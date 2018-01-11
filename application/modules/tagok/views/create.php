<?php 
$this->load->module('php_strap_cv');
$first_segment = $this->uri->segment(1);
?>

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
			<a href="<?= base_url() ?>tagok/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Tag Törlése</button></a>
    		<a href="<?=base_url()?>tagok/kolcsonzesek/<?= $update_id ?>" class="btn metro-button mtr-teal mtr-round margin">Kölcsönzések</a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Tag Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."Tagok/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">


								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="olvasojegy">olvasójegy</label> <input name="olvasojegy" value="<?=$olvasojegy ?>" type="text" class="form-control" id="olvasojegy" maxlength="13"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="vezeteknev">vezetéknév</label> <input name="vezeteknev" value="<?=$vezeteknev ?>" type="text" class="form-control" id="vezeteknev"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="keresztnev">keresztnév</label> <input name="keresztnev" value="<?=$keresztnev ?>" type="text" class="form-control" id="keresztnev"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="szuletesi_datum">Születési dátum</label> <input name="szuletesi_datum" value="<?=$szuletesi_datum ?>" type="date" class="form-control" id="szuletesi_datum"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="lakcim">Lakcím</label> <input name="lakcim" value="<?=$lakcim ?>" type="text" class="form-control" id="lakcim"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="szemelyigazolvany">Személyigazolvány</label> <input name="szemelyigazolvany" value="<?=$szemelyigazolvany ?>" type="text" class="form-control" id="szemelyigazolvany"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="otthoni_telefon">Otthoni telefon</label> <input name="otthoni_telefon" value="<?=$otthoni_telefon ?>" type="text" class="form-control" id="otthoni_telefon"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="munkahelyi_telefon">Munkahelyi telefon</label> <input name="munkahelyi_telefon" value="<?=$munkahelyi_telefon ?>" type="text" class="form-control" id="munkahelyi_telefon"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="email">Email</label> <input name="email" value="<?=$email ?>" type="text" class="form-control" id="email"> </div></div>
								<?php /* ?>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="fiok_id">Fiók (könyvtár)</label> <input name="fiok_id" value="<?=$fiok_id ?>" type="text" class="form-control" id="fiok_id"> </div></div>
								php */ ?>

								<div class="row">
									<div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3">
								    	<label for="konyvtar">Fiók (könyvtár)</label>
										<div class="input-group col-xs-12">
								          <input name="konyvtarak" list="konyvtarak" id="konyvtar" class="form-control" autocomplete="off" value="<?=$konyvtarak?>">
								          <datalist id="konyvtarak">
								          </datalist>
								        </div>
								    </div>
							    </div>

								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="tagsag_kezdete">Tagság kezdete</label> <input name="tagsag_kezdete" value="<?=$tagsag_kezdete ?>" type="date" class="form-control" id="tagsag_kezdete"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="mettol_ervenyes">Mettől érvényes</label> <input name="mettol_ervenyes" value="<?=$mettol_ervenyes ?>" type="date" class="form-control" id="mettol_ervenyes"> </div></div>
								<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="meddig_ervenyes">Meddig érvényes</label> <input name="meddig_ervenyes" value="<?=$meddig_ervenyes ?>" type="date" class="form-control" id="meddig_ervenyes"> </div></div><br/>

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
			$this->php_strap_cv->datalist('konyvtar', 'konyvtarak', base_url().$first_segment.'/datalist/konyvtarak/nev');
			?>