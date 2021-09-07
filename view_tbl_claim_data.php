<?php
include "koneksi.php"; // Load file koneksi.php

$search = $_POST['search']['value']; 
$limit = $_POST['length']; 
$start = $_POST['start']; 
$db = new koneksi();

$sql = "select id from tbl_claim_data order by id ";
$cc= $db->db_row_count($sql);

$query = "SELECT * FROM tbl_claim_data WHERE (cedant_clm_nbr LIKE '%".$search."%' OR insured_name LIKE '%".$search."%'  OR certificate_no LIKE '%".$search."%' )";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY ID ".$order_ascdesc;

$stro = $query.$order." LIMIT ".$limit." OFFSET ".$start;

$sql_data = $db->db_fetch_array($query.$order." LIMIT ".$limit." OFFSET ".$start); 
$sql_filter = $db->db_row_count($query); 


$data = array(); 
$result = $sql_data['data']; 
$index = 0;
$no = $start + 1; 
foreach($result as $d){ 
    array_push($data, $d); 
    $data[$index]['no'] = $no; 
    $index++;
    $no++;
}



$callback = array(
    'draw'=>$_POST['draw'], 
    'recordsTotal'=>$cc['data'], 
    'recordsFiltered'=>$sql_filter['data'], 
    'data'=>$data
);


header('Content-Type: application/json');
echo json_encode($callback);
?>
