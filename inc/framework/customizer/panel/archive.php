<?php
/**
 * Theme Customizer Blog Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_blog_controls_init' ) ) :

    function yugen_customizer_blog_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_archive_page_panel', array(
            'priority'      => 122,
            'title'         => esc_html__( 'Archive/Blog Settings', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_global_page_header_section'              => array( esc_attr__( 'Page Header', 'yugen' ), '' ),
            'yugen_archive_page_column_section'             => array( esc_attr__( 'Column Settings', 'yugen' ), '' ),
            'yugen_archive_page_thumbnail_section'          => array( esc_attr__( 'Thumbnail Placeholder', 'yugen' ), '' ),
            'yugen_archive_page_sidebar_section'            => array( esc_attr__( 'Sidebar', 'yugen' ), '' ),
        );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_archive_page_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Page Header: Background Image
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'image',
                'label'       => esc_html__( 'Background Image', 'yugen' ),
                'settings'    => 'yugen_global_page_header_bg_image',
                'section'     => 'yugen_global_page_header_section',
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'  =>  array( '.page-header' ),
                        'property' => 'background-image',
                    )
                ),
                'output'   => array(
                    array(
                        'element'  =>  array( '.page-header' ),
                        'property' => 'background-image',
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
        # Page Header: Background Overlay Color
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'color',
                'label'       => esc_html__( 'Background Overlay', 'yugen' ),
                'settings'    => 'yugen_global_page_header_bg_overlay_color',
                'section'     => 'yugen_global_page_header_section',
                'default'     => 'rgb(0,0,0,.15)',
                'choices'     => array(
                    'alpha' => true,
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'  =>  array( '.page-header::after' ),
                        'property' => 'background-color',
                    )
                ),
                'output'   => array(
                    array(
                        'element'  =>  array( '.page-header::after' ),
                        'property' => 'background-color',
                    )
                ),
            )
        );

        /*--------------------------------------------------------------
       # Page Header: Color Scheme
       --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'select',
                'settings'    => 'yugen_global_page_header_color_scheme',
                'label'       => esc_html__( 'Color Scheme', 'yugen' ),
                'section'     => 'yugen_global_page_header_section',
                'default'     => 'cs-light',
                'choices'     => array(
                    'cs-light'          => esc_html__( 'Light', 'yugen' ),
                    'cs-dark'           => esc_html__( 'Dark', 'yugen' ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Column Settings: Columns Per Row
        --------------------------------------------------------------*/
        //Desktop
        yugen_add_field(
            array(
                'type'        => 'select',
                'settings'    => 'yugen_archive_page_col_per_row_desktop',
                'label'       => esc_html__( 'Posts Per Row', 'yugen' ),
                'section'     => 'yugen_archive_page_column_section',
                'default'     => 'w-33',
                'choices'     => array(
                    'w-33'    => 3,
                    'w-25'    => 4,
                    'w-20'    => 5,
                ),
            )
        );

        /*--------------------------------------------------------------
        # Column Settings: Spacing
        --------------------------------------------------------------*/
        // Desktop
        yugen_add_field(
            array(
                'type'          => 'slider',
                'settings'      => 'yugen_archive_page_col_padding_x_desktop',
                'section'       => 'yugen_archive_page_column_section',
                'label'         => esc_html__( 'Column Spacing', 'yugen' ),
                'description'   => esc_html__( 'Add space to left and right side of each post.', 'yugen' ),
                'default'       => 32,
                'choices'       => array(
                    'min'       => '16',
                    'max'       => '100',
                    'suffix'    => 'px',
                ),
                'transport'     =>  'postMessage',
                'js_vars'       =>  array(
                    array(
                        'element'       => array( '.blog-posts.d-row .grid-column' ),
                        'property'      => 'padding-right',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.blog-posts.d-row .grid-column,' ),
                        'property'      => 'padding-left',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.archive .blog-posts.d-row, .home .blog-posts.d-row' ),
                        'property'      => 'margin-right',
                        'prefix'        => '-',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.archive .blog-posts.d-row, .home .blog-posts.d-row' ),
                        'property'      => 'margin-left',
                        'prefix'        => '-',
                        'value_pattern' => '$px'
                    )
                ),
                'output'        =>  array(
                    array(
                        'element'       => array( '.blog-posts.d-row .grid-column' ),
                        'property'      => 'padding-right',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.blog-posts.d-row .grid-column' ),
                        'property'      => 'padding-left',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.archive .blog-posts.d-row, .home .blog-posts.d-row' ),
                        'property'      => 'margin-right',
                        'prefix'        => '-',
                        'value_pattern' => '$px'
                    ),
                    array(
                        'element'       => array( '.archive .blog-posts.d-row, .home .blog-posts.d-row' ),
                        'property'      => 'margin-left',
                        'prefix'        => '-',
                        'value_pattern' => '$px',
                    )
                )
            )
        );

        /*--------------------------------------------------------------
        # Thumbnail Placeholder
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'toggle',
                'label'       => esc_html__( 'Show Placeholder', 'yugen' ),
                'description' => esc_html__( 'Show grey background colored box in absence of post thumbnail.', 'yugen' ),
                'settings'    => 'yugen_archive_page_thumbnail_placeholder',
                'section'     => 'yugen_archive_page_thumbnail_section',
                'default'     => 1,
            )
        );

        /*--------------------------------------------------------------
        # Archive/Blog Sidebar Layout
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'yugen_archive_page_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'yugen' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for all archive pages.','yugen' ),
                'section'     => 'yugen_archive_page_sidebar_section',
                'default'     => 'full-width',
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
add_action( 'init', 'yugen_customizer_blog_controls_init', 999 );
