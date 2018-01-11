<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_katalogus_cedula extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "bibliografiak_view";
    return $table;
}

function get_where($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}

}