<h1><?=$headline?></h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$link = base_url()."tagok/kolcsonzes_create/$update_id";
?><p style="margin-top: 30px;">
	<a href="<?= base_url().'tagok/create/'.$update_id ?>"><button type="button" class="btn btn-secondary margin">Vissza</button></a>
	<a href="<?php echo $link ?>"><button type="button" class="btn btn-primary margin">Új kölcsönzés hozzáadása</button></a>
	</p>
<div class="row-fluid sortable">		
				<div class="box box-default">
					<div class="box-header with-border">
			          <h3 class="box-title"><i class="fa fa-fw fa-book"></i> Tagok listája</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								<th>Kölcsönző</th>
								<th>Könyv</th>
								<th>Dátum</th>
								<th>Visszahozta</th>
								<th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$first_segment = $this->uri->segment(3);
						  	$edit_url = base_url()."tagok/kolcsonzes_create/".$first_segment.'/'.$row->kolcsonzesek_id;
						  ?>
							<tr>
								<td data-title="Kölcsönző"><?=$row->vezeteknev." ".$row->keresztnev?></td>
								<td data-title="Könyv"><?=$row->cim?></td>
								<td data-title="Dátum"><?=$row->datum?></td>
								<td data-title="Visszahozta"><?=empty($row->visszahozta)?"-":$row->visszahozta?></td>
				
								<td data-title="Műveletek" class="center">
									<a class="btn btn-primary" href="<?= $edit_url ?>">
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
				              <td colspan="9">
				                <?= $pagination ?>
				              </td>
				            </tr>  
				            <tr>
				              <td colspan="9">
				                <p><?= $showing_statement ?></p>
				              </td>
				            </tr>          
				          </tfoot>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->