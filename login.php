<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- Include DB connection -->
<?php include ('./database/db_config.php'); ?>

<!-- BEGIN: Head-->
<title>Muzon Segundo BMIS | Login</title>
<?php include ('./page-layout/html-assets.php'); ?>
<!-- END: Head-->
<style>
.error{
    margin-left: 43px;
}
.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  -webkit-animation: spin 1s linear infinite;
  border-top: 5px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-dark-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form" method="" action="" id="loginForm" novalidate="novalidate">
                        <div class="row">
                                <div class="input-field col s12">
                                    <h6 class="ml-7">Barangay Management Information System</h5>
                                </div>
                            </div>
                        <div class="row">
                                        <div class="col s12 center-align">
                                            <img class="responsive-img circle z-depth-5" width="150" src="./app-assets/images/gallery/logo.png" alt="">
                                            <br>
                                        </div>
                                    </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="username" type="text" name="username" data-error=".errorTxt1">
                                    <label for="username" class="center-align">Username</label>
                                    <!-- <small class="text-danger ml-5" id="username-error"></small> -->
                                    <small class="errorTxt1"></small>
                                </div>
                                
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" name="password">
                                    <label for="password">Password</label>
                                    <small class="text-danger ml-5" id="password-error"></small>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                            <div class="loader" style="display:none;margin-left: 188px;"></div>
                                <div class="input-field col s12">
                                    <!-- <a href="#" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow" >Login</a> -->

                                    <button type="submit" href="#" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow" id="loginButton" style="text-align:center;margin-left: 156px;">Login</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                   
                                </div>
                                <div class="input-field col s6 m6 l6">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
        <script src="./app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="./app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="./app-assets/vendors/chartjs/chart.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="./app-assets/js/plugins.js"></script>
    <script src="./app-assets/js/search.js"></script>
    <script src="./app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="./app-assets/js/scripts/dashboard-ecommerce.js"></script> -->
    <script src="./app-assets/js/custom/form-validation.js"></script>
    <!-- END PAGE LEVEL JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <script>
         $('#loginForm').on('submit', function(e) {
      e.preventDefault();
      var data = new FormData($(this)[0]);
      data.append('action', 'login');
      var form = $(this);
      var url = "/bmis_v1/php-action-scripts/login.php";

      var userName = $("#username").val();
      var password = $("#password").val();

       if (userName.length <= 0 || password.length <= 0) {
        return false;
    }
    else{
        $('.loader').css({"display": "block"});
      $('#loginButton').css({"display": "none"});
   $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        error: function(xhr, textStatus, errorThrown) {
          console.log(xhr.responseText);
        },
        success: function(response) {
          console.log(response);
          form.find(':submit').attr('disabled', false);
          if (response.status == 1) {
            // handling success response
            //window.location.href = '/php_tutorial/dashboard.php';

            var middleName = (response.middle_name.length !== 0) ? response.middle_name : '';
            console.log(middleName);
            var name = response.first_name + " " + middleName + " " + response.last_name;

            setTimeout(() => {

Swal.fire({

title: "Login Successful",
text: "Welcome, "+ name +"",
icon: "success",
allowOutsideClick: false,
showConfirmButton: false
})
            }, 3000);

            setTimeout(() => {
                form.trigger('reset');
                window.location.href  = "/bmis_v1/dashboard.php"; 
              }, 7000);

          } else if (response.status == 0) {

            setTimeout(() => {
                $('.loader').css({"display": "none"});
      $('#loginButton').css({"display": "block"});       
            toastr.error(response.msg);
            }, 2000);

          }
        }
      });
    }   
   
    });
   
    </script>


</body>

</html>