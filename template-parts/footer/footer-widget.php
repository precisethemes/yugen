<?php
/**
 * Footer Widget Section.
 *
 * @package yugen
 */

if ( ( is_active_sidebar( 'footer_sidebar_1' ) || is_active_sidebar( 'footer_sidebar_2' ) || is_active_sidebar( 'footer_sidebar_3' ) || is_active_sidebar( 'footer_sidebar_4' ) ) ) :
    $footer_widget_layout   = get_theme_mod( 'yugen_footer_widgets_area_layout', 'footer-layout-8' ); ?>

    <div class="footer-widgets pt-80 pb-32 cs-light">
        <div class="outer-container">
            <div class="container-fluid">
                <div class="row">

                    <?php

                    if ( $footer_widget_layout == 'footer-layout-8' ) {
                        get_template_part( 'template-parts/footer/widget-area/col', 4 );
                    }

                    ?>

                </div><!-- .row -->
            </div><!-- .outer-container -->
        </div><!-- .container-fluid -->
    </div><!-- .footer-widgets -->
<?php
endif;
