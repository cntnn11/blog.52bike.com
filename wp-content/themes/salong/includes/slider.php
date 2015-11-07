<?php if (have_posts()) : ?>
<section class="slide-main">
  <div class="swiper-home swiper-container wrapper">
    <div class="swiper-wrapper">
      <?php
        $args = array(
          'posts_per_page' => 16,
          'post__in'  => get_option('sticky_posts'),
          'caller_get_posts' => 10
        );
        query_posts($args);
        ?>
      <?php while (have_posts()) : the_post(); ?>
      <article class="swiper-slide slide-single" >
        <div class="swiper-image">
        <a href="<?php if ( get_post_meta($post->ID, 'imgurl', true) ) : ?><?php $imgurl = get_post_meta($post->ID, 'imgurl', true); ?><?php echo $imgurl; ?><?php else: ?><?php the_permalink() ?><?php endif; ?>" rel="bookmark" target="_blank" title="<?php the_title(); ?>">
          <?php if ( get_post_meta($post->ID, 'show', true) ) : ?>
          <?php $image = get_post_meta($post->ID, 'show', true); ?>
          <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
          <?php else: ?>
          <?php if (has_post_thumbnail()) { post_thumbnail(1182,420); } else { ?>
          <img src="<?php echo get_content_first_image(get_the_content()); ?>" alt="<?php the_title(); ?>"/>
          <?php } ?>
          <?php endif; ?>
          </a>
        </div>
        <?php if (get_option('sl_slider_con') == 'true') { ?>
        <div class="swiper-post">
          <h3><a href="<?php if ( get_post_meta($post->ID, 'imgurl', true) ) : ?><?php $imgurl = get_post_meta($post->ID, 'imgurl', true); ?><?php echo $imgurl; ?><?php else: ?><?php the_permalink() ?><?php endif; ?>" rel="bookmark" target="_blank" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a></h3>
          <!-- 摘要 -->
          <div class="excerpt">
            <?php if (has_excerpt()) { ?>
            <?php the_excerpt() ?>
            <?php } else{ echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); } ?>
          </div>
          <!-- 摘要end -->
          <div class="clearfix"></div>
        </div>
        <?php } ?>
      </article>
      <?php endwhile; ?>
    </div>
    <!-- 导航 -->
    <div class="swiper-pagination swiper-home-pagination"></div>
    <!-- 按钮 -->
    <div class="swiper-button swiper-button-next swiper-home-button-next"></div>
    <div class="swiper-button swiper-button-prev swiper-home-button-prev"></div>
  </div>
</section>
<?php endif; ?>
