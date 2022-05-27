<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";
        try{
            $search = isset($_POST["search"]) ? trim($_POST["search"]) : false;  
            $search = strtolower($search);
            
            $pretraga = search('%'.$search.'%');
            
            $uloge = vratiSve('uloga');
            
            echo json_encode([$pretraga,$uloge]);
            http_response_code(201);
        }
        catch(PDOException $exception){
            http_response_code(500);
            //var_dump($exception);
        }
    }
    else{
        http_response_code(404);
    }
?>