<style>
	#cke_1_contents{
		height:600px !important;
	}
</style>

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}
?>

<div id="error_msg"></div>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Egyéb</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
			<a href="<?= base_url() ?>hirlevelek/create"><button type="button" class="btn btn-warning">Új Feliratkozó</button></a>
			<a href="<?= base_url() ?>hirlevelek/manage/20"><button type="button" class="btn btn-primary">Feliratkozók</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-envelope"></i> <img id='loader' src="<?=base_url()?>dist/img/loader.gif" alt='loader' style='height: 20px; display: none;'> Hírlevél küldés</h3>
			<div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
		</div>
		<div class="box-body">

			  <fieldset class="col-sm-12">
			<form method="post" id="email_service">
              <div class="box-body">
                <!--div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div-->
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea id="message" name="message" class="textarea" rows="10" cols="80" style="display:none;">
                  	
					









	<table border="0" cellpadding="0" cellspacing="0" style="width:590px">
	<tbody>
	<tr>
	<td style="background-color:#eae8e1; vertical-align:top">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="background-color:#eae8e1; vertical-align:top">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="background-color:#e5e4e6; vertical-align:top">
	<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="vertical-align:top">
	<table align="center" border="0" cellpadding="0" cellspacing="0">
	<tbody>
	<tr>
	<td style="vertical-align:middle">
	<h1><strong>KossuthK&ouml;nyvt&aacute;r</strong></h1>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td style="background-color:#eae8e1; vertical-align:top">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="background-color:#eae8e1; vertical-align:top">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="background-color:#ffffff; vertical-align:top">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
	<tr>
	<td style="vertical-align:top">
	<p><strong>&Uuml;dv&ouml;z&ouml;lj&uuml;k a KossuthK&ouml;nyvt&aacute;rn&aacute;l!</strong></p>

	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere molestie ante, eu vestibulum nulla dignissim ut. Cras vulputate consequat ex, eget cursus eros viverra vitae. Ut volutpat enim non maximus porta. Morbi vitae maximus dolor. Maecenas mattis ultricies urna eu pharetra. Ut vitae ligula eu justo posuere vulputate a ut odio. Fusce dapibus nisi ut neque ultrices faucibus. Donec ligula metus, tincidunt ut ullamcorper ac, auctor sed est. Fusce ac justo turpis. Donec ac fermentum enim. Suspendisse potenti. Nam ultrices, purus quis tempor interdum, metus ipsum laoreet diam, eget malesuada nisl augue vel sem. Duis varius dui vitae diam lacinia vestibulum. In blandit nec massa ut sollicitudin. Nulla non mi nec sem ornare fringilla. Mauris ac urna&nbsp;dignissim, maximus lorem sit amet, condimentum ipsum.</p>
												</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	</tr>
	<tr>
	<td style="background-color:#ffffff; vertical-align:top">
	<ul>
	<li><a href="https://www.otpbank.hu/portal/hu/JogiEtikaiNyilatkozat#Impresszum">Impresszum</a></li>
	<li><a href="https://www.otpbank.hu/portal/hu/Kondiciok">Hirdetm&eacute;nyek &eacute;s &uuml;zletszab&aacute;lyzatok</a></li>
	<li><a href="https://www.otpbank.hu/portal/hu/JogiEtikaiNyilatkozat">Jogi &eacute;s etikai nyilatkozat</a></li>
	<li><a href="https://www.otpbank.hu/portal/hu/PFK">P&eacute;nz&uuml;gyi Fogyaszt&oacute;v&eacute;delmi K&ouml;zpont</a></li>
	</ul>

	<p>&nbsp;&copy; Copyright 2018 KossuthK&ouml;nyvt&aacute;r&nbsp;<a href="https://www.shiwaforce.com/" target="_blank">Powered by CodeIgniter</a></p>
			</td>
	</tr>
	<tr>
	<td style="background-color:#eae8e1; vertical-align:top">&nbsp;</td>
	</tr>
	</tbody>
	</table>










                  </textarea>

                </div>
              </div>
	            <div class="box-footer clearfix">
	              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
	                <i class="fa fa-arrow-circle-right"></i></button>
	            </div>
        	</form>
			  </fieldset>

		</div>
	</div><!--/span-->

</div><!--/row-->


<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
<!-- CK Editor -->
<script src="<?=base_url()?>bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
$(document).ready(function(){   
  $('#email_service').on("submit", function(event){
	    $('#loader').show();
        event.preventDefault();
        $(window).on('beforeunload', function(){
            return 'Are you sure you want to leave?';
        });
        $.ajax({  
             url:"<?= base_url() ?>mail_service/send_email_for_everyone",  
             method:"POST",  
             data:$('#email_service').serialize(),                   
             complete:function(data){
             	$('#loader').hide();
                $('#error_msg').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Az új hírlevelet sikeresen továbbítottuk!</div>');          
             	$(window).off('beforeunload');
            }  
        });
    });

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('message')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
});    
</script>
