
    $( document ).ready(function() {
        var width;
        var max_width;
        var max_height;
        width=document.getElementsByClassName('thumb');
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $('.thumb .thumbnail').css('background-color','#BDBFBF');
            $('.thumb .caption').css('background-color','#FFFFFF');      
            $('.img-thumb').css('max-width',max_width);
            $('.img-thumb').css('max-height',max_height);
        $( window ).resize(function() {
          width=document.getElementsByClassName('thumb');
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $('.thumb .thumbnail').css('background-color','#BDBFBF');
            $('.thumb .caption').css('background-color','#FFFFFF');
            $('.img-thumb').css('max-width',max_width);
            $('.img-thumb').css('max-height',max_height);  
        });
});// Carousel Auto-Cycle
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: false,
      pause:'hover',
    });
    $('.skiptranslate').remove();
  });
  $(document).ready(function(){$(function() { 
    var availableTags = [{
value : 'srbija/kopaonik',
label : 'Srbija Kopaonik',
icon : 'Srbija',
},
{
value : 'crna-gora/igalo',
label : 'Crna Gora Igalo',
icon : 'Crna Gora',
},
{
value : 'crna-gora/herceg-novi',
label : 'Crna Gora Herceg Novi',
icon : 'Crna Gora',
},
{
value : 'crna-gora/budva',
label : 'Crna Gora Budva',
icon : 'Crna Gora',
},
{
value : 'crna-gora/dobre-vode',
label : 'Crna Gora Dobre Vode',
icon : 'Crna Gora',
},
{
value : 'crna-gora/kotor',
label : 'Crna Gora Kotor',
icon : 'Crna Gora',
},
{
value : 'crna-gora/petrovac',
label : 'Crna Gora Petrovac',
icon : 'Crna Gora',
},
{
value : 'crna-gora/tivat',
label : 'Crna Gora Tivat',
icon : 'Crna Gora',
},
{
value : 'crna-gora/krasici',
label : 'Crna Gora Krašići',
icon : 'Crna Gora',
},
{
value : 'crna-gora/kumbor',
label : 'Crna Gora Kumbor',
icon : 'Crna Gora',
},
{
value : 'crna-gora/ulcinj',
label : 'Crna Gora Ulcinj',
icon : 'Crna Gora',
},
{
value : 'hrvatska/opatija',
label : 'Hrvatska Opatija',
icon : 'Hrvatska',
},
 ];
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
    });function pretrazi()
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
                                location.href='http://privatnismestaji.com/sr/'+putanja+'?od='+od[t].value+'&do='+do1[y].value+'&lezaja='+lezaja[e].value; 
                                    
                                }
                                else if(kon==0 && lezaja[e].value=='')
                                {
                                kon=1;
                                location.href='http://privatnismestaji.com/sr/'+putanja+'?od='+od[t].value+'&do='+do1[y].value;
                                }
                            }
                        
                        }
                        
                    }
                }
            }

            }
            if(putanja!=null && kon==0)
            {
            location.href='http://privatnismestaji.com/sr/'+putanja;
            } 
                  
          }$(function () {
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
                });$(function () {
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
                });