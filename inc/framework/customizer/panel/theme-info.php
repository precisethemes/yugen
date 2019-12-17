<?php
/**
 * Yugen Customizer Themes Info Section
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_theme_info_controls_init' ) ) :

    function yugen_customizer_theme_info_controls_init() {
        /*--------------------------------------------------------------
        # Themes Info Section
        --------------------------------------------------------------*/
        Kirki::add_section( 'yugen_theme_info_section', array(
            'title'          => esc_html__( 'Themes Info', 'yugen' ),
            'priority'       => 200,
            'capability'     => 'edit_theme_options',
        ) );

        /*--------------------------------------------------------------
        # Themes Info Section
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'yugen_theme_info_theme_link',
                'section'     => 'yugen_theme_info_section',
                'default'     => '<a target="_blank" href="' . esc_url( 'https://precisethemes.com/yugen/' ) . '">'.esc_html( 'Theme Info', 'yugen' ).'</a>',
            )
        );

        yugen_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'yugen_theme_info_support_link',
                'section'     => 'yugen_theme_info_section',
                'default'     => '<a target="_blank" href="' . esc_url( 'https://precisethemes.com/support-forum/forum/yugen/' ) . '">'.esc_html( 'Support', 'yugen' ).'</a>',
            )
        );

        yugen_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'yugen_theme_info_docs_link',
                'section'     => 'yugen_theme_info_section',
                'default'     => '<a target="_blank" href="' . esc_url( 'https://precisethemes.com/docs/yugen/' ) . '">'.esc_html( 'Documentation', 'yugen' ).'</a>',
            )
        );

        yugen_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'yugen_theme_info_demo_link',
                'section'     => 'yugen_theme_info_section',
                'default'     => '<a target="_blank" href="' . esc_url( 'https://precisethemes.com/demo/yugen/' ) . '">'.esc_html( 'View Demos', 'yugen' ).'</a>',
            )
        );
    }
endif;
add_action( 'init', 'yugen_customizer_theme_info_controls_init', 999 );