<?php
    global $openup_option;    


?>
<div class="footer-bottom">
    <div class="container">
        <div class="copyright_border">
            
            <div class="copyright text-center" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                <?php if(!empty($openup_option['copyright'])){?>
                <p><?php echo wp_kses($openup_option['copyright'], 'openup'); ?></p>
                <?php }
                 else{
                    ?>
                <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                </p>
                <?php
                 }   
                ?>
            </div>
              
        </div>
    </div>
</div>


