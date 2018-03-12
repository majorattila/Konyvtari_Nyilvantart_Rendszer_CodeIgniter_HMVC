<?php
$this->load->module('php_strap_cv');
$first_segment = $this->uri->segment(1);
?>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- CK Editor -->
<script src="<?=base_url()?>bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<style>
	#cke_editor1{
		padding: 1px;
	}

	textarea{
	    overflow: hidden;
	    resize: vertical;
	  }
</style>

<h1><?=$headline ?></h1><br/>
<?= validation_errors("<p style='color:red;'>", "</p>");

	if(isset($flash))
	{
		echo $flash;
	}
?>
<div id="error_msg"></div>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Hírek Adatai</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">


					<?php
					$form_location = base_url()."hirek/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
							<fieldset class="col-xs-12">
								<?php /* ?>
								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-3 col-xl-3">
										<label class="form-label" for="kategoria">Kategória </label>
       								 	<div class="input-group col-xs-12 col-sm-12">
											<!--input name="kategoriak" list="kategoriak" value="<?=$kategoria?>" maxlength="255" type="text" class="form-control" id="kategoria" autocomplete="off">
									        <datalist id="kategoriak">
									        </datalist-->

									        <input name="kategoriak" list="kategoriak" id="kategoria" class="form-control" autocomplete="off" value="<?=$kategoria?>">
								            <span class="input-group-btn hidden-xs hidden-sm">
								            <button name="new_cat" class="btn btn-twitter btn-flat" type="button"><span class="fa fa-fw fa-pencil"></span></button>
								          </span>
								          <datalist id="kategoriak">
								          </datalist>
										</div>
									</div>
								</div>
								<?php */ 
								$max_id = 1;
								?>
								<div class="row" >
						        	<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-3 col-xl-3">
						        		<label for="kategoriak">Kategóra</label>
       								 	<div class="input-group col-xs-12 col-sm-12">
						        		<select name="kategoriak" class="form-control" id="kategoriak">
						        			<option data-id=''>---</option>
						        			<?php
						        			foreach ($query_categories->result() as $row) {
						        			$max_id = $row->k_id?>		        			
						        			<option data-id="<?=$row->k_id?>" data-url="<?=$row->k_url?>" <?= $kategoria == $row->k_neve ?"selected":""?>><?= $row->k_neve ?></option>
						        			<?php } ?>
						        		</select>
								            <span class="input-group-btn"><!--hidden-xs hidden-sm-->
						        			<button name="new_cat" class="btn btn-twitter btn-flat" type="button"><span class="fa fa-fw fa-pencil"></span></button>
						        			<button name="del_cat" class="btn btn-twitter btn-flat" type="button"><span class="fa fa-fw fa-trash"></span></button>
						        			</span>
						        		</div>
						        	</div>
						        </div>
						        <?php
						        $publikalas_datuma = empty($publikalas_datuma)?date('Y-m-d'):$publikalas_datuma;
						        ?>
								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-3 col-xl-3">
									  <label class="form-label" for="typeahead">Publikálás dátuma </label>
										<input type="date" name="publikalas_datuma" class="form-control" value="<?=$publikalas_datuma ?>">
									</div>
								</div>

								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
									  <label class="form-label" for="typeahead">Cím</label>
										<input type="text" class="form-control" name="oldal_cim" value="<?=$oldal_cim ?>">
									</div>
								</div>

								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
									  <label class="form-label">Kulcsszavak</label>
										<textarea rows="3" class="form-control" name="oldal_kulcsszavak"><?php 
											echo $oldal_kulcsszavak; 
										?></textarea>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
									  <label class="form-label">Leírás</label>
										<textarea class="form-control" name="oldal_leiras"><?php 
											echo $oldal_leiras; 
										?></textarea>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 hidden-phone">
									  <label class="form-label" for="textarea2">Tartalom</label>
										<textarea class="cleditor" id="editor1" name="oldal_tartalom"><?php 
											echo $oldal_tartalom; 
										?></textarea>
									</div>
								</div>

								<?php 
								$szerzo = !empty($szerzo)?$szerzo:$this->session->userdata('lastname').' '.$this->session->userdata('firstname');
								?>

									<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
									  <label class="form-label" for="typeahead">Szerző</label>
										<input type="text" class="form-control" name="szerzo" value="<?=$szerzo ?>">
									</div>
								</div>


								<div class="form-actions">
								  <button type="submit" class="btn btn-success margin" name="submit" value="Submit">Mentés</button>
								  <button type="submit" class="btn btn-secondary margin" name="submit" value="Cancel">Mégse</button>
								</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php
if(is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> További beállítások</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
		<?php

		if($kep=="") {?>
		<a href="<?= base_url() ?>hirek/upload_image/<?= $update_id ?>"><button type="button" class="btn btn-secondary margin">Kép feltöltése</button></a>
		<?php
		}else{ ?>
		<a href="<?= base_url() ?>hirek/delete_image/<?= $update_id ?>"><button type="button" class="btn btn-danger margin">Kép törlése</button></a>
		<?php
		}

		if($update_id>2){ ?>
		<a href="<?= base_url() ?>hirek/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger margin">Hír eltávolítása</button></a>
		<?php
		}
		?>
			<a href="<?= base_url().'kategoriak/10/0/'.urlencode($oldal_url) ?>"><button type="button" class="btn btn-secondary margin">Hír megtekintése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>



<?php
if($kep!=""){?>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Kép</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">

			<img src="<?= base_url() ?>hirek_pics/<?=$kep ?>" style="max-width:100%;">

		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}

//$this->php_strap_cv->datalist('kategoria', 'kategoriak', base_url().$first_segment.'/datalist/hirek_kategoria/k_neve');
?>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
</script>

<?php 

//Ez itt a könyv nyelvek ablak  
  $fields = array(
    array('label' => 'Kategória neve' ,'name' => 'k_neve', 'type' => 'text'),
    array('label' => 'URL cím' ,'name' => 'k_url', 'type' => 'text'),
    array('label' => '' ,'name' => 'k_id', 'type' => 'hidden')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/add_new_cat";
  $message = "Az új kategóriát sikeresen hozzáadta!";
  $custom_script = 
  "var k_neve_input;
  var k_url_input;
  var max_id = '".$max_id."';
  \$(\"button[name='new_cat']\").click(function(){
    \$('#insert_form')[0].reset();
    var selected_option = $('select[name=kategoriak] option:selected').text();
    var selected_option_url = $('select[name=kategoriak] option:selected').data('url');
    var selected_option_id = $('select[name=kategoriak] option:selected').data('id');
    
    if(selected_option == '---'){
    	selected_option = '';
    }

    \$('#insert_form input[name=k_neve]').val(selected_option);
    \$('#insert_form input[name=k_url]').val(selected_option_url);
    \$('#insert_form input[name=k_id]').val(selected_option_id);
    \$(\"#add_new_Modal\").modal(\"show\");
  });
  \$(\"button[name='del_cat']\").click(function(){
	event.preventDefault();
    \$.ajax({  
         url:'".base_url()."hirek/insert_with_ajax/del_cat',  
         method:'POST',  
         data:\$('#kategoriak').serialize(),
         complete:function(data){
              \$('#error_msg').html(\"<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>A kiválasztott hír kategóriát sikeresen törölte!</div>\");
        }  
    });
    \$('option').remove( \":contains(\"+\$('select[name=kategoriak] option:selected').text()+\")\");
  });
  \$('input[name=k_neve]').on('keyup focusout', function(){
	 k_neve_input = \$('input[name=k_neve]').val();

	var prev = ['á','í','é','ö','ü','ó','ő','ú','ű'];
	var new1 = ['a','i','e','o','u','o','o','u','u'];
	new_k_url = k_neve_input;
	

	for (i = 0; i < new_k_url.length; i++) {
		for (j = 0; j < prev.length; j++) {
	        if(new_k_url.charAt(i) == prev[j]){
	        	new_k_url = setCharAt(new_k_url, i, new1[j]).toLowerCase();
	        }
	    }
	}
  
  	\$('input[name=k_url]').val(new_k_url);
  	k_url_input = new_k_url;
  
  });  

  \$('input[name=k_url]').on('keyup focusout', function(){
     k_url_input = \$('input[name=k_url]').val();
  });

  \$('#add_new_Modal button[name=insert]').on('click', function(){

	
	var temp = \$('#insert_form input[name=k_id]').val();

	if(temp == ''){
		\$.ajax({url: '".base_url()."hirek/print_max_id', async: true, success: function(result){ max_id = result; }});
		\$('select[name=kategoriak]').append('<option data-id=\"'+max_id+'\" data-url=\"'+k_url_input+'\">'+k_neve_input+'</option>');
	}else{
		\$('select').children('option[data-id='+temp+']').remove();
		\$('select[name=kategoriak]').append('<option data-id=\"'+temp+'\" data-url=\"'+k_url_input+'\">'+k_neve_input+'</option>');
	}
  });


  function setCharAt(str,index,chr) {
  	if(index > str.length-1) return str;
	return str.substr(0,index) + chr + str.substr(index+1);
  }
  ";

  $this->php_strap_cv->new_modal("add_new_Modal", "Új Kategória Hozzáadása", "insert_form", $fields, "new_cat", $ajax_url, $message, $custom_script);

  ?>