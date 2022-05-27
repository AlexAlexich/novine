<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";

        try{
            $idKomentara = $_GET['id'];
            $komentari = "";
            $idVesti = $_GET['idVesti'];
            $aktivan = 1;
            $akcija = aktivacija2("komentar","aktivanKomentar", $idKomentara,"idKomentara",$aktivan);

            
            if($akcija){
                $komentari =vratiKomentare($idVesti) ;
               
            }

           


            header('Location: ../../vest.php?id='.$idVesti);
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>