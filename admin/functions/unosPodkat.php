<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";
        try{
             $ime=$_POST['ime'];
             $idKat = $_POST['idKat'];
             $greska=[];
             $regexIme= "/^([A-Z])+([A-z\s]){2,50}/";
             if(!preg_match($regexIme,$ime)){   
                $greska[]="Ime nije dobro.Veliko prvo slovo, samo slova, do 50 karaktera";
                }
             if(existsPodkat($ime)){
                $greksa[]="Postoji vec potkategorija sa istim imenom";
             }
             if(empty($greska)){
            
                $unos= unosPodkategorije($ime,$idKat);
                if($unos){
                    $odgovor = ["poruka"=>"Uspesno ste se uneli podkategoriju."];
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
            //var_dump($exception);
        }
    }
    else{
        http_response_code(404);
    }
?>