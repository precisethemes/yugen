/**
 * Project   : Yugen WordPress Theme
 * Purpose   : Customizer Enhancements Script
 * Author    : precisethemes
 * Theme URI : https://precisethemes.com/
 *
 * File customizer-preview.js.
 * @package yugen
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

} )( jQuery );
