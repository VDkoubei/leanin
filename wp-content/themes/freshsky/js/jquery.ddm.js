jQuery(document).ready(function($){
	var arrs = [
		'苍茫的短代码是我滴爱',                 
		'[down]这里写内容[/down]',         // 1
		'[warning]这里写内容[/warning]',
		'[author]这里写内容[/author]',
		'[text]这里写内容[/text]',
		'[tutorial]这里写内容[/tutorial]', // 5
		'[project]这里写内容[/project]',
		'[error]这里写内容[/error]',
		'[question]这里写内容[/question]',
		'[blink]这里写内容[/blink]',
		'[codee]这里写内容[/codee]',      // 10
		'[newdown title=标题]这里写内容[/newdown]',
		'[newwarning title=标题]这里写内容[/newwarning]',
		'[newauthor title=标题]这里写内容[/newauthor]',
		'[newtext title=标题]这里写内容[/newtext]',
		'[newtutorial title=标题]这里写内容[/newtutorial]',  // 15
		'[newproject title=标题]这里写内容[/newproject]',
		'[newerror title=标题]这里写内容[/newerror]',
		'[newquestion title=标题]这里写内容[/newquestion]',
		'[newlink title=标题]这里写内容[/newlink]',
		'[newcode title=标题]这里写内容[/newcode]',   // 20
		'[butdown href=这里写链接]这里写内容[/butdown]',
		'[butheart href=这里写链接]这里写内容[/butheart]',
		'[buttext href=这里写链接]这里写内容[/buttext]',
		'[butbox href=这里写链接]这里写内容[/butbox]',
		'[butsearch href=这里写链接]这里写内容[/butsearch]', // 25
		'[butdocument href=这里写链接]这里写内容[/butdocument]',
		'[butlink href=这里写链接]这里写内容[/butlink]',
		'[butnext href=这里写链接]这里写内容[/butnext]',
		'[butmusic href=这里写链接]这里写内容[/butmusic]', // 29
		'[music]这里写可外链音乐的链接[/music]',
		'[music auto=1]这里写可外链音乐的链接[/music]',
		'[toggle title=标题]这里写内容[/toggle]',       // 32
		'[embed]直接复制浏览器中的地址填入[/embed]',
		'[embed]直接复制浏览器中的地址填入[/embed]',
		'[embed]填写视频分享中的Flash地址[/embed]',
		'[embed]填写视频分享中的视频地址(在地址后多加一个斜杠/)[/embed]', // 36
		'[DaoJi name=\'目标时间\']2012-12-21-23-59-59[/DaoJi]' ,// 37倒计时
		'[reply]隐藏内容[/reply]' // 38回复可见
	];
	$('#ddm-button').click(function(e){
		e.preventDefault();
		$('#ddm-lay,#ddm-box').fadeIn();
		return false;
	});
	$('#ddm-close').click(function(e){
		e.preventDefault();
		$('#ddm-lay,#ddm-box').hide();
		return false;
	});
	$('#ddm-cate li a').click(function(e){
		e.preventDefault();
		if($(this).hasClass('current')) return false;
		var _this = $(this),
			_n = $('#ddm-cate li a').index(_this),
			_cateACurrrent = $('#ddm-cate li a.current'),
			_ddmCurrent = $('#ddm-ddm li.current'),
			_ddmNext = $('#ddm-ddm li').eq(_n);
		_cateACurrrent.removeClass('current');
		_ddmCurrent.removeClass('current');
		_this.addClass('current');
		_ddmNext.addClass('current');
		return false;
	});
	$('#ddm-ddm li a').click(function(e){
		e.preventDefault();
		var _this = $(this),
			_n = _this.attr('href'),
			_ddm = arrs[_n];
		if( $('#content').is(":visible") ){
			var _t = $('#content').val();
			$('#content').val( _t + _ddm ).focus();
		}else{
			var _ele = $('#content_ifr').contents().find("#tinymce"),
				_t = _ele.html();
			_ele.html(_t + _ddm).focus();
		}
		$('#ddm-close').click();
		return false;
	});
});