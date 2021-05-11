/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".dodaj-novi"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var brojdet=document.getElementById("brojdet").value;
    
    var x = brojdet; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        
        if(x < max_fields){ //max input box allowed
            x++; //text box increment

            $(wrapper).append("<tr><script type='text/javascript'>$('#datetimepicker"+x+"').datetimepicker({format: 'YYYY-MM-DD',useCurrent: false});$('#datetimepickerr"+x+"').datetimepicker({format: 'YYYY-MM-DD',useCurrent: false});$('#datetimepicker"+x+"').on('dp.change', function (e) {$('#datetimepickerr"+x+"').data('DateTimePicker').minDate(e.date);});$('.datetimepickerr"+x+"').on('dp.change', function (e) {$('#datetimepicker"+x+"').data('DateTimePicker').maxDate(e.date);});</script><td class='col-md-3'>Od:<div class='form-group' style='margin:0px;'><div class='input-group date ' id='datetimepicker"+x+"'><input type='text' class='form-control' name='od[]' placeholder='od datuma' /><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div></td><td class='col-md-3'>Do:<div class='form-group' style='margin:0px;'><div class='input-group date '  id='datetimepickerr"+x+"'><input type='text' class='form-control' name='do[]' placeholder='do datuma' /><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div></td><td class='col-md-3'>Cena:<input type='text' class='form-control' name='cenadetaljno[]' placeholder='Cena' /></td><td class='col-md-2'><br/><select name='cenapo[]' class='form-control'><option value='1'>Po osobi</option><option value='2'>Za ceo smestaj</option></select></td><td class='col-md-1'><br/><button type='button' class='btn btn-danger form-control remove_field' >X</button></td></tr>"); //add input box
        }
        else
        {
            alert ("Ne mozete dodati vise od 10 cena");
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parents().eq(1).remove(); x--;
    })
});

//	 $(function() {
//		 var addDiv = $('#addinput');
//		 var i = $('#addinput tr').size() + 1 ;
//			$("#dodajcenu").on('click', function() {
//				
//			$( "#prvi" ).after( "<tr><td>Od:<input type='text' class='form-control' name='od[]' placeholder='od datuma'/></td><td>Do:<input type='text' class='form-control' name='do[]' placeholder='do datuma'/></td><td>Cena:<input type='text' class='form-control' name='cenadetaljno[]' placeholder='Cena'/></td><td><br/><select name='cenapo[]' class='form-control'><option value='1'>Po osobi</option><option value='2'>Za ceo smestaj</option></select></td><td><br/><button type='button' class='btn btn-danger form-control ' id='removee' >X</button></td></tr>" );
//			
//				i++;
//				return false;
//				});
//				
//			$("#removee").on('click', function() { 
//                if( i > 1 ) {
//                        $(this).parents('tr').remove();
//                        i--;
//                }
//				return false;
//        });
//});
    