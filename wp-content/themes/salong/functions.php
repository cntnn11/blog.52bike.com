<?php
// 后台设置
include("admin/admin-functions.php");
include("admin/admin-interface.php");
include("admin/theme-settings.php");

// 公告
include("includes/functions/types_bulletin.php");

// 缩略图
if (get_option('sl_lazyload') == 'true') {
  include(TEMPLATEPATH .'/includes/thumb.php');
}
else {
  include(TEMPLATEPATH . '/includes/thumb-nl.php');
}

// 邮件通知
include("includes/functions/notify.php");

// 短代码
include("includes/shortcodes/shortcodespanel.php");
include("includes/shortcodes/shortcodes.php");

// 后台登录界面
include("includes/login/login.php");

// 小工具
include("includes/sidebars.php");
include("includes/widget.php");
include("includes/taji.php");

// 加载语言包
load_theme_textdomain('salong', get_template_directory() . '/languages');

// 自定义菜单
register_nav_menus(
  array(
     'header-menu' => "导航菜单",
     'footer-menu' => "页脚菜单"
  )
);

//菜单回调函数
function Salong_header_fallback(){
  echo '<div class="header-menu"><ul class="empty"><li>'.__( '<a href="'.get_option('home').'/wp-admin/nav-menus.php?action=locations">请在 "后台——外观——菜单" 添加导航菜单</a>','Salong' ).'</ul></li></div>';
}
function Salong_footer_fallback(){
  echo '<div class="footer-menu"><ul class="empty"><li>'.__( '<a href="'.get_option('home').'/wp-admin/nav-menus.php?action=locations">请在 "后台——外观——菜单" 添加页脚菜单</a>','Salong' ).'</ul></li></div>';
}


//保护后台登录
if (get_option('sl_admin_login') == 'true') {
add_action('login_enqueue_scripts','login_protection');  
function login_protection(){  
    if($_GET[''.get_option('sl_admin_word').''] != ''.get_option('sl_admin_press').'')header('Location: '.get_home_url().'');  
}
}

// 重置默认注册用户到首页
function redirect_non_admin_users() {
  if ( ! current_user_can( 'publish_posts' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
    wp_redirect( home_url() );
    exit;
  }
}
add_action( 'admin_init', 'redirect_non_admin_users' );

// 获取文章第一张图片，这里获取的是图片的原始大小
function get_content_first_image($content){
  if ( $content === false ) $content = get_the_content();

  preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $content, $images);

  if($images){
    return $images[1][0];
  }else{
    return false;
  }
}

//为弹窗自动添加标签属性
add_filter('the_content', 'boxer_replace');   
function boxer_replace ($content)   
{   global $post;   
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";   
    $replacement = '<a$1href=$2$3.$4$5 class="boxer" rel="gallery"$6>$7</a>';   
    $content = preg_replace($pattern, $replacement, $content);   
    return $content;   
}

// 为图片添加 data-original 属性
add_filter ('the_content', 'lazyload');
function lazyload($content) {
    $loadimg_url= get_option('sl_post_loading');
    if(!is_feed()||!is_robots) {
        $content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" src=\"$loadimg_url\"\$3>\n<noscript>\$0</noscript>",$content);
    }
    return $content;
}

//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_option('sl_gravatar');
  $avatar_defaults[$myavatar] = '自定义头像';
  return $avatar_defaults;
}

//取消描述中的p标签
function deletehtml($description) {  
    $description = trim($description);  
    $description = strip_tags($description,"");  
    return ($description); 
} 
add_filter('category_description', 'deletehtml');


// 让WordPress支持使用中文用户名注册和登录
function ludou_sanitize_user ($username, $raw_username, $strict) {
   $username = wp_strip_all_tags( $raw_username );
   $username = remove_accents( $username );
   // Kill octets
   $username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
   $username = preg_replace( '/&.+?;/', '', $username ); // Kill entities

   // 网上很多教程都是直接将$strict赋值false，
   // 这样会绕过字符串检查，留下隐患
   if ($strict) {
     $username = preg_replace ('|[^a-z\p{Han}0-9 _.\-@]|iu', '', $username);
   }

   $username = trim( $username );
   // Consolidate contiguous whitespace
   $username = preg_replace( '|\s+|', ' ', $username );

   return $username;
}

 add_filter ('sanitize_user', 'ludou_sanitize_user', 10, 3);

// 网站维护
if (get_option('sl_weihu') == 'true') {
function wp_maintenance_mode(){
  if(!current_user_can('edit_themes') || !is_user_logged_in()){
      wp_die(''.__('网站临时维护中，请稍后访问，给您带来的不便，敬请谅解！','salong').'', ''. get_option('blogname') .''.__('网站维护中','salong').'', array('response' => '503'));
  }
}
add_action('get_header', 'wp_maintenance_mode');
}

//面包屑
function salong_breadcrumbs() {
  $delimiter = '-';
  $name = '首页'; 
 
  if ( !is_home() ||!is_front_page() || is_paged() ) {
 
    global $post;
    $home = home_url();
    echo '当前位置：<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo single_cat_title();
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo get_the_time('d');
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo get_the_time('F');
 
    } elseif ( is_year() ) {
      echo get_the_time('Y');
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo the_title();
 
    } elseif ( is_page()||!$post->post_parent ) {
      the_title();
 
    } elseif ( is_page()||$post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="admin_url() . get_permalink($page->ID) . ">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      the_title();
 
    } elseif ( is_search() ) {
      echo get_search_query();
 
    } elseif ( is_tag() ) {
      echo single_tag_title();
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo ''.__('由','salong').''.$userdata->display_name.''.__('发表','salong').'';
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '第' . ' ' . get_query_var('paged').' 页';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    if ( is_404() ) {
    echo ''.__('404 公益页面','salong').' ';
  }
  }else{
    echo $name;
  }
}

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );  

//canonical标签
function salong_archive_link( $paged = true ) { 
$link = false; 

if ( is_front_page() ) { 
        $link = home_url( '/' ); 
} else if ( is_home() && "page" == get_option('show_on_front') ) { 
        $link = get_permalink( get_option( 'page_for_posts' ) ); 
} else if ( is_tax() || is_tag() || is_category() ) { 
        $term = get_queried_object(); 
        $link = get_term_link( $term, $term->taxonomy ); 
} else if ( is_post_type_archive() ) { 
        $link = get_post_type_archive_link( get_post_type() ); 
} else if ( is_author() ) { 
        $link = get_author_posts_url( get_query_var('author'), get_query_var('author_name') ); 
} else if ( is_archive() ) { 
        if ( is_date() ) { 
                if ( is_day() ) { 
                        $link = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') ); 
                } else if ( is_month() ) { 
                        $link = get_month_link( get_query_var('year'), get_query_var('monthnum') ); 
                } else if ( is_year() ) { 
                        $link = get_year_link( get_query_var('year') ); 
                }                                                
        } 
} 

if ( $paged && $link && get_query_var('paged') > 1 ) { 
        global $wp_rewrite; 
        if ( !$wp_rewrite->using_permalinks() ) { 
                $link = add_query_arg( 'paged', get_query_var('paged'), $link ); 
        } else { 
                $link = user_trailingslashit( trailingslashit( $link ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged'), 'archive' );
        } 
} 
return $link; 
}

//外链自动nofollow
add_filter( 'the_content', 'salong_seo_wl');
function salong_seo_wl( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {
   
            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
   
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
   
                $noFollow = '';   
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';
   
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
   
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}

//禁止加载GOOGLE字体
class Disable_Google_Fonts {
public function __construct() {
add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
}
public function disable_open_sans( $translations, $text, $context, $domain ) {
if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
$translations = 'off';
}
return $translations;
}
}
$disable_google_fonts = new Disable_Google_Fonts;

//搜索提高相关性
add_filter('posts_orderby_request', 'wpjam_search_orderby_filter');
function wpjam_search_orderby_filter($orderby = ''){
if(is_search()){
global $wpdb;
$keyword = $wpdb->prepare($_REQUEST['s'],'');
return "((CASE WHEN {$wpdb->posts}.post_title LIKE '%{$keyword}%' THEN 2 ELSE 0 END) + (CASE WHEN {$wpdb->posts}.post_content LIKE '%{$keyword}%' THEN 1 ELSE 0 END)) DESC, {$wpdb->posts}.post_modified DESC, {$wpdb->posts}.ID ASC";
}else{
return $orderby;
}
}


//隐藏版本信息
function change_footer_admin () {return '<a href="http://salongweb.com" title="萨龙网络">萨龙网络</a>';}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
function change_footer_version() {return '&nbsp;';}
add_filter( 'update_footer', 'change_footer_version', 9999);

//隐藏面板登陆错误信息
add_filter('login_errors', create_function('$a', "return null;"));

// 同时删除head和feed中的WP版本号
function salong_remove_wp_version() {
  return '';
}
add_filter('the_generator', 'salong_remove_wp_version');
// 隐藏js/css附加的WP版本号
function salong_remove_wp_version_strings( $src ) {
  global $wp_version;

  parse_str(parse_url($src, PHP_URL_QUERY), $query);

  if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {

    // 用WP版本号 + 12.8来替代js/css附加的版本号

    // 既隐藏了WordPress版本号，也不会影响缓存

    // 建议把下面的 12.8 替换成其他数字，以免被别人猜出

    $src = str_replace($wp_version, $wp_version + 12.8, $src);

  }
  return $src;
}
add_filter( 'script_loader_src', 'salong_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'salong_remove_wp_version_strings' );

//禁止代码标点转换
remove_filter('the_content', 'wptexturize');


// 移除头部冗余代码
remove_action( 'wp_head', 'wp_generator' );// WP版本信息
remove_action( 'wp_head', 'rsd_link' );// 离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' );// 同上
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );// 上下文章的url
remove_action( 'wp_head', 'feed_links', 2 );// 文章和评论feed
remove_action( 'wp_head', 'feed_links_extra', 3 );// 去除评论feed
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );// 短链接


// 标签页获取公告
function salong_posts_where($where) {
  if (is_tag()) {
    $where = @str_replace("post_type IN (", "post_type IN ('bulletin', ", $where);
    $where = @preg_replace("/post_type = '([a-zA-Z0-9_-]+)'/", "post_type IN ('bulletin', '$1')", $where);
  }
  return $where;
}

add_filter('posts_where', 'salong_posts_where');

//编辑器TinyMCE增强
function enable_more_buttons($buttons) {   
     $buttons[] = 'hr';   
     $buttons[] = 'del';   
     $buttons[] = 'sub';   
     $buttons[] = 'sup';    
     $buttons[] = 'fontselect';   
     $buttons[] = 'fontsizeselect';   
     $buttons[] = 'cleanup';      
     $buttons[] = 'styleselect';   
     $buttons[] = 'wp_page';   
     $buttons[] = 'anchor';   
     $buttons[] = 'backcolor';   
     return $buttons;   
     }   
add_filter("mce_buttons_3", "enable_more_buttons"); 

//标题文字截断
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//摘要截取
function chinese_excerpt($text, $length=65) {
 $text = mb_substr($text,0, $length);
 return $text;
 }
 add_filter('the_excerpt', 'chinese_excerpt');

// 判断管理员
function is_admin_comment( $comment_ID = 0 ) {
$comment = get_comment( $comment_ID );
$admin_comment = false;
if($comment->user_id == 1){
$admin_comment = true;
}
return $admin_comment;
}


// 评论回复
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
    global $commentcount;
    if(!$commentcount) {
        $page = get_query_var('cpage')-1;
        $cpp=get_option('comments_per_page');
        $commentcount = $cpp * $page;
    }
    ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
  <article id="div-comment-<?php comment_ID() ?>" class="comment-art">
    <?php $add_below = 'div-comment'; ?>
      <div class="t" style="display:none;" id="comment-<?php comment_ID(); ?>"></div>
      <div id="avatar" class="left">
      <?php echo get_avatar( $comment, 36 ); ?>
      </div> <div  class="comment-author"><div class="comment-info"><?php comment_author_link() ?>&nbsp;&nbsp;<time class="datetime"><?php comment_date('Y-m-d') ?>&nbsp;<?php comment_time('H:i:s') ?>
      </time>
      <?php edit_comment_link('编辑','+',''); ?>
       <span class="reply-del right">
       <span class="floor">
      <?php if(!$parent_id = $comment->comment_parent) {printf('&nbsp;%1$s楼', ++$commentcount);} ?>
      </span>
      <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      <?php   
                    if ( is_user_logged_in() ) {   
                    $url = get_bloginfo('url');   
                    echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '"" >删除</a>';   
                    }   
                    ?>
      </span>
      </div>
      <div class="comment-text"><?php comment_text() ?></div>
      </div >
    <?php if ( $comment->comment_approved == '0' ) : ?>
    您的评论正在等待审核中... <br/>
    <?php endif; ?>
    <div class="clearfix"></div>
  </article>
  <?php
}

function mytheme_end_comment() {
        echo '</li>';
}

//解决头像被墙
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=32" class="avatar avatar-32" height="32" width="32">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

// 标记链接超长的垃圾评论
function rkv_url_spamcheck( $approved , $commentdata ) {
return ( strlen( $commentdata['comment_author_url'] ) > 50 ) ? 'spam' : $approved;
}
add_filter( 'pre_comment_approved', 'rkv_url_spamcheck', 99, 2 );


// 禁止全英文和日文评论
function BYMT_comment_post( $incoming_comment ) {
$pattern = '/[一-龥]/u';
$jpattern ='/[ぁ-ん]+|[ァ-ヴ]+/u';
if(!preg_match($pattern, $incoming_comment['comment_content'])) {
err( "写点汉字吧，博主英文过了四级，但还是不认识英文！Please write some chinese words！" );
}
if(preg_match($jpattern, $incoming_comment['comment_content'])){
err( "日文滚粗！Japanese Get out！日本語出て行け！" );
}
return( $incoming_comment );
}
add_filter('preprocess_comment', 'BYMT_comment_post');


// 针对特定字符留言直接屏蔽
function in_comment_post_like($string, $array) {   
    foreach($array as $ref) { if(strstr($string, $ref)) { return true; } }   
    return false;  
}  
function drop_bad_comments() {  
    if (!empty($_POST['comment'])) {  
        $post_comment_content = $_POST['comment'];  
        $lower_case_comment = strtolower($_POST['comment']);  
        $bad_comment_content = array(  
            'www.','.com','.cn','.net','.me','.html','.php','夜场','ktv','东方魅力','夜总会','新娘','肾虚','化妆','培训','娱乐','百家乐','博彩','娱乐城','足球博彩','理财','代理','硝化棉','金宝博','赌博','博大'
        );  
        if (in_comment_post_like($lower_case_comment, $bad_comment_content)) {  
            $comment_box_text = wordwrap(trim($post_comment_content), 80, "\n  ", true);  
            $txtdrop = fopen('/var/log/httpd/wp_post-logger/nullamatix.com-text-area_dropped.txt', 'a');  
            fwrite($txtdrop, "  --------------\n  [COMMENT] = " . $post_comment_content . "\n  --------------\n");  
            fwrite($txtdrop, "  [SOURCE_IP] = " . $_SERVER['REMOTE_ADDR'] . " @ " . date("F j, Y, g:i a") . "\n");  
            fwrite($txtdrop, "  [USERAGENT] = " . $_SERVER['HTTP_USER_AGENT'] . "\n");  
            fwrite($txtdrop, "  [REFERER  ] = " . $_SERVER['HTTP_REFERER'] . "\n");  
            fwrite($txtdrop, "  [FILE_NAME] = " . $_SERVER['SCRIPT_NAME'] . " - [REQ_URI] = " . $_SERVER['REQUEST_URI'] . "\n");  
            fwrite($txtdrop, '--------------**********------------------'."\n");  
            header("HTTP/1.1 406 Not Acceptable");  
            header("Status: 406 Not Acceptable");  
            header("Connection: Close");  
            wp_die( __('砰 砰 砰…') );  
        }  
    }  
}  
add_action('init', 'drop_bad_comments');


// 投稿发布后给投稿者邮件
function tougao_notify($mypost) {
    $email = get_post_meta($mypost->ID, "sl_tougao_email", true);
    if( !empty($email) ) {
        // 以下是邮件标题
        $subject = '您在 '. get_option('blogname') .' 的投稿已发布';
        // 以下是邮件内容
        $message = '
        <p><strong>'. get_option('blogname') .'</strong> 提醒您: 您投递的文章 <strong>' . $mypost->post_title . '</strong> 已发布</p>
        <p>您可以点击以下链接查看具体内容:<br />
        <a href="' . get_permalink( $mypost->ID ) . '" target="_blank">点此查看完整內容</a></p>
        <p>感谢您对<a href="' . get_option('home') . '" target="_blank">'. get_option('blogname') .' </a>的关注和支持</p>
        <p><strong>该信件由系统自动发出, 请勿回复, 谢谢.</strong></p>';

        add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
        @wp_mail( $email, $subject, $message );
    }
}

add_action('draft_to_publish', 'tougao_notify', 6);


// 分页
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;
$next = $paged + 1;
$range = 2; // only edit this if you want to show more page-links
$showitems = ($range * 2)+1;

$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
echo "<div class='pagination'>";
echo ($paged > 3 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>首页</a>":"";
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>上一页</a>":"";

for ($i=1; $i <= $pages; $i++){
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
}
}
echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>下一页</a>" :"";
echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>尾页</a>":"";
echo "</div>\n";
}
}


//分类文章数
function wt_get_category_count($input = '') {
    global $wpdb;

    if($input == '') {
        $category = get_the_category();
        return $category[0]->category_count;
    }
    elseif(is_numeric($input)) {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
        return $wpdb->get_var($SQL);
    }
    else {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
        return $wpdb->get_var($SQL);
    }
}


//文章浏览统计   
function getPostViews($postID){   
        $count_key = 'views'; //自定义域   
        $count = get_post_meta($postID, $count_key, true);   
        if($count==''){   
            delete_post_meta($postID, $count_key);   
            add_post_meta($postID, $count_key, '0');   
            return "0";   
        }   
        return $count.'';   
    }   
    function setPostViews($postID) {   
        $count_key = 'views'; //自定义域   
        $count = get_post_meta($postID, $count_key, true);   
        if($count==''){   
            $count = 0;   
            delete_post_meta($postID, $count_key);   
            add_post_meta($postID, $count_key, '0');   
        }else{   
            $count++;   
            update_post_meta($postID, $count_key, $count);   
        }   
    }  
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);  

//字数统计
function count_words ($text) {
global $post;
if ( '' == $text ) {
$text = $post->post_content;
if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8'). '字';
return $output;
}
}

//全部结束

?>