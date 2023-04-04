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
function motobatt_site_navigation() {

    echo '<div class="header-nav">';
        echo motobatt_language_switcher();
        echo motobatt_mobile_menu_toggle();
        //echo motobatt_search_toggle();

        echo '<nav' . motobatt_amp_class( 'nav-menu', 'active', 'menuActive' ) . ' role="navigation">';

        echo '<div class="nav-header">';
        echo motobatt_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
        echo '</div>';
        if( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'nav-primary' ) );
        }
        if( has_nav_menu( 'secondary' ) ) {
            wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'container_class' => 'nav-secondary' ) );
        }
	    echo '</nav>';

        //echo '<div' . motobatt_amp_class( 'header-search', 'active', 'searchActive' ) . '>' . get_search_form( array( 'echo' => false ) ) . '</div>';

    echo '</div>';
}
add_action( 'genesis_header', 'motobatt_site_navigation', 11 );

/**
 * Nav Extras
 *
 */
function motobatt_nav_extras( $menu, $args ) {

	if( 'primary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . motobatt_search_toggle() . '</li>';
	}

	if( 'secondary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . get_search_form( false ) . '</li>';
	}

	return $menu;
}
//add_filter( 'wp_nav_menu_items', 'motobatt_nav_extras', 10, 2 );

/**
 * Search toggle
 *
 */
function motobatt_search_toggle() {
	$output = '<button' . motobatt_amp_class( 'search-toggle', 'active', 'searchActive' ) . motobatt_amp_toggle( 'searchActive', array( 'menuActive', 'mobileFollow' ) ) . '>';
		$output .= motobatt_icon( array( 'icon' => 'search', 'size' => 24, 'class' => 'open' ) );
		$output .= motobatt_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Search</span>';
	$output .= '</button>';
	return $output;
}

function motobatt_language_switcher() {
    $args = array(
        'dropdown' => 1,
    );
    $output = '';
    $output .= pll_the_languages($args);
    $output .= '';
}

/**
 * Mobile menu toggle
 *
 */
function motobatt_mobile_menu_toggle() {
	$output = '<button' . motobatt_amp_class( 'menu-toggle', 'active', 'menuActive' ) . motobatt_amp_toggle( 'menuActive', array( 'searchActive', 'mobileFollow' ) ) . '>';
		$output .= motobatt_icon( array( 'icon' => 'menu-toggle', 'size' => 24, 'class' => 'open' ) );
		//$output .= motobatt_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
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
function motobatt_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = motobatt_icon( array( 'icon' => 'navigate-down', 'size' => 8, 'title' => 'Submenu Dropdown' ) );

		$output .= sprintf(
			'<button' . motobatt_amp_nav_dropdown( $args->theme_location, $depth ) . ' tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'motobatt_nav_add_dropdown_icons', 10, 4 );


/**
 * Add mobile bottom menu
 */
add_action( 'genesis_after', 'motobatt_nav_bottom_mobile' );
function motobatt_nav_bottom_mobile() {
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $whatsapp_text = 'Hi.%20Saya%20klik%20di%20website%3A%0A';
    $whatsapp_text .= urlencode($current_url);
    $whatsapp_text .= '%0AMau%20tanya%20info%20tentang%20produk%20Motobatt.';
    $whatsapp_link = 'https://wa.me/628157020999?text=' . $whatsapp_text;

    $home_link = site_url();
    $findbattery_link = site_url('/cari-aki/');
    $technology_link = site_url('/teknologi/');

    if ( function_exists( 'pll_current_language' ) ) {
        $lang = pll_current_language('slug');
        if ($lang == "en") {
            $home_link = site_url('/en/');
            $findbattery_link = site_url('/en/find-battery/');
            $technology_link = site_url('/en/technology/');
        }
    }

    ?>
    <div class="nav-bottom-mobile">
        <div class="nav-bottom-container">
            <a href="<?php echo $home_link ?>" class="nav-bottom-link">
                <span class="nav-icon"><?php echo motobatt_icon( array( 'icon' => 'home', 'group' => 'utility', 'size' => 24, 'class' => 'icon-home' ) ); ?></span>
                <span class="nav-title"><?php echo __('Home', 'motobatt') ?></span>
            </a>
            <a href="<?php echo $findbattery_link ?>" class="nav-bottom-link">
                <span class="nav-icon"><?php echo motobatt_icon( array( 'icon' => 'battery', 'group' => 'utility', 'size' => 24, 'class' => 'icon-battery' ) ); ?></span>
                <span class="nav-title"><?php echo __('Cari Aki', 'motobatt') ?></span>
            </a>
            <a href="<?php echo $technology_link ?>" class="nav-bottom-link">
                <span class="nav-icon"><?php echo motobatt_icon( array( 'icon' => 'power', 'group' => 'utility', 'size' => 24, 'class' => 'icon-technology' ) ); ?></span>
                <span class="nav-title"><?php echo __('Teknologi', 'motobatt') ?></span>
            </a>
            <a href="<?php echo $whatsapp_link ?>" class="nav-bottom-link" target="_blank">
                <span class="nav-icon"><?php echo motobatt_icon( array( 'icon' => 'whatsapp', 'group' => 'social', 'size' => 22, 'class' => 'icon-whatsapp' ) ); ?></span>
                <span class="nav-title"><?php echo __('Whatsapp', 'motobatt') ?></span>
            </a>
        </div>
    </div>
    <?php
}