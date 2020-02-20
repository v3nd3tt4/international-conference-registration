<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> Profile
		</div>
		<div class="panel-body">
			<h3>Upload Payment Proof</h3><hr/>
			<?php if($this->session->flashdata('msg')): ?>
			    <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><?php echo $this->session->flashdata('msg'); ?></div>
			<?php endif; ?>

			<?php if($data->row()->bukti_bayar != "" || $data->row()->bukti_bayar !== NULL){
			?>
			<table class="table table-striped">
				<tr>
					<td>Payment Proof</td>
					<td><a href="<?=base_url()?>assets/file_upload/foto/<?=$data->row()->bukti_bayar?>" target="_blank">View</a></td>
				</tr>
			</table>
			<?php }else{ ?>
			<form action="<?=base_url()?>user/simpan_bukti_bayar" method="POST" enctype="multipart/form-data">
				<table class="table table-striped">
					<tr>
						<td>File</td>
						<td><input type="file" name="file" id="file" class="form-control" required /></td>
					</tr>
					<tr>
						<td></td>
						<td><button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button></td>
					</tr>
				</table>
			</form>
			<?php }?>
		</div>
	</div>
</div>