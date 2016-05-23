<?php
$pageinfo = array('full_name' => '侧边栏', 'optionname'=>'includes', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open"),
	   array(	"name" => "侧边栏小工具/Sidebar Widgets",
			"desc" => "",
			"type" => "title_inside",
			),

	array(	"name" => "为特定的页面配置额外的小工具<br />Extra Widget Areas for specific Pages",
			"desc" => "为页面增加小工具,这样你就就能在页面侧边栏里添加不同的内容. <br/>
						当你选定完页面后,就增加工具到新的小工具区域中 <a href='widgets.php'>小工具设置页面</a>.<br/><br/>
						<strong>注意</strong> 当你移动小工具区域:你必须注意删除的小工具区域不能你的列表的最后一个 <br/> 推荐避免这些.如果你想知道更多的这样关于这的话题,请阅读本主题自带的文档说明<br />",
            "id" => "multi_widget",
            "type" => "multi",
            "subtype" => "page"),
            
	array(	"name" => "为特定的分类配置额外的小工具<br />Extra Widget Areas for specific Categories",
			"desc" => "为分类目录增加小工具,这样你就就能在分类目录侧边栏里添加不同的内容.<br/>
						当你选定完分类目录后,就增加工具到新的小工具区域中 <a href='widgets.php'>小工具设置页面</a>.<br/><br/>

						<strong>注意</strong> 当你移动小工具区域:你必须注意删除的小工具区域不能你的列表的最后一个 <br/> 推荐避免这些.如果你想知道更多的这样关于这的话题,请阅读本主题自带的文档说明<br />",

            "id" => "multi_widget_cat",
            "type" => "multi",
            "subtype" => "cat"),
 
 	array(  "name" => "当你选择分类目录选择侧边栏区域同时影响该分类下的文章<br />Display Widget areas for categories on posts of that category as well",
			"desc" => "如果你选择一个特定的文章区域，是否会同时会影响到这个分类下的文章页面<br />If you have set special widget areas for categories you can choose to display them on the single post view as well, if that category is applied to this post",
            "id" => "single_post_multi_widget_cat",
            "type" => "radio",
            "buttons" => array('yes','no'),
            "std" => 1),
            
	array(  "name" => "显示虚拟的(默认)侧边栏<br />Display 'dummy' sidebars widgets",
			"desc" => "当没有为特定的页面或者分类设置侧边栏，是否显示默认边栏<br />When no sidebar widgets are set for a specific post page or category should the theme set default dummy sidebars?",
            "id" => "dummy_sidebars",
            "type" => "radio",
            "buttons" => array('yes','no'),
            "std" => 1),
            

	array(	"type" => "close")

);



$options_page = new kriesi_option_pages($options, $pageinfo);

#####################################################################
# Define Sidebars 定义侧边栏
#####################################################################
 // 这个功能是干嘛的
if($h_option['includes']['sidebarCount'] == 2){
	$h_option['custom']['sidebars'] = array('left','right');
}
else
{
	$h_option['custom']['sidebars'] = array('left');
}

$h_option['custom']['footer'] = array('left','center','right');