<div class="container top" style="background:#daa520;" >
<nav class="navbar navbar-default">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <!--<a class="navbar-brand" href="#">WebSiteName</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <!--<ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li> 
        <li><a href="#">Page 3</a></li> 
      </ul>-->
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
          <?php if(!$this->session->userdata('is_login')){?>
          <li><a href="<?=base_url()?>login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php }else{?>
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$this->session->userdata('nama')?></a></li>
          <li><a href="<?=base_url()?>login/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          <?php }?>
      </ul>
    </div>
  
</nav>
</div>
    

<div class="container" style="background:#fff;min-height:500px; box-shadow:0px -6px 22px 0px rgba(0, 0, 0, 0.2);">
    <div class="row">