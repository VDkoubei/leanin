function themeurl(){
	var i=0,got=-1,url,len=document.getElementsByTagName('link').length;
	while(i<=len && got==-1){
		url=document.getElementsByTagName('link')[i].href;
		got=url.indexOf('/style.css');
		i++;
	};
	var re= /(\S+)\/style.css(\S+)/;

	return url.replace(re,"$1");
};
/*=复制粘贴
---------------------------------------------------------------------*/
function copy_code(text) {
  if (window.clipboardData) {
    window.clipboardData.setData("Text", text);
	alert("已经成功复制到剪贴板！");
  } else {
	var x=prompt('你的浏览器可能不能正常复制\n请你手动进行：',text);
  };
  //return false;
};


jQuery(document).ready(function($) {
/*=图片延迟加载
---------------------------------------------------*/
var $lazyload = jQuery("article img,.single-cats-li img, .category-cats-li img, .tag-tags-li img,.thumb-little img").not(".watarfall  img");
 $lazyload.lazyload({
		placeholder:themeurl()+"/images/image-pending.gif",
		effect:"fadeIn"
});
 //图片透明度变淡
 $lazyload.hover(function() {
		jQuery(this).fadeTo("fast", 0.8);
	},function() {
		jQuery(this).fadeTo("fast", 1);
});
//--------------------------------------------------------------

/*=关注我们
--------------------------------------------------------------*/
$("li#text").click(function(){
	alert("这个真的没有！请点击右侧的小按钮关注我们^_^");
});
//--------------------------------------------------------------

/*=幻灯片
--------------------------------------------------------------*/
var $wind = $(window);//将浏览器加入缓存中
var winWidth = $wind.outerWidth();//首先获取浏览器的宽度
function slideShowCode($select,$classes, $auto ) {
	jQuery($select).KandyTabs({
			classes:  $classes,
			action:"fade",
			stall:8000,
			//stall:800,
			type:"slide",
			//last:600,
			last:1600,
			auto: $auto,
			process:true,
			resize:true
		});
};

slideShowResize();
function slideShowResize(){
	var $winWidthNew = $(window).outerWidth();//将浏览器加入缓存中
	//var winWidth = $wind.outerWidth()//首先获取浏览器的宽度
	if ($winWidthNew>= 600) { //大于600自动
		if($("#slide_con").size() !=0 ) slideShowCode("#slide_con" , "home-slide", true);/*=幻灯片*/
		if($(".imglist_wrap-1").size() !=0 ) slideShowCode(".imglist_wrap-1","imglist_wrap-1", true);/*=文章页图库*/
	}else{
		if($("#slide_con").size() !=0 ) slideShowCode("#slide_con" , "home-slide", false);/*=幻灯片*/
		if($(".imglist_wrap-1").size() !=0 ) slideShowCode(".imglist_wrap-1","imglist_wrap-1", false);/*=文章页图库*/
	};	
};

//开始调整幻灯片
// $wind.resize(function() {
// 	slideShowResize()
// });
//--------------------------------------------------------------
 
/*=侧边栏
---------------------------------------------------*/
	$(".three-tabs").KandyTabs({btn: "h3",cont: "ul", trigger:"mouseover",action:"slide",process:true,current:1});
	$(".single-cats-tabs").KandyTabs({type: "fold", trigger:"click", action:"slide",process:true,current:1});
	$(".users-list-section").KandyTabs({type: "fold", trigger:"click", action:"slide",process:true,current:1});
	$(".category-cats-tabs").KandyTabs({type: "fold", trigger:"click", action:"slide",process:true,current:1});
//--------------------------------------------------------------

/*=文章标题
-----------------------------------------------------*/
	$('.entry-title a').click(function(){
		$(this).text('稍等下，我正在很用力地加载文章...');
	});
//--------------------------------------------------------------

/*=cms分栏
-----------------------------------------------------*/
var $wind = $(window);//将浏览器加入缓存中
var winWidth = $wind.outerWidth();//首先获取浏览器的宽度
if (winWidth>=960 ||    ( $.browser.msie && ( $.browser.version==6.0 || $.browser.version==7.0 || $.browser.version==8.0 ))     ) {
	if( $(".cms-column").size() != 0 ){

			var cms_column =$(".cms-column");//获取分栏
			var column_num=cms_column.size();//获取个数
			for (var i = 1; i <= cms_column.size(); i+=2) {
			
				 var _h=Math.max($(".cat-"+i).height(),$(".cat-"+(i+1)).height());
				 $(".cat-"+i).css({"height":_h+"px","padding-bottom":"14px"});
				 $(".cat-"+(i+1)).css({"height":_h+"px","padding-bottom":"14px"});

			};

		};
	};//960
////////////////////
if( !($.browser.msie && ( $.browser.version==6.0 || $.browser.version==7.0 || $.browser.version==8.0 ))){
	//浏览器宽高改变
	$wind.resize(function() {

		var winWidthNew = $wind.width();//首先获取浏览器的宽度
		if (winWidthNew>=960) {
			if( $(".cms-column").size() != 0 ){

				var cms_column =$(".cms-column");//获取分栏
				var column_num=cms_column.size();//获取个数
					
				for (var i = 1; i <= cms_column.size(); i+=2) {
					
					 var _h=Math.max($(".cat-"+i).height(),$(".cat-"+(i+1)).height());
					 $(".cat-"+i).css({"height":_h+"px","padding-bottom":"14px"});
					 $(".cat-"+(i+1)).css({"height":_h+"px","padding-bottom":"14px"});
				};

			};

		}else{
			if( $(".cms-column").size() != 0 ){

				var cms_column =$(".cms-column");//获取分栏
				var column_num=cms_column.size();//获取个数
					
				for (var i = 1; i <= cms_column.size(); i++) {
					  $(".cat-"+i).css({"height":"auto"});
				};//for

			};//cms-column
		};//浏览器宽度
	});

 };

// //只能浮动
// /**
//  * [smartFloat description]
//  * @param  {[type]} stopDiv= null          相对于那个div停止浮动
//  * @return {[type]}          [description]
//  */
// $.fn.smartFloat = function(stopDiv= null) {

// 	var stopDivTop=stopDiv ? stopDiv.position().top : 10000;

// 	var position = function(element) {
// 		var top = element.position().top, pos = element.css("position");
		
// 		$(window).scroll(function() {
// 			var scrolls = $(this).scrollTop();//获取滚动条已经滚动的长度

// 			//当滚动的长度大于div位置的top是
// 			if (scrolls > top && scrolls < stopDivTop) {
// 				if (window.XMLHttpRequest) { //不知是否是判断ie？
// 					element.css({
// 						position: "fixed",
// 						top: 0
// 					});	
// 				} else {
// 					element.css({
// 						top: scrolls
// 					});	
// 				}
// 			}else {
// 				element.css({
// 					position: pos,
// 					top: top
// 				});	
// 			}
// 		});
// 	};

// 	return $(this).each(function() {
// 		position($(this));						 
// 	});
// };
/*//更改##share_toolbar的position
if(winWidth <=960){
	$("#share_toolbar").css({"position":"static","width":"100%"});

} 
//绑定更改位置
if( $("#share_toolbar").size() != 0 && winWidth >960  ) {
	$("#share_toolbar").smartFloat($(".entry-meta"));
	$(".entry-content").css({'margin-top':"30px"});
}
*/

/*---------------------------------------------------*/
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

/*=IE6下拉菜单
---------------------------------------------------------------*/
//var IE6=window.ActiveXObject&&!window.XMLHttpRequest;
 //if( IE6 ){
if($.browser.msie && ( $.browser.version==6.0) && !$.support.style ){
 	$(".main-navigation li").hover(function () {
 		$(this).children('ul').css({"border-left":0, "display":"block"});
 		// body...
 	},function(){
		$(this).children('ul').css({ "display":"none"});
	});
 };
 //--------------------------------------------------------------

 /*=返回顶部
---------------------------------------------------------------*/
var goToTopButton = "<div id='go-top' class='go-top' style='display: none;float: right;position:fixed; _position: absolute;'><a title='回到顶部'>回到顶部</a></div>";//定义一个变量，方便后面加入在html元素标签中插入这个goToTop按钮的标签
$("body").append(goToTopButton);

var av_height = $(window).height();
var av_width = $(window).width();
var go_top= $("#go-top");
var Gotop_w = go_top.width()+2;
var Gotop_h = go_top.height()+2;
var doc_width = 960;
var Gotop_x = (av_width>doc_width?0.5*av_width+0.5*doc_width:av_width-Gotop_w);
var Gotop_y = av_height-Gotop_h;
var ie6Hack = "<style>.go-top{position:absolute; top:expression(documentElement.scrollTop+documentElement.clientHeight - this.offsetHeight-40);</style>}";
if ($.browser.msie && ($.browser.version == "6.0" || $.browser.version == "7.0" )){
	$("body").append(ie6Hack);
};
function setGotop(){
av_height = $(window).height();
av_width = $(window).width();
Gotop_y = av_height-Gotop_h-40;
Gotop_x = (av_width>doc_width?0.5*av_width+0.5*doc_width:av_width-Gotop_w);
	if($(window).scrollTop()>0){
		go_top.fadeIn(200);
	}else{
		go_top.fadeOut(200);
	};

	if ($.browser.msie && ($.browser.version == "6.0" || $.browser.version == "7.0")){
		//alert(333);
		go_top.animate({"left":Gotop_x},0);
	return false;
	};
	go_top.animate({"left":Gotop_x,"top":Gotop_y},0);
};

setGotop();
$(window).resize(function(){
	setGotop();
});
$(window).scroll(function(){
	setGotop();
});
go_top.click(function(){
	$("html , body").animate({scrollTop:"0"},300);
});

 //--------------------------------------------------------------
/*=ColorBox
-----------------------------------------------------------------------*/
$("a[rel='colorbox']").colorbox({title:" ",slideshow:true,slideshowAuto:false,previous:"上一张",next:"下一张",close:"关闭",slideshowStart:"播放",slideshowStop:"暂停",current:"第 {current} 张 (共{total}张)"});
$("a").has("img.attachment-thumbnail").colorbox({title:" ",slideshow:true,slideshowAuto:false,previous:"上一张",next:"下一张",close:"关闭",slideshowStart:"播放",slideshowStop:"暂停",current:"第 {current} 张 (共{total}张)"});
$(".example6").colorbox({width:"720", height:"600", iframe:true,slideshowStart:''});
$(".site-mobile-style-url").colorbox({width:"480", height:"600", iframe:true,slideshowStart:''});
$(".waterwall-box").colorbox({width:"720", height:"600", iframe:true,slideshowStart:''});
 //--------------------------------------------------------------

/*=视频墙
-----------------------------------------------------------------------*/
var $container = $('.watarfall');
if ($container.size()!=0 ) {
	$container.imagesLoaded( function(){
	  $container.masonry({
		itemSelector : '.watarfall article'
	  });
	});//视频墙结束
};
//--------------------------------------------------------------

/*=全部文章
-----------------------------------------------------------------------*/
function setsplicon(c, d) {
	if (c.html()=='+' || d=='+') {
		c.html('-');
		c.removeClass('car-plus');
		c.addClass('car-minus');
	} else if( !d || d=='-'){
		c.html('+');
		c.removeClass('car-minus');
		c.addClass('car-plus');
	};
};
//////////////////
$('.car-collapse').find('.car-yearmonth').click(function() {
	$(this).next('ul').slideToggle('fast');
	setsplicon($(this).find('.car-toggle-icon'));
});
$('.car-collapse').find('.car-toggler').click(function() {
if ( '展开所有月份' == $(this).text() ) {
	$(this).parent('.car-container').find('.car-monthlisting').show();
	$(this).text('折叠所有月份');
   setsplicon($('.car-collapse').find('.car-toggle-icon'), '+');
} else {
	$(this).parent('.car-container').find('.car-monthlisting').hide();
	$(this).text('展开所有月份');
	setsplicon($('.car-collapse').find('.car-toggle-icon'), '-');
};
return false;
});
//--------------------------------------------------------------

/*=提示
-----------------------------------------------------------------------*/

 var sweetTitles = {
 x : 10, // @Number: x pixel value of current cursor position
 y : 20, // @Number: y pixel value of current cursor position
 tipElements : ".community_news a,.cms-column a, .go-top a", // @Array: Allowable elements that can have the toolTip,split with ","
 noTitle : true, //if this value is false,when the elements has no title,it will not be show
 init : function() {
 	var noTitle = this.noTitle;
 $(this.tipElements).each(function(){
 $(this).mouseover(function(e){
	 if(noTitle){
	 	isTitle = true;
	 }else{
	 	isTitle = $.trim(this.title) != '';
	 }
	 if(isTitle){
		 this.myTitle = this.title;
		 this.title = "";
		 var tooltip = "<div id='tooltip'><p>"+this.myTitle+"</p></div>";
		 $('body').append(tooltip);
		 $('#tooltip')
		 .css({
		 "top" :( e.pageY+20)+"px",
		 "left" :( e.pageX+10)+"px"
		 }).show('fast');
	 }
 }).mouseout(function(){
	 if(this.myTitle != null){
	 this.title = this.myTitle;
	 $('#tooltip').remove();
 	}
 }).mousemove(function(e){
 $('#tooltip')
	 .css({
	 "top" :( e.pageY+20)+"px",
	 "left" :( e.pageX+10)+"px"
	 	});
 });
 });
 }
 };
 $(function(){
 sweetTitles.init();
 });

//--------------------------------------------------------------
/////////////////////////////////////////
});



/*=评论
---------------------------------------------------*/
//<![CDATA[
var changeMsg = "[ 更改 ]";
var closeMsg = "[ 隐藏 ]";
function toggleCommentAuthorInfo() {
	jQuery('#comment-author-info').slideToggle('slow', function(){
		if ( jQuery('#comment-author-info').css('display') == 'none' ) {
			jQuery('#toggle-comment-author-info').text(changeMsg);
		} else {
			jQuery('#toggle-comment-author-info').text(closeMsg);
		};
	});
};
jQuery(document).ready(function($){

	if ($("#toggle-comment-author-info").size() != 0 ) {
		$('#comment-author-info').hide();
	};
	//Textarea 当鼠标聚焦
	var comment = $('#comment');
	if(comment.val()==""){
		comment.val('留言是种美德，写点什么...').css({color:"#666"});
	}
	comment.focus(function() {
		if($(this).val() == '留言是种美德，写点什么...') {
			$(this).val('').css({color:"#222"});
		}
	}).blur(function(){// 当鼠标失去焦点
		if($(this).val() == '') {
			$(this).val('留言是种美德，写点什么...').css({color:"#666"});
		}
	});

/////////////////////////////
});

jQuery(document).keypress(function(e){
	if(e.ctrlKey && e.which == 13 || e.which == 10) { 
		jQuery(".submit").click();
		document.body.focus();
	} else if (e.shiftKey && e.which==13 || e.which == 10) {
		jQuery(".submit").click();
	};          
});


// ]]>

			