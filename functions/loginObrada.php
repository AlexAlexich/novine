<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection/connection.php";
        include "functions.php";

        try{
            $email = $_POST['email'];
            $lozinka = $_POST['password'];
            $sLozinka = md5($lozinka);
            $regexLozinka ="/^([A-Z])+([A-Za-z0-9]{7,30})$/";
            
            if(!preg_match($regexLozinka,$lozinka)){
                $greska[] = "Sifra nije u dobroj formi, mora poceti velikim slovom,moze sadrzati mala i velika slova i brojeve. Minimum 8 karaktera";
            }
            if(!exists('passwordUser',$sLozinka)){
                $greska[] = "Sifra se ne poklapa sa sifrom email";
            }
            if(!filter_var($email,FILTER_SANITIZE_EMAIL)){
                $greska[]="Email nije validan";
            }
            if(!exists('emailUser',$email)){
                $greska[]="Ne postoji nalog sa tim emailom";
            }
            if(empty($greska)){
                $userObj = logovanje($email, $sLozinka);
                $_SESSION['user'] = $userObj;
                $SESSION['aktivan'] = $userObj ->aktivanUser;
                if($SESSION['aktivan']==1) {
                    $odgovor = ["user" => $userObj];
                    echo json_encode($odgovor);
                    http_response_code(201);
                }
                else{
                    $odgovor = ["Vas nalog je deaktiviran, kontaktirajte admina <a href='kontakt.php'> Kontakt  "];
                    echo json_encode($odgovor);
                    http_response_code(422);
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