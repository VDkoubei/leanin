<?php
$url = dirname(__FILE__);
$pattern = '/(\S+)wp(\S+)/i';
$replacement = '$1';
$blog_url= preg_replace($pattern,$replacement , $url);
require_once($blog_url.'wp-config.php');
$type = $_POST["type"];
if($type=='post_show'){
	if(empty($_POST['post_show_id'])){
		$str= '<div class="entry-title">
	<h2>[  ╮(╯_╰)╭  已经没有文章了，有也不给你看]</h2>
	<br>
	<br>
	小朋友一边玩去...
	<br>
	<img src="'.get_bloginfo('template_url').'/images/nopost.gif">
	<br><br></div>songlecn%dsonglecn%d
	';
		query_posts("showposts=1");
		if (have_posts()) {
					while (have_posts()) {	
						the_post();
					}
		}
		printf ($str,'',get_the_ID());
		wp_reset_query();
	}else{
		$postid=$_POST['post_show_id'];
		query_posts("posts_per_page=-1&p=".$postid);
		if (have_posts()) {
				while (have_posts()) {	
					the_post();
		$str= '
		<div class="entry-title">
				<h2><span>[ ' ;
		echo $str;
		the_category(' , ');
		$str=' ]</span><a href="'. get_permalink() .'">'. get_the_title().'</a></h2>
				</div><div class="entry-banner"><a href="'.
				 get_permalink() .'">';
				echo $str;
				$soContent = $post->post_content;
$soImages = '~<img [^\>]*\ />~';
preg_match_all( $soImages, $soContent, $thePics );
$allPics = count($thePics[0]);
if( $allPics > 0 ){
echo $thePics[0][0];
}
else {
echo '<img src="/plus/default.gif" border="0" />';
}

				$str='</a>
				</div>				
				<div>';
				
						 if(has_excerpt()) $str.=get_the_excerpt();
						 else
						 $str.= mb_strimwidth(strip_tags($post->post_content),0,500,'……');
					$str.='
					<div class="entry-meta">
						<span class="meta_comment">';
						echo $str;
						 comments_popup_link('发现&nbsp;0 个古生物抵达新大陆 &#187;', '发现&nbsp;1 个古生物抵达新大陆 &#187;', '发现&nbsp;% 个古生物抵达新大陆 &#187;');
						 $str='</span><div class="meta_tags"><span id="spn">已有 %s人阅读</span><script type="text/javascript">strBatchView+=",";</script>  |  <span>开荒日期：纪元'. get_the_time("y年m月d日").'</span>  |  ';
						 printf ($str,the_views(false));
						 the_tags(' ' , ' , ' , ' ');
						 $str='</div>
					</div>
				</div>songlecn%dsonglecn%d';
				$next_post = get_adjacent_post(false,'',true) ;
				$prev_post = get_adjacent_post(false,'',false) ;
		printf ($str,$prev_post->ID,$next_post->ID);
			}
		}
		wp_reset_query();
	}
}
/*--------------------------------------------------------------------------------*/
//获取最新文章
if($type=='hot_tab_new'){
	query_posts('showposts=8');
	$str='<ul>';
	if (have_posts()) {
		$i=1;
		while (have_posts()) {	
			the_post();
			$str.='<li><span class="tabNum">'.$i.'</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			$i++;
		}
	}
	$str.='</ul>';
	echo $str;
	wp_reset_query();
}

//获取最新评论
if($type=='hot_tab_comment'){
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,43) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date_gmt DESC LIMIT 8";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$i=1;
foreach ($comments as $comment) {$output .= "\n<style>.hotab_cmt{color:#999999} .hotab_cmt a{color:#666666} .hotab_cmt a:hover{color:#018EE8}</style><ul><li class=\"hotab_cmt\"><span class=\"tabNum\">".$i."</span><a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"" .$comment->post_title . "\">" .strip_tags($comment->comment_author)." 说：</a>"."". strip_tags($comment->com_excerpt)."...</li></ul>";
$i++;
}
$output .= $post_HTML;
echo $output;
wp_reset_query();
}


//获取随机文章
if($type=='hot_tab_rnd'){
$randposts = $wpdb->get_results('SELECT p.ID, p.post_title, rand()*p1.id AS o_id FROM ' . 
$wpdb->posts . ' AS p JOIN ( SELECT MAX(ID) AS id FROM ' 
. $wpdb->posts . ' WHERE post_type="post" AND post_status="publish") AS p1 WHERE p.post_type="post"  
AND p.post_status="publish" ORDER BY o_id LIMIT 8'); 
$output = $pre_HTML;
$i=1;
foreach($randposts as $randpost) 
{                    
echo('<ul><li><span class="tabNum">'.$i.'</span><a href="' . get_permalink($randpost->ID) 
. '">' 
. $randpost->post_title . '</a></li></ul>'); 
$i++;  
} 
$output .= $post_HTML;
echo $output;
wp_reset_query();
}
//获取月度热评
if($type=='hot_tab_month'){
get_most_viewed_month (8, 30); 
wp_reset_query();
}
//获取年度热评
if($type=='hot_tab_year'){
get_most_viewed_month (8, 365); 
wp_reset_query();
}
//获取本月热门
if($type=='hot_tab_month_view'){
get_timespan_month();
wp_reset_query();
}
//获取本年热门
if($type=='hot_tab_year_view'){
get_timespan_year();
wp_reset_query();
}
?>