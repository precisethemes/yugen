<?php
/**
 * The Footer Column - 4
 *
 * @package yugen
 */

$col_1_class = 'col-12 col-md-6 col-lg-3';
$col_2_class = 'col-12 col-md-6 col-lg-3';
$col_3_class = 'col-12 col-md-6 col-lg-3';
$col_4_class = 'col-12 col-md-6 col-lg-3';
?>

<div class="<?php echo esc_attr( $col_1_class ); ?>">
    <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
</div><!-- .col-3 -->

<div class="<?php echo esc_attr( $col_2_class ); ?>">
    <?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
</div><!-- .col-3 -->

<div class="<?php echo esc_attr( $col_3_class ); ?>">
    <?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
</div><!-- .col-3 -->

<div class="<?php echo esc_attr( $col_4_class ); ?>">
    <?php dynamic_sidebar( 'footer_sidebar_4' ); ?>
</div><!-- .col-3 -->