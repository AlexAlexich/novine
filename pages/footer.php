        <footer>
    <div class="okvir">
            <div id="dolePrvo">
            

            <div id="navigacija">
                <h2>Expres vesti</h2>
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

            <div id="socials">
                <h2>Linkovi</h2>
                    <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="kontakt.php">Kontakt</a></li>
                    <li><a href="anketa.php">Anketa</a></li>
                    <li><a href="autor.php">Autor</a>
                    </ul>
            </div>
            </div>
            <div id="dole">
                <p>&copy; Done as PHP 1 project</p>
                <a href="dokumentacija.pdf">Dokumentacija</a>
            </div>
            
    </div>
        </footer>
        
        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->
      
        <!-- Template JS -->
        <script src="assets/js/main.js"></script>
    </body>
</html>