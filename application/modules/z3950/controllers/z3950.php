<?php
class Z3950 extends MX_Controller 
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
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $submit = $this->input->post('submit', TRUE);
    if($submit=="Cancel")
    {
        redirect(base_url().'z3950/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $this->_delete($update_id);
    } 

    $flash_msg = "A z3950t sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'z3950/manage');
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

    $data['headline'] = "Z3950 törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['nev'] = $this->input->post('nev', TRUE);
    $data['host'] = $this->input->post('host', TRUE);
    $data['port'] = $this->input->post('port', TRUE);
    $data['adatbazis'] = $this->input->post('adatbazis', TRUE);
    $data['szintaxis'] = $this->input->post('szintaxis', TRUE);
    $data['felhasznalonev'] = $this->input->post('felhasznalonev', TRUE);
    $data['jelszo'] = $this->input->post('jelszo', TRUE);
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
        $data['nev'] = $row->nev;
        $data['host'] = $row->host;
        $data['port'] = $row->port;
        $data['adatbazis'] = $row->adatbazis;
        $data['szintaxis'] = $row->szintaxis;
        $data['felhasznalonev'] = $row->felhasznalonev;
        $data['jelszo'] = $row->jelszo;
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
        redirect('z3950/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nev', 'Név', 'required');
        $this->form_validation->set_rules('host', 'Host', 'required');
        $this->form_validation->set_rules('port', 'Port', 'required');
        $this->form_validation->set_rules('adatbazis', 'Adatbázis', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $name = $data['fiok_id'];

            if(is_numeric($update_id))
            {
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('z3950/create/'.$update_id);
            }
            else
            {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('z3950/create/'.$update_id);
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
        $data['headline'] = "Új z3950 hozzáadása";
    }
    else
    {
        $data['headline'] = "Z3950 módosítása";
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

    if(!empty($rendez) && in_array($rendez, array('id','nev', 'host', 'port', 'adatbazis', 'szintaxis', 'felhasznalonev', 'jelszo'))){
        $order_by = $rendez;
    }else{
        $order_by = 'id';
    }

    $where = empty($keres)?"":"WHERE lower(id) LIKE lower('%$keres%') OR lower(nev) LIKE lower('%$keres%') OR lower(host) LIKE lower('%$keres%') OR lower(port) LIKE lower('%$keres%') OR lower(adatbazis) LIKE lower('%$keres%') OR lower(szintaxis) LIKE lower('%$keres%') OR lower(felhasznalonev) LIKE lower('%$keres%') OR lower(jelszo) LIKE lower('%$keres%')";

    $query ="SELECT * FROM biblioteka.z3950 $where ORDER BY $order_by";
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
    redirect(base_url().'z3950/manage/20/');
}
*/
function truncate(){
    $this->load->module('site_security');
    $this->load->model('mdl_z3950');

    if($this->site_security->_get_user_type() == "admin"){
        $this->mdl_z3950->_truncate();
    }
}

function get($order_by)
{
    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_z3950');
    $this->mdl_z3950->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_z3950');
    $this->mdl_z3950->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_z3950');
    $this->mdl_z3950->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_z3950');
    $count = $this->mdl_z3950->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_z3950');
    $max_id = $this->mdl_z3950->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_z3950');
    $query = $this->mdl_z3950->_custom_query($mysql_query);
    return $query;
}

function autogen()
{
    $mysql_query = "SHOW COLUMNS FROM z3950";
    $query = $this->_custom_query($mysql_query);
    
    foreach ($query->result() as $row) {
        $column_name = $row->Field;
        //echo $column_name."<br>";
        if($column_name != "id")
        {
            //echo $column_name."<br>";
            echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
        }
    }
    echo "<hr>";
    foreach ($query->result() as $row) {
        $column_name = $row->Field;
        //echo $column_name."<br>";
        if($column_name != "id")
        {
            //echo $column_name."<br>";
            //echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
            echo '$data[\''.$column_name.'\'] = $row->'.$column_name.';<br>';
        }
    }
    echo "<hr>";
    foreach ($query->result() as $row) {
        $column_name = $row->Field;
        //echo $column_name."<br>";
        if($column_name != "id")
        {
$var = '<div class="control-group">
  <label class="control-label" for="typeahead">'.ucfirst($column_name).'</label>
  <div class="controls">
    <input type="text" class="span6" name="'.$column_name.'" value="<?=$'.$column_name.' ?>">
  </div>
</div>';
$var = '<div class="row"><div class="form-group col-xs-3">
<label for="'.$column_name.'">'.ucfirst($column_name).'</label>
<input name="'.$column_name.'" value="<?=$'.$column_name.' ?>" type="text" class="form-control" id="'.$column_name.'">
</div></div>';
echo htmlentities($var);
echo "<br>";
        }
    }

}

}