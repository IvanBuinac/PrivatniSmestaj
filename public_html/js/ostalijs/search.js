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
value : 'crna-gora/podgorica',
label : 'Crna Gora Podgorica',
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
    });