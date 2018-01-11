<?php
class Custom_pagination extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _generate_pagination($data){

	//NOtE: for this to work, data must contain:
	//$template, $target_base_url, $total_rows, $offset_segment, $limit

	$template = $data['template'];
	$target_base_url = $data['target_base_url'];
	$total_rows = $data['total_rows'];
	$offset_segment = $data['offset_segment'];
	$limit = $data['limit'];

	if($template == "public_bootstrap"){
		$settings = $this->get_settings_for_public_bootstrap();
	}

    $this->load->library('pagination');

    $config['base_url'] = $target_base_url;
    $config['total_rows'] = $total_rows;
    $config['uri_segment'] = $offset_segment;

    $config['per_page'] = $limit;
    $config['num_links'] = $settings['num_links'];

    $config['full_tag_open'] = $settings['full_tag_open'];
    $config['full_tag_close'] = $settings['full_tag_close'];

    $config['cur_tag_open'] = $settings['cur_tag_open'];
    $config['cur_tag_close'] = $settings['cur_tag_close'];

    $config['num_tag_open'] = $settings['num_tag_open'];
    $config['num_tag_close'] = $settings['num_tag_close'];

    $config['first_link'] = $settings['first_link'];
    $config['first_tag_open'] = $settings['first_tag_open'];
    $config['first_tag_close'] = $settings['first_tag_close'];

    $config['last_link'] = $settings['last_link'];
    $config['last_tag_open'] = $settings['last_tag_open'];
    $config['last_tag_close'] = $settings['last_tag_close'];

    $config['prev_link'] = $settings['prev_link'];
    $config['prev_tag_open'] = $settings['prev_tag_open'];
    $config['prev_tag_close'] = $settings['prev_tag_close'];

    $config['next_link'] = $settings['next_link'];
    $config['next_tag_open'] = $settings['next_tag_open'];
    $config['next_tag_close'] = $settings['next_tag_close'];

    $this->pagination->initialize($config);
    $pagination = $this->pagination->create_links();
    return $pagination;
}

function get_showing_statement($data){
	//NOTE: for this to work, data should contain:
	//limit, offset, total_rows

	$limit = $data['limit'];
	$offset = $data['offset'];
	$total_rows = $data['total_rows'];

	$value1 = $offset+1;
	$value2 = $offset+$limit;
	$value3 = $total_rows;

	if($value2>$value3){
		$value2 = $value3;
	}

	$showing_statement = "Megjelenítve ".$value1." - ".$value2." a(z) ".$value3." eredményből.";
	return $showing_statement;
}

/*
<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
*/

function get_settings_for_public_bootstrap(){

    $settings['num_links'] = 12;

    $settings['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
    $settings['full_tag_close'] = '</ul></nav>';

    $settings['cur_tag_open'] = '<li class="active"><a href="#">';
    $settings['cur_tag_close'] = '</a></li>';
    //this mean current tag

    $settings['num_tag_open'] = '<li>';
    $settings['num_tag_close'] = '</li>';

    $settings['first_link'] = '<span aria-hidden="true">&laquo;</span>';
    $settings['first_tag_open'] = '<li>';
    $settings['first_tag_close'] = '</li>';

    $settings['last_link'] = '<span aria-hidden="true">&raquo;</span>';
    $settings['last_tag_open'] = '<li>';
    $settings['last_tag_close'] = '</li>';

    $settings['prev_link'] = '<span aria-hidden="true">&lsaquo;</span>';
    $settings['prev_tag_open'] = '<li>';
    $settings['prev_tag_close'] = '</li>';

    $settings['next_link'] = '<span aria-hidden="true">&rsaquo;</span>';
    $settings['next_tag_open'] = '<li>';
    $settings['next_tag_close'] = '</li>';

    return $settings;
}

/*
function get_settings_for_some_template($template){

	if($template == "bublic_bootstrap"){
		$settings = $this->settings->get_settings_public_bootstrap();
	}

    $this->load->library('pagination');
    $config['base_url'] = 'http://example.com/index.php/test/page/';
    $config['total_rows'] = 200;

    $config['num_links'] = '';

    $config['full_tag_open'] = '';
    $config['full_tag_close'] = '';

    $config['cur_tag_open'] = '';
    $config['cur_tag_close'] = '';

    $config['num_tag_open'] = '';
    $config['num_tag_close'] = '';

    $config['first_link'] = '';
    $config['first_tag_open'] = '';
    $config['first_tag_close'] = '';

    $config['last_link'] = '';
    $config['last_tag_open'] = '';
    $config['last_tag_close'] = '';

    $config['prev_link'] = '';
    $config['prev_tag_open'] = '';
    $config['prev_tag_close'] = '';

    $config['next_link'] = '';
    $config['next_tag_open'] = '';
    $config['next_tag_close'] = '';

    $this->pagination->initialize($config);
    $pagination = $this->pagination->create_links();
    return $pagination;
}
*/

}