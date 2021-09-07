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
		fieldset {
			border: 1px solid #DDDDDD;
			display: inline-block;
			font-size: 14px;
			font-family: Arial, Helvetica;
			padding: 1em 2em;
		}
		 
		legend {
			background: #BFD48C;     /* Hijau */
			color: #FFFFFF;          /* Putih */
			margin-bottom: 4px;
			padding: 0.5em 1em;
		}
		</style>

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		

		<!-- Content -->
		<div>
			<fieldset>
			 <legend>Data Claim Information</legend>

			<div style="width:100%;">
			<hr>
			<form method="post" action="" enctype="multipart/form-data">
			
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success btn-sm pull-left">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
				
				<button type="submit" name="preview" class="btn btn-success btn-sm pull-left">
					<span class="glyphicon glyphicon-eye-open"></span> Cek Data
				</button>
			
			</form>
			<div>
			</fieldset>	
			<hr><br>

			<!-- Buat Preview Data -->
			<?php
			
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				
				if(is_file('tmp/'.$nama_file_baru)) 
					unlink('tmp/'.$nama_file_baru); 

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
				$tmp_file = $_FILES['file']['tmp_name'];

				
				if($ext == "xlsx"){
					
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";

					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
						<tr>
						<th>no</th>
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
					</tr>";
					
					$db = new koneksi();
					
					$numrow = 1;
					$kosong = 0;
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
						
						
					     
						

						// Cek jika semua data tidak diisi
						if($certificate_no == "" && $nama == "" && $jenis_kelamin == "" && $telp == "" && $alamat == "")
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							
							
							
				    	 $sqlQuery = " INSERT INTO public.tbl_claim_data
									(cedant_clm_nbr, policy_no, certificate_no, insured_name, effective_date, sum_assured, benefit, event_date, submit_date, complate_date, 
									approval_date, payment_date, investigation, curr_idr, submission_amt, approved_amt, paid_amt, diagnosis_desc, tre_share_amt, sent_to_reinsr_date, sla)
									VALUES(
									'$cedant_clm_nbr', '$policy_no', '$certificate_no', '$insured_name', '$effective_date', '$sum_assured', '$benefit','$event_date', 
									'$submit_date','$complate_date','$approval_date' , '$payment_date', '$investigation', '$curr_idr', '$submission_amt', '$approved_amt', 
									'$paid_amt', '$diagnosis_desc', '$tre_share_amt', '$sent_to_reinsr_date', '$sla') ";
									
									
									// echo "<pre>";
									// print_r( $sqlQuery );
									// die; 

							$dataQuery = $db->db_fetch_array($sqlQuery);

							
							
							// Validasi apakah semua data telah diisi
							$cedant_clm_nbr_td = ( ! empty($cedant_clm_nbr))? "" : " style='background: #E07171;'"; 
							$policy_no_td = ( ! empty($policy_no))? "" : " style='background: #E07171;'"; 
							$certificate_no_td = ( ! empty($certificate_no))? "" : " style='background: #E07171;'"; 
							$insured_name_td = ( ! empty($insured_name))? "" : " style='background: #E07171;'"; 
							
							
							// $query = "select * from tbl_insured where  name_of_insured like '%$insured_name%'
									// and policy_no like '%$policy_no%'
									// and certificate_no like '%$certificate_no%' " ;
							// $sql_data = $db->db_fetch_array($query); 

							

							// Jika salah satu data ada yang kosong
							if($cedant_clm_nbr == "" or $policy_no == "" or $certificate_no == "" or $insured_name == "" ){
								$kosong++; // Tambah 1 variabel $kosong
							}

							echo "<tr>";
							echo "<td>".($key-1)."</td>";
							echo "<td".$cedant_clm_nbr_td.">".$cedant_clm_nbr."</td>";
							echo "<td".$policy_no_td.">".$policy_no."</td>";
							echo "<td".$certificate_no_td.">".$certificate_no."</td>";
							echo "<td".$insured_name_td.">".$insured_name."</td>";
							echo "<td".$effective_date_td.">".$effective_date."</td>";							
							echo "<td".$sum_assured_td.">".$sum_assured."</td>";
							echo "<td".$benefit_td.">".$benefit."</td>";
							echo "<td".$event_date_td.">".$event_date."</td>";
							echo "<td".$submit_date_td.">".$submit_date."</td>";
							echo "<td".$complate_date_td.">".$complate_date."</td>";
							echo "<td".$approval_date_td.">".$approval_date."</td>";
							echo "<td".$payment_date_td.">".$payment_date."</td>";
							echo "<td".$investigation_td.">".$investigation."</td>";
							echo "<td".$curr_idr_td.">".$curr_idr."</td>";
							echo "<td".$submission_amt_td.">".$submission_amt."</td>";
							echo "<td".$approved_amt_td.">".$approved_amt."</td>";
							echo "<td".$paid_amt_td.">".$paid_amt."</td>";
							echo "<td".$diagnosis_desc_td.">".$diagnosis_desc."</td>";
							echo "<td".$tre_share_amt_td.">".$tre_share_amt."</td>";
							echo "<td".$sent_to_reinsr_date_td.">".$sent_to_reinsr_date."</td>";
							echo "<td".$sla_td.">".$sla."</td>";
							
							echo "</tr>";
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
			
		
		</div>
		
		<div>
		
			    <div class="position-relative ">
                  	<div class="table-responsive">
				
							<table class="table table-bordered" id="table-data-insured">
							<thead>
								<tr>
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
									<th>sent_to_reinsr_date
									<th>sla
								
								</tr>
							</thead>
							<tbody></tbody>	
							</table>
				
					</div>
				</div>
		</div>
		
		
		<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>

<script src="dist/js/pages/dashboard3.js"></script>

<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="datatables/datatables.min.js"></script>
		<script type="text/javascript" src="datatables/lib/js/dataTables.bootstrap.min.js"></script>
		<script>
		var tabel = null;
		var server = "http://localhost:90/data_claim/";

		$(document).ready(function() {
		    tabel = $('#table-data-insured').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ordering": true, 
		        "order": [[ 0, 'asc' ]], 
		        "ajax":
		        {
		            "url": server +"view_claim.php", 
		            "type": "POST"
		        },
				
		        "deferRender": true,
		        // "aLengthMenu": [[10],[10]], 
		        "columns": [						
							// { "data": "no" },
				
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
