<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', '#form_after_revisi', function(e){
			e.preventDefault();
			$('#notif_after_revisi').html('Loading...');
			var data = new FormData(document.getElementById('form_after_revisi'));
			$.ajax({
				url : '<?=base_url()?>user/simpan_file_revisi',
				type: 'POST',
				dataType: 'JSON',
				data: data,
				processData: false, 
	            contentType: false,
				success: function(msg){
					if(msg.status == 'success'){
						$('#notif_after_revisi').html(msg.msg);
						location.reload();
					}else if(msg.status == 'failed'){
						$('#notif_after_revisi').html(msg.msg);
					}
				}
			});
		});
	});
</script>