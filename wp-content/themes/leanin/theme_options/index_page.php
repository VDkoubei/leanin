<?php
$pageinfo = array('full_name' => '首页选项', 'optionname'=>'index', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open","desc" => "幻灯片设置选项"),

/* =幻灯片
--------------------------------------------------------------------*/
	array(
			"name" => "幻灯片SlideShow",
			"desc" => "使用置顶文章、特定分类的文章或者输入文章的ID",
			"type" => "title_inside",
			),

	array(	"name" => "幻灯片来源",
			"desc" => "幻灯片文章的来源设置",
            "id" => "SlideshowPostsFrom",
            "type" => "radio",
            "std" => 1,
            "buttons" => array(
				            	"置顶文章",
				            	"特定分类",
				            	"特定文章ID",
				            	"编辑区选择"
				            	)
            ),

	array(	"name" => "文章数量",
			"desc" => "置顶文章或特定分类文章的数量",
            "id" => "SlideshowPostsLimits",
            //"std" => 5,
            //"size" =>3,
            "type" => "dropdown",
            "subtype"=>array(
            				'1'=>'1',
            				'2'=>'2',
            				'3'=>'3',
            				'4'=>'4',
            				'5'=>'5',
            				'5'=>'5',
            				'6'=>'6',
            				'7'=>'7',
            				'8'=>'8',
            				'9'=>'9',
            				'10'=>'10',
            				)
            ),

	array(	"name" => "幻灯片文章分类",
			"desc" => "在幻灯片文章的来源分类",
            "id" => "SlideshowPostsCats",
            "type" => "multi",
            "subtype" => "cat"
            ),

	array(	"name" => "幻灯片特定文章",
			"desc" => "幻灯片设置",
            "id" => "SlideshowPostsIds",
            "type" => "text"
            ),

	
	array(	"type" => "group"), //分组用的
	array(
			"name" => "显示幻灯片区域",
			"desc" => "在那些地方显示幻灯片及其对应的小工具",
			"type" => "title_inside",
			),
	array(	"type" => "group"), //分组用的

	array(	"name" => "显示幻灯片区域的分类",
			"desc" => "在分类归档显示幻灯片的",
            "id" => "SlideshowDisplayCats",
            "type" => "multi",
            "subtype" => "cat"),

	array(	"name" => "显示幻灯片区域的页面",
			"desc" => "在分类归档显示幻灯片的",
            "id" => "SlideshowDisplayPages",
            "type" => "multi",
            "subtype" => "page"),


array(	"type" => "close"),

array(	"type" => "open","desc" => "CMS选项"),
/* =CMS多分类
--------------------------------------------------------------------*/
		
	array(	"type" => "group"), //分组用的
	array(
			"name" => "CMS选项第一行",
			"desc" => "淡淡的",
			"type" => "title_inside",
			),

//通知公告
    array(  "name" => "通知公告",
            "desc" => "通知公告id",
            "id" => "index_notice",
            "type" => "dropdown",
            "subtype" => "cat"),

    array(  "name" => "通知公告文章数量",
            "desc" => "通知公告数量",
            "id" => "index_notice_limit",
            "std" => 12,
            "size" => 3,
            "type" => "text"
            ),

//首页右侧图片
    array(  "name" => "首页右侧图片",
            "desc" => "首页右侧图片id",
            "id" => "index_right_cat",
            "type" => "dropdown",
            "subtype" => "cat"),

    array(  "name" => "首页右侧图片文章数量",
            "desc" => "首页右侧图片数量",
            "id" => "index_right_cat_limit",
            "std" => 5,
            "size" => 3,
            "type" => "text"
            ),

    array(	"type" => "group"), //分组用的
	array(
			"name" => "CMS选项第二行",
			"desc" => "淡淡的",
			"type" => "title_inside",
			),
// 学术交流
    array(  "name" => "最新活动",
            "desc" => "最新活动的id",
            "id" => "index_activities",
            "type" => "dropdown",
            "subtype" => "cat"),

    array(  "name" => "文章数量",
            "desc" => "最新活动数量",
            "id" => "index_activities_limit",
            "std" => 5,
            "size" => 3,
            "type" => "text"
            ),








array(	"type" => "close"),
			
);

$options_page = new kriesi_option_pages($options, $pageinfo);
