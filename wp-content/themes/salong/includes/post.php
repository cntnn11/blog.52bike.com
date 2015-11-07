<article class="post">
  <div class="post-thumb">
    <?php post_thumbnail(); ?>
  </div>
  <header class="post-head">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="详细阅读 <?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a></h2>
  </header>
  <!-- 摘要 -->
  <div class="excerpt">
    <?php if (has_excerpt()){ ?>
    <?php the_excerpt() ?>
    <?php } else{ echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 116,"..."); }?>
  </div>
  <!-- 摘要end --> 
  <div class="info">
    <div class="up">
    <span><i class="icon-category"></i><?php the_category(', ') ?></span>
    <span><i class="icon-author"></i><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php the_author_nickname(); ?></a></span>
      </div>
    <div class="down">
    <span><i class="icon-date"></i><?php the_time('Y-m-d') ?></span>
    <span><i class="icon-views"></i> <?php echo getPostViews(get_the_ID()); ?></span>
    <span><i class="icon-comment"></i><?php comments_popup_link('0', '1', '%'); ?></span>
    <a class="read-more right" href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" target="_blank">more</a> </div>
  </div>
  <!-- 文章信息end --> 
</article>
