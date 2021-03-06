<?php defined('IN_IA') or exit('Access Denied');?><?php include template('common/header', TEMPLATE_INCLUDEPATH);?>
<div id="header">
	<div class="logo pull-left" style="background:#36393a url('<?php if(empty($_W['setting']['copyright']['blogo'])) { ?>./resource/image/blogo.png<?php } else { ?><?php echo $_W['attachurl'];?><?php echo $_W['setting']['copyright']['blogo'];?><?php } ?>') no-repeat;"><?php if(!empty($_W['setting']['copyright']['sitename'])) { ?><?php echo $_W['setting']['copyright']['sitename'];?><?php } ?></div>
	<!-- 导航 -->
	<div class="hnav clearfix">
		<div class="row-fluid">
			<ul class="hnav-main text-center unstyled pull-left" style="width:55%;">
				<li class="hnav-parent <?php if($do == 'profile') { ?>active<?php } ?>"><a href="./?do=profile">当前公众号</a></li>
				<li class="hnav-parent <?php if($do == 'global') { ?>active<?php } ?>"><a href="./?do=global">全局设置</a></li>
				<li class="hnav-parent">
					<a href="">常用</a>
					<ul class="hnav-child unstyled text-left">
						<?php if($_W['isfounder']) { ?><li><a target="main" href="<?php echo create_url('setting/upgrade')?>">自动更新</a></li><?php } ?>
						<li><a target="main" href="test.php">调试工具</a></li>
						<li><a target="main" href="<?php echo create_url('setting/updatecache')?>">更新缓存</a></li>
					</ul>
				</li>
				<?php if(IMS_FAMILY == 'v' || $_W['isfounder']) { ?><li class="hnav-parent"><a href="http://bbs.we7.cc/" target="_blank">微擎论坛</a></li><?php } ?>
				<li class="hnav-parent"><a href="https://mp.weixin.qq.com/" target="_blank">公众平台</a></li>
				<?php if($_W['isfounder']) { ?><li class="hnav-parent"><a href="http://bbs.we7.cc/forum.php?mod=forumdisplay&fid=38" target="_blank">帮助</a></li><?php } ?>
			</ul>
			<!-- 右侧管理菜单 -->
			<ul class="hnav-manage text-center unstyled pull-right">
				<li class="hnav-parent" id="wechatpanel">
					<a href="javascript:;"><i class="icon-chevron-down icon-large"></i><span id="current-account"><?php if($_W['account']) { ?><?php echo $_W['account']['name'];?><?php } else { ?>请切换公众号<?php } ?></span></a>
					<ul class="hnav-child unstyled text-left">
						<?php if(is_array($wechats)) { foreach($wechats as $account) { ?>
							<li><a href="<?php echo create_url('account/switch', array('id' => $account['weid']))?>" onclick="return ajaxopen(this.href, function(s) {switchHandler(s)})"><?php echo $account['name'];?></a></li>
						<?php } } ?>
					</ul>
				</li>
				<li class="hnav-parent"><a href=""><i class="icon-user icon-large"></i><?php echo $_W['username'];?></a></li>
				<li class="hnav-parent"><a href="<?php echo create_url('member/logout')?>"><i class="icon-signout icon-large"></i>退出</a></li>
			</ul>
			<!-- end -->
		</div>
	</div>
	<!-- end -->
</div>
<!-- 头部 end -->
<div class="content-main">
	<table width="100%" height="100%" cellspacing="0" cellpadding="0" id="frametable">
		<tbody>
			<tr>
				<td valign="top" height="100%" class="content-left" style="overflow:hidden;">
					<div class="sidebar-nav" style="">
						<?php if(is_array($mset)) { foreach($mset as $g) { ?>
						<?php if($g['menus']) { ?>
						<span class="snav-big"><i class="icon-folder-open"></i> <?php echo $g['title'];?></span>
						<?php if(is_array($g['menus'])) { foreach($g['menus'] as $menu) { ?>
						<ul class="snav unstyled">
							<?php if(is_array($menu['title'])) { ?>
							<li class="snav-header-list"><a href="<?php echo $menu['title']['1'];?>" target="main"><?php echo $menu['title']['0'];?><i class="arrow"></i></a></li>
							<?php } else { ?>
							<li class="snav-header"><a href=""><?php echo $menu['title'];?><i class="arrow"></i></a></li>
							<?php } ?>
							<?php if(!empty($menu['items'])) { ?>
							<?php if(is_array($menu['items'])) { foreach($menu['items'] as $item) { ?>
							<li class="snav-list"><a href="<?php echo $item['1'];?>" target="main"><?php echo $item['0'];?><i class="arrow"></i></a><?php if(!empty($item['childItems'])) { ?><a href="<?php echo $item['childItems']['1'];?>" target="main" class="snav-small"><?php echo $item['childItems']['0'];?></a><?php } ?></li>
							<?php } } ?>
							<?php } else { ?>
							<li class="snav-list"><span style="font-size:16px;color:#999;padding-left:20px;">抱歉，暂无菜单 -_-!!!</span></li>
							<?php } ?>
						</ul>
						<?php } } ?>
						<?php } ?>
						<?php } } ?>
					</div>
					<!-- 右侧管理菜单上下控制按钮 -->
					<div class="scroll-button">
						<span class="scroll-button-up"><i class="icon-caret-up"></i></span>
						<span class="scroll-button-down"><i class="icon-caret-down"></i></span>
					</div>
					<!-- end -->
				</td>
				<td valign="top" height="100%" style=""><iframe width="100%" scrolling="yes" height="100%" frameborder="0" style="min-width:800px; overflow:visible; height:100%;" name="main" id="main" src="<?php echo $iframe;?>"></iframe></td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 3.1.9
 *
 * Requires: jQuery 1.2.2+
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.9',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
        },

        getLineHeight: function(elem) {
            return parseInt($(elem)['offsetParent' in $.fn ? 'offsetParent' : 'parent']().css('fontSize'), 10);
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));
</script>
<script type="text/javascript">
function max(a) {
	var b = a[0];
	for(var i=1;i<a.length;i++){ if(b<a[i])b=a[i]; }
	return b;
}
function currentMenuItem(a) {
	window.frames['main'].location.href= a;
}
function scrollButton() {
	if($(".sidebar-nav").height() > $(".content-main").height()) {
		$(".scroll-button").show();
	} else {
		if($(".sidebar-nav").position().top == 0) $(".scroll-button").hide();
	}
}
function switchHandler(s) {
	var mainurl = window.frames['main'].location;
	window.top.location.reload();
	window.frames['main'].location = mainurl;
	$('#current-account').html(s);
}
function strlen(str) {
		var n = 0;
		for(i=0;i<str.length;i++){
			var leg=str.charCodeAt(i);
			n+=1;
		}
		return n;
}
$(document).ready(function() {
	//顶部子导航
	$(".hnav").delegate(".hnav-parent", "mouseover", function(){
		var $this = this;
		if ($(this).attr('id') == 'wechatpanel') {
			if ($(this).attr('loading') == '1'){
				return false;
			}
			position();
			if (cookie.get('wechatloaded') == '1') {
				return true;
			}
			$($this).find(".hnav-child").html('<li><a>加载中</a></li>');
			$(this).attr('loading', '1');
			ajaxopen('<?php echo create_url('member/wechat')?>', function(s){
				var obj = $($this).find(".hnav-child");
				var html = '';
				for (i in s) {
					html += '<li><a href="account.php?act=switch&id='+s[i]['weid']+'" onclick="return ajaxopen(this.href, function(s) {main.document.location.reload();$(\'#current-account\').html(s)})">'+s[i]['name']+'</a></li>';
				}
				obj.html(html);
				$('#wechatpanel').attr('loading', '0');
			});
		} else {
			position();
		}
		function position() {
			var tmp = new Array();
			$($this).find(".hnav-child").show();
			$($this).find(".hnav-child li").each(function(i) {
				tmp[i] = strlen($(this).find("a").html());
			});
			$($this).find(".hnav-child li a").css("width", max(tmp)*18);
			$($this).find(".hnav-child").css("left", $($this).offset().left);
		}
		return false;
	});
	$(".hnav").delegate(".hnav-parent", "mouseout", function(){
		$(".hnav-child").hide();
	});
	//左侧导航
	$(".sidebar-nav").delegate(".snav-header", "click", function(){
		var a = $(this).hasClass("open");
		$(".sidebar-nav .snav-header").removeClass("open");
		$(".sidebar-nav .snav-list").hide();
		if(a) {
			$(this).removeClass("open");
			$(this).parent().find(".snav-list").each(function(i) {
				$(this).hide();
			});
		} else {
			$(this).addClass("open");
			$(this).parent().find(".snav-list").each(function(i) {
				$(this).show();
			});
		}
		scrollButton();
		return false;
	});
	$(".sidebar-nav .snav").each(function() {
		if($(this).find(".snav-header").hasClass("open")) {
			$(this).find(".snav-list").each(function() {
				$(this).toggle();
			});
		}
		$(this).find(".snav-list").each(function() {
			if($(this).hasClass("current")) {
				$(this).parent().find(".snav-header").toggleClass("open");
				$(this).parent().find(".snav-list").each(function() {
					$(this).toggle();
				});
			}
		});
		$(this).find(".snav-list a,.snav-header-list a").click(function() {
			$(".snav-list,.snav-header-list").removeClass("current");
			$(this).parent().addClass("current");
			currentMenuItem($(this).attr("href"));
			return false;
		});
	});
});
$(function() {
	//调整框架宽高 兼容ie8
	$(".content-main, .content-main table td").height($(window).height()-40);
	$("#main").width($(window).width()-200);
	//右侧菜单上下控制按钮
	var postion = 0,top = 0;
	$(".scroll-button .scroll-button-up").click(function() {
		postion = $(".sidebar-nav").position().top;
		if(postion > 0 || postion==0) {
			top = 0;
		} else {
			top = postion+$(".content-main").height()-50;
			if(top > 0) top =0;
		}
		$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
	});
	$(".scroll-button .scroll-button-down").click(function() {
		postion = $(".sidebar-nav").position().top;
		if(postion < 0 || postion==0) {
			top = postion-$(".content-main").height()+50;
			if(top< -($(".sidebar-nav").height()-$(".content-main").height()+50)) top = -($(".sidebar-nav").height()-$(".content-main").height()+50);
		} else {
			top =0;
		}
		$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
	});
	$.getScript('http%3A%2F%2Fs13.cnzz.com%2Fstat.php%3Fid%3D1998411%26web_id%3D1998411');
	$.get('index.php?act=announcement', function(s){
		$('body').append(s);
		if(cookie.get("we7_tips") == "0") {
			$("#we7_tips").hide();
		}
	});
	var mouseScroll = function(e, ui){
		console.dir(e);
		var step = parseInt(e.deltaY);
		if(step > 0) {
			postion = $(".sidebar-nav").position().top;
			if(postion > 0 || postion==0) {
				top = 0;
			} else {
				top = postion+121*step;
				if(top > 0) top = 0;
			}

			$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
		} else {
			postion = $(".sidebar-nav").position().top;
			if(postion < 0 || postion==0) {
				top = postion+121*step;
				if(top< -($(".sidebar-nav").height()-$(".content-main").height()+50)) top = -($(".sidebar-nav").height()-$(".content-main").height()+50);
			} else {
				top =0;
			}
			$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
		}
	};
	$('.sidebar-nav').parent().mousewheel(mouseScroll);
});
$(window).resize(function(){
	//调整框架宽高 兼容ie8
	$(".content-main, .content-main table td").height($(window).height()-40);
	$("#main").width($(window).width()-200);
});
</script>
