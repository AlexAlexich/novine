<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection/connection.php";
        include "functions.php";

        try{
            $ime = $_POST['ime'];
            $email = $_POST['email'];
            $razlozi = $_POST['razlozi'];
            $poruka = $_POST['poruka'];
            
            
            
            $checkIme = "/^[A-Z][a-z]{2,50}/";
            $checkEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
            
            $greska=[];
            if(!preg_match($checkIme,$ime)){   
                $greska[]="Ime nije dobro";
            }
            if(!preg_match($checkEmail,$email)){   
                $greska[]="Email nije dobar";
            }
            if(strlen($poruka)>500){   
                $greska[]="Poruka nije dobra'";
            }
            if($razlozi==0){
                $greska[]="Razlog nije dobar";
            }
            if(empty($greska)){

                $unos = unosKontakta($ime,$email,$razlozi,$poruka);
                if($unos){
                    $odgovor = ["poruka"=>"Uspesno ste poslali poruku, bicete kontaktirani putem maila"];
                    echo json_encode($odgovor);
                    http_response_code(201);
                }
            }
            else{
                
                $odgovor = $greska;
                echo json_encode($odgovor);
                http_response_code(422);
            }  
        }
        catch(PDOException $exception){
            http_response_code(500);
            var_dump($exception);
        }
    }
    else{
        http_response_code(404);
    }
?>