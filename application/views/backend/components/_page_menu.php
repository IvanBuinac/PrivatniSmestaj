<nav class="navbar navbar-inverse navbar-fixed-top">
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
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
               <?php $jezik=$this->uri->segment(1);?>
               <?php
                print get_menu ($links,$jezik); 
                ?>
                
           
          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    
               <?php if($jezik=="sr"){?>
               <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php print base_url()."img/sr.png"?>" alt="Srpski"><span class="caret"></span></a> 
                <!--<ul class="dropdown-menu" role="menu">-->
                        <?php $putanja1=uri_string();
                        $delov1i=  explode("/", $putanja1);
                        $cela= "";
                                for($i=1;$i<count($delov1i);$i++)
                                {
                                    $cela.=$delov1i[$i]."/";
                                }
                               
                        ?>
                    <!--<li><a href="<?php print base_url()."en/".$cela;?>"><img src="<?php print base_url()."img/uk.png";?>" alt="English"> English</a></li>-->
                <!--</ul>-->
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
<div class='container' style="margin-top:150px;margin-bottom:150px;">
<div class="<?php if($signle==FALSE)
    {
    print 'col-md-8';
    }
 else 
    {
    print 'col-md-10';   
    }
    ?>">

