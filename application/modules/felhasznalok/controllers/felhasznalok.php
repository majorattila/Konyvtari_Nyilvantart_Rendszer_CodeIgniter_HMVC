<?php
class Felhasznalok extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('form_validation');
$this->form_validation->CI =& $this;
}


function fetch_data_from_elofoglalasok_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $mysql_query = "SELECT * FROM biblioteka.elofoglalasok INNER JOIN biblioteka.elofoglalasok_has_tagok ON(biblioteka.elofoglalasok_has_tagok.elofoglalasok_id = biblioteka.elofoglalasok.id) WHERE biblioteka.elofoglalasok_has_tagok.elofoglalasok_id = $update_id";

    $query = $this->_custom_query($mysql_query);
    foreach($query->result() as $row)
    {
        $data['leltari_szam'] = $row->leltari_szam;
        $data['datum'] = $row->datum;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}

function fetch_data_from_elofoglalasok_post()
{
    $data['leltari_szam'] = $this->input->post('leltari_szam', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    return $data;
}

function check_leltari_szam($str)
{
    $str = $this->input->post('leltari_szam', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.bibliografiak WHERE leltari_szam LIKE ?";
    $query = $this->db->query($mysql_query, array($str));
    $num_rows = $query->num_rows();
    
    if ($num_rows == 0)
    {
        $this->form_validation->set_message('check_leltari_szam', 'A {field} mező értéke nem található meg a könyvtárak táblában.');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}

function _elofoglalasok_insert($data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "INSERT INTO biblioteka.elofoglalasok (leltari_szam, datum) VALUES (?,?)";
    $this->db->query($mysql_query ,array($data['leltari_szam'], $data['datum']));
}

function _elofoglalasok_has_tagok_insert($user_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT max(id) as id FROM biblioteka.elofoglalasok";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();

    $elofoglalasok_id = $row->id;
    $felhasznalok_id = $user_id;

    $mysql_query = "INSERT INTO biblioteka.elofoglalasok_has_tagok (felhasznalok_id, elofoglalasok_id) VALUES (?,?)";
    $this->db->query($mysql_query ,array($felhasznalok_id, $elofoglalasok_id));
}

function _elofoglalasok_update($user_id, $update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    
    $mysql_query = "UPDATE biblioteka.elofoglalasok SET leltari_szam = ?, datum = ? WHERE id = ?";
    $this->db->query($mysql_query ,array($data['leltari_szam'], $data['datum'], $update_id));
}

function process_of_delete_reserve($user_id, $update_id)
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
        redirect(base_url().'felhasznalok/kolcsonzes_create/'.$user_id.'/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $mysql_query = "DELETE FROM biblioteka.elofoglalasok_has_tagok WHERE felhasznalok_id = ? AND elofoglalasok_id = ? ";
        $this->db->query($mysql_query, array($user_id, $update_id));
     
        $mysql_query = "DELETE FROM biblioteka.elofoglalasok WHERE id = ?";
        $this->db->query($mysql_query, array($update_id));
    } 

    $flash_msg = "A tagat sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'felhasznalok/elofoglalasok/'.$user_id);
}

function delete_reserve($user_id, $update_id)
{
    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Kölcsönzés törlése";

    $data['user_id'] = $user_id;
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "delete_reserve";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function kolcsonzes_create()
{
    $this->load->module('custom_pagination');
    $this->load->module('site_security');

    $user_id = $this->uri->segment(3);
    $update_id = $this->uri->segment(4);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect(base_url().'felhasznalok/elofoglalasok/'.$user_id);
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('leltari_szam', 'Leltári Szám', 'required|callback_check_leltari_szam');
        $this->form_validation->set_rules('datum', 'Dátum', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_from_elofoglalasok_post();
            $data['datum'] = str_replace(". ", "-", $data['datum']);

            if(is_numeric($update_id))
            {
                //update the item details
                
                $this->_elofoglalasok_update($user_id, $update_id, $data);
                //$this->_elofoglalasok_has_tagok_update($user_id, $update_id, $data);

                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'felhasznalok/kolcsonzes_create/'.$user_id.'/'.$update_id);
            }
            else
            {
                //insert a new item                
                $this->_elofoglalasok_insert($data);
                $this->_elofoglalasok_has_tagok_insert($user_id, $data);

                $mysql_query = "SELECT max(elofoglalasok_id) as max_id FROM biblioteka.elofoglalasok_has_tagok";
                $query = $this->_custom_query($mysql_query);
                $row = $query->row();
                $update_id = $row->max_id;
              
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'felhasznalok/elofoglalasok/'.$user_id);
            }
        }
    }

    if(is_numeric($update_id))
    {
        $data = $this->fetch_data_from_elofoglalasok_db($update_id);
        if($data == "")
        {
            $data = $this->fetch_data_from_elofoglalasok_post();
        }
    }
    else
    {
        $data = $this->fetch_data_from_elofoglalasok_post();
    }

    $data['flash'] = $this->session->flashdata('item');
    $data['headline'] = "Előfoglalások";
    $data['user_id'] = $user_id;
    $data['update_id'] = $update_id;
    $data['view_file'] = "booking";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function elofoglalasok($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $this->load->module('custom_pagination');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $oldal_szam = $this->uri->segment(3);
    if(is_null($oldal_szam) || !is_numeric($oldal_szam))
    {
        $oldal_szam = $this->get_limit();
    }

    $limit = TRUE;

    $query = "SELECT elofoglalasok_has_tagok.elofoglalasok_id, felhasznalok.vezeteknev, felhasznalok.keresztnev, bibliografiak.cim, elofoglalasok.datum FROM biblioteka.elofoglalasok_has_tagok INNER JOIN biblioteka.elofoglalasok ON (biblioteka.elofoglalasok.id = biblioteka.elofoglalasok_has_tagok.elofoglalasok_id) INNER JOIN biblioteka.bibliografiak ON (biblioteka.bibliografiak.leltari_szam = biblioteka.elofoglalasok.leltari_szam) INNER JOIN biblioteka.felhasznalok ON(biblioteka.felhasznalok.id = biblioteka.elofoglalasok_has_tagok.felhasznalok_id) WHERE biblioteka.elofoglalasok_has_tagok.felhasznalok_id = $update_id";
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

    $data['flash'] = $this->session->flashdata('item');
    $data['update_id'] = $update_id;
    $data['headline'] = "Előfoglalások";
    $data['view_file'] = "elofoglalasok";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function datalist($table_name, $column_name)
{
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
        redirect(base_url().'felhasznalok/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Account")
    {
        $this->_delete($update_id);
    } 

    $flash_msg = "A felhasználói fiókot sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'felhasznalok/manage/20');
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

    $data['headline'] = "Fiók törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function _get_customer_name($update_id, $optional_customer_data=NULL)
{
    if(!isset($optional_customer_data)){
        $data = $this->fetch_data_from_db($update_id);
    }else{
        $data['keresztnev'] = $optional_customer_data['keresztnev'];
        $data['vezeteknev'] = $optional_customer_data['vezeteknev'];
        $data['email'] = $optional_customer_data['email'];
    }

    if($data==""){
        $customer_name = "Unknown";
    }else{
        $keresztnev = trim(ucfirst($data['keresztnev']));
        $vezeteknev = trim(ucfirst($data['vezeteknev']));
        $email = trim(ucfirst($data['email']));

        $email_length = strlen($email);
        if($email_length>2){
            $customer_name = $email;
        }else{
            $customer_name = $keresztnev." ".$vezeteknev;
        }
    }
    return $customer_name;
}

function update_pword()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin(); // _ ~ this mean this is a private thing.

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if(!is_numeric($update_id))
    {
        redirect('felhasznalok/manage');
    }
    elseif($submit=='Cancel')
    {
        redirect('felhasznalok/create/'.$update_id);
    }

    if($submit=="Cancel"){
        redirect('felhasznalok/manage');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pword', 'Password', 'required|min_length[7]|max_length[35]');
        $this->form_validation->set_rules('repeat_pword', 'Repeat Password', 'required|matches[pword]');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $pword = $this->input->post('pword', TRUE);
            $this->load->module('site_security');
            $data['jelszo'] = $this->site_security->_hash_string($pword);

            //update the item details
            $this->_update($update_id, $data);
            $flash_msg = "Az elemet sikeresen módosította.";
            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('item', $value);
            redirect('felhasznalok/create/'.$update_id);
        }
    }

    $data['headline'] = "Update Account Password";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    //$data['view_module'] = "felhasznalok";
    $data['view_file'] = "update_pword";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}



function fetch_data_form_post()
{
    $data['vezeteknev'] = $this->input->post('vezeteknev', TRUE);
    $data['keresztnev'] = $this->input->post('keresztnev', TRUE);
    $data['felhasznalonev'] = $this->input->post('felhasznalonev', TRUE);
    $data['email'] = $this->input->post('email', TRUE);
    $data['jelszo'] = $this->input->post('jelszo', TRUE);
    $data['olvasojegy'] = $this->input->post('olvasojegy', TRUE);
    $data['jogosultsag'] = $this->input->post('jogosultsag', TRUE);
    $data['statusz'] = $this->input->post('statusz', TRUE);
    $data['reg_datuma'] = $this->input->post('reg_datuma', TRUE);
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
        $data['vezeteknev'] = $row->vezeteknev;
        $data['keresztnev'] = $row->keresztnev;
        $data['felhasznalonev'] = $row->felhasznalonev;
        $data['email'] = $row->email;
        $data['jelszo'] = $row->jelszo;
        $data['olvasojegy'] = $row->olvasojegy;
        $data['jogosultsag'] = $row->jogosultsag;
        $data['statusz'] = $row->statusz;
        $data['reg_datuma'] = $row->reg_datuma;
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
    $this->site_security->_is_admin(); // _ ~ this mean this is a private thing.

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect('felhasznalok/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'required');
        $this->form_validation->set_rules('keresztnev', 'keresztnév', 'required');

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
                redirect('felhasznalok/create/'.$update_id);
            }
            else
            {
                //insert a new item
                $data['reg_datuma'] = date('Y-m-d');
                $this->_insert($data);
                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('felhasznalok/create/'.$update_id);
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
        $data['headline'] = "Új fiók hozzáadása";
    }
    else
    {
        $data['headline'] = "A fiókadatok frissítése";
    }

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    //$data['view_module'] = "felhasznalok";
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}


function manage()
{
    $this->load->module('custom_pagination');
    $this->load->module('site_security');
    $this->site_security->_is_admin(); // _ ~ this mean this is a private thing.

    $data['flash'] = $this->session->flashdata('item');


    $oldal_szam = $this->uri->segment(3);
    if(is_null($oldal_szam) || !is_numeric($oldal_szam))
    {
        $oldal_szam = $this->get_limit();
    }

    $limit = TRUE;


    $query ="SELECT * FROM biblioteka.felhasznalok ORDER BY vezeteknev";
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
    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get_where($id);
    return $query;
}

function get_user_data($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get_user_data($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_felhasznalok');
    $this->mdl_felhasznalok->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_felhasznalok');
    $this->mdl_felhasznalok->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_felhasznalok');
    $this->mdl_felhasznalok->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_felhasznalok');
    $count = $this->mdl_felhasznalok->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_felhasznalok');
    $max_id = $this->mdl_felhasznalok->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_felhasznalok');
    $query = $this->mdl_felhasznalok->_custom_query($mysql_query);
    return $query;
}


function autogen()
{
    $mysql_query = "SHOW COLUMNS FROM felhasznalok";
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

$var = '<div class="form-group col-xs-3">
<label for="'.$column_name.'">'.ucfirst($column_name).'</label>
<input name="'.$column_name.'" value="<?=$'.$column_name.' ?>" type="text" class="form-control" id="'.$column_name.'">
</div>';

echo htmlentities($var);

echo "<br>";

        }
    }


}

}