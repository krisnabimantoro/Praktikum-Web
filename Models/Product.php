<?php

namespace Models;
include "Config/DatabaseConfig.php";

use Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig{
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host,$this->user,$this->password,$this->database_name,$this->port);
        
        if ($this->conn->connect_error) {
            die("Connection Failed: ". $this->conn->connect_error);
        }
    }

    public function findAll(){
        $sql = "Select * from product";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function findById($id){
        $sql = "select * from product where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function create($data){
        $productName = $data['product_name'];
        $query = "insert into product (product_name) values (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s",$productName);
        $stmt->execute();
        $this->conn->close();
    }
    public function update($data,$id, ){
        $productName = $data['product_name'];
        $query = "update product set product_name = ? where id =?";

        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si",$productName,$id);
        $stmt->execute();
        $this->conn->close();
    }
    public function delete($id){
        $query = "delete from product where id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $this->conn->close();    
    }
    
}