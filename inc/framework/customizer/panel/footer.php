<?php
/**
 * Theme Customizer Post Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_footer_controls_init' ) ) :

    function yugen_customizer_footer_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_footer_panel', array(
            'priority'      => 126,
            'title'         => esc_html__( 'Footer', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_footer_widgets_section'      => array( esc_attr__( 'Widgets', 'yugen' ), '' ),
            'yugen_footer_bar_section'          => array( esc_attr__( 'Footer Bar', 'yugen' ), '' ),
            'yugen_footer_separator_section'    => array( esc_attr__( 'Footer Bar Separator', 'yugen' ), '' ),
        );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_footer_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Footer Widgets: Layout
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'yugen_footer_widgets_area_layout',
                'label'       => esc_html__( 'Layout', 'yugen' ),
                'section'     => 'yugen_footer_widgets_section',
                'default'     => 'footer-layout-8',
                'choices'     => array(
                    'footer-layout-8'           => YUGEN_THEME_URI . '/assets/back-end/images/footer/footer-layout-widgets.svg'
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Widgets: Content Order
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'yugen_footer_bar_content_order_list',
                'label'       => esc_html__( 'Content Order', 'yugen' ),
                'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'yugen' ),
                'section'     => 'yugen_footer_bar_section',
                'default'     => array(
                    'footer-bar-text',
                ),
                'choices'     => array(
                    'footer-bar-text'       => esc_attr__( 'Copyright Text', 'yugen' ),
                    'footer-bar-menu'       => esc_attr__( 'Footer Menu', 'yugen' ),
                    'footer-bar-social'     => esc_attr__( 'Social Icons', 'yugen' ),
                ),
                'partial_refresh'   => array(
                    'yugen_footer_bar_content_order_list'   => array(
                        'selector'                          => '#colophon',
                        'render_callback'                   => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Widgets: Footer Menu
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'select',
                'settings'    => 'yugen_footer_bar_menu_id',
                'label'       => esc_html__( 'Display a menu', 'yugen' ),
                'section'     => 'yugen_footer_bar_section',
                'choices'     => yugen_get_menus(),
                'active_callback'  => array(
                    array(
                        'setting'  => 'yugen_footer_bar_content_order_list',
                        'operator' => 'in',
                        'value'    => array( 'footer-bar-menu' ),
                    ),
                ),
            )
        );

    }
endif;
add_action( 'init', 'yugen_customizer_footer_controls_init', 999 );
