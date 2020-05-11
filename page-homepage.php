<?php
/**
 * Template Name: Homepage
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'gfs_add_body_class' );
function gfs_add_body_class( $classes ) {

	$classes[] = 'home';

	return $classes;

}

/* Remove Skip Links */
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );
add_action( 'wp_enqueue_scripts', 'gfs_dequeue_skip_links' );
function gfs_dequeue_skip_links() {

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

// Add homepage content
add_action( 'genesis_entry_content', 'gfs_homepage_content' );
function gfs_homepage_content() {
    ?>
    <div class="intro">
        <h2 class="headline">Aki PowerSports Terbaik di Indonesia</h2>
        <div class="section-buttons">
            <a href="/cari-aki" class="button button-lg button-pill button-gradient">Temukan Aki Motormu</a>
        </div>
    </div>
    <div class="products">
        <div class="container">
            <h2 class="section-title">Produk Motobatt</h2>
            <div class="products-grid">
                <a href="/produk" class="grid-item">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/motobatt-battery.jpg' ?>" alt="Motobatt Battery">
                    </div>
                    <div class="title">Aki Motor</div>
                </a>
                <a href="/produk" class="grid-item">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/motobatt-accessories.jpg' ?>" alt="Motobatt Accessories">
                    </div>
                    <div class="title">Aksesoris</div>
                </a>
            </div>
        </div>
    </div>
    <div class="technology">
        <div class="container">
            <h2 class="headline">Dengan Teknologi Revolusioner</h2>
            <p class="subheadline">Lebih kuat, awet dan tahan lama</p>
            <div class="section-buttons">
                <a href="/teknologi" class="button button-lg button-pill button-gradient">KENALI TEKNOLOGI MOTOBATT</a>
            </div>
            <div class="technology-logo">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/quadflex-logo.svg' ?>" alt=""> <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/gel-logo.svg' ?>" alt="">
            </div>
        </div>
    </div>
    <div class="media">
        <div class="container">
            <h2 class="section-title">Media</h2>
            <div class="media-grid">
                <div class="media-card">
                    <a href="/media" class="media-link">
                        <div class="media-thumbnail">
                            <div class="media-thumbnail--inner">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/video-1.jpg' ?>" alt="">
                            </div>
                        </div>
                        <div class="media-title">
                            Battery Installation - Motobatt
                        </div>
                    </a>
                </div>
                <div class="media-card">
                    <a href="/media" class="media-link">
                        <div class="media-thumbnail">
                            <div class="media-thumbnail--inner">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/video-2.jpg' ?>" alt="">
                            </div>
                        </div>
                        <div class="media-title">
                            Motobatt Battery Features and Benefits
                        </div>
                    </a>
                </div>
                <div class="media-card">
                    <a href="/media" class="media-link">
                        <div class="media-thumbnail">
                            <div class="media-thumbnail--inner">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/video-3.jpg' ?>" alt="">
                            </div>
                        </div>
                        <div class="media-title">
                            Motobatt Quick Pocket Battery and System Voltage Tester
                        </div>
                    </a>
                </div>
            </div>
            <div class="section-buttons">
                <a href="/media" class="button button-invert">Lihat Semua</a>
            </div>
        </div>
    </div>
    <?php
}


/* Run Genesis */
genesis();