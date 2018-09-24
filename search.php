<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package yugen
 */

get_header();

$row_class          = array( 'row' );
$primary_class      = array( 'content-area' );
$post_wrapper_class = array( 'blog-posts search-results-posts d-row' );

if ( yugen_has_secondary_content_class() != 'full-width' ) {
    $row_class[]    = 'have-sidebar';
}

if ( yugen_has_primary_content_class() ) {
    $primary_class[] = yugen_has_primary_content_class();
}


/**
 * Hook - yugen_action_before_main_content
 *
 * @hooked: yugen_action_page_header - 10
 * @hooked: yugen_action_breadcrumbs - 20
 */
do_action( 'yugen_action_before_main_content' ); ?>

    <div class="outer-container">
        <div class="container-fluid">
            <div class="<?php echo esc_attr( implode( ' ', $row_class ) ); ?>">
                <div class="col-12 d-flex flex-wrap">
                    <div id="primary" class="<?php echo esc_attr( implode( ' ', $primary_class ) ); ?>">
                        <main id="main" class="site-main">

                            <?php if ( have_posts() ) : ?>

                                <div class="<?php echo esc_attr( implode( ' ', $post_wrapper_class ) ); ?>">
                                    <?php
                                    while ( have_posts() ) : the_post();

                                        /*
                                         * Include the Post-Type-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                         */
                                        get_template_part( 'template-parts/blog/content', get_post_format() );

                                    endwhile;
                                    ?>

                                </div><!-- .blog-posts -->

                                <?php
                                /**
                                 * Hook - yugen_action_posts_pagination.
                                 *
                                 * @hooked: yugen_add_posts_pagination - 10
                                 */
                                do_action( 'yugen_action_posts_pagination' );

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif; ?>

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

<?php

get_footer();
