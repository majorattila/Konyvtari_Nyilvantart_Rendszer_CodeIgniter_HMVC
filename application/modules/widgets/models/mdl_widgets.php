<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_widgets extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_employees(){
    $query=$this->db->get('szemelyzet');
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_books(){
    $query=$this->db->get('bibliografiak');
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_user_registrations(){
    $query=$this->db->get('felhasznalok');
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_subscribers(){
    $query = $this->db->get('hirlevelek');
    $num_rows = $query->num_rows();
    return $num_rows;
}

}