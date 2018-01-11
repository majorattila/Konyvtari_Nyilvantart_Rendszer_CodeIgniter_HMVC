<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_hirek extends CI_Model
{

private $table = "hirek";

function __construct() {
parent::__construct();
}

function set_table($table){
    $this->table = $table;
}

function get_table() {
    $table = $this->table;
    return $table;
}

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_double_condition($col1, $val1, $col2, $val2)
{
    $table = $this->get_table();
    $this->db->where($col1, $val1);    
    $this->db->where($col2, $val2);
    $query=$this->db->get($table);
    return $query;
}

function get_join()
{
    $table = $this->get_table();
    $this->db->join("hirek_kategoria", "hirek_kategoria.k_id = $table.k_id");
    $this->db->order_by('publikalas_datuma desc');
    $query = $this->db->get($table);
    return $query;
}

function get_join_with_limit($limit, $offset)
{
    $table = $this->get_table();
    $this->db->join("hirek_kategoria", "hirek_kategoria.k_id = $table.k_id");    
    $this->db->limit($limit, $offset);
    $this->db->order_by('publikalas_datuma desc');
    $query = $this->db->get($table);
    return $query;
}

function get_join_with_condition($col, $val)
{
    $table = $this->get_table();
    $this->db->join("hirek_kategoria", "hirek_kategoria.k_id = $table.k_id");
    $this->db->like($col, $val, 'none', false);
    $this->db->order_by('publikalas_datuma desc');
    $query = $this->db->get($table);
    return $query;
}

function get_join_with_double_condition($col1, $val1, $col2, $val2)
{
    $table = $this->get_table();
    $this->db->join("hirek_kategoria", "hirek_kategoria.k_id = $table.k_id");
    $this->db->like($col1, $val1, 'none', false);    
    $this->db->like($col2, $val2, 'none', false);
    $this->db->order_by('publikalas_datuma desc');
    $query = $this->db->get($table);
    return $query;
}

function get_where($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom($col, $value) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}

function _insert($data){
    $table = $this->get_table();
    $this->db->insert($table, $data);
}

function _update($id, $data){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

function _delete($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->delete($table);
}

function count_where($column, $value) {
    $table = $this->get_table();
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function count_all() {
    $table = $this->get_table();
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _custom_query($mysql_query) {
    $query = $this->db->query($mysql_query);
    return $query;
}

}