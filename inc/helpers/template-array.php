<?php
/**
 * Custom template Useful functions that return arrays for theme
 *
 * @package yugen
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------
# Returns array of site content layout
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_content_layouts' ) ) :
    /**
     * Returns array of content layouts for page or page.
     */
    function yugen_content_layouts( $output = array() ) {

        $output['left-sidebar']     = esc_html__( 'Left Sidebar', 'yugen' );
        $output['full-width']       = esc_html__( 'Full Width', 'yugen' );
        $output['right-sidebar']    = esc_html__( 'Right Sidebar', 'yugen' );
        return $output;
    }
endif;


/*----------------------------------------------------------------------
# Returns array of social profiles
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_social_profiles' ) ) :
    /**
     * Returns array of social profiles.
     */
    function yugen_social_profiles( $output = array() ) {
        $output['fa-behance']       = esc_html__( 'Behance', 'yugen' );
        $output['fa-delicious']     = esc_html__( 'Delicious', 'yugen' );
        $output['fa-digg']          = esc_html__( 'Digg', 'yugen' );
        $output['fa-dribbble']      = esc_html__( 'Dribbble', 'yugen' );
        $output['fa-facebook']      = esc_html__( 'Facebook', 'yugen' );
        $output['fa-flickr']        = esc_html__( 'Flickr', 'yugen' );
        $output['fa-foursquare']    = esc_html__( 'Foursquare', 'yugen' );
        $output['fa-github']        = esc_html__( 'Github', 'yugen' );
        $output['fa-google-plus']   = esc_html__( 'Google Plus', 'yugen' );
        $output['fa-instagram']     = esc_html__( 'Instagram', 'yugen' );
        $output['fa-linkedin']      = esc_html__( 'LinkedIn', 'yugen' );
        $output['fa-envelope']      = esc_html__( 'Mail', 'yugen' );
        $output['fa-medium']        = esc_html__( 'Medium', 'yugen' );
        $output['fa-pinterest']     = esc_html__( 'Pinterest', 'yugen' );
        $output['fa-reddit']        = esc_html__( 'Reddit', 'yugen' );
        $output['fa-skype']         = esc_html__( 'Skype', 'yugen' );
        $output['fa-slack']         = esc_html__( 'Slack', 'yugen' );
        $output['fa-stackoverflow'] = esc_html__( 'Stackoverflow', 'yugen' );
        $output['fa-twitter']       = esc_html__( 'Twitter', 'yugen' );
        $output['fa-tumblr']        = esc_html__( 'Tumblr', 'yugen' );
        $output['fa-vimeo']         = esc_html__( 'Vimeo', 'yugen' );
        $output['fa-youtube']       = esc_html__( 'YouTube', 'yugen' );
        return $output;
    }
endif;

/*----------------------------------------------------------------------
# Returns array of text alignment
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_text_alignment' ) ) :
    /**
     * Returns array of text alignment options
     */
    function yugen_text_alignment( $output = array() ) {

        $output['left']     = esc_html__( 'Left', 'yugen' );
        $output['center']   = esc_html__( 'Center', 'yugen' );
        $output['right']    = esc_html__( 'Right', 'yugen' );
        return $output;
    }
endif;
