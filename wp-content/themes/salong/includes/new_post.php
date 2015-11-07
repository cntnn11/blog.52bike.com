<section class="new-post">
<ul>
<?php $scrollcount = get_option('sl_new_post');?>
<?php query_posts('&showposts='.$scrollcount.'&caller_get_posts=10.&cat='.get_option('sl_new_exclude')); while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>
<li>
<?php include(TEMPLATEPATH .'/includes/post.php'); ?>
</li>
<?php endwhile; ?>
</ul>
</section>
