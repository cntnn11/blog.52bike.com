<footer class="footer">
  <div class="footer-menu-wrap"> 
    <!-- 页脚菜单 -->
    <nav class="footer-nav wrapper">
      <?php wp_nav_menu( array( 'container_class' => 'footer-menu', 'theme_location' => 'footer-menu' , 'fallback_cb'=>'Salong_footer_fallback') ); ?>
    </nav>
    <!-- 页脚菜单end --> 
  </div>
  <div class="footer-widgets-wrap">
    <aside class="wrapper">
    <div class="footer-widgets left">
      <?php dynamic_sidebar( '页脚第一栏' ); ?>
      </div>
      <div class="footer-widgets left">
      <?php dynamic_sidebar( '页脚第二栏' ); ?>
      </div>
      <div class="footer-widgets left">
      <?php dynamic_sidebar( '页脚第三栏' ); ?>
      </div>
      <div class="footer-widgets widgets-right right">
      <?php dynamic_sidebar( '页脚第四栏' ); ?>
      </div>
    </aside>
  </div>
  <div class="clearfix"></div>
  <div class="footer-bottom-wrap">
    <section class="footer-bottom wrapper">
      <p class="copyright left"><?php echo stripslashes(get_option('sl_copyright_text')); ?></p>
      <div class="footer-icons"> 
        <!-- 社交图标 -->
        <?php include('includes/social.php'); ?>
        <!-- 社交图标end --> 
      </div>
      <p class="theme-author right"><span class="left">Powered by <a href="http://cn.wordpress.org" title="WordPress">WordPress</a> Theme by <a href="http://yfdxs.com" title="远方的雪山">萨龙龙</a></span>&nbsp; <?php global $user_ID; if (!$user_ID) : ?><?php echo stripslashes(get_option('sl_statistics')); ?><?php endif; ?></p>
    </section>
  </div>
</footer>
<!-- 回顶部 -->
<div id="back-to-top"><a href="#" title="返回顶部"><i class="icon-top"></i></a></div>
<script type="text/javascript" src="http://libs.useso.com/js/jquery/2.0.3/jquery.min.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.fs.boxer.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/swiper.jquery.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<?php if ( is_singular() ){ ?>
<!-- Google 网页摘要 -->
<?php
$separator = '&rsaquo;';
$category = get_the_category();
if ($category) {
foreach($category as $category) {
echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:none">';
echo $separator . "<a href=\"".get_category_link($category->term_id)."\" itemprop=\"url\"><span itemprop=\"title\">$category->name</span></a>
";
echo '</div>';
}}
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script> 
<!-- 是否启用多说自定义样式 -->
<?php if (get_option('sl_duoshuo') == 'true') { include(TEMPLATEPATH . '/includes/duoshuo.php'); } ?>
<!-- 是否启用代码高亮 -->
<?php if (get_option('sl_highlight') == 'true') { include(TEMPLATEPATH . '/includes/highlight.php'); } ?>
<?php } ?>
<!-- 图片延迟加载 -->
<?php if (get_option('sl_lazyload') == 'true') { include(TEMPLATEPATH . '/includes/lazyload.php'); } ?>
<?php wp_footer(); ?>
</body></html>