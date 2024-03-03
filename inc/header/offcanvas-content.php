<?php 

    global $openup_option;
    if(!empty($openup_option['facebook']) || !empty($openup_option['twitter']) || !empty($openup_option['rss']) || !empty($openup_option['pinterest']) || !empty($openup_option['google']) || !empty($openup_option['instagram']) || !empty($openup_option['vimeo']) || !empty($openup_option['tumblr']) ||  !empty($openup_option['youtube'])){
    ?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($openup_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($openup_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($openup_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($openup_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($openup_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($openup_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($openup_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($openup_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }