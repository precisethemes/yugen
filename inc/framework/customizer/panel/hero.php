<?php
/**
 * Theme Customizer Hero Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_hero_controls_init' ) ) :

    function yugen_customizer_hero_controls_init() {
        /*--------------------------------------------------------------
        # Panel Hero Slider
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_hero_panel', array(
            'priority'  =>  122,
            'title'     =>  esc_html__( 'Hero Section', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_hero_visibility'                 => array( esc_attr__( 'Visibility', 'yugen' ), '' ),
            'yugen_hero_content_section'            => array( esc_attr__( 'Content & Settings', 'yugen' ), '' ),
        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_hero_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*------------------------------------------------------
        # Enable Hero Slider on Homepage Control
        -------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'              => 'toggle',
                'settings'          => 'yugen_hero_on_home_enable',
                'label'             => esc_html__( 'Homepage', 'yugen' ),
                'description'       => esc_html__( 'Enable hero slider on Homepage.', 'yugen' ),
                'section'           => 'yugen_hero_visibility',
            )
        );

        /*------------------------------------------------------
        # Hero Slides
        -------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'repeater',
                'section'     => 'yugen_hero_content_section',
                'row_label' => array(
                    'type'  => 'field',
                    'value' => esc_attr__('Content', 'yugen' ),
                ),
                'settings'    => 'yugen_repeatable_hero_slides',
                'default'     => array(
                    array(
                        'hero_image'        => YUGEN_THEME_URI . '/assets/back-end/images/hero/hero-default.png',
                        'hero_title'        => esc_attr__( 'Hero Title', 'yugen' ),
                        'hero_subtitle'     => esc_attr__( 'Hero Subtitle', 'yugen' ),
                        'hero_desc'         => esc_attr__( 'Hero Short Description Here.', 'yugen' ),
                        'hero_button_text'  => esc_attr__( 'Read More', 'yugen' ),
                        'hero_button_link'  => '#',
                        'hero_button_link_open' => '_self',
                    ),
                ),
                'choices'       => array(
                    'limit'     => 1
                ),
                'fields' => array(
                    'hero_image' => array(
                        'type'        => 'image',
                        'label'       => esc_attr__( 'Image', 'yugen' ),
                        'description' => esc_html__( 'Recommend image width is 1800px.', 'yugen' ),
                        'default'     => '',
                    ),
                    'hero_title' => array(
                        'type'        => 'text',
                        'label'       => esc_attr__( 'Title', 'yugen' ),
                        'default'     => '',
                    ),
                    'hero_subtitle' => array(
                        'type'        => 'text',
                        'label'       => esc_attr__( 'Subtitle', 'yugen' ),
                        'default'     => '',
                    ),
                    'hero_desc' => array(
                        'type'        => 'textarea',
                        'label'       => esc_attr__( 'Short Description', 'yugen' ),
                        'default'     => '',
                    ),
                    'hero_button_text' => array(
                        'type'        => 'text',
                        'label'       => esc_attr__( 'Button Text', 'yugen' ),
                        'default'     => 'Read More',
                    ),
                    'hero_button_link' => array(
                        'type'        => 'link',
                        'label'       => esc_attr__( 'Button URL', 'yugen' ),
                        'default'     => '#',
                    ),
                    'hero_button_link_open' => array(
                        'type'        => 'radio',
                        'label'       => esc_attr__( 'Open Button URL', 'yugen' ),
                        'default'     => '_self',
                        'choices'     => array(
                            '_self'     => esc_attr__( 'Same Window', 'yugen' ),
                            '_blank'    => esc_attr__( 'New Window', 'yugen' ),
                        ),
                    ),
                ),
                'partial_refresh'   => array(
                    'yugen_repeatable_hero_slides'  => array(
                        'selector'                  => '.hero-container',
                        'render_callback'           => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Hero Overlay Background Color
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'      =>  'color',
                'settings'  =>  'yugen_hero_overlay_bg_color',
                'section'   =>  'yugen_hero_content_section',
                'label'     =>  esc_html__( 'Overlay Background Color', 'yugen' ),
                'default'   =>  'rgba(255,255,255,.5)',
                'choices'   => array(
                    'alpha' => true,
                ),
                'transport'     =>  'postMessage',
                'js_vars'       =>  array(
                    array(
                        'element'   =>  array( '.hero-content .post-thumbnail::after' ),
                        'function'  =>  'css',
                        'property'  =>  'background'
                    )
                ),
                'output'        =>  array(
                    array(
                        'element'   =>  array( '.hero-content .post-thumbnail::after' ),
                        'function'  =>  'css',
                        'property'  =>  'background'
                    )
                )
            )
        );

        /*--------------------------------------------------------------
        # Hero Title Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'Title Typography', 'yugen' ),
                'settings'    => 'yugen_hero_title_typography',
                'section'     => 'yugen_hero_content_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '700',
                    'font-size'      => '48px',
                    'line-height'    => '1.5',
                    'letter-spacing' => '1',
                    'color'          => '#000',
                    'text-transform' => 'none',
                ),
                'choices' => array(
                    'fonts' => array(
                        'google' => array(
                            'Roboto',
                            'Cormorant Garamond'
                        ),
                    ),
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'  => array( '.hero-content .content-wrap .entry-title' ),
                    ),
                ),
                'output'   =>  array(
                    array(
                        'element'  => array( '.hero-content .content-wrap .entry-title' ),
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Hero Subtitle Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'Subtitle Typography', 'yugen' ),
                'settings'    => 'yugen_hero_subtitle_typography',
                'section'     => 'yugen_hero_content_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => '400',
                    'font-size'      => '13px',
                    'line-height'    => '1.5',
                    'letter-spacing' => '2',
                    'color'          => '#666',
                    'text-transform' => 'uppercase',
                ),
                'choices' => array(
                    'fonts' => array(
                        'google' => array(
                            'Roboto',
                            'Cormorant Garamond'
                        ),
                    ),
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'       => array( '.hero-content .entry-subtitle' ),
                    ),
                ),
                'output'   =>  array(
                    array(
                        'element'       => array( '.hero-content .entry-subtitle' ),
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Hero Description Typography
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'Description Typography', 'yugen' ),
                'settings'    => 'yugen_hero_description_typography',
                'section'     => 'yugen_hero_content_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => '300',
                    'font-size'      => '16px',
                    'line-height'    => '1.8',
                    'letter-spacing' => '1',
                    'color'          => '#333',
                    'text-transform' => 'none',
                ),
                'choices' => array(
                    'fonts' => array(
                        'google' => array(
                            'Roboto',
                            'Cormorant Garamond'
                        ),
                    ),
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'  => '.hero-content .entry-content',
                    ),
                ),
                'output'        =>  array(
                    array(
                        'element'  => '.hero-content .entry-content',
                    )
                ),
            )
        );

    }
endif;
add_action( 'init', 'yugen_customizer_hero_controls_init', 999 );

