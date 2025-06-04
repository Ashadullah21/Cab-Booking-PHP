<?php 
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
session_start();
require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en">
 <?php require_once('inc/header.php') ?>
 <style>
</style>
<body class="">
  <script>
    start_loader()
  </script>
  <style>
    html, body{
      width:calc(100%);
      height:calc(100%);
    }
      body{
         
          /* background-image:url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size:cover; */
          background-color: rgb(143, 174, 202);
      }
	  .form-check-label a 
		{
		text-decoration: none; /* Remove underline */
		color: violet; /* Change color to violet */
		}

  .form-check-label a:hover
  {
    color: darkviolet; /* Optional hover effect */
  }
      #logo-img{
          width:15em;
          height:15em;
          object-fit:scale-down;
          object-position:center center;
      }
      #cimg{
          width:15vw;
          height:20vh;
          object-fit:scale-down;
          object-position:center center;
      }
      .pass_type{
        cursor: pointer;
      }
	  #sendOtpBtn,#reg{
		  border-radius:15px;
	  }
  </style>
<div class="d-flex align-items-center justify-content-center ">
  <!-- /.login-logo -->
  <!-- <div class="d-flex  justify-content-center align-items-center col-lg-5">
      <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img"></center>
      <div class="clear-fix my-2"></div>
  </div> -->
  <div class="d-flex  justify-content-center align-items-center col-lg-7 bg-gradient-light text-dark">
    <div class="card card-outline card-purple w-75">
      <div class="card-header text-center">
        <a href="./" class="text-decoration-none text-dark"><b>Create an Account - Client</b></a>
      </div>
      <div class="card-body">
        <form id="register-frm" action="register.php" method="post">
          <input type="hidden" name="id">
          <div class="row">
            <div class="form-group col-md-6">
                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" class="form-control form-control-sm form-control-border" required pattern="[A-Za-z ]+" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                <small class="ml-3">First Name</small>
            </div>
            <div class="form-group col-md-6">
                <input type="text" name="middlename" id="middlename" placeholder="Enter Middle Name (optional)" class="form-control form-control-sm form-control-border" pattern="[A-Za-z ]+" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                <small class="ml-3">Middle Name</small>
            </div>
            <div class="form-group col-md-6">
                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" class="form-control form-control-sm form-control-border" required pattern="[A-Za-z ]+" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                <small class="ml-3">Last Name</small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
                  <select name="gender" id="gender" class="custom-select custom-select-sm form-control-border" required>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                  <small class="ml-3">Gender</small>
            </div>
            <div class="form-group col-md-6">
                <input type="number" name="contact" id="contact" placeholder="Enter Contact" class="form-control form-control-sm form-control-border" required>
                <small class="ml-3">Contact Number</small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <small class="ml-3">Address</small>
              <textarea name="address" id="address" rows="3" class="form-control form-control-sm rounded-0" placeholder="Enter Your Full Address"></textarea>
            </div>
          </div>
          <hr>
          <!--<div class="row">
            <div class="form-group col-md-6">
                <input type="email" name="email" id="email" placeholder="harryden@mail.com" class="form-control form-control-sm form-control-border" required>
                <small class="ml-3">Email</small>
            </div>
          </div>-->
		  <div class="row">
    <div class="form-group col-md-6">
        <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control form-control-sm" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
        <small class="ml-3">Email</small>
    </div>
    <div class="form-group col-md-6">
        <button type="button" id="sendOtpBtn" class="btn btn-primary btn-sm">Send OTP</button>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <input type="text" name="otp" id="otp" placeholder="Enter OTP" class="form-control form-control-sm" required>
        <small class="ml-3">Enter the OTP sent to your email</small>
    </div>
</div>

          <div class="row">
            <div class="form-group col-md-6">
                <div class="input-group">
                  <input type="password" name="password" id="password" placeholder="" class="form-control form-control-sm form-control-border" required>
                  <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                  </div>
                </div>
                <small class="ml-3">Password</small>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                  <input type="password" id="cpassword" placeholder="" class="form-control form-control-sm form-control-border" required>
                  <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                  </div>
                </div>
                <small class="ml-3">Confirm Password</small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="" class="control-label">Avatar</label>
              <div class="custom-file">
                      <input type="file" class="custom-file-input rounded-0 form-control form-control-sm form-control-border" id="customFile" name="img" onchange="displayImg(this,$(this))">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
            </div>
          <div class="row">
          </div>
            <div class="form-group col-md-6 d-flex justify-content-center">
              <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-8">
              <a href="<?php echo base_url ?>" style="text-decoration:none;">Back</a>
            </div>
			<!-- TERMS AND CONDITION CHECKBOX -->
			<div class="row mt-3">
			<div class="form-group col-md-12">
				<div class="form-check">
				<input type="checkbox" class="form-check-input" id="terms" required>
				<label for="terms" class="form-check-label">
				<i>I accept the </i><a href="terms.php"><b>Terms and Conditions</b> .</a>
				</label>
				</div>
				</div>
			</div>

            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-sm btn-flat btn-block" id="reg">Register</button>
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
              <div class="col-12 text-center">
              <a href="<?php echo base_url.'login.php' ?>" style="text-decoration:none;">Already have an Account</a>
              </div>
          </div>
        </form>
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p> -->
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

</div>

<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?= base_url ?>dist/js/adminlte.min.js"></script> -->

<script>
  window.displayImg = function(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
            _this.siblings('.custom-file-label').html("Choose file")
        }
	}
  $(document).ready(function(){
	  
    end_loader();
    $('.pass_type').click(function(){
      var type = $(this).attr('data-type')
      if(type == 'password'){
        $(this).attr('data-type','text')
        $(this).closest('.input-group').find('input').attr('type',"text")
        $(this).removeClass("fa-eye-slash")
        $(this).addClass("fa-eye")
      }else{
        $(this).attr('data-type','password')
        $(this).closest('.input-group').find('input').attr('type',"password")
        $(this).removeClass("fa-eye")
        $(this).addClass("fa-eye-slash")
      }
    })
	
	//------------------Getting Error-------------------//
	$('#register-frm').submit(function(e){
      e.preventDefault()
      var _this = $(this)
			 $('.err-msg').remove();
       var el = $('<div>')
            el.hide()
      if($('#password').val() != $('#cpassword').val()){
        el.addClass('alert alert-danger err-msg').text('Password does not match.');
        _this.prepend(el)
        el.show('slow')
        return false;
      }
			start_loader();
			$.ajax({
    url: _base_url_ + "classes/Users.php?f=save_client",
    data: new FormData($(this)[0]),
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST',
    dataType: 'json',
    error: function (err) {
        console.log("AJAX Error:", err.responseText); // Log full error
        alert_toast("An error occurred", 'error');
        end_loader();
    },
success: function(resp) {
    console.log("Server Response:", resp); // Debugging line
    if (resp.status === 'success') {
        location.href = "./login.php";
    } else {
        alert_toast(resp.msg || "Registration failed", 'error');
    }
    end_loader();
},
error: function(err) {
    console.log("AJAX Error:", err);
    alert_toast("An error occurred", 'error');
    end_loader();
}

});

    })
  })

$(document).ready(function(){
    $('#sendOtpBtn').click(function(){
        var email = $('#email').val();
        if(email == ''){
            alert('Enter your email first!');
            return;
        }
        $.ajax({
            url: 'send_otp.php',
            type: 'POST',
            data: {email: email},
            dataType: 'json',
            success: function(response){
                alert(response.msg);
            }
        });
    });

    $('#register-frm').submit(function(e){
        if($('#password').val() != $('#cpassword').val()){
            alert("Passwords do not match!");
            e.preventDefault();
        }
    });
});
//---------------------------------------May be//
$(document).ready(function() {
    $('#register-frm').submit(function(e) {
        // Check password match
        if ($('#password').val() !== $('#cpassword').val()) {
            alert("Passwords do not match!");
            e.preventDefault();
            return;
        }

        // Check terms and conditions
        if (!$('#terms').is(':checked')) {
            alert("You must accept the Terms and Conditions!");
            e.preventDefault();
            return;
        }
    });

    // Debug AJAX response
    $.ajax({
        url: _base_url_ + "classes/Users.php?f=save_client",
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(resp) {
            console.log("Server Response:", resp);
            if (resp.status === 'success') {
                location.href = "./login.php";
            } else {
                alert_toast(resp.msg || "Registration failed", 'error');
            }
        },
        error: function(err) {
            console.log("AJAX Error:", err);
            alert_toast("An error occurred", 'error');
        }
    });
});
</script>
</body>
</html>