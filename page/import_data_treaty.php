<?php
require_once('koneksi.php');
ini_set('display_errors', 'On');

// session_start();
// echo "SESSION= ";print_r($_SESSION);
if(!strlen(trim($_SESSION['username']))) {
  // session_destroy();
  unset($_SESSION["username"]);
  header("Location:index");
  exit();
  }


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>data claim</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sweetalert2.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />    
		<link href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
		<link href='https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
		
		<!-- <link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
		<!-- <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    

    


		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		fieldset.scheduler-border {
			border: 1px groove #ddd !important;
			padding: 0 1.4em 1.4em 1.4em !important;
			margin: 0 0 1.5em 0 !important;
			-webkit-box-shadow:  0px 0px 0px 0px #000;
					box-shadow:  0px 0px 0px 0px #000;
		}

		legend.scheduler-border {
			font-size: 1.2em !important;
			font-weight: bold !important;
			text-align: left !important;
			width:auto;
			padding:0 10px;
			border-bottom:none;
		}
		.res_column{
			background-color: lightgoldenrodyellow;
		}
	
		.centered {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		.freeze {
			background: #e9e9e9;   
			display: none;        
			position: absolute;   
			top: 0;               
			right: 0;             
			bottom: 0;
			left: 0;
			opacity: 0.5;
			}

			.row_selected td {
    			background-color: black !important; /* Add !important to make sure override datables base styles */
 			}

			 @media screen and (min-width: 676px) {
				.modal-dialog {
				max-width: 900px; /* New width for default modal */
				}
			}

			table.dataTable tr th.select-checkbox.selected::after {
				content: "✔";
				margin-top: -11px;
				margin-left: -4px;
				text-align: center;
				text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
			}

		</style>

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/sweetalert2.all.min.js"></script>
		

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body class="bodypage">
		<!-- Membuat Menu Header / Navbar -->

<fieldset class="scheduler-border">
<form>
                
	<div class="col-sm-12 " style="background-color: ;">
		<p>
				<label class="control-label" for="ceding_name">Ceding Name</label>
				<select name="ceding_name" id="ceding_name" class="form-control" style="width:100%" >
					<option value=""> - </option>
				</select>
		</p>
    </div>
    <div class="col-sm-12 " style="background-color: ;">
        <p>
				<label class="control-label" for="treaty_name">Treaty Name</label>
				<select name="treaty_name" id="treaty_name" class="form-control" style="width:100%" >
				<option value=""> - </option>
				</select>
		</p>
    </div>
    
	<div class="col-sm-12 " style="background-color: ;">
		<p></p>
    </div>


<div class="col-xs-12">
  <div class="form-group">
<!--	<input type="file" name="sortdata" id="sortdata" class="btn btn-success btn-sm pull-left"></input> -->
	<input id="sortdata" name="sortdata" type="file" class="file" data-show-preview="false">
  </div>
</div>
<div class="col-xs-12">
  <div class="form-group">
    <button id="upload" type="button" name="upload" class="dt-button buttons-csv buttons-html5 btn-sm pull-left">
		<!-- <span class="glyphicon glyphicon-eye-open"></span> -->
		 Upload
	</button>
	<button id="download_format_excel" type="button" name="download_format_excel" class="dt-button buttons-csv buttons-html5 btn-sm pull-left">
		<a href='./PHPExcel/template_upload.xlsx' target='__self'>Download Template Upload</a>
	</button>
  </div>
</div>

<div class="form-group">
    <input id="upload_number" type="text" name="upload_number" style="display: none;" class="" />
</div>
  <div>
	<div id="progressBar" class="progress" style="width:100%;height:100px; display: none;"> </div>
	<h3 id="status"></h3>
	<p id="loaded_n_total"></p>
	</div>
	
</form>
</fieldset>

	<div>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data Upload </legend>		
			    <div class="position-relative ">
                  	<div class="table-responsive">
							<table class="table table-bordered" id="table-data-insured">
							<thead>
								<tr>
									<th>No.</th> 
									<th>Nama File</th>
									<th>Ceding</th>
									<th>Nama Treaty</th> 
									<th>Upload No.</th> 
									<th>Detail</th>
									<th>Validasi Data</th>
								</tr>
							</thead>
							<tbody></tbody>	
							</table>
				
					</div>
				</div>
		</fieldset>
		</div>

	
			
		<div>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data Hasil Upload </legend>		
			    <div class="position-relative ">
                  	<div class="table-responsive">
							<table class="table table-bordered" id="table-data-insured-detail">
							<thead>
								<tr>
									<th>No.</th> 
									<th>Nama Ceding</th>
									<th>Nama Treaty</th>
									<th>Upload No</th>
									<th>No. Klaim Ceding </th>
									<th>No Polis</th>
									<th>No. Certificate</th>
									<th>Nama Insured</th>
									<th>TGL Effective</th>
									<th>Sum Assured</th>
									<th>Benefit</th>
									<th>Tgl Event</th>
									<th>Tgl Kirim</th>
									<th>Tgl Complate</th>
									<th>Tgl Approve</th>
									<th>Tgl Bayar</th>
									<th>Investigasi</th>
									<th>Idr</th>
									<th>Jumlah Submission</th>
									<th>Jumlah Approved</th>
									<th>Jumlah Bayar</th>
									<th>Ket Diagnosis</th>
									<th>Jml tre share</th>
									<th>Tgl Kirim ke Reins</th>
									<th>SLA</th>
									<th>Tre SI</th>
									<th>Rate Ceding</th>
									<th>Tgl Lhr</th>
									<th>STNC</th>
									<th>Tgl Upload</th>
									<th>Nama File</th>
									<th>Lokasi File </th>
									
								</tr>
							</thead>
							<tbody></tbody>	
							</table>
				
					</div>
				</div>
		</fieldset>
		</div>
		

		
		<div class="" >
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data Validasi </legend>		
		<div class="position-relative ">
		<div class="table-responsive">
        <p><h1></h1></p>
        <div >
            <table id='tbl_claim_check_result' class='table table-bordered'>
								<thead>
								<tr>
									<th>No.</th> 
									<th>Nama File</th>
							<!--	<th>tgl validasi</th> -->
									<th>Detail Data Validasi</th> 
									<th>Detail Data Settle</th> 
								</tr>
								</thead>
                 
            </table>
        </div>
		</div>
   </div>
		</fieldset>
</div>
		
	
		<div class="" >
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data setelah Validasi </legend>		
		<div class="position-relative ">
		<div class="table-responsive">
        <p><h1></h1></p>
		<div>
			<input type="checkbox" id="selectAll" class="selectAll" name="selectAll" value="all" />  Pilih Semua
		</div>
		<br>
        <div >
            <table id='tbl_claim_check_result_detail' class='table table-bordered'>
								<thead>
								<tr>
									<!--
									<th></th>
									<th>No.</th> 
									<th>Id.</th>
									<th>claim_insd_name</th>
									<th>pl_insd_name</th>
									<th>result_insd_name</th>
									<th>claim_policy_no</th>
									<th>pl_policy_no</th>
									<th>result_policy_no</th>
									<th>claim_certificate_no</th>
									<th>pl_certificate_no</th>
									<th>result_certificate_no</th>
									<th>claim_effective_date</th>
									<th>pl_inception_date</th>
									<th>result_efective_inception</th>
									<th>claim_submit</th>
									<th>pl_sum_insd</th>
									<th>result_claim_submit_pl_sum_insd</th>
									<th>claim_event</th>
									<th>stnc</th>
									<th>result_claim_event_stnc</th>
									<th>payment_date_submit_date_days</th>
									<th>result_payment_date_submit_date_status</th>
									<th>pl_cedant_ret</th>
									<th>pl_tre</th>
									<th>claim_paid_by_cedant</th>
									<th>claim_paid_tre_share_calc_by_cedant</th>
									<th>claim_paid_tre_share_calc_by_tre</th>
									<th>check_claim_tre_share_cedant_vs_tre</th>
									<th>result_check_claim_tre_share_cedant_vs_tre</th>
									<th>result_overall_clm_status</th>
									<th>remark</th>
									<th>file name</th>
									<th>path file</th>
									<th>tgl validasi</th> 
									<th>no treaty</th> 
									-->


									<th></th>
									<th>No.</th>
									<th>Id.</th>        
									<th>Excel Insured</th>
									<th>Weblife Insured</th>
									<th>Check Insured</th>
									<th>Excel Policy No</th>
									<th>Weblife Policy No</th>
									<th>Check Policy No</th>
									<th>Excel Certificate</th>
									<th>Weblife Certificate</th>
									<th>Check Excel Certificate</th>
									<th>Excel Tgl Lhr</th>
									<th>Weblife Tgl Lhr</th>
									<th>Check Tgl Lhr</th>
									<th>Excel Effective Date</th>
									<th>Weblife Inception Date</th>
									<th>Check Effective vs Inception</th>
									<th>Excel Claim Submit 100%</th>
									<th>Weblife Sum Insd 100%</th>
									<th>Check Claim Submit vs PL Sum Insured</th>
									<th>Excel Claim Event Date</th>
									<th>Excel STNC</th>
									<th>Check Claim Event vs STNC</th>
									<th>Payment Date vs Submit Date Days</th>
									<th>Payment Date vs Submit Date Days Status</th>
									<th>Excel Cedant Rate</th>
									<th>Excel TRE</th>
									<th>Claim Paid by Cedant 100%</th>
									<th>Claim Paid TRE Share (calc by Cedant)</th>
									<th>Claim Paid TRE Share (calc by TRE)</th>
									<th>Check Claim TRE Share (Cedant Version vs TRE Version %)</th>
									<th>Check Claim TRE Share (Cedant ver vs TRE ver status)</th>
									<th>Overall Claim Status</th>
									<th>Remark</th>	
									<th>Nama File</th>
									<th>Lokasi File</th>
									<th>Tgl Validasi</th>
									<th>No Treaty</th> 

								</tr>
								</thead>
                 
            			</table>
        			</div>
				</div>
   			</div>
		</fieldset>
		</div>

		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data Settle </legend>		
		<div class="position-relative ">
		<div class="table-responsive">
        <p><h1></h1></p>
		<div>
			
		</div>
		<br>
        <div >
            <table id="tbl_settle" class='table table-bordered'>
								<thead>
								<tr>
									<!--
									<th></th>
									<th>No.</th> 
									<th>Id.</th>
									<th>claim_insd_name</th>
									<th>pl_insd_name</th>
									<th>result_insd_name</th>
									<th>claim_policy_no</th>
									<th>pl_policy_no</th>
									<th>result_policy_no</th>
									<th>claim_certificate_no</th>
									<th>pl_certificate_no</th>
									<th>result_certificate_no</th>
									<th>claim_effective_date</th>
									<th>pl_inception_date</th>
									<th>result_efective_inception</th>
									<th>claim_submit</th>
									<th>pl_sum_insd</th>
									<th>result_claim_submit_pl_sum_insd</th>
									<th>claim_event</th>
									<th>stnc</th>
									<th>result_claim_event_stnc</th>
									<th>payment_date_submit_date_days</th>
									<th>result_payment_date_submit_date_status</th>
									<th>pl_cedant_ret</th>
									<th>pl_tre</th>
									<th>claim_paid_by_cedant</th>
									<th>claim_paid_tre_share_calc_by_cedant</th>
									<th>claim_paid_tre_share_calc_by_tre</th>
									<th>check_claim_tre_share_cedant_vs_tre</th>
									<th>result_check_claim_tre_share_cedant_vs_tre</th>
									<th>result_overall_clm_status</th>
									<th>remark</th>
									<th>file name</th>
									<th>path file</th>
									<th>tgl Generate</th>  -->

									
									
							<th>No.</th>
							<th>Id.</th>        
							<th>Excel Insured</th>
							<th>Weblife Insured</th>
							<th>Check Insured</th>
							<th>Excel Policy No</th>
							<th>Weblife Policy No</th>
							<th>Check Policy No</th>
							<th>Excel Certificate</th>
							<th>Weblife Certificate</th>
							<th>Check Excel Certificate</th>
							<th>Excel Effective Date</th>
							<th>Weblife Inception Date</th>
							<th>Effective vs Inception</th>
							<th>Excel Claim Submit 100%</th>
							<th>Weblife Sum Insd 100%</th>
							<th>Check Claim Submit vs PL Sum Insured</th>
							<th>Excel Claim Event Date</th>
							<th>Excel STNC</th>
							<th>Check Claim Event vs STNC</th>
							<th>Payment Date vs Submit Date Days</th>
							<th>Payment Date vs Submit Date Days Status</th>
							<th>Excel Cedant Rate</th>
							<th>Excel TRE</th>
							<th>Claim Paid by Cedant 100%</th>
							<th>Claim Paid TRE Share (calc by Cedant)</th>
							<th>Claim Paid TRE Share (calc by TRE)</th>
							<th>Check Claim TRE Share (Cedant Version vs TRE Version %)</th>
							<th>Check Claim TRE Share (Cedant ver vs TRE ver status)</th>
							<th>Overall Claim Status</th>
							<th>Remark</th>	
                            <th>Nama File</th>
                            <th>Lokasi File</th>
                            <th>Tgl Generate</th>
                            
							

								</tr>
								</thead>
                 
            			</table>
        			</div>
				</div>
   			</div>
		</fieldset>


		<div id="wait" class="centered" >
		<img alt="" src="css/Spinner.gif" class='preloading_image' id="actual_image1-pre">
        </div>
		
<div class="modal" id="DescModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

		<div class="modal-header">
			<h4 class="modal-title"><span id="detail_name"></span></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		</div>
            <div class="modal-body">
            <div class="row dataTable">
				 <div class="col-md-12">
            	 </div>
			<form id="form_settle">
								<div class="form-horizontal">
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">insured name #</label>
										<div class="controls col-xs-4">
												<select name="result_insd_name" id="result_insd_name" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
						
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">policy no. #</label>
										<div class="controls col-xs-4">
												<select name="result_policy_no" id="result_policy_no" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
							
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">certificate no. #</label>
										<div class="controls col-xs-4">
												<select name="result_certificate_no" id="result_certificate_no" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
						
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">efective vs inception #</label>
										<div class="controls col-xs-4">
												<select name="result_efective_inception" id="result_efective_inception" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
                      
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">claim submit vs pl sum insured #</label>
										<div class="controls col-xs-4">
												<select name="result_claim_submit_pl_sum_insd" id="result_claim_submit_pl_sum_insd" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
	
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">claim event vs stnc #</label>
										<div class="controls col-xs-4">
												<select name="result_claim_event_stnc" id="result_claim_event_stnc" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
									
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">payment date vs submit date days status #</label>
										<div class="controls col-xs-4">
												<select name="result_payment_date_submit_date_status" id="result_payment_date_submit_date_status" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
									
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">check claim tre share cedant vs tre #</label>
										<div class="controls col-xs-4">
												<select name="result_check_claim_tre_share_cedant_vs_tre" id="result_check_claim_tre_share_cedant_vs_tre" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>
									
									<div class="control-group form-inline">
										<label for="name" class="control-label col-xs-8">overall claim status #</label>
										<div class="controls col-xs-4">
												<select name="result_overall_clm_status" id="result_overall_clm_status" class="form-control" style="width:200px" >
													<option value="Ok"> Ok </option>
													<option value="NotYet"> NotYet </option>
													<option value="Check"> Check </option>	
												</select>
										</div>
									</div>				
                                </div>
								<br>
								<div class="modal-footer">
									<button type="button" id="btn_save_settle" name="btn_save_settle" class="dt-button " data-dismiss="modal">Simpan!</button>
									<button type="button" data-dismiss="modal" class="dt-button">Tutup</button>
								</div>
						</form>
                    
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



		

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<!--     
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>-->
<script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script> 

 
		<script>
		var tabel = null;
		var tbl_claim_check_result = null;
		var tabel_insured = null;
		// var server = "http://localhost:90/data_claim/";

		$(document).ready(function() {
			$("#wait").hide();
			
			
			show_tabel_insured();
			show_tbl_claim_check_result();
			
			
		function show_tabel_insured(){
		
				tabel_insured = $('#table-data-insured').DataTable({
				lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
                
				'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": "view_validasi.php"
                },
				// rowId: 'id',
				select: true,
                pageLength: 5,
		        "columns": [						
							{ "data": "no" },
							{ "data": "file_name" },  
							{ "data": "ceding_name" }, 
							{ "data": "treaty_name" }, 
							{ "data": "upload_number" },   	
							// { "mRender": function(data, type, full) {
								// return '<a class="btn btn-info btn-sm getx" href=#/' + full[0] + '>' + 'Detail' + '</a>';
							  // }
							// },
							
							{
								'data': null,
								'render': function (data, type, row) {
											return '<button class="dt-button btn-sm getx" id="' + row.file_name +'" >Detail</button>'
										}
							},
							{
								'data': null,
								'render': function (data, type, row) {
											return '<button class="dt-button btn-sm getValidasiData" id="' + row.file_name +'" >Validasi Data</button>'
										}
							},
		        ],
					
		    });	
			
			
			
			$('#table-data-insured tbody').on('click', '.getx', function () {
					  var fila = $(this).closest("tr");
					  var data = tabel_insured.row( fila ).data();
					  console.log(data);
					  
					  var ceding_name = data.ceding_name;
					  var file_name = data.file_name;
					  // var id = data.id;
					  var treaty_name = data.treaty_name;
					  var upload_number = data.upload_number; 
					  detail_validasi_insured(file_name,upload_number,"list_insured");
					  detail_check_result_validasi(file_name,"","");
				});
				
				$('#table-data-insured tbody').on('click', '.getValidasiData', function () {
					  var fila = $(this).closest("tr");
					  var data = tabel_insured.row( fila ).data();
					  console.log('data= ',data);
					  
					  var ceding_name = data.ceding_name;
					  var file_name = data.file_name;
					  var id = data.id;
					  var treaty_name = data.treaty_name;
					  var upload_number = data.upload_number; 
					  cek_validasi_data(file_name,upload_number,ceding_name,treaty_name); 
				});
			
		}
		    
			
				
				
		
		
		
		function detail_validasi_insured(par1,par2,par3) {		
		
			$("#table-data-insured-detail").dataTable().fnDestroy();

		    tabel = $('#table-data-insured-detail').DataTable({
				lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
				 "bDestroy": true,
				'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
				"ajax": {
					"url": 'view_tbl_claim_bm.php',
					"type": 'POST',
					"data":  {
						file_name:par1,
						upload_number:par2
						}
				},
				// rowId: 'id',
				select: true,
				// responsive: true,
                pageLength: 5,
		        "columns": [						
							{ "data": "no" },
							{ "data": "ceding_name" }, 
							{ "data": "treaty_name" }, 
							{ "data": "upload_number" }, 
							{ "data": "cedant_clm_nbr" }, 
							{ "data": "policy_no" },  
							{ "data": "certificate_no" },  
							{ "data": "insured_name" },  
							{ "data": "effective_date" },  
							{ "data": "sum_assured",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "benefit" },  
							{ "data": "event_date" },  
							{ "data": "submit_date" },  
							{ "data": "complate_date" },  
							{ "data": "approval_date" },  
							{ "data": "payment_date" },  
							{ "data": "investigation" },  
							{ "data": "curr_idr" },  
							{ "data": "submission_amt",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "approved_amt",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "paid_amt",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "diagnosis_desc" },  
							{ "data": "tre_share_amt",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "sent_to_reinsr_date" },  
							{ "data": "sla" },  
							{ "data": "tre_si",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "cedant_rate",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data": "birth_date" },  
							{ "data": "stnc" }, 
							{ "data": "upload_date" },  
							{ "data": "file_name" },  
							{ "data": "path_file" }
				
		        ],
		    });
			$('#table-data-insured-detail').DataTable().ajax.reload(); 
			
			

		}
		
		
		
		function show_tbl_claim_check_result(tbl_claim_check_result){
				tbl_claim_check_result = $('#tbl_claim_check_result').DataTable({
				lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
                
				'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": "view_tbl_claim_check_result.php" 
                },
				select: true,
                pageLength: 5,
		        "columns": [						
							{ "data": "no" }, 
							{ "data": "file_name" },  
							// { "data": "validasi_date" }, 
							// { "data": "validasi_date" }
							{
								'data': null,
								'render': function (data, type, row) {
											return '<button class="dt-button btn-sm getDtRes" id="' + row.file_name +'" >Detail</button>'
										}
							},
							{
								'data': null,
								'render': function (data, type, row) {
											return '<button class="dt-button btn-sm getDtSettle" id="BtnDtSettle" >Detail Data Settle</button>'
										}
							},
							
		        ],
		    });
			
			
			$('#tbl_claim_check_result tbody').on('click', '.getDtRes', function () {
					  var fila = $(this).closest("tr");
					  var data = tbl_claim_check_result.row( fila ).data();
					  console.log(data);
					  
					  var validasi_number = null;
					  
					  var file_name = data.file_name;
					  var id = data.id;
					  var validasi_date = null;
					  detail_check_result_validasi(file_name,validasi_date,validasi_number);
					  
				});

			$('#tbl_claim_check_result tbody').on('click', '.getDtSettle', function () {
					  var fila = $(this).closest("tr");
					  var data = tbl_claim_check_result.row( fila ).data();
					  console.log(data);
					  
					  var validasi_number = null;
					  
					  var file_name = data.file_name;
					  var id = data.id;
					  var validasi_date = null;
					  detail_data_settle(file_name,validasi_date,validasi_number);
				});

		}
		
				
		var empDataTable;
	    
		function detail_check_result_validasi(file_name,validasi_date,validasi_number) {	
			
			$("#tbl_claim_check_result_detail").dataTable().fnDestroy();
		    empDataTable = $('#tbl_claim_check_result_detail').DataTable({
				lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
                dom: 
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
				// buttons: [ 'csv','excel' ],
				buttons: [
					{
					className:'dt-button',
					extend: 'excel',
					text : 'Export to Excel',
					filename: function(){
									var d = new Date();
									var year = d.getFullYear();
									var month = (d.getMonth()+1);
									var day = d.getDate();
									var hours = d.getHours();
									var minutes = d.getMinutes();
									var ms = d.getMilliseconds();
									return 'excel_' + year+'-'+month+'-'+day+'-'+hours+'-'+minutes+'-'+ms;
								}
					},
					{
					className:'dt-button',
					extend: 'csv',
					text : 'Export to CSV',
					filename: function(){
						var d = new Date();
									var year = d.getFullYear();
									var month = (d.getMonth()+1);
									var day = d.getDate();
									var hours = d.getHours();
									var minutes = d.getMinutes();
									var ms = d.getMilliseconds();
									return 'csv_' + year+'-'+month+'-'+day+'-'+hours+'-'+minutes+'-'+ms;
								}
					},
					{
					// extend: 'copyHtml5',
					className:'dt-button',
					text: 'Generate Data Settle',
					attr:  {
							id: 'btn_generate_settle'
						}
					},	
				],
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": "view_tbl_claim_check_result_detail.php",
					"type": 'POST',
					"data":  {
						file_name:file_name,
						validasi_date:validasi_date,
						validasi_number:validasi_number
						}
                },
				// responsive: true,
    			// altEditor: true,   
				// scrollY:        "300px",
				// scrollX:        true,
				// scrollCollapse: true,  
                // pageLength: 10000,
				select: true,
                pageLength: 5,
                'columns': [  
							{
								data: null, 
								defaultContent: '<unout type="checkbox" class="" />',
								className: 'select-checkbox',
								orderable: false
							},
							// { "data":"no" ,"title": "No.","width":"50%"},
							// { "data":"id" ,"title": "id","visible": false},
							// { "data":"claim_insd_name","title": "Claim Insd Name","width":"100%"},
							// { "data":"pl_insd_name","title": "PL Insd Name",},
							// { "data":"result_insd_name", "title": "Insd Name",}, 
							// { "data":"claim_policy_no", "title": "Claim Policy No",},
							// { "data":"pl_policy_no", "title": "PL Policy No",},
							// { "data":"result_policy_no", "title": "Policy No",},
							// { "data":"claim_certificate_no", "title": "Claim Certificate",},
							// { "data":"pl_certificate_no", "title": "PL Certificate",},
							// { "data":"result_certificate_no", "title": "Certificate",},
							// { "data":"claim_effective_date", "title": "Claim Effective Date",},
							// { "data":"pl_inception_date", "title": "PL Inception Date",},
							// { "data":"result_efective_inception", "title": "Effective vs Inception",},
							// { "data":"claim_submit", "title": "Claim Submit 100%",render: $.fn.dataTable.render.number( ',', '.', 2 )},
							// { "data":"pl_sum_insd", "title": "PL Sum Insd 100%",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							// { "data":"result_claim_submit_pl_sum_insd", "title": "Claim Submit vs PL Sum Insured ",},
							// { "data":"claim_event", "title": "Claim Event ",},
							// { "data":"stnc", "title": "STNC ",},
							// { "data":"result_claim_event_stnc", "title": "Claim Event vs STNC",}, 
							// { "data":"payment_date_submit_date_days", "title": "Payment Date vs Submit Date Days",}, 
							// { "data":"result_payment_date_submit_date_status", "title": "Payment Date vs Submit Date Days Status",}, 
							// { "data":"pl_cedant_ret", "title": "PL Cedant Ret",}, 
							// { "data":"pl_tre", "title": "PL TRE",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							// { "data":"claim_paid_by_cedant", "title": "Claim Paid by Cedant 100%",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							// { "data":"claim_paid_tre_share_calc_by_cedant", "title": "Claim Paid TRE Share (calc by Cedant)",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							// { "data":"claim_paid_tre_share_calc_by_tre", "title": " Claim Paid TRE Share (calc by TRE)",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							// { "data":"check_claim_tre_share_cedant_vs_tre", "title": " Check Claim TRE Share (Cedant Version vs TRE Version)",}, 
							// { "data":"result_check_claim_tre_share_cedant_vs_tre", "title": "Check Claim TRE Share (Cedant ver vs TRE ver)",}, 
							// { "data":"result_overall_clm_status", "title": "Overall Claim Status",}, 
							// { "data":"remark"}, 			
							// { "data":"file_name", "title": "nama file",}, 
							// { "data":"path_file", "title": "path file",}, 
							// { "data":"validasi_date", "title": "tgl validasi",},
							// { "data":"no_treaty", "title": "No Treaty",}

							
							{ "data":"no" },
							{ "data":"id" ,"visible": false},
							{ "data":"claim_insd_name"},
							{ "data":"pl_insd_name"},
							{ "data":"result_insd_name"},
							{ "data":"claim_policy_no"},
							{ "data":"pl_policy_no"},
							{ "data":"result_policy_no"},
							{ "data":"claim_certificate_no"},
							{ "data":"pl_certificate_no"},
							{ "data":"result_certificate_no"},

							{ "data":"claim_birth_date"},
							{ "data":"pl_birth_date"},
							{ "data":"result_birth_date"},

							{ "data":"claim_effective_date"},
							{ "data":"pl_inception_date"},
							{ "data":"result_efective_inception"},
							{ "data":"claim_submit", render: $.fn.dataTable.render.number( ',', '.', 2 )},
							{ "data":"pl_sum_insd", render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"result_claim_submit_pl_sum_insd"},
							{ "data":"claim_event"},
							{ "data":"stnc"},
							{ "data":"result_claim_event_stnc"},
							{ "data":"payment_date_submit_date_days"},
							{ "data":"result_payment_date_submit_date_status"},
							{ "data":"pl_cedant_ret"},
							{ "data":"pl_tre",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_by_cedant",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_cedant",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_tre",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_overall_clm_status"},
							{ "data":"remark"}, 			
							{ "data":"file_name"},
							{ "data":"path_file"},
							{ "data":"validasi_date"},
							{ "data":"no_treaty"},
							
							
					],
					'rowCallback': function(row, data, index){
						
						/*
						data['result_insd_name'] == "Ok" ? $(row).find('td:eq(4)').css('color', 'green') : $(row).find('td:eq(4)').css('color', 'red');
						data['result_policy_no'] == "Ok" ? $(row).find('td:eq(7)').css('color', 'green') : $(row).find('td:eq(7)').css('color', 'red');
						data['result_certificate_no'] == "Ok" ? $(row).find('td:eq(10)').css('color', 'green') : $(row).find('td:eq(10)').css('color', 'red');
						data['result_birth_date'] == "Ok" ? $(row).find('td:eq(13)').css('color', 'green') : $(row).find('td:eq(13)').css('color', 'red');
						data['result_efective_inception'] == "Ok" ? $(row).find('td:eq(16)').css('color', 'green') : $(row).find('td:eq(16)').css('color', 'red');
						data['result_claim_submit_pl_sum_insd'] == "Ok" ? $(row).find('td:eq(19)').css('color', 'green') : $(row).find('td:eq(19)').css('color', 'red');
						data['result_claim_event_stnc'] == "Ok" ? $(row).find('td:eq(22)').css('color', 'green') : $(row).find('td:eq(22)').css('color', 'red');
						data['result_payment_date_submit_date_status'] == "Ok" ? $(row).find('td:eq(24)').css('color', 'green') : $(row).find('td:eq(24)').css('color', 'red');
						data['result_check_claim_tre_share_cedant_vs_tre'] == "Ok" ? $(row).find('td:eq(31)').css('color', 'green') : $(row).find('td:eq(31)').css('color', 'red');
						data['result_overall_clm_status'] == "Ok" ? $(row).find('td:eq(32)').css('color', 'green') : $(row).find('td:eq(32)').css('color', 'red');
						*/

						if( data['result_insd_name'] == "Ok" ) { $(row).find('td:eq(4)').css('color', 'green'); } 
						else if ( data['result_insd_name'] == "Check" ){ $(row).find('td:eq(4)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(4)').css('color', 'red'); }

						if( data['result_policy_no'] == "Ok" ) { $(row).find('td:eq(7)').css('color', 'green'); } 
						else if ( data['result_policy_no'] == "Check" ){ $(row).find('td:eq(7)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(7)').css('color', 'red'); }

						if( data['result_certificate_no'] == "Ok" ) { $(row).find('td:eq(10)').css('color', 'green'); } 
						else if ( data['result_certificate_no'] == "Check" ){ $(row).find('td:eq(10)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(10)').css('color', 'red'); }

						if( data['result_certificate_no'] == "Ok" ) { $(row).find('td:eq(13)').css('color', 'green'); } 
						else if ( data['result_certificate_no'] == "Check" ){ $(row).find('td:eq(13)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(13)').css('color', 'red'); }

						if( data['result_claim_submit_pl_sum_insd'] == "Ok" ) { $(row).find('td:eq(19)').css('color', 'green'); } 
						else if ( data['result_claim_submit_pl_sum_insd'] == "Check" ){ $(row).find('td:eq(19)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(19)').css('color', 'red'); }

						if( data['result_claim_submit_pl_sum_insd'] == "Ok" ) { $(row).find('td:eq(19)').css('color', 'green'); } 
						else if ( data['result_claim_submit_pl_sum_insd'] == "Check" ){ $(row).find('td:eq(19)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(19)').css('color', 'red'); }

						if( data['result_claim_event_stnc'] == "Ok" ) { $(row).find('td:eq(22)').css('color', 'green'); } 
						else if ( data['result_claim_event_stnc'] == "Check" ){ $(row).find('td:eq(22)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(22)').css('color', 'red'); }

						if( data['result_payment_date_submit_date_status'] == "Ok" ) { $(row).find('td:eq(24)').css('color', 'green'); } 
						else if ( data['result_payment_date_submit_date_status'] == "Check" ){ $(row).find('td:eq(24)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(24)').css('color', 'red'); }

						if( data['result_check_claim_tre_share_cedant_vs_tre'] == "Ok" ) { $(row).find('td:eq(31)').css('color', 'green'); } 
						else if ( data['result_check_claim_tre_share_cedant_vs_tre'] == "Check" ){ $(row).find('td:eq(31)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(31)').css('color', 'red'); }

						if( data['result_overall_clm_status'] == "Ok" ) { $(row).find('td:eq(32)').css('color', 'green'); } 
						else if ( data['result_overall_clm_status'] == "Check" ){ $(row).find('td:eq(32)').css('color', 'yellow'); } 
						else { $(row).find('td:eq(32)').css('color', 'red'); }
						
					},
					
					orderable: false,
					columnDefs: [
						{
								orderable: true,
							    className: 'select-checkbox', 
								targets: 0,
								checkboxes: {
									'selectRow': true
								}
							}],
						select: {
								style: 'multi',
								// selector: 'td:first-child'
							}, 
							order: [
								[1, 'asc']
							],
				});

				$('#tbl_claim_check_result_detail').DataTable().ajax.reload(); 
					var  DT1 = $('#tbl_claim_check_result_detail').DataTable();
					$(".selectAll").on( "click", function(e) {
						if ($(this).is( ":checked" )) {
						DT1.rows({page:'current'}  ).select();   
						var data = DT1.rows('.selected').data();
						console.log('data= ', data);
						
					} else {
						DT1.rows({page:'current'}  ).deselect(); 
					}		
				});


			$('#tbl_claim_check_result_detail tbody').on('click', '.row-edit', function () {
					  var fila = $(this).closest("tr");
					  var data = empDataTable.row( fila ).data();
					  console.log(data);
					  console.log('claim_insd_name',data.claim_insd_name);
					  
					  $('#detail_name').html(data.claim_insd_name);

					  switch(data.result_insd_name) {
						case "Ok":
							$('#result_insd_name').val("Ok");
							break;
						case "Check":
							$('#result_insd_name').val("Check");
							break;
						default:
							$('#result_insd_name').val("NotYet");
							break;
						}
						
						switch(data.result_policy_no) {
						case "Ok":
							$('#result_policy_no').val("Ok");
							break;
						case "Check":
							$('#result_policy_no').val("Check");
							break;
						default:
							$('#result_policy_no').val("NotYet");
							break;
						}

						switch(data.result_certificate_no) {
						case "Ok":
							$('#result_certificate_no').val("Ok");
							break;
						case "Check":
							$('#result_certificate_no').val("Check");
							break;
						default:
							$('#result_certificate_no').val("NotYet");
							break;

						}
						
						switch(data.result_efective_inception) {
						case "Ok":
							$('#result_efective_inception').val("Ok");
							break;
						case "Check":
							$('#result_efective_inception').val("Check");
							break;
						default:
							$('#result_efective_inception').val("NotYet");
							break;
						}

						switch(data.result_claim_submit_pl_sum_insd) {
						case "Ok":
							$('#result_claim_submit_pl_sum_insd').val("Ok");
							break;
						case "Check":
							$('#result_claim_submit_pl_sum_insd').val("Check");
							break;
						default:
							$('#result_claim_submit_pl_sum_insd').val("NotYet");
							break;
						}

						switch(data.result_claim_event_stnc) {
						case "Ok":
							$('#result_claim_event_stnc').val("Ok");
							break;
						case "Check":
							$('#result_claim_event_stnc').val("Check");
							break;
						default:
							$('#result_claim_event_stnc').val("NotYet");
							break;
						}

						switch(data.result_payment_date_submit_date_status) {
						case "Ok":
							$('#result_payment_date_submit_date_status').val("Ok");
							break;
						case "Check":
							$('#result_payment_date_submit_date_status').val("Check");
							break;
						default:
							$('#result_payment_date_submit_date_status').val("NotYet");
							break;
						}

						switch(data.result_check_claim_tre_share_cedant_vs_tre) {
						case "Ok":
							$('#result_check_claim_tre_share_cedant_vs_tre').val("Ok");
							break;
						case "Check":
							$('#result_check_claim_tre_share_cedant_vs_tre').val("Check");
							break;
						default:
							$('#result_check_claim_tre_share_cedant_vs_tre').val("NotYet");
							break;
						}


						switch(data.result_overall_clm_status) {
						case "Ok":
							$('#result_overall_clm_status').val("Ok");
							break;
						case "Check":
							$('#result_overall_clm_status').val("Check");
							break;
						default:
							$('#result_overall_clm_status').val("NotYet");
							break;
						}
						$('#DescModal').modal("show");
					//   detail_check_result_validasi(file_name,validasi_date,validasi_number);
					

				});

			$('#tbl_claim_check_result_detail tbody').on('click', '.select-checkbox', function () {

			});

					
			var tablex = $('#tbl_claim_check_result_detail').DataTable();
			
			$('#btn_generate_settle').click( function () {						
				var arr = [], id = [], claim_insd_name = [], pl_insd_name = [], result_insd_name = [], claim_policy_no = [], pl_policy_no = [], result_policy_no = [], claim_certificate_no = [], pl_certificate_no = [], result_certificate_no = [], claim_effective_date = [], pl_inception_date = [], result_efective_inception = [], claim_submit = [], pl_sum_insd = [], result_claim_submit_pl_sum_insd = [], claim_event = [], stnc = [], result_claim_event_stnc = [], payment_date_submit_date_days = [], result_payment_date_submit_date_status = [], pl_cedant_ret = [], pl_tre = [], claim_paid_by_cedant = [], claim_paid_tre_share_calc_by_cedant = [], claim_paid_tre_share_calc_by_tre = [], check_claim_tre_share_cedant_vs_tre = [], result_check_claim_tre_share_cedant_vs_tre = [], result_overall_clm_status = [], remark = [], file_name = [], path_file = [], validasi_date = [];

				console.log('tx= ',tablex.rows('.selected').data().length);

				Swal.fire({
								title: 'Generate Data Settle ',
								text: "",
								icon: 'info',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								// confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.isConfirmed) {

				if( tablex.rows('.selected').data().length > 0 ) {  
					$.map(tablex.rows('.selected').data(), function (value,i) {
								id.push(value.id);
								claim_insd_name.push(value.claim_insd_name);
								pl_insd_name.push(value.pl_insd_name);
								result_insd_name.push(value.result_insd_name);
								claim_policy_no.push(value.claim_policy_no);
								pl_policy_no.push(value.pl_policy_no);
								result_policy_no.push(value.result_policy_no);
								claim_certificate_no.push(value.claim_certificate_no);
								pl_certificate_no.push(value.pl_certificate_no);
								result_certificate_no.push(value.result_certificate_no);
								claim_effective_date.push(value.claim_effective_date);
								pl_inception_date.push(value.pl_inception_date);
								result_efective_inception.push(value.result_efective_inception);
								claim_submit.push(value.claim_submit);
								pl_sum_insd.push(value.pl_sum_insd);
								result_claim_submit_pl_sum_insd.push(value.result_claim_submit_pl_sum_insd); 
								claim_event.push(value.claim_event); 
								stnc.push(value.stnc); 
								result_claim_event_stnc.push(value.result_claim_event_stnc); 
								payment_date_submit_date_days.push(value.payment_date_submit_date_days); 
								result_payment_date_submit_date_status.push(value.result_payment_date_submit_date_status); 
								pl_cedant_ret.push(value.pl_cedant_ret); 
								pl_tre.push(value.pl_tre); 
								claim_paid_by_cedant.push(value.claim_paid_by_cedant); 
								claim_paid_tre_share_calc_by_cedant.push(value.claim_paid_tre_share_calc_by_cedant); 
								claim_paid_tre_share_calc_by_tre.push(value.claim_paid_tre_share_calc_by_tre); 
								check_claim_tre_share_cedant_vs_tre.push(value.check_claim_tre_share_cedant_vs_tre); 
								result_check_claim_tre_share_cedant_vs_tre.push(value.result_check_claim_tre_share_cedant_vs_tre); 
								result_overall_clm_status.push(value.result_overall_clm_status); 
								remark.push(value.remark); 
								file_name.push(value.file_name); 
								path_file.push(value.path_file); 
								validasi_date.push(value.validasi_date); 
					});

					console.log('id=', id);
					console.log('claim_insd_name=', claim_insd_name);

					
					var formdata = new FormData();
					formdata.append("kode", "generate_settle");
					formdata.append("id", id);
					formdata.append("claim_insd_name", claim_insd_name);
					formdata.append("pl_insd_name", pl_insd_name);
					formdata.append("result_insd_name", result_insd_name );
					formdata.append("claim_policy_no", claim_policy_no);
					formdata.append("pl_policy_no", pl_policy_no);
					formdata.append("result_policy_no", result_policy_no );
					formdata.append("claim_certificate_no", claim_certificate_no);
					formdata.append("pl_certificate_no", pl_certificate_no);
					formdata.append("result_certificate_no", result_certificate_no );
					formdata.append("claim_effective_date", claim_effective_date );
					formdata.append("pl_inception_date", pl_inception_date );
					formdata.append("result_efective_inception",result_efective_inception );
					formdata.append("claim_submit", claim_submit );
					formdata.append("pl_sum_insd", pl_sum_insd );
					formdata.append("result_claim_submit_pl_sum_insd", result_claim_submit_pl_sum_insd );
					formdata.append("claim_event", claim_event );
					formdata.append("stnc", stnc );
					formdata.append("result_claim_event_stnc", result_claim_event_stnc );
					formdata.append("payment_date_submit_date_days", payment_date_submit_date_days );
					formdata.append("result_payment_date_submit_date_status", result_payment_date_submit_date_status );
					formdata.append("pl_cedant_ret", pl_cedant_ret );
					formdata.append("pl_tre", pl_tre );
					formdata.append("claim_paid_by_cedant", claim_paid_by_cedant );
					formdata.append("claim_paid_tre_share_calc_by_cedant", claim_paid_tre_share_calc_by_cedant );
					formdata.append("claim_paid_tre_share_calc_by_tre", claim_paid_tre_share_calc_by_tre );
					formdata.append("check_claim_tre_share_cedant_vs_tre", check_claim_tre_share_cedant_vs_tre );
					formdata.append("result_check_claim_tre_share_cedant_vs_tre", result_check_claim_tre_share_cedant_vs_tre );
					formdata.append("result_overall_clm_status", result_overall_clm_status );
					formdata.append("remark", remark );
					formdata.append("file_name", file_name );
					formdata.append("path_file", path_file );
					formdata.append("validasi_date", validasi_date );
								
					$.ajax({
							url: "list_data.php",
							type: "POST",
							data: formdata,
							cache: false,
							contentType: false,
							processData: false,
					success: function(result) {    
							$("#wait").hide();   
							console.log(' result insert data settle= ', result ); 
							if(result){
								Swal.fire("Data Settle berhasil dibuat",'','success')			 
							}else{
								Swal.fire("Data Settle gagal dibuat",'','danger')			 
							}
							// $('#tbl_settle').DataTable().ajax.reload();						
							// $('#table-data-insured').DataTable().ajax.reload(); 
						}
						
					});	
					
				} 
				else {
					Swal.fire("Data Validasi belum dipilih ",'','info')			 
				}	
				
			}

			
			
		});
		
					
		});

		

		}
	
	

		var tbl_settle;
	    
		function detail_data_settle(file_name,validasi_date,validasi_number) {	
			
			$("#tbl_settle").dataTable().fnDestroy();
		    tbl_settle = $('#tbl_settle').DataTable({
				lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
                dom: 
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
				// buttons: [ 'csv','excel' ],
				buttons: [
					{
					className:'dt-button',
					extend: 'excel',
					text : 'Data Claim Settle Export to Excel',
					filename: function(){
									var d = new Date();
									var year = d.getFullYear();
									var month = (d.getMonth()+1);
									var day = d.getDate();
									var hours = d.getHours();
									var minutes = d.getMinutes();
									var ms = d.getMilliseconds();
									return 'excel_' + year+'-'+month+'-'+day+'-'+hours+'-'+minutes+'-'+ms;
								}
					},
					{
					className:'dt-button',
					extend: 'csv',
					text : 'Data Claim Settle Export to CSV',
					filename: function(){
						var d = new Date();
									var year = d.getFullYear();
									var month = (d.getMonth()+1);
									var day = d.getDate();
									var hours = d.getHours();
									var minutes = d.getMinutes();
									var ms = d.getMilliseconds();
									return 'csv_' + year+'-'+month+'-'+day+'-'+hours+'-'+minutes+'-'+ms;
								}
					}
				],
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": "view_tbl_settle_detail.php",
					"type": 'POST',
					"data":  {
						file_name:file_name,
						validasi_date:validasi_date,
						validasi_number:validasi_number
						}
                },
                pageLength: 10000,
                'columns': [  
					
							{ "data":"no"},
							{ "data":"id" ,"title": "id","visible": false},
							{ "data":"claim_insd_name"},
							{ "data":"pl_insd_name"},
							{ "data":"result_insd_name"},
							{ "data":"claim_policy_no"},
							{ "data":"pl_policy_no", "title": "PL Policy No",},
							{ "data":"result_policy_no", "title": "Policy No",},
							{ "data":"claim_certificate_no", "title": "Claim Certificate",},
							{ "data":"pl_certificate_no", "title": "PL Certificate",},
							{ "data":"result_certificate_no", "title": "Certificate",},
							{ "data":"claim_effective_date", "title": "Claim Effective Date",},
							{ "data":"pl_inception_date", "title": "PL Inception Date",},
							{ "data":"result_efective_inception", "title": "Effective vs Inception",},
							{ "data":"claim_submit", "title": "Claim Submit 100%",render: $.fn.dataTable.render.number( ',', '.', 2 )},
							{ "data":"pl_sum_insd", "title": "PL Sum Insd 100%",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"result_claim_submit_pl_sum_insd", "title": "Claim Submit vs PL Sum Insured ",},
							{ "data":"claim_event", "title": "Claim Event ",},
							{ "data":"stnc", "title": "STNC ",},
							{ "data":"result_claim_event_stnc", "title": "Claim Event vs STNC",}, 
							{ "data":"payment_date_submit_date_days", "title": "Payment Date vs Submit Date Days",}, 
							{ "data":"result_payment_date_submit_date_status", "title": "Payment Date vs Submit Date Days Status",}, 
							{ "data":"pl_cedant_ret", "title": "PL Cedant Ret",}, 
							{ "data":"pl_tre", "title": "PL TRE",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_by_cedant", "title": "Claim Paid by Cedant 100%",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_cedant", "title": "Claim Paid TRE Share (calc by Cedant)",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_tre", "title": " Claim Paid TRE Share (calc by TRE)",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"check_claim_tre_share_cedant_vs_tre", "title": " Check Claim TRE Share (Cedant Version vs TRE Version)",}, 
							{ "data":"result_check_claim_tre_share_cedant_vs_tre", "title": "Check Claim TRE Share (Cedant ver vs TRE ver)",}, 
							{ "data":"result_overall_clm_status", "title": "Overall Claim Status",}, 
							{ "data":"remark"}, 			
							{ "data":"file_name", "title": "nama file",}, 
							{ "data":"path_file", "title": "path file",}, 
							{ "data":"settle_date", "title": "tgl Settle",}
							

						/*
							{ "data":"no" },
							{ "data":"id" ,"visible": false},
							{ "data":"claim_insd_name"},
							{ "data":"pl_insd_name"},
							{ "data":"result_insd_name"},
							{ "data":"claim_policy_no"},
							{ "data":"pl_policy_no"},
							{ "data":"result_policy_no"},
							{ "data":"claim_certificate_no"},
							{ "data":"pl_certificate_no"},
							{ "data":"result_certificate_no"},
							{ "data":"claim_effective_date"},
							{ "data":"pl_inception_date"},
							{ "data":"result_efective_inception"},
							{ "data":"claim_submit", render: $.fn.dataTable.render.number( ',', '.', 2 )},
							{ "data":"pl_sum_insd", render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"result_claim_submit_pl_sum_insd"},
							{ "data":"claim_event"},
							{ "data":"stnc"},
							{ "data":"result_claim_event_stnc"},
							{ "data":"payment_date_submit_date_days"},
							{ "data":"result_payment_date_submit_date_status"},
							{ "data":"pl_cedant_ret"},
							{ "data":"pl_tre",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_by_cedant",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_cedant",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"claim_paid_tre_share_calc_by_tre",render: $.fn.dataTable.render.number( ',', '.', 2 ) },  
							{ "data":"check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_overall_clm_status"},
							{ "data":"remark"}, 			
							{ "data":"file_name"}, 
							{ "data":"path_file"}, 
							{ "data":"settle_date"}
					*/							
					],
					'rowCallback': function(row, data, index){
						
						data['result_insd_name'] == "Ok" ? $(row).find('td:eq(3)').css('color', 'green') : $(row).find('td:eq(3)').css('color', 'red');
						data['result_policy_no'] == "Ok" ? $(row).find('td:eq(6)').css('color', 'green') : $(row).find('td:eq(6)').css('color', 'red');
						data['result_certificate_no'] == "Ok" ? $(row).find('td:eq(9)').css('color', 'green') : $(row).find('td:eq(9)').css('color', 'red');
						data['result_efective_inception'] == "Ok" ? $(row).find('td:eq(12)').css('color', 'green') : $(row).find('td:eq(12)').css('color', 'red');
						data['result_claim_submit_pl_sum_insd'] == "Ok" ? $(row).find('td:eq(15)').css('color', 'green') : $(row).find('td:eq(15)').css('color', 'red');
						data['result_claim_event_stnc'] == "Ok" ? $(row).find('td:eq(18)').css('color', 'green') : $(row).find('td:eq(18').css('color', 'red');
						data['result_payment_date_submit_date_status'] == "Ok" ? $(row).find('td:eq(20)').css('color', 'green') : $(row).find('td:eq(20)').css('color', 'red');
						data['result_check_claim_tre_share_cedant_vs_tre'] == "Ok" ? $(row).find('td:eq(27)').css('color', 'green') : $(row).find('td:eq(27)').css('color', 'red');
						data['result_overall_clm_status'] == "Ok" ? $(row).find('td:eq(28)').css('color', 'green') : $(row).find('td:eq(28)').css('color', 'red');
						
					},
				});


		}






	
		$('#btn_save_settle').on('click', function() {
						$("#wait").show();

						Swal.fire({
								title: 'Edit Data! ',
								text: "Edit data untuk Nama '"+$('#detail_name').html()+"' ",
								icon: 'info',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								// confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.isConfirmed) {

								$("#wait").show();
								var formdata = new FormData();
								formdata.append("kode", "generate_settle");
								formdata.append("result_insd_name", $('#result_insd_name').val().trim() );
								formdata.append("result_policy_no", $('#result_policy_no').val().trim() );
								formdata.append("result_certificate_no", $('#result_certificate_no').val().trim() );
								formdata.append("result_efective_inception", $('#result_efective_inception').val().trim() );
								formdata.append("result_claim_submit_pl_sum_insd", $('#result_claim_submit_pl_sum_insd').val().trim() );
								formdata.append("result_claim_event_stnc", $('#result_claim_event_stnc').val().trim() );
								formdata.append("result_payment_date_submit_date_status", $('#result_payment_date_submit_date_status').val().trim() );
								formdata.append("result_check_claim_tre_share_cedant_vs_tre", $('#result_check_claim_tre_share_cedant_vs_tre').val().trim() );
								formdata.append("result_overall_clm_status", $('#result_overall_clm_status').val().trim() );
								
								$.ajax({
									url: "list_data.php",
									type: "POST",
									data: formdata,
									cache: false,
									contentType: false,
									processData: false,
								success: function(output) {    
									$("#wait").hide();   
										console.log(' output= ', output ); 
										// var dt = parseInt(output);
										// console.log('check_data ',dt);
										// if( dt > 0){
										// 	Swal.fire("File sudah ada",'','info')			 
										// }else{
										// 	Swal.fire("Data berhasil di Upload",'','success');
										// } 																
										$('#table-data-insured').DataTable().ajax.reload(); 
										
									}
								})
							}
						})
					});
	
		
			$('#upload').on('click', function() {
						$("#wait").show();
						if ( $('#ceding_name').val() == "" ){
									$("#wait").hide(); 
									Swal.fire("","Nama Ceding belum dipilih",'info');
									return false;
						} 
						// else if ( $('#treaty_name').val() =="" ){
						// 			$("#wait").hide(); 
						// 			Swal.fire("","Nama Treaty belum dipilih",'info');
						// 			return false;
						// }
						else {
							Swal.fire({
								title: 'Upload! ',
								text: "Upload data untuk Ceding '"+$('#ceding_name').val().trim()+"' dan treaty '"+ $('#treaty_name').val().trim()+"' ",
								icon: 'info',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								// confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.isConfirmed) {

								$("#wait").show();
								var file = document.getElementById("sortdata").files[0];
								var formdata = new FormData();
								formdata.append("file", file);
								formdata.append("kode", "upload");
								formdata.append("upload_nmbr", $('#upload_number').val().trim() );
								formdata.append("ceding_name", $('#ceding_name').val().trim() );
								formdata.append("treaty_name", $('#treaty_name').val().trim() );
								
								$.ajax({
									url: "list_data.php",
									type: "POST",
									data: formdata,
									cache: false,
									contentType: false,
									processData: false,
								success: function(output) {    
									$("#wait").hide();   
										console.log(' output= ', output ); 
										var dt = parseInt(output);
										console.log('check_data ',dt);
										if( dt > 0){
											Swal.fire("File sudah ada",'','info')			 
										}else{
											Swal.fire("Data berhasil di Upload",'','success');
										} 																
										$('#table-data-insured').DataTable().ajax.reload(); 
										UPLOAD_NUMBER();
									}
								});
								
							}else {
								$("#wait").hide();
							}
						  })
					   }
					}); 


					
					$('#upload_number').ready(function() {
						UPLOAD_NUMBER(); 
					}); 


					
		function UPLOAD_NUMBER(){
							$("#wait").show();
						// event.preventDefault();       
							$.ajax({
							url: "list_data.php",
								type: "POST",
								dataType: "json",
								data: {
										kode: 'CEK_MAX_UPLOAD_NUMBER', 
										data: ""
									},
								success: function(output) {       
									$("#wait").hide();
									console.log('upload_number ',output);
									
									$('#upload_number').val( output.trim() );
									} 
							}); 
					}
					

						
					function cek_validasi_data(file_name,upload_number,ceding_name,treaty_name) {
							$("#wait").show();
							Swal.fire({
							title: 'Check data!',
							// text: "Akan dilakukan Check data!",
							text: "Akan dilakukan Check data untuk Ceding '"+ceding_name+"' dan treaty '"+ treaty_name +"' ",
							icon: 'info',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							// confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
							if (result.isConfirmed) {

								// var file = document.getElementById("sortdata").files[0];
								var formdata2 = new FormData();
								// formdata2.append("file", file);
								formdata2.append("kode", "CHECK_DATA_CLAIM_TREATY");
								formdata2.append("file_name", file_name );
								formdata2.append("ceding_name", ceding_name );
								formdata2.append("treaty_name", treaty_name);
								formdata2.append("upload_number", upload_number);

								$.ajax({
									url: "list_data.php",
									type: "POST",
									data: formdata2,
									cache: false,
									contentType: false,
									processData: false,

									success: function(output) {       
										$("#wait").hide();
										var dt = parseInt(output);
										console.log('check_data ',dt);
										if( dt > 0){
											Swal.fire("File sudah ada",'','info');
										}else{
											Swal.fire("Data berhasil di validasi",'','success');
										} 
										$('#tbl_claim_check_result').DataTable().ajax.reload(); 
									}

								}); 
							}else {
								$("#wait").hide();
							}
						  })

						// }
						
					}



						

					$('#ceding_name').ready(function() {
						$("#wait").show();
						// event.preventDefault();       
							$.ajax({
							url: "list_data.php",
								type: "POST",
								dataType: "json",
								data: {
										kode: 'ceding_name', 
										data: ""
									},
								success: function(output) {       
									$("#wait").hide();
                                    output.forEach( (val, key) =>  $("#ceding_name").append('<option value="' + val.ceding_name + '">' + val.ceding_name + '</option>')   ); 
									} 
							}); 
						}); 

                        $('#ceding_name').on('click',function() {
						$("#wait").show();
						// event.preventDefault();       
							$.ajax({
							url: "list_data.php",
								type: "POST",
								dataType: "json",
								data: {
										kode: 'treaty_name', 
										data: $('#ceding_name').val().trim()
									},
								success: function(treaty) {       
									$("#wait").hide();
                                    console.log('treaty= ', treaty); 

									$('#treaty_name')
									.find('option')
									.remove()
									.end()
									.append('<option value="">-</option>')
									.val('');

									var listitems = "";
									let no_contract = "";
									let id_treaty_insured = "";
									$.each(treaty, function(key, val){
										no_contract = val.no_contract.toString();
										// id_treaty_insured = val.id.toString();
										console.log('val.no_contract= ',val.no_contract);
										// console.log('val.id= ',val.id);
										listitems += '<option value='+no_contract.toString()+'>'+no_contract.toString()+'</option>';
									});
									$("#treaty_name").append(listitems);
                                    
								} 
							}); 
						}); 

		});

		

		</script>
	</body>
	
</html>