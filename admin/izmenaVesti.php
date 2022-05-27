<?php   
    if(!empty($_GET['id'])){
        session_start();
        if(isset($_SESSION['user'])){
            if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $id = $_GET['id'];
        $vest = vratiVest($id);
        $komentari = vratiKomentare($id);
        $komentariAktiv = vratiKomentareAktivne($id);
        
?>
<div class="okvir">
    <div class="sadrzaj">
    <div id="vest">
        <form action="functions/izmenaVesti.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="idVesti" value="<?php echo $id?>"> 
                <div id="gornjiDeo">    
                    <div id="slikaGornjiDeo">
                        <img src="../<?php echo $vest->putanjaSlikeVest  ?>" alt="slikaVesti" >
                        <input type="hidden" name="slikaTrenutno" value="<?php echo $vest->putanjaSlikeVest ?>"> 
                            <?php 
                                echo  "<h1> Promeni sliku</h1>";
                                echo   "<input type='file' name='tdSlikaVestIzmena' >";
                            ?>
                    </div>
                    <div id="naslovGornjiDeo">
                            <?php 
                                echo  "<h1> Promeni naslov</h1>";
                                if(isset($_SESSION['naslovIzmena'])){
                                     echo   " <input type='text' name='tbNaslovVestIzmena' value='".$_SESSION['naslovIzmena']."' /> ";
                                    }
                                 else{
                                    echo   " <input type='text' name='tbNaslovVestIzmena' value='$vest->naslov' /> ";
                                 }   
                                ?>
                                
                            
                    </div>
                </div>
                <div id="donjiDeo">
                    <div  id="textDonjiDeo">
                            <?php
                                echo "<h2>Promeni opis </h2>";
                            if(isset($_SESSION['opis'])){
                                echo "<textarea name='tbOpisVestIzmena' id='' cols='100' rows='10'>".$_SESSION['opisIzmena']."</textarea>";
                                }
                             else{
                                echo "<textarea name='tbOpisVestIzmena' id='' cols='100' rows='10'>$vest->sadrzaj</textarea>";
                             }   
                            ?>
                    </div>
                    <div id="novinarDiv">
                        <?php
                         echo  "<p> Napisao $vest->imeUser $vest->prezimeUser ".date('d. m. Y.', strtotime($vest->datum))."</p>";
                        ?>
                    </div>
                </div>
                <td><input type="submit" value="Izmenite vest" class="btnUploadVest" name="btnIzmenaVesti"></td>
                </form>
                <div id="ispis">
                            <?php

                                if(isset($_SESSION['greska-NaslovIzmena'])){
                                echo "<p>".$_SESSION['greska-NaslovIzmena']."</p>";
                                unset($_SESSION['greska-NaslovIzmena']);
                                }
                                if(isset($_SESSION['greska-opisIzmena'])){
                                echo "<p>".$_SESSION['greska-opisIzmena']."</p>";
                                unset($_SESSION['greska-opisIzmena']);
                                }

                                
                                if(isset($_SESSION['greska-tipIzmena'])){
                                    echo "<p>".$_SESSION['greska-tipIzmena']."</p>";
                                    unset($_SESSION['greska-tipIzmena']);
                                }

                                if(isset($_SESSION['greska-velicinaIzmena'])){
                                    echo "<p>".$_SESSION['greska-velicinaIzmena']."</p>";
                                    unset($_SESSION['greska-velicinaIzmena']);
                                }
                                
                            ?>
                </div>      
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
}
else{
    header('location: upravljajVestima.php');
}
?>