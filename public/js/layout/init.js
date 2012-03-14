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

	$('#files').fileupload({
		url:'/file/upload',
		dataType:'json',
		maxFileSize:10000000,
		done:function (e, data) {
			console.log($('#files'));
			console.log($('#files').find('li:contains("' + data.result.name + '")'));
			console.log(data.result);
			var result = data.result[0];
			var $el = $('#files').find('li:contains("' + result.name + '")');
			var $a = $el.find('a');
			$a.attr('href', result.url);
			if (typeof result.thumbnail_url != 'undefined'){
				var thumbnail_img = '<img src="' + result.thumbnail_url + '"/>';
				$('<img />').attr('src', result.thumbnail_url);
				$a.attr("title", thumbnail_img).tooltip({placement:'left'});
			}
			$a.find('div.close').click(function(evt){
				evt.preventDefault();
				$a.tooltip('hide');
				$.ajax({
					url:result.delete_url,
					success:function()
					{
						$a.tooltip('hide');
						$el.remove();
					}
				});
			});
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
			var $html = $('<li><a target="_blank"><i class="' + style_class + '"></i>' + filename + '<div class="close">&times;</div></a></li>');
			$html.data('data_file', data);
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