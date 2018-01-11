  <nav class="navbar navbar-expand-lg navbar-default bg-faded">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="<?=base_url()?>"><b>Kossuth</b>könyvtár 2.0</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
    <?php     
    foreach ($navbar_query->result() as $row) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url().$row->kategoria_url?>"><?=$row->kategoria_cim?></span></a>
      </li>
      <?php 
      }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php 
      $this->load->module('site_security');
      $customer_id = $this->site_security->_get_user_id();
      if(!$customer_id > 0){
      ?>
      <li><a href="<?=base_url()?>fiok/start"><span class="glyphicon glyphicon-user"></span> Regisztráció</a></li>
      <li><a href="<?=base_url()?>fiok/login"><span class="glyphicon glyphicon-log-in"></span> Belépés</a></li>
      <?php }else{ ?>

      
      <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown">
            <!--http://placehold.it/30x30-->
          <img style="height:30px; width: 30px;" src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile?>" class="img-circle special-img"> <?= $username ?> <b class="caret"></b></a>
          <ul class="dropdown-menu" style="background-color: #1ba1e2 !important; background-clip: initial !important; border: 0px !important;">
            <li><a href="<?= base_url() ?>fiok/profil"><i class="fa fa-cog"></i> Profil</a></li>
              <!--li class="divider" style="background-color: #0b91d2;"></li-->
            <li><a href="<?=base_url()?>fiok/logout"><i class="fa fa-sign-out"></i> Kilépés</a></li>
          </ul>
        </li>


      <!--li><a href="<?=base_url()?>fiok/logout"><span class="glyphicon glyphicon-log-out"></span> Kilépés</a></li-->
      <?php } ?>
    </ul>
  </div>
</nav>