<?php  


##################################################################
# 页面加入摘要，
##################################################################
add_action( 'admin_menu', 'my_page_excerpt_meta_box' );
function my_page_excerpt_meta_box() {
    add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}



 
function leanin_jq_script(){
	global $h_option;

	if(!is_admin()){
	// KandyTabs
	//$my_KandyTabs= get_bloginfo('template_url')."/js/KandyTabs.js";
	// $my_KandyTabs= get_bloginfo('template_url')."/js/kandytabs.pack.js";
	// wp_enqueue_script('KandyTabs',$my_KandyTabs,array('jquery'),'4.2.0112', true);

	// if ($h_option["general"]["Lazyload"] =="1") {
	// 	$my_Lazyload = get_bloginfo('template_url') ."/js/lazyload.js";
	// 	wp_enqueue_script('Lazyload',$my_Lazyload,array('jquery'),THEMEVERSION, true);
	// };





	// if ($h_option["general"]["ColorBox"]) {
	// 	$my_ColorBox = get_bloginfo('template_url')."/js/colorbox/jquery.colorbox-min.js";
	// 	wp_enqueue_script('ColorBox',$my_ColorBox,array('jquery'),'1.4.1', true);
	// };

	// add leanin
	$my_leanin = get_bloginfo('template_url')."/js/leanin.js";
	wp_enqueue_script('leanin',$my_leanin,array('jquery'),THEMEVERSION, true);

	// if ( (is_single() || is_page()) && !is_home()) {
	// 	//add ajax
	// 	$my_comments_Ajax = get_bloginfo('template_url')."/comments-ajax.js";
	// 	wp_enqueue_script('my_comments_Ajax ',$my_comments_Ajax,array('jquery'),THEMEVERSION, true);

	// 	//add realgravatar
	// 	$my_realgravatar = get_bloginfo('template_url')."/js/realgravatar.js";
	// 	wp_enqueue_script('my_realgravatar ',$my_realgravatar,array('jquery'),THEMEVERSION, true);
	
	// }


	}

}
//add_action('wp_footer', 'leanin_jq_script');
add_action('wp_head', 'leanin_jq_script');


##################################################################
# prevents duplicate content by setting archive pages to nofollow
# 防止重复的内容存档页面设定为nofollow
##################################################################
function khelper_follow_nofollow()
{
	if ((is_single() || is_page() || is_home() ) && ( !is_paged() )) 
	{
		echo '<meta name="robots" content="index, follow" />' . "\n";
	} 
	else 
	{
		echo '<meta name="robots" content="noindex, follow" />' . "\n";
	}
}

##################################################################
# check if the current page has a custom widget and set a global
# var if that the case
# 如果当前页面有一个自定义的widget，并设置一个全局变量，如果的情况下
##################################################################
function check_custom_widget()
{	
	global $custom_widget_area, $h_option;
	//special widget area
	$specialpage = explode(',',$h_option['includes']['multi_widget_final']);
	$specialcat = explode(',',$h_option['includes']['multi_widget_cat_final']); 
	
	if(is_page($specialpage))
	{	
		$custom_widget_area = get_the_title();
	}
	else if(is_category($specialcat) || ($h_option['includes']['single_post_multi_widget_cat'] != 2 && in_category($specialcat)))
	{	
		$custom_widget_area = get_the_category();
		$custom_widget_area = $custom_widget_area[0]->cat_name;
	}
	
}
add_action('wp_head', 'check_custom_widget');



##################################################################
# Remove Blog categories from widget
# 从小工具中删除博客分类
# 作用是啥？
##################################################################

function filter_category($cat_args)
{
	global $h_option;
	
	if($h_option['blog']['blog_widget_exclude'] == 1)
	{
		$cat_args['exclude'] = $h_option['blog']['blog_cat_final'];
	}
	else if($h_option['mainpage']['blog_widget_exclude'] == 1)
	{
		$cat_args['exclude'] = $h_option['mainpage']['main_cat_final'];
	}
	
 	return $cat_args;
}

add_filter('widget_categories_args', 'filter_category');
//widget_categories_args的作用是啥？



##################################################################
# Used as a replacement function for plugins_url if using external plugins
# 如果使用外部插件作为替换函数的plugins_url
##################################################################

function template_url($path = '', $plugin = '') 
{
	return KFWPLUGINS_URI.$path;
}

/* =判断是否移动版
------------------------------------------------------------------------*/
function h_is_mobile(){
	$detect = new Mobile_Detect();
	if ($detect -> isMobile()) {
		return true;
	}else{
		return false;
	}
	
}

function h_get_device($device = 'pc'){

	$detect = new Mobile_Detect();

	switch($device){

			case 'mobile':
				if ($detect -> isMobile()) {
					return true;
				}else{
					return false;
				}
				break;
			case 'tablet':
				if ($detect -> isTablet()) {
					return true;
				}else{
					return false;
				}
				break;
			case 'phone':
				if ( $detect -> isMobile()  && !$detect -> isTablet()) {
					return true;
				}else{
					return false;
				}
				break;

			default:

				if ( !$detect -> isMobile() ) {
					return true;
				}else{
					return false;
				}

		}
	
}


/* =获取自定义栏目的值
------------------------------------------------------------------------*/
function h_get_terms_meta($id, $meta_name){
	if (function_exists('get_terms_meta')) {
		// $category_id是分类id，$meta_key是自定义栏目名称（就是你上面填的Meta Name）
		// 
		$meta_value = get_terms_meta($id, $meta_name);

		$meta_value = $meta_value[0];
		//echo $meta_value;
		switch ( $meta_name ) {
			//混合分类中的数量
			case 'multi_num':
				if ($meta_value =="all") {
					return null;
				}
				break;

			default:
				# code...
				break;
		}
		return $meta_value;
	}

}


/* =截取函数
------------------------------------------------------------------------*/
	function h_mb_strimwidth($str ,$start , $width ,$trimmarker ){

		if( strlen($str ) > $width*3  ){
			$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
			return $output.$trimmarker;
		}
		return $str;

	}

function h_get_title($num = 30){
	return h_mb_strimwidth(get_the_title(), 0, $num, '…'); 
}
// 有分类
function h_get_li_has_cat($num = 30){ 
	$post_one_attachment =get_post_custom_values("post_one_attachment");
	$post_url = get_the_content() =='' ? $post_one_attachment[0] : get_permalink() ;

	?>

<li  <?php post_class(); ?>><time class="entry-date fr" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time("m-d") ?></time><span class="entry-category">[<?php the_category(",") ?>] </span><a href="<?php echo $post_url; ?>" title="<?php the_title() ?>" class="l-link"><?php echo h_get_title($num); ?></a></li>

<?php 
}
// 没有分类
function h_get_li_no_cat($num = 30){

	$post_one_attachment =get_post_custom_values("post_one_attachment");
	$post_url = get_the_content() =='' ? $post_one_attachment[0] : get_permalink() ;

	?>
<li  <?php post_class(); ?>><time class="entry-date fr" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time("m-d") ?></time><a class="l-link" href="<?php echo $post_url; ?>" title="<?php the_title() ?>"><?php the_title(); //echo h_get_title($num); ?></a></li>

<?php 
}

// 没有分类
function h_get_li_has_views($num = 30){

	$post_one_attachment =get_post_custom_values("post_one_attachment");
	$post_url = get_the_content() =='' ? $post_one_attachment[0] : get_permalink() ;

	?>
<li  <?php post_class(); ?>>
	<time class="entry-date fr" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time("Y-m-d") ?></time>
	<a href="<?php echo $post_url; ?>" title="<?php the_title() ?>" class="l-link">
		[<span class="entry-views">浏览:<?php if(function_exists('the_views')) { the_views(); } ?></span>]
		<?php echo h_get_title($num); ?>
	</a>
</li>

<?php 
}


function h_cms_list($category,$posts_limit,$substr = 20,$has_cat = false){

	if ($has_cat) {




		# code...
	}else{ ?>
		<header class="lists-title">
			<h2>&gt;<?php echo get_cat_name($category) ?></h2>
			<a class="more" href="<?php echo get_category_link($category) ?>" title="查看更多[ <?php echo get_cat_name($category) ?> ]">更多&gt;&gt;</a>
		</header><!-- 分类标题/lists-title -->

		<ul class="lists-small">
			<?php 
			$i=1;
			$args  = array('category__in' => $category ,'showposts' => $posts_limit);

			
			query_posts($args);
			 if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); 
			if ( $i <= $posts_limit)h_get_li_no_cat($substr);
			$i++;
		 endwhile; endif;wp_reset_query()?>
		</ul>
	<?php }

}

/* =获取缩略图链接
--------------------------------------------------------------------------------------*/
function h_get_thumb_link(){
	if (has_post_thumbnail()) {
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
		$img_src = $img_src[0];
	}else{
		$img_src = get_permalink();

	}
	return $img_src;
}


/* =以下是犀利找的
--------------------------------------------------------------------------------------*/
//删除空格，回车等的函数
function DeleteHtml($str){
	$str = trim($str);
	$str = strip_tags($str,"");
	$str = ereg_replace("\t","",$str);
	$str = ereg_replace("\r\n","",$str);
	$str = ereg_replace("\r","",$str);
	$str = ereg_replace("\n","",$str);
	$str = ereg_replace(" "," ",$str);
	return trim($str);
}



//截取图片
function catch_first_image($size) {
	global $post, $posts;$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){
		$random = mt_rand(1, 12);
		$first_img .= get_bloginfo ( 'stylesheet_directory' );
		$first_img .= '/images/thumbs/shici-'.$random.'-'.$size.'.jpg';
		}
  return $first_img;
};

//获取缩略图
function leanin_get_thumb_image($name = "thumbnails",$size = 160,$get = false,$post_id = null){

	$height= $size*0.75;
	$img = catch_first_image($size);
	$output="";
	if ($get) {
		
		if ( get_post_meta($post->ID, 'show', true) ) {

			$image = get_post_meta($post->ID, 'show', true);
			$output = "<img src='".$image." width='".$size."' height='".$height."' alt='1".get_the_title()."' />";
		}elseif( has_post_thumbnail() ) {
			//echo $name;
			$output = get_the_post_thumbnail($post_id, $name ,array( 'title' => trim(strip_tags( $post->post_title )),'class' => $name));
		}else{
			$output = "<img src='".$img."' alt='2".get_the_title()."' width='".$size."' height='".$height."' class='".$name." wp-post-image' />";	
		}
	}else{
		echo leanin_get_thumb_image($name,$size,true);
		return;

	}
	 
	return $output;
 	
}


//截字
function dm_strimwidth($str ,$start , $width ,$trimmarker ){
	
		$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str); 
		return $output.$trimmarker;

};

//标题文字截断
function cut_str($src_str,$cut_length= 12)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '...';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str ;
}



//分页
function pagination($query_string,$html_id=''){


	$html_id=$html_id?' '.$html_id:" nav-below";//获取上下导航，默认为下
	//echo $query_string."strings";
	global $posts_per_page, $paged;
	$my_query = new WP_Query($query_string ."&posts_per_page=-1");
	$total_posts = $my_query->post_count;
	if(empty($paged))$paged = 1;
	$prev = $paged - 1;							
	$next = $paged + 1;	
	$range = 4; // 修改数字,可以显示更多的分页链接 在分页的时候，显示该页面的前后各$ranges个，总共$showitems个
	$showitems = ($range * 2)+1;
	$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
	$navigation_name ='文章导航';
	echo "<nav class='navigation pagination".$html_id."'><h3 class='assistive-text'>".$navigation_name."</h3>";
	echo "<span class='fir_las'>".__(" Pages: ", 'leanin').$paged." / ".$pages."</span>";
	echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='fir_las'>第一页</a>":"";
	echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='page_previous'>上一页</a>":"";		
	for ($i=1; $i <= $pages; $i++){
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
		echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
	}
	}
	echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='page_next'>下一页</a>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='fir_las'>最末页</a>":"";
	
if ($pages >=5) {
	echo '<select name="page-select" size="1" class="page-select" onchange="window.location=this.value;">';
	for ($i=1; $i <= $pages; $i++){
			echo ($paged == $i)? '<option value="1" selected="selected">'.$i.'</option>':"<option value='".get_pagenum_link($i)."'>".$i."</option>"; 
	}
	echo "</select>";
}



	echo "</nav>\n";
	}
}






//获取根分类
function get_category_root_id($cat){

	$this_category = get_category($cat);   // 取得当前分类
	while($this_category->category_parent) // 若当前分类有上级分类时，循环
	{
	$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
	}
	return $this_category->term_id; // 返回根分类的id号
}

//获取子分类
function MY_get_category_children($id = '',$link = true,$separator = '/',$id_find=false, $visited = array()){
_deprecated_function( __FUNCTION__, '2.8', 'get_term_children()' );
global $cat;
if($id == '')$id = $cat;
$chain = '';
/** TODO: consult hierarchy */
$cat_ids = get_all_category_ids();
foreach ( (array) $cat_ids as $cat_id ) {
if ( $cat_id == $id )continue;
$category = get_category( $cat_id );
if ( is_wp_error( $category ) )return $category;
if ( $category->parent == $id && !in_array( $category->term_id, $visited ) ) {
$visited[] = $category->term_id;
$category_id = $category->term_id;
$category_name = $category->name;
$category_link = get_category_link( $category_id );
if($link){
	$chain .= '<a href="'.$category_link.'">'.$category_name.'</a>'.$separator;
} elseif ($id_find) {
	$chain .= $category_id.$separator;
}else{

 $chain .= $category_name.$separator;
}
$chain .= MY_get_category_children( $category_id,$link,$separator,$visited );
}
}
return $chain;
}
function MY_the_category_children($id = '',$link = true,$separator = '/',$visited = array()){
echo MY_get_category_children($id,$link,$separator,$visited);
}
//////////////////////////////////////wordpress啦

     function get_category_tags($args) {
        global $wpdb;
        $tags = $wpdb->get_results
        ("
            SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
            FROM
                wp_posts as p1
                LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
                LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
                LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

                wp_posts as p2
                LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
                LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
                LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
            WHERE
                t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
                t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
                AND p1.ID = p2.ID
            ORDER by tag_name
        ");
        $count = 0;
        foreach ($tags as $tag) {
            $tags[$count]->tag_link = get_tag_link($tag->tag_id);
            $count++;
        }
        return $tags;
    }

//为页面添加钩子
add_action( 'init', 'boj_add_excerpts_to_pages' );

function boj_add_excerpts_to_pages() {
add_post_type_support( 'page', array( 'excerpt' ) );
}
//Html5验证中的rel category
function the_category_filter($thetag){
    return preg_replace('/rel=".*?"/','rel="tag"',$thetag);
  }
add_filter('the_category','the_category_filter');


//自定义样式
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css" />';
}
add_action('login_head', 'custom_login');

//自定义登陆地址
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url){
	return get_bloginfo("url");
}






//可视化面板
function add_editor_buttons($buttons) { 
	$buttons[] = 'fontselect'; 
	$buttons[] = 'fontsizeselect'; 
	$buttons[] = 'cleanup'; 
	$buttons[] = 'styleselect'; 
	$buttons[] = 'hr'; 
	$buttons[] = 'del'; 
	$buttons[] = 'sub'; 
	$buttons[] = 'sup'; 
	$buttons[] = 'copy'; 
	$buttons[] = 'paste'; 
	$buttons[] = 'cut'; 
	$buttons[] = 'undo'; 
	$buttons[] = 'image'; 
	$buttons[] = 'anchor'; 
	$buttons[] = 'backcolor'; 
	$buttons[] = 'wp_page'; 
	$buttons[] = 'charmap'; 
	return $buttons; } 
	add_filter("mce_buttons_3", "add_editor_buttons");


/* =置顶文章
------------------------------------------------------------------------ */	
//add_filter('the_posts',  'putStickyOnTop' );
function putStickyOnTop( $posts ) {
  if(is_home()/* ||  !is_archive()*/ ) 
    return $posts;
    
  global $wp_query;

//获取置顶文章
  $sticky_posts = get_option('sticky_posts');
  
  if ( 
	  	$wp_query->query_vars['paged'] <= 1 
	  	&& is_array($sticky_posts) 
	  	&& !empty($sticky_posts) 
	  	&& !get_query_var('ignore_sticky_posts')
  	 ) 
  {        
  	//获取置顶文章的信息
  	$stickies1 = get_posts( array( 'post__in' => $sticky_posts ) );

    foreach ( $stickies1 as $sticky_post1 ) {

      // 判断当前是否分类页 
      if($wp_query->is_category == 1 && !has_category($wp_query->query_vars['cat'], $sticky_post1->ID)) {
        // 去除不属于本分类的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }

      
      // 判断当前是否标签页 
      if($wp_query->is_tag == 1 && has_tag($wp_query->query_vars['tag'], $sticky_post1->ID)) {
        // 去除不属于本标签的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }

      //判断当前是否是按年归档
      if($wp_query->is_year == 1 && date_i18n('Y', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        // 去除不属于本年份的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }

      //判断当前是否是按月归档
      if($wp_query->is_month == 1 && date_i18n('Ym', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        // 去除不属于本月份的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }



      //判断当前是否是按日期归档
      if($wp_query->is_day == 1 && date_i18n('Ymd', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        // 去除不属于本日期的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }

      
      //判断当前是否是按作者归档
      if($wp_query->is_author == 1 && $sticky_post1->post_author != $wp_query->query_vars['author']) {
        // 去除不属于本作者的文章
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }


    }//end if



  
    $num_posts = count($posts);//文章数量

    //print_r($sticky_posts);

    $sticky_offset = 0;

    // Loop over posts and relocate stickies to the front.
    // 循环文章 将置顶文章提前
    for ( $i = 0; $i < $num_posts; $i++ ) {
    	//判断是
      if ( in_array($posts[$i]->ID, $sticky_posts) ) {

        $sticky_post = $posts[$i];

        // Remove sticky from current position
        array_splice($posts, $i, 1);
        // Move to front, after other stickies
        array_splice($posts, $sticky_offset, 0, array($sticky_post));
        // Increment the sticky offset. The next sticky will be placed at this offset.
        $sticky_offset++;
        // Remove post from sticky posts array
        
        $offset = array_search($sticky_post->ID, $sticky_posts);
        unset( $sticky_posts[$offset] );
      }
    }


    //
    //

    // If any posts have been excluded specifically, Ignore those that are sticky.
    // 如果某些文章被设为排除的，忽略这些文章
    if ( !empty($sticky_posts) && !empty($wp_query->query_vars['post__not_in'] ) )
      $sticky_posts = array_diff($sticky_posts, $wp_query->query_vars['post__not_in']);

    // Fetch sticky posts that weren't in the query results
    // 在查询结果中并没有置顶文章
    if ( !empty($sticky_posts) ) {
      $stickies = get_posts( array(
        'post__in' => $sticky_posts,
        'post_type' => $wp_query->query_vars['post_type'],
        'post_status' => 'publish',
        'nopaging' => true
      ) );

      foreach ( $stickies as $sticky_post ) {
        array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
        $sticky_offset++;
      }
    }




  }
  
  return $posts;
}


//添加置顶文章样式
add_filter('post_class',  'addStickyClass' ,10,3 );
function addStickyClass( $classes, $class, $post_id ){
  if( is_sticky() && is_category() && !isset( $classes['sticky'] ) ){
    $classes[] = 'li-sticky';
  }else{
  	$classes[] = 'li-normal';
  }
  
  return $classes;
}