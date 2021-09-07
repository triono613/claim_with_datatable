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
                        <input class="form-check-input" type="checkbox" value="true" id="check_180_days" name="check_180_days" >
                        <label class="form-check-label" for="check_180_days">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        (Payment date-Submit date) > 180 = Reject
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
		  

						
					$('#save_data_setting').on('click', function() {
							$("#wait").show();
						// event.preventDefault();       
						Swal.fire({
							title: 'Simpan! ',
							// text: "Akan dilakukan Upload data!",
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
                                formdata.append("check_180_days", $('#check_180_days:checkbox:checked').length);
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
										$('#table-data-insured').DataTable().ajax.reload(); 
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
                                    treaty.forEach( (val, key) =>  $("#treaty_name").append('<option value="' + val.no_treaty + '">' + val.no_treaty + '</option>')   ); 

									} 
							}); 
						}); 

						
		});

		</script>
	</body>
	
</html>
