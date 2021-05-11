<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin: 0px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php print base_url();isset($jezik)?print $jezik:NULL;?>"><?php print translate($site_name, $jezik);?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
               <?php
               if($ulogovan == TRUE)
               {
                   if($this->korisnik_m->get_privilege_id()==1)
                        print "<li><a href='".base_url()."admin/dashboard' title=".translate("Administracija Smestaja", $jezik).">".translate("Administracija Sajta", $jezik)."</a></li>";
                        print "<li><a href='".base_url()."korisnik/dashboard' title=".translate("Administracija Smestaja", $jezik).">".translate("Administracija Smestaja", $jezik)."</a></li>";
                        print "<li><a href='".base_url()."login/logout' title='Logout'>Logout</a></li>";

                       
               }
               else
               {
               ?>
              <li class="dropdown">
			<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="icon-enter"></span><?php print translate("Prijavi se", $jezik)?><span class="caret"></span>
			</a>
			<ul style="padding:20px;" class="dropdown-menu" role="menu">
			    <li>
			    	<div class="row col-lg-12">
					    <div class="col-lg-12 col-md-12">
						<hr class="left visible-desktop">
					    </div>
					    <div class="col-lg-12 col-md-12">
                                               
					        <?php print form_open('login_k/login/',array('class'=>'navbar-form','role'=>'form','charset'=>'UTF-8'));?>
                                                        <div class="form-group">
                                                            <label for="email"><?php print translate("E-mail adresa", $jezik) ?></label>
                                                        <?php print form_input(array('type'=>'email','class'=>"form-control ",'placeholder'=>translate("E-mail adresa", $jezik),'required'=>'required','autofocus'=>'autofocus','name'=>'email1')); ?>
					          	</div>			          
					          	<div class="form-group">
					            	<label for="password"><?php print translate("Lozinka", $jezik) ?></label>
					            	 <?php print form_input(array('type'=>'password','class'=>"form-control ",'placeholder'=>translate("Lozinka", $jezik),'required'=>'required','name'=>'password1')); ?>
                                                        <span class="help-block"><a href=''> <?php print translate("Zaboravili ste lozinku?", $jezik)?> </a></span>
					          	</div>
                                                        <?php print form_submit(array('type'=>'submit','name'=>'btnLoginn','value'=>translate("Prijavi se", $jezik),'class'=>'btn btn-success pr_modal_login' )); ?>
					          	
					        <?php print form_close();?>
					        <div class="clearfix"></div>
					        <div style="margin-top:15px; display:none;" class="alert alert-danger" id="loginmsg"></div>
					    </div>
					</div>
				</li>
			</ul>

        </li>
        <?php print "<a href='".base_url()."$jezik/registracija' title='".translate("Registruj se", $jezik)."' class='btn btn-primary navbar-btn pull-left'>".  translate("Registruj se", $jezik)."</a>";?>
                
                 
                
                
                
               <?php  
               }
                ?>
           <li>
               <?php if($jezik=="sr"){?>
               <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php print base_url()."img/sr.png"?>" alt="Srpski"><span class="caret"></span></a> 
                <ul class="dropdown-menu" role="menu">
                        <?php $putanja1=uri_string();
                        $delov1i=  explode("/", $putanja1);
                        $cela= "";
                                for($i=1;$i<count($delov1i);$i++)
                                {
                                    $cela.=$delov1i[$i]."/";
                                }
                               
                        ?>
                    <li><a href="<?php print base_url()."en/".$cela;?>"><img src="<?php print base_url()."img/uk.png";?>" alt="English"> English</a></li>
                </ul>
               <?php }else if($jezik=="en"){?>
               <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php print base_url()."img/uk.png"?>" alt="Engleski"><span class="caret"></span></a> 
                <ul class="dropdown-menu" role="menu">
                        <?php $putanja1=uri_string();
                        $delov1i=  explode("/", $putanja1);
                        $cela= "";
                                for($i=1;$i<count($delov1i);$i++)
                                {
                                    $cela.=$delov1i[$i]."/";
                                }
                                
                        ?>
                    <li><a href="<?php print base_url()."sr/".$cela;?>"><img src="<?php print base_url()."img/sr.png";?>" alt="Srpski"> Srkpski</a></li>
                </ul>
               <?php }?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    
    </nav>


