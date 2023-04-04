<?php
/**
 * Archive partial
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="post-summary">';

    $youtube_video_url = get_field('youtube_video_url');
    if ($youtube_video_url) {
        global $wp_embed;
        $post_video = $wp_embed->run_shortcode('[embed]' . $youtube_video_url . '[/embed]');
        echo '<div class="post-summary__video video-responsive">' . $post_video . '</div>';
    } else {
        motobatt_post_summary_image();
    }

	echo '<div class="post-summary__content">';
		motobatt_post_summary_title();
	echo '</div>';

echo '</article>';
