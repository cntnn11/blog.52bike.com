<?php
// 远方的雪山简码
// http://salonglong.com

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');


// 一、图标框
////////////////////////////////////////////////////////////

//1.远方
function sl_yuanfangbox($atts, $content=null, $code="") {
  $return = '<div class="yuanfangbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('yuanfangbox' , 'sl_yuanfangbox' );
//简码：[yuanfangbox]远方的雪山[/yuanfangbox]


//2.骑行
function sl_qixingbox($atts, $content=null, $code="") {
  $return = '<div class="qixingbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('qixingbox' , 'sl_qixingbox' );
//简码：[qixingbox]远方的雪山[/qixingbox]

//3.音乐
function sl_headsetbox($atts, $content=null, $code="") {
  $return = '<div class="headsetbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('headsetbox' , 'sl_headsetbox' );
//简码：[headsetbox]远方的雪山[/headsetbox]

//4.电影
function sl_moviebox($atts, $content=null, $code="") {
  $return = '<div class="moviebox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('moviebox' , 'sl_moviebox' );
//简码：[moviebox]远方的雪山[/moviebox]

//5.镜头
function sl_shotbox($atts, $content=null, $code="") {
  $return = '<div class="shotbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('shotbox' , 'sl_shotbox' );
//简码：[shotbox]远方的雪山[/shotbox]

//6.绘画
function sl_painterbox($atts, $content=null, $code="") {
  $return = '<div class="painterbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('painterbox' , 'sl_painterbox' );
//简码：[painterbox]远方的雪山[/painterbox]

//7.灯泡
function sl_ideabox($atts, $content=null, $code="") {
  $return = '<div class="ideabox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('ideabox' , 'sl_ideabox' );
//简码：[ideabox]远方的雪山[/ideabox]

//8.事件
function sl_eventbox($atts, $content=null, $code="") {
  $return = '<div class="eventbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('eventbox' , 'sl_eventbox' );
//简码：[eventbox]远方的雪山[/eventbox]

//9.Wordpress
function sl_wpbox($atts, $content=null, $code="") {
  $return = '<div class="wpbox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('wpbox' , 'sl_wpbox' );
//简码：[wpbox]远方的雪山[/wpbox]

//10.微笑
function sl_smilebox($atts, $content=null, $code="") {
  $return = '<div class="smilebox">';
  $return .= $content;
  $return .= '</div>';
  return $return;
}
add_shortcode('smilebox' , 'sl_smilebox' );
//简码：[smilebox]远方的雪山[/smilebox]


// 二、按钮
////////////////////////////////////////////////////////////

function scbutton( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'  => '#',
    'target'  => '',
    'variation' => '',
    'size'  => '',
    'align' => '',
    ), $atts));

  $style = ($variation) ? ' '.$variation : '';
  $align = ($align) ? ' align'.$align : '';
  $size = ($size == 'large') ? ' large_button' : '';
  $target = ($target == 'blank') ? ' target="_blank"' : '';

  $out = '<a' .$target. ' class="button' .$style.$size.$align. '" href="' .$link. '">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('scbutton', 'scbutton');
//简码：[button link="http://salonglong.com" target="_blank" size="large" align="right"]远方的雪山[/button]


// 二、列表
////////////////////////////////////////////////////////////
//1.小红点
function sl_redlist($atts, $content = null) {
    return '<div class="redlist">'.$content.'</div>';
}
add_shortcode('ssredlist', 'sl_redlist');
//简码：[ssredlist]<ul> <li>列表内容1</li> <li>列表内容2</li> <li>列表内容3</li> </ul>[/ssredlist]

//2.小黄点
function sl_yellowlist($atts, $content = null) {
    return '<div class="yellowlist">'.$content.'</div>';
}
add_shortcode('ssyellowlist', 'sl_yellowlist');
//简码：[ssyellowlist]<ul> <li>列表内容1</li> <li>列表内容2</li> <li>列表内容3</li> </ul>[/ssyellowlist]

//3.小蓝点
function sl_bluelist($atts, $content = null) {
    return '<div class="bluelist">'.$content.'</div>';
}
add_shortcode('ssbluelist', 'sl_bluelist');
//简码：[ssbluelist]<ul> <li>列表内容1</li> <li>列表内容2</li> <li>列表内容3</li> </ul>[/ssbluelist]

//4.小绿点
function sl_greenlist($atts, $content = null) {
    return '<div class="greenlist">'.$content.'</div>';
}
add_shortcode('ssgreenlist', 'sl_greenlist');
//简码：[ssgreenlist]<ul> <li>列表内容1</li> <li>列表内容2</li> <li>列表内容3</li> </ul>[/ssgreenlist]

//5.系列教程列表
function sl_series($atts, $content = null) {
    return '<div class="series">'.$content.'</div>';
}
add_shortcode('ssseries', 'sl_series');
//简码：[ssseries]<h3>系列教程</h3><ul> <li>列表内容1</li> <li>列表内容2</li> <li>列表内容3</li> </ul>[/ssseries]


// 四、媒体
////////////////////////////////////////////////////////////
//1.插入flash
function swf_player($atts, $content = null) {   
extract(shortcode_atts(array("width"=>'100%',"height"=>'400'),$atts));   
return '<embed type="application/x-shockwave-flash" class="flash" width="'.$width.'" height="'.$height.'" src="'.$content.'"></embed>';   
}  
add_shortcode('swf','swf_player');
//简码：[swf]Flash文件地址[/swf]

//2.优酷视频去广告
function youku_video($atts, $content=null){  
    return '<p style="text-align: center;"><embed src=http://static.youku.com/v1.0.0149/v/swf/loader.swf?VideoIDS='.$content.'ID&winType=adshow quality="high" width="100%" height="400" align="middle" wmode="transparent" allowScriptAccess="never"  allowfullscreen="true" allowNetworking="internal" autostart="0" type="application/x-shockwave-flash"></embed></p>';  
}  
add_shortcode('youku','youku_video');  
//简码：[youku]XMjM2OTE3ODg4[/youku]


// 五、其它简码
////////////////////////////////////////////////////////////
//1.开关盒
  add_shortcode('toggle_box', 'gdl_toggle_box_shortcode');
  function gdl_toggle_box_shortcode( $atts, $content = null ){
  
    $toggle_box = "<ul class='gdl-toggle-box'>";
    $toggle_box = $toggle_box . do_shortcode($content);
    $toggle_box = $toggle_box . "</ul>";
    return $toggle_box;
  }
  add_shortcode('toggle_item', 'gdl_toggle_item_shortcode');
  function gdl_toggle_item_shortcode( $atts, $content = null ){
  
    extract( shortcode_atts(array("title" => '', "active" => 'false'), $atts) );
    
    $active = ( $active == "true" )? " active": '';
    $toggle_item = "<li>";
    $toggle_item = $toggle_item . "<h2 class='toggle-box-head'>";
    $toggle_item = $toggle_item . "<i class='icon-toggle" . $active . "'></i>"; 
    $toggle_item = $toggle_item . $title . "</h2>";
    $toggle_item = $toggle_item . "<div class='toggle-box-content" . $active . "'>" . do_shortcode($content) . "</div>";
    $toggle_item = $toggle_item . "</li>";
  
  
    return $toggle_item;
  
  } 
//简码：[toggle_box][toggle_item title="标题" active="true"]内容[/toggle_item][toggle_item title="标题"]内容[/toggle_item][toggle_item title="标题"]内容[/toggle_item][toggle_item title="标题"]内容[/toggle_item][/toggle_box]

//2. Tabs
add_shortcode( 'tabgroup', 'sl_tab_group' );
function sl_tab_group( $atts, $content=null ){
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$tab['id'].'">'.$tab['content'].'</div>';
}
$return = "\n".'<div id="tabwrap"><ul id="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div id="tab_content">'.implode( "\n", $panes ).'</div></div>'."\n";
}
return $return;
}

add_shortcode( 'tab', 'scd_tab' );
function scd_tab( $atts, $content=null ){
extract(shortcode_atts(array(
'title' => 'Tab %d',
'id' => ''
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content, 'id' =>  $id );

$GLOBALS['tab_count']++;
}

//简码：[tabgroup][tab title="标题 1" id="1"]内容 1[/tab][tab title="标题 2" id="2"]内容 2[/tab] [tab title="标题 3" id="3"]内容 3[/tab][/tabgroup]

//3.短代码之评论可见
function reply_to_read($atts, $content=null) {
extract(shortcode_atts(array("notice" => '<p class="reply-to-read"><span style="color:red; font-size=13px;">温馨提示：</span>此处内容需要<a href="#respond" title="评论本文">评论本文</a>后才能查看。</p>'), $atts));
$email = null;
$user_ID = (int) wp_get_current_user()->ID;
if ($user_ID > 0) {
$email = get_userdata($user_ID)->user_email;
//对博主直接显示内容
$admin_email = "longyizaifei@163.com"; //博主Email
if ($email == $admin_email) {
return $content;
}
} else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
$email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
} else {
return $notice;
}
if (empty($email)) {
return $notice;
}
global $wpdb;
$post_id = get_the_ID();
$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
if ($wpdb->get_results($query)) {
return do_shortcode($content);
} else {
return $notice;
}
}
add_shortcode('reply', 'reply_to_read'); 
//简码：[reply]评论后可见内容[/reply]或者[reply notice="自定义提醒回复内容"]自定义提醒回复内容[/reply]

?>