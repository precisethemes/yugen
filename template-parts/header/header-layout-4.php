<?php
/**
 * Header Layout 4
 *
 * @package yugen
 */
?>

<div class="body-overlay w-100 h-100 opacity-0 invisible transition-5s"></div>

<div class="col-12 d-flex flex-column align-items-center">
    <div class="site-branding d-flex flex-wrap flex-column justify-content-center align-items-center pt-32 pb-32">

        <?php the_custom_logo(); ?>

        <div class="site-title-wrap text-center">

            <?php

            $site_title = get_bloginfo( 'name ');

            if ( true == get_theme_mod( 'yugen_header_site_title_visible', true ) ) :

                if ( is_front_page() && is_home() ) : ?>

                    <h1 class="site-title"><a class="d-inline-block td-none outline-none" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></h1>

                <?php else : ?>

                    <p class="site-title"><a class="d-inline-block td-none outline-none" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></p>

                <?php endif;

            endif;

            if ( true == get_theme_mod( 'yugen_header_site_tagline_visible', true ) ) :

                $yugen_description = get_bloginfo( 'description', 'display' );
                if ( $yugen_description || is_customize_preview() ) : ?>

                    <p class="site-description"><?php echo wp_kses_post( $yugen_description ); /* WPCS: xss ok. */ ?></p>

                <?php endif;

            endif; ?>

        </div><!-- .site-title-wrap -->
    </div><!-- .site-branding -->

    <nav id="site-navigation" class="main-navigation slide-in transition-5s">
        <div class="close-navigation position-absolute transition-5s cursor-pointer d-xl-none color-hex-6"><span class="pt-icon icon-cross"></span></div>

        <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu', 'container' => 'ul', 'menu_class' => 'primary-menu d-flex flex-wrap flex-column flex-xl-row justify-content-center p-0 m-0 ls-none' ) ); ?>
    </nav><!-- #site-navigation -->

    <div class="hamburger-menu cursor-pointer d-xl-none">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div><!-- .hamburger-menu -->
</div><!-- .col -->