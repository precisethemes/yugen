<?php
/**
 * Theme Customizer Post Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_post_controls_init' ) ) :

    function yugen_customizer_post_controls_init() {
        /*--------------------------------------------------------------
        # Post Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_post_panel', array(
            'priority'      => 122,
            'title'         => esc_html__( 'Single Post Settings', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_post_content_settings_section'       => array( esc_attr__( 'Content Settings', 'yugen' ), '' ),
            'yugen_post_sidebar_section'                => array( esc_attr__( 'Sidebar', 'yugen' ), '' ),
        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_post_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*----------------------------------------------------------------------------------------------------------------------------
        # Content settings controls
        ----------------------------------------------------------------------------------------------------------------------------*

        /*-------------------------------------------------------------
        # Header Section
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'yugen_post_content_header_elements_order',
                'label'       => esc_html__( 'Content Header Section', 'yugen' ),
                'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'yugen' ),
                'section'     => 'yugen_post_content_settings_section',
                'default'     => array( 'post-thumbnail','post-title' ),
                'choices'     => array(
                    'post-thumbnail'        => esc_attr__( 'Featured Image', 'yugen' ),
                    'post-title'            => esc_attr__( 'Title', 'yugen' ),

                ),
                'partial_refresh'   => array(
                    'yugen_post_content_header_elements_order'  => array(
                        'selector'                              => '.single .content-area .site-main',
                        'render_callback'                       => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Section
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'yugen_post_content_footer_elements_order',
                'label'       => esc_html__( 'Content Footer Section', 'yugen' ),
                'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'yugen' ),
                'section'     => 'yugen_post_content_settings_section',
                'default'     => array('post-cats','post-tags','post-navigation','comment-section'),
                'choices'     => array(
                    'post-cats'             => esc_attr__( 'Categories', 'yugen' ),
                    'post-tags'             => esc_attr__( 'Tags ', 'yugen' ),
                    'related-posts'         => esc_attr__( 'Related Posts', 'yugen' ),
                    'post-navigation'       => esc_attr__( 'Post Navigation', 'yugen' ),
                    'comment-section'       => esc_attr__( 'Comment Section', 'yugen' ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Post Sidebar Layout
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'yugen_post_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'yugen' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for all single post.','yugen' ),
                'section'     => 'yugen_post_sidebar_section',
                'default'     => 'default',
                'choices'     => array(
                    'default'           => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/default-sidebar.svg',
                    'left-sidebar'      => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/left-sidebar.svg',
                    'full-width'        => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/no-sidebar.svg',
                    'right-sidebar'     => YUGEN_THEME_URI . '/assets/back-end/images/sidebar/right-sidebar.svg',

                ),
            )
        );
    }

endif;
add_action( 'init', 'yugen_customizer_post_controls_init', 999 );

