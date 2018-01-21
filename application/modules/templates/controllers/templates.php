<?php
class Templates extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function login($data){
	if(!isset($data['view_module'])){
		$data['view_module'] = $this->uri->segment(1);
	}

	$this->load->view('login_page', $data);
}

function admin_template($data)
{
    $this->load->module('site_security');
    
    $this->site_security->_is_admin();
    $this->site_security->_get_details_from_user();
    $this->site_security->_check_browser();
    $this->site_security->_click_counter();

    $data['username'] = $this->session->userdata('username');
    $data['firstname'] = $this->session->userdata('firstname');
    $data['lastname'] = $this->session->userdata('lastname');
    $data['reg_date'] = $this->session->userdata('reg_date');

    $profile_img = $this->session->userdata('profile_img');

    if(empty(trim($profile_img)))
    {
        $profile_img = "man-3.png";
    }
    
    $data['profile'] = $profile_img;

    $data['view_module'] = $this->uri->segment(1);
    $this->load->view('admin',$data);
}

function public_template($data)
{
	$this->load->module('site_security');
	$data['customer_id'] = $this->site_security->_get_user_id();
	$this->site_security->_get_details_from_user();
    $this->site_security->_check_browser();
    $this->site_security->_click_counter();

    $user_id = $this->site_security->_get_user_id();
    if(!is_numeric($user_id)){
        $mysql_query = "UPDATE widget_latogatok set latogatok = latogatok+1";
        $this->db->query($mysql_query);
    }

	if(!isset($data['view_module']))
	{
		$data['view_module'] = $this->uri->segment(1);
	}

	$this->load->view('public', $data);
}

}