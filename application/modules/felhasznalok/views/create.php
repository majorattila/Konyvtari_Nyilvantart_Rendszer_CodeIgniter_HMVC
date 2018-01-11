<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}

if(is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Fiókbeállítások</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body"> 
			<a href="<?= base_url() ?>felhasznalok/update_pword/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-teal mtr-round margin">Jelszó Módosítása</button></a>
			<a href="<?= base_url() ?>felhasznalok/elofoglalasok/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-teal mtr-round margin">Előfoglalás</button></a>
			<a href="<?= base_url() ?>felhasznalok/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Fiók Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Fiók Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."felhasznalok/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">


							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="vezeteknev">Vezetéknév</label> <input name="vezeteknev" value="<?=$vezeteknev ?>" type="text" class="form-control" id="vezeteknev"> </div></div>
							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="keresztnev">Keresztnév</label> <input name="keresztnev" value="<?=$keresztnev ?>" type="text" class="form-control" id="keresztnev"> </div></div>
							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="felhasznalonev">Felhasználónév</label> <input name="felhasznalonev" value="<?=$felhasznalonev ?>" type="text" class="form-control" id="felhasznalonev"> </div></div>
							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="email">Email</label> <input name="email" value="<?=$email ?>" type="text" class="form-control" id="email"> </div></div>
							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="jelszo">Jelszó</label> <input name="jelszo" value="<?=$jelszo ?>" type="text" class="form-control" id="jelszo"> </div></div>
							<div class="row" ><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="olvasojegy">Olvasójegy</label> <input name="olvasojegy" value="<?=$olvasojegy ?>" type="text" class="form-control" id="olvasojegy"> </div></div>

							<div class="row" >
								<div class="form-group col-xs-2">
									<label for="jogosultsag">Jogosultság</label>
									<select name="jogosultsag" class="form-control" id="jogosultsag">
										<option>admin</option>
										<option>user</option>
									</select>
								</div>
							</div>

					        <div class="row" >
					        	<div class="form-group col-xs-2">
					        		<label for="statusz">Státusz</label>
					        		<select name="statusz" class="form-control" id="statusz">
					        			<option>aktiv</option>
					        			<option>inaktiv</option>
					        		</select>
					        	</div>
					        </div><br/>

							<div class="form-actions">
							  <button type="submit" class="btn metro-button mtr-green mtr-round margin" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn metro-button mtr-orange mtr-round margin" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->