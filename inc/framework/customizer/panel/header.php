<?php
/**
 * Theme Customizer Header Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_header_controls_init' ) ) :

    function yugen_customizer_header_controls_init() {
        /*--------------------------------------------------------------
        # Panel Header
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_header_panel', array(
            'priority'      => 2,
            'title'         => esc_html__( 'Header', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'header_image'                              => array( esc_attr__( 'Header Image', 'yugen' ), '' ),
            'title_tagline'                             => array( esc_attr__( 'Site Title & Tagline', 'yugen' ), '' ),
        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_header_panel',
            );

            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }

            Kirki::add_section( $section_id, $section_args );
        }
        /*--------------------------------------------------------------
        # Header Image: Background Overlay Color
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'color',
                'label'       => esc_html__( 'Background Overlay', 'yugen' ),
                'settings'    => 'yugen_header_image_overlay_color',
                'section'     => 'header_image',
                'default'     => 'rgba(255,255,255,0.25)',
                'choices'     => array(
                    'alpha' => true,
                ),
                'js_vars'   => array(
                    array(
                        'element'  => array( '.site-header .nav-bar::after' ),
                        'property' => 'background-color',
                        'suffix'   => ' !important'
                    )
                ),
                'output'   => array(
                    array(
                        'element'  => array( '.site-header .nav-bar::after' ),
                        'property' => 'background-color',
                        'suffix'   => ' !important'
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Site Logo Height
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'priority'      => 8,
                'type'          => 'slider',
                'settings'      => 'yugen_site_branding_logo_height',
                'label'         => esc_html__( 'Logo Height', 'yugen' ),
                'section'       => 'title_tagline',
                'default'       => 72,
                'choices'       => array(
                    'min'       => '0',
                    'max'       => '200',
                    'suffix'    => 'px',
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'       => array( '.site-branding .custom-logo' ),
                        'property'      => 'height',
                        'units'         => 'px',
                    ),
                ),
                'output'   =>  array(
                    array(
                        'element'       => array( '.site-branding .custom-logo' ),
                        'property'      => 'height',
                        'units'         => 'px',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Site Title Control
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'yugen_header_site_title_visible',
                'section'       => 'title_tagline',
                'label'         => esc_html__( 'Display Site Title', 'yugen' ),
                'default'       => 1,
            )
        );

        /*--------------------------------------------------------------
        # Tagline Control
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'              => 'toggle',
                'settings'          => 'yugen_header_site_tagline_visible',
                'section'           => 'title_tagline',
                'label'             => esc_html__( 'Display Tagline', 'yugen' ),
                'default'           => 1,
            )
        );
    }
endif;
add_action( 'init', 'yugen_customizer_header_controls_init', 999 );
