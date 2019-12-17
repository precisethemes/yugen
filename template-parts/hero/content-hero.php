<?php
/**
 * Theme Hero Section.
 *
 * @package yugen
 */
// Default values for 'my_setting' theme mod.
$defaults = array(
    array(
        'hero_image'        => YUGEN_THEME_URI . '/assets/back-end/images/hero/hero-default.png',
        'hero_title'        => esc_attr__( 'Hero Title', 'yugen' ),
        'hero_subtitle'     => esc_attr__( 'Hero Subtitle', 'yugen' ),
        'hero_desc'         => esc_attr__( 'Hero Short Description Here.', 'yugen' ),
        'hero_button_text'  => esc_attr__( 'Read More', 'yugen' ),
        'hero_button_link'  => '#',
        'hero_button_link_open' => '_self',
    ),
);
$repeatable_hero_slides = get_theme_mod( 'yugen_repeatable_hero_slides', $defaults );

if ( !empty( $repeatable_hero_slides ) ) : ?>

    <section class="hero-section overflow-hidden mt-16 mt-lg-48 mt-xl-80">
        <div class="outer-container">
            <div class="container-fluid">
                <div class="hero-container cs-dark">
                        <div class="hero-content-wrap position-relative">

                            <?php foreach( $repeatable_hero_slides as $slide_key => $slide_value ) :
                                $image_id           = $slide_value['hero_image'];
                                $output             = '<div class="object-fit-cover"></div><!-- .object-fit-cover -->';

                                if ( is_numeric( $image_id ) ) {
                                    $image_path     = wp_get_attachment_image_src( $image_id, 'yugen-1800-21x9', true );
                                    $image_src      = $image_path[0];
                                    $output         = '<div class="post-thumbnail ratio-21x9 background-cover m-0" style="background-image: url(' . esc_url( $image_src ) . ')"></div><!-- .post-thumbnail -->';
                                }
                                else {
                                    $image_src      = $image_id;
                                    $output         = '<div class="post-thumbnail ratio-21x9 background-cover m-0" style="background-image: url(' . esc_url( $image_src ) . ')"></div><!-- .post-thumbnail -->';
                                }

                                ?>

                                <div class="hero-content position-relative">

                                    <?php echo $output; ?>

                                    <?php if ( $slide_value['hero_title'] !== '' || $slide_value['hero_subtitle'] !== '' || $slide_value['hero_desc'] !== '' ) : ?>

                                        <div class="content-wrap position-absolute center">

                                            <?php if ( $slide_value['hero_title'] !== '' || $slide_value['hero_subtitle'] !== '' ) : ?>
                                                <header class="entry-header w-100">
                                                    <?php if ( $slide_value['hero_subtitle'] !== '' ) {?><h3 class="entry-subtitle mb-0"><?php echo esc_html( $slide_value['hero_subtitle'] ); ?></h3><?php } ?>

                                                    <?php if ( $slide_value['hero_title'] !== '' ) {?><h2 class="entry-title"><?php if ( $slide_value['hero_button_link'] !== '' && $slide_value['hero_button_link'] !== '#' ) { echo '<a href="' . esc_url( $slide_value['hero_button_link'] ) . '">'; } ?><?php echo esc_html( $slide_value['hero_title'] ); ?><?php if ( $slide_value['hero_button_link'] !== '' && $slide_value['hero_button_link'] !== '#' ) { echo '</a>'; } ?></h2><?php } ?>
                                                </header><!-- .entry-title -->
                                            <?php endif; ?>

                                            <?php if ( $slide_value['hero_desc'] !== '' ) : ?>
                                                <div class="entry-content w-100">
                                                    <p><?php echo wp_kses_post( $slide_value['hero_desc'] ); ?></p>
                                                </div><!-- .entry-content -->
                                            <?php endif; ?>

                                            <?php if ( $slide_value['hero_button_text'] !== '' ) :

                                                $read_more_class    = array( 'position-relative read-more' );
                                                $read_more_class[]  = 'trail'; ?>

                                                <footer class="entry-footer w-100">
                                                    <div class="d-inline-block <?php echo esc_attr( implode( ' ', $read_more_class ) ); ?>">
                                                        <a class="td-none transition-35s" href="<?php echo esc_url( $slide_value['hero_button_link'] );?>" target="<?php echo esc_attr( $slide_value['hero_button_link_open'] ); ?>"><?php echo esc_html( $slide_value['hero_button_text'] ); ?></a>
                                                    </div>
                                                </footer><!-- .entry-footer -->

                                            <?php endif; ?>

                                        </div><!-- .content-wrap -->

                                    <?php endif; ?>

                                </div><!-- .hero-content -->

                            <?php endforeach; ?>

                        </div><!-- .hero-content-wrap -->
                </div><!-- .hero-container -->
            </div><!-- .container-fluid -->
        </div><!-- .outer-container -->
    </section><!-- .hero-section -->

<?php endif;
