<?php
// 缩略图
add_theme_support( 'post-thumbnails' );
function post_thumbnail( $width = 400,$height = 225 ){
    global $post;
    if( has_post_thumbnail() ){
        $xmlobject = simplexml_load_string(get_the_post_thumbnail());
        $timthumb_src = $xmlobject->attributes()->src;
        $post_timthumb = '<a href="'.get_permalink().'" target="_blank" title="'.$post->post_title.'"><img src="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?src='.get_option('sl_thumb_loading').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" data-original="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" /></a>';
        echo $post_timthumb;
    } else {
            $content = $post->post_content;
            preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
            $n = count($strResult[1]);
            if($n > 0){
                echo '<a href="'.get_permalink().'" target="_blank" title="'.$post->post_title.'"><img src="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?src='.get_option('sl_thumb_loading').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" data-original="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?h='.$height.'&amp;w='.$width.'&amp;src='.$strResult[1][0].'" alt="'.$post->post_title.'" /></a>';
            } else {
                echo '<a href="'.get_permalink().'" target="_blank" title="'.$post->post_title.'"><img src="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?src='.get_option('sl_thumb_loading').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" data-original="'.get_bloginfo("template_url").'/includes/functions/timthumb.php?h='.$height.'&amp;w='.$width.'&amp;src='.get_bloginfo('template_url').'/images/random/'.rand(1,10).'.jpg" alt="'.$post->post_title.'" /></a>';
            }
        }
    }
?>