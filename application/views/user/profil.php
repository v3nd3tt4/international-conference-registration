<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> Registration
		</div>
		<div class="panel-body">
			<div class="alert alert-danger">
				Please Fill the blank form, as follows: 
			</div>
			<div class="form_pendaftaran">
				<form id="submit_pendaftaran">
					<label>Name:</label>
					<input type="text" name="nama_pendaftaran" id="nama_pendaftaran" class="form-control" required>
					<label>Date of Birth:</label>
					<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
					<label>Country:</label>
					<select class="form-control" name="country_pendaftaran" id="country_pendaftaran" required>
						<option value="">--Select--</option>
						<?php foreach($country as $row){?>
						<option value="<?=$row->id_ref_negara?>"><?=$row->nama_negara?></option>
						<?php }?>
					</select>
					<label>Affiliation:</label>
					<input type="text" name="affiliation" id="affiliation" class="form-control" required>
					<label>Phone Number:</label>
					<input type="text" name="no_hp" id="no_hp" class="form-control" required>
					<label>E-Mail:</label>
					<input type="text" name="email" id="email" class="form-control" required>
					<label>Participant:</label>
					<select class="form-control" name="participant" id="participant" required>
						<option value="">--Select--</option>
						<option value="SOC">SOC</option>
						<option value="LOC">LOC</option>
						<option value="Regular">Regular</option>
						<option value="Business Meeting">Business Meeting</option>
					</select>
					<br/>
					<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Submit</button>
				</form>
			</div>
			<div id="notif_pendafatarn"></div>
		</div>
	</div>
</div>