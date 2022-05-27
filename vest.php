<?php
    if(!empty($_GET['id'])){
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $id = $_GET['id'];
        $vest = vratiVest($id);
        $komentari = vratiKomentare($id);
        $komentariAktiv = vratiKomentareAktivne($id);
        
        if(!empty($vest)){
?>
<div class="okvir">
            <div id="vest">
                <!-- Treba dodati da ukoliko si admin mozes da menjas info kad udjes u vest-->
                <div id="gornjiDeo">    
                    <div id="slikaGornjiDeo">
                            <?php 
                                echo   "<img src='$vest->putanjaSlikeVest' alt='' class='slider'>";
                            ?>
                    </div>
                    <div id="naslovGornjiDeo">
                            <?php 
                                echo   "<h1> $vest->naslov </h1>";
                            ?>
                    </div>
                </div>
                <div id="donjiDeo">
                    <div  id="textDonjiDeo">
                            <?php 
                                echo   "<p> $vest->sadrzaj </p>";
                            ?>
                    </div>
                    <div id="novinarDiv">
                        <?php
                         echo  "<p> Napisao $vest->imeUser $vest->prezimeUser ".date('d. m. Y.', strtotime($vest->datum))."</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div id="komentari">
                <h1>Komentari</h1>
                <?php 
                    if(isset($_SESSION['user'])){
                     if($_SESSION['user']->aktivanUser=='1'){   
                ?>
                <form >
                    <label>Dodaj komentar</label>
                    <textarea  id="unosKomentara" cols="100" rows="5"></textarea>
                    <input type="hidden" id="idUsera" value="<?php echo $_SESSION['user']->idUser?>">
                    <input type="hidden" id="idVesti" value="<?php echo $id?>">
                    <button type="submit" id="btnDodajKomentar">Dodaj komentar</button>
                </form>
                <div class="greskaKomentar">

                </div>
                <?php 
                        }
                        else{
                         ?>
                         <h3>Morate se ulogovati da biste mogli da komentarisete</h3>
                  <form>
                    <table>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="tbLoginEmailKom" id="tbLoginEmailKom"></td>
                            <td>Password</td>
                            <td><input type="password" name="tbLoginPasswordKom" id="tbLoginPasswordKom"></td>
                            <td><button type="submit" id="btnLogovanjeKom">Ulogujte se</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="greskaEmailLogKom hide"> </p></td>
                            <td colspan="2"><p class="greskaPassLogKom hide"> </p></td>
                        </tr>
                       
                    </table>
                </form>
                
                <div class="odgovorLogKom">

                </div>
                <h4>Nemate nalog?<a href="register.php">Registrujte se</a></h1>      
                <?php
                    }
                ?>
                  <?php  }
                    else{
                  ?>
                  <h3>Morate se ulogovati da biste mogli da komentarisete</h3>
                  <form>
                    <table>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="tbLoginEmailKom" id="tbLoginEmailKom"></td>
                            <td>Password</td>
                            <td><input type="password" name="tbLoginPasswordKom" id="tbLoginPasswordKom"></td>
                            <td><button type="submit" id="btnLogovanjeKom">Ulogujte se</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="greskaEmailLogKom hide"> </p></td>
                            <td colspan="2"><p class="greskaPassLogKom hide"> </p></td>
                        </tr>
                       
                    </table>
                </form>
                
                <div class="odgovorLogKom">

                </div>
                <h4>Nemate nalog?<a href="register.php">Registrujte se</a></h1>      
                <?php
                    }
                ?>
                <div id="komentariSkup">
                <table>
                    <label for="">Komentari <?php echo count($komentariAktiv) ?></label>
                    <?php 
                    if(!empty($komentari)){
                    //var_dump($komentari);
                        foreach($komentari as $k):
                          if($k->aktivanKomentar == 1):
                    ?>
                    <tbody>
                    <tr>
                        <td><img src="<?=$k->putanjaSlikaUloga?>">
                        <?=$k->username ?>
                    </td>
                    <?php
                            if(isset($_SESSION['user'])):
                                if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')):
                    ?>
                        <td ><a href='admin/functions/deaktivirajKomentar.php?id=<?= $k->idKomentara ?>&idVesti=<?= $id?>'> Deaktiviraj komentar</a> </td>
                    <?php
                                endif;
                            endif;
                    ?>
                    </tr>
                    <tr>
                        <td>
                        <p>  Datum : <?=date('d. m. Y.', strtotime($k->datumKomentara))?> </p>
                        <td>
                    </tr>
                    
                    <tr>
                        <td colspan="100%"><?= $k->opis ?></td>
                    </tr>
                    </tbody>
                    <?php 
                        
                        else:
                            if(!isset($_SESSION['user']) || ($_SESSION['user']->nazivUloga=='korisnik')):
                                ?>
                                  
                                
                                <?php
                                endif;
                                if(isset($_SESSION['user'])):
                                    if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')):

                        ?>
                            <tbody>
                    <tr>
                        <td><img src="<?=$k->putanjaSlikaUloga?>">
                        <?=$k->username ?>
                    </td>
                    <?php
                                if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')):
                    ?>
                        <td ><a href='admin/functions/aktivirajKomentar.php?id=<?= $k->idKomentara ?>&idVesti=<?= $id?>'> Aktiviraj  komentar</a> </td>
                    <?php
                                endif;
                    ?>
                    </tr>
                    <tr>
                        <td>
                        <p>  Datum : <?=date('d. m. Y.', strtotime($k->datumKomentara))?> </p>
                        <td>
                    </tr>
                    
                    <tr>
                        <td colspan="100%"><?= $k->opis ?></td>
                    </tr>
                    </tbody>
                        <?php
                                    endif;
                                endif;
                        ?>
                        <?php
                         endif;
                        endforeach;
                    }
                    
                    else{
                        echo "<h3>Trenutno nema komentara za ovu vest</h3>";
                    }
                    ?> 
                </table>
                </div>

            </div>
</div>


<?php
        include("pages/footer.php");
    }
    else{
        header('location: index.php');
    }
} 
    else{
        header('location: index.php');
    }
?>
