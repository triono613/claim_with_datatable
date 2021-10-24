<?php
include "koneksi.php"; 

// echo "<pre>";
// echo "_POST= ";print_r( $_POST);
// die;

$search = $_POST['search']['value']; 
$limit = $_POST['length']; 
$start = $_POST['start']; 
$file_name = $_POST['file_name']; 
$validasi_date = $_POST['validasi_date']; 
$validasi_number = $_POST['validasi_number']; 
$db = new koneksi();



// $query = "SELECT * FROM tbl_claim_check_result WHERE (claim_insd_name LIKE '%".$search."%' OR claim_policy_no LIKE '%".$search."%'  OR claim_certificate_no LIKE '%".$search."%' )";
$query = "select * from tbl_claim_check_result a where a.file_name ='$_POST[file_name]' and (claim_insd_name LIKE '%".$search."%' OR claim_policy_no LIKE '%".$search."%'  OR claim_certificate_no LIKE '%".$search."%' ) ";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY ID ".$order_ascdesc;
$stro = $query.$order." LIMIT ".$limit." OFFSET ".$start;

// echo "<pre>";
// echo "stro= ";print_r( $stro);
// die;


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
    'recordsTotal'=>$sql_filter['data'], 
    'recordsFiltered'=>$sql_filter['data'], 
    'data'=>$data
);

header('Content-Type: application/json');
echo json_encode($callback); 
?>
