<?php 
	$form_location = base_url()."bibliografiak/create_z3950/".$update_id;
?>

<h1><?=$headline?></h1><br/>

<?php
	echo validation_errors("<p style='color:red;'>", "</p>");

	if(isset($flash))
	{
		echo $flash;
	}
?>

<div class="box box-danger">
  <div class="box-header">
    <h3>Z39.50 Szerver adatok</h3>
  </div>
  <div class="box-body">
	    <div class="row">
			<div class="col-sm-8">
				<form action="<?=$form_location?>" method="post">
					<div class="form-group">
					  <label for="nev"><h4>Név:</h4></label>
					  <input id="nev" class="form-control" name="nev" type="text" value="<?=$nev?>" maxlength="65">
					</div>
					<div class="form-group">
					  <label for="host"><h4>Host:</h4></label>
					  <input id="host" class="form-control" name="host" type="text" value="<?=$host?>" maxlength="255">
					</div>
					<div class="form-group">
					  <label for="port"><h4>Port:</h4></label>
					  <input id="port" class="form-control" name="port" type="numeric" value="<?=$port?>" min="1" max="9999">
					</div>
					<div class="form-group">
					  <label for="adatbazis"><h4>Adatbázis:</h4></label>
					  <input id="adatbazis" class="form-control" name="adatbazis" type="text" value="<?=$adatbazis?>" maxlength="255">
					</div>
					<div class="form-group">
					  <label for="szintaxis"><h4>Szintaxis:</h4></label>
					  <input id="szintaxis" class="form-control" name="szintaxis" type="text" value="<?=$szintaxis?>" maxlength="255">
					</div>
					<div class="form-group">
					  <label for="felhasznalonev"><h4>Felhasználónév:</h4></label>
					  <input id="felhasznalonev" class="form-control" name="felhasznalonev" type="text" value="<?=$felhasznalonev?>" maxlength="255">
					</div>
					<div class="form-group">
					  <label for="jelszo"><h4>Jelszó:</h4></label>
					  <input id="jelszo" class="form-control" name="jelszo" type="password" value="<?=$jelszo?>" maxlength="255">
					</div><br/>
					<div class="form-actions">
					  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Mentés</button>
					  <button type="submit" class="btn" name="submit" value="Cancel">Mégse</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>