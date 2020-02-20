<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function(e){
		

		$(document).on('click', '.btn-verif', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$('#modal_verifikasi_pendaftar').modal();
			$('#id_pendaftar').val(id);
		});

		$(document).on('submit', '#form_upload_verifikasi', function(e){
			e.preventDefault();
			$('#notif_upload_verifikasi').html('Loading...');
			var data = new FormData(document.getElementById('form_upload_verifikasi'));
			$.ajax({
				url : '<?=base_url()?>admin/simpan_verifikasi',
				type: 'POST',
				dataType: 'JSON',
				data: data,
				processData: false, 
	            contentType: false,
				success: function(msg){
					if(msg.status == 'success'){
						$('#notif_upload_verifikasi').html(msg.msg);
						location.reload();
					}else if(msg.status == 'failed'){
						$('#notif_upload_verifikasi').html(msg.msg);
					}
				}
			});
		});

		$('.dtTb').dataTable();

		CKEDITOR.replace( 'abstract_text1' );
	});
</script>