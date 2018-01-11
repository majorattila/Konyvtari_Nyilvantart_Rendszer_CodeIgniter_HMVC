<h1><?=$headline?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>"); ?>

<?php
if(isset($flash)){
	echo $flash;
}
?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Enquiry Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">

						<table class="table table-striped table-bordered bootstrap-datatable datatable">
 
						  <tbody>
						  <?php
						  $this->load->module('store_accounts');
						  $this->load->module('timedate');
						  foreach($query->result() as $row){

						  	$view_url = base_url().'enquiries/view/'.$row->id;

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
						  		$sent_by = $this->store_accounts->_get_customer_name($row->sent_by);
						  	}

						  	$subject = $row->subject;
						  	$message = $row->message;
						  	?>
							<tr>
								<td style="font-weight: bold;">Date Sent</td><td><?=$date_sent?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;">Sent By</td><td><?=$sent_by?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;">Subject</td><td><?=$subject?></td>
							</tr>
							<tr>
								<td style="font-weight: bold; vertical-align: top;">Message</td>
								<td style="vertical-align: top;"><?=nl2br($message)?></td>
							</tr>
						    <?php
							}
							?>
						  </tbody>
					  </table> 

						<?php
						foreach ($query->result() as $row) {
							
						}
						?>

					</div>
				</div>
			</div>