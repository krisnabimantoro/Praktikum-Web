<?php

namespace Controller;

include "Traits/ApiResponseFormatter.php";
include "Models/Event.php";

use Traits\ApiResponseFormatter;
use Models\Event;

class EventController {
    use ApiResponseFormatter;

    public function index(){
        $eventModel = new Event();
        $response  = $eventModel->findAll();
        return $this->apiResponse(200, "succes", $response);
    }
    public function getById($id){
        $eventModel = new Event();
        
        $response  = $eventModel->findById($id);
        return $this->apiResponse(200, "succes", $response);
    }
    public function insert(){
        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            $jsonInput = file_get_contents("php://input");
            $inputData = json_decode($jsonInput, true);
        
            if (json_last_error()) {
                return $this->apiResponse(400, "Error: invalid input", null);
            }
        } else {
            // Handle form-data or x-www-form-urlencoded
            $inputData = $_POST;
        }

        $eventModel = new Event();
        $response = $eventModel->create([
            'name' => $inputData['name'],
            'description' => $inputData['description'],
            'date_event' => $inputData['date_event'],
            'image_event' => $inputData['image_event'],
            'locate' => $inputData['locate'],
            'target_audiens' => $inputData['target_audiens'],   
        ]);
        
        return $this->apiResponse(200, "succes", $response);
    }
    public function update($id){
        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            $jsonInput = file_get_contents("php://input");
            $inputData = json_decode($jsonInput, true);
        
            if (json_last_error()) {
                return $this->apiResponse(400, "Error: invalid input", null);
            }
        } else {
            // Handle form-data or x-www-form-urlencoded
            // parse_str(file_get_contents("php://input"), $inputData);
            // echo $inputData["name"]."";
            // echo $inputData["description"]."";
            $inputData = $_POST;                                                    
           
        }

        $eventModel = new Event();
        $response = $eventModel->update([
            'name' => $inputData['name'],
            'description' => $inputData['description'],
            'date_event' => $inputData['date_event'],
            'image_event' => $inputData['image_event'],
            'locate' => $inputData['locate'],
            'target_audiens' => $inputData['target_audiens'],],$id);
        return $this->apiResponse(200, "succes", $response);
    }

    public function delete($id){
        $eventModel = new Event();
        $response = $eventModel->delete($id);

        return $this->apiResponse(200, "succes", $response);
    }
}