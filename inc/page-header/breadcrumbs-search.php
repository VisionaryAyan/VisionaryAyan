<div class="reactheme-breadcrumbs  porfolio-details">  
  <?php 
    $openup_option = get_option( 'openup_option' );    
    if(!empty($openup_option['blog_banner_main']['url'])) { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($openup_option['blog_banner_main']['url']);?>')">
    <?php }
    elseif(!empty($openup_option['breadcrumb_bg_color'])) { ?>
      <div class="breadcrumbs-single" style="background:<?php echo esc_attr($openup_option['breadcrumb_bg_color']);?>">
      <?php }
    else { ?>
        <div class="breadcrumbs-single">
    <?php } ?>
      <div class="reactheme-breadcrumbs-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">
              <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'openup' ), '<span>' . get_search_query() . '</span>' ); ?></h1>            
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>