<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../core/database.php';
include_once '../../model/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited

$sourcePath = $_FILES['userImage']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = "upload/".$_FILES['userImage']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;
//var_dump($_POST);
// set product property values
$product->id = $_POST['id'];
$product->name = $_POST['name'];
$product->price = $_POST['price'];
$product->productImage=$targetPath;
$product->description = $_POST['description'];
$product->category_id = $_POST['category_id'];
 
// update the product
if($product->update()){
    echo '{';
        echo '"message": "Product was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product."';
    echo '}';
}
?>