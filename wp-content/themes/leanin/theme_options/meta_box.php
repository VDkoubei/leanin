<?php
global $h_option; //在文章页 添加文章的自定义字段

/**
 * 下载地址
 * @var array
 */
//$index = get_option("kriesi_leanin_index");
//print_r($index);
if ($h_option['index']['SlideshowPostsFrom']== 4) {
	$options = array();

	$boxinfo = array('title' => '幻灯片文章', 'id'=>'slideshow', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');


	$options[] =    array(	"name" => "<strong>CMS幻灯片文章</strong>",
							"desc" => "",
					        "id" => "_index_slideshow_sort",
					        "type" => "dropdown",
					        "std" => "no",
					        "subtype" => array(
					        					1 => '第一篇文章',
					        					2 => '第二篇文章',
					        					3 => '第三篇文章',
					        					4 => '第四篇文章',
					        					5 => '第五篇文章'
					        			)
					        );


	$new_box= new kriesi_meta_box($options, $boxinfo);

}

$options = array();

$boxinfo = array('title' => '附件地址', 'id'=>'download', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');

$options[] = array(
					"name" => "<strong>附件地址</strong>",
					"desc" => "请点击“上传附件”上传",
					"id" => "post_one_attachment",
					"std" => "",
					"button_label" => "上传附件",
					"size" => 60,
					"type" => "media"
					);
$new_box2= new kriesi_meta_box($options, $boxinfo);

/**
 * 幻灯片选项
 * @var array
 */
/*$options = array();
$boxinfo = array('title' => '首页幻灯片选项', 'id'=>'gallery_addition', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');

// $options[] = array(
// 					"name" => "<strong>下载地址</strong>",
// 					"desc" => "请输入文件下载地址",
// 					"id" => "downloadUrl",
// 					"size"=>60,
// 					"type" => "text"
// 					);
		


$options[] =    array(	"name" => "<strong>首页幻灯片文章</strong>",
			"desc" => "",
	        "id" => "_index_slideshow_sort",
	        "type" => "dropdown",
	        "std" => "no",
	        "subtype" => array(
	        					'第一篇文章'=>1,
	        					'第二篇文章'=>2,
	        					'第三篇文章'=>3,
	        					'第四篇文章'=>4,
	        					'第五篇文章'=>5
	        			));
		
$new_box2 = new kriesi_meta_box($options, $boxinfo);
*/
/* 
$options = array();
$boxinfo = array('title' => '文章缩略图选项', 'id'=>'post_thumb_overwrite', 'page'=>array('post','page'), 'context'=>'side', 'priority'=>'low', 'callback'=>'');

$options[] = array(	"name" => "<strong>缩略图重写选项</strong><br/>预览图将自动生成,如果你不喜欢这样,可以手动添加一个图片",
			"type" => "title");
*/
		

			
			
// $options[] =    array(	"name" => "<strong>图片链接</strong>",
// 			"desc" => "<br />当你在文章页或者页面中点击一个图片的时候,会触发?",
// 	        "id" => "_prev_image_link",
// 	        "type" => "dropdown",
// 	        "std" => "lightbox",
// 	        "subtype" => array('在lightbox中展开大版本图片'=>'lightbox','打开额外资源'=>'external','没有任何链接'=>'none'));
			
			
			
// $options[] = array(	"name" => "lightbox不仅仅能容纳一个大版本的图片,更能容纳一个视频或者图片",
// 			"type" => "title");
		

// $options[] = array(	"name" => "<strong>lightbox的充实大小的图片或者视频</strong>",
// 			"desc" => "允许图片或者视频",
// 			"id" => "_preview_big",
// 			"std" => "",
// 			"button_label" => "插入图片/视频",
// 			"size" => 31,
// 			"type" => "media");

// $new_box = new kriesi_meta_box($options, $boxinfo);






// $options = array();
// $boxinfo = array('title' => '附加的文章或者页面选项', 'id'=>'extra_option', 'page'=>array('post','page'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');
			
// $options[] = array(	"name" => "预览地址</strong><br/>在这里输入预览地址.",
// 			"desc" => "",
// 			"id" => "_previewadd",
// 			"std" => "",
// 			"size" => 70,
// 			"type" => "text");
// $options[] =array(	"name" => "官方介绍</strong><br/>在这里输入官方介绍地址.",
// 			"desc" => "",
// 			"id" => "_introadd",
// 			"std" => "",
// 			"size" => 70,
// 			"type" => "text");


// $new_box3 = new kriesi_meta_box($options, $boxinfo);




// $options[] = array(	"name" => "<strong>外部链接</strong><br/>定义一个外部链接,当你点击特色图片的时候就打开这个链接",
// 			"desc" => "",
// 			"id" => "_external",
// 			"std" => "",
// 			"size" => 70,
// 			"type" => "text");

// $new_box3 = new kriesi_meta_box($options, $boxinfo);



