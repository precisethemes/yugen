<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yugen
 */
?>

</div><!-- #content -->

<div class="footer-separator"></div>

<footer class="site-footer">

    <?php
    /**
     * Hook - yugen_action_footer.
     *
     * @hooked yugen_add_footer_widgets - 10
     * @hooked yugen_add_footer_bar - 20
     */
    do_action( 'yugen_action_footer' );
    ?>

</footer><!-- .site-footer -->
</div><!-- #page -->

<?php if ( true == get_theme_mod( 'yugen_back_to_top_enable', true ) ) :

    $go_to_top_button_text  = get_theme_mod( 'yugen_back_to_top_text', 'Back to Top' ); ?>

    <div class="back-to-top d-none d-md-flex align-items-center">
        <div class="bt-text">
            <?php echo esc_html( $go_to_top_button_text ); ?>
        </div><!-- .bt-text -->

        <span class="d-block pt-icon icon-arrow-right"></span>
    </div><!-- .back-to-top -->

<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>