<?php
// 社交图标
$sl_taji = get_option('sl_taji_link');
$sl_taobao = get_option('sl_taobao_link');
$sl_facebook = get_option('sl_facebook_link');
$sl_twitter = get_option('sl_twitter_link');
$sl_sina    = get_option('sl_sina_link');
$sl_qq      = get_option('sl_qq_link');
$sl_renren  = get_option('sl_renren_link');
$sl_rss     = get_option('sl_rss_link');
echo ($sl_taji) ? '<span><a class="icons" title="它季|专属民族格调商城！" target="_blank" href="'.$sl_taji.'"><i class="icon-taji"></i></a></span>' : '';
echo ($sl_taobao) ? '<span><a class="icons" title="它季淘宝商城" target="_blank" href="'.$sl_taobao.'"><i class="icon-taobao"></i></a></span>' : '';
echo ($sl_facebook) ? '<span><a class="icons" title="在 Facebook 中关注我" target="_blank" href="'.$sl_facebook.'"><i class="icon-fbook"></i></a></span>' : '';
echo ($sl_twitter)  ? '<span><a class="icons" title="在 Twitter 中关注我" target="_blank" href="'.$sl_twitter.'"><i class="icon-twi"></i></a></span>' : '';
echo ($sl_sina)     ? '<span><a class="icons" title="在 新浪微博 中关注我" target="_blank" href="'.$sl_sina.'"><i class="icon-tsina"></i></a></span>' : '';                                  
echo ($sl_qq)       ? '<span><a class="icons" title="在 腾讯微博 中关注我" target="_blank" href="'.$sl_qq.'"><i class="icon-tqq"></i></a></span>' : '';
echo ($sl_renren)   ? '<span><a class="icons" title="在 人人网 中关注我" target="_blank" href="'.$sl_renren.'"><i class="icon-renren"></i></a></span>' : '';                                  
echo ($sl_rss)      ? '<span><a class="icons" title="订阅本站" target="_blank" href="'.$sl_rss.'"><i class="icon-rss"></i></a></span>' : '';
?>