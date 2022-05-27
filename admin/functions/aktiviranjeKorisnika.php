<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";

        try{
            $idKorisnik = $_GET['id'];
            $korisnici = "";
            $aktivan = 1;
            
            $brisanje = aktivacija2("user","aktivanUser",$idKorisnik,"idUser",$aktivan);
            
            if($brisanje){
                $korisnici = vratiSve('user');
            }

           

            header('Location: ../upravljajKorisnicima.php');
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>