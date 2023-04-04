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

//* Youtube Video on Entry Header
add_action( 'genesis_entry_header', 'single_video_post', 9 );
function single_video_post() {
    $youtube_video_url = get_field('youtube_video_url');
    if ($youtube_video_url) {
        global $wp_embed;
        $post_video = $wp_embed->run_shortcode('[embed]' . $youtube_video_url . '[/embed]');
        echo '<div class="video-responsive">' . $post_video . '</div>';
    }
}

genesis();
