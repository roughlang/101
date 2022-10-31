<?php

// echo 'wp_commmon.php';

function hello($hello='') {
  if (!empty($hello)) {
    return $hello;
  } else {
    $hello = 'hello';
  }
  return 'hello';
}

/**
 * Get meta data
 * 
 * tile
 * description
 */
function get_meta($type='home') {

}

/**
 * page判定
 * URL: https://wpdocs.osdn.jp/%E6%9D%A1%E4%BB%B6%E5%88%86%E5%B2%90%E3%82%BF%E3%82%B0
 * is_home()
 * is_front_page()
 * is_tag()
 * is_category()
 * 
 * is_single()
 * is_page()
 * 
 */
function get_page_type() {
  $type = 'can not get the type!';
  if (is_front_page() && is_home() ) {
    $type = 'home';
  } else if (is_search()) {
    $type = 'search';
  } else if (is_category()) {
    $type = 'category';
  } else if (is_tag()) {
    $type = 'tag';
  } else if (is_single()) {
    $type = 'single';
  } else if (is_page()) {
    $type = 'page';
  } else {
    $type = 'home';
  }
  return $type;
}