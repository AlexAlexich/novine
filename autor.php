<?php
        session_start();
        include("connection/connection.php");
        include("functions/functions.php");
        include("pages/head.php");
        include("pages/header.php");
        $potkategorije = vratiSve('podkategorija');
        
        
?>
<div class="okvir">                 
        <div class="sadrzaj">
                   <div id="slikaAutor">
                       <img src="assets/img/autor.jpg" alt="autor">
                   </div>
                    <div id="tekstAutor">
                        <h2>Zdravo, moje ime je Aleksandar</h2>
</br>
                        <h3>Poreklom sam iz Loznice, ali trenutno studiram u Beogradu. Zavrsio sam "Gimnaziju Vuk Karadzic" u Loznici, a trenutno sam zavrsna godina na Visokoj ICT Skoli smer Internet Tehnologije, modul Informacione Tehnologije. Ukoliko zelite da me kontaktirate posaljite mejl na alexbusiness1705@gmail.com .</h3>
                    </div>
        </div>
</div>       
<?php
        include("pages/footer.php");
?>