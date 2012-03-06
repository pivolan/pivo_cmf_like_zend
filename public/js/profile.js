/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 29.02.12
 * Time: 0:34
 * To change this template use File | Settings | File Templates.
 */
var Profile =
{
	$input:null,
	$span:null,
	init:function () {
		var _Profile = this;
		_Profile.$span = $('p.navbar-text.pull-right > span');
		_Profile.$input = $('p.navbar-text.pull-right > input')

		_Profile.$span.click(function (evt) {
			evt.preventDefault();

			$(this).addClass('hidden');
			_Profile.$input.removeClass('hidden').focus().select();
		});

		_Profile.$input.blur(
			function () {
				var $this = $(this);
				Profile.load($this);
			}).change(function () {
				var $this = $(this);
				Profile.load($this);
			});
	},
	load:function ($input) {
		var _Profile = this;
		$.ajax({
			url:'/user/editname/',
			data:{fio:$input.val()},
			type:'post',
			dataType:'json',
			success:function (json) {
				_Profile.$span.text(json.fio + '(' + json.id + ')').removeClass('hidden');
				$input.addClass('hidden');
			}
		});

	}
}