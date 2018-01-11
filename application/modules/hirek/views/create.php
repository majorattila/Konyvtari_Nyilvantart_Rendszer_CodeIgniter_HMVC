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

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");

	if(isset($flash))
	{
		echo $flash;
	}
?>
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
								<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-3 col-xl-3">
										<label class="form-label" for="kategoria">Kategória </label>
       								 	<div class="input-group col-xs-12 col-sm-12">
											<!--input name="kategoriak" list="kategoriak" value="<?=$kategoria?>" maxlength="255" type="text" class="form-control" id="kategoria" autocomplete="off">
									        <datalist id="kategoriak">
									        </datalist-->

									        <input name="kategoriak" list="kategoriak" id="kategoria" class="form-control" autocomplete="off" value="<?=$kategoria?>">
								            <span class="input-group-btn hidden-xs hidden-sm">
								            <button class="btn btn-twitter btn-flat" type="button"><span class="fa fa-fw fa-pencil"></span></button>
								          </span>
								          <datalist id="kategoriak">
								          </datalist>
										</div>
									</div>
								</div>
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

									<div class="row">
									<div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
									  <label class="form-label" for="typeahead">Szerző</label>
										<input type="text" class="form-control" name="szerzo" value="<?=$szerzo ?>">
									</div>
								</div>


								<div class="form-actions">
								  <button type="submit" class="btn metro-button mtr-green mtr-round margin" name="submit" value="Submit">Mentés</button>
								  <button type="submit" class="btn metro-button mtr-orange mtr-round margin" name="submit" value="Cancel">Mégse</button>
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
		<a href="<?= base_url() ?>hirek/upload_image/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-indigo mtr-round margin">Kép feltöltése</button></a>
		<?php
		}else{ ?>
		<a href="<?= base_url() ?>hirek/delete_image/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Kép törlése</button></a>
		<?php
		}

		if($update_id>2){ ?>
		<a href="<?= base_url() ?>hirek/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Hír eltávolítása</button></a>
		<?php
		}
		?>
			<a href="<?= base_url().$oldal_url ?>"><button type="button" class="btn metro-button mtr-steel mtr-round margin">Hír megtekintése</button></a>
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

$this->php_strap_cv->datalist('kategoria', 'kategoriak', base_url().$first_segment.'/datalist/hirek_kategoria/k_neve');
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