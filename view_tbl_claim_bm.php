<?php
include "koneksi.php"; // Load file koneksi.php

// echo "<pre>";
// print_r( $_POST);
// die;

$search = $_POST['search']['value']; 
$limit = $_POST['length']; 
$start = $_POST['start']; 
$start = $_POST['start']; 
$file_name = $_POST['file_name']; 
$upload_number = $_POST['upload_number']; 
$db = new koneksi();

// $query = "SELECT * FROM tbl_claim_data WHERE (cedant_clm_nbr LIKE '%".$search."%' OR insured_name LIKE '%".$search."%'  OR certificate_no LIKE '%".$search."%' ) ";
$query = "select * from tbl_claim_data a where a.file_name ='$file_name' and a.upload_number ='$upload_number' and (cedant_clm_nbr LIKE '%".$search."%' OR insured_name LIKE '%".$search."%'  OR certificate_no LIKE '%".$search."%' ) ";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY ID ".$order_ascdesc;

$stro = $query.$order." LIMIT ".$limit." OFFSET ".$start;

$sql_data = $db->db_fetch_array($query.$order." LIMIT ".$limit." OFFSET ".$start); 
$sql_filter = $db->db_row_count($query); 


// echo "<pre>";
// echo "sql_filter= ";print_r($sql_filter);
// die;


$data = array(); 
$result = $sql_data['data']; 
$index = 0;
$no = $start + 1; 
foreach($result as $d){ 
    array_push($data, $d); 
    $data[$index]['no'] = $no; 
    $index++;
    $no++;

    // echo "<pre>";
    // print_r( $data);

}

$callback = array(
    'draw'=>$_POST['draw'], 
    'recordsTotal'=>$sql_filter['data'], 
    'recordsFiltered'=>$sql_filter['data'], 
    'data'=>$data
);



header('Content-Type: application/json');
echo json_encode($callback);
?>
