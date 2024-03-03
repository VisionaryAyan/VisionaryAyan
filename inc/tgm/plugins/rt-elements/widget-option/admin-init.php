<?php

class rt_Elements_Addon_Control {

    private $rtelements_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'rtelements_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'rtelements_page_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'rtelements_admin_scripts' ) );
        register_activation_hook( RTELEMENTS_FILE, [$this,'rseelements_plugin_activate'] );      
        
    }

    public function rtelements_admin_scripts(){
        wp_register_style('rtelements-admin-styles', RTELEMENTS_DIR_URL_PRO . 'widget-option/assets/css/rtelements-admin.css', array(), null );
        wp_enqueue_style('rtelements-admin-styles');
    }


    public function rtelements_add_plugin_page() {
        add_menu_page(
            'RTS Elements Setting',
            'RTS Elements',
            'manage_options',
            'rtelements-addon-settings',
            array( $this, 'rtselements_create_admin_page' ),
            'dashicons-superhero',
            6
        );
    }

    /**
     *
     */
    public function rtselements_create_admin_page() {
        $this->rtelements_options = get_option( 'rtelements_addon_option' );
        ?>
        <div class="wrap">
            <form class="rtelements-form" method="post" action="options.php">
                <?php
                settings_fields( 'rtelements_addon_group' );
                do_settings_sections( 'rtelements-addon-field' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }


    public function rtelements_page_init(){

        /**
         * Sanitize callback
         */
        register_setting(
            'rtelements_addon_group',
            'rtelements_addon_option',
            array( $this, 'rtelements_sanitize' )
        );

        

        add_settings_section(
            'rtelements_section_field_id',
            esc_html__( 'Disable Elements for better performance', 'rtelements' ),
            array( $this, 'rtelements_section_info' ),
            'rtelements-addon-field'
        );

       
        /**
         * Heading addon control
         */
        add_settings_field(
            'rt_heading',
            esc_html__( 'RT Heading', 'rtelements' ),
            array( $this, 'rtelements_heading_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Animated heading control
         */
        add_settings_field(
            'rt_animated_heading',
            esc_html__( 'RT Animated Heading', 'rtelements' ),
            array( $this, 'rtelements_animated_heading_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Animated heading control
         */
        add_settings_field(
            'rt_about_iamge',
            esc_html__( 'RT About Image', 'rtelements' ),
            array( $this, 'rtelements_about_image' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        /**
         * Image Showcase
         */
        add_settings_field(
            'rt_image_showcase',
            esc_html__( 'RT Image Showcase', 'rtelements' ),
            array( $this, 'rtelements_image_showcase_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        /**
         * Team Grid control
         */
        add_settings_field(
            'rt_team_gread',
            esc_html__( 'RT Team Grid', 'rtelements' ),
            array( $this, 'rtelements_team_gread_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        /**
         * Full Width Slider control
         */
        add_settings_field(
            'rt_team_slider',
            esc_html__( 'RT Team Slider', 'rtelements' ),
            array( $this, 'rtelements_team_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );


        /**
         * Full Width Slider control
         */
        add_settings_field(
            'rt_full_width_slider',
            esc_html__( 'RT Full Width Slider', 'rtelements' ),
            array( $this, 'rtelements_full_width_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        
        /**
         * Portfolio Grid
         */
        add_settings_field(
            'rt_portfolio_grid',
            esc_html__( 'RT Portfolio Grid', 'rtelements' ),
            array( $this, 'rtelements_portfolio_grid_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
       
        /**
         * Portfolio Slider
         */
        add_settings_field(
            'rt_portfolio_slider',
            esc_html__( 'RT Portfolio Slider', 'rtelements' ),
            array( $this, 'rtelements_portfolio_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Counter
         */
        add_settings_field(
            'rt_counter',
            esc_html__( 'RT Counter', 'rtelements' ),
            array( $this, 'rtelements_counter_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Services Grid
         */
        add_settings_field(
            'rt_service_grid',
            esc_html__( 'RT Services Grid', 'rtelements' ),
            array( $this, 'rtelements_service_grid_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Services Slider
         */
        add_settings_field(
            'rt_service_slider',
            esc_html__( 'RT Services Slider', 'rtelements' ),
            array( $this, 'rtelements_service_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Video
         */
        add_settings_field(
            'rt_video',
            esc_html__( 'RT Video', 'rtelements' ),
            array( $this, 'rtelements_video_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Pricing Table
         */
        add_settings_field(
            'rt_pricing_table',
            esc_html__( 'RT Pricing Table', 'rtelements' ),
            array( $this, 'rtelements_pricing_table_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
       
        /**
         * Button
         */
        add_settings_field(
            'rt_button',
            esc_html__( 'RT Button', 'rtelements' ),
            array( $this, 'rtelements_button_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Logo Showcase
         */
        add_settings_field(
            'rt_logo_showcase',
            esc_html__( 'RT Logo Showcase', 'rtelements' ),
            array( $this, 'rtelements_logo_showcase_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * CTA
         */
        add_settings_field(
            'rt_cta',
            esc_html__( 'RT CTA', 'rtelements' ),
            array( $this, 'rtelements_cta_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        
        /**
         * Testimonial Slider
         */
        add_settings_field(
            'rt_testimonial_slider',
            esc_html__( 'RT Slider', 'rtelements' ),
            array( $this, 'rtelements_testimonial_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
       
        /**
         * Flip Box
         */
        add_settings_field(
            'rt_flip_box',
            esc_html__( 'RT Flip Box', 'rtelements' ),
            array( $this, 'rtelements_flip_box_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Tab
         */
        add_settings_field(
            'rt_tab',
            esc_html__( 'RT Tab', 'rtelements' ),
            array( $this, 'rtelements_tab_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Advance Tab
         */
        add_settings_field(
            'rt_advance_tab',
            esc_html__( 'RT Advance Tab', 'rtelements' ),
            array( $this, 'rtelements_advance_tab_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Icon Box
         */
        add_settings_field(
            'rt_icon_box',
            esc_html__( 'RT Icon Box', 'rtelements' ),
            array( $this, 'rtelements_icon_box_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Blog Grid
         */
        add_settings_field(
            'rt_blog_grid',
            esc_html__( 'RT Blog Grid', 'rtelements' ),
            array( $this, 'rtelements_blog_grid_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Blog Slider
         */
        add_settings_field(
            'rt_blog_slider',
            esc_html__( 'RT Blog Slider', 'rtelements' ),
            array( $this, 'rtelements_blog_slider_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Number Grid
         */
        add_settings_field(
            'rt_number_grid',
            esc_html__( 'RT Number Grid', 'rtelements' ),
            array( $this, 'rtelements_number_grid_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Contact Form 7
         */
        add_settings_field(
            'rt_contact_form_7',
            esc_html__( 'RT Contact Form 7', 'rtelements' ),
            array( $this, 'rtelements_contact_form_7_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Progress Bar
         */
        add_settings_field(
            'rt_progress_bar',
            esc_html__( 'RT Progress Bar', 'rtelements' ),
            array( $this, 'rtelements_progress_bar_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        /**
         * Progress Bar
         */
        add_settings_field(
            'rt_iconbox_bar',
            esc_html__( 'RT Iconbox Top', 'rtelements' ),
            array( $this, 'rtelements_icon_bar_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Progress Pie
         */
        add_settings_field(
            'rt_progress_pie',
            esc_html__( 'RT Progress Pie', 'rtelements' ),
            array( $this, 'rtelements_progress_pie_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        
        /**
         * Top Icon Box
         */
        add_settings_field(
            'rt_topicon_box',
            esc_html__( 'RT Top Icon Box', 'rtelements' ),
            array( $this, 'rtelements_topicon_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

        /**
         * Countdown 
         */
        add_settings_field(
            'rt_cowndown_box',
            esc_html__( 'RT Coundown', 'rtelements' ),
            array( $this, 'rtelements_countdown_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );

         /**
         * Business Hour 
         */
        add_settings_field(
            'rt_cowndown_box',
            esc_html__( 'RT Busines Hour', 'rtelements' ),
            array( $this, 'rtelements_business_hour_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Tooltip
         */
        add_settings_field(
            'rt_tooltip',
            esc_html__( 'RT Tooltip', 'rtelements' ),
            array( $this, 'rtelements_tooltip_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
       
        /**
         * FAQ
         */
        add_settings_field(
            'rt_faq',
            esc_html__( 'RT FAQ', 'rtelements' ),
            array( $this, 'rtelements_faq_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
       
        /**
         * Image Hover Effect
         */
        add_settings_field(
            'rt_image_hover_effect',
            esc_html__( 'RT Image Hover Effect', 'rtelements' ),
            array( $this, 'rtelements_image_hover_effect_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Features List
         */
        add_settings_field(
            'rt_features_list',
            esc_html__( 'RT Features List', 'rtelements' ),
            array( $this, 'rtelements_features_list_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
      
       
        /**
         * Accordion
         */
        add_settings_field(
            'rt_accordion',
            esc_html__( 'RT Accordion', 'rtelements' ),
            array( $this, 'rtelements_accordion_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        /**
         * Newsletter
         */
        add_settings_field(
            'rt_newsletter',
            esc_html__( 'RT Newsletter', 'rtelements' ),
            array( $this, 'rtelements_newsletter_setting' ),
            'rtelements-addon-field',
            'rtelements_section_field_id',
            array( 'class' => 'rtselements_addon_field' )
        );
        
       

    }

    /**
     * Sanitize all form
     */
    public function rtelements_sanitize( $input_addon ) {
        $rt_addon_arg = array();
        //Team
        if( isset( $input_addon['rt_team_post'] ) ){
            $rt_addon_arg['rt_team_post'] = sanitize_text_field( $input_addon['rt_team_post'] );
        }
        //Portfolio
        if( isset( $input_addon['rt_portfolio_post'] ) ){
            $rt_addon_arg['rt_portfolio_post'] = sanitize_text_field( $input_addon['rt_portfolio_post'] );
        }
        //Testimonials
        if( isset( $input_addon['rt_testimonials_post'] ) ){
            $rt_addon_arg['rt_testimonials_post'] = sanitize_text_field( $input_addon['rt_testimonials_post'] );
        }
        //Heading
        if( isset( $input_addon['rt_heading_setting'] ) ){
            $rt_addon_arg['rt_heading_setting'] = sanitize_text_field( $input_addon['rt_heading_setting'] );
        }
        
        //Heading
        if( isset( $input_addon['rt_animated_heading_setting'] ) ){
            $rt_addon_arg['rt_animated_heading_setting'] = sanitize_text_field( $input_addon['rt_animated_heading_setting'] );
        }
        //About Image
        if( isset( $input_addon['rt_about_image_setting'] ) ){
            $rt_addon_arg['rt_about_image_setting'] = sanitize_text_field( $input_addon['rt_about_image_setting'] );
        }
        //Team Grid
        if( isset( $input_addon['rt_team_gread_setting'] ) ){
            $rt_addon_arg['rt_team_gread_setting'] = sanitize_text_field( $input_addon['rt_team_gread_setting'] );
        }
        //Full Width Slider
        if( isset( $input_addon['rt_full_width_slider_setting'] ) ){
            $rt_addon_arg['rt_full_width_slider_setting'] = sanitize_text_field( $input_addon['rt_full_width_slider_setting'] );
        }
        //Team Slider
        if( isset( $input_addon['rt_team_slider_setting'] ) ){
            $rt_addon_arg['rt_team_slider_setting'] = sanitize_text_field( $input_addon['rt_team_slider_setting'] );
        }
        //Portfolio Grid 
        if( isset( $input_addon['rt_portfolio_grid_setting'] ) ){
            $rt_addon_arg['rt_portfolio_grid_setting'] = sanitize_text_field( $input_addon['rt_portfolio_grid_setting'] );
        }
        //Portfolio Filter 
        if( isset( $input_addon['rt_portfolio_filter_setting'] ) ){
            $rt_addon_arg['rt_portfolio_filter_setting'] = sanitize_text_field( $input_addon['rt_portfolio_filter_setting'] );
        }
        //Portfolio Slider 
        if( isset( $input_addon['rt_portfolio_slider_setting'] ) ){
            $rt_addon_arg['rt_portfolio_slider_setting'] = sanitize_text_field( $input_addon['rt_portfolio_slider_setting'] );
        }
        //Counter 
        if( isset( $input_addon['rt_counter_setting'] ) ){
            $rt_addon_arg['rt_counter_setting'] = sanitize_text_field( $input_addon['rt_counter_setting'] );
        }

         //Counter 
         if( isset( $input_addon['rt_countdown_setting'] ) ){
            $rt_addon_arg['rt_countdown_setting'] = sanitize_text_field( $input_addon['rt_countdown_setting'] );
        } 
        
        //Business Hour 
         if( isset( $input_addon['rt_business_hour_setting'] ) ){
            $rt_addon_arg['rt_business_hour_setting'] = sanitize_text_field( $input_addon['rt_business_hour_setting'] );
        }

        //Services Grid 
        if( isset( $input_addon['rt_service_grid_setting'] ) ){
            $rt_addon_arg['rt_service_grid_setting'] = sanitize_text_field( $input_addon['rt_service_grid_setting'] );
        }
        //Services Slider 
        if( isset( $input_addon['rt_service_slider_setting'] ) ){
            $rt_addon_arg['rt_service_slider_setting'] = sanitize_text_field( $input_addon['rt_service_slider_setting'] );
        }
        //Video 
        if( isset( $input_addon['rt_video_setting'] ) ){
            $rt_addon_arg['rt_video_setting'] = sanitize_text_field( $input_addon['rt_video_setting'] );
        }
        //Pricing Table 
        if( isset( $input_addon['rt_pricing_table_setting'] ) ){
            $rt_addon_arg['rt_pricing_table_setting'] = sanitize_text_field( $input_addon['rt_pricing_table_setting'] );
        }
        //Pricing Switcher 
        if( isset( $input_addon['rt_pricing_switcher_setting'] ) ){
            $rt_addon_arg['rt_pricing_switcher_setting'] = sanitize_text_field( $input_addon['rt_pricing_switcher_setting'] );
        }
        //Button
        if( isset( $input_addon['rt_button_setting'] ) ){
            $rt_addon_arg['rt_button_setting'] = sanitize_text_field( $input_addon['rt_button_setting'] );
        }
        //Logo Showcase
        if( isset( $input_addon['rt_logo_showcase_setting'] ) ){
            $rt_addon_arg['rt_logo_showcase_setting'] = sanitize_text_field( $input_addon['rt_logo_showcase_setting'] );
        }
        //CTA
        if( isset( $input_addon['rt_cta_setting'] ) ){
            $rt_addon_arg['rt_cta_setting'] = sanitize_text_field( $input_addon['rt_cta_setting'] );
        }
        //Testimonial Grid
        if( isset( $input_addon['rt_testimonial_grid_setting'] ) ){
            $rt_addon_arg['rt_testimonial_grid_setting'] = sanitize_text_field( $input_addon['rt_testimonial_grid_setting'] );
        }
        //Testimonial Slider
        if( isset( $input_addon['rt_testimonial_slider_setting'] ) ){
            $rt_addon_arg['rt_testimonial_slider_setting'] = sanitize_text_field( $input_addon['rt_testimonial_slider_setting'] );
        }
        //Testimonial Slider Two
        if( isset( $input_addon['rt_testimonial_slider_two_setting'] ) ){
            $rt_addon_arg['rt_testimonial_slider_two_setting'] = sanitize_text_field( $input_addon['rt_testimonial_slider_two_setting'] );
        }
        //Flip Box
        if( isset( $input_addon['rt_flip_box_setting'] ) ){
            $rt_addon_arg['rt_flip_box_setting'] = sanitize_text_field( $input_addon['rt_flip_box_setting'] );
        }
        //Tab
        if( isset( $input_addon['rt_tab_setting'] ) ){
            $rt_addon_arg['rt_tab_setting'] = sanitize_text_field( $input_addon['rt_tab_setting'] );
        }
        //Advance Tab
        if( isset( $input_addon['rt_advance_tab_setting'] ) ){
            $rt_addon_arg['rt_advance_tab_setting'] = sanitize_text_field( $input_addon['rt_advance_tab_setting'] );
        }
        //Icon Box
        if( isset( $input_addon['rt_icon_box_setting'] ) ){
            $rt_addon_arg['rt_icon_box_setting'] = sanitize_text_field( $input_addon['rt_icon_box_setting'] );
        }
        //Blog Grid
        if( isset( $input_addon['rt_blog_grid_setting'] ) ){
            $rt_addon_arg['rt_blog_grid_setting'] = sanitize_text_field( $input_addon['rt_blog_grid_setting'] );
        }
        //Blog Slider
        if( isset( $input_addon['rt_blog_slider_setting'] ) ){
            $rt_addon_arg['rt_blog_slider_setting'] = sanitize_text_field( $input_addon['rt_blog_slider_setting'] );
        }
        //Number Grid
        if( isset( $input_addon['rt_number_grid_setting'] ) ){
            $rt_addon_arg['rt_number_grid_setting'] = sanitize_text_field( $input_addon['rt_number_grid_setting'] );
        }
        //Contact Form 7
        if( isset( $input_addon['rt_contact_form_7_setting'] ) ){
            $rt_addon_arg['rt_contact_form_7_setting'] = sanitize_text_field( $input_addon['rt_contact_form_7_setting'] );
        }
        //Progress Bar
        if( isset( $input_addon['rt_progress_bar_setting'] ) ){
            $rt_addon_arg['rt_progress_bar_setting'] = sanitize_text_field( $input_addon['rt_progress_bar_setting'] );
        }
        //Progress Pie
        if( isset( $input_addon['rt_progress_pie_setting'] ) ){
            $rt_addon_arg['rt_progress_pie_setting'] = sanitize_text_field( $input_addon['rt_progress_pie_setting'] );
        }
        //topicon Box
        if( isset( $input_addon['rt_icon_bar_setting'] ) ){
            $rt_addon_arg['rt_icon_bar_setting'] = sanitize_text_field( $input_addon['rt_icon_bar_setting'] );
        }
        //Tooltip
        if( isset( $input_addon['rt_tooltip_setting'] ) ){
            $rt_addon_arg['rt_tooltip_setting'] = sanitize_text_field( $input_addon['rt_tooltip_setting'] );
        }
        //Static Product
        if( isset( $input_addon['rt_static_product_setting'] ) ){
            $rt_addon_arg['rt_static_product_setting'] = sanitize_text_field( $input_addon['rt_static_product_setting'] );
        }
        //FAQ
        if( isset( $input_addon['rt_faq_setting'] ) ){
            $rt_addon_arg['rt_faq_setting'] = sanitize_text_field( $input_addon['rt_faq_setting'] );
        }
        //Image Showcase
        if( isset( $input_addon['rt_image_showcase_setting'] ) ){
            $rt_addon_arg['rt_image_showcase_setting'] = sanitize_text_field( $input_addon['rt_image_showcase_setting'] );
        }
        //Image Hover Effect
        if( isset( $input_addon['rt_image_hover_effect_setting'] ) ){
            $rt_addon_arg['rt_image_hover_effect_setting'] = sanitize_text_field( $input_addon['rt_image_hover_effect_setting'] );
        }
        //Features List
        if( isset( $input_addon['rt_features_list_setting'] ) ){
            $rt_addon_arg['rt_features_list_setting'] = sanitize_text_field( $input_addon['rt_features_list_setting'] );
        }
     
        //Image Parallax
        if( isset( $input_addon['rt_image_parallax_setting'] ) ){
            $rt_addon_arg['rt_image_parallax_setting'] = sanitize_text_field( $input_addon['rt_image_parallax_setting'] );
        }
        //Image Animation Shape
        if( isset( $input_addon['rt_image_animation_shape_setting'] ) ){
            $rt_addon_arg['rt_image_animation_shape_setting'] = sanitize_text_field( $input_addon['rt_image_animation_shape_setting'] );
        }
        //Breadcrumb
        if( isset( $input_addon['rt_breadcrumb_setting'] ) ){
            $rt_addon_arg['rt_breadcrumb_setting'] = sanitize_text_field( $input_addon['rt_breadcrumb_setting'] );
        }
        //Accordion
        if( isset( $input_addon['rt_accordion_setting'] ) ){
            $rt_addon_arg['rt_accordion_setting'] = sanitize_text_field( $input_addon['rt_accordion_setting'] );
        }
        //Newsletter
        if( isset( $input_addon['rt_newsletter_setting'] ) ){
            $rt_addon_arg['rt_newsletter_setting'] = sanitize_text_field( $input_addon['rt_newsletter_setting'] );
        }
        //Hover Tab
        if( isset( $input_addon['rt_hover_tab_setting'] ) ){
            $rt_addon_arg['rt_hover_tab_setting'] = sanitize_text_field( $input_addon['rt_hover_tab_setting'] );
        }

        //Hover Tab
        if( isset( $input_addon['rt_screen_slider_setting'] ) ){
            $rt_addon_arg['rt_screen_slider_setting'] = sanitize_text_field( $input_addon['rt_screen_slider_setting'] );
        }

        return $rt_addon_arg;
    }

    /**
     * Print the Section text
     */
    public function rtelements_section_info() {
        //print 'Enter your settings below:';
    }

    /**
     * Team
     */
    public function rtelements_team_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_team_post]" id="rt_team_post" value="rt_team_post" %s/>',
                (isset( $this->rtelements_options['rt_team_post']) && $this->rtelements_options['rt_team_post'] ) == 'rt_team_post' ? 'checked' : ''
            );
            ?>
            <label for="rt_team_post"></label>
        </div>
        <?php
    }

    /**
     * Portfolio
     */
    public function rtelements_portfolio_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_portfolio_post]" id="rt_portfolio_post" value="rt_portfolio_post" %s/>',
                (isset( $this->rtelements_options['rt_portfolio_post']) && $this->rtelements_options['rt_portfolio_post'] ) == 'rt_portfolio_post' ? 'checked' : ''
            );
            ?>
            <label for="rt_portfolio_post"></label>
        </div>
        <?php
    }

     /**
     * Testimonials
     */
    public function rtelements_testimonials_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_testimonials_post]" id="rt_testimonials_post" value="rt_testimonials_post" %s/>',
                (isset( $this->rtelements_options['rt_testimonials_post']) && $this->rtelements_options['rt_testimonials_post'] ) == 'rt_testimonials_post' ? 'checked' : ''
            );
            ?>
            <label for="rt_testimonials_post"></label>
        </div>
        <?php
    }

    /**
     * Heading field
     */
    public function rtelements_heading_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_heading_setting]" id="rt_heading_setting" value="rtelement_heading" %s/>',
                (isset( $this->rtelements_options['rt_heading_setting']) && $this->rtelements_options['rt_heading_setting'] ) == 'rtelement_heading' ? 'checked' : ''
            );
            ?>
            <label for="rt_heading_setting"></label>
        </div>
        <?php
    }

    /**
     * Animated Heading
     */
    public function rtelements_animated_heading_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_animated_heading_setting]" id="rt_animated_heading_setting" value="rselement_animated_heading" %s/>',
                (isset( $this->rtelements_options['rt_animated_heading_setting']) && $this->rtelements_options['rt_animated_heading_setting'] ) == 'rselement_animated_heading' ? 'checked' : ''
            );
            ?>
            <label for="rt_animated_heading_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Animated Heading
     */
    public function rtelements_about_image() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_about_image_setting]" id="rt_about_image_setting" value="rtelement_about_image" %s/>',
                (isset( $this->rtelements_options['rt_about_image_setting']) && $this->rtelements_options['rt_about_image_setting'] ) == 'rtelement_about_image' ? 'checked' : ''
            );
            ?>
            <label for="rt_about_image_setting"></label>
        </div>
        <?php
    }

    /**
     * Team Grid
     */
    public function rtelements_team_gread_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_team_gread_setting]" id="rt_team_gread_setting" value="rselement_team_gread" %s/>',
                (isset( $this->rtelements_options['rt_team_gread_setting']) && $this->rtelements_options['rt_team_gread_setting'] ) == 'rselement_team_gread' ? 'checked' : ''
            );
            ?>
            <label for="rt_team_gread_setting"></label>
        </div>
        <?php
    }

    /**
     * Full Width Slider
     */
    public function rtelements_full_width_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_full_width_slider_setting]" id="rt_full_width_slider_setting" value="rselement_full_width_slider" %s/>',
                (isset( $this->rtelements_options['rt_full_width_slider_setting']) && $this->rtelements_options['rt_full_width_slider_setting'] ) == 'rselement_full_width_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_full_width_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Team Slide
     */
    public function rtelements_team_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_team_slider_setting]" id="rt_team_slider_setting" value="rselement_team_slider" %s/>',
                (isset( $this->rtelements_options['rt_team_slider_setting']) && $this->rtelements_options['rt_team_slider_setting'] ) == 'rselement_team_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_team_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Portfolio Grid
     */
    public function rtelements_portfolio_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_portfolio_grid_setting]" id="rt_portfolio_grid_setting" value="rselement_portfolio_grid" %s/>',
                (isset( $this->rtelements_options['rt_portfolio_grid_setting']) && $this->rtelements_options['rt_portfolio_grid_setting'] ) == 'rselement_portfolio_grid' ? 'checked' : ''
            );
            ?>
            <label for="rt_portfolio_grid_setting"></label>
        </div>
        <?php
    }

    /**
     * Portfolio Filter
     */
    public function rtelements_portfolio_filter_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_portfolio_filter_setting]" id="rt_portfolio_filter_setting" value="rselement_portfolio_filter" %s/>',
                (isset( $this->rtelements_options['rt_portfolio_filter_setting']) && $this->rtelements_options['rt_portfolio_filter_setting'] ) == 'rselement_portfolio_filter' ? 'checked' : ''
            );
            ?>
            <label for="rt_portfolio_filter_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Portfolio Slider
     */
    public function rtelements_portfolio_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_portfolio_slider_setting]" id="rt_portfolio_slider_setting" value="rselement_portfolio_slider" %s/>',
                (isset( $this->rtelements_options['rt_portfolio_slider_setting']) && $this->rtelements_options['rt_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_portfolio_slider_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Counter
     */
    public function rtelements_counter_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_counter_setting]" id="rt_counter_setting" value="rselement_counter" %s/>',
                (isset( $this->rtelements_options['rt_counter_setting']) && $this->rtelements_options['rt_counter_setting'] ) == 'rselement_counter' ? 'checked' : ''
            );
            ?>
            <label for="rt_counter_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Services Grid
     */
    public function rtelements_service_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_service_grid_setting]" id="rt_service_grid_setting" value="rselement_service_grid" %s/>',
                (isset( $this->rtelements_options['rt_service_grid_setting']) && $this->rtelements_options['rt_service_grid_setting'] ) == 'rselement_service_grid' ? 'checked' : ''
            );
            ?>
            <label for="rt_service_grid_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Services Slider
     */
    public function rtelements_service_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_service_slider_setting]" id="rt_service_slider_setting" value="rselement_service_slider" %s/>',
                (isset( $this->rtelements_options['rt_service_slider_setting']) && $this->rtelements_options['rt_service_slider_setting'] ) == 'rselement_service_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_service_slider_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Video
     */
    public function rtelements_video_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_video_setting]" id="rt_video_setting" value="rselement_video" %s/>',
                (isset( $this->rtelements_options['rt_video_setting']) && $this->rtelements_options['rt_video_setting'] ) == 'rselement_video' ? 'checked' : ''
            );
            ?>
            <label for="rt_video_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Pricing Table
     */
    public function rtelements_pricing_table_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_pricing_table_setting]" id="rt_pricing_table_setting" value="rselement_pricing_table" %s/>',
                (isset( $this->rtelements_options['rt_pricing_table_setting']) && $this->rtelements_options['rt_pricing_table_setting'] ) == 'rselement_pricing_table' ? 'checked' : ''
            );
            ?>
            <label for="rt_pricing_table_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Pricing Switcher
     */
    public function rtelements_pricing_switcher_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_pricing_switcher_setting]" id="rt_pricing_switcher_setting" value="rselement_pricing_switcher" %s/>',
                (isset( $this->rtelements_options['rt_pricing_switcher_setting']) && $this->rtelements_options['rt_pricing_switcher_setting'] ) == 'rselement_pricing_switcher' ? 'checked' : ''
            );
            ?>
            <label for="rt_pricing_switcher_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Button
     */
    public function rtelements_button_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_button_setting]" id="rt_button_setting" value="rselement_button" %s/>',
                (isset( $this->rtelements_options['rt_button_setting']) && $this->rtelements_options['rt_button_setting'] ) == 'rselement_button' ? 'checked' : ''
            );
            ?>
            <label for="rt_button_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Logo Showcase
     */
    public function rtelements_logo_showcase_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_logo_showcase_setting]" id="rt_logo_showcase_setting" value="rselement_logo_showcase" %s/>',
                (isset( $this->rtelements_options['rt_logo_showcase_setting']) && $this->rtelements_options['rt_logo_showcase_setting'] ) == 'rselement_logo_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rt_logo_showcase_setting"></label>
        </div>
        <?php
    }
    
    /**
     * CTA
     */
    public function rtelements_cta_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_cta_setting]" id="rt_cta_setting" value="rselement_cta" %s/>',
                (isset( $this->rtelements_options['rt_cta_setting']) && $this->rtelements_options['rt_cta_setting'] ) == 'rselement_cta' ? 'checked' : ''
            );
            ?>
            <label for="rt_cta_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Testimonial Grid
     */
    public function rtelements_testimonial_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_testimonial_grid_setting]" id="rt_testimonial_grid_setting" value="rselement_testimonial_grid" %s/>',
                (isset( $this->rtelements_options['rt_testimonial_grid_setting']) && $this->rtelements_options['rt_testimonial_grid_setting'] ) == 'rselement_testimonial_grid' ? 'checked' : ''
            );
            ?>
            <label for="rt_testimonial_grid_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Testimonial Slider
     */
    public function rtelements_testimonial_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_testimonial_slider_setting]" id="rt_testimonial_slider_setting" value="rselement_testimonial_slider" %s/>',
                (isset( $this->rtelements_options['rt_testimonial_slider_setting']) && $this->rtelements_options['rt_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_testimonial_slider_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Testimonial Slider Two
     */
    public function rtelements_testimonial_slider_two_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_testimonial_slider_two_setting]" id="rt_testimonial_slider_two_setting" value="rselement_testimonial_slider_two" %s/>',
                (isset( $this->rtelements_options['rt_testimonial_slider_two_setting']) && $this->rtelements_options['rt_testimonial_slider_two_setting'] ) == 'rselement_testimonial_slider_two' ? 'checked' : ''
            );
            ?>
            <label for="rt_testimonial_slider_two_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Flip Box
     */
    public function rtelements_flip_box_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_flip_box_setting]" id="rt_flip_box_setting" value="rselement_flip_box" %s/>',
                (isset( $this->rtelements_options['rt_flip_box_setting']) && $this->rtelements_options['rt_flip_box_setting'] ) == 'rselement_flip_box' ? 'checked' : ''
            );
            ?>
            <label for="rt_flip_box_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Tab
     */
    public function rtelements_tab_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_tab_setting]" id="rt_tab_setting" value="rselement_tab" %s/>',
                (isset( $this->rtelements_options['rt_tab_setting']) && $this->rtelements_options['rt_tab_setting'] ) == 'rselement_tab' ? 'checked' : ''
            );
            ?>
            <label for="rt_tab_setting"></label>
        </div>
        <?php
    }

    /**
     * Advance Tab
     */
    public function rtelements_advance_tab_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_advance_tab_setting]" id="rt_advance_tab_setting" value="rselement_advance_tab" %s/>',
                (isset( $this->rtelements_options['rt_advance_tab_setting']) && $this->rtelements_options['rt_advance_tab_setting'] ) == 'rselement_advance_tab' ? 'checked' : ''
            );
            ?>
            <label for="rt_advance_tab_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Icon Box
     */
    public function rtelements_icon_box_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_icon_box_setting]" id="rt_icon_box_setting" value="rselement_icon_box" %s/>',
                (isset( $this->rtelements_options['rt_icon_box_setting']) && $this->rtelements_options['rt_icon_box_setting'] ) == 'rselement_icon_box' ? 'checked' : ''
            );
            ?>
            <label for="rt_icon_box_setting"></label>
        </div>
        <?php
    }

    /**
     * Blog Grid
     */
    public function rtelements_blog_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_blog_grid_setting]" id="rt_blog_grid_setting" value="rselement_blog_grid" %s/>',
                (isset( $this->rtelements_options['rt_blog_grid_setting']) && $this->rtelements_options['rt_blog_grid_setting'] ) == 'rselement_blog_grid' ? 'checked' : ''
            );
            ?>
            <label for="rt_blog_grid_setting"></label>
        </div>
        <?php
    }

    /**
     * Blog Slider
     */
    public function rtelements_blog_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_blog_slider_setting]" id="rt_blog_slider_setting" value="rselement_blog_slider" %s/>',
                (isset( $this->rtelements_options['rt_blog_slider_setting']) && $this->rtelements_options['rt_blog_slider_setting'] ) == 'rselement_blog_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_blog_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Number Grid
     */
    public function rtelements_number_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_number_grid_setting]" id="rt_number_grid_setting" value="rselement_number_grid" %s/>',
                (isset( $this->rtelements_options['rt_number_grid_setting']) && $this->rtelements_options['rt_number_grid_setting'] ) == 'rselement_number_grid' ? 'checked' : ''
            );
            ?>
            <label for="rt_number_grid_setting"></label>
        </div>
        <?php
    }

    /**
     * Contact Form 7
     */
    public function rtelements_contact_form_7_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_contact_form_7_setting]" id="rt_contact_form_7_setting" value="rselement_contact_form_7" %s/>',
                (isset( $this->rtelements_options['rt_contact_form_7_setting']) && $this->rtelements_options['rt_contact_form_7_setting'] ) == 'rselement_contact_form_7' ? 'checked' : ''
            );
            ?>
            <label for="rt_contact_form_7_setting"></label>
        </div>
        <?php
    }

    /**
     * Progress Bar
     */
    public function rtelements_progress_bar_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_progress_bar_setting]" id="rt_progress_bar_setting" value="rselement_progress_bar" %s/>',
                (isset( $this->rtelements_options['rt_progress_bar_setting']) && $this->rtelements_options['rt_progress_bar_setting'] ) == 'rselement_progress_bar' ? 'checked' : ''
            );
            ?>
            <label for="rt_progress_bar_setting"></label>
        </div>
        <?php
    }

    /**
     * Progress Bar
     */
    public function rtelements_icon_bar_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_icon_bar_setting]" id="rt_icon_bar_setting" value="rselement_icon_bar" %s/>',
                (isset( $this->rtelements_options['rt_icon_bar_setting']) && $this->rtelements_options['rt_icon_bar_setting'] ) == 'rselement_icon_bar' ? 'checked' : ''
            );
            ?>
            <label for="rt_icon_bar_setting"></label>
        </div>
        <?php
    }

    

    /**
     * Progress Pie
     */
    public function rtelements_progress_pie_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_progress_pie_setting]" id="rt_progress_pie_setting" value="rselement_progress_pie" %s/>',
                (isset( $this->rtelements_options['rt_progress_pie_setting']) && $this->rtelements_options['rt_progress_pie_setting'] ) == 'rselement_progress_pie' ? 'checked' : ''
            );
            ?>
            <label for="rt_progress_pie_setting"></label>
        </div>
        <?php
    }

    /**
     * Contact Box
     */
    public function rtelements_topicon_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_topicon_setting]" id="rt_topicon_setting" value="rselement_contact_box" %s/>',
                (isset( $this->rtelements_options['rt_topicon_setting']) && $this->rtelements_options['rt_topicon_setting'] ) == 'rselement_contact_box' ? 'checked' : ''
            );
            ?>
            <label for="rt_topicon_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Countdown Box
     */
    public function rtelements_countdown_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_countdown_setting]" id="rt_countdown_setting" value="rtelement_countdown_box" %s/>',
                (isset( $this->rtelements_options['rt_countdown_setting']) && $this->rtelements_options['rt_countdown_setting'] ) == 'rtelement_countdown_box' ? 'checked' : ''
            );
            ?>
            <label for="rt_countdown_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Business Hour 
     */
    public function rtelements_business_hour_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_business_hour_setting]" id="rt_business_hour_setting" value="rtelement_business_hour_box" %s/>',
                (isset( $this->rtelements_options['rt_business_hour_setting']) && $this->rtelements_options['rt_business_hour_setting'] ) == 'rtelement_business_hour_box' ? 'checked' : ''
            );
            ?>
            <label for="rt_business_hour_setting"></label>
        </div>
        <?php
    }

    /**
     * Tooltip
     */
    public function rtelements_tooltip_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_tooltip_setting]" id="rt_tooltip_setting" value="rselement_tooltip" %s/>',
                (isset( $this->rtelements_options['rt_tooltip_setting']) && $this->rtelements_options['rt_tooltip_setting'] ) == 'rselement_tooltip' ? 'checked' : ''
            );
            ?>
            <label for="rt_tooltip_setting"></label>
        </div>
        <?php
    }

    /**
     * Static Product
     * 
     */
    public function rtelements_static_product_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_static_product_setting]" id="rt_static_product_setting" value="rselement_static_product" %s/>',
                (isset( $this->rtelements_options['rt_static_product_setting']) && $this->rtelements_options['rt_static_product_setting'] ) == 'rselement_static_product' ? 'checked' : ''
            );
            ?>
            <label for="rt_static_product_setting"></label>
        </div>
        <?php
    }

    /**
     * FAQ
     */
    public function rtelements_faq_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_faq_setting]" id="rt_faq_setting" value="rselement_faq" %s/>',
                (isset( $this->rtelements_options['rt_faq_setting']) && $this->rtelements_options['rt_faq_setting'] ) == 'rselement_faq' ? 'checked' : ''
            );
            ?>
            <label for="rt_faq_setting"></label>
        </div>
        <?php
    }

    /**
     * Image Showcase
     */
    public function rtelements_image_showcase_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_image_showcase_setting]" id="rt_image_showcase_setting" value="rselement_image_showcase" %s/>',
                (isset( $this->rtelements_options['rt_image_showcase_setting']) && $this->rtelements_options['rt_image_showcase_setting'] ) == 'rselement_image_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rt_image_showcase_setting"></label>
        </div>
        <?php
    }

    /**
     * Image Hover Effect
     */
    public function rtelements_image_hover_effect_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_image_hover_effect_setting]" id="rt_image_hover_effect_setting" value="rselement_image_hover_effect" %s/>',
                (isset( $this->rtelements_options['rt_image_hover_effect_setting']) && $this->rtelements_options['rt_image_hover_effect_setting'] ) == 'rselement_image_hover_effect' ? 'checked' : ''
            );
            ?>
            <label for="rt_image_hover_effect_setting"></label>
        </div>
        <?php
    }

    /**
     * Features List
     */
    public function rtelements_features_list_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_features_list_setting]" id="rt_features_list_setting" value="rselement_features_list" %s/>',
                (isset( $this->rtelements_options['rt_features_list_setting']) && $this->rtelements_options['rt_features_list_setting'] ) == 'rselement_features_list' ? 'checked' : ''
            );
            ?>
            <label for="rt_features_list_setting"></label>
        </div>
        <?php
    }



    /**
     * Image Parallax
     */
    public function rtelements_image_parallax_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_image_parallax_setting]" id="rt_image_parallax_setting" value="rselement_image_parallax" %s/>',
                (isset( $this->rtelements_options['rt_image_parallax_setting']) && $this->rtelements_options['rt_image_parallax_setting'] ) == 'rselement_image_parallax' ? 'checked' : ''
            );
            ?>
            <label for="rt_image_parallax_setting"></label>
        </div>
        <?php
    }

    /**
     * Image Animation Shape
     */
    public function rtelements_image_animation_shape_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_image_animation_shape_setting]" id="rt_image_animation_shape_setting" value="rselement_image_animation_shape" %s/>',
                (isset( $this->rtelements_options['rt_image_animation_shape_setting']) && $this->rtelements_options['rt_image_animation_shape_setting'] ) == 'rselement_image_animation_shape' ? 'checked' : ''
            );
            ?>
            <label for="rt_image_animation_shape_setting"></label>
        </div>
        <?php
    }

    /**
     * Breadcrumb
     */
    public function rtelements_breadcrumb_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_breadcrumb_setting]" id="rt_breadcrumb_setting" value="rselement_breadcrumb" %s/>',
                (isset( $this->rtelements_options['rt_breadcrumb_setting']) && $this->rtelements_options['rt_breadcrumb_setting'] ) == 'rselement_breadcrumb' ? 'checked' : ''
            );
            ?>
            <label for="rt_breadcrumb_setting"></label>
        </div>
        <?php
    }

    /**
     * Accordion
     */
    public function rtelements_accordion_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_accordion_setting]" id="rt_accordion_setting" value="rselement_accordion" %s/>',
                (isset( $this->rtelements_options['rt_accordion_setting']) && $this->rtelements_options['rt_accordion_setting'] ) == 'rselement_accordion' ? 'checked' : ''
            );
            ?>
            <label for="rt_accordion_setting"></label>
        </div>
        <?php
    }

    /**
     * Newsletter
     */
    public function rtelements_newsletter_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_newsletter_setting]" id="rt_newsletter_setting" value="rselement_newsletter" %s/>',
                (isset( $this->rtelements_options['rt_newsletter_setting']) && $this->rtelements_options['rt_newsletter_setting'] ) == 'rselement_newsletter' ? 'checked' : ''
            );
            ?>
            <label for="rt_newsletter_setting"></label>
        </div>
        <?php
    }

    /**
     * Hover Tabs
     */
    public function rtelements_hover_tab_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rtelements_addon_option[rt_hover_tab_setting]" id="rt_hover_tab_setting" value="rselement_hover_tab" %s/>',
                (isset( $this->rtelements_options['rt_hover_tab_setting']) && $this->rtelements_options['rt_hover_tab_setting'] ) == 'rselement_hover_tab' ? 'checked' : ''
            );
            ?>
            <label for="rt_hover_tab_setting"></label>
        </div>
        <?php
    }

    /**
     * Apps ScreenSlider
     */
    public function rtelements_screenslider_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="rtelements_addon_option[rt_screen_slider_setting]" id="rt_screen_slider_setting" value="rselement_screen_slider" %s/>',
                (isset( $this->rtelements_options['rt_screen_slider_setting']) && $this->rtelements_options['rt_screen_slider_setting'] ) == 'rselement_screen_slider' ? 'checked' : ''
            );
            ?>
            <label for="rt_screen_slider_setting"></label>
        </div>
        <?php
    }

    public function rseelements_plugin_activate() {
        $all_elements_list = $this->rtelements_widget_list();

        update_option('rtelements_addon_option',$all_elements_list);
    }

    public function rtelements_widget_list() {
        $rsall_elements = [
           
            'rt_portfolio_post' => 'rt_portfolio_post',
            'rt_testimonials_post' => 'rt_testimonials_post',
            'rt_team_post' => 'rt_team_post ',
            'rt_heading_setting' => 'rselement_heading',
            'rt_animated_heading_setting' => 'rselement_animated_heading',
            'rt_about_image_setting' => 'rtelement_about_image',
            'rt_team_gread_setting' => 'rselement_team_gread',
            'rt_full_width_slider_setting' => 'rselement_full_width_slider',
            'rt_team_slider_setting' => 'rselement_team_slider',
            'rt_portfolio_grid_setting' => 'rselement_portfolio_grid',
            'rt_portfolio_filter_setting' => 'rselement_portfolio_filter',
            'rt_portfolio_slider_setting' => 'rselement_portfolio_slider',
            'rt_counter_setting' => 'rselement_counter',
            'rt_service_grid_setting' => 'rselement_service_grid',
            'rt_service_slider_setting' => 'rselement_service_grid',
            'rt_video_setting' => 'rselement_video',
            'rt_pricing_table_setting' => 'rselement_pricing_table',
            'rt_pricing_switcher_setting' => 'rselement_pricing_switcher',
            'rt_button_setting' => 'rselement_button',
            'rt_logo_showcase_setting' => 'rselement_logo_showcase',
            'rt_cta_setting' => 'rselement_cta',
            'rt_testimonial_grid_setting' => 'rselement_testimonial_grid',
            'rt_testimonial_slider_two_setting' => 'rselement_testimonial_slider_two',
            'rt_flip_box_setting' => 'rselement_flip_box',
            'rt_tab_setting' => 'rselement_tab',
            'rt_advance_tab_setting' => 'rselement_advance_tab',
            'rt_icon_box_setting' => 'rselement_icon_box',
            'rt_blog_grid_setting' => 'rselement_blog_grid',
            'rt_blog_slider_setting' => 'rselement_blog_slider',
            'rt_number_grid_setting' => 'rselement_number_grid',
            'rt_contact_form_7_setting' => 'rselement_contact_form_7',
            'rt_progress_bar_setting' => 'rselement_progress_bar',
            'rt_icon_bar_setting' => 'rselement_icon_bar',
            'rt_progress_pie_setting' => 'rselement_progress_pie',
            'rt_topicon_setting' => 'rselement_contact_box',
            'rt_countdown_setting' => 'rtelement_countdown_box',
            'rt_business_hour_setting' => 'rtelement_business_hour_box',
            'rt_tooltip_setting' => 'rselement_tooltip',
            'rt_static_product_setting' => 'rselement_static_product',
            'rt_faq_setting' => 'rselement_faq',
            'rt_image_showcase_setting' => 'rselement_image_showcase',
            'rt_image_hover_effect_setting' => 'rselement_image_hover_effect',
            'rt_features_list_setting' => 'rselement_features_list',            
            'rt_image_animation_shape_setting' => 'rselement_image_animation_shape',
            'rt_breadcrumb_setting' => 'rselement_breadcrumb',
            'rt_accordion_setting' => 'rselement_accordion',
            'rt_newsletter_setting' => 'rselement_newsletter',
            'rt_hover_tab_setting' => 'rselement_hover_tab',
            'rt_screen_slider_setting' => 'rselement_screen_slider',
            'rt_testimonial_slider_setting' => 'rselement_testimonial_slider',
            'rt_image_parallax_setting' => 'rselement_image_parallax',
           
        ];

        return $rsall_elements;
    }
    
}

if( is_admin() )
    new rt_Elements_Addon_Control();