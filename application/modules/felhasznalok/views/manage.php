<h1>Fiókok kezelése</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."felhasznalok/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary margin">Új fiók hozzáadása</button></a>
	</p>

<?php
$form_location = base_url().'felhasznalok/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>bibliografiak/manage/20"><i class="fa fa-fw fa-close"></i></a>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="keresztnév">
		                <option value="keresztnev" <?=($rendez=="keresztnev")?'selected':''?>>keresztnév</option>
		                <option value="vezeteknev" <?=($rendez=="vezeteknev")?'selected':''?>>vezetéknév</option>
		                <option value="felhasznalonev" <?=($rendez=="felhasznalonev")?'selected':''?>>felhasználónév</option>
		                <option value="email" <?=($rendez=="email")?'selected':''?>>email</option>
		                <option value="reg_datuma" <?=($rendez=="reg_datuma")?'selected':''?>>regisztrálás dátuma</option>
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
			          <h3 class="box-title"><i class="fa fa-fw fa-users"></i> Ügyfél fiókok</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							 	  <th>Felhasználónév</th>
								  <th>Keresztnév</th>
								  <th>Vezetéknév</th>
								  <th>Email</th>
								  <th>Regisztrálás dátuma</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."felhasznalok/create/".$row->id;
							$view_accounts_url = base_url()."felhasznalok/view/".$row->id;
						  ?>
							<tr>
								<td data-title="Felhasználónév"><?= $row->felhasznalonev ?></td>
								<td data-title="Keresztnév"><?= $row->keresztnev ?></td>
								<td data-title="Vezetéknév"><?= $row->vezeteknev ?></td>
								<td data-title="Email"><?= $row->email ?></td>
								<td data-title="Regisztrálás dátuma"><?= $row->reg_datuma ?></td>
								<td data-title="Műveletek">
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
				              <td colspan="6">
				                <?= $pagination ?>
				              </td>
				            </tr>  
				            <tr>
				              <td colspan="6">
				                <p><?= $showing_statement ?></p>
				              </td>
				            </tr>          
				          </tfoot>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->