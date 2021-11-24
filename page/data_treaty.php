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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="datatables/lib/css/dataTables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css"/>
  
</head>

                <div class="position-relative ">
                  	<div class="table-responsive">
						  <!--
					  		<button id="button">Row count</button>
						-->
				<table class="table table-bordered" id="table-data-insured">
				<thead>
					<tr>
						<th>no.</th>                       
                        <th>source_type</th>
                        <th>source_name</th>
                        <th>ceding_name</th>
                        <th>type_of_contract</th>
                        <th>no_contract</th>
                        <th>no_edoc</th>
                        <th>policy_holder</th>
                        <th>insured_name</th>
                        <th>insured_name_remark</th>
                        <th>limit_retensi_ceding</th>
                        <th>qs_cedant_share_percent</th>
                        <th>qs_tugure_share_percent</th>
                        <th>qs_maximum_limit</th>
                        <th>surplus_limit</th>
                        <th>surplus_tugure_share_percent</th>
                        <th>group_or_individu</th>
                        <th>cob_life</th>
                        <th>cob_life_coverage</th>
                        <th>limit_cob_life</th>
                        <th>cob_credit</th>
                        <th>cob_credit_life_decreasing_term</th>
                        <th>limit_cob_credit_life_decreasing_term</th>
                        <th>cob_credit_coverage_credit_life_level_term</th>
                        <th>limit_cob_credit_life_level_term</th>
                        <th>cob_health</th>
                        <th>sub_cob_hospital_cash_plan</th>
                        <th>limit_sub_cob_hospital_cash_plan</th>
                        <th>sub_cob_indemnity</th>
                        <th>limit_sub_cob_indemnity</th>
                        <th>sub_cob_managed_care</th>
                        <th>limit_sub_cob_managed_care</th>
                        <th>cob_pa</th>
                        <th>sub_cob_pa_a</th>
                        <th>limit_sub_cob_pa_a</th>
                        <th>sub_cob_pa_b</th>
                        <th>limit_sub_cob_pa_b</th>
                        <th>sub_cob_pa_d</th>
                        <th>limit_sub_cob_pa_d</th>
                        <th>cob_ci</th>
                        <th>limit_cob_ci</th>
                        <th>sub_cob_ci_dd</th>
                        <th>limit_sub_cob_ci_dd</th>
                        <th>sub_cob_ti</th>
                        <th>limit_sub_cob_ti</th>
                        <th>cob_tpd</th>
                        <th>limit_cob_tpd</th>
                        <th>cob_catastrophe</th>
                        <th>limit_cob_catastrophe</th>
                        <th>remark_coverage</th>
                        <th>effective_date</th>
                        <th>treaty_start_date</th>
                        <th>treaty_end_date</th>
                        <th>stnc_date</th>
                        <th>automatic_outward_retro</th>
                        <th>no_automatic_outward_retro</th>
                        <th>usia_masuk_min</th>
                        <th>usia_masuk_min_satuan</th>
                        <th>usia_masuk_max</th>
                        <th>usia_masuk_max_satuan</th>
                        <th>usia_max_saat_polis_berakhir</th>
                        <th>usia_max_saat_polis_berakhir_satuan</th>
                        <th>periode_asuransi</th>
                        <th>periode_asuransi_satuan</th>
                        <th>ketentuan_underwriting_medis</th>
                        <th>ketentuan_underwriting_non_medis</th>
                        <th>ketentuan_underwriting_free_cover_limit</th>
                        <th>ketentuan_underwriting_guaranteed_acceptance</th>
                        <th>komisi_reasuransi_percent</th>
                        <th>overriding_commision_percent</th>
                        <th>profit_commission_percent</th>
                        <th>batas_waktu_pelaporan_peserta_hari</th>
                        <th>batas_waktu_pelaporan_claim_hari</th>
                        <th>jenis_pelaporan_claim</th>
                        <th>periode_pembayaran</th>
                        <th>skenario_pembayaran</th>
                        <th>stop_loss_limit</th>
                        <th>stop_loss_skenario</th>
                        <th>cut_loss_limit</th>
                        <th>underwriter_name</th>
                        <th>pengembalian_premi_definisi_n</th>
                        <th>pengembalian_premi_definisi_t</th>
                        <th>pengembalian_premi_percent</th>
                        <th>pengembalian_premi_ketentuan</th>
                        <th>no_addendum</th>
                        <th>id</th>
                        <th>cut_loss_skenario</th>
                        <th>creatoruserid</th>
                        <th>creationtime</th>
                        <th>lastmodificationtime</th>
                        <th>lastmodifieruserid</th>
                        <th>status_data</th>
                        <th>periode_pembayaran_satuan</th>
                        <th>automatic_renewal</th>

						
					</tr>
					</thead>
					<tbody></tbody>
					
				</table>
			</div>
        </div>

               
           
        

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- <strong><a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved. -->
    <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div> -->
  </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
		<script>
		var tabel = null;
		// var server = "http://localhost:90/data_claim/";

		$(document).ready(function() {
		    tabel = $('#table-data-insured').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ordering": true, // Set true agar bisa di sorting
		        "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		        "ajax":
		        {
		            "url": "view_treaty.php", // URL file untuk proses select datanya
		            "type": "POST"
		        },
				'select':true,
				'rowId': 'no_treaty',
		        "deferRender": true,
		        // "aLengthMenu": [[10],[10]], 
		        "columns": [
						
					{ "data": "no" },
                    { "data": "source_type" },
                    { "data": "source_name" },
                    { "data": "ceding_name" },
                    { "data": "type_of_contract" },
                    { "data": "no_contract" },
                    { "data": "no_edoc" },
                    { "data": "policy_holder" },
                    { "data": "insured_name" },
                    { "data": "insured_name_remark" },
                    { "data": "limit_retensi_ceding" },
                    { "data": "qs_cedant_share_percent" },
                    { "data": "qs_tugure_share_percent" },
                    { "data": "qs_maximum_limit" },
                    { "data": "surplus_limit" },
                    { "data": "surplus_tugure_share_percent" },
                    { "data": "group_or_individu" },
                    { "data": "cob_life" },
                    { "data": "cob_life_coverage" },
                    { "data": "limit_cob_life" },
                    { "data": "cob_credit" },
                    { "data": "cob_credit_life_decreasing_term" },
                    { "data": "limit_cob_credit_life_decreasing_term" },
                    { "data": "cob_credit_coverage_credit_life_level_term" },
                    { "data": "limit_cob_credit_life_level_term" },
                    { "data": "cob_health" },
                    { "data": "sub_cob_hospital_cash_plan" },
                    { "data": "limit_sub_cob_hospital_cash_plan" },
                    { "data": "sub_cob_indemnity" },
                    { "data": "limit_sub_cob_indemnity" },
                    { "data": "sub_cob_managed_care" },
                    { "data": "limit_sub_cob_managed_care" },
                    { "data": "cob_pa" },
                    { "data": "sub_cob_pa_a" },
                    { "data": "limit_sub_cob_pa_a" },
                    { "data": "sub_cob_pa_b" },
                    { "data": "limit_sub_cob_pa_b" },
                    { "data": "sub_cob_pa_d" },
                    { "data": "limit_sub_cob_pa_d" },
                    { "data": "cob_ci" },
                    { "data": "limit_cob_ci" },
                    { "data": "sub_cob_ci_dd" },
                    { "data": "limit_sub_cob_ci_dd" },
                    { "data": "sub_cob_ti" },
                    { "data": "limit_sub_cob_ti" },
                    { "data": "cob_tpd" },
                    { "data": "limit_cob_tpd" },
                    { "data": "cob_catastrophe" },
                    { "data": "limit_cob_catastrophe" },
                    { "data": "remark_coverage" },
                    { "data": "effective_date" },
                    { "data": "treaty_start_date" },
                    { "data": "treaty_end_date" },
                    { "data": "stnc_date" },
                    { "data": "automatic_outward_retro" },
                    { "data": "no_automatic_outward_retro" },
                    { "data": "usia_masuk_min" },
                    { "data": "usia_masuk_min_satuan" },
                    { "data": "usia_masuk_max" },
                    { "data": "usia_masuk_max_satuan" },
                    { "data": "usia_max_saat_polis_berakhir" },
                    { "data": "usia_max_saat_polis_berakhir_satuan" },
                    { "data": "periode_asuransi" },
                    { "data": "periode_asuransi_satuan" },
                    { "data": "ketentuan_underwriting_medis" },
                    { "data": "ketentuan_underwriting_non_medis" },
                    { "data": "ketentuan_underwriting_free_cover_limit" },
                    { "data": "ketentuan_underwriting_guaranteed_acceptance" },
                    { "data": "komisi_reasuransi_percent" },
                    { "data": "overriding_commision_percent" },
                    { "data": "profit_commission_percent" },
                    { "data": "batas_waktu_pelaporan_peserta_hari" },
                    { "data": "batas_waktu_pelaporan_claim_hari" },
                    { "data": "jenis_pelaporan_claim" },
                    { "data": "periode_pembayaran" },
                    { "data": "skenario_pembayaran" },
                    { "data": "stop_loss_limit" },
                    { "data": "stop_loss_skenario" },
                    { "data": "cut_loss_limit" },
                    { "data": "underwriter_name" },

					// { "data": "sum_insured_orc",render: $.fn.dataTable.render.number( ',', '.', 0 )}, 
									
		        ],
		    });


		});
		</script>

</body>
</html>
