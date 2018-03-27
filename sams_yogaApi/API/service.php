<?php
	class service
	{
		// read product
		function verifyLogin($data){
			require('core/database.php');
			require('models/User.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$user = new User($db);
			 $user->email=$data->email;
			 $user->password=$data->password;
			// query products
			$stmt = $user->login();
			$result=array();
			// check if more than 0 record found
			if($stmt){
				// heros array
				$result["data"]=array(
					"name" => $user->name,
					"token" => $user->token
				);

				
				$result["status"]='ok';
				$result["message"]='Login successfully';
				
			}else{
				$result["data"]="";
				$result["status"]='error';
				$result["message"]='Invalid Email or Password';
			}
			return $result;
		}

		function validateLogin($data){
			require('core/database.php');
			require('models/User.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$user = new User($db);
			 $user->token=$data;
			 
			// query products
			$stmt = $user->validateToken();
			$result=array();
			// check if more than 0 record found
			if($stmt){
				// heros array
				$result["data"]=array(
					"name" => $user->name,
					"token" => $user->token
				);

				
				$result["status"]='ok';
				$result["message"]='Valid token!';
				
			}else{
				$result["data"]="";
				$result["status"]='error';
				$result["message"]='Invalid token!';
			}
			return $result;
		}

		function getAdminTimeTable(){
			require('core/database.php');
			require('models/TimeTable.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$timetable = new TimeTable($db);
			 $timetable->day=$_GET['day'];
			 
			// query products
			 $result=array();
			$result["data"] = $timetable->getAdminTimeTable();
			$result["status"]='ok';
			$result["message"]='data loaded!';
			return $result;
		}

		function getTimeTable(){
			require('core/database.php');
			require('models/TimeTable.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$timetable = new TimeTable($db);
			 
			// query products
			 $result=array();
			$result["data"] = $timetable->getTimeTable();
			$result["status"]='ok';
			$result["message"]='data loaded!';
			return $result;
		}
		function addSlot($data){
			$result;
			if(isset($data->day) && !empty($data->day)){
				require('core/database.php');
				require('models/Slot.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$slot = new Slot($db);
				// get posted data
				
				// set product property values
				$slot->day = $data->day;
				$slot->start_time = $data->start_time;
				$slot->end_time = $data->end_time;
				if(!$slot->checkTime())
				{
					$result = array(
						"message" => "End Time Should be greater than Start Time",
						"status" => "error"
					);

				}
				else if(!$slot->checkTimeDiffenece())
				{
					$result = array(
						"message" => "Slot Can be of 1 or 2 hours",
						"status" => "error"
					);

				}
				elseif (!$slot->checkSlotOverlap()) {
					$result = array(
						"message" => "Slot Must not overlap other slots",
						"status" => "error"
					);
				}
				elseif (!$slot->checkSlotDifference()) {
					$result = array(
						"message" => "Duration between slots is minimum 20 minutes",
						"status" => "error"
					);
				}
				else if($slot->create()){
					$result = array(
						"message" => "Slot was created.",
						"status" => "ok"
					);
				}
				else{
					$result = array(
						"message" => "Unable to create slot.",
						"status" => "error"
					);
				}
			}
			else
			{
				$result = array(
					"message" => "Please enter slot day.",
					"status" => "error"
				);
			}

			return $result;
			
		}

		function deleteClass($data){
			require('core/database.php');
			require('models/TimeTable.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$timetable = new TimeTable($db);
			
			 
			// query products
			 $result=array();
			if($timetable->timeTableDeleteClass($data->class_id,$data->slot_id,$data->venu_id))
			{
				$result["status"]='ok';
				$result["message"]='Class Removed!!!';
			}
			else
			{
				$result["status"]='error';
				$result["message"]='Error Removing Class!!!';
			}
			return $result;
		}

		function addClass($data){
			require('core/database.php');
			require('models/TimeTable.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$timetable = new TimeTable($db);
			
			 
			// query products
			 $result=array();
			if($timetable->timeTableAddClass($data->class_id,$data->slot_id,$data->venu_id))
			{
				$result["status"]='ok';
				$result["message"]='Class Added!!!';
			}
			else
			{
				$result["status"]='error';
				$result["message"]='Error Adding Class!!!';
			}
			return $result;
		}
		function getAddClasses(){
			require('core/database.php');
			require('models/TimeTable.php');
			// instantiate database and hero object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$timetable = new TimeTable($db);
			 
			 
			// query products
			 $result=array();
			$result["data"] = $timetable->getClasses($_GET['slot_id']);
			$result["status"]='ok';
			$result["message"]='Classes loaded!';
			return $result;
		}		
		
	}


		
?>