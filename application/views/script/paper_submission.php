<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.add_full_paper', function(e){
			e.preventDefault();
			$('#modal_file_full_paper').modal();
			var nilai = $(this).attr('id');
			$('#aksi_full_paper').val('tambah');
			
		});

		$(document).on('submit', '#form_upload_fulll_paper', function(e){
			e.preventDefault();
			$('#notif_file_full_paper').html('Loading...');
			var aksi = $('#aksi_full_paper').val();
			var data = new FormData(document.getElementById('form_upload_fulll_paper'));
			if(aksi == 'tambah'){
				$.ajax({
					url: '<?=base_url()?>user/simpan_file_full_paper',
					type: 'POST',
					dataType: 'JSON',
					data: data,
					processData: false, 
	                contentType: false,
					success: function(msg){
						if(msg.status == 'success'){
							$('#notif_file_full_paper').html(msg.text);
							location.reload();
						}else if(msg.status == 'failed'){
							$('#notif_file_full_paper').html(msg.text);
						}
					}
				});
			}
		});

		$(document).on('click', '.add_abstract', function(e){
			e.preventDefault();
			$('#modal_file_abstract').modal();
			var nilai = $(this).attr('id');
			$('#aksi_abstract').val('tambah');
			
		});

		$(document).on('submit', '#form_upload_abstract', function(e){
			e.preventDefault();
			$('#notif_file_abstract').html('Loading...');
			var aksi = $('#aksi_abstract').val();
			var data = new FormData(document.getElementById('form_upload_abstract'));
			if(aksi == 'tambah'){
				$.ajax({
					url: '<?=base_url()?>user/simpan_file_abstract',
					type: 'POST',
					dataType: 'JSON',
					data: data,
					processData: false, 
	                contentType: false,
					success: function(msg){
						if(msg.status == 'success'){
							$('#notif_file_abstract').html(msg.msg);
							location.reload();
						}else if(msg.status == 'failed'){
							$('#notif_file_abstract').html(msg.msg);
						}
					}
				});
			}
		});

		$(document).on('submit', '#form_upload', function(e){
			e.preventDefault();
			$('#notif_file').html('Loading....');
			var data = new FormData(document.getElementById('form_upload'));
			$.ajax({
				url: '<?=base_url()?>user/simpan_file',
				type: 'POST',
				dataType: 'JSON',
				data: data,
				processData: false, 
                contentType: false,
				success: function(msg){
					if(msg.status == 'success'){
						$('#notif_file').html(msg.msg);
					}else if(msg.status == 'failed'){
						$('#notif_file').html(msg.msg);
					}
				}
			});
		});

		CKEDITOR.replace( 'abstract_text' );
	});
</script>
