<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', '#submit_pendaftaran', function(e){
			e.preventDefault();
			$('#notif_pendafatarn').html('Loading....');
			var data = new FormData(document.getElementById('submit_pendaftaran'));
			$.ajax({
				url: '<?=base_url()?>welcome/simpan_pendaftaran',
				type: 'POST',
				dataType: 'JSON',
				data: data,
				processData: false, 
                contentType: false,
				success: function(msg){
					if(msg.status == 'success'){
						$('#notif_pendafatarn').html(msg.text);
						$('.form_pendaftaran').hide('slow');
					}else if(msg.status == 'failed'){
						$('#notif_pendafatarn').html(msg.text);
					}
				}
			});
		});

		$(document).on('change', '#country_pendaftaran', function(e){
			e.preventDefault();
			var data = $('#country_pendaftaran option:selected').text();
			var id = $(this).val();
			if(id == '12'){
				$('#others_country').attr('readonly', false);
				$('#others_country').val('');
			}else{
				$('#others_country').attr('readonly', true);
				$('#others_country').val(data);
			}
		});
	});
</script>