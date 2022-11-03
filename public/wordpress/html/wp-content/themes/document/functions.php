<?php
/**
 * アイキャッチ
 */
function twpp_setup_theme() {
  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'twpp_setup_theme' );

/**
 * 投稿画像のimgタグのカスタマイズ
 */
// function img_norightclick($html, $id, $alt, $title, $align, $size) {
// 	return str_replace('/>','oncontextmenu="alert(\'保存できません\');return false; />',$html);
// }
// add_filter('get_image_tag','img_norightclick', 10, 6);

function add_image_class( $classes ) {
 return $classes . ' insert-image'; //クラス名「insert-image」を追加する
}
add_filter('get_image_tag_class', 'add_image_class');


// function.php
add_filter('edit_post_link', 'my_post_link');
function my_post_link($output) {
    return str_replace('<a ', '<a target="_blank" class="btn btn-warning mt10" ', $output);
}

/**
 * 
 */
function sidebar_widgets_init() {
  register_sidebar( array(
    'name' => 'Main Sidebar',
    'id' => 'main-sidebar',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

/**
 * 投稿記事の画像を取得
 */
function post_images() {
  global $post, $posts;
  ob_start();
  ob_end_clean();
  preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  return $matches[1];
}

/**
 * Wordpress rest api
 * 
 * + add icatch url
 * - delete revisions
 */

/**
 * "date_format": "2022年01月10日 (月) 16:05",
 */
add_action( 'rest_api_init', 'api_add_date_format_fields' );
function api_add_date_format_fields() {
  register_rest_field( 'post',
    'date_format',
     array(
      'get_callback'    => 'get_date_format',
      'update_callback' => null,
      'schema'          => null,
    )
  );
}
function get_date_format( $post, $name ) {
	/* */
  get_the_modified_date('Y年m月d日 H時i分s秒');
  return get_the_modified_date('Y年m月d日 (D) H:i');
}

/* add icatch url */
add_action( 'rest_api_init', 'api_add_fields' );
function api_add_fields() {
  register_rest_field( 'post',
    'thumbnail_url',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );
}
function register_fields( $post, $name ) {
	/* icatch size [thumbnail | full | medium | large] */
  return get_the_post_thumbnail_url($post['id'], 'full');
}

/**
 * add category name
 */
add_action( 'rest_api_init', 'register_rest_category_name'); 

if ( ! function_exists( 'register_rest_category_name' )) {
  function register_rest_category_name() {
    register_rest_field( 'post', 'category_info',
    array(
      'get_callback' => 'get_category_name'
    ));
  }
  function get_category_name( $object ) {
    $categories = [];
    $categories = get_the_category($object[ 'id' ]);
    return $categories;
  }
}

/**
 * add tag name
 */
add_action( 'rest_api_init', 'register_rest_tag_name'); 
if ( ! function_exists( 'register_rest_tag_name' )) {
  function register_rest_tag_name() {
    register_rest_field( 'post', 'tag_info',
    array(
      'get_callback' => 'get_tag_name'
    ));
  }
  function get_tag_name( $object ) {
    $tags =[];
    $tags = get_the_tags($object[ 'id' ]);
    return $tags;
  }
}

/**
 * Debug log
 */
if(!function_exists('_log')){
  function _log($message) {
    if (WP_DEBUG === true) {
      if (is_array($message) || is_object($message)) {
        error_log(print_r($message, true));
      } else {
        error_log($message);
      }
    }
  }
}

// function wps_highlight_results($text) {
//   if(is_search()){
//   $sr = get_query_var('s');
//   $keys = explode(" ",$sr);
//   $text = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search-highlight">'.$sr.'</span>', $text);
//   }
//   return $text;
// }
// add_filter('the_title', 'wps_highlight_results');
// add_filter('the_content', 'wps_highlight_results');



/**
 * Custom type 
 */
add_action( 'init', 'create_post_type' );

function create_post_type() {

  register_post_type(
    'news',
    array(
      'label' => 'ニュース',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 5,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
    )
  );
  register_taxonomy(
    'news-cat',
    'news',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );

  register_taxonomy(
    'news-tag',
    'news',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}

/**
 * Laravel login to Wordpress
 */
// add_filter('wp', 'laravel_login');

// function laravel_login() {

//   global $wp;

//   # access tokenの取得

//   $token = @htmlentities($_GET['token'], ENT_QUOTES);

//     if (!empty($token)) {
//       // var_dump($token);
//       try {
//         $pdo = new PDO(
//           LARAVEL_DB_TYPE . ':' .
//           'host=' . LARAVEL_DB_HOST . ';' .
//           'port=' . LARAVEL_DB_PORT . ';' .
//           'dbname=' . LARAVEL_DB_DATABASE . ';' .
//           'charset=utf8mb4', // DSN
//           LARAVEL_DB_USERNAME,
//           LARAVEL_DB_PASSWORD
//         );
//       } catch (Exception $e) {
//         throw new Exception('Failed to connect to database.');
//       }
//       // var_dump($pdo);
//       $sql = $pdo->prepare(
//         'SELECT 
//           id,
//           user_code,
//           name,
//           email,
//           status,
//           login_token,
//           member_class,
//           user_icon,
//           created_at, updated_at FROM ' . LARAVEL_DB_USER_TABLE . ' WHERE login_token=:token'
//       );
//       $sql->bindParam(':token', $token);
//       $sql->execute();
//       $laravel_user = $sql->fetch();

//       if (!empty($laravel_user)) {
//         // var_dump($laravel_user['user_code']);

//         // wordpress user登録の準備
//         $laravel_name = $laravel_user['name'];
//         $laravel_email = $laravel_user['email'];
//         $password = md5(uniqid(rand(), 1));

//         $user_id = null;
//         $wp_user = get_user_by('email', $laravel_email);
         
//         if (!$wp_user) { // ユーザー登録

//           $user_id = wp_insert_user([
//             'user_login' => md5(uniqid(rand(), 1)),
//             'user_pass' => $password,
//             'user_email' => $laravel_email,
//             'display_name' => $laravel_name,
//             'role' => 'author'
//           ]);

//         } else { // ユーザー更新
//           $user_id = $wp_user->ID;
//           wp_update_user([
//             'ID' => $user_id,
//             'user_pass' => $password,
//             'user_email' => $laravel_email,
//             'display_name' => $laravel_name
//           ]);

//         }
//         // ユーザーIDを使ってログイン
//         /*
        
//         */
//         // if (is_user_logged_in()) {
//         //   echo "under login.";
//         // }
        
//         /**
//          * ログイン
//          * - トークンがなくても、すでにログインしている場合は、ログインを維持する
//          * - 指定Emailのユーザーは除外
//          */
//         $ex_email_user = [
//           'roughlangx@gmail.com',
//         ];
//         // foreach($ex_email_user as $e) {
//         //   if
//         //   var_dump($e);
//         // }
//         // var_dump($laravel_email);
//         $s_r = array_search($laravel_email, $ex_email_user);
//         if ($s_r !== false) {
//           wp_set_current_user($user_id);
//           wp_set_auth_cookie($user_id);
//         }


//       } else {
//         wp_redirect('https://section28.roughlang.com/login');
//         exit();
//       }



//     }
    
//     // else {
//     //   // tokenがない場合
//     //   if (is_user_logged_in()) {
//     //     // var_dump("logined...");
//     //     // Laravel側でログアウトしていないかいちいち確認
//     //     $user = wp_get_current_user();
//     //     var_dump($user->user_email);
//     //     try {
//     //       $pdo = new PDO(
//     //         LARAVEL_DB_TYPE . ':' .
//     //         'host=' . LARAVEL_DB_HOST . ';' .
//     //         'port=' . LARAVEL_DB_PORT . ';' .
//     //         'dbname=' . LARAVEL_DB_DATABASE . ';' .
//     //         'charset=utf8mb4', // DSN
//     //         LARAVEL_DB_USERNAME,
//     //         LARAVEL_DB_PASSWORD
//     //       );
//     //     } catch (Exception $e) {
//     //       throw new Exception('Failed to connect to database.');
//     //     }
//     //     // var_dump($pdo);
//     //     $sql = $pdo->prepare(
//     //       'SELECT 
//     //         id,
//     //         user_code,
//     //         name,
//     //         email,
//     //         status,
//     //         login_token,
//     //         member_class,
//     //         user_icon,
//     //         created_at, updated_at FROM ' . LARAVEL_DB_USER_TABLE . ' WHERE email=:email'
//     //     );
//     //     $sql->bindParam(':email', $user->user_email);
//     //     $sql->execute();
//     //     $laravel_user = $sql->fetch();
//     //     // var_dump($laravel_user->login_token);
//     //     if ($laravel_user->login_token == NULL) {
//     //       wp_logout();
//     //     }


//     //   } else {
//     //     wp_logout();
//     //     $redirect_url = @htmlentities($_GET['redirect_url'], ENT_QUOTES);
//     //     if (!empty($redirect_url)) {
//     //       wp_redirect( $redirect_url, '302' );
//     //     } else {
//     //       wp_logout();
//     //       // wp_redirect( '/ac/', '302' );
//     //     }
//     //   }     
//     // }


//   return 1;
// }

/**
 * icon
 */
function get_user_icon(string $user_email) {
  try {
    $pdo = new PDO(
      LARAVEL_DB_TYPE . ':' .
      'host=' . LARAVEL_DB_HOST . ';' .
      'port=' . LARAVEL_DB_PORT . ';' .
      'dbname=' . LARAVEL_DB_DATABASE . ';' .
      'charset=utf8mb4',
      LARAVEL_DB_USERNAME,
      LARAVEL_DB_PASSWORD
    );
  } catch (Exception $e) {
    throw new Exception('Failed to connect to database.');
  }
  $sql = $pdo->prepare(
    'SELECT 
      id,
      user_code,
      name,
      email,
      status,
      login_token,
      member_class,
      user_icon,
      created_at, updated_at FROM ' . LARAVEL_DB_USER_TABLE . ' WHERE email=:email'
  );
  $sql->bindParam(':email', $user_email);
      $sql->execute();
      $laravel_user = $sql->fetch();
      // var_dump($laravel_user['user_icon']);
  return $laravel_user['user_icon'];
}
