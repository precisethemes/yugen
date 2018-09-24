<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yugen
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'yugen' ); ?></a>

    <header id="masthead" class="site-header header-layout-4 scroll transition-5s">

        <?php
        /**
         * Hook - yugen_action_header
         *
         * @hooked: yugen_add_header - 10
         */
        do_action( 'yugen_action_header' );

        ?>

    </header><!-- #masthead -->

    <div class="site-header-separator"></div>

    <div id="content" class="site-content">

<?php
/**
 * Hook - yugen_action_after_header
 *
 * @hooked: yugen_add_after_header_hero - 20
 */
do_action( 'yugen_action_after_header' );
        