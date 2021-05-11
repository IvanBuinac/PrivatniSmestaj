</section>
<script type="text/javascript">
    function submittForm()
{
     document.getElementById('myForm').submit();
} 
    </script>
<footer class="footer" >
    <div class="footer-content">
        <div class="container">
            <div class='col-md-4'>
                <h4 style="text-align: center;"><?php print translate("Prijavite se za nase e-mail novosti", $jezik);?></h4>
                <p style="text-align: center;"><?php print translate("Budite obavesteni sa nasim novim Smestajima i Smestajnim jedinicama", $jezik);?></p>
                <?php print form_open("","class=form-horizontal id='myForm'");?>
                
                <?php $data = array(
              'name'        => 'get-e-mails',
              'maxlength'   => '100',
              'size'        => '50',
              'class'       => ' form-control'
            ); ?>
                 <div class="form-group get-emails">
                    <label for="InputEmail1">Email address</label>
                    <div class="input-group">
                    <?php print form_input($data);?>                      
                        <div class="input-group-addon">                         
                            <span  class="glyphicon glyphicon-chevron-right" onclick="submittForm();" id='InputEmail1'></span>
                        </div>
                    </div>
                </div>
                <?php print form_close();?>
            </div>
            <div class='col-md-4' >
                <h4 style="text-align: center;"><?php print translate("Budite povezani sa Privatni Smestaj", $jezik);?></h4>
                <div class='footer-social' style="text-align: center;">
                    <div class='row'>
                        <a href="<?php print $facebook_link;?>" title="facebook" target="_blank"><img src='<?php print base_url()."img/social/facebook.png";?>' alt='facebook'/></a>
                        <a href="<?php print $twitter_link;?>" title="twitter" target="_blank"><img src='<?php print base_url()."img/social/twiter.png";?>' alt='twitter' /></a>
                        <a href="<?php print $google_link;?>" title="google+" target="_blank"><img src='<?php print base_url()."img/social/google+.png";?>' alt='google+'/></a>
                    </div>
                    <div class='row' style="margin-top:-6px;">
                        <a href="<?php print $youtube_link;?>" title="youtube" target="_blank"><img src='<?php print base_url()."img/social/youtube.png";?>' alt='youtube'/></a>
                        <a href="<?php print base_url();?>rss.rss" title="rss" target="_blank"><img src='<?php print base_url()."img/social/rss.png";?>' alt='rss'/></a>
                    </div>
                </div>            
            </div>
            <div class='col-md-4'>
                <h4 style="text-align: center;"><?php print translate("Prijatelji sajta", $jezik);?></h4>            
                <?php if(isset($prijatelji_sajta))
                {
                        foreach($prijatelji_sajta as $kljuc => $prijatelji)
                        {
                            print "<div class='row' style='text-align: center;'><a href='$kljuc' title='$prijatelji'>$prijatelji</a></div>";
                        }
                }?>
            </div>
        </div>
    </div>
    <div class="footer-copyrights">
        <div class="container">
          <a class="navbar-brand" href="<?php print base_url();isset($jezik)?print $jezik:NULL;?>"><img src="<?php print base_url()."img/logos/PrivatniSmestaj-mini.png"?>" class="pull-left" alt="<?Php print $site_name;?>"/><h5 class="pull-left" style="font-size:20px;margin-top:7px;color:white;"><?php print $site_name;?></h5></a>
          <div class="clearfix"></div>
          <div class="build-by">
              <p class="pull-right" style="position:relative;top: 15px; color:#4a4a4a;">Build by Ivan Buinac &copy; <?php echo date('Y'); ?> <?php echo $site_name; ?></p>  
          </div>
          
        </div>
        
    </div>
      
</footer>
    <script type="text/javascript">
        function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}
$(document).ready(function() {
    var x;
    x=readCookie('cookie');
    if(x==null)
    {
    $("#facebookpage").modal();
    createCookie('cookie','true',1);
    
    }
});

    </script>
    <div class="modal fade" tabindex="-1" id="facebookpage" role="dialog" style="z-index: 4000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body  ">
          <div class="fb-page col-md-offset-2" data-href="https://www.facebook.com/PrivatniSmestaji/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/PrivatniSmestaji/"><a href="https://www.facebook.com/PrivatniSmestaji/">PrivatniSmestaj</a></blockquote></div></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


