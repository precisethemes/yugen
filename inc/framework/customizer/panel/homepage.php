<?php
/**
 * Theme Customizer Homepage Settings Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_homepage_controls_init' ) ) :

    function yugen_homepage_controls_init() {
        /*--------------------------------------------------------------
        # Homepage: Sidebar Layout
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'yugen_home_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'yugen' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for home or static home page.','yugen' ),
                'section'     => 'static_front_page',
                'default'     => 'full-width',
                'choices'     => array(
                    'default'           => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/default-sidebar.svg',
                    'left-sidebar'      => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/left-sidebar.svg',
                    'full-width'        => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/no-sidebar.svg',
                    'right-sidebar'     => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/right-sidebar.svg',

                )
            )
        );

    }
endif;
add_action( 'init', 'yugen_homepage_controls_init', 999 );
