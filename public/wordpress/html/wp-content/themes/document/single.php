<?php
include(__DIR__."/inc/meta_header.php");
include(__DIR__."/inc/nav.php");
?>



<div class="doc-single container mt100">
  <div class="row">
    <div class="blog-area col-sm-12 col-md-8 col-lg-9">
      <h2 class="blog-title"><?php the_title(); ?></h2>
      <div class="blog-text mt60 mb50">
        <?php the_content(); ?>
        <span class="date"><?php the_time('Y.m.d (D)'); ?></span>
      </div>
      <div class="blog-footer">
          <?php the_category(); ?>
          <?php the_tags('<ul class="tag"><li>', '</li><li>', '</li></ul>'); ?>
        </div>
    </div>
    <div class="blog-widget col-sm-12 col-md-4 col-lg-3">
      <?php if ( is_active_sidebar('main-sidebar') ) : ?>
        <ul class="menu">
          <?php dynamic_sidebar('main-sidebar'); ?>
        </ul>
			<?php endif; ?>
    </div>
  </div>
</div>

<div class="doc-container container mt100">
  <div class="row">
    <div class="middle-banner col-md-6">
      <a href="#" target="_blank">
        <img class="middle-banner-image" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/middle-banner-image_05.jpg" alt="78c925a3a4b36984d1bcbbb01457eec6">
      </a>
    </div>
    <div class="middle-banner col-md-6">
      <a href="#" target="_blank">
        <h3 class="middle-title">Update</h3>
        <ul class="doc-list mt30">

        <!-- <?php if(have_posts()): ?>
					<?php while(have_posts()): the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail', array('class' => 'eyecatch')); ?>
              <?php else : ?>
                <img src="/assets/img/document/eyecatch-dummy.jpg" class="eyecatch" alt="xxxxx" />
              <?php endif ; ?>
              
              <?php the_title(); ?>
              <span class="date"><?php the_time('Y.m.d'); ?></span>
            </a>
            <?php the_category(); ?>
            <?php the_tags('<ul class="tag"><li>', '</li><li>', '</li></ul>'); ?>
          </li>
          <?php endwhile; ?>
          <?php else: ?>
            <!-- 投稿データが取得できない場合の処理 -->
          <?php endif; ?> -->
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
