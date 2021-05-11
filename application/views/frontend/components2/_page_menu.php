<?php

?>
<nav class="navbar navbar-default navbar-fixed-top" style="margin: 0px;">
    <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="<?php print base_url();isset($jezik)?print $jezik:NULL;?>"><img src="<?php print base_url()."img/logos/PrivatniSmestaj-mini.png"?>" class="pull-left" alt="<?Php print $site_name;?>"/><h1 class="pull-left" style="font-size:20px;margin-top:7px;color:#1171A3;"><?php print $site_name;?></h1></a>
        <div class="clearfix"></div>    
    </div>
    <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
              <li role="presentation" class="dropdown">
    <a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <?php print translate("Informacije",$jezik);?> <span class="caret"></span>
    </a>
<!--                  <div id="google_translate_element" class="hidden"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'sr'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
    <ul class="dropdown-menu">
        
        <?php
//        print "<li><a href='".base_url().$jezik."/informacije/o_nama' title='".translate("O nama", $jezik)."' >".translate("O nama", $jezik)."</a></li>";
        print "<li><a href='".base_url().$jezik."/informacije/kontakt' title='".translate("Kontakt", $jezik)."' >".translate("Kontakt", $jezik)."</a></li>";
//        print "<li><a href='".base_url().$jezik."/informacije/marketing' title='".translate("Marketing", $jezik)."' >".translate("Marketing", $jezik)."</a></li>";
        print "<li><a href='".base_url().$jezik."/informacije/uslovikoriscenja' title='".translate("Uslovi koriscenja", $jezik)."' >".translate("Uslovi koriscenja", $jezik)."</a></li>";
        ?>
    </ul>
  </li>
               <?php
                   
               if($ulogovan == TRUE)
               {
                   if($this->korisnik_m->get_privilege_id()==1)
                        print "<li><a href='".base_url().$jezik."/admin/dashboard' title=".translate("Administracija Smestaja", $jezik).">".translate("Administracija Sajta", $jezik)."</a></li>";
                        print "<li><a href='".base_url().$jezik."/korisnik/dashboard' title=".translate("Administracija Smestaja", $jezik).">".translate("Administracija Smestaja", $jezik)."</a></li>";
                        print "<li><a href='".base_url().$jezik."/login/logout' title='Logout'>Logout</a></li>";

                       
               }
               else
               {
               ?>
              <li class="dropdown">
			<a class="dropdown-toggle btn btn-default" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="icon-enter"></span><?php print translate("Prijavi se", $jezik)?><span class="caret"></span>
			</a>
			<ul style="padding:20px;" class="dropdown-menu" role="menu">
			    <li>
			    	<div class="row col-lg-12">
					    <div class="col-lg-12 col-md-12">
						<hr class="left visible-desktop">
					    </div>
					    <div class="col-lg-12 col-md-12">
                                               <?php $error=$this->session->flashdata('error');
                                                    if (isset($error)) {
                                                        print $error;
                                                    }
                                                    
                                                        ?>
					        <?php print form_open('login_k/login',array('class'=>'navbar-form'));?>
                                                        <div class="form-group">
                                                            <label for="email"><?php print translate("E-mail adresa", $jezik) ?></label>
                                                        <?php print form_input(array('type'=>'email','class'=>"form-control ",'placeholder'=>translate("E-mail adresa", $jezik),'required'=>'required','name'=>'email1',"id"=>"email")); ?>
					          	</div>			          
					          	<div class="form-group">
					            	<label for="password"><?php print translate("Lozinka", $jezik) ?></label>
					            	 <?php print form_input(array('type'=>'password','class'=>"form-control ",'placeholder'=>translate("Lozinka", $jezik),'required'=>'required','name'=>'password1',"id"=>"password")); ?>
                                                        <span class="help-block"><a href='#' data-toggle="modal" data-target="#myModal1"><?php print translate("Zaboravili ste lozinku?", $jezik)?> </a></span>
					          	</div>
                                                        <?php print form_submit(array('type'=>'submit','name'=>'btnLoginn','value'=>translate("Prijavi se", $jezik),'class'=>'btn btn-success pr_modal_login' )); ?>
					          	
					        <?php print form_close();?>
                                                <hr>
                                                <?php 
                                                if(isset($facebook_login_url))
                                                print "<a href='$facebook_login_url' tite='sign in with facebook'><img src='".  base_url()."img/facebook-sign-in.png' alt='sign in with facebook' class='col-md-12'></a>";
                                                if(isset($twitter_login_url))
                                                print "<a href='$twitter_login_url' tite='sign in with twitter'><img src='".  base_url()."img/twitter-sign-in.png' alt='sign in with twitter'  class='col-md-12'></a>";
                                                if(isset($google_login_url))
                                                print "<a href='$google_login_url' tite='sign in with google'><img src='".  base_url()."img/google-sign-in.png' alt='sign in with google'  class='col-md-12'></a>";     
                                                ?>
					        <div class="clearfix"></div>
					        <div style="margin-top:15px;display:none;" class="alert alert-danger" id="loginmsg"></div>
                                                
					    </div>
					</div>
				</li>
			</ul>

        </li>
        <?php print "<li><a href='".base_url()."$jezik/registracija' title='".translate("Registruj se", $jezik)."' class='btn btn-primary' style='color:white;'>".  translate("Registruj se", $jezik)."</a></li>";?>
                
                 
                
                
                
               <?php  
               }
                ?>
        <li>
               <?php if($jezik=="sr"){?>
               <a class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php print base_url()."img/sr.png"?>" alt="Srpski"/><span class="caret"></span></a> 
<!--                <ul class="dropdown-menu" role="menu">
                        <?php $putanja1=uri_string();
                        $delov1i=  explode("/", $putanja1);
                        $cela= "";
                                for($i=1;$i<count($delov1i);$i++)
                                {
                                    $cela.=$delov1i[$i]."/";
                                }
                               
                        ?>
                   <li><a href="<?php print base_url()."en/".$cela;?>"><img src="<?php print base_url()."img/uk.png";?>" alt="English"/>Engleski</a></li> 
                </ul>-->
               <?php }else if($jezik=="en"){?>
               <a class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-expanded="false"><img src="//<?php print base_url()."img/uk.png"?>" alt="English"/><span class="caret"></span></a> 
<!--                <ul class="dropdown-menu" role="menu">
                        //<?php $putanja1=uri_string();
//                        $delov1i=  explode("/", $putanja1);
//                        $cela= "";
//                                for($i=1;$i<count($delov1i);$i++)
//                                {
//                                    $cela.=$delov1i[$i]."/";
//                                }
//                                
//                        ?>
                    <li><a href="//<?php print base_url()."sr/".$cela;?>"><img src="<?php print base_url()."img/sr.png";?>" alt="Srpski">Serbian</a></li>
                </ul>-->
               <?php }?>
            </li>
            
          </ul>
        </div><!--/.nav-collapse -->
    
    </nav>

<div class="clearfix"></div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php  print form_open("",array('class'=>'navbar-form'))?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="Mail">Unesi e-mail</p>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="email"><?php print translate("E-mail adresa", $jezik) ?></label>
            <?php print form_input(array('type'=>'email','class'=>"form-control ",'placeholder'=>translate("E-mail adresa", $jezik),'required'=>'required','name'=>'emailll',"id"=>'emaill')); ?>
        </div>                       
      </div>
      <div class="modal-footer">
        <?php print form_submit(array('type'=>'submit','name'=>'btnEmail','value'=>translate("Promeni mail", $jezik),'class'=>'btn btn-success pr_modal_login' )); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        <?php print form_close();?>
    </div>
  </div>
</div>


