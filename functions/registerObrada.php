<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection/connection.php";
        include "functions.php";

        try{
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $lozinka = $_POST['sifra'];
            
            
            $regexImePrezime = "/^[A-Z][a-z]{2,30}/";
            $regexLozinka ="/^([A-Z])+([A-Za-z0-9]{7,30})$/";
            $regexUsername = "/^[A-Za-z][A-Za-z0-9]{2,30}/";
            $greska=[];
            if(!preg_match($regexImePrezime,$ime)){   
                $greska[]="Ime nije u dobroj formi, primer : 'Aleksandar '";
            }
            if(!preg_match($regexImePrezime,$prezime)){
                
                $greska[] = "Prezime nije u dobro formi, primer : 'Aleksic'";
            }
            if(!preg_match($regexLozinka,$lozinka)){
                $greska[] = "Sifra nije u dobroj formi, mora poceti velikim slovom,moze sadrzati mala i velika slova i brojeve. Minimum 8 karaktera";
            }
            if(!preg_match($regexUsername,$username)){
                $greska[] = "Username nije u dobroj formi. Moguce je koristit mala i velika slova i brojeve. Minimum 3 karaktera";
            }
            if(exists('username',$username)){
                $greska[] = "Username je zauzet";
            }
            if(!filter_var($email,FILTER_SANITIZE_EMAIL)){
                $greska[]="Email nije validan";
            }
            if(exists('emailUser',$email)){
                $greska[]="Email vec postoji";
            }
            if(empty($greska)){
                $sifrovanaLozinka = md5($lozinka);
            
                
                $unosKorisnika = unosKorisnika($ime,$prezime,$username, $email, $sifrovanaLozinka);
                if($unosKorisnika){
                    $odgovor = ["poruka"=>"Uspesno ste se registrovali, sada se mozete logovati."];
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