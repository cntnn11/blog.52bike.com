<?php
/*
*	公告文章页面
*/ 
get_template_part( 'header-bulletin' ); ?>
<section class="container wrapper">
  <div class="content-box left">
    <section class="page-head">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <!-- 页面信息 -->
      <div class="info">
        <span class="category"><i class="icon-category"></i><?php echo get_the_term_list($post-> ID,  'genre', '', ', ', ''); ?></span>
        <span class="date"><i class="icon-date"></i><?php the_time('Y-m-d') ?></span>
        <span class="views"><i class="icon-views"></i><?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?></span>
        <span class="comment"><i class="icon-comment"></i><?php comments_popup_link('0', '1', '%'); ?></span>
        <span class="words"><i class="icon-words"></i> <?php echo count_words ($text); ?></span>
      </div>
      <!-- 页面信息end -->
      <!-- 字体大小切换 -->
      <?php if (get_option('sl_font_change') == 'true') { include(TEMPLATEPATH . '/includes/font_change.php'); } ?>
      <!-- 字体大小切换end -->
    </section>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="entry" id="post-<?php the_ID(); ?>">
      <?php the_content(); ?>
    </article>
    <?php endwhile; endif; ?>
    <?php wp_link_pages( array( 'before' => '<p class="pagination">' . __( '分页:'), 'after' => '</p>' ) ); ?>
      <div class="tags"><?php the_tags('关键字：', ', ', ''); ?></div>
    <!-- 分享按钮 -->
    <?php if (get_option('sl_share') == 'true') { include(TEMPLATEPATH . '/includes/share.php'); } ?>
    <!-- 分享按钮end -->
    <!-- 作者版本 -->
    <?php if (get_option('sl_author_copy') == 'true') { include(TEMPLATEPATH . '/includes/copyright.php'); } ?>
    <!-- 作者版本end -->
    <!-- 它季广告 -->
      <div class="tajiad"><a href="http://taji.me" title="它季|专属民族格调商城！"><img src="http://yfdxs.com/wp-content/uploads/2014/12/tajiad.jpg" alt=""></a></div>
      <!-- 它季广告end -->
    <!-- 上下篇 -->
      <div class="pre-next">
        <div class="left">
          <?php previous_post_link('上一篇：%link') ?>
        </div>
        <div class="right">
          <?php next_post_link('下一篇：%link') ?>
        </div>
      </div>
      <!-- 上下篇end -->
    <!-- 相关文章 -->
    <?php if (get_option('sl_related') == 'true') { include(TEMPLATEPATH . '/includes/related.php'); } ?>
    <!-- 相关文章end -->
    <?php comments_template(); ?>
  </div>
  <!-- 博客边栏 -->
  <?php get_sidebar(); ?>
  <!-- 博客边栏end -->
  <div class="clearfix"></div>
</section>
<?php get_footer(); ?>
