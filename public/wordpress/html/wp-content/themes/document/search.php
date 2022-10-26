<?php
include(__DIR__."/inc/meta_header.php");
include(__DIR__."/inc/nav.php");
?>


<?php
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $word = 'no word';
  } else {
    $word = '“'.$_GET['s'] .'” ('.$wp_query->found_posts.')';
  }
?>
<div class="bread-crumb mr50">
  <ul>
    <li><a href="/" class="crumblink">101 home</a></li>
    <li><a href="#" class="crumblink">search</a></li>
    <li><?php echo $word; ?></li>
  </ul>
</div>


<div class="doc-single wp-archives container mt100">
  <div class="row">
    <div class="blog-archives col-sm-12 col-md-8 col-lg-9">
      <h2 class="blog-title mb30">Search</h2>

      <div class="search-result mb30">
      <?php
        if (isset($_GET['s']) && empty($_GET['s'])) {
          echo '検索ワードはありませんでした。';
        } else {
          $word = '“'.$_GET['s'] .'” ('.$wp_query->found_posts.')';
          echo '“'.$_GET['s'] .'を検索して、”'.$wp_query->found_posts.'件見つかりました。';
        }
      ?>
      </div>

      <div class="wp-loop-def">
        <?php if(have_posts()): ?>
          <ul class="wp-list">
          <?php while(have_posts()): the_post(); ?>
          <li class="wp-item mb20">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('thumbnail', array('class' => 'eyecatch')); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/document/eyecatch-dummy.jpg" class="eyecatch" alt="xxxxx" />
            <?php endif ; ?>
            <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a>
            <div class="summery">
              <?php
                if (!empty(get_the_excerpt())) {
                  $description = get_the_excerpt();
                } else {
                  $description = get_the_content();
                }
                echo mb_substr(strip_tags($description),0,200);
              ?>
            </div>
            <div class="meta-info mt10 ml30">
              <?php the_category(); ?>
              <?php the_tags('<ul class="tag"><li>', '</li><li>', '</li></ul>'); ?>
            </div>
          </li>
          <?php endwhile; ?>
          </ul>
        <?php else: ?>
          <div class="alert alert-secondary mt50" role="alert">
            何もありません。
          </div>
        <?php endif; ?>

        <div class="page-nav mt50">
          <?php the_posts_pagination(
            array(
              'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
              'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
              'prev_text'     => __( '←'), // 「前へ」リンクのテキスト
              'next_text'     => __( '→'), // 「次へ」リンクのテキスト
              'type'          => 'list', // 戻り値の指定 (plain/list)
            )
          ); ?>
        </div>


      </div>

    </div>
    <div class="blog-widget col-sm-12 col-md-4 col-lg-3">
      <div class="search-widget mb30">
        <div class="input-group mb-3">
          <form method="get" action="/">
            <div class="input-group mb-3">
              <input name="s" id="s" type="text" class="form-control" placeholder="search words" aria-describedby="button-addon2">
              <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
          </form>
        </div>
      </div>
      <?php if ( is_active_sidebar('main-sidebar') ) : ?>
        <ul class="menu">
          <?php dynamic_sidebar('main-sidebar'); ?>
        </ul>
			<?php endif; ?>
    </div>
  </div>
</div>

<script>
  $(function(){
    $(window).on('scroll', function(){
      var scrollTop = $(window).scrollTop();
      var bgPosition = scrollTop / 2;
      var bv = bgPosition/20;
      var bpb = bgPosition/5;
      var brt = 100 - (bgPosition/4);
      $('.doc-banner-image').css('top',50+bpb+'%');
      $('.doc-banner-image').css('filter','brightness('+brt+'%)');
      $('.doc-banner-image').css('filter','blur('+bv+'px)');
      $('.doc-banner-image').css('width',100+bv+'%');
    });
  });
</script>

<?php
include(__DIR__."/inc/footer.php");
?>
</body>
</html>
