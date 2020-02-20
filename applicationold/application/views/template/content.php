<div class="col-md-3">
	<br/>
	
	<?php 
	if($this->session->userdata('is_login')){
		?>
		<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-user" aria-hidden="true"></i> Photo Profile
		</div>
		<div class="panel-body">
		<?php
	if($this->session->userdata('photo') !== NULL || $this->session->userdata('photo') != '' || !empty($this->session->userdata('photo'))){ ?>
	
			<center>
				<div class="circular--portrait img-responsive">
					<img src="<?=base_url()?>assets/file_upload/foto/<?=$this->session->userdata('photo')?>" class="img-responsive"/>
				</div>
			</center>
		
	<?php 
	}else{?>
		<center>
			<div class="circular--portrait img-responsive">
				<img src="<?=base_url()?>assets/profile-pictures.png" class="img-responsive img-circle"/>
			</div>
		</center>
	<?php
		}	
		?>
			</div>
		</div>
	<?php
	}?>
		
	<?php if(!$this->session->userdata('is_login')){?>
	<div class="list-group">
	  <a href="#" class="list-group-item list-group-item-warning">Menu</a>
	  <a href="<?=base_url()?>" class="list-group-item <?php if($link=='pendaftaran'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Registration</a>  
	  <a href="<?=base_url()?>welcome/ct" class="list-group-item <?php if($link=='ct'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Conference Topic</a>
	  <a href="<?=base_url()?>welcome/sc" class="list-group-item <?php if($link=='sc'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Scientific Committee</a>    
	  <a href="<?=base_url()?>welcome/oc" class="list-group-item <?php if($link=='oc'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Organizatoring Committee</a>  
	  <a href="<?=base_url()?>welcome/ks" class="list-group-item <?php if($link=='ks'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Keynote Speaker</a> 
	  <a href="<?=base_url()?>welcome/mp" class="list-group-item <?php if($link=='mp'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Manuscripts Publication</a> 
	  <a href="<?=base_url()?>assets/template.docx" class="list-group-item <?php if($link=='mp'){echo'active';}?>"><i class="fa fa-home" aria-hidden="true"></i> Download Template</a>  
	  <!-- <a href="<?=base_url()?>welcome/procedure" class="list-group-item <?php if($link=='procedure'){echo'active';}?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Registration Guidance</a> -->      
	</div>
	<?php }else{
		if($this->session->userdata('level') == 'pendaftar'){
	?>
	<div class="list-group">
	  <a href="#" class="list-group-item list-group-item-warning">Menu</a>
	  <a href="<?=base_url()?>user" class="list-group-item <?php if($link=='profile'){echo'active';}?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
	  <?php if($this->session->userdata('paper') != 'No'){?>
	  <a href="<?=base_url()?>user/paper_submission" class="list-group-item <?php if($link=='paper_submission'){echo'active';}?>"><i class="fa fa-book" aria-hidden="true"></i> Paper Submission</a>
	  <?php }?>
	  <?php if($this->session->userdata('revisi') == 'Major Revision' || $this->session->userdata('revisi') == 'Minor Revision'){?>
	  <a href="<?=base_url()?>user/revision" class="list-group-item <?php if($link=='revision'){echo'active';}?>"><i class="fa fa-book" aria-hidden="true"></i> Revision</a>
	  <?php }?>
	  <!-- <a href="<?=base_url()?>user/information" class="list-group-item <?php if($link=='information'){echo'active';}?>"><i class="fa fa-info" aria-hidden="true"></i> Payment Info</a> -->
	  <a href="<?=base_url()?>user/payment_proof" class="list-group-item <?php if($link=='payment_proof'){echo'active';}?>"><i class="fa fa-money" aria-hidden="true"></i> Upload Payment Proof</a>
		  

		
	</div>
	<?php
		}else if($this->session->userdata('level') == 'admin'){
	?>
	<div class="list-group">
	  <a href="#" class="list-group-item list-group-item-warning">Menu</a>
	  <a href="<?=base_url()?>admin" class="list-group-item <?php if($link=='pendaftaran'){echo'active';}?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
	  <a href="<?=base_url()?>admin/list_pendaftar" class="list-group-item <?php if($link=='list'){echo'active';}?>"><i class="fa fa-user" aria-hidden="true"></i> List</a>
	</div>
	<?php
		} 
	}?>

</div>







