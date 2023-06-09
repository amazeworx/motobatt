<?php

/**
 * Functions
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/*
BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/EA-Starter/wiki
Devs, contact me if you need access
*/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if (!isset($content_width))
  $content_width = 768;

/* # Set Localization (do not remove)
============================================= */
load_child_theme_textdomain('motobatt', apply_filters('child_theme_textdomain', get_stylesheet_directory() . '/languages', 'motobatt'));

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function motobatt_global_enqueues()
{

  // javascript
  if (!motobatt_is_amp()) {
    //wp_enqueue_script( 'smooth-scroll', get_stylesheet_directory_uri() . '/assets/js/smoothscroll.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/smoothscroll.js' ), true );
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/vendor/slick/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('gfs-global', get_stylesheet_directory_uri() . '/assets/js/global.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/global.js'), true);
  }

  // css
  wp_dequeue_style('child-theme');
  wp_enqueue_style('gfs-fonts', motobatt_theme_fonts_url());
  //wp_enqueue_style( 'tailwind', get_stylesheet_directory_uri() . '/assets/vendor/tailwindcss/tailwind.min.css', array(), '1.4.6' );
  wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/vendor/slick/slick.css', array(), '1.8.1');
  wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/assets/vendor/slick/slick-theme.css', array(), '1.8.1');

  wp_enqueue_style('gfs-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
  wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/custom.css'));
}
add_action('wp_enqueue_scripts', 'motobatt_global_enqueues');

/**
 * Gutenberg scripts and styles
 *
 */
function motobatt_gutenberg_scripts()
{
  wp_enqueue_style('gfs-fonts', motobatt_theme_fonts_url());
  wp_enqueue_script('gfs-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array('wp-blocks', 'wp-dom'), filemtime(get_stylesheet_directory() . '/assets/js/editor.js'), true);
}
add_action('enqueue_block_editor_assets', 'motobatt_gutenberg_scripts');

/**
 * Theme Fonts URL
 *
 */
function motobatt_theme_fonts_url()
{
  return 'https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Material+Icons&display=swap';
}

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function motobatt_child_theme_setup()
{

  define('CHILD_THEME_VERSION', filemtime(get_stylesheet_directory() . '/assets/css/main.css'));

  // General cleanup
  include_once(get_stylesheet_directory() . '/inc/general/wordpress-cleanup.php');
  include_once(get_stylesheet_directory() . '/inc/general/genesis-changes.php');

  // Theme
  include_once(get_stylesheet_directory() . '/inc/theme/markup.php');
  include_once(get_stylesheet_directory() . '/inc/theme/helper-functions.php');
  include_once(get_stylesheet_directory() . '/inc/theme/layouts.php');
  include_once(get_stylesheet_directory() . '/inc/theme/navigation.php');
  include_once(get_stylesheet_directory() . '/inc/theme/loop.php');
  include_once(get_stylesheet_directory() . '/inc/theme/author-box.php');
  include_once(get_stylesheet_directory() . '/inc/theme/template-tags.php');
  include_once(get_stylesheet_directory() . '/inc/theme/site-footer.php');

  // Editor
  include_once(get_stylesheet_directory() . '/inc/editor/disable-editor.php');
  include_once(get_stylesheet_directory() . '/inc/editor/tinymce.php');

  // Functionality
  include_once(get_stylesheet_directory() . '/inc/functionality/post-type.php');
  include_once(get_stylesheet_directory() . '/inc/functionality/login-logo.php');
  include_once(get_stylesheet_directory() . '/inc/functionality/block-area.php');
  include_once(get_stylesheet_directory() . '/inc/functionality/social-links.php');
  include_once(get_stylesheet_directory() . '/inc/functionality/video-post.php');

  // Plugin Support
  include_once(get_stylesheet_directory() . '/inc/plugin/acf.php');
  include_once(get_stylesheet_directory() . '/inc/plugin/amp.php');
  //include_once( get_stylesheet_directory() . '/inc/plugin/shared-counts.php' );
  //include_once( get_stylesheet_directory() . '/inc/plugin/wpforms.php' );

  // Editor Styles
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');

  // Image Sizes
  // add_image_size( 'motobatt_featured', 400, 100, true );

  // Gutenberg

  // -- Responsive embeds
  add_theme_support('responsive-embeds');

  // -- Wide Images
  add_theme_support('align-wide');

  // -- Disable custom font sizes
  add_theme_support('disable-custom-font-sizes');

  // -- Editor Font Styles
  add_theme_support('editor-font-sizes', array(
    array(
      'name'      => 'Small',
      'shortName' => 'S',
      'size'      => 14,
      'slug'      => 'small'
    ),
    array(
      'name'      => 'Normal',
      'shortName' => 'M',
      'size'      => 20,
      'slug'      => 'normal'
    ),
    array(
      'name'      => 'Large',
      'shortName' => 'L',
      'size'      => 24,
      'slug'      => 'large'
    ),
  ));

  // -- Disable Custom Colors
  add_theme_support('disable-custom-colors');

  // -- Editor Color Palette
  add_theme_support('editor-color-palette', array(
    array(
      'name'  => 'Blue',
      'slug'  => 'blue',
      'color'  => '#05306F',
    ),
    array(
      'name'  => 'Grey',
      'slug'  => 'grey',
      'color' => '#FAFAFA',
    ),
  ));
}
add_action('genesis_setup', 'motobatt_child_theme_setup', 15);

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function motobatt_comment_text($args)
{
  $args['title_reply']          = __('Leave A Reply', 'motobatt');
  $args['label_submit']         = __('Post Comment',  'motobatt');
  $args['comment_notes_before'] = '';
  $args['comment_notes_after']  = '';
  return $args;
}
add_filter('comment_form_defaults', 'motobatt_comment_text');


/**
 * Template Hierarchy
 *
 */
function motobatt_template_hierarchy($template)
{
  if (is_home())
    $template = get_query_template('archive');
  return $template;
}
add_filter('template_include', 'motobatt_template_hierarchy');
