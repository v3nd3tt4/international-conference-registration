<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> Registration
		</div>
		<div class="panel-body">
			<div class="form_pendaftaran">
				<div class="alert alert-danger">
					Please Fill the blank form, as follows: 
				</div>
				<form id="submit_pendaftaran">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="nama_pendaftaran" id="nama_pendaftaran" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Photo Profile: *file type jpg or png max. 2 Mb</label>
						<input type="file" name="photo" id="photo" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Date of Birth:</label>
						<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Gender:</label><br/>
						<label class="radio-inline">
							<input type="radio" name="jk" id="jk" value="Male" required> Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="jk" id="jk" value="Female"> Female
						</label>
					</div>
					<table width="100%">
						<tr>
							<td>
								<div class="form-group">
									<label>Country:</label>
									<select class="form-control" name="country_pendaftaran" id="country_pendaftaran" required>
										<option value="">--Select--</option>
										<?php foreach($country as $row){?>
										<option value="<?=$row->id_ref_negara?>"><?=$row->nama_negara?></option>
										<?php }?>
									</select>
								</div>
							</td>
							<td>&nbsp;&nbsp;&nbsp;</td>
							<td>
								<div class="form-group">
									<label>Others</label>
									<input type="text" class="form-control" name="others_country" id="others_country"  readonly required />
								</div>
							</td>
						</tr>
					</table>
					
					<div class="form-group">
						<label>Affiliation:</label>
						<input type="text" name="affiliation" id="affiliation" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Phone Number:</label>
						<input type="text" name="no_hp" id="no_hp" class="form-control" required>
					</div>
					<div class="form-group">
						<label>E-Mail:</label>
						<input type="text" name="email" id="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Participant:</label>
						<select class="form-control" name="participant" id="participant" required>
							<option value="">--Select--</option>
							<!--<option value="Regular">Student</option>-->
							<!--<option value="Business Meeting">Lecture</option>-->
							<!--<option value="Others">Regular</option>-->
							<option value="Student">Student</option>
							<option value="Lecture">Lecture</option>
							<option value="Teacher">Teacher</option>
							<option value="Regular">Regular</option>
							<option value="ABKIN Member">ABKIN Member</option>
						</select>
					</div>
					<div class="form-group">
						<label>Have Research Paper?</label>
						<select class="form-control" name="paper_submission" id="paper_submission" required>
							<option value="">--Select--</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Join Excursion?</label>
						<select class="form-control" name="join_excursion" id="join_excursion" required>
							<option value="">--Select--</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					<!-- <div class="form-group">
						<?php echo $captcha // tampilkan recaptcha ?>
					</div> -->
					<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Submit</button>
				</form>
				<!-- <?php echo $script_captcha; // javascript recaptcha ?> -->
			</div>
			<div id="notif_pendafatarn"></div>
		</div>
	</div>
</div>