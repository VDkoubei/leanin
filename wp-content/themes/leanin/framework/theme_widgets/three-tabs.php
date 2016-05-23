<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_three_tabs_widget' );

/* Function that registers our widget. */
function kriesi_three_tabs_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_three_tabs_widget' );
}

class Kriesi_three_tabs_widget extends WP_Widget {
	function Kriesi_three_tabs_widget() 
	{
		$widget_ops = array('classname' => 'three-tabs', 
							'description' => 'tab三栏文章，若未使用wp-postviews插件，则第一个tab调用最新文章');
		
		$this->WP_Widget( 'three_tabs', THEMENAME.'/tab三栏', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option,$wpdb;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title1 = empty($instance['title1']) ? '' : apply_filters('widget_title', $instance['title1']);
		$title2 = empty($instance['title2']) ? '' : apply_filters('widget_title', $instance['title2']);
		$title3 = empty($instance['title3']) ? '' : apply_filters('widget_title', $instance['title3']);
		$new_or_view = strip_tags($instance['new_or_view']);
		$limit = strip_tags($instance['limit']);
//title
if (!empty( $title1) && !empty( $title2) && !empty( $title3) ) {
	echo '<header class="tabtitle">';
	if ( !empty( $title1 ) ) echo $before_title . $title1 . $after_title; 
	if ( !empty( $title2 ) ) echo $before_title . $title2 . $after_title;
	if ( !empty( $title3 ) )echo $before_title . $title3 . $after_title; 
	echo '</header><!-- /header -->';
}
		
//cont
		if ( !empty( $title1 ) ) { 
			
			echo '<ul>';
			if ($new_or_view == 1) {
				if (function_exists("get_most_viewed")) {
					# code...
			 	get_most_viewed('post', $limit, 0, true, false); 
				}
			 } else{
			 	$myposts = get_posts('numberposts='.$limit.'&offset=0');
				foreach($myposts as $post) :?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,36); ?></a></li>
				<?php endforeach;
			 }
			echo '</ul>';
		}
		if ( !empty( $title2 ) ) { 
			echo '<ul>';
			simple_get_most_viewed($limit, 90);
			echo '</ul>';
		}
		if ( !empty( $title3 ) ) { 
			echo '<ul>';
			$myposts = get_posts('numberposts='.$limit.'&orderby=rand');foreach($myposts as $post) :?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,36); ?></a></li>
					<?php endforeach; 
			echo '</ul>';
		}
		
		echo $after_widget;
		
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title1'] = strip_tags($new_instance['title1']);
         $instance['title2'] = strip_tags($new_instance['title2']);
         $instance['title3'] = strip_tags($new_instance['title3']);
         $instance['new_or_view'] = strip_tags($new_instance['new_or_view']);
         $instance['limit'] = strip_tags($new_instance['limit']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title1'=> '最新文章','title2'=> '热评文章', 'title3'=> '随机文章',  'new_or_view' => '0',  'limit' => '10'));
         $title1 = esc_attr($instance['title1']);
         $title2 = esc_attr($instance['title2']);
         $title3 = esc_attr($instance['title3']);
         $new_or_view = strip_tags($instance['new_or_view']);
         $limit = strip_tags($instance['limit']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title1'); ?>">最新/最热-标题：<input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo $title1; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('title2'); ?>">热评文章-标题：<input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo $title2; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('title3'); ?>">随机文章-标题：<input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo $title3; ?>" /></label>
         </p>
          <p>
             <label for="<?php echo $this->get_field_id('new_or_view'); ?>">最新/热门-显示：
             	<select name="<?php echo $this->get_field_name('new_or_view'); ?>" id="<?php echo $this->get_field_id('new_or_view'); ?>" class="widefat">
					<option value="0"<?php selected('0', $new_or_view); ?>>最新文章</option>
					<option value="1"<?php selected('1', $new_or_view); ?>>最热文章</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
	}
}

