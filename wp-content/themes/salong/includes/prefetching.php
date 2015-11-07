<!-- HTML5预加载 -->
<?php if (is_archive() && ($paged > 1) && ($paged < $wp_query->max_num_pages)) { ?>
<link rel="prefetch" href="<?php echo get_next_posts_page_link(); ?>">
<link rel="prerender" href="<?php echo get_next_posts_page_link(); ?>">
<?php } elseif (is_singular()) { ?>
<link rel="prefetch" href="<?php bloginfo('home'); ?>">
<link rel="prerender" href="<?php bloginfo('home'); ?>">
<?php } ?>

<!-- 让HTML5支持IE -->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_directory'); ?>/js/html5.js"></script>
<![endif]-->