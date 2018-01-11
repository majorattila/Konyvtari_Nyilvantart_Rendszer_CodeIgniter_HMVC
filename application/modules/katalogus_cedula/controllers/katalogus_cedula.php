<?php
class Katalogus_cedula extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function view($leltari_szam)
{
    $data['query'] = $this->get_where($leltari_szam);
    $this->load->view('_draw_katalogus_cedula', $data);
}

function get_where($order_by)
{
    $this->load->model('mdl_katalogus_cedula');
    $query = $this->mdl_katalogus_cedula->get_where($order_by);
    return $query;
}

}