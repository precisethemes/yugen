<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yugen
 */

get_header();

$row_class          = array( 'row' );
$primary_class      = array( 'content-area' );

if ( yugen_has_secondary_content_class() != 'full-width' ) {
    $row_class[]    = 'have-sidebar';
}

if ( yugen_has_primary_content_class() ) {
    $primary_class[] = yugen_has_primary_content_class();
}

while ( have_posts() ) : the_post(); ?>

    <?php
    /**
     * Hook - yugen_action_before_main_content
     *
     * @hooked: yugen_action_page_header - 10
     * @hooked: yugen_action_breadcrumbs - 20
     */
    do_action( 'yugen_action_before_main_content' );
    ?>

    <div class="outer-container mt-80">
        <div class="container-fluid">
            <div class="<?php echo esc_attr( implode( ' ', $row_class ) ); ?>">
                <div class="col-12 d-flex flex-wrap">
                    <div id="primary" class="<?php echo esc_attr( implode( ' ', $primary_class ) ); ?>">
                        <main id="main" class="site-main">
                            <?php get_template_part( 'template-parts/page/content', 'page' ); ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->

                    <?php
                    /**
                     * Hook - yugen_action_sidebar.
                     *
                     * @hooked: yugen_add_sidebar - 10
                     */
                    do_action( 'yugen_action_sidebar' ); ?>

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .outer-container -->

<?php endwhile; // End of the loop.

get_footer();
