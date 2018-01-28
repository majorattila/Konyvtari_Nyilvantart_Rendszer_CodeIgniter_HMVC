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