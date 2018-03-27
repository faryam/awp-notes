<?php
	// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



if(isset($_GET['method']) && $_GET['method'] == 'getFoodItems')
{


	$host = "localhost";
	$db_name = "samcuisine";
	$username = "root";
	$password = "";
	$conn=null;
	try
	{
		$conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
		$conn->exec("set names utf8");
	}
	catch(PDOException $exception)
	{
		echo "Connection error: " . $exception->getMessage();
	}

	if($conn!=null)
	{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
		$query = "SELECT
		f.foodItemId, f.name,f.imageUrl, f.description,f.categoryId, f.createdDate,c.name as categoryName
		FROM
		fooditem f
		LEFT JOIN
		category c
		ON f.categoryId = c.categoryId
		ORDER BY
		f.createdDate DESC";

        // prepare query statement
		$stmt = $conn->prepare($query);

        // execute query
		$stmt->execute();
		$num = $stmt->rowCount();
		$result=array();
		if($num>0)
		{
				// products array
			$result["data"]=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// extract row
					// this will make $row['name'] to
					// just $name only

				extract($row);
				$food_item=array(
					"id" => $foodItemId,
					"name" => $name,
					"description" => html_entity_decode($description),
					"imageUrl" => $imageUrl,
					"categoryId" => $categoryId,
					"categoryName" => $categoryName,
					"createdDate"=>$createdDate
				);
				array_push($result["data"], $food_item);
			}
			$result["status"]='ok';
			$result["message"]='Product are loaded successfully';

		}
		else
		{
			$result["status"]='ok';
			$result["message"]='Product are loaded successfully';
		}

		echo json_encode($result);
	}

}
?>