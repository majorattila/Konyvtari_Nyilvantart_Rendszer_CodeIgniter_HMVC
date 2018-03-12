<?php
class Backup extends MX_Controller 
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

function new_file_name($length)
{
    $this->load->module('site_security');
    echo $this->site_security->generate_random_string($length);
}

private function get_mysqli() { 
    $db = (array)get_instance()->db;
    return mysqli_connect('localhost', $db['username'], $db['password']);
}

function print_last_id()
{
    $sql = "SHOW TABLE STATUS LIKE 'backup'";
    $result= $this->db->query($sql);

    $output = '';

    foreach ($result->result() as $row) {
        $output = $row->Auto_increment;
    }

    echo $output;
}

function ajax_api($action = "insert")
{
    $this->load->database();
    $this->load->module("site_settings");
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    $this->site_security->_get_details_from_user();
    $id = $this->input->post('item', TRUE);
    if(!is_numeric($id) && $action == "delete")
    {
        die('Non-numeric variable!');
    }
    else if($action == "truncate")
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $backup_query = $this->db->query("SELECT * from biblioteka.backup");
        $query = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='biblioteka'");
        foreach ($query->result() as $row) {
            if($row->TABLE_NAME != "ci_sessions" && $row->TABLE_NAME != "site_cookies"){
                $this->db->truncate($row->TABLE_NAME);
            }
        }
        $fields = array('fiok_id' => '2','nev' => 'Központi Könyvtár','foigazgato' => 'Major Attila','iranyitoszam' => '1083','varos' => 'Budapest','kerulet' => 'VIII','cim' => 'Tömő utca 48-54 14.em 156','telefon_szam' => '06205534854','fax_szam' => '','email' => 'attilamajor1997@gmail.com','fiok_megjegyzesek' => '','url' => ''
        );
        $this->db->insert('konyvtarak', $fields);
        $fields = array('id' => '2','fiok_id' => '2','vezeteknev' => 'Major','keresztnev' => 'Attila','felhasznalonev' => 'admin','email' => 'admin@gmail.com','jelszo' => '$2y$11$ZRd4tmoLVfErdG3h4pnaX.RnIwszHaNG4ftWYT8W4maZFW/84460S','olvasojegy' => '102','jogosultsag' => 'admin','statusz' => 'aktiv','reg_datuma' => '2017-12-05','utolso_bejelentkezes' => '1517576397','hirlevel' => '0','profilkep' => 'man-2.png'
        );
        $this->db->insert('felhasznalok', $fields);
        foreach ($backup_query->result() as $row) {
            $fields = array('id' => $row->id,'fiok_id' => $row->fiok_id,'szemelyzet_id' => $row->szemelyzet_id,'datum' => $row->datum,'fajl_nev' => $row->fajl_nev
            );
            $this->db->insert('backup', $fields);
        }
        $fields_array = array(
            array('id' => '1' ,'kategoria_cim' => 'Kezdőlap','kategoria_url' => '','prioritas' => '1'),
            array('id' => '2' ,'kategoria_cim' => 'Rólunk','kategoria_url' => 'rolunk','prioritas' => '2'),
            array('id' => '3' ,'kategoria_cim' => 'Katalógus','kategoria_url' => 'katalogus/kereses','prioritas' => '3'),
            array('id' => '4' ,'kategoria_cim' => 'Hírek','kategoria_url' => 'hirek/kategoriak','prioritas' => '4'),
            array('id' => '5' ,'kategoria_cim' => 'Könyvtárak','kategoria_url' => 'konyvtarak/kirendeltseg','prioritas' => '5')
        );
        foreach ($fields_array as $fields) {
            $this->db->insert('navbar', $fields);
        }
        $fields_array = array(
            array('id' => 1,'oldal_url' => '','oldal_cim' => 'Kezdőlap','oldal_kulcsszavak' => 'KossuthKönyvtár | Kezdőlap','oldal_leiras' => '','oldal_tartalom' => ''),
            array('id' => 2,'oldal_url' => 'rolunk','oldal_cim' => 'rolunk','oldal_kulcsszavak' => 'Rólunk','oldal_leiras' => '','oldal_tartalom' => ''),
            array('id' => 3,'oldal_url' => 'feltetelek','oldal_cim' => 'Feltételek','oldal_kulcsszavak' => 'A könyvtár használat feltételei - KossuthKönyvtár','oldal_leiras' => '','oldal_tartalom' => ''
            )
        );
        foreach ($fields_array as $fields) {
            $this->db->insert('weboldalak', $fields);
        }
        $fields = array("nev" => "oszk", "host" => "tagetes2.oszk.hu", "port" => "1616", "adatbazis" => "ANY");
        $this->db->insert('z3950', $fields);
    }
    else
    {
        //$drive = substr($_SERVER['DOCUMENT_ROOT'],0,1);

        if($action == "insert")
        {        
            $data = $this->fetch_data_form_post();
            if(!empty($data['fajl_nev'])){
                $this->_insert($data);

                $path = $this->site_settings->_get_path();
                $password = ($this->db->password!="")?' -p '.$this->db->password.' ':'';
                $host = ' -h '.explode(':',$this->db->hostname)[0].' ';
                $port = isset(explode(':',$this->db->hostname)[1])?' --port '.explode(':',$this->db->hostname)[1].' ':'';

//die("\"".$path."\" ".$host.$port." -u ".$this->db->username.$password." --events biblioteka > database/".$data['fajl_nev'].".sql");
                exec("\"".$path."\" ".$host.$port." -u ".$this->db->username.$password." --events biblioteka > database/".$data['fajl_nev'].".sql");

            }
        }
        else if($action == "delete" && !is_null($id))
        {
            $query = $this->get_where($id);
            $file_name = "";

            foreach ($query->result() as $row) {
                $file_name = $row->fajl_nev;            
            }
            $path = "database/".$file_name.".sql";
            $this->_delete($id);

            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}

function fetch_data_form_post()
{
    $data['fiok_id'] = $this->input->post('fiok_id', TRUE);
    $data['szemelyzet_id'] = $this->input->post('szemelyzet_id', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    $data['fajl_nev'] = $this->input->post('fajl_nev', TRUE);
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
        $data['szemelyzet_id'] = $row->szemelyzet_id;
        $data['datum'] = $row->datum;
        $data['fajl_nev'] = $row->fajl_nev;
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
        $data['headline'] = "Új mentés";
    }
    else
    {
        $data['headline'] = "Módosítás";
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


    $query ="SELECT * FROM biblioteka.backup ORDER BY datum DESC";
    $data['result_number'] = $this->_custom_query($query)->num_rows();

    $mysql_query = $this->_generate_mysql_query($query, $oldal_szam, $limit);
    $data['query'] = $this->_custom_query($mysql_query);

    $data['fiok_id'] = $this->session->userdata('lib_id');
    $data['szemelyzet_id'] = $this->session->userdata('user_id');

    date_default_timezone_set('Europe/Budapest');
    $data['datum'] = date('Y-m-d H:i:s');

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
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_backup');
    $this->mdl_backup->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $this->mdl_backup->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $this->mdl_backup->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_backup');
    $count = $this->mdl_backup->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_backup');
    $max_id = $this->mdl_backup->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->_custom_query($mysql_query);
    return $query;
}

}