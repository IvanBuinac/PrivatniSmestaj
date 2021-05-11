/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var httpObj=null;
function kreiranje(){
  if (window.ActiveXObject)

    return new ActiveXObject("Microsoft.XMLHTTP");
else if (window.XMLHttpRequest)
    return new XMLHttpRequest();
else{
     alert("Vas browser ne podrzava AJAX.");
     return null;
}
}
function datetime (obj)
{
    httpObjj=kreiranje();
    document.getElementById('datetimepickerdiv').innerHTML = "";
    if(httpObj != null)
	{
		httpObjj.open("GET",base_url()+"korisnik/ajax/datetime/"+obj,true);
		httpObjj.send(null);
		httpObjj.onreadystatechange = datese
	
	}
}
function datese()
{
    if(httpObjj.readyState==4 || httpObjj.readyState=="complete")
    {
    document.getElementById('datetimepickerdiv').innerHTML = httpObjj.responseText;;
    }
}
function dohvati_pozicije(obj)
{
    httpObjs=kreiranje();
    document.getElementById('pozicije').value = 0;
    if(httpObjs != null)
	{
		httpObjs.open("GET",base_url()+"korisnik/ajax/pozicija/"+obj,true);
		httpObjs.send(null);
		httpObjs.onreadystatechange = pozicija
	
	}
}
function pozicija()
{
    if(httpObjs.readyState==4 || httpObjs.readyState=="complete")
    {
    document.getElementById('pozicije').innerHTML = httpObjs.responseText;;
    }
}


function dohvati_cenu_smestaja(obj)
{
    httpObj=kreiranje();
    document.getElementById('cenasmestaja').value = "";
    if(httpObj != null)
	{
		httpObj.open("GET",base_url()+"korisnik/ajax/cena/"+obj,true);
		httpObj.send(null);
		httpObj.onreadystatechange = cena
	
	}
}
function cena()
{
    if(httpObj.readyState==4 || httpObj.readyState=="complete")
    {
    document.getElementById('cenasmestaja').value = httpObj.responseText;;
    }
}
function dohvati_broj_kreveta(obj)
{
    httpObje=kreiranje();
    document.getElementById('brojkreveta').value = "";
    if(httpObje != null)
	{
		httpObje.open("GET",base_url()+"korisnik/ajax/brojkreveta/"+obj,true);
		httpObje.send(null);
		httpObje.onreadystatechange = kreveta
	
	}
}
function kreveta()
{
    if(httpObje.readyState==4 || httpObje.readyState=="complete")
    {
    document.getElementById('brojkreveta').value = httpObje.responseText;
    }
}



function dohvati_korisnika(obj)
{
    httpObj=kreiranje();
    document.getElementById('objekat').value = "";
    if(httpObj != null)
	{
		httpObj.open("GET",base_url()+"admin/ajax/objekat/"+obj,true);
		httpObj.send(null);
		httpObj.onreadystatechange = objektii
	
	}
}
function objektii()
{
    if(httpObj.readyState==4 || httpObj.readyState=="complete")
    {
    document.getElementById('objekat').innerHTML = httpObj.responseText;;
    }
}


function dohvati_grad(obj)
{
	httpObj=kreiranje();

	document.getElementById('grad').value = "";
	if(httpObj != null)
	{
		httpObj.open("GET",base_url()+"korisnik/ajax/grad/"+obj,true);
		httpObj.send(null);
		httpObj.onreadystatechange = gradovi
	
	}
        
}

function gradovi()
{
	if(httpObj.readyState==4 || httpObj.readyState=="complete")
	{
	
	document.getElementById('grad').innerHTML = httpObj.responseText;;
	}
}


function dohvati_cenu(obj)
{
	httpObj=kreiranje();
	
	document.getElementById('amt').value = "";
        
	if(httpObj != null)
	{
		httpObj.open("GET",base_url()+"korisnik/ajax/cenaa/"+obj,true);
		httpObj.send(null);
		httpObj.onreadystatechange = cenaa
	}
}
function cenaa()
{
	if(httpObj.readyState==4 || httpObj.readyState=="complete")
	{
	
	document.getElementById('amt').value = httpObj.responseText;;
	}
}


function dohvati_drzavu(obj)
{
	httpObj=kreiranje();
	
	document.getElementById('drzava').value = 0;
        document.getElementById('grad').value = 0;
        
	if(httpObj != null)
	{
		httpObj.open("GET",base_url()+"korisnik/ajax/drzava/"+obj,true);
		httpObj.send(null);
		httpObj.onreadystatechange = ispisiBroja
	}
}
function ispisiBroja()
{
	if(httpObj.readyState==4 || httpObj.readyState=="complete")
	{
	
	document.getElementById('drzava').innerHTML = httpObj.responseText;;
	}
}

                
function prikaz_linkova(obj)
{
    httpObj=kreiranje();
	    
    if(httpObj != null)
    {
            httpObj.open("GET",base_url()+"admin/ajax/linkovi/"+obj,true);
            httpObj.send(null);
            httpObj.onreadystatechange = vrati
    }
}
function vrati()
{
    if(httpObj.readyState==4 || httpObj.readyState=="complete")
	{
	
	document.getElementById('linkovi').innerHTML = httpObj.responseText;;
	}
}
$(document).ready(function(){
  $(".click").change(function(){
	var id=$('.click').val()
	 var httpObj=null;
	
		
	var ajaxRequest;  // The variable that makes Ajax possible!

	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	
	ajaxRequest.open("GET", base_url()+"korisnik/ajax/razdaljine/"+id, true);
	ajaxRequest.send(null);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById('razdaljine').innerHTML = ajaxRequest.responseText;
		}
	}
	
	});
        
});
$(document).ready(function(){
    $(".obrisi").click(function(){
        var httpObj=null;
        var id=$('.obrisi').val()
        
        var ajaxRequest;  // The variable that makes Ajax possible!

	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	
	ajaxRequest.open("GET", base_url()+"korisnik/ajax/obrisi_upit_detaljno/"+id, true);
	ajaxRequest.send(null);
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			location.reload();
		}
	}
            
            
            
            
        });
});
