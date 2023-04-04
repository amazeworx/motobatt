<?php
/**
 * Template Name: Accessories
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
    ?>
    <div class="intro">
        <?php echo page_breadcrumbs_navigation(); ?>
        <h2 class="headline">Aki Motor</h2>
        <p class="subheadline">Temukan berbagai aki motor powersport berteknologi tinggi untuk performa terbaik</p>
    </div>

    <div class="product-cards-wrap">
        <div class="product-card">
            <div class="product-thumbnail">
                <a href="/quadflex">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/MBTX24U-01.jpg' ?>" alt="">
                </a>
            </div>
            <div class="product-info">
                <h4>QuadFlex Battery</h4>
                <div class="product-detail">
                    <!-- The first and unique 4-terminal patented system, propose the best balance between AH and CCA. -->
                    Sistem 4-terminal pertama di dunia dan dipatenkan, memberikan keseimbangan terbaik antara AH dan CCA.
                </div>
                <div><a href="/quadflex" class="button"><span class="button-text">Pilihan Produk</span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-thumbnail">
                <a href="/gel">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/MTZ6S-01.jpg' ?>" alt="">
                </a>
            </div>
            <div class="product-info">
                <h4>Gel Battery</h4>
                <div class="product-detail">
                    Direkomendasikan untuk penggunaan sehari-hari di daerah beriklim panas.
                    <!-- Recommended for daily use in hot climates. The Gel directly imported from Germany to obtain the best performance. -->
                </div>
                <div><a href="/gel" class="button"><span class="button-text">Pilihan Produk</span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-thumbnail">
                <a href="/pro-lithium">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/MPL14B4-P-01.jpg' ?>" alt="">
                </a>
            </div>
            <div class="product-info">
                <h4>Pro Lithium</h4>
                <div class="product-detail">
                    Aki yang direkomendasikan untuk penggunaan profesional atau kompetisi.
                    <!-- Recommended batteries for professional or competitive use -->
                </div>
                <div><a href="/pro-lithium" class="button"><span class="button-text">Pilihan Produk</span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-thumbnail">
                <a href="/hybrid">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/MHTX16-01.jpg' ?>" alt="">
                </a>
            </div>
            <div class="product-info">
                <h4>Hybrid</h4>
                <div class="product-detail">
                    Perpaduan sempurna antara asam timbal dan baterai lithium
                    <!-- The perfect mix between the advantages of lead acid and lithium batteries -->
                </div>
                <div><a href="/hybrid" class="button"><span class="button-text">Pilihan Produk</span><?php echo '<span class="button-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-left-circle' ) ) . '</span>' ?></a></div>
            </div>
        </div>

    </div>

    <?php
}



/* Run Genesis */
genesis();