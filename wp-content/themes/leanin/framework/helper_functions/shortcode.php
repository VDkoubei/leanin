<?php

//这里是短代码设置，你可以在这里添加或删除自己喜欢的样式
//在HTML中只输入content和href两种值
//在处理时添加title等其他属性
function downbox($atts, $content=null, $code="") {
	$return = "<div class='down codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('down' , 'downbox' );

function warningbox($atts, $content=null, $code="") {
	$return = "<div class='warning codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('warning' , 'warningbox' );	

function authorbox($atts, $content=null, $code="") {
	$return = "<div class='panelauthor codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('author' , 'authorbox' );

function textbox($atts, $content=null, $code="") {
	$return = "<div class='texticon codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('text' , 'textbox' );

function teachbox($atts, $content=null, $code="") {
	$return = "<div class='tutorial codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('tutorial' , 'teachbox' );

function projectbox($atts, $content=null, $code="") {
	$return = "<div class='project codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('project' , 'projectbox' );

function errorbox($atts, $content=null, $code="") {
	$return = "<div class='error codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('error' , 'errorbox' );

function questionbox($atts, $content=null, $code="") {
	$return = "<div class='question codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('question' , 'questionbox' );

function blinkbox($atts, $content=null, $code="") {
	$return = "<div class='blink codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('blink' , 'blinkbox' );

function codeebox($atts, $content=null, $code="") {
	$return = "<div class='codee codei'><div class='box-content'>";
	$return .= do_shortcode($content);
	$return .= "</div></div>";
	return $return;
}
add_shortcode('codee' , 'codeebox' );


function button_download($atts, $content = null) {
	extract(shortcode_atts(array("href"=>'http://'), $atts));		
	return '<span class="but-down"><a href="'.$href.'" target="_blank"><span>'.$content.'</span></a></span>';
}
add_shortcode('butdown', 'button_download');

function button_heart($atts, $content = null) {
	extract(shortcode_atts(array("href"=>'http://'), $atts));		
	return '<span class="but-heart"><a href="'.$href.'" target="_blank"><span>'.$content.'</span></a></span>';
}
add_shortcode('butheart', 'button_heart');


function button_document($atts, $content = null) {
	extract(shortcode_atts(array("href"=>'http://'), $atts));		
	return '<span class="but-document"><a href="'.$href.'" target="_blank"><span>'.$content.'</span></a></span>';
}
add_shortcode('butdocument', 'button_document');

function button_link($atts, $content = null) {
	extract(shortcode_atts(array("href"=>'http://'), $atts));		
	return '<span class="but-link"><a href="'.$href.'" target="_blank"><span>'.$content.'</span></a></span>';
}
add_shortcode('butlink', 'button_link');



function button_music($atts, $content = null) {
	extract(shortcode_atts(array("href"=>'http://'), $atts));		
	return '<span class="but-music"><a href="'.$href.'" target="_blank"><span>'.$content.'</span></a></span>';
}
add_shortcode('butmusic', 'button_music');


function musiclink($atts, $content=null){
	extract(shortcode_atts(array("auto"=>'0',"replay"=>'0',),$atts));	
	return '<embed src="'.get_bloginfo("template_url").'/images/shortcode/dewplayer.swf?mp3='.$content.'&amp;autostart='.$auto.'&amp;autoreplay='.$replay.'" wmode="transparent" height="20" width="240" type="application/x-shockwave-flash" />';
}
add_shortcode('music','musiclink');

function post_toggle($atts, $content=null){
	extract(shortcode_atts(array("title"=>''),$atts));	
	return '<p class="toggle_title">'.$title.'</p><p class="toggle_content">'.$content.'</p>';
} 
add_shortcode('toggle','post_toggle');

//图片展示
function imglist_title($atts, $content = null) {
	return '<div class="imglist-title">'.$content.'</div>';
}
add_shortcode('imglist_title', 'imglist_title');

function imglist_imgs($atts, $content = null) {
	extract(shortcode_atts(array("src"=>'http://'), $atts));		
	return '<div class="imglist-imgs"><a class="cboxElement" href="'.$src.'" rel="colorbox"><img alt="'.$content.'" src="'.$src.'" /></a><h4 class="imglist-alt">'.$content.'</h4></div>';
}
add_shortcode('imglist_imgs', 'imglist_imgs');
function imglist_wrap($atts, $content = null) {
	extract(shortcode_atts(array("src"=>'http://'), $atts));		
	return '<h4 class="imglist-alt">'.$content.'</h4><div class="imglist-imgs"><a class="cboxElement" href="'.$src.'" rel="colorbox1"><img alt="'.$content.'" src="'.$src.'" /></a></div>';
}
//add_shortcode('imglist_wrap', 'imglist_wrap');

//倒计时
function daojishi($atts, $content=null){
	extract(shortcode_atts(array("name"=>''),$atts));
return '<p style="text-align: center;"><object width="256" height="128" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="src" value="'.get_bloginfo("template_url").'/images/shortcode/daojishi.swf?area='.$name.'&amp;endTime='.$content.'" /><param name="quality" value="high" /><embed width="256" height="128" type="application/x-shockwave-flash" src="'.get_bloginfo("template_url").'/images/shortcode/daojishi.swf?area='.$name.'&amp;endTime='.$content.'" quality="high" /></object></p>';
	}
add_shortcode('DaoJi','daojishi');


//回复内容可见				
function ATheme_reply_to_read($atts, $content=null) {
        extract(shortcode_atts(array("notice" => '<p class="yincang-tag shortcodestyle"><strong style="color:#f00;">温馨提示:</strong> 此处内容需要您<a href="#respond" title="评论本文">评论本文</a>后才能查看!如需审核，请等待，如有不便，敬请见谅！</p>'), $atts));  
        $email = null;   
        $user_ID = (int) wp_get_current_user()->ID;   
        if ($user_ID > 0) {   
            $email = get_userdata($user_ID)->user_email;   
            //对博主直接显示内容   
            $admin_email = get_bloginfo ('admin_email');  
			
            if ($email == $admin_email) {   
                return $content;   
            }   
        } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {   
            $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);   
        } else {   
            return $notice;   
        }   
        if (empty($email)) {   
            return $notice;   
        }   
        global $wpdb;   
        $post_id = get_the_ID();   
        $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";   
        if ($wpdb->get_results($query)) {   
            return do_shortcode($content);   
        } else {   
            return $notice;   
        }   
    }   
	
add_shortcode('reply', 'ATheme_reply_to_read');


///////////面板插入代码///////////
//HTML面板 在需要的页面再添加功能
if(		basename( $_SERVER['PHP_SELF']) == "page.php" 
		|| basename( $_SERVER['PHP_SELF']) == "page-new.php" 
		|| basename( $_SERVER['PHP_SELF']) == "post-new.php" 
		|| basename( $_SERVER['PHP_SELF']) == "post.php"
		|| basename( $_SERVER['PHP_SELF']) == "media-upload.php")
{
	add_action( 'admin_print_footer_scripts', 'Newer_shortcode_buttons', 100 );
function Newer_shortcode_buttons() {
	?>
	<script type="text/javascript">
		QTags.addButton( 'm', 'MP3Player', '[music]MP3地址[/music]');
		QTags.addButton( 'm2', '下载面板', '[down]这里输入内容[/down]');
		QTags.addButton( 'm3', '警告面板', '[warning]这里输入内容[/warning]');
		QTags.addButton( 'm4', '介绍面板', '[author]这里输入内容[/author]');
		QTags.addButton( 'm5', '文本面板', '[text]这里输入内容[/text]');
		QTags.addButton( 'm6', '教程面板', '[tutorial]这里输入内容[/tutorial]');
		QTags.addButton( 'm7', '项目面板', '[project]这里输入内容[/project]');
		QTags.addButton( 'm8', '错误面板', '[error]这里输入内容[/error]');
		QTags.addButton( 'm9', '提问面板', '[question]这里输入内容[/question]');
		QTags.addButton( 'm10', '链接面板', '[blink]这里输入内容[/blink]');
		QTags.addButton( 'm11', '代码面板', '[codee]这里输入内容[/codee]');
        QTags.addButton( 'm12', '下载按钮', '[butdown href="链接"]标题[/butdown]');
		QTags.addButton( 'm13', '爱心按钮', '[butheart href="链接"]标题[/butheart]');
		QTags.addButton( 'm14', '文档按钮', '[butdocument href="链接"]标题[/butdocument]');
		QTags.addButton( 'm15', '链接按钮', '[butlink href="链接"]标题[/butlink]');
		QTags.addButton( 'm16', '音乐按钮', '[butmusic href="链接"]标题[/butmusic]');
		QTags.addButton( 'm17', '下载按钮', '[butdown href="链接"]标题[/butdown]');
		QTags.addButton( 'imglist_title', '图库标题', '[imglist_title]标题[/imglist_title]');
		QTags.addButton( 'imglist_imgs', '图库图片', '[imglist_imgs src="链接"]标题[/imglist_imgs]');
		QTags.addButton( 'imglist_wrap', '图库包装', '<div class="imglist-wrapper imglist_wrap-序号">\n\t请再添加图库标题和图库内容，注意修改序号(imglist_wrap-1)\n</div>');
	</script>
	<?php }
	
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
?>