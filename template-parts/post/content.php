<?php
/**
 * Template part for displaying post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yugen
 */

$header_elements    = get_theme_mod( 'yugen_post_content_header_elements_order', array( 'post-thumbnail','post-title' ) );
$footer_elements    = get_theme_mod( 'yugen_post_content_footer_elements_order', array( 'post-cats','post-tags','post-navigation','comment-section' ) );
$gallery_position   = get_post_meta( yugen_get_the_ID(), 'yugen_gl_position', true );
$thumbnail_show     = get_post_meta( yugen_get_the_ID(), 'yugen_featured_image_hide', true );

$header_class       = array( 'entry-header d-flex flex-wrap align-items-center' );
$header_class[]     = 'text-left';

$content_class      = array( 'entry-content mt-80' );
$content_class[]    = 'text-left';

if ( yugen_has_secondary_content_class() == 'full-width' ) {
    $content_class[]    = 'col-count-xxl-2 col-gap-xxl-96';
}

$footer_class       = array( 'entry-footer d-flex flex-wrap align-items-center mt-80' );
$footer_class[]     = 'text-left'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">

        <?php if ( !empty( $header_elements ) ) :

            foreach ( $header_elements as $header_key => $header_element ) :

                if ( $header_element == 'post-thumbnail' && has_post_thumbnail() ) :

                    $image_size     = 'yugen-1200-16x9';

                    if ( yugen_has_secondary_content_class() == 'full-width' ) {
                        $image_size = 'yugen-1800-16x9';
                    } ?>

                    <figure class="post-featured-image post-thumbnail">

                        <?php the_post_thumbnail( $image_size, array(
                            'alt' => the_title_attribute( array(
                                'echo' => false,
                            ) ),
                        ) ); ?>

                    </figure>

                <?php elseif ( $header_element == 'post-title' ) :

                    the_title( '<h1 class="entry-title w-100">', '</h1>' );

                endif;

            endforeach;

        endif; ?>

    </header><!-- .entry-header -->

    <div class="<?php echo esc_attr( implode( ' ', $content_class ) ); ?>">

        <?php

        the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links d-flex flex-wrap align-items-center py-24">' . esc_html__( 'Pages:', 'yugen' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) );

        ?>

    </div><!-- .entry-content -->

    <footer class="<?php echo esc_attr( implode( ' ', $footer_class ) ); ?>">

        <?php if ( !empty( $footer_elements ) ) :

            foreach ( $footer_elements as $footer_key => $footer_element ) :

                if ( $footer_element == 'post-cats' ) :

                    yugen_cat_links();

                elseif ( $footer_element == 'post-tags' ) :

                    yugen_tags_links();

                elseif ( $footer_element == 'related-posts' ) :

                    get_template_part( 'template-parts/post/related', 'posts' ); // related post

                elseif ( $footer_element == 'post-navigation' ) :

                    echo '<div class="post-listing post-navigation-wrap default navigation-layout-2">';

                    // Previous/next post navigation.
                    the_post_navigation( array(
                        'prev_text' => '<span aria-hidden="true" class="meta-nav d-inline-block">'. __( 'Previous Post', 'yugen' ) . '</span>
                            <div class="post-nav-content transition-5s">
                                <h2 class="entry-title m-0">%title</h2></div><span class="screen-reader-text">' . __( 'Previous Post', 'yugen' ) . '</span>' ,
                        'next_text' => '<span aria-hidden="true" class="meta-nav d-inline-block">'. __( 'Next Post', 'yugen' ) . '</span>
                            <div class="post-nav-content transition-5s">
                            <h2 class="entry-title m-0">%title</h2></div><span class="screen-reader-text">' . __( 'Next Post', 'yugen' ) . '</span>' ,
                    ) );

                    echo '</div>';


                elseif ( $footer_element == 'comment-section' ) :

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endif;

            endforeach;

        endif;

        if ( get_edit_post_link() ) :

            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'yugen' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );

        endif;

        ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
