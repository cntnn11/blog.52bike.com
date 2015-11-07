<?php
/*
* Template Name: 投稿页面
*/ 
// 投稿表单
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
     global $wpdb;
     $current_url = get_option('sl_contribute_page_link');   // 注意修改此处的链接地址

     $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");

     // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
     // 可自行修改时间间隔，修改下面代码中的120即可
     // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
     if ( current_time('timestamp') - strtotime($last_post) < get_option('sl_contribute_interval_time') ) {
         wp_die('您投稿也太勤快了吧，先歇会儿！<a href="'.$current_url.'">点此返回</a>');
     }
         
     // 表单变量初始化
     $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
     $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
     $blog =  isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
     $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
     $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
     $content =  isset( $_POST['tougao_content'] ) ? trim($_POST['tougao_content']) : '';
     $content = str_ireplace('?>', '?&gt;', $content);
     $content = str_ireplace('<?', '&lt;?', $content);
     $content = str_ireplace('<script', '&lt;script', $content);
     $content = str_ireplace('<a ', '<a rel="external nofollow" ', $content);
     
     // 表单项数据验证
     if ( empty($name) || mb_strlen($name) > 20 ) {
         wp_die('昵称必须填写，且长度不得超过20字。<a href="'.$current_url.'">点此返回</a>');
     }
     
     if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
         wp_die('Email必须填写，且长度不得超过60字，必须符合Email格式。<a href="'.$current_url.'">点此返回</a>');
     }
     
     if ( empty($title) || mb_strlen($title) > 100 ) {
         wp_die('标题必须填写，且长度不得超过100字。<a href="'.$current_url.'">点此返回</a>');
     }
     
     if ( empty($content) || mb_strlen($content) > get_option('sl_contribute_content_max') || mb_strlen($content) < get_option('sl_contribute_content_min')) {
         wp_die('内容必须填写，且长度不得超过'.get_option('sl_contribute_content_max').'字，不得少于'.get_option('sl_contribute_content_min').'字。<a href="'.$current_url.'">点此返回</a>');
     }
     
     $post_content = '昵称: '.$name.'<br />Email: '.$email.'<br />blog: '.$blog.'<br />内容:<br />'.$content;
     
     $tougao = array(
         'post_title' => $title, 
         'post_content' => $post_content,
         'post_category' => array($category)
     );


     // 将文章插入数据库
     $status = wp_insert_post( $tougao );
   
     if ($status != 0) { 
         // 投稿成功给博主发送邮件
         // somebody#example.com替换博主邮箱
         // My subject替换为邮件标题，content替换为邮件内容
         wp_mail(get_option('sl_contribute_email'),''. get_option('blogname') .'投稿',''. get_option('blogname') .'有投稿了，快去看看！');
         // 其中 sl_tougao_email 是自定义栏目的名称
         add_post_meta($status, 'sl_tougao_email', $email, TRUE);

         wp_die('投稿成功！感谢投稿！<a href="'.$current_url.'">点此返回</a>', '投稿成功');
     }
     else {
         wp_die('投稿失败！<a href="'.$current_url.'">点此返回</a>');
     }
}
// 投稿表单end



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
      </div>
      <!-- 页面信息end --> 
    </section>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="entry-page" id="tag-page">
      <?php the_content(); ?>
      <!-- 关于表单样式，请自行调整-->
      <form class="commentform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; $current_user = wp_get_current_user(); ?>">
     <p><i class="icon-author"></i>
         <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_login; ?>" id="author" name="tougao_authorname" placeholder="<?php the_author_nickname(); ?>" required />
         <span class="form-hint">请输入您的昵称！</span>
     </p>
     <p><i class="icon-email"></i>
         <input type="email" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_email; ?>" id="email" name="tougao_authoremail" placeholder="<?php bloginfo('admin_email'); ?>" required />
         <span class="form-hint">正确格式为：<?php bloginfo('admin_email'); ?></span>
     </p>
     <p><i class="icon-url"></i>
         <input type="url" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_url; ?>" id="url" name="tougao_authorblog" placeholder="<?php echo get_option('home'); ?>" required />
            <span class="form-hint">正确格式为：<?php echo get_option('home'); ?></span> </p>
     </p>
     <p><i class="icon-title"></i>
         <input type="text" size="40" value="" id="title" name="tougao_title" placeholder="文章标题" required />
         <span class="form-hint">请输入文章标题！</span>
     </p>
     <p class="tuogao-hint"><i class="icon-cate"></i>
         <?php wp_dropdown_categories('hide_empty=0&id=tougaocategorg&show_count=1&hierarchical=1'); ?>
         <span class="form-hint">请选择相应的文章分类！</span>
     </p>
     <p>
         <textarea rows="15" cols="55" id="tougao_content" name="tougao_content"  placeholder="文章内容…"></textarea>
     </p>
     <div style="text-align: center; padding-top: 10px;">
         <input type="hidden" value="send" name="tougao_form" />
         <input type="submit" class="submit" value="提交" />
         <input type="reset" class="reset" value="重填" />
     </div>
</form>
      <script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/kindeditor-min.js"></script> 
      <script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/lang/zh_CN.js"></script> 
      <script>
 /* 编辑器初始化代码 start */
     <?php echo stripslashes(get_option('sl_Kindeditor')); ?>
 /* 编辑器初始化代码 end */
      </script> 
    </article>
    <?php endwhile; endif; 	?>
  </div>
  <!-- 博客边栏 -->
  <aside class="sidebar right">
  <?php dynamic_sidebar('联系边栏'); ?>
  </aside>
  <!-- 博客边栏end -->
  <div class="clearfix"></div>
</section>
<?php get_footer(); ?>
