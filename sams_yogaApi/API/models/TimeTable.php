<?php
class TimeTable{

    // database connection and table name
  private $conn;
  public $day;

    // object properties

    // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  function getAdminTimeTable(){
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT
                  *
              FROM
                  slots s
              WHERE
                  s.day = ?
              ORDER BY
                  start_time ASC";

        // prepare query statement
    $slots = $this->conn->prepare($query);

        // bind id of product to be updated

    $slots->bindParam(1, $this->day);


        // execute query
    $slots->execute();

    $num = $slots->rowCount();
    $timetable=array();
    $timetable['slots']=array();
    if($num>0){
      while ($row = $slots->fetch(PDO::FETCH_ASSOC)){
       extract($row);          
       array_push($timetable['slots'], $start_time." - ".$end_time);

     }
   }
        // select all query
   $query = "SELECT
                  *
              FROM
                  venus v
              ORDER BY
                  id ASC";

        // prepare query statement
   $venus = $this->conn->prepare($query);




        // execute query
   $venus->execute();

   $num = $venus->rowCount();
   $timetable['venus']=array();
   if($num>0){
    while ($venu = $venus->fetch(PDO::FETCH_ASSOC)){
     $venudata=array();
     $venudata['id']=$venu['id'];
     $venudata['name']=$venu['name'];
     $venudata['classes']=array();

     $query = "SELECT
                    *
                FROM
                    slots s
                WHERE
                    s.day = ?
                ORDER BY
                    start_time ASC";

        // prepare query statement
     $slots = $this->conn->prepare($query);

        // bind id of product to be updated

     $slots->bindParam(1, $this->day);


        // execute query
     $slots->execute();

     $num = $slots->rowCount();
     if($num>0){
      while ($row = $slots->fetch(PDO::FETCH_ASSOC)){
         extract($row);
         $result=array(
          "slotId" => $id,
          "class" => $this->getClass($venu['id'],$id)
        );         
         array_push($venudata['classes'], $result);

        }
      }



      array_push($timetable['venus'], $venudata);

    }

    
  }

  return $timetable;



}

function getTimeTable(){
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    $timetable=array();
    $daysClasses=array();
    for ($i=0; $i <count($days) ; $i++)
    { 
      $daysClasses[$days[$i]]=$this->getDayClasses($days[$i]);
    }
   
    $classesCount=array();
    for ($i=0; $i <count($days) ; $i++) 
    { 
       $classesCount[$days[$i]]=count($daysClasses[$days[$i]]);
    }
    $value = max($classesCount);
    for ($i=0; $i <$value ; $i++) { 
      $arrayName = array(
        'Monday' => isset($daysClasses["Monday"][$i]) ? $daysClasses["Monday"][$i]:'', 
        'Tuesday' => isset($daysClasses["Tuesday"][$i]) ? $daysClasses["Tuesday"][$i]:'', 
        'Wednesday' => isset($daysClasses["Wednesday"][$i]) ? $daysClasses["Wednesday"][$i]:'', 
        'Thursday' => isset($daysClasses["Thursday"][$i]) ? $daysClasses["Thursday"][$i]:'', 
        'Friday' => isset($daysClasses["Friday"][$i]) ? $daysClasses["Friday"][$i]:'', 
        'Saturday' => isset($daysClasses["Saturday"][$i]) ? $daysClasses["Saturday"][$i]:'', 
        'Sunday' => isset($daysClasses["Sunday"][$i]) ? $daysClasses["Sunday"][$i]:'', 
      );
      array_push($timetable, $arrayName);

    }
   



    return $timetable;



}



function getClass($venuId,$slotId){
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
  $query = "SELECT
                c.id,
                c.name AS classname,
                t.name AS teachername
            FROM
                classes c
            JOIN classteachers ct ON
                c.id = ct.class_id
            JOIN teachers t ON
                t.id = ct.teacher_id
            JOIN classvenuslots cvs ON
                c.id = cvs.class_id AND cvs.slot_id = ".$slotId." AND cvs.venu_id = ".$venuId;

        // prepare query statement
  $classes = $this->conn->prepare($query);




        // execute query
  $classes->execute();

  $num = $classes->rowCount();

  if($num>0){
    $row = $classes->fetch(PDO::FETCH_ASSOC);
    extract($row);          
    $result=array(
      "id" => $id,
      "name" => $classname,
      "teachername"=> $teachername
    );
    return $result;

  }

  $abc=array();
  return $abc;

}


function timeTableDeleteClass($class_id,$slot_id,$venu_id)
{
  $query = "DELETE
            FROM
                classvenuslots
            WHERE
                class_id = ? AND slot_id = ? AND venu_id = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
    
       // bind id of record to delete
       $stmt->bindParam(1, $class_id);
       $stmt->bindParam(2, $slot_id);
       $stmt->bindParam(3, $venu_id);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;

}

function timeTableAddClass($class_id,$slot_id,$venu_id)
{
  $query = "INSERT INTO
                classvenuslots
            SET
                slot_id=:slot_id,class_id=:class_id,venu_id=:venu_id";
       
        
        // prepare query statement
        

       $stmt = $this->conn->prepare($query);
        $slot_id=htmlspecialchars(strip_tags($slot_id));
        $class_id=htmlspecialchars(strip_tags($class_id));
        $venu_id=htmlspecialchars(strip_tags($venu_id));
        $stmt->bindParam(":slot_id", $slot_id);
        $stmt->bindParam(":class_id", $class_id);
        $stmt->bindParam(":venu_id", $venu_id);

         if($stmt->execute()){
               return true;
           }else{
               return false;
           }

}

function getClasses($slotId){
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
  $query = "SELECT
                k.id,
                k.name
            FROM
                (
                SELECT
                    q.id,
                    q.name
                FROM
                    (
                    SELECT
                        id,
                        NAME
                    FROM
                        classes
                    WHERE
                        id NOT IN(
                        SELECT
                            ct.class_id
                        FROM
                            classteachers ct
                        INNER JOIN(
                            SELECT
                                cts.teacher_id
                            FROM
                                classteachers cts
                            JOIN(
                                SELECT
                                    class_id
                                FROM
                                    classvenuslots
                                WHERE
                                    slot_id = '".$slotId."'
                            ) a
                        ON
                            a.class_id = cts.class_id
                        GROUP BY
                            cts.teacher_id
                        ) b
                    ON
                        ct.teacher_id = b.teacher_id
                    GROUP BY
                        ct.class_id
                    )
                ) q
            JOIN(
                SELECT
                    id,
                    NAME
                FROM
                    classes
                WHERE
                    id NOT IN(
                    SELECT
                        cs.class_id
                    FROM
                        classstudents cs
                    INNER JOIN(
                        SELECT
                            st.student_id
                        FROM
                            classstudents st
                        JOIN(
                            SELECT
                                class_id
                            FROM
                                classvenuslots
                            WHERE
                                slot_id = '".$slotId."'
                        ) a
                    ON
                        a.class_id = st.class_id
                    GROUP BY
                        st.student_id
                    ) X
                ON
                    cs.student_id = X.student_id
                GROUP BY
                    cs.class_id
                )
            ) w
            ON
                q.id = w.id AND q.name = w.name
            ) k
            JOIN(
                SELECT
                    id,
                    NAME
                FROM
                    classes
                WHERE
                    id IN(
                    SELECT
                        class_id
                    FROM
                        classteachers
                    WHERE
                        teacher_id IN(
                        SELECT
                            f.id
                        FROM
                            (
                            SELECT
                                t.id,
                                g.classCount
                            FROM
                                teachers t
                            LEFT JOIN(
                                SELECT
                                    COUNT(cvs.class_id) AS classCount,
                                    tc.teacher_id
                                FROM
                                    classvenuslots cvs
                                INNER JOIN(
                                    SELECT
                                        ct.class_id,
                                        ct.teacher_id
                                    FROM
                                        classteachers ct
                                    INNER JOIN(
                                        SELECT
                                            teacher_id
                                        FROM
                                            classteachers
                                        WHERE
                                            class_id IN(
                                            SELECT
                                                class_id
                                            FROM
                                                classvenuslots
                                            WHERE
                                                slot_id IN(
                                                SELECT
                                                    id
                                                FROM
                                                    slots
                                                WHERE
                                                    DAY IN(
                                                    SELECT
                                                        DAY
                                                    FROM
                                                        slots
                                                    WHERE
                                                        id = '".$slotId."'
                                                )
                                            )
                                        GROUP BY
                                            class_id
                                        )
                                    GROUP BY
                                        teacher_id
                                    ) t
                                ON
                                    ct.teacher_id = t.teacher_id
                                ) tc
                            ON
                                cvs.class_id = tc.class_id
                            WHERE
                                cvs.slot_id IN(
                                SELECT
                                    id
                                FROM
                                    slots
                                WHERE
                                    DAY IN(
                                    SELECT
                                        DAY
                                    FROM
                                        slots
                                    WHERE
                                        id = '".$slotId."'
                                )
                            )
                        GROUP BY
                            tc.teacher_id
                            ) g
                        ON
                            t.id = g.teacher_id
                        ) f
                    WHERE
                        f.classCount < 3 OR f.classCount IS NULL
                    )
                )
            ) u
            ON
                k.id = u.id AND k.name = u.name";

        // prepare query statement
  $classes = $this->conn->prepare($query);




        // execute query
  $classes->execute();

  $num = $classes->rowCount();
  $result=array();
  if($num>0){
       while ($row = $classes->fetch(PDO::FETCH_ASSOC)){
            extract($row);          
            $abc=array(
              "id" => $id,
              "name" => $NAME,
            );
            array_push($result, $abc);
          }
  }

  
  return $result;

}

function getDayClasses($day){
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
  $query = "SELECT
                c.id,
                c.name AS classname,
                c.colour,
                t.name AS teachername,
                a.start_time,
                a.end_time
            FROM
                classes c
            JOIN classteachers ct ON
                c.id = ct.class_id
            JOIN teachers t ON
                t.id = ct.teacher_id
            JOIN(
                SELECT
                    cvs.class_id,
                    b.start_time,
                    b.end_time
                FROM
                    classvenuslots cvs
                JOIN(
                    SELECT
                        s.id,
                        s.start_time,
                        s.end_time
                    FROM
                        slots s
                    WHERE
                        s.day = '".$day."'
                ) b
            ON
                cvs.slot_id = b.id
            ) a
            ON
                ct.class_id = a.class_id";

        // prepare query statement
  $classes = $this->conn->prepare($query);




        // execute query
  $classes->execute();

  $num = $classes->rowCount();
  $result=array();
  if($num>0){
       while ($row = $classes->fetch(PDO::FETCH_ASSOC)){
            extract($row);          
            $abc=array(
              "name" => $classname,
              "colour"=>$colour,
              "teachername"=> $teachername,
              "timing"=>$start_time." - ".$end_time
            );
            array_push($result, $abc);
          }
  }

  
  return $result;

}



}

?>











