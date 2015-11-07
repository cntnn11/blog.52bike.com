<?php get_header(); ?>
<!-- 网站主体 -->
<section class="container wrapper">
	<!-- 最新文章与文章列表 -->
	<div class="content-wrap left">
		<!-- 最新文章 -->
		<?php include('includes/new_post.php'); ?>
		<!-- 最新文章end -->
		<!-- 文章列表 -->
		<?php include('includes/cms.php'); ?>
		<!-- 文章列表end -->
	</div>
	<!-- 最新文章与文章列表end -->
	<!-- 首页边栏 -->
		<?php get_sidebar(); ?>
	<!-- 首页边栏end -->
</section>
<div class="clearfix"></div>
<!-- 网站主体end -->
<?php get_footer(); ?>