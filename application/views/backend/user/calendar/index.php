<div class="col-md-12"><div class='col-md-3'>Brisanje:</div><div class='col-md-9'><input id="checkbox" name="my-checkbox" class='checkbox' type="checkbox" data-size="mini"></div></div>
<div class='col-md-12'><div class='col-md-6 action'>Akcija</div><div class='col-md-6 reserve'>Rezervisano</div></div>
<style>
    .calendar
    {
        font-family: Arial;
        for-size:12px;
    }
    table.calendar
    {
        margin:auto;
        border-collapse: collapse;
    }
    .row
    {
    height:50px;    
    }
    .header
    {
    background-color: #428bca;
    color:white;    
    }
    .calendar .row td:hover
    {
     background-color: #428bca;   
    }
    .calendar .highlight
    {
    font-weight: bold;
    font-size:18px;
    }
    .action
{
    background-color: #7400BD;
    color:white;
}
.reserve
{
    background-color: #d9534f;
}
</style>

<?php print $kalendar;?>

<script type="text/javascript">
    $(document).ready(function(){
        $("[name='my-checkbox']").bootstrapSwitch();
        
        var count = 0;
//        var provera=false;
        $(".akcija").parent().parent().addClass( "action" );
        $(".rezervisano").parent().parent().addClass( "reserve" );
//      $("#"+i+"").parent().css("background-color","#d9534f");
        var pocetak;
        var kraj;
        $(".day").one( "click",function(){
        var checkedValue = $('.checkbox:checked').val();
        if(!checkedValue)
        {
        if(count % 2 == 0){          
            pocetak=$(this).find(".day_num").html();
            $(".day").hover(function(e){
                kraj=$(this).find(".day_num").html();
                var razlika=kraj-pocetak;
                var k=pocetak;
                    for(var i=0;i<=razlika;i++)
                    {               
                       $("#"+k+"").parent().addClass( "reserve" );
                       k++;
                    }
            }, function(){
                kraj=$(this).find(".day_num").html();
                for(var j=31;j>kraj;j--)
                {            
                   $("#"+j+"").parent().removeClass( "reserve" );
                } 
            });
            
            count++;

        }else{
    $(".day").unbind('mouseenter');
        $("#myModala").modal('show');
        pocetak=strip(pocetak);
        kraj=strip(kraj);
        pocetak = pocetak.replace(/[^0-9]/g,'');
        kraj = kraj.replace(/[^0-9]/g,'');
        document.getElementById("datumod").value = pocetak;
        document.getElementById("datumdo").value = kraj;

            count++;
        }
    }
    else
    {
       if(count % 2 == 0){          
            pocetak=$(this).find(".day_num").html();
            $(".day").hover(function(e){
                kraj=$(this).find(".day_num").html();
                var razlika=kraj-pocetak;
                var k=pocetak;
                    for(var i=0;i<=razlika;i++)
                    {   
                       $("#"+k+"").parent().removeClass( "action" );            
                       $("#"+k+"").parent().removeClass( "reserve" );
                       k++;
                    }
            }, function(){
                kraj=$(this).find(".day_num").html();
                for(var j=31;j>kraj;j--)
                {            
                   $("#"+k+"").parent().removeClass( "action" );            
                   $("#"+k+"").parent().removeClass( "reserve" );
                } 
            });
            
            count++;

        }else{
           $(".day").unbind('mouseenter');
           document.getElementById("obrisiod").value = pocetak;
           document.getElementById("obrisido").value = kraj;
           $("#brisanje").click();
        } 
    }
});
function provera()
{
    
}
        });
//        $(".day").one( "click",function(){
//            var ids=$(this).find(".content").children().val();
//            var day_num=$(this).find(".day_num").html();
//             
//
//
//            if(day_num!=null && provera==false)
//            {
//            var day_data=prompt("Unesi Ime:");
//            if(day_data!=null)
//            {
//                $.ajax({
//                method: "POST",
//                url: window.location,
//                data: { day: day_num, ime_prezime: day_data ,kalendar_id : ids}
//              })
//                .done(function( msg ) {
//                location.reload();
//              });
//            }       
//            }
//           
//        });
//        $(".close").one( "click",function(){
//            provera=true;
//            var ids=$(".day").find(".content").children().val();
//            var day_num=$(".day").find(".day_num").html();
//            
//            
//            if(day_num!=null)
//            {
//                $.ajax({
//                method: "POST",
//                url: window.location,
//                data: { obrisi : ids}
//              })
//                .done(function( msg ) {
//                location.reload();
//        
//              });
//                  
//            }
//            
//            
//            
//            
//            
//        });

//    });
function strip(html)
{
   try {
       var doc = document.implementation.createDocument('http://www.w3.org/1999/xhtml', 'html', null);
       doc.documentElement.innerHTML = html;
       return doc.documentElement.textContent||doc.documentElement.innerText;
   } catch(e) {
       return "";
   }
}


</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModala">
  <div class="modal-dialog">
    <div class="modal-content">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Unos</h4>
      </div>
        <?php $attributes = array('class' => 'form', 'id' => 'myform',"onsubmit"=>"provera()");
        print form_open(current_url(),$attributes);?>
      <div class="modal-body">
          
          <input type='hidden' id='datumod' name="datumod"/>
          <input type='hidden' id='datumdo' name="datumdo"/>
            <div class="form-group">
                <label for="status">status</label>
                <?php $options = array(
                    '0'=>'Izaberite',
                  '1'  => 'Rezervisano',
                  '2'    => 'Akcija',
                );
                    $css="class='form-control' name='status'";

print form_dropdown('status', $options,'0',$css);?>
            </div>
            <div class="form-group">
                <label for="name">Ime i Prezime</label>
                <input type="text" class="form-control" id="name" name="nameandsur" placeholder="Ime i prezime">
            </div>
            <div class="form-group">
                <label for="price">Cena</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Cena">
            </div>                      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Sacuvaj</button>
      </div>
        <?php form_close();?>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php

print form_open(current_url());
?>
<input type="hidden" class="form-control" id="obrisiod" name="obrisiod" >
<input type="hidden" class="form-control" id="obrisido" name="obrisido">
<button type="submit" class="btn btn-primary hidden" id='brisanje'>Sacuvaj</button>
<?php
print form_close();
?>