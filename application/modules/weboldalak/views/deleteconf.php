<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}
	?>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="halflings-icon white edit"></i><span class="break"></span>Confirm Delete</h3>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
					</div>
		<div class="box-body">
		<p>Are you sure that you want to delete the page?<p>
		


		<?php
		$attributes = array('class' => 'form-horizontal');
		echo form_open_multipart('weboldalak/delete/'.$update_id, $attributes);
		?>

		
		  <fieldset class="col-sm-12">

			<div class="form-group" style="height:200px;">
				<button type="submit" name="submit" value="Yes - Delete Page" class="btn btn-danger" >Yes - Delete Page</button>
				<button type="submit" name="submit" value="Cancel" class="btn">Mégse</button>
			</div>    

		  </fieldset class="col-sm-12">
		</form>  





		</div>
	</div><!--/span-->
</div><!--/row-->