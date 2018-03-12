<h1>z3950 kezelése</h1>

<?php
$this->load->module('php_strap_cv');
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."z3950/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary">Új z3950 hozzáadása</button></a>
	
<!--a href="<?=base_url()?>bibliografiak/truncate" class="btn btn-warning margin">Kiürítés</a-->
<button name="truncate" class="btn btn-warning margin">Kiürítés</button>
	</p>


<?php
$form_location = base_url().'z3950/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>z3950/manage/20"><i class="fa fa-fw fa-close"></i></a>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="id">
						<option value="id" <?=($rendez=="id")?'selected':''?>>Id</option>						
						<option value="nev" <?=($rendez=="nev")?'selected':''?>>Név</option>
						<option value="host" <?=($rendez=="host")?'selected':''?>>Host</option>
						<option value="port" <?=($rendez=="port")?'selected':''?>>Port</option>
						<option value="adatbazis" <?=($rendez=="adatbazis")?'selected':''?>>Adatbázis</option>
						<option value="szintaxis" <?=($rendez=="szintaxis")?'selected':''?>>Szintaxis</option>
						<option value="felhasznalonev" <?=($rendez=="felhasznalonev")?'selected':''?>>Felhasználonév</option>
						<option value="jelszo" <?=($rendez=="jelszo")?'selected':''?>>Jelszó</option>
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
			          <h3 class="box-title"><i class="fa fa-fw fa-database"></i> z3950 listája</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Id</th>
								  <th>Név</th>
								  <th>Host</th>
								  <th>Port</th>
								  <th>Adatbázis</th>
								  <th>Szintaxis</th>
								  <th>Felhasználonév</th>
								  <th>Jelszó</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."z3950/create/".$row->id;
							$view_accounts_url = base_url()."z3950/view/".$row->id;
						  ?>
							<tr>
								<td data-title="Id"><?= $row->id ?></td>
								<td data-title="Név"><?= $row->nev ?></td>
								<td data-title="Host"><?= $row->host ?></td>
								<td data-title="Port"><?= $row->port ?></td>
								<td data-title="Adatbázis"><?= $row->adatbazis ?></td>
								<td data-title="Szintaxis"><?= $row->szintaxis ?></td>
								<td data-title="Felhasználonév"><?= $row->felhasznalonev ?></td>
								<td data-title="Jelszó"><?= $row->jelszo ?></td>

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
$ajax_url = base_url()."z3950/truncate";
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