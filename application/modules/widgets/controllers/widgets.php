<?php
class Widgets extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_employees()
{
	$data['num_rows'] = $this->get_employees();
    $this->load->view("_draw_employees.php", $data);
}

function _draw_books()
{
	$data['num_rows'] = $this->get_books();
    $this->load->view("_draw_books.php", $data);
}

function _draw_user_registrations()
{
	$data['num_rows'] = $this->get_user_registrations();
    $this->load->view("_draw_user_registrations.php", $data);
}

function _draw_unique_vistors()
{
	$data['num_rows'] = $this->get_unique_vistors();
    $this->load->view("_draw_unique_vistors.php", $data);
}

function _draw_calendar()
{
	$data = [];
    $this->load->view("_draw_calendar.php", $data);
}

function _draw_quick_email()
{
	$data = [];
    $this->load->view("_draw_quick_email.php", $data);
}

function get($order_by)
{
	$this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->get($order_by);
	return $query;
}

function groupby($order_by, $group_by)
{
	$this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->groupby($order_by, $group_by);
	return $query;
}

function get_employees(){
    $this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->get_employees();
	return $query;
}

function get_books(){
	$this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->get_books();
	return $query;
}

function get_user_registrations(){
	$this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->get_user_registrations();
	return $query;
}

function get_unique_vistors(){
	$this->load->model("mdl_widgets");
	$query = $this->mdl_widgets->get_unique_vistors();
	return $query;
}

}