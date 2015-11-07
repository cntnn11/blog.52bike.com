// 暗窗弹出
$(function(){
    $('.boxer').boxer({
        requestKey: 'abc123',
        labels: {
            close: "关闭",
            count: "/",
            next: "下一个",
            previous: "上一个"
        }
    });
});

// 边栏随窗口移动
$.fn.extend({
    scrollFollow: function(d) {
        d = d || {};
        d.container = d.container || $(this).parent();
        d.bottomObj = d.bottomObj || '';
        d.bottomMargin = d.bottomMargin || 0;
        d.marginTop = d.marginTop || 0;
        d.marginBottom = d.marginBottom || 0;
        d.zindex = d.zindex || 10;
        var e = $(window);
        var f = $(this);
        if (f.length <= 0) {
            return false
        }
        var g = f.position().top;
        var h = d.container.height();
        var i = f.css("position");
        if (d.bottomObj == '' || $(d.bottomObj).length <= 0) {
            var j = false
        } else {
            var j = true
        }
        e.scroll(function(a) {
            var b = f.height();
            if (f.css("position") == i) {
                g = f.position().top
            }
            scrollTop = e.scrollTop();
            topPosition = Math.max(0, g - scrollTop);
            if (j == true) {
                var c = $(d.bottomObj).position().top - d.marginBottom - d.marginTop;
                topPosition = Math.min(topPosition, (c - scrollTop) - b)
            }
            if (scrollTop > g) {
                if (j == true && (g + b > c)) {
                    f.css({
                        position: i,
                        top: g
                    })
                } else {
                    if (window.XMLHttpRequest) {
                        f.css({
                            position: "fixed",
                            top: topPosition + d.marginTop,
                            'z-index': d.zindex
                        })
                    } else {
                        f.css({
                            position: "absolute",
                            top: scrollTop + topPosition + d.marginTop + 'px',
                            'z-index': d.zindex
                        })
                    }
                }
            } else {
                f.css({
                    position: i,
                    top: g
                })
            }
        });
        return this
    }
});


$(document).ready(function() {
    $(".sidebar .widget_sl_random").scrollFollow({
        bottomObj: '.footer',
        marginTop: 20,
        marginBottom: 32
    })
});

// 幻灯片
var swiper = new Swiper('.swiper-home', {
    pagination: '.swiper-home-pagination',
    nextButton: '.swiper-home-button-next',
    prevButton: '.swiper-home-button-prev',
    paginationClickable: true,
    centeredSlides: true,
    autoplay: 5000,
    autoplayDisableOnInteraction: false,
    lazyLoading: true,
    loop: true
});
var swiper = new Swiper('.swiper-taji', {
    nextButton: '.swiper-taji-button-next',
    prevButton: '.swiper-taji-button-prev',
    centeredSlides: true,
    autoplay: 5000,
    autoplayDisableOnInteraction: false,
    lazyLoading: true,
    loop: true
});


// 响应式菜单
function createMobileMenu(menu_id, mobile_menu_id) {
    // 创建下拉选项
    jQuery("<select />").appendTo(menu_id);
    jQuery(menu_id).find('select').first().attr("id", mobile_menu_id);

    // 填充下拉选项
    jQuery(menu_id).find('a').each(function() {
        var el = jQuery(this);

        var selected = '';
        if (el.parent().hasClass('current-menu-item') == true) {
            selected = "selected='selected'";
        }

        var depth = el.parents("ul").size();
        var space = '';
        if (depth > 1) {
            for (i = 1; i < depth; i++) {
                space += '&nbsp;&nbsp;';
            }
        }

        jQuery("<option " + selected + " value='" + el.attr("href") + "'>" + space + el.text() + "</option>").appendTo(jQuery(menu_id).find('select').first());
    });
    jQuery(menu_id).find('select').first().change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });
}

jQuery(document).ready(function() {
    if (jQuery('.header-menu').length > 0) {
        createMobileMenu('.header-menu', 'responsive-nav');
    };
    if (jQuery('.footer-menu').length > 0) {
        createMobileMenu('.footer-menu', 'responsive-nav');
    }
});

    /*-----------------------------------------------------------------------------------*/
    /* 菜单下拉动画
    /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(e) {

    $ = jQuery;

    $(function() {
        $('.header-menu ul li').hover(function() {
            $(this).children('.sub-menu').stop(true, true).slideDown(500);
        }, function() {
            $(this).children('.sub-menu').stop(true, true).slideUp(500);
        });
    });

    $(function() {
        $('.header-menu .sub-menu .menu-item').click(function(e) {
            window.location = $(this).children('a').attr('href');
        });
    });

});


// 简码中的开关盒
jQuery(document).ready(function(){    
    // Toggle Box
    jQuery("ul.gdl-toggle-box li").each(function(){
        jQuery(this).children(".toggle-box-content").not(".active").css('display','none');
        
        jQuery(this).children(".toggle-box-head").bind("click", function(){
            jQuery(this).children().addClass(function(){
                if(jQuery(this).hasClass("active")){
                    jQuery(this).removeClass("active");
                    return "";
                }
                return "active";
            });
            jQuery(this).siblings(".toggle-box-content").slideToggle();
        });
    });
});


// TABS
$(function(){
    $('#tabs li:first,#tab_content > div:first').addClass('current');
    $('#tabs li a').click(function(e){
        $('#tabs li, #tab_content .current').removeClass('current').removeClass('fadeInLeft');
        $(this).parent().addClass('current');
        var currentTab = $(this).attr('href');
        $(currentTab).addClass('current fadeInLeft');
        e.preventDefault();
     
    }); 

});

// 公告文字滚动
(function($) {
    $.fn.extend({
        Scroll: function(opt, callback) {
            if (!opt) var opt = {};
            var _this = this.eq(0).find("ul:first");
            var lineH = _this.find("li:first").height(),
                line = opt.line ? parseInt(opt.line, 10) : parseInt(this.height() / lineH, 10),
                speed = opt.speed ? parseInt(opt.speed, 10) : 7000, //卷动速度，数值越大，速度越慢（毫秒）
                timer = opt.timer ? parseInt(opt.timer, 10) : 7000; //滚动的时间间隔（毫秒）
            if (line == 0) line = 1;
            var upHeight = 0 - line * lineH;
            scrollUp = function() {
                _this.animate({
                    marginTop: upHeight
                }, speed, function() {
                    for (i = 1; i <= line; i++) {
                        _this.find("li:first").appendTo(_this);
                    }
                    _this.css({
                        marginTop: 0
                    });
                });
            }
            _this.hover(function() {
                clearInterval(timerID);
            }, function() {
                timerID = setInterval("scrollUp()", timer);
            }).mouseout();
        }
    })
})(jQuery);
$(document).ready(function() {
    $(".bulletin").Scroll({
        line: 1,
        speed: 1000,
        timer: 5000
    }); //修改此数字调整滚动时间
});



//微信弹出
jQuery(function(a) {
    a(".qr").hover(function() {
            a(this).find(".weixin_content").slideDown(200)
        },
        function() {
            a(this).find(".weixin_content").hide(0)
        })
});


//回顶部
$(window).scroll(function() {
    if ($(window).scrollTop() > 600) {
        $("#back-to-top").fadeIn(200);
    } else {
        $("#back-to-top").fadeOut(200);
    }
});

$('#back-to-top, .back-to-top').click(function() {
    $('html, body').animate({
        scrollTop: 0
    }, '800');
    return false;
});

//友情链接图标显示
$("#link-page a").each(function(e){
$(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+">");
});


// 字体大小写切换
jQuery(document).ready(function($){
//调节字体大小
     $('#font-change span').click(function() {
         // 选择器
         var selector='.entry,.entry p';
         // 每次增加字体大小
         var increment=1;
         // 默认字体大小
         var font_size = 13; 
         // 获取当前字体大小和单位
         var fs_css = $(selector).css('fontSize');
         var fs_css_c = parseFloat( fs_css, 10);
         var fs_unit = fs_css.slice(-2);        
         var id = $(this).attr('id');
         switch(id) {
         case 'font-dec': fs_css_c -= increment; break;
         case 'font-inc': fs_css_c += increment; break;
         default: fs_css_c = font_size;      
         }
         $(selector).css('fontSize', fs_css_c + fs_unit);
         return false;
     });
});


// 在新窗口打开评论者链接
function externallinks() 
{ 
if (!document.getElementsByTagName) return; 
var anchors = document.getElementsByTagName("a"); 
for (var i=0; i<anchors.length; i++) 
 { 
var anchor = anchors[i]; 
if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external nofollow") 
 { 
 anchor.target = "_blank"; 
 } 
 } 
} 
window.onload = externallinks;

