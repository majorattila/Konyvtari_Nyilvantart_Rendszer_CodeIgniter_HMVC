<?php
class Tagok extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('form_validation');
$this->form_validation->CI =& $this;
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

function _delete_with_constrait($update_id)
{
    $tagok_adatai_id = $this->get_field_from_member_id($update_id,'tagok_adatai_id');
    $tagsagi_id = $this->get_field_from_member_id($update_id,'tagsagi_id');

    $mysql_query = "DELETE FROM biblioteka.tagok WHERE id = ?";
    $query = $this->db->query($mysql_query, array($update_id));
    
    $mysql_query = "DELETE FROM biblioteka.tagok_adatai WHERE id = ?";
    $query = $this->db->query($mysql_query, array($tagok_adatai_id));

    $mysql_query = "DELETE FROM biblioteka.tagsagi WHERE id = ?";
    $query = $this->db->query($mysql_query, array($tagsagi_id));
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
        redirect(base_url().'tagok/create/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $this->_delete_with_constrait($update_id);
    } 

    $flash_msg = "A tagat sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'tagok/manage/20');
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

    $data['headline'] = "Tag törlése";

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function fetch_data_form_post()
{
    $data['olvasojegy'] = $this->input->post('olvasojegy', TRUE);
    $data['vezeteknev'] = $this->input->post('vezeteknev', TRUE);
    $data['keresztnev'] = $this->input->post('keresztnev', TRUE);
    $data['szuletesi_datum'] = $this->input->post('szuletesi_datum', TRUE);
    $data['lakcim'] = $this->input->post('lakcim', TRUE);
    $data['szemelyigazolvany'] = $this->input->post('szemelyigazolvany', TRUE);
    $data['otthoni_telefon'] = $this->input->post('otthoni_telefon', TRUE);
    $data['munkahelyi_telefon'] = $this->input->post('munkahelyi_telefon', TRUE);
    $data['email'] = $this->input->post('email', TRUE);
    $data['konyvtarak'] = $this->input->post('konyvtarak', TRUE);
    $data['tagsag_kezdete'] = $this->input->post('tagsag_kezdete', TRUE);
    $data['mettol_ervenyes'] = $this->input->post('mettol_ervenyes', TRUE);
    $data['meddig_ervenyes'] = $this->input->post('meddig_ervenyes', TRUE);
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
        $data['tagsagi_id'] = $row->tagsagi_id;
        $data['tagok_adatai_id'] = $row->tagok_adatai_id;
        $data['olvasojegy'] = $row->olvasojegy;
        $data['vezeteknev'] = $row->vezeteknev;
        $data['keresztnev'] = $row->keresztnev;
        $data['szuletesi_datum'] = $row->szuletesi_datum;
        $data['lakcim'] = $row->lakcim;
        $data['szemelyigazolvany'] = $row->szemelyigazolvany;
        $data['otthoni_telefon'] = $row->otthoni_telefon;
        $data['munkahelyi_telefon'] = $row->munkahelyi_telefon;
        $data['email'] = $row->email;
        $data['konyvtarak'] = $row->nev;
        $data['tagsag_kezdete'] = $row->tagsag_kezdete;
        $data['mettol_ervenyes'] = $row->mettol_ervenyes;
        $data['meddig_ervenyes'] = $row->meddig_ervenyes;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}

function fetch_data_from_kolcsonzesek_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect(base_url().'site_security/not_allowed');
    }

    $mysql_query = "SELECT * FROM biblioteka.kolcsonzesek INNER JOIN biblioteka.kolcsonzesek_has_tagok ON(biblioteka.kolcsonzesek_has_tagok.kolcsonzesek_id = biblioteka.kolcsonzesek.id) WHERE biblioteka.kolcsonzesek_has_tagok.kolcsonzesek_id = $update_id";

    $query = $this->_custom_query($mysql_query);
    foreach($query->result() as $row)
    {
        $data['leltari_szam'] = $row->leltari_szam;
        $data['datum'] = $row->datum;
        $data['visszahozta'] = $row->visszahozta;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}

function fetch_data_from_kolcsonzesek_post()
{
    $data['leltari_szam'] = $this->input->post('leltari_szam', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    $data['visszahozta'] = $this->input->post('visszahozta', TRUE);
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

function _kolcsonzesek_insert($data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "INSERT INTO biblioteka.kolcsonzesek (leltari_szam, datum) VALUES (?,?)";
    $this->db->query($mysql_query ,array($data['leltari_szam'], $data['datum']));
}

function _kolcsonzesek_has_tagok_insert($user_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT max(id) as id FROM biblioteka.kolcsonzesek";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();

    $kolcsonzesek_id = $row->id;
    $tagok_id = $user_id;

    $mysql_query = "INSERT INTO biblioteka.kolcsonzesek_has_tagok (tagok_id, kolcsonzesek_id) VALUES (?,?)";
    $this->db->query($mysql_query ,array($tagok_id, $kolcsonzesek_id));
}

function _kolcsonzesek_update($user_id, $update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    
    $mysql_query = "UPDATE biblioteka.kolcsonzesek SET leltari_szam = ?, datum = ?, visszahozta = ? WHERE id = ?";
    $this->db->query($mysql_query ,array($data['leltari_szam'], $data['datum'], $data['visszahozta'], $update_id));
}

/*
function _kolcsonzesek_has_tagok_update($user_id, $update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT max(id) as id FROM biblioteka.kolcsonzesek";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();

    $kolcsonzesek_id = $row->id;
    $tagok_id = $user_id;

    $mysql_query = "UPDATE biblioteka.kolcsonzesek_has_tagok SET tagok_id = ?, kolcsonzesek_id = ? WHERE kolcsonzesek_id = ? AND tagok_id = ?";
    $this->db->query($mysql_query ,array($tagok_id, $kolcsonzesek_id, $user_id, $update_id));
}
*/

function process_of_delete_book_rental($user_id, $update_id)
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
        redirect(base_url().'tagok/kolcsonzes_create/'.$user_id.'/'.$update_id);
    }
    elseif($submit=="Yes - Delete Collection")
    {
        $mysql_query = "DELETE FROM biblioteka.kolcsonzesek_has_tagok WHERE tagok_id = ? AND kolcsonzesek_id = ? ";
        $this->db->query($mysql_query, array($user_id, $update_id));
     
        $mysql_query = "DELETE FROM biblioteka.kolcsonzesek WHERE id = ?";
        $this->db->query($mysql_query, array($update_id));
    } 

    $flash_msg = "A tagat sikeresen eltávolította.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);   

    redirect(base_url().'tagok/kolcsonzesek/'.$user_id);
}

function delete_book_rental($user_id, $update_id)
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
    $data['view_file'] = "delete_book_rental";
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
        redirect(base_url().'tagok/kolcsonzesek/'.$user_id);
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
            $data = $this->fetch_data_from_kolcsonzesek_post();
            
            //$data['datum'] = str_replace(". ", "-", $data['datum']);

            if(!empty($data['datum'])){
                $data['datum'] = str_replace(". ", "-", $data['datum']);
            }

            if(!empty($data['visszahozta'])){
                $data['visszahozta'] = str_replace(". ", "-", $data['visszahozta']);
            }else{
                $data['visszahozta'] = null;
            }

            if(is_numeric($update_id))
            {
                //update the item details
                
                $this->_kolcsonzesek_update($user_id, $update_id, $data);
                //$this->_kolcsonzesek_has_tagok_update($user_id, $update_id, $data);

                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'tagok/kolcsonzes_create/'.$user_id.'/'.$update_id);
            }
            else
            {
                //insert a new item                
                $this->_kolcsonzesek_insert($data);
                $this->_kolcsonzesek_has_tagok_insert($user_id, $data);

                $mysql_query = "SELECT max(kolcsonzesek_id) as max_id FROM biblioteka.kolcsonzesek_has_tagok";
                $query = $this->_custom_query($mysql_query);
                $row = $query->row();
                $update_id = $row->max_id;
              
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'tagok/kolcsonzesek/'.$user_id);
            }
        }
    }

    if(is_numeric($update_id))
    {
        $data = $this->fetch_data_from_kolcsonzesek_db($update_id);
        if($data == "")
        {
            $data = $this->fetch_data_from_kolcsonzesek_post();
        }
    }
    else
    {
        $data = $this->fetch_data_from_kolcsonzesek_post();
    }

    $data['flash'] = $this->session->flashdata('item');
    $data['headline'] = "Kölcsönzések";
    $data['user_id'] = $user_id;
    $data['update_id'] = $update_id;
    $data['view_file'] = "booking";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function kolcsonzesek($update_id)
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

    $query = "SELECT kolcsonzesek_has_tagok.kolcsonzesek_id, tagok_adatai.vezeteknev, tagok_adatai.keresztnev, bibliografiak.cim, kolcsonzesek.datum, kolcsonzesek.visszahozta FROM biblioteka.kolcsonzesek_has_tagok INNER JOIN biblioteka.kolcsonzesek ON (biblioteka.kolcsonzesek.id = biblioteka.kolcsonzesek_has_tagok.kolcsonzesek_id) INNER JOIN biblioteka.bibliografiak ON (biblioteka.bibliografiak.leltari_szam = biblioteka.kolcsonzesek.leltari_szam) INNER JOIN biblioteka.tagok ON(biblioteka.tagok.id = biblioteka.kolcsonzesek_has_tagok.tagok_id)  INNER JOIN biblioteka.tagok_adatai ON(biblioteka.tagok_adatai.id = biblioteka.tagok.tagok_adatai_id) WHERE biblioteka.kolcsonzesek_has_tagok.tagok_id = $update_id";
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
    $data['headline'] = "Kölcsönzések";
    $data['view_file'] = "kolcsonzesek";
    $this->load->module('templates');
    $this->templates->admin_template($data);
}

function check_konyvtar($val)
{
    $str = $this->input->post('konyvtarak', TRUE);
    $mysql_query = "SELECT * FROM biblioteka.konyvtarak WHERE nev LIKE ?";
    $query = $this->db->query($mysql_query, array($str));
    $num_rows = $query->num_rows();
    
    if ($num_rows == 0)
    {
        $this->form_validation->set_message('check_konyvtar', 'A {field} mező értéke nem található meg a könyvtárak táblában.');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}

private function _tagsagi_insert($data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    $mysql_query = "INSERT INTO biblioteka.tagsagi (fiok_id, tagsag_kezdete, mettol_ervenyes, meddig_ervenyes) VALUES (?,?,?,?)";
    $this->db->query($mysql_query ,array($data['fiok_id'],$data['tagsag_kezdete'],$data['mettol_ervenyes'],$data['meddig_ervenyes']));
}
private function _tagok_adatai_insert($data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();
    $mysql_query = "INSERT INTO biblioteka.tagok_adatai (olvasojegy, vezeteknev, keresztnev, szuletesi_datum, lakcim, szemelyigazolvany, otthoni_telefon, munkahelyi_telefon, email) VALUES (?,?,?,?,?,?,?,?,?)";
    $this->db->query($mysql_query ,array($data['olvasojegy'], $data['vezeteknev'], $data['keresztnev'], $data['szuletesi_datum'], $data['lakcim'], $data['szemelyigazolvany'], $data['otthoni_telefon'], $data['munkahelyi_telefon'], $data['email']));
}
private function _tagok_insert($data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT max(id) as tagsagi_id FROM biblioteka.tagsagi";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    $tagsagi_id = $row->tagsagi_id;

    $mysql_query = "SELECT max(id) as tagok_adatai_id FROM biblioteka.tagok_adatai";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    $tagok_adatai_id = $row->tagok_adatai_id;

    $mysql_query = "INSERT INTO biblioteka.tagok (tagsagi_id, tagok_adatai_id) VALUES (?,?)";
    $this->db->query($mysql_query ,array($tagsagi_id, $tagok_adatai_id));
}

private function _tagsagi_update($update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->get_field_from_member_id($update_id,'tagsagi_id');

    $mysql_query = "UPDATE biblioteka.tagsagi SET fiok_id = ?, tagsag_kezdete = ?, mettol_ervenyes = ?, meddig_ervenyes = ? WHERE id = ?";
    $this->db->query($mysql_query ,array($data['fiok_id'],$data['tagsag_kezdete'],$data['mettol_ervenyes'],$data['meddig_ervenyes'], $update_id));
}
private function _tagok_adatai_update($update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->get_field_from_member_id($update_id,'tagok_adatai_id');

    $mysql_query = "UPDATE biblioteka.tagok_adatai SET olvasojegy = ?, vezeteknev = ?, keresztnev = ?, szuletesi_datum = ?, lakcim = ?, szemelyigazolvany = ?, otthoni_telefon = ?, munkahelyi_telefon = ?, email = ? WHERE id = ?";
    $this->db->query($mysql_query ,array($data['olvasojegy'], $data['vezeteknev'], $data['keresztnev'], $data['szuletesi_datum'], $data['lakcim'], $data['szemelyigazolvany'], $data['otthoni_telefon'], $data['munkahelyi_telefon'], $data['email'], $update_id));
}
private function _tagok_update($update_id, $data)
{
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $mysql_query = "SELECT max(id) as tagsagi_id FROM biblioteka.tagsagi";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    $tagsagi_id = $row->tagsagi_id;

    $mysql_query = "SELECT max(id) as tagok_adatai_id FROM biblioteka.tagok_adatai";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    $tagok_adatai_id = $row->tagok_adatai_id;

    $mysql_query = "UPDATE biblioteka.tagok SET tagsagi_id = ?, tagok_adatai_id = ? WHERE id = ?";
    $this->db->query($mysql_query ,array($tagsagi_id, $tagok_adatai_id, $update_id));
}

function get_field_from_member_id($update_id, $field_name)
{
    $mysql_query = "SELECT $field_name FROM biblioteka.tagok WHERE id = ?";
    $query = $this->db->query($mysql_query, array($update_id));
    $row = $query->row();
    $field = $row->$field_name;

    return $field;
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

function olvasojegy()
{
    $mysql_query = "SELECT max(olvasojegy) as olvasojegy FROM biblioteka.tagok_adatai";
    $query = $this->_custom_query($mysql_query);
    $row = $query->row();
    $olvasojegy = $row->olvasojegy;
    if(!empty($olvasojegy))
    {
        $olvasojegy = $olvasojegy+1;
    }
    else
    {
        $olvasojegy = "5531200000000";
    }
    return $olvasojegy;
}

private function get_konyvtar_from_id($fiok_id)
{
    $mysql_query = "SELECT fiok_id FROM biblioteka.konyvtarak WHERE nev LIKE ?";
    $query = $this->db->query($mysql_query,array($fiok_id));
    $row = $query->row();
    $fiok_id = $row->fiok_id;

    return $fiok_id;
}

function create()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Cancel"){
        redirect(base_url().'tagok/manage/20');
    }
    else if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('olvasojegy', 'Olvasójegy', 'required');
        $this->form_validation->set_rules('vezeteknev', 'Vezeteknév', 'required');
        $this->form_validation->set_rules('keresztnev', 'Keresztnév', 'required');
        $this->form_validation->set_rules('szuletesi_datum', 'Születési Dátum', 'required');
        $this->form_validation->set_rules('lakcim', 'Lakcím', 'required');
        $this->form_validation->set_rules('szemelyigazolvany', 'Személyigazolvány', 'required');
        $this->form_validation->set_rules('konyvtarak', 'Fiók (könyvtár)', 'required|callback_check_konyvtar');
        $this->form_validation->set_rules('tagsag_kezdete', 'Tagság Kezdete', 'required');
        $this->form_validation->set_rules('mettol_ervenyes', 'Mettől Érvényes', 'required');
        $this->form_validation->set_rules('meddig_ervenyes', 'Meddig Érvényes', 'required');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_form_post();
            $data['szuletesi_datum'] = str_replace(". ", "-", $data['szuletesi_datum']);
            $data['tagsag_kezdete'] = str_replace(". ", "-", $data['tagsag_kezdete']);
            $data['mettol_ervenyes'] = str_replace(". ", "-", $data['mettol_ervenyes']);
            $data['meddig_ervenyes'] = str_replace(". ", "-", $data['meddig_ervenyes']);
            $data['fiok_id'] = $this->get_konyvtar_from_id($data['konyvtarak']);

            if(is_numeric($update_id))
            {
                //update the item details
                
                $this->_tagsagi_update($update_id, $data);
                $this->_tagok_adatai_update($update_id, $data);
                $this->_tagok_update($update_id, $data);

                $flash_msg = "Az elemet sikeresen módosította.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'tagok/create/'.$update_id);
            }
            else
            {
                //insert a new item                
                $this->_tagsagi_insert($data);
                $this->_tagok_adatai_insert($data);
                $this->_tagok_insert($data);

                $update_id = $this->get_max(); // get te ID of the new accounts                
                $flash_msg = "Az elemet sikeresn hozzáadta.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect(base_url().'tagok/create/'.$update_id);
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
        $data['olvasojegy'] = $this->olvasojegy();        
        $data['tagsag_kezdete'] = date('Y-m-d');
        $data['mettol_ervenyes'] = date('Y-m-d');
        $years=date_create(date('Y-m-d'));
        date_add($years,date_interval_create_from_date_string("1 years"));
        $data['meddig_ervenyes'] = date_format($years,"Y-m-d");
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új tag hozzáadása";
    }
    else
    {
        $data['headline'] = "Tag módosítása";
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


    $query ="SELECT * FROM biblioteka.tagok_view ORDER BY tagsag_kezdete";
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
    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_Tagok');
    $this->mdl_Tagok->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Tagok');
    $this->mdl_Tagok->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_Tagok');
    $this->mdl_Tagok->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_Tagok');
    $count = $this->mdl_Tagok->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_Tagok');
    $max_id = $this->mdl_Tagok->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_Tagok');
    $query = $this->mdl_Tagok->_custom_query($mysql_query);
    return $query;
}


function autogen()
{
    $mysql_query = "SHOW COLUMNS FROM tagok_view";
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