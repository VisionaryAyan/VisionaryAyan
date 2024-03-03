<?php
/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class RTelements_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'rtelements' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_header_footer_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rtelements_register_widget_styles' ] );	
		add_action( 'wp_enqueue_scripts', [ $this, 'rsaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rsaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rsaddon_register_plugin_admin_styles' ] );
		$this->include_files();		
	}

	public function rtelements_register_widget_styles() {		
		$dir = plugin_dir_url(__FILE__);        
		$rtelements_addon_setting = get_option( 'rtelements_addon_option' );

		//Contact Form 7
		if( isset( $rtelements_addon_setting['rt_contact_form_7_setting'] ) == 'rs_contact_form_7_setting' ) {
			wp_enqueue_style( 'rtelements-cf7', $dir.'widgets/cf7/cf7-css/cf7.css' );			
		}
		
		if( isset( $rtelements_addon_setting['rt_animated_heading_setting'] ) == 'rselement_animated_heading' ){
			wp_enqueue_style( 'rtelements-heading-css', $dir.'widgets/heading/heading-css/heading.css' );	
		}
		//button css	
		wp_enqueue_style( 'rtelements-button-css', $dir.'widgets/button/button-css/button.css' );	
		
		
		//price table
		if( isset( $rtelements_addon_setting['rt_pricing_table_setting'] ) == 'rselement_pricing_table' ) {
			wp_enqueue_style( 'rtelements-pricing-table', $dir.'widgets/pricing-table/pricing-table-css/pricing-table.css' );
		}		
		//CTA
		if( isset( $rtelements_addon_setting['rt_cta_setting'] ) == 'rt_cta_setting' ) {			
			wp_enqueue_style( 'rtelements-cta', $dir.'widgets/cta/cta-css/cta.css' );	
		}		
	
		if( isset( $rtelements_addon_setting['rt_icon_box_setting'] ) == 'rtelement_icon_box' ){
			wp_enqueue_style( 'rtelements-iconbox', $dir.'widgets/iconbox/rs-iconbox-css/iconbox.css' );
		}
		if( isset( $rtelements_addon_setting['rt_blog_grid_setting'] ) == 'rtelement_blog_grid' ){
			wp_enqueue_style( 'rtelements-blog-grid', $dir.'widgets/blog-grid/blog-css/blog-grid.css' );
		}

		//Progress Pie
		if( isset( $rtelements_addon_setting['rt_progress_pie_setting'] ) == 'rt_progress_pie_setting' ) {
			wp_enqueue_style( 'rtelements-progress-pie', $dir.'widgets/progress-pie/progress-pie-css/progress-pie.css' );
		}		
		
	}

	public function rsaddon_register_plugin_styles() {		
		$dir = plugin_dir_url(__FILE__);       
		wp_enqueue_style( 'custom-elements', $dir.'assets/css/aos.css' );		
		wp_enqueue_style( 'headding-title', $dir.'assets/css/headding-title.css' );		
		wp_enqueue_style( 'aos', $dir.'assets/css/elements.css' );

        //enqueue javascript   		  
		wp_enqueue_script( 'aos', $dir.'assets/js/aos.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'gsap', $dir.'assets/js/gsap.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'scrolltigger', $dir.'assets/js/scrolltigger.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'headding-title', $dir.'assets/js/headding-title.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);       	
      
    }

    public function rsaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rsaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function rsaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'pielements_category',
            [
                'title' => esc_html__('RT Elementor Addons', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_header_footer_category( $elements_manager ) {
        $elements_manager->add_category(
            'header_footer_rts',
            [
                'title' => esc_html__('RTS Header Footer Elements', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pielements' ),
			'<strong>' . esc_html__( 'RTS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pielements' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		$rtelements_addon_setting = get_option( 'rtelements_addon_option' );		
		
		//heading
		if( isset( $rtelements_addon_setting['rt_heading_setting'] ) == 'rselement_heading' ) {
            require_once(__DIR__ . '/widgets/heading/heading.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new \Reactheme_Elementor_Heading_Widget());
        }

		//Animated Hheading Setting
		if( isset( $rtelements_addon_setting['rt_animated_heading_setting'] ) == 'rselement_animated_heading' ) {
			require_once( __DIR__ . '/widgets/animated-heading/animated-heading.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Elementor_Animated_Heading_Widget() );
		}	
		
		//Sound Coud 
		require_once( __DIR__ . '/widgets/sound-cloud/sound-cloud.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Sound_Cloud_Widget() );
		
		
		//Tab Sound Coud 
		require_once( __DIR__ . '/widgets/tab-sound-cloud/tab-sound-cloud.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Tab_Sound_Cloud_Widget() );
		


		//Dual Heading
		require_once( __DIR__ . '/widgets/dual-heading/dual-heading.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Elementor_Heading_dual_Widget() );

		require_once( __DIR__ . '/widgets/image-about-home/about-image.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Quote_Widget() );
		
	
		if( isset( $rtelements_addon_setting['rt_image_showcase_setting'] ) == 'rselement_image_showcase' ) {
		require_once( __DIR__ . '/widgets/image-widget/image.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Image_Showcase_Widget() );		
		}

		if( isset( $rtelements_addon_setting['rt_team_gread_setting'] ) == 'rt_team_gread_setting' ) {
			require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Team_Grid_Widget() );
		}

		//Team Slider
		if( isset( $rtelements_addon_setting['rt_team_slider_setting'] ) == 'rt_team_slider_setting' ) {
			require_once( __DIR__ . '/widgets/team-member-slider/team-slider-widget.php' );		
			\Elementor\Plugin::instance()->widgets_manager->register( new \RTElements_Elementor_Team_Slider_Widget() );
		}

		//Service Grid
		if( isset( $rtelements_addon_setting['rt_service_grid_setting'] ) == 'rt_service_grid_setting' ) {
			require_once( __DIR__ . '/widgets/services/service-grid.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Sservices_Grid_Widget() );	
		}

		//Service Slider
		if( isset( $rtelements_addon_setting['rt_service_slider_setting'] ) == 'rt_service_slider_setting' ) {
			require_once( __DIR__ . '/widgets/services/service-slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Services_Slider_Widget() );
		}

		//Video
		if( isset( $rtelements_addon_setting['rt_video_setting'] ) == 'rt_video_setting' ) {
			require_once( __DIR__ . '/widgets/video/rt-video.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Video_Widget() );
		}

		//Button
		if( isset( $rtelements_addon_setting['rt_button_setting'] ) == 'rt_button_setting' ) {
			require_once( __DIR__ . '/widgets/button/button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Button_Widget() );
		}
		//Testimonial Slider
		if( isset( $rtelements_addon_setting['rt_testimonial_slider_setting'] ) == 'rt_testimonial_slider_setting' ) {
			require_once( __DIR__ . '/widgets/slider/slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Slider_Widget() );
		}


		//Blog Grid
        if( isset( $rtelements_addon_setting['rt_blog_grid_setting'] ) == 'rtelement_blog_grid' ){
			require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Grid_Widget () );
		}

		if( isset( $rtelements_addon_setting['rt_tab_setting'] ) == 'rtelement_tab' ){
			require_once( __DIR__ . '/widgets/tab/tab.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Tab_Widget() );
		}
		
		if( isset( $rtelements_addon_setting['rt_counter_setting'] ) == 'rtelement_counter' ){
			require_once( __DIR__ . '/widgets/counter/rt-counter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Counter_Widget() );
		}

		//Contact Form 7
		if( isset( $rtelements_addon_setting['rt_contact_form_7_setting'] ) == 'rs_contact_form_7_setting' ) {
			require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_CF7_Widget() );
		}
		//Logo Showcase
        if( isset( $rtelements_addon_setting['rt_logo_showcase_setting'] ) == 'rtelement_logo_showcase' ){
		require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Logo_Showcase_Widget() );
		}

		//Blog Slider
        if( isset( $rtelements_addon_setting['rt_blog_slider_setting'] ) == 'rtelement_blog_slider' ){
			require_once( __DIR__ . '/widgets/blog-slider/blog-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Slider_Widget() );
		}
		
		//price table
		if( isset( $rtelements_addon_setting['rt_pricing_table_setting'] ) == 'rselement_pricing_table' ) {
			require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Pricing_Table_Widget() );
		}

		//Portfolio Grid
        if( isset( $rtelements_addon_setting['rt_portfolio_grid_setting'] ) == 'rtelement_portfolio_grid' ){
			require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Portfolio_Grid_Widget() );
		}

		//Newsletter
        if( isset( $rtelements_addon_setting['rt_newsletter_setting'] ) == 'rtelement_newsletter' ){
			require_once( __DIR__ . '/widgets/mailchimp/mailchimp.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Mailchimp_Widget() );
		}

		//Accordion
		if( isset( $rtelements_addon_setting['rt_accordion_setting'] ) == 'rt_accordion_setting' ) {
			require_once( __DIR__ . '/widgets/accordion/accordion.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Widget_Accordion() );
		}	
		
		//CTA
		if( isset( $rtelements_addon_setting['rt_cta_setting'] ) == 'rt_cta_setting' ) {				
			require_once( __DIR__ . '/widgets/cta/cta.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_CTA_Widget() );
		}
		
		//Advance Tab
		require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Advance_Tab_Widget() );
		
		//Portfolio Filter
        if( isset( $rtelements_addon_setting['rt_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ){
		require_once( __DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Portfolio_Slider_Widget() );
		}
		
		//Progress Bar
		if( isset( $rtelements_addon_setting['rt_progress_bar_setting'] ) == 'rt_progress_bar_setting' ) {
			require_once( __DIR__ . '/widgets/progress/rs-progress.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Progress_Widget() );	
		}	
	

		if( isset( $rtelements_addon_setting['rt_icon_box_setting'] ) == 'rtelement_icon_box' ){
		require_once( __DIR__ . '/widgets/iconbox/rs-iconbox.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Icon_Box_Widget() );	
		}	
		if( isset( $rtelements_addon_setting['rt_number_grid_setting'] ) == 'rt_number_grid_setting' ) {
			require_once( __DIR__ . '/widgets/number/rt-number.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Elementor_Numnber_Widgets () );	
		}

		//Progress Pie
		if( isset( $rtelements_addon_setting['rt_progress_pie_setting'] ) == 'rt_progress_pie_setting' ) {
		require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reacthemes_Elementor_Progress_Pie_Widget() );		
		}
		//countdown
		if( isset( $rtelements_addon_setting['rt_countdown_setting'] ) == 'rtelement_countdown_box' ){
		require_once( __DIR__ . '/widgets/countdown/countdown.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Countdown_Widget() );
		}

		//Tooltip
        if( isset( $rtelements_addon_setting['rt_tooltip_setting'] ) == 'rtelement_tooltip' ){
		require_once( __DIR__ . '/widgets/tooltip/rs-tooltip.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSTooltip_Box_Widget() );
		}

		//business hour
		if( isset( $rtelements_addon_setting['rt_business_hour_setting'] ) == 'rtelement_business_hour_box' ){
		require_once( __DIR__ . '/widgets/business-hour/rts-hour.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Elementor_Business_Hour_Widget() );
		}
		
		require_once( __DIR__ . '/widgets/image-card/image-card.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Image_Card_Widget() );

		// Marque		
		require_once( __DIR__ . '/widgets/marquee/marquee.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Marquee_Widget() );		
		
		// Marque Testimonial
		require_once( __DIR__ . '/widgets/marque-testimonial/marque-testimonial.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Marque_Testimonial_Widget() );		

		// Line Draw		
		require_once( __DIR__ . '/widgets/line-draw/line-draw.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Line_Draw_Widget() );		
		

	
		if( isset( $rtelements_addon_setting['rt_icon_bar_setting'] ) == 'rselement_contact_box' ) {
			require_once( __DIR__ . '/widgets/header-footer/topbar-icon.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Topbar_Icon_List_Widget() );
		}

		require_once( __DIR__ . '/widgets/client-thumb/client-thumb.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Client_Thumb_Showcase_Widget() );

		require_once( __DIR__ . '/widgets/timeline/timeline.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_timeline_Showcase_Widget() );

		require_once( __DIR__ . '/widgets/company-history/history.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_History_Showcase_Widget() );
		
		require_once( __DIR__ . '/widgets/woocommerce/cart.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Product_Cart() );

		require_once( __DIR__ . '/widgets/header-footer/site-search.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Search_Button() );


		require_once( __DIR__ . '/widgets/header-footer/site-canvas.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Offcanvas() );

		require_once( __DIR__ . '/widgets/header-footer/site-logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Site_Logo() );	

		require_once( __DIR__ . '/widgets/header-footer/site-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Navigation_Menu() );	

		require_once( __DIR__ . '/widgets/header-footer/single-page-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Single_Navigation_Menu() );	

		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Copyright_Widget() );

		require_once( __DIR__ . '/widgets/featured-image/image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Featured_Image_Showcase_Widget() );	
		
		require_once( __DIR__ . '/widgets/portfolio-features-list/feature-list.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Portfolio_Features_List_Widget() );
		
		require_once( __DIR__ . '/widgets/image-parallax/image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Image_Parallax_Widget() );	
						
		// Register widget				
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
		add_action( 'elementor/elements/categories_registered', [$this, 'resgister_header_footer_category'] );
	}
}
RTelements_Elementor_Extension::instance();