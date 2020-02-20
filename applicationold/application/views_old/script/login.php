<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', '#form_login', function(e){
			e.preventDefault();
			$('#notif_login').html('Loading....');
			var data = $('#form_login').serialize();
			$.ajax({
				url: '<?=base_url()?>login/proses_login',
				type: 'POST',
				data: data,
				success: function(msg){
					$('#notif_login').html(msg);
				}
			});
		});
	})
</script>