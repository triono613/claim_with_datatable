<?php
require_once('koneksi.php');
ini_set('display_errors', 'On');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sweetalert2.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />    
		<link href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
		<link href='https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

		
		

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
	<body>
		<!-- Membuat Menu Header / Navbar -->

<fieldset class="scheduler-border">
<form>
	
<div class="col-xs-3">
  <div class="form-group">
<!--	<input type="file" name="sortdata" id="sortdata" class="btn btn-success btn-sm pull-left"></input> -->
	<input id="input-b2" name="input-b2" type="file" class="file" data-show-preview="false">
  </div>
</div>
<div class="col-xs-1">
  <div class="form-group">
    <button id="upload" type="button" name="upload" class="btn btn-success btn-sm pull-left">
		<span class="glyphicon glyphicon-eye-open"></span> Upload
	</button>
  </div>
</div>
<div class="col-xs-1">
  <div class="form-check">
    <button type="button" name="check_data" id="check_data" class="btn btn-success btn-sm pull-left">
		<span class="glyphicon glyphicon-eye-open"></span> Cek Data
	</button>
  </div>
</div>
<div class="form-group">
    <input id="upload_number" type="text" name="upload_number" style="display: none;;" class="" />
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
		<legend class="scheduler-border">Data Hasil Upload Excel </legend>		
			    <div class="position-relative ">
                  	<div class="table-responsive">
							<table class="table table-bordered" id="table-data-insured">
							<thead>
								<tr>
									<th>No.</th> 
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
									<th>Upload Number</th>
									<th>Tgl upload</th>
								
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
		<legend class="scheduler-border">Data Hasil Upload Excel </legend>		
		<div class="position-relative ">
		<div class="table-responsive">
        <p><h1></h1></p>
        <div >
            <table id='tbl_claim_check_result' class='table table-bordered'>
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
								</tr>
								</thead>
                 
            </table>
        </div>
		</div>
   </div>
		</fieldset>
</div>



		<div id="wait" >
		<img alt="" src="http://localhost:90/data_claim/css/Spinner.gif" class='preloading_image' id="actual_image1-pre">
        </div>
		
		
		



		<!--
		<script type="text/javascript" src="js/jquery.min.js"></script>	
		-->

		
<script type="text/javascript" src="datatables/datatables.min.js"></script> 
<script type="text/javascript" src="datatables/lib/js/dataTables.bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

 

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

		
		
		<script>
		var tabel = null;
		var tbl_claim_check_result = null;
		var server = "http://localhost:90/data_claim/";

		$(document).ready(function() {
		    tabel = $('#table-data-insured').DataTable({
				'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": server +"view_insured.php"
                },
                pageLength: 5,
		        "columns": [						
							{ "data": "no" },
							{ "data": "cedant_clm_nbr" }, 
							{ "data": "policy_no" },  
							{ "data": "certificate_no" },  
							{ "data": "insured_name" },  
							{ "data": "effective_date" },  
							{ "data": "sum_assured" },  
							{ "data": "benefit" },  
							{ "data": "event_date" },  
							{ "data": "submit_date" },  
							{ "data": "complate_date" },  
							{ "data": "approval_date" },  
							{ "data": "payment_date" },  
							{ "data": "investigation" },  
							{ "data": "curr_idr" },  
							{ "data": "submission_amt" },  
							{ "data": "approved_amt" },  
							{ "data": "paid_amt" },  
							{ "data": "diagnosis_desc" },  
							{ "data": "tre_share_amt" },  
							{ "data": "sent_to_reinsr_date" },  
							{ "data": "sla" },  
							{ "data": "upload_number" }, 
							{ "data": "upload_date" },  
				
		            // { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    // var html  = "<a href=''>EDIT</a> | "
		                    // html += "<a href=''>DELETE</a>"

		                    // return html
		                // }
		            // },
		        ],
		    });

			var buttonCommon = {
				exportOptions: {
					format: {
						body: function ( data, row, column, node ) {
							// Strip $ from salary column to make it numeric
							return column === 5 ?
								data.replace( /[$,]/g, '' ) :
								data;
						}
					}
				}
			};

			var empDataTable = $('#tbl_claim_check_result').DataTable({
			
				dom: 'Bfrtip',
				buttons: [ {
					extend: 'excelHtml5',
					customize: function( xlsx ) {
						var sheet = xlsx.xl.worksheets['sheet1.xml'];
		
						$('row c[r^="C"]', sheet).attr( 's', '2' );
					}
				} ],
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": server +"view_claim.php"
                },
                pageLength: 5,
                'columns': [ 
							{ "data": "no" },
                    		{ "data":"claim_insd_name"},
							{ "data":"pl_insd_name"},
							{ "data":"result_insd_name", "className": "res_column"},
							{ "data":"claim_policy_no"},
							{ "data":"pl_policy_no"},
							{ "data":"result_policy_no"},
							{ "data":"claim_certificate_no"},
							{ "data":"pl_certificate_no"},
							{ "data":"result_certificate_no"},
							{ "data":"claim_effective_date"},
							{ "data":"pl_inception_date"},
							{ "data":"result_efective_inception"},
							{ "data":"claim_submit"},
							{ "data":"pl_sum_insd"},
							{ "data":"result_claim_submit_pl_sum_insd"},
							{ "data":"claim_event"},
							{ "data":"stnc"},
							{ "data":"result_claim_event_stnc"},
							{ "data":"payment_date_submit_date_days"},
							{ "data":"result_payment_date_submit_date_status"},
							{ "data":"pl_cedant_ret"},
							{ "data":"pl_tre"},
							{ "data":"claim_paid_by_cedant"},
							{ "data":"claim_paid_tre_share_calc_by_cedant"},
							{ "data":"claim_paid_tre_share_calc_by_tre"},
							{ "data":"check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_check_claim_tre_share_cedant_vs_tre"},
							{ "data":"result_overall_clm_status"},
							{ "data":"remark"}, 
							
                ],
				
            });

			
					
					$('#upload').on('click', function() {
							var file = document.getElementById("sortdata").files[0];
							var formdata = new FormData();
							formdata.append("file", file);
							formdata.append("kode", "upload");
							formdata.append("upload_nmbr", $('#upload_number').val().trim() );
							$.ajax({
								url: "list_data.php",
								type: "POST",
								data: formdata,
								cache: false,
								contentType: false,
								processData: false,
								success: function(output) {       
									var json = $.parseJSON(output);
									// var json = json_encode(output);
									console.log('json.message ', json.message );
									Swal.fire(
										json.message,
										'Data Telah tersimpan',
										'success'
										)																			
									}
								});
					});

					$('#upload_nmbr').ready(function() {
						// $("#wait").css("display", "block");
						// event.preventDefault();       
							$.ajax({
							url: server +"list_data.php",
								type: "POST",
								dataType: "json",
								data: {
										kode: 'CEK_MAX_UPLOAD_NUMBER', 
										data: ""
									},
								success: function(output) {       
									console.log('upload_number ',output);
									
									$('#upload_number').val( output.trim() );
									} 
							}); 
						}); 

						
					$('#check_data').on('click', function() {
						// $("#wait").css("display", "block");
						// event.preventDefault();       
							$.ajax({
							url: server +"list_data.php",
								type: "POST",
								dataType: "json",
								data: {
										kode: 'CHECK_DATA_CLAIM', 
										data: ""
									},
								success: function(output) {       
									console.log('check_data ',output);
									// $("#wait").css("display", "none");
									Swal.fire(
										output.message,
										'Data Telah tersimpan',
										'success'
										)	
									} 
							}); 
						}); 

		

		});




		</script>
	</body>
	
</html>
