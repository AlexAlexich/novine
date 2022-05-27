<?php
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $vesti = vratiVestPoSvimKategoriji();
        
        //var_dump($vesti)
        
?>

        <div class="okvir">      
                <div class="newsSlider">
                        <img src="assets/img/naslovna.jpg" alt="" class="slider">
                </div>
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
                                                <a href="kategorija.php?id=<?= $vest->idKategorija?>"><?= $vest->nazivKategorija?></a>
                                                </div>
                                                <!--Ukoliko nisi admin ne vidis ovo-->
                                                <!--<div class="buttonBrisanje">
                                                       <a href="#" data-idpost="<?= $vest->idVest?>" class="brisanjeVest">Obriši</a></td>
                                                </div>-->
                                                <div class="datumBrKom">
                                                <p> <?=date('d. m. Y.', strtotime($vest->datum)) ?></p>
                                                <p><a href="vest.php?id=<?= $vest->idVest?>">Broj Komentara <?php 
                                                        $kom = vratiKomentareAktivne($vest->idVest);
                                                        
                                                        echo count($kom);
                                                        
                                                ?> </a> </p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <?php
                         endforeach;
                        ?>
                        <?php }
                                else{
                                echo "<h1 id='nemaVestiWarning'>Trenutno nema vesti </h1>";
                                }
                        ?>
                    </div>
                    <div class="sadrzajDesno">
                        <div>   
                                <h2>Sortitraj</h2>
                                <select  id="ddlSortPoPopularnosti">
                                        <option value="0"> Izaberite </option>
                                        <option value="1"> Po popularnosti rastuce</option>
                                        <option value="2"> Po popularnosti Opadajuce</option>
                                </select>
                        </div>
                    </div>
                </div>
        </div>
</div>       
<?php
        include("pages/footer.php");
?>