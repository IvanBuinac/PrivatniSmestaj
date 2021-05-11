/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function dodajsliku(){
var glavna=document.getElementById("slika2");
//var slika=document.getElementsByName("slika[]");
//for(var i=0;i<slika.length;i++)
//{
//alert (slika[i].value);
//if(slika[i].value!='')
//{
$( "#slika2" ).after("<tr><td>Galerija:</td><td id='slika1'><input name='slika[]' type='file' class='btn btn-success form-control' class='sliska' onChange='dodajsliku();' /><input class='form-control' type='text' name='nazivslika[]' placeholder='Unesite naziv slike'/></td></tr>");
//}
}