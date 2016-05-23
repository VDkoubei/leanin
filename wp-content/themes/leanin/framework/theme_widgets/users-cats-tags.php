<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_users_cats_tags_widget' );

/* Function that registers our widget. */
function kriesi_users_cats_tags_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_users_cats_tags_widget' );
}

class Kriesi_users_cats_tags_widget extends WP_Widget {
	function Kriesi_users_cats_tags_widget() 
	{
		$widget_ops = array('classname' => 'users-cats-tags', 
							'description' => '特定用户，热门标签、分类、页面');
		
		$this->WP_Widget( 'users_cats_tags', THEMENAME.'/特定用户', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$single_or_multi = strip_tags($instance['single_or_multi']);
		$users_select = strip_tags($instance['users_select']);
		$name_if = strip_tags($instance['name_if']);
		$description_if = strip_tags($instance['description_if']);
		$page_if = strip_tags($instance['page_if']);
		$cat_if = strip_tags($instance['cat_if']);
		$tag_if = strip_tags($instance['tag_if']);
		$title_inside_if = strip_tags($instance['title_inside_if']);

		$users = get_option("kriesi_leanin_users");
		//print_r($users);
		$users_list=explode(",", $users["websiteUsers"]);//获取用户

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		if ($single_or_multi == 1) {
			echo '<section class="users-list-section">';
			foreach ($users_list as $users_slug) {
				echo '<h3>'.$h_option['users'][$users_slug."Name"].'</h3>';
				echo '<div>';
				//描述
				if ($description_if = 1) {
					echo '<p>'.$h_option['users'][$users_slug."Description"].'</p>';
				}
				//页面
				if ($page_if == 1) {
					echo '<h4>'.__("Pages").'</h4>';
					$pages=explode(",", $users[$users_slug."Pages_final"]);
					$args = array(	'include' =>$pages,
									'title_li'=>"",
									'sort_column' => 'menu_order');
					echo "<ul>";
					wp_list_pages($args);
					echo "</ul>";
				}
				//分类
				if ($cat_if == 1) {
					echo '<h4>'.__("Categories").'</h4>';
					$cats=explode(",", $users[$users_slug."Cats_final"]);
					$args = array(	'include' =>$cats,
									'title_li'=>"");
					echo "<ul>";
					wp_list_categories($args);
					echo "</ul>";
				}
				//标签
				if ($tag_if == 1) {
					echo '<h4>'.__("Tags").'</h4>';
					$tags=explode(",", $users[$users_slug."Tags_final"]);
					$args = array(	'include' => $tags , ///???smallest=9&largest=9
									'smallest' => 12,
									'largest' => 16
								);
					echo "<p>";
					wp_tag_cloud($args);
					echo "</p>";
				}
				echo '</div>';
			}//end foreach
			echo '</section><!-- .users-list-section/ -->';
			/*-----------------------------------*/
		} else {
			if ($name_if == 1) {
				echo '<h3>'.$h_option['users'][$users_select."Name"].'</h3>';
			} 
				echo '<div class="user-single-focus">';
				//描述
				if ($description_if == 1) {
					echo '<p>'.$h_option['users'][$users_select."Description"].'</p>';
				}
				//页面
				if ($page_if == 1) {
					if ($title_inside_if == 1) echo '<h4>'.__("Pages").'</h4>';
					$pages=explode(",", $users[$users_select."Pages_final"]);
					$args = array(	'include' =>$pages,
									'title_li'=>"",
									'sort_column' => 'menu_order');
					echo "<ul>";
					wp_list_pages($args);
					echo "</ul>";
				}
				//分类
				if ($cat_if == 1) {
					if ($title_inside_if == 1)echo '<h4>'.__("Categories").'</h4>';
					$cats=explode(",", $users[$users_select."Cats_final"]);
					$args = array(	'include' =>$cats,
									'title_li'=>"");
					echo "<ul>";
					wp_list_categories($args);
					echo "</ul>";
				}
				//标签
				if ($tag_if == 1) {
					if ($title_inside_if == 1) echo '<h4>'.__("Tags").'</h4>';
					$tags=explode(",", $users[$users_select."Tags_final"]);
					$args = array(	'include' => $tags , ///???smallest=9&largest=9
									'smallest' => 10,
									'largest' => 12
								);
					echo '<p style="margin-bottom:0;">';
					wp_tag_cloud($args);
					echo "</p>";
				}
				echo '</div>';
		}
		echo $after_widget;
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['single_or_multi'] = strip_tags($new_instance['single_or_multi']);
         $instance['users_select'] = strip_tags($new_instance['users_select']);
         $instance['name_if'] = strip_tags($new_instance['name_if']);
         $instance['description_if'] = strip_tags($new_instance['description_if']);
         $instance['page_if'] = strip_tags($new_instance['page_if']);
         $instance['cat_if'] = strip_tags($new_instance['cat_if']);
         $instance['tag_if'] = strip_tags($new_instance['tag_if']);
         $instance['title_inside_if'] = strip_tags($new_instance['title_inside_if']);
        
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
		 $users = get_option("kriesi_leanin_users");
		 $users_list=explode(",", $users["websiteUsers"]);//获取用户
         $instance = wp_parse_args((array) $instance, array('title'=> '特定用户', 'single_or_multi' => '1', 'users_select' => '', 'name_if' => '1', 'description_if' => '1', 'page_if' => '1', 'tag_if' => '1','title_inside_if' => '1'));
         $title = esc_attr($instance['title']);
         $single_or_multi = strip_tags($instance['single_or_multi']);
         $users_select = strip_tags($instance['users_select']);
         $name_if = strip_tags($instance['name_if']);
         $description_if = strip_tags($instance['description_if']);
         $page_if = strip_tags($instance['page_if']);
         $cat_if = strip_tags($instance['cat_if']);
         $tag_if = strip_tags($instance['tag_if']);
         $title_inside_if = strip_tags($instance['title_inside_if']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
                  <p>
             <label for="<?php echo $this->get_field_id('single_or_multi'); ?>">单列/分拆：
             	<select name="<?php echo $this->get_field_name('single_or_multi'); ?>" id="<?php echo $this->get_field_id('single_or_multi'); ?>" class="widefat">
					<option value="0"<?php selected('0', $single_or_multi); ?>>单列</option>
					<option value="1"<?php selected('1', $single_or_multi); ?>>分拆</option>
				</select>
             </label>
         </p>

         <p>
             <label for="<?php echo $this->get_field_id('users_select'); ?>">单独列出用户：
             	<select name="<?php echo $this->get_field_name('users_select'); ?>" id="<?php echo $this->get_field_id('users_select'); ?>" class="widefat">
					<?php foreach ($users_list as  $users_li) { ?>
						<option value="<?php echo $users_li; ?>"<?php selected($users_li, $users_select); ?>><?php echo $users_li; ?></option>
					<?php } ?>
				</select>
             </label>
         </p>
          <p>
             <label for="<?php echo $this->get_field_id('name_if'); ?>">显示用户名称：
             	<select name="<?php echo $this->get_field_name('name_if'); ?>" id="<?php echo $this->get_field_id('name_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $name_if); ?>>否</option>
					<option value="1"<?php selected('1', $name_if); ?>>是</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('description_if'); ?>">显示用户描述：
             	<select name="<?php echo $this->get_field_name('description_if'); ?>" id="<?php echo $this->get_field_id('description_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $description_if); ?>>否</option>
					<option value="1"<?php selected('1', $description_if); ?>>是</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('page_if'); ?>">显示关注页面：
             	<select name="<?php echo $this->get_field_name('page_if'); ?>" id="<?php echo $this->get_field_id('page_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $page_if); ?>>否</option>
					<option value="1"<?php selected('1', $page_if); ?>>是</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('cat_if'); ?>">显示关注分类：
             	<select name="<?php echo $this->get_field_name('cat_if'); ?>" id="<?php echo $this->get_field_id('cat_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $cat_if); ?>>否</option>
					<option value="1"<?php selected('1', $cat_if); ?>>是</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('tag_if'); ?>">显示关注标签：
             	<select name="<?php echo $this->get_field_name('tag_if'); ?>" id="<?php echo $this->get_field_id('tag_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $tag_if); ?>>否</option>
					<option value="1"<?php selected('1', $tag_if); ?>>是</option>
				</select>
             </label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('title_inside_if'); ?>">显示内部标题：
             	<select name="<?php echo $this->get_field_name('title_inside_if'); ?>" id="<?php echo $this->get_field_id('title_inside_if'); ?>" class="widefat">
					<option value="0"<?php selected('0', $title_inside_if); ?>>否</option>
					<option value="1"<?php selected('1', $title_inside_if); ?>>是</option>
				</select>
             </label>
         </p>
        

         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
	}
}

