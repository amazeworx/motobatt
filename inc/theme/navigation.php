<?php
/**
 * Navigation
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Don't let Genesis load menus
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/**
 * Mobile Menu
 *
 */
function gfs_site_navigation() {

    echo '<div class="header-nav">';

        echo gfs_mobile_menu_toggle();
        //echo gfs_search_toggle();

        echo '<nav' . gfs_amp_class( 'nav-menu', 'active', 'menuActive' ) . ' role="navigation">';

        echo '<div class="nav-header">';
        echo gfs_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
        echo '</div>';
        if( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'nav-primary' ) );
        }
        if( has_nav_menu( 'secondary' ) ) {
            wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'container_class' => 'nav-secondary' ) );
        }
	    echo '</nav>';

        //echo '<div' . gfs_amp_class( 'header-search', 'active', 'searchActive' ) . '>' . get_search_form( array( 'echo' => false ) ) . '</div>';

    echo '</div>';
}
add_action( 'genesis_header', 'gfs_site_navigation', 11 );

/**
 * Nav Extras
 *
 */
function gfs_nav_extras( $menu, $args ) {

	if( 'primary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . gfs_search_toggle() . '</li>';
	}

	if( 'secondary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . get_search_form( false ) . '</li>';
	}

	return $menu;
}
//add_filter( 'wp_nav_menu_items', 'gfs_nav_extras', 10, 2 );

/**
 * Search toggle
 *
 */
function gfs_search_toggle() {
	$output = '<button' . gfs_amp_class( 'search-toggle', 'active', 'searchActive' ) . gfs_amp_toggle( 'searchActive', array( 'menuActive', 'mobileFollow' ) ) . '>';
		$output .= gfs_icon( array( 'icon' => 'search', 'size' => 24, 'class' => 'open' ) );
		$output .= gfs_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Search</span>';
	$output .= '</button>';
	return $output;
}

/**
 * Mobile menu toggle
 *
 */
function gfs_mobile_menu_toggle() {
	$output = '<button' . gfs_amp_class( 'menu-toggle', 'active', 'menuActive' ) . gfs_amp_toggle( 'menuActive', array( 'searchActive', 'mobileFollow' ) ) . '>';
		$output .= gfs_icon( array( 'icon' => 'menu-toggle', 'size' => 24, 'class' => 'open' ) );
		//$output .= gfs_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Menu</span>';
	$output .= '</button>';
	return $output;
}

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function gfs_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = gfs_icon( array( 'icon' => 'navigate-down', 'size' => 8, 'title' => 'Submenu Dropdown' ) );

		$output .= sprintf(
			'<button' . gfs_amp_nav_dropdown( $args->theme_location, $depth ) . ' tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'gfs_nav_add_dropdown_icons', 10, 4 );


/**
 * Add mobile bottom menu
 */
add_action( 'genesis_after', 'gfs_nav_bottom_mobile' );
function gfs_nav_bottom_mobile() {
    ?>
    <div class="nav-bottom-mobile">
        <div class="nav-bottom-container">
            <a href="/" class="nav-bottom-link">
                <span class="nav-icon"><?php echo gfs_icon( array( 'icon' => 'home', 'group' => 'utility', 'size' => 24, 'class' => 'icon-home' ) ); ?></span>
                <span class="nav-title">Home</span>
            </a>
            <a href="/cari-aki" class="nav-bottom-link">
                <span class="nav-icon"><?php echo gfs_icon( array( 'icon' => 'battery', 'group' => 'utility', 'size' => 24, 'class' => 'icon-battery' ) ); ?></span>
                <span class="nav-title">Cari Aki</span>
            </a>
            <a href="/teknologi" class="nav-bottom-link">
                <span class="nav-icon"><?php echo gfs_icon( array( 'icon' => 'power', 'group' => 'utility', 'size' => 24, 'class' => 'icon-technology' ) ); ?></span>
                <span class="nav-title">Teknologi</span>
            </a>
            <a href="#" class="nav-bottom-link">
                <span class="nav-icon"><?php echo gfs_icon( array( 'icon' => 'whatsapp', 'group' => 'social', 'size' => 22, 'class' => 'icon-whatsapp' ) ); ?></span>
                <span class="nav-title">Whatsapp</span>
            </a>
        </div>
    </div>
    <?php
}