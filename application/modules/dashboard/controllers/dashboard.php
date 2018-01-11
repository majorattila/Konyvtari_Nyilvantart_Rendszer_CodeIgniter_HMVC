<?php
class Dashboard extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function home()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "home";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}


}