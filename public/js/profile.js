/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 29.02.12
 * Time: 0:34
 * To change this template use File | Settings | File Templates.
 */
var Profile =
{
	settings:{
		$fio_container:$('#name'),
		$ava_container:$('span.ava'),
		$settings_container:$('a#gbi5'),
		timer_id:null
	},
	init:function (settings) {
		var _Profile = Profile;
		_Profile.settings = $.extend(_Profile.settings, settings);
		_Profile.$fio_container.find('span').click(function () {
			var $this = $(this);
			var fio = $this.text();
			var html = _Profile.input_fio_tpl(fio);
			_Profile.$fio_container.html();
		});
		$('#name').click(function (evt) {
			evt.preventDefault;
			var $this = $(this);
			var user_name_id = $this.html();
			var user_name = _Profile.filter_user(user_name_id);
			var user_id = _Profile.filter_id(user_name_id);
			var settings = {
				user_name_id:user_name_id,
				user_name:user_name,
				user_id:user_id
			}
			_Profile.settings = $.extend(_Profile.settings, settings);
			$this.html(_Profile.input_fio_tpl(user_name));
		});
		$('input.fio').live('keyup', function (evt) {
			var name = $(this).val();
			clearTimeout(_Profile.settings.timer_id);
			_Profile.settings.timer_id = setTimeout(function () {
				_Profile.save_name(name);
			}, 1000);
			if (evt) {

			}
		})
	},
	input_fio_tpl:function (fio) {
		return '\
		<input class="fio" type="text" value="' + fio + '">\
		';
	},
	filter_user:function (name_id) {
		return name_id.match('[^(]*')[0];
	},
	filter_id:function (name_id) {
		return name_id.match(/\(\d+\)/g)[0];
	},
	save_name:function (name, user_id) {
		var _Profile = Profile;

		$.ajax({
			url:'/user/editname',
			data:{fio:name},
			type:'post',
			dataType:'json',
			success:function (json) {
				_Profile.return_name_span(name);
			}
		});
	},
	return_name_span:function (text) {
		_Profile.settings.user_id;
		$('#name').html(text + _Profile.settings.user_id);
	}
}