<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";

        try{
            $idUloge = $_POST['idUl'];
            $idKorisinka = $_POST['idK'];
            if($idUloge==0){
                $korisnici = vratiKorisinke();
                 $uloge = vratiSve('uloga');
            }
            else{
                $promena = promenaUloge($idUloge,$idKorisinka);
                
                if($promena){
                    $korisnici = vratiKorisinke();
                    $uloge = vratiSve('uloga');
            
                    }
                }    
            echo json_encode([
                "korisnici"=>$korisnici,
                "uloge"=>$uloge]);
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