<?php
/**
 * Related Posts Section.
 *
 * @package yugen
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post,$authordata;
$current_post = $post;
$post_class   = array( 'grid-column' );

$related_post_title             = esc_html__( 'Related Posts', 'yugen' );
$btn_text                       = esc_html__( 'Read More', 'yugen' );
$post_class[]                   = 'w-33';

$args = array(
    'posts_per_page'      => 3,
    'post__not_in'        => array( $current_post->ID ),
    'no_found_rows'       => true,
    'ignore_sticky_posts' => true,
);

$the_query = new WP_Query( $args ); ?>

<div class="post-listing related-posts">

    <?php if ( $related_post_title !== '' ) : ?>
        <h2 class="section-title"><?php echo esc_html( $related_post_title ); ?></h2>
    <?php endif; ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <div class="blog-posts d-row mt-40">

            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

                    <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">

                        <?php if ( has_post_thumbnail() ) : ?>

                            <figure class="post-thumbnail d-block position-relative w-100 mb-0">

                                <a class="post-thumbnail-link d-block" href="<?php echo esc_url( get_the_permalink() ); ?>">

                                    <?php the_post_thumbnail( 'yugen-768-3x4', array(
                                        'alt' => the_title_attribute( array(
                                            'echo' => false,
                                        ) ),
                                    ) ); ?>

                                </a><!-- .post-thumbnail-link -->

                                <a class="d-flex position-absolute justify-content-center align-items-center post-format-icon video-play-icon opacity-0 invisible transition-35s" href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <span class="pt-icon icon-article"></span>
                                </a><!-- .post-format-icon -->


                            </figure><!-- .post-thumbnail -->

                        <?php endif; ?>

                        <?php the_title( '<h2 class="entry-title w-100 td-none"><a class="transition-35s" href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                    </header><!-- entry-header -->

                    <div class="entry-content">

                        <p class="m-0"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?></p>

                    </div><!-- .entry-content -->

                    <footer class="entry-footer">

                        <?php yugen_read_more( '', '', $btn_text ); ?>

                    </footer><!-- .entry-footer -->


                </article><!-- #post-<?php the_ID(); ?> -->

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div><!-- .blog-posts -->

    <?php endif; ?>

</div><!-- .related-posts -->
