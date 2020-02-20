<div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"></i> Profile
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<td>Name</td>
					<td>: <?=$data->row()->nama_pendaftar?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>: <?=$data->row()->nama_negara?></td>
				</tr>
				<tr>
					<td>Birthday</td>
					<td>: <?=date('d F Y', strtotime($data->row()->tgl_lahir));?></td>
				</tr>
				<tr>
					<td>Affiliation</td>
					<td>: <?=$data->row()->affiliation?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>: <?=$data->row()->email?></td>
				</tr>
				<tr>
					<td>Participant Type</td>
					<td>: <?=$data->row()->id_jenis_peserta?> </td>
				</tr>
				<tr>
					<td>Have Research Paper?</td>
					<td>: <?=$data->row()->paper?> </td>
				</tr>
				<tr>
					<td>Join Excursion</td>
					<td>: <?=$data->row()->join_excursion?> </td>
				</tr>
				<tr>
					<td>Status</td>
					<td>: <?=$data->row()->status_verifikasi === NULL ? 'Not Verified' : $data->row()->status_verifikasi?> </td>
				</tr>
			</table>
		</div>
	</div>
</div>