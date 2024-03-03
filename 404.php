<?php
wp_head();
$openup_option = get_option('openup_option');?>
<div class="page-error">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php if (!empty($openup_option['404_bg']['url'])) {?>
                            <img class="error-image"  src="<?php echo esc_url($openup_option['404_bg']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php }
                        else{ ?>
                            <h2>
                            <span>
                                <?php
                                    if (!empty($openup_option['title_404'])) {
                                        echo esc_html($openup_option['title_404']);
                                    } else {  
                                        echo esc_html__('404', 'openup');
                                    }
                                ?>
                            </span>                           
                        </h2>                 
                       <?php } 
                        ?>

                        <h2 class="opps-nothing">
                            
                            <?php
                                if (!empty($openup_option['text_404'])) {
                                    echo esc_html($openup_option['text_404']);
                                } else {
                                    echo esc_html__('Oops! Nothing Was Found', 'openup');
                                }
                            ?>
                        </h2>            
                        <p class="error-msg">
                            <?php echo esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'openup'); ?>
                            </p>
                        <a class="reacbutton" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                                if (!empty($openup_option['back_home'])) {
                                    echo esc_html($openup_option['back_home']);
                                } else {
                                    esc_html_e('Or back to homepage', 'openup');
                                }
                            ?>
                        </a>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- .page-error -->
<?php
wp_footer();
