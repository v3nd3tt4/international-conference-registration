 <div class="col-md-9">
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-info" aria-hidden="true"></i> Information
		</div>
		<div class="panel-body">
			<div class="alert alert-success">
				<h4>Payment Info</h4><hr/>
				
				<?php 
					if($data->row()->id_jenis_peserta == 'Regular'){
				?>	
					Regular (Local Indonesia)
					<ul>
						<li>Full Package : 1.800.000 IDR</li>
						<li>Half (As Participant) : 500.000 IDR</li>
					</ul>
				<?php
					} 
					if($data->row()->id_jenis_peserta == 'Others'){
				?>
					Others (International)
					<ul>
						<li>Publish Scientific Paper: 77 EUR / 1.300.000 IDR</li>
						<li>Doesnt Publish Scientific Paper: 0 EUR / 0 IDR</li>
					</ul>
					
				<?php
					}
					if($data->row()->id_jenis_peserta == 'Business Meeting'){
				?>	
					Business Meeting
					<ul>
						<li>Full Package : 1.800.000 IDR</li>
						<li>Half (As Participant) : 500.000 IDR</li>
					</ul>
				<?php
					}
				?>
				</ul>
			</div>
			
		</div>
	</div>
</div>