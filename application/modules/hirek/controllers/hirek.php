<?php
class Hirek extends MX_Controller 
{

function __construct() {
parent::__construct();
/*
$this->db->query("SET character_set_client = utf8");
$this->db->query("SET character_set_connection = utf8");
$this->db->query("SET character_set_database = utf8");
$this->db->query("SET character_set_results = utf8");
$this->db->query("SET character_set_server = utf8");
$this->db->query("SET collation_connection = utf8_hungarian_ci");
$this->db->query("SET collation_database = utf8_hungarian_ci");
$this->db->query("SET collation_server = utf8_hungarian_ci");
*/
}

function show_in_pdf(){
    $title = $this->input->post("title", TRUE);
    $content = $this->input->post("content", TRUE);

    $this->load->module("dompdf");
    $this->dompdf->create_pdf("<h1>".$title."</h1><br/>".urldecode($content), true, $title, $title);
}

function print_max_id(){
    $temp = 0;
    $query = $this->db->query("SELECT max(k_id) as k_id FROM biblioteka.hirek_kategoria");
    foreach ($query->result() as $row) {
        $temp = $row->k_id;
    }
    echo $temp;
}

function insert_with_ajax($param)
{
    if($param == "add_new_cat")
    {
        $k_neve = $this->input->post('k_neve', TRUE);
        $k_url = $this->input->post('k_url', TRUE);
        $k_id = $this->input->post('k_id', TRUE);
        $check = $this->db->query("SELECT * FROM biblioteka.hirek_kategoria WHERE k_id LIKE ?", array($k_id));
        echo $this->db->last_query();
        $check_id = 0;
        if(!($check->num_rows()>0)){
            $this->db->query("INSERT INTO biblioteka.hirek_kategoria (k_neve, k_url) VALUES (?,?)",array($k_neve, $k_url));
            echo $this->db->last_query();
        }else{
            foreach ($check->result() as $row) {
                $check_id = $row->k_id;
            }
            $this->db->query("UPDATE biblioteka.hirek_kategoria SET k_neve = ?, k_url = ? WHERE k_id = ?",array($k_neve, $k_url,$check_id));
            echo $this->db->last_query();
        }
    }else if($param == "del_cat"){
        //die(var_dump($_POST));
        $k_neve = $this->input->post('kategoriak', TRUE);
        $this->db->query("DELETE FROM biblioteka.hirek_kategoria WHERE k_neve LIKE ? or k_neve LIKE ?", array(urldecode($k_neve), urlencode(urldecode($k_neve))));
        echo $this->db->last_query();
    }
}

function kategoriak()
{
/*
    $third_bit = $this->uri->segment(3);
    $third_bit = empty($third_bit)?5:$third_bit;
    $fourth_bit = $this->uri->segment(4);
    $fourth_bit = empty($fourth_bit)?0:$fourth_bit;
*/

    $fifth_bit = $this->uri->segment(5);
    $sixth_bit = $this->uri->segment(6);

    $data = $this->news_and_events_with_pagination($fifth_bit, $sixth_bit);
    
    $data['view_file'] = "index";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function news_and_events_with_pagination($fifth_bit=null, $sixth_bit=null)
{
    $this->load->module('custom_pagination');

    //get the news
    $query = $this->get_join_with_double_condition('k_neve',urldecode($fifth_bit),'oldal_url',urldecode($sixth_bit));
    $num_rows = $query->num_rows();

    //get the categories
    if($num_rows==0 && !empty($fifth_bit) && empty($sixth_bit)){
        $query = $this->get_join_with_condition('k_neve',$fifth_bit);       
    }

    $check_the_category = $this->check_the_category($fifth_bit);

    if($check_the_category==0 && empty($sixth_bit))
    {
        $data['category_list'] = true;
    }

    $check_the_currant_news = $this->check_the_currant_news($sixth_bit);
    $data["type"] = $check_the_currant_news>0;



    $oldal_szam = $this->uri->segment(3);
    $limit = TRUE;

    $this->get_join_with_condition('k_url', empty($fifth_bit)?'%':$fifth_bit);

    $query = $this->db->last_query();
    $data['result_number'] = @$this->_custom_query($query)->num_rows();

    $pagination_data['template'] = 'public_bootstrap';
    $pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
    $pagination_data['total_rows'] = $data['result_number'];
    $pagination_data['offset_segment'] = 4;
    $pagination_data['limit'] = 10;

    $data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);

    $pagination_data['offset'] = $this->get_offset();
    $data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
   

    
    $data['query'] = $query;
    return $data;
}

function _draw_news_and_events_with_pagination()
{
    $data = $this->news_and_events_with_pagination("%");
    $this->load->view("news_with_paginator", $data);
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

function query_cat()
{
    $mysql_query = "SELECT * FROM biblioteka.hirek_kategoria";
    return $this->_custom_query($mysql_query);
}

function _draw_current_news_category($url, $limit = 5, $offset = 0)
{
    $this->load->helper('text');
    $data['query'] = $this->get_join_with_condition_and_limit('k_url', $url, $limit, $offset);
    $this->load->view('detailed_news', $data);
}

function check_the_currant_news($second_segment)
{
    $query = $this->get_where_custom('oldal_url', urldecode($second_segment));
    return $query->num_rows();
}

function check_the_category($url)
{
    $this->set_table('hirek_kategoria');
    $query = $this->get_where_custom('k_url', urldecode($url));

    $this->set_table('hirek');
    return $query->num_rows();
}

function _draw_news_and_events()
{    
    $data['query'] = $this->get_join_with_limit(5,4);
    $this->load->view('feed_hp', $data);
}

function _draw_lib_news_and_events(){
    $nev = $this->uri->segment(3);
    $data['query'] = $this->get_join_with_condition_and_limit("nev",urldecode($nev),5,0);
    $this->load->view('feed_hp', $data);
}

function _draw_about_us(){
    $data['query'] = $this->get_join_with_condition_and_limit("k_neve","rólunk",5,0);
    $this->load->view('feed_hp', $data);
}

function _draw_carousel(){
    $data['query'] = $this->get_join_with_condition_and_limit('kep','%',4,0);
    $this->load->view('carousel', $data);
}

function _draw_feed_hp(){
    $data['query'] = $this->get_join_with_condition_and_limit('kep','%',4,0);
    $this->load->view('feed_hp', $data);
}

function delete_image($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }


    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data = $this->fetch_data_from_db($update_id);

    $kep = $data['kep'];

    $big_pic_path = './hirek_pics/'.$kep;
    $small_kep = str_replace('.', '_thumb.', $kep);
    $small_pic_path = './hirek_pics/'.$small_kep;
    

    if(file_exists($big_pic_path))
    {
        unlink($big_pic_path);
    }
    if(file_exists($small_pic_path))
    {
        unlink($small_pic_path);
    }

    //update the database
    unset($data);
    $data['kep'] = "";
    $this->_update($update_id, $data);

    $flash_msg = "The item image was successfully deleted.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('hirek/create/'.$update_id);
}

function _generate_thumbnail($file_name, $thumbnail_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image'] = './hirek_pics/'.$file_name;
    $config['new_image'] = './hirek_pics/'.$thumbnail_name;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 200;
    $config['height'] = 200;

    $this->load->library('image_lib', $config);

    $this->image_lib->resize();
}

function do_upload($update_id)
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
        redirect('hirek/create/'.$update_id);
    }

    $config['upload_path']  = './hirek_pics/';
    $config['allowed_types']  ='gif|jpg|png';
    $config['max_size']  = 200;
    $config['max_width']  = 2024;
    $config['max_height']  = 1268;
    $config['file_name'] = $this->site_security->generate_random_string(16);

    $this->load->library('upload', $config);

    if(! $this->upload->do_upload('userfile'))
    {      
        $data['error'] = array('error' => $this->upload->display_errors('<p style="color:red;">','</p>'));
        $data['headline'] = "Upload Error";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_module'] = "hirek";
        $data['view_file'] = "upload_image";
        $this->load->module('templates');
        $this->templates->admin_template($data);
    }
    else
    {
        //uppload was successfull
        $data = array('upload_data' => $this->upload->data());
        $upload_data = $data['upload_data'];

        /* TESZT
        foreach ($upload_data as $key => $value) {
            echo "key of $key has value of $value<br>";
        }
        die();
        */

        //raw_name ... file_ext
        $raw_name = $upload_data['raw_name'];
        $file_ext = $upload_data['file_ext'];
        //generate a thumbnail name
        $thumbnail_name = $raw_name."_thumb".$file_ext;


        $file_name = $upload_data['file_name'];
        $this->_generate_thumbnail($file_name, $thumbnail_name);

        //update the data base
        $update_data['kep'] = $file_name;
        $this->_update($update_id, $update_data);

        $data['headline'] = "Sikeres feltöltés";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "upload_success";
        $this->load->module('templates');
        $this->templates->admin_template($data);
    }
}

function upload_image($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin(); // _ ~ this mean this is a private thing.
    
    $data['headline'] = "Kép feltöltése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "upload_image";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function test(){
    $this->load->module('timedate');
    $nowtime = time();
    $date_picker_time = $this->timedate->get_nice_date($nowtime, 'datepicker_us');
    echo $date_picker_time;
    echo "<hr>";
    //convert back ino a unix timestamp
    $timestamp = $this->timedate->make_timestamp_from_datepicker_us($date_picker_time);
    echo $timestamp;

    echo "<hr>";
    $nice_date = $this->timedate->get_nice_date($timestamp, 'cool');
    echo $nice_date;
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
        redirect('hirek/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Hirek Entry")
    {
        $this->_process_delete($update_id);
    } 

    $flash_msg = "The hirek entry was successfully deleted.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect('hirek/manage');

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

    $data['headline'] = "Delete Hirek Entry";

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
    $this->load->module('timedate');

    if($submit=="Cancel"){
        redirect('hirek/manage');
    }
    
    if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('publikalas_datuma', 'Publikálás dátuma', 'required');
        $this->form_validation->set_rules('oldal_cim', 'Cím', 'required|max_length[250]');
        $this->form_validation->set_rules('oldal_tartalom', 'Tartalom', 'required');
        $this->load->module('bibliografiak');
        
        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $data['oldal_url'] = $this->bibliografiak->generate_url_from_utf8($data['oldal_cim']);
            //convert datepicker into a unix timestamp
            $data['publikalas_datuma'] = str_replace('. ', '-', $data['publikalas_datuma']);
            $data['publikalas_datuma'] = $this->timedate->make_timestamp_from_datepicker_hu($data['publikalas_datuma']);

            $mysql_query = "SELECT k_id FROM biblioteka.hirek_kategoria WHERE k_neve LIKE CONCAT('%',?,'%')";
            $query = $this->db->query($mysql_query, array($data['kategoria']));
            $row = $query->row();
            $data['k_id'] = $row->k_id;

            if(empty($data['k_id'])){
                $mysql_query = "INSERT INTO biblioteka.hirek_kategoria SET k_neve = ?";
                $query = $this->db->query($mysql_query, array($this->bibliografiak->generate_url_from_utf8($data['kategoria'])));

                $mysql_query = "SELECT k_id FROM biblioteka.hirek_kategoria WHERE k_neve LIKE CONCAT('%',?,'%')";
                $query = $this->db->query($mysql_query, array($data['kategoria']));
                $row = $query->row();
                $data['k_id'] = $row->k_id;
            }

            unset($data['kategoria']);

            if(is_numeric($update_id))
            {
                //update the page details

                $this->_update($update_id, $data);
                $flash_msg = "A hír adatait sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('hirek/create/'.$update_id);
            }
            else
            {
                $data['fiok_id'] = $this->session->userdata('lib_id');
                
                //insert a page item
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "A hírt sikeresen létrehozta";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('hirek/create/'.$update_id);
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
        $data['kep'] = "";
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Hozzon létre új hírt";
    }
    else
    {
        $data['headline'] = "Hír módosítása";
    }

    if($data['publikalas_datuma']>0){
        //it must be a unix timestapm, so convert to datepicker format
        $data['publikalas_datuma'] = $this->timedate->get_nice_date($data['publikalas_datuma'], 'datepicker_hu');
    }

    $data['query_categories'] = $this->query_cat();
    $data['oldal_url'] = url_title($data['oldal_cim']);
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['kategoria'] = $this->input->post('kategoriak', TRUE);
    $data['oldal_cim'] = $this->input->post('oldal_cim', TRUE);
    $data['oldal_kulcsszavak'] = $this->input->post('oldal_kulcsszavak', TRUE);
    $data['oldal_leiras'] = $this->input->post('oldal_leiras', TRUE);
    $data['oldal_tartalom'] = $this->input->post('oldal_tartalom', TRUE);
    $data['publikalas_datuma'] = $this->input->post('publikalas_datuma', TRUE);
    $data['szerzo'] = $this->input->post('szerzo', TRUE);
    return $data;

}

function fetch_data_from_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $mysql_query = "SELECT * FROM biblioteka.hirek INNER JOIN biblioteka.hirek_kategoria ON(hirek.k_id = hirek_kategoria.k_id) WHERE id = ?";
    $query = $this->db->query($mysql_query, array($update_id));
    foreach($query->result() as $row)
    {
        $data['kategoria'] = $row->k_neve;
        $data['oldal_cim'] = $row->oldal_cim;
        $data['oldal_kulcsszavak'] = $row->oldal_kulcsszavak;
        $data['oldal_leiras'] = $row->oldal_leiras;
        $data['oldal_tartalom'] = $row->oldal_tartalom;
        $data['publikalas_datuma'] = $row->publikalas_datuma;
        $data['szerzo'] = $row->szerzo;
        $data['kep'] = $row->kep;
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

    $data['query'] = $this->get_join();

    //$data['view_module'] = "hirek";
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

    $keres = $this->site_security->prevent_injection($this->input->get('keres',TRUE));
    $rendez = $this->input->get('rendez',TRUE);

    $fiok_id = $this->session->userdata('lib_id');

    if(!empty($rendez) && in_array($rendez, array('publikalas_datuma', 'szerzo', 'oldal_url', 'oldal_cim'))){
        $order_by = $rendez;
    }else{
        $order_by = 'publikalas_datuma desc';
    }
    
    $where = empty($keres)?"":"WHERE lower(publikalas_datuma) LIKE lower('%$keres%') OR lower(szerzo) LIKE lower('%$keres%') OR lower(oldal_url) LIKE lower('%$keres%') OR lower(oldal_cim) LIKE lower('%$keres%') and fiok_id = $fiok_id";

    $query ="SELECT * FROM biblioteka.hirek INNER JOIN hirek_kategoria ON hirek_kategoria.k_id = hirek.k_id $where ORDER BY $order_by";
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
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_hirek');
    $this->mdl_hirek->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirek');
    $this->mdl_hirek->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_hirek');
    $this->mdl_hirek->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_hirek');
    $count = $this->mdl_hirek->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_hirek');
    $max_id = $this->mdl_hirek->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->_custom_query($mysql_query);
    return $query;
}

function get_join_with_double_condition($col1, $val1, $col2, $val2)
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_join_with_double_condition($col1, $val1, $col2, $val2);
    return $query;
}

function get_join_with_condition($col, $val)
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_join_with_condition($col, $val);
    return $query;
}

function get_join_with_condition_and_limit($col, $val, $limit, $offset)
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_join_with_condition_and_limit($col, $val, $limit, $offset);
    return $query;
}

function get_join()
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_join();
    return $query;
}

function get_join_with_limit($limit, $offset)
{
    $this->load->model('mdl_hirek');
    $query = $this->mdl_hirek->get_join_with_limit($limit, $offset);
    return $query;
}

function set_table($table)
{
    $this->load->model('mdl_hirek');
    $this->mdl_hirek->set_table($table);
}

}