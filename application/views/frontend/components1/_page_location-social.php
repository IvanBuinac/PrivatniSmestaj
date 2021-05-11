<div class="container" style="margin-top:70px;">
    <div class='header'>
        
        <ol class="breadcrumb pull-left">
            <li><div class="fb-like pull-left" data-href="<?php print base_url();?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
            <li><div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php print base_url();?>"></div></li>
        </ol>
        <ol class="breadcrumb  pull-right">
            <li><a href="<?php print base_url()."$jezik";?>" title="početna" ><?php print translate("Početna",$jezik)?></a></li>
            <?php
            $segs = $this->uri->segment_array();
            if(count($segs))
            {
            foreach ($segs as $key => $segment)
            {
                if($key>1)
                {
                $p=0;
                $broj=count($segs);
                
                print "<li";
                if($broj==$key)
                {
                    print " class='active' title='$segment'>$segment</li>";
                }
                
                else
                {
                print "><a href='".base_url()."";
                for($i=0;$i<$key;$i++)
                {
                    
                    $p =$i+1;
                    if($p>1)
                    {
                        print "/";
                    }
                    print $this->uri->segment($p);
                    
                }
                
                print "' title='$segment'>".translate($segment, $jezik)."</a></li>";
                }
                }
            }
            }
            ?>
        </ol>
    </div>
</div>