<?php
include "koneksi.php"; 

$search = $_POST['search']['value']; 
$limit = $_POST['length']; 
$start = $_POST['start']; 

$db = new koneksi();

$query = "SELECT * FROM tbl_treaty WHERE (source_name LIKE '%".$search."%'  OR ceding_name LIKE '%".$search."%' OR no_contract LIKE '%".$search."%'  OR insured_name LIKE '%".$search."%' )";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY ID ".$order_ascdesc;

$stro = $query.$order." LIMIT ".$limit." OFFSET ".$start;

$sql_data = $db->db_fetch_array($query.$order." LIMIT ".$limit." OFFSET ".$start); 
$sql_filter = $db->db_row_count($query); 

$sqlCount = "select count(*) from tbl_treaty ";
$dataCount= $db->db_fetch_obj($sqlCount);


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
    'recordsTotal'=>$dataCount['data']['count'], 
    'recordsFiltered'=>$dataCount['data']['count'], 
    'data'=>$data

);

header('Content-Type: application/json');
echo json_encode($callback); // Convert array $callback ke json
?>
