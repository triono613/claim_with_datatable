<?php 
require_once('koneksi.php');
ini_set('display_errors', 'On');
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
</head>

                <div class="position-relative ">
                  	<div class="table-responsive">
				
				<table class="table table-bordered" id="table-data-insured">
				<thead>
					<tr>
					
					<!--	<th>no.</th> -->
						<th>source</th>
						<th>ceding</th>
						<th>no_treaty</th>
						<th>no_add</th>
						<th>product</th>
						<th>cob</th>
						<th>sub_cob</th>
						<th>cara_bayar</th>
						<th>policy_holder</th>
						<th>ketentuan_uw</th>
						<th>bulan_produksi</th>
						<th>tahun_produksi</th>
						<th>no_nota</th>
						<th>tanggal_nota</th>
						<th>premium_list_no</th>
						<th>certificate_no</th>
						<th>name_of_insured</th>
						<th>sex</th>
						<th>birth_of_date</th>
						<th>age</th>
						<th>inception_date</th>
						<th>expired_date</th>
						<th>basic_rider</th>
						<th>em_percent</th>
						<th>rate</th>
						<th>kurs</th>
						<th>sum_insured_orc</th>
						<th>gross_premi_orc</th>
						<th>komisi_orc</th>
						<th>net_premi_orc</th>
						<th>tanggal_claim</th>
						<th>retrosesi</th>
						<th>share_tugure</th>
						<th>share_retro</th>
						<th>retensi_tugure</th>
						<th>inamount_tugure</th>
						<th>inamount_retro</th>
						
					</tr>
					</thead>
					<tbody></tbody>
					<?php
					/*
					 $database = new koneksi();
					 $sqlQuery = "select * from tbl_claim_data order by id ";
					 $dataQuery = $database->db_fetch_array($sqlQuery);
					
					
					for( $a=0; $a <= count($dataQuery['data'])-1; $a++ ) {
						echo "<tr>";
						echo "<td>".($a+1)."</td>";
						echo "<td>".$dataQuery['data'][$a]['cedant_clm_nbr']."</td>";
						echo "<td>".$dataQuery['data'][$a]['policy_no']."</td>";
						echo "<td>".$dataQuery['data'][$a]['certificate_no']."</td>";
						echo "<td>".$dataQuery['data'][$a]['insured_name']."</td>";
						echo "<td>".$dataQuery['data'][$a]['effective_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['sum_assured']."</td>";
						echo "<td>".$dataQuery['data'][$a]['benefit']."</td>";
						echo "<td>".$dataQuery['data'][$a]['event_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['submit_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['complate_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['approval_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['payment_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['investigation']."</td>";
						echo "<td>".$dataQuery['data'][$a]['curr_idr']."</td>";
						echo "<td>".$dataQuery['data'][$a]['submission_amt']."</td>";
						echo "<td>".$dataQuery['data'][$a]['approved_amt']."</td>";
						echo "<td>".$dataQuery['data'][$a]['paid_amt']."</td>";
						echo "<td>".$dataQuery['data'][$a]['diagnosis_desc']."</td>";
						echo "<td>".$dataQuery['data'][$a]['tre_share_amt']."</td>";
						echo "<td>".$dataQuery['data'][$a]['sent_to_reinsr_date']."</td>";
						echo "<td>".$dataQuery['data'][$a]['sla']."</td>";
						echo "</tr>";
					}
					*/
					?>
				</table>
			</div>
        </div>

               
           
        

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong><a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
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
		            "url": "view.php", // URL file untuk proses select datanya
		            "type": "POST"
		        },
				
		        "deferRender": true,
		        // "aLengthMenu": [[10],[10]], 
		        "columns": [
						
							// { "data": "no" },
					{ "data": "source" }, 
		            { "data": "ceding" },  
					{ "data": "no_treaty" },  
					{ "data": "no_add" },  
					{ "data": "product" },  
					{ "data": "cob" },  
					{ "data": "sub_cob" },  
					{ "data": "cara_bayar" },  
					{ "data": "policy_holder" },  
					{ "data": "ketentuan_uw" },  
					{ "data": "bulan_produksi" },  
					{ "data": "tahun_produksi" },  
					{ "data": "no_nota" },  
					{ "data": "tanggal_nota" },  
					{ "data": "premium_list_no" },  
					{ "data": "certificate_no" },  
					{ "data": "name_of_insured" },  
					{ "data": "sex" },  
					{ "data": "birth_of_date" },  
					{ "data": "age" },  
					{ "data": "inception_date" },  
					{ "data": "expired_date" },  
					{ "data": "basic_rider" },  
					{ "data": "em_percent" },  
					{ "data": "rate" },  
					{ "data": "kurs" },  
					{ "data": "sum_insured_orc",render: $.fn.dataTable.render.number( ',', '.', 0 )}, 
					{ "data": "gross_premi_orc" ,render: $.fn.dataTable.render.number( ',', '.', 0 )}, 
					{ "data": "komisi_orc" ,render: $.fn.dataTable.render.number( ',', '.', 0 )},
					{ "data": "net_premi_orc" },  
					{ "data": "tanggal_claim" },  
					{ "data": "retrosesi" },  
					{ "data": "share_tugure" },  
					{ "data": "share_retro" },  
					{ "data": "retensi_tugure" },  
					{ "data": "inamount_tugure" },  
					{ "data": "inamount_retro" },  
				
				/*
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
					*/
					
				
						

		            // { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    // var html  = "<a href=''>EDIT</a> | "
		                    // html += "<a href=''>DELETE</a>"

		                    // return html
		                // }
		            // },
		        ],
		    });
		});
		</script>

</body>
</html>
