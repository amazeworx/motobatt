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
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'home';

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

// Add homepage content
add_action( 'genesis_entry_content', 'motobatt_homepage_content' );
function motobatt_homepage_content() {
    $intro_headline = get_field('intro_headline');
    $intro_image = get_field('intro_image');
    $intro_button_text = get_field('intro_button_text');
    $intro_button_link = get_field('intro_button_link');
    $intro_button_2_text = get_field('intro_button_2_text');
    $intro_button_2_link = get_field('intro_button_2_link');	
    $product_headline = get_field('product_headline');
    $battery_image = get_field('battery_image');
    $battery_text = get_field('battery_text');
    $battery_link = get_field('battery_link');
    $accessories_image = get_field('accessories_image');
    $accessories_text = get_field('accessories_text');
    $accessories_link = get_field('accessories_link');
    $technology_headline = get_field('technology_headline');
    $technology_sub_headline = get_field('technology_sub_headline');
    $technology_button_text = get_field('technology_button_text');
    $technology_button_link = get_field('technology_button_link');
    $video_headline = get_field('video_headline');
    $embed_video = get_field('embed_video');
    ?>
    <div class="intro">
        <h2 class="headline"><?php echo $intro_headline ?></h2>
        <div class="section-buttons">
            <a href="<?php echo $intro_button_link ?>" class="button button-lg button-pill button-gradient"><?php echo $intro_button_text ?></a>
			<?php if ($intro_button_2_link) { ?>
			<a href="<?php echo $intro_button_2_link ?>" class="button button-lg button-pill button-gradient"><?php echo $intro_button_2_text ?></a>
			<?php } ?>
        </div>
    </div>
    <div class="products">
        <div class="container">
            <h2 class="section-title"><?php echo $product_headline ?></h2>
            <div class="products-grid">
                <a href="<?php echo $battery_link ?>" class="grid-item">
                    <div class="image">
                        <img src="<?php echo $battery_image['url'] ?>" alt="Motobatt Battery">
                    </div>
                    <div class="title"><?php echo $battery_text ?></div>
                </a>
                <a href="<?php echo $accessories_link ?>" class="grid-item">
                    <div class="image">
                        <img src="<?php echo $accessories_image['url'] ?>" alt="Motobatt Accessories">
                    </div>
                    <div class="title"><?php echo $accessories_text ?></div>
                </a>
            </div>
        </div>
    </div>
    <div class="technology">
        <div class="container">
            <h2 class="headline"><?php echo $technology_headline ?></h2>
            <p class="subheadline"><?php echo $technology_sub_headline ?></p>
            <div class="section-buttons">
                <a href="<?php echo $technology_button_link ?>" class="button button-lg button-pill button-gradient"><?php echo $technology_button_text ?></a>
            </div>
            <div class="technology-logo">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/quadflex-logo.svg' ?>" alt=""> <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/gel-logo.svg' ?>" alt=""> <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/prolithium-logo.svg' ?>" alt=""> <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/hybrid-logo.svg' ?>" alt="">
            </div>
        </div>
    </div>
    <?php if ($embed_video) { ?>
    <div class="video">
        <div class="container">
            <h2 class="section-title"><?php echo $video_headline ?></h2>
            <div class="video-container">
                <?php echo $embed_video ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="media">
        <div class="container">
            <h2 class="section-title">Media</h2>
            <div class="media-grid">
            <?php
                $query_args = array(
                    'posts_per_page' => '6',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'paged' => '1',
                );

                // The Query
                $the_query = new WP_Query( $query_args );

                // The Loop
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>
                        <div class="media-card">
                            <a href="<?php the_permalink() ?>" class="media-link">
                                <div class="media-thumbnail">
                                    <?php
                                        $youtube_video_url = get_field('youtube_video_url');
                                        if ($youtube_video_url) {
                                            $uri = $youtube_video_url;
                                            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $uri, $id)) {
                                                $video_id = $id[1];
                                            } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $uri, $id)) {
                                                $video_id = $id[1];
                                            } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $uri, $id)) {
                                                $video_id = $id[1];
                                            } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $uri, $id)) {
                                                $video_id = $id[1];
                                            } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $uri, $id)) {
                                                $video_id = $id[1];
                                            } else {
                                                    // not an youtube video
                                            }
                                            $img_url = 'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';
                                        } else if ( has_post_thumbnail() ) {
                                            $img_url = get_the_post_thumbnail_url(get_the_id(), 'full');
                                        }
                                    ?>
                                    <div class="media-thumbnail--inner" style="background-size: cover; background-image: url('<?php echo $img_url ?>')">
                                    </div>
                                </div>
                                <div class="media-title">
                                    <?php the_title() ?>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                }
            ?>
            </div>
            <div class="section-buttons">
                <a href="/media" class="button"><?php echo __('Lihat Semua', 'motobatt') ?></a>
            </div>
        </div>
    </div>
    <?php
}


/* Run Genesis */
genesis();