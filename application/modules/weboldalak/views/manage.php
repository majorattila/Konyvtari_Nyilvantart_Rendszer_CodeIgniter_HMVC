<h1>Content Management System</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_oldal_url = base_url()."weboldalak/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_oldal_url ?>"><button type="button" class="btn metro-button mtr-teal mtr-round margin">Új weblap létrehozása</button></a>
	</p>

<div class="row-fluid sortable">		
				<div class="box box-default">
					<div class="box-header with-border" data-original-title>
						<h3 class="box-title"><i class="halflings-icon white file"></i><span class="break"></span>Egyéni weboldalak</h3>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Oldal URL</th>
								  <th>Oldal Cím</th>
								  <th class="span2">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_oldal_url = base_url()."weboldalak/create/".$row->id;
							$view_oldal_url = base_url().$row->oldal_url;
						  ?>
							<tr>
								<td><?= $view_oldal_url ?></td>
								<td class="center"><?= $row->oldal_cim ?></td>
								<td class="center">
									<a class="btn btn-info" href="<?= $edit_oldal_url ?>">
										<i class="fa fa-fw fa-edit"></i>  
									</a>
									<a class="btn btn-success" href="<?= $view_oldal_url ?>">
										<i class="fa fa-fw fa-eye"></i>  
									</a>
								</td>
							</tr>
							<?php
							}
							?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->