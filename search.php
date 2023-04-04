<?php
/**
 * Search Results
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Search header
 *
 */
function motobatt_search_header() {
	do_action( 'genesis_archive_title_descriptions', 'Search Results', get_search_form( false ), 'search-description' );
}
add_action( 'genesis_before_loop', 'motobatt_search_header', 15 );

// Build the page using the archive template
require get_stylesheet_directory() . '/archive.php';
