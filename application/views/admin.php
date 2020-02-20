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
					<td>: <?=$this->session->userdata('username')?></td>
				</tr>
				<tr>
					<td>Level</td>
					<td>: <?=$this->session->userdata('level')?></td>
				</tr>
			</table>
		</div>
	</div>
</div>