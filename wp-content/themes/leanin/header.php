<?php


global $h_option;
$device_name = "";
if(h_get_device('tablet')) {
	$device_name = "pad";
} elseif (h_get_device('pc')) {
	$device_name = "pc";
}
//$video_data = get_video_data("http://v.youku.com/v_show/id_XMzA1MTI3MTMy.html?firsttime=78");
//print_r($video_data);
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Fresh_Sky
 * @since leanin 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html class="ie ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
<?php  include(TEMPLATEPATH . '/inc/seo.php'); ?>
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" /> 
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site  <?php echo $device_name ?>">
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="site-branding">
			<a class="site-home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<p class="site-description"><?php bloginfo('description') ?></p>
			</a>
			<buttton class="menu-toggle"><?php _e( 'Menu and widgets', 'leanin' ); ?></buttton>
			<!-- <div class="screen-reader-text">搜索：</div>
			<div class="site-search">
			  <?php get_search_form();?>
			</div> -->
		</div>
			


		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a class="assistive-text" href="#content" title="跳至内容区">跳至内容区</a>
			<div class="section-wrapper">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu clearfix' ) ); ?>				
			</div>
		</nav><!-- #site-navigation -->
		<?php include(TEMPLATEPATH . '/inc/breadcrumb.php'); ?>
	</header>

	<div id="main" class="wrapper clearfix">
		<div class="section-wrapper">