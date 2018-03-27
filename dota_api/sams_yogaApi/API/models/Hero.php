<?php
class Hero{
 
    // database connection and table name
    private $conn;
    private $table_name = "hero";
 
    // object properties
    public $id;
    public $name;
    public $img;
  	public $local_name;
  	public $hero_strengths;
  	public $hero_counters;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
        $query = "SELECT
                     h.id, h.name,h.img, h.local_name
                FROM
                    " . $this->table_name . " h";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function readOne(){
    
       // query to read single record
       $query = "SELECT
                     h.id, h.name,h.img, h.local_name
                FROM
                    " . $this->table_name . " h
               WHERE
                   h.id = ?
               LIMIT
                   0,1";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $this->id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       // set values to object properties
       $this->name = $row['name'];
       $this->img = $row['img'];
       $this->local_name = $row['local_name'];
       $this->hero_strengths = $this->readStrengths($this->id);
       $this->hero_counters = $this->readCounters($this->id);
       
   }


   function getHeroName($id){
    
       // query to read single record
       $query = "SELECT
                     h.local_name
                FROM
                    " . $this->table_name . " h
               WHERE
                   h.id = ?
               LIMIT
                   0,1";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       // set values to object properties
       return $row['local_name'];
      
       
   }

   function getHeroImg($id){
    
       // query to read single record
       $query = "SELECT
                     h.img
                FROM
                    " . $this->table_name . " h
               WHERE
                   h.id = ?
               LIMIT
                   0,1";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       // set values to object properties
       return $row['img'];
      
       
   }

   function get_best_heros($data){
    
       // query to read single record
       $query = "SELECT
                     h.id, h.name,h.img, h.local_name
                FROM
                    " . $this->table_name . " h
               WHERE
                   h.id = ?
               LIMIT
                   0,1";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $data->hero_id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       // set values to object properties
       $arrayName = array();
       $arrayName['name'] = $row['local_name'];
       $arrayName['img'] = $row['img'];
       $arrayName['games'] = $data->games;
       $arrayName['wins'] = $data->win;

       return $arrayName;
       
   }


   function readStrengths($id){
    
       // query to read single record
       $query = "SELECT
                      strength_id,strength_name
                FROM
                    strengths JOIN hero_strengths
               ON
                   strength_id=strength and hero_id=?";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
      $num = $stmt->rowCount();
      $result=array();
      // check if more than 0 record found
      if($num>0){
        // heros array
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to
          // just $name only
          extract($row);
          $hero_strength=array(
            "id" => $strength_id,
            "name" => $strength_name,
          );
          
          
          array_push($result, $hero_strength);
        }
        
      }

      return $result;
       
   }


   function readCounters($id){
   
       // query to read single record
       $query = "(SELECT
                        id,local_name
                FROM
                    hero JOIN (SELECT hero_id FROM hero_strengths JOIN (SELECT that FROM strength_counters JOIN (SELECT strength_id FROM strengths JOIN hero_strengths ON strength_id=strength and hero_id=".$id.") s ON this=s.strength_id) k ON strength=k.that WHERE hero_id!=".$id." GROUP by hero_id) h
               ON
                   id=h.hero_id) 
                   UNION
                   (SELECT id,local_name FROM `hero` JOIN direct_counters on id=this and that=".$id.")";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
      // $stmt->bindParam(1, $id);
       //$stmt->bindParam(2, $id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
      $num = $stmt->rowCount();
      $result=array();
      // check if more than 0 record found
      if($num>0){
        // heros array
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to
          // just $name only
          
          extract($row);
          $hero_counter=array(
            "id" => $id,
            "name" => $local_name,
          );
          
          array_push($result, $hero_counter);
        }
        
      }

      return $result;
       
   }



   function readBestPicks($ids){
        
       // query to read single record
      $on='';
      $direct_on='';
      $where='';
      for($x = 0; $x < count($ids); $x++)
      {
        if($on=='')
        {
          $on="hero_id=".$ids[$x];
           $direct_on='that='.$ids[$x];
          $where="hero_id!=".$ids[$x];

        }
        else
        {
          $on.=" OR hero_id=".$ids[$x];
          $direct_on.=" OR that=".$ids[$x];
          $where.=" AND hero_id!=".$ids[$x];
        }
        
      }
       $query = "(SELECT
                        id,name,img,local_name
                FROM
                    hero JOIN (SELECT hero_id FROM hero_strengths JOIN (SELECT that FROM strength_counters JOIN (SELECT strength_id FROM strengths JOIN hero_strengths ON strength_id=strength and (".$on.")) s ON this=s.strength_id) k ON strength=k.that WHERE ".$where." GROUP by hero_id) h
               ON
                   id=h.hero_id)
                   UNION
                   (SELECT id,name,img,local_name FROM `hero` JOIN direct_counters on id=this and (".$direct_on."))";
      
      
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
      return $stmt;
       
   }


    

   
}