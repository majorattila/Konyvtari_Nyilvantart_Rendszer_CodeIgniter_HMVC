<?php
class Default_module extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function index(){
    //attempt to load content from web page
    $first_bit = trim($this->uri->segment(1));

    $this->load->module('weboldalak');
    $query = $this->weboldalak->get_where_custom('oldal_url', $first_bit);
    $num_rows = $query->num_rows();

    //get the website content
    if($num_rows>0){

        //we have found content!
        foreach ($query->result() as $row){
            $data['oldal_cim'] = $row->oldal_cim;
            $data['oldal_url'] = $row->oldal_url;
            $data['oldal_kulcsszavak'] = $row->oldal_kulcsszavak;
            $data['oldal_tartalom'] = $row->oldal_tartalom;
            $data['oldal_leiras'] = $row->oldal_leiras;
        }
    }else{

        //page not found
        $this->load->module('site_settings');
        $data['oldal_tartalom'] = nl2br($this->site_settings->_page_not_found());
    }

    $this->load->module('templates');
    $this->templates->public_template($data);
}//end of index

}