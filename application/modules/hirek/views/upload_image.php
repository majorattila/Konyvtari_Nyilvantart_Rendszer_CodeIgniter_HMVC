<h1><?=$headline ?></h1>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="halflings-icon white edit"></i><span class="break"></span>Kép feltöltése</h3>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-body">
 
		<?php
			if(isset($error))
			{
				//echo $error;

				foreach($error as $value)
		        {
		            echo $value;

		        }

			}
		?>





<?php
$attributes = array('class' => 'form-horizontal');
echo form_open_multipart('hirek/do_upload/'.$update_id, $attributes);
?>

<h3 style="margin-top: 24px;">Válasszon ki egy fájlt a számítógépéről, majd nyomja meg a "Feltöltés" gombot.</h3>

  <fieldset>

	<div class="control-group" style="height:200px;">
	  <label class="control-label" for="fileInput">File input</label>
	  <div class="controls">
		<input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
	  </div>
	</div>    

	<div class="form-actions">
	  <button type="submit" class="btn btn-success margin">Feltöltés</button>
	  <button type="submit" class="btn btn-secondary margin" name="submit" value="Cancel">Mégse</button>
	</div>
  </fieldset>
</form>   

		</div>
	</div><!--/span-->
</div><!--/row-->