<?php

require_once('koneksi.php');
require_once('PHPExcel/PHPExcel.php');
ini_set('display_errors', 'Off');
header("Access-Control-Allow-Origin: *"); 


switch ($_POST['kode']) {

    	case 'upload':
		
		$nm_date = 'data_'.date("Y-m-d").'.xlsx';
		$nm_time = date("h:i:sa").'.xlsx';
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
		$fileName = $_FILES["file"]["name"]; 
		$fileTmp = $_FILES["file"]["tmp_name"]; 
		$upload_nmbr = $_POST['upload_nmbr'];
		$ceding_name = $_POST['ceding_name'];
		$treaty_name = $_POST['treaty_name'];
		
		$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
		$path = "$rootDir/temp/".$fileName;
		
		$database = new Koneksi;	
		$sqlCekFile = "select count(*) from tbl_claim_data where file_name ='$fileName' ";																		
		$dataCekFile = $database->db_fetch_obj($sqlCekFile);
		

		$dtCount = (int)$dataCekFile['data']['count'];
		if( $dtCount > 0 ){
			echo json_encode($dtCount); 
		} else {
			
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

					$db = new koneksi();
					$numrow = 1;
					$kosong = 0;
					(int)$key ;
					foreach($sheet as $key=>$row){ 
						
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
						$tre_si = $row['W'];
						$birth_date = $row['X'];
						$cedant_rate = $row['Y']; 
						$stnc = $row['Z']; 
						
								
						$tre_si = !empty($tre_si) ? "$tre_si" : 0; 
						$cedant_rate = !empty($cedant_rate) ? "$cedant_rate" : 0; 
						$birth_date = !empty($birth_date) ? "'$birth_date'" : "NULL"; 
						$effective_date = !empty($effective_date) ? "'$effective_date'" : "NULL";
						$event_date = !empty($event_date) ? "'$event_date'" : "NULL";
						$submit_date = !empty($submit_date) ? "'$submit_date'" : "NULL";
						$complate_date = !empty($complate_date) ? "'$complate_date'" : "NULL";
						$approval_date = !empty($approval_date) ? "'$approval_date'" : "NULL";
						$payment_date = !empty($payment_date) ? "'$payment_date'" : "NULL";
						$stnc = !empty($stnc) ? "'$stnc'" : "NULL";
						$sent_to_reinsr_date = !empty($sent_to_reinsr_date) ? "'$sent_to_reinsr_date'" : "NULL";
						$submission_amt = !empty($submission_amt) ? "$submission_amt" : 0; 
						$approved_amt = !empty($approved_amt) ? "$approved_amt" : 0; 	
						$paid_amt = !empty($paid_amt) ? "$paid_amt" : 0; 
						$tre_share_amt = !empty($tre_share_amt) ? "$tre_share_amt" : 0; 
						$sum_assured = !empty($sum_assured) ? "$sum_assured" : 0; 
						
					

						if($key > 1){					
							$sqlQuery = " INSERT INTO public.tbl_claim_data
									(cedant_clm_nbr, policy_no, certificate_no, insured_name, effective_date, sum_assured, benefit, event_date, submit_date, complate_date, 
									approval_date, payment_date, investigation, curr_idr, submission_amt, approved_amt, paid_amt, diagnosis_desc, tre_share_amt, sent_to_reinsr_date, sla, upload_number,ceding_name, treaty_name,tre_si,birth_date,cedant_rate,stnc,file_name,path_file )
									VALUES( 
									'$cedant_clm_nbr', '$policy_no', '$certificate_no', '$insured_name', $effective_date, '$sum_assured', '$benefit',$event_date, 
									$submit_date,$complate_date,$approval_date , $payment_date, '$investigation', '$curr_idr', '$submission_amt', '$approved_amt', 
									'$paid_amt', '$diagnosis_desc', '$tre_share_amt', $sent_to_reinsr_date, '$sla',  '$upload_nmbr', '$ceding_name', '$treaty_name','$tre_si',$birth_date,'$cedant_rate', $stnc,'$fileName','$path') ; "; 
								
		
							$dataQuery = $db->insert($sqlQuery);
		
						} 
						
					}

					echo json_encode($dataQuery);

				}
				else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
		}
        break;



		case 'upload_urgent':
		
			$nm_date = 'data_'.date("Y-m-d").'.xlsx';
			$nm_time = date("h:i:sa").'.xlsx';
			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
			$fileName = $_FILES["file"]["name"]; 
			$fileTmp = $_FILES["file"]["tmp_name"]; 
			
			$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
			$path = "$rootDir/temp/".$fileName;
			
			
				
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
	
						$db = new koneksi();
						$numrow = 1;
						$kosong = 0;
						(int)$key ;
						foreach($sheet as $key=>$row){ 
							
							$certificate_no = $row['B']; 
							$insured_name = $row['C']; 
							$birth_date = $row['D']; 

							// echo "<pre>";
							// print_r($row);
							
	
							if($key > 1){					

							$sqlQuery = "INSERT INTO public.tbl_claim_urgent
								(certificate_no, insured_name, birth_date)
								VALUES('$certificate_no', '$insured_name', '$birth_date'); ";
								
								$dataQuery = $db->insert($sqlQuery);

								print_r($sqlQuery); 
								// echo "<br>";
			
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
			check_data_claim($_POST);
			break;
	case 'CHECK_DATA_CLAIM_TREATY':
			check_data_claim_treaty($_POST);
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
	case 'validasi_login':	
			validasi_login($_POST);
			break;
	case 'list_insured':	
			list_insured($_POST);
			break;
	case 'generate_settle':
			generate_settle($_POST);
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
	$sqlQuery = "select max(left(upload_number,-13)) as upload_number from tbl_claim_data ";										
	$dataQuery = $database->db_fetch_obj($sqlQuery);
	$dt_upload = ((int)$dataQuery['data']['upload_number']);
	
	$dt_upload = ( !empty($dt_upload) ) ? (int)($dt_upload+1) : (int)($dt_upload+1);

	$year = date("Y");
	$month = date("m");
	
	if( $dataQuery['success'] && $dataQuery['status']==200 ){
		$dt = $dt_upload;

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


function generate_settle($data) { 


	$id = explode(",",$data['id']);
	$claim_insd_name = explode(",",$data['claim_insd_name']);
	$pl_insd_name = explode(",",$data['pl_insd_name']);
	$result_insd_name= explode(",",$data['result_insd_name']);
	$claim_policy_no= explode(",",$data['claim_policy_no']);
	$pl_policy_no= explode(",",$data['pl_policy_no']);
	$result_policy_no= explode(",",$data['result_policy_no']);
	$claim_certificate_no= explode(",",$data['claim_certificate_no']);
	$pl_certificate_no= explode(",",$data['pl_certificate_no']);
	$result_certificate_no= explode(",",$data['result_certificate_no']);
	$claim_effective_date= explode(",",$data['claim_effective_date']);
	$pl_inception_date= explode(",",$data['pl_inception_date']);
	$result_efective_inception= explode(",",$data['result_efective_inception']);
	$claim_submit= explode(",",$data['claim_submit']);
	$pl_sum_insd= explode(",",$data['pl_sum_insd']);
	$result_claim_submit_pl_sum_insd= explode(",",$data['result_claim_submit_pl_sum_insd']);
	$claim_event= explode(",",$data['claim_event']);
	$stnc= explode(",",$data['stnc']);
	$result_claim_event_stnc= explode(",",$data['result_claim_event_stnc']);
	$payment_date_submit_date_days= explode(",",$data['payment_date_submit_date_days']);
	$result_payment_date_submit_date_status= explode(",",$data['result_payment_date_submit_date_status']);
	$pl_cedant_ret= explode(",",$data['pl_cedant_ret']);
	$pl_tre= explode(",",$data['pl_tre']);
	$claim_paid_by_cedant= explode(",",$data['claim_paid_by_cedant']);
	$claim_paid_tre_share_calc_by_cedant= explode(",",$data['claim_paid_tre_share_calc_by_cedant']);
	$claim_paid_tre_share_calc_by_tre= explode(",",$data['claim_paid_tre_share_calc_by_tre']);
	$check_claim_tre_share_cedant_vs_tre= explode(",",$data['check_claim_tre_share_cedant_vs_tre']);
	$result_check_claim_tre_share_cedant_vs_tre= explode(",",$data['result_check_claim_tre_share_cedant_vs_tre']);
	$result_overall_clm_status= explode(",",$data['result_overall_clm_status']);
	$remark= explode(",",$data['remark']);
	$file_name= explode(",",$data['file_name']);
	$path_file= explode(",",$data['path_file']);
	$settle_date= explode(",",$data['settle_date']);
	$id_old= explode(",",$data['id']);


	$database = new Koneksi;
	for( $i =0; $i <= count($id)-1; $i++ ){

		$claim_effective_date[$i] = !empty($claim_effective_date[$i]) ? "'$claim_effective_date[$i]'" : "NULL";
		$pl_inception_date[$i] = !empty($pl_inception_date[$i]) ? "'$pl_inception_date[$i]'" : "NULL";
		$payment_date_submit_date_days[$i] = !empty($payment_date_submit_date_days[$i]) ? "'$payment_date_submit_date_days[$i]'" : "NULL";
		
			
		$sqlQuery = "INSERT INTO public.tbl_claim_settle
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
             remark,
             file_name,
             path_file,
             settle_date,
             id_old )
	VALUES (
			'$claim_insd_name[$i]',
			'$pl_insd_name[$i]',
			'Ok',
			'$claim_policy_no[$i]',
			'$pl_policy_no[$i]',
			'Ok',
			'$claim_certificate_no[$i]',
			'$pl_certificate_no[$i]',
			'Ok',
			$claim_effective_date[$i],
			$pl_inception_date[$i],
			'Ok',
			'$claim_submit[$i]',
			'$pl_sum_insd[$i]',
			'Ok',
			'$claim_event[$i]',
			'$stnc[$i]',
			'Ok',
			$payment_date_submit_date_days[$i],
			'Ok',
			'$pl_cedant_ret[$i]',
			'$pl_tre[$i]',
			'$claim_paid_by_cedant[$i]',
			'$claim_paid_tre_share_calc_by_cedant[$i]',
			'$claim_paid_tre_share_calc_by_tre[$i]',
			'$check_claim_tre_share_cedant_vs_tre[$i]',
			'Ok',
			'Ok',
			'$remark[$i]',
			'$file_name[$i]',
			'$path_file[$i]',
			'now()',
			'$id_old[$i]' ) ; ";
			

			$dataQuery = $database->db_fetch_obj($sqlQuery);
	}

	echo json_encode((int)$dataQuery['success']);
	
}


function check_data_claim($data) {
	
	$database = new Koneksi;
	$sqlQuery = "select upload_number from tbl_claim_data  where ceding_name ='$data[ceding_name]' and treaty_name ='$data[treaty_name]' ";																		
	$dataQuery = $database->db_fetch_obj($sqlQuery);


	if( $dataQuery['success'] && $dataQuery['status']==200 ){
		
		$upload_nbr = $dataQuery['data']['upload_number'] ;
		$sqlQuery_claim = "select * from tbl_claim_data where upload_number ='$upload_nbr' ";										
		$dataQuery_claim = $database->db_fetch_array($sqlQuery_claim);
		$data_claim = $dataQuery_claim['data'];

		foreach( $data_claim as $key=>$value ) {

			$insured_name_claim = $value['insured_name'];
			$policy_no_claim = $value['policy_no'];
			$certificate_no_claim = $value['certificate_no'];
			$effective_date_claim = $value['effective_date'];
			$submission_amt_claim = $value['submission_amt'];
			$event_date_claim = $value['event_date'];
			$submit_date_claim = $value['submit_date'];
			$SentToReinsrDate_claim = $value['sent_to_reinsr_date'];
			$tre_si_claim = $value['tre_si'];
			$cedant_rate_claim = $value['cedant_rate'];
			$birth_date_claim = $value['birth_date'];
			$stnc = $value['stnc'];

			$database = new Koneksi;
			$sq = "select * from tbl_setting_uw tsu where ceding_name ='$data[ceding_name]' and treaty_name ='$data[treaty_name]' ";										
			$dq = $database->db_fetch_obj($sq);
		

        if ($dq['success'] && $dq['status']==200) {
			$dt = $dq['data'];

			if( $dt['insured_name'] ) {
				$sqlQuery_name_of_insured = "select name_of_insured from tbl_insured where  name_of_insured = '$insured_name_claim' and certificate_no = '$certificate_no_claim' limit 1 ";										
				$dataQuery_name_of_insured = $database->db_fetch_obj($sqlQuery_name_of_insured);
				$name_of_insured = $dataQuery_name_of_insured['data']['name_of_insured'];
	
			}

			if( $dt['policy_no'] ) {
				$sqlQuery_policy_no = "select policy_no from tbl_insured where  policy_no = '$policy_no_claim' and certificate_no = '$certificate_no_claim' limit 1 ";
				$dataQuery_policy_no = $database->db_fetch_obj($sqlQuery_policy_no);
				$policy_no_insured = $dataQuery_policy_no['data']['policy_no'];
	
			}

			if( $dt['certificate_no'] ) {
				$sqlQuery_certificate_no = "select certificate_no from tbl_insured where  certificate_no = '$certificate_no_claim'  limit 1 ";
				$dataQuery_certificate_no = $database->db_fetch_obj($sqlQuery_certificate_no);
				$certificate_no_insured = $dataQuery_certificate_no['data']['certificate_no'];
	
			}

			if( $dt['inception_date'] ) {
				$sqlQuery_inception_date = "select inception_date from tbl_insured where  certificate_no = '$certificate_no_claim'  limit 1 ";
				$dataQuery_inception_date = $database->db_fetch_obj($sqlQuery_inception_date);
				$inception_date_insured = $dataQuery_inception_date['data']['inception_date'];
	
			}

			

			/* PLCedantSI */
			$sqlQuery_sum_insured_orc = "select sum_insured_orc from tbl_insured where  certificate_no = '$certificate_no_claim'  limit 1 ";										
			$dataQuery_sum_insured_orc = $database->db_fetch_obj($sqlQuery_sum_insured_orc);
			$sum_insured_orc = $dataQuery_sum_insured_orc['data']['sum_insured_orc'];


			/* PLCedantRate */
			$sql_pl_cedant_rate = "select limit_retensi_ceding as cedant_rate from tbl_treaty a where a.certificate_no ='$certificate_no_claim' ";
			$dt_sql_pl_cedant_rate = $database->db_fetch_obj( $sql_pl_cedant_rate );
			$pl_cedant_rate = $dt_sql_pl_cedant_rate['data']['cedant_rate'];

			if( $dt['stnc'] ) {
			/* stnc_date */
				$sql_stnc_date = "select stnc_date from tbl_treaty a where a.certificate_no ='$certificate_no_claim' ";
				$dt_sql_stnc_date = $database->db_fetch_obj( $sql_stnc_date );
				$stnc_date = $dt_sql_stnc_date['data']['cedant_rate'];
			}
			
			if( $dt['days_180_more'] ) { 
				$sql_paymentdate_vs_submitdate_days = "select a.sent_to_reinsr_date - a.event_date AS days1 from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
				$dt_sql_paymentdate_vs_submitdate_days = $database->db_fetch_obj( $sql_paymentdate_vs_submitdate_days );
				$paymentdate_vs_submitdate_days = $dt_sql_paymentdate_vs_submitdate_days['data']['days1'];
			} 
			if( $dt['days_180_less'] ) { 
				$sql_paymentdate_vs_submitdate_days = "select a.payment_date - '$submit_date_claim'  AS days1 from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
				$dt_sql_paymentdate_vs_submitdate_days = $database->db_fetch_obj( $sql_paymentdate_vs_submitdate_days );
				$paymentdate_vs_submitdate_days = $dt_sql_paymentdate_vs_submitdate_days['data']['days1'];
			}


			$sql_tree_si = "select tre_si from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
			$dt_sql_tree_si = $database->db_fetch_obj( $sql_tree_si );
			$pl_tree_si = $dt_sql_tree_si['data']['tre_si'];

			$sql_paid_amt = "select paid_amt from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
			$dt_sql_paid_amt = $database->db_fetch_obj( $sql_paid_amt );
			$paid_amt = $dt_sql_paid_amt['data']['paid_amt'];

			$sql_tre_share_amt = "select tre_share_amt from tbl_claim_data a where a.certificate_no ='$certificate_no_claim' ";
			$dt_sql_tre_share_amt = $database->db_fetch_obj( $sql_tre_share_amt );
			$tre_share_amt = $dt_sql_tre_share_amt['data']['tre_share_amt'];

			
			

			$submission_amt_insured = $sum_insured_orc;
			$stnc_insured = $stnc_date;
			// $stnc_insured = '2020-05-01';

			$submission_amt_claim = !empty($submission_amt_claim) ? "$submission_amt_claim" : 0;
			$submission_amt_insured = !empty($submission_amt_insured) ? "$submission_amt_insured" : 0;


			
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
			$pl_cedant_rate = !empty($pl_cedant_rate) ? "$pl_cedant_rate" : 0;
			$sum_insured_orc = !empty($sum_insured_orc) ? "$sum_insured_orc" : 0;
			$pl_tree_si = !empty($pl_tree_si) ? "$pl_tree_si" : 0;
			$paid_amt = !empty($paid_amt) ? "$paid_amt" : 0;
			$tre_share_amt = !empty($tre_share_amt) ? "$tre_share_amt" : 0;
			
			
			if( $dt['sent_to_reinsr_date'] ) {
				if( (int)$paymentdate_vs_submitdate_days > 180 ) {
					$result_paymentdate_vs_submitdate_days_stts = "Reject"; 
				} else {
					$result_paymentdate_vs_submitdate_days_stts = "Ok";
				}
			}
			else {
				if( (int)$paymentdate_vs_submitdate_days < 180 ) {
					$result_paymentdate_vs_submitdate_days_stts = "Ok"; 
				} else {
					$result_paymentdate_vs_submitdate_days_stts = "Check";
				}	
			} 
			



			$result_pl_cedant_rate = ( floatval($pl_cedant_rate)/floatval($sum_insured_orc) ); 			
			$result_pl_tree = ( floatval($pl_tree_si)/floatval($sum_insured_orc) );
			
			$Claim_Paid_TRE_Share_calcByTRE = ($result_pl_tree*$paid_amt);
			$Claim_Paid_TRE_Share_cedantVersionVsTREversion_real =(floatval($Claim_Paid_TRE_Share_calcByTRE) / floatval($tre_share_amt) );
			$Claim_Paid_TRE_Share_cedantVersionVsTREversion_100 =(floatval($Claim_Paid_TRE_Share_calcByTRE) / floatval($tre_share_amt)*100 );
			$Claim_Paid_TRE_Share_cedantVerVsTREver = $Claim_Paid_TRE_Share_cedantVersionVsTREversion_real = '1' ? "Ok" : "Check";
			$result_pl_cedant_rate = !empty($result_pl_cedant_rate) ? "$pl_tree_si" : 0;

		

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

		
		}


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
							'$result_pl_cedant_rate', 
							'$pl_tree_si', 
							'$paid_amt', 
							'$tre_share_amt', 
							'$Claim_Paid_TRE_Share_calcByTRE', 
							'$Claim_Paid_TRE_Share_cedantVersionVsTREversion_100', 
							'$Claim_Paid_TRE_Share_cedantVerVsTREver', 
							'$result_overall_claim_stts', 
							NULL) ";

			// echo "<pre>";
			// echo "q_insert= ";
			// print_r( $q_insert ); echo "<br>"; 
			// die;

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
	
	
}


function check_data_claim_treaty($data) {
	$database = new Koneksi;	
	$sqlQuery = "select count(*) from tbl_claim_check_result where file_name ='$data[file_name]' ";																		
	$dataQuery = $database->db_fetch_obj($sqlQuery);

	
	if( $dataQuery['data']['count'] > 0 ){
		echo json_encode((int)$dataQuery['data']['count']);
	} else {
		proses_data_claim_treaty($data);
	}
}

function proses_data_claim_treaty($data) {

		

		if (!empty(trim($data['ceding_name']))) {
			$ceding_name_param = $data['ceding_name'];
	    } else {
			$ceding_name_param = "";
		}

	    if (!empty(trim($data['treaty_name']))) {
			$treaty_name_param = $data['treaty_name'];
   		} else {
			$treaty_name_param = "";
		}

		

	$database = new Koneksi;
	$fileName = $data['file_name'];
	$path ="";
		
		$upload_nbr = $data['upload_number']; 
		$sqlQuery_claim = "select * from tbl_claim_data a where a.file_name ='$data[file_name]' and a.upload_number='$data[upload_number]' ";
		$dataQuery_claim = $database->db_fetch_array($sqlQuery_claim);
		$data_claim = $dataQuery_claim['data'];
		
		

		foreach( $data_claim as $key=>$value ) {

			$insured_name_claim = $value['insured_name'];
			$policy_no_claim = $value['policy_no'];
			$certificate_no_claim = $value['certificate_no'];
			$effective_date_claim = $value['effective_date'];
			$submission_amt_claim = $value['submission_amt'];
			$event_date_claim = $value['event_date'];
			$submit_date_claim = $value['submit_date'];
			$SentToReinsrDate_claim = $value['sent_to_reinsr_date'];
			$tre_si_claim = $value['tre_si'];
			$cedant_rate_claim = $value['cedant_rate'];
			$birth_date_claim = $value['birth_date'];
			$stnc = $value['stnc'];

			
			if( $insured_name_claim != "" ) {
				$sqlQuery_name_of_insured = "select name_of_insured from tbl_insured where name_of_insured like '%$insured_name_claim%' ";
				
				if (!empty( $ceding_name_param )) {
					$sqlQuery_name_of_insured .= "and ceding like '%$ceding_name_param%' ";
				   }

				if (!empty( $treaty_name_param )) {
					$sqlQuery_name_of_insured .= "and no_treaty like '%$treaty_name_param%' ";
				   }

				$sqlQuery_name_of_insured .= "LIMIT 1 ";
				$dataQuery_name_of_insured = $database->db_fetch_obj($sqlQuery_name_of_insured);
				$name_of_insured = $dataQuery_name_of_insured['data']['name_of_insured'];
				

			} else {
				$name_of_insured = "";
			}


			if( $policy_no_claim != "" ) {
				$sqlQuery_policy_no = "select policy_no from tbl_insured where policy_no = '$policy_no_claim' ";
				if (!empty( $ceding_name_param )) {
					$sqlQuery_policy_no .= "and ceding like '%$ceding_name_param%' ";
				   }

				if (!empty( $treaty_name_param )) {
					$sqlQuery_policy_no .= "and no_treaty like '%$treaty_name_param%' ";
				   }

				$sqlQuery_policy_no .= "LIMIT 1 ";
				$dataQuery_policy_no = $database->db_fetch_obj($sqlQuery_policy_no);
				$policy_no_insured = $dataQuery_policy_no['data']['policy_no'];
			} else {
				$policy_no_insured = "";
			}

			if( $certificate_no_claim != "" ) {
				$sqlQuery_certificate_no = "select certificate_no from tbl_insured where  certificate_no = '$certificate_no_claim'  ";
				if (!empty( $ceding_name_param )) {
					$sqlQuery_certificate_no .= "and ceding like '%$ceding_name_param%' ";
				   }

				if (!empty( $treaty_name_param )) {
					$sqlQuery_certificate_no .= "and no_treaty like '%$treaty_name_param%' ";
				   }

				$sqlQuery_certificate_no .= "LIMIT 1 ";
				$dataQuery_certificate_no = $database->db_fetch_obj($sqlQuery_certificate_no);
				$certificate_no_insured = $dataQuery_certificate_no['data']['certificate_no'];
			} else {
				$certificate_no_insured = "";
			}

			if( $birth_date_claim != "" ) {
				$sqlQuery_birth_date = "select birth_of_date from tbl_insured where  birth_of_date = '$birth_date_claim'   ";
				if (!empty( $ceding_name_param )) {
					$sqlQuery_birth_date .= "and ceding like '%$ceding_name_param%' ";
				   }

				if (!empty( $treaty_name_param )) { 
					$sqlQuery_birth_date .= "and no_treaty like '%$treaty_name_param%' ";
				   }

				$sqlQuery_birth_date .= "LIMIT 1 "; 
				$dataQuery_birth_date = $database->db_fetch_obj($sqlQuery_birth_date);
				$birth_date_insured = $dataQuery_birth_date['data']['birth_of_date'];
			} else {
				$birth_date_insured = "";
			}

		
	
					/* PLCedantSI and inception_date */
			if( $insured_name_claim != "" and $birth_date_claim != "" and $certificate_no_claim != "" and $policy_no_claim != "" ) {
				$sqlQuery_inception_date = "select inception_date,sum_insured_orc,no_treaty from tbl_insured  
				where name_of_insured like '%$insured_name_claim%'  
				and birth_of_date ='$birth_date_claim' 
				and certificate_no='$certificate_no_claim' 
				and policy_no ='$policy_no_claim' ";

				if (!empty( $ceding_name_param )) {
					$sqlQuery_inception_date .= " and ceding like '%$ceding_name_param%' ";
				   }

				if (!empty( $treaty_name_param )) { 
					$sqlQuery_inception_date .= " and no_treaty like '%$treaty_name_param%' ";
				   }

				$sqlQuery_inception_date .= "LIMIT 1 ";  
				$dataQuery_inception_date_and_sum_insured_orc = $database->db_fetch_obj($sqlQuery_inception_date);
				$inception_date_insured = $dataQuery_inception_date_and_sum_insured_orc['data']['inception_date'];
				$sum_insured_orc = $dataQuery_inception_date_and_sum_insured_orc['data']['sum_insured_orc'];
				$no_treaty = $dataQuery_inception_date_and_sum_insured_orc['data']['no_treaty'];
	
			} else {
				$inception_date_insured = "";
				$sum_insured_orc = "";
				$no_treaty = "";
			}

			
			
			$sql_claim_data= "SELECT
								a.sent_to_reinsr_date - a.event_date AS days1 ,
								a.cedant_rate,
								a.tre_si,
								a.paid_amt ,
								a.tre_share_amt 
							  from tbl_claim_data a 
							  where  
								a.certificate_no ='$certificate_no_claim' and
								a.insured_name = '$insured_name_claim' 
								and a.birth_date = '$birth_date_claim' "; 
			$dt_sql_claim_data = $database->db_fetch_obj( $sql_claim_data );
		

			$paymentdate_vs_submitdate_days = $dt_sql_claim_data['data']['days1'];
			$pl_cedant_rate = $dt_sql_claim_data['data']['cedant_rate'];
			$pl_tree_si = $dt_sql_claim_data['data']['tre_si'];
			$paid_amt = $dt_sql_claim_data['data']['paid_amt'];
			$tre_share_amt = $dt_sql_claim_data['data']['tre_share_amt'];

			
			$submission_amt_insured = $sum_insured_orc;
			$stnc_insured = $stnc;
			// $stnc_insured = '2020-05-01';

			$submission_amt_claim = !empty($submission_amt_claim) ? "$submission_amt_claim" : 0;
			$submission_amt_insured = !empty($submission_amt_insured) ? "$submission_amt_insured" : 0;

			
			
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

			if( $birth_date_insured == $birth_date_claim ) { 
				$result_birth_date = "Ok";
			} else{
				$result_birth_date = "Check";
			}

			

			$effective_date_claim = !empty($effective_date_claim) ? "'$effective_date_claim'" : "NULL";
			$inception_date_insured = !empty($inception_date_insured) ? "'$inception_date_insured'" : "NULL";
			$event_date_claim = !empty($event_date_claim) ? "'$event_date_claim'" : "NULL";
			$stnc_insured = !empty($stnc_insured) ? "'$stnc_insured'" : "NULL";
			$birth_date_claim = !empty($birth_date_claim) ? "'$birth_date_claim'" : "NULL";
			$birth_date_insured = !empty($birth_date_insured) ? "'$birth_date_insured'" : "NULL";

			$paymentdate_vs_submitdate_days = !empty($paymentdate_vs_submitdate_days) ? "$paymentdate_vs_submitdate_days" : 0;
			$pl_cedant_rate = !empty($pl_cedant_rate) ? "$pl_cedant_rate" : 0;
			$sum_insured_orc = !empty($sum_insured_orc) ? "$sum_insured_orc" : 0;
			$pl_tree_si = !empty($pl_tree_si) ? "$pl_tree_si" : 0;
			$paid_amt = !empty($paid_amt) ? "$paid_amt" : 0;
			$tre_share_amt = !empty($tre_share_amt) ? "$tre_share_amt" : 0;
			
			if( $paymentdate_vs_submitdate_days != "" ) {
				if( (int)$paymentdate_vs_submitdate_days > 180 ) {
					$result_paymentdate_vs_submitdate_days_stts = "Reject"; 
				} else {
					$result_paymentdate_vs_submitdate_days_stts = "Ok";
				}
			} else {
				$result_paymentdate_vs_submitdate_days_stts = "NotYet";
			}

			
			$result_pl_cedant_rate = ( floatval($pl_cedant_rate)/floatval($sum_insured_orc) ); 			
			$check_result_pl_tree = ( floatval($pl_tree_si)/floatval($sum_insured_orc) );

			if ( is_infinite($check_result_pl_tree) || is_nan($check_result_pl_tree) ){
				$result_pl_tree = (string)$check_result_pl_tree;
			} else {
				$result_pl_tree = $check_result_pl_tree;
			}

			
			
			$Claim_Paid_TRE_Share_calcByTRE = ($result_pl_tree*$paid_amt);
			$Claim_Paid_TRE_Share_cedantVersionVsTREversion_real =(floatval($Claim_Paid_TRE_Share_calcByTRE) / floatval($tre_share_amt) );
			$Claim_Paid_TRE_Share_cedantVersionVsTREversion_100 =(floatval($Claim_Paid_TRE_Share_calcByTRE) / floatval($tre_share_amt)*100 );
			$Claim_Paid_TRE_Share_cedantVerVsTREver = $Claim_Paid_TRE_Share_cedantVersionVsTREversion_real = '1' ? "Ok" : "Check";
			$result_pl_cedant_rate = !empty($result_pl_cedant_rate) ? "$pl_tree_si" : 0;

		
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
							remark,
							file_name,
							path_file,
							validasi_date,
							no_treaty,
							claim_birth_date,
							pl_birth_date,
							result_birth_date
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
							'$result_pl_cedant_rate', 
							'$pl_tree_si', 
							'$paid_amt', 
							'$tre_share_amt', 
							'$Claim_Paid_TRE_Share_calcByTRE', 
							'$Claim_Paid_TRE_Share_cedantVersionVsTREversion_100', 
							'$Claim_Paid_TRE_Share_cedantVerVsTREver', 
							'$result_overall_claim_stts', 
							NULL,
							'$fileName',
							'$path',
							'now()',
							'$no_treaty',
							$birth_date_claim,
							$birth_date_insured,
							'$result_birth_date'
							) ";


			$dataQuery_q_insert = $database->insert($q_insert);
			$dt_q_insert = $dataQuery_q_insert['data'];

		}
		

		echo json_encode( $dt_q_insert);
	
}



function ceding_name($data){

	
	$database = new Koneksi;
	$sqlQuery = "select tt.ceding_name from tbl_treaty tt where tt.type_of_contract ='Treaty' group by tt.ceding_name
					union		
					select ceding from tbl_insured a group by ceding " ;	
	$dataQuery = $database->db_fetch_array($sqlQuery);


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
	$sqlQuery = "select tt.no_contract from tbl_treaty tt where tt.ceding_name='$data' group by tt.no_contract ";	
	$dataQuery = $database->db_fetch_array($sqlQuery);


	$no_treaty = array();
    if ($dataQuery['success'] && $dataQuery['status']==200) {         
        foreach ($dataQuery['data'] as $key=>$value) {
            $no_treaty[$key] = $value;
        }
    }


	echo  json_encode($no_treaty);

}


function form_setting($data) {
	$db = new Koneksi();

	$sqlQuery = " INSERT INTO public.tbl_setting_uw
	(insured_name, 
	policy_no, 
	certificate_no, 
	inception_date, 
	sum_insured, 
	stnc, 
	days_180_more, 
	pl_cedant_rate, 
	pl_tre, 
	claim_paid_by_cedant_100, 
	claim_paid_tre_share_calc_by_cedant, 
	claim_paid_tre_share_calc_by_tre, 
	check_claim_tre_share, 
	over_all_claim_stts, 
	remark,ceding_name,
	treaty_name,
	days_180_less )
	VALUES(
		'$data[check_insured_name]', 
		'$data[check_policy_no]', 
		'$data[check_certificate_no]', 
		'$data[check_inception_date]', 
		'$data[check_sum_ins]', 
		'$data[check_stnc]', 
		'$data[check_180_days_more]',
		'$data[pl_cedant_rate]', 
		'$data[pl_tre]', 
		'$data[claim_paid_by_cedant]', 
		'$data[claim_paid_tre_share_calc_by_cedant]', 
		'$data[claim_paid_tre_share_calc_by_tre]', 
		'$data[check_claim_tre_share_stts]', 
		'0',
		'$data[remark]',
		'$data[ceding_name]',
		'$data[treaty_name]',
		'$data[check_180_days_less]'
	 ) ";
	

	$dataQuery = $db->insert($sqlQuery);
	$dt_q_insert = $dataQuery['data'];

	echo json_encode( $dt_q_insert);

}


function validasi_login($data){

	$username = $data['data']['username'];
	$password = $data['data']['password'];


	if( !empty($username) and !empty($password) ) {

			$database = new Koneksi; 
			 $sqlQuery = "select * FROM tbl_users_claim WHERE username='$username' and password=md5('$password') ";										
			//$sqlQuery = "select * FROM tbl_users_claim WHERE username='$username' and password='$password' ";										

			

			$dataQuery = $database->db_fetch_obj($sqlQuery);

			// echo "dataQuery: ";
			// print_r($dataQuery);
			// die;

			
			if( $dataQuery['success'] && $dataQuery['status']==200 && !empty($dataQuery['data']) ){
				if( md5($password) == $dataQuery['data']['password'] ) {
					session_start();
					$_SESSION["username"] = $dataQuery['data']['username'];
					// header("Location: dashboard");

					// echo "username: ";
					// print_r($_SESSION["username"] );
					// die;

					echo json_encode($dataQuery['data']['username']);
				} else {
					echo json_encode("different_passwd");
				}
			} else {
				echo json_encode("empty");
			}
		}
}




function list_insured($data){

	$upload_number = $data['upload_number'];
	$file_name = $data['file_name'];


	if( !empty($username) and !empty($password) ) {

			$database = new Koneksi; 
			$sqlQuery = "select * FROM tbl_users_claim WHERE username='$username' and password=md5('$password') ";										
			$dataQuery = $database->db_fetch_obj($sqlQuery);

			
			if( $dataQuery['success'] && $dataQuery['status']==200 && !empty($dataQuery['data']) ){
				if( md5($password) == $dataQuery['data']['password'] ) {
					session_start();
					$_SESSION["username"] = $dataQuery['data']['username'];
					// header("Location: dashboard");
					echo json_encode($dataQuery['data']['username']);
				} else {
					echo json_encode("different_passwd");
				}
			} else {
				echo json_encode("empty");
			}
		}
}

?>