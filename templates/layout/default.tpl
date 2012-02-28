<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta content="" name="keywords">
	<meta content="" name="description">
	<meta content="{$user.id}" name="user_id">
	<title>Блого чат</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<LINK REL="SHORTCUT ICON" HREF="/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/css/layout/style.css" media="screen"/>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery_plugin/jquery.fileupload.allinone.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/uploads.js"></script>
	<script type="text/javascript" src="/js/chat.js"></script>
	<script type="text/javascript" src="/js/user.js"></script>
	<script type="text/javascript" src="/js/const.js"></script>
	<script type="text/javascript" src="/js/layout/init.js"></script>
</head>
<body>
<div class="head">
	<span class="date">Дата регистрации: <span id="date-register">{$user.date_reg|date_format:'%d.%m.%Y'}</span></span>
	<span class="quick-enter">Быстрый вход: <a href="/login/url/{$user.url}" id="quick-enter">URL</a></span>

	<a href="/settings" id="gbi5"></a>
	<span class="profile">
		<span class="ava"><a href="/img/user/1/ava-full.jpg"><img
			src="http://placekitten.com/26"
			alt="Перетащите сюда картинку для смены аватарки"></a></span>
		<span class="name" id="name" title="Нажмите чтобы изменить свое имя">{$user.fio}({$user.id})</span>
	</span>
</div>
<div class="main">
	<div class="common">
		<div class="left">
		{block 'left'}
			<div class="menu_title">Поиск по пользователям</div>
			<input type="text" name="user-find" id="user-find-input">

			<div id="user_loader" style="display: none"></div>
			<div class="user-list">
				<div class="user-item">
					<a href="/img/user/1/ava-full.jpg" class="ava"><img
						src="http://placekitten.com/26"
						alt="" width="26" height="26" align="middle"></a>
					<a href="/user/2" class="name">Guest</a>
				</div>
			</div>
		{/block}
		</div>
		<div class="right">
		{block 'right'}
			<div class="menu_title">Поиск по теме</div>
			<input type="text" name="blog-find" id="blog-find-input">

			<div class="blog-list">
				<div class="blog-item">
					<a href="/img/blog/1/ava-full.jpg" class="ava"><img
						src="http://placekitten.com/26"
						alt="" width="26" height="26" align="middle"></a>
					<a href="/user/2" class="name">Написание своего блога</a>
				</div>
			</div>
		{/block}
		</div>
		<div class="content">
		{block 'content'}
			<div class="chat">
				<div class="help">Чтобы прикрепить файлы, перетащите их сюда из проводника.</div>
				<input type="file" multiple>
				<textarea name="chat" id="chat-textarea" cols="50" rows="5"></textarea>
				<input id="submit" type="submit" value="send">

				<ol class="filelist">
					<li>
						<img src="/img/ico/archive.png" alt="архив">
						<span class="title">вася тут был.rar</span>
						<span class="mark">[6fg]</span>
						<a href="/delete/" class="delete"><img class="delete" src="/img/ico/delete.png"
															   alt="удалить"></a>
					</li>
					<li>
						<img src="/img/ico/image.png" alt="картинка">
						<span class="title">img315654.jpg</span>
						<span class="mark">[6fg]</span>
						<a class="preview" href="/img/blog/temp/IMG_1672.JPG"><img class="preview"
																				   src="/img/blog/temp/IMG_1672-16.jpg"
																				   alt="" height="16"></a>
						<a href="/delete/" class="delete"><img class="delete" src="/img/ico/delete.png"
															   alt="удалить"></a>
					</li>
				</ol>
			</div>
			<div id="blog_loader" style="display: none"></div>
			<div class="messages">

			</div>
		{/block}
		</div>
		<div class="clear"></div>
	</div>
	<div class="foot">
	{block 'test'}
		
		{/block}
	</div>
</div>
</body>
</html>