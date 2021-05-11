function checkform()
{
    var greske="";
    var korisnik='';
    try
    {
     var korisnik=document.getElementById("korisnik").value;   
    }
    catch(err)
    {
        
    }
    
    var objekat=document.getElementById("objekat");
    if(objekat.value==0)
    {
       objekat.style.borderColor = "red";
       greske+="</br>Niste izabrali objekat"; 
    }
    else
    {
        objekat.style.borderColor = "";
    }
    
    var vrsta=document.getElementById("vrsta");
    if(vrsta.value==0)
    {
       vrsta.style.borderColor = "red";
       greske+="</br>Niste izabrali vrstu"; 
    }
    else
    {
        vrsta.style.borderColor = "";
    }
    
    var naziv=document.getElementById("naziv");
    var noHTML = /(<([^>]+)>)/ig; // regex for removing HTML tags
    if(naziv.value=="" || noHTML.test(naziv.value) )
    {
       naziv.style.borderColor = "red";
       greske+="</br>Niste uneli naziv"; 
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
    
    var reg = /^\d+$/;
    var mesta=document.getElementById("mesta");
    if(mesta.value==""  || !reg.test(mesta.value))
    {
       mesta.style.borderColor = "red";
       greske+="</br>Niste uneli broj mesta"; 
    }
    else
    {
        mesta.style.borderColor = "";
    }
    
    
    if(greske=="")
    return true;
    else
    {
        var ispis=document.getElementById("ispis");
        ispis.innerHTML = greske;
        return false;
    }
}

