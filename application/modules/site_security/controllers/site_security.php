<?php
class Site_security extends MX_Controller 
{

private $jsondata;

function __construct() {
parent::__construct();

    $freegeoipjson = file_get_contents("http://freegeoip.net/json/");
    $this->jsondata = json_decode($freegeoipjson);
}

function _get_user_id()
{

    //attempt to get the ID of the user

    //start by checking for a session variable
    $user_id = $this->session->userdata('user_id'); 

    if(!is_numeric($user_id)){
        //check for a valid cookie

        $this->load->module('site_cookies');
        $user_id = $this->site_cookies->_attempt_get_user_id();
    }

    return $user_id;
}

function _make_sure_logged_in()
{
    //make sure customer (member) is logged

    $user_id = $this->_get_user_id();
    if(!is_numeric($user_id)){
        redirect('fiok/login');
    }
}

function _hash_string($str){
    $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
        'cost' => 11
    ));
    return $hashed_string;
}

function _verify_hash($plain_text_str, $hash_string){
    $result = password_verify($plain_text_str, $hash_string);
    return $result; //TRUE or FLASE
}

function generate_random_string($length){
    //Egyéb kódok a generáláshoz:
    //$str = rand('stuff goes here');
    //$str = random_string([$type = 'alnum'[, $len = 8]]);

    //az: 1,l,O,o,0 kivételével az összes Pl R2D2 jó, de a C3PO nem
    $characters = '23456789abcdefghjkmnpqrtuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i=0; $i < $length; $i++) { 
        $randomString .= $characters[rand(0, strlen($characters)-1)];
    }
    return $randomString;
}

function _is_admin()
{
    
    $is_admin = $this->session->userdata('is_admin');
    if($is_admin==1){
        return TRUE;
    }else{
        redirect('site_security/not_allowed');
    }


    if($is_admin!=TRUE)
    {
        redirect('site_security/not_allowed');
    }
    
    return true;
}

function not_allowed()
{
    //echo "Nem engedélyezett, hogy itt tartózkodj!";
    $data['oldal_tartalom'] = nl2br('<div class="error-box"><div class="error-body text-center"><h1 style="font-size:113pt">405</h1><h3 class="text-uppercase">A kért oldalhoz nincs jogosultsága!</h3><p class="text-muted m-t-30 m-b-30">ÚGY TŰNIK A HAZVEZETŐ UTAT KERESED</p><a href="'.base_url().'" class="btn btn-primary btn-rounded waves-effect waves-light m-b-40">Vissza a főoldalra</a> </div></div>');
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function _check_admin_login_details($username, $password)
{
    $target_username = "admin";
    $target_pass = "password";

    if( ($username==$target_username) && ($password==$target_pass) ){
        return TRUE;
    }else{
        return FALSE;
    }
}

function get_browser_name()
{
    $this->load->module("browser_detect");    
    $this->browser_detect->detect();
    $name = $this->browser_detect->getBrowser();
    return $name;
}

function _click_counter(){
    $this->load->module('latogatok');
    $this->load->module('diagram_nezettseg');

    //get number of "latogatok"
    $query = $this->diagram_nezettseg->get_with_double_condition('ev', date("Y"), 'honap', date("m"));

    $latogatok_szama = 0;
    foreach ($query->result() as $row) {
        $latogatok_szama = $row->latogatok;
    }

    //check the currant user
    $ip = $this->get_ip();
    $longitude = $this->get_longitude();
    $latitude = $this->get_latitude();

    $query = $this->latogatok->get_where_custom_with_triple_condition("ip",$ip,"longitude",$longitude,"latitude",$latitude);
    
    //if the currant user is new, we will increase the number of the visitors
    if($query->num_rows() == 0)
    {
    $data['latogatok'] = $latogatok_szama+1;
    $this->diagram_nezettseg->_update_with_double_condition('ev', date("Y"), 'honap', date("m"), $data);
    }  
    //die($this->db->last_query());  
}

function get_ip()
{
    $ip = $this->jsondata->ip;
    return $ip;
}

function get_country_name()
{
    $country_name = $this->jsondata->country_name;
    return $country_name;
}

function get_region_name()
{
    $region_name = $this->jsondata->region_name;
    return $region_name;
}

function get_longitude()
{
    $longitude = $this->jsondata->longitude;
    return $longitude;
}

function get_latitude()
{
    $latitude = $this->jsondata->latitude;
    return $latitude;
}

function _check_browser()
{
    $ip = $this->get_ip();
    $browser = $this->get_browser_name();
    $orszag = $this->get_country_name();
    $regio = $this->get_region_name();
    $longitude = $this->get_longitude();
    $latitude = $this->get_latitude();

    $this->load->module("latogatok");
    $data = $this->latogatok->get_where_custom_with_triple_condition("ip",$ip,"longitude",$longitude,"latitude",$latitude);

    $browser_data["ip"] = $ip;
    $browser_data["bongeszo"] = $browser;
    $browser_data["orszag"] = $orszag;
    $browser_data["regio"] = $regio;    
    $browser_data["longitude"] = $longitude;
    $browser_data["latitude"] = $latitude;    

    if($data->num_rows() > 0)
    {
        $bool = false;

        foreach ($data->result() as $row) 
        {
            if($row->bongeszo != $browser)
            {
                $bool = true;
            }
        }

        if($bool)
        {
            $this->latogatok->_insert($browser_data);            
        }
    }
    else
    {
        $this->latogatok->_insert($browser_data);
    } 
}

function _get_details_from_user()
{
    //$this->session->sess_destroy();
    //$this->session->unset_userdata('email');
    
    $this->load->module('felhasznalok');
    $user_id = $this->_get_user_id();

    if(is_numeric($user_id)){
        $query = $this->felhasznalok->get_user_data($user_id);
        foreach ($query->result() as $row) {
            //send the user data
            $this->session->set_userdata(
                array(
                    'lib_id' => $row->fiok_id,
                    'username' => $row->felhasznalonev,
                    'profile_img' => $row->profilkep,
                    'lastname' => $row->vezeteknev,            
                    'firstname' => $row->keresztnev,
                    'email' => $row->email,
                    'library_card' => $row->olvasojegy,
                    'reg_date' => $row->reg_datuma
                )
            );
            //set the session variables expiration time to 1 minute
            
            $this->session->mark_as_temp(array(
                'lib_id' => 500,
                'username' => 500,
                'profile_img' => 500,
                'lastname' => 500,            
                'firstname' => 500,
                'email' => 500,
                'library_card' => 500,
                'reg_date' => 500
            ));
        }
    }
}

}