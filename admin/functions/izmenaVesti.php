<?php
    if(isset($_POST['btnIzmenaVesti'])){
        session_start();
        include "../../connection/connection.php";
        include "../../functions/functions.php";
        include "functions.php";
        try{
            // var_dump($_FILES['tdSlikaVest']["name"]);
            // die();
            $idVesti = $_POST['idVesti'];
            $naslov = $_POST['tbNaslovVestIzmena'];
            $opis = $_POST['tbOpisVestIzmena'];
            $slikaTrenutno =$_POST['slikaTrenutno'];
            $imeFajla = $_FILES['tdSlikaVestIzmena']['name'];
            $tmpFajla = $_FILES['tdSlikaVestIzmena']['tmp_name'];
            $velicinaFajla = $_FILES['tdSlikaVestIzmena']['size'];
            $tipFajla = $_FILES['tdSlikaVestIzmena']['type'];
            $greskeFajla = $_FILES['tdSlikaVestIzmena']['error'];
            $allowedFileTypes = [ "image/png", "image/jpeg", "image/jpg", "image/gif"];
            $brojGresaka = 0;
            $regexNaslov = "/^([A-ZŽĐŠČĆ\"])+([A-z0-9ŽĐŠČĆžđščć_\-\.\s\!\?]){2,200}/";
            $regexOpis = "/^([A-ZŽĐŠČĆ\"])+([A-z0-9ŽĐŠČĆžđščć_\-\.\s\!\?]){2,}/";

            // var_dump($idVesti,$naslov,$opis,$slikaTrenutno);
            // die();
            if(empty($_FILES['tdSlikaVestIzmena']['name'])){
                if(preg_match($regexNaslov,$naslov)){
                    $_SESSION['naslovIzmena']=$naslov;
                }
                if(preg_match($regexOpis,$opis)){
                    $_SESSION['opisIzmena']=$opis;
                }
                if(!preg_match($regexNaslov,$naslov)){ 
                    $brojGresaka++;
                    $_SESSION['greska-NaslovIzmena'] = "Greska u naslovu. Prvo slovo mora biti veliko, max 200 karaktera,razunajuci znakove i razmake";
                }
                if(!preg_match($regexOpis,$opis)){   
                    $brojGresaka++;
                    $_SESSION['greska-opisIzmena'] = "Greska u opisu.Može krenuti velikim slovom ili navodnikom";
                }
            
                if($brojGresaka != 0){
                   // var_dump($brojGresaka);
                    header("Location: ../izmenaVesti.php?id=".$idVesti."");
                }
                else{   
                    
                        $upis = izmenaVesti($idVesti,$naslov,$opis,$slikaTrenutno);
                   
                         if($upis){
                            unset($_SESSION['naslovIzmena']);
                            unset($_SESSION['opisIzmena']);
                            header("Location: ../izmenaVesti.php?id=".$idVesti."");
                        }
                     
                }
                
            
            }
            else{
                    if(preg_match($regexNaslov,$naslov)){
                        $_SESSION['naslovIzmena']=$naslov;
                    }
                    if(preg_match($regexOpis,$opis)){
                        $_SESSION['opisIzmena']=$opis;
                    }
                    if(!preg_match($regexNaslov,$naslov)){ 
                        $brojGresaka++;
                        $_SESSION['greska-naslovIzmena'] = "Greska u naslovu. Prvo slovo mora biti veliko, max 200 karaktera,razunajuci znakove i razmake";
                    }
                    if(!preg_match($regexOpis,$opis)){   
                        $brojGresaka++;
                        $_SESSION['greska-opisIzmena'] = "Greska u opisu.Može krenuti velikim slovom ili navodnikom.";
                    }
                    if($greskeFajla==0){
                        if(!in_array($tipFajla, $allowedFileTypes)){
                            $brojGresaka++;
                            $_SESSION['greska-tipIzmena'] ="Tip fajla mora biti jpg,jpeg, png ili gif !";
                        }
                        if($velicinaFajla > 5000000){
                            $brojGresaka++;
                            $_SESSION['greska-velicinaIzmena'] = "Max velicina fajla je 5MB, upload manju.";
                        }
                        if($brojGresaka != 0){
                            //var_dump($brojGresaka);
                            header("Location: ../izmenaVesti.php?id=".$idVesti."");
                        }
                        else{
                            $novoImeFajla = time()."_".$imeFajla;
                            $putanja = "../../uploads/".$novoImeFajla;
                            
                           if(move_uploaded_file($tmpFajla, $putanja)){
                                $putanja2="uploads/".$novoImeFajla;
                                $upis = izmenaVesti($idVesti,$naslov,$opis,$putanja2);
                                if($upis){
                                    unset($_SESSION['naslovIzmena']);
                                    unset($_SESSION['opisIzmena']);
                                    header("Location: ../izmenaVesti.php?id=".$idVesti."");
                                }
                            }
                        }
                    
                      }
                    else{      
                            header("Location: ../izmenaVesti.php?id=".$idVesti."");
                        }
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