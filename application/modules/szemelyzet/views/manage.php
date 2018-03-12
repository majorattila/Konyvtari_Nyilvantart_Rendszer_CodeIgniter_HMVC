<h1>Dolgozók kezelése</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."szemelyzet/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary">Új dolgozó hozzáadása</button></a>
	</p>


<?php
$form_location = base_url().'szemelyzet/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>nyelvek/manage/20"><i class="fa fa-fw fa-close"></i></a>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="nyelv">
						<option value="vezeteknev" <?=($rendez=="nyelv")?'selected':''?>>Vezetéknév</option>
						<option value="keresztnev" <?=($rendez=="roviditese")?'selected':''?>>Keresztnév</option>
						<option value="lakcim" <?=($rendez=="roviditese")?'selected':''?>>Lakcím</option>
						<option value="pozicio" <?=($rendez=="roviditese")?'selected':''?>>Pozició</option>
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
			          <h3 class="box-title"><i class="fa fa-fw fa-book"></i> Dolgozók listája</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Vezetéknév</th>
								  <th>Keresztnév</th>
								  <th>Lakcím</th>
								  <th>Pozició</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."szemelyzet/create/".$row->szemelyzet_id;
							$view_accounts_url = base_url()."szemelyzet/view/".$row->szemelyzet_id;
						  ?>
							<tr>
								<td data-title="Vezetéknév"><?= $row->vezeteknev ?></td>
								<td data-title="Keresztnév"><?= $row->keresztnev ?></td>
								<td data-title="Lakcím"><?= $row->lakcim ?></td>	
								<td data-title="Pozíció"><?= $row->pozicio ?></td>				
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