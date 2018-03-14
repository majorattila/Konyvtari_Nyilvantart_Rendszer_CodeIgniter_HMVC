<?php
$this->load->module('site_security');
?>
<div class="container" style="padding-left: 0px; padding-right: 0px;">
  <nav class="navbar navbar-expand-lg navbar-default bg-faded">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>

      <?php 
      $customer_id = $this->site_security->_get_user_id();
      if(!$customer_id > 0){
      ?>
      <a href="<?=base_url()?>fiok/login"><button class="pull-right navbar-toggle"><i class="text-primary glyphicon glyphicon-log-in"></i></button></a>
      <?php } else {?>
      <a href="<?=base_url()?>fiok/logout"><button class="pull-right navbar-toggle" style="background-color: yellow !important;"><i class="text-primary glyphicon glyphicon-log-out"></i></button></a>
      <?php } ?>
      <a class="navbar-brand" href="<?=base_url()?>"><b>Kossuth</b>könyvtár</a>
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


      <?php 
      $customer_id = $this->site_security->_get_user_id();
      if($customer_id > 0){
      ?>
        <li class="hidden-xl hidden-lg hidden-md hidden-sm"><a href="<?= base_url() ?>bibliografiak/hosszabbit"><i class="fa fa-cog"></i> Hosszabbít</a></li>
        <li class="hidden-xl hidden-lg hidden-md hidden-sm"><a href="<?= base_url() ?>bibliografiak/view/kosar_tartalma"><i class="fa fa-cog"></i> Előfoglal</a></li>
        <li class="hidden-xl hidden-lg hidden-md hidden-sm"><a href="<?= base_url() ?>fiok/profil/user"><i class="fa fa-cog"></i> Profil</a></li>
      <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php 
      $customer_id = $this->site_security->_get_user_id();
      if(!$customer_id > 0){
      ?>
      <li class="hidden-xs"><a href="<?=base_url()?>fiok/start"><span class="glyphicon glyphicon-user"></span> <span class="hidden-sm">Regisztráció</span></a></li>
      <li class="hidden-xs"><a href="<?=base_url()?>fiok/login"><span class="glyphicon glyphicon-log-in"></span> <span class="hidden-sm">Belépés</span></a></li>
      <?php }else{ ?>

      
      <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown">
            <!--http://placehold.it/30x30-->
          <img style="height:30px; width: 30px;" src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile?>" class="img-circle special-img"> <?= $username ?> <b class="caret"></b></a>
          <ul class="dropdown-menu" style="background-color: #1ba1e2 !important; background-clip: initial !important; border: 0px !important;">
            <li><a href="<?= base_url() ?>bibliografiak/hosszabbit"><i class="fa fa-cog"></i> Hosszabbít</a></li>
            <li><a href="<?= base_url() ?>bibliografiak/view/kosar_tartalma"><i class="fa fa-cog"></i> Előfoglal</a></li>
            <li><a href="<?= base_url() ?>fiok/profil/user"><i class="fa fa-cog"></i> Profil</a></li>
              <!--li class="divider" style="background-color: #0b91d2;"></li-->
            <li><a href="<?=base_url()?>fiok/logout"><i class="fa fa-sign-out"></i> Kilépés</a></li>
          </ul>
        </li>


      <!--li><a href="<?=base_url()?>fiok/logout"><span class="glyphicon glyphicon-log-out"></span> Kilépés</a></li-->
      <?php } ?>
    </ul>
  </div>
</nav>
</div>