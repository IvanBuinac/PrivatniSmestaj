
            $(document).ready(function() {
    var max_fields      = 3; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr><td>Telefon:</td><td><div class="input-group"><input type="text" name="telefon[]" value="" class="form-control" placeholder="Unesite vas kontakt telefon" required="required"  /><span class="input-group-addon"><span class="glyphicon glyphicon-remove remove_field" ></span></span></div></td></tr>'); //add input box
        }
        else
        {
            alert ("Ne mozete dodati vise od 3 telefona");
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parents().eq(3).remove(); x--;
    })
});