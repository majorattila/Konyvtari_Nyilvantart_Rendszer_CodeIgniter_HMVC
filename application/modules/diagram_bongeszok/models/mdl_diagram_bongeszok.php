<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_diagram_bongeszok extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "diagram_bongeszok";
    return $table;
}

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

}