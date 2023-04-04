<?php
/**
 * Template Name: FAQ
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 */

 /* Add body class */
add_filter( 'body_class', 'motobatt_add_body_class' );
function motobatt_add_body_class( $classes ) {

	$classes[] = 'faq';

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
//remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
//remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


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

add_action( 'genesis_entry_content', 'motobatt_faq_content' );
function motobatt_faq_content() {
    if( have_rows('faqs') ):
        while( have_rows('faqs') ): the_row();
            $faq_section_title = get_sub_field('faq_section_title');
            echo '<h4 class="faq-section-title">' . $faq_section_title . '</h4>';
            if( have_rows('faq_list') ):
                echo '<dl class="accordion">';
                while( have_rows('faq_list') ): the_row();
                    $faq_question = get_sub_field('faq_question');
                    $faq_answer = get_sub_field('faq_answer');

                    ?>

                    <dt><a class="accordion-trigger" href="#"><span class="accordion-title"><?php echo $faq_question ?></span><?php echo '<span class="accordion-icon">' . motobatt_icon( array( 'icon' => 'arrow-right-circle', 'group' => 'utility', 'size' => 16, 'class' => 'arrow-right-circle' ) ) . '</span>' ?></a></dt>
                    <dd><?php echo $faq_answer ?></dd>

                    <?php
                endwhile;
                echo '</dl>';
            endif;
        endwhile;

    endif;
}


/* Run Genesis */
genesis();