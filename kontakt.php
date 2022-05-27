<?php
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $razlozi= vratiSve('razlog')
?>      
<div class="okvir">
    <div class="sadrzaj">
        <form action="">
            <table>
                <tr>
                 <td> Ime  </td>
                   <td> <input type="text"  id="imeKontakt"></td>
                </tr>
                <tr>
                    <td>
                        <p class="greskaImeKontakt"></p>
                    </td>
                </tr>
                <tr>
                    <td> Email </td>
                    <td><input type="text" name="" id="emailKontakt"></td>
                </tr>
                <tr>
                    <td>
                        <p class="greskaEmailKontakt"></p>
                    </td>
                </tr>
                <tr>
                    <td> Razlog  </td>
                    <td>
                    <select id="ddlRazlog"> 
                        <option value="0">Izaberite</option>
                        <?php
                            foreach($razlozi as $razlog):
                        ?>
                            <option value="<?= $razlog->idRazlog?>"> <?= $razlog->imeRazlog ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="greskaSelect"></p>
                    </td>
                </tr>
                <tr>
                    <td>    Poruka  </td>
                   <td> <textarea name="" id="porukaKontakt" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td>
                        <p class="greskaPorukaKontakt"></p>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" id="btnPosaljiPoruku">Posalji poruku</button></td>
                </tr>
               
            </table>

        </form>
        <div class="odgovor">

        </div>
    </div>
</div>        
<?php
        include("pages/footer.php");
?>