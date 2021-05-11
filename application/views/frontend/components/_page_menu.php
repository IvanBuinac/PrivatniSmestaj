<nav class="navbar navbar-fixed-top" role="navigation" style="margin: 0px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php print base_url();?>"><?php print $site_name;?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
               <?php
               if($ulogovan == TRUE)
               {
                   if($this->korisnik_m->get_privilege_id()==1)
                        print "<li><a href='".base_url()."admin/dashboard' title='admin'>Administracija Sajta</a></li>";

                        print "<li><a href='".base_url()."korisnik/dashboard' title='administracija smestaja'>Administracija Smestaja</a></li>";
                        print "<li><a href='".base_url()."login/logout' title='administracija smestaja'>Logout</a></li>";

                       
               }
               else
               {
               ?>
                <?php print form_open('login_k/login',array('class'=>'navbar-form','role'=>'form'));?>
                <?php print form_input(array('type'=>'email','class'=>"form-control ",'placeholder'=>"Email address",'required'=>'required','autofocus'=>'autofocus','name'=>'email1')); ?>
                <?php print form_input(array('type'=>'password','class'=>"form-control ",'placeholder'=>"Password",'required'=>'required','name'=>'password1')); ?>  
                <?php print form_submit(array('type'=>'submit','name'=>'btnLoginn','value'=>'Sing in','class'=>'btn btn-primary ' )); ?>
                <?php print "<a href='".base_url()."registracija' title='administracija smestaja' class='btn btn-danger'>Registracija</a>";?>
                <?php print form_close();?>
               <?php  
               }
                ?>
           
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


