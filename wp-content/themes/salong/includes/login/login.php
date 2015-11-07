<?php
// 远方的雪山自定义后台登录界面

//向body中添加一些标签，方便设置页面
function custom_login() {   
echo '<!-- 网站Logo -->
    <div class="logo-main">
      <a class="logo" href="'. get_home_url() .'" title="'. get_bloginfo('name') .' | '. get_bloginfo('description') .'">'. get_bloginfo('name') .'</a>
    </div>
    <!-- 网站Logo end --> '; }   
add_action('login_body_class', 'custom_login');
//引入自定义的css文件，自定义的css样式优先于wp样式
function fixed_login() {   
echo '<link rel="stylesheet" tyssspe="text/css" href="' . get_bloginfo('template_directory') . '/includes/login/login.css" />'; }   
add_action('login_head', 'fixed_login'); 
?>