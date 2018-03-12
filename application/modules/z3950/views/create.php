<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php

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
			<a href="<?= base_url() ?>z3950/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Z3950 Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Z3950 Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."z3950/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">

							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="nev">Név</label> <input name="nev" value="<?=$nev ?>" type="text" class="form-control" id="nev"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="host">Host</label> <input name="host" value="<?=$host ?>" type="text" class="form-control" id="host"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="port">Port</label> <input name="port" value="<?=$port ?>" type="text" class="form-control" id="port"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="adatbazis">Adatbázis</label> <input name="adatbazis" value="<?=$adatbazis ?>" type="text" class="form-control" id="adatbazis"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="szintaxis">Szintaxis</label> <input name="szintaxis" value="<?=$szintaxis ?>" type="text" class="form-control" id="szintaxis"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="felhasznalonev">Felhasználonév</label> <input name="felhasznalonev" value="<?=$felhasznalonev ?>" type="text" class="form-control" id="felhasznalonev"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="jelszo">Jelszó</label> <input name="jelszo" value="<?=$jelszo ?>" type="text" class="form-control" id="jelszo"> </div></div><br/>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->