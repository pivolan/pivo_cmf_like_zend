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
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
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
					<img src="http://placekitten.com/26" alt="">
				</a>
			{$user.fio}({$user.id})
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
						<input type="text" class="input input-mini search-query" placeholder="users">
						<button class="btn" type="submit"><i class="icon-search"></i></button>
					</form>
					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
					</ul>
				</div>
				<div class="span8 ">
					<form class="form-horizontal">
						<fieldset>
							<legend>New message</legend>
							<div class="control-group">
								<label class="control-label" for="input01">Text input</label>
								<div class="controls">
									<textarea name="message" id="input10" class="input-xlarge" rows="3"></textarea>
								</div>
							</div>
							<button class="btn btn-primary" type="submit">Send</button>
						</fieldset>
					</form>
					<div class="row">
						<div class="span8 well">
							<div class="row">
								<div class="span1"><img src="http://placekitten.com/48" alt=""></div>
								<div class="span7">
									<div class="pull-left">

										<h4><i class="icon-user"></i>Вася Зайцев<span class="label">10.10.2012</span>
										</h4>

									</div>
									<div class="pull-right">
										<div class="close">&times;</div>
									</div>
								</div>
								<hr>
								<div class="span7">тут любой текст</div>
							</div>
						</div>
						<div class="span8 well">
							<div class="row">
								<div class="span1"><img src="http://placekitten.com/48" alt=""></div>
								<div class="span7">
									<div class="pull-left">

										<h4><i class="icon-user"></i>Вася Зайцев<span class="label">10.10.2012</span>
										</h4>

									</div>
									<div class="pull-right">
										<div class="close">&times;</div>
									</div>
								</div>
								<hr>
								<div class="span7">тут любой текст</div>
							</div>
						</div>
					</div>
				</div>
				<div class="span2 ">
					<form class="form-search">
						<input type="text" class="input input-mini search-query" placeholder="blogs">
						<button class="btn" type="submit"><i class="icon-search"></i></button>
					</form>
					<ul class="nav nav-pills nav-stacked">
						<li><a href="#"><i class="icon-user"></i>who are you</a></li>
						<li><a href="#"><i class="icon-user"></i>hello world</a></li>
						<li class="active"><a href="#"><i class="icon-user"></i>Guest</a></li>
						<li><a href="#"><i class="icon-user"></i>Guest</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>