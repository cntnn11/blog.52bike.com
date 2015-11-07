<?php
add_action('init','of_options');

if (!function_exists('of_options')) 
{
function of_options()
{
/*
*	Theme Shortname
*/
$themename = "salong";
$shortname = "sl";
/*
*	Populate the options array
*/
global $tt_options;
$tt_options = get_option('of_options');
/*
*	Access the WordPress Pages via an Array
*/
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) 
{
$tt_pages[$tt_page->
ID] = $tt_page->post_name; 
}
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:" ); 
/*
*	Access the WordPress Categories via an Array
*/
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) 
{
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;
}
$categories_tmp = array_unshift($tt_categories, "Select a category:");
/*
*	Sample Array for demo purposes
*/
$sample_array = array("1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20");
/*
*	Sample Advanced Array - The actual value differs from what the user sees
*/
$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 
/*
*	Folder Paths for "type" => "images"
*/
$sampleurl =  get_template_directory_uri() . '/admin/images/sample-layouts/';
/*-----------------------------------------------------------------------------------*/
/* 创建自定义主题控制面板
/*-----------------------------------------------------------------------------------*/
$options = array();



/* 常规 */
$options[] = array( "name" => "常规",
"type" => "heading");

$options[] = array( "name" => "Logo",
"desc" => "更新网站Logo，没有LOGO将显示网站标题",
"id" => $shortname."_logo",
"std" => get_stylesheet_directory_uri()."/images/logo.png",
"type" => "upload");

$options[] = array( "name" => "Favicon",
"desc" => "为网站添加标签上的图标，建议大小为：16px*16px",
"id" => $shortname."_favicon",
"std" => get_stylesheet_directory_uri()."/images/favicon.png",
"type" => "upload");

$options[] = array( "name" => "是否启用图片延迟加载",
"desc" => "默认不显示",
"id" => $shortname."_lazyload",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "延迟加载缩略图默认图片",
"desc" => "更新延迟加载缩略图默认图片",
"id" => $shortname."_thumb_loading",
"std" => get_stylesheet_directory_uri()."/images/thumb_loading.jpg",
"type" => "upload");

$options[] = array( "name" => "延迟加载文章中默认图片",
"desc" => "更新延迟加载文章中默认图片",
"id" => $shortname."_post_loading",
"std" => get_stylesheet_directory_uri()."/images/post_loading.gif",
"type" => "upload");

$options[] = array( "name" => "是否启用自定义登录地址",
"desc" => "默认不启用，链接地址默认为：http://yourdomain.com/wp-login.php?word=press，域名已经自动获取站点域名，需要修改“word”和“press”两个值，修改后要牢记了",
"id" => $shortname."_admin_login",
"std" => "false",
"type" => "checkbox");
    
$options[] = array( "name" => "第一个值",
"desc" => "重新设置“word”值",
"id" => $shortname."_admin_word",
"std" => "word",
"type" => "text");

$options[] = array( "name" => "第二个值",
"desc" => "重新设置“press”值",
"id" => $shortname."_admin_press",
"std" => "press",
"type" => "text");

$options[] = array( "name" => "是否启用网站维护功能",
"desc" => "默认不启用",
"id" => $shortname."_weihu",
"std" => "false",
"type" => "checkbox");

/* 首页 */

$options[] = array( "name" => "首页",
"type" => "heading");

$options[] = array( "name" => "是否幻灯片内容",
"desc" => "默认启用",
"id" => $shortname."_slider_con",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "显示最新文章的数量",
"desc" => "默认显示1篇",
"id" => $shortname."_new_post",
"std" => "6",
"type" => "select",
"options" => $sample_array);

$options[] = array( "name" => "输入最新文章中排除的分类ID",
"desc" => "比如：-1,-2,-3多个ID用英文逗号隔开",
"id" => $shortname."_new_exclude",
"std" => "",
"type" => "text");

$options[] = array( "name" => "首页分类列表ID设置",
"desc" => "输入分类ID,显示更多分类，请用英文逗号＂,＂隔开",
"id" => $shortname."_cate",
"std" => "1,2,3,4",
"type" => "text");

$options[] = array( "name" => "分类列表显示的数量",
"desc" => "默认显示6篇",
"id" => $shortname."_catelist",
"std" => "6",
"type" => "select",
"options" => $sample_array);

/* SEO */

$options[] = array( "name" => "SEO",
"type" => "heading");

$options[] = array( "name" => "博客描述",
"desc" => "输入博客的一个简单描述性文字",
"id" => $shortname."_description",
"std" => "",
"type" => "textarea");

$options[] = array( "name" => "博客关键字",
"desc" => "输入博客的关键字",
"id" => $shortname."_keywords",
"std" => "",
"type" => "textarea");

/* 博客 */
$options[] = array( "name" => "博客",
"type" => "heading");

$options[] = array( "name" => "是否启用代码高亮",
"desc" => "默认不显示",
"id" => $shortname."_highlight",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "是否启用自定义多说样式",
"desc" => "默认不显示",
"id" => $shortname."_duoshuo",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "是否显示文章分享按钮",
"desc" => "默认不显示",
"id" => $shortname."_share",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "是否显示相关文章",
"desc" => "默认不显示",
"id" => $shortname."_related",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "相关文章显示数量",
"desc" => "默认显示4篇",
"id" => $shortname."_related_count",
"std" => "4",
"type" => "select",
"options" => $sample_array);

$options[] = array( "name" => "是否显示作者版本",
"desc" => "默认不显示",
"id" => $shortname."_author_copy",
"std" => "true",
"type" => "checkbox");

$options[] = array( "name" => "是否显示字体大小切换按钮",
"desc" => "默认不显示",
"id" => $shortname."_font_change",
"std" => "true",
"type" => "checkbox");

/* 社交图标*/
$options[] = array( "name" => "社交",
"type" => "heading");

$options[] = array( "name" => "关注我简介",
"desc" => "小工具中的简介",
"id" => $shortname."_follow_text",
"std" => "一个平平常常的人！",
"type" => "textarea");

$options[] = array( "name" => "微信图片说明",
"desc" => "关注我小工具中的微信弹出说明",
"id" => $shortname."_follow_weixin",
"std" => "请扫描微信二维码<br>或搜索\"salonglong_com\"添加关注",
"type" => "textarea");

$options[] = array( "name" => "它季",
"desc" => "它季链接地址",
"id" => $shortname."_taji_link",
"std" => "http://taji.me",
"type" => "text");

$options[] = array( "name" => "淘宝",
"desc" => "淘宝链接地址",
"id" => $shortname."_taobao_link",
"std" => "http://tajime.taobao.com",
"type" => "text");

$options[] = array( "name" => "Facebook",
"desc" => "Facebook链接地址",
"id" => $shortname."_facebook_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "Twitter",
"desc" => "Twitter链接地址",
"id" => $shortname."_twitter_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "新浪微博",
"desc" => "新浪微博链接地址",
"id" => $shortname."_sina_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "腾讯微博",
"desc" => "腾讯微博链接地址",
"id" => $shortname."_qq_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "人人网",
"desc" => "人人网链接地址",
"id" => $shortname."_renren_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "RSS",
"desc" => "RSS链接地址",
"id" => $shortname."_rss_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "微信",
"desc" => "微信图片链接地址",
"id" => $shortname."_weixin",
"std" => "",
"type" => "upload");

/************************* 投稿设置 *************************/

$options[] = array( "name" => "投稿",
"type" => "heading");

$options[] = array( "name" => "投稿页面链接",
"desc" => "输入投稿页面链接",
"id" => $shortname."_contribute_page_link",
"std" => "",
"type" => "text");

$options[] = array( "name" => "投稿提醒邮箱",
"desc" => "输入投稿提醒邮箱",
"id" => $shortname."_contribute_email",
"std" => "",
"type" => "text");

$options[] = array( "name" => "投稿间隔时间",
"desc" => "输入投稿间隔时间，单位为秒，默认为120秒",
"id" => $shortname."_contribute_interval_time",
"std" => "120",
"type" => "text");

$options[] = array( "name" => "投稿最多内容限制",
"desc" => "输入投稿最多内容限制，单位为字，默认为3000字",
"id" => $shortname."_contribute_content_min",
"std" => "100",
"type" => "text");

$options[] = array( "name" => "投稿最少内容限制",
"desc" => "输入投稿最少内容限制，单位为字，默认为100字",
"id" => $shortname."_contribute_content_max",
"std" => "3000",
"type" => "text");

$options[] = array( "name" => "投稿Kindeditor编辑器",
"desc" => "投稿页面中Kindeditor编辑器样式，到Kindeditor官网下载，examples文件夹中有很多样式，把HTML文件里面script标签中的js代码粘贴到下面，把js中“K.create”后面的ID（单引号中的）改为“#tougao_content”，留空，则不使用Kindeditor编辑器",
"id" => $shortname."_Kindeditor",
"std" => "",
"type" => "textarea");

/*******************广告*******************/
$options[] = array( "name" => "广告",
"type" => "heading");

$options[] = array( "name" => "作者版权下的广告图片",
"desc" => "作者版权下的广告图片",
"id" => $shortname."_ad1_img",
"std" => get_stylesheet_directory_uri()."/images/tajiad.jpg",
"type" => "upload");

$options[] = array( "name" => "作者版权下的广告链接",
"desc" => "作者版权下的广告链接",
"id" => $shortname."_ad1_link",
"std" => "http://taji.me",
"type" => "text");

$options[] = array( "name" => "作者版权下的广告标题",
"desc" => "作者版权下的广告标题",
"id" => $shortname."_ad1_title",
"std" => "它季|专属民族格调商城！",
"type" => "text");

$options[] = array( "name" => "相关文章中的广告图片",
"desc" => "作者版权下的广告图片",
"id" => $shortname."_ad2_img",
"std" => get_stylesheet_directory_uri()."/images/taji-related.jpg",
"type" => "upload");

$options[] = array( "name" => "相关文章中的广告链接",
"desc" => "作者版权下的广告链接",
"id" => $shortname."_ad2_link",
"std" => "http://taji.me",
"type" => "text");

$options[] = array( "name" => "相关文章中的广告标题",
"desc" => "作者版权下的广告标题",
"id" => $shortname."_ad2_title",
"std" => "它季|专属民族格调商城！",
"type" => "text");

/*******************页脚*******************/
$options[] = array( "name" => "页脚",
"type" => "heading");

$options[] = array( "name" => "页脚版本文本",
"desc" => "添加网站页脚版本信息",
"id" => $shortname."_copyright_text",
"std" => "Copyright © 2012-2014 远方的雪山.保留所有权利",
"type" => "textarea");

$options[] = array( "name" => "统计代码",
"desc" => "添加网站统计代码，比如google统计代码、百度统计、CNZZ等",
"id" => $shortname."_statistics",
"std" => "",
"type" => "textarea");


update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}

?>