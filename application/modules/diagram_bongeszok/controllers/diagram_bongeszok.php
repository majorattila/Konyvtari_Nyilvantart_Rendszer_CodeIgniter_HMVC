<?php
class Diagram_bongeszok extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_chart()
{
    $this->load->module("site_security");
    $this->site_security->_is_admin();

    $query = $this->get('label');

    $data["data"] = "";
	foreach($query->result() as $row){		
		
		$data["data"].='{
				  "value":"'.$row->value.'",				  
				  "color":"'.$row->color.'",			  
				  "highlight":"'.$row->highlight.'",			  
				  "label":"'.$row->label.'"
				},';		
	}

    $this->load->view("chart.php", $data);
}

function get($order_by)
{
	$this->load->model("mdl_diagram_bongeszok");
	$query = $this->mdl_diagram_bongeszok->get($order_by);
	return $query;
}

}