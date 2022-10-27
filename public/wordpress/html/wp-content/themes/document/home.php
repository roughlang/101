<?php
include(__DIR__."/inc/meta_header.php");
include(__DIR__."/inc/nav.php");
?>

<div id="doc-banner" class="doc-banner bg-light">
  <img id="doc-banner-image" class="doc-banner-image bnr-xs" src="<?php echo get_template_directory_uri(); ?>/assets/img/document/doc-banner_xs_01.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
  <img id="doc-banner-image" class="doc-banner-image bnr-sm" src="<?php echo get_template_directory_uri(); ?>/assets/img/document/doc-banner_sm_01.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
  <img id="doc-banner-image" class="doc-banner-image bnr-md" src="<?php echo get_template_directory_uri(); ?>/assets/img/document/doc-banner_md_01.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
  <img id="doc-banner-image" class="doc-banner-image bnr-lg" src="<?php echo get_template_directory_uri(); ?>/assets/img/document/doc-banner_lg_01.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
  <div class="doc-banner-text">
    <h3 class="doc-banner-title">101</h3>
    <h3 class="doc-banner-subtitle">Section28</h3>
    <div class="commerce">
    I do not think. I just organize the information.
    </div>
  </div>
</div>

<div class="doc-container container mt100">
  <div class="row">
    <div class="middle-banner col-md-6">
      <div id="twitter_rss" class="tw mb20">
        <?php
        /**
         * RSS: https://nitter.net/a141828410/rss
         * in case of skip
         * - $data->title[0] = 空の場合
         * - $data->pubDate[0] = 空の場合
         * - $data->title[0] = 'image'
         * - $data->title[0] = 'モリリa1 / @a141828410'
         * 最初の６ループはmeta情報なので無視してもよい。
         */
        $tw_list = [];
        $tweet = simplexml_load_file('https://nitter.net/a141828410/rss');
        // var_dump($tweet->channel[0]);
        foreach($tweet->channel[0] as $data){
          // var_dump($data->title[0]);
          if (
            empty($data->title[0]) ||
            $data->title[0] == 'モリリa1 / @a141828410' ||
            $data->title[0] == 'Image'
          ) {
            // skip
          } else {
            // echo $data->title[0]."<br>\n";
            // $date = $data->pubDate[0];
            // echo date('Y年m月d日',$date).'<br>';
            // echo 'date: '.$data->pubDate[0]."<br>\n";
            $tw_list[] = [$data->title[0]];
          }
        }
        // var_dump($tw_list[0]);
        ?>
        <a href="https://twitter.com/a141828410" target="_blank" rel="noopener noreferrer">
          <img class="tw-icon" src="/assets/img/twitter-icon.png" alt="twitter">
        </a>
        <span class="latest-twitter"><?php echo $tw_list[0][0]; ?></span>
      </div>
      <script>
        const twitter_rss = new Vue({
          el: "#twitter_rss",
          data: {
            sample: 'foobar',
          },
        })
      </script>
      <div class="tag-cloud mb20">
        <?php wp_tag_cloud(); ?>
      </div>

      <a href="#" target="_blank">
        <img class="middle-banner-image" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/middle-banner-image_05.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
      </a>
    </div>
    <div class="middle-banner col-md-6">
      <a href="#" target="_blank">
        <h3 class="middle-title">Update</h3>
        <ul class="doc-list mt30">

        <?php if(have_posts()): ?>
					<?php while(have_posts()): the_post(); ?>
          <li class="item">
            <a href="<?php the_permalink(); ?>">

            <div class="container">
              <div class="row">

                <div class="col-12 item">
                  
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('thumbnail', array('class' => 'eyecatch')); ?>
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/document/eyecatch-dummy.jpg" class="eyecatch" alt="xxxxx" />
                  <?php endif ; ?>
                  <?php the_title(); ?>
                </div>

              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-xs-11 col-sm-10 col-lg-11 description">
                  <?php
                  if (!empty(get_the_excerpt())) {
                    $description = get_the_excerpt();
                  } else {
                    $description = get_the_content();
                  }
                  echo mb_substr(strip_tags($description),0,200);
                  ?>
                  <span class="date"><?php the_time('Y.m.d'); ?></span>
                </div>
              </div>
            </div>

            </a>
            <div class="meta-info">
              <?php the_category(); ?>
              <?php the_tags('<ul class="tag"><li>', '</li><li>', '</li></ul>'); ?>
            </div>
          </li>
          <?php endwhile; ?>
          <?php else: ?>
            <!-- 投稿データが取得できない場合の処理 -->
          <?php endif; ?>
        </ul>
      </a>
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
      // console.log(bpb);
      // console.log(scrollTop);
      // console.log(brt);
      // console.log(bv);
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