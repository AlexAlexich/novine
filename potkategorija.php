<?php    
    session_start();
    if(!empty($_GET['id'])){
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $id = $_GET['id'];
        $podk=vratiPodkategorijuPodId($id);
        $podk=$podk[0];
        $vesti=vratiVestiPoPodkategoriji($id);

?>

<div class="okvir">
    <div class="sadrzaj">
        <div class="nas">
        <h1> <?php echo $podk->nazivPodkategorija ?>  vesti :</h1>
        </div>
        <?php
            if(empty($vesti)):
        ?>
            <div class="sadrzajLevo">
            <h3>Nema vesti </h3>
            </div>
        <?php 
            else:
        ?>
            <div class="sadrzajLevo">
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
            </div>
        <?php
            endif;
        ?>
    </div>
</div>
<?php
        include("pages/footer.php");
    }
    else{
        header('location: index.php');
    }  
?>