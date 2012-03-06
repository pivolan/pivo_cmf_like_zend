/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 17.02.12
 * Time: 0:43
 * To change this template use File | Settings | File Templates.
 */
var Blog =
{
	$input:null,
	_chat:null,
	$blog_list:null,
	timeout_id:null,
	init:function () {
		var _Blog = this;
		_Blog._chat = Chat;
		_Blog.$input = $('#blogs');
		_Blog.$blog_list = $('#blog_list');

		$('#blog_list > li').live('click', function (evt) {
			evt.preventDefault();
			$('#blog_list > li.active').removeClass('active');
			$(this).addClass('active');
			var item = $(this).data('json');
			_Blog._chat.clear();
			var html = _Blog._chat.message_tpl(item.id, item.message, item.owner_id, item.fio, 'http://placekitten.com/48', item.date_create);
			_Blog._chat.add(item.id, html);
		});
		_Blog.$input.keyup(function (evt) {
			var $this = $(this);
			clearTimeout(_Blog.timeout_id);
			_Blog.timeout_id = setTimeout(function () {
				_Blog.load();
			}, 1000);
			var search = $this.val();
		});
	},
	load:function () {
		var _Blog = this;
		var search_str = _Blog.$input.val();
		console.log(search_str);
		$.ajax({
			url:'/search/blog',
			data:{message:search_str},
			type:'post',
			dataType:'json',
			success:function (json) {
				_Blog.clear();
				for (index in json) {
					var item = json[index];
					var message = item[Const.KN_MESSAGE];
					var id = item[Const.KN_ID];
					var date_create = item[Const.KN_DATE_CREATE];
					var owner_id = item[Const.KN_OWNER_ID];
					var fio = item[Const.KN_FIO];
					message = _Blog.filter(message, search_str)
					var html = _Blog.blog_tpl(id, message);
					var $html = $(html);
					$html.data('json', item);
					_Blog.add($html);
				}
			}
		});

	},
	clear:function () {
		this.$blog_list.html('');
	},
	add:function (html) {
		this.$blog_list.append(html);
	},
	filter:function (message, search) {
		var index_str = message.search(search);
		var start = index_str;
		var end = index_str + search.length + 5;
		if (index_str - 5 < 0)
			start = 0;

		return message.slice(start, end).slice(0, 19);
	},
	blog_tpl:function (id, message) {
		return '<li data-id="' + id + '"><a href="#no"><i class="icon-comment"></i>' + message + '</a></li>';
	}
}