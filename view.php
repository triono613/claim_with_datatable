<?php
include "koneksi.php"; // Load file koneksi.php

$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
$limit = $_POST['length']; // Ambil data limit per page
$start = $_POST['start']; // Ambil data start

// $sql = $pdo->prepare("SELECT nis FROM siswa"); // Query untuk menghitung seluruh data siswa
// $sql->execute();

$db = new koneksi();


// echo "<pre>";
// print_r( $dataQuery );
// die;

// $sql = "select count(*) from tbl_insured ";
// $cc= $db->db_row_count($sql);

 // print_r( $cc);
 // die;

// if( empty($search) ){
	// $search = null;
// }

$query = "SELECT * FROM tbl_insured WHERE (source LIKE '%".$search."%'  OR certificate_no LIKE '%".$search."%'  OR name_of_insured LIKE '%".$search."%' )";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
// $order = " ORDER BY ".$order_field." ".$order_ascdesc;
$order = " ORDER BY ID ".$order_ascdesc;

$stro = $query.$order." LIMIT ".$limit." OFFSET ".$start;

$sql_data = $db->db_fetch_array($query.$order." LIMIT ".$limit." OFFSET ".$start); 
$sql_filter = $db->db_row_count($query); 

$sqlCount = "select count(*) from tbl_insured ";
$dataCount= $db->db_fetch_obj($sqlCount);

// echo "<pre>";
// echo "dataCount= ";
// print_r( $dataCount['data']['count'] );
// die;


// $index = 0;
// $no = $start + 1; 
// foreach( $sql_data['data'] as $key=>$d){ 
//     array_push( $sql_data['data'], $d); 
//     $sql_data['data'][$index]['no'] = $no; 
//     $index++;
//     $no++;
// }


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


// echo "<pre>";
// print_r( $sql_data['data'] );
// die;	



$callback = array(
    'draw'=>$_POST['draw'], 
    'recordsTotal'=>$dataCount['data']['count'], 
    // 'recordsFiltered'=>$sql_filter['data'], 
    'recordsFiltered'=>$dataCount['data']['count'], 
    'data'=>$data

);



// echo "<pre>";
// print_r( $callback );
// die;	

header('Content-Type: application/json');
echo json_encode($callback); // Convert array $callback ke json
?>
