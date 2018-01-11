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