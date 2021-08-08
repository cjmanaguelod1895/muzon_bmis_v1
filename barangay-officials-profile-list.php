<?php
session_start();
require_once('./database/db_config.php');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<title>BMIS | Barangay Officials</title>
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
            <div id="breadcrumbs-wrapper" data-image="./app-assets/images/gallery/breadcrumb-bg.jpg" class="breadcrumbs-bg-image" style="background-image: url(&quot;./app-assets/images/gallery/breadcrumb-bg.jpg&quot;);">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Barangay Officials Profile</span></h5>
                        </div>
                        <!-- <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pages</a>
                                </li>
                                <li class="breadcrumb-item active">Blank Page
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
                    <div class="section mt-2" id="blog-list">
                        <div class="row">
                        <!-- <a class="waves-effect waves-light btn mb-1 mr-1" style="margin-left: 12px;">
                            <i class="material-icons right">settings_backup_restore</i>View as List</a> -->


                            <button onclick="window.location.href='barangay-officials-table-list.php'" class="btn mb-1 waves-effect waves-light " type="submit" name="action" style="margin-left: 12px;">View as Table List<i class="material-icons right">remove_red_eye</i>
                                                    </button>
                        </div>
                        <br>
                        
                    <div class='row'>
                      
                            <?php

                            //Include DB connection
                            include ('./database/db_config.php');


                             $squery = mysqli_query($conn, "SELECT * FROM tblofficial");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        $position =$row['sPosition']; 
                                                        $completeName =$row['completeName']; 
                                                        $contact =$row['pcontact']; 
                                                        $address =$row['paddress']; 
                                                        $termStart =$row['termStart']; 
                                                        $termEnd=$row['termEnd'];


                            echo "
                            <div class='col s12 m6 l4'>
                            <div class='card-panel border-radius-6 mt-10 card-animation-1'>
                                <a href='#'><img class='responsive-img border-radius-8 z-depth-4 image-n-margin' src='./app-assets/images/cards/news-fashion.jpg' alt=''></a>
                            <h6 class='deep-purple-text text-darken-3 mt-5'><a href='#'>$completeName</a></h6>
                            <div class='row'>
                                                            <div class='col s12 place mt-4 p-0'>
                                                                <div class='col s2 m2 l2'><i class='material-icons'> person_outline </i></div>
                                                                <div class='col s10 m10 l10'>
                                                                    <p class='m-0'>$position</p>
                                                                </div>
                                                            </div>
                                                            <div class='col s12 place mt-4 p-0'>
                                                            <div class='col s2 m2 l2'><i class='material-icons'>  call  </i></div>
                                                            <div class='col s10 m10 l10'>
                                                                <p class='m-0'>$contact</p>
                                                            </div>
                                                        </div>
                                                        <div class='col s12 place mt-4 p-0'>
                                                        <div class='col s2 m2 l2'><i class='material-icons'> place </i></div>
                                                        <div class='col s10 m10 l10'>
                                                            <p class='m-0'>$address</p>
                                                        </div>
                                                    </div>
                                                    <div class='col s12 place mt-4 p-0'>
                                                    <div class='col s2 m2 l2'><i class='material-icons'> calendar </i></div>
                                                    <div class='col s10 m10 l10'>
                                                        <p class='m-0'>$termStart</p>
                                                    </div>
                                                </div>
                                                <div class='col s12 place mt-4 p-0'>
                                                <div class='col s2 m2 l2'><i class='material-icons'> calendar </i></div>
                                                <div class='col s10 m10 l10'>
                                                    <p class='m-0'>$termEnd</p>
                                                </div>
                                            </div>


                                                        </div>
                        </div>
                </div>";


                               
                                                            }

                                                            ?>


                    
                            
                        </div>
                    </div>
                </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->


    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <?php include ('./page-layout/html-vendors.php');  ?>
    <!-- END PAGE LEVEL JS-->


</body>

</html>