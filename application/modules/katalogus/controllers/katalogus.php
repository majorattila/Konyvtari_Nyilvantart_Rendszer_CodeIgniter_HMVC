<?php
class Katalogus extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function kereses()
{
	//figure out what the item ID
    $item_url = $this->uri->segment(3);
    $this->load->module('bibliografiak');
    $this->bibliografiak->view();
}

}

?>