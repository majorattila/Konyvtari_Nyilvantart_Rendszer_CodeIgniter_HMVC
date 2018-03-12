<?php
class Gyujtemenyek extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function get_library_id_from_name($name)
{
    $mysql_query = "SELECT fiok_id FROM biblioteka.konyvtarak WHERE nev LIKE ?";
    $query = $this->db->query($mysql_query, array($name));
    $row = $query->row();
    $fiok_id = $row->fiok_id;
    return $fiok_id;
}

function get_library_name_from_id($id)
{
    $mysql_query = "SELECT nev FROM biblioteka.konyvtarak WHERE fiok_id LIKE ?";
    $query = $this->db->query($mysql_query, array($id));
    $row = $query->row();
    $nev = @$row->nev;
    return $nev;
}

function datalist($table_name, $column_name)
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT $column_name FROM biblioteka.$table_name WHERE $column_name like CONCAT('%','".$this->input->get($table_name,TRUE)."','%') ORDER BY $column_name limit 5";

    $result = $this->_custom_query($mysql_query);
    $res = $result->result_array();

    foreach( $res as $parent_row )
    {
        $row = array_values($parent_row);
        echo "<option value='".trim($row[0])."'/></option>\n";
    }
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
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if($submit=="Cancel")
    {
        redirect(base_url().'gyujtemenyek/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $this->_delete($update_id);
    } 

    $flash_msg = "A gyűjteményt sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'gyujtemenyek/manage/20');
}

function deleteconf($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Gyűjtemény törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['fiok_id'] = $this->input->post('fiok_id', TRUE);
    $data['leiras'] = $this->input->post('leiras', TRUE);
    $data['hatralevo_napok'] = $this->input->post('hatralevo_napok', TRUE);
    $data['kesedelmi_dij'] = $this->input->post('kesedelmi_dij', TRUE);
    $data['kolcsonzoi_dij'] = $this->input->post('kolcsonzoi_dij', TRUE);
    $data['nem_masolhato'] = $this->input->post('nem_masolhato', TRUE);
    $data['masolat_dij'] = $this->input->post('masolat_dij', TRUE);$data['leiras'] = $this->input->post('leiras', TRUE);
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
        $data['fiok_id'] = $row->fiok_id;
        $data['leiras'] = $row->leiras;
        $data['hatralevo_napok'] = $row->hatralevo_napok;
        $data['kesedelmi_dij'] = $row->kesedelmi_dij;
        $data['kolcsonzoi_dij'] = $row->kolcsonzoi_dij;
        $data['nem_masolhato'] = $row->nem_masolhato;
        $data['masolat_dij'] = $row->masolat_dij;
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
        redirect('gyujtemenyek/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('fiok_id', 'Fiók (könyvtár)', 'required');
        $this->form_validation->set_rules('leiras', 'Leírás', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $name = $data['fiok_id'];

            if(is_numeric($update_id))
            {
                $data['fiok_id'] = $this->get_library_id_from_name($name);

                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('gyujtemenyek/create/'.$update_id);
            }
            else
            {
                $data['fiok_id'] = $this->get_library_id_from_name($name);

                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('gyujtemenyek/create/'.$update_id);
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
    
    $id = $data['fiok_id'];
    $data['fiok_id'] = $this->get_library_name_from_id($id);

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új gyűjtemény hozzáadása";
    }
    else
    {
        $data['headline'] = "Gyűjtemény módosítása";
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

    if(!empty($rendez) && in_array($rendez, array('gyujtemeny_id', 'leiras'))){
        $order_by = $rendez;
    }else{
        $order_by = 'gyujtemeny_id';
    }

    $where = empty($keres)?"":"WHERE lower(gyujtemeny_id) LIKE lower('%$keres%') OR lower(leiras) LIKE lower('%$keres%') ";

    $query ="SELECT * FROM biblioteka.gyujtemenyek $where ORDER BY $order_by";
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
    redirect(base_url().'gyujtemenyek/manage/20/');
}
*/
function truncate(){
    $this->load->module('site_security');
    $this->load->model('mdl_gyujtemenyek');

    if($this->site_security->_get_user_type() == "admin"){
        $this->mdl_gyujtemenyek->_truncate();
    }
}

function get($order_by)
{
    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_gyujtemenyek');
    $this->mdl_gyujtemenyek->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_gyujtemenyek');
    $this->mdl_gyujtemenyek->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_gyujtemenyek');
    $this->mdl_gyujtemenyek->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_gyujtemenyek');
    $count = $this->mdl_gyujtemenyek->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_gyujtemenyek');
    $max_id = $this->mdl_gyujtemenyek->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_gyujtemenyek');
    $query = $this->mdl_gyujtemenyek->_custom_query($mysql_query);
    return $query;
}

}