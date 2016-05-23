<?php

$pageinfo = array('full_name' => '"'.THEMENAME.'" 一般设置选项', 'optionname'=>'general', 'child'=>false, 'filename' => basename(__FILE__));

$options = array();
			
$options[] = array(	"type" => "open","desc" => "head区");


$options[] = array(	"type" => "group"); //分组用的

$options[] = array(
					"name" => "head区",
					"desc" => "在head中添加的内容",
					"type" => "title_inside",
					);

$options[] = array(
					"name" => "网站描述<br />Website Description",
					"desc" => "将网站描述的文字放在这里，一般不超过200字符，使用英文的逗号(,)隔开<br />Write the text of the website described here, generally no more than 200 characters, use commas (,) separated",
					"id" => "websiteDescription",
					"std" => get_bloginfo("description"),
					"size" =>5,
					"type" => "textarea"
					);

$options[] = array(
					"name" => "网站关键词<br />Website Keywords",
					"desc" => "将网站关键词的文字放在这里，一般不超过100字符，使用英文的逗号(,)隔开<br />Write the text of the website described here, generally no more than 200 characters, use commas (,) separated",
					"id" => "websiteKeywords",
					"std" => "请填写网站描述和关键词",
					"size" =>2,
					"type" => "textarea"
					);

$options[] = array(	"type" => "close");

/* =顶部选项
----------------------------------------------------------------------------*/
$options[] = array(	"type" => "open","desc" => "综合功能");

$options[] = array(
					"name" => "是否开启图片预加载",
					"desc" => "默认开启",
					"id" => "Lazyload",
					"type" => "radio",
					"buttons" => array('yes','no'),
					"std" => 1);
// $options[] = array(
// 					"name" => "是否开启ColorBox暗箱",
// 					"desc" => "默认开启",
// 					"id" => "ColorBox",
// 					"type" => "radio",
// 					"buttons" => array('yes','no'),
// 					"std" => 1);


$options[] = array(	"type" => "close");

/* =顶部选项
----------------------------------------------------------------------------*/
$options[] = array(	"type" => "open","desc" => "顶部选项");

$options[] = array(	"type" => "group"); //分组用的

$options[] = array(
					"name" => "顶部选项",
					"desc" => "页面顶部设置",
					"type" => "title_inside",
					);


$options[] = array(
					"name" => "移动版网站标志/Logo",
					"desc" => "为你的logo增加一个路径。如果为空，就会使用默认的logo。logo的指出为180像素*60像素（如果你的图片过大，请调节相应的style.css来适应问题）<br />
					Add the full URI path to your logo. the themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 180px * 60px (if your logo is larger you might need to modify style.css to align it perfectly)<br/> URI Exampe: http://www.yourdomain.com/path/to/image.jpg<br/>",
					"id" => "logo",
					"std" => "",
					"size" => 30,
					"type" => "upload"
					);




//==============================
//还未填写qq，微博等设置
//
$options[] = array(	"type" => "close");

/* =底部选项
----------------------------------------------------------------------------*/
$options[] = array(	"type" => "open","desc" => "底部选项");

$options[] = array(	"type" => "group"); //分组用的
$options[] = array(	
					"name" => "底部选项",
					"desc" => "想在底部显示自定义的内容，请在这里输入/支持html代码",
					"type" => "title_inside",
					);

$options[] = array(	
					"name" => "自定义版权备案",
					"desc" => "将底部备案版权的html内容复制粘贴到这里",
					"id" => "site_info",
					"size" => "5",
					"type" => "textarea"
					);

	



	
$options[] = array(	"type" => "close");
	
          

$options_page = new kriesi_option_pages($options, $pageinfo);
