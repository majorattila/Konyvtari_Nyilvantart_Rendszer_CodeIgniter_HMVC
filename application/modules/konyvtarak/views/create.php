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
			<a href="<?= base_url() ?>Konyvtarak/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Könyvtár Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Könyvtár Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."Konyvtarak/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">

							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="nev">Név</label> <input name="nev" value="<?=$nev ?>" type="text" class="form-control" id="nev"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="foigazgato">Főigazgató</label> <input name="foigazgato" value="<?=$foigazgato ?>" type="text" class="form-control" id="foigazgato"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="iranyitoszam">Irányítószám</label> <input name="iranyitoszam" value="<?=$iranyitoszam ?>" type="text" class="form-control" id="iranyitoszam"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="varos">Város</label> <input name="varos" value="<?=$varos ?>" type="text" class="form-control" id="varos"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="kerulet">Kerület</label> <input name="kerulet" value="<?=$kerulet ?>" type="text" class="form-control" id="kerulet"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="cim">Cím</label> <input name="cim" value="<?=$cim ?>" type="text" class="form-control" id="cim"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="telefon_szam">Telefon szám</label> <input name="telefon_szam" value="<?=$telefon_szam ?>" type="text" class="form-control" id="telefon_szam"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="fax_szam">Fax szám</label> <input name="fax_szam" value="<?=$fax_szam ?>" type="text" class="form-control" id="fax_szam"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="email">Email</label> <input name="email" value="<?=$email ?>" type="text" class="form-control" id="email"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="fiok_megjegyzesek">Fiók megjegyzések</label> <input name="fiok_megjegyzesek" value="<?=$fiok_megjegyzesek ?>" type="text" class="form-control" id="fiok_megjegyzesek"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="url">Url</label> <input name="url" value="<?=$url ?>" type="text" class="form-control" id="url"> </div></div><br/>

							<div class="form-actions">
							  <button type="submit" class="btn metro-button mtr-green mtr-round margin" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn metro-button mtr-orange mtr-round margin" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->