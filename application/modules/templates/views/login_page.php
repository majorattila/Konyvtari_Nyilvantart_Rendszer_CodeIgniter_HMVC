<?php
$first_bit = $this->uri->segment(1);
$form_location = base_url().$first_bit.'/submit_login';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" href="<?= base_url() ?>dist/img/llama_ico.png">

  <title>LOGIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/flat/orange.css">

  <link rel="stylesheet" href="<?=base_url()?>dist/css/slideshow.css">

  <style>
    body{
      overflow-y: hidden; 
    }
    .cb-slideshow{
      list-style-type: none;
    }
    .login-box{
      background-color: #fff;
      margin: 9% auto;
    }
    @media (max-width:576px){
      .cb-slideshow{
        display: none;
      }
      .login-page{
        background-color: #fff;
      }
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="page hold-transition login-page">

<ul class="cb-slideshow" style="z-index:-10;">
  <li><span>Image 01</span></li>
  <li><span>Image 02</span></li>
  <li><span>Image 03</span></li>
  <li><span>Image 04</span></li>
  <li><span>Image 05</span></li>
  <li><span>Image 06</span></li>
</ul>
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>index2.html"><b>Kossuth</b>KÖNYVTÁR</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Belépés a könyvtár oldalára</p>

    <?php echo validation_errors('<p style="color: red;">','</p>'); ?>

    <form action="<?=$form_location?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" value="<?=$username?>" class="form-control" placeholder="Email | Felhasználónév" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pword" class="form-control" placeholder="Jelszó" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-7">
          <div class="checkbox icheck">
            <?php
            if($first_bit=="fiok"){ ?>
            <label>
              <input type="checkbox" name="remember" value="remember-me">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Emlékezzen rám?
            </label>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button name="submit" value="Submit" class="btn btn-primary btn-block btn-flat">Bejelentkezés</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--div class="social-auth-links text-center">
      <p>- VAGY -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Belépés Facebook fiókkal</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Belépés Google+ fiókkal</a>
    </div-->
    <!-- /.social-auth-links -->

    <a href="<?=base_url()?>fiok/password">Elfelejtettem a jelszavam</a><br>
    <a href="<?=base_url()?>fiok/start" class="text-center">Regisztrálás új tagként</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-orange',
      radioClass: 'iradio_flat-orange',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>