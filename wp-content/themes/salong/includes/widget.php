<?php

// 关注我
class SocialMediaWidget extends WP_Widget
{
   function SocialMediaWidget()
   {
      $widget_ops = array(
         'classname' => 'social_widget',
         'description' => '自定义关注我小工具，包括社交按钮与个人简介'
      );
      $this->WP_Widget('social_networks', 'Salong-关注我', $widget_ops);
   }
   function widget($args, $instance)
   {
      extract($args);
      $title      = apply_filters('widget_title', $instance['title']);
      $title_link = strip_tags($instance['title_link']);
      if (!empty($title_link)) {
         $title_page = get_post($title_link);
      }
      echo $before_widget;
      if (!empty($title)) {echo $before_title;}
      if (!empty($title_link)) {
         echo "<a href=\"" . get_permalink($title_page->ID) . "\">";
      }
      if (empty($title)) {
         echo $title_page->post_title;
      } else {
         echo $title;
      }
      if (!empty($title_link)) {
         echo "</a>";
      }

if (!empty($title)) {echo $after_title;}
?>

<section class="social-icons">
<p><?php echo stripslashes(get_option('sl_follow_text')); ?></p>
<!-- 微信按钮 -->
  <section class="qr left">
    <span><a class="icons"><i class="icon-weixin"></i></a></span>
    <div class="weixin_content" style="display:none;">
      <div class="weixin_bg">
        <?php $weixin_path = get_option('sl_weixin');
        if(!empty($weixin_path)) { ?>
        <img src="<?php echo $weixin_path; ?>" alt="<?php  bloginfo( 'name' ); ?>微信">
        <?php }?>
        <p><?php echo stripslashes(get_option('sl_follow_weixin')); ?></p>
      </div>
    </div>
  </section>
<!-- 微信按钮end -->
<!-- 社交图标 -->
<?php include('social.php'); ?>
<!-- 社交图标end -->
<div class="clearfix"></div>
</section>
<?php
      echo $after_widget;
   }
   function update($new_instance, $old_instance)
   {
      $instance               = $old_instance;
      $instance['title']      = strip_tags($new_instance['title']);
      $instance['title_link'] = $new_instance['title_link'];
      return $instance;
   }
   function form($instance)
   {
      $instance   = wp_parse_args((array) $instance, array(
         'title' => '',
         'text' => '',
         'title_link' => ''
      ));
      $title      = strip_tags($instance['title']);
      $title_link = strip_tags($instance['title_link']);
      $text       = format_to_edit($instance['text']);
?>
<p>
  <label for="<?php
      echo $this->get_field_id('title');
?>">标题：</label>
  <input id="<?php
      echo $this->get_field_id('title');
?>" name="<?php
      echo $this->get_field_name('title');
?>" type="text" value="<?php
      echo esc_attr($title);
?>" />
</p>
<p>
  <label for="<?php
      echo $this->get_field_id('title_link');
?>">链接：</label>
  <?php
      wp_dropdown_pages(array(
         'selected' => $title_link,
         'name' => $this->get_field_name('title_link'),
         'show_option_none' => '不链接',
         'sort_column' => 'menu_order, post_title'
      ));
?>
</p>
<?php
   }
}
add_action('widgets_init', create_function('', 'return register_widget("SocialMediaWidget");'));


// 热门文章
add_action('widgets_init', create_function('', 'return register_widget("sl_hotpost");'));

class sl_hotpost extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => '主题自带热门文章小工具');
      parent::__construct('sl_hotpost', 'Salong-热门文章', $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      
      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      echo '<ul class="'.$className.'">';
      sl_hotpost($instance['limit']);
      echo '</ul>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = absint($new_instance['limit']);
      return $instance;
    }
    function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 
      'title' => '热门文章',
      'limit' => '6' 
      ) 
    );
      $instance = wp_parse_args((array) $instance, array('title' => '热门文章', 'limit' => 10));
      $title = esc_attr($instance['title']);
      $limit = isset($instance['limit']) ? absint($instance['limit']) : 10;
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
function sl_hotpost($limit){
    
    $queryObject = new WP_Query( apply_filters( 'widget_posts_args', array('caller_get_posts'=> '1', 'posts_per_page' => $limit , 'orderby' => 'comment_count' ) ) ); 

    if ($queryObject->have_posts()) {
      while ($queryObject->have_posts()) {
        $queryObject->the_post();
        $commentcount = get_comments_number();
        ?>
          <li><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="详细阅读 <?php the_title_attribute() ?> (<?php printf( _n( '1', '%s', $commentcount, 'salong' ), $commentcount );  ?>)"><?php the_title() ?></a></li>
        <?php 
      }
    }
    wp_reset_postdata();
  }



// 置顶文章
add_action('widgets_init', create_function('', 'return register_widget("sl_sticky");'));

class sl_sticky extends WP_Widget {
  function sl_sticky() {
    global $prename;
    $this->WP_Widget('sl_sticky', $prename.'Salong-置顶文章 ', array( 'description' => '主题自带置顶文章小工具' ));
  }
  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    $title = apply_filters('widget_name', $instance['title']);
    $limit = $instance['limit'];

    echo $before_title.$title.$after_title; 
    echo '<ul>';
    echo sl_sticky( $limit );;
    echo '</ul>';
    echo $after_widget;
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['limit'] = strip_tags($new_instance['limit']);
    return $instance;
  }
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 
      'title' => '置顶文章',
      'limit' => '10' 
      ) 
    );
    $title = strip_tags($instance['title']);
    $limit = strip_tags($instance['limit']);
?>
<p>
  <label> 标题：
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
  </label>
</p>
<p>
  <label> 数目：
    <input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
  </label>
</p>
<?php
  }
}

function sl_sticky($limit){
  $sticky = get_option('sticky_posts');rsort( $sticky );$sticky = array_slice( $sticky, 0, $limit );
  query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
  while (have_posts()) : the_post();

  echo '<li><a href="'.get_permalink().'" title="详细阅读 '.get_the_title().'">'.get_the_title().'</a></li>';
  endwhile; wp_reset_query();
}


// 随机文章
class RandomPostWidget extends WP_Widget   
{   
    function RandomPostWidget()   
    {   
        parent::WP_Widget('sl_random', 'Salong-随机文章', array('description' =>  '主题自带随机文章小工具') );   
    }   
    
    function widget($args, $instance)   
    {   
        extract( $args );   
    
        $title = apply_filters('widget_title',empty($instance['title']) ? '随机文章' :    
$instance['title'], $instance, $this->id_base);   
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )   
        {   
            $number = 10;   
        }   
    
        $r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true,    
'post_status' => 'publish', 'ignore_sticky_posts' => true, 'orderby' =>'rand'));   
        if ($r->have_posts())   
        {   
            echo "\n";   
            echo $before_widget;   
            if ( $title ) echo $before_title . $title . $after_title;   
            ?>   
<ul class="line">   
<?php  while ($r->have_posts()) : $r->the_post(); ?>   
<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>   
<?php endwhile; ?>   
</ul><?php   
            echo $after_widget;   
            wp_reset_postdata();   
        }   
    }   
    
    function update($new_instance, $old_instance)   
    {   
        $instance = $old_instance;   
        $instance['title'] = strip_tags($new_instance['title']);   
        $instance['number'] = (int) $new_instance['number'];   
        return $instance;   
    }   
    
    function form($instance)   
    {   
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';   
        $number = isset($instance['number']) ? absint($instance['number']) : 10;?>   
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>   
        <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>   
    
        <p><label for="<?php echo $this->get_field_id('number'); ?>">数量：</label>   
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>   
<?php   
    }   
    
}   
add_action('widgets_init', create_function('', 'return register_widget("RandomPostWidget");')); 



// 最新评论
class sl_widget extends WP_Widget {
     function sl_widget() {
         $widget_ops = array('description' => '最近评论小工具');
         $this->WP_Widget('sl_widget', 'Salong-最近评论', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
         $title = apply_filters('widget_title',esc_attr($instance['title']));
         $limit = strip_tags($instance['limit']);
         echo $before_widget.$before_title.$title.$after_title;
?>
<ul>
  <?php
                global $wpdb;
                $limit_num = $limit;
                $my_email = "'" . get_bloginfo ('admin_email') . "'";
                $rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
                $rc_comments = '';
                foreach ($rc_comms as $rc_comm) { $rc_comments .= "<li><section class='recent-comments'><span class='comment-avatar left'>" . get_avatar($rc_comm,$size='32') ."</span><p class='com-content right'><a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title='在 " . $rc_comm->post_title .  " 发表的评论'>".cut_str(strip_tags($rc_comm->comment_content),28)."…</a></p><br/><span class='comment-author left'>".$rc_comm->comment_author."</span><time class='comment-time right'>" .$rc_comm->comment_date."</time></section></li>\n";}
                echo $rc_comments;
            ?>
</ul>
<?php         
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['limit'] = strip_tags($new_instance['limit']);
         return $instance;
     }
    function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 
      'title' => '最新评论',
      'limit' => '6' 
      ) 
    );
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '','limit' => ''));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
 ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('limit'); ?>">数量：
    <input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
  </label>
</p>
<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
     }
 }
 add_action('widgets_init', 'sl_widget_init');
 function sl_widget_init() {
     register_widget('sl_widget');
 }

// 标签云
 class sl_tags extends WP_Widget {
     function sl_tags() {
         $widget_ops = array('description' => '主题自带标签云小工具');
         $this->WP_Widget('sl_tags', 'Salong-标签云', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
         $title = apply_filters('widget_title',esc_attr($instance['title']));
         $limit = strip_tags($instance['limit']);
         $paichu = strip_tags($instance['paichu']);
         echo $before_widget.$before_title.$title.$after_title;
?>
<div class="sltags">
  <?php $args = array(
        'order'         => DESC,        
        'orderby'       => count,
        'number'        => $limit,
        'exclude'        => $paichu
    );
    $tags_list = get_tags($args);
        if ($tags_list) { 
            foreach($tags_list as $tag) {
                echo '<a href="'.get_tag_link($tag).'" title="'. $tag->name .' 标签下有 '.$tag->count.' 个文章，点击查看">'. $tag->name .'</a>'; 
            } 
        } 
        ?>
</div>
<?php         
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['limit'] = strip_tags($new_instance['limit']);
         $instance['paichu'] = strip_tags($new_instance['paichu']);
         return $instance;
     }
     function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 
      'title' => '标签云',
      'limit' => '6' 
      ) 
    );
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'paichu' => ''));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
         $paichu = strip_tags($instance['paichu']);
 ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('limit'); ?>">数量：
    <input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('paichu'); ?>">排除：
    <input id="<?php echo $this->get_field_id('paichu'); ?>" name="<?php echo $this->get_field_name('paichu'); ?>" type="text" value="<?php echo $paichu; ?>" />
  </label>
</p>
<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
     }
 }
 add_action('widgets_init', 'sl_tags_init');
 function sl_tags_init() {
     register_widget('sl_tags');
 }

?>
