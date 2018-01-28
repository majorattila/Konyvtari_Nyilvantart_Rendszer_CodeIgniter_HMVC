<?php
class Backup extends MX_Controller 
{

function __construct() {
parent::__construct();
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

function new_file_name($length)
{
    $this->load->module('site_security');
    echo $this->site_security->generate_random_string($length);
}

private function get_mysqli() { 
    $db = (array)get_instance()->db;
    return mysqli_connect('localhost', $db['username'], $db['password']);
}

function ajax_api($action = "insert")
{
    $id = $this->input->post('item', TRUE);
    if(!is_numeric($id) && $action == "delete")
    {
        die('Non-numeric variable!');
    }
    else
    {
        $drive = substr($_SERVER['DOCUMENT_ROOT'],0,1);

        if($action == "insert")
        {        
            $data = $this->fetch_data_form_post();
            if(!empty($data['fajl_nev'])){
                /*
                date_default_timezone_set('Europe/Budapest');
                $data['datum'] = date('Y-m-d H:i:s');
                */
                $this->_insert($data);

                exec("\"".$drive.":\\biblioteka-x64\\mariadb\\bin\\mysqldump.exe\" -h 127.0.0.1 -u root biblioteka > database/".$data['fajl_nev'].".sql");
            }
        }
        else if($action == "delete" && !is_null($id))
        {
            $query = $this->get_where($id);
            $file_name = "";

            foreach ($query->result() as $row) {
                $file_name = $row->fajl_nev;            
            }
            $path = "database/".$file_name.".sql";
            $this->_delete($id);

            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
/*
    else if($action == "use"){
        /+
        $string = "";
        $query = $this->db->query("SELECT GROUP_CONCAT(Concat('TRUNCATE TABLE ',table_schema,'.',TABLE_NAME) SEPARATOR ';') AS print FROM INFORMATION_SCHEMA.TABLES where table_schema in ('biblioteka') AND table_type LIKE 'BASE TABLE'");

        foreach ($query->result() as $row) {
            $string = $row->print;
        };

        $array = split(";", $string);
        foreach ($array as $key => $value) {
            //if (strpos($value, "view") !== false) {
                $query = $this->db->query($value);
            //}
        }
        
        exec("\"".$drive.":\\biblioteka-x64\\mariadb\\bin\\mysqldump.exe\" -u root biblioteka < \"G:/biblioteka-x64/apache/htdocs/biblioteka/database/5tFxGg9gDP5F.sql\"");
        +/
        $conn = $this->get_mysqli();

        $sql = '
        DROP DATABASE biblioteka;
        CREATE SCHEMA biblioteka;
        USE biblioteka;
        ';
/+
        $this->db->query("DROP DATABASE biblioteka");
        $this->db->query("CREATE SCHEMA biblioteka");
        $this->db->query("USE biblioteka");
+/
        $lines = file('database/5tFxGg9gDP5F.sql'); 
        foreach ($lines as $line)
        {
            $sql .= $line."\n";
        }

        //echo $sql;

        if ($conn->multi_query($sql) === TRUE) {
            echo "New records created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
/+
        // Set line to collect lines that wrap
        $templine = '';

        // Read in entire file
        $lines = file('database/5tFxGg9gDP5F.sql'); 

        // Loop through each line
        foreach ($lines as $line)
        {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
        continue;

        // Add this line to the current templine we are creating
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query so can process this templine
        if (substr(trim($line), -1, 1) == ';')
        {        
        // Perform the query
        $this->db->query($templine);

        // Reset temp variable to empty
        $templine = '';
        }
        }
/+
    }
*/

}

function fetch_data_form_post()
{
    $data['fiok_id'] = $this->input->post('fiok_id', TRUE);
    $data['szemelyzet_id'] = $this->input->post('szemelyzet_id', TRUE);
    $data['datum'] = $this->input->post('datum', TRUE);
    $data['fajl_nev'] = $this->input->post('fajl_nev', TRUE);
    return $data;

}

function fetch_data_from_db($update_id)
{

    if(!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach($query->result() as $row)
    {
        $data['fiok_id'] = $row->fiok_id;
        $data['szemelyzet_id'] = $row->szemelyzet_id;
        $data['datum'] = $row->datum;
        $data['fajl_nev'] = $row->fajl_nev;
    }

    if(!isset($data))
    {
        $data = "";
    }

    return $data;
}
function create()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_is_admin();

    if((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);
    }
    else
    {
        $data = $this->fetch_data_form_post();
    }

    if(!is_numeric($update_id))
    {
        $data['headline'] = "Új mentés";
    }
    else
    {
        $data['headline'] = "Módosítás";
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


    $query ="SELECT * FROM biblioteka.backup ORDER BY datum";
    $data['result_number'] = $this->_custom_query($query)->num_rows();

    $mysql_query = $this->_generate_mysql_query($query, $oldal_szam, $limit);
    $data['query'] = $this->_custom_query($mysql_query);

    $data['fiok_id'] = $this->session->userdata('lib_id');
    $data['szemelyzet_id'] = $this->session->userdata('user_id');

    date_default_timezone_set('Europe/Budapest');
    $data['datum'] = date('Y-m-d H:i:s');

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
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_backup');
    $this->mdl_backup->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $this->mdl_backup->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_backup');
    $this->mdl_backup->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_backup');
    $count = $this->mdl_backup->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_backup');
    $max_id = $this->mdl_backup->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_backup');
    $query = $this->mdl_backup->_custom_query($mysql_query);
    return $query;
}


function autogen()
{
    $mysql_query = "SHOW COLUMNS FROM backup";
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