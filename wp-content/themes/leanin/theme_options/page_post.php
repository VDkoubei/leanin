<?php
$pageinfo = array('full_name' => '分类/文章', 'optionname'=>'page_post', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	
	array(	"type" => "close"),
	array(	"type" => "open","desc" => "分类页选项"),

	// //视频墙分类
	// array(	"name" => "分类设置",
	// 		"desc" => "选择显示视频墙的分类",
 //            "type" => "title_inside"),
 //            
	
    array(	"name" => "多分类文章数量",
					"desc" => "多分类下每个分类显示的数量",
					"id" => "multi_category_limit",
					"size" => 3,
					"std"=>"6",
					"type" => "text"
			),


	//正序显示的文章
	array(	"name" => "正序显示",
			"desc" => "选择正序显示的分类",
            "id" => "cats_ASC",
            "type" => "multi",
            "subtype" => "cat"), 


	//正序显示的文章
	array(	"name" => "班级风采",
			"desc" => "请选择班级风采的分类",
            "id" => "class_style_cats",
            "type" => "dropdown",
            "subtype" => "cat"),  

		//正序显示的文章
	array(	"name" => "团训",
			"desc" => "请选择团训的分类",
            "id" => "tuanxun_cats",
            "type" => "dropdown",
            "subtype" => "cat"),  

    //正序显示的文章
	array(	"name" => "学科与专业，有摘要",
			"desc" => "学科与专业，有摘要",
            "id" => "cats_has_majar_pef",
            "type" => "multi",
            "subtype" => "cat"),  

	// 		),

	// array(	"name" => "所有文章",
	// 		"desc" => "该混合列表分类显示所有文章",
	// 		"id" => "multi_category_all_if",
	// 		"type" => "radio",
	// 		'buttons'=>array('显示所有',
	// 						'有限数量'	)





    //图片墙分类
	array(	"name" => "图片墙分类",
			"desc" => "选择显示视频墙的分类",
            "id" => "pic_cats",
            "type" => "multi",
            "subtype" => "cat"),


	array(	"name" => "图片墙文章数量",
					"desc" => "在一级分类下，图片墙文章数量",
					"id" => "pic_cats_limit",
					"size" => 3,
					"std"=>"4",
					"type" => "text"
		),

	array(	"name" => "弹出式图片分类",
			"desc" => "弹出式图片分类",
            "id" => "colorbox_pic_cats",
            "type" => "multi",
            "subtype" => "cat"),

	array(  "name" => "是否显示侧边栏",
			"desc" => "在弹出式图片墙分类是否显示侧边栏",
            "id" => "colorbox_pic_sidebar_if",
            "type" => "radio",
            "buttons" => array('yes','no'),
            "std" => 2),
	//视频墙分类
	// array(	"name" => "视频墙分类",
	// 		"desc" => "选择显示视频墙的分类",
 //            "id" => "VideoCats",
 //            "type" => "multi",
 //            "subtype" => "cat"),
	// array(	"name" => "视频墙摘要",
	// 		"desc" => "选择显示视频墙的分类",
 //            "id" => "VideoMeta_can",
 //            "type" => "radio",
 //            "buttons" => array('yes','no'),
 //            "std" => 1),

	// array(	"name" => "视频墙摘要",
	// 		"desc" => "选择显示视频墙的分类",
 //            "id" => "PicMeta_can",
 //            "type" => "radio",
 //            "buttons" => array('yes','no'),
 //            "std" => 1),




	// //会员的权限页面
	// array(	"name" => "会员权限",
	// 		"desc" => "注册后被提升为作者以上的权限才能见到的页面",
 //            "id" => "Member_can",
 //            "type" => "multi",
 //            "subtype" => "tag"),
            
 //    //分类或文章页 侧边栏是否显示
	// array(	"name" => "侧边栏显示",
	// 		"desc" => "分类或文章页的侧边栏是否显示",
 //            "id" => "SidebarCatPost_can",
 //            "type" => "multi",
 //            "subtype" => "cat"),

	// //页面 侧边栏是否显示
	// array(	"name" => "侧边栏显示",
	// 		"desc" => "页面的侧边栏是否显示",
 //            "id" => "SidebarPage_can",
 //            "type" => "multi",
 //            "subtype" => "page"),
            
	array(	"type" => "close")


	
			
);

$options_page = new kriesi_option_pages($options, $pageinfo);
