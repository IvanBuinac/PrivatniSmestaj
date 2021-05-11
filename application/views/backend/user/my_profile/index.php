<h2>Izmena profila <?php print $korisnik->ime." ".$korisnik->prezime; ?></h2>
<br/><br/><br/>

<?php print form_open($jezik.'/korisnik/moj_profil/sacuvaj',array('role'=>"form",'class'=>"form-horizontal"))?>
    <table class="table">
        <tr>
            <td>Ime:</td>
            <td><?php print form_input(array('name'=>'ime','class'=>'form-control','placeholder'=>'Unesite vase ime', 'required'=>'required'), set_value('ime', isset($korisnik->ime) ?  $korisnik->ime:'')); ?></td>
        </tr>
        <tr>
            <td>Prezime:</td>
            <td><?php print form_input(array('name'=>'prezime','class'=>'form-control','placeholder'=>'Unesite vase prezime', 'required'=>'required'), set_value('prezime', isset($korisnik->prezime) ?  $korisnik->prezime:'')); ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php print form_input(array('name'=>'email','class'=>'form-control','placeholder'=>'Unesite vase prezime', 'type'=>'email', 'required'=>'required'), set_value('email', isset($korisnik->email) ?  $korisnik->email:'')); ?>(u koliko menjate email, dobicete link na taj email da potvrdite promenu)</td>
        </tr>
        <tr>
            <?php $grad=$this->grad_m->get_by(array("grad_id"=>$korisnik->grad),TRUE);
            $drzave=$this->drzava_m->get();
            $drz=array();
            foreach ($drzave as $drzava)
            {
                $drz["$drzava->drzava_id"]=$drzava->naziv;
            }
            $gradovi=$this->grad_m->get_by(array('drzava_id'=>$grad->drzava_id));
            $grd=array();
            foreach ($gradovi as $grod)
            {
                $grd["$grod->grad_id"]=$grod->naziv;
            }
            ?>
            <td>Drzava:</td>
            <td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava'";
            print form_dropdown("drzava", $drz , $grad->drzava_id ,$datas); ?></td>
        </tr>
        <tr>
            <td>Grad:</td>
            <td><?php $datas = "class='form-control' id='grad'";
            print form_dropdown("grad", $grd , $grad->grad_id ,$datas); ?></td>
        </tr>
        <?php if(!empty($korisnik_kontakt)){?>
            <?php foreach ($korisnik_kontakt as $kontakt){?>
                <tr>
                    <td>Telefon:</td>
                    <td><?php print form_input(array('name'=>'telefon[]','class'=>'form-control col-md-3','placeholder'=>'Unesite vas kontakt telefon', 'required'=>'required'), set_value('telefon[]',  $kontakt->telefon)); ?></td>
                </tr>
            <?php }?>
        <?php } else {?>
        <tr>
            <td>Telefon:</td>
            <td><?php print form_input(array('name'=>'telefon[]','class'=>'form-control span2','placeholder'=>'Unesite vas kontakt telefon', 'required'=>'required')); ?></td>
        </tr>
        <?php }?>
        <tr> 
            <td><a href="<?php print base_url()."$jezik";?>/korisnik/moj_profil/password" title="promena passworda" class="btn btn-info">Promeni password</a></td>
            <td><input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/></td>
        </tr>
        

    </table>
<?php print form_close(); ?>

