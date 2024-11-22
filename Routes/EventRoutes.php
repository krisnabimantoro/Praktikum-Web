<?php

namespace Routes;
include "Controller/EventController.php";
use Controller\EventController;

class EventRoutes{
    public function handle($method,$path){
        if ($method == "GET"&& $path == "/api/event") {
            $controller  = new EventController(); 
            echo $controller->index();
        }

        if ($method == "GET"&& strpos($path,"/api/event/")==0) {
            $pathParts = explode("/",$path);
            $id = $pathParts[count($pathParts)-1];
            $controller = new EventController();
            echo $controller->getById($id);    
        }

        if ($method == "POST"&& $path == "/api/event") {
            $controller  = new EventController(); 
            echo $controller->insert();
        }


        if ($method == "PUT"&& strpos($path,"/api/event/")== 0) {
            $pathParts = explode("/",$path);
            $id = $pathParts[count($pathParts)-1];
            $controller = new EventController();
            echo $controller->update($id);    
        }
        if ($method == "POST"&& strpos($path,"/api/event/")== 0) {
            $pathParts = explode("/",$path);
            $id = $pathParts[count($pathParts)-1];
            $controller = new EventController();
            echo $controller->update($id);    
        }
        if ($method == "DELETE" && strpos($path,"/api/event/")== 0) {
            $pathParts = explode("/",$path);
            $id = $pathParts[count($pathParts)-1];
            $controller = new EventController();
            echo $controller->delete($id);    
        }
        
    }
}