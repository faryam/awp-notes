<?php
class Slot{
 
    // database connection and table name
    private $conn;
    private $table_name = "slots";
 
    // object properties
    public $id;
    public $day;
    public $start_time;
  	public $end_time;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
     $query = "INSERT
                INTO
                    " . $this->table_name . "
                SET
                    day = :day,
                    start_time=:start_time,
                    end_time=:end_time";
       
        
        // prepare query statement
        

       $stmt = $this->conn->prepare($query);
        $this->day=htmlspecialchars(strip_tags($this->day));
        $this->start_time=htmlspecialchars(strip_tags($this->start_time));
        $this->end_time=htmlspecialchars(strip_tags($this->end_time));
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);

         if($stmt->execute()){
               return true;
           }else{
               return false;
           }
        
        
    }

    public function checkTimeDiffenece()
    {
      $result=abs(strtotime($this->end_time)-strtotime($this->start_time))/60;
      if($result==60||$result==120)
      {
        return true;
      }
      return false;
    }


    public function checkTime()
    {
      $result=abs(strtotime($this->end_time)-strtotime($this->start_time))/60;
      if(abs(strtotime($this->end_time)>strtotime($this->start_time)))
      {
        return true;
      }
      return false;
    }

     function checkSlotDifference(){
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
     $query = "SELECT
                    s.end_time
                FROM
                    " . $this->table_name . " s
                WHERE
                    s.day = ? ";
       
        
        // prepare query statement
        
         
       $stmt = $this->conn->prepare($query);
       $stmt->bindParam(1, $this->day);
       $stmt->execute();
       $num = $stmt->rowCount();
        if($num>0){
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           extract($row);
           
          if(strtotime($end_time)<=strtotime($this->start_time))
          {
            
            $result=abs(strtotime($this->start_time)-strtotime($end_time))/60;
            if($result<20)
            {
              return false;

            }
            
          }
          
         }
       }

       return true;    
        
    }

    function checkSlotOverlap(){
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
     $query = "SELECT
                    *
                FROM
                    slots s
                WHERE
                    (
                        (
                            s.start_time >= '".$this->start_time."' AND s.start_time <= '".$this->end_time."'
                        ) OR(
                            s.end_time >= '".$this->start_time."' AND s.end_time <= '".$this->end_time."'
                        ) OR(
                            s.start_time <= '".$this->start_time."' AND s.end_time >= '".$this->end_time."'
                        )
                    ) AND s.day = '".$this->day."'";
       
        
        // prepare query statement
       //echo $query;die(); 
       $stmt = $this->conn->prepare($query);
       $stmt->execute();
       $num = $stmt->rowCount();
        if($num>0){
          
              return false;

            
       }

       return true;    
        
    }

    



    

   
}