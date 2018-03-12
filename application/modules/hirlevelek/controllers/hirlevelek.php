<?php
class Hirlevelek extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function hibernate()
{
    $this->load->module("site_security");

    $email = $this->site_security->prevent_injection($this->input->post("email", TRUE));
    $stat = $this->site_security->prevent_injection($this->input->post("stat", TRUE));
    
    if(in_array($stat, array('Y', 'N')))
    {
        $this->db->query("UPDATE biblioteka.hirlevelek SET aktiv = ? WHERE email LIKE ?", array($stat, $email));
    }
}

function unsuscribe($code)
{
    $query = $this->db->query("DELETE biblioteka.hirlevelek WHERE md5(email) LIKE ?", array($code));

    if($this->db->affected_rows() == '1'){
        $flash_msg = "Sikeres Leiratkozás!";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
    }

    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "newsletter";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function unsuscribe_from_newsletter()
{
    $this->load->module("mail_service");
    $email = $this->input->post("email", TRUE);
    $subject = "Leiratkozás a Hírlevélről";
    $message="Kedves Leliratkozó,<br/><br/>Ebben az Email-ben szeretnénk meggyőződni róla, hogy tényleg helyes címet adott meg. <br/>Abban az esetben, hogy, ha nem szeretne leliratkozni a KossuthKönyvtár hírlevelére, akkor ne is törődjön evvel az üzenettel. <br/>Viszont, ha valóban szeretne leliratkozni, akkor ezt az alábbi link segítségével tudja megtenni: <a href='".base_url()."hirlevelek/unsuscribe/".md5($email)."'>Megerősít</a>";
    $this->mail_service->send_custom($email, $subject, $message);
}

function settings()
{
    $this->confirm();
}

function confirm($code=null)
{
    $this->load->module("hirek");

    if($code!=null){
        $query = $this->db->query("UPDATE biblioteka.hirlevelek SET aktiv = 'Y' WHERE md5(email) LIKE ?", array($code));

        if($this->db->affected_rows() == '1'){
            $flash_msg = "Sikeres Feliratkozás!";
            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('item', $value);
        }
    }

    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "newsletter";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function subscribe_to_newsletter()
{
    $this->load->module("mail_service");
    $email = $this->input->post("email", TRUE);
    $this->db->query("INSERT INTO hirlevelek (email, aktiv) VALUES (?, ?)", array($email, "N"));
    $subject = "Feliratkozás Hírlevélre";
    $message="Kedves Feliratkozó,<br/><br/>Ebben az Email-ben szeretnénk meggyőződni róla, hogy tényleg helyes címet adott meg. <br/>Abban az esetben, hogy, ha nem szeretne feliratkozni a KossuthKönyvtár hírlevelére, akkor ne is törődjön evvel az üzenettel. <br/>Viszont, ha valóban szeretne feliratkozni, akkor ezt az alábbi link segítségével tudja megtenni: <a href='".base_url()."hirlevelek/confirm/".md5($email)."'>Megerősít</a>";
    $this->mail_service->send_custom($email, $subject, $message);
}

function korlevel()
{   
    $data['headline'] = "Új Hírlevél";
    $data['view_file'] = "korlevel";
    $this->load->module('templates');
    $this->templates->admin_template($data);
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
        redirect(base_url().'hirlevelek/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $this->_delete($update_id);
    } 

    $flash_msg = "A hírlevélt sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'hirlevelek/manage');
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

    $data['headline'] = "Hírlevél törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['email'] = $this->input->post('email', TRUE);
    $data['aktiv'] = $this->input->post('aktiv', TRUE);
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
        $data['email'] = $row->email;
        $data['aktiv'] = $row->aktiv;
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
        redirect('hirlevelek/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('aktiv', 'Aktív', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();

            if(is_numeric($update_id))
            {
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('hirlevelek/create/'.$update_id);
            }
            else
            {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('hirlevelek/create/'.$update_id);
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
        $data['headline'] = "Új feliratkozó hozzáadása";
    }
    else
    {
        $data['headline'] = "Adatok módosítása";
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


    $query ="SELECT * FROM biblioteka.hirlevelek ORDER BY email";
    $data['result_number'] = $this->_custom_query($query)->num_rows();

    $mysql_query = $this->_generate_mysql_query($query, $oldal_szam, $limit);
    $data['query'] = $this->_custom_query($mysql_query);

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
    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_hirlevelek');
    $this->mdl_hirlevelek->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirlevelek');
    $this->mdl_hirlevelek->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirlevelek');
    $this->mdl_hirlevelek->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_hirlevelek');
    $count = $this->mdl_hirlevelek->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_hirlevelek');
    $max_id = $this->mdl_hirlevelek->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_hirlevelek');
    $query = $this->mdl_hirlevelek->_custom_query($mysql_query);
    return $query;
}

}