(function($){
	$('body').on('click','.dialog_open',function(){
		$('#rs_dialog').modal('show');
		var dataTemp = {
			title: $(this).attr('data-title'),
			url: $(this).attr('data-url'),
		}
		$('#rs_dialog .rs_dialog_title').text(dataTemp.title);
		$('#rs_dialog .rs_dialog_body').load(dataTemp.url,function(){
			var dataScriptUrl = $('#file_uploader_script').attr('src');
			$('#file_uploader_script').attr('src',dataScriptUrl);
		});
	});
	$('body').on('click','.media_upload .dialog_open',function(){
		$('body').attr('data-media-group-id',$(this).closest('.media_upload').attr('id'));
	});
	/*$('.rs_country').on('change',function(e){
		var obj = {
			data:$(this).val()
		}
		$.post(rs_obj.url+'Ajax_query/get_city/'+obj.data,function(res){
			console.log(res);
		})
	})*/
	$('select').select2();
}(jQuery))