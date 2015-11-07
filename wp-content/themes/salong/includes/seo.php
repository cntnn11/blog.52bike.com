<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() || is_page() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="og:image" content="<?php if( has_post_thumbnail() ){ ?><?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $large_image_url[0]; ?><?php } else { ?><?php echo get_content_first_image(get_the_content()); ?><?php } ?>"/>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:email" content="<?php bloginfo('admin_email'); ?>"/>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<link rel="canonical" href="<?php the_permalink(); ?>"/>
<?php } ?>
<?php if ( is_page() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php the_title(); ?> | <?php bloginfo('name'); ?>" />
<link rel="canonical" href="<?php the_permalink(); ?>"/>
<?php } ?>
<?php if ( is_category() ) { ?>
<meta name="description" content="<?php echo category_description(); ?>" />
<meta name="keywords" content="<?php single_cat_title(); ?>" />
<link rel="canonical" href="<?php echo salong_archive_link();?>"/>
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo single_tag_title(); ?>" />
<meta name="keywords" content="<?php echo single_tag_title(); ?>" />
<link rel="canonical" href="<?php echo salong_archive_link();?>"/>
<?php } ?>
<?php if ( is_home() ) { ?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:url" content="<?php echo get_option('home'); ?>" />
<meta property="og:email" content="<?php bloginfo('admin_email'); ?>"/>
<meta name="description" content="<?php echo get_option('sl_description'); ?>" />
<meta name="keywords" content="<?php echo get_option('sl_keywords'); ?>" />
<link rel="canonical" href="<?php echo salong_archive_link();?>"/>
<?php } ?>