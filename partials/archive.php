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

	gfs_post_summary_image();

	echo '<div class="post-summary__content">';
		gfs_entry_category();
		gfs_post_summary_title();
	echo '</div>';

echo '</article>';
