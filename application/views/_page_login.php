<div class="container">
      <?php echo validation_errors(); ?>
      <?php echo form_open('login',array('class'=>'form-signin','role'=>'form'));?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <?php echo form_input(array('type'=>'email','class'=>"form-control",'placeholder'=>"Email address",'required'=>'required','autofocus'=>'autofocus','name'=>'email')); ?>
        <label for="inputPassword" class="sr-only">Password</label>
        <?php echo form_input(array('type'=>'password','class'=>"form-control",'placeholder'=>"Password",'required'=>'required','name'=>'password')); ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <?php echo form_submit(array('type'=>'submit','name'=>'btnLogin','value'=>'Sing in','class'=>'btn btn-lg btn-primary btn-block' )); ?>
        
      <?php echo form_close();?>

    </div> <!-- /container -->