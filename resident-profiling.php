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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Resident Profiling</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- users list start -->
                    <section class="users-list-wrapper section users-view">
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="row">
                                <div class="col s12 m12 quick-action-btns display-flex align-items-center">
                                    <a href="/bmis_v1/add-resident-profiling.php"  class="btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4 modal-trigger invoice-create ">
                                <i class="material-icons">add</i>
                                <span class="hide-on-small-only">Add New Resident</span>

                            </a>
                                </div>
                                </div>

                               
                        </div>
                        <div class="users-list-table">
                            
                            <div class="card">
                                <div class="card-content">
                                   
                                    <!-- datatable start -->
                                    <div class="responsive-table">
                                        <table id="resident-list-datatable" class="table">
                                            <thead>
                                            <tr>
                                            <th>Name</th>
            <th>Age</th>
            <th>Stage</th>
            <th>Sex</th>
            <th>Citizenship</th>
            <th>Occupation</th>
            <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            include ('./database/db_config.php');
          while ($res_data = mysqli_fetch_array($sql)) {
            $suffix = $res_data['suffix'];
            if ($suffix == "N/A") {
              $suffix = "";
            }
            else{
               $suffix = $res_data['suffix'];
            }
           ?>
           <tr>
            <td><small><?php echo $res_data['res_fName']." ".$res_data['res_mName'].". ".$res_data['res_lName']." ".$suffix ?></td>
            <td><small><?php echo $res_data['age'] ?></td>
            <td><small><?php echo $res_data['Age_Stage'] ?></td>
            <td><small><?php echo $res_data['gender_Name'] ?></td>
            <td><small><?php echo $res_data['country_citizenship'] ?></td>
            <td><small><?php echo $res_data['occupation_Name'] ?></td>
            <td>
            <a href="#" data-target="#view" data-id="<?php echo $res_data['res_ID']; ?>"  id="view_resident"><i class="material-icons">edit</i></a>
            <a href="#" data-target="#edit" data-id="<?php echo $res_data['res_ID']; ?>"  id="edit_resident"><i class="material-icons">edit</i></a>
            </td>
          </tr>
           <?php
          }
          ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </section>
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

    <script src="./app-assets/js/custom/resident-profiling.js"></script>
    <script src="./app-assets/js/custom/swalToast.js"></script>



</body>

</html>