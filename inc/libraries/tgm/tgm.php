<?php
/**
 * Plugin recommendation
 *
 * @package yugen
 */

// Load TGM library.
require YUGEN_THEME_DIR . '/inc/libraries/tgm/class-tgm-plugin-activation.php';

if ( ! function_exists( 'yugen_register_recommended_plugins' ) ) :

	/**
	 * Register recommended plugins.
	 *
	 * @since 1.0.0
	 */
	function yugen_register_recommended_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'yugen' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'MailChimp Sign-Up Form', 'yugen' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Contact Form 7', 'yugen' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
        );

		$config = array();

		tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'yugen_register_recommended_plugins' );
