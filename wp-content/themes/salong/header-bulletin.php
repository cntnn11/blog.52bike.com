<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="author" content="萨龙龙">
<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, user-scalable=no"/>
<!-- 网站SEO -->
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?><?php if ( is_home() ) { ?> | <?php bloginfo('description'); ?><?php } ?></title>
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/boxer/jquery.fs.boxer.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/includes/shortcodes/css/shortcodes.css" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 10]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie9-and-down.css"/> 
<![endif]-->
<!-- HTML5预加载 -->
<?php include('includes/prefetching.php'); ?>
<!-- 图标 -->
<?php $favicon = get_option('sl_favicon');
if( !empty($favicon) ) { ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php } ?>
<!-- 图标end -->
<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
<!-- 头部黑底部分 -->
<div class="header-wrap">
<!-- 头部 -->
<header class="header">
<div class="wrapper header-main">
  <!-- 网站Logo --> 
  <h1><a class="logo left" href="<?php echo home_url(); ?>"  title="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>">
  <?php if(get_option('sl_logo')){?>
  <img src="<?php echo get_option('sl_logo'); ?>" alt="<?php  bloginfo( 'name' ); ?>">
  <?php }else{?>
  <?php bloginfo('name'); ?>
  <?php }?>
  </a></h1>
  <!-- 网站Logo end --> 
  <!-- 导航菜单 -->
  <nav class="header-nav right">
    <?php wp_nav_menu( array( 'container_class' => 'header-menu', 'theme_location' => 'header-menu' , 'fallback_cb'=>'Salong_header_fallback') ); ?>
  </nav>
  <!-- 导航菜单end --> 
  </div>
</header>
<div class="clearfix"></div>
<!-- 头部end -->
<?php wp_reset_query();if ( is_home()){ ?>
<!-- 幻灯片 -->
<?php include('includes/slider.php'); ?>
<!-- 公告栏与搜索 -->
<?php include('includes/bulletin.php'); ?>
<?php } ?>
<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
<!-- 面包屑与搜索 -->
<div class="slide-shadow"></div>
<div class="crumbs-wrap">
  <article class="crumbs-search wrapper" > 
    <!-- 面包屑 -->
    <div class="crumbs left">当前位置 - <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> - <?php echo get_the_term_list($post->
      ID,  'genre', '', ', ', ''); ?> - <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?>
      </a></div>
    <!-- 面包屑end -->
    <!-- 搜索 -->
      <?php include(TEMPLATEPATH . '/includes/search_wp.php'); ?>
    <!-- 搜索end -->
  </article>
</div>
<!-- 面包屑与搜索end -->
<?php } ?>
</div>
<!-- 头部黑底部分end -->
