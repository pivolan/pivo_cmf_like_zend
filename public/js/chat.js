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
	message_tpl:function (id, message, owner_id, fio, owner_ava_src, date_create, files) {
		date_create = Common.helper_date(date_create);
        var html_file = this.file_tpl(files);
		if (Chat.current_user_id == owner_id) {
			return '' +
				'<div class="span8 well" data-id="' + id + '">' +
				'	<div class="row">' +
				'		<div class="span1"><img alt="" src="' + owner_ava_src + '"></div>' +
				'		<div class="span7">' +
				'			<div class="pull-left">' +
				'				<h4><a href="#' + owner_id + '"></a><i class="icon-user"></i>' + fio + '<span class="label">' + date_create + '</span>' +
				'				</h4>' +
				'			</div>' +
				'			<div class="pull-right">' +
				'				<a href="#" title=" Удалить " class="delete"><div class="close">&times;</div></a>' +
				'			</div>' +
				'		</div>' +
				'		<hr>' +
				'		<div class="span7">' + message + '</div>' +
				'		<div class="span7">' + html_file + '</div>' +
				'	</div>' +
				'</div>';
		}
		else {
			return '' +
				'<div class="span8 well" data-id="' + id + '">' +
				'	<div class="row">' +
				'		<div class="span1"><img alt="" src="' + owner_ava_src + '"></div>' +
				'		<div class="span7">' +
				'			<div class="pull-left">' +
				'				<h4><a href="#' + owner_id + '"></a><i class="icon-user"></i>' + fio + '<span class="label">' + date_create + '</span>' +
				'				</h4>' +
				'			</div>' +
				'			<div class="pull-right">' +
				'			</div>' +
				'		</div>' +
				'		<hr>' +
				'		<div class="span7">' + message + '</div>' +
				'		<div class="span7">' + html_file + '</div>' +
				'	</div>' +
				'</div>';
		}
	},
    file_tpl: function(files)
    {
        var result = '';
        for(var i in files)
        {
            var file = files[i];
            result += '<a target="_blank" data-toggle="modal" href="'+file+'"><img src="'+file.replace('files', 'thumbnails')+'"/></a>';
        }
        return result;
    },
	add:function (id, html, order) {
		var $html = $(html);
		$html.find('a.delete').click(function (evt) {
			evt.preventDefault();
			$html.remove();
			Chat.remove_blog(id);
		});
		if (order)
			this.$container.prepend($html);
		else
			this.$container.append($html);

	},
	load:function (owner_id, from, count) {
		if (owner_id && owner_id > 0) {
			var url = '/search/blog_owner/' + owner_id + '/' + from + '/' + count;
			User.set_active(owner_id);
		}
		else {
			var url = '/search/blog_all/';
			User.clear_active();
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
					var html = Chat.message_tpl(json.id, json.message, json.owner_id, json.fio, 'http://placekitten.com/48', json.date_create, json.files);
					Chat.add(json.id, html);
				}
			},
			error:function () {
				Chat.hide_loader();
			}
		});
	},
	init:function () {
		this.$container = $('div.messages.row');
		var user_id = parseInt(window.location.hash.replace('#', ''));
		this.current_user_id = $('meta[name="user_id"]').attr('content');
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
            var files = [];
            $('#files a').each(function(index, target){
                files.push($(target).attr("href"));
            });
			$.ajax({
				type:'post',
				dataType:'json',
				url:'/blog/create',
				data:{message:value, files: files},
				success:function (json) {
					Chat.hide_loader();
					html = Chat.message_tpl(json.id, json.message, json.owner_id, json.fio, 'http://placekitten.com/48', json.date_create, json.files);
					Chat.add(json.id, html, true);
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