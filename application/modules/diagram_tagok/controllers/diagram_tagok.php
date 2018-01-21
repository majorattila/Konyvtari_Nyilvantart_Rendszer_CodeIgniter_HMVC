<?php
class Top_konyvek_digram extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_chart()
{
    $this->load->module("site_security");
    $this->load->module("site_security");

    $this->site_security->_is_admin();
    $data["data"] = $this->site_security->get();

    $this->load->view("chart.php", $data);
}

}