<?php
class Bibliografiak extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('form_validation');
$this->form_validation->CI =& $this;
}

function download_pdf($param){
    $this->load->module("site_security");

    $title = $this->input->post("title", TRUE);
    $content = $this->input->post("content", TRUE);
    $rnd = $this->site_security->generate_random_string(12);

    $this->load->module("dompdf");
    $this->dompdf->create_pdf("<h1>".$title."</h1><br/>".file_get_contents(base_url()."bibliografiak/details/".$param), false, $rnd, $rnd);
}

function admin_search()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $this->load->module('custom_pagination');
    $this->load->module("gyujtemenyek");
    $this->load->module("konyvtarak");
    $this->load->module("nyelvek");
    $this->load->module("tipusok");
    $this->load->module("termek");

    $data['flash'] = $this->session->flashdata('catalog');

    $oldal_szam = $this->uri->segment(3);
    if(is_null($oldal_szam) || !is_numeric($oldal_szam))
    {
        $oldal_szam = $this->get_limit();
    }

    $limit = TRUE;

    
    $result = $this->check_search_result();
    if(!is_null($result['query'])){
        $query = $result['query'];
        $data = $result;
    }        
    

    if(isset($query)){
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

    }

    $data['tipus_query'] = $this->tipusok->get("leiras");
    $data['nyelv_query'] = $this->nyelvek->get("nyelv");
    $data['gyujtemeny_query'] = $this->gyujtemenyek->get("leiras");

    $data['get_user_type'] = $this->site_security->_get_user_type();

    $data['view_module'] = "bibliografiak";
    $data['view_file'] = "admin_search";
    $this->load->module('templates');

    $this->templates->admin_template($data);
}

function check_search_result(){
    $this->load->module('site_security');
    $query = null;

    $keresokifejezes1_input = $this->site_security->prevent_injection($this->input->get('keresokifejezes1_input', TRUE));
    $keresokifejezes2_input = $this->site_security->prevent_injection($this->input->get('keresokifejezes2_input', TRUE));
    $keresokifejezes3_input = $this->site_security->prevent_injection($this->input->get('keresokifejezes3_input', TRUE));
    $oldal = $this->site_security->prevent_injection($this->input->get('oldal', TRUE));
    $tipus = $this->site_security->prevent_injection($this->input->get('tipus', TRUE));
    $nyelv = $this->site_security->prevent_injection($this->input->get('nyelv', TRUE));
    $gyujtemeny = $this->site_security->prevent_injection($this->input->get('gyujtemeny', TRUE));
    $keresokifejezes1 = $this->site_security->prevent_injection($this->input->get('keresokifejezes1', TRUE));
    $keresokifejezes2 = $this->site_security->prevent_injection($this->input->get('keresokifejezes2', TRUE));
    $keresokifejezes3 = $this->site_security->prevent_injection($this->input->get('keresokifejezes3', TRUE));
    $textlogic0 = $this->site_security->prevent_injection($this->input->get('textlogic0', TRUE));
    $textlogic1 = $this->site_security->prevent_injection($this->input->get('textlogic1', TRUE));

    if(empty($textlogic0)){
        $textlogic0 = "OR";
    }

    if(empty($textlogic1)){
        $textlogic1 = "OR";
    }

    if(empty($keresokifejezes1) || $keresokifejezes1 == "kulcsszo"){
        $keresokifejezes1 = "cim";
    }

    if($keresokifejezes1 == "leiras_tipus") {
        $keresokifejezes1 = "biblioteka.tipusok.leiras";
    }else if($keresokifejezes1 == "leiras_gyujtemeny"){
        $keresokifejezes1 = "biblioteka.gyujtemenyek.leiras";
    }else if($keresokifejezes1 == "szerzo"){
        $keresokifejezes1 = "biblioteka.szerzok.nev";
    }

    if(empty($keresokifejezes2) || $keresokifejezes2 == "kulcsszo"){
        $keresokifejezes2 = "cim";
    }

    if($keresokifejezes2 == "leiras_tipus"){
        $keresokifejezes2 = "biblioteka.tipusok.leiras";
    }else if($keresokifejezes2 == "leiras_gyujtemeny"){
        $keresokifejezes2 = "biblioteka.gyujtemenyek.leiras";
    }else if($keresokifejezes2 == "szerzo"){
        $keresokifejezes2 = "biblioteka.szerzok.nev";
    }

    if(empty($keresokifejezes3) || $keresokifejezes3 == "kulcsszo"){
        $keresokifejezes3 = "cim";
    }

    if($keresokifejezes3 == "leiras_tipus"){
        $keresokifejezes3 = "biblioteka.tipusok.leiras";
    }else if($keresokifejezes3 == "leiras_gyujtemeny"){
        $keresokifejezes3 = "biblioteka.gyujtemenyek.leiras";
    }else if($keresokifejezes3 == "szerzo"){
        $keresokifejezes3 = "biblioteka.szerzok.nev";
    }

    $data['oldal'] = $oldal;
    $data['tipus'] = $tipus;
    $data['nyelv'] = $nyelv;
    $data['gyujtemeny'] = $gyujtemeny;
    $data['keresokifejezes1'] = $keresokifejezes1;
    $data['keresokifejezes2'] = $keresokifejezes2;
    $data['keresokifejezes3'] = $keresokifejezes3;
    $data['keresokifejezes1_input'] = $keresokifejezes1_input;
    $data['keresokifejezes2_input'] = $keresokifejezes2_input;
    $data['keresokifejezes3_input'] = $keresokifejezes3_input;
    $data['textlogic0'] = $textlogic0;
    $data['textlogic1'] = $textlogic1;

    if(
        !empty($keresokifejezes1_input) && strlen($keresokifejezes1_input) >= 3 ||
        !empty($keresokifejezes2_input) && strlen($keresokifejezes2_input) >= 3 ||
        !empty($keresokifejezes3_input) && strlen($keresokifejezes3_input) >= 3
    )
    {

        $query = "SELECT bibliografiak.id, szerzok.nev, bibliografiak.cim, bibliografiak.targyszavak, kiadok.kiado, nyilvantartas.rszj, tipusok.leiras as leiras_tipus, nyilvantartas.url, bibliografiak.isbn, bibliografiak.gyari_szam, gyujtemenyek.leiras as leiras_gyujtemeny, bibliografiak.megjelenes, bibliografiak.eto FROM biblioteka.bibliografiak INNER JOIN biblioteka.tipusok USING(tipus_id) INNER JOIN biblioteka.szerzok USING(szerzo_id) INNER JOIN biblioteka.gyujtemenyek USING(gyujtemeny_id) INNER JOIN biblioteka.kiadok USING(kiado_id) INNER JOIN biblioteka.nyilvantartas USING(nyilvantartas_id) WHERE (lower('tipusok.leiras') LIKE lower('$tipus') OR lower('nyelvek.nyelv') LIKE lower('$nyelv') OR lower('gyujtemenyek.leiras') LIKE lower('$gyujtemeny')) or ($keresokifejezes1 LIKE lower(CONCAT('%','$keresokifejezes1_input','%')) $textlogic0 $keresokifejezes2 LIKE lower(CONCAT('%','$keresokifejezes2_input','%')) $textlogic1 $keresokifejezes3 LIKE lower(CONCAT('%','$keresokifejezes3_input','%'))) ORDER BY cim";
    }
    //die($query);

    $data['query'] = $query;

    return $data;
}

function _draw_search_toolkit(){
    $this->load->view("search");
}

function hosszabbit(){

    $this->load->module('custom_pagination');
    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $update_id = $this->uri->segment(3);

    if(!empty($update_id) && !is_numeric($update_id)){
        $this->site_security->not_allowed();
    }else if(!empty($update_id) && is_numeric($update_id)){
        $mysql_query = "UPDATE biblioteka.kolcsonzesek SET hosszabbit = IF(hosszabbit<3, hosszabbit + 1, hosszabbit), datum = IF(hosszabbit<3, ?, datum) WHERE leltari_szam = ?";
        $this->db->query($mysql_query, array($update_id, date('Y-m-d')));

        $flash_msg = "A bibliográfiát sikeresen meghosszabbította!";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
        
        redirect(base_url().'bibliografiak/hosszabbit');
    }

    $lib_card = $this->session->userdata('library_card');

    if(is_null($lib_card))
    {
        $lib_card = 'NULL';
    }


    $oldal_szam = $this->uri->segment(3);
    $limit = TRUE;

    $query = "
        SELECT
          biblioteka.bibliografiak.leltari_szam,
          biblioteka.szerzok.nev as szerzo,
          biblioteka.bibliografiak.cim,
          biblioteka.kolcsonzesek.datum,
          biblioteka.kolcsonzesek.hosszabbit,
          biblioteka.gyujtemenyek.hatralevo_napok
        FROM
          biblioteka.bibliografiak
          INNER JOIN biblioteka.kolcsonzesek ON biblioteka.bibliografiak.leltari_szam = biblioteka.kolcsonzesek.leltari_szam
          INNER JOIN biblioteka.kolcsonzesek_has_tagok ON biblioteka.kolcsonzesek_has_tagok.kolcsonzesek_id =
            biblioteka.kolcsonzesek.id
          INNER JOIN biblioteka.tagok ON biblioteka.tagok.id = biblioteka.kolcsonzesek_has_tagok.tagok_id
          INNER JOIN biblioteka.tagok_adatai ON biblioteka.tagok.tagok_adatai_id = biblioteka.tagok_adatai.id
          INNER JOIN biblioteka.szerzok ON biblioteka.bibliografiak.szerzo_id = biblioteka.szerzok.szerzo_id
          INNER JOIN biblioteka.gyujtemenyek ON biblioteka.bibliografiak.gyujtemeny_id = biblioteka.gyujtemenyek.gyujtemeny_id
          INNER JOIN biblioteka.felhasznalok ON biblioteka.tagok_adatai.olvasojegy = biblioteka.felhasznalok.olvasojegy
          WHERE biblioteka.tagok_adatai.olvasojegy = $lib_card
    ";


    $data['result_number'] = @$this->_custom_query($query)->num_rows();

    $mysql_query = $this->_generate_mysql_query($query, $oldal_szam, $limit);
    $data['query'] = $this->_custom_query($mysql_query);


    $pagination_data['template'] = 'public_bootstrap';
    $pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
    $pagination_data['total_rows'] = $data['result_number'];
    $pagination_data['offset_segment'] = 4;
    $pagination_data['limit'] = $this->get_limit();

    $data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);

    $pagination_data['offset'] = $this->get_offset();;
    $data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
   
    $data['headline'] = "Hosszabbítás";
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "hosszabbit";
    $this->load->module('templates');
    $this->templates->public_template($data);

}

function get_elofoglalasok_to_datatable(){

    $this->load->module('site_security');
    $user_id = $this->site_security->_get_user_id();
    $mysql_query = 'SELECT bibliografiak.leltari_szam, elofoglalasok.id, elofoglalasok.datum, szerzok.nev, bibliografiak.cim FROM biblioteka.elofoglalasok INNER JOIN biblioteka.elofoglalasok_has_tagok ON (elofoglalasok_has_tagok.elofoglalasok_id = elofoglalasok.id) INNER JOIN biblioteka.bibliografiak ON (bibliografiak.leltari_szam = elofoglalasok.leltari_szam) INNER JOIN biblioteka.szerzok ON (bibliografiak.szerzo_id = szerzok.szerzo_id) WHERE felhasznalok_id = ? group by elofoglalasok.id';

    $query = $this->db->query($mysql_query, array($user_id));

    $tabla = "";

    $id = 0;
    foreach($query->result() as $row){        

        $var = $row->id;
        $actions = '<input type=\"checkbox\" class=\"editor-active\" name=\"eltavolit('.$id.')\" value=\"'.$var.'\">';
        $reszletek = "<a onClick=\\\"newwindow = window.open('".base_url()."bibliografiak/details/".$row->leltari_szam."', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=600, top=10, left=10');\\\" href='javascript:void(0);'>Részletek</a>";
        
        $tabla.='{
                  "actions":"'.trim($actions).'",
                  "datum":"'.substr(trim($row->datum),0,85).'",
                  "nev":"'.substr(trim($row->nev),0,85).'",
                  "cim":"'.substr(trim($row->cim),0,85).'",
                  "reszletek":"'.$reszletek.'"
                },';    
        $id++;    
    }   

    //eliminamos la coma que sobra
    $tabla = substr($tabla,0, strlen($tabla) - 1);

    echo '{"data":['.$tabla.']}';   
}

function elofoglalas_torlese()
{
    $this->load->module('site_security');
    $checked_elements = $_POST;

    foreach($checked_elements as $element) {    
        if(is_numeric($element)){
            
            $get_elofoglalasok_id = $this->db->insert_id();
            $mysql_query = "DELETE FROM biblioteka.elofoglalasok_has_tagok WHERE elofoglalasok_id = ? AND felhasznalok_id = ?";
            $this->db->query($mysql_query, array($element, $this->site_security->_get_user_id()));

            $mysql_query = "DELETE FROM biblioteka.elofoglalasok WHERE id = ?";
            $this->db->query($mysql_query, array($element));
        }
    }
}

function elofoglalas()
{
    $this->load->module('site_security');
    $checked_elements = $_POST;

    $user_id = $this->site_security->_get_user_id();

    foreach($checked_elements as $element) { 
        if(is_numeric($element)){

            $mysql_query = "SELECT leltari_szam FROM elofoglalasok INNER JOIN elofoglalasok_has_tagok ON(elofoglalasok.id = elofoglalasok_has_tagok.elofoglalasok_id) WHERE leltari_szam = ? AND felhasznalok_id = ?";
            $query = $this->db->query($mysql_query, array($element, $user_id));
        }
    }

    foreach(array_unique($checked_elements) as $element) { 
        if(is_numeric($element)){

            if(!is_numeric($query) && $query->num_rows()==0){

                $mysql_query = "INSERT INTO biblioteka.elofoglalasok (leltari_szam, datum) values (?, ?)";
                $this->db->query($mysql_query, array($element, date('Y-m-d')));

                echo($this->db->last_query());

                $get_elofoglalasok_id = $this->db->insert_id();
                
                $mysql_query = "INSERT INTO biblioteka.elofoglalasok_has_tagok (elofoglalasok_id, felhasznalok_id) values (?,?)";
                $this->db->query($mysql_query, array($get_elofoglalasok_id, $user_id));

                echo($this->db->last_query());
            }
        }
    }
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

    $picture = $data['picture'];

    $big_pic_path = './biblio_pics/'.$picture;
    $small_picture = str_replace('.', '_thumb.', $picture);
    $small_pic_path = './biblio_pics/'.$small_picture;
    

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
    $data['picture'] = "";
    $this->_update($update_id, $data);

    $flash_msg = "The item image was successfully deleted.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('blog/create/'.$update_id);
}

function _generate_thumbnail($file_name, $thumbnail_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image'] = './biblio_pics/'.$file_name;
    $config['new_image'] = './biblio_pics/'.$thumbnail_name;
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
        redirect(base_url()."bibliografiak/create/".$update_id);
    }

    $config['upload_path']  = './biblio_pics/';
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
        $data['view_module'] = "blog";
        $data['view_file'] = "upload_image";
        $this->load->module('templates');
        $this->templates->admin_template($data);
    }
    else
    {
        //uppload was successfull
        $data = array('upload_data' => $this->upload->data());
        $upload_data = $data['upload_data'];

        //raw_name ... file_ext
        $raw_name = $upload_data['raw_name'];
        $file_ext = $upload_data['file_ext'];
        //generate a thumbnail name
        $thumbnail_name = $raw_name."_thumb".$file_ext;


        $file_name = $upload_data['file_name'];
        $this->_generate_thumbnail($file_name, $thumbnail_name);

        //update the data base
        $update_data['borito'] = $file_name;
        $this->_update($update_id, $update_data);

        $data['headline'] = "Sikeres Feltöltés";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "upload_success";
        $this->load->module('templates');
        $this->templates->admin_template($data);
    }
}

function borito_feltoltes($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Borítókép feltöltése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "upload_image";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function try_out_some_crazy_things()
{
    $this->load->model('mdl_yaz');
    $this->mdl_yaz->fetch_data_from_library("lx2.loc.gov:210/LCDB", "unimarc");
}

function fetch_z3950_data_from_post()
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

function fetch_z3950_data_from_db($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $mysql_query = "SELECT * FROM biblioteka.z3950 WHERE id = $update_id";
    $query = $this->_custom_query($mysql_query);

    foreach ($query->result() as $row) {
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

function gyors_honosito()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $this->load->model('mdl_yaz');

    $cim = $this->input->get('cim',TRUE);
    $szerver = $this->input->get('szerver',TRUE);
    //$formatum = $this->input->get('format',TRUE);
    $ccl_query = "title = $cim";
    //$szerver = "oszk";

    $mysql_query = "SELECT * FROM biblioteka.z3950 WHERE nev LIKE ? LIMIT 1";
    $server_data = $this->db->query($mysql_query, array($szerver));
    //echo $this->db->last_query();

    //die(var_dump($server_data->result()));

    $row = $server_data->row();
    $host = $row->host;
    $port = $row->port;
    $szerver = $row->adatbazis;
    $formatum = "unimarc";

    $arr = array();
    array_push($arr, array());

    $parsedResult = $this->mdl_yaz->fetch_data_from_library($host.":".$port."/".$szerver, $formatum, $ccl_query);
    //die($parsedResult);


    if(isset($parsedResult)){

    foreach($parsedResult as $row){

    if(!empty($row) && !empty($row['titel'])){ 

    //language,isbn,issn,author,titel,edition,pub_date,extent,series,editor
      
      
    array_push($arr, array(
        "cim" => $this->json_string_encode((isset($row['titel'])?iconv(mb_detect_encoding($row['titel'], mb_detect_order(), true), "UTF-8", $row['titel']):'')),
        "szerzok" => $this->json_string_encode((isset($row['author'])?iconv(mb_detect_encoding($row['author'], mb_detect_order(), true), "UTF-8", $row['author']):'')),
        "megjelenes" => $this->json_string_encode((isset($row['pub_date'])?iconv(mb_detect_encoding($row['pub_date'], mb_detect_order(), true), "UTF-8", $row['pub_date']):'')), 
        "terjedelem" => $this->json_string_encode((isset($row['extent'])?iconv(mb_detect_encoding($row['extent'], mb_detect_order(), true), "UTF-8",$row['extent']):'')), 
        "datum" => date('Y. m. d'), 

        "dok_stat" => 'n',

        "beszerz_mod" => 'v', 

        "kotes" => $this->json_string_encode((isset($row['quality_note'])?iconv(mb_detect_encoding($row['quality_note'], mb_detect_order(), true), "UTF-8",$row['quality_note']):'')), 

        "targyszavak" => $this->json_string_encode((isset($row['author'])?iconv(mb_detect_encoding($row['author'], mb_detect_order(), true), "UTF-8", $row['author']):'')).';'.$this->json_string_encode((isset($row['titel'])?iconv(mb_detect_encoding($row['titel'], mb_detect_order(), true), "UTF-8", $row['titel']):'')),

        "peldany_megj" => $this->json_string_encode((isset($row['diss_note'])?iconv(mb_detect_encoding($row['diss_note'], mb_detect_order(), true), "UTF-8",$row['diss_note']):'')), 
        "feltuntetett_ar" => $this->json_string_encode((isset($row['trade_price'])?iconv(mb_detect_encoding($row['trade_price'], mb_detect_order(), true), "UTF-8",$row['trade_price']):'')), 
        "isbn" => $this->json_string_encode((isset($row['isbn'])?iconv(mb_detect_encoding($row['isbn'], mb_detect_order(), true), "UTF-8", $row['isbn']):'')),
        "nyelvek" => $this->json_string_encode((isset($row['language'])?iconv(mb_detect_encoding($row['language'], mb_detect_order(), true), "UTF-8", $row['language']):'')),
        "nemzetkozi_azonosito" => $this->json_string_encode((isset($row['national_no'])?iconv(mb_detect_encoding($row['national_no'], mb_detect_order(), true), "UTF-8", $row['national_no']):'')),
        "gyujtemenyek" => $this->json_string_encode((isset($row['genre'])?iconv(mb_detect_encoding($row['genre'], mb_detect_order(), true), "UTF-8", $row['genre']):'')),
        "eto" => $this->json_string_encode((isset($row['eto'])?iconv(mb_detect_encoding($row['eto'], mb_detect_order(), true), "UTF-8", $row['eto']):'')),
        "kiadok" => $this->json_string_encode((isset($row['publisher'])?iconv(mb_detect_encoding($row['publisher'], mb_detect_order(), true), "UTF-8", $row['publisher']):'')))
); 

    }
    }
    }
    
    $konyv_adatok = str_replace('"','\'',json_encode($arr));    

    echo $konyv_adatok;

    //var_dump($arr);
    
}

function json_string_encode( $str ) {
   $this->load->module('site_security');
   $this->site_security->_is_admin();

   $from = array('\'');    // Array of values to replace
   $to = array('\\"');    // Array of values to replace with

   // Replace the string passed
   return str_replace( $from, $to, $str );
}

function check_honositas()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    if (isset($_COOKIE['honositas_check']) && !empty($_COOKIE['honositas_check']))
    {
        echo $_COOKIE['honositas_check'];
        unset($_COOKIE['honositas_check']);
        setcookie('honositas_check', '');
    }
}

function honositas_kereso()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $this->load->model('mdl_yaz');

    $submit = $this->input->post('submit', TRUE);
    if($submit == "Submit")
    {
        $szempont1 = $this->input->post('szempont1', TRUE);
        $kriterium1 = $this->input->post('kriterium1', TRUE);
        $csonkolas1 = $this->input->post('csonkolas1', TRUE);
        $kapcsolat1 = $this->input->post('kapcsolat1', TRUE);
        $szempont2 = $this->input->post('szempont2', TRUE);
        $kriterium2 = $this->input->post('kriterium2', TRUE);
        $csonkolas2 = $this->input->post('csonkolas2', TRUE);
        $kapcsolat2 = $this->input->post('kapcsolat2', TRUE);
        $szempont3 = $this->input->post('szempont3', TRUE);
        $kriterium3 = $this->input->post('kriterium3', TRUE);
        $csonkolas3 = $this->input->post('csonkolas3', TRUE);
        $kapcsolat3 = $this->input->post('kapcsolat3', TRUE);
        $szempont4 = $this->input->post('szempont4', TRUE);
        $kriterium4 = $this->input->post('kriterium4', TRUE);
        $csonkolas4 = $this->input->post('csonkolas4', TRUE);
        $kapcsolat4 = $this->input->post('kapcsolat4', TRUE);
        $szempont5 = $this->input->post('szempont5', TRUE);
        $kriterium5 = $this->input->post('kriterium5', TRUE);
        $csonkolas5 = $this->input->post('csonkolas5', TRUE);
        $formatum = $this->input->post('formatum', TRUE);
        $media = $this->input->post('media', TRUE);
        $szerver = $this->input->post('szerver', TRUE);

        $ccl_query = "";

        if(!empty($kriterium1))
        {
            $szempont1 = $this->convert_simple_value_to_specified_ccl_value($szempont1);
            $ccl_query .= "($szempont1 = $kriterium1)";
        }

        if(!empty($kriterium2))
        {
            $szempont2 = $this->convert_simple_value_to_specified_ccl_value($szempont2);
            if(!empty($kriterium1))
            {
                switch($kapcsolat1)
                {
                    case "es": $ccl_query.= " and "; break;
                    case "vagy": $ccl_query.= " or "; break;
                    case "esnem": $ccl_query.= " not "; break;
                }
            }
            $ccl_query .= "($szempont2 = $kriterium2)";
        }

        if(!empty($kriterium3))
        {
            $szempont3 = $this->convert_simple_value_to_specified_ccl_value($szempont3);
            if(!empty($kriterium2))
            {
                switch($kapcsolat2)
                {
                    case "es": $ccl_query.= " and "; break;
                    case "vagy": $ccl_query.= " or "; break;
                    case "esnem": $ccl_query.= " not "; break;
                }
            }       
            $ccl_query .= "($szempont3 = $kriterium3)";
        }

        if(!empty($kriterium4))
        {
            $szempont4 = $this->convert_simple_value_to_specified_ccl_value($szempont4);
            if(!empty($kriterium3))
            {
                switch($kapcsolat3)
                {
                    case "es": $ccl_query.= " and "; break;
                    case "vagy": $ccl_query.= " or "; break;
                    case "esnem": $ccl_query.= " not "; break;
                }
            }
            $ccl_query .= "($szempont4 = $kriterium4)";
        }

        if(!empty($kriterium5))
        {
            $szempont5 = $this->convert_simple_value_to_specified_ccl_value($szempont5);
            if(!empty($kriterium4))
            {
                switch($kapcsolat4)
                {
                    case "es": $ccl_query.= " and "; break;
                    case "vagy": $ccl_query.= " or "; break;
                    case "esnem": $ccl_query.= " not "; break;
                }
            }
            $ccl_query .= "($szempont5 = $kriterium5)";
        }

        $mysql_query = "SELECT * FROM biblioteka.z3950 WHERE nev LIKE ?";
        $server_data = $this->db->query($mysql_query, array($szerver));

        $row = $server_data->row();
        $szerver = $row->adatbazis;  
        $host = $row->host;
        $port = $row->port;

        $formatum = $this->site_security->prevent_injection($formatum);

        $data['parsedResult'] = $this->mdl_yaz->fetch_data_from_library($host.":".$port."/".$szerver, $formatum, $ccl_query);
    }
    $this->load->view("honositas_kereso", $data);
}

private function convert_simple_value_to_specified_ccl_value($val)
{
    switch($val)
    {
        case "nev": return "author_name_personal"; break;
        case "cim": return "title"; break;
        case "targyszavak": return "subject_heading"; break;
        case "megjelenes": return "date_of_publication"; break;
        case "kiado": return "publisher"; break;
        case "leiras": return "content_type"; break;
        case "isbn": return "isbn"; break;
        case "eto": return "dewey_classification"; break;
        default: return "title"; break;
        
        /*
        case "cim": return "titel"; break;
        case "szerzok": return "author"; break;
        case "megjelenes": return "pub_date";  break;
        case "terjedelem": return "extent"; break;
        case "datum": date('Y. m. d'); break;
        case "dok_stat": return 'n'; break;
        case "beszerz_mod": return 'v'; break;
        case "kotes": return "quality_note"; break;
        case "targyszavak": return "autho titel";
        case "peldany_megj": return "diss_note";
        case "feltuntetett_ar": return "trade_price";
        case "isbn": return "isbn";
        case "nyelvek": return "language";
        case "nemzetkozi_azonosito": return "national_no";
        case "gyujtemenyek": return "genre";
        case "eto": return "eto";
        case "kiadok": return "publisher";
        */
    }
}

function honositas()
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data['headline'] = "Z39.50 szerverek";

    $mysql_query_z3950 = "SELECT * FROM biblioteka.z3950";
    $data['query_z3950'] = $this->_custom_query($mysql_query_z3950);
    
    $mysql_query_konyvtarak = "SELECT * FROM biblioteka.konyvtarak";
    $data['query_konyvtarak'] = $this->_custom_query($mysql_query_konyvtarak);

    $this->load->view("honositas", $data);
}

function generate_url_from_utf8($text)
{    
    $text = trim($text);
    $text = mb_strtolower($text);
    $text = preg_replace('/\s+/', ' ',$text);
    $text = str_replace(array(' ', '"', ',', '/', ':', '?', '.', '!', '@', '$'), array('-', '', '', '', '', '', '', '', '', ''), $text);        
    $text = str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö','ő', 'ù','ú','û','ü','ű', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o','o' , 'u','u','u','u','u' , 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), $text); 
    $text = trim($text, "-");
    $text = str_replace('-', ' ', $text);
    $text = preg_replace('/\s+/', ' ',$text);
    $text = str_replace(' ', '-', $text);
    $text = urlencode($text);
    return $text;
}

function _get_book_id_from_url($item_url){
    $query = $this->get_where_custom('item_url', $item_url);
    foreach ($query->result() as $row) {
        $item_id = $row->id;
    }

    if(!isset($item_id)){
        $item_id = 0;
    }
    return $item_id;
}

function details()
{
    $book_id = $this->uri->segment(3);
    if($book_id == 0)
    {
        redirect(base_url());
    }

    $data = $this->fetch_data_from_db($book_id);
    $data['query'] = $this->db->query("
SELECT
  biblioteka.termek.terem_neve,
  biblioteka.kolcsonzesek.leltari_szam,
  biblioteka.kolcsonzesek.datum,
  biblioteka.konyvtarak.nev,
  biblioteka.nyilvantartas.nem_kolcsonzesre,
  biblioteka.kolcsonzesek.visszahozta
FROM
  biblioteka.nyilvantartas
  INNER JOIN biblioteka.nyilvantartas_has_termek ON biblioteka.nyilvantartas.nyilvantartas_id =
    biblioteka.nyilvantartas_has_termek.nyilvantartas_id
  INNER JOIN biblioteka.termek ON biblioteka.nyilvantartas_has_termek.terem_id = biblioteka.termek.terem_id
  INNER JOIN biblioteka.konyvtarak ON biblioteka.termek.fiok_id = biblioteka.konyvtarak.fiok_id
  INNER JOIN biblioteka.bibliografiak ON biblioteka.bibliografiak.nyilvantartas_id =
    biblioteka.nyilvantartas.nyilvantartas_id
  INNER JOIN biblioteka.kolcsonzesek ON biblioteka.bibliografiak.leltari_szam = biblioteka.kolcsonzesek.leltari_szam
  INNER JOIN biblioteka.kolcsonzesek_has_tagok ON biblioteka.kolcsonzesek_has_tagok.kolcsonzesek_id =
    biblioteka.kolcsonzesek.id AND biblioteka.konyvtarak.fiok_id = biblioteka.kolcsonzesek_has_tagok.fiok_id
  WHERE biblioteka.bibliografiak.leltari_szam = $book_id
");
    $this->load->view('details', $data);
}

function view($tab = "egyszeru_kereses")
{
    $this->load->module('custom_pagination');
    $this->load->module('site_security');

    $this->load->module("nyelvek");
    $this->load->module("gyujtemenyek");
    $this->load->module("tipusok");
    $this->load->module("termek");
    $this->load->module("konyvtarak");

    $data['flash'] = $this->session->flashdata('catalog');

    $oldal_szam = $this->uri->segment(3);
    if(is_null($oldal_szam) || !is_numeric($oldal_szam))
    {
        $oldal_szam = $this->get_limit();
    }

    $limit = TRUE;

    $filter = $this->input->get('filter', TRUE);
    $q = $this->input->get('q', TRUE);

    if(!empty($filter) && !empty($q))
    {
        $filter = $this->site_security->prevent_injection($filter);    
        $q = $this->site_security->prevent_injection($q);

        $valid_options = array("kulcsszo", "nev", "cim", "targyszavak", "kiado", "rszj", "leiras_tipus", "url", "isbn", "gyari_szam", "leiras_gyujtemeny", "megjelenes", "eto");

        if (in_array($filter, $valid_options)){

            if($filter == "kulcsszo")
            {
                $query = "SELECT bibliografiak.id,szerzok.nev, bibliografiak.cim, bibliografiak.targyszavak, kiadok.kiado, nyilvantartas.rszj, tipusok.leiras as leiras_tipus, nyilvantartas.url, bibliografiak.isbn, bibliografiak.gyari_szam, gyujtemenyek.leiras as leiras_gyujtemeny, bibliografiak.megjelenes, bibliografiak.eto FROM biblioteka.bibliografiak INNER JOIN biblioteka.tipusok ON biblioteka.bibliografiak.tipus_id = biblioteka.tipusok.tipus_id INNER JOIN biblioteka.szerzok ON biblioteka.bibliografiak.szerzo_id = biblioteka.szerzok.szerzo_id INNER JOIN biblioteka.gyujtemenyek ON biblioteka.bibliografiak.gyujtemeny_id = biblioteka.gyujtemenyek.gyujtemeny_id INNER JOIN biblioteka.kiadok ON biblioteka.bibliografiak.kiado_id = biblioteka.kiadok.kiado_id INNER JOIN biblioteka.nyilvantartas ON biblioteka.bibliografiak.nyilvantartas_id = biblioteka.nyilvantartas.nyilvantartas_id WHERE lower(nev) LIKE lower(CONCAT('%','$q','%')) || lower(cim) LIKE lower(CONCAT('%','$q','%')) || lower(targyszavak) LIKE lower(CONCAT('%','$q','%')) || lower(kiado) LIKE lower(CONCAT('%','$q','%')) || lower(rszj) LIKE lower(CONCAT('%','$q','%')) || lower(tipusok.leiras) LIKE lower(CONCAT('%','$q','%')) || lower(url) LIKE lower(CONCAT('%','$q','%')) || lower(isbn) LIKE lower(CONCAT('%','$q','%')) || lower(gyari_szam) LIKE lower(CONCAT('%','$q','%')) || lower(gyujtemenyek.leiras) LIKE lower(CONCAT('%','$q','%')) || lower(megjelenes) LIKE lower(CONCAT('%','$q','%')) ||lower(eto) LIKE lower(CONCAT('%','$q','%'))ORDER BY cim";
            } else {
                if($filter == "leiras_tipus")
                {
                    $filter = "biblioteka.tipusok.leiras";
                }
                else if($filter == "leiras_gyujtemeny")
                {
                    $filter = "biblioteka.gyujtemenyek.leiras";
                }

                $query = "SELECT bibliografiak.id, szerzok.nev, bibliografiak.cim, bibliografiak.targyszavak, kiadok.kiado, nyilvantartas.rszj, tipusok.leiras as leiras_tipus, nyilvantartas.url, bibliografiak.isbn, bibliografiak.gyari_szam, gyujtemenyek.leiras as leiras_gyujtemeny, bibliografiak.megjelenes, bibliografiak.eto FROM biblioteka.bibliografiak INNER JOIN biblioteka.tipusok USING(tipus_id) INNER JOIN biblioteka.szerzok USING(szerzo_id) INNER JOIN biblioteka.gyujtemenyek USING(gyujtemeny_id) INNER JOIN biblioteka.kiadok USING(kiado_id) INNER JOIN biblioteka.nyilvantartas USING(nyilvantartas_id) WHERE lower($filter) LIKE lower(CONCAT('%','$q','%')) ORDER BY cim";
            }

        }

    } else {
        $result = $this->check_search_result();
        if(!is_null($result['query'])){
            $query = $result['query'];
            $data = $result;
        }        
    }

    if(isset($query)){
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

    }

    $data['tipus_query'] = $this->tipusok->get("leiras");
    $data['nyelv_query'] = $this->nyelvek->get("nyelv");
    $data['gyujtemeny_query'] = $this->gyujtemenyek->get("leiras");

    $data['get_user_type'] = $this->site_security->_get_user_type();

    $data['q'] = $q;
    $data['tab'] = $tab;
    $data['view_module'] = "bibliografiak";
    $data['view_file'] = "view";
    $this->load->module('templates');

    $this->templates->public_template($data);
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
        redirect(base_url().'bibliografiak/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $mysql_query = "SELECT nyilvantartas_id FROM biblioteka.bibliografiak WHERE id = ?";
        $query = $this->db->query($mysql_query, array($update_id));
        $row = $query->row();
        $nyilvantartas_id = $row->nyilvantartas_id;

        $mysql_query = "DELETE FROM biblioteka.nyilvantartas WHERE nyilvantartas_id = ?";
        $this->db->query($mysql_query, array($nyilvantartas_id));
        
        $this->_delete($update_id);
    } 

    $flash_msg = "A bibliográfiát sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'bibliografiak/manage/20');
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

    $data['headline'] = "Bibliográfia törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function insert_szerzo($nev = "")
{
    if($nev != ""){
        $this->load->module('site_security');
        $this->site_security->_is_admin();
        $mysql_query = "INSERT INTO biblioteka.szerzok (nev) VALUES (?)";
        $this->db->query($mysql_query, array(urldecode($nev)));
    }
}

function delete_szerzo($nev)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    $mysql_query = "DELETE FROM biblioteka.szerzok WHERE nev LIKE ?";
    $this->db->query($mysql_query, array($nev));
}

function katalogus_cedula($leltari_szam)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $data = $this->get_where($leltari_szam);

    $this->load->view('katalogus_cedula', $data);
}

function get_inventory_number_with_ajax()
{
    /*
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    */
    $mysql_query = "SELECT max(leltari_szam) as max_id FROM biblioteka.bibliografiak";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    echo $row->max_id+1;
}

function insert_with_ajax($table)
{    
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    extract($_POST);

    switch($table)
    {
        case 'tipus': 
            $mysql_query = "INSERT INTO biblioteka.tipusok (leiras) VALUES ('$leiras')";
            $this->_custom_query($mysql_query);
        break;
        case 'kiado': 
            $mysql_query = "INSERT INTO biblioteka.kiadok (kiado, hely) VALUES ('$kiado', '$hely')";
            $this->_custom_query($mysql_query);
        break;
        case 'gyujtemeny':
            $mysql_query = "SELECT fiok_id FROM biblioteka.konyvtarak WHERE nev LIKE '$fioktelep'";
            $query = $this->_custom_query($mysql_query);
            $row = $query->row();
            $fiok_id = $row->fiok_id;

            $mysql_query = "INSERT INTO biblioteka.gyujtemenyek (fiok_id, leiras, hatralevo_napok, kesedelmi_dij, kolcsonzoi_dij, nem_masolhato, masolat_dij) VALUES ('$fiok_id', '$leiras', '$hatralevo_napok', '$kesedelmi_dij', '$kolcsonzoi_dij', '$nem_masolhato', '$masolasi_dij')";
            $this->_custom_query($mysql_query);
        break;
        case 'nyelv':
            $mysql_query = "INSERT INTO biblioteka.nyelvek (nyelv, roviditese) VALUES ('$nyelv', '$rovidites')";
            $this->_custom_query($mysql_query);
        break;
        case 'konyvtar':
            $mysql_query = "INSERT INTO biblioteka.konyvtarak (nev, foigazgato, iranyitoszam, varos, kerulet, cim, telefon_szam, fax_szam, email, fiok_megjegyzesek, url) VALUES ('$nev', '$foigazgato', '$iranyitoszam', '$varos', '$kerulet', '$cim', '$telefon_szam', '$fax_szam', '$email', '$fiok_megjegyzesek', '$url')";
            $this->_custom_query($mysql_query);
        break;
    }
}

function _get_item_id_from_item_url($item_url){
    $query = $this->get_where_custom('id', $item_url);
    foreach ($query->result() as $row) {
        $item_id = $row->id;
    }

    if(!isset($item_id)){
        $item_id = 0;
    }
    return $item_id;
}

function katalogus($update_id)
{
    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    //fetch the item details
    $data = $this->fetch_data_from_db($update_id);
    $data['update_id'] = $update_id;

    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "view";
    $this->load->module('templates');
    $this->templates->public_template($data);
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

function manage()
{
    $this->load->module('custom_pagination');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $oldal_szam = $this->uri->segment(3);
    $limit = TRUE;

    $keres = $this->input->get('keres',TRUE);
    $rendez = $this->input->get('rendez',TRUE);

    if(!empty($rendez) && in_array($rendez, array('leltari_szam', 'cim', 'nev', 'megjelenes'))){
        $order_by = $rendez;
    }else{
        $order_by = 'leltari_szam';
    }
    $where = empty($keres)?"":"WHERE lower(leltari_szam) = lower('%$keres%') OR lower(cim) LIKE lower('%$keres%') OR lower(nev) LIKE lower('%$keres%') OR lower(datum) LIKE lower('%$keres%')";

    $data['flash'] = $this->session->flashdata('item');
    $query = "SELECT * FROM  biblioteka.bibliografiak_view  $where ORDER BY $order_by";
    $data['result_number'] = @$this->_custom_query($query)->num_rows();

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

    $pagination_data['offset'] = $this->get_offset();;
    $data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
   

    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin_template($data);

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

function check_constrait_for_nyilvantartas($nyilvantartas_id)
{
    $this->site_security->_get_details_from_user();
    $lib_id = $this->session->userdata('lib_id');
    $lelohely = $this->input->post('lelohely', TRUE);
    $mysql_query = "SELECT terem_id FROM biblioteka.termek WHERE terem_neve LIKE '$lelohely' AND fiok_id = $lib_id";
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $terem_id = $row_x->terem_id;

    $mysql_query2 = "SELECT * FROM nyilvantartas_has_termek WHERE nyilvantartas_id = ? AND terem_id = ?";
    $query = $this->db->query($mysql_query2,array($nyilvantartas_id, $terem_id));
    if($query->num_rows() == 0){
        $mysql_query2 = "SELECT * FROM nyilvantartas_has_termek WHERE nyilvantartas_id = ?";
        $query = $this->db->query($mysql_query2,array($nyilvantartas_id));
        if($query->num_rows() > 0){
            $mysql_query3 = "UPDATE biblioteka.nyilvantartas_has_termek SET terem_id = ? WHERE nyilvantartas_id = ?";
            $this->db->query($mysql_query3,array($terem_id, $nyilvantartas_id));
        }
        else
        {
            $mysql_query3 = "INSERT INTO biblioteka.nyilvantartas_has_termek (nyilvantartas_id, terem_id) VALUES (?,?)";
            $this->db->query($mysql_query3,array($nyilvantartas_id, $terem_id));
        }
    }
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $id = $row_x->terem_id;
    return $id;
}

function check_constrait()
{
    $nyelvek = $this->input->post('nyelvek', TRUE);
    $mysql_query = "SELECT nyelv_id FROM biblioteka.nyelvek WHERE nyelv LIKE '$nyelvek' OR roviditese LIKE '$nyelvek'";
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $data['nyelv_id'] = $row_x->nyelv_id;

    $tipusok = $this->input->post('tipusok', TRUE);
    $mysql_query = "SELECT tipus_id FROM biblioteka.tipusok WHERE leiras LIKE '$tipusok'";
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $data['tipus_id'] = $row_x->tipus_id;    

    $kiadok = $this->input->post('kiadok', TRUE);
    $mysql_query = "SELECT kiado_id FROM biblioteka.kiadok WHERE kiado LIKE '$kiadok'";
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $data['kiado_id'] = $row_x->kiado_id;

    $gyujtemenyek = $this->input->post('gyujtemenyek', TRUE);
    $mysql_query = "SELECT gyujtemeny_id FROM biblioteka.gyujtemenyek WHERE leiras LIKE '$gyujtemenyek'";
    $stuff_x = $this->_custom_query($mysql_query);
    $row_x = $stuff_x->row();
    $data['gyujtemeny_id'] = $row_x->gyujtemeny_id;

    return $data;
}

function create()
{
    $this->load->module('termek');
    $this->load->module('szerzok');

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect('bibliografiak/manage/20');
    }
    if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('leltari_szam', 'Leltari szam', 'required|numeric|integer|max_length[11]');
        $this->form_validation->set_rules('rszj', 'Rszj', 'numeric|integer|max_length[3]');
        $this->form_validation->set_rules('mrj', 'Mrj', 'max_length[11]');
        $this->form_validation->set_rules('vonalkod', 'Vonalkód', 'numeric|integer|max_length[13]');           
        $this->form_validation->set_rules('cim', 'Cím', 'required|max_length[255]');        
        $this->form_validation->set_rules('egyebcimek', 'Egyébcímek', 'max_length[255]');  
        $this->form_validation->set_rules('szerzok', 'Szerzők', 'required|max_length[65]');  
        $this->form_validation->set_rules('kiemelt_rendszavak', 'Kiemelt rendszavak', 'max_length[500]');  
        $this->form_validation->set_rules('egyeb_rendszavak', 'Egyéb rendszavak', 'max_length[500]');  
        $this->form_validation->set_rules('testuleti_szerzo', 'Testületi szerző', 'max_length[500]');  
        $this->form_validation->set_rules('kiadasjelzes', 'Kiadasjelzés', 'max_length[100]');       
        $this->form_validation->set_rules('lelohely', 'Lelőhely', 'max_length[300]');  
        $this->form_validation->set_rules('dok_stat', 'Dok stat', 'max_length[100]');  
        $this->form_validation->set_rules('megjelenes', 'Megjelenés', 'max_length[500]');  
        $this->form_validation->set_rules('terjedelem', 'Terjedelem', 'max_length[165]');  
        $this->form_validation->set_rules('sorozat', 'Sorozat', 'max_length[255]');
        $this->form_validation->set_rules('isbn', 'ISBN', 'max_length[17]');
        $this->form_validation->set_rules('gyari_szam', 'Gyári szám', 'max_length[100]');  
        $this->form_validation->set_rules('nemzetkozi_azonosito', 'Nemzetközi azonosító', 'max_length[100]');  
        $this->form_validation->set_rules('feltuntetett_ar', 'Feltüntett ár', 'max_length[11]');  
        $this->form_validation->set_rules('beszerz_jegyz', 'Beszerz jegyz', 'max_length[150]');   
        $this->form_validation->set_rules('beszerz_mod', 'Beszerz mód', 'max_length[200]');  
        $this->form_validation->set_rules('datum', 'Dátum', 'max_length[15]');  
        $this->form_validation->set_rules('beszerzesi_ar', 'Beszerzesi_ar', 'max_length[11]');
        $this->form_validation->set_rules('eto', 'ETO', 'max_length[500]');
        $this->form_validation->set_rules('targyi_mt', 'Tárgyi mt', 'max_length[500]');
        $this->form_validation->set_rules('csz', 'Csz', 'max_length[10]');

        $this->form_validation->set_rules('nyelvek', 'Nyelv', 'required|callback_nyelv_check');
        $this->form_validation->set_rules('tipusok', 'Típus', 'required|callback_tipus_check');
        $this->form_validation->set_rules('gyujtemenyek', 'Gyűjtemény', 'required|callback_gyujtemeny_check');
        $this->form_validation->set_rules('kiadok', 'Kiadó', 'required|callback_kiado_check');

        if($this->form_validation->run() == TRUE)
        {
            if(is_numeric($update_id))
            {
                //update the page details
                $mysql_query = "SELECT nyilvantartas_id FROM biblioteka.bibliografiak WHERE id = $update_id";
                $query = $this->_custom_query($mysql_query);
                $row = $query->row();
                $nyilvantartas_id = $row->nyilvantartas_id;

                //update the registry
                $mysql_query = "UPDATE biblioteka.nyilvantartas SET
                    rszj = ?, 
                    mrj = ?, 
                    feltuntetett_ar = ?, 
                    beszerzesi_ar = ?, 
                    cserear = ?, 
                    cserear_datuma = ?, 
                    nem_kolcsonzesre = ?, 
                    dok_stat = ?, 
                    kotes = ?, 
                    elveszett_elem = ?, 
                    tartalekok = ?, 
                    melleklet_1 = ?, 
                    melleklet_2 = ?, 
                    melleklet_3 = ?, 
                    kozos_megjegyzesek = ?, 
                    peldany_megjegyzesek = ?,
                    lelohely = ?, 
                    beszerz_jegyz = ?, 
                    beszerz_mod = ?, 
                    kozos_spec_adat = ?, 
                    saj_spec_adat = ?, 
                    url = ?
                    WHERE biblioteka.nyilvantartas.nyilvantartas_id = ?
                    ";
                    $data = $this->fetch_data_form_post_to_nyilvantartas();
                    if(!empty($data['cserear_datuma'])){
                        $data['cserear_datuma'] = str_replace(". ", "-", $data['cserear_datuma']);
                    }

                    $data['lelohely'] = $this->check_constrait_for_nyilvantartas($nyilvantartas_id);

                    $this->db->query($mysql_query, array(
                        $data['rszj'], 
                        $data['mrj'], 
                        $data['feltuntetett_ar'], 
                        $data['beszerzesi_ar'], 
                        $data['cserear'], 
                        $data['cserear_datuma'], 
                        $data['nem_kolcsonzesre'], 
                        $data['dok_stat'], 
                        $data['kotes'], 
                        $data['elveszett_elem'], 
                        $data['tartalekok'], 
                        $data['melleklet_1'], 
                        $data['melleklet_2'], 
                        $data['melleklet_3'],  
                        $data['kozos_megj'],
                        $data['peldany_megj'], 
                        $data['lelohely'], 
                        $data['beszerz_jegyz'], 
                        $data['beszerz_mod'], 
                        $data['kozos_spec_adat'], 
                        $data['saj_spec_adat'], 
                        $data['url'], 
                        $nyilvantartas_id
                    ));

                $data = $this->fetch_data_form_post_to_bibliografiak();  
                
                //check the authors
                $szerzok = $this->input->post('szerzok', TRUE);
                $query = $this->szerzok->get_where_custom('nev', trim($szerzok));

                if($query->num_rows() > 0)
                {
                    $data['szerzo_id'] = $query->row()->szerzo_id;
                }
                else
                {
                    $this->szerzok->_insert(array('nev' => trim($szerzok)));
                    $data['szerzo_id'] = $this->db->insert_id();
                }     

                $data += $this->check_constrait();
                $this->_update($update_id, $data);

                $flash_msg = "A bibliográfiát sikeresen módosította!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('bibliografiak/create/'.$update_id);
            }
            else
            {
                //insert a new record
                $mysql_query = "INSERT INTO biblioteka.nyilvantartas (
                    rszj,
                    mrj,                    
                    letrehozas_datuma,
                    feltuntetett_ar,
                    beszerzesi_ar,
                    cserear,
                    cserear_datuma,
                    nem_kolcsonzesre,
                    dok_stat,
                    kotes,
                    elveszett_elem,
                    tartalekok,
                    melleklet_1,
                    melleklet_2,
                    melleklet_3,
                    kozos_megjegyzesek,
                    peldany_megjegyzesek,
                    lelohely,
                    beszerz_jegyz,
                    beszerz_mod,
                    kozos_spec_adat,
                    saj_spec_adat,
                    url
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $data = $this->fetch_data_form_post_to_nyilvantartas();
                if(!empty($data['cserear_datuma'])){
                    $data['cserear_datuma'] = str_replace(". ", "-", $data['cserear_datuma']);
                }
                
                $data['lelohely'] = 0;

                $this->db->query($mysql_query, array(
                    $data['rszj'], 
                    $data['mrj'], 
                    date("Y-m-d"),
                    $data['feltuntetett_ar'], 
                    $data['beszerzesi_ar'], 
                    $data['cserear'], 
                    $data['cserear_datuma'], 
                    $data['nem_kolcsonzesre'], 
                    $data['dok_stat'], 
                    $data['kotes'], 
                    $data['elveszett_elem'], 
                    $data['tartalekok'], 
                    $data['melleklet_1'], 
                    $data['melleklet_2'], 
                    $data['melleklet_3'],  
                    $data['kozos_megj'],
                    $data['peldany_megj'], 
                    $data['lelohely'], 
                    $data['beszerz_jegyz'], 
                    $data['beszerz_mod'], 
                    $data['kozos_spec_adat'], 
                    $data['saj_spec_adat'], 
                    $data['url']
                ));

                $data = $this->fetch_data_form_post_to_bibliografiak();  
                $data['nyilvantartas_id'] = $this->db->insert_id();
                
                $this->check_constrait_for_nyilvantartas($data['nyilvantartas_id']);

                $szerzok = $this->input->post('szerzok', TRUE);
                $query = $this->szerzok->get_where_custom('nev', trim($szerzok));

                if($query->num_rows() > 0)
                {
                    $data['szerzo_id'] = $query->row()->szerzo_id;
                }
                else
                {
                    $this->szerzok->_insert(array('nev' => trim($szerzok)));
                    $data['szerzo_id'] = $this->db->insert_id();
                }     

                $data += $this->check_constrait();
                $this->_insert($data);

                $update_id = $this->get_max();
                $flash_msg = "A bibliográfiát sikeresen hozzáadta!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('bibliografiak/create/'.$update_id);
            }
        }
    }

    
    if((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);

        if($data == "")
        {
            redirect(base_url().'bibliografiak/create');
        }
    }
    else
    {
        $data = $this->fetch_data_form_post();
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új bibliográfia";
    }
    else
    {
        $data['headline'] = "Bibliográfia módosítása";
    }

    $query = $this->db->query("select CONCAT(SUBSTR(nev,1,1),COUNT(1)) as result from szerzok WHERE nev LIKE ? order by nev limit 1",array($data['szerzok']));

    foreach ($query->result() as $row) {
        $data['auto_cutter'] = $row->result;
    }
    if(!isset($data['auto_cutter']))
    {
        $data['auto_cutter'] = '';
    }

    $lib_id = $this->session->userdata('lib_id');
    $data['query'] = $this->termek->get_where_custom('fiok_id',$lib_id);

    $data['get_max'] = $this->get_max()+1;
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function nyelv_check($val)
{
    $str = $this->input->post('nyelvek', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.nyelvek WHERE nyelv LIKE ? OR roviditese LIKE ?";
    $query = $this->db->query($mysql_query, array($str, $str));
    $num_rows = $query->num_rows();

    if ($num_rows == 0)
    {
        $this->db->query("INSERT INTO nyelvek (roviditese) VALUES (?)",array($val));
        //$this->form_validation->set_message('nyelv_check', 'A {field} mező értéke nem található meg a nyelvek táblában.');
        return TRUE;
    }
    else
    {
        return TRUE;
    }
}

function tipus_check($val)
{
    $str = $this->input->post('tipusok', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.tipusok WHERE leiras LIKE ?";
    $query = $this->db->query($mysql_query, array($str));
    $num_rows = $query->num_rows();
    
    if ($num_rows == 0)
    {
        $this->db->query("INSERT INTO tipusok (leiras) VALUES (?)",array($val));
        //$this->form_validation->set_message('tipus_check', 'A {field} mező értéke nem található meg a típusok táblában.');
        return TRUE;
    }
    else
    {
        return TRUE;
    }
}

function gyujtemeny_check($val)
{
    $str = $this->input->post('gyujtemenyek', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.gyujtemenyek WHERE leiras LIKE ?";
    $query = $this->db->query($mysql_query, array($str));
    $num_rows = $query->num_rows();
    
    if ($num_rows == 0)
    {
        $this->db->query("INSERT INTO gyujtemenyek (leiras) VALUES (?)",array($val));
        //$this->form_validation->set_message('gyujtemeny_check', 'A {field} mező értéke nem található meg a gyűjtemények táblában.');
        return TRUE;
    }
    else
    {
        return TRUE;
    }
}

function kiado_check($val)
{
    $str = $this->input->post('kiadok', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.kiadok WHERE kiado LIKE ?";
    $query = $this->db->query($mysql_query, array($str));
    $num_rows = $query->num_rows();
    
    if ($num_rows == 0)
    {
        $this->db->query("INSERT INTO kiadok (kiado) VALUES (?)",array($val));
        //$this->form_validation->set_message('kiado_check', 'A {field} mező értéke nem található meg a kiadók táblában.');
        return TRUE;
    }
    else
    {
        return TRUE;
    }
}

function fetch_data_form_post_to_bibliografiak()
{
    $data['leltari_szam'] = $this->input->post('leltari_szam', TRUE);
    $data['vonalkod'] = $this->input->post('vonalkod', TRUE);
    $data['cim'] = $this->input->post('cim', TRUE);
    $data['egyebcimek'] = $this->input->post('egyebcimek', TRUE);
    $data['kiemelt_rendszavak'] = $this->input->post('kiemelt_rendszavak', TRUE);
    $data['egyeb_rendszavak'] = $this->input->post('egyeb_rendszavak', TRUE);
    $data['testuleti_szerzo'] = $this->input->post('testuleti_szerzo', TRUE);
    $data['kiadasjelzes'] = $this->input->post('kiadasjelzes', TRUE);
    $data['megjelenes'] = $this->input->post('megjelenes', TRUE);
    $data['terjedelem'] = $this->input->post('terjedelem', TRUE);
    $data['sorozat'] = $this->input->post('sorozat', TRUE);
    $data['isbn'] = $this->input->post('isbn', TRUE);
    $data['gyari_szam'] = $this->input->post('gyari_szam', TRUE);
    $data['nemzetkozi_azonosito'] = $this->input->post('nemzetkozi_azonosito', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    $data['targyszavak'] = $this->input->post('targyszavak', TRUE);
    $data['eto'] = $this->input->post('eto', TRUE);
    $data['targyi_mt'] = $this->input->post('targyi_mt', TRUE);
    $data['csz'] = $this->input->post('csz', TRUE);
    return $data;
}

function fetch_data_form_post_to_nyilvantartas()
{
    $data['rszj'] = $this->input->post('rszj', TRUE);
    $data['mrj'] = $this->input->post('mrj', TRUE);
    $data['lelohely'] = $this->input->post('lelohely', TRUE);
    $data['dok_stat'] = $this->input->post('dok_stat', TRUE);
    $data['kozos_megj'] = $this->input->post('kozos_megj', TRUE);
    $data['peldany_megj'] = $this->input->post('peldany_megj', TRUE);
    $data['kotes'] = $this->input->post('kotes', TRUE);
    $data['feltuntetett_ar'] = $this->input->post('feltuntetett_ar', TRUE);
    $data['beszerz_jegyz'] = $this->input->post('beszerz_jegyz', TRUE);
    $data['beszerz_mod'] = $this->input->post('beszerz_mod', TRUE);
    $data['beszerzesi_ar'] = $this->input->post('beszerzesi_ar', TRUE);
    $data['kozos_spec_adat'] = $this->input->post('kozos_spec_adat', TRUE);
    $data['saj_spec_adat'] = $this->input->post('saj_spec_adat', TRUE);

    $data['cserear'] = $this->input->post('cserear', TRUE);
    $data['cserear_datuma'] = $this->input->post('cserear_datuma', TRUE);
    $data['nem_kolcsonzesre'] = $this->input->post('nem_kolcsonzesre', TRUE);
    $data['elveszett_elem'] = $this->input->post('elveszett_elem', TRUE);
    $data['tartalekok'] = $this->input->post('tartalekok', TRUE);
    $data['melleklet_1'] = $this->input->post('melleklet_1', TRUE);
    $data['melleklet_2'] = $this->input->post('melleklet_2', TRUE);
    $data['melleklet_3'] = $this->input->post('melleklet_3', TRUE);
    $data['url'] = $this->input->post('url', TRUE);
    return $data;
}


function fetch_data_form_post_to_nyelv()
{
    $data['nyelv_id'] = $this->input->post('nyelv_id', TRUE);
    $data['nyelv'] = $this->input->post('nyelv', TRUE);
    $data['roviditese'] = $this->input->post('roviditese', TRUE);
    return $data;
}


function fetch_data_form_post_to_tipus()
{
    $data['tipus_id'] = $this->input->post('tipus_id', TRUE);
    $data['leiras'] = $this->input->post('leiras', TRUE);
    return $data;
}


function fetch_data_form_post_to_gyujtemeny()
{
    $data['gyujtemeny_id'] = $this->input->post('gyujtemeny_id', TRUE);
    $data['fiok_id'] = $this->input->post('fiok_id', TRUE);
    $data['leiras'] = $this->input->post('leiras', TRUE);
    $data['hatralevo_napok'] = $this->input->post('hatralevo_napok', TRUE);
    $data['kesedelmi_dij'] = $this->input->post('kesedelmi_dij', TRUE);
    $data['kolcsonzoi_dij'] = $this->input->post('kolcsonzoi_dij', TRUE);
    $data['nem_masolhato'] = $this->input->post('nem_masolhato', TRUE);
    $data['masolat_dij'] = $this->input->post('masolat_dij', TRUE);

    return $data;
}


function fetch_data_form_post_to_kiado()
{
    $data['kiado_id'] = $this->input->post('kiado_id', TRUE);
    $data['kiado'] = $this->input->post('kiado', TRUE);
    $data['hely'] = $this->input->post('hely', TRUE);
    return $data;
}

function fetch_data_from_db($update_id)
{
    $this->load->module('termek');

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $mysql_query = "SELECT * FROM  biblioteka.bibliografiak_view WHERE id = $update_id
    ";

    $query = $this->_custom_query($mysql_query);

    foreach ($query->result() as $row) {
        $nyilvantartas_id = $row->nyilvantartas_id;
        $data['leltari_szam'] = $row->leltari_szam;
        $data['rszj'] = $row->rszj;
        $data['mrj'] = $row->mrj;
        $data['vonalkod'] = $row->vonalkod;
        $data['cim'] = $row->cim;
        $data['egyebcimek'] = $row->egyebcimek;
        $data['szerzok'] = $row->nev;
        $data['kiemelt_rendszavak'] = $row->kiemelt_rendszavak;
        $data['egyeb_rendszavak'] = $row->egyeb_rendszavak;
        $data['testuleti_szerzo'] = $row->testuleti_szerzo;
        $data['kiadasjelzes'] = $row->kiadasjelzes;
        $data['lelohely'] = $row->lelohely;
        $data['dok_stat'] = $row->dok_stat;
        $data['megjelenes'] = $row->megjelenes;
        $data['terjedelem'] = $row->terjedelem;
        $data['sorozat'] = $row->sorozat;
        $data['kozos_megj'] = $row->kozos_megjegyzesek;
        $data['peldany_megj'] = $row->peldany_megjegyzesek;
        $data['isbn'] = $row->isbn;
        $data['kotes'] = $row->kotes;
        $data['gyari_szam'] = $row->gyari_szam;
        $data['nemzetkozi_azonosito'] = $row->nemzetkozi_azonosito;
        $data['feltuntetett_ar'] = $row->feltuntetett_ar;
        $data['beszerz_jegyz'] = $row->beszerz_jegyz;
        $data['beszerz_mod'] = $row->beszerz_mod;
        $data['datum'] = $row->datum;
        $data['beszerzesi_ar'] = $row->beszerzesi_ar;
        $data['targyszavak'] = $row->targyszavak;
        $data['eto'] = $row->eto;
        $data['targyi_mt'] = $row->targyi_mt;
        $data['kozos_spec_adat'] = $row->kozos_spec_adat;
        $data['saj_spec_adat'] = $row->saj_spec_adat;
        $data['csz'] = $row->csz;

        $data['nyelv'] = ($row->nyelv)!=""?$row->nyelv:$row->roviditese;
        $data['tipus'] = $row->leiras_tipusok;
        $data['gyujtemeny'] = $row->leiras;
        $data['kiado'] = $row->kiado;

        $data['cserear'] = $row->cserear;
        $data['cserear_datuma'] = $row->cserear_datuma;
        $data['nem_kolcsonzesre'] = $row->nem_kolcsonzesre;
        $data['elveszett_elem'] = $row->elveszett_elem;
        $data['tartalekok'] = $row->tartalekok;
        $data['melleklet_1'] = $row->melleklet_1;
        $data['melleklet_2'] = $row->melleklet_2;
        $data['melleklet_3'] = $row->melleklet_3;
        $data['url'] = $row->url;

        $data['borito'] = $row->borito;
    }

    if(isset($nyilvantartas_id)){
        $query = $this->db->query("SELECT * FROM biblioteka.nyilvantartas_has_termek INNER JOIN biblioteka.termek ON(termek.terem_id = nyilvantartas_has_termek.terem_id) WHERE nyilvantartas_id = ?",array($nyilvantartas_id));

        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $data['lelohely'] = $row->terem_neve;
            }
        }else{
            $data['lelohely'] = "";
        }
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}



function fetch_data_form_post()
{

    $data['nyelv'] = $this->input->post('nyelvek', TRUE);
    $data['tipus'] = $this->input->post('tipusok', TRUE);
    $data['gyujtemeny'] = $this->input->post('gyujtemenyek', TRUE);
    $data['kiado'] = $this->input->post('kiadok', TRUE);

    $data['leltari_szam'] = $this->input->post('leltari_szam', TRUE);
    $data['rszj'] = $this->input->post('rszj', TRUE);
    $data['mrj'] = $this->input->post('mrj', TRUE);
    $data['vonalkod'] = $this->input->post('vonalkod', TRUE);
    $data['cim'] = $this->input->post('cim', TRUE);
    $data['egyebcimek'] = $this->input->post('egyebcimek', TRUE);
    $data['szerzok'] = $this->input->post('szerzok', TRUE);
    $data['kiemelt_rendszavak'] = $this->input->post('kiemelt_rendszavak', TRUE);
    $data['egyeb_rendszavak'] = $this->input->post('egyeb_rendszavak', TRUE);
    $data['testuleti_szerzo'] = $this->input->post('testuleti_szerzo', TRUE);
    $data['kiadasjelzes'] = $this->input->post('kiadasjelzes', TRUE);
    $data['lelohely'] = $this->input->post('lelohely', TRUE);
    $data['dok_stat'] = $this->input->post('dok_stat', TRUE);
    $data['megjelenes'] = $this->input->post('megjelenes', TRUE);
    $data['terjedelem'] = $this->input->post('terjedelem', TRUE);
    $data['sorozat'] = $this->input->post('sorozat', TRUE);
    $data['kozos_megj'] = $this->input->post('kozos_megj', TRUE);
    $data['peldany_megj'] = $this->input->post('peldany_megj', TRUE);
    $data['isbn'] = $this->input->post('isbn', TRUE);
    $data['kotes'] = $this->input->post('kotes', TRUE);
    $data['gyari_szam'] = $this->input->post('gyari_szam', TRUE);
    $data['nemzetkozi_azonosito'] = $this->input->post('nemzetkozi_azonosito', TRUE);
    $data['feltuntetett_ar'] = $this->input->post('feltuntetett_ar', TRUE);
    $data['beszerz_jegyz'] = $this->input->post('beszerz_jegyz', TRUE);
    $data['beszerz_mod'] = $this->input->post('beszerz_mod', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    $data['beszerzesi_ar'] = $this->input->post('beszerzesi_ar', TRUE);
    $data['targyszavak'] = $this->input->post('targyszavak', TRUE);
    $data['eto'] = $this->input->post('eto', TRUE);
    $data['targyi_mt'] = $this->input->post('targyi_mt', TRUE);
    $data['kozos_spec_adat'] = $this->input->post('kozos_spec_adat', TRUE);
    $data['saj_spec_adat'] = $this->input->post('saj_spec_adat', TRUE);
    $data['csz'] = $this->input->post('csz', TRUE);

    $data['cserear'] = $this->input->post('cserear', TRUE);
    $data['cserear_datuma'] = $this->input->post('cserear_datuma', TRUE);
    $data['nem_kolcsonzesre'] = $this->input->post('nem_kolcsonzesre', TRUE);
    $data['elveszett_elem'] = $this->input->post('elveszett_elem', TRUE);
    $data['tartalekok'] = $this->input->post('tartalekok', TRUE);
    $data['melleklet_1'] = $this->input->post('melleklet_1', TRUE);
    $data['melleklet_2'] = $this->input->post('melleklet_2', TRUE);
    $data['melleklet_3'] = $this->input->post('melleklet_3', TRUE);
    $data['url'] = $this->input->post('url', TRUE);

    $data['borito'] = $this->input->post('borito', TRUE);
    return $data;

}
/*
function truncate(){
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    
    $this->_truncate();
    redirect(base_url().'bibliografiak/manage/20/');
}
*/
function truncate(){
    $this->load->module('site_security');
    $this->load->model('mdl_bibliografiak');

    if($this->site_security->_get_user_type() == "admin"){
        $this->mdl_bibliografiak->_truncate();
    }
}

function get($order_by)
{
    $this->load->model('mdl_bibliografiak');
    $query = $this->mdl_bibliografiak->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bibliografiak');
    $query = $this->mdl_bibliografiak->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bibliografiak');
    $query = $this->mdl_bibliografiak->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_bibliografiak');
    $query = $this->mdl_bibliografiak->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_bibliografiak');
    $this->mdl_bibliografiak->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bibliografiak');
    $this->mdl_bibliografiak->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_bibliografiak');
    $this->mdl_bibliografiak->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_bibliografiak');
    $count = $this->mdl_bibliografiak->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_bibliografiak');
    $max_id = $this->mdl_bibliografiak->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_bibliografiak');
    $query = $this->mdl_bibliografiak->_custom_query($mysql_query);
    return $query;
}

}