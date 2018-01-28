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
    $config['smtp_pass'] = 'QTSVTFGgyB7';  //sender's password
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8'; //iso-8859-1
    $config['wordwrap'] = 'TRUE';
    $config['newline'] = "\r\n"; 
    return $config;  
}

function send_email()
{
    $config = $this->config();
    $this->load->library('email', $config);

    $this->email->initialize($config);

    $emailfrom = $this->session->userdata('email');
    $emailto = $this->input->post('emailto', TRUE);
    $subject = $this->input->post('subject', TRUE);
    $message = $this->input->post('message', TRUE);

    $this->email->from($emailfrom, 'HACKER');
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

    $this->email->from($emailfrom, 'robot');
    $this->email->to($emailto); 

    $this->email->subject($subject);
    $this->email->message($message);  

    $this->email->send();

    //echo $this->email->print_debugger();

    //$this->load->view('email_view');

}

}