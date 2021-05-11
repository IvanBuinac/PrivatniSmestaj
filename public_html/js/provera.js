function registracija()
{

	var greske = "";
        var noHTML = /(<([^>]+)>)/ig; // regex for removing HTML tags
        var Ime=document.getElementById("ime");
        if(Ime.value=="" || noHTML.test(Ime.value))
        {
           Ime.style.borderColor = "red";
           greske+="</br>Niste uneli Ime"; 
        }
        else
        {
            Ime.style.borderColor = "";
        }
        
        var Prezime=document.getElementById("prezime");
        if(Prezime.value=="" || noHTML.test(Prezime.value))
        {
           Prezime.style.borderColor = "red";
           greske+="</br>Niste uneli Prezime"; 
        }
        else
        {
            Prezime.style.borderColor = "";
        }
        
        var email=document.getElementById("e-mail");
        if(email.value=="" || noHTML.test(email.value))
        {
           email.style.borderColor = "red";
           greske+="</br>Niste uneli e-mail"; 
        }
        else
        {
            email.style.borderColor = "";
        }
        
        var lozinka=document.getElementById("lozinka");       
        if(lozinka.value=="" || noHTML.test(lozinka.value))
        {
           lozinka.style.borderColor = "red";
           greske+="</br>Niste uneli lozinku"; 
        }
        else
        {
            lozinka.style.borderColor = "";
        }
        
        var lozinkaponovo=document.getElementById("lozinkaponovo");
        if(lozinkaponovo.value=="" || noHTML.test(lozinkaponovo.value))
        {
           lozinkaponovo.style.borderColor = "red";
           greske+="</br>Niste uneli lozinku ponovo"; 
        }
        else
        {
            lozinkaponovo.style.borderColor = "";
        }
        
        if(lozinka.value!=lozinkaponovo.value)
        {
          lozinka.style.borderColor = "red";
          lozinkaponovo.style.borderColor = "red";
          greske+="</br>Lozinke se ne poklapaju";   
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