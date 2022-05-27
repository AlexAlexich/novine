<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection/connection.php";
        include "functions.php";

        try{
            $id= $_POST['id'];
            $vesti = "";
            $idKat = isset($_POST['idKat']) ? $_POST['idKat'] : false;

            if($idKat==false){
                if($id == 1){
                    //asc
                $vesti= vratiVestiPoKomentarima('ASC');
                
                }
                else if($id == 2){
                    //desc
                    $vesti= vratiVestiPoKomentarima('DESC');
                    
                }
        }
            else{
                 if($id == 1){
                    //asc
                $vesti= vratiVestPoKomentarimaIPodkategoriji('ASC',$idKat);
                
                }
                else if($id == 2){
                    //desc
                    $vesti= vratiVestPoKomentarimaIPodkategoriji('DESC',$idKat);
                    
                }
                
            }
            
            echo json_encode($vesti);
            http_response_code(200);
           
        }
        catch(PDOException $exception){
            http_response_code(500);
            
        }
    }
    else{
        http_response_code(404);
    }
?>