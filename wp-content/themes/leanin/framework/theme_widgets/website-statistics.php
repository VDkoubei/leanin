<?php
/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'Kriesi_website_statistics_widget' );

/* Function that registers our widget. */
function Kriesi_website_statistics_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_website_statistics_widget' );
}

class Kriesi_website_statistics_widget extends WP_Widget {
	function Kriesi_website_statistics_widget() 
	{
		$widget_ops = array('classname' => 'website-statistics', 
							'description' => '统计网站的所有大信息');
		
		$this->WP_Widget( 'website_statistics', THEMENAME.'/博客统计', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$modCats = "";
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$builddate = strip_tags($instance['builddate']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		global $wpdb
?>
			   <ul>
			<li>日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
			<li>评论总数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments where comment_author!='".(get_option('swt_user'))."'");?> 个</li>
			<li>标签数量：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
			<li>链接总数：<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> 个</li>
			<?php if ( !empty( $builddate ) ) {  ?>
			<li>建站日期：<?php echo $builddate ?></li>
			<li>运行天数：<?php echo floor((time()-strtotime($builddate))/86400); ?> 天</li>
			<?php } ?>
			<li>最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></li>
			   </ul>
	<?php  
		echo $after_widget;
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['builddate'] = strip_tags($new_instance['builddate']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '博客统计', 'builddate' => '2013-2-12' ) );
		$title = strip_tags($instance['title']);
		$builddate = strip_tags($instance['builddate']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题/Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('builddate'); ?>">建站日期: 
		<input class="widefat" id="<?php echo $this->get_field_id('builddate'); ?>" name="<?php echo $this->get_field_name('builddate'); ?>" type="text" value="<?php echo attribute_escape($builddate); ?>" /></label></p>
		
		
			
<?php
	}
}
