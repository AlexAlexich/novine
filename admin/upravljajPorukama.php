<?php   
        session_start();
        if(isset($_SESSION['user'])){
                if($_SESSION['user']->nazivUloga=='admin'){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $poruke = vratiPoruke();
        
?>

<!--Ako stignes ubaci da poruka ima kolonu procitana i da ako je procitana stoji procitana, a po defaultu da stoji da nije-->
    <div class="okvir">
        <div class="sadrzaj">
            <div id="poruke">
            <table>
                <tr>
                    <td>ID</td>
                    <td>Ime</td>
                    <td>Email</td>
                    <td>Poruka</td>
                    <td>Razlog</td>
                    <td>Datum</td>
                </tr>
                <?php 
                    foreach($poruke as $p):
                ?>
                    <tr>
                        <td><?=$p->idKontakt ?></td>
                        <td><?=$p->imeKontakt ?></td>
                        <td><?=$p->emailKontakt ?></td>
                        <td><?=$p->porukaKontakt ?></td>
                        <td><?=$p->imeRazlog ?></td>
                        <td><?=$p->datumKontakt ?></td>
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