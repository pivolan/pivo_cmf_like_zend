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
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css" media="screen"/>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/jquery_plugin/vendor/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="/js/jquery_plugin/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="/js/jquery_plugin/jquery.fileupload.js"></script>
	<script type="text/javascript" src="/js/const.js"></script>
	<script type="text/javascript" src="/js/user.js"></script>
	<script type="text/javascript" src="/js/blog.js"></script>
	<script type="text/javascript" src="/js/profile.js"></script>
	<script type="text/javascript" src="/js/chat.js"></script>
	<script type="text/javascript" src="/js/uploads.js"></script>
	<script type="text/javascript" src="/js/file.js"></script>
	<script type="text/javascript" src="/js/layout/init.js"></script>
</head>
<body>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/">PiVo BlogChat</a>

			<p class="navbar-text pull-left"><span
				class="label">Дата регистрации: {$user.date_reg|date_format:'%d.%m.%Y'} </span></p>
			<ul class="nav">
				<li><a href="/login/url/{$user.url}">Получить короткую ссылку для входа</a></li>
			</ul>
			<p class="navbar-text pull-right">
				<a class="thumbnail pull-left" href="#">
					<img src="http://placekitten.com/26" alt="" plugin="change_avatar">
				</a>
				<span plugin="change_fio" data-target="#change_fio_input" data-fio="{$user.fio}" data-userid="{$user.id}">{$user.fio}({$user.id})</span>
				<input id="change_fio_input" type="text" class="input-small navbar-form hidden" value="{$user.fio}">

			</p>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span2">
					<form class="form-search">
						<input type="text" class="input input-small search-query " id="user-find-input"
							   placeholder="users">
					</form>
					<ul class="nav nav-pills nav-stacked user-list">
						<li class="active"><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
					</ul>
				</div>
				<div class="span8 ">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="alert alert-info" id="file-message">Перетащите сюда файлы для прикрепления к сообщению</div>
							<legend>New message</legend>
							<div class="control-group">
								<label class="control-label" for="input01">Text input</label>

								<div class="controls">
									<textarea name="message" id="chat-textarea" class="input-xlarge span6"
											  rows="3"></textarea>
									<ul class="nav nav-pills nav-stacked span6" id="files">
									</ul>
								</div>
							</div>
							<button id="submit" class="btn btn-primary" type="button">Send</button>
						</fieldset>
					</form>
					<div class="row messages">
					</div>
				</div>
				<div class="span2 ">
					<form class="form-search">
						<input type="text" class="input input-small search-query" placeholder="blogs" id="blogs">
					</form>
					<ul class="nav nav-pills nav-stacked" id="blog_list">
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>