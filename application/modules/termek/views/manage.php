<h1>Termek kezelése</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."termek/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary">Új terem hozzáadása</button></a>
	</p>
<div class="row-fluid sortable">		
				<div class="box box-default">
					<div class="box-header with-border">
			          <h3 class="box-title"><i class="fa fa-fw fa-book"></i> Termek listája</h3>

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
								  <th>Terem neve</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."termek/create/".$row->terem_id;
							$view_accounts_url = base_url()."termek/view/".$row->terem_id;
						  ?>
							<tr>
								<td data-title="ID"><?= $row->terem_id ?></td>
								<td data-title="Terem neve"><?= $row->terem_neve ?></td>								
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