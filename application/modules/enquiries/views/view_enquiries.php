<h1>Your <?=$folder_type?></h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_msg = base_url()."enquiries/create";
?><p style="margin-top: 30px;">
	<a href="<?php echo $create_msg ?>"><button type="button" class="btn btn-primary">Compose Messages</button></a>
	</p>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white envelope"></i><span class="break"></span><?=$folder_type?></h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							 	  <th>&nbsp;</th>
								  <th>Date Sent</th>
								  <th>Sent By</th>
								  <th>Subject</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $this->load->module('store_accounts');
						  $this->load->module('timedate');
						  foreach($query->result() as $row){

						  	$view_url = base_url().'enquiries/view/'.$row->id;

						  	$customer_data['firstname'] = $row->firstname;
						  	$customer_data['lastname'] = $row->lastname;
						  	$customer_data['company'] = $row->company;
						  	$opened = $row->opened;
						  	if($opened==1){
						  		$icon = '<i class="icon-envelope"></i>';
						  	}else{
						  		$icon = '<i class="icon-envelope-alt" style="color:orange;"></i>';
						  	}

						  	$date_sent = $this->timedate->get_nice_date($row->date_created,'full');

						  	if($row->sent_by==0){
						  		$sent_by = "Admin";
						  	}else{
						  		$sent_by = $this->store_accounts->_get_customer_name($row->sent_by, $customer_data);
						  		//$sent_by  = $firstname." ".$lastname;
						  	}
						  	?>
						  	<tr>
							  	<td class="span1"><?=$icon?></td>
								<td><?=$date_sent?></td>
								<td><?=$sent_by?></td>
								<td><?=$row->subject?></td>
								<td  class="span1">
									<a class="btn btn-info" href="<?= $view_url ?>">
										<i class="halflings-icon white edit"></i>  
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