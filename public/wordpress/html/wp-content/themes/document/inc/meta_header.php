<?php
require_once('wp_common.php');
// echo get_page_type()."<br>\n";

/**
 * $site_name
 * $site_title
 * $url_link
 * $description
 * $type
 */
$site_name = '101 Roughlang';
if (get_page_type() == 'home') {
  $site_title = $site_name;
  $url_link = 'https://101.roughlang.com/';
  $description = 'システムエンジニアのメモと覚書きとアイディア帳。WEBの技術やインフラ構築、PHP/Laravelなどについて書いています。';
  $type = 'website';
  $og_image = 'https://101.roughlang.com/assets/img/og/101-roughlang-og.png';
} else if (get_page_type() == 'single' || get_page_type() == 'page') {
  $site_title = get_the_title().' | '.$site_name;
  /* link */
  $url_link = esc_url(get_permalink());
  /* description */
  if (!empty(get_the_excerpt())) {
    $description = get_the_excerpt();
  } else {
    $description = get_the_content();
  }
  $description =  mb_substr(strip_tags($description),0,200);
  $type = 'article';
  $og_image = 'https://101.roughlang.com/assets/img/og/101-roughlang-og.png';
}
/**
 * ENV
 */
$tmp_env = [];
$env = [];
$tmp_env = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.env');
$rows = explode("\n", $tmp_env);
foreach ($rows as $line) {
  list ($name, $value) = explode('=',$line);
  $env = array_merge($env, array( $name=>$value) );
}
/**
 * Get page link
 */
$link = get_the_permalink();
// var_dump($link);

/* meta data */

?>
<!doctype html>
<html lang="ja">
<head prefix="og:http://ogp.me/ns#">
  <script src="https://www.googleoptimize.com/optimize.js?id=OPT-T2543CR"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all">
  <meta name="csrf-token" content="dV7NepvA4iVW8XbzH9xIyfsQVTojaCtSj6DvTVyS">
  <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/site-tile-70x70.png">
  <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/site-tile-150x150.png">
  <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/site-tile-310x150.png">
  <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/site-tile-310x310.png">
  <meta name="msapplication-TileColor" content="#0078d7">
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
  <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="36x36" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-36x36.png">
  <link rel="icon" type="image/png" sizes="48x48" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-48x48.png">
  <link rel="icon" type="image/png" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-72x72.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-96x96.png">
  <link rel="icon" type="image/png" sizes="128x128" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-128x128.png">
  <link rel="icon" type="image/png" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-144x144.png">
  <link rel="icon" type="image/png" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-152x152.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="256x256" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-256x256.png">
  <link rel="icon" type="image/png" sizes="384x384" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-384x384.png">
  <link rel="icon" type="image/png" sizes="512x512" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/android-chrome-512x512.png">
  <link rel="icon" type="image/png" sizes="36x36" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-36x36.png">
  <link rel="icon" type="image/png" sizes="48x48" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-48x48.png">
  <link rel="icon" type="image/png" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-72x72.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-96x96.png">
  <link rel="icon" type="image/png" sizes="128x128" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-128x128.png">
  <link rel="icon" type="image/png" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-144x144.png">
  <link rel="icon" type="image/png" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-152x152.png">
  <link rel="icon" type="image/png" sizes="160x160" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-160x160.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-192x192.png">
  <link rel="icon" type="image/png" sizes="196x196" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-196x196.png">
  <link rel="icon" type="image/png" sizes="256x256" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-256x256.png">
  <link rel="icon" type="image/png" sizes="384x384" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-384x384.png">
  <link rel="icon" type="image/png" sizes="512x512" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-512x512.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-16x16.png">
  <link rel="icon" type="image/png" sizes="24x24" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-24x24.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/icon/favicon/icon-32x32.png">
  <link rel="manifest" href="/assets/img/icon/favicon/manifest.json">
  <link rel="canonical" href="<?php echo $url_link; ?>">

  <meta property="og:title" content="<?php echo $site_title; ?>">
  <meta property="og:description" content="<?php echo $description; ?>">
  <meta property="og:url" content="<?php echo $url_link; ?>">
  <meta property="og:image" content="<?php echo $og_image; ?>">
  <meta property="og:type" content="<?php echo $type; ?>">
  <meta property="og:site_name" content="<?php echo $site_name; ?>">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="モリリa1@a141828410">
  <meta name="twitter:title" content="<?php echo $site_title; ?>">
  <meta name="twitter:description" content="<?php echo $description; ?>">
  <meta name="twitter:image" content="<?php echo $og_image; ?>">

  <title><?php echo $site_title; ?></title>
  <meta name="description" content="<?php echo $description; ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/_main.css" media="screen">
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/bootstrap5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/js/vue/vue.min.js"></script>
  <script type="text/javascript" src="/assets/js/vue/axios.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>