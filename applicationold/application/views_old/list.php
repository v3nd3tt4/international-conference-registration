<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> List
		</div>
		<div class="panel-body">
			<table class="table table-striped dtTb">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Status</th>
						<th>Type</th>
						<th>Paper</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($data as $row){?>
					<tr>
						<td><?=$no++?></td>
						<td>
							<a href="<?=base_url()?>admin/detail_pendaftar/<?=$row->id_pendaftar?>" target="_blank">
								<?=$row->nama_pendaftar?>
							</a>
						</td>
						<td>
							<?=$row->status_verifikasi === NULL ? 'Not Verified' : $row->status_verifikasi?>
						</td>
						<td>
							<?=$row->id_jenis_peserta?>
						</td>
						<td>
							<?=$row->paper?>
						</td>
						<th>
							<button class="btn btn-warning btn-xs btn-verif" id="<?=$row->id_pendaftar?>">Verified</button>
						</th>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="modal_verifikasi_pendaftar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Abstract and Full Paper</h4>
      </div>
      <div class="modal-body">
      	<form id="form_upload_verifikasi">
	        <div class="form-group">
	        	<label>Status:</label>
	        	<select class="form-control" name="status_nya" id="status_nya" required>
	        		<option value="">--Select--</option>
	        		<option value="Accepted">Accepted</option>
	        		<option value="Major Revision">Major Revision</option>
	        		<option value="Minor Revision">Minor Revision</option>
	        		<option value="Rejected">Rejected</option>
	        	</select>
	        </div>
			<div class="form-group">
	        	<label>Oral/Poster:</label>
	        	<select class="form-control" name="status_absnya" id="status_absnya" required>
	        		<option value="">--Select--</option>
	        		<option value="Accepted for oral presentation">Accepted for oral presentation</option>
	        		<option value="Accepted for poster presentation">Accepted for poster presentation</option>
	        	</select>
	        </div>
	        <div class="form-group">
	        	<label>Revisions Papers: *Type PDF Max. 3 Mb</label>
	        	<input type="hidden" name="id_pendaftar" id="id_pendaftar" class="form-control">
	        	<input type="file" name="file_direvisi" id="file_direvisi" class="form-control"/>
	        </div>
	        <div class="form-group">
	        	<label>Comment:</label>
	        	<textarea class="form-control" name="komentar" id="komentar"></textarea>
	        </div>
	        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
	    </form>
	    <div id="notif_upload_verifikasi"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>