<?php
/*
*	搜索页面
*/ 
get_header(); ?>
<section class="container wrapper">
  <div class="content-wrap left">
  <ul>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <li>
      <!-- 文章 -->
    <?php include(TEMPLATEPATH .'/includes/post.php'); ?>
    <!-- 文章end -->
  </li>
    <?php endwhile; else: ?>
      <p>非常抱歉，没有找到相关内容。</p>
      <?php endif; ?>
  </ul>
    <!-- 分页 -->
    <?php pagination($query_string); ?>
    <!-- 分页end --> 
  </div>
  <!-- 博客边栏 -->
  <?php get_sidebar(); ?>
  <!-- 博客边栏end --> 
</section>
<div class="clearfix"></div>
<?php get_footer(); ?>
