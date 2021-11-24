<?php
session_start();
// echo "SESSION= ";print_r($_SESSION);
if(!strlen(trim($_SESSION['username']))) {
  // session_destroy();
  unset($_SESSION["username"]);
  header("Location:index");
  exit();
  }

?>


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
		


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />


    <!-- <link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
s

      <title>Web Claim</title>
</head>
<body class="hold-transition sidebar-mini">	
	
	<div class="wrapper">
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex flex-row-reverse">
    <div class="col-lg-12">
     
        <div style="float:right;margin-right: 0;align:right">
          <img src="https://www.tugure.id/uploads/web_config/606be2e4b96f5_20210406112612-1.png" width="60px" height="60px" class="" alt="logo tugure">
        </div>   
    </div> 
    
  </nav> -->

  <div class="main-header navbar navbar-white d-flex">
     
        <div class="d-flex flex-row-reverse col-lg-12">
          <img src="https://www.tugure.id/uploads/web_config/606be2e4b96f5_20210406112612-1.png" width="60px" height="60px" class="" alt="logo tugure">
        </div>   
</div> 

 
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="https://www.tugure.id/uploads/web_config/606be2e4b96f5_20210406112612-1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    </a> -->

   
    <!-- Sidebar -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["username"]; ?></a>
        </div>
      </div>



    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dashboard?page=home" class="nav-link">
                  <p>Data Insured</p>
                </a>
              </li>
			        <!-- <li class="nav-item">
                <a href="dashboard?page=import_data_new" class="nav-link">
                  <p>Upload Data Claim</p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="dashboard?page=data_treaty" class="nav-link">
                  <p>Data Treaty</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="dashboard?page=import_data_treaty" class="nav-link">
                  <p>Upload Data Claim Nasional Life</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboard?page=setting_uw" class="nav-link">
                  <p>Setting Ketentuan Underwriting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboard?page=logout" class="nav-link">
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  
            <h1 class="m-0">
			 <?php 
				if(isset($_GET['page'])){
					$page = $_GET['page'];
			 
					switch ($page) {
						case 'home':
							echo "Data Insured";
							break;
						case 'import_data_new':
							echo "Import Data";
							break;
            case 'import_data_treaty':
                echo "Import Data";
                break;
            case 'setting_uw':
                echo "";
                break;
            case 'logout':
              session_destroy();
              unset($_SESSION["username"]);
              // header("Location:index");
              break;
            case 'data_treaty':
                echo  "Data Treaty";
                break;
						default:
							echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
							break;
					}
				}
				?>
			</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              
              <div class="card-body">
			  
			  <?php 
				if(isset($_GET['page'])){
					$page = $_GET['page'];
			 
					switch ($page) {
						case 'home':
							include "page/data_insured.php";
							break;
						case 'import_data_new':
							include "page/import_data_new.php";
							break;
            case 'import_data_treaty':
                include "page/import_data_treaty.php"; 
                break;
            case 'setting_uw':
                include "page/setting_uw.php";
                break;
            case 'data_treaty':
                include "page/data_treaty.php"; 
                break;
						default:
							echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
							break;
					}
				} else {
					
				}
			?>
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
              </div>
            </div>
          </div>
          </div>
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
	
	
    <!-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
  <script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script> 

	<!--<script src="plugins/jquery/jquery.min.js"></script> 
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> 
	<script src="dist/js/pages/dashboard3.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="datatables/datatables.min.js"></script>
	<script type="text/javascript" src="datatables/lib/js/dataTables.bootstrap.min.js"></script>
	-->
	<script src="dist/js/adminlte.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>

	
</body>

</html>