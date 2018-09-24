<?php
/**
 * Demo class
 *
 * @package yugen
 */

if ( ! class_exists( 'Yugen_Demo' ) ) {

    /**
     * Main class.
     *
     * @since 0.2.0
     */
    class Yugen_Demo {

        /**
         * Singleton instance of Yugen_Demo.
         *
         * @var Yugen_Demo $instance Yugen_Demo instance.
         */
        private static $instance;

        /**
         * Configuration.
         *
         * @var array $config Configuration.
         */
        private $config;

        /**
         * Main Yugen_Demo instance.
         *
         * @since 0.2.0
         *
         * @param array $config Configuration array.
         */
        public static function init( $config ) {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Yugen_Demo ) ) {
                self::$instance = new Yugen_Demo();
                if ( ! empty( $config ) && is_array( $config ) ) {
                    self::$instance->config = $config;
                    self::$instance->setup_actions();
                }
            }
        }

        /**
         * Setup actions.
         *
         * @since 0.2.0
         */
        public function setup_actions() {

            // Disable branding.
            add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

            // OCDI import files.
            add_filter( 'pt-ocdi/import_files', array( $this, 'ocdi_files' ), 99 );

            // OCDI after import.
            add_action( 'pt-ocdi/after_import', array( $this, 'ocdi_after_import' ) );

            // OCDI additional intro text.
            add_filter( 'pt-ocdi/plugin_intro_text', array( $this, 'additional_intro_text' ) );
        }

        /**
         * OCDI files.
         *
         * @since 0.2.0
         */
        public function ocdi_files() {

            $ocdi = isset( $this->config['ocdi'] ) ? $this->config['ocdi'] : array();
            return $ocdi;
        }

        /**
         * Intro message.
         *
         * @since 0.2.0
         *
         * @param string $intro Intro.
         * @return string Modified intro.
         */
        public function additional_intro_text( $intro ) {

            $intro_content = isset( $this->config['intro_content'] ) ? $this->config['intro_content'] : '';

            if ( ! empty( $intro_content ) ) {
                $message  = '<div class="ocdi__intro-text">';
                $message .= wp_kses_post( wpautop( $intro_content ) );
                $message .= '</div><!-- .ocdi__intro-text -->';
                $intro   .= $message;
            }

            return $intro;
        }

        /**
         * OCDI after import.
         *
         * @since 0.2.0
         */
        public function ocdi_after_import( $selected_import ) {

            // Set static front page.
            $static_page = isset( $this->config['static_page'] ) ? $this->config['static_page'] : '';
            $posts_page  = isset( $this->config['posts_page'] ) ? $this->config['posts_page'] : '';

            $pages = array();

            if ( $static_page ) {
                $pages['page_on_front'] = $static_page;
            }

            if ( $posts_page ) {
                $pages['page_for_posts'] = $posts_page;
            }

            if ( ! empty( $pages ) ) {
                foreach ( $pages as $option_key => $slug ) {
                    $result = get_page_by_path( $slug );
                    if ( $result ) {
                        if ( is_array( $result ) ) {
                            $object = array_shift( $result );
                        } else {
                            $object = $result;
                        }

                        update_option( $option_key, $object->ID );
                    }
                }

                update_option( 'show_on_front', 'page' );
            }

            // Set menu locations.
            $menu_details = isset( $this->config['menu_locations'] ) ? $this->config['menu_locations'] : array();
            if ( ! empty( $menu_details ) ) {
                $nav_settings  = array();
                $current_menus = wp_get_nav_menus();

                if ( ! empty( $current_menus ) && ! is_wp_error( $current_menus ) ) {
                    foreach ( $current_menus as $menu ) {
                        foreach ( $menu_details as $location => $menu_slug ) {
                            if ( $menu->slug === $menu_slug ) {
                                $nav_settings[ $location ] = $menu->term_id;
                            }
                        }
                    }
                }

                set_theme_mod( 'nav_menu_locations', $nav_settings );
            }

        }
    }

} // End if().

/**
 * Demo configuration
 *
 * @package yugen
 */

$config = array(
    'menu_locations' => array(
        'primary-menu'  => 'primary-menu',
        'footer'        => 'footer-menu'
    ),
    'ocdi'           => array(
        array(
            'import_file_name'             => 'Default',
            'local_import_file'            => YUGEN_THEME_DIR . '/inc/framework/demo-importer/demo/default/content.xml',
            'local_import_widget_file'     => YUGEN_THEME_DIR . '/inc/framework/demo-importer/demo/default/widget.wie',
            'local_import_customizer_file' => YUGEN_THEME_DIR . '/inc/framework/demo-importer/demo/default/customizer.dat',
            'import_preview_image_url'     => YUGEN_THEME_URI . '/inc/framework/demo-importer/demo/default/screenshot.png',
            'preview_url'                  => 'https://precisethemes.com/demo/yugen-free/',
        ),
    ),
    'intro_content'  => esc_html__( 'NOTE: In demo import, category selection could be omitted in old (non-fresh) WordPress setup. After import is complete, please go to Widgets admin page under Appearance menu and select the appropriate category in the widgets.', 'yugen' ),
);

Yugen_Demo::init( apply_filters( 'yugen_demo_filter', $config ) );
