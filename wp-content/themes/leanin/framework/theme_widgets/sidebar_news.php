<?php
/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_sidebar_news_widget' );

/* Function that registers our widget. */
function kriesi_sidebar_news_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_sidebar_news_Widget' );
}

class Kriesi_sidebar_news_Widget extends WP_Widget {
	function Kriesi_sidebar_news_Widget() 
	{
		$widget_ops = array('classname' => 'community_news',
							'description' => '一个用以在侧边栏中展示新闻的小工具(A Sidebar widget to display posts in your sidebar)'
							);
		
		$this->WP_Widget( 'community_news', THEMENAME.'/侧边栏新闻', $widget_ops );
	}
 	//在前台页面显示的东西，
	function widget($args, $instance) 
	{	
		global $h_option;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '' : apply_filters('widget_entry_title', $instance['count']);
		$cat = empty($instance['cat']) ? '' : apply_filters('widget_comments_title', $instance['cat']);
		$cat_scrolling_if = empty($instance['cat_scrolling_if']) ? '' : apply_filters('widget_comments_title', $instance['cat_scrolling_if']);
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		if ( $cat_scrolling_if == "1" ) {
			echo "<ul id='cat-scrolling'>";
		}else{
			echo "<ul>";
		}
		$args = array(
    // 以下代码中的title就是orderby的值，按标题排序
    //'orderby'   => title,、
    'ignore_sticky_posts' => 1,
    'category__in'=> $cat,
    'showposts' => $count
);
query_posts($args);
		if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); 
				h_get_li_no_cat(10);
				
			  endwhile; endif;
		echo "</ul>";
		echo $after_widget;
		wp_reset_query();
		
	}
 
 	//更新数据
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['cat_scrolling_if'] = strip_tags($new_instance['cat_scrolling_if']);
		return $instance;
	}

 
 	//小工具的表单
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '最新新闻', 'count' => '10', 'cat' => '' ,"cat_scrolling_if"=> '' ) );
		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);
		$cat = strip_tags($instance['cat']);
		$cat_scrolling_if = strip_tags($instance['cat_scrolling_if']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>">要展示的文章数量
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo attribute_escape($count); ?>" /></label></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">输入相关分类的id，用英文的逗号隔:
				<input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo attribute_escape($cat); ?>" />
			</label>
		</p>
		<p>
             <label for="<?php echo $this->get_field_id('cat_scrolling_if'); ?>">是否滚动：
             	<select name="<?php echo $this->get_field_name('cat_scrolling_if'); ?>" id="<?php echo $this->get_field_id('cat_scrolling_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $cat_scrolling_if); ?>>否</option>
					<option value="1"<?php selected('1', $cat_scrolling_if); ?>>是</option>
				</select>
             </label>
         </p>

         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />

<?php
	}
}
