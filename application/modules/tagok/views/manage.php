<h1>Tagok kezelése</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."tagok/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_account_url ?>"><button type="button" class="btn btn-primary margin">Új tag hozzáadása</button></a>
	</p>

<?php
$form_location = base_url().'tagok/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
		<h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3>
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
					<select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="nev">
						<option value="nev" <?=($rendez=="nev")?'selected':''?>>fiok (könyvtár)</option>
						<option value="olvasojegy" <?=($rendez=="olvasojegy")?'selected':''?>>olvasójegy</option>
						<option value="vezeteknev" <?=($rendez=="vezeteknev")?'selected':''?>>vezetéknév</option>
						<option value="keresztnev" <?=($rendez=="keresztnev")?'selected':''?>>keresztnév</option>
						<option value="lakcim" <?=($rendez=="lakcim")?'selected':''?>>lakcím</option>
						<option value="email" <?=($rendez=="email")?'selected':''?>>email</option>
						<option value="mettol_ervenyes" <?=($rendez=="mettol_ervenyes")?'selected':''?>>mettől érvényes</option>
						<option value="meddig_ervenyes" <?=($rendez=="meddig_ervenyes")?'selected':''?>>meddig érvényes</option>
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
								<th>fiok (könyvtár)</th>
								<th>olvasójegy</th>
								<th>vezetéknév</th>
								<th>keresztnév</th>
								<th>lakcím</th>
								<th>email</th>
								<th>mettől érvényes</th>
								<th>meddig érvényes</th>
								<th class="col-xs-1">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."tagok/create/".$row->id;
							$view_accounts_url = base_url()."tagok/view/".$row->id;
						  ?>
							<tr>
								<td data-title="fiok (könyvtár)"><?=$row->nev?></td>
								<td data-title="olvasójegy"><?=$row->olvasojegy?></td>
								<td data-title="vezetéknév"><?=$row->vezeteknev?></td>
								<td data-title="keresztnév"><?=$row->keresztnev?></td>
								<td data-title="lakcím"><?=$row->lakcim?></td>
								<td data-title="email"><?=$row->email?></td>
								<td data-title="mettől érvényes"><?=$row->mettol_ervenyes?></td>
								<td data-title="meddig érvényes"><?=$row->meddig_ervenyes?></td>
				
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