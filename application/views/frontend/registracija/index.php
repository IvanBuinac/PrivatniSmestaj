<div class="container">
<h2><?php print translate("Registracija", $jezik)?></h2>
<?php $error=$this->session->flashdata('error');
if (isset($error)) {
    print $error;
}
    ?>
<?php print form_open($jezik.'/registracija/registrujse',array('role'=>"form",'class'=>"form-horizontal","onSubmit"=>"return registracija()"))?>

    <table class="table input_fields_wrap">
        <tr>
            <td><?php print translate("Ime", $jezik)?>:</td>
            <td><?php print form_input(array('name'=>'ime','class'=>'form-control','placeholder'=>'Unesite vase ime', 'required'=>'required',"id"=>"ime")); ?></td>
        </tr>
        <tr>
            <td><?php print translate("Prezime", $jezik)?>:</td>
            <td><?php print form_input(array('name'=>'prezime','class'=>'form-control','placeholder'=>'Unesite vase prezime', 'required'=>'required',"id"=>"prezime")); ?></td>
        </tr>
        <tr>
            <td><?php print translate("Email", $jezik)?>:</td>
            <td><?php print form_input(array('name'=>'email','class'=>'form-control','placeholder'=>'Unesite vasu e-mail adressu', 'type'=>'email', 'required'=>'required',"id"=>"e-mail")); ?></td>
        </tr>
        <tr>
            <td><?php print translate("Lozinka", $jezik)?>:</td>
            <td><?php print form_input(array('name'=>'password','class'=>'form-control','placeholder'=>'Unesite vas password', 'type'=>'password', 'required'=>'required',"id"=>"lozinka")); ?></td>
        </tr>
        <tr>
            <td><?php print translate("Lozinka ponovo", $jezik,TRUE)?>:</td>
            <td><?php print form_input(array('name'=>'ponovljen','class'=>'form-control','placeholder'=>'Ponovite password', 'type'=>'password', 'required'=>'required',"id"=>"lozinkaponovo")); ?></td>
        </tr>
        <tr>
            <td>Drzava:</td>
            <td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava' ";
            print form_dropdown("drzava", $drzavas , NULL ,$datas); ?></td>
        </tr>
        <tr>
            <td>Grad:</td>
            <td><?php $datas = "class='form-control' id='grad'";
            print form_dropdown("grad", array("0"=>"Izaberite drzavu") , NULL ,$datas); ?></td>
        </tr>
        
        <tr>
            <td>Telefon:</td>
            <td>
                <div class="input-group">
                <?php print form_input(array('name'=>'telefon[]','class'=>'form-control','placeholder'=>'Unesite vas kontakt telefon', 'required'=>'required')); ?>
                <span class="input-group-addon "><span class="glyphicon glyphicon-plus add_field_button" ></span></span>
                </div>
            </td>
        </tr>       
    </table>
<div id="ispis"></div>
<input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
<?php print form_close(); ?>
</div>

