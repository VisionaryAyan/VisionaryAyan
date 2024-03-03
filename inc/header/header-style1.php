  <?php

/*
Header Style 1
*/
$openup_option = get_option( 'openup_option' ); 
$sticky             = !empty($openup_option['off_sticky']) ? $openup_option['off_sticky'] : ''; 
$sticky_menu        = ($sticky == 1) ? ' menu-sticky' : '';
$drob_aligns        = (!empty($openup_option['drob_align_s'])) ? 'menu-drob-align' : '';
$mobile_hide_search = (!empty($openup_option['mobile_off_search'])) ? 'mobile-hide-search' : '';
$mobile_hide_cart   = (!empty($openup_option['mobile_off_cart'])) ? 'mobile-hide-cart-no' : 'mobile-hide-cart';
$mobile_hide_button = (!empty($openup_option['mobile_off_button'])) ? 'mobile-hide-button' : '';
$mobile_logo_height = !empty($openup_option['mobile_logo_height']) ? 'style = "max-height: '.$openup_option['mobile_logo_height'].'"' : '';

// Header Options here
require get_parent_theme_file_path('inc/header/header-options.php');
//off convas here
get_template_part('inc/header/off-canvas');
?> 

<!-- Mobile Menu Start -->
<div class="responsive-menus"><?php require get_parent_theme_file_path('inc/header/menu-single.php');?></div>
<!-- Mobile Menu End -->

<?php if ( has_nav_menu( 'menu-1' ) ) {
    $menugap_minus = 'menugap-minus';
}else{
    $menugap_minus = '';
}

    //include sticky search here
    get_template_part('inc/header/search');
?>

<!-- Header Menu Start -->  
<?php
$menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
?>   
<div class="menu-area menu_type_<?php echo esc_attr($main_menu_type);?>" <?php echo wp_kses($menu_bg_color, 'axela');?>>    
    <div class="menu_one">
            <div class="row-table"> 
            <div class="col-cell header-logo">
                <?php 
                 if (!empty( $openup_option['wplogo_mobile_rt']['url'] ) ) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses($mobile_logo_height, 'axela');?> src="<?php echo esc_url( $openup_option['wplogo_mobile_rt']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
                <?php }else{
                 get_template_part('inc/header/logo'); 
                } ?>
            </div>  
                    
            <div class="col-cell menu-responsive primary-menu">  
                <?php                  
                    if(is_page_template('page-single.php')){
                        require get_parent_theme_file_path('inc/header/menu-single.php'); 
                    }else{
                        require get_parent_theme_file_path('inc/header/menu.php'); 
                    }               
                ?>
            </div>            

            <div class="col-cell header-quote">            
                
                <?php 
                if($rs_top_search != 'hide'){
                  if(!empty($openup_option['off_search']) || ($rs_top_search == 'show') ): ?>
                    <div class="sidebarmenu-search text-right">
                        <div class="sidebarmenu-search">
                            <div class="sticky_search"> 
                              <i class="rt-magnifying-glass"></i> 
                            </div>
                        </div>
                    </div> 
                  <?php endif; 
                }                                                  

               if($rs_offcanvas != 'hide'):
                  if(!empty($openup_option['off_canvas']) || ($rs_offcanvas == 'show') ): ?>
                  <div class="sidebarmenu-area text-right desktop">
                    <?php if(!empty($openup_option['off_canvas']) || ($rs_offcanvas == 'show') ){
                            $off = $openup_option['off_canvas'];
                            if( ($off == 1) || ($rs_offcanvas == 'show') ){
                       ?>
                        <ul class="offcanvas-icon">
                            <li class="nav-link-container"> 
                                <a href='#' class="nav-menu-link menu-button">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="14" width="18" height="2" fill="#ffffff"></rect>
                                <rect y="7" width="18" height="2" fill="#ffffff"></rect>
                                <rect width="18" height="2" fill="#ffffff"></rect>
                            </svg>                                      
                                </a> 
                            </li>
                        </ul>
                        <?php } 
                    }?> 
                  </div>
                <?php endif; endif; ?>

                
                <div class="sidebarmenu-area text-right primary-menu mobilehum">                                    
                    <ul class="offcanvas-icon">
                        <li class="nav-link-container"> 
                            <a href='#' class="nav-menu-link menu-button">
                               <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect y="14" width="18" height="2" fill="#ffffff"></rect>
                                    <rect y="7" width="18" height="2" fill="#ffffff"></rect>
                                    <rect width="18" height="2" fill="#ffffff"></rect>
                                </svg>                                     
                            </a> 
                        </li>
                    </ul>                                       
                </div>                

            </div> 
        </div>
    </div>    
</div> 
