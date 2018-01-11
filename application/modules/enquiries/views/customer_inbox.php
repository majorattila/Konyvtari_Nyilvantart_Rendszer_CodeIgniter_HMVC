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

		<table class="table table-striped table-bordered bootstrap-datatable datatable">
		  <thead>
			  <tr style="background-color: #666; color: white;">
			 	  <th>&nbsp;</th>
				  <th>Date Sent</th>
				  <th>Sent By</th>
				  <th>Subject</th>
				  <th>Actions</th>
			  </tr>
		  </thead>   
		  <tbody>
		  <?php
		  $this->load->module('site_settings');
		  $this->load->module('store_accounts');
		  $this->load->module('timedate');
		  $team_name = $this->site_settings->_get_support_team_name();

		  foreach($query->result() as $row){

		  	$view_url = base_url().'enquiries/view/'.$row->id;

		  	$customer_data['firstname'] = $row->firstname;
		  	$customer_data['lastname'] = $row->lastname;
		  	$customer_data['company'] = $row->company;
		  	$opened = $row->opened;
		  	if($opened==1){
		  		$icon = '<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>';
		  	}else{
		  		$icon = '<i style="color: orange" class="glyphicon glyphicon-envelope" aria-hidden="true"></i>';
		  	}

		  	$date_sent = $this->timedate->get_nice_date($row->date_created,'mini');

		  	if($row->sent_by==0){
		  		$sent_by = $team_name;
		  	}else{
		  		$sent_by = $this->store_accounts->_get_customer_name($row->sent_by, $customer_data);
		  		//$sent_by  = $firstname." ".$lastname;
		  	}
		  	?>
		  	<tr>
			  	<td class="col-sm-1"><?=$icon?></td>
				<td><?=$date_sent?></td>
				<td><?=$sent_by?></td>
				<td><?=$row->subject?></td>
				<td class="col-sm-1">
					<a class="btn btn-default" href="<?= $view_url ?>">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View
					</a>
				</td>
			</tr>
		    <?php
			}
			?>
		  </tbody>
	  </table>            
