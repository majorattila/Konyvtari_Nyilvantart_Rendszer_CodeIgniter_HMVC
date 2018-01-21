<?php
class Site_security extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _click_counter(){
    $this->load->module('diagram_nezettseg');

    $query = $this->diagram_nezettseg->get_with_double_condition('ev', date("Y"), 'honap', date("m"));

    $latogatok_szama = 0;
    foreach ($query->result() as $row) {
        $latogatok_szama = $row->latogatok;
    }

    $data['latogatok'] = $latogatok_szama+1;
    $this->diagram_nezettseg->_update_with_double_condition('ev', date("Y"), 'honap', date("m"), $data);
    //die($this->db->last_query());
}

function _check_browser()
{
    $freegeoipjson = file_get_contents("http://freegeoip.net/json/");
    $jsondata = json_decode($freegeoipjson);

    $ip = $jsondata->ip;
    $browser = $this->get_browser_properties()['browser'];
    $orszag = $jsondata->country_name;
    $regio = $jsondata->region_name;

    $this->load->module("bongeszo_es_ipcim_lista");
    $data = $this->bongeszo_es_ipcim_lista->get_where_custom("ip",$ip);

    $browser_data["ip"] = $ip;
    $browser_data["bongeszo"] = $browser;
    $browser_data["orszag"] = $orszag;
    $browser_data["regio"] = $regio;    

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
            $this->bongeszo_es_ipcim_lista->_insert($browser_data);            
        }
    }
    else
    {
        $this->bongeszo_es_ipcim_lista->_insert($browser_data);
    } 
}

function _get_details_from_user()
{
    $this->load->module('felhasznalok');
    $user_id = $this->_get_user_id();

    if(is_numeric($user_id)){
        $query = $this->felhasznalok->get_where($user_id);
        foreach ($query->result() as $row) {
            //send the user data
            $this->session->set_userdata(
                array(
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
                'username' => 50,
                'profile_img' => 50,
                'lastname' => 50,            
                'firstname' => 50,
                'email' => 50,
                'library_card' => 50,
                'reg_date' => 50
            ));
            
        }
    }
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
    echo "Nem engedélyezett, hogy itt tartózkodj!";
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

function get_browser_properties(){
    $browser =array();
    $agent=$_SERVER['HTTP_USER_AGENT'];

    if(stripos($agent,"firefox")!==false){
        $browser['browser'] = 'Firefox'; // Set Browser Name
        $domain = stristr($agent, 'Firefox');
        $split =explode('/',$domain);
        $browser['version'] = $split[1]; // Set Browser Version
    }
    if(stripos($agent,"Opera")!==false){
        $browser['browser'] = 'Opera'; // Set Browser Name
        $domain = stristr($agent, 'Version');
        $split =explode('/',$domain);
        $browser['version'] = $split[1]; // Set Browser Version
    }
    if(stripos($agent,"MSIE")!==false){
        $browser['browser'] = 'Internet Explorer'; // Set Browser Name
        $domain = stristr($agent, 'MSIE');
        $split =explode(' ',$domain);
        $browser['version'] = $split[1]; // Set Browser Version
    }
    if(stripos($agent,"Trident")!==false){
        $browser['browser'] = 'Internet Explorer'; // Set Browser Name
        $domain = stristr($agent, 'rv:');
        $split =explode(')',$domain);
        $browser['version'] = substr($split[0],3,4); // Set Browser Version
    }
    if(stripos($agent,"Chrome")!==false){
        $browser['browser'] = 'Google Chrome'; // Set Browser Name
        $domain = stristr($agent, 'Chrome');
        $split1 =explode('/',$domain);
        $split =explode(' ',$split1[1]);
        $browser['version'] = $split[0]; // Set Browser Version
    }
    else if(stripos($agent,"Safari")!==false){
        $browser['browser'] = 'Safari'; // Set Browser Name
        $domain = stristr($agent, 'Version');
        $split1 =explode('/',$domain);
        $split =explode(' ',$split1[1]);
        $browser['version'] = $split[0]; // Set Browser Version
    }else{
        $browser['browser'] = "Unknown";
    }

    return $browser;
} 

}