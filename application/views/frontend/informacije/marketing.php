<div class="container">
    <?php if(isset($usluge)){?>
    <?php foreach($usluge as $usluga){?>
        <div class="row col-md-12">
            <h2><?php print $usluga->naziv;?></h2>
            <p><?php print $usluga->opis;?></p>
            <div class="col-md-12">
                <form action='<?php print base_url().$jezik."/marketing/Set_express_checkout"?>' METHOD='POST'>
<input type="hidden" value="<?php print $usluga->cena;?>" name="amt" />
<input type="hidden" value="<?php print $usluga->naziv;?>" name="name" />
<input type="hidden" value="<?php print $usluga->opis;?>" name="description" />
<select name="PaymentOption">
    <option value='0'>Izaberite...</option>
    <option name='Paypal'>Paypal</option> 
    <option value='MasterCard'>MasterCard</option>
    <option value='Visa'>Visa</option>
    <option value='Amex'>Amex</option>
    <option name='Discover'>Discover</option> 
</select>
<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
</form>

            </div>
        </div>
    <?php }}?>
</div>