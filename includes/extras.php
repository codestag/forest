<?php
/**
 * Extra theme functions.
 *
 * @package Stag_Customizer
 * @since 2.2.0.
 */

if ( ! function_exists( 'forest_body_class' ) ) :
	/**
	 * Modify Forest body classes.
	 *
	 * @param array $classes A list of all body classes.
	 * @return array
	 */
	function forest_body_class( $classes ) {
		if ( ! is_active_sidebar( 'sidebar-main' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
endif; // End of forest_body_class.

add_filter( 'body_class', 'forest_body_class' );
