<?php
/**
 * Template Name: Products Page
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'products';

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
    $page_headline = get_field('page_headline');
    $page_subheadline = get_field('page_subheadline');
    ?>
    <div class="intro">
        <h2 class="headline"><?php echo $page_headline ?></h2>
        <p class="subheadline"><?php echo $page_subheadline ?></p>
    </div>

    <?php if( have_rows('product_categories') ): ?>
        <div class="product-cards-wrap">

        <?php while( have_rows('product_categories') ): the_row(); ?>
        <?php
            $category_image = get_sub_field('category_image');
            $category_title = get_sub_field('category_title');
            $category_description = get_sub_field('category_description');
            $category_url = get_sub_field('category_url');
        ?>
        <div class="product-card">
            <div class="product-thumbnail">
                <a href="<?php echo $category_url ?>">
                    <img src="<?php echo esc_url( $category_image['url'] ); ?>" alt="">
                </a>
            </div>
            <div class="product-info">
                <h4><?php echo $category_title ?></h4>
                <div class="product-detail">
                    <?php echo $category_description ?>
                </div>
                <div><a href="<?php echo $category_url ?>" class="button"><span class="button-text"><?php echo __('Pilihan Produk', 'motobatt') ?></span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
            </div>
        </div>
        <?php endwhile; ?>

        </div>

    <?php endif; ?>


    <?php
}



/* Run Genesis */
genesis();