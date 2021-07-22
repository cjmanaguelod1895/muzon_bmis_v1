<?php

session_start();


if (!$_SESSION['user_data']) {
    header('Location: /bmis_v1/login.php');
    exit();
    
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>BMIS | Barangay Officials Table List</title>
    <link rel="apple-touch-icon" href="./app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="./app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="./app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/vendors/flag-icon/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/vendors/data-tables/css/select.dataTables.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="./app-assets/css/themes/vertical-dark-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/css/themes/vertical-dark-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="./app-assets/css/pages/data-tables.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="./app-assets/css/custom/custom.css">
    


    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Barangay Officials Table List</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
 

                        <!-- Page Length Options -->
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
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
                                                <th>Barangay Id</th>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th>Status</th>
                                                <th style="width: 130px !important;">Actions</th>
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
                                                            <td>'.$row['barangay_id'].'</td>
                                                            <td>'.$row['sPosition'].'</td>
                                                            <td>'.$row['completeName'].'</td>
                                                            <td>'.$row['pcontact'].'</td>
                                                            <td>'.$row['paddress'].'</td>
                                                            <td>'.$row['termStart'].'</td>
                                                            <td>'.$row['termEnd'].'</td>
                                                            <td>'.$row['status'].'</td>
                                                            <td>
                                                            <a class="btn-floating mb-1 waves-effect waves-light" data-target="#editModal'.$row['id'].'" data-toggle="modal">
                                                            <i class="material-icons">edit</i>
                                                        </a>';
                                                                if($row['status'] == 'Ongoing Term'){
                                                                echo '
                                                                <a class="btn-floating mb-1 btn-flat waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow" data-target="#endModal'.$row['id'].'" data-toggle="modal">
                                                            <i class="material-icons">indeterminate_check_box</i>';
                                                                }
                                                                else{
                                                                echo '
                                                                <a class="btn-floating mb-1 btn-flat waves-effect waves-light gradient-45deg-green-teal gradient-shadow" data-target="#startModal'.$row['id'].'" data-toggle="modal">
                                                            <i class="material-icons">cloud_done</i>';
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
                                                            <td>'.$row['barangay_id'].'</td>
                                                            <td>'.$row['sPosition'].'</td>
                                                            <td>'.$row['completeName'].'</td>
                                                            <td>'.$row['pcontact'].'</td>
                                                            <td>'.$row['paddress'].'</td>
                                                            <td>'.$row['termStart'].'</td>
                                                            <td>'.$row['termEnd'].'</td>
                                                            <td>'.$row['status'].'</td>
                                                            <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                        </tr>
                                                        ';

                                                        // include "edit_modal.php";
                                                    }
                                                }
                                            ?>
                                                   </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="./app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="./app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="./app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="./app-assets/vendors/data-tables/js/dataTables.select.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="./app-assets/js/plugins.js"></script>
    <script src="./app-assets/js/search.js"></script>
    <script src="./app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="./app-assets/js/scripts/data-tables.js"></script> -->

    <script src="//cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>

<script>
       $('#page-length-option').DataTable({
        dom: 'Bfrtip',
        "scrollY": 700,
        "scrollX": true,
		"searching": true,
		"paging": true,
		"order": [[ 0, "asc" ]],
		"ordering": true,
		"columnDefs": [{
			"targets": [1], /* column index */
			"orderable": false,
            "className": 'noVis'
		},
		{
			"targets": [ 1 ],
			"visible": true,
			"searchable": true
		}],
        buttons:{
            dom:{
                button: {
                    className: 'waves-effect waves-light btn-small mb-1'
                }
            },

        buttons: [
            // {
            //     extend: 'colvis',
            //     columns: ':not(.noVis)'
            // },
                {
                    //COPY
                    extend: 'copy',
                    text: '<i class="material-icons left">content_copy</i>Copy',
                    className: 'waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1',
                    title: 'Copy Datatables',
                    // exportOptions: {
                    // columns: ':visible'
                    // }
                    exportOptions: {
            columns: ':not(:last-child)',
        }
                },
                {
                    //EXCEL
                    extend: 'excel',
                    text: '<i class="material-icons left">cloud_download</i>Export to Excel',
                    className: 'waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1',
                    title: 'Export to Excel',
                    exportOptions: {
            columns: ':not(:last-child)',
        }
                },
                {
                    //CSV
                    extend: 'csv',
                    text: '<i class="material-icons left">cloud_download</i>Export as CSV',
                    className: 'waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1',
                    title: 'Export as CSV File',
                    exportOptions: {
            columns: ':not(:last-child)',
        }
                },
                {
                    //PDF
                    extend: 'pdf',
                    text: '<i class="material-icons left">picture_as_pdf</i>Export as PDF',
                    className: 'waves-effect waves-light  btn gradient-45deg-red-pink box-shadow-none border-round mr-1 mb-1',
                    title: 'Export as PDF File',
                    exportOptions: {
            columns: ':not(:last-child)',
        }
                },
                {
                    //PRINT
                    extend: 'print',
                    text: '<i class="material-icons left">print</i>Print',
                    className: 'waves-effect waves-light  btn gradient-45deg-amber-amber box-shadow-none border-round mr-1 mb-1',
                    title: 'Print File',
                    exportOptions: {
            columns: ':not(:last-child)',
        }
                }
            ]
        }
    });
</script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>