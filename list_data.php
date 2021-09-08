<?php

require_once('koneksi.php');
require_once('PHPExcel/PHPExcel.php');
ini_set('display_errors', 'On');
header("Access-Control-Allow-Origin: *"); 

// echo "<pre>";
// echo "_POST"; print_r($_POST);
// echo "request"; print_r($_REQUEST);
// echo "_FILES"; print_r($_FILES);
// print_r( $_POST['kode'] );
// die;


switch ($_POST['kode']) {

    	case 'upload':
		
		$nm_date = 'data_'.date("Y-m-d").'.xlsx';
		$nm_time = date("h:i:sa").'.xlsx';
		// $nama_file_baru = $nm_date."-".$nm_time;
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
		$fileName = $_FILES["file"]["name"]; 
		$fileTmp = $_FILES["file"]["tmp_name"]; 
		$upload_nmbr = $_POST['upload_nmbr'];
		$ceding_name = $_POST['ceding_name'];
		$treaty_name = $_POST['treaty_name'];

	
			
		if($ext == "xlsx"){				
			$temp = "temp/";
			if (!file_exists($temp)){
				mkdir($temp);
			}
			(move_uploaded_file($fileTmp, $temp . "$nm_date"));
			
			require_once 'PHPExcel/PHPExcel.php';
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('temp/'.$nm_date); 
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

			// echo "<pre>";
			// echo "sheet= ";print_r( $sheet);
			// die;

			$db = new koneksi();
			$numrow = 1;
			$kosong = 0;
			(int)$key ;
			foreach($sheet as $key=>$row){ 

				// echo "<pre>";
				// echo "row= ";print_r( $row); echo "<br>";
				// echo "key= ";print_r( $key); echo "<br>";
				// die;
				
				$cedant_clm_nbr = $row['B']; 
				$policy_no = $row['C']; 
				$certificate_no = $row['D']; 
				$insured_name = $row['E']; 
				$effective_date = $row['F']; 
				$sum_assured = $row['G']; 
				$benefit = $row['H']; 
				$event_date = $row['I']; 
				$submit_date = $row['J'];
				$complate_date = $row['K']; 
				$approval_date = $row['L']; 
				$payment_date = $row['M']; 
				$investigation = $row['N']; 
				$curr_idr = $row['O']; 
				$submission_amt = $row['P']; 
				$approved_amt = $row['Q']; 
				$paid_amt = $row['R']; 
				$diagnosis_desc = $row['S']; 
				$tre_share_amt = $row['T']; 
				$sent_to_reinsr_date = $row['U']; 
				$sla = $row['V']; 
						
				// if($certificate_no == "" && $nama == "" && $jenis_kelamin == "" && $telp == "" && $alamat == "")
					// continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

				if($key > 1){					
				    $sqlQuery = " INSERT INTO public.tbl_claim_data
							(cedant_clm_nbr, policy_no, certificate_no, insured_name, effective_date, sum_assured, benefit, event_date, submit_date, complate_date, 
							approval_date, payment_date, investigation, curr_idr, submission_amt, approved_amt, paid_amt, diagnosis_desc, tre_share_amt, sent_to_reinsr_date, sla, upload_number)
							VALUES(
							'$cedant_clm_nbr', '$policy_no', '$certificate_no', '$insured_name', '$effective_date', '$sum_assured', '$benefit','$event_date', 
							'$submit_date','$complate_date','$approval_date' , '$payment_date', '$investigation', '$curr_idr', '$submission_amt', '$approved_amt', 
							'$paid_amt', '$diagnosis_desc', '$tre_share_amt', '$sent_to_reinsr_date', '$sla',  '$upload_nmbr') ";
							
					$dataQuery = $db->insert($sqlQuery);

					// echo "<pre>";
					// print_r( $sqlQuery);

					$cedant_clm_nbr_td = ( ! empty($cedant_clm_nbr))? "" : " style='background: #E07171;'"; 
					$policy_no_td = ( ! empty($policy_no))? "" : " style='background: #E07171;'"; 
					$certificate_no_td = ( ! empty($certificate_no))? "" : " style='background: #E07171;'"; 
					$insured_name_td = ( ! empty($insured_name))? "" : " style='background: #E07171;'"; 
						
				}
				
			}
			// die;
			echo json_encode($dataQuery);

		}
		else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
			echo "<div class='alert alert-danger'>
			Hanya File Excel 2007 (.xlsx) yang diperbolehkan
			</div>";
		}
        break;

    
	case 'CEK_MAX_UPLOAD_NUMBER':
		check_max_upload_number($_POST['data']);
		break;

	case 'CHECK_DATA_CLAIM':
			check_data_claim($_POST['data']);
			break;
	case 'ceding_name':
			ceding_name($_POST['data']);
			break;
	case 'treaty_name':
			treaty_name($_POST['data']);
			break;
	case 'FORM_SETTING':
			form_setting($_POST);
			break;
    default:
		break;

}

function KonDecRomawi($angka)
{
    $hsl = "";
    if ($angka < 1 || $angka > 5000) { 
        
        $hsl = "Batas Angka 1 s/d 5000";
    } else {
        while ($angka >= 1000) {
            
            $hsl .= "M";     
            $angka -= 1000;
        
        }
    }


    if ($angka >= 500) {
        
        if ($angka > 500) {
            if ($angka >= 900) {
                $hsl .= "CM";
                $angka -= 900;
            } else {
                $hsl .= "D";
                $angka-=500;
            }
        }
    } 
    while ($angka>=100) {
        if ($angka>=400) {
            $hsl .= "CD";
            $angka -= 400;
        } else {
            $angka -= 100;
        }
    }
    if ($angka>=50) {
        if ($angka>=90) {
            $hsl .= "XC";
            $angka -= 90;
        } else {
            $hsl .= "L";
            $angka-=50;
        }
    }
    while ($angka >= 10) {
        if ($angka >= 40) {
            $hsl .= "XL";
            $angka -= 40;
        } else {
            $hsl .= "X";
            $angka -= 10;
        }
    }
    if ($angka >= 5) {
        if ($angka == 9) {
            $hsl .= "IX";
            $angka-=9;
        } else {
            $hsl .= "V";
            $angka -= 5;
        }
    }
    while ($angka >= 1) {
        if ($angka == 4) {
            $hsl .= "IV"; 
            $angka -= 4;
        } else {
            $hsl .= "I";
            $angka -= 1;
        }
    }

    return ($hsl);
}





function check_max_upload_number($data=""){
	
	$database = new Koneksi;
	$sqlQuery = "select max(left(upload_number,-16)) as upload_number from tbl_claim_data ";										
	$dataQuery = $database->db_fetch_obj($sqlQuery);

	$year = date("Y");
	$month = date("m");
	
	if( $dataQuery['success'] && $dataQuery['status']==200 ){
		$dt = ( (int)$dataQuery['data']['upload_number'] ) + 1;

		if( $dt == 0 | $dt == 1 | $dt == 2 | $dt == 3 
		| $dt == 4 | $dt == 5 | $dt == 6 | $dt == 7 | $dt == 8 | $dt == 9
		) {
			$has = '0'.$dt;
		} else {
			$has = $dt;
		}	

		$upload_number = $has.'/CLAIM/'.KonDecRomawi($month).'/'.$year; 
	} else {
		$upload_number = "error";
	}

	echo json_encode($upload_number);
}

function check_data_claim($data) {
	
	$database = new Koneksi;
	$sqlQuery = "select max(upload_number) as upload_number from tbl_claim_data ";										
	$dataQuery = $database->db_fetch_obj($sqlQuery);

	if( $dataQuery['success'] && $dataQuery['status']==200 ){
		
		$upload_nbr = $dataQuery['data']['upload_number'] ;
		// echo "<pre>";
		// print_r( $upload_nbr  ); echo "<br>";

		$sqlQuery_claim = "select * from tbl_claim_data where upload_number ='$upload_nbr' ";										
		$dataQuery_claim = $database->db_fetch_array($sqlQuery_claim);
		$data_claim = $dataQuery_claim['data'];

		// print_r( $data_claim  ); echo "<br>";
		
		// print_r( $sqlQuery2 );

		foreach( $data_claim as $key=>$value ) {

			$insured_name_claim = $value['insured_name'];
			$policy_no_claim = $value['policy_no'];
			$certificate_no_claim = $value['certificate_no'];
			$effective_date_claim = $value['effective_date'];
			$submission_amt_claim = $value['submission_amt'];
			$event_date_claim = $value['event_date'];
			$submit_date_claim = $value['submit_date'];

			// echo "insured_name= "; print_r( $insured_name ); echo "<br>";



	// echo "<pre>";
		// echo "_POST"; print_r($_POST);
		// die;

		$database = new Koneksi;
		$sq = "select * from tbl_setting_uw tsu where ceding_name ='PT. BCA FINANCE' and treaty_name ='016/BCA/2009/CT ADDENDUM NO.01' ";										
		$dq = $database->db_fetch_obj($sq);
		
		echo "<pre>";
		echo "_POST"; print_r($dq);
		die;

			
			$sqlQuery_name_of_insured = "select name_of_insured from tbl_insured where  name_of_insured = '$insured_name_claim' and certificate_no = '$certificate_no_claim' limit 1 ";										
			$dataQuery_name_of_insured = $database->db_fetch_obj($sqlQuery_name_of_insured);
			$name_of_insured = $dataQuery_name_of_insured['data']['name_of_insured'];

			// print_r( $sqlQuery_name_of_insured ); echo "<br>";

			$sqlQuery_policy_no = "select policy_no from tbl_insured where  policy_no = '$policy_no_claim' and certificate_no = '$certificate_no_claim' limit 1 ";
			$dataQuery_policy_no = $database->db_fetch_obj($sqlQuery_policy_no);
			$policy_no_insured = $dataQuery_policy_no['data']['policy_no'];

			$sqlQuery_certificate_no = "select certificate_no from tbl_insured where  certificate_no = '$certificate_no_claim'  limit 1 ";
			$dataQuery_certificate_no = $database->db_fetch_obj($sqlQuery_certificate_no);
			$certificate_no_insured = $dataQuery_certificate_no['data']['certificate_no'];

			$sqlQuery_inception_date = "select inception_date from tbl_insured where  certificate_no = '$certificate_no_claim'  limit 1 ";
			$dataQuery_inception_date = $database->db_fetch_obj($sqlQuery_inception_date);
			$inception_date_insured = $dataQuery_inception_date['data']['inception_date'];

			$sql_paymentdate_vs_submitdate_days = "select a.payment_date - '$submit_date_claim'  AS days1 from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
			$dt_sql_paymentdate_vs_submitdate_days = $database->db_fetch_obj( $sql_paymentdate_vs_submitdate_days );
			$paymentdate_vs_submitdate_days = $dt_sql_paymentdate_vs_submitdate_days['data']['days1'];

			
			// echo "submit_date_claim= "; print_r( $submit_date_claim); echo "<br>";
			// echo "sql_paymentdate_vs_submitdate_days= "; print_r( $sql_paymentdate_vs_submitdate_days); echo "<br>";
			// echo "paymentdate_vs_submitdate_days= "; print_r( $paymentdate_vs_submitdate_days); echo "<br>";
			// die; 

			$submission_amt_insured = "";
			$stnc_insured = "";
			// $stnc_insured = '2020-05-01';


			

			$submission_amt_claim = !empty($submission_amt_claim) ? "$submission_amt_claim" : 0;
			$submission_amt_insured = !empty($submission_amt_insured) ? "$submission_amt_insured" : 0;


			// $result_insd_name = !empty($name_of_insured) ? "Ok" : "NotYet";
			// $result_policy_no = !empty($policy_no_insured) ? "Ok" : "NotYet";
			// $result_certificate_no = !empty($certificate_no_insured) ? "Ok" : "NotYet";
			
			
			if( $name_of_insured == $insured_name_claim ){
				$result_insd_name = "Ok";
			}elseif( !empty($name_of_insured) && empty($insured_name_claim) ){
				$result_insd_name = "NotYet";
			}elseif( !empty($insured_name_claim) && empty($name_of_insured) ){
				$result_insd_name = "NotYet";
			} else{
				$result_insd_name = "Check";
			}

			if( $policy_no_insured == $policy_no_claim ){
				$result_policy_no = "Ok";
			}elseif( !empty($policy_no_insured) && empty($policy_no_claim) ){
				$result_policy_no = "NotYet";
			}elseif( !empty($policy_no_claim) && empty($policy_no_insured) ){
				$result_policy_no = "NotYet";
			} else{
				$result_policy_no = "Check";
			}
			
			if( $certificate_no_insured == $certificate_no_claim ){
				$result_certificate_no = "Ok";
			}elseif( !empty($certificate_no_insured) && empty($certificate_no_claim) ){
				$result_certificate_no = "NotYet";
			}elseif( !empty($certificate_no_claim) && empty($certificate_no_insured) ){
				$result_certificate_no = "NotYet";
			} else{
				$result_certificate_no = "Check";
			}


			if( $inception_date_insured == $effective_date_claim ){
				$result_inception_date = "Ok";
			}elseif( !empty($inception_date_insured) && empty($effective_date_claim) ){
				$result_inception_date = "NotYet";
			}elseif( !empty($effective_date_claim) && empty($inception_date_insured) ){
				$result_inception_date = "NotYet";
			} else{
				$result_inception_date = "Check";
			}

			
			if( $submission_amt_claim == $submission_amt_insured ){
				$result_submission_amt = "Ok";
			}
			elseif( !empty($submission_amt_insured) && empty($submission_amt_claim) ){
				$result_submission_amt = "NotYet";
			}elseif( !empty($submission_amt_claim) && empty($submission_amt_insured) ){
				$result_submission_amt = "NotYet";
			} else{
				$result_submission_amt = "Check";
			}

			
			if( !empty($stnc_insured) && $event_date_claim > $stnc_insured  ) {
				$result_event_date = "Ok";
			}elseif( !empty($stnc_insured) && empty($event_date_claim) ) {
				$result_event_date = "NotYet";
			}elseif( !empty($event_date_claim) && empty($stnc_insured) ) {
				$result_event_date = "NotYet";
			} else{
				$result_event_date = "Check";
			}

			

			$effective_date_claim = !empty($effective_date_claim) ? "'$effective_date_claim'" : "NULL";
			$inception_date_insured = !empty($inception_date_insured) ? "'$inception_date_insured'" : "NULL";
			$event_date_claim = !empty($event_date_claim) ? "'$event_date_claim'" : "NULL";
			$stnc_insured = !empty($stnc_insured) ? "'$stnc_insured'" : "NULL";
			$paymentdate_vs_submitdate_days = !empty($paymentdate_vs_submitdate_days) ? "$paymentdate_vs_submitdate_days" : 0;


			if( (int)$paymentdate_vs_submitdate_days < 180 ) {
				$result_paymentdate_vs_submitdate_days_stts = "Ok"; 
			} else {
				$result_paymentdate_vs_submitdate_days_stts = "Check";
			}

			// $result_overall_claim_stts ="";
			// echo "result_event_date= "; print_r( $result_event_date);
			// die;

			if ( 
				$result_insd_name == "Ok" &&
				$result_policy_no == "Ok" && 
				$result_certificate_no == "Ok" && 
				$result_inception_date == "Ok" && 
				$result_submission_amt == "Ok" &&  
				$result_event_date == "Ok"
			){ $result_overall_claim_stts = "Ok"; }
			else {
				$result_overall_claim_stts = "Check";
			}
			
			// $result_overall_claim_stts = "check";

			$q_insert = "INSERT INTO public.tbl_claim_check_result 
							(claim_insd_name, 
							pl_insd_name, 
							result_insd_name, 
							claim_policy_no, 
							pl_policy_no, 
							result_policy_no, 
							claim_certificate_no, 
							pl_certificate_no, 
							result_certificate_no, 
							claim_effective_date, 
							pl_inception_date, 
							result_efective_inception, 
							claim_submit, 
							pl_sum_insd, 
							result_claim_submit_pl_sum_insd, 
							claim_event, 
							stnc, 
							result_claim_event_stnc, 
							payment_date_submit_date_days, 
							result_payment_date_submit_date_status, 
							pl_cedant_ret, 
							pl_tre, 
							claim_paid_by_cedant, 
							claim_paid_tre_share_calc_by_cedant, 
							claim_paid_tre_share_calc_by_tre, 
							check_claim_tre_share_cedant_vs_tre, 
							result_check_claim_tre_share_cedant_vs_tre, 
							result_overall_clm_status,
							remark
							)
						VALUES(
							'$insured_name_claim', 
							'$name_of_insured', 
							'$result_insd_name', 
							'$policy_no_claim', 
							'$policy_no_insured', 
							'$result_policy_no', 
							'$certificate_no_claim', 
							'$certificate_no_insured', 
							'$result_certificate_no', 
							$effective_date_claim, 
						    $inception_date_insured, 
							'$result_inception_date', 
							'$submission_amt_claim', 
							'$submission_amt_insured', 
							'$result_submission_amt', 
							$event_date_claim, 
							$stnc_insured, 
							'$result_event_date', 
							'$paymentdate_vs_submitdate_days', 
							'$result_paymentdate_vs_submitdate_days_stts',  
							0, 
							0, 
							0, 
							0, 
							0, 
							0, 
							NULL, 
							'$result_overall_claim_stts', 
							NULL) ";

			// echo "<pre>";
			// echo "q_insert= ";
			// print_r( $q_insert ); echo "<br>"; 
				
			$dataQuery_q_insert = $database->insert($q_insert);
			$dt_q_insert = $dataQuery_q_insert['data'];

			// echo "dt_q_insert= ";
			// print_r( $dt_q_insert );

		}

		// die;
		echo json_encode( $dataQuery_q_insert);
		
	} else {
		$upload_number = "error";
	}
	// die;

	// echo json_encode($upload_number);
}


function ceding_name($data){

	
	$database = new Koneksi;
	$sqlQuery = "select tt.ceding_name, tt.no_contract from tbl_treaty tt where tt.type_of_contract ='Treaty' ";										
	$dataQuery = $database->db_fetch_array($sqlQuery);

	// echo "<pre>";
	// echo "kkkkkk";
	// print_r($dataQuery);
	// die;

	$ceding_name = array();
    if ($dataQuery['success'] && $dataQuery['status']==200) {
            
        foreach ($dataQuery['data'] as $key=>$value) {
            $ceding_name[$key] = $value;
        }
    }
	echo  json_encode($ceding_name);

}

function treaty_name($data){

	$database = new Koneksi;
	$sqlQuery = "select tt.no_contract from tbl_treaty tt where tt.ceding_name='$data' ";	
	$dataQuery = $database->db_fetch_array($sqlQuery);

	// echo "<pre>";
	// echo "dataQuery ";
	// print_r($dataQuery);
	// die;

	$no_treaty = array();
    if ($dataQuery['success'] && $dataQuery['status']==200) {         
        foreach ($dataQuery['data'] as $key=>$value) {
            $no_treaty[$key] = $value;
        }
    }

	// echo "no_treaty ";
	// print_r($no_treaty);
	// die;

	echo  json_encode($no_treaty);

}


function form_setting($data) {
	$db = new Koneksi();


	// echo "<pre>";
	// print_r( $data);
	// die;



	$sqlQuery = " INSERT INTO public.tbl_setting_uw
	(insured_name, 
	policy_no, 
	certificate_no, 
	inception_date, 
	sum_insured, 
	stnc, 
	paymentdate_submitdate_days_18, 
	pl_cedant_rate, 
	pl_tre, 
	claim_paid_by_cedant_100, 
	claim_paid_tre_share_calc_by_cedant, 
	claim_paid_tre_share_calc_by_tre, 
	check_claim_tre_share, 
	over_all_claim_stts, 
	remark,ceding_name,
	treaty_name)
	VALUES(
		'$data[check_insured_name]', 
		'$data[check_policy_no]', 
		'$data[check_certificate_no]', 
		'$data[check_inception_date]', 
		'$data[check_sum_ins]', 
		'$data[check_stnc]', 
		'$data[check_180_days]',
		'$data[pl_cedant_rate]', 
		'$data[pl_tre]', 
		'$data[claim_paid_by_cedant]', 
		'$data[claim_paid_tre_share_calc_by_cedant]', 
		'$data[claim_paid_tre_share_calc_by_tre]', 
		'$data[check_claim_tre_share_stts]', 
		'0',
		'$data[remark]',
		'$data[ceding_name]',
		'$data[treaty_name]'
	 ) ";
	
// print_r( $sqlQuery );
// die;

	$dataQuery = $db->insert($sqlQuery);
	$dt_q_insert = $dataQuery['data'];

	echo json_encode( $dt_q_insert);

}


?>