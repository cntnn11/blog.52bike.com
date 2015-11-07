<!-- 相关文章 -->

<article class="same_cat_posts">
  <h3><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
    <?php the_author_nickname(); ?>
    </a>推荐阅读：</h3>
  <ul>
  <?php if(get_option('sl_ad2_img')){?>
  <li>
<a title="<?php echo get_option('sl_ad2_title'); ?>" target="_blank" href="<?php echo get_option('sl_ad2_link'); ?>">
<img alt="<?php echo get_option('sl_ad2_title'); ?>" data-original="<?php echo get_option('sl_ad2_img'); ?>" src="<?php bloginfo('template_url'); ?>/includes/functions/timthumb.php?src=<?php echo get_option('sl_thumb_loading'); ?>&h=225&w=400&zc=1">
</a>
<a title="<?php echo get_option('sl_ad2_title'); ?>" target="_blank" href="<?php echo get_option('sl_ad2_link'); ?>"><?php echo get_option('sl_ad2_title'); ?></a>
</li>
<?php }?>
    <?php
                 foreach(get_the_category() as $category){$cat = $category-> cat_ID;}
             query_posts('cat=' . $cat . '&orderby=rand&showposts='.stripslashes(get_option('sl_related_count')).'');  //控制相关文章排序为随机，显示5篇相关文章
             while (have_posts()) : the_post();
             $imgContent = $post->post_content;
         ?>
    <li><?php post_thumbnail(); ?><a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </li>
    <?php endwhile; wp_reset_query(); ?>
  </ul>
  <div class="clearfix"></div>
</article>
<!-- 相关文章end --> 
