<?php
        session_start();
if(isset($_SESSION['user'])){
        if($_SESSION['user']->nazivUloga=='admin'){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $korisnici = vratiKorisinke();
        $uloge = vratiSve('uloga');
        
?>

<div class="okvir">
<div class="sadrzaj">
    <div>
        <h2>Pretraga</h2>
                <input type="search" id="search" name="pretraga" placeholder="Pretraži po username-u...">
                
        </div>
    <div id="stampajKorisnike">
    
        <table class="adminPanelTabela">
                <tr>
                    <td>Slika</td>
                    <td>id</td>
                    <td>Ime</td>
                    <td>Prezime</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Aktivan</td>
                    <td>Datum</td>
                    <td>Uloga</td>
                    <td>Obrisi</td>
                    <td>Promeni ulogu</td>
                </tr>

            <?php foreach($korisnici as $k): 
                   
            ?>      
                <tr>
                    <td><img src="../<?= $k->putanjaSlikaUloga ?>" alt ='slikaKorisnik' /></td>
                    <td><?= $k->idUser ?></td>
                    <td><?= $k->imeUser ?></td>
                    <td><?= $k->prezimeUser ?></td>
                    <td><?= $k->username ?></td>
                    <td><?= $k->emailUser ?></td>
                    <td><?= $k->aktivanUser==0 ? 'Neaktivan' : 'Aktivan' ?></td>
                    <td><?= $k->datumRegistracije ?></td>
                    <td><?= $k->nazivUloga ?></td>
                    <?php
                    if($k->aktivanUser):
                    ?>
                       <td><a href="functions/deaktiviranjeKorisnika.php?id=<?= $k->idUser ?>">Deaktiviraj </a></td>
                    
                       <?php
                        else:
                        ?>    
                            <td><a href="functions/aktiviranjeKorisnika.php?id=<?= $k->idUser ?>">Aktiviraj</a></td>
                    <?php 
                        endif;
                     ?>
                    <td>
                        <select data-id="<?=$k->idUser?>"  class="ddlPromenaUloge" name ="promena">
                            <option value="0">Izaberite</option>
                            <?php
                                foreach($uloge as $u):
                            ?>
                                <option value="<?= $u->idUloga ?>"> <?= $u->nazivUloga?> </option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                    </td>
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