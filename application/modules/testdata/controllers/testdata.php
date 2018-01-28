<?php
class Testdata extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function hash_book_gen()
{
    http://gen.lib.rus.ec/book/bibtex.php?md5=9B79D355B4D11F735C9257773061F54A
}

function gen_tables()
{
    $query = $this->db->query("
    SELECT TABLE_NAME 
    FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='biblioteka'
    ");

    foreach ($query->result() as $row) {
        echo $row->TABLE_NAME."<br/>";
        $fh = fopen('testdata/'.$row->TABLE_NAME.'.txt', 'w');
        $con = @mysql_connect("localhost:3404","root","");
        @mysql_select_db("biblioteka", $con);

        /* insert field values into data.txt */

        $result = @mysql_query("SELECT * FROM ".$row->TABLE_NAME);   
        while ($row = @mysql_fetch_array($result)) {          
            $num = @mysql_num_fields($result) ;    
            $last = $num - 1;
            for($i = 0; $i < $num; $i++) {            
                fwrite($fh, $row[$i]);                       
                if ($i != $last) {
                    fwrite($fh, ";");
                }
            }                                                                 
            fwrite($fh, "\n");
        }
        fclose($fh);
    }

    
}

/*
function get($order_by)
{
    $this->load->model('mdl_perfectcontroller');
    $query = $this->mdl_perfectcontroller->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectcontroller');
    $query = $this->mdl_perfectcontroller->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectcontroller');
    $query = $this->mdl_perfectcontroller->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_perfectcontroller');
    $query = $this->mdl_perfectcontroller->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_perfectcontroller');
    $this->mdl_perfectcontroller->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectcontroller');
    $this->mdl_perfectcontroller->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectcontroller');
    $this->mdl_perfectcontroller->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_perfectcontroller');
    $count = $this->mdl_perfectcontroller->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_perfectcontroller');
    $max_id = $this->mdl_perfectcontroller->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_perfectcontroller');
    $query = $this->mdl_perfectcontroller->_custom_query($mysql_query);
    return $query;
}
*/
}