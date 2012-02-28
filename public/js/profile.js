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
		$settings_container:$('a#gbi5')
	},
	init:function(settings)
	{
		var _Profile = Profile;
		_Profile.settings = $.extend(_Profile.settings, settings);
		_Profile.$fio_container.find('span').click(function()
		{
			var $this = $(this);
			var fio = $this.text();
			var html = _Profile.input_fio_tpl(fio);
			_Profile.$fio_container.html();
		});
	},
	input_fio_tpl:function(fio)
	{
		return '\
		<input class="fio" type="text" value="'+fio+'">\
		';
	}
}