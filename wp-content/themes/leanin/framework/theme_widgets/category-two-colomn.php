<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_cat_two_colomn_widget' );

/* Function that registers our widget. */
function kriesi_cat_two_colomn_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_cat_two_colomn_widget' );
}

class Kriesi_cat_two_colomn_widget extends WP_Widget {
	function Kriesi_cat_two_colomn_widget() 
	{
		$widget_ops = array('classname' => 'cat_two_colomn', 
							'description' => '双栏的分类目录，不显示子分类目录');
		
		$this->WP_Widget( 'cat_two_colomn', THEMENAME.'/分类目录', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$modCats = "";
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$limit = strip_tags($instance['limit']);
		$orderby = strip_tags($instance['orderby']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		if($h_option['showSidebar'] == 'frontpage' || $h_option['showSidebar'] == 'gallery')
		{
			$modCats = "&include=".$h_option['gallery']['gallery_cat_final'];
		}
		else if ($h_option['showSidebar'] == 'blog')
		{
			$modCats = "&exclude=".$h_option['gallery']['gallery_cat_final'];
		}
		
		echo '<ul class="cate2row cf">';
		wp_list_categories( array(
								'style' => 'list',
								'show_count' => $limit,
								'hide_empty' => 1,
								'hierarchical' => false,
								'title_li' => '',
								'orderby' => $orderby,
								'order' => 'ASC',
								'echo' => 1
								)
							);
		echo "</ul>";
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
		 $instance['orderby'] = strip_tags($new_instance['orderby']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '两栏分类目录', 'limit' => '12', 'orderby' => 'name'));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
		 $orderby = strip_tags($instance['orderby']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
		 <p>
             <label for="<?php echo $this->get_field_id('orderby'); ?>">排序：<br>● 使用普通排序，输入“name”<input class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" type="text" value="<?php echo $orderby; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
	}
}

