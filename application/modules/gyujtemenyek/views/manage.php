<h1>Gyűjtemények kezelése</h1>

<?php
$this->load->module('php_strap_cv');
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."gyujtemenyek/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary margin">Új gyűjtemény hozzáadása</button></a>
	
<!--a href="<?=base_url()?>bibliografiak/truncate" class="btn btn-warning margin">Kiürítés</a-->
<button name="truncate" class="btn btn-warning margin">Kiürítés</button>
	</p>


<?php
$form_location = base_url().'gyujtemenyek/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>gyujtemenyek/manage/20"><i class="fa fa-fw fa-close"></i></a>
			<div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          	</div>
		</div>
		<div class="box-body">			
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">					
					<span class="input-group-addon hidden-xs">Keresés</span>
	                <input name="keres" type="text" value="<?=$keres?>" class="form-control" autocomplete="off">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Keresés!</button>
                    </span>
              	</div>
			</div><br class="visible-xs"/><br class="visible-xs"/>
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon hidden-xs">Rendezés</span>
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="gyujtemeny_id">
						<option value="gyujtemeny_id" <?=($rendez=="gyujtemeny_id")?'selected':''?>>gyujtemeny_id</option>
						<option value="leiras" <?=($rendez=="leiras")?'selected':''?>>leírás</option>
		            </select>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat btn_rendez">Rendez!</button>
                    </span>
	        	</div>
			</div>
		</div>
	</div>
</div>
</form>


<div class="row-fluid sortable">		
				<div class="box box-default">
					<div class="box-header with-border">
			          <h3 class="box-title"><i class="fa fa-fw fa-book"></i> Gyűjtemények listája</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							 	  <th>ID</th>
								  <th>Leírás</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."gyujtemenyek/create/".$row->gyujtemeny_id;
							$view_accounts_url = base_url()."gyujtemenyek/view/".$row->gyujtemeny_id;
						  ?>
							<tr>
								<td data-title="ID"><?= $row->gyujtemeny_id ?></td>
								<td data-title="Leírás"><?= $row->leiras ?></td>								
								<td data-title="Műveletek" class="center">
									<a class="btn btn-primary" href="<?= $edit_account_url ?>">
										<i class="fa fa-fw fa-edit"></i>  
									</a>
								</td>
							</tr>
							<?php
							}
							?>
						  </tbody>
						  <tfoot>
				            <tr>
				              <td colspan="3">
				                <?= $pagination ?>
				              </td>
				            </tr>  
				            <tr>
				              <td colspan="3">
				                <p><?= $showing_statement ?></p>
				              </td>
				            </tr>          
				          </tfoot>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->


<?php
$fields = array();
$ajax_url = base_url()."gyujtemenyek/truncate";
$message = "Az elemet sikeresen eltávolította!";
$modal_message = "<h5 style='color: red; display: inline;'>&nbsp;&nbsp;&nbsp;Biztos, hogy szeretné törölni az adatokat?</h5>&nbsp;&nbsp;&nbsp;<img id='loader3' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 20px; display: none;'><br/>";
$custom_script = 
  "\$(\"button[name='truncate']\").click(function(){
    \$('#loader3').hide();
    \$(\"#truncate_Modal\").modal(\"show\");
  });
  \$('#truncate_form').on(\"submit\", function(event){
    \$('#loader3').show();
    \$('tbody').empty();
  });";
  $this->php_strap_cv->new_modal("truncate_Modal", "Adatok törlése", "truncate_form", $fields, "truncate", $ajax_url, $message, $custom_script, "", $modal_message, "Törlés", "glyphicon glyphicon-trash");
?>