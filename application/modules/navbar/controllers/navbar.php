<?php
class Navbar extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function sort()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin(); 

    $number = $this->input->post('number', TRUE);
    for ($i=1; $i <= $number; $i++) { 
        $update_id = $_POST['order'.$i];
        $data['prioritas'] = $i;
        $this->_update($update_id, $data);
    }
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin(); 

    $szulo_kategoria_id = $this->uri->segment(3);
    if(!is_numeric($szulo_kategoria_id))
    {
        $szulo_kategoria_id = 0;
    }
    $data['sort_this'] = TRUE;
    $data['szulo_kategoria_id'] = $szulo_kategoria_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['query'] = $this->get_where_custom('szulo_kategoria_id', $szulo_kategoria_id);
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}


function _alkategoriak_szama($update_id)
{
    //return the number of sub categories, belonging to THIS category
    $query = $this->get_where_custom('szulo_kategoria_id', $update_id);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function fetch_data_form_post()
{
    $data['kategoria_cim'] = $this->input->post('kategoria_cim', TRUE);
    $data['parent_cat_id'] = $this->input->post('parent_cat_id', TRUE);
    return $data;

}

function fetch_data_from_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach($query->result() as $row)
    {
        $data['kategoria_cim'] = $row->kategoria_cim;
        $data['kategoria_url'] = $row->kategoria_url;
        $data['szulo_kategoria_id'] = $row->szulo_kategoria_id;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}


function _kategoria_cime($update_id)
{
    $data = $this->fetch_data_from_db($update_id);
    $cat_title = $data['kategoria_cim'];
    return $cat_title;
}

function _draw_sortable_list($szulo_kategoria_id)
{
    $mysql_query = "select * from navbar where szulo_kategoria_id = $szulo_kategoria_id order by prioritas";
    $data['query'] = $this->_custom_query($mysql_query);
    $this->load->view('sortable_list', $data);
}

function draw_navbar_to_top()
{
    $mysql_query = "SELECT * FROM biblioteka.navbar";
    $data['username'] = $this->session->userdata('username');
    $profile_img = $this->session->userdata('profile_img');

    if(empty(trim($profile_img)))
    {
        $profile_img = "man-3.png";
    }
    
    $data['profile'] = $profile_img;
    $data['navbar_query'] = $this->_custom_query($mysql_query);
    $this->load->view('navbar',$data);
}

function get($order_by)
{
    $this->load->model('mdl_navbar');
    $query = $this->mdl_navbar->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_navbar');
    $query = $this->mdl_navbar->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_navbar');
    $query = $this->mdl_navbar->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_navbar');
    $query = $this->mdl_navbar->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_navbar');
    $this->mdl_navbar->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_navbar');
    $this->mdl_navbar->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_navbar');
    $this->mdl_navbar->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_navbar');
    $count = $this->mdl_navbar->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_navbar');
    $max_id = $this->mdl_navbar->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_navbar');
    $query = $this->mdl_navbar->_custom_query($mysql_query);
    return $query;
}

}