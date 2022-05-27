<?php
    
    $kategorije=vratiSve("kategorija");
?>

<header>
    <div    id="gornji">
        <div class="okvir flex">
        <div id="slika">
            <img src="assets/img/icon.png" alt="Logo">
        </div>
        <div id="loginGore">

            <div id="goreDesno">
               
               <?php
                    if(isset($_SESSION['user'])):
                        if($_SESSION['user']->aktivanUser=='1'):
               ?>
                    <h2>Dobrodosli , <?=$_SESSION['user']->username ?></h2>
                    <h4><a href="anketa.php">Anketa</a></h4>
                    <h4><a href="functions/odjava.php">Odjavi se</a></h4>
                    <?php 
                        if(($_SESSION['user']->nazivUloga=='admin') || ($_SESSION['user']->nazivUloga=='novinar')):
                    ?>
                        <a href="admin/admin.php">Uredite sajt</a>
                    <?php 
                        endif;
                    ?>   
                    <?php 
                        else:
                    ?>     
                    <form>
                    <table>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="tbLoginEmail" id="tbLoginEmail"></td>
                            <td>Password</td>
                            <td><input type="password" name="tbLoginPassword" id="tbLoginPassword"></td>
                            <td><button type="submit" id="btnLogovanje">Ulogujte se</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="greskaEmailLog hide"> </p></td>
                            <td colspan="2"><p class="greskaPassLog hide"> </p></td>
                        </tr>
                       
                    </table>
                </form>
                <div>

                </div>
                <div class="odgovorLog">
                </div>
                <h4>Nemate nalog?<a href="register.php">Registrujte se</a></h1>
                    <?php
                       // unset($_SESSION['user']);
                        endif;
                    ?>   
               <?php else: 
               ?>
                <form>
                    <table>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="tbLoginEmail" id="tbLoginEmail"></td>
                            <td>Password</td>
                            <td><input type="password" name="tbLoginPassword" id="tbLoginPassword"></td>
                            <td><button type="submit" id="btnLogovanje">Ulogujte se</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="greskaEmailLog hide"> </p></td>
                            <td colspan="2"><p class="greskaPassLog hide"> </p></td>
                        </tr>
                       
                    </table>
                </form>
                <div>

                </div>
                <div class="odgovorLog">
                   
                </div>
                <h4>Nemate nalog?<a href="register.php">Registrujte se</a></h1>
            <?php
                endif;
            ?>
            
            </div>   
            <!-- Dodati ako je ulogovan da se vidi Dobrodosli, username-->
                <div class="cleaner"></div>
        </div>
        
    </div>
    
    </div>
    <div    id="donji">
        <div class="okvir">
            <div class="divMeni">
            <ul>
                <li><a href="index.php">Naslovna</a></li>
                <?php
                foreach($kategorije as $kat ):
            ?>

                <li> <a href="kategorija.php?id=<?= $kat->idKategorija?>"   > <?= $kat->nazivKategorija?> </a> </li>
            <?php
                endforeach;
            ?>
            </ul>
            </div> 
        </div>
    </div>
</header>