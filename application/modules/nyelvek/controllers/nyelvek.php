<?php
class Nyelvek extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _generate_mysql_query($mysql_query, $oldal_szam, $limit){

    if($limit == TRUE){
        $limit = $this->get_limit();
        $offset = $this->get_offset();
        $mysql_query .= " limit ".$offset.", ".$limit;
    }

    return $mysql_query;
}

function get_offset(){
    $offset = $this->uri->segment(4);
    if(!is_numeric($offset)){
        $offset = 0;
    }
    return $offset;
}

function get_limit(){
    $limit = 20;
    return $limit;
}

function get_target_pagination_base_url(){
    $first_bit = $this->uri->segment(1);
    $second_bit = $this->uri->segment(2);
    $third_bit = $this->uri->segment(3);
    $target_base_url = base_url().$first_bit.'/'.$second_bit.'/'.$third_bit;
    return $target_base_url;
}

function delete($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if($submit=="Cancel")
    {
        redirect(base_url().'nyelvek/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $this->_delete($update_id);
    } 

    $flash_msg = "A nyelvat sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'nyelvek/manage/20');
}

function deleteconf($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Nyelv törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['nyelv'] = $this->input->post('nyelv', TRUE);
    $data['roviditese'] = $this->input->post('roviditese', TRUE);
    return $data;

}

function fetch_data_from_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach($query->result() as $row)
    {
        $data['nyelv'] = $row->nyelv;
        $data['roviditese'] = $row->roviditese;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}

function create()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect(base_url().'nyelvek/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('nyelv', 'Nyelv', 'required');
        $this->form_validation->set_rules('roviditese', 'Rövidítése', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $name = $data['nyelv_id'];

            if(is_numeric($update_id))
            {
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'nyelvek/create/'.$update_id);
            }
            else
            {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'nyelvek/create/'.$update_id);
            }
        }
    }

    
    if((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);
        if($data == "")
        {
            $data = $this->fetch_data_form_post();
        }
    }
    else
    {
        $data = $this->fetch_data_form_post();
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új nyelv hozzáadása";
    }
    else
    {
        $data['headline'] = "Nyelv módosítása";
    }

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}


function manage()
{
    $this->load->module('custom_pagination');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['flash'] = $this->session->flashdata('item');


    $oldal_szam = $this->uri->segment(3);
    if(is_null($oldal_szam) || !is_numeric($oldal_szam))
    {
        $oldal_szam = $this->get_limit();
    }

    $limit = TRUE;

    $keres = $this->site_security->prevent_injection($this->input->get('keres',TRUE));
    $rendez = $this->input->get('rendez',TRUE);

    if(!empty($rendez) && in_array($rendez, array('nyelv','roviditese'))){
        $order_by = $rendez;
    }else{
        $order_by = 'nyelv';
    }

    $where = empty($keres)?"":"WHERE lower(nyelv) LIKE lower('%$keres%') OR lower(roviditese) LIKE lower('%$keres%') ";

    $query ="SELECT * FROM biblioteka.nyelvek $where ORDER BY $order_by";
    $data['result_number'] = $this->_custom_query($query)->num_rows();

    $mysql_query = $this->_generate_mysql_query($query, $oldal_szam, $limit);
    $data['query'] = $this->_custom_query($mysql_query);

    $data['rendez'] = $rendez;
    $data['keres'] = $keres;

    $pagination_data['template'] = 'public_bootstrap';
    $pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
    $pagination_data['total_rows'] = $data['result_number'];
    $pagination_data['offset_segment'] = 4;
    $pagination_data['limit'] = $this->get_limit();

    $data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);

    $pagination_data['offset'] = $this->get_offset();
    $data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);

    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}
/*
function truncate(){
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    
    $this->_truncate();
    redirect(base_url().'nyelvek/manage/20/');
}
*/
function truncate(){
    $this->load->module('site_security');
    $this->load->model('mdl_nyelvek');

    if($this->site_security->_get_user_type() == "admin"){
        $this->mdl_nyelvek->_truncate();
    }
}

function get($order_by)
{
    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_Nyelvek');
    $this->mdl_Nyelvek->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Nyelvek');
    $this->mdl_Nyelvek->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Nyelvek');
    $this->mdl_Nyelvek->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_Nyelvek');
    $count = $this->mdl_Nyelvek->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_Nyelvek');
    $max_id = $this->mdl_Nyelvek->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_Nyelvek');
    $query = $this->mdl_Nyelvek->_custom_query($mysql_query);
    return $query;
}

}