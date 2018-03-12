<?php
$first_bit = $this->uri->segment(1);
$third_bit = $this->uri->segment(3);
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

  <style>
  /*
  	body{
  		background-image: url('<?=base_url()?>dist/img/background/pwd_bg.png') !important;
  		background-size: cover !important;
  		background-repeat: no-repeat !important;
  		background-position: center !important;
  		background-attachment: fixed !important;
  	}
  	*/
	#video_bg {
	    position: fixed;
	    right: 0;
	    bottom: 0;	    
	    /*width: 100%;*/ 
      width: 2000px;
	    min-width: 100%; 
	    min-height: 100%;
  	}
  	#filter{
  		width:100%;
  		height:100%;
  		position: fixed;
      background-color: rgba(255, 255, 255, 0.67);
  	}
  </style>

  <style>
    body{
      overflow-y: hidden; 
    }
    .cb-slideshow{
      list-style-type: none;
    }
    .fixed_pos.full_width{    
      width:100%;	
      position: fixed;
    }
    .login-box{
      box-shadow: 0px 0px 30px #0000004d;
      background-color: #fff;
      margin: 9% auto;
    }
    .btn-transparent {    
    	color: #000;	
    	background-color: #ffffff00;
    	border: 1px solid #b563c3 !important;
  		transition: background-color 0.1s ease;
    }
    .btn-transparent:hover {
    	color: #fff;
    	background-color: #b563c3;
    }
    .login-box-body, .register-box-body{
      padding-top: 0px !important;
    }


    @media (max-width:576px){
      #video_bg{
        display: none;
      }
      .login-page{
        background-color: #fff;
      }
      .login-box{
        box-shadow: none;
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




<video id="video_bg" autoplay loop>
  <source src="<?=base_url()?>dist/vid/Particle_Wave_4K_Motion_Background_Loop.mp4" type="video/mp4">
</video>

<div id="filter"></div>



<div class="fixed_pos full_width">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>Kossuth</b>KÖNYVTÁR</a>
  </div>
  <!-- /.login-logo -->
  <div id="first_step" class="login-box-body">
    <h2 class="login-box-msg">Jussunk be a fiókjába</h2>
    <p>Mondja el nekünk az alábbiak egyikét az induláshoz:</p>
    <ul>
    	<li>Bejelentkezési e-mail cím vagy mobilszám</li>
    	<li>Helyreállítási telefonszám</li>
    	<li>Másodlagos e-mail címet</li>
    </ul>

    <?php echo validation_errors('<p style="color: red;">','</p>'); ?>

    <form id="new_password" action="<?=base_url()?>fiok/password_ajax/1" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button name="submit" value="Submit" class="btn btn-transparent btn-flat pull-right">Folytatás</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>





 <div id="second_step" class="login-box-body" style="display: none;">
    <h4 class="login-box-msg">Van hozzáférésed ehhez az e-mailhez?</h4>
    	<p>
    		<b><span class="mail"></span></b>
    		 <a onclick="back_to_edit()" href="javascript: void(0)">Szerkeszt</a>
    	</p>
    <p>Küldünk Önnek egy fiókkulcsot, azért, hogy ellenőrizhessük az azonosságát.</p>

    <?php echo validation_errors('<p style="color: red;">','</p>'); ?>

    
      <div class="form-group has-feedback">

      <div class="row">
      <form id="new_password2" action="<?=base_url()?>fiok/password_ajax/2" method="post">

      <input type="hidden" name="email">
      <input type="hidden" name="action">

        <div class="col-xs-12">
          <button name="submit" value="Send" class="btn btn-transparent btn-block btn-flat pull-right">Azonosító Email küldése</button>
        </div><br/><br/>

        
        </form>
        <div class="col-xs-12">
          <button name="next_option" value="Other" class="btn btn-transparent btn-block btn-flat pull-right">Nem férek hozzá az email fiókomhoz</button>
        </div>
    </div>
  </div>
</div>



  <div id="third_step" class="login-box-body" style="display: none;">
    <h4 class="login-box-msg">Biztonsági okokból ellenőrizzük az olvasójegyét</h4>
    <!-- Biztonsági okokból ellenőrizze a hiányzó számjegyeket -->
      <p>
        <b><span class="mail"></span></b>
         <a onclick="back_to_edit()" href="javascript: void(0)">Szerkeszt</a>
      </p>
      <div id="error_msg"></div>

      <div class="form-group has-feedback">
        
      
        <div class="row">
      <form id="new_password3" action="<?=base_url()?>fiok/password_ajax/3" method="post">
        <div class="col-xs-12">
        <div class="form-group has-feedback">
          <input type="number" name="olvasojegy" class="form-control" placeholder="Olvasójegy">
        </div>
        </div>

        <div class="col-xs-12" style="margin-bottom: 5px;">
          <button name="submit" value="Confirm" class="btn btn-transparent btn-block btn-flat pull-right">Jóváhagy</button>
        </div><br><br>

      </form>

      <div class="col-xs-12">
          <button name="go_to_abort" class="btn btn-transparent btn-block btn-flat pull-right">Nem tudom a számokat</button>
        </div>
        </div>

    </div>
</div>


  <div id="final_step" class="login-box-body" style="display: none;">
    <h4 class="login-box-msg">Kérjük ellenőrizze az email fiókját</h4>
      <p>Az aktivációs kulcsot erre az email címre küldtük</p>
      <b><span class="mail"></span></b>
         <a onclick="back_to_edit()" href="javascript: void(0)">Szerkeszt</a>

    <?php echo validation_errors('<p style="color: red;">','</p>'); ?>

      <div class="form-group has-feedback" style="float: unset;">
        
      <div class="col-xs-12"><br>
    
        <a href="<?=base_url()?>fiok/login" class="btn btn-transparent btn-flat pull-right">Belépés</a>
        <button name="other_options" value="Submit" class="btn btn-transparent btn-flat pull-right">Másik opció</button>
      </div>
      <br><br>
  </div>
</div>



  <div id="abort_step" class="login-box-body" style="display: none;">
    <h1 class="login-box-msg">Uh-oh...</h1>
      <p>Úgy tűnik, nem tudjuk helyreállítani fiókját online. A leggyakoribb okok a következők:</p>
      <ul>
        <li>Nincs más helyreállítási opció a fiókjában</li>
        <li>Elérte az SMS vagy az E-mail kísérletekre vonatkozó napi limitjét</li>
      </ul>
      <b><span class="mail"></span></b>
         <a onclick="back_to_edit()" href="javascript: void(0)">Szerkeszt</a>

    <?php echo validation_errors('<p style="color: red;">','</p>'); ?>

      <div class="form-group has-feedback" style="float: unset;"><br/>
        
      <div class="row">

        <div class="col-xs-12" style="margin-bottom: 5px;">
          <button name="go_to_start" value="Confirm" class="btn btn-transparent btn-block btn-flat pull-right">Előröl kezdem</button>
        </div><br><br>

        <div class="col-xs-12">
          <button name="go_to_abort" value="Finish" class="btn btn-transparent btn-block btn-flat pull-right">Segítség</button>
        </div>
        </div>

  </div>
</div>



  <div id="change_pword" class="login-box-body" style="display: none;">
    <h1 class="login-box-msg">Jelszó módosítása</h1>
    <div id="error_msg2"></div>
      

      <!-- Variables BEGIN -->
      <input type="hidden" name="email">
      <input type="hidden" name="olvasojegy">
      <!-- Variables END -->

      <div class="form-group has-feedback" style="float: unset;"><br/>        
      

      <div class="row">

        <form id="change_pword_form" action="<?=base_url()?>fiok/password_ajax/4" method="post">

        <div class="col-xs-12">
        <div class="form-group has-feedback">
          <input type="password" name="pword" class="form-control" placeholder="Jelszó megadás">
        </div>
        </div><br><br>

        <div class="col-xs-12">
        <div class="form-group has-feedback">
          <input type="password" name="pword_repeate" class="form-control" placeholder="Jelszó ismétlése">
        </div>
        </div><br><br>

        <div class="col-xs-12">
        <div class="form-group has-feedback">
          <button name="submit" value="Submit" class="btn btn-transparent btn-block btn-flat pull-right">Módosítás</button>
        </div>
        </div><br/><br/>

        </form>

        <div class="col-xs-12">         
        <div class="form-group has-feedback" style=" margin-top: 5px;">
          <button name="go_to_start" class="btn btn-transparent btn-block btn-flat pull-right">Vissza</button>
        </div>
        </div>
      </div>

  </div>
</div>


<div id="_success_box" class="login-box-body" style="display: none;">
    <h1 class="login-box-msg">Sikeres módosítás</h1>
    <p>A jelszó módosítás megtörtént. Kérjük jelentkezzen be az új jelszavával.</p>

      <div class="form-group has-feedback" style="float: unset;"><br/>        
      

      <div class="row">

        <div class="col-xs-12">
        <div class="form-group has-feedback">
          <a href="<?=base_url()?>fiok/login" class="btn btn-transparent btn-block btn-flat pull-right">Belépés</a>
        </div>
        </div><br/><br/>

      </div>

  </div>
</div>



  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>

<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
<!-- Crypto JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
<script>

<?php 
if(!isset($is_valid_key)){
  $is_valid_key = "false";
} 
if(!isset($olvasojegy)){
  $olvasojegy = "";
} 
?>

if(<?=$is_valid_key?>){
  $('#first_step').hide();
  $('#change_pword').show();
  $('#change_pword input[name=email]').val("<?=$third_bit?>");
  $('#change_pword input[name=olvasojegy]').val("<?=$olvasojegy?>");
}
function back_to_edit(){
	$('#second_step').hide();
  $('#third_step').hide();
  $('#final_step').hide();
  $('#abort_step').hide();
  $('#change_pword').hide();
  $('#first_step').show();
}
$('button[name=next_option]').on('click', function(){
  $('#first_step').hide();
  $('#second_step').hide();
  $('#final_step').hide();
  $('#abort_step').hide();
  $('#change_pword').hide();
  $('#third_step').show();
});
$('button[name=other_options]').on('click', function(){
  $('#first_step').hide();
  $('#third_step').hide();
  $('#final_step').hide();
  $('#abort_step').hide();
  $('#change_pword').hide();
  $('#second_step').show();
});
$('button[name=go_to_abort]').click(function(){
  $('#first_step').hide();
  $('#second_step').hide();
  $('#third_step').hide();
  $('#final_step').hide();
  $('#change_pword').hide();
  $('#abort_step').show();
});
$('button[name=go_to_start]').click(function(){
  $('#second_step').hide();
  $('#third_step').hide();
  $('#final_step').hide();
  $('#abort_step').hide();
  $('#change_pword').hide();
  $('#first_step').show();
});
 $('input[name=email]').focusout(function(){
 	$('.mail').text($(this).val());
  $('input[name=email]').val($(this).val());
 });
  $('input[name=olvasojegy]').focusout(function(){
  $('input[name=olvasojegy]').val($(this).val());
 });
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-orange',
      radioClass: 'iradio_flat-orange',
      increaseArea: '20%' // optional
    });
    document.querySelector('#video_bg').playbackRate = 0.60;
  });
  $(document).ready(function(){   
  $('#new_password').on("submit", function(event){  
       event.preventDefault();
        $.ajax({  
             url:"<?=base_url()?>fiok/password_ajax/1",  
             method:"POST",  
             data:$('#new_password').serialize(),                   
             success: function(data){
                if(data){
                	$('#first_step').hide();
                  $('#third_step').hide();
                  $('#final_step').hide();
                  $('#abort_step').hide();
                  $('#change_pword').hide();
                  $('#second_step').show();
                }
            }  
        });   
    });

  $('#new_password2 button[name=submit]').click(function(){
       $('#new_password2 input[name=action]').val($(this).val());
  });

  $('#new_password2').on("submit", function(event){
       event.preventDefault();
        $.ajax({  
             url:"<?=base_url()?>fiok/password_ajax/2",  
             method:"POST",  
             data:$('#new_password2').serialize(),                   
             success: function(data){
              if(data == "Az emailt sikeresen elküldte..."){
                $('#first_step').hide();
                $('#second_step').hide();
                $('#third_step').hide();
                $('#abort_step').hide();
                $('#change_pword').hide();
                $('#final_step').show();
              }
            }  
        });   
    });
  $('#new_password3').on("submit", function(event){
       event.preventDefault();
        $.ajax({  
             url:"<?=base_url()?>fiok/password_ajax/3",  
             method:"POST",  
             data:$('#new_password3').serialize(),                   
             success: function(data){
              if(data == "confirm"){
                $('#first_step').hide();
                $('#second_step').hide();
                $('#third_step').hide();
                $('#final_step').hide();
                $('#abort_step').hide();
                $('#change_pword').show();
              }else{                
                  $('#error_msg').html('<p style="color: red;">Hibás számot adott meg!</p>');
              }
            }  
        });   
    });
  $(document).on('keyup keypress change focusout', 'input[name=pword_repeate], input[name=pword]', function(e) {
      var pword = $('input[name=pword]').val();
      var pword_repeate = $('input[name=pword_repeate]').val();
      if(pword != pword_repeate){        
          $('#error_msg2').html('<span style="color: red;">Nem egyezik a 2 jelszó!</span>');
      }else{
        $('#error_msg2').empty();
      }
  });
  $('#change_pword_form').on("submit", function(event){
      event.preventDefault();
      var pword = $('input[name=pword]').val();
      var pword_repeate = $('input[name=pword_repeate]').val();
      if(pword == pword_repeate){
        <?php if(is_null($third_bit)){ ?>
          $('input[name=email]').val(CryptoJS.MD5($('input[name=email]').val()));
        <?php } ?>
        $.ajax({  
             <?= is_null($third_bit) ? 'url:"'.base_url().'fiok/password_ajax/4"':'url:"'.base_url().'fiok/password_ajax/4/'.$third_bit.'"'?>,  
             method:"POST",  
             data:$('#change_pword_form').serialize(),                   
             success: function(data){
              if(data != 1){
                $('#first_step').hide();
                $('#second_step').hide();
                $('#third_step').hide();
                $('#final_step').hide();
                $('#abort_step').hide();
                $('#change_pword').show();            
              }else{
                $('#change_pword').hide();
                $('#_success_box').show();
              }
            }  
          });
        }else{
          $('#error_msg2').html('<span style="color: red;">Nem egyezik a 2 jelszó!</span>');
        }
    });
});
</script>
</body>
</html>