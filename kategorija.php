<?php
    if(!empty($_GET['id'])){
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $id = $_GET['id'];
        $podaciOKategoriji = vratiKategorijuPoId($id);
        $podaciOKategoriji = $podaciOKategoriji[0];
        $podkategorije = vratiPodkategorije($id);
        $vesti = vratiVestPoKategoriji($id);
     if(!empty($podaciOKategoriji)){ 

?>
<div class="podmeni">
        <div class="okvir"> 
                <div class="divMeni">
                        <ul>
                                
                                <?php
                                foreach($podkategorije as $p ):
                        ?>

                                <li> <a href="potkategorija.php?id=<?=$p->idPodkategorija?>"   > <?= $p->nazivPodkategorija ?> </a> </li>
                        <?php
                                endforeach;
                        ?>
                        </ul>
                </div> 
        </div>           
</div>       
        <div class="okvir">      
                
              
                <h1 class="nas">Vesti</h1>
                <div class="sadrzaj">
                    
                        <div class="sadrzajLevo">
                                <?php if(!empty($vesti)){
                                ?>
                                <?php 
                                        foreach($vesti as $vest):
                                ?>      
                                        <div class="vest">
                                                <div class="vestLevo">
                                                <a href="vest.php?id=<?= $vest->idVest?>">   <img src="<?= $vest->putanjaSlikeVest ?>" alt="slikaVest"> </a>
                                                </div>
                                                <div class="vestDesno">
                                                        <div class="vestNaslov">
                                                                <h1><a href="vest.php?id=<?= $vest->idVest?>"><?= $vest->naslov ?></a></h1>
                                                        </div>
                                                        <div class="vestInfo">
                                                                <div class="podkat">
                                                                <a href="kategorija.php?id=<?= $vest->idKategorija?>"><?= $vest->nazivPodkategorija?></a>
                                                                </div>
                                                                <!--Ukoliko nisi admin ne vidis ovo-->
                                                                <!--<div class="buttonBrisanje">
                                                                <a href="#" data-idpost="<?= $vest->idVest?>" class="brisanjeVest">Obriši</a></td>
                                                                </div>-->
                                                                <div class="datumBrKom">
                                                                <p> <?=date('d. m. Y.', strtotime($vest->datum)) ?></p>
                                                                <p><a href="vest.php?id=<?= $vest->idVest?>">Broj Komentara 
                                                                <?php 
                                                                        $kom = vratiKomentareAktivne($vest->idVest);
                                                                        
                                                                        echo count($kom);
                                                                        
                                                                ?> 
                                                        </a>
                                                                </p>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <?php
                                        endforeach;
                                        ?>
                                        <?php }
                                                else{
                                                echo "<h1 id='nemaVestiWarning'>Trenutno nema vesti iz odabrane kategorije</h1>";
                                                }
                                        ?> 
                        </div>
                        <div class="sadrzajDesno">
                               <div>
                                        <h2>Sortitraj</h2>
                                <select name="select" id="ddlSortPoPopularnosti2">
                                        <option value="0"> Izaberite </option>
                                        <option value="1" class="<?php echo $id?>"> Po popularnosti rastuce</option>
                                        <option value="2" class="<?php echo $id?>"> Po popularnosti Opadajuce</option>
                                </select>
                               </div> 
                               
                        </div>
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
