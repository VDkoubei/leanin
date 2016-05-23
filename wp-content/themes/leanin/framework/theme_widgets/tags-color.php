<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_tags_color_widget' );

/* Function that registers our widget. */
function kriesi_tags_color_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_tags_color_widget' );
}

class Kriesi_tags_color_widget extends WP_Widget {
	function Kriesi_tags_color_widget() 
	{
		$widget_ops = array('classname' => 'tags-color', 
							'description' => '颜色请在base_funs.php中设置');
		
		$this->WP_Widget( 'tags_color', THEMENAME.'/彩色标签云', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option,$wpdb;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$limit = strip_tags($instance['limit']);
		$smallest = strip_tags($instance['smallest']);
		$largest = strip_tags($instance['largest']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
		echo '<div>';

		wp_tag_cloud('smallest='.$smallest.'&largest='.$largest .'&unit=px&number='.$limit.'&orderby=count&order=RAND');

		echo "</div>";
		echo $after_widget;
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['limit'] = strip_tags($new_instance['limit']);
         $instance['smallest'] = strip_tags($new_instance['smallest']);
		 $instance['largest'] = strip_tags($new_instance['largest']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '标签云集',  'limit' => '', 'smallest' => '12','largest'=>"16"));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
		 $smallest = strip_tags($instance['smallest']);
		 $largest = strip_tags($instance['largest']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
		 <p>
             <label for="<?php echo $this->get_field_id('smallest'); ?>">最小字体：<input class="widefat" id="<?php echo $this->get_field_id('smallest'); ?>" name="<?php echo $this->get_field_name('smallest'); ?>" type="text" value="<?php echo $smallest; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('largest'); ?>">最大字体：<input class="widefat" id="<?php echo $this->get_field_id('largest'); ?>" name="<?php echo $this->get_field_name('largest'); ?>" type="text" value="<?php echo $largest; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
	}
}

