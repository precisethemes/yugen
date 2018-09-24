<?php
/**
 * Functions hooked to custom hook
 *
 * @package yugen
 */

/*----------------------------------------------------------------------
# Header type hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_add_header' ) ) :

    /**
     * Add Header Type Section
     *
     * @since 0.1.0
     */
    function yugen_add_header() {
        $inline_style = '';
        if ( get_header_image() ) {
            $inline_style = ' style="background-image:url(' . esc_url( get_header_image() ) . ');background-attachment:scroll;background-repeat:no-repeat;background-size:cover;background-position:center;"';
        } ?>

        <div class="nav-bar"<?php echo $inline_style; ?>>
            <div class="outer-container">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <?php get_template_part( 'template-parts/header/header-layout', 4 ); ?>
                    </div><!-- .row -->
                </div><!-- .container-fluid -->
            </div><!-- .outer-container -->
        </div><!-- .nav-bar -->
        <?php
    }

endif;

add_action( 'yugen_action_header', 'yugen_add_header', 10 );


/*----------------------------------------------------------------------
# Hero section hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_add_after_header_hero' ) ) :

    /**
     * Add Hero Section
     *
     * @since 0.1.0
     */
    function yugen_add_after_header_hero() {

        $home = get_theme_mod( 'yugen_hero_on_home_enable' );

        if ( ( is_front_page() || is_home() ) && $home == true ){ //Homepage or Static homepage

            get_template_part( 'template-parts/hero/content', 'hero' ); // Hero Content

        }

    }

endif;

add_action( 'yugen_action_after_header', 'yugen_add_after_header_hero', 10 );


/*----------------------------------------------------------------------
# Page header hook / Breadcrumbs hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_action_page_header' ) ) :

    /**
     * Add Page Header
     *
     * @since 0.1.0
     */
    function yugen_action_page_header() {

        if ( is_archive() ) { ?>

            <div class="page-header archive-header cs-light">
                <div class="outer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-left">

                                <?php
                                    yugen_archive_get_title('<h1 class="page-title w-100">', '</h1>');
                                    the_archive_description('<div class="archive-description w-100">', '</div>');
                                ?>

                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container-fluid -->
                </div><!-- .outer-container -->
            </div><!-- .page-header -->

            <?php
        }

        elseif( is_search() ) { ?>

            <div class="page-header archive-header cs-light">
                <div class="outer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-left">
                                <h1 class="page-title w-100">
                                    <?php
                                    /* translators: %s: search query. */
                                    printf( esc_html__( 'Search Results for: %s', 'yugen' ), '<span>' . get_search_query() . '</span>' );
                                    ?>
                                </h1>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container-fluid -->
                </div><!-- .outer-container -->
            </div><!-- .page-header -->

        <?php }

        elseif ( is_404() ) { ?>

            <div class="page-header error-404-header cs-light">
                <div class="outer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-left">

                                <h1 class="page-title w-100"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'yugen' ); ?></h1>

                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container-fluid -->
                </div><!-- .outer-container -->
            </div><!-- .page-header -->

        <?php }

    }

endif;

if ( ! function_exists( 'yugen_action_breadcrumbs' ) ) :

    /**
     * Add Breadcrumbs
     *
     * @since 0.1.0
     */
    function yugen_action_breadcrumbs() {

        get_template_part( 'template-parts/breadcrumb/content', 'breadcrumb' ); // Breadcrumb
    }

endif;

add_action( 'yugen_action_before_main_content', 'yugen_action_page_header', 10 );
add_action( 'yugen_action_before_main_content', 'yugen_action_breadcrumbs', 20 );


/*----------------------------------------------------------------------
# Sidebar hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_add_sidebar' ) ) :

    /**
     * Add Sidebar
     *
     * @since 0.1.0
     */
    function yugen_add_sidebar() {

        get_sidebar(); // sidebar area

    }

endif;

add_action( 'yugen_action_sidebar', 'yugen_add_sidebar', 10 );

/*----------------------------------------------------------------------
# Footer widget hook / Footer bar hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_add_footer_widgets' ) ) :

    /**
     * Add footer widgets
     *
     * @since 0.1.0
     */
    function yugen_add_footer_widgets() {

        get_template_part( 'template-parts/footer/footer', 'widget' ); // Footer Widget Area

    }

endif;

if ( ! function_exists( 'yugen_add_footer_bar' ) ) :

    /**
     * Add footer bar
     *
     * @since 0.1.0
     */
    function yugen_add_footer_bar() {

        get_template_part( 'template-parts/footer/footer', 'bar' ); // Footer Bar

    }

endif;

add_action( 'yugen_action_footer', 'yugen_add_footer_widgets', 10 );
add_action( 'yugen_action_footer', 'yugen_add_footer_bar', 20 );


/*----------------------------------------------------------------------
# Post Pagination hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_add_posts_pagination' ) ) :

    /**
     * Add custom posts pagination
     *
     * @since 0.1.0
     */
    function yugen_add_posts_pagination() {

        the_posts_pagination();

    }

endif;

add_action( 'yugen_action_posts_pagination', 'yugen_add_posts_pagination', 10 );



/*----------------------------------------------------------------------
# Filter Post Navigation hook
-------------------------------------------------------------------------*/

if ( ! function_exists( 'yugen_add_class_next_post_link' ) ) { // Next Post
    function yugen_add_class_next_post_link($html){

        $html = str_replace('<a','<a class="position-relative d-block td-none"',$html);
        return $html;
    }
}


if ( ! function_exists( 'yugen_add_class_previous_post_link' ) ) { // Previous Post
    function yugen_add_class_previous_post_link($html){

        $html = str_replace('<a','<a class="position-relative d-block td-none"',$html);
        return $html;
    }
}

add_filter('next_post_link','yugen_add_class_next_post_link',10,1);
add_filter('previous_post_link','yugen_add_class_previous_post_link',10,1);
