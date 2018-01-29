<h1>Hírek Kezelése</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_oldal_url = base_url()."hirek/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_oldal_url ?>"><button type="button" class="btn btn-primary margin">Új hír létrehozása</button></a>
	</p>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Saját hírek</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							  	  <th>Kép</th>
							  	  <td class="col-xs-1">Publikálás dátuma</td>
							      <td class="col-xs-1">Szerző</td>
								  <th>URL</th>
								  <th>Fejléc</th>
								  <th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $this->load->module('timedate');
						  foreach($query->result() as $row){
						  	$edit_oldal_url = base_url()."hirek/create/".$row->id;
							$view_oldal_url = base_url().'hirek/kategoriak/'.$row->k_url.'/'.urldecode($row->oldal_url);
							$publikalas_datuma = $this->timedate->get_nice_date($row->publikalas_datuma, 'mini');
							$kep = $row->kep;
							if(!empty($kep)){
								$kep = $row->kep;	
							}else{
								$kep = 'noimage.png';
							}
							$thumbnail_name = str_replace('.', '_thumb.', $kep);
							$thumbnail_path = base_url().'hirek_pics/'.$thumbnail_name;
						  ?>
							<tr>
								<td data-title="Kép"><img src="<?= $thumbnail_path ?>"></td>
								<td data-title="Publikálás dátuma"><?= $publikalas_datuma ?></td>
								<td data-title="Szerző"><?= $row->szerzo ?></td>
								<td data-title="URL"><?= $view_oldal_url ?></td>
								<td data-title="Fejléc" class="center"><?= $row->oldal_cim ?></td>
								<td data-title="Műveletek" class="center">
									<a class="btn btn-primary" href="<?= $edit_oldal_url ?>">
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