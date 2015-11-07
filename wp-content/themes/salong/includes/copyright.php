<aside class="post-copyright">
      <div class="post-copy left">
  <?php   $custom_fields = get_post_custom_keys($post_id);
if (!in_array ('copyright', $custom_fields)) : ?>
  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 为 <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php the_author_nickname(); ?></a> 原创，于 <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')). '前'; ?> 发表在
    <?php the_category(', ') ?>
    分类下。
    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {?>
    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { ?>
    <?php } ?>
    <br/>
    欢迎转载，并保留本文有效链接： <a href="<?php the_permalink() ?>
          " rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a>
  <?php else: ?>
  <?php  $custom = get_post_custom($post_id);
$custom_value = $custom['copyright']; ?>
  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 来源： <a target="_blank" rel="nofollow" > <?php echo $custom_value[0] ?></a> ，由 <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php the_author_nickname(); ?></a> 整理编辑，于 <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?> 发表在 <?php the_category(', ') ?> 分类下。
    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {?>
    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { ?>
    <?php } ?>
    <br/>
    链接地址： <a href="<?php the_permalink() ?> " rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a>, 转载请保留本说明及本文有效链接！
  <?php endif; ?>
  </div>
</aside>
