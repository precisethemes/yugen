<?php
/**
 * Sample implementation of the Custom widgets and sidebar feature
 *
 * @package yugen
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// Register Sidebars
function yugen_widgets_init() {

    // Register Default Sidebar
    register_sidebar( array(
        'name'          => esc_html__('Sidebar', 'yugen'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'yugen'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    /* ---------------------------------------------
    # Footer Widget Areas
    ---------------------------------------------*/
    $footer_widgets_layout      = get_theme_mod( 'yugen_footer_widgets_area_layout', 'footer-layout-8' );
    $number_of_widgets          = 1;
    if ($footer_widgets_layout == 'footer-layout-8' ) {
        $number_of_widgets      = 4;
    }

    for ($i = 1; $i <= $number_of_widgets; $i++) {

        register_sidebar( array(
            'name'          => sprintf( esc_html__('Footer Widgets Column %d', 'yugen'), $i),
            'id'            => 'footer_sidebar_' . $i,
            'description'   => esc_html__('Add widgets here.', 'yugen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }

    register_widget( "Yugen_Social_Profiles_Widget" );
    register_widget( "Yugen_About_Us_Widget" );
}
add_action( 'widgets_init', 'yugen_widgets_init' );

require YUGEN_THEME_DIR . '/inc/framework/widgets/social-profiles-widget.php';
require YUGEN_THEME_DIR . '/inc/framework/widgets/about-widget.php';
