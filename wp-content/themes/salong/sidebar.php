<aside class="sidebar right">
		<?php wp_reset_query();if ( is_home()){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页边栏') ) : ?>
		<?php endif; ?>
		<?php } ?>

		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('博客边栏') ) : ?>
		<?php endif; ?>
		<?php } ?>
</aside>