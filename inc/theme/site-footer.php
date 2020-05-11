<?php
/**
 * Site Footer
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Site Footer
 *
 */
function gfs_site_footer() {
    ?>
    <div class="footer-social">
        <a href="#" class="social-link"><?php echo gfs_icon( array( 'icon' => 'whatsapp', 'group' => 'social', 'size' => 24, 'class' => 'whatsapp' ) ); ?></a>
        <a href="#" class="social-link"><?php echo gfs_icon( array( 'icon' => 'facebook', 'group' => 'social', 'size' => 24, 'class' => 'facebook' ) ); ?></a>
        <a href="#" class="social-link"><?php echo gfs_icon( array( 'icon' => 'instagram', 'group' => 'social', 'size' => 24, 'class' => 'instagram' ) ); ?></a>
        <a href="#" class="social-link"><?php echo gfs_icon( array( 'icon' => 'youtube', 'group' => 'social', 'size' => 24, 'class' => 'youtube' ) ); ?></a>
    </div>
    <div class="footer-copyright">
        <p class="copyright">Copyright &copy; <?php date( 'Y' ) ?> PT. Motobatt Indonesia. All Rights Reserved.</p>
    </div>
    <?php
}
add_action( 'genesis_footer', 'gfs_site_footer' );
remove_action( 'genesis_footer', 'genesis_do_footer' );
