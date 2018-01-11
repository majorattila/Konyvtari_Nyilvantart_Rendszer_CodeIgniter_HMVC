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
			<a href="<?= base_url() ?>Nyelvek/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Nyelv Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Nyelv Adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."Nyelvek/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">

							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="nyelv">Nyelv</label> <input name="nyelv" value="<?=$nyelv ?>" type="text" class="form-control" id="nyelv"> </div></div>
							<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="roviditese">Rövidítése</label> <input name="roviditese" value="<?=$roviditese ?>" type="text" class="form-control" id="roviditese"> </div></div><br/>

							<div class="form-actions">
							  <button type="submit" class="btn metro-button mtr-green mtr-round margin" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn metro-button mtr-orange mtr-round margin" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->