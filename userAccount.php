<?php
session_start();
require_once('./database/db_config.php');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <style>
        .hidetext { -webkit-text-security: disc; /* Default */ }
    </style>
<title>BMIS | Users Accounts</title>
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>


<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>User Accounts</span></h5>
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
                                    <a href="#addNewUser"  class="btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4 modal-trigger invoice-create ">
                                <i class="material-icons">add</i>
                                <span class="hide-on-small-only">Add New Official</span>

                            </a>
                                </div>
                                </div>

                               
                        </div>
                        <div class="users-list-table">
                            
                            <div class="card">
                                <div class="card-content">
                                   
                                    <!-- datatable start -->
                                    <div class="responsive-table">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Level Access</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    //Include DB connection
                                               include ('./database/db_config.php');
  

                                                    $squery = mysqli_query($conn, "SELECT ua.acc_ID,bod.official_ID,rd.res_fName,rd.res_mName,rd.res_lName,rs.suffix,ua.acc_username,ua.acc_password,us.status_Name,us.status_ID,rp.position_Name, rp.position_ID FROM `user_account` ua 
                                                    LEFT JOIN brgy_official_detail bod ON ua.official_ID = bod.official_ID 
                                                    LEFT JOIN resident_detail rd ON bod.res_ID = rd.res_ID 
                                                    LEFT JOIN ref_position rp ON rp.position_ID = ua.position_ID
                                                    LEFT JOIN ref_suffixname rs ON rd.suffix_ID = rs.suffix_ID
                                                    LEFT JOIN user_status us ON ua.status_ID = us.status_ID ORDER BY ua.acc_created DESC");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        $suffix = $row['suffix'];
                                                        $crypt = crypt("Darren",$row['acc_password']);
                                                        if ($suffix == "N/A") {
                                                            $suffix = "";
                                                          }
                                                          else{
                                                             $suffix = $row['suffix'];
                                                          }

                                                        echo '
                                                        <tr>
                                                        <td>'.$row['res_fName']." ".$row['res_mName'].". ".$row['res_lName']." ".$suffix.'</td>
                                                            <td>'.$row['acc_username'].'</td>
                                                            
                                                            <td>'.$row['position_Name'].'</td>';

                                                            if($row['status_ID'] == 2){
                                                               
                                                                echo '<td><span class="chip red lighten-5">
                                                                <span class="red-text">
                                                                '.$row['status_Name'].'
                                                                </span></td>
                                                                <td>
                                                                ';
                                                           
                                                            }else{
                                                                echo '<td><span class="chip green lighten-5"><span class="green-text">'.$row['status_Name'].'</span></td>
                                                                <td>';
                                                            }

                                                            echo '
                                                            <a href="#updateCurrentUser_'.$row['acc_ID'].'" class="modal-trigger" data-id="'.$row['acc_ID'].'" ><i class="material-icons">edit</i></a>
                                                            </td>';

                                                            include './modals/update-current-user.php';

                                                            // echo "
                                                            // <a href='#updateCurrentUser".$row['acc_ID']."' class='modal-trigger'> <i class='material-icons'>edit</i></a>
                                                            // </td>";

                                                        // include "edit_modal.php";
                                                        // include "endterm_modal.php";
                                                        // include "startterm_modal.php";
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
            <!-- Modal -->
      <?php include './modals/add-new-user.php' ?>

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

    <script src="./app-assets/js/custom/userAccounts.js"></script>
    <script src="./app-assets/js/custom/swalToast.js"></script>


</body>

</html>