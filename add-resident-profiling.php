<?php
require_once('./database/db_config.php');
require_once('./php-action-scripts/session.php');

?>
  <?php 
  
$sql = mysqli_query($conn,"SELECT res_ID,res_fName,res_mName,res_lName,rs.suffix,rms.marital_Name,rg.gender_Name,rr.religion_Name,ro.occupation_Name,ros.occuStat_Name,res_Date_Record,rc.country_citizenship,res_Bday,TIMESTAMPDIFF(YEAR,res_Bday,CURDATE()) AS age,
(case  
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1) then 'Maternal and Newborn'
 when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=1 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=12) then 'Babies'
when (TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Month,res_Bday,CURDATE())<=24) then 'Toddlers'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=2 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=4) then 'Preschoolers'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=5 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=8) then 'School Age Children'
 when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=9 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=12) then 'Tweens '
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=13 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=19) then 'Teenager'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=20 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=35) then 'Young Adult'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=36 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=55) then 'Middle-Aged Adults'
when (TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=56 and TIMESTAMPDIFF(Year,res_Bday,CURDATE())<=100) then 'Senior'
   end) Age_Stage
FROM resident_detail rd 
LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID 
LEFT JOIN ref_gender rg ON rd.gender_ID = rg.gender_ID
LEFT JOIN ref_marital_status rms ON rms.marital_ID = rd.marital_ID
LEFT JOIN ref_religion rr ON rr.religion_ID = rd.religion_ID 
LEFT JOIN ref_occupation ro ON ro.occupation_ID = rd.occupation_ID 
LEFT JOIN ref_occupation_status ros ON ros.occuStat_ID = rd.occuStat_ID
LEFT JOIN ref_country rc ON rc.country_ID = rd.country_ID");

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <style>
        .hidetext { -webkit-text-security: disc; /* Default */ }
    </style>
<title>BMIS | Resident Profiling</title>
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>


<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php include ('./page-layout/header.php'); ?>
    <!-- END: Header-->
 

    <!-- BEGIN: SideNav-->
    <?php include ('./page-layout/sidebar.php'); ?>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="./app-assets/images/gallery/breadcrumb-bg.jpg">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Add Resident</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- Horizontal Stepper -->

                    <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content pb-0">
                                        <div class="card-header mb-2">
                                            <h4 class="card-title">Horizontal Stepper</h4>
                                        </div>

                                        <ul class="stepper horizontal" id="horizStepper">
                                            <li class="step active">
                                                <div class="step-title waves-effect">Step 1</div>
                                                <form id="form1" name="form1"> 
                                                <div class="step-content">
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <label for="res_fname">First Name: <span class="red-text">*</span></label>
                                                            <input  type="text" id="res_fname" name="res_fname" data-error=".errorTxt1" class="validate" required>
                                                            <small class="errorTxt1"></small>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <!-- <label for="res_mname">Middle Name: <span class="red-text">*</span></label>
                                                            <input type="text" id="res_mname" name="res_mname"> -->
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <label for="res_lname">Last Name: <span class="red-text">*</span></label>
                                                            <input type="text" id="res_lname" class="validate" name="res_lname" data-error=".errorTxt2" class="validate" required>
                                                            <small class="errorTxt2"></small>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                            <select id="res_suffix" name="res_suffix" class="select2 browser-default" data-error=".errorTxt3" class="validate" required>
                                                            <option value="" disabled selected>Suffix</option>
                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_suffixname");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>
                                                                        <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt3"></small>
                                                        </div>
                                                                
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                            <select  class="select2 browser-default" id="res_gender" name="res_gender" data-error=".errorTxt4" class="validate" required>
                                                            <option value="" disabled selected>Gender</option>

                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_gender");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>

                                                                <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt4"></small>
                                                        </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            
                                                        <label for="res_bdate" class="active">Date</label>
                                                        <div class="input-field">
                                                        <input placeholder="2021-01-01" id="res_bdate" name="res_bdate" type="text" data-error=".errorTxt5" class="validate" required>
                                                            <small class="errorTxt4"></small>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                            <select  class="select2 browser-default" id="res_civilstatus" name="res_civilstatus" data-error=".errorTxt6" class="validate" required>
                                                            <option value="" disabled selected>Civil Status</option>
                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_marital_status");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>

                                                                        <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt6"></small>
                                                        </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <select  class="select2 browser-default" id="res_contacttype" name="res_contacttype" data-error=".errorTxt7" class="validate" required>
                                                            <option value="" disabled selected>Contact Type</option>
                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_contact");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>

                                                                        <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt7"></small>
                                                                </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <input placeholder="2021-01-01" id="res_contactnum" name="res_contactnum"  type="text" data-error=".errorTxt8" class="validate" required>
                                                            <label for="res_contactnum">Contact Number</label>
                                                            <small class="errorTxt7"></small>
                                                        </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="step-actions" style="margin-bottom:-120px;">
                                                        <div class="row">
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="red btn btn-reset" type="reset">
                                                                    <i class="material-icons left">clear</i>Reset
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="btn btn-light previous-step" disabled>
                                                                    <i class="material-icons left">arrow_back</i>
                                                                    Prev
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="waves-effect waves dark btn btn-primary next-step" type="submit" id="firstFormButton">
                                                                    Next
                                                                    <i class="material-icons right">arrow_forward</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        </form>
                                                </div>
                                            </li>
                                            <li class="step">
                                                <div class="step-title waves-effect">Step 2</div>
                                                <div class="step-content">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="proposal">Proposal Title: <span class="red-text">*</span></label>
                                                            <input type="text" class="validate" id="proposal" name="proposal" required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="job">Job Title: <span class="red-text">*</span></label>
                                                            <input type="text" class="validate" id="job" name="job" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="company">Previous Company:</label>
                                                            <input type="text" class="validate" id="company" name="company">
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="url">Video Url:</label>
                                                            <input type="url" class="validate" id="url">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="exp">Experience: <span class="red-text">*</span></label>
                                                            <input type="text" class="validate" id="exp" name="exp">
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="desc">Short Description: <span class="red-text">*</span></label>
                                                            <textarea name="dec" id="desc" rows="4" class="materialize-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="step-actions">
                                                        <div class="row">
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="red btn btn-reset" type="reset">
                                                                    <i class="material-icons left">clear</i>Reset
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="btn btn-light previous-step">
                                                                    <i class="material-icons left">arrow_back</i>
                                                                    Prev
                                                                </button>
                                                            </div>
                                                            <div class="col m4 s12 mb-3">
                                                                <button class="waves-effect waves dark btn btn-primary next-step" type="submit">
                                                                    Next
                                                                    <i class="material-icons right">arrow_forward</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="step">
                                                <div class="step-title waves-effect">Step 3</div>
                                                <div class="step-content">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="eventName">Event Name: <span class="red-text">*</span></label>
                                                            <input type="text" class="validate" id="eventName" name="eventName" required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select>
                                                                <option value="Select" disabled selected>Select Event Type</option>
                                                                <option value="Wedding">Wedding</option>
                                                                <option value="Party">Party</option>
                                                                <option value="FundRaiser">Fund Raiser</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <select>
                                                                <option value="Select" disabled selected>Select Event Status</option>
                                                                <option value="Planning">Planning</option>
                                                                <option value="In Progress">In Progress</option>
                                                                <option value="Completed">Completed</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select>
                                                                <option value="Select" disabled selected>Event Location</option>
                                                                <option value="New York">New York</option>
                                                                <option value="Queens">Queens</option>
                                                                <option value="Washington">Washington</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="Budget">Event Budget: <span class="red-text">*</span></label>
                                                            <input type="Number" class="validate" id="Budget" name="Budget">
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <p> <label>Requirments</label></p>
                                                            <p> <label>
                                                                    <input type="checkbox">
                                                                    <span>Staffing</span>
                                                                </label></p>
                                                            <p><label>
                                                                    <input type="checkbox">
                                                                    <span>Catering</span>
                                                                </label></p>
                                                        </div>
                                                    </div>
                                                    <div class="step-actions">
                                                        <div class="row">
                                                            <div class="col m6 s12 mb-1">
                                                                <button class="red btn mr-1 btn-reset" type="reset">
                                                                    <i class="material-icons">clear</i>
                                                                    Reset
                                                                </button>
                                                            </div>
                                                            <div class="col m6 s12 mb-1">
                                                                <button class="waves-effect waves-dark btn btn-primary" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    <!-- END: Page Modal-->
    </div>
    <!-- END: Page Main-->

  
    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->


    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <?php include ('./page-layout/html-vendors.php');  ?>

    <!-- END PAGE LEVEL JS-->

    <!-- <script src="./app-assets/js/custom/resident-profiling.js"></script> -->
    
    
    <script src="./app-assets/js/custom/swalToast.js"></script>
     

</body>

</html>

<script>

$(document).ready(function () {

    $(".select2").select2({
        /* the following code is used to disable x-scrollbar when click in select input and
        take 100% width in responsive also */
        dropdownAutoWidth: true,
        width: '100%',
    });

    $("#form1").validate({
        onfocusout: false,
        ignore: "",
        rules: {
            res_fname: {
                required: true
            },
            res_lname:{
                required: true
            },
            res_suffix:{
                required: true
            },
            res_gender:{
                required: true
            },
            res_bdate:{
                required: true
            },
            res_civilstatus:{
                required: true
            },
            res_contacttype:{
                required: true
            },
            res_contactnum:{
                required: true
            }
        },
        //For custom messages
        messages: {
            res_fname: {
                required: "Enter First Name"
            },
            res_lname:{
                required: "Enter Last Name"
            },
            res_suffix:{
                required: "Please select suffix"
            },
            res_gender:{
                required: "Please select gender"
            },
            res_bdate:{
                required: "Enter Birthdate"
            },
            res_civilstatus:{
                required: "Please select civil status"
            },
            res_contacttype:{
                required: "Please select contact type"
            },
            res_contactnum:{
                required: "Enter Contact Number"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
    });






    //Birthdate format
    $('#res_bdate').formatter({
    'pattern': '{{9999}}-{{99}}-{{99}}',
    });

    //Contact Number format
    $('#res_contactnum').formatter({
    'pattern': '({{999}}) {{999}}-{{99999}}',
    'persistent': true
  });


});

$("#firstFormButton").click(function (e) { 
    e.preventDefault();

    $("#form1").valid();

    console.log($("#form1").valid());
    
});

    //Initialize Form Wizard
var horizStepper = document.querySelector('#horizStepper');
var horizStepperInstace = new MStepper(horizStepper, {
    // options
    firstActive: 0,
    showFeedbackPreloader: true,
    autoFormCreation: true,
    validationFunction: defaultValidationFunction,
    stepTitleNavigation: false,
    feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
});


function validationFunction(stepperForm, activeStepContent) {
    // You can use the 'stepperForm' to valide the whole form around the stepper:
    someValidationPlugin(stepperForm);
    // Or you can do something with just the activeStepContent
    //someValidationPlugin(activeStepContent);
    // Return true or false to proceed or show an error
    return true;
}


function defaultValidationFunction(stepperForm, activeStepContent) {
    var inputs = activeStepContent.querySelectorAll('input, textarea, select');
    for (var i = 0; i < inputs.length; i++) {
        if (!inputs[i].checkValidity()) return false;
    }
    return true;
}

$('.btn-reset').on('click', function() {
    horizStepperInstace.openStep(0);
})
</script>