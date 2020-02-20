<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-book" aria-hidden="true"></i> Paper Submission
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>File Type</th>
						<th>File</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1.</td>
						<td>Full Paper</td>
						<?php if($data->row()->full_paper != '' ){?>
						<td>
							<a href="<?=base_url()?>assets/file_upload/foto/<?=$data->row()->full_paper?>" target="_blank">
								<i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
							</a>
						</td>
						<td>
							<a href="#" class="add_full_paper"  style="color: red">
								<i class="fa fa-pencil" aria-hidden="true"></i> Edit
							</a>
							
						</td>
						<?php }else{ ?>
						<td>
							<?="Empty"?>
						</td>
						<td>
							<a href="#" class="add_full_paper" style="color: green" target="_blank">
								<i class="fa fa-plus" aria-hidden="true"></i> Add
							</a>
						</td>
						<?php }?>
					</tr>
					<tr>
						<td>2.</td>
						<td>Abstract</td>
						<?php if($data->row()->abstract != '' ){?>
						<td>
							<a href="<?=base_url()?>assets/file_upload/foto/<?=$data->row()->abstract?>" target="_blank">
								<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							</a>
						</td>
						<td>
							<a href="#" class="add_abstract"  style="color: red">
								<i class="fa fa-pencil" aria-hidden="true"></i> Edit
							</a>
							
						</td>
						<?php }else{ ?>
						<td>
							<?="Empty"?>
						</td>
						<td>
							<a href="#" class="add_abstract" style="color: green">
								<i class="fa fa-plus" aria-hidden="true"></i> Add
							</a>
						</td>
						<?php }?>
					</tr>
				</tbody>
			</table><hr/>

			<form enctype="multipart/form-data" method="POST" action="<?=base_url()?>user/simpan_paper_submission">
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" id="title" class="form-control" required value="<?=$data->row()->tittle?>" />
				</div>
				<div class="form-group">
					<label>Keyword</label>
					<input type="text" name="keyword" id="keyword" class="form-control" required value="<?=$data->row()->keyword_abstract?>" />
				</div>
				<div class="form-group">
					<label>Group Session</label>
					<select name="category" id="category" class="form-control" required >
						<option value="">--Select--</option>
						<?php foreach($topics as $row){?>
						<option value="<?=$row->id_topics?>" <?php if($data->row()->id_topics == $row->id_topics){ echo 'selected'; }?> ><?=$row->title?></option>
						<?php }?>
					</select>
				</div>
				<div class="form-group">
					<label>Abstract Text</label>
					<textarea class="form-control" name="abstract_text" id="abstract_text" required><?=$data->row()->abstract_text?></textarea>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
			</form>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="modal_file_full_paper" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Abstract and Full Paper</h4>
      </div>
      <div class="modal-body">
      	<form id="form_upload_fulll_paper">
	        <div class="form-group">
	        	<label>File Type:</label>
	        	<input type="text" class="form-control" name="status" id="status" value="Full Paper" readonly required />
	        </div>
	        <div class="form-group">
	        	<label>File: *Type DOC or DOCX Max. 3 Mb</label>
	        	<input type="hidden" name="aksi_full_paper" id="aksi_full_paper">
	        	<input type="file" class="form-control" name="file_nya_full_paper" id="file_nya_full_paper" required/>
	        </div>
	        <button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
	    </form>
	    <div id="notif_file_full_paper"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="modal_file_abstract" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Abstract and Full Paper</h4>
      </div>
      <div class="modal-body">
      	<form id="form_upload_abstract">
	        <div class="form-group">
	        	<label>File Type:</label>
	        	<input type="text" class="form-control" name="status" id="status" value="Abstract" readonly required />
	        </div>
	        <div class="form-group">
	        	<label>File: *Type DOC or DOCX Max. 3 Mb</label>
	        	<input type="hidden" name="aksi_abstract" id="aksi_abstract">
	        	<input type="file" class="form-control" name="file_nya_abstract" id="file_nya_abstract" required/>
	        </div>
	        <button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Uplaod</button>
	    </form>
	    <div id="notif_file_abstract"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>