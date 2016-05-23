<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_comments_new_widget' );

/* Function that registers our widget. */
function kriesi_comments_new_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_comments_new_widget' );
}

class Kriesi_comments_new_widget extends WP_Widget {
	function Kriesi_comments_new_widget() 
	{
		$widget_ops = array('classname' => 'comments-new', 
							'description' => '最新评论，统计评论总数');
		
		$this->WP_Widget( 'comments_new', THEMENAME.'/最新评论', $widget_ops );
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
		$comment_count=$wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
		echo sprintf('<div class="comments-all-count">'.sprintf(__("Leave %s footprints",'leanin'), $comment_count)).'</div>';
		echo '<ul>';
		//开始
		global $wpdb;
		$my_email ="'" . $email . "'";
		/*$rc_comms = $wpdb->get_results("SELECT 
												ID, post_title, comment_ID, comment_author,comment_author_email, comment_content
										 FROM 
										 		$wpdb->comments LEFT OUTER JOIN $wpdb->posts
										 ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID)
										 WHERE 
										 		comment_approved = '1'
										 	AND 
										 		comment_type = ''
										 	AND 
										 		post_password = ''
										 	AND 
										 		comment_author_email != $my_email
										 ORDER BY 
										 		comment_date_gmt
										 DESC LIMIT $limit
		 ");
		$rc_comments = '';
		foreach ($rc_comms as $rc_comm) { //get_avatar($rc_comm,$size='50')
		$rc_comments .= "<li><a href='"
		. get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID
		. "' title='在 " . $rc_comm->post_title . " 发表的评论'><span class='comer'>".$rc_comm->comment_author." : </span>". $rc_comm->comment_content ."</a></li>\n";
		}
		
		echo $rc_comments;*/
		//摘自www.90nl.com的主题
		if ($h_option['general']['AvatarCache'] == 1) { 

			$sql = "SELECT DISTINCT 
									ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,16) AS com_excerpt 
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
								ORDER BY 
									comment_date_gmt 
								DESC LIMIT 
											$limit";
			$comments = $wpdb->get_results($sql);
			$output = $pre_HTML;
			foreach ($comments as $comment) {
				//$a= get_bloginfo('wpurl') .'/avatar/'.md5(strtolower($comment->comment_author_email)).'.jpg';
				//
				//
				$imgsrc = my_avatar($comment->comment_author_email);
				$output .= "\n<li><img width='32' height='32' src='". $imgsrc ."'  alt=\"$comment->comment_author\" class='avatar'/>$comment->comment_author:<br /><a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"" .__("Link to ", 'leanin').$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";
			}
			$output .= $post_HTML;
			$output = convert_smilies($output);
			
			echo $output;
		}else{
			global $wpdb;
			$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,16) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date_gmt DESC LIMIT 8";
			$comments = $wpdb->get_results($sql);
			$output = $pre_HTML;
			foreach ($comments as $comment) {$output .= "\n<li>".get_avatar(get_comment_author_email(), 32).strip_tags($comment->comment_author).":<br />" . " <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"".__("Link to ", 'leanin') .$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";}
			$output .= $post_HTML;
			$output = convert_smilies($output);
			echo $output;
		}
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
		 $instance['email'] = strip_tags($new_instance['email']);
         return $instance;
	}

 
 
	function form($instance) 
	{
		 global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '最新评论', 'limit' => '8', 'email' => ''));
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

