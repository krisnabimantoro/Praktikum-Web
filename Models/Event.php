<?php

namespace Models;
include "Config/DatabaseConfig.php";

use Config\DatabaseConfig;
use mysqli;

class Event extends DatabaseConfig{
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host,$this->user,$this->password,$this->database_name,$this->port);
        
        if ($this->conn->connect_error) {
            die("Connection Failed: ". $this->conn->connect_error);
        }
    }

    public function findAll(){
        $sql = "Select * from event";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function findById($id){
        $sql = "select * from event where id = ?";
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
        $eventName = $data['name'];
        $description = $data['description'];
        $dateEvent = $data['date_event'];
        $imageEvent = $data['image_event'];
        $locate = $data['locate'];
        $targetAudiens = $data['target_audiens'];

        $query = "INSERT INTO event (name, description, date_event, image_event, locate, target_audiens) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $eventName, $description, $dateEvent, $imageEvent, $locate, $targetAudiens);

        $stmt->execute();
        $this->conn->close();
    }
    public function update($data,$id, ){
        $eventName = $data['name'];
        $description = $data['description'];
        $dateEvent = $data['date_event'];
        $imageEvent = $data['image_event'];
        $locate = $data['locate'];
        $targetAudiens = $data['target_audiens'];
        
        $query = "UPDATE event 
                  SET name = ?, 
                      description = ?, 
                      date_event = ?, 
                      image_event = ?, 
                      locate = ?, 
                      target_audiens = ? 
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssi", $eventName, $description, $dateEvent, $imageEvent, $locate, $targetAudiens, $id);


        $stmt->execute();
        $this->conn->close();
    }
    public function delete($id){
        $query = "delete from event where id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $this->conn->close();    
    }
    
}