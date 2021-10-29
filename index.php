<!doctype html>
<html lang="en">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
	
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	    <link rel="stylesheet" href="dist/css/adminlte.min.css">
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>




    
    <!-- <link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />

		
      <title>data_claim</title>
      <style>
        body {
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
        }
        .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
        }
        
        .centered {
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
		}
     </style>
</head>
<body class="hold-transition sidebar-mini">	
	
 
         
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
          <div class="text-center">
          <img  src="https://www.tugure.id/uploads/web_config/606be2e4b96f5_20210406112612-1.png" width="70px" height="60px" class="" alt="logo tugure">
          </div>
            <br>
            <form id="">
              <div class="form-floating mb-3">
              <label for="floatingInput">Username</label>
                <input id="username" type="text" name="username" style="display: ;" class="form-control" />
                
              </div>
              <div class="form-floating mb-3">
              <label for="floatingPassword">Password</label>
                <input id="password" type="password" name="password" style="display: ;" class="form-control" />
              </div>
              <div class="d-grid">
                  <button type="button" name="check_datax" id="check_datax" class="btn btn-primary btn-login text-uppercase fw-bold">
                  Sign in </button>
              </div>
              <hr class="my-4">
              
              <div class="d-grid mb-2">
                <button class="btn btn-google btn-login text-uppercase fw-bold" >
                  <i class="fab me-2"></i> Register
                </button>
              </div>
              <div class="d-grid">
                <!-- <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
                  <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                </button> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Datatables -->
    <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
	
	
	<script src="dist/js/adminlte.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	
  
<!--     
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>-->
  <script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script> 
	
			
    <script>
      $(document).ready(function() {
      $('#check_datax').on('click', function() {
						$("#wait").show();
						// event.preventDefault();       
							$.ajax({
							  url: "list_data.php",
                async: false, 
								type: "POST",
								dataType: "json",
								data: {
										kode: 'validasi_login', 
										data: {
                            'username' : $('#username').val(), 
                            'password' : $('#password').val()
                      }
									},
								success: function(output) {       
									$("#wait").hide();
                    console.log('output= ',output);
                    window.location.href = "dashboard";
									} 
							}); 
						}); 
      });
    </script>
</body>
</html>