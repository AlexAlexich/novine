<?php
    if(isset($_POST['btnAnketa'])){
        session_start();
        include "../connection/connection.php";
        include "functions.php";
        try{
            $potkategorija = $_POST['potkategorija']? $_POST['potkategorija']:false;
            // var_dump($potkategorija);
            // die();
            if($potkategorija!=false){
                
                $unos= unosGlasanja($potkategorija);
                    if($unos){
                    $_SESSION['hvala']= "Hvala vam na odgovoru!";
                    header("Location: ../anketa.php");
                    }
                
            }
            else{
                $_SESSION['greska-odabir']="Morate nesto izabrati";
                header("Location: ../anketa.php");
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