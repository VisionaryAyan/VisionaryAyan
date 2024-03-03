<?php
 $openup_option = get_option('openup_option');
  $header_trans = '';
    if(!empty($openup_option['header_layout'])){               
        $header_style = $openup_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }
?>

<div class="reactheme-breadcrumbs porfolio-details <?php echo esc_attr($header_trans);?>">
    <?php  if(is_post_type_archive('events')){
        $archive_banner = !empty($openup_option['event_banner_main']['url']) ? $openup_option['event_banner_main']['url'] : '';
    }
    
    else{
        $archive_banner = !empty($openup_option['blog_banner_main']['url']) ? $openup_option['blog_banner_main']['url'] : '';
    }

    if(!empty($openup_option['show_banner__course'])):
      $archive_banner = $openup_option['show_banner__course'];
    endif;

   if(!empty($archive_banner)) { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($archive_banner);?>')">
      <div class="container">
        <div class="breadcrumbs-inner">
            <div class="row">
              <div class="col-lg-12">             

                
                    <div class="col-lg-12">
                        <?php if(!empty($openup_option['off_breadcrumb'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }   ?>
                    </div>
                    <?php if (empty($openup_option['show_banner__course'])) {
                    if(!empty($openup_option['event_info']) && is_post_type_archive('events')){
                        echo '<h1 class="page-title a">'.esc_html($openup_option['event_info']).'</h1>';
                            if( !empty($openup_option['off_breadcrumb_event'])){
                                if(function_exists('bcn_display')){?>
                                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                                <?php } 
                            }                 
                        }
                        elseif(!empty($openup_option['notice_info']) && is_post_type_archive('notices')){
                        echo '<h1 class="page-title b">'.esc_html($openup_option['notice_info']).'</h1>';  
                        if(!empty($openup_option['off_breadcrumb_notice'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }                 
                        } else {
                        the_archive_title( '<h1 class="page-title c">', '</h1>' );
                        
                    } 
                }          
                ?>   
                </div>
              </div>
            </div>
      </div>
    </div>
  <?php }
  else{   
  ?>
  <div class="reactheme-breadcrumbs-inner">  
    <div class="container">
        <div class="breadcrumbs-inner">
            <div class="row">
              <div class="col-lg-12">              

                <?php if (empty($openup_option['show_banner__course'])) {
                    if(!empty($openup_option['event_info']) && is_post_type_archive('events')){
                        echo '<h1 class="page-title a">'.esc_html($openup_option['event_info']).'</h1>';
                            if( !empty($openup_option['off_breadcrumb_event'])){
                                if(function_exists('bcn_display')){?>
                                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                                <?php } 
                            }                 
                        }
                        elseif(!empty($openup_option['notice_info']) && is_post_type_archive('notices')){
                        echo '<h1 class="page-title b">'.esc_html($openup_option['notice_info']).'</h1>';  
                        if(!empty($openup_option['off_breadcrumb_notice'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }                 
                        } else {
                        the_archive_title( '<h1 class="page-title c">', '</h1>' );
                        
                    } 
                }          
                ?>   
                </div>
                    <div class="col-lg-12">
                        <?php if(!empty($openup_option['off_breadcrumb'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }   ?>
                    </div>
              </div>
            </div>
      </div>
    </div>
  </div>
  <?php
  }
?>  
</div>