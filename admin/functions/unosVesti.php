<?php
    if(isset($_POST['btnUploadVest'])){
        session_start();
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";
        try{
            // var_dump($_FILES['tdSlikaVest']["name"]);
            // die();
            $id = $_SESSION["user"]->idUser;
            $naslov = $_POST['tbNaslovVest'];
            $opis = $_POST['tbOpisVest'];
            $podkategorija = $_POST['ddlPodkategorija'];
            $imeFajla = $_FILES['tdSlikaVest']['name'];
            $tmpFajla = $_FILES['tdSlikaVest']['tmp_name'];
            $velicinaFajla = $_FILES['tdSlikaVest']['size'];
            $tipFajla = $_FILES['tdSlikaVest']['type'];
            $greskeFajla = $_FILES['tdSlikaVest']['error'];
            $allowedFileTypes = [ "image/png", "image/jpeg", "image/jpg", "image/gif"];
            $brojGresaka = 0;
            $regexNaslov = "/^([A-ZŽĐŠČĆ\"])+([A-z0-9ŽĐŠČĆžđščć_\-\.\s\!\?]){2,200}/";
            $regexOpis = "/^([A-ZŽĐŠČĆ\"])+([A-z0-9ŽĐŠČĆžđščć_\-\.\s\!\?]){2,/";
            if(empty($_FILES['tdSlikaVest']['name'])){
                $_SESSION['greska-upload'] ="Morate uploadovati sliku";
            }
            if(preg_match($regexNaslov,$naslov)){
                $_SESSION['naslov']=$naslov;
            }
            if(preg_match($regexOpis,$opis)){
                $_SESSION['opis']=$opis;
            }
            if(!preg_match($regexNaslov,$naslov)){ 
                $brojGresaka++;
                $_SESSION['greska-Naslov'] = "Greska u naslovu. Prvo slovo mora biti veliko, max 200 karaktera,razunajuci znakove i razmake";
            }
            if(!preg_match($regexOpis,$opis)){   
                $brojGresaka++;
                $_SESSION['greska-opis'] = "Greska u opisu.Može krenuti velikim slovom ili navodnikom.";
            }
           
            if($podkategorija==0){
                $brojGresaka++;
                $_SESSION['greska-podkat'] = "Morate izabrati podkategoriju";
            }
            
           // var_dump($id, $naslov,$opis,$podkategorija);
            if($greskeFajla==0){
                if(!in_array($tipFajla, $allowedFileTypes)){
                    $brojGresaka++;
                    $_SESSION['greska-tip'] ="Tip fajla mora biti jpg,jpeg, png ili gif !";
                }
                if($velicinaFajla > 5000000){
                    $brojGresaka++;
                    $_SESSION['greska-velicina'] = "Max velicina fajla je 5MB, upload manju.";
                }
                if($brojGresaka != 0){
                    var_dump($brojGresaka);
                    header("Location: ../upravljajVestima.php");
                }
                else{
                    $novoImeFajla = time()."_".$imeFajla;
                    $putanja = "../../uploads/".$novoImeFajla;
                    if(move_uploaded_file($tmpFajla, $putanja)){
                        $putanja2="uploads/".$novoImeFajla;
                         $upis = upisVestiUBazu($naslov,$opis,$putanja2,$podkategorija,$id);
                         if($upis){
                            unset($_SESSION['naslov']);
                            unset($_SESSION['opis']);
                            header("Location: ../upravljajVestima.php");
                        }
                     }
                }
                
        }
        else{      
            header("Location: ../upravljajVestima.php");
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