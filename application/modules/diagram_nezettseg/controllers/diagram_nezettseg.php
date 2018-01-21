<?php
class Diagram_nezettseg extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function get_with_double_condition($col1, $id1, $col2, $id2)
{
    $this->load->model('mdl_diagram_nezettseg');
    $query = $this->mdl_diagram_nezettseg->get_with_double_condition($col1, $id1, $col2, $id2);
    return $query;
}

function _update_with_double_condition($col1, $id1, $col2, $id2, $data)
{
    $this->load->model('mdl_diagram_nezettseg');
    $this->mdl_diagram_nezettseg->_update_with_double_condition($col1, $id1, $col2, $id2, $data);
}

function _draw_chart()
{
    $this->load->module("site_security");
    $this->site_security->_is_admin();

    $query = $this->groupby('ev', 'ev'); //YEAR(datum), 

    $i = 0;

    $data["_data"] = "";
	foreach($query->result() as $row){		
		if($i==0){
			$data["_data"].="{
		          label               : 'Last Year(".$row->ev.")',
		          fillColor           : 'rgba(210, 214, 222, 1)',
		          strokeColor         : 'rgba(210, 214, 222, 1)',
		          pointColor          : 'rgba(210, 214, 222, 1)',
		          pointStrokeColor    : '#c1c7d1',
		          pointHighlightFill  : '#fff',
		          pointHighlightStroke: 'rgba(220,220,220,1)',
		          data                : [".$row->data."]
		        },";
		}else{
			$data["_data"].="{
		          label               : 'This year(".$row->ev.")',
		          fillColor           : 'rgba(60,141,188,0.9)',
	              strokeColor         : 'rgba(60,141,188,0.8)',
	              pointColor          : '#3b8bba',
	              pointStrokeColor    : 'rgba(60,141,188,1)',
	              pointHighlightFill  : '#fff',
	              pointHighlightStroke: 'rgba(60,141,188,1)',
		          data                : [".$row->data."]
		        },";
		}
	       
	    $i++; 
	}

    $this->load->view("chart.php", $data);
}

function get($order_by)
{
	$this->load->model("mdl_diagram_nezettseg");
	$query = $this->mdl_diagram_nezettseg->get($order_by);
	return $query;
}

function groupby($order_by, $group_by)
{
	$this->load->model("mdl_diagram_nezettseg");
	$query = $this->mdl_diagram_nezettseg->groupby($order_by, $group_by);
	return $query;
}

}