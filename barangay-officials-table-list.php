<?php
session_start();
require_once('./database/db_config.php');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>

<!-- END: Head-->

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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Barangay Official List</span></h5>
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
                                    <a id="buttonCopy"></a>
                                    <a id="buttonExportToPDF"></a>
                                    <a id="buttonExportToCSV"></a>
                                    <a id="buttonPrint"></a>
                                    <a id="test"></a>
                                    <a href="#add-barangay"  class="btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4 modal-trigger invoice-create ">
                                <i class="material-icons">add</i>
                                <span class="hide-on-small-only">Add New Official</span>

                            </a>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col s12 m12 quick-action-btns display-flex align-items-center">
                                <p>
                                                <label>
                                                    <input type="checkbox" class="filled-in" checked="checked">
                                                    <span>Filled in</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" class="filled-in" checked="checked">
                                                    <span>Filled in</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" class="filled-in" checked="checked">
                                                    <span>Filled in</span>
                                                </label>
                                            </p>
                                </div>
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
                                                <?php 
                                                    if($_SESSION['user_data']['type'] === "Administrator")
                                                    {
                                                ?>
                                                <!-- <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th> -->
                                                <?php
                                                    }
                                                ?>
                                                <th></th>
                                                <th>BARANGAY ID</th>
                                                <th>POSITION</th>
                                                <th>FULL NAME</th>
                                                <th>CONTACT NUMBER</th>
                                                <th>ADDRESS</th>
                                                <th>START OF TERM</th>
                                                <th>END OF TERM</th>
                                                <th>STATUS</th>
                                                <th style="width: 130px !important;">ACTIONS</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    //Include DB connection
                                               include ('./database/db_config.php');
                                                if($_SESSION['user_data']['type'] === "Administrator")
                                                {

                                                    $squery = mysqli_query($conn, "SELECT * FROM tblofficial");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                        <td></td>
                                                            <td><small>'.$row['barangay_id'].'</small></td>
                                                            <td style="color:#03a9f4">'.$row['sPosition'].'</td>
                                                            <td><small>'.$row['completeName'].'</small></td>
                                                            <td><small>'.$row['pcontact'].'</small></td>
                                                            <td><small>'.$row['paddress'].'</small></td>
                                                            <td><small>'.$row['termStart'].'</small></td>
                                                            <td><small>'.$row['termEnd'].'</small></td>';
                                                            if($row['status'] == 'Active'){
                                                            echo '<td><span class="chip green lighten-5"><span class="green-text">'.$row['status'].'</span></small></td>
                                                            <td>';
                                                            }else{
                                                                echo '<td><span class="chip red lighten-5">
                                                                <span class="red-text">
                                                                '.$row['status'].'
                                                                </span></small></td>
                                                                <td>';
                                                            }

                                                        
                                                                if($row['status'] == 'Ongoing Term'){
                                                                echo '            
                                                                <a href="#" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="material-icons">edit</i></a>
                                            ';
                                                                }
                                                                else{
                                                                echo '
                                                                <a href="#" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="material-icons">edit</i></a>';
                                                                }
                                                            echo '</td>
                                                        
                                                        </tr>
                                                        ';

                                                        // include "edit_modal.php";
                                                        // include "endterm_modal.php";
                                                        // include "startterm_modal.php";
                                                    }

                                                }
                                                else{
                                                    $squery = mysqli_query($conn, "SELECT * FROM tblofficial where status = 'Ongoing Term' group by termend");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                        <td></td>
                                                            <td><small>'.$row['barangay_id'].'</small></td>
                                                            <td>'.$row['sPosition'].'</td>
                                                            <td>'.$row['completeName'].'</td>
                                                            <td>'.$row['pcontact'].'</td>
                                                            <td>'.$row['paddress'].'</td>
                                                            <td>'.$row['termStart'].'</td>
                                                            <td>'.$row['termEnd'].'</td>
                                                            <td>'.$row['status'].'</td>
                                                            <td>
                                                            <a href="#"><i class="material-icons" data-target="#editModal'.$row['id'].'" data-toggle="modal">edit</i></a>
                                                           
                                                            </td>
                                                        </tr>
                                                        ';

                                                        // include "edit_modal.php";
                                                    }
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
    </div>
    <!-- Modal -->
    <?php include './modals/add-barangay.php' ?>
    <!-- END: Page Modal-->
    </div>


    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->
    
    
  <!-- BEGIN VENDOR JS-->
  <?php include ('./page-layout/html-vendors.php');  ?>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <!-- END PAGE LEVEL JS-->
  

<script src="./app-assets/js/custom/barangay-officials-table-list.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>

