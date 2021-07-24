<?php

session_start();


if (!$_SESSION['user_data']) {
    header('Location: /bmis_v1/login.php');
    exit();
    
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<title>BMIS | Table List</title>
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>

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
                                            <a class="waves-effect waves-light modal-trigger btn gradient-45deg-amber-amber box-shadow-none border-round mr-1 mb-1" href="#add-barangay"><i class="material-icons left">add</i>Add New</a>
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
    <!-- END PAGE LEVEL JS-->
  

<script>

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


    $(function() {
        $("#phoneNumberLabel").addClass("active");

$('#pcontact').formatter({
'pattern': '{{9999}}{{999}}{{9999}}',
'persistent': false
});

  $("#addNewBarangayOfficial").validate({
    onfocusout: false,
    ignore: "",
  rules: {
    firstName: {
      required: true
    },
    lastName: {
      required: true
    },
    sPosition: {
      required: true
    },
    pcontact:{
        required: true,
        minlength : 10,
        maxlength : 20
    },
    paddress: {
      required: true
    },
    termStart: {
      required: true,
    },
    termEnd: {
      required: true
    }
  },
  //For custom messages
  messages: {
      
    firstName: {
      required: "Enter First Name"
    },
    lastName: {
      required: "Enter Last Name"
    },
    sposition:{
        required: "Please select position"
    },
    pcontact:{
        required: "Enter your Contact Number"
    },
    paddress:{
      required: "Enter Address"
    },
    termStart: {
      required: "Enter Start Term"
    },
    termEnd: {
      required: "Enter End Term"
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

  submitHandler: function(form) {

  var formData = $(form).serializeFormJSON();

  console.log(formData);
  
      setTimeout(() => {
        var url = "/bmis_v1/php-action-scripts/create.php";
      $.ajax({
        type: 'POST',
        url: url,
        data: {createBarangayOfficial: JSON.stringify(formData)},
        dataType: 'json',
        error: function(xhr, textStatus, errorThrown) {
          console.log(xhr.responseText);
        },
        success: function(response) {
            Swal.fire({
  title: 'Data Uploaded successfully.',
  allowOutsideClick: false
})
        }
      });
      }, 1000);


    }


});


     

    $('#add-barangay').modal({
        dismissible: false, // Modal can be dismissed by clicking outside of the modal
  opacity: .5, // Opacity of modal background
  inDuration: 300, // Transition in duration
  outDuration: 200, // Transition out duration
  startingTop: '50%', // Starting top style attribute
  endingTop: '10%', // Ending top style attribute
  ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
  alert("Ready");
  console.log(modal, trigger);
  },
  complete: function() { alert('Closed'); } // Callback for Modal close
    });
    
  });

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
			"orderable": false
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