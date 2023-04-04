<?php
/**
 * Template Name: Products Cards
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'products-archive';

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
    $output =   '<div class="breadcrumbs-wrap">';
    $output .=  '<div class="container">';
    $output .=  '<a href="/" class="">';
    $output .=  'Home';
    $output .=  '</a>';
    $output .=  ' &raquo Produk';
    $output .=  '</div>';
    $output .=  '</div>';
    echo $output;
}

// Add find battery content
add_action( 'genesis_entry_content', 'motobatt_products_content' );
function motobatt_products_content() {
    ?>
    <div class="intro">
        <h1 class="headline"><?php echo the_title() ?></h1>
        <div class="intro-content"><?php echo the_content() ?></div>
    </div>

    <div class="product-models">
        <?php
            $product_category_title = get_field('product_category_title');
            if ( $product_category_title ) {
                echo '<h3 class="category-title">' . $product_category_title . '</h3>';
            }
        ?>
        <div class="product-cards-wrap">

            <?php
                $term = get_field('product_category');
                $query_args = array(
                    'posts_per_page' => '-1',
                    'post_type' => 'motobatt_products',
                    'lang' => '',
                    'post_status' => 'publish',
                    'paged' => '1',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_categories',
                            'field'    => 'id',
                            'terms'    => $term,
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
                        $thumbnail = get_the_post_thumbnail_url( $id, 'medium' );
                        $permalink = get_the_permalink();
                        $title = get_the_title();
                        ?>

                        <div class="product-card boxed">
                            <div class="product-card-wrap">
                                <h5 class="product-title"><a href="<?php echo $permalink ?>"><?php echo $title ?></a></h5>
                                <div class="product-thumbnail">
                                    <a href="<?php echo $permalink ?>">
                                        <img src="<?php echo $thumbnail ?>" alt="">
                                    </a>
                                </div>
                                <div><a href="<?php echo $permalink ?>" class="button"><span class="button-text"><?php echo __('Detail Produk', 'motobatt') ?></span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
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
    </div>


    <?php
}



/* Run Genesis */
genesis();