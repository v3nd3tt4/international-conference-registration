<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> Revision
		</div>
		<div class="panel-body">
			<iframe src="https://docs.google.com/viewer?url=<?=base_url()?>assets/file_upload/foto/<?=$data->row()->file_revisi?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
			<br/><br/>
			<label>Note:</label><br/>
			<?=$data->row()->komentar === NULL ? '-' : nl2br($data->row()->komentar)?>
			<hr/>
			<h4>Upload Your Paper after revision here</h4>
			<hr/>
			<form id="form_after_revisi">
				<div class="form-group">
					<label>Paper *type PDF Max. 3 Mb</label>
					<input type="file" name="paper_revisi" id="paper_revisi" class="form-control" required />
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
				<div id="notif_after_revisi"></div>
			</form>
		</div>
	</div>
</div>
