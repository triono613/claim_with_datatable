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
		<title>data_claim</title>

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
		
		<div>
            <form id="formSetting">
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Underwriter Parameter </legend>		
			    <div class="position-relative ">
                
				<div class="col-sm-6 " style="background-color: ;">
				<p>
				<label class="control-label" for="ceding_name">Ceding Name</label>
				<select name="ceding_name" id="ceding_name" class="form-control" style="width:100%" >
					<option value=""> - </option>
				</select>
				</p>
                </div>
                <div class="col-sm-6 " style="background-color: ;">
                <p>
				<label class="control-label" for="treaty_name">Treaty Name</label>
				<select name="treaty_name" id="treaty_name" class="form-control" style="width:100%" >
					<option value=""> - </option>
				</select>
				</p>
                </div>
              

                <div class="col-sm-3 " style="background-color: ;">
                <p>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="check_insured_name" name="check_insured_name" >
                    <label class="form-check-label" for="check_insured_name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Insured Name
                    </label>
                    </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="check_policy_no" name="check_policy_no" >
                    <label class="form-check-label" for="check_policy_no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Policy No.
                    </label>
                    </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                <p>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="check_certificate_no" name="check_certificate_no" >
                    <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Certificate No.
                    </label>
                    </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="check_inception_date"  name="check_inception_date"> 
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Inception Date
                        </label>
                        </div>
                    </p>
                </div>


                

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="check_sum_ins" id="check_sum_ins" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Sum Insured
                        </label>
                        </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="check_stnc" name="check_stnc" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        STNC
                        </label>
                        </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="check_180_days_less" name="check_180_days_less" >
                        <label class="form-check-label" for="check_180_days_less">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            (PaymentDate - SubmitDate) < 180 days
                        </label>
                        </div>
                    </p>
                </div>
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="check_180_days_more" name="check_180_days_more" >
                        <label class="form-check-label" for="check_180_days_more">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (SentToReinsrDate - eventdate) > 180 = Reject
                        </label>
                        </div>
                    </p>
                </div>
                
                
                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="pdate_vs_sdate_stts" name="pdate_vs_sdate_stts" >
                        <label class="form-check-label" for="pdate_vs_sdate_stts">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (Payment date VS Submit date days Status) 
                        </label>
                        </div>
                    </p>
                </div> 

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="pl_cedant_rate" name="pl_cedant_rate" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        PL Cedant Rate
                        </label>
                        </div>
                    </p>
                </div>

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="pl_tre" name="pl_tre" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        PL TRE
                        </label>
                        </div>
                    </p>
                </div>

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="claim_paid_by_cedant" name="claim_paid_by_cedant" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Claim Paid by Cedant 100%
                        </label>
                        </div>
                    </p>
                </div>

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="claim_paid_tre_share_calc_by_cedant" name="claim_paid_tre_share_calc_by_cedant" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Claim Paid TRE Share (calc by cedant )
                        </label>
                        </div>
                    </p>
                </div>



                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="claim_paid_tre_share_calc_by_tre" name="claim_paid_tre_share_calc_by_tre" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Claim Paid TRE Share (calc by TRE )
                        </label>
                        </div>
                    </p>
                </div>

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="check_claim_tre_share_stts" name="check_claim_tre_share_stts" >
                        <label class="form-check-label" for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Check Claim TRE Share 
                        </label>
                        </div>
                    </p>
                </div>

                <div class="col-sm-3 " style="background-color: ;">
                    <p>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="remark" name="remark" >
                        <label class="form-check-label" for="remark">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Remark
                        </label>
                        </div>
                    </p>
                </div>

				</div>
		</fieldset>
        <div class="col-xs-0">
            <div class="form-group">
                <button type="button" name="save_data_setting" id="save_data_setting" class="btn btn-primary buttons-csv buttons-html5 btn-sm">
                Save
                </button>
            </div>
            </div>
		</div>
        </form>
	

        <div class="" >
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Data Underwriter Parameter </legend>		
		<div class="position-relative ">
		<div class="table-responsive">
        <p><h1></h1></p>
        <div >
            <table id='tbl-setting-uw' class='table table-bordered'>
								<thead>
								<tr>
                                <th>No.</th> 
                                <!-- <th>id</th></th>  -->
                                <th>ceding_name</th>  
                                <th>treaty_name</th> 
                                <th>insured_name</th> 
                                <th>policy_no</th> 
                                <th>certificate_no</th> 
                                <th>inception_date</th> 
                                <th>sum_insured</th> 
                                <th>stnc</th> 
                                <th>days > 180 </th> 
                                <th>days < 180 </th> 
                                <th>pl_cedant_rate</th> 
                                <th>pl_tre</th> 
                                <th>claim_paid_by_cedant_100</th> 
                                <th>claim_paid_tre_share_calc_by_cedant</th> 
                                <th>claim_paid_tre_share_calc_by_tre</th>
                                <th>check_claim_tre_share</th> 
                                <th>remark</th> 
                                <th>create_date</th> 
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
		// var server = "http://localhost:90/data_claim/";

		$(document).ready(function() {
			$("#wait").hide();
		  



            var empDataTable = $('#tbl-setting-uw').DataTable({
				
                // dom: 
                // "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                // "<'row'<'col-md-12'tr>>" +
                // "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,10000],
                    [5,10,25,50,100,10000]
                ],
				// buttons: [ 'csv','excel' ],
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    "url": "view_tbl_setting_uw.php"
                },
                searching: false,
                pageLength: 5,
				"autoWidth": false, 
                'columns': [ 
                    { "data":"no" ,"title": "No.","width":"50%"},
                    // { "data":"id" ,"title": "Id.","width":"50%"},
                    { "data":"ceding_name" ,"title": "ceding_name","width":"50%"},
                    { "data":"treaty_name" ,"title": "treaty_name","width":"50%"},
                    { "data":"insured_name" ,"title": "insured name","width":"50%"},
                    { "data":"policy_no" ,"title": "policy no.","width":"50%"},
                    { "data":"certificate_no" ,"title": "certificate no.","width":"50%"},
                    { "data":"inception_date" ,"title": "inception date.","width":"50%"},
                    { "data":"sum_insured" ,"title": "sum insured.","width":"50%"},
                    { "data":"stnc" ,"title": "STNC","width":"50%"},
                    { "data":"days_180_more" ,"title": " > 180","width":"50%"},
                    { "data":"days_180_less" ,"title": " < 180","width":"50%"},
                    { "data":"pl_cedant_rate" ,"title": "pl_cedant_rate","width":"50%"},
                    { "data":"pl_tre" ,"title": "pl_tre","width":"50%"},
                    { "data":"claim_paid_by_cedant_100" ,"title": "claim_paid_by_cedant_100","width":"50%"},
                    { "data":"claim_paid_tre_share_calc_by_cedant" ,"title": "claim_paid_tre_share_calc_by_cedant","width":"50%"},
                    { "data":"claim_paid_tre_share_calc_by_tre" ,"title": "claim_paid_tre_share_calc_by_tre","width":"50%"},
                    { "data":"check_claim_tre_share" ,"title": "check_claim_tre_share","width":"50%"},
                    { "data":"remark" ,"title": "remark","width":"50%"},
                    { "data":"create_date" ,"title": "create_date","width":"50%"},		
                ],
            });

			empDataTable.buttons().container().appendTo( '#table_wrapper .col-md-5:eq(0)' );


						
					$('#save_data_setting').on('click', function() {
							$("#wait").show();
						// event.preventDefault();       
						Swal.fire({
							title: 'Simpan! ',
							text: "Menu setting untuk Ceding '"+$('#ceding_name').val().trim()+"' dan treaty '"+ $('#treaty_name').val().trim()+"' ",
							icon: 'info',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							// confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
							if (result.isConfirmed) {

								$("#wait").show();
								var formdata = new FormData();
                                formdata.append("kode", 'FORM_SETTING' );
                                formdata.append("ceding_name", $('#ceding_name').val().trim() );
                                formdata.append("treaty_name", $('#treaty_name').val().trim() );
                                formdata.append("check_insured_name", $('#check_insured_name:checkbox:checked').length);
                                formdata.append("check_policy_no", $('#check_policy_no:checkbox:checked').length);
                                formdata.append("check_certificate_no", $('#check_certificate_no:checkbox:checked').length);
                                formdata.append("check_inception_date", $('#check_inception_date:checkbox:checked').length);
                                formdata.append("check_sum_ins", $('#check_sum_ins:checkbox:checked').length);
                                formdata.append("check_stnc", $('#check_stnc:checkbox:checked').length);
                                formdata.append("check_180_days_more", $('#check_180_days_more:checkbox:checked').length);
                                formdata.append("check_180_days_less", $('#check_180_days_less:checkbox:checked').length);
                                formdata.append("pdate_vs_sdate_stts", $('#pdate_vs_sdate_stts:checkbox:checked').length);
                                formdata.append("pl_cedant_rate", $('#pl_cedant_rate:checkbox:checked').length);
                                formdata.append("pl_tre", $('#pl_tre:checkbox:checked').length);
                                formdata.append("claim_paid_by_cedant", $('#claim_paid_by_cedant:checkbox:checked').length);
                                formdata.append("claim_paid_tre_share_calc_by_cedant", $('#claim_paid_tre_share_calc_by_cedant:checkbox:checked').length);
                                formdata.append("claim_paid_tre_share_calc_by_tre", $('#claim_paid_tre_share_calc_by_tre:checkbox:checked').length);
                                formdata.append("check_claim_tre_share_stts", $('#check_claim_tre_share_stts:checkbox:checked').length);
                                // formdata.append("over_all_claim_stts", $('#over_all_claim_stts').val().trim() );
                                formdata.append("remark", $('#remark:checkbox:checked').length);

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
									// var json = $.parseJSON(output);
									// var json = json_encode(output);
									// console.log('json.message ', json.message );
									
									Swal.fire(
										output.message,
										'Data Telah tersimpan',
										'success'
										)																			
										$('#tbl-setting-uw').DataTable().ajax.reload(); 
									}
								});
							}else {
								$("#wait").hide();
							}
							})
						}); 



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

                        $('#ceding_name').on('change',function() {
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
                                    $('#treaty_name')
									.find('option')
									.remove()
									.end()
									.append('<option value="">-</option>')
									.val('');
                                    treaty.forEach( (val, key) =>  $("#treaty_name").append('<option value="' + val.no_contract + '">' + val.no_contract + '</option>')   ); 

									} 
							}); 
						}); 

						
		});

		</script>
	</body>
	
</html>
