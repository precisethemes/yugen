<?php
/**
 * Yugen Welcome Screen
 *
 * @since  1.0.0
 * @package yugen
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Yugen_Welcome_Screen' ) ) :

    /**
     * Yugen_Welcome_Screen Class.
     */
    class Yugen_Welcome_Screen {

        /**
         * Constructor.
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( 'PAnD', 'init' ) );
            add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
        }

        /**
         * Add admin menu.
         */
        public function admin_menu() {

            add_theme_page(
                esc_html__( 'Getting Started', 'yugen' ),
                esc_html__( 'Getting Started', 'yugen' ),
                'edit_theme_options',
                'yugen-welcome' ,
                array( $this, 'welcome_screen' )
            );
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice() {
            if ( ! PAnD::is_admin_notice_active( 'yugen-welcome-forever' ) ) {
                return;
            } ?>

            <div data-dismissible="yugen-welcome-forever" class="updated notice notice-success is-dismissible welcome-notice">

                <h1><?php printf( esc_html__( 'Welcome to %s', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?></h1>
                <p><?php printf( esc_html__( 'Welcome! Thank you for choosing %1$s ! To fully take advantage of the best our theme can offer please make sure you visit our %2$s welcome page%3$s.', 'yugen' ),esc_html( YUGEN_THEME_NAME ),'<br/><a href="' . esc_url( admin_url( 'themes.php?page=yugen-welcome' ) ) . '">', '</a>' ); ?></p>
                <p>
                    <a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=yugen-welcome' ) ); ?>">
                        <?php printf( esc_html__( 'Get started with %s', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?>
                    </a>
                </p>
                <button type="button" class="notice-dismiss">
                    <a class="yugen-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'yugen-hide-notice', 'welcome' ) ), 'yugen_hide_notices_nonce', '_yugen_notice_nonce' ) ); ?>">
                        <span class="screen-reader-text"><?php esc_html_e( 'Dismiss', 'yugen' ); ?></span>
                    </a>
                </button>

            </div>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen() {
            $user = wp_get_current_user();
            $rating_url     = 'https://wordpress.org/support/theme/yugen/reviews/#new-post';
            $rating_link    = sprintf( __( '<a href="%s" target="_blank">Yugen</a>', 'yugen' ), esc_url( $rating_url ) ); ?>

            <div class="about-container">
                <div class="flex theme-info">
                    <div class="theme-details">
                        <h4><?php echo sprintf( __( 'Hello, %s,', 'yugen' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></h4>
                        <h1 class="entry-title"><?php echo sprintf( __( 'Welcome to %1$s version %2$s', 'yugen' ), esc_html( YUGEN_THEME_NAME ), YUGEN_THEME_VERSION ); ?></h1>
                        <p class="entry-content"><?php echo wp_kses_post( YUGEN_THEME_DESC ); ?></p>
                    </div>

                    <figure class="theme-screenshot">
                        <img src="<?php echo esc_url( YUGEN_THEME_URI ) . '/screenshot.png'; ?>" />
                    </figure>
                </div>

                <div class="about-theme-tabs">
                    <ul class="about-theme-tab-nav">
                        <li class="tab-link" data-tab="getting_started"><?php esc_html_e( 'Getting Started', 'yugen' ); ?></li>
                        <li class="tab-link" data-tab="support"><?php esc_html_e( 'Support Forum', 'yugen' ); ?></li>
                        <li class="tab-link" data-tab="changelog"><?php esc_html_e( 'Changelog', 'yugen' ); ?></li>
                        <li class="tab-link" data-tab="free_vs_pro"><?php esc_html_e( 'Free vs Pro', 'yugen' ); ?></li>
                        <li class="tab-link" data-tab="upgrade_pro"><span class="dashicons dashicons-star-filled"></span><?php esc_html_e( ' Upgrade to Pro', 'yugen' ); ?></li>
                    </ul>

                    <?php $this->getting_started();?>

                    <?php $this->supports();?>

                    <?php $this->changelog();?>

                    <?php $this->free_vs_pro();?>

                    <?php $this->upgrade_pro();?>

                    <div class="about-page-theme-rating">
                        <p><?php
                            printf( __( 'Have you ❤ using %1$s? Please rate ⭐⭐⭐⭐⭐ our theme %2$s on WordPress.org ☺ Thank you', 'yugen' ), esc_html( YUGEN_THEME_NAME ), $rating_link ); ?></p>
                    </div>

                </div>
            </div>
            <?php
        }

        /**
         * Show Getting Started Content.
         */
        public function getting_started() { ?>

            <div id="getting_started" class="about-theme-tab">
                <section>
                    <h3><?php esc_html_e( 'Documentation & Installation Guide', 'yugen' ); ?></h3>

                    <p><?php esc_html_e( 'Theme documentation page will guide you to install and configure theme quick and easy. We have included details, screenshots and stepwise description about theme installation guides and tutorials.', 'yugen' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/docs/yugen/' ); ?>" target="_blank"><?php esc_html_e( 'View Documentation', 'yugen' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'yugen' ); ?></h3>

                    <p><?php printf( __( 'Need help to setup your website with %s theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/yugen/' ); ?>" target="_blank"><?php esc_html_e( 'Support Forum', 'yugen' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Demo content', 'yugen' ); ?></h3>

                    <h4><?php esc_html_e( 'Install:  One Click Demo Import', 'yugen' ); ?></h4>
                    <p><?php esc_html_e( 'Install the following plugin and then come back here to access the importer. With it you can import all demo content and change your homepage and blog page to the ones from our demo site, automatically. It will also assign a menu.', 'yugen' ); ?></p>

                    <?php if ( !class_exists('OCDI_Plugin') ) : ?>
                        <?php $odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
                        <p>
                            <a target="_blank" class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Install and Activate', 'yugen' ); ?></a>
                            <a style="display:none;" class="button button-primary button-large importer-button" href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import.php' ) ); ?>"><?php esc_html_e( 'Go to the importer', 'yugen' ); ?></a>
                        </p>
                    <?php else : ?>
                        <p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'yugen' ); ?></p>
                        <a class="button button-primary button-large" href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import.php' ) ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'yugen' ); ?></a>
                    <?php endif; ?>

                    <br> <br>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Theme Option & Customization', 'yugen' ); ?></h3>

                    <p><?php esc_html_e( 'Most of theme settings customization options are available through theme customizer. To setup and customise your website elements and sections.', 'yugen' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Go to Customizer', 'yugen' ); ?></a></p>
                </section>

            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function supports() { ?>

            <div id="support" class="about-theme-tab flex">
                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'yugen' ); ?></h3>

                    <p><?php printf( __( 'Need help to setup your website with %s theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/yugen/' ); ?>" target="_blank"><?php esc_html_e( 'Visit Support Forum', 'yugen' ); ?></a></p>
                </section>
            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function free_vs_pro() { ?>

            <div id="free_vs_pro" class="about-theme-tab">
                <table>
                    <tr>
                        <td><?php esc_html_e( 'Theme Features', 'yugen' ); ?></td>
                        <td><?php esc_html_e( 'Free Version', 'yugen' ); ?></td>
                        <td><?php esc_html_e( 'Pro Version', 'yugen' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Coming Soon Page', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Top Header Bar', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Slide in Box', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Header Layouts', 'yugen' ); ?></td>
                        <td>1</td>
                        <td>6</td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Header Settings', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Header', 'yugen' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Header Separator', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Smooth Page Scroll', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Hero Slider Support', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Featured Posts Slider for Homepage', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Built-in Custom Widgets', 'yugen' ); ?></td>
                        <td>2</td>
                        <td>5</td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Sidebar', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unlimited Widget Area (Sidebar) Generator', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unique Sidebar Selection', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Typography Option (850+ Google Fonts)', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Archive/Blog Settings', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unique Page Header', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Post Navigation Layout', 'yugen' ); ?></td>
                        <td class="redFeature">1</span></td>
                        <td class="greenFeature">3</span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Show Related Posts', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Post/Page Settings', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Social Share for Post/Page', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Post/Page Options', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>


                    <tr>
                        <td><?php esc_html_e( 'Advanced 404 Error Page Editor', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Pop up Box', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Footer Widgets Position Layouts', 'yugen' ); ?></td>
                        <td>1</td>
                        <td>10</td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sortable Footer Bar Elements', 'yugen' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Footer Copyright Editor', 'yugen' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Contact Form 7 Compatible', 'yugen' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>


                    <tr>
                        <td><?php esc_html_e( 'Polylang Support in Customizer', 'yugen' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Theme Support', 'yugen' ); ?></td>
                        <td><?php esc_html_e( 'Support via Forum', 'yugen' ); ?></td>
                        <td><?php esc_html_e( 'Quick Ticket Support', 'yugen' ); ?></td>
                    </tr>
                </table>

                <br>

                <p><?php printf( __( 'Need more features and customization option? Try Pro Version of %s theme.', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?>
                <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/wordpress-theme/yugen-pro/' );?>" target="_blank"><?php printf( __( '<span>View %s Pro Details', 'yugen'), esc_html( YUGEN_THEME_NAME ) ); ?></a><br></p>
            </div>
            <?php
        }

        /**
         * Show Changelog Content.
         */
        public function changelog() {
            global $wp_filesystem; ?>

            <div id="changelog" class="about-theme-tab">
                <div class="wrap about-wrap">

                    <?php

                    $changelog_file = apply_filters( 'yugen_changelog_file', get_template_directory() . '/readme.txt' );

                    // Check if the changelog file exists and is readable.
                    if ( $changelog_file && is_readable( $changelog_file ) ) {
                        WP_Filesystem();
                        $changelog = $wp_filesystem->get_contents( $changelog_file );
                        $changelog_list = $this->parse_changelog( $changelog );

                        echo wp_kses_post( $changelog_list );
                    }

                    ?>

                </div>
            </div>
            <?php
        }

        /**
         * Show Upgrade Pro Content.
         */
        public function upgrade_pro() { ?>

            <div id="upgrade_pro" class="about-theme-tab flex">
                <section>
                    <h3><?php esc_html_e( 'Upgrade to Pro', 'yugen' ); ?></h3>

                    <p><?php printf( __( 'Need help to upgrade your website with %s Pro theme for more exciting features and additional theme options.', 'yugen' ), esc_html( YUGEN_THEME_NAME ) ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/wordpress-theme/yugen-pro/' ); ?>" target="_blank"><?php esc_html_e( 'Upgrade to Pro', 'yugen' ); ?></a></p>

                </section>
            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         */
        private function parse_changelog( $content ) {
            $matches   = null;
            $regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if ( preg_match( $regexp, $content, $matches ) ) {
                $changes = explode( '\r\n', trim( $matches[1] ) );

                $changelog .= '<pre class="changelog">';

                foreach ( $changes as $index => $line ) {
                    $changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post( $changelog );
        }
    }

endif;

return new Yugen_Welcome_Screen();
