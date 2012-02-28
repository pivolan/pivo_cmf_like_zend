var Uploads = {
	settings: {
		$container:$('div.help')
	},
	init:function(settings){
		var _Uploads = this;
		var $container = $('div.help');
		_Uploads.settings = $.extend(_Uploads.settings, settings);
		$container.fileupload();
	}
}