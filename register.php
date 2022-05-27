<?php
        session_start();
        if(empty($_SESSION['user'])){
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
?>
        <div class="okvir">
        <div id="Register">
            <form action="">
                <table>
                    <th>Registrujte se</th>
                    <tr>
                        <td>Ime</td>
                        <td><input type="text" name="tbIme" id="tbIme"></td>
                    </tr>
                    <tr><td><p class="greskaIme hide"> </p></td></tr>
                    <tr>
                        <td>Prezime</td>
                        <td><input type="text" name="tbPrezme" id="tbPrezime"></td>
                    </tr>
                    <tr><td><p class="greskaPrezime hide"> </p></td></tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="tbUsername" id="tbUsername"></td>
                    </tr>
                    <tr><td><p class="greskaUsername hide"> </p></td></tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="tbEmail" id="tbEmail"></td>
                    </tr>
                    <tr><td><p class="greskaEmail hide"> </p></td></tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="tbPassword" id="tbPassword"></td>
                    </tr>
                    <tr><td><p class="greskaPass hide"> </p></td></tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="tbCPassword" id="tbCPassword"></td>
                    </tr>
                    <tr><td><p class="greskaCPass hide"> </p></td></tr>
                    <tr>
                        <td>Ukoliko se registrujete slazete se sa <a href="uslovi.php" target="_blank" >uslovima koriscenja</a></td>
                        <td><button type="submit" id="register">Registrujte se</button></td>
                    </tr>
                    
                </table>
            </form>
            <div class="odgovor">

            </div>
    
        </div>
        </div> 
<?php
        include("pages/footer.php");
        }
        else{
            header('Location: index.php');
        }
?>