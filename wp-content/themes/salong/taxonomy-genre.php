<?php
/*
*分类目录
*/ 
get_header(); ?>
<section class="container wrapper">
  <div class="content-wrap left">
  <ul>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <li>
      <!-- 文章 -->
    <?php include(TEMPLATEPATH .'/includes/post-bulletin.php'); ?>
    <!-- 文章end -->
  </li>
    <?php endwhile;endif; ?>
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
