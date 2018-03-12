<?php
class Mail_service extends MX_Controller 
{

function __construct() {
parent::__construct();
}
function config()
{
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'attilamajor1997@gmail.com';
    $config['smtp_pass'] = 'ryEPNfgj01ooQ7zy';  //sender's password
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8'; //iso-8859-1
    $config['wordwrap'] = 'TRUE';
    $config['newline'] = "\r\n"; 
    return $config;  
}

function send_email_for_everyone()
{
    $this->load->module('hirlevelek');
    $query = $this->hirlevelek->get_where_custom('aktiv','Y');

    foreach ($query->result() as $row) {
        $this->send_email($row->email);
    }

    $this->load->module('felhasznalok');
    $query = $this->felhasznalok->get_where_custom('statusz','aktiv');

    foreach ($query->result() as $row) {
        $this->send_email($row->email);
    }
}

function send_email($email = null)
{
    $config = $this->config();
    $this->load->library('email', $config);

    $this->email->initialize($config);

    $emailfrom = 'attilamajor1997@gmail.com'; //$this->session->userdata('email');
    $emailto = empty($email)?$this->input->post('emailto', TRUE):$email;
    $subject = $this->input->post('subject', TRUE);
    $message = $this->input->post('message', TRUE);

    $this->email->from($emailfrom, 'KossuthKönyvtár');
    $this->email->to($emailto); 

    $this->email->subject($subject);
    $this->email->message($message);  

    $this->email->send();

    echo $this->email->print_debugger();

    //$this->load->view('email_view');

}

function reg_mail($email,$code)
{
    $config = $this->config();
    $this->load->library('email', $config);

    $this->email->initialize($config);

    $emailfrom = "reg17@sys.com";
    $emailto = $email;
    $subject = "Regisztrálás - KossuthKönyvtár";
    $message = "
    <html>
    <body>
    <h4>Regisztrálás</h4>
    <p>A regisztráció érvényesítéséhez kattintson az alábbi linkre:</p>
    <a href='".base_url()."fiok/validate/".$code."'>".base_url()."fiok/validate/".$code."</a>
    </body>
    <html>
    ";

    $this->email->from($emailfrom, 'KossuthKönyvtár');
    $this->email->to($emailto); 

    $this->email->subject($subject);
    $this->email->message($message);  

    $this->email->send();

    //echo $this->email->print_debugger();

    //$this->load->view('email_view');

}

function send_custom($emailto, $subject, $message)
{
    $config = $this->config();
    $this->load->library('email', $config);

    $this->email->initialize($config);

    $emailfrom = "reg17@sys.com";

    $this->email->from($emailfrom, 'KossuthKönyvtár');
    $this->email->to($emailto); 

    $this->email->subject($subject);
    $this->email->message($message);  

    $this->email->send();
}

}