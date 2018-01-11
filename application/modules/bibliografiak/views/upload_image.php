<h1><?=$headline ?></h1><br/>
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Borító feltöltés</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
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
echo form_open_multipart('bibliografiak/do_upload/'.$update_id, $attributes);
?>

<p style="margin-top: 24px;">Válasszon ki egy fájlt a számítógépéről, majd nyomja meg a "Feltöltés"-t.</p>

  <fieldset>

	<div class="control-group" style="height:200px;">
	  <label class="control-label" for="fileInput">Fájlbevitel</label>
	  <div class="controls">
		<input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
	  </div>
	</div>    

	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Feltöltés</button>
	  <button type="submit" class="btn" name="submit" value="Cancel">Mégse</button>
	</div>
  </fieldset>
</form>   

		</div>
	</div><!--/span-->
</div><!--/row-->