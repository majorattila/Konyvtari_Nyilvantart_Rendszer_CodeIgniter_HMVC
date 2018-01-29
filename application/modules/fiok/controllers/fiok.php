<?php
class Fiok extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('form_validation');
$this->form_validation->CI =& $this;
}
/*
function g_login_success()
{
    $data['view_file'] = "welcome";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function config()
{
    require_once("./GoogleAPI/vendor/autoload.php");
    $this->gClient = new Google_Client();
    $this->gClient->setClientId("288578857674-vjmq13egnmcn0os6pcq71m2quvp31bog.apps.googleusercontent.com");
    $this->gClient->setClientSecret("GUHiVoMAYeriE78GRZ0cyQe3");
    $this->gClient->setApplicationName("Biblioteka");
    $this->gClient->setRedirectUri("http://localhost:8089/biblioteka/fiok/g_callback");
    $this->gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
}

function g_callback()
{
    $code = $this->input->get('code', TRUE);
    if (!is_null($this->session->userdata('access_token')))
        $this->gClient->setAccessToken($this->session->userdata('access_token'));
    else if (!is_null($code)) {
        $token = $this->gClient->fetchAccessTokenWithAuthCode($code);
        $this->session->set_userdata('access_token', $token);
    } else {
        redirect(base_url().'fiok/login');
    }

    $oAuth = new Google_Service_Oauth2($this->gClient);
    $userData = $oAuth->userinfo_v2_me->get();

    $this->session->set_userdata('id', $userData['id']);
    $this->session->set_userdata('email', $userData['email']);
    $this->session->set_userdata('gender', $userData['gender']);
    $this->session->set_userdata('picture', $userData['picture']);
    $this->session->set_userdata('familyName', $userData['familyName']);
    $this->session->set_userdata('givenName', $userData['givenName']);

    redirect(base_url().'fiok/g_login_success');
}

function google_login()
{
    $this->load->module('templates');
    $data = $this->session->userdata('access_token');

    if(!is_null($data)){
        $data['view_file'] = "welcome";
    }else{
        $data['view_file'] = "google_login";
    }   
    $this->templates->public_template($data); 
}
*/

function profil_kep_ajax()
{
    $this->load->module('site_security');
    $user_id = $this->site_security->_get_user_id();
    $picture = $this->input->post('picture');

    $this->db->query('UPDATE biblioteka.felhasznalok SET profilkep = ? WHERE id = ?', array($picture, $user_id));
}

function profil()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $submit = $this->input->post('submit');

    if($submit == 'Submit'){

        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('vezeteknev', 'Vezetéknév', 'required'); 
        $this->form_validation->set_rules('keresztnev', 'Keresztnév', 'required');   
        $this->form_validation->set_rules('felhasznalonev', 'Felhasználónév', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('olvasojegy', 'Olvasójegy', 'required');

        if($this->form_validation->run() == TRUE)
        {

            $user_id = $this->site_security->_get_user_id();

            $vezeteknev = $this->input->post('vezeteknev', TRUE);
            $keresztnev = $this->input->post('keresztnev', TRUE);
            $felhasznalonev = $this->input->post('felhasznalonev', TRUE);
            //$email = $this->input->post('email', TRUE);
            $olvasojegy = $this->input->post('olvasojegy', TRUE);

            $this->db->query('UPDATE biblioteka.felhasznalok SET vezeteknev = ?, keresztnev = ?, felhasznalonev = ?, email = ?, olvasojegy = ? WHERE id = ?', array($vezeteknev, $keresztnev, $felhasznalonev, $email, $olvasojegy, $user_id));

            $flash_msg = "A felhasználói profilját sikeresen frissítette!";
            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('item', $value);
            redirect(base_url().'fiok/profil');
        }
    }  


    $profile_img = $this->session->userdata('profile_img');

    if(empty(trim($profile_img)))
    {
        $profile_img = "man-3.png";
    }

    $data['profile'] = $profile_img;    
    $data['email'] = $this->session->userdata('email');
    $data['library_card'] = $this->session->userdata('library_card');


    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "profil";

    $this->load->module('templates');
    if(isset($_SESSION['is_admin']) && is_numeric($_SESSION['is_admin'])){
        $this->templates->admin_template($data);
    }else{
        $data += array(
            'username' => $this->session->userdata('username'),
            'firstname' => $this->session->userdata('firstname'),
            'lastname' => $this->session->userdata('lastname')
        );

        $this->templates->public_template($data);
    }
}

function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['is_admin']);
    $this->load->module('site_cookies');
    $this->site_cookies->_destroy_cookie();
    redirect(base_url());
}

function welcome(){
    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "welcome";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function test1()
{
    $your_name = "David";
    $this->session->set_userdata('your_name', $your_name);
    echo "The session variable was set.";

    echo "<hr>";
    echo anchor('fiok/test2', 'Get (display) the session varable')."<br>";
    echo anchor('fiok/test3', 'Unset (destroy) the session varable')."<br>";
}

function test2()
{
    $your_name = $this->session->userdata('your_name');
    if($your_name!=""){
        echo "<h1>Hello $your_name</h1>";
    }else{
        echo "No session varable has been set for your_name";
    }

    echo "<hr>";
    echo anchor('fiok/test1', 'Set the session varable')."<br>";
    echo anchor('fiok/test3', 'Unset (destroy) the session varable')."<br>";
}

function test3()
{
    unset($_SESSION['your_name']);
    echo "The session variable was unset.";

    echo "<hr>";
    echo anchor('fiok/test1', 'Set the session varable')."<br>";
    echo anchor('fiok/test2', 'Get (display) the session varable')."<br>";
}

function login()
{
    //$data['loginURL'] = $this->gClient->createAuthUrl();
    $data['username'] = $this->input->post('username',TRUE);
    //$data['view_file'] = "view";
    $this->load->module('templates');
    $this->templates->login($data);
}

function submit_login()
{
    $this->load->module('felhasznalok');
    $this->load->module('site_security');
    $submit = $this->input->post('submit', TRUE);

    if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;   
        $this->form_validation->set_rules('username', 'Felhasználónév', 'required|callback_username_check'); 
        /*min_length[5]|max_length[60]*/   
        $this->form_validation->set_rules('pword', 'Jelszó', 'required'); /*min_length[7]|max_length[35]*/

        if($this->form_validation->run() == TRUE)
        {            
            //figure out the user id
            $col1 = 'felhasznalonev';
            $value1 = $this->input->post('username', TRUE);
            $col2 = 'email';
            $value2  = $this->input->post('username', TRUE);
            $query = $this->felhasznalok->get_with_double_condition($col1, $value1, $col2, $value2);
            $num_rows = $query->num_rows();
            foreach ($query->result() as $row) {
                $user_id = $row->id;
                $priority = $row->jogosultsag;
            }

            $remember = $this->input->post('remember', TRUE);
            if($remember=="remember-me"){
                $login_type = "longterm";
            }else{
                $login_type = "shortterm";               
            }

            $data['utolso_bejelentkezes'] = time();
            $this->felhasznalok->_update($user_id, $data);

            //send them to the private page
            $this->_in_you_go($user_id, $login_type, $priority);

        }else{
            $this->login();
            //echo validation_errors();
        }    
    }
}

function unique_email($val)
{
    $mysql_query = "SELECT * FROM biblioteka.felhasznalok WHERE email LIKE ?";
    $query = $this->db->query($mysql_query, array($val));
    $num_rows = $query->num_rows();

    if ($num_rows != 0)
    {
            $this->form_validation->set_message('unique_email', 'Ez az email cím már foglalt.');
            return FALSE;
    }
    else
    {
            return TRUE;
    }
}

function unique_felhasznalonev($val)
{
    $mysql_query = "SELECT * FROM biblioteka.felhasznalok WHERE felhasznalonev LIKE ?";
    $query = $this->db->query($mysql_query, array($val));
    $num_rows = $query->num_rows();

    if ($num_rows != 0)
    {
            $this->form_validation->set_message('unique_felhasznalonev', 'Ez a felhasználónév már foglalt.');
            return FALSE;
    }
    else
    {
            return TRUE;
    }
}

function submit(){
    /*
    foreach ($_POST as $key => $value) {        
        echo "key of $key has value of $value<br>";
        /* INVALID TYPE
        echo "key of ".$key." has value of ".$value."<br>";
        *//*
    }
    */

    $submit = $this->input->post('submit', TRUE);

    if($submit=="Submit")
    {
        //process the form
        $this->config->set_item('language', 'hungarian');
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;        
        $this->form_validation->set_rules('username1', 'Felhasználónév', 'required|min_length[7]|max_length[60]|callback_unique_felhasznalonev');/*|is_unique[felhasznalok.felhasznalonev]*/ 
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[120]|callback_unique_email');   
        $this->form_validation->set_rules('pword', 'Jelszó', 'required|min_length[7]|max_length[35]');
        $this->form_validation->set_rules('repeat_pword', 'Jelszó Ismétlése', 'required|matches[pword]');

        if($this->form_validation->run() == TRUE)
        {
            //get the variables
            $this->_process_create_account();

            $data['view_file'] = "account_created";
            $this->load->module('templates');
            $this->templates->public_template($data);

        }else{
            $this->start();
        }
    }else{
        $this->start();
    }
}

function _in_you_go($user_id, $login_type, $priority)
{
    $this->session->sess_expiration = '14400';// expires in 4 hours

    //NOTE: the login_type can be longterm or shortterm
    if($login_type=="longterm"){
        //set a cookie
        $this->load->module('site_cookies');
        $this->site_cookies->_set_cookie($user_id);

    }else{
        //set a session variable
        $this->session->set_userdata('user_id', $user_id);
    }
    
    if($priority == 'admin')
    {
        //set a session variable        
        $this->session->set_userdata('is_admin', '1');

        //send the usser to the private page
        redirect('dashboard/home');
    }
    else if($priority == 'user')
    {
        //send the usser to the private page
        redirect('fiok/welcome');
    }    
}

function _process_create_account(){

    $this->load->module("site_security");
    $this->load->module("mail_service");
    $this->load->module("felhasznalok");
    
    $data = $this->fetch_data_from_post();
    $data['felhasznalonev'] = $data['username1'];
    $data['reg_datuma'] = date('Y-m-d');
    unset($data['username1']);
    unset($data['pword']);
    unset($data['repeat_pword']);

    $code = base64_encode($data['email']);
    $this->mail_service->reg_mail($data['email'],str_replace("%3D%3D","",urlencode($code)));

    $pword = $this->input->post('pword', TRUE);    
    $data['jelszo'] = $this->site_security->_hash_string($pword);

    $this->felhasznalok->_insert($data);
}

function start()
{
    $this->load->module('konyvtarak');    

    $data = $this->fetch_data_from_post();
    $data['query'] = $this->konyvtarak->get('fiok_id');
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "start";
    $this->load->module('templates');
    $this->templates->public_template($data);
}

function validate($code)
{
    $this->load->module("felhasznalok");

    $ind = -1;

    $query = $this->db->query("SELECT id, email FROM biblioteka.felhasznalok");
    foreach ($query->result() as $row) {
        if(base64_decode($code) == $row->email)
        {
            $ind = $row->id;
        }
    }

    if($ind!=-1)
    {
        $data['statusz'] = "aktiv";
        $this->felhasznalok->_update($ind,$data);

        $data['code'] = $code;
        $data['view_file'] = "activated";
        $this->load->module('templates');
        $this->templates->public_template($data);
    }
}

function fetch_data_from_post(){
    $data['vezeteknev'] = $this->input->post('vezeteknev',TRUE);
    $data['keresztnev'] = $this->input->post('keresztnev',TRUE);
    $data['username1'] = $this->input->post('username1',TRUE);
    $data['email'] = $this->input->post('email',TRUE);
    $data['pword'] = $this->input->post('pword',TRUE);
    $data['repeat_pword'] = $this->input->post('repeat_pword',TRUE);

    $data['fiok_id'] = $this->input->post('fiok_konyvtar',TRUE);

    $hirlevel = $this->input->post('hirlevel',TRUE);
    if(!is_null($hirlevel)){
        $data['hirlevel'] = 1;
    }

    return $data;
}

function username_check($str)
{

    $this->load->module('felhasznalok');
    $this->load->module('site_security');

    $error_msg = "Nem adott meg helyes felhasználónevet és/vagy jelszót.";

    $col1 = 'felhasznalonev';
    $value1 = $str;
    $col2 = 'email';
    $value2  = $str;
    $query = $this->felhasznalok->get_with_double_condition($col1, $value1, $col2, $value2);
    $num_rows = $query->num_rows();

    if($num_rows<1){
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    }

    foreach ($query->result() as $row) {
        $pword_on_table = $row->jelszo;
        $statusz = $row->statusz;
    }
    $pword = $this->input->post('pword', TRUE);
    $result = $this->site_security->_verify_hash($pword, $pword_on_table);

    if($result == TRUE && $statusz == 'aktiv'){        
        return TRUE;
    }else{
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    }
    
    /*
    $item_url = url_title($str);
    $mysql_query = "select * from store_items where item_title='$str' and item_url='$item_url'";

    $update_id = $this->uri->segment(3);

    if(is_numeric($update_id))
    {
        //this is an update
        $mysql_query.= "and id!=$update_id";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();


    if($num_rows>0)
    {
        $this->form_validation->set_message('item_check', 'The item title that you submitted is not available');
        return FALSE;
    }
    else
    {
        return TRUE;
    }*/
}

}