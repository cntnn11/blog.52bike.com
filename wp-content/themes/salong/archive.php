<?php
/*
*归档
*/ 
get_header(); ?>
<section class="container wrapper">
  <div class="content-wrap left">
  <ul>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <li>
      <!-- 文章 -->
    <article class="post left">
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
        <?php } else{ echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 116,"..."); } ?>
        </div>
        <!-- 摘要end -->
      <!-- 文章信息 -->
      <div class="info">
        <div class="up"> <span class="category">
          <?php the_category(', ') ?>
          </span> <span class="author">
          <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php the_author_nickname(); ?></a>
          </span> <span class="edit">
          <?php edit_post_link('编辑', '  ', '  '); ?>
          </span> </div>
        <div class="down"> <span class="date">
          <?php the_time('Y-m-d') ?>
          </span> <span class="views"> <?php echo getPostViews(get_the_ID()); ?></span> <span class="comment">
          <?php comments_popup_link('0', '1', '%'); ?>
          </span> <a class="read-more right" href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" target="_blank">more</a> </div>
      </div>
      <!-- 文章信息end --> 
    </article>
    <!-- 文章end -->
  </li>
    <?php endwhile; else: ?>
      <p>非常抱歉，没有相关文章。</p>
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
