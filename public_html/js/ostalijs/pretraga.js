function pretrazi()
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