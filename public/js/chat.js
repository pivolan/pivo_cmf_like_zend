/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 17.02.12
 * Time: 0:43
 * To change this template use File | Settings | File Templates.
 */
var Chat =
{
	$container:null, //$('div.messages')
	user_id:null, //from hash url
	current_user_id:null, //from hash url
	from:0,
	//todo: заменить на нормальную шаблонизацию через плагин jquery.
	message_tpl:function (id, message, owner_id, fio, owner_ava_src, date_create) {
		date_create = Common.helper_date(date_create);
		if (Chat.current_user_id == owner_id){
			return '' +
				'<div class="message" data_id="' + id + '">' +
				'	<div class="left"><a class="ava" href="#' + owner_id + '"><img class="ava" src="' + owner_ava_src + '" alt="аватарка"></a></div>' +
				'	<div class="right">' +
				'		<div class="top_info">' +
				'			<a class="fio" href="#' + owner_id + '">' + fio + '</a>' +
				'			<span class="date_create">' + date_create + '</span>' +
				'			<a title="удалить" class="delete" href="#delete"></a>' +
				'		</div>' +
				'		<div class="middle">' +
				'			' + message +
				'		</div>' +
				'		<div class="bottom"><a class="like liked" href="#like"></a></div>' +
				'	</div>' +
				'	<div class="clear_right"></div>' +
				'</div>';
		}
		else
		{
			return '' +
				'<div class="message" data_id="' + id + '">' +
				'	<div class="left"><a class="ava" href="#' + owner_id + '"><img class="ava" src="' + owner_ava_src + '" alt="аватарка"></a></div>' +
				'	<div class="right">' +
				'		<div class="top_info">' +
				'			<a class="fio" href="#' + owner_id + '">' + fio + '</a>' +
				'			<span class="date_create">' + date_create + '</span>' +
				'		</div>' +
				'		<div class="middle">' +
				'			' + message +
				'		</div>' +
				'		<div class="bottom"><a class="like liked" href="#like"></a></div>' +
				'	</div>' +
				'	<div class="clear_right"></div>' +
				'</div>';
		}
	},
	add:function (id, html) {
		var $html = $(html);
		$html.find('a.delete').click(function (evt) {
			evt.preventDefault();
			$html.remove();
			Chat.remove_blog(id);
		});
		this.$container.prepend($html);
	},
	load:function (owner_id, from, count) {
		if (owner_id && owner_id > 0) {
			var url = '/search/blog_owner/' + owner_id + '/' + from + '/' + count;
		}
		else {
			var url = '/search/blog_all/';
		}
		$.ajax({
			url:url,
			data:'',
			type:'post',
			dataType:'json',
			success:function (jsons) {
				Chat.hide_loader();
				for (index in jsons) {
					var json = jsons[index];
					var html = Chat.message_tpl(json.id, json.message, json.owner_id, json.fio, 'http://placekitten.com/48', json.date_create);
					Chat.add(json.id, html);
				}
			},
			error:function () {
				Chat.hide_loader();
			}
		});
	},
	init:function () {
		this.$container = $('div.messages');
		var user_id = parseInt(window.location.hash.replace('#', ''));
		this.current_user_id = $('meta[name="user_id"]').attr('content');
		this.current_user_fio = $('meta[name="user_fio"]').attr('content');
		if (user_id) {
			this.user_id = user_id;
		}

		this.load(user_id, this.from, Const.CF_PAGINATE_COUNT);

		// обработчик на изменение строки адресной
		window.onhashchange = function () {
			var user_id = parseInt(window.location.hash.replace('#', ''));
			if (!user_id) {
				user_id = $('meta[name="user_id"]').attr('content');
			}
			Chat.user_id = user_id;
			Chat.clear();
			Chat.show_loader();
			Chat.load(user_id, Chat.from, Const.CF_PAGINATE_COUNT);
		}
		//обработчик на форму
		$('#submit').click(function () {
			var value = $('#chat-textarea').val();
			Chat.show_loader();
			$.ajax({
				type:'post',
				dataType:'json',
				url:'/blog/create',
				data:{message:value},
				success:function (json) {
					Chat.hide_loader();
					html = Chat.message_tpl(json.id, json.message, json.owner_id, json.fio, 'http://placekitten.com/48', json.date_create);
					Chat.add(json.id, html);
				},
				error:function () {
					Chat.hide_loader();
				}
			});
		});
	},
	remove_blog:function (id) {
		this.$container.find('div[data_id="' + id + '"]').remove();
		$.ajax({
			url:'/blog/delete/' + id
		});
	},
	clear:function () {
		this.$container.html('');
		this.from = 0;
	},
	create:function () {

	},
	show_loader:function () {
		$('#blog_loader').show();
	},
	hide_loader:function () {
		$('#blog_loader').hide();
	}

}