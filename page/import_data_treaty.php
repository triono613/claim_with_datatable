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
		
		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

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
    <button id="upload" type="button" name="upload" class="btn btn-primary buttons-csv buttons-html5 btn-sm pull-left">
		<!-- <span class="glyphicon glyphicon-eye-open"></span> -->
		 Upload
	</button>
  </div>
</div>
<div class="col-xs-0">
  
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
									<th>file name</th>
									<th>ceding</th>
									<th>treaty name</th> 
									<th>upload number</th> 
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
									<th>ceding_name</th>
									<th>treaty_name</th>
									<th>Upload Number</th>
									<th>cedant_clm_nbr</th>
									<th>policy_no</th>
									<th>certificate_no</th>
									<th>insured_name</th>
									<th>effective_date</th>
									<th>sum_assured</th>
									<th>benefit</th>
									<th>event_date</th>
									<th>submit_date</th>
									<th>complate_date</th>
									<th>approval_date</th>
									<th>payment_date</th>
									<th>investigation</th>
									<th>curr_idr</th>
									<th>submission_amt</th>
									<th>approved_amt</th>
									<th>paid_amt</th>
									<th>diagnosis_desc</th>
									<th>tre_share_amt</th>
									<th>sent_to_reinsr_date</th>
									<th>sla</th>
									<th>tre_si</th>
									<th>cedant_rate</th>
									<th>birth_date</th>
									<th>stnc</th>
									<th>Tgl upload</th>
									<th>File Name</th>
									<th>Path File </th>
									
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
									<th>detail</th> 
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
        <div >
            <table id='tbl_claim_check_result_detail' class='table table-bordered'>
								<thead>
								<tr>
									<th>No.</th> 
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
								</tr>
								</thead>
                 
            </table>
        </div>
		</div>
   </div>
		</fieldset>
</div>



		<div id="wait" class="centered" >
		<img alt="" src="css/Spinner.gif" class='preloading_image' id="actual_image1-pre">
        </div>
		


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

		
		
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
											return '<button class="btn btn-info btn-sm getx" id="' + row.file_name +'" >Detail</button>'
										}
							},
							{
								'data': null,
								'render': function (data, type, row) {
											return '<button class="btn btn-info btn-sm getValidasiData" id="' + row.file_name +'" >Validasi Data</button>'
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
											return '<button class="btn btn-info btn-sm getDtRes" id="' + row.file_name +'" >Detail</button>'
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
			
		}
		
				
				
				

	    
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
				
                pageLength: 10000,
				"autoWidth": false, 
                'columns': [ 
							{ "data":"no" ,"title": "No.","width":"50%"},
							{ "data":"claim_insd_name","title": "Claim Insd Name","width":"100%"},
							{ "data":"pl_insd_name","title": "PL Insd Name",},
							{ "data":"result_insd_name", "title": "Insd Name",}, 
							{ "data":"claim_policy_no", "title": "Claim Policy No",},
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
							{ "data":"validasi_date", "title": "tgl validasi",}
					],
				});
				$('#tbl_claim_check_result_detail').DataTable().ajax.reload(); 
			}
	
	
	
		
			$('#upload').on('click', function() {
						$("#wait").show();
						if ( $('#ceding_name').val() == "" ){
									$("#wait").hide(); 
									Swal.fire("","Nama Ceding belum dipilih",'info');
									return false;
						} else if ( $('#treaty_name').val() =="" ){
									$("#wait").hide(); 
									Swal.fire("","Nama Treaty belum dipilih",'info');
									return false;
						}
						else{
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