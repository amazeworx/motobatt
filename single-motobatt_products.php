<?php
/**
 * Single Post
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
**/

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Add Single Product Details
add_action( 'genesis_before', 'single_product_actions' );
function single_product_actions() {
    if ( is_singular( 'motobatt_products' ) ) {
        //add_action( 'genesis_before_content', 'page_breadcrumbs_navigation' );
        add_action( 'genesis_entry_header', 'product_images', 8 );
        add_action( 'genesis_entry_header', 'product_header_open', 9 );
        add_action( 'genesis_entry_header', 'product_category' );
        add_action( 'genesis_entry_header', 'product_short_specs' );
        add_action( 'genesis_entry_header', 'button_whatsapp' );
        add_action( 'genesis_entry_header', 'product_header_close' );
        add_action( 'genesis_entry_content', 'product_features' );
        add_action( 'genesis_entry_content', 'product_applications' );
        add_action( 'genesis_entry_content', 'product_replaces' );
        add_action( 'genesis_entry_content', 'product_specification' );
        //add_action( 'genesis_entry_content', 'product_related' );
    }
}

function product_header_open() {
    echo '<div class="product-header">';
}
function product_header_close() {
    echo '</div>';
}

function page_breadcrumbs_navigation() {
    $output =   '<div class="breadcrumbs-wrap">';
    $output .=  '<a href="/" class="">';
    $output .=  'Home';
    $output .=  '</a>';
    $output .=  ' &raquo ';
    $output .=  '<a href="/produk" class="">';
    $output .=  'Produk';
    $output .=  '</a>';
    $output .=  '</div>';
    echo $output;
}

function product_images() {
    $images = get_field('product_images');
    if( $images ) {
        ?>
        <div class="product-images">
            <div class="slider">
                <?php foreach( $images as $image ) { ?>
                <figure>
                    <img src="<?php echo esc_url($image['url']) ?>" alt="<?php echo esc_attr($image['alt']) ?>" />
                </figure>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}

function product_category() {
    $product_sub_heading = get_field('product_sub_heading');
    if ($product_sub_heading) {
        echo '<p class="product-category">' . $product_sub_heading . '</p>';
    } else {
        $terms = get_the_terms( get_the_ID(), 'product_categories' );
        if ($terms) {
            echo '<p class="product-category">' . esc_html( $terms[0]->name ) . '</p>';
        }
    }
}

function product_short_specs() {
    $specification = 'specification';

    if( have_rows($specification) ):

        while( have_rows($specification) ): the_row();

            $output = '';

            $voltage = get_sub_field('voltage');
            $cca = get_sub_field('cca');
            $capacity = get_sub_field('capacity');

            if ( $voltage ) {
                $output .= '<dl class="short-specs">';
            }

            if ( $voltage ) {
                $output .= '<dt>Voltage</dt><dd> : ' . $voltage . '</dd>';
            }
            if ( $capacity ) {
                $output .= '<div class="w-full"></div>';
                $output .= '<dt>Capacity</dt><dd> : ' . $capacity . '</dd>';
            }
            if ( $cca ) {
                $output .= '<div class="w-full"></div>';
                $output .= '<dt>CCA</dt><dd> : ' . $cca . '</dd>';
            }
            if ( $voltage ) {
                $output .= '</dl>';
            }

        endwhile;

        echo $output;

    endif;

}

function button_whatsapp() {
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $whatsapp_text = 'Hi.%20Saya%20klik%20di%20website%3A%0A';
    $whatsapp_text .= urlencode($current_url);
    $whatsapp_text .= '%0AMau%20tanya%20info%20tentang%20produk%20Motobatt.';
    $whatsapp_link = 'https://wa.me/628157020999?text=' . $whatsapp_text;

    $button =   '<div class="button-wrap">';
    $button .=  '<a href="' . $whatsapp_link . '" class="button button-whatsapp" target="_blank">';
    $button .=  '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'whatsapp', 'group' => 'social', 'size' => 24, 'class' => 'whatsapp' ) ) . '</span>';
    $button .=  '<span class="button-text">' . __( 'INFO HARGA DAN PEMBELIAN', 'motobatt' ) . '</span>';
    $button .=  '</a>';
    $button .=  '</div>';
    echo $button;
}

function product_features() {
    $features = get_field('features');
    if ( $features ) {
        $output = '<h4 class="section-heading">' . __( 'Fitur', 'motobatt' ) . '</h4>';
        $output .= '<div class="features-wrap">' . $features . '</div>';
        echo $output;
    }
}

function product_applications() {
    $terms = get_the_terms( get_the_ID(), 'battery_applications' );

    if ( $terms && ! is_wp_error( $terms ) ) {

        $output = '<h4 class="section-heading">' . __( 'Aplikasi pada motor', 'motobatt' ) . '</h4>';
        $output .= '<div class="applications-wrap">';
        $output .= '<ul>';

        $applications = array();

        foreach ( $terms as $term ) {
            $termParentID = $term->parent;
            $termParent = get_term( $termParentID, 'battery_applications' );
            $applications[] = $termParent->name . ' ' . $term->name;
        }

        sort($applications);

        foreach ( $applications as $value ) {
            $output .= '<li>' . $value . '</li>';
        }

        $output .= '</ul>';
        $output .= '</div>';

        echo $output;
    }

}

function product_replaces() {
    $replaces = get_field('replaces');
    if ( $replaces ) {
        $output = '<h4 class="section-heading">' . __( 'Pengganti Aki', 'motobatt' ) . '</h4>';
        $output .= '<div class="replaces-wrap">' . $replaces . '</div>';
        echo $output;
    }
}

function product_specification() {
    $specification = 'specification';

    if( have_rows($specification) ):

        while( have_rows($specification) ): the_row();

            $mb_item_number = get_sub_field('mb_item_number');
            $voltage = get_sub_field('voltage');
            $cca = get_sub_field('cca');
            $capacity = get_sub_field('capacity');
            $weight = get_sub_field('weight');
            $dimensions_in__mm = get_sub_field('dimensions_in__mm');
            $assembly_figure_terminal_locations_number = get_sub_field('assembly_figure_terminal_locations_number');
            $assembly_figure_terminal_locations_image = get_sub_field('assembly_figure_terminal_locations_image');
            $terminal = get_sub_field('terminal');
            $screws = get_sub_field('screws');
            $washer = get_sub_field('washer');
            $allen_wrench = get_sub_field('allen_wrench');
            $block_nut = get_sub_field('block_nut');
            $terminal_caps = get_sub_field('terminal_caps');
            $spacer = get_sub_field('spacer');
            $cap_style = get_sub_field('cap_style');
            $terminal_cable_adaptors = get_sub_field('terminal_cable_adaptors');

            $output = '';
            if ( $mb_item_number ) {
                $output .= '<h4 class="section-heading">' . __( 'Spesifikasi', 'motobatt' ) . '</h4>';
                $output .= '<div class="specification-wrap">';
                $output .= '<table class="specification-table">';
            }

            if ( $mb_item_number ) {
                $output .= '<tr><th>Battery Type</th><td>' . $mb_item_number . '</td></tr>';
            }
            if ( $voltage ) {
                $output .= '<tr><th>Voltage</th><td>' . $voltage . '</td></tr>';
            }
            if ( $cca ) {
                $output .= '<tr><th>CCA</th><td>' . $cca . '</td></tr>';
            }
            if ( $capacity ) {
                $output .= '<tr><th>Capacity</th><td>' . $capacity . '</td></tr>';
            }
            if ( $weight ) {
                $output .= '<tr><th>Weight</th><td>' . $weight . '</td></tr>';
            }
            if ( $dimensions_in__mm ) {
                $output .= '<tr><th>Dimensions (mm)</th><td>' . $dimensions_in__mm . '</td></tr>';
            }
            if ( $assembly_figure_terminal_locations_number || $assembly_figure_terminal_locations_image ) {
                $output .= '<tr><th>Assembly Figure Terminal Locations</th><td>';
                if ($assembly_figure_terminal_locations_number) {
                    $output .= '<span style="display:inline-block; vertical-align: top">' . $assembly_figure_terminal_locations_number . '</span>';
                }
                if ($assembly_figure_terminal_locations_image) {
                    $output .= '<span style="display:inline-block; margin-left: 10px; vertical-align: top"><img src="' . $assembly_figure_terminal_locations_image['url'] . '"></span>';
                }
                $output .= '</td></tr>';
            }
            if ( $terminal ) {
                $output .= '<tr><th>Terminals</th><td>' . $terminal . '</td></tr>';
            }
            if ( $screws ) {
                $output .= '<tr><th>Screws</th><td>' . $screws . '</td></tr>';
            }
            if ( $washer ) {
                $output .= '<tr><th>Washer</th><td>' . $washer . '</td></tr>';
            }
            if ( $allen_wrench ) {
                $output .= '<tr><th>Allen Wrench</th><td>' . $allen_wrench . '</td></tr>';
            }
            if ( $block_nut ) {
                $output .= '<tr><th>Block Nut</th><td>' . $block_nut . '</td></tr>';
            }
            if ( $terminal_caps ) {
                $output .= '<tr><th>Terminal Caps</th><td>' . $terminal_caps . '</td></tr>';
            }
            if ( $spacer ) {
                $output .= '<tr><th>Spacer</th><td>' . $spacer . '</td></tr>';
            }
            if ( $cap_style ) {
                $output .= '<tr><th>Terminal Caps</th><td>' . $cap_style . '</td></tr>';
            }
            if ( $terminal_cable_adaptors ) {
                $output .= '<tr><th>Terminal Cable Adaptors</th><td>' . $terminal_cable_adaptors . '</td></tr>';
            }

            if ( $mb_item_number ) {
                $output .= '</table>';
                $output .= '</div>';
            }

        endwhile;

        echo $output;

    endif;

}

function product_related() {
    $output = '<h4 class="section-heading">' . __( 'Produk Terkait', 'motobatt' ) . '</h4>';
    echo $output;
}

genesis();
