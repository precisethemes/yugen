<?php
/**
 * Theme Customizer General Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_general_controls_init' ) ) :

    function yugen_customizer_general_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_general_panel', array(
            'priority'  =>  2,
            'title'     =>  esc_html__( 'General Settings', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_base_typography_section'                 => array( esc_attr__( 'Typography', 'yugen' ), '' ),
            'yugen_global_sidebar_section'                  => array( esc_attr__( 'Sidebar', 'yugen' ), '' ),
            'colors'                                        => array( esc_attr__( 'Colors', 'yugen' ), '' ),
            'yugen_general_bck_to_top_section'              => array( esc_attr__( 'Back to Top', 'yugen' ), '' ),
        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_general_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Base : Body Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'Body', 'yugen' ),
                'settings'    => 'yugen_body_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => '400',
                    'font-size'      => '15px',
                    'line-height'    => '1.6',
                    'color'          => '#000',
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
                        'element'   => array( 'body' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'body' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H1 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H1', 'yugen' ),
                'settings'    => 'yugen_h1_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '700',
                    'font-size'      => '2.5rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h1' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h1' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H2 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H2', 'yugen' ),
                'settings'    => 'yugen_h2_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '700',
                    'font-size'      => '2rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h2' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h2' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H3 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H3', 'yugen' ),
                'settings'    => 'yugen_h3_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '500',
                    'font-size'      => '1.75rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h3' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h3' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H4 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H4', 'yugen' ),
                'settings'    => 'yugen_h4_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '500',
                    'font-size'      => '1.5rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h4' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h4' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H5 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H5', 'yugen' ),
                'settings'    => 'yugen_h5_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '500',
                    'font-size'      => '1.25rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h5' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h5' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Base : H6 Typography
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'        => 'typography',
                'label'       => esc_html__( 'H6', 'yugen' ),
                'settings'    => 'yugen_h6_typography',
                'section'     => 'yugen_base_typography_section',
                'default'     => array(
                    'font-family'    => 'Cormorant Garamond',
                    'variant'        => '4500',
                    'font-size'      => '1rem',
                    'line-height'    => '1.4',
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
                        'element'   => array( 'h6' ),
                    ),
                ),
                'output'    =>  array(
                    array(
                        'element'   => array( 'h6' ),
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Global Sidebar Layout
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'yugen_global_sidebar_layout',
                'label'       => esc_html__( 'Layout', 'yugen' ),
                'description' => esc_html__( 'This sidebar will be reflected in whole site blog, archives, categories, tags, authors and search result page.', 'yugen' ),
                'section'     => 'yugen_global_sidebar_section',
                'default'     => 'right-sidebar',
                'choices'     => array(
                    'full-width'        => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/no-sidebar.svg',
                    'left-sidebar'      => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/left-sidebar.svg',
                    'right-sidebar'     => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/right-sidebar.svg',

                ),
            )
        );

        /*--------------------------------------------------------------
        # Back to Top: Enable
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'              => 'toggle',
                'settings'          => 'yugen_back_to_top_enable',
                'label'             => esc_html__( 'Enable', 'yugen' ),
                'description'       => esc_html__( 'Enable it to display back to top button.', 'yugen' ),
                'section'           => 'yugen_general_bck_to_top_section',
                'default'           => 1,
                'partial_refresh'   => array(
                    'yugen_back_to_top_enable'   => array(
                        'selector'                 => '.back-to-top',
                        'render_callback'          => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Back to Top: Text
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'      => 'text',
                'settings'  => 'yugen_back_to_top_text',
                'section'   => 'yugen_general_bck_to_top_section',
                'label'     => esc_html__( 'Button Text', 'yugen' ),
                'default'   => esc_html__( 'Back to Top', 'yugen' ),
                'js_vars'   => array(
                    array(
                        'element'  => '.back-to-top',
                        'function' => 'html',
                    ),
                )
            )
        );
    }
endif;
add_action( 'init', 'yugen_customizer_general_controls_init', 999 );
