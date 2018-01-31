<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}
	?>

<div class="alert alert-success">A fájlt sikeresen feltöltöttük!</div>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Sikeres feltöltés</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
 

		<ul>
		<?php foreach($upload_data as $item => $value):?>
		<li><?php echo $item; ?>: <?php echo $value;?></li>
		<?php endforeach; ?>
		</ul>

		<p>
		<?php
			$edit_item_url = base_url()."hirek/create/".$update_id;
		?>
			<a href="<?=$edit_item_url;?>"><button type="button" class="btn btn-secondary margin">Visszatérés a hírekhez</button></a>
		</p>

		</div>
	</div><!--/span-->
</div><!--/row-->