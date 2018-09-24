<?php
/**
 * Theme Breadcrumb Section.
 *
 * @package yugen
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_front_page() || is_search() )
    return;

if ( ! function_exists( 'yugen_breadcrumb' ) ) {
    require YUGEN_THEME_DIR . '/inc/libraries/breadcrumbs.php';
} ?>

<div class="outer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="breadcrumb">

                    <?php $breadcrumb_args = array(
                        'delimiter'   => get_theme_mod( 'yugen_breadcrumb_delimiter', '/' ),
                        'show_browse' => false,
                    );

                    yugen_breadcrumb( $breadcrumb_args ); ?>

                </div><!-- #breadcrumb -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container-fluid -->
</div><!-- .outer-container -->
