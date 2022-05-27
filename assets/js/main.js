$(document).ready(function () {
    //Ne radi samo poruka, videti to
    $(document).on('click', '#register',function(e){
        e.preventDefault();
        v = provera();
        
       let podaciZaSlanje= {
            ime : v[0],
            prezime:v[1],
            username:v[2],
            email:v[3],
            sifra:v[4]
        }
       ajax2("functions/registerObrada.php","post",podaciZaSlanje,function(data){
        let upis = `<h2>${data.poruka} </h2>`;
        $(".odgovor").html(upis);
        vracanje()
        $(".odgovor").addClass('success');
        

       },function(xhr){
           let i = 0;
           console.log(xhr.responseText)
           xhr.responseText =xhr.responseText.replace("["," ")
           xhr.responseText =xhr.responseText.replace("]"," ")
           xhr.responseText =xhr.responseText.replaceAll('"'," ")
           console.log(xhr.responseText)    
            $(".odgovor").html("<h2>Greska:" + xhr.responseText+"</h2>"); 
            $(".odgovor").addClass('error');       
       })
    })
    //Logovanje
    $(document).on('click', '#btnLogovanje', function(e){
        e.preventDefault()
        p = proveraLog();
        let podaciZaSlanje= {
            email : p[0],
            password:p[1]
        }
        ajax2("functions/loginObrada.php","post",podaciZaSlanje,function(data){
            location.reload(true);
           },function(xhr){
            let i = 0;
            console.log(xhr.responseText)
            xhr.responseText =xhr.responseText.replace("["," ")
            xhr.responseText =xhr.responseText.replace("]"," ")
            xhr.responseText =xhr.responseText.replaceAll('"'," ")
            console.log(xhr.responseText)    
             $(".odgovorLog").html("<h4>Greska:" + xhr.responseText+"</h4>"); 
             
            })
   })
   //Logovanje komentar
   $(document).on('click', '#btnLogovanjeKom', function(e){
    e.preventDefault()
    p = proveraLog2();
   let podaciZaSlanje= {
        email : p[0],
        password:p[1]
    }
    ajax2("functions/loginObrada.php","post",podaciZaSlanje,function(data){
        location.reload(true);
       }, function(xhr){
        let i = 0;
        console.log(xhr.responseText)
        xhr.responseText =xhr.responseText.replace("["," ")
        xhr.responseText =xhr.responseText.replace("]"," ")
        xhr.responseText =xhr.responseText.replaceAll('"'," ")
        console.log(xhr.responseText)    
         $(".odgovorLogKom").html("<h4>Greska:" + xhr.responseText+"</h4>"); 
         $(".odgovorLogKom").addClass('error');
        })
    })
    //slanje poruka adminu
    $(document).on('click', '#btnPosaljiPoruku',function(e){
        e.preventDefault();
        v = proveraKontakt();
        console.log(v[3])
        let podaciZaSlanje= {
            email : v[0],
            ime:v[1],
            razlozi:v[3],
            poruka:v[2],
        }

       ajax2("functions/kontaktObrada.php","post",podaciZaSlanje,function(data){
        let upis = `<h2>${data.poruka} </h2>`;
        $(".odgovor").html(upis);
        vracanje2()
        $(".odgovor").addClass('success');
        

       },function(xhr){
           let i = 0;
           console.log(xhr.responseText)
           xhr.responseText =xhr.responseText.replace("["," ")
           xhr.responseText =xhr.responseText.replace("]"," ")
           xhr.responseText =xhr.responseText.replaceAll('"'," ")
           console.log(xhr.responseText)    
            $(".odgovor").html("<h2>Greska:" + xhr.responseText+"</h2>"); 
            $(".odgovor").addClass('error');       
       })
    })
    //sortiranje index
    $(document).on('change','#ddlSortPoPopularnosti',function(){
        let idDdl = $("#ddlSortPoPopularnosti").val();
        
        if(idDdl==0){
            location.reload(true);
        }
        else{
           let podaciZaSlanje = {
                id:idDdl
           }
            ajax2("functions/filterPoPopularnosti.php","post",podaciZaSlanje,function(data){
                stampajVesti(data);
            })
        }
    })
    //sortiranje na kategorji
    $(document).on('change','#ddlSortPoPopularnosti2',function(){
        let idDdl = $("#ddlSortPoPopularnosti2").val();
        let idKat = $('select[name="select"] :selected').attr('class')
        console.log(idKat);
        if(idDdl==0){
            location.reload(true);
        }
        else{
           let podaciZaSlanje = {
                id:idDdl,
                idKat:idKat
           }
            ajax2("functions/filterPoPopularnosti.php","post",podaciZaSlanje,function(data){
                stampajVesti2(data);
            })
        }
    })
    //unosKomentara
    $(document).on('click','#btnDodajKomentar',function(e){
        e.preventDefault();
        v = proveraKomentar();
        //console.log(v);
        podaciZaSlanje={
            komentar:v[0],
            idUser:v[1],
            idVest:v[2]
        }
       ajax2("functions/unosKomentara.php","POST",podaciZaSlanje,function(data){
           location.reload(true);
            
       },function(xhr){
        let i = 0;
        console.log(xhr.responseText)
        xhr.responseText =xhr.responseText.replace("["," ")
        xhr.responseText =xhr.responseText.replace("]"," ")
        xhr.responseText =xhr.responseText.replaceAll('"'," ")
        console.log(xhr.responseText)    
         $(".greskaKomentar").html("<h2>Greska:" + xhr.responseText+"</h2>"); 
         $(".greskaKomentar").addClass('error');       
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
    
// regex
function provera() {

    let Podaci = [];
    let error = 0;
    let ime = document.querySelector("#tbIme");
    let prezime = document.querySelector("#tbPrezime");
    let email = document.querySelector('#tbEmail');
    let username = document.querySelector('#tbUsername');
    let password = document.querySelector("#tbPassword");
    let Cpassword = document.querySelector("#tbCPassword")
    let checkImePrezime = /^[A-ZŽĐŠČĆ][a-z]{2,30}/;
    let checkEmail = /^([a-zA-Z0-9_\-\.ŽĐŠČĆžđščć]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    let checkUsername = /^[A-Za-zŽĐŠČĆžđščć[A-Za-zŽĐŠČĆžđščć0-9]{2,30}/;
    let checkPass = /^([A-ZŽĐŠČĆžđščć])+([A-Za-z0-9ŽĐŠČĆžđščć]{7,30})$/;
    
    if (!checkImePrezime.test(ime.value)) {
        document.querySelector('.greskaIme').classList.remove("hide");
        document.querySelector('.greskaIme').innerHTML = 'Ime nije u dobroj formi, primer : "Aleksandar"'
        error++;
    } else {
        document.querySelector('.greskaIme').classList.add("hide");
        document.querySelector('.greskaIme').innerHTML = ''
        Podaci.push(ime.value)
        
    }
    if (!checkImePrezime.test(prezime.value)) {
        document.querySelector('.greskaPrezime').classList.remove("hide");
        document.querySelector('.greskaPrezime').innerHTML = 'Prezime nije u dobro formi, primer : "Aleksic"';
        error++;
    } else {
        document.querySelector('.greskaPrezime').classList.add("hide");
        document.querySelector('.greskaPrezime').innerHTML = '';
        Podaci.push(prezime.value)
        
    }
    if (!checkUsername.test(username.value)) {        
        document.querySelector('.greskaUsername').classList.remove("hide");
        document.querySelector('.greskaUsername').innerHTML = ' Username nije u dobroj formi. Moguce je koristit mala i velika slova i brojeve. Minimum 3 karaktera';
        error++;
    } else {
        document.querySelector('.greskaUsername').classList.add("hide");
        document.querySelector('.greskaUsername ').innerHTML = '';
        Podaci.push(username.value);
        
    }
    if (!checkEmail.test(email.value)) {
        document.querySelector('.greskaEmail').classList.remove("hide");
        document.querySelector('.greskaEmail').innerHTML = 'Email nije u dobroj formi, primer : "nesto@gmail.com"'
        error++;
    } else {
        document.querySelector('.greskaEmail').classList.add("hide");
        document.querySelector('.greskaEmail').innerHTML = ''
        Podaci.push(email.value)
    }
    if (!checkPass.test(password.value)) {
        document.querySelector(".greskaPass").classList.remove("hide");
        document.querySelector(".greskaPass").innerHTML = "Sifra nije u dobroj formi, mora poceti velikim slovom,moze sadrzati mala i velika slova i brojeve. Minimum 8 karaktera"
        error++;
    } else {
        document.querySelector(".greskaPass").classList.add("hide");
        document.querySelector(".greskaPass").innerHTML = "";
        Podaci.push(password.value)
    }
    if(password.value != Cpassword.value){
        document.querySelector(".greskaCPass").classList.remove("hide");
        document.querySelector(".greskaCPass").innerHTML="Sifre se ne poklapaju"
        error++;
    }
    else{
        document.querySelector(".greskaCPass").classList.add("hide");
        document.querySelector(".greskaCPass").innerHTML = "";
    }
    if(error==0){
        return Podaci;
    }
    
}
function vracanje(){
    let ime = document.querySelector("#tbIme");
    let prezime = document.querySelector("#tbPrezime");
    let email = document.querySelector('#tbEmail');
    let username = document.querySelector('#tbUsername');
    let password = document.querySelector("#tbPassword");
    let Cpassword = document.querySelector("#tbCPassword");
    ime.value=""
    prezime.value=""
    username.value=""
    email.value=""
    password.value=""
    Cpassword.value=""
}
function proveraLog(){
    let Podaci =[];
    let email = document.querySelector('#tbLoginEmail');
    let password = document.querySelector("#tbLoginPassword");
    let checkEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    let checkPass = /^([A-ZŽĐŠČĆžđščć])+([A-Za-z0-9ŽĐŠČĆžđščć]{7,30})$/;
    let error = 0;
    if (!checkEmail.test(email.value)) {
        document.querySelector('.greskaEmailLog').classList.remove("hide");
        document.querySelector('.greskaEmailLog').innerHTML = 'Email nije u dobroj formi, primer : "nesto@gmail.com"'
        error++;
    } else {
        document.querySelector('.greskaEmailLog').classList.add("hide");
        document.querySelector('.greskaEmailLog').innerHTML = ''
        Podaci.push(email.value)
    }
    if (!checkPass.test(password.value)) {
        document.querySelector(".greskaPassLog").classList.remove("hide");
        document.querySelector(".greskaPassLog").innerHTML = "Sifra nije u dobroj formi, mora poceti velikim slovom,moze sadrzati mala i velika slova i brojeve. Minimum 8 karaktera"
        error++;
    } else {
        document.querySelector(".greskaPassLog").classList.add("hide");
        document.querySelector(".greskaPassLog").innerHTML = "";
        Podaci.push(password.value)
    }
    if(error==0){
        return Podaci;
    }
}
function proveraLog2(){
    let Podaci =[];
    let email = document.querySelector('#tbLoginEmailKom');
    let password = document.querySelector("#tbLoginPasswordKom");
    let checkEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    let checkPass = /^([A-ZŽĐŠČĆžđščć])+([A-Za-z0-9ŽĐŠČĆžđščć]{7,30})$/;
    let error = 0;
    if (!checkEmail.test(email.value)) {
        document.querySelector('.greskaEmailLogKom').classList.remove("hide");
        document.querySelector('.greskaEmailLogKom').innerHTML = 'Email nije u dobroj formi, primer : "nesto@gmail.com"'
        error++;
    } else {
        document.querySelector('.greskaEmailLogKom').classList.add("hide");
        document.querySelector('.greskaEmailLogKom').innerHTML = ''
        Podaci.push(email.value)
    }
    if (!checkPass.test(password.value)) {
        document.querySelector(".greskaPassLogKom").classList.remove("hide");
        document.querySelector(".greskaPassLogKom").innerHTML = "Sifra nije u dobroj formi, mora poceti velikim slovom,moze sadrzati mala i velika slova i brojeve. Minimum 8 karaktera"
        error++;
    } else {
        document.querySelector(".greskaPassLogKom").classList.add("hide");
        document.querySelector(".greskaPassLogKom").innerHTML = "";
        Podaci.push(password.value)
    }
    if(error==0){
        return Podaci;
    }
}
function proveraKontakt(){
    let email = document.querySelector('#emailKontakt');
    let ime = document.querySelector('#imeKontakt');
    let razlozi = document.querySelector("#ddlRazlog");
    let poruka = document.querySelector("#porukaKontakt");
    let razlogV = razlozi.value;
    let porukav = poruka.value;
    let checkIme = /^[A-ZŽĐŠČĆ][a-zžđščć]{2,50}/;
    let checkEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    //let checkPoruka = /^[A-Z][a-z][0-9]\s\.\,\?\!\"{2,500}/
    error=0;
    Podaci=[];
    if (!checkEmail.test(email.value)) {
        document.querySelector('.greskaEmailKontakt').classList.remove("hide");
        document.querySelector('.greskaEmailKontakt').innerHTML = 'Email nije u dobroj formi, primer : "nesto@gmail.com"'
        error++;
    } else {
        document.querySelector('.greskaEmailKontakt').classList.add("hide");
        document.querySelector('.greskaEmailKontakt').innerHTML = ''
        Podaci.push(email.value)
    }
    if (!checkIme.test(ime.value)) {
        document.querySelector('.greskaImeKontakt').classList.remove("hide");
        document.querySelector('.greskaImeKontakt').innerHTML = 'Ime nije u dobroj formi.'
        error++;
    } else {
        document.querySelector('.greskaImeKontakt').classList.add("hide");
        document.querySelector('.greskaImeKontakt').innerHTML = ''
        Podaci.push(ime.value)
    }
    if (porukav.lenght >500) {
        document.querySelector('.greskaPorukaKontakt').classList.remove("hide");
        document.querySelector('.greskaPorukaKontakt').innerHTML = 'Poruka nije dobra'
        error++;
    } else {
        document.querySelector('.greskaPorukaKontakt').classList.add("hide");
        document.querySelector('.greskaPorukaKontakt').innerHTML = ''
        Podaci.push(poruka.value)
    }
    if(razlogV==0){
        document.querySelector('.greskaSelect').classList.remove("hide");
        document.querySelector('.greskaSelect').innerHTML = 'Morate izabrati razlog'
        error++;
    }
    else{
        document.querySelector('.greskaSelect').classList.add("hide");
        document.querySelector('.greskaSelect').innerHTML = ''
        Podaci.push(razlozi.value)
    }
    if(error==0){
        return Podaci;
    }

}
function vracanje2(){
    let email = document.querySelector('#emailKontakt');
    let ime = document.querySelector('#imeKontakt');
    let razlozi = document.querySelector("#ddlRazlog");
    let poruka = document.querySelector("#porukaKontakt");
    email.value="";
    ime.value="";
    razlozi.value=0;
    poruka.value=""
}
function stampajVesti(vesti){
    let html="";
    if(vesti.length === 0){
       html+= `<h1 id='nemaVestiWarning'>Trenutno nema vesti </h1>`
    }
    else{
        for(let vest of vesti){
            let datumArr = vest.datum.split(" ");
            
            let datum = datumArr[0].split("-");
            
            let datumFormat = datum[2] + ". " + datum[1] + ". " + datum[0] + ".";
        html+=`  
        <div class="vest">
                <div class="vestLevo">
                     <a href="vest.php?id=${vest.idVest}">   <img src="${vest.putanjaSlikeVest}" alt="slikaVest"> </a>
                </div>
                <div class="vestDesno">
                        <div class="vestNaslov">
                                <h1><a href="vest.php?id=${vest.idVest}">${vest.naslov}</a></h1>
                        </div>
                        <div class="vestInfo">
                                <div class="podkat">
                                <a href="kategorija.php?id=${vest.idKategorija}"> ${vest.nazivKategorija}</a>
                                </div>
                                <!--Ukoliko nisi admin ne vidis ovo-->
                                <div class="datumBrKom">
                                <p> ${datumFormat}</p>
                                <p><a href="vest.php?id=${vest.idVest}">Broj Komentara ${vest.komentari}</a> </p>
                                </div>
                        </div>
                </div>
        </div>
       `}
    }
    $(".sadrzajLevo").html(html);
}
function stampajVesti2(vesti){
    let html="";
    if(vesti.length === 0){
       html+= `<h1 id='nemaVestiWarning'>Trenutno nema vesti </h1>`
    }
    else{
        for(let vest of vesti){
            let datumArr = vest.datum.split(" ");
            
            let datum = datumArr[0].split("-");
            
            let datumFormat = datum[2] + ". " + datum[1] + ". " + datum[0] + ".";
        html+=`  
        <div class="vest">
                <div class="vestLevo">
                     <a href="vest.php?id=${vest.idVest}">   <img src="${vest.putanjaSlikeVest}" alt="slikaVest"> </a>
                </div>
                <div class="vestDesno">
                        <div class="vestNaslov">
                                <h1><a href="vest.php?id=${vest.idVest}">${vest.naslov}</a></h1>
                        </div>
                        <div class="vestInfo">
                                <div class="podkat">
                                <a href="kategorija.php?id=${vest.idKategorija}"> ${vest.nazivPodkategorija}</a>
                                </div>
                                <!--Ukoliko nisi admin ne vidis ovo-->
                                <div class="datumBrKom">
                                <p> ${datumFormat}</p>
                                <p><a href="vest.php?id=${vest.idVest}">Broj Komentara ${vest.komentari}</a> </p>
                                </div>
                        </div>
                </div>
        </div>
       `}
    }
    $(".sadrzajLevo").html(html);
}
function proveraKomentar(){
    let Podaci = [];
    let error = 0;
    let komentar = document.querySelector("#unosKomentara");
    let idUser = document.querySelector("#idUsera");
    let idVest = document.querySelector("#idVesti");
    let regexKomentar = /^([A-ZŽĐŠČĆ])+([A-z0-9ŽĐŠČĆžđščć_\-\.\s\!\?]){2,500}/
    if (!regexKomentar.test(komentar.value)) {
        document.querySelector('.greskaKomentar').classList.remove("hide");
        document.querySelector('.greskaKomentar').innerHTML = 'Komentar nije u dobroj formi, max 500 karaktera min 3. Prvo slovo veliko'
        error++;
    } else {
        document.querySelector('.greskaKomentar').classList.add("hide");
        document.querySelector('.greskaKomentar').innerHTML = ''
        Podaci.push(komentar.value)
        
    }
    if(idUser!=0){
        Podaci.push(idUser.value);
    }
    else{
        error++;
    }
    if(idVest != 0){
        Podaci.push(idVest.value);
    }
    else{
        error++;
    }
    if(error==0){
        return Podaci;
    }

}