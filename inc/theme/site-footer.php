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
function motobatt_site_footer() {
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $whatsapp_text = 'Hi.%20Saya%20klik%20di%20website%3A%0A';
    $whatsapp_text .= urlencode($current_url);
    $whatsapp_text .= '%0AMau%20tanya%20info%20tentang%20produk%20Motobatt.';
    $whatsapp_link = 'https://wa.me/628157020999?text=' . $whatsapp_text;
    ?>
    <div class="footer-social">
        <a href="<?php echo $whatsapp_link ?>" class="social-link" target="_blank"><?php echo motobatt_icon( array( 'icon' => 'whatsapp', 'group' => 'social', 'size' => 24, 'class' => 'whatsapp' ) ); ?></a>
        <a href="https://www.facebook.com/motobattindonesia/" class="social-link" target="_blank"><?php echo motobatt_icon( array( 'icon' => 'facebook', 'group' => 'social', 'size' => 24, 'class' => 'facebook' ) ); ?></a>
        <a href="https://www.instagram.com/motobattindonesia/" class="social-link" target="_blank"><?php echo motobatt_icon( array( 'icon' => 'instagram', 'group' => 'social', 'size' => 24, 'class' => 'instagram' ) ); ?></a>
        <a href="https://www.youtube.com" class="social-link" target="_blank"><?php echo motobatt_icon( array( 'icon' => 'youtube', 'group' => 'social', 'size' => 24, 'class' => 'youtube' ) ); ?></a>
    </div>
    <div class="footer-copyright">
        <p class="copyright">Copyright &copy; <?php date( 'Y' ) ?> PT. Motobatt Indonesia. All Rights Reserved.</p>
    </div>
    <?php
}
add_action( 'genesis_footer', 'motobatt_site_footer' );
remove_action( 'genesis_footer', 'genesis_do_footer' );
