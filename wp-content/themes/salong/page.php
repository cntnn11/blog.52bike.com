<?php
/*
*Page
*/ 
get_header(); ?>
<section class="container wrapper">
  <div class="content-box left">
    <section class="page-head">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <!-- 页面信息 -->
      <div class="info">
        <span class="date"><i class="icon-date"></i><?php the_time('Y-m-d') ?></span>
        <span class="views"><i class="icon-views"></i><?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?></span>
        <span class="comment"><i class="icon-comment"></i><?php comments_popup_link('0', '1', '%'); ?></span>
        <span class="words"><i class="icon-words"></i> <?php echo count_words ($text); ?></span>
      </div>
      <!-- 页面信息end -->
    </section>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="entry" id="post-<?php the_ID(); ?>">
      <?php the_content(); ?>
    </article>
    <?php 
		endwhile;											
		comments_template();
		endif; 
	?>
  </div>
  <!-- 博客边栏 -->
  <?php get_sidebar(); ?>
  <!-- 博客边栏end -->
  <div class="clearfix"></div>
</section>
<?php get_footer(); ?>
