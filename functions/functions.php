<?php 
//mogla je biti jedna fja za neke delove, ali sam kasno video
function vratiSve($nazivTabele){
    try{
            global $conn;
            $upit = "SELECT * FROM $nazivTabele";
            $podaci = $conn->query($upit)->fetchAll();
            return $podaci;
    }
    catch(PDOException $ex){
        return $ex;
    }   
}
function vratiPodkategorije($id){
    try{   global $conn;
            $upit = "SELECT * FROM podkategorija p INNER JOIN kategorija k WHERE p.idKategorija = k.idKategorija AND k.idKategorija = ?";
            $select = $conn->prepare($upit);
            $select->execute([$id]);
            $podaci = $select->fetchAll();
            return $podaci;
        }
        catch(PDOException $ex){
            return $ex;
        }
}
function vratiPodkategorijuPodId($id){
    try{   global $conn;
        $upit = "SELECT * FROM podkategorija WHERE idPodKategorija = ? ";
        $select = $conn->prepare($upit);
        $select->execute([$id]);
        $podaci = $select->fetchAll();
        return $podaci;
        }
        catch(PDOException $ex){
            return $ex;
        }
}
function vratiKategorijuPoId($id){
         try{   global $conn;
            $upit = "SELECT * FROM kategorija WHERE idKategorija = ? ";
            $select = $conn->prepare($upit);
            $select->execute([$id]);
            $podaci = $select->fetchAll();
            return $podaci;
            }
            catch(PDOException $ex){
                return $ex;
            }
}

function vratiVestPoSvimKategoriji(){
        try{
        global $conn;
        $upit = "SELECT * FROM vest v 
        INNER JOIN podkategorija p
         ON v.idPodkategorije = p.idPodkategorija
        INNER JOIN kategorija k 
        ON p.idKategorija = k.idKategorija
        WHERE vestAktivna = 1
        ORDER BY v.datum DESC" ;
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;   
        }
        catch(PDOException $ex){
            return $ex;
        } 
}
function vratiVestPoKategoriji($id){
    try{
    global $conn;
    $upit = "SELECT * FROM vest v 
    INNER JOIN podkategorija p
     ON v.idPodkategorije = p.idPodkategorija
    INNER JOIN kategorija k 
    ON p.idKategorija = k.idKategorija
    WHERE p.idKategorija = ? AND vestAktivna = 1
    ORDER BY v.datum DESC" ;
    $select = $conn->prepare($upit);
    $select->execute([$id]);
    $podaci = $select->fetchAll();
    return $podaci;
    }
    catch(PDOException $ex){
        return $ex;
    }

}
function vratiVestiPoPodkategoriji($id){
    try{
        global $conn;
        $upit = "SELECT * FROM vest v 
        INNER JOIN podkategorija p
         ON v.idPodkategorije = p.idPodkategorija
        WHERE p.idPodkategorija = ? AND vestAktivna = 1
        ORDER BY v.datum DESC" ;
        $select = $conn->prepare($upit);
        $select->execute([$id]);
        $podaci = $select->fetchAll();
        return $podaci;
        }
        catch(PDOException $ex){
            return $ex;
        }
}
function vratiVestiSve(){
   try{
    global $conn;
    $upit = "SELECT * FROM vest v INNER JOIN podkategorija p
     ON v.idPodkategorije = p.idPodkategorija INNER JOIN user u
     ON v.idUser = u.idUser ORDER BY v.datum DESC";
     $podaci = $conn->query($upit)->fetchAll();
    return $podaci;
    }   
    catch(PDOException $ex){
        return $ex;
    }   
}
function vratiVest($id){
    try{
    global $conn;
    $upit= "SELECT * FROM vest v INNER JOIN user u 
    ON v.idUser = u.idUser  
    WHERE v.idVest= ? AND vestAktivna = 1" ;
    $select = $conn->prepare($upit);
    $select->execute([$id]);
    $podaci = $select->fetch();
    return $podaci;
    }
    catch(PDOException $ex){
        return $ex;
    }
}
function vratiVestiPoKomentarima($smer){
    try{
        global $conn;
        $query = "SELECT *, (SELECT COUNT(*) FROM komentar WHERE idVest = v.idVest AND aktivanKomentar = 1) komentari
                    FROM vest v INNER JOIN podkategorija p ON v.idPodkategorije = p.idPodkategorija 
                    INNER JOIN kategorija k ON p.idKategorija = k.idKategorija
                    WHERE v.vestAktivna = 1
                    ORDER BY komentari ".$smer;
        
        $podaci = $conn->query($query)->fetchAll();
        return $podaci;
        }
        catch(PDOException $ex){
            return $ex;
        } 
}
function vratiVestPoKomentarimaIPodkategoriji($smer,$id){
    try{
        global $conn;
            $upit = "SELECT *, (SELECT COUNT(*) FROM komentar WHERE idVest = v.idVest AND aktivanKomentar = 1) komentari
            FROM vest v INNER JOIN podkategorija p ON v.idPodkategorije = p.idPodkategorija 
            INNER JOIN kategorija k ON p.idKategorija = k.idKategorija
            WHERE p.idKategorija = ? AND v.vestAktivna = 1
            ORDER BY komentari ".$smer; 
            $select = $conn->prepare($upit);
            $select->execute([$id]);
            $podaci = $select->fetchAll();
            return $podaci;
    }
    catch(PDOException $ex){

    }
}

function vratiKomentare($id){
    try{
        global $conn;
        $upit = "SELECT * FROM komentar k INNER JOIN vest v
        ON k.idVest = v.idVest INNER JOIN user u
        ON k.idUser = u.idUser INNER JOIN uloga ul
        ON u.idUloga = ul.idUloga
        WHERE k.idVest = ?
        ORDER BY k.datumKomentara DESC";
        $select = $conn->prepare($upit);
        $select->execute([$id]);
        $podaci = $select->fetchAll();
        return $podaci;

    }
    catch(PDOException $ex){
        return $ex;
    }
}
function vratiKomentareAktivne($id){
    try{
        global $conn;
        $upit = "SELECT * FROM komentar k INNER JOIN vest v
        ON k.idVest = v.idVest INNER JOIN user u
        ON k.idUser = u.idUser INNER JOIN uloga ul
        ON u.idUloga = ul.idUloga
        WHERE k.idVest = ? AND k.aktivanKomentar = 1
        ORDER BY k.datumKomentara DESC";
        $select = $conn->prepare($upit);
        $select->execute([$id]);
        $podaci = $select->fetchAll();
        return $podaci;

    }
    catch(PDOException $ex){
        return $ex;
    }
}
function vratiKorisinke(){
    try{
        global $conn;
        $upit = "SELECT * FROM user u
        JOIN uloga ul
         ON u.idUloga = ul.idUloga
         ORDER BY u.idUser ASC" ;
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    catch(PDOException $ex){
        return $ex;
    }
}
function vratiPoruke(){
    try{
        global $conn;
        $upit = "SELECT * FROM kontakt k JOIN razlog r 
        ON k.idRazlog = r.idRazlog
        ORDER BY k.datumKontakt DESC";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
}
    catch(PDOException $ex){
    return $ex;
}   
}

//Registracija i unos u bazu
function unosKorisnika($ime,$prezime,$username, $email, $sifrovanaLozinka){
        try{
            global $conn;
            $upit = "INSERT INTO user (imeUser, prezimeUser, username, emailUser, passwordUser) VALUES (:ime,:prezime,:username,:email,:lozinka)";
            $insert = $conn->prepare($upit);
            $insert->bindParam(":ime", $ime);
            $insert->bindParam(":prezime", $prezime);
            $insert->bindParam(":username", $username);
            $insert->bindParam(":email", $email);
            $insert->bindParam(":lozinka", $sifrovanaLozinka);
            $rezultat = $insert->execute();
            return $rezultat;
    }
        catch(PDOException $ex){
            return $ex;
        }
}
function exists($kolona,$param){
    try{
    global $conn;
    $upit = "SELECT idUser FROM user WHERE $kolona = ?";
    $podaci = $conn->prepare($upit);
    $podaci->execute([$param]);
    $rezulat = $podaci->fetch();

    return $rezulat;
    }
    catch(PDOException $ex){
    return $ex;
    }
}
function logovanje($email, $password){
    try{
        global $conn;
        $upit = "SELECT * FROM user u JOIN uloga ul ON u.idUloga = ul.idUloga 
        WHERE u.emailUser = :email AND u.passwordUser = :lozinka";
        $sel = $conn->prepare($upit);
        $sel->bindParam(":email", $email);
        $sel->bindParam(":lozinka", $password);
        $sel->execute();
        $rez = $sel->fetch();
        return $rez ;
    }
    catch(PDOException $ex){
        return $ex;
    }
}
function unosKontakta($ime,$email,$razlog,$poruka){
   try{
        global $conn;
        $upit= "INSERT INTO kontakt (imeKontakt,emailKontakt,porukaKontakt,idRazlog) VALUES (:ime,:email,:poruka,:id)";
        $insert = $conn->prepare($upit);
        $insert->bindParam(":ime", $ime);
        $insert->bindParam(":email", $email);
        $insert->bindParam(":poruka", $poruka);
        $insert->bindParam(":id", $razlog);
        $rezultat = $insert->execute();
        return $rezultat;
    }
   catch(PDOException $ex){
       return $ex;
   }

}
//moglo je sve u exists pa da se prosledjuje i tabela ali nisam imao vreman da prepravljam 
function existsVest($kolona,$param){
    try{
        global $conn;
        $upit = "SELECT idVest FROM vest WHERE $kolona = ?";
        $podaci = $conn->prepare($upit);
        $podaci->execute([$param]);
        $rezulat = $podaci->fetch();
    
        return $rezulat;
        }
        catch(PDOException $ex){
        return $ex;
        }
}

function unosKomentara($komentar,$idUser,$idVest){
    try{
        global $conn;
        $upit= "INSERT INTO komentar (opis,idUser,idVest) VALUES (:kom,:idUser,:idVest)";
        $insert = $conn->prepare($upit);
        $insert->bindParam(":kom", $komentar);
        $insert->bindParam(":idUser", $idUser);
        $insert->bindParam(":idVest", $idVest);
        $rezultat = $insert->execute();
        return $rezultat;
    }
   catch(PDOException $ex){
       return $ex;
   }
}
function unosGlasanja($rezultat){
    try{
        global $conn;
        $upit= "INSERT INTO anketa (idPodkategorija) VALUES (:rezultat)";
        $insert = $conn->prepare($upit);
        $insert->bindParam(":rezultat", $rezultat);
        $rezultat = $insert->execute();
        return $rezultat;
    }
   catch(PDOException $ex){
       return $ex;
   }
}