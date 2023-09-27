<?php

/**
 * Archive
 *
 * @package      Motobatt
 * @author       Fransnico Susanto
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Full Width
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

/**
 * Blog Archive Body Class
 *
 */
function motobatt_blog_archive_body_class($classes)
{
  $classes[] = 'archive';
  return $classes;
}
add_filter('body_class', 'motobatt_blog_archive_body_class');

// Move breadcrumbs
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_archive_title_descriptions', 'genesis_do_breadcrumbs', 8);

remove_action('genesis_before_loop', 'genesis_do_taxonomy_title_description', 15);

// Remove description on paginated archives
if (get_query_var('paged')) {
  //remove_action('genesis_archive_title_descriptions', 'genesis_do_taxonomy_title_description', 12, 3);
  remove_action('genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12, 3);
}

add_action('genesis_before_loop', 'category_nav');
function category_nav()
{
  $categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC',
    'parent' => 0
  ));

  if ($categories) {
    echo '<div class="col-span-full my-8 lg:my-16">';
    echo '<div class="flex justify-center gap-x-8 lg:gap-x-16">';
    foreach ($categories as $cat) {
      $category_link = get_category_link($cat->term_id);
      $category_class = '';
      $category_style = 'font-family: Exo, Roboto, sans-serif;';
      $category = get_queried_object();
      if ($category->term_id == $cat->term_id) {
        $category_style .= ' color: #FFF200; border-color: #FFF200';
      }
      echo '<a href="' . esc_url($category_link) . '" class="inline-block text-white leading-[1.2] text-[28px] italic font-black no-underline border-transparent border-b-2 hover:border-[#FFF200] hover:text-[#FFF200] ' . $category_class . '" style="' . $category_style . '">';
      echo $cat->name;
      echo '</a>';
    }
    echo '</div>';
    echo '</div>';
  }

  // echo '<pre>';
  // print_r($categories);
  // echo '</pre>';
}

//add_action('genesis_archive_title_descriptions', 'archive_sub_nav');
function archive_sub_nav()
{
  //echo 'Sub Nav';
  $queried_object = get_queried_object();
  // echo '<pre>';
  // print_r($queried_object);
  // echo '</pre>';
  $current_term_id = $queried_object->term_id;
  $current_term = $queried_object->slug;
  if ($current_term == 'media') {

    $term_id = $queried_object->term_id;
    $taxonomy_name = 'category';
    $termchildren = get_term_children($term_id, $taxonomy_name);

    echo '<ul class="sub-nav">';
    echo '<li><a href="' . get_term_link($term_id, $taxonomy_name) . '" class="current_term">' . esc_html__('Semua', 'motobatt') . '</a></li>';
    foreach ($termchildren as $child) {
      $term = get_term_by('id', $child, $taxonomy_name);
      echo '<li><a href="' . get_term_link($child, $taxonomy_name) . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';
  } else {

    $term_id = $queried_object->term_id;
    $parent_id = $queried_object->parent;
    $taxonomy_name = 'category';
    $termchildren = get_term_children($parent_id, $taxonomy_name);
    $parent = get_term_by('id', $parent_id, $taxonomy_name);
    echo '<ul class="sub-nav">';
    echo '<li><a href="' . get_term_link($parent_id, $taxonomy_name) . '">' . esc_html__('Semua', 'motobatt') . '</a></li>';
    foreach ($termchildren as $child) {
      $term = get_term_by('id', $child, $taxonomy_name);
      $class = '';
      if ($current_term_id == $term->term_id) {
        $class = 'current_term';
      }
      // echo '<pre>';
      // print_r($term);
      // echo '</pre>';
      echo '<li><a href="' . get_term_link($child, $taxonomy_name) . '" class="' . $class . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';
  }
}

genesis();
