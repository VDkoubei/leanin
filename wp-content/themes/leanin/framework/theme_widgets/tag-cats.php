<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_tag_tags_widget' );

/* Function that registers our widget. */
function kriesi_tag_tags_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_tag_tags_widget' );
}

class Kriesi_tag_tags_widget extends WP_Widget {
	function Kriesi_tag_tags_widget() 
	{
		$widget_ops = array('classname' => 'tag-tags', 
							'description' => '标签页调取相关文章');
		
		$this->WP_Widget( 'tag_tags', THEMENAME.'/标签页标签', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option,$wpdb;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$new_or_view = strip_tags($instance['new_or_view']);
		$thumb_if = strip_tags($instance['thumb_if']);
		$thumb_num = 3;
		$limit = strip_tags($instance['limit']);
		

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		if ( !is_tag() ) echo "请在Tag Sidebar中使用这个小工具";

			$tag_name = single_tag_title('',false);//当前分类名
		$tag=get_term_by( 'name', $tag_name, 'post_tag' ); //用 get_term_by函数获取别名对应的标签数组	
		$tag_id = $tag->term_id;
		wp_reset_query();

			$args =  array();
			if ($new_or_view == 0) {

				$args = array(
					'tag__and' =>  array($tag_id),
					'ignore_sticky_posts' => 1,
					'showposts' => $limit
				);
			}else{
				$args = array(
					'tag__and' =>  array($tag_id),
					'ignore_sticky_posts' => 1,
					'meta_key' => 'views',
					'orderby' => 'meta_value_num', 
					'order' => 'DESC', 
					'showposts' => $limit
				);
			}


			query_posts($args);
			$i=0;
			echo "<ul>";
			while( have_posts() ) { the_post();$i++;
				if ($thumb_if==1 && $i <= $thumb_num ) {?>
					<li class="tag-tags-li">
						<a href="<?php the_permalink(); ?> " title="<?php the_title(); ?>" rel="nofollow"><?php leanin_get_thumb_image() ?></a>
						<span class="related-posts-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow"><?php echo cut_str(get_the_title(),8); ?></a></span>
					</li>
				<?php }else{?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str(get_the_title(),36); ?></a></li>
				<?php } ?>

			<?php 
			 }  wp_reset_query();	//结束单列
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
         $instance['new_or_view'] = strip_tags($new_instance['new_or_view']);
         $instance['thumb_if'] = strip_tags($new_instance['thumb_if']);
         $instance['limit'] = strip_tags($new_instance['limit']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '标签页标签', 'thumb_if' => '1', 'new_or_view' => '1',  'limit' => '8'));
         $title = esc_attr($instance['title']);
         $new_or_view = strip_tags($instance['new_or_view']);
         $thumb_if = strip_tags($instance['thumb_if']);
         $limit = strip_tags($instance['limit']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
          <p>
             <label for="<?php echo $this->get_field_id('new_or_view'); ?>">最新/热门：
             	<select name="<?php echo $this->get_field_name('new_or_view'); ?>" id="<?php echo $this->get_field_id('new_or_view'); ?>" class="widefat">
					<option value="0"<?php selected('0', $new_or_view); ?>>最新文章</option>
					<option value="1"<?php selected('1', $new_or_view); ?>>最热文章</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('thumb_if'); ?>">缩略图：
             	<select name="<?php echo $this->get_field_name('thumb_if'); ?>" id="<?php echo $this->get_field_id('thumb_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $thumb_if); ?>>隐藏</option>
					<option value="1"<?php selected('1', $thumb_if); ?>>显示</option>
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

