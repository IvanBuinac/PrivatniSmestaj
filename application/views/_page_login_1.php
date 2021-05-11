<div class="container">
      <?php echo validation_errors(); ?>
      <?php echo form_open('login',array('class'=>'form-signin','role'=>'form'));?>
        <h2 class="form-signin-heading">Sigurnost pre logovanja</h2>
        <label  class="sr-only">logovanje</label>
        <?php echo form_input(array('type'=>'text','class'=>"form-control",'placeholder'=>"Zastita za logovanje za admina",'required'=>'required','autofocus'=>'autofocus','name'=>'logovanje1')); ?>
        <label  class="sr-only">logovanje</label>
        <?php echo form_input(array('type'=>'password','class'=>"form-control",'placeholder'=>"Zastita za logovanje za admina",'required'=>'required','name'=>'pass1')); ?>
        <?php echo form_submit(array('type'=>'submit','name'=>'provera','value'=>'Provera','class'=>'btn btn-lg btn-primary btn-block' )); ?>
        
      <?php echo form_close();?>

    </div> <!-- /container -->