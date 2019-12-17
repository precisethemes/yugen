<?php
/**
 * Template part for displaying posts on archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yugen
 */


$posts_per_column               = get_theme_mod( 'yugen_archive_page_col_per_row_desktop', 'w-33' );
$url_link                       = get_the_permalink();
$enable_thumbnail_placeholder   = get_theme_mod( 'yugen_archive_page_thumbnail_placeholder', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'grid-column', $posts_per_column, 'text-left' ) ); ?>>

    <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">

        <?php if ( has_post_thumbnail() || ( true == $enable_thumbnail_placeholder ) ) :

            $post_format_class  = array( 'd-flex position-absolute justify-content-center align-items-center post-format-icon opacity-0 invisible transition-35s' ); ?>

            <figure class="post-thumbnail d-block position-relative w-100 mb-0">
                <a class="post-thumbnail-link d-block" href="<?php echo esc_url( $url_link ); ?>">

                    <?php

                    if ( $posts_per_column == 'w-100' || $posts_per_column == 'w-50' ) {
                        $thumbnail_size = 'yugen-1800-3x4';
                    } else {
                        $thumbnail_size = 'yugen-768-3x4';
                    }

                    if ( has_post_thumbnail() ) {

                        the_post_thumbnail( $thumbnail_size, array(
                            'alt' => the_title_attribute( array(
                                'echo' => false,
                            ) ),
                        ) );
                    }
                    elseif ( $enable_thumbnail_placeholder == true ) {

                        $img_src = YUGEN_THEME_URI . '/assets/front-end/images/thumbnail-placeholder-3x4.svg';
                        echo '<img src="'.esc_url( $img_src ).'" alt="'.esc_attr__( 'Thumbnail Placeholder','yugen' ).'">';
                    }

                    ?>

                </a><!-- .post-thumbnail-link -->

                <a class="<?php echo esc_attr( implode( ' ', $post_format_class ) ); ?>" href="<?php echo esc_url( $url_link ); ?>">
                    <span class="pt-icon icon-article"></span>
                </a><!-- .post-format-icon -->

            </figure><!-- .post-thumbnail -->

        <?php endif; ?>

        <?php yugen_cat_links(); ?>

        <?php the_title( '<h2 class="entry-title w-100 mb-0 td-none"><a class="transition-35s" href="' . esc_url( $url_link ) . '" rel="bookmark">', '</a></h2>' ); ?>

    </header><!-- entry-header -->

    <div class="entry-content">
        <p class="m-0"><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
    </div><!-- .entry-content -->

    <footer class="entry-footer d-flex flex-wrap justify-content-between align-items-center">

        <?php yugen_read_more(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
