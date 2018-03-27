<?php
class Product
{

    // database connection and table name
    private $conn;
    private $table_name = "games";

    // object properties
    public $id;
    public $name;
    public $price;
    

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function readAllProducts()
    {

    // select all query
            $query = "select * from ".$this->table_name;

            if($this->conn->query($query) == TRUE)
            {
                $products_arr=array();
                $products_arr["records"]=array();
                $rs = $this->conn->query($query);
                while( $r = $rs->fetch_assoc())
                {
                   $product_item=array(
                    "id" => $r["id"],
                    "name" => $r["name"],
                    "price" => $r["price"]
                );

                   array_push($products_arr["records"], $product_item);
               }
               echo json_encode($products_arr);   
           }
           else
           {
            die ("COnnection failed: " . $this->conn->error);
            }

    }

    public function readProduct($id)
    {

    // select all query
            $query = "select * from ".$this->table_name." where id=".$id;

            if($this->conn->query($query) == TRUE)
            {
                $products_arr=array();
                $products_arr["records"]=array();
                $rs = $this->conn->query($query);
                while( $r = $rs->fetch_assoc())
                {
                   $product_item=array(
                    "id" => $r["id"],
                    "name" => $r["name"],
                    "price" => $r["price"]
                );

                   array_push($products_arr["records"], $product_item);
               }
               echo json_encode($products_arr);   
           }
           else
           {
            die ("COnnection failed: " . $this->conn->error);
            }

    }
}