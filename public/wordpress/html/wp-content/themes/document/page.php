<?php
include(__DIR__."/inc/meta_header.php");
include(__DIR__."/inc/nav.php");
?>

<?php
// get cagetory
$cat = get_the_category();
$cat_link = get_category_link( $cat[0]->term_id );
$real_title = get_the_title();
$title = mb_substr($real_title,0,10).'..,';
?>
<div class="bread-crumb mr50">
  <ul>
    <li><a href="/" class="crumblink">101 home</a></li>
    <li><a href="<?php echo $cat_link; ?>" class="crumblink"><?php echo $cat[0]->name; ?></a></li>
    <li><?php echo $title; ?></li>
  </ul>
</div>

<div class="doc-single container mt100">
  <div class="row">
    <div class="blog-area col-sm-12 col-md-8 col-lg-9">
      <h2 class="blog-title"><?php the_title(); ?></h2>
      <div class="blog-text mt60 mb50">
        <?php the_content(); ?>
        <br clear="both">
        <span class="date"><?php the_time('Y.m.d (D)'); ?></span>
      </div>
      <div class="blog-footer">
          <?php the_category(); ?>
          <?php the_tags('<ul class="tag"><li>', '</li><li>', '</li></ul>'); ?>
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
