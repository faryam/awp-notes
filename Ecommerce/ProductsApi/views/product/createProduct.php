<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../../core/database.php';
include_once '../../model/product.php';

$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

$sourcePath = $_FILES['userImage']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = "upload/".$_FILES['userImage']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;
//var_dump($_POST);
// set product property values
$product->name = $_POST['name'];
$product->price = $_POST['price'];
$product->productImage=$targetPath;
$product->description = $_POST['description'];
$product->category_id = $_POST['category_id'];
$product->created = date('Y-m-d H:i:s');

if($product->name !="" && isset($product->name)){
    // create the product
    if($product->create()){
        echo '{';
            echo '"message": "Product was created."';
        echo '}';
    }
    
    // if unable to create the product, tell the user
    else{
        echo '{';
            echo '"message": "Unable to create product."';
        echo '}';
    }
}else{
    echo '{';
        echo '"message": "Please enter product name."';
    echo '}';
}
?>