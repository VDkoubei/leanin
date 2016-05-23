<?php
/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'Kriesi_special_login_widget' );

/* Function that registers our widget. */
function Kriesi_special_login_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_special_login_widget' );
}

class Kriesi_special_login_widget extends WP_Widget {
	function Kriesi_special_login_widget() 
	{
		$widget_ops = array('classname' => 'special_login', 
							'description' => '会员登录');
		
		$this->WP_Widget( 'special_cat', THEMENAME.'/会员登录页面', $widget_ops );
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
			<?php if (!(current_user_can('level_0'))){ ?>   
				<form name="loginform" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">   
				    <div id="login">   
				    <p>    
				        <label><?php _e('Username:') ?><input type="text" name="log" value="" size="20" /></label>    
				    </p>    
				    <p>    
				        <label><?php _e('Password:') ?><input type="password" name="pwd" value="" size="20" /></label>    
				    </p>    
				    <p>    
				        <label><input name="rememberme" type="checkbox" value="forever" /> <?php _e('Remember Me') ?>　<input type="submit" name="submit" value="<?php _e('Log in') ?>" class="rm"/></label>   
				    </p>   
				    <p>   
				        <a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost and Found') ?>">找回密码</a>   
				        <a class="rm" href="<?php echo get_option('home'); ?>/wp-login.php?action=register" title="还没注册？点此去注册吧"> <?php _e('Register') ?></a>   
				    </p>   
				    </div>   
				        <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />   
				</form>   
			<?php } else { ?>   
					 <div id="login">   
					    <div class="info" >   
					   		<P>尊敬的"<?php echo the_author_meta( 'user_login' ); ?>"，您已经成功登录了</P>   
					    </div>   
					    <p>   
						    <a class="rm" href="<?php bloginfo('home'); ?>/wp-admin/" target="_blank">管理网站</a>   
						    <a class="rm" href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="">退出登录</a>   
						</p>   
					</div>   
				<?php }?> 


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
		$instance = wp_parse_args( (array) $instance, array( 'title' => '会员登录' ) );
		$title = strip_tags($instance['title']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题/Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		
			
<?php
	}
}
