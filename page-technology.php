<?php
/**
 * Template Name: Technology
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'technology';

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
    $output .=  ' &raquo ' . get_the_title();
    $output .=  '</div>';
    $output .=  '</div>';
    echo $output;
}

// Add find battery content
add_action( 'genesis_before_content', 'motobatt_technology_intro' );
function motobatt_technology_intro() {
    $intro_text = get_field('intro_text');
    ?>
    <div class="intro">
        <div class="container">
            <?php echo page_breadcrumbs_navigation(); ?>
            <h2 class="headline"><?php the_title(); ?></h2>
            <?php if($intro_text) {
                echo '<p class="subheadline">' . $intro_text . '</p>';
            } ?>
        </div>
    </div>
    <?php
}
add_action( 'genesis_entry_content', 'motobatt_technology_content' );
function motobatt_technology_content() {
    $opening_text = get_field('opening_text');
    ?>
    <div class="technology-content-wrap">
        <?php if($opening_text) {
            echo $opening_text;
        } ?>
        <?php
            if( have_rows('technology_list') ):

                while( have_rows('technology_list') ): the_row();
                    $technology_title = get_sub_field('technology_title');
                    $technology_subheading = get_sub_field('technology_subheading');
                    $technology_intro_text = get_sub_field('technology_intro_text');
                    $technology_cover_image = get_sub_field('technology_cover_image');
                    ?>
                    <div class="technology-row">
                        <h3 class="technology-title"><?php echo $technology_title ?></h3>
                        <p class="technology-subheading"><?php echo $technology_subheading ?></p>
                        <?php echo $technology_intro_text ?>
                        <p class="technology-cover-image"><img src="<?php echo $technology_cover_image['url'] ?>"></p>
                        <?php
                            if( have_rows('technology_features') ):
                                echo '<div class="technology-features">';
                                while( have_rows('technology_features') ): the_row();
                                $features_icon = get_sub_field('features_icon');
                                $features_title = get_sub_field('features_title');
                                $features_description = get_sub_field('features_description');
                                ?>
                                    <div class="features-row">
                                        <div class="features-icon">
                                            <img src="<?php echo $features_icon['url'] ?>" alt="">
                                        </div>
                                        <div class="features-details">
                                            <h5 class="features-title"><?php echo $features_title ?></h5>
                                            <?php if ($features_description) { ?>
                                                <p class="features-description"><?php echo $features_description ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                echo '</div>';
                            endif;
                        ?>

                    </div>
                    <?php

                endwhile;

            endif;
        ?>
    </div>
    <?php
}


/* Run Genesis */
genesis();