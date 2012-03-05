/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 19.02.12
 * Time: 4:40
 * To change this template use File | Settings | File Templates.
 */
var User = {
	$container:null, //$('#user-list')
	timer_id:null,
	current_user_id:null,
	init:function () {
		this.$container = $('ul.user-list');
		$('ul.user-list > li').live('click',function()
		{
			$('ul.user-list > li.active').removeClass('active');
			$(this).addClass('active');
		});
		this.reload();
		this.current_user_id = $('meta[name="user_id"]').attr('content');
		$('#user-find-input').keyup(
			function (evt) {
				clearTimeout(User.timer_id);
				User.timer_id = setTimeout(function () {
					User.reload();
				}, 1500)
			}).change(function (evt) {
				clearTimeout(User.timer_id);
				User.timer_id = setTimeout(function () {
					User.reload();
				}, 1500)
			});
	},
	reload:function () {
		var str = this.get_search_string();
		this.clear();
		this.show_loader();
		this.load(str);
	},
	load:function (str) {
		$.ajax({
			type:'post',
			dataType:'json',
			url:'/search/user',
			data:{fio:str},
			success:function (jsons) {
				User.hide_loader();
				for (index in jsons) {
					var json = jsons[index];
					var html = User.item_tpl(json.id, json.fio, 'http://placekitten.com/48', json.id == User.current_user_id);
					User.add(html);
				}
			},
			error:function () {
				User.hide_loader();
			}
		});
	},
	add:function (html) {
		var $html = $(html);
		this.$container.append(html);
	},

	get_search_string:function () {
		return $('#user-find-input').val();
	},
	clear:function () {
		this.$container.html('');
	},
	item_tpl:function (id, fio, ava_src, active) {
		if (active)
			return '<li class="active"><a href="#' + id + '"><i class="icon-user"></i>' + fio + '</a></li>';
		else
			return '<li><a href="#' + id + '"><i class="icon-user"></i>' + fio + '</a></li>';
	},
	show_loader:function () {
		$('#user_loader').show();
	},
	hide_loader:function () {
		$('#user_loader').hide();
	}
}