<?php if ( have_posts() ) : ?>
<section class="cms">
<ul>
<?php $display_categories = explode(',', get_option('sl_cate') ); foreach ($display_categories as $category) { ?>
<?php  query_posts( array( 'showposts' => 1, 'cat' => $category, 'post__not_in' => $do_not_duplicate)); ?>
  <?php while (have_posts()) : the_post(); ?>
    <li>
  <article class="cate-post left"> 
  <!-- 分类标题 -->
  <div class="cate-title"><i class="icon-cate"></i><?php the_category(', ') ?></div>
  <!-- 分类标题end -->
    <!-- 第一篇文章 -->
    <div class="post-thumb">
      <?php post_thumbnail(); ?>
    </div>
    <header class="post-head">
      <h2> <a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="详细阅读<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> </h2>
    </header>
         <!-- 摘要 -->
        <div class="excerpt">
        <?php if (has_excerpt()) { ?>
        <?php the_excerpt() ?>
        <?php } else{ echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 116,"..."); } ?>
        </div>
        <!-- 摘要end -->
    <!-- 第一篇文章end -->
    <?php endwhile; ?>
    <!-- 分类文章列表 -->
    <ul class="cate-list">
      <?php query_posts( array( 'showposts' => get_option('sl_catelist'), 'cat' => $category, 'offset' => 1, 'post__not_in' => $do_not_duplicate
						));?>
      <?php while (have_posts()) : the_post(); ?>
      <li>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="详细阅读 <?php the_title(); ?>">
          <?php the_title(); ?>
          </a> </h2>
        <span class="cate-time">
        <?php the_time('Y-m-d') ?>
        </span> </li>
      <?php endwhile; ?>
    </ul>
    <!-- 分类文章列表end --> 
    <!-- 分类目录信息 -->
    <section class="cate-info"> <span class="cate-name"><i class="icon-category"></i>
      <?php the_category(', ') ?>分类下有<?php echo wt_get_category_count(); ?>篇文章</span> <a href="<?php echo get_category_link($category);?>" rel="bookmark" class="read-more right" title="查看更多 <?php single_cat_title(); ?> 的文章">more</a> </section>
    <!-- 分类目录信息end --> 
  </article>
</li>
  <?php } ?>
</ul>
</section>
<?php endif; ?>
