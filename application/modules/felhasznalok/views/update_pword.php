<h1><?=$headline ?></h1><br/>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-remove"></i> Jelszó Módosítás</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          	</div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."felhasznalok/update_pword/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-xs-12">

							<div class="row" ><div class="form-group col-xs-4"> <label for="pword">Jelszó</label> <input name="pword" type="text" class="form-control" id="pword"> </div></div>
							<div class="row" ><div class="form-group col-xs-4"> <label for="repeat_pword">Jelszó Ismétlése</label> <input name="repeat_pword" type="text" class="form-control" id="repeat_pword"> </div></div>
							

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->