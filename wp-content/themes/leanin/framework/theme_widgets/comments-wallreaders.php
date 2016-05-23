<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_comments_wallreaders_widget' );

/* Function that registers our widget. */
function kriesi_comments_wallreaders_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_comments_wallreaders_widget' );
}

class Kriesi_comments_wallreaders_widget extends WP_Widget {
	function Kriesi_comments_wallreaders_widget() 
	{
		$widget_ops = array('classname' => 'comments-wallreaders', 
							'description' => '评论墙');
		
		$this->WP_Widget( 'comments_wallreaders', THEMENAME.'/评论墙', $widget_ops );
	}
 
	function widget($args, $instance) 
	{	
		global $h_option,$wpdb;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$limit = strip_tags($instance['limit']);
		$email = strip_tags($instance['email']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
		echo "\n<ul>\n";
		//开始
		global $wpdb;
		$my_email ="'" . $email . "'";
	
		//摘自www.90nl.com的主题
		if ($h_option['general']['AvatarCache'] == 1) { 

			$sql = "SELECT DISTINCT 
									count(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email 
							FROM 
									$wpdb->comments LEFT OUTER JOIN $wpdb->posts 
							ON 
									($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
							WHERE 
									comment_approved = '1' 
								AND 
									comment_type = '' 
								AND 
									post_password = '' 
								AND 
									user_id='0'
								GROUP BY comment_author 
								ORDER BY 
									cnt DESC 
								Limit {$limit}
								";
			$counts = $wpdb->get_results($sql);
			$output .= $pre_HTML;

			foreach ($counts as $count) {
				//$imgsrc = get_bloginfo('wpurl') . '/avatar/' . md5(strtolower($count->comment_author_email)) . '.jpg';
				if ($count->cnt=='') {
				 	echo "kong";
				 } 
				 echo $comment->comment_author;
				$imgsrc = my_avatar($count->comment_author_email);
				$c_url = $count->comment_author_url;
				$mostactive .= '<li class="mostactive">' . '<a href="'. $c_url . ' " title="' . $count->comment_author . ' ('.   sprintf(__("Leave %s footprints",'leanin'),$count->cnt ) .')" target="_blank" rel="nofollow"><img src="' . $imgsrc . '" alt="' . $count->comment_author . '" class="avatar" /></a></li>'."\n";
			}
			echo $mostactive;
		}else{
			$sql = "SELECT DISTINCT 
									count(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email 
							FROM 
									$wpdb->comments LEFT OUTER JOIN $wpdb->posts 
							ON 
									($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
							WHERE 
									comment_approved = '1' 
								AND 
									comment_type = '' 
								AND 
									post_password = '' 
								AND 
									user_id='0'
								GROUP BY comment_author 
								ORDER BY 
									cnt DESC 
								Limit {$limit}
								";
			$wall = $wpdb->get_results($sql);
			
			foreach ($wall as $comment){
				if( $comment->comment_author_url )
					$url = $comment->comment_author_url;
				else 
					$url="#";
				$r="rel='nofollow'";
				$tmp = "<li><a href='".$url."' ".$r." title='".$comment->comment_author." (".sprintf(__("Leave %s footprints",'leanin'),$comment->cnt)."'>".get_avatar($comment->comment_author_email, 38)."</a></li>";
				$output .= $tmp;
			}
				echo $output ;
		}
		echo "</ul>\n";
		echo $after_widget."\n";
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['limit'] = strip_tags($new_instance['limit']);
		 $instance['email'] = strip_tags($new_instance['email']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '评论墙', 'limit' => '12', 'email' => ''));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
		 $email = strip_tags($instance['email']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
		 <p>
             <label for="<?php echo $this->get_field_id('email'); ?>">输入你的邮箱以排除显示你的回复: <br>（留空则不排除）<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
	}
}

