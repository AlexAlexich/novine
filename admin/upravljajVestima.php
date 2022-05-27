<?php   
        session_start();
        if(isset($_SESSION['user'])){
            if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $vesti = vratiVestiSve();
        $potkategorije = vratiSve('podkategorija');
        
?>

    <div class="okvir">
        <div class="sadrzaj">
            <div>
            <h2>Unesi vest</h2>
        <form action="functions/unosVesti.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Dodaj naslov</td>
                <td>
            <input type="text" name="tbNaslovVest" id="tbNaslovVest" value="<?php
                    if(isset($_SESSION['naslov'])){
                    echo $_SESSION['naslov'];
                    unset($_SESSION['naslov']);
                    }
                    else{
                        echo "";
                    }
                ?>"></td>
            </tr>
            <tr>
                <td>Dodaj opis</td>
                <td><textarea name="tbOpisVest" id="tbOpisVest" cols="30" rows="10" ><?php 
                    if(isset($_SESSION['opis'])){
                    echo $_SESSION['opis'];
                    unset($_SESSION['opis']);
                    }
                    else{
                        echo "";
                    }
                ?></textarea></td>
            </tr>
            <tr>
                <td>Dodaj sliku</td>
                <td><input type="file" name="tdSlikaVest" id="tdSlikaVest" ></td>
            </tr>
            <tr>
                <td>Podkategorija</td>
                <td>
                    <select name="ddlPodkategorija">
                        <option value="0"> Izaberite</option>
                        <?php
                            foreach($potkategorije as  $p ):
                        ?>
                        <option value="<?= $p->idPodkategorija ?>"><?= $p->nazivPodkategorija ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Unesite vest" class="btnUploadVest" name="btnUploadVest"></td>
            </tr>
        </table>
    </form>
    <div id="ispis">
                            <?php

                                if(isset($_SESSION['greska-Naslov'])){
                                echo "<p>".$_SESSION['greska-Naslov']."</p>";
                                unset($_SESSION['greska-Naslov']);
                                }
                                if(isset($_SESSION['greska-opis'])){
                                echo "<p>".$_SESSION['greska-opis']."</p>";
                                unset($_SESSION['greska-opis']);
                                }

                                if(isset($_SESSION['greska-podkat'])){
                                echo "<p>".$_SESSION['greska-podkat']."</p>";
                                unset($_SESSION['greska-podkat']);
                                }
                                if(isset($_SESSION['greska-tip'])){
                                    echo "<p>".$_SESSION['greska-tip']."</p>";
                                    unset($_SESSION['greska-tip']);
                                }

                                if(isset($_SESSION['greska-velicina'])){
                                    echo "<p>".$_SESSION['greska-velicina']."</p>";
                                    unset($_SESSION['greska-velicina']);
                                }
                              
                                 if(isset($_SESSION['greska-upload'])){
                                    echo "<p>".$_SESSION['greska-upload']."</p>";
                                    unset($_SESSION['greska-upload']);
                                 }
                                
                            ?>
                        </div>
    </div>
    <div>
        <h2>Sve vesti</h2>
    <table class="adminPanelTabela">
                <tr>
                    <td>Slika</td>
                    <td>id</td>
                    <td>Naslov</td>
                    <td>Datum</td>
                    <td>Ime podkategorije</td>
                    <td>User novinara</td>
                    <td>Aktivna</td>
                    <td>Aktivnost</td>
                    <td>Izmeni</td>
                </tr>
                <?php foreach($vesti as $v): 
                
                ?>
                <tr>
                    <td><img src="../<?= $v->putanjaSlikeVest  ?>" alt=""></td>
                    <td><?= $v->idVest ?></td>
                    <td><?= $v->naslov ?></td>
                    <td><?= $v->datum ?></td>
                    <td><?= $v->nazivPodkategorija ?></td>
                    <td><?= $v->username?></td>
                    <td><?= $v->vestAktivna==0 ? 'Neaktivna' : 'Aktivna' ?></td>
                    <?php
                    if($v->vestAktivna):
                    ?>
                       <td><a href="functions/deaktiviranjeVesti.php?id=<?= $v->idVest ?>">Deaktiviraj </a></td>
                    
                       <?php
                        else:
                        ?>    
                            <td><a href="functions/aktiviranjeVesti.php?id=<?= $v->idVest ?>">Aktiviraj</a></td>
                    <?php 
                        endif;
                     ?>
                    <td><a href="izmenaVesti.php?id=<?=$v->idVest ?>">Izmeni</a></td>
                </tr>
            <?php 
                endforeach;
            ?>
    </table>
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