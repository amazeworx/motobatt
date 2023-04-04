<?php
/**
 * Template Name: Find Battery
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'find-battery';

	return $classes;

}

/* Remove Skip Links */
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );
add_action( 'wp_enqueue_scripts', 'motobatt_dequeue_skip_links' );
function motobatt_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

/* Force full width content layout */
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

/* Remove Entry Header */
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


// Remove unnecessary stuff from the loop.
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

function page_breadcrumbs_navigation() {
    $output =   '<div class="breadcrumbs-wrap">';
    $output .=  '<div class="container">';
    $output .=  '<a href="/" class="">';
    $output .=  'Home';
    $output .=  '</a>';
    $output .=  ' &raquo ' . __('Cari Aki', 'motobatt');
    $output .=  '</div>';
    $output .=  '</div>';
    echo $output;
}

// Add find battery content
add_action( 'genesis_before_content', 'motobatt_findbattery_intro' );
function motobatt_findbattery_intro() {
    ?>
    <div class="intro">
        <div class="container">
            <?php echo page_breadcrumbs_navigation(); ?>
            <h2 class="headline"><?php echo __('Temukan Aki Motormu', 'motobatt') ?></h2>
            <p class="subheadline"><?php echo __('Gunakan fitur pencarian di bawah ini untuk menemukan rekomendasi aki yang paling sesuai untuk motormu.', 'motobatt') ?></p>
        </div>
    </div>
    <?php
}
add_action( 'genesis_entry_content', 'motobatt_findbattery_content' );
function motobatt_findbattery_content() {
    ?>
    <div class="find-battery-wrap">
        <form id="find-battery-form">
            <div class="form-group">
                <select id="select-brand">
                </select>
            </div>
            <div class="form-group">
                <select id="select-model">
                </select>
            </div>
            <div class="form-group">
                <button type="button" id="button-find-battery" class="button button-block button-lg button-pill button-gradient"><?php echo __('Temukan Aki Motormu', 'motobatt') ?></button>
            </div>
        </form>
    </div>
    <?php
}

add_action( 'genesis_after_footer', 'motobatt_findbattery_select_array' );
function motobatt_findbattery_select_array() {

    $applications = array();

    $args = array(
        'taxonomy' => 'battery_applications',
        'hide_empty' => false,
        'parent'   => 0
    );
    $brands = get_terms($args);

    $i = 0;
    foreach ( $brands as $brand ) {
        $applications['brands'][$i]['id'] = $brand->term_id;
        $applications['brands'][$i]['name'] = $brand->name;
        $applications['brands'][$i]['slug'] = $brand->slug;

        $models = get_terms(array(
            'taxonomy' => 'battery_applications',
            'child_of' => $brand->term_id,
            'hide_empty' => false,
        ));

        $x = 0;
        foreach ( $models as $model ) {
            $applications['brands'][$i]['models'][$x]['id'] = $model->term_id;
            $applications['brands'][$i]['models'][$x]['name'] = $model->name;
            $applications['brands'][$i]['models'][$x]['slug'] = $model->slug;
            $x++;
        }

        $i++;
    }

    $applicationsJson = json_encode($applications);

    echo "<script>var applicationsJson = JSON.parse('" . $applicationsJson . "');</script>";
    // echo '<pre>';
    // print_r($applicationsJson);
    // echo '</pre>';

}

/**
 * Find battery ajax API wp-json
 */
add_action( 'wp_enqueue_scripts', 'motobatt_findbattery_page_js', 9999 );
function motobatt_findbattery_page_js() {
    wp_enqueue_script( 'findbattery', get_stylesheet_directory_uri() . '/assets/js/findbattery.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/findbattery.js' ), true );
    wp_localize_script( 'findbattery', 'findbattery_object',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'choose_brand' => __( 'Pilih Merek Motor', 'motobatt' ),
            'choose_model' => __( 'Pilih Model Motor', 'motobatt' ),
            'recommendation_url' => __( '/rekomendasi/', 'motobatt' ),
        )
    );
}

/* Run Genesis */
genesis();