<?php
class Weboldalak extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _process_delete($update_id)
{
    //attempt to page
    $this->_delete($update_id);
}

function delete($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if($submit=="Cancel")
    {
        redirect('weboldalak/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Page")
    {
        $this->_process_delete($update_id);
    } 

    $flash_msg = "Az oldalt sikeresen törölte.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect('weboldalak/manage');

}

function deleteconf($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }elseif($update_id<3){ //prevent them deleting home and contact us
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Delete Page";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function create()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect('weboldalak/manage');
    }
    
    if($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldal_cim', 'Oldal Cím', 'required|max_length[250]');
        $this->form_validation->set_rules('oldal_kulcsszavak', 'Oldal Kulcsszavak', 'required|max_length[250]');
        $this->form_validation->set_rules('oldal_tartalom', 'Oldal Tartalom', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $data['oldal_url'] = url_title($data['oldal_cim']);

            if(is_numeric($update_id))
            {
                //update the page details

                if($update_id<3){
                    unset($data['oldal_url']);
                }

                $this->_update($update_id, $data);
                $flash_msg = "Az oldalt sikeresen módosítottuk.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('weboldalak/create/'.$update_id);
            }
            else
            {
                //insert a new page
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "Az oldalt sikeresen létrehoztuk.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('weboldalak/create/'.$update_id);
            }
        }
    }

    
    if((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);
    }
    else
    {
        $data = $this->fetch_data_form_post();
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új oldal létrehozása";
    }
    else
    {
        $data['headline'] = "Oldal módosítása";
    }

    $data['oldal_url'] = url_title($data['oldal_cim']);
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['oldal_cim'] = $this->input->post('oldal_cim', TRUE);
    $data['oldal_kulcsszavak'] = $this->input->post('oldal_kulcsszavak', TRUE);
    $data['oldal_leiras'] = $this->input->post('oldal_leiras', TRUE);
    $data['oldal_tartalom'] = $this->input->post('oldal_tartalom', TRUE);
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
        $data['oldal_cim'] = $row->oldal_cim;
        $data['oldal_kulcsszavak'] = $row->oldal_kulcsszavak;
        $data['oldal_leiras'] = $row->oldal_leiras;
        $data['oldal_tartalom'] = $row->oldal_tartalom;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}

/*
function manage()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['flash'] = $this->session->flashdata('item');

    $data['query'] = $this->get('oldal_url');

    //$data['view_module'] = "weboldalak";
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}
*/


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

function _generate_mysql_query($mysql_query, $oldal_szam, $limit){

    if($limit == TRUE){
        $limit = $this->get_limit();
        $offset = $this->get_offset();
        $mysql_query .= " limit ".$offset.", ".$limit;
    }

    return $mysql_query;
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

    $keres = $this->input->get('keres',TRUE);
    $rendez = $this->input->get('rendez',TRUE);

    $order_by = empty($rendez)?'oldal_url':$rendez;
    $where = empty($keres)?"":"WHERE lower(oldal_url) LIKE lower('%$keres%') OR lower(oldal_cim) LIKE lower('%$keres%')";

    $query ="SELECT * FROM biblioteka.weboldalak $where ORDER BY $order_by";
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

function get($order_by)
{
    $this->load->model('mdl_weboldalak');
    $query = $this->mdl_weboldalak->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_weboldalak');
    $query = $this->mdl_weboldalak->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_weboldalak');
    $query = $this->mdl_weboldalak->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_weboldalak');
    $query = $this->mdl_weboldalak->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_weboldalak');
    $this->mdl_weboldalak->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_weboldalak');
    $this->mdl_weboldalak->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_weboldalak');
    $this->mdl_weboldalak->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_weboldalak');
    $count = $this->mdl_weboldalak->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_weboldalak');
    $max_id = $this->mdl_weboldalak->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_weboldalak');
    $query = $this->mdl_weboldalak->_custom_query($mysql_query);
    return $query;
}

}