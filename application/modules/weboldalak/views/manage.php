<h1>Content Management System</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_oldal_url = base_url()."weboldalak/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_oldal_url ?>"><button type="button" class="btn btn-primary margin">Új weblap létrehozása</button></a>
	</p>



<?php
$form_location = base_url().'weboldalak/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>weboldalak/manage/20"><i class="fa fa-fw fa-close"></i></a>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="oldal_url">
						<option value="oldal_url" <?=($rendez=="oldal_url")?'selected':''?>>oldal url</option>
						<option value="oldal_cim" <?=($rendez=="oldal_cim")?'selected':''?>>oldal cím</option>
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
								<td data-title="Oldal URL"><?= $view_oldal_url ?></td>
								<td data-title="Oldal Cím" class="center"><?= $row->oldal_cim ?></td>
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