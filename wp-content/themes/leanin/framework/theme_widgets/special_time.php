<?php
/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'Kriesi_special_time_widget' );

/* Function that registers our widget. */
function Kriesi_special_time_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_special_time_widget' );
}

class Kriesi_special_time_widget extends WP_Widget {
	function Kriesi_special_time_widget() 
	{
		$widget_ops = array('classname' => 'special_time', 
							'description' => '时间提醒');
		
		$this->WP_Widget( 'special_time', THEMENAME.'/时间提醒', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$modCats = "";
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
?>
			<div class="info" >
				<p><?php $timezone_format = _x('Y年m月d日 G时i分s秒', 'timezone date format');  printf(__('Local time is %1$s'), date_i18n($timezone_format));?></p>
			</div>
	<?php  
		echo $after_widget;
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '现在时间' ) );
		$title = strip_tags($instance['title']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题/Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		
			
<?php
	}
}
