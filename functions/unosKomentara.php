<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection/connection.php";
        include "functions.php";

        try{
            $komentar = $_POST['komentar'];
            $idUser = $_POST['idUser'];
            $idVest = $_POST['idVest'];
            $regexKomentar = "/^([A-Z])+([A-z0-9_\-\.\s\!\?]){2,500}/";
            if(!preg_match($regexKomentar,$komentar)){   
                $greska[]="Komentar nije u dobroj formi, max 500 karaktera min 3. Prvo slovo veliko";
            }
            if(!exists("idUser",$idUser)){
                $greska[]="Ne postoji taj user";
            }
            if(!existsVest("idVest",$idVest)){
                $greska[]="Ne postoji ta vest";
            }
            if(empty($greska)){
                $unos = unosKomentara($komentar,$idUser,$idVest);
                if($unos){
                    $odgovor = ["poruka"=>"Uspesno ste komentarisali"];
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