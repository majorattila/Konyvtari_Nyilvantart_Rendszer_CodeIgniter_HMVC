<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_diagram_nezettseg extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "diagram_nezettseg";
    return $table;
}

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function groupby($order_by, $group_by){
    $table = $this->get_table();
	$this->db->select('ev, honap, (SELECT GROUP_CONCAT(latogatok) FROM diagram_nezettseg as d WHERE d.ev = diagram_nezettseg.ev) as data');
	$this->db->group_by($group_by);
	$this->db->order_by($order_by);
	$query = $this->db->get($table,2);
	return $query;
}

function _update_with_double_condition($col1, $id1, $col2, $id2, $data){
    $table = $this->get_table();
    $this->db->where($col1, $id1);
    $this->db->where($col2, $id2);
    $this->db->update($table, $data);
}

function get_with_double_condition($col1, $id1, $col2, $id2){
    $table = $this->get_table();
    $this->db->where($col1, $id1);
    $this->db->where($col2, $id2);
    $query=$this->db->get($table);
    return $query;
}

}