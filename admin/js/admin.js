$(document).ready(function(){
    

        $(document).on('change','.ddlPromenaUloge',function(){
            let idUloge = $(this).val();
            let idKor = $(this).data("id")
            // console.log(idUloge, idKor);
            podaciZaSlanje={
                idUl:idUloge,
                idK:idKor
            }
            ajax2("functions/promenaUloge.php","POST",podaciZaSlanje,function(data){

                stampajKorisinke(data.korisnici,data.uloge);
                console.log(data.korisnici)
                console.log(data.uloge)
                // location.reload(true);
            })
           
        })
        $(document).on('click','#btnUnesipotkategoriju',function(e){
            e.preventDefault();
            v=proveraPodkategorija();
           // console.log(v);
            let podaciZaSlanje={
                ime:v[0],
                idKat:v[1]
            }
            ajax2("functions/unosPodkat.php","POST",podaciZaSlanje,function(data){
                let upis = `<h2>${data.poruka} </h2>`;
                 $(".odgovorPod").html(upis);
                vracanje()
                $(".odgovorPod").addClass('success');
            },function(xhr){
                let i = 0;
           console.log(xhr.responseText)
           xhr.responseText =xhr.responseText.replace("["," ")
           xhr.responseText =xhr.responseText.replace("]"," ")
           xhr.responseText =xhr.responseText.replaceAll('"'," ")
           console.log(xhr.responseText)    
            $(".odgovorPod").html("<h2>Greska:" + xhr.responseText+"</h2>"); 
            $(".odgovorPod").addClass('error');       
            })
         })

         $( "#search" ).keyup(function() {
            v=$(this).val()
            //console.log(v);
            podaciZaSlanje={
                search:v
            }
            ajax2("functions/search.php","POST",podaciZaSlanje,function(data){
                stampajKorisinke(data[0],data[1]);
            })
          })
        
})

function ajax2(url, method, data = {},func,greske) {
    if(greske){
    $.ajax({
        url: url,
        method: method,
        dataType: "json",
        data: data,
        success: func,
        error: greske
        }
    );
}
    else{
        $.ajax({
            url: url,
            method: method,
            dataType: "json",
            data: data,
            success: func,
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
}
function stampajKorisinke(korisnici,uloge){
     html="";

    if(korisnici.lenght===0){
        html+=`<h1 >Trenutno nema korisnika</h1>`;
    }
    else{
        html+=` <table class="adminPanelTabela">
                    <tr>
                        <td>Slika</td>
                        <td>id</td>
                        <td>Ime</td>
                        <td>Prezime</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Aktivan</td>
                        <td>Datum</td>
                        <td>Uloga</td>
                        <td>Obrisi</td>
                        <td>Promeni ulogu</td>
                    </tr>`
        for(let k of korisnici){
            let datumArr = k.datumRegistracije.split(" ");
            
            let datum = datumArr[0].split("-");
            
            let datumFormat = datum[2] + ". " + datum[1] + ". " + datum[0] + ".";

            html +=` <tr>
                            <td><img src="../${k.putanjaSlikaUloga}" alt ='slikaKorisnik' /></td>
                            <td>${k.idUser}</td>
                            <td>${k.imeUser}</td>
                            <td>${k.prezimeUser}</td>
                            <td>${k.username}</td>
                            <td>${k.emailUser}</td> `
                            if(k.aktivanUser=="0"){
                                    html+=`<td>Neaktivan</td>`
                            }
                            else{
                                html+=`<td>Aktivan</td>`
                            }
                        html+=`       
                            <td>${datumFormat}</td>
                            <td>${k.nazivUloga}</td>`
                            
                            if(k.aktivanUser=="1"){
                            
                                         html+= `<td><a href="functions/deaktiviranjeKorisnika.php?id=${k.idUser}">Deaktiviraj </a></td>`
                            }
                            else{
                            
                                html+= `<td><a href="functions/aktiviranjeKorisnika.php?id=${k.idUser}">Aktiviraj</a></td>`
                            }
                        html+= `      <td>
                                <select data-id="${k.idUser}"  class="ddlPromenaUloge" name ="promena">
                                    <option value="0">Izaberite</option>`
                                    
                                        for(let u of uloge ){
                                    
                                        html+=  `<option value="${u.idUloga}"> ${u.nazivUloga} </option>`
                                    
                                        }
                                
                    html+=` </select>
                                </td>
                 </tr>`

        }
    html+=`</table>`
    }
    $("#stampajKorisnike").html(html);
}
function proveraPodkategorija(){
    let Podaci = [];
    let error = 0;
    let ime = document.querySelector("#tbImePotkategorije");
    let kat = document.querySelector("#ddlKategorija")
    let checkIme =/^([A-Z])+([A-z\s]){2,50}/;
    if (!checkIme.test(ime.value)) {
        document.querySelector('.greskaIme').classList.remove("hide");
        document.querySelector('.greskaIme').innerHTML = 'Ime nije dobro.Veliko prvo slovo, samo slova, do 50 karaktera'
        error++;
    } else {
        document.querySelector('.greskaIme').classList.add("hide");
        document.querySelector('.greskaIme').innerHTML = ''
        Podaci.push(ime.value)      
    }
    if (kat.value==0) {
        document.querySelector('.greskaKategorija').classList.remove("hide");
        document.querySelector('.greskaKategorija').innerHTML = 'Morate izabrati kategoriju'
        error++;
    } else {
        document.querySelector('.greskaKategorija').classList.add("hide");
        document.querySelector('.greskaKategorija').innerHTML = ''
        Podaci.push(kat.value)      
    }
    if(error==0){
        return Podaci;
    }
}
function vracanje(){
    let ime = document.querySelector("#tbImePotkategorije");
    let kat = document.querySelector("#ddlKategorija")
    ime.val="";
    kat.val=0;
}