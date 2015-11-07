<!-- 图片延迟加载 -->
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
// 图片延迟加载
$(function() {
    $(".container img").lazyload({
        effect: "fadeIn"
    });
});
</script>