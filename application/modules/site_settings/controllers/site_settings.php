<?php
class Site_settings extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _get_support_team_name()
{
    $name = "Customer Support";
    return $name;
}

function _get_item_segments(){
    //return the segments for the category pages
    $segments = "music/instruments/";
    return $segments;
}

function _get_cookie_name(){
    $cookie_name = 'hwefcdsdfhz';
    return $cookie_name;
}

function _page_not_found()
{
    return '<div class="error-box"><div class="error-body text-center"><h1 style="font-size:113pt">404</h1><h3 class="text-uppercase">A kért oldal nem található!</h3><p class="text-muted m-t-30 m-b-30">ÚGY TŰNIK A HAZVEZETŐ UTAT KERESED</p><a href="'.base_url().'" class="btn btn-primary btn-rounded waves-effect waves-light m-b-40">Vissza a főoldalra</a> </div></div>';
}

}