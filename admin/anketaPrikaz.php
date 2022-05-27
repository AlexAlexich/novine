<?php   
        session_start();
        if(isset($_SESSION['user'])){
                if($_SESSION['user']->nazivUloga=='admin'){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $pod=vratiSve('podkategorija');
       // var_dump(vratiAnketu(2))
       
       
       $sum = (int) get_object_vars(vratiBrojGlasova())["COUNT(idGlasanja)"];
       $oneOfHundred = $sum / 100;
       //var_dump($sum);
?>
<div class="okvir">
       <div class="sadrzaj">
           <div id="anketaIspis">
                    <table>
                        
                            <?php
                                foreach($pod as $p):
                            ?>
                            <tr>
                                <td><?= $p->nazivPodkategorija?> </td>
                                <td>Glasovi: <?= get_object_vars(vratiAnketu($p->idPodkategorija))["COUNT(idGlasanja)"]; ?></td>
                                <td>Procenat: <?= round(get_object_vars(vratiAnketu($p->idPodkategorija))["COUNT(idGlasanja)"]/$oneOfHundred,1)?> %</td>
                            </tr>
                            <?php
                                endforeach
                            ?>
                        </tr>
                        
                            
                        </tr>
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