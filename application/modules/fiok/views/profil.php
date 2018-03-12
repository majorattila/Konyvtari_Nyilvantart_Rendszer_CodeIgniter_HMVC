<?php if(isset($_SESSION['is_admin']) && is_numeric($_SESSION['is_admin'])){ ?>
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<?php } ?>

<style>
.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
	min-width: 220px;
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size: 20px;
}

.fb-profile-text>h3{
    font-weight: 700;
    font-size: 17px;
}

.fb-image-profile
{
    margin: -50px 19px 0px -3px;
    z-index: 9;
    width: 20%;
    min-width: 160px;
}
}

.gallery_product, .add_gallery_product
{
	cursor: pointer;
    margin-bottom: 30px;    
}
.gallery_product a, .add_gallery_product a {
	width:365px;
    height:365px;
}

img {border : 0;}
img a {outline : none;}

.scrollable-box{
	padding-right: 23px;
    margin-right: -10px;
    height: 450px;
    overflow-y: overlay;
}

</style>

<script>
function previewFile() {
  var preview = document.querySelector('img.fb-image-profile');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
</script>

<div class="container" style="margin-top: 100px; margin-bottom: 50px; background-color: unset;">
    <div class="fb-profile">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
        	<img align="left" class="img-circle fb-image-profile" src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile; ?>" alt="Profile Image"/>
        </a>
        <div class="fb-profile-text">
            <h1><?php echo $lastname . ' ' . $firstname;?></h1>
            <h3>felhasználónév: <?= $username ?></p>
        </div>
    </div>
</div> <!-- /container -->  


<div class="col-md-9 col-md-offset-1">

<?php
    echo validation_errors("<p style='color:red;'>", "</p>") . "<br/>";

    if(isset($flash))
    {
      echo $flash;
    }
?> 

<div id="error_msg"></div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Adatok</a></li>
  <li><a data-toggle="tab" href="#menu1">Adatok Módosítása</a></li>
</ul>

<div class="tab-content">
 <div id="home" class="tab-pane fade in active">
   <br/><br/>
   <table class="table table-striped">
		<tr>
			<td><b>Vezetéknév:</b></td>
			<td><?= $lastname ?></td>
		</tr>
		<tr>			
			<td><b>Keresztnév:</b></td>
			<td><?= $firstname ?></td>
		</tr>
		<tr>			
			<td><b>Felhasználónév:</b></td>
			<td><?= $username ?></td>
		</tr>
		<tr>
			<td><b>Email:</b></td>
			<td><?= $email ?></td>			
		</tr>
		<tr>
			<td><b>Olvasójegy:</b></td>
			<td><?= $library_card ?></td>
		</tr>
   </table>
 </div>
 <div id="menu1" class="tab-pane fade">
 <br/><br/><br/>


<?php 
$form_location = base_url().'fiok/profil';
?>

<div class="row">
	<form action="<?= $form_location ?>" method="post">
		<div class="form-group">
		    <label for="vezeteknev">Vezetéknév:</label>
		    <input name="vezeteknev" type="text" class="form-control" id="vezeteknev" value="<?= $lastname ?>">
		</div>
		<div class="form-group">
		    <label for="keresztnev">Keresztnév:</label>
		    <input name="keresztnev" type="text" class="form-control" id="keresztnev" value="<?= $firstname ?>">
		</div>
		<div class="form-group">
		    <label for="felhasznalonev">Felhasználónév:</label>
		    <input name="felhasznalonev" type="text" class="form-control" id="felhasznalonev" value="<?= $username ?>">
		</div>
		<div class="form-group">
		    <label for="email">Email:</label>
		    <input type="email" class="form-control" id="email" value="<?= $email ?>" disabled>
		</div>
		<div class="form-group">
		    <label for="olvasojegy">Olvasójegy:</label>
		    <input name="olvasojegy" type="text" class="form-control" id="olvasojegy" value="<?= $library_card ?>">
		</div><br/>
		<div class="form-group"> 
		 	<button name="submit" value="Submit" type="submit" class="btn btn-success">Mentés</button>		 	
		</div>
	</form>
 </div>
</div>

</div>

</div>




<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Profilképek</h4>
        </div>
        <div class="modal-body">

        	<div class="scrollable-box">
          
				<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter hdpe">
	                <img src="<?= base_url() . 'dist/img/avatar/png/boy.png'?>" data-img="boy.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter sprinkle">
	                <img src="<?= base_url() . 'dist/img/avatar/png/boy-1.png'?>" data-img="boy-1.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter hdpe">
	                <img src="<?= base_url() . 'dist/img/avatar/png/girl.png'?>" data-img="girl.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/girl-1.png'?>" data-img="girl-1.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/man.png'?>" data-img="man.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/man-1.png'?>" data-img="man-1.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/man-2.png'?>" data-img="man-2.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/man-3.png'?>" data-img="man-3.png" class="img-responsive">
	            </div>

	            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <img src="<?= base_url() . 'dist/img/avatar/png/man-4.png'?>" data-img="man-4.png" class="img-responsive">
	            </div>

	            <div class="add_gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-4 filter irrigation">
	                <label class="" for="file5" style="cursor:pointer;">
	                	<img src="<?= base_url() . 'dist/img/avatar/png/plus.png'?>" class="img-responsive">
	                </label>
	                
	                <input onchange="previewFile()" style="display:none;" id="file5" type="file">
	            </div>

			</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <form id="pic" method="post">
  	<input id="image_path" name="picture" type="hidden" value="man-1.png">
  </form>

<script>
$(document).ready(function(){
	$( ".gallery_product" ).click(function() {
        var relative_path = $(this).children().data('img');
        var full_path = $(this).children().attr('src');
        $('#image_path').val(relative_path);
        $('#myModal').modal('hide');
        $('.fb-image-profile').attr('src',full_path);
        $('.special-img').attr('src',full_path);
	    $( "#pic" ).submit();
	});
	$('#pic').on("submit", function(event){  
       event.preventDefault();
        $.ajax({  
             url:"<?= base_url() ?>fiok/profil_kep_ajax",  
             method:"POST",  
             data:$('#pic').serialize(),                   
             success:function(data){
                  $('#error_msg').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>A profilképét sikeresn módosította.</div>');
            }  
        });   
    });
    /*
    $('#file5').on('change'),function(event){
    	previewFile();

    }*/
});    

</script>