<?php
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $potkategorije = vratiSve('podkategorija');
        
        
?>
<div class="okvir">                 
        <div class="sadrzaj">
                    
                   <form id="anketa" action="functions/obradaAnkete.php" method="post">
                       <table>
                       <label for="">Koja sekcija vas najvise interesuje</label>
                        <?php 
                            foreach($potkategorije as $p):
                        ?>
                           <tr><td> <input type="radio" name="potkategorija" value="<?= $p->idPodkategorija?>" ><?=$p->nazivPodkategorija?></td></tr>
                        <?php
                            endforeach;
                        ?>
                        <tr><td><input type="submit" value="Odgovori" name="btnAnketa"></td></tr>
                        </table>
                        <?php
                                    if(isset($_SESSION['greska-odabir'])){
                                    echo "<h2>".$_SESSION['greska-odabir']."</h2";
                                    unset($_SESSION['greska-odabir']);
                                    }
                                    if(isset($_SESSION['hvala'])){
                                        echo "<h2>".$_SESSION['hvala']."</h2";
                                        unset($_SESSION['hvala']);
                                        }
                        ?>
                   </form>
                               
            
        </div>
</div>       
<?php
        include("pages/footer.php");
?>