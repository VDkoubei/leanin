<?php


/**
 * 部分会被体现到<head>中
 * Sets up theme defaults and registers the various WordPress features that
 * leanin supports.
 * 创建主题的默认值和注册各种2012主题支持的WordPress的功能
 *
 * @uses load_theme_textdomain() For translation/localization support. 增加主题翻译/定位支持
 * @uses add_editor_style() To add a Visual Editor stylesheet. 增加一个编辑器样式？？
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,增加对缩略图，自动feed地址的支持
 * 	custom background, and post formats.自定义背景，文章格式
 * @uses register_nav_menu() To add support for navigation menus. 创建一个Primary Menu菜单
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size. 设定缩略图的大小
 *
 * @since leanin 1.0
 */
function leanin_setup() {
	/*
	 * Makes leanin available for translation.确保2012主题可以支持翻译
	 *
	 * Translations can be added to the /languages/ directory.翻译引用来自/languages/的文件夹
	 * If you're building a theme based on leanin, use a find and replace
	 * to change 'leanin' to the name of your theme in all the template files.
	 * 如果你创建一个主题，请你在所有的主题文件中找到leanin并听话成你自己的主题名
	 */
	load_theme_textdomain( 'leanin', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	// 主题的样式将匹配前台文章的样式
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.为文章和评论增加RSS地址到<head>中
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.增加一系列的文章格式
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ));

	//增加链接功能
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );  
	//去掉adminbar
	add_filter( 'show_admin_bar', '__return_false' );
	//后台菜单
	register_nav_menus( array(
			'primary' => '基本菜单',
			'footer' => '底部菜单'
	    ));




	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	// 这个为标准文章格式的文章增加主题支持和设定特色图片大小，这里的宽度限制为624，高度随意
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 9999 ); // Unlimited height, soft crop
	//缩略图功能
	// post thumbnail support      
	if ( function_exists( 'add_image_size' ) ){
		add_image_size( 'big_show', 1000, 628,true);//缩略图尺寸为640*480
		add_image_size( 'show', 449, 282,true);//缩略图尺寸为320*240
		add_image_size( 'thumbnails', 285, 179, true );//缩略图尺寸为160*120
	}

}
add_action( 'after_setup_theme', 'leanin_setup' );



/**
 * Enqueues scripts and styles for front-end. 
 * 将scripts 和 styles加到<head>中，wp_enqueue_script在heade.php的wp_head函数中
 * @since leanin 1.0
 */
function leanin_scripts_styles() {
	global $wp_styles,$h_option;

	/*
	 * 为了支持站点进行层叠式评论，增加JavaScript到带有评论表单的页面中，
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 * 增加导航菜单的显示与隐藏行为。
	 */
	//wp_enqueue_script( 'leanin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.导入特定的字体
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 * 默认使用的开源字体Sans将被定位，对于不支持改字体的语言，字体将不被使用
	 * To disable in a child theme, use wp_dequeue_style()为了将该功能变成不可用，请使用wp_dequeue_style()函数
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'leanin-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language.
		翻译：如果你的语言不支持开源字体Sans，这里将被设定成off。不要翻译成你自己的语言
	    */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'leanin' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		   为了增加开源字体Sans特定子集到你自己的语言，请翻译这个到'greek', 'cyrillic' or 'vietnamese'，以下函数不能自己翻译。 */
		
		//判断你自己的语言支持哪种字体
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'leanin' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		//增加字体支持。
		//wp_enqueue_style( 'leanin-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.获取你的主题style.css，自动写出版本
	 */
	wp_enqueue_style( 'leanin-style', get_stylesheet_uri() );
	//wp_enqueue_style( 'leanin-media', get_template_directory_uri() . '/css/media.css' );
	wp_enqueue_style( 'leanin-Genericons', get_template_directory_uri() . '/genericons/genericons.css' );

	if ($h_option["general"]["ColorBox"]) {
		wp_enqueue_style( 'leanin-colorbox', get_template_directory_uri() . '/js/colorbox/colorbox.css',array( 'leanin-style' ), '1.4.1' );
	};
	/*
	 * Loads the Internet Explorer specific stylesheet.
	 * 获取Internet Explorer特定的样式表，专为低版本IE浏览器写出的html5.js
	 */
	wp_enqueue_style( 'leanin-ie', get_template_directory_uri() . '/css/ie.css', array( 'leanin-style' ), '20121010' );
	//wp_enqueue_style( 'leanin-ie', get_template_directory_uri() . '/css/ie.css', array( 'leanin-style' ), null );
	$wp_styles->add_data( 'leanin-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'leanin_scripts_styles' );

/**
 * 创建一个格式美观、更加实用的<!-- <title> -->,这基于你所在的页面
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since leanin 1.0
 *
 * @param string $title Default title text for current view.目前页面的默认标题
 * @param string $sep Optional separator.选择性分割器，如"-"
 * @return string Filtered title.
 */
function leanin_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.必要情况下增加页码
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'leanin' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'leanin_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 * 为wp_nav_menu增加fallback，展示一个首页链接
 *
 * @since leanin 1.0
 */
function leanin_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'leanin_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 * 城建我们自己的小工具和前端显示样式
 * 
 * @since leanin 1.0
 */
function leanin_widgets_init() {
	global $h_option;
	if ( function_exists('register_sidebar') ){	

				//注册三个小工具集合面板
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'leanin' ),
			'id' => 'sidebar-1',
			'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Article Slideshow Sidebar', 'leanin' ),
			'id' => 'sidebar-slideshow',
			'description' => __( 'Appears when displaying article slideshow', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Category Sidebar', 'leanin' ),
			'id' => 'sidebar-category',
			'description' => __( 'Appears in category', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Tag Sidebar', 'leanin' ),
			'id' => 'sidebar-tag',
			'description' => __( 'Appears in category', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Single Sidebar', 'leanin' ),
			'id' => 'sidebar-single',
			'description' => __( 'Appears in single', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Page Sidebar', 'leanin' ),
			'id' => 'sidebar-page',
			'description' => __( 'Appears in page', 'leanin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
			

		
		//注册某些页面显示不同的侧边栏
		$dynamic_widgets = explode(',',$h_option['includes']['multi_widget_final']);
		foreach ($dynamic_widgets as $page_name){	
			
				if($page_name != "")
					register_sidebar(array(
										'name' =>sprintf(__('Page: %1$s'),get_the_title($page_name) ) ,
										'description' => sprintf(__('Set one sidebar for %1$s'),get_the_title($page_name) ),
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget' => '</aside>',
										'before_title' => '<h3 class="widget-title">',
										'after_title' => '</h3>',
										)
									);
			
		}
		
		//注册某些分类页面显示不同的侧边栏
		$dynamic_widgets_cat = explode(',',$h_option['includes']['multi_widget_cat_final']);
		foreach ($dynamic_widgets_cat as $the_cat){
			
				$the_cat_name = get_cat_name($the_cat);

				if($the_cat_name != "")
					register_sidebar(array(
										'name' =>sprintf(__('Category: %1$s'),$the_cat_name ),
										'description' => sprintf(__('Set one sidebar for %1$s'),$the_cat_name ),
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget' => '</aside>',
										'before_title' => '<h3 class="widget-title">',
										'after_title' => '</h3>',
										)
								);
			
		}//end foreach
	}//end if

}
add_action( 'widgets_init', 'leanin_widgets_init' );




/**
 * Extends the default WordPress body class to denote:扩充默认的WordPress body class
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 *    当在侧边栏中没激活任何小工具或者在full-width模板中，将使用全宽度布局
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 *    Front Page 模板:缩略图可用且在小工具区域有一定数量的小工具
 * 3. White or empty background color to change the layout and spacing.
 * 	  白色或者空余背景色，为改变层和空间的
 * 4. Custom fonts enabled.自定义字体可用
 * 5. Single or multiple authors.单独或者作者。
 *
 * @since leanin 1.0
 *
 * @param array Existing class values.已存在的class值
 * @return array Filtered class values.过滤后的class值
 */
function leanin_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' )|| is_page_template( 'page-templates/page-multi.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	// 如果字体css被登入可用，将自定义字体class设为可用
	if ( wp_style_is( 'leanin-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'leanin_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 * 调整内容的宽度为了全宽度和文章页图片附件模板，或者在侧边栏中没有小工具
 * 
 * @since leanin 1.0
 */

function leanin_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ||  is_page_template( 'page-templates/page-multi.php' )) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'leanin_content_width' );



/* =自定义主题框架的开始
--------------------------------------------------------------------------------------*/
global $h_option;
##################################################################
# Get Theme informations and save them to PHP Constants
# 获取主题信息,并且保存到php常量中
##################################################################
$the_theme = get_theme_data(TEMPLATEPATH . '/style.css');
$the_version = trim($the_theme['Version']);
if(!$the_version) $the_version = "1";

//set theme constants
define('THEMENAME', $the_theme['Title']);
define('THEMEVERSION', $the_version);

// set Path constants
// 获取路径的常量 并且设置出 相关的参数
define('KFW', TEMPLATEPATH . '/framework/'); // 'K'riesi 'F'rame 'W'ork;
define('KFWOPTIONS', 	TEMPLATEPATH . '/theme_options/'); 
define('KFWHELPER', 	KFW . 'helper_functions/'); 
define('KFWCLASSES', 	KFW . 'classes/'); 
define('KFWPLUGINS', 	KFW . 'theme_plugins/');
define('KFWWIDGETS', 	KFW . 'theme_widgets/'); 
define('KFWINC', 		KFW . 'includes/'); 
define('KFWSC', 		KFW . 'shortcodes/'); 

// set URI constants
// 设置URI变量
define('KFW_URI', get_bloginfo('template_url') . '/framework/'); // 'K'riesi 'F'rame 'W'ork;
define('KFWOPTIONS_URI', 	get_bloginfo('template_url') . '/theme_options/'); 
define('KFWHELPER_URI', 	KFW_URI . 'helper_functions/'); 
define('KFWCLASSES_URI', 	KFW_URI . 'classes/'); 
define('KFWPLUGINS_URI', 	KFW_URI . 'theme_plugins/'); 
define('KFWWIDGET_URI', 	KFW_URI . 'theme_widgets/'); 
define('KFWINC_URI', 		KFW_URI . 'includes/'); 
define('KFWINC_SC', 		KFW_URI . 'shortcodes/'); 


##################################################################
# this include calls a file that automatically includes all
# 这里包含着一个文件可以自动包含主题中其他功能性文件
# the files within the folder framework and therefore makes 
# 这些文件都包含在framework文件夹中
# all functions and classes available for later use
# 所有的功能性质的函数和类都可以留在后面的使用
##################################################################



$autoload['helper'] = array(
							'Mobile_Detect',	# helper functions that make my developer-life easier =)helper function让我的开发过程更加轻松
							'base-funs'//,	# helper functions that make my developer-life easier =)helper function让我的开发过程更加轻松
							//'shortcode'
							
							);

$autoload['plugins'] = array('kriesi_option_pages/kriesi_option_pages',		
							'kriesi_meta_box/kriesi_meta_box'
							);

$autoload['widgets'] = array(
							/*'advertising_widget_dual',这个地方是主题推荐，在“外观”中*/
							'sidebar_news',//侧边栏新闻
							// 'category-two-colomn',//两栏分类目录 
							//'special_category',//高级图库展示，忘记怎么用的
							'special_time',//提示时间。尚未配置
							// 'comments-new',//最新评论
							// 'comments-wallreaders',//读者墙
							// 'tags-color',//彩色标签云
							// 'website-statistics',//网站统计
							// 'three-tabs',//tab三栏
							// 'single-cats',//文章页分类
							// 'category-cats',//标签页分类
							// 'tag-cats',//标签页标签
							// 'users-cats-tags',//标签页标签
							// 'special_login'//登录
							/*'advertising_widget'，在小工具中添加广告空间*/
							);
//加载meta_box
$autoload['option_pages'] = array('meta_box');
/* = 判断管理员 非后台
-----------------------------------------------------------------------------*/
if( !is_admin() || current_user_can('level_10')){ 
	$autoload['option_pages'] = array(
									'options',
									'index_page',
									'page_post',
									'sidebar_footer',
									// 'users_cats_tags',
									'meta_box'
									
									 );
}
								 

include_once(KFW.'/include_framework.php');

/* = 获取文章所有图片
-----------------------------------------------------------------------------*/
 function all_img($soContent){
 $soImages = '~<img [^\>]*\ />~';
 preg_match_all( $soImages, $soContent, $thePics );
 $allPics = count($thePics[0]);
 $SoImgAddress="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
if( $allPics > 0 ){
    for($i=0;$i<$allPics;$i++){
    preg_match($SoImgAddress,$thePics[0][$i],$imagesurl);
 	// echo $thePics[0][$i];
 	echo "<a href='";
 	echo $imagesurl[1];
 	echo "' class='group1'></a>";
 	// echo $imagesurl[1];
 }
 }
 else {
 echo "<img src='";
 echo bloginfo('template_url');
 echo "/images/thumb.gif'>";
 }
 }

// if( $allPics > 0 ){
// foreach($thePics[0] as $v){
// echo $v;
// }

 // if( $allPics > 0 ){
 // for($i=0;$i<$allPics;$i++){
 // 	echo $thePics[0][$i];
 // }
 // }
// <?php
// //从文章中搜索图片并获取图片
// $SoImages  = ‘~<img [^\>]*\ />~’;
// preg_match_all($SoImages,$post->post_content,$Images);
// $PictureAmount=count($Images[0]);　//获取图片数量

// //处理所有的图片
// for($i=0;$i<$PictureAmount;$i++){
// echo $Images[0][$i]  //处理图片,语句可以自定义,第一张图片为$Images[0][0];
// }

// //通过使用switch控制语句处理第一张图片,也可以使用if…else…elseif语句来实现,具体逻辑请自定义
// switch($PictureAmount>0){
// case 1:
//   echo $Images[0][0];　//输出第一张图片
//   break;
// default:
//   $ImagesUrl=bloginfo(‘stylesheet_directory’).”/images/1.jpg”;　//当文章无图片时默认输出的图片
// }
// 
// id=”logo” src=”/intl/zh-CN/images/logo_cn.gif” width=”276″ height=”110″ border=”0″  />
// $ImgUrl = $Images[0][0];
// $SoImgAddress=”/\<img.*?src\=\”(.*?)\”[^>]*>/i”;  //正则表达式语句
// preg_match($SoImgAddress,$ImgUrl,$imagesurl);　　//分析
// echo $imagesurl[1];　//得到并处理路径:/intl/zh-CN/images/logo_cn.gif


/**
 * WordPress 后台禁用Google Open Sans字体，加速网站
 * http://www.wpdaxue.com/disable-google-fonts.html
 */
add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}

