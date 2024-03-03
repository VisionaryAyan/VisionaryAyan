<?php
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

defined( 'ABSPATH' ) || die();
class ReacTheme_Widget_Accordion extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'rt-custom-accordions';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RT Accordion', 'rtelements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_style_depends() {

		wp_register_style( 'rtelements-accordion', plugins_url( 'accordion-css/accordion.css', __FILE__ ) );
		
		return [
			'rtelements-accordion'
		];

	}


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'Accordion' ];
    } 

    protected function register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Item', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

    

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Item Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Title', 'rtelements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Item Description', 'rtelements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'rtelements' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                
            ]
        ); 

        $this->add_control(
			'accordion_icon',
			[
				'label' => esc_html__( 'Accordion Icon', 'rtelements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-up',
					'library' => 'solid',
				],			
				'separator' => 'before',			
			]
		);

        $this->add_control(
			'accordion_active_icon',
			[
				'label' => esc_html__( 'Accordion Active Icon', 'rtelements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-down',
					'library' => 'solid',
				],			
				'separator' => 'before',			
			]
		);
        $this->add_control(
            'accordion_style',
            [
                'label'   => esc_html__( 'Select Style', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',               
                'options' => [                    
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',                                
                    'style3' => 'Style 3',                              
                ],                                          
            ]
        );

        $this->add_control(
            'show_title_count',
            [
                'label' => esc_html__( 'Show Title Count', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
       

       $this->end_controls_section();

       $this->start_controls_section(
            '_accordion_style',
            [
                'label' => esc_html__( 'Title Style', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label' => esc_html__( 'Item Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item' => 'background: {{VALUE}} !important',
                ],    
                'separator'   => 'before',            
            ]
        );

        $this->add_responsive_control(
			'_accordion_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rts-accordion.style2 .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

       $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-header button' => 'color: {{VALUE}} !important',
                ],    
                'separator'   => 'before',            
            ]
        );

        $this->add_control(
            'title_color_bg',
            [
                'label' => esc_html__( 'Title Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-header button' => 'background: {{VALUE}} !important',
                ],  
                'separator'   => 'before',              
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button',
			]
		);

        $this->add_control(
			'title_height',
			[
				'label' => esc_html__( 'Height', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'title_color_active',
            [
                'label' => esc_html__( 'Active Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button[aria-expanded=true]' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-header button[aria-expanded=true]' => 'color: {{VALUE}} !important',
                ],   
                'separator'   => 'before',                 
            ]
        );
        $this->add_control(
            'title_color_active_bg',
            [
                'label' => esc_html__( 'Active Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button[aria-expanded=true]' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-header button[aria-expanded=true]' => 'background: {{VALUE}} !important',
                ],   
                'separator'   => 'before',                 
            ]
        );      

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'selector' => '{{WRAPPER}} .accordion .cart-button-rt',
                'selector' => '{{WRAPPER}} .rts-accordion .accordion-item .accordion-button',
			]
		);


       $this->add_control(
            'title_number_color',
            [
                'label' => esc_html__( 'Title Number Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button span' => 'color: {{VALUE}} !important',
                    
                ],
            ]
        );

        $this->add_control(
            'title_icon_color',
            [
                'label' => esc_html__( 'Title Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button:after' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button span i' => 'color: {{VALUE}} !important',                    
                ],
            ]
        );

        $this->add_control(
            'title_active_icon_color',
            [
                'label' => esc_html__( 'Active Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button:before' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header .accordion-icon-active i' => 'color: {{VALUE}} !important',                    
                ],
            ]
        );

        $this->add_control(
            'title_icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button .accordion-icon i' => 'background: {{VALUE}} !important',              
                ],
            ]
        );
        
        $this->add_control(
            'title_icon_active_bg_color',
            [
                'label' => esc_html__( 'Icon Active Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button:before' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header .accordion-icon-active i' => 'background: {{VALUE}} !important',                    
                ],
            ]
        );

        $this->add_responsive_control(
			'title_icon_position',
			[
				'label' => esc_html__( 'Icon Position Right to Left', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
                
				'selectors' => [
					'{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button .accordion-icon' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-header button .accordion-icon-active' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->add_control(
            'desc__color',
            [
                'label' => esc_html__( 'Desccription Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .card-body' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-body' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-body' => 'color: {{VALUE}} !important',
                ],   
                'separator'   => 'before',                 
            ]
        );

        $this->add_control(
            'desc___bg_color',
            [
                'label' => esc_html__( 'Desccription Bg Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .card-body' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-body' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .rts-accordion.style3 .accordion-item .accordion-body' => 'background: {{VALUE}} !important',
                ],   
                'separator'   => 'before',                 
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc__typography',
				'selector' => '{{WRAPPER}} .accordion .card-body',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'desc__border',
				'selector' => '{{WRAPPER}} .rts-accordion.style2 .accordion-item',
			]
		);
        
        $this->add_responsive_control(
			'desc__padding',
			[
				'label' => esc_html__( 'Padding', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rts-accordion.style2 .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

       $this->end_controls_section();

   }
    protected function render() {    	
        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        ?>
        <div class="rts-accordion <?php echo $settings['accordion_style'];?>" id="accordionExample<?php echo $unique;?>">
            <?php $x = 0; 
            foreach ( $settings['logo_list'] as $index => $item ) :
                $title = !empty($item['name']) ? $item['name'] : '';
                $description = !empty($item['description']) ? $item['description'] : '';
             $x++;
         
            if($x== 1){
                $collapse  = '';
                $show = 'show';
                $true = 'true';
            }
            else{
                $collapse  = 'collapsed';
                $show = '';
                $true = 'false';
            }
           
            $dataUnique = $unique . $x;
           
            if( $settings['accordion_style'] == 'style1'): ?>                                
         
                <div class="accordion-item">
                        <div class="accordion-header" id="heading-<?php echo $dataUnique;?>">
                            <button class="accordion-button <?php echo $collapse;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $dataUnique;?>" aria-expanded="<?php echo $true;?>" aria-controls="collapse<?php echo $dataUnique;?>">
                            <?php echo wp_kses_post ($title);?> 
                            </button>
                        </div>
                        <div id="collapse<?php echo $dataUnique;?>" class="accordion-collapse collapse <?php echo $show;?>" aria-labelledby="heading<?php echo $dataUnique;?>" data-bs-parent="#accordionExample<?php echo $unique;?>">
                            <div class="accordion-body">
                            <?php echo esc_attr ($description);?>
                            </div>
                        </div>
                </div>
            <?php else : ?>
                <div class="accordion-item">
                        <div class="accordion-header" id="heading-<?php echo $dataUnique;?>">
                            <button class="accordion-button <?php echo $collapse;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $dataUnique;?>" aria-expanded="<?php echo $true;?>" aria-controls="collapse<?php echo $dataUnique;?>">
                            
                                <?php if($settings['show_title_count']) :?><?php endif;?> 
                                    <?php echo wp_kses_post ($title);?> <span class="accordion-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['accordion_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                    <span class="accordion-icon-active"> <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_active_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                            </button>
                        </div>
                        <div id="collapse<?php echo $dataUnique;?>" class="accordion-collapse collapse <?php echo $show;?>" aria-labelledby="heading<?php echo $dataUnique;?>" data-bs-parent="#accordionExample<?php echo $unique;?>">
                            <div class="accordion-body">
                            <?php echo esc_attr ($description);?>
                            </div>
                        </div>
                </div>
            <?php    

            endif;
                endforeach; ?>                  
                  
            </div>            
        <?php
    }
} ?>