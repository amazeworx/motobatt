<?php
/**
 * Template Name: Recommendation
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'recommendation';

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

//add_action( 'genesis_before_content', 'page_breadcrumbs_navigation' );
function page_breadcrumbs_navigation() {
    $findbattery_link = site_url('/cari-aki/');
    if ( function_exists( 'pll_current_language' ) ) {
        $lang = pll_current_language('slug');
        if ($lang == "en") {
            $findbattery_link = site_url('/en/find-battery/');
        }
    }
    $output = '<div class="breadcrumbs-wrap">';
    $output .=  '<a href="' . $findbattery_link . '" class="button-back">';
    $output .=  '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-left-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>';
    $output .=  '<span class="button-text">' . __('Kembali ke Pencarian', 'motobatt') . '</span>';
    $output .=  '</a>';
    $output .= '</div>';
    echo $output;
}

// Add find battery content
add_action( 'genesis_entry_content', 'motobatt_recommendation_content' );
function motobatt_recommendation_content() {
    $modelParam = isset($_GET["model"]) ? $_GET["model"] : '';

    $model = get_term_by('slug', $modelParam, 'battery_applications');
    $brand = get_term_by('id', $model->parent, 'battery_applications');
    //echo $model;

    // echo '<pre>';
    // print_r($brand);
    // echo '</pre>';
    ?>
    <div class="intro">
        <?php echo page_breadcrumbs_navigation(); ?>
        <p class="subheadline"><?php echo __('Rekomendasi untuk motor', 'motobatt') ?></p>
        <h2 class="headline"><?php echo $brand->name ?> <?php echo $model->name ?></h2>
    </div>

    <div class="product-cards-wrap">
        <?php
            $query_args = array(
                'posts_per_page' => '-1',
                'post_type' => 'motobatt_products',
                'post_status' => 'publish',
                'paged' => '1',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'battery_applications',
                        'field'    => 'slug',
                        'terms'    => $model->name,
                    ),
                ),
            );

            // The Query
            $the_query = new WP_Query( $query_args );

            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();

                    $id = get_the_ID();
                    $terms = get_the_terms( $id, 'product_categories' );
                    $category = $terms[0]->name;
                    $thumbnail = get_the_post_thumbnail_url( $id, 'medium' );
                    $permalink = get_the_permalink();
                    $title = get_the_title();
                    $specification = get_field('specification');
                    $voltage = $specification['voltage'];
                    $capacity = $specification['capacity'];
                    $cca = $specification['cca'];
                    ?>

                    <div class="product-card">
                        <div class="product-thumbnail">
                            <a href="<?php echo $permalink ?>">
                                <img src="<?php echo $thumbnail ?>" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <h5><?php echo $category ?></h5>
                            <h3><a href="<?php echo $permalink ?>"><?php echo $title ?></a></h3>
                            <div class="product-detail">
                                <dl>
                                    <?php if ( $voltage ) : ?>
                                        <dt><?php echo __('Voltase', 'motobatt') ?></dt>
                                        <dd>: <?php echo $voltage ?></dd>
                                    <?php endif; ?>
                                    <?php if ( $capacity ) : ?>
                                        <div class="w-full"></div>
                                        <dt><?php echo __('Kapasitas', 'motobatt') ?></dt>
                                        <dd>: <?php echo $capacity ?></dd>
                                    <?php endif; ?>
                                    <?php if ( $cca ) : ?>
                                        <div class="w-full"></div>
                                        <dt>CCA</dt>
                                        <dd>: <?php echo $cca ?></dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                            <div><a href="<?php echo $permalink ?>" class="button"><span class="button-text"><?php echo __('Lihat Detail', 'motobatt') ?></span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
                        </div>
                    </div>

                    <?php
                }
                /* Restore original Post Data */
                wp_reset_postdata();
            } else {
                // no posts found
            }
        ?>
    </div>


    <?php
}



/* Run Genesis */
genesis();