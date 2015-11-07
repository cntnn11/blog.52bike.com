<?php $loop = new WP_Query( array( 'post_type' => 'bulletin', 'posts_per_page' => 4 ) ); ?>
<?php if ( $loop->have_posts() ) : ?>
<article class="notice wrapper" >
<div class="bulletin">
<ul>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <li><span class="bulletin-time">[<?php the_time('Y-n-j H:i') ?>]</span><a href="<?php the_permalink(); ?>" title="详细阅读 <?php the_title(); ?>"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 80,"..."); ?></a></li>
<?php endwhile; ?>
</ul>
</div>
<!-- 搜索 -->
<?php include(TEMPLATEPATH . '/includes/search_wp.php'); ?>
<!-- 搜索end -->
</article>
<?php endif; ?>