<?php
/*
* Template Name: 文章归档
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
      <!-- 页面信息end -->
    </section>
    <article class="entry-page" id="tag-page">
      <div id="archives">      
    <div id="archives-content">      
    <?php       
        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );      
        $year=0; $mon=0; $i=0; $j=0;      
        $all = array();      
        $output = '';      
        while ( $the_query->have_posts() ) : $the_query->the_post();      
            $year_tmp = get_the_time('Y');      
            $mon_tmp = get_the_time('n');      
            $y=$year; $m=$mon;      
            if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';      
            if ($year != $year_tmp) { // 输出年份      
                $year = $year_tmp;      
                $all[$year] = array();      
            }      
            if ($mon != $mon_tmp) { // 输出月份      
                $mon = $mon_tmp;      
                array_push($all[$year], $mon);      
                $output .= "<div class='archive-title' id='arti-$year-$mon'><span class='archive-round'><h3>$year<br>$mon</h3></span><div class='archives archives-$mon' data-date='$year-$mon'>";      
            }      
            $output .= '<div class="brick"><span class="time">'.get_the_time('Y-n-d').'</span><a href="'.get_permalink() .'" title="详细阅读 '.get_the_title() .'" target="_blank">'.get_the_title() .' </a><span class="right"> ('. get_comments_number('0', '1', '%') .')</span></div>';      
        endwhile;      
        wp_reset_postdata();      
        $output .= '</div></div>';      
        echo $output;      
     
        $html = "";      
        $year_now = date("Y");
    ?>     
    </div>
</div><!-- #archives --> 
    </article>
  </div>
  <!-- 博客边栏 -->
  <?php get_sidebar(); ?>
  <!-- 博客边栏end -->
  <div class="clearfix"></div>
</section>
<?php get_footer(); ?>
