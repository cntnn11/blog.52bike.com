<section id="comments">
  <?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>
  <p class="nocomments">必须输入密码，才能查看评论！</p>
  <?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = '';
?>
  <!-- You can start editing here. -->
  <?php if ($comments) : ?>
  <!-- 引用 -->
  <?php
  /* Count the totals */
  $numPingBacks = 0;
  $numComments  = 0;

  /* Loop throught comments to count these totals */
  foreach ($comments as $comment)
    if (get_comment_type() != "comment") $numPingBacks++; else $numComments++;
?>
  <h2 id="comments-info">评论：
    <?php
      $my_email = get_bloginfo ( 'admin_email' );
      $str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID 
      AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
      $count_t = $post->comment_count;
      $count_v = $wpdb->get_var("$str != '$my_email'");
      $count_h = $wpdb->get_var("$str = '$my_email'");
      echo $count_t, " 条  访客:", $count_v, " 条, 博主:", $count_h, " 条 ";
    ?>
    <a class="backs right" href="#backs">查看引用:<?php echo ' '.$numPingBacks.'';?></a> </h2>
  <!-- 引用 -->
  <?php if($numPingBacks>0) { ?>
  <a href="#x" class="overlay" id="backs"></a>
  <div id="trackbacks" class="popup">
    <ul >
      <?php foreach ($comments as $comment) : ?>
      <?php $comment_type = get_comment_type(); ?>
      <?php if($comment_type != 'comment') { ?>
      <li>
        <?php comment_author_link() ?>
      </li>
      <?php } ?>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php } ?>
  <!-- 引用end --> 
  <!-- 评论列表 -->
  <ul class="commentlist">
    <?php wp_list_comments('type=comment&callback=mytheme_comment&end-callback=mytheme_end_comment'); ?>
  </ul>
  <!-- 评论列表end --> 
  <!-- 评论分页 -->
  <div id="comments-nav">
    <?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
  </div>
  <!-- 评论分页end -->
  <?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->
  <?php else : // comments are closed ?>
  <!-- If comments are closed. -->
  <p class="nocomments">抱歉!评论已关闭.</p>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post->comment_status) : ?>
  <div id="respond_box">
    <div id="respond">
      <h3>发表评论：</h3>
      <div class="cancel-comment-reply">
        <?php cancel_comment_reply_link(); ?>
      </div>
      <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
      <p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
      <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="commentform">
        <?php if ( $user_ID ) : ?>
        <?php print '登录用户：'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print ' 登出'; ?></a>
        <?php elseif ( '' != $comment_author ): ?>
        <div class="author">您好，<?php printf(__('<strong>%s</strong>'), $comment_author); ?> 欢迎来到
          <?php  bloginfo( 'name' ); ?>
          ！ <a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">[更改]</a> 
          <script type="text/javascript" charset="utf-8">
              //<![CDATA[
              var changeMsg = "[更改]";
              var closeMsg = "[关闭]";
              function toggleCommentAuthorInfo() {
                jQuery('#comment-author-info').slideToggle('slow', function(){
                  if ( jQuery('#comment-author-info').css('display') == 'none' ) {
                  jQuery('#toggle-comment-author-info').text(changeMsg);
                  } else {
                  jQuery('#toggle-comment-author-info').text(closeMsg);
                  }
                });
              }
              jQuery(document).ready(function(){
                jQuery('#comment-author-info').hide();
              });
              //]]>
            </script> 
        </div>
        <?php endif; ?>
        <?php if ( ! $user_ID ): ?>
        <div id="comment-author-info">
          <p  class="form-author"><i class="icon-author"></i>
            <input type="text" name="author" id="author" placeholder="<?php the_author_nickname(); ?>"  required value="<?php echo $comment_author; ?>" size="12" tabindex="1" />
            <span class="form-hint">请输入您的昵称！（必填）</span> </p>
          <p class="form-email"><i class="icon-email"></i>
            <input type="email" name="email" id="email" placeholder="<?php  echo the_author_meta( 'user_email' ); ?>" required value="<?php echo $comment_author_email; ?>" size="24" tabindex="2" />
            <span class="form-hint">正确格式为：
            <?php  echo the_author_meta( 'user_email' ); ?>
            （必填）</span> </p>
          <p class="form-url"><i class="icon-url"></i>
            <input type="text" name="url" id="url" placeholder="<?php echo home_url(); ?>" size="24" tabindex="3" />
            <span class="form-hint">正确格式为：<?php echo home_url(); ?>（选填）</span> </p>
        </div>
        <?php endif; ?>
        
        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
        <div class="clear"></div>
        <p class="form-textarea">
          <textarea name="comment" placeholder="请输入内容…" id="comment" cols="40" rows="6" required tabindex="4"></textarea>
        </p>
        <div class="form-submit left">
          <input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="提交留言"/>
          <input class="reset" name="reset" type="reset" id="reset" tabindex="6" value="<?php esc_attr_e( '重写' ); ?>" />
          <?php comment_id_fields(); ?>
        </div>
        <script type="text/javascript"> //Crel+Enter
      $(document).keypress(function(e){
        if(e.ctrlKey && e.which == 13 || e.which == 10) { 
          $(".submit").click();
          document.body.focus();
        } else if (e.shiftKey && e.which==13 || e.which == 10) {
          $(".submit").click();
        }
      })
    </script>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
      <div class="clear"></div>
      <?php endif; // If registration required and not logged in ?>
    </div>
  </div>
  <?php endif; // if you delete this the sky will fall on your head ?>
</section>
