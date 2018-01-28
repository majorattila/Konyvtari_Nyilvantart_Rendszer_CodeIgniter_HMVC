<?php
class Php_strap_cv extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function new_modal(
    $modal_id, 
    $modal_name, 
    $form_id, 
    $fields, 
    $action_btn_name, 
    $ajax_url, 
    $message = null, 
    $custom_script = null, 
    $enable_back = null,
    $modal_message = null,
    $button_text = null,
    $modal_icon = null)
{

/*
EXAMPLE:

$modal_id = "MyModal";
$modal_name = "MyModal";
$form_id = "MyModal";
$fields = array('label' => 'vmi' ,'name' => 'vmi', 'type' => 'text');
$action_btn_name = "edit";
$ajax_url = base_url().$this->uri->segment(1).'/pelda/mostbeszurlak';
$this->load->module('modal');
$this->modal->new_modal($modal_id, $modal_name, $form_id, $fields, $action_btn_name, $ajax_url);

*/

if($message == null)
{
	$message = "Az új elem hozzáadása sikeres volt!";
}

$data = array(
    'modal_id' => $modal_id, 
    'modal_name' => $modal_name, 
    'form_id' => $form_id, 
    'fields' => $fields,
    'action_btn_name' => $action_btn_name,    
    'ajax_url' => $ajax_url,
    'message' => $message,    
    'custom_script' => $custom_script,
    'enable_back' => $enable_back,
    'modal_message' => $modal_message,
    'button_text' => $button_text,
    'modal_icon' => $modal_icon
);

$this->load->view('modal', $data);

}

function datalist($name, $data_name, $url)
{
	$data = array(
	    'name' => $name, 
	    'data_name' => $data_name, 
	    'url' => $url
	);
	$this->load->view('datalist', $data);
}

}