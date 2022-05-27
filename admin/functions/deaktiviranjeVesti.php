<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";

        try{
            $idVest = $_GET['id'];
            $vesti = "";
            
            
            $brisanje = aktivacija2("vest","vestAktivna",$idVest,"idVest");
            
            if($brisanje){
                $vesti = vratiVestiSve();
            }

            


            header('Location: ../upravljajVestima.php');
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>