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


<?php
$form_location = base_url().'hirek/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>hirek/manage/20"><i class="fa fa-fw fa-close"></i></a>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="publikalas_datuma">
						<option value="publikalas_datuma" <?=($rendez=="publikalas_datuma")?'selected':''?>>publikálás dátuma</option>
						<option value="szerzo" <?=($rendez=="szerzo")?'selected':''?>>szerző</option>
						<option value="oldal_url" <?=($rendez=="oldal_url")?'selected':''?>>oldal url</option>
						<option value="oldal_cim" <?=($rendez=="oldal_cim")?'selected':''?>>oldal cim</option>
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
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Saját hírek</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
						<table class="table table-striped table-bordered">
						  <thead>
							  <tr>
							  	  <th class="col-xs-2">Kép</th>
							  	  <th class="col-xs-1">Publikálás</th>
							      <th class="col-xs-1">Szerző</th>
								  <th class="col-xs-2">URL</th>
								  <th class="col-xs-2">Fejléc</th>
								  <th class="col-xs-3">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $this->load->module('timedate');
						  foreach($query->result() as $row){
						  	$edit_oldal_url = base_url()."hirek/create/".$row->id;
							$view_oldal_url = base_url().'hirek/kategoriak/10/0/'.$row->k_url.'/'.urlencode($row->oldal_url);
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
								<td class="col-xs-2" data-title="Kép"><img src="<?= $thumbnail_path ?>"></td>
								<td class="col-xs-1" data-title="Publikálás dátuma"><?= $publikalas_datuma ?></td>
								<td class="col-xs-1" data-title="Szerző"><?= $row->szerzo ?></td>
								<td class="url col-xs-2" data-title="URL"><?= $view_oldal_url ?></td>
								<td class="col-xs-2" data-title="Fejléc" class="center"><?= $row->oldal_cim ?></td>
								<td class="col-xs-3" data-title="Műveletek">
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