/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 17.02.12
 * Time: 0:44
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
	User.init();
	Chat.init();
//	Uploads.init();
	Profile.init();
	Blog.init();
	$('#files > li > i').tooltip({placement:'left'});
	$('#files').fileupload({
		url:'/index/upload',
		dataType:'json',
		maxFileSize:10000000,
		done:function (e, data) {
			console.log(data);
			console.log(data.result);
			console.log(e);
		},
		always:function (e, data) {
		},
		progress:function (e, data) {
		},
		progressall:function (e, data) {
//			console.log(data.loaded);
		},
		dragover:function (e) {
			$('#file-message').removeClass('alert-info').addClass('alert-success');
		},
		drop:function (e, data) {
			$('#file-message').addClass('alert-info').removeClass('alert-success');
		},
		add:function (e, data) {
			console.log(e);
			console.log(data);
			var $this = $(this);
			var filename = data.files[0].name;
			var type = data.files[0].type;
			var style_class = 'icon-file';
			if (type.match(/image/))
				style_class = 'icon-picture';
			if (type.match(/video/))
				style_class = 'icon-film';
			if (type.match(/audio/))
				style_class = 'icon-music';
			var $html = $('<li><i class="' + style_class + '"></i>' + filename + '<div class="close">&times;</div></li>');
			$html.data('data_file', data);
			$html.find('div.close').click(function () {
				$html.data('data_file', null);
				$html.remove();
				delete files.data[filename];
			});
			data.submit();
			$this.append($html);
			files.data[filename] = $html;
		}
	});
})
var files = {
	data:[],
	send:function () {
		for (i in this.data) {
			var $html = this.data[i];
			var data = $html.data('data_file');
			data.submit();
			$html.data('data_file', null);
			$html.remove();
		}
	}
}