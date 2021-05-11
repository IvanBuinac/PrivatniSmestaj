 <?php
$text="$(document).ready(function(){".'$'."(function() { 
    var availableTags = ["?>
        <?php if(!empty($drzave)){?>
    <?php foreach($drzave as $key1 =>$drzava){?>
                <?php 
                        $objekti=$this->objekat_m->get();
                        $lista=array();
                        $vrednost=array();
                        if(!empty($objekti))
                        {
                            foreach ($objekti as $objekat)
                            {   
                                $vrednosti=array();
                                $grad=$this->grad_m->get_by(array('grad_id'=>$objekat->grad_id,'drzava_id'=>$drzava->drzava_id,'status'=>1),TRUE);
                                if(!empty($grad))
                                {
                                       array_push($lista, $grad->grad_id);                                   
                                }
                                
                            }
                        }
                        ?>
                <?php if(!empty(count($lista))){?>
                    <?php 
                        
                        if(!empty($lista))
                        {
                            $gradovi=$this->grad_m->get_by_in(array('grad_id'=>$lista,'drzava_id'=>$drzava->drzava_id));
                            foreach($gradovi as $grad)
                            {
                                $text.= "{\n";
                $text.= "value : '$drzava->putanja/$grad->putanja',\n";
                $text.= "label : '$drzava->naziv $grad->naziv',\n";
                $text.= "icon : '$drzava->naziv',\n";
                $text.= "},\n";
                            }
                            

                        }
                }
    }
                    ?>
    <?php }?>
<?php $text.=" ];
    $( '.search' ).autocomplete({
      minLength: 0,
      source: availableTags,
      focus: function( event, ui ) {
        $( '.search' ).val( ui.item.label );
        $( '.putanja' ).val( ui.item.value);
        return false;
      },
      select: function( event, ui ) {
        $( '.search' ).val( ui.item.label);
        $( '.putanja' ).val( ui.item.value);
        return false;
      }
    });
    
    });
    });";
make_new_file("ostalijs/search", $text, "js", NULL);


?>



  <header class="col-md-12 header" style="padding:0px;">
      <div class="embed-responsive-16by9 video-container">
        <video autoplay preload loop class="embed-responsive-item video">
            <?php $date = date('Y-m-d');
            $date=date_parse_from_format("Y-m-d", $date);
            $month=preg_replace('/^0/', '',$date["month"]);
            if($month>=4 && $month<=10)
            { 
            ?>
            <source src="<?php print base_url()."video/".str_replace(' ', '', normalize($site_name))."_Leto.webm";?>" type="video/webm">
            
            <?php print translate("Vaš pretrazivač ne podržava HTML 5", $jezik)?>
            <?php }else{?>
            <source src="<?php print base_url()."video/".str_replace(' ', '', normalize($site_name))."_Zima.webm";?>" type="video/webm">
            <?php print translate("Vaš pretrazivač ne podržava HTML 5", $jezik)?>
            <?php }?>
        </video> 
    </div>
          <?php $text1="function pretrazi()
          {
              
              var putanja=document.getElementById('putanja').value;
              
              var od=document.getElementsByName('od[]'); 
              var do1=document.getElementsByName('do[]'); 
              var lezaja=document.getElementsByName('lezaja[]'); 
              var kon=0;
            

            for(var t=0;t<od.length;t++)
            {
            if(od[t].value!='')
            {
            if(putanja!=null)
                {
                    for(var y=0;y<do1.length;y++)
                    {
                        if(do1[y].value!='')
                        {
                        
                            for(var e=0;e<lezaja.length;e++)
                            {
                                if(lezaja[e].value!='')
                                {
                                kon=1;
                                location.href='".base_url()."$jezik/'+putanja+'?od='+od[t].value+'&do='+do1[y].value+'&lezaja='+lezaja[e].value; 
                                    
                                }
                                else if(kon==0 && lezaja[e].value=='')
                                {
                                kon=1;
                                location.href='".base_url()."$jezik/'+putanja+'?od='+od[t].value+'&do='+do1[y].value;
                                }
                            }
                        
                        }
                        
                    }
                }
            }

            }
            if(putanja!=null && kon==0)
            {
            location.href='".base_url()."$jezik/'+putanja;
            } 
                  
          }";
          $text1.="$(function () {
                    $('#datetimepicker').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
                    $('#datetimepickerr').datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false //Important! See issue #1075
                    });
                    $('#datetimepicker').on('dp.change', function (e) {
                        $('#datetimepickerr').data('DateTimePicker').minDate(e.date);
                    });
                    $('#datetimepickerr').on('dp.change', function (e) {
                        $('#datetimepicker').data('DateTimePicker').maxDate(e.date);
                        
                    });
                });";
          $text1.="$(function () {
                    $('#datetimepicker1').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
                    $('#datetimepickerr1').datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false //Important! See issue #1075
                    });
                    $('#datetimepicker1').on('dp.change', function (e) {
                        $('#datetimepickerr1').data('DateTimePicker').minDate(e.date);
                    });
                    $('#datetimepickerr1').on('dp.change', function (e) {
                        $('#datetimepicker1').data('DateTimePicker').maxDate(e.date);
                    });
                });";
            make_new_file("ostalijs/pretraga", $text1, "js", NULL);
          ?>
    <div class="cover-heading">
            <div class="Welcome">
                <h2 style="text-align:center;" class="title"><?php print translate("Pronađite najbolji smeštaj za vaš odmor", $jezik)?></h1>
                <h3 style="text-align:center;" class="subtitle"><?php print translate("Apartmani, sobe, kuće - sve na jednom mestu", $jezik)?></h2>
            </div>
        <div class="row hidden-lg hidden-md searchbox-sm ui-widget col-xs-12"  style="z-index: 1000;">
                 <div class="input-group col-md-4 pull-left">
                    <input type="text" class="form-control search" placeholder="<?php print translate("Gde Hoćete da idete?", $jezik);?>" />
                    <input type="hidden" class="form-control putanja" id="putanja"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search" aria-hidden="true" ></span>
                    </span>
                 </div>
                 <div class="input-group col-md-3 pull-left" >
                     <input type='text' class='form-control ' name='od[]' placeholder='od datuma' id='datetimepicker'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                 <div class="input-group col-md-3 pull-left" >
                     <input type='text' class='form-control' name='do[]' placeholder='do datuma' id='datetimepickerr'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                <div class="input-group col-md-3 pull-left">
                     <input type='text' class='form-control' name='lezaja[]' placeholder='lezaja' ><span class='input-group-addon'></span>
                 </div>
                <button type="submit" class="btn btn-success col-xs-12" onclick="pretrazi();">Pretrazi</button>
            </div>
        <div class="bottom hidden-xs hidden-sm">
            <div class='container searchbox-lg scroller'>
            <div class=" input-group ui-widget col-md-4 pull-left">
                <input type="text" class="form-control search"  placeholder="<?php print translate("Gde Hocete da idete?", $jezik);?>" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search" aria-hidden="true" ></span>
                </span>
            </div>

                 <div class="  input-group col-md-3 pull-left date">
                     <input type='text' class='form-control' name='od[]' placeholder='od datuma' id='datetimepicker1'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                 <div class="  input-group col-md-3 pull-left date">
                     <input type='text' class='form-control' name='do[]' placeholder='do datuma' id='datetimepickerr1'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                <div class="input-group col-md-1 pull-left">
                     <input type='text' class='form-control' name='lezaja[]' placeholder='lezaja' />
                 </div>
                <button type="submit" class="btn btn-success col-md-1" onclick="pretrazi();">Pretrazi</button>
            </div>
        </div>
        </div>
</header>
  <div class="clearfix"></div>
  <section class="col-md-12 section" style="margin:0px;padding:0px;">
<?php 
if($this->session->flashdata('message'))
        {
           print $this->session->flashdata('message'); 
        }
?>  