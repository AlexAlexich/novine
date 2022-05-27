<?php
        session_start();
        
 if(isset($_SESSION['user'])){
    if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')){
  
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        
    ?>
        <div class="okvir">
            <div class="sadrzaj">
                <div id="adminPanel">
                    <ul> 
                        <li><a href="upravljajVestima.php">Upravljaj vestima</a></li>
                        <?php 
                        if($_SESSION['user']->nazivUloga=='admin'):
                        ?>
                            <li><a href="upravljajKorisnicima.php">Upravljaj korisnicima</a></li>
                            <li><a href="upravljajPodkategorijama.php">Upravljaj podkategorijama</a></li>
                            <li><a href="upravljajPorukama.php">Pogledaj poruke</a></li>
                            <li><a href="anketaPrikaz.php">Vidi anketu</a></li>
                        <?php 
                            endif;
                          
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php
            include("pages/adminfooter.php");
            }
            else{
                http_response_code(404);
            }
        }
else{
        http_response_code(404);
    }
?>