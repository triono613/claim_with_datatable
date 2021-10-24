<?php
include "koneksi.php"; 

$search = $_POST['search']['value']; 
$limit = $_POST['length']; 
$start = $_POST['start']; 
// $file_name = $_POST['file_name']; 
// $upload_number = $_POST['upload_number'];


$db = new koneksi();

$sql = "select id from tbl_claim_check_result order by id ";
$cc= $db->db_row_count($sql);



// $query = "SELECT * FROM tbl_claim_check_result WHERE (claim_insd_name LIKE '%".$search."%' OR claim_policy_no LIKE '%".$search."%'  OR claim_certificate_no LIKE '%".$search."%' )";
$query = "select file_name from tbl_claim_check_result WHERE claim_insd_name LIKE '%".$search."%' OR claim_policy_no LIKE '%".$search."%'  OR claim_certificate_no LIKE '%".$search."%'  group by 1 ";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY file_name ".$order_ascdesc;

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
