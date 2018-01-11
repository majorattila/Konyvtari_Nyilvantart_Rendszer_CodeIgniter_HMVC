<style>
	.cke_inner.cke_reset{
		margin-left: 1px;
	}
	#cke_1_contents{
		min-height: 500px !important;
	}
	textarea{
	    overflow: hidden;
	    resize: vertical;
	  }
</style>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- CK Editor -->
<script src="<?=base_url()?>bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<h1><?=$headline ?></h1><br/>
<?= validation_errors("<p style='color:red;'>", "</p>");

	if(isset($flash))
	{
		echo $flash;
	}
?>
<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Oldal adatok</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">

					<?php
					$form_location = base_url()."weboldalak/create/".$update_id;
					?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset class="col-sm-12">

						    <div class="row">
							  	<div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3">
							  	  <label for="typeahead">Oldal Cím</label>
							  	  <div class="controls">
							  		<input type="text" class="form-control" name="oldal_cim" value="<?=$oldal_cim ?>">
							  	  </div>
							  	</div>
						    </div>

							<div class="row">
								<div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3">
								  <label>Oldal Kulcsszavak</label>
								  <div class="controls">
									<textarea rows="3" class="form-control" name="oldal_kulcsszavak"><?php 
										echo $oldal_kulcsszavak; 
									?></textarea>
								  </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3">
								  <label>Oldal Leírás</label>
								  <div class="controls">
									<textarea rows="3" class="form-control" name="oldal_leiras"><?php 
										echo $oldal_leiras; 
									?></textarea>
								  </div>
								</div>
							</div>

							<div class="form-group">
							  <label for="textarea2">Oldal Tartalom</label>
							  <div class="controls">
								<textarea class="cleditor" id="editor1" name="oldal_tartalom"><?php 
									echo $oldal_tartalom; 
								?></textarea>
							  </div>
							</div>

							<div class="form-actions">
							  <button type="submit" class="btn metro-button mtr-green mtr-round margin" name="submit" value="Submit">Mentés</button>
							  <button type="submit" class="btn metro-button mtr-orange mtr-round margin" name="submit" value="Cancel">Mégse</button>
							</div>
						  </fieldset class="col-sm-12">
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php
if(is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> További beállítások</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
					<div class="box-body">
		<?php
		if($update_id>2){ ?>
		<a href="<?= base_url() ?>weboldalak/deleteconf/<?= $update_id ?>"><button type="button" class="btn metro-button mtr-red mtr-round margin">Delete Page</button></a>
		<?php
		}
		?>
			<a href="<?= base_url().$oldal_url ?>"><button type="button" class="btn metro-button mtr-steel mtr-round margin">Oldal megtekintése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>