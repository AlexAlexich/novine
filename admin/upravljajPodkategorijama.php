<?php   
        session_start();
        if(isset($_SESSION['user'])){
                if($_SESSION['user']->nazivUloga=='admin'){
        //ako si admin mozes da pristpus ovom, ako nisi ne mozes, plus ne vidis link ka ovoj strani
        include("../connection/connection.php");
        include("../functions/functions.php");
        include("pages/adminhead.php");
        include("pages/adminheader.php");
        $kat= vratiSve('kategorija');
        
?>

<!--Ako stignes ubaci da podkategorija moze biti aktivna i neaktivna, kao sto ima za vesti i za komentare-->
<div class="okvir">
        <div class="sadrzaj">
             <form>
                     <table>
                             <tr>      <td>Ime potkategorije</td>
                                     <td><input type="text" name="tbImePotkategorije" id="tbImePotkategorije"></td>
                             </tr>
                            <tr>
                                    <td class="greskaIme"></td>
                            </tr>
                            <tr>
                                    <td>Kategorija kojoj pripada</td>
                                    <td> <select name="" id="ddlKategorija">
                                                <option value="0">Izaberite</option>
                                                <?php
                                                        foreach($kat as $k):
                                                ?>
                                                        <option value="<?= $k->idKategorija?>"> <?= $k->nazivKategorija?> </option>
                                                <?php
                                                        endforeach;
                                                ?>
                                        </select></td>
                            </tr>
                            <tr>
                                    <td class="greskaKategorija"></td>
                            </tr>
                            <tr>
                                 <td>
                                         <button type="submit" id="btnUnesipotkategoriju">Dodaj</button>
                                 </td>
                            </tr>
                    
                     </table>
             </form>
             <div class="odgovorPod">

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