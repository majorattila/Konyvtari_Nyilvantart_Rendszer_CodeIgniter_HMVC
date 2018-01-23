<?php
class Bongeszo_es_ipcim_lista extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function get($order_by)
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->get_where_custom($col, $value);
    return $query;
}

function get_where_custom_with_triple_condition($col1, $value1, $col2, $value2, $col3, $value3)
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->get_where_custom_with_triple_condition($col1, $value1, $col2, $value2, $col3, $value3);
    return $query;    
}

function _insert($data)
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $this->mdl_bongeszo_es_ipcim_lista->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $this->mdl_bongeszo_es_ipcim_lista->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $this->mdl_bongeszo_es_ipcim_lista->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $count = $this->mdl_bongeszo_es_ipcim_lista->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $max_id = $this->mdl_bongeszo_es_ipcim_lista->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_bongeszo_es_ipcim_lista');
    $query = $this->mdl_bongeszo_es_ipcim_lista->_custom_query($mysql_query);
    return $query;
}

}