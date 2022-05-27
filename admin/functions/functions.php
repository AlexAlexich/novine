<?php
function promenaUloge($idUloge,$idKor){
   try{ 
        global $conn ;
        $upit = "UPDATE user SET idUloga = :uloga WHERE idUser = :korisnik";
        $deact = $conn->prepare($upit);
        $deact->bindParam(":uloga", $idUloge);
        $deact->bindParam(":korisnik", $idKor);
        $result = $deact->execute();

        return $result;
    }   
    catch(PDOException $ex){
        return $ex;
    }

}
function unosPodkategorije($ime,$id){
    try{
        global $conn;
        $upit = "INSERT INTO podkategorija (nazivPodkategorija, idKategorija) VALUES (:ime,:id)";
        $insert = $conn->prepare($upit);
        $insert->bindParam(":ime", $ime);
        $insert->bindParam(":id", $id);
        $rezultat = $insert->execute();
        return $rezultat;
}
    catch(PDOException $ex){
        return $ex;
    }
}
function existsPodkat($nazivPodkategorija){
    try{
    global $conn;
    $upit = "SELECT idPodkategorija FROM podkategorija WHERE nazivPodkategorija = ?";
    $podaci = $conn->prepare($upit);
    $podaci->execute([$nazivPodkategorija]);
    $rezulat = $podaci->fetch();

    return $rezulat;
    }
    catch(PDOException $ex){
    return $ex;
    }
}
//aktiviranje /deaktivirianje

function aktivacija2($nazivTabele,$tabela,$id,$idPoredjenja,$aktivan=0){
    try{
        global $conn;

        $upit = "UPDATE $nazivTabele SET $tabela = :aktivan WHERE $idPoredjenja = :id";
        $deact = $conn->prepare($upit);
        $deact->bindParam(":aktivan", $aktivan);
        $deact->bindParam(":id", $id);
        $result = $deact->execute();

        return $result;
    }
    catch(PDOException $ex){
        return $ex;
    }
}

function search($search){
   try{
    global $conn;
    $upit = "SELECT * FROM user u
    JOIN uloga ul
     ON u.idUloga = ul.idUloga 
     WHERE LOWER(username) LIKE ?
     ORDER BY u.idUser ASC";
    $select = $conn->prepare($upit);
    $select->execute([$search]);
    $podaci = $select->fetchAll();
    return $podaci;
   }
   catch(PDOException $ex){
       return $ex;
   }
}
function upisVestiUBazu($naslov,$opis,$putanja,$podk,$id){
    try{
        global $conn;
        $upit = "INSERT INTO vest (naslov,sadrzaj,putanjaSlikeVest,idPodkategorije,idUser) VALUES (:naslov,:sadrzaj,:putanja,:idPod,:idUser)";
        $insert = $conn->prepare($upit);
        $insert->bindParam(":naslov", $naslov);
        $insert->bindParam(":sadrzaj", $opis);
        $insert->bindParam(":putanja", $putanja);
        $insert->bindParam(":idPod", $podk);
        $insert->bindParam(":idUser", $id);
        $rezultat = $insert->execute();
        return $rezultat;
    }
    catch(PDOException $ex){
        return $ex;
    }
}
function izmenaVesti($idVesti,$naslov,$opis,$putanja){
    try{
        global $conn;
        $upit = "UPDATE vest SET naslov = :naslov , sadrzaj = :opis , putanjaSlikeVest = :putanja
        WHERE idVest = :id";
        $update = $conn->prepare($upit);
        $update->bindParam(":naslov", $naslov);
        $update->bindParam(":opis", $opis);
        $update->bindParam(":putanja", $putanja);
        $update->bindParam(":id", $idVesti);
        $rezultat = $update->execute();
        return $rezultat;
    }
    catch(PDOException $ex){
        return $ex;
    }
}
function vratiAnketu($idPodkategorija){
   try{
       global $conn ;
    $upit = "SELECT COUNT(idGlasanja) FROM anketa WHERE idPodkategorija = ?";
    $select = $conn->prepare($upit);
            $select->execute([$idPodkategorija]);
            $podaci = $select->fetch();
            return $podaci;
   }
   catch(PDOException $ex){
       return $ex;
   }
}
function vratiBrojGlasova(){
try{global $conn;
   $upit="SELECT COUNT(idGlasanja) FROM anketa";
   $podaci = $conn->query($upit)->fetch();
   return $podaci;
}
catch(PDOException $ex){
    return $ex;
}
}
?>