<?php
/*
* Template Name: 读者墙
*/ 
get_header(); ?>
<section class="container wrapper">
  <div class="content-box left">
    <section class="page-head">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <!-- 页面信息 -->
      <div class="info">
      <span class="date"><i class="icon-date"></i><?php the_time('Y-m-d') ?></span>
      <span class="views"><i class="icon-views"></i><?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?></span>
      <span class="comment"><i class="icon-comment"></i><?php comments_popup_link('0', '1', '%'); ?></span>
      </div>
      <!-- 页面信息end --> 
    </section>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="entry-page" id="reader-page">
      <?php the_content(); ?>
      <!-- 读者墙 -->
      <?php
        $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'longyizaifei@163.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 36";//把longyizaifei@163.com改成自己的邮箱，在读者墙中排除管理员。最后的数字36是在读者墙中显示的读者个数，根据情况修改！ 
        $wall = $wpdb->get_results($query);
        $maxNum = $wall[0]->cnt;
         foreach ($wall as $comment)
        {
          if( $comment->comment_author_url )
          $url = $comment->comment_author_url;
          else $url="#";
          $r="rel='external nofollow'";
          $imgsize="36";//头像的大小，如果修改，CSS样式也得相应地修改。
          $tmp = "<li><section class='reader'><div class='reader-box'><span class='avatar'><img src='http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($comment->comment_author_email) )."&size=".$imgsize ."&d=identicon&r=G' /> ".$comment->comment_author." +".$comment->cnt."</span><div class='site'><a target='_blank' href='".$url."'>查看 ".$comment->comment_author." 的站点</a></div></div></section></li>";
          $output .= $tmp;
        }
        $output = "<ul class=\"readers-list\">".$output."</ul>";
        echo $output ;
        ?>
      <!-- 读者墙end --> 
      
    </article>
    <?php endwhile; comments_template(); endif; ?>
  </div>
  <!-- 博客边栏 -->
  <?php get_sidebar(); ?>
  <!-- 博客边栏end -->
  <div class="clearfix"></div>
</section>
<?php get_footer(); ?>
