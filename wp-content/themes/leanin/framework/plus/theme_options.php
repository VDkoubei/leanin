<?php
$themename = "iplaysoft";

function iplaysoft_add_option() {

	global $themename;

	//create new top-level menu under Presentation
	add_theme_page($themename." 主题设置", "".$themename." 主题设置", 'administrator', basename(__FILE__), 'iplaysoft_form');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {

	//register our settings
	register_setting( 'iplaysoft-settings', 'iplaysoft_tip');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_tip');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_showlazy');
	register_setting( 'iplaysoft-settings', 'iplaysoft_tongji');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topad');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_ad_topad');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner_link');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner_link2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_topbanner_link3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_navtopad');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_ad_navtopad');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_homesidebar');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_ad_homesidebar');
	register_setting( 'iplaysoft-settings', 'iplaysoft_ad_singlesidebar');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_ad_singlesidebar');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_slide');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_digu');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_avatar');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_avatar_link');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_title');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_title');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_link1');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_title1');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_link2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_title2');	
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_link3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_other_title3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_digu_jscode');	
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_link');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_des');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_pic_path');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_slide2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_link2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_des2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_pic_path2');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_slide3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_link3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_des3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_pic_path3');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide4');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_slide4');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_link4');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_des4');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_pic_path4');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide5');
	register_setting( 'iplaysoft-settings', 'iplaysoft_if_slide5');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_link5');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_des5');
	register_setting( 'iplaysoft-settings', 'iplaysoft_slide_pic_path5');
	}

function iplaysoft_form() {

	global $themename;

?>
<!-- Options Form begin -->
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br/></div>
	<h2><?php echo $themename; ?>设置</h2>
    <ul class="subsubsub" style="margin-top:15px; ">
    	<li><a href="#iplaysoft_bs"><strong>基本设置</strong></a> |</li>
		<li><a href="#iplaysoft_digu"><strong>嘀咕设置</strong></a> |</li>
		<li><a href="#iplaysoft_slide"><strong>幻灯片设置</strong></a> |</li>
		<li><a href="#iplaysoft_ad"><strong>广告设置</strong></a> |</li>
     </ul>
	<form method="post" action="options.php">
		<?php settings_fields('iplaysoft-settings'); ?>
		<table class="form-table">
			<tr valign="top">
            	<td><h3 id="iplaysoft_bs">基本设置</h3></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>网站公告<span class="description">(文本)</span></label></th>
                <td>
                    <textarea style="width:35em; height:5em;" name="iplaysoft_tip"><?php echo get_option('iplaysoft_tip'); ?></textarea>
                    <br />
                    <span class="description">网站首页中间的文字部分,可自由设置</span>
					<select name="iplaysoft_if_tip">
                        <option value="1" <?php if (get_option('iplaysoft_if_tip') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_tip') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select>
                </td>
        	</tr>
			 <tr valign="top">
            	<th scope="row"><label>设置图片延时加载<span class="description"></span></label></th>
                <td>
                	<select name="iplaysoft_if_showlazy">
                        <option value="1" <?php if (get_option('iplaysoft_if_showlazy') == '1') { echo 'selected="selected"'; } ?>>开启</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_showlazy') == '0') { echo 'selected="selected"'; } ?>>关闭</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>网站统计代码<span class="description">(CODE)</span></label></th>
                <td>
                    <textarea style="width:35em; height:5em;" name="iplaysoft_tongji"><?php echo get_option('iplaysoft_tongji'); ?></textarea>
                    <br />
                </td>
        	</tr>

			
			
			
			<tr valign="top">
            	<td><h3 id="iplaysoft_digu">嘀咕设置</h3></td>
        	</tr>
			
			<th scope="row"><label>是否开启嘀咕</label></th>
			 <td>
                	<select name="iplaysoft_if_digu">
                        <option value="1" <?php if (get_option('iplaysoft_if_digu') == '1') { echo 'selected="selected"'; } ?>>开启</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_digu') == '0') { echo 'selected="selected"'; } ?>>关闭</option>
                    </select>
                </td>
				
			
			 <tr valign="top">
                <th scope="row"><label>头像设置<span class="description">(文本)</span></label></th>
                <td>
 
					<input class="regular-text" style="width:38em;" type="text" value="<?php echo get_option('iplaysoft_digu_avatar'); ?>" name="iplaysoft_digu_avatar"/><br /> <span class="description">头像图片</span><br />
					
					
					<input class="regular-text" style="width:38em;" type="text" value="<?php echo get_option('iplaysoft_digu_avatar_link'); ?>" name="iplaysoft_digu_avatar_link"/><br /> <span class="description">头像链接地址</span><br />
					
					
					<input class="regular-text" style="width:38em;" type="text" value="<?php echo get_option('iplaysoft_digu_title'); ?>" name="iplaysoft_digu_title"/><br /> <span class="description">标题 如: < b>子强< /b>  的有感而发... </span><br />
					
                </td>
        	</tr>
			
			<tr valign="top">
                <th scope="row"><label>其它网站<span class="description">(文本)</span></label></th>
                <td>
					<input class="regular-text" style="width:38em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_title'); ?>" name="iplaysoft_digu_other_title"/><br /> <span class="description">说明文字</span><br />
					
					<input class="regular-text" style="width:10em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_title1'); ?>" name="iplaysoft_digu_other_title1"/>
					
					
					<input class="regular-text" style="width:28em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_link1'); ?>" name="iplaysoft_digu_other_link1"/><br />
					 <span class="description">第一个网站标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网站链接 例: http://www.bianiplaysoft.com</span><br />					 
					 <input class="regular-text" style="width:10em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_title2'); ?>" name="iplaysoft_digu_other_title2"/>
					  <input class="regular-text" style="width:28em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_link2'); ?>" name="iplaysoft_digu_other_link2"/><br />
					<span class="description">第二个网站标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网站链接 例: http://www.bianiplaysoft.com</span><br />					
					  <input class="regular-text" style="width:10em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_title3'); ?>" name="iplaysoft_digu_other_title3"/>
					  <input class="regular-text" style="width:28em;" type="text" value="<?php echo get_option('iplaysoft_digu_other_link3'); ?>" name="iplaysoft_digu_other_link3"/><br />
					<span class="description">第三个网站标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网站链接 例: http://www.bianiplaysoft.com</span><br />

                </td>
        	</tr>
			 <tr valign="top">
                <th scope="row"><label>嘀咕JS代码<span class="description">(CODE)</span></label></th>
                <td>
                    <textarea style="width:35em; height:5em;" name="iplaysoft_digu_jscode"><?php echo get_option('iplaysoft_digu_jscode'); ?></textarea>
                    <br />
					<span class="description">可以通过 www.digushow.com获取到代码 </span><br />

                </td>
        	</tr>
			
            <tr valign="top">
            	<td><h3 id="iplaysoft_slide">首页幻灯片设置</h3></td>
        	</tr>
			 <tr valign="top">
                <th scope="row"><label>第一张幻灯片 </label><select name="iplaysoft_if_slide">
                        <option value="1" <?php if (get_option('iplaysoft_if_slide') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_slide') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select></th>
                <td>
				
				 <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide'); ?>" name="iplaysoft_slide"/>
				  <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_des'); ?>" name="iplaysoft_slide_des"/><br /><span class="description">设置幻灯片的标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;设置幻灯片的描述(大约24个字符)</span><br />
				  
				   <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide_pic_path'); ?>" name="iplaysoft_slide_pic_path"/>
				   <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_link'); ?>" name="iplaysoft_slide_link"/><br /><span class="description">图片路径&nbsp;&nbsp;如: /plus/slide/1.jpg&nbsp;&nbsp;&nbsp;设置幻灯片的链接&nbsp;&nbsp;&nbsp;&nbsp; 如: http://www.bianiplaysoft.com</span><br />
                </td>
        	</tr>	
				<tr valign="top">
                <th scope="row"><label>第二张幻灯片 </label><select name="iplaysoft_if_slide2">
                        <option value="1" <?php if (get_option('iplaysoft_if_slide2') == '1') { echo 'selected="selected2"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_slide2') == '0') { echo 'selected="selected2"'; } ?>>不显示</option>
                    </select></th>
                <td>
				 <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide2'); ?>" name="iplaysoft_slide2"/>
				  <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_des2'); ?>" name="iplaysoft_slide_des2"/><br /><span class="description">设置幻灯片的标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;设置幻灯片的描述(大约24个字符)</span><br />
				  
				   <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide_pic_path2'); ?>" name="iplaysoft_slide_pic_path2"/>
				   <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_link2'); ?>" name="iplaysoft_slide_link2"/><br /><span class="description">图片路径&nbsp;&nbsp;如: /plus/slide/2.jpg&nbsp;&nbsp;&nbsp;设置幻灯片的链接&nbsp;&nbsp;&nbsp;&nbsp; 如: http://www.bianiplaysoft.com</span><br />
                </td>
        	</tr>	
				<tr valign="top">
                <th scope="row"><label>第三张幻灯片 </label><select name="iplaysoft_if_slide3">
                        <option value="1" <?php if (get_option('iplaysoft_if_slide3') == '1') { echo 'selected="selected2"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_slide3') == '0') { echo 'selected="selected2"'; } ?>>不显示</option>
                    </select></th>
                <td>
				<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide3'); ?>" name="iplaysoft_slide3"/>
				  <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_des3'); ?>" name="iplaysoft_slide_des3"/><br /><span class="description">设置幻灯片的标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;设置幻灯片的描述(大约24个字符)</span><br />
				  
				   <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide_pic_path3'); ?>" name="iplaysoft_slide_pic_path3"/>
				   <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_link3'); ?>" name="iplaysoft_slide_link3"/><br /><span class="description">图片路径&nbsp;&nbsp;如: /plus/slide/3.jpg&nbsp;&nbsp;&nbsp;设置幻灯片的链接&nbsp;&nbsp;&nbsp;&nbsp; 如: http://www.bianiplaysoft.com</span><br />
				
                </td>
        	</tr>	
			
				<tr valign="top">
                <th scope="row"><label>第四张幻灯片 </label><select name="iplaysoft_if_slide4">
                        <option value="1" <?php if (get_option('iplaysoft_if_slide4') == '1') { echo 'selected="selected2"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_slide4') == '0') { echo 'selected="selected2"'; } ?>>不显示</option>
                    </select></th>
                <td>
				<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide4'); ?>" name="iplaysoft_slide4"/>
				  <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_des4'); ?>" name="iplaysoft_slide_des4"/><br /><span class="description">设置幻灯片的标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;设置幻灯片的描述(大约24个字符)</span><br />
				  
				   <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide_pic_path4'); ?>" name="iplaysoft_slide_pic_path4"/>
				   <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_link4'); ?>" name="iplaysoft_slide_link4"/><br /><span class="description">图片路径&nbsp;&nbsp;如: /plus/slide/4.jpg&nbsp;&nbsp;&nbsp;设置幻灯片的链接&nbsp;&nbsp;&nbsp;&nbsp; 如: http://www.bianiplaysoft.com</span><br />
				
                </td>
        	</tr>	
				
			<tr valign="top">
                <th scope="row"><label>第五张幻灯片 </label><select name="iplaysoft_if_slide5">
                        <option value="1" <?php if (get_option('iplaysoft_if_slide5') == '1') { echo 'selected="selected2"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_slide5') == '0') { echo 'selected="selected2"'; } ?>>不显示</option>
                    </select></th>
                <td>
				<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide5'); ?>" name="iplaysoft_slide5"/>
				  <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_des5'); ?>" name="iplaysoft_slide_des5"/><br /><span class="description">设置幻灯片的标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;设置幻灯片的描述(大约24个字符)</span><br />
				  
				   <input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_slide_pic_path5'); ?>" name="iplaysoft_slide_pic_path5"/>
				   <input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_slide_link5'); ?>" name="iplaysoft_slide_link5"/><br /><span class="description">图片路径&nbsp;&nbsp;如: /plus/slide/5.jpg&nbsp;&nbsp;&nbsp;设置幻灯片的链接&nbsp;&nbsp;&nbsp;&nbsp; 如: http://www.bianiplaysoft.com</span><br />
				
                </td>
        	</tr>	
			<tr valign="top">
            	<td><h3 id="iplaysoft_ad">广告设置</h3></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>首页导航下面广告</label></th>
                <td>
				<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner'); ?>" name="iplaysoft_ad_topbanner"/>
				<input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner_link'); ?>" name="iplaysoft_ad_topbanner_link"/><br />
				<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner2'); ?>" name="iplaysoft_ad_topbanner2"/>
				<input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner_link2'); ?>" name="iplaysoft_ad_topbanner_link2"/><br />
				
					<input class="regular-text" style="width:15em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner3'); ?>" name="iplaysoft_ad_topbanner3"/>
				<input class="regular-text" style="width:30em;" type="text" value="<?php echo get_option('iplaysoft_ad_topbanner_link3'); ?>" name="iplaysoft_ad_topbanner_link3"/><br />
					<span class="description">直接放入广告代码即可,&nbsp;&nbsp;&nbsp;&nbsp;是否显示该广告:</span><select name="iplaysoft_if_ad_topad">
                        <option value="1" <?php if (get_option('iplaysoft_if_ad_topad') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_ad_topad') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select>
                </td>
        	</tr>
			
            <tr valign="top">
                <th scope="row"><label>首页首篇文章广告</label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="iplaysoft_ad_navtopad"><?php echo get_option('iplaysoft_ad_navtopad'); ?></textarea>
                    <br />
					<span class="description">直接放入广告代码即可, size: 250*250 &nbsp;&nbsp;&nbsp;&nbsp;是否显示该广告:</span>
					<select name="iplaysoft_if_ad_navtopad">
                        <option value="1" <?php if (get_option('iplaysoft_if_ad_navtopad') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_ad_navtopad') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select>
                </td>
        	</tr>			
			
            <tr valign="top">
                <th scope="row"><label>首页边栏广告</label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="iplaysoft_ad_homesidebar"><?php echo get_option('iplaysoft_ad_homesidebar'); ?></textarea>
                    <br />
			<span class="description">直接放入广告代码即可, size: width=250 &nbsp;&nbsp;&nbsp;&nbsp;是否显示该广告:</span>

<select name="iplaysoft_if_ad_homesidebar">
                        <option value="1" <?php if (get_option('iplaysoft_if_ad_homesidebar') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_ad_homesidebar') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select>                </td>
        	</tr>
         
            <tr valign="top">
                <th scope="row"><label>文章页边栏广告</label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="iplaysoft_ad_singlesidebar"><?php echo get_option('iplaysoft_ad_singlesidebar'); ?></textarea>
                    <br />
					<span class="description">设置格式为: < li>代码... < /li> (可显示4个) size:125*125   &nbsp;&nbsp;&nbsp;&nbsp;是否显示该广告:</span>
<select name="iplaysoft_if_ad_singlesidebar">
                        <option value="1" <?php if (get_option('iplaysoft_if_ad_singlesidebar') == '1') { echo 'selected="selected"'; } ?>>显示</option>
                        <option value="0" <?php if (get_option('iplaysoft_if_ad_singlesidebar') == '0') { echo 'selected="selected"'; } ?>>不显示</option>
                    </select>                </td>
        	</tr>
		</table>
		<p class="submit">
		<input type="submit" name="save" id="button-primary" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
        <p style="margin-bottom:60px;">本网站主题由<a href="http://wwww.bianiplaysoft.com/" target="_blank">子强</a>仿制</p>
	</form>
    <style type="text/css"> span.description{ font-style:normal;} .form-table h3{ padding:5px 10px 4px; color:#FFF; background-color:#0086E3;}</style>
</div>
<!-- Options Form begin -->
<?php } 
	// create custom plugin settings menu
	add_action('admin_menu', 'iplaysoft_add_option');
?>