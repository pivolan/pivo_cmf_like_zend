/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 17.02.12
 * Time: 0:44
 * To change this template use File | Settings | File Templates.
 */
function load($this) {
	$.ajax({
		url:'/user/editname/',
		data:{fio:$this.val()},
		type:'post',
		dataType:'json',
		success:function (json) {
			$('p.navbar-text.pull-right > span').text(json.fio + '(' + json.id + ')').removeClass('hidden');
			$this.addClass('hidden');
		}
	});
}

$(document).ready(function () {
	Chat.init();
	User.init();
//	Uploads.init();
	$('p.navbar-text.pull-right > span').click(function (evt) {
		evt.preventDefault();

		$(this).addClass('hidden');
		$('p.navbar-text.pull-right > input').removeClass('hidden').focus();
	});
	$('p.navbar-text.pull-right > input').blur(function () {
			var $this = $(this);
			load($this);
		}).change(function(){
			load($(this));
		});
})
