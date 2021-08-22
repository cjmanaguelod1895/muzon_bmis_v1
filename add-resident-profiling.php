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
    /* .validate{
        text-transform: uppercase;
    } */
    #camBox {
        display: none;
        position: fixed;
        border: 0;
        top: 0;
        right: 0;
        left: 0;
        overflow-x: auto;
        overflow-y: hidden;
        z-index: 9999;
        background-color: rgba(239, 239, 239, .9);
        width: 100%;
        height: 100%;
        padding-top: 10px;
        text-align: center;
        cursor: pointer;
        -webkit-box-align: center;
        -webkit-box-orient: vertical;
        -webkit-box-pack: center;
        -webkit-transition: .2s opacity;
        -webkit-perspective: 1000
    }

    .revdivshowimg {
        width: 400px;
        top: 0;
        padding: 0;
        position: relative;
        margin: 0 auto;
        display: block;
        background-color: #fff;
        webkit-box-shadow: 6px 0 10px rgba(0, 0, 0, .2), -6px 0 10px rgba(0, 0, 0, .2);
        -moz-box-shadow: 6px 0 10px rgba(0, 0, 0, .2), -6px 0 10px rgba(0, 0, 0, .2);
        box-shadow: 6px 0 10px rgba(0, 0, 0, .2), -6px 0 10px rgba(0, 0, 0, .2);
        overflow: hidden;
        border-radius: 3px;
        color: #17293c
    }
</style>
<title>BMIS | Resident Profiling</title>
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>


<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns"
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <div id="camBox" style="width:100%;height:100%;">
        <!--POPUP DIALOG BOX TO SHOW LIVE WEBCAM.-->
        <div class="revdivshowimg" style="top:20%;text-align:center;margin:0 auto;">

            <div id="camera" style="height:auto;text-align:center;margin:30px auto;"></div>

            <p>
                <button class="waves-effect waves dark btn btn-primary" type="submit" id="btnAddImage">
                    Add Image
                    <i class="material-icons right">save</i>
                </button>
                <button class="waves-effect waves dark btn btn-primary" type="submit"
                    onclick="document.getElementById('camBox').style.display = 'none';">
                    Cancel
                    <i class="material-icons right">cancel</i>
                </button>
            </p>
            <input type="hidden" id="rowid" /><input type="hidden" id="dataurl" />
        </div>

    </div>

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
                    <div id="results"></div>
                    <!-- Horizontal Stepper -->

                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content pb-0">

                                    <ul class="stepper horizontal" id="horizStepper">
                                        <li class="step active">
                                            <div class="step-title waves-effect">Basic Information</div>
                                            <form id="basicInformationForm" name="basicInformationForm">
                                                <div class="step-content">
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <label for="res_fname" class="active">First Name</label>
                                                            <div class="input-field">
                                                                <input maxlength="50" type="text" id="res_fname"
                                                                    name="res_fname" data-error=".errorTxt1"
                                                                    class="validate" required>
                                                                <small class="errorTxt1"></small>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <label for="res_mname" class="active">Middle Name</label>
                                                            <div class="input-field">
                                                                <input maxlength="50" type="text" id="res_mname"
                                                                    class="validate" name="res_mname">
                                                            </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <label for="res_lname" class="active">Last Name</label>
                                                            <div class="input-field">
                                                                <input maxlength="50" type="text" id="res_lname"
                                                                    class="validate" name="res_lname"
                                                                    data-error=".errorTxt2" class="validate" required>
                                                                <small class="errorTxt2"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                                <select id="res_suffix" name="res_suffix"
                                                                    class="select2 browser-default"
                                                                    data-error=".errorTxt3" class="validate" required>
                                                                    <option class="optionStyle" value="" disabled
                                                                        selected>Suffix</option>
                                                                    <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_suffixname");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>">
                                                                        <?php echo $row[1];?></option>
                                                                    <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt3"></small>
                                                            </div>

                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                                <select class="select2 browser-default" id="res_gender"
                                                                    name="res_gender" data-error=".errorTxt4"
                                                                    class="validate" required>
                                                                    <option class="optionStyle" value="" disabled
                                                                        selected>Gender</option>

                                                                    <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_gender");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>">
                                                                        <?php echo $row[1];?></option>

                                                                    <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt4"></small>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">

                                                            <label for="res_bdate" class="active">Birth Date</label>
                                                            <div class="input-field">
                                                                <input placeholder="YYYY-MM-DD" id="res_bdate"
                                                                    name="res_bdate" type="text" data-error=".errorTxt5"
                                                                    class="validate" required>
                                                                <small class="errorTxt4"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                                <select class="select2 browser-default"
                                                                    id="res_civilstatus" name="res_civilstatus"
                                                                    data-error=".errorTxt6" class="validate" required>
                                                                    <option value="" disabled selected>Civil Status
                                                                    </option>
                                                                    <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_marital_status");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>">
                                                                        <?php echo $row[1];?></option>

                                                                    <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt6"></small>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                                <select class="select2 browser-default"
                                                                    id="res_contacttype" name="res_contacttype"
                                                                    data-error=".errorTxt7" class="validate" required>
                                                                    <option value="" disabled selected>Contact Type
                                                                    </option>
                                                                    <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_contact");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                    <option value="<?php echo $row[0] ?>">
                                                                        <?php echo $row[1];?></option>

                                                                    <?php
                                                            }

                                                            ?>
                                                                </select>
                                                                <small class="errorTxt7"></small>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col m4 s12">
                                                            <div class="input-field">
                                                                <input placeholder="09451376758" id="res_contactnum"
                                                                    name="res_contactnum" type="text"
                                                                    data-error=".errorTxt8" class="validate" required>
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
                                                                <button
                                                                    class="waves-effect waves dark btn btn-primary next-step"
                                                                    type="submit" id="basicInformationButton">
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
                                    <div class="step-title waves-effect">Resident Address</div>
                                    <form id="residentAddressForm" name="residentAddressForm">
                                        <div class="step-content">
                                            <div class="row">
                                                <div class="input-field col m6 s12">
                                                    <div class="input-field">
                                                        <select id="res_address" name="res_address"
                                                            class="select2 browser-default" data-error=".errorTxt8"
                                                            class="validate" required>
                                                            <option value="" disabled selected>Address Type</option>
                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_address");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row[0] ?>"><?php echo $row[1];?>
                                                            </option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                        <small class="errorTxt8"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m6 s12">
                                                    <div class="input-field">
                                                        <select id="res_purokno" name="res_purokno"
                                                            class="select2 browser-default" data-error=".errorTxt9"
                                                            class="validate" required>
                                                            <option value="" disabled selected>Purok</option>
                                                            <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_purok");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row[0] ?>"><?php echo $row[2];?>
                                                            </option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                        <small class="errorTxt9"></small>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_unit">Unit-Room-Floor</label>
                                                        <input maxlength="10" type="number" id="res_unit"
                                                            name="res_unit" data-error=".errorTxt10" class="validate"
                                                            required>
                                                        <small class="errorTxt10"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_building">Building Name</label>
                                                        <input maxlength="4" type="text" id="res_building"
                                                            name="res_building" data-error=".errorTxt11"
                                                            class="validate" required>
                                                        <small class="errorTxt11"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_lot">Lot</label>
                                                        <input maxlength="4" type="number" id="res_lot" name="res_lot"
                                                            data-error=".errorTxt12" class="validate" required>
                                                        <small class="errorTxt12"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_block">Block</label>
                                                        <input maxlength="4" type="number" id="res_block"
                                                            name="res_block" data-error=".errorTxt13" class="validate"
                                                            required>
                                                        <small class="errorTxt13"></small>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_phase">Phase</label>
                                                        <input maxlength="10" type="number" id="res_phase"
                                                            name="res_phase" data-error=".errorTxt14" class="validate"
                                                            required>
                                                        <small class="errorTxt14"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_houseno">House number</label>
                                                        <input maxlength="4" type="number" id="res_houseno"
                                                            name="res_houseno" data-error=".errorTxt15" class="validate"
                                                            required>
                                                        <small class="errorTxt15"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_street">Street</label>
                                                        <input maxlength="10" type="text" id="res_street"
                                                            name="res_street" data-error=".errorTxt16" class="validate"
                                                            required>
                                                        <small class="errorTxt16"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col m3 s12">
                                                    <div class="input-field">
                                                        <label for="res_subd">Subdivision</label>
                                                        <input maxlength="4" type="text" id="res_subd" name="res_subd"
                                                            data-error=".errorTxt17" class="validate" required>
                                                        <small class="errorTxt17"></small>
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
                                                        <button class="btn btn-light previous-step">
                                                            <i class="material-icons left">arrow_back</i>
                                                            Prev
                                                        </button>
                                                    </div>
                                                    <div class="col m4 s12 mb-3">
                                                        <button
                                                            class="waves-effect waves dark btn btn-primary next-step"
                                                            type="submit" id="residentAddressButton">
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
                                <div class="step-title waves-effect">Other Information</div>
                                <div class="step-content">
                                    <div class="row">
                                        <div class="col s12 m4 l4 user-section-negative-margin">

                                            <div class="card-panel border-radius-6 mt-10 card-animation-1">

                                                <img id="capturedImage"
                                                    class="responsive-img border-radius-8 z-depth-4 image-n-margin"
                                                    src="./app-assets/images/cards/news-fashion.jpg" alt="">

                                                <div class="display-flex justify-content-between flex-wrap mt-4">
                                                    <div class="display-flex align-items-center mt-1">
                                                        <button class="waves-effect waves dark btn btn-primary"
                                                            type="submit" id="captureImage">
                                                            Take
                                                            <i class="material-icons right">camera_alt</i>
                                                        </button>
                                                    </div>
                                                    <div class="display-flex align-items-center mt-1">
                                                        <button class="red btn mr-1" type="submit" id="resetImage">
                                                            Reset
                                                            <i class="material-icons">clear</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-field col s12 m8 l8">
                                            <br>
                                            <form id="otherInformationForm" name="otherInformationForm">
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <select id="res_religion" name="res_religion"
                                                                class="select2 browser-default" data-error=".errorTxt18"
                                                                class="validate" required>
                                                                <option value="" disabled selected>Religion</option>
                                                                <?php
                                                             $res=mysqli_query($conn,"SELECT * FROM ref_religion");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>">
                                                                    <?php echo $row[1];?>
                                                                </option>
                                                                <?php
                                                            }

                                                            ?>
                                                            </select>
                                                            <small class="errorTxt18"></small>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <select class="select2 browser-default" id="res_citizenship"
                                                                name="res_citizenship" data-error=".errorTxt19"
                                                                class="validate" required>
                                                                <option value="" disabled selected>Citizenship</option>

                                                                <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_country");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>">
                                                                    <?php echo $row[2];?>
                                                                </option>

                                                                <?php
                                                            }

                                                            ?>
                                                            </select>
                                                            <small class="errorTxt19"></small>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <select class="select2 browser-default"
                                                                id="res_occupationstatus" name="res_occupationstatus"
                                                                data-error=".errorTxt20" class="validate" required>
                                                                <option value="" disabled selected>Occupational status
                                                                </option>
                                                                <option value="NULL">N/A</option>

                                                                <?php
                                                            $res=mysqli_query($conn,"SELECT * FROM ref_occupation_status");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>">
                                                                    <?php echo $row[1];?>
                                                                </option>

                                                                <?php
                                                            }

                                                            ?>
                                                            </select>
                                                            <small class="errorTxt20"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <select id="res_occupation" name="res_occupation"
                                                                class="select2 browser-default" data-error=".errorTxt21"
                                                                class="validate" required>
                                                                <option value="" disabled selected>Occupation</option>
                                                                <?php
                                                             $res=mysqli_query($conn,"SELECT * FROM ref_occupation");
                                                            while ($row=mysqli_fetch_array($res))
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>">
                                                                    <?php echo $row[1];?></option>
                                                                <?php
                                                            }

                                                            ?>
                                                            </select>

                                                            <small class="errorTxt21"></small>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <label for="res_height">Height: <span
                                                                    class="red-text">*</span></label>
                                                            <input maxlength="3" type="text" id="res_height"
                                                                class="validate" name="res_height"
                                                                data-error=".errorTxt22" placeholder="Meter/Centimeter"
                                                                class="validate" required>
                                                            <small class="errorTxt22"></small>
                                                        </div>
                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <div class="input-field">
                                                            <label for="res_weight">Weight: <span
                                                                    class="red-text">*</span></label>
                                                            <input maxlength="3" type="text" id="res_weight"
                                                                class="validate" name="res_weight"
                                                                data-error=".errorTxt23" placeholder="Kilogram"
                                                                class="validate" required>
                                                            <small class="errorTxt23"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>



                                    <div class="step-actions" style="margin-bottom:-65px;">
                                        <div class="row">
                                            <div class="col m4 s12 mb-3">
                                                <button class="red btn mr-1 btn-reset" type="reset">
                                                    <i class="material-icons">clear</i>
                                                    Reset
                                                </button>
                                            </div>
                                            <div class="col m4 s12 mb-3">
                                                <button class="btn btn-light previous-step">
                                                    <i class="material-icons left">arrow_back</i>
                                                    Prev
                                                </button>
                                            </div>
                                            <div class="col m4 s12 mb-3">
                                                <button class="waves-effect waves-dark btn btn-primary" type="submit"
                                                    id="submitFinalFormButton">Submit
                                                    <i class="material-icons right">save</i>
                                                </button>
                                            </div>
                                            </form>
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
    function loadWebCamJS() {
        Webcam.set({
            width: 308.66,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach('#camera');
    }

    (function ($) {
        $.fn.serializeFormJSON = function () {

            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);

    $(document).ready(function () {

        var isBasicInfoFormValid = false;
        var isResidentAddressFormValid = false;
        var isOtherInformationFormValid = false;

        var basicInformationFormData = {};
        var residentAddressFormData = {};
        var otherInformationFormData = {};


        $("#res_fname").keypress(function (event) {
            var inputValue = event.charCode;
            if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                event.preventDefault();
            }
        });

        $("#res_mname").keypress(function (event) {
            var inputValue = event.charCode;
            if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                event.preventDefault();
            }
        });

        $("#res_lname").keypress(function (event) {
            var inputValue = event.charCode;
            if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                event.preventDefault();
            }
        });

        $(".select2").select2({
            /* the following code is used to disable x-scrollbar when click in select input and
            take 100% width in responsive also */
            dropdownAutoWidth: true,
            width: '100%',
        });


        //Basic Information Validate
        $("#basicInformationForm").validate({
            onfocusout: false,
            ignore: "",
            rules: {
                //First Form
                res_fname: {
                    required: true,
                    // lettersonly: true
                },
                res_lname: {
                    required: true
                },
                res_suffix: {
                    required: true
                },
                res_gender: {
                    required: true
                },
                res_bdate: {
                    required: true
                },
                res_civilstatus: {
                    required: true
                },
                res_contacttype: {
                    required: true
                },
                res_contactnum: {
                    required: true
                },
                //Second Form
                res_address: {
                    required: true
                },
                res_purokno: {
                    required: true
                },
                res_unit: {
                    required: true
                },
                res_building: {
                    required: true
                },
                res_lot: {
                    required: true
                },
                res_block: {
                    required: true
                },
                res_phase: {
                    required: true
                },
                res_houseno: {
                    required: true
                },
                res_street: {
                    required: true
                },
                res_subd: {
                    required: true
                },
                //3rd Form

            },
            //For custom messages
            messages: {
                //First Form
                res_fname: {
                    required: "Enter First Name"
                },
                res_lname: {
                    required: "Enter Last Name"
                },
                res_suffix: {
                    required: "Please select suffix"
                },
                res_gender: {
                    required: "Please select gender"
                },
                res_bdate: {
                    required: "Enter Birthdate"
                },
                res_civilstatus: {
                    required: "Please select civil status"
                },
                res_contacttype: {
                    required: "Please select contact type"
                },
                res_contactnum: {
                    required: "Enter Contact Number"
                },
                //Second Form
                res_address: {
                    required: "Please select Address type"
                },
                res_purokno: {
                    required: "Please select purok"
                },
                res_unit: {
                    required: "Enter Unit Room Floor"
                },
                res_building: {
                    required: "Enter Building Name"
                },
                res_lot: {
                    required: "Enter Lot number"
                },
                res_block: {
                    required: "Enter Block number"
                },
                res_phase: {
                    required: "Enter Phase number"
                },
                res_houseno: {
                    required: "Enter House number"
                },
                res_street: {
                    required: "Enter Street name"
                },
                res_subd: {
                    required: "Enter Subdivison name"
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }

        });

        //Resident Address Validate
        $("#residentAddressForm").validate({
            onfocusout: false,
            ignore: "",
            rules: {
                res_address: {
                    required: true
                },
                res_purokno: {
                    required: true
                },
                res_unit: {
                    required: true
                },
                res_building: {
                    required: true
                },
                res_lot: {
                    required: true
                },
                res_block: {
                    required: true
                },
                res_phase: {
                    required: true
                },
                res_houseno: {
                    required: true
                },
                res_street: {
                    required: true
                },
                res_subd: {
                    required: true
                },

            },
            //For custom messages
            messages: {

                res_address: {
                    required: "Please select Address type"
                },
                res_purokno: {
                    required: "Please select purok"
                },
                res_unit: {
                    required: "Enter Unit Room Floor"
                },
                res_building: {
                    required: "Enter Building Name"
                },
                res_lot: {
                    required: "Enter Lot number"
                },
                res_block: {
                    required: "Enter Block number"
                },
                res_phase: {
                    required: "Enter Phase number"
                },
                res_houseno: {
                    required: "Enter House number"
                },
                res_street: {
                    required: "Enter Street name"
                },
                res_subd: {
                    required: "Enter Subdivison name"
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
        });

        //Other Information Validate
        $("#otherInformationForm").validate({
            onfocusout: false,
            ignore: "",
            rules: {
                res_height: {
                    required: true
                },
                res_citizenship: {
                    required: true
                },
                res_religion: {
                    required: true
                },
                res_occupationstatus: {
                    required: true
                },
                res_occupation: {
                    required: true
                },
                res_weight: {
                    required: true
                }

            },
            //For custom messages
            messages: {
                res_height: {
                    required: "Enter Height"
                },
                res_weight: {
                    required: "Enter Weight"
                },
                res_citizenship: {
                    required: "Please select Citizenship"
                },
                res_religion: {
                    required: "Please select Relegion"
                },
                res_occupationstatus: {
                    required: "Please select Occupation Status"
                },
                res_occupation: {
                    required: "Please select Occupation"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
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
            'pattern': '{{999}}{{999}}{{99999}}',
            'persistent': true
        });


    });

    $("#basicInformationButton").click(function (e) {
        e.preventDefault();

        isBasicInfoFormValid = $("#basicInformationForm").valid();

        basicInformationFormData = $("#basicInformationForm").serializeFormJSON();

    });

    $("#residentAddressButton").click(function (e) {
        e.preventDefault();

        isResidentAddressFormValid = $("#residentAddressForm").valid();

        residentAddressFormData = $("#residentAddressForm").serializeFormJSON();

    });

    //Submit Final Form
    $("#submitFinalFormButton").click(function (e) {
        e.preventDefault();

        isOtherInformationFormValid = $("#otherInformationForm").valid();


        otherInformationFormData = $("#otherInformationForm").serializeFormJSON();
        otherInformationFormData.res_img = $("#capturedImage").attr('src');


        var residentFormData = Object.assign(basicInformationFormData, residentAddressFormData,
            otherInformationFormData);

        if (isBasicInfoFormValid === true && isResidentAddressFormValid === true &&
            isOtherInformationFormValid === true) {

            //Disable Submit Button
            $("#submitFinalFormButton").attr("disabled", "true");
            Toast.fire({
                icon: 'info',
                title: 'Saving Record... Please wait!',
            })

            setTimeout(() => {
                var url = "/bmis_v1/php-action-scripts/create.php";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        createNewResident: JSON.stringify(residentFormData)
                    },
                    dataType: 'json',
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.actionType === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: response.msg,
                            })
                            setTimeout(() => {
                                location.reload();

                            }, 5000);
                        } else if (response.actionType === 'error') {
                            setTimeout(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.msg
                                })
                                $("#submitFinalFormButton").removeAttr("disabled");

                            }, 2000);


                        }
                    }
                });
            }, 1000);




        } else {
            alert("Meron pang error.");
        }


    });



    //Initialize Form Wizard
    var horizStepper = document.querySelector('#horizStepper');
    var horizStepperInstace = new MStepper(horizStepper, {
        // options
        firstActive: 0,
        showFeedbackPreloader: true,
        autoFormCreation: true,
        // validationFunction: defaultValidationFunction,
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

    $('.btn-reset').on('click', function () {
        horizStepperInstace.openStep(0);
    })

    //Capture Image
    $("#captureImage").click(function (e) {
        e.preventDefault();
        $("#camBox").css({
            "display": "block"
        });
        loadWebCamJS();

    });
    //Add Image
    $("#btnAddImage").click(function (e) {
        e.preventDefault();
        Webcam.snap(function (data_uri) {
            // display results in page

            $('#capturedImage').attr("src", data_uri);
        });
        document.getElementById('camBox').style.display = 'none'; // HIDE THE POPUP DIALOG BOX.


        Webcam.reset();

    });

    //Reset Image
    $("#resetImage").click(function (e) {
        e.preventDefault();

        $('#capturedImage').attr("src", "./app-assets/images/cards/news-fashion.jpg");

    });
</script>