<h1><?=$headline ?></h1><br/>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<?php

	if(isset($flash))
	{
		echo $flash;
	}
	?>

<div class="sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title">Törlés Megerősítése</h3>
				<div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	          </div>
			</div>
		<div class="box-body">
		<h4 style="margin-left:5px;">Biztos benne, hogy eltávolítja a bejegyzést?</h4><br/>
		


		<?php
		$attributes = array('class' => 'form-horizontal');
		echo form_open_multipart('tagok/process_of_delete_book_rental/'.$user_id.'/'.$update_id, $attributes);
		?>

		
		  <fieldset>

			<div class="control-group" style="height:200px;">
				<button type="submit" name="submit" value="Yes - Delete Collection" class="btn btn-danger margin" >Igen - Bejegyzés Eltávolítása</button>
				<button type="submit" name="submit" value="Cancel" class="btn btn-secondary margin">Mégse</button>
			</div>    

		  </fieldset>
		</form>  





		</div>
	</div><!--/span-->
</div><!--/row-->