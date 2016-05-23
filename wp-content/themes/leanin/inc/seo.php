<?php
global $h_option;
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
$website_description = $h_option['general']['websiteDescription'];
$website_keywords = $h_option['general']['websiteKeywords'];
if (is_single() || is_page() ) { //文章页
  if ($post->post_excerpt) {
        $description = $post->post_excerpt;
        $description =  DeleteHtml(strip_tags($description));
    } else {
      if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
        $post_content = $result['1'];
      } else {
        $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
        $post_content = $post_content_r['0'];
      }
        $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
       $keywords = $keywords . $tag->name . ",";
    }
    $keywords = (is_page()) ? $website_keywords: $keywords  ;
}elseif (is_archive()) {
  $description = category_description() ? DeleteHtml(category_description()) : $website_description;
  $keywords = wp_title('',false).','.$website_keywords;
}elseif ( function_exists('is_tag') && is_tag() ) {
  $description=tag_description() ? DeleteHtml(tag_description()):$website_description;
  $keywords = single_tag_title('"').','.$website_keywords;
} else {
  $description = $website_description;
  $keywords = $website_keywords;
}

echo '<meta name="description" content="'.trim($description).'" />';
echo '<meta name="keywords" content="'.rtrim($keywords,',').'" />';
?>
