<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php

	$this->load->module('php_strap_cv');
	$first_segment = $this->uri->segment(1);

	if(isset($flash))
	{
		echo $flash;
	}

if(is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Műveletek</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
			<a href="<?= base_url() ?>gyujtemenyek/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger margin">Gyűjtemény Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Gyűjtemény Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."gyujtemenyek/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">

							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="fiok_id">Fiók (könyvtár)</label> <input name="fiok_id" value="<?=$fiok_id ?>" type="text" class="form-control" id="fiok_id" list="fiok_datalist"> </div><datalist id="fiok_datalist"></datalist></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="leiras">Leírás</label> <input name="leiras" value="<?=$leiras ?>" type="text" class="form-control" id="leiras"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="hatralevo_napok">Hátralévő napok</label> <input name="hatralevo_napok" value="<?=$hatralevo_napok ?>" type="text" class="form-control" id="hatralevo_napok"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="kesedelmi_dij">Késedelmi díj</label> <input name="kesedelmi_dij" value="<?=$kesedelmi_dij ?>" type="text" class="form-control" id="kesedelmi_dij"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="kolcsonzoi_dij">Kölcsönzői díj</label> <input name="kolcsonzoi_dij" value="<?=$kolcsonzoi_dij ?>" type="text" class="form-control" id="kolcsonzoi_dij"> </div></div>

							<div class="row" >
								<div class="form-group col-xs-2">
									<label for="nem_masolhato">Nem másolható?</label>
									<select name="nem_masolhato" class="form-control" id="nem_masolhato">
										<option <?=$nem_masolhato=="Y"?"selected":""?>>Y</option>
										<option <?=$nem_masolhato=="N"?"selected":""?>>N</option>
									</select>
								</div>
							</div>

							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="masolat_dij">Másolat díj</label> <input name="masolat_dij" value="<?=$masolat_dij ?>" type="text" class="form-control" id="masolat_dij"> </div></div><br/>

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
$this->php_strap_cv->datalist('fiok_id', 'fiok_datalist', base_url().$first_segment.'/datalist/konyvtarak/nev');
?>