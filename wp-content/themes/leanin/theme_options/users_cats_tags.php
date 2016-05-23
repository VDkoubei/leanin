<?php
$users = get_option("kriesi_leanin_users");
$users_list=explode(",", $users["websiteUsers"]);
//echo $users_list;
//print_r($users_list);

$pageinfo = array('full_name' => '特定用户', 'optionname'=>'users', 'child'=>true, 'filename' => basename(__FILE__));

$options = array();
			
$options[] = array(
					"name" => "用户区",
					"desc" => "增加特定用户，以显示特定的标注，分类，标签<br /需要多刷新几次才会出现>",
					"type" => "title",
					);

$options[] = array(	"type" => "open",
					"desc" => "添加特定浏览用户" 
					);

$options[] = array(	"type" => "group"
					); //分组用的

$options[] = array(
					"name" => "增加用户",
					"desc" => "请用英文设置别名(slug)，为之后的设置提供独特的标识符，<br />使用英文的逗号( , )隔开，提交后才会显示下面细节设置",
					"id" => "websiteUsers",
					"std" => "cms",
					"size" =>3,
					"type" => "textarea"
					);



$options[] = array(	"type" => "close");

/* =用户设置
----------------------------------------------------------------------------*/

foreach ($users_list as $users_slug) {
	$options[] = array(	"type" => "open",
						"desc" => $users_slug." 用户设置");

	$options[] = array(	"name" => $users_slug."<br />用户名称",
					"desc" => "请".$users_slug."为填写名称",
					"id" => $users_slug."Name",
					"size" => "10",
					"std"=>"用户名称",
					"type" => "text"
					);
	$options[] = array(	"name" => $users_slug."<br />用户名称",
					"desc" => "请".$users_slug."为填写名称",
					"id" => $users_slug."Description",
					"size" => "2",
					"std"=>"用户描述",
					"type" => "textarea"
					);

	$options[] = array(	"name" => $users_slug."<br />特定页面",
						"desc" =>  "请".$users_slug."为选择页面",
			            "id" => $users_slug."Pages",
			            "type" => "multi",
			            "subtype" => "page");

	$options[] = array(	"name" => $users_slug."<br />特定分类",
						"desc" =>  "请".$users_slug."为选择分类",
			            "id" => $users_slug."Cats",
			            "type" => "multi",
			            "subtype" => "cat");

	$options[] = array(	"name" => $users_slug."<br />特定标签",
						"desc" =>  "请".$users_slug."为选择标签",
			            "id" => $users_slug."Tags",
			            "type" => "multi",
			            "subtype" => "tag");


	$options[] = array(	"type" => "close");


	
}//end foreach
/*----------------------------------------------------------------*/


$options_page= new kriesi_option_pages($options, $pageinfo);

