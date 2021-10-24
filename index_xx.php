<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 
        <title>Rest API Authentication Example</title>
 
        <!-- CSS links will be here -->
        <!-- Bootstrap 4 CSS and custom CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="custom.css" />

        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sweetalert2.min.css" rel="stylesheet">

		

		

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

        .btn-google {
        color: white !important;
        background-color: #ea4335;
        }

        .btn-facebook {
        color: white !important;
        background-color: #3b5998;
        }

        .centered {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
     </style>
    </head>
<body>
 
 
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <form id="form_login">
              <div class="form-floating mb-3">
              <label for="floatingInput">Username</label>
                <input type="text" class="form-control" id="username" placeholder="">
                
              </div>
              <div class="form-floating mb-3">
              <label for="floatingPassword">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Remember password
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" id="submit" >Sign
                  in</button>
              </div>
              <hr class="my-4">
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="wait" class="centered" >
		<img alt="" src="css/Spinner.gif" class='preloading_image' id="actual_image1-pre">
        </div>
<!-- /container -->
 

<!-- jQuery & Bootstrap 4 JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script>
    // jQuery codes
    $(document).ready(function(){
        $("#wait").hide();

        
        // $("#form_login").submit(function (event) {
            $('#submit').on('click', function() {
            // alert("sssss");
						$("#wait").show();
						// event.preventDefault();       
							$.ajax({
							url: "http://localhost/claim/list_data.php",
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

                                    // output.forEach( (val, key) =>  $("#ceding_name").append('<option value="' + val.ceding_name + '">' + val.ceding_name + '</option>')   ); 
									} 
							}); 
						}); 


    });
    </script>

</body>
</html>