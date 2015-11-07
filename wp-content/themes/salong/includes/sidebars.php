<?php
function truethemes_widgets_init() {

register_sidebar( array(
'name' => "首页边栏",
'description' => "这个边栏显示在首页",
'before_widget' => '<section class="sidebar-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "博客边栏",
'description' => "这个边栏显示在博客与文章页",
'before_widget' => '<section class="sidebar-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "联系边栏",
'description' => "这个边栏显示在联系页面",
'before_widget' => '<section class="sidebar-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "页脚第一栏",
'description' => "这个边栏显示在页脚第一栏",
'before_widget' => '<section class="footer-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "页脚第二栏",
'description' => "这个边栏显示在页脚第二栏",
'before_widget' => '<section class="footer-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "页脚第三栏",
'description' => "这个边栏显示在页脚第三栏",
'before_widget' => '<section class="footer-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => "页脚第四栏",
'description' => "这个边栏显示在页脚第四栏",
'before_widget' => '<section class="footer-widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

}
add_action( 'widgets_init', 'truethemes_widgets_init' );

?>