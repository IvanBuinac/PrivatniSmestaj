function checkform()
{
    var greske = "";  
    var korisnik='';
    try
    {
     var korisnik=document.getElementById("korisnik").value;   
    }
    catch(err)
    {
        
    }
    
    var drzava=document.getElementById("drzava");
    if(drzava.value==0)
    {
       drzava.style.borderColor = "red";
       greske+="</br>Niste izabrali drzavu"; 
    }
    else
    {
        drzava.style.borderColor = "";
    }
    
    var grad=document.getElementById("grad");
    if(grad.value==0)
    {
       grad.style.borderColor = "red";
       greske+="</br>Niste izabrali grad"; 
    }
    else
    {
        grad.style.borderColor = "";
    }
    
    var kategorija=document.getElementById("kategorija");
    if(kategorija.value==0)
    {
       kategorija.style.borderColor = "red";
       greske+="</br>Niste izabrali kategoriju"; 
    }
    else
    {
        kategorija.style.borderColor = "";
    }
    
    var tip=document.getElementById("tip");
    if(tip.value==0)
    {
       tip.style.borderColor = "red";
       greske+="</br>Niste izabrali tip"; 
    }
    else
    {
        tip.style.borderColor = "";
    }
    
    var web=document.getElementById("web");
    var noHTML = /(<([^>]+)>)/ig; // regex for removing HTML tags

    
    if(web.value=="" || noHTML.test(web.value))
    {
       web.style.borderColor = "red";
       greske+="</br>Niste uneli web adresu";  
    }
    else
    {
        web.style.borderColor = "";
    }
    
    var adresa=document.getElementById("adresa");
    if(adresa.value=="" || noHTML.test(adresa.value))
    {
       adresa.style.borderColor = "red";
       greske+="</br>Niste uneli Adresu smestaja";  
    }
    else
    {
        adresa.style.borderColor = "";
    }
    
    var naziv=document.getElementById("naziv");
    if(naziv.value=="" || noHTML.test(naziv.value))
    {
       naziv.style.borderColor = "red";
       greske+="</br>Niste uneli Naziv smestaja";  
    }
    else
    {
        naziv.style.borderColor = "";
    }
    
    
    var opis=document.getElementById("opis");
    if(korisnik=="")
    {
        if(opis.value=="" || noHTML.test(opis.value) )
        {
           opis.style.borderColor = "red";
           greske+="</br>Niste uneli Opis smestaja";  
        }
        else
        {
            opis.style.borderColor = "";
        }
    }
    
    
    var reg=/^[0-9]{1,}$/;
    var kapacitet=document.getElementById("kapacitet");
    if(kapacitet.value=="" || noHTML.test(kapacitet.value) || !reg.test(kapacitet.value))
    {
       kapacitet.style.borderColor = "red";
       greske+="</br>Niste dobro uneli kapacitet, mora da bude broj";  
    }
    else
    {
        kapacitet.style.borderColor = "";
    } 
    
    var iznajmljujese=document.getElementsByName("iznajmljujese[]");
    var cbPrevod=0;
    for(var t=0;t<iznajmljujese.length;t++)
    {
    if(iznajmljujese[t].checked)
    {
    cbPrevod++;
    }
    }

    if(cbPrevod==0)
    {
    greske+="</br>Niste izabrali sta se iznajmljuje";
    }
    
    var kordinatax=document.getElementById("kordinatax");
    if(kordinatax.value=="" || noHTML.test(kordinatax.value))
    {
       kordinatax.style.borderColor = "red";
       greske+="</br>Niste uneli kordinate";  
    }
    else
    {
        kordinatax.style.borderColor = "";
    }
    
    
    var kordinatay=document.getElementById("kordinatay");
    if(kordinatay.value=="" || noHTML.test(kordinatay.value))
    {
       kordinatay.style.borderColor = "red";
       greske+="</br>Niste uneli kordinate";  
    }
    else
    {
        kordinatay.style.borderColor = "";
    }
    
    var od=document.getElementsByName("od[]");
    for(var t=0;t<od.length;t++)
    {
    if(od[t].value=="" || noHTML.test(od[t].value))
    {
    greske+="</br>Niste izabrali pocetni datum u detaljnom cenovniku";
    od[t].style.borderColor = "red";
    }
    else
    {        
    od[t].style.borderColor = "";
    }
    }

    var doo=document.getElementsByName("do[]");
    for(var t=0;t<doo.length;t++)
    {
    if(doo[t].value=="" || noHTML.test(doo[t].value))
    {
    greske+="</br>Niste izabrali zavrsni datum u detaljnom cenovniku";
    doo[t].style.borderColor = "red";
    }
    else
    {       
    doo[t].style.borderColor = "";
    }
    }
    
    var cenaa=document.getElementsByName("cena[]");
    for(var t=0;t<cenaa.length;t++)
    {
    if(cenaa[t].value=="" || noHTML.test(cenaa[t].value) || !reg.test(cenaa[t].value))
    {
    greske+="</br>Niste uneli cenu ili niste uneli ispravno, moguce je uneti samo brojeve";
    cenaa[t].style.borderColor = "red";
    }
    else
    {      
    cenaa[t].style.borderColor = "";
    }
    }
    
    var cena=document.getElementsByName("cenadetaljno[]");
    for(var t=0;t<cena.length;t++)
    {
    if(cena[t].value=="" || noHTML.test(cena[t].value) || !reg.test(cena[t].value))
    {
    greske+="</br>Niste uneli cenu u detaljnom cenovniku";
    cena[t].style.borderColor = "red";
    }
    else
    {      
    cena[t].style.borderColor = "";
    }
    }
    
    
    
    if(greske=="")
    {
        return true;
    }
    else
    {
        var ispis=document.getElementById("ispis");
        ispis.innerHTML = greske;
        return false;
    }
    

}


