<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yugen
 */

$sidebar_class = yugen_has_secondary_content_class();

if ( $sidebar_class == 'full-width' ) {
    return;
}

$secondary_classes 		= array('widget-area');
$secondary_classes[] 	= $sidebar_class;
$secondary_classes[] 	= yugen_get_sidebar_layout(); ?>

<aside id="secondary" class="<?php echo esc_attr( implode( ' ', $secondary_classes ) );?>">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
