<?php
require_once('./database/db_config.php');
require_once('./php-action-scripts/session.php');
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
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
            <div id="breadcrumbs-wrapper" data-image="./app-assets/images/gallery/breadcrumb-bg.jpg" class="breadcrumbs-bg-image" style="background-image: url(&quot;./app-assets/images/gallery/breadcrumb-bg.jpg&quot;);">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>System Setup</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
                <div class="container">

                <div class="section users-edit">
                    
                        <div class="card">
                            <div class="card-content">
                                <!-- <div class="card-body"> -->
                                <ul class="tabs mb-2 row">
                                    <li class="tab">
                                        <a class="display-flex align-items-center active" id="barangayInfo-tab" href="#barangayInfo">
                                            <i class="material-icons mr-1">error_outline</i><span>Barangay Information</span>
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a class="display-flex align-items-center" id="barangayLogo-tab" href="#barangayLogo">
                                            <i class="material-icons mr-2">error_outline</i><span>Logo</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="divider mb-3"></div>
                                <div class="row">
                                    <div class="col s12" id="barangayInfo">
                                    <?php
      $sql = mysqli_query($conn,"SELECT * FROM `brgy_address_info`");
      $brgy_info = mysqli_fetch_array($sql);     
      ?>
                                        <form id="barangaySetupForm">
                                            <div class="row">
                                                <div class="col s12 m4">
                                                    <div class="row">
                                                    <div class="col s12 input-field">
                                                            <input id="brgy_name" name="brgy_name" type="text" class="systemSetupInput" value="<?php echo $brgy_info[0]?>" data-error=".errorTxt1">
                                                            <label for="brgy_name">Barangay Name</label>
                                                            <small class="errorTxt1"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m4">
                                                    <div class="row">
                                                    <div class="col s12 input-field">
                                                            <input id="brgy_city" name="brgy_city" type="text" class="systemSetupInput" value="<?php echo $brgy_info[1]?>" data-error=".errorTxt2">
                                                            <label for="brgy_city">City</label>
                                                            <small class="errorTxt2"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m4">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                            <input id="brgy_province" name="brgy_province" type="text" class="systemSetupInput" value="<?php echo $brgy_info[2]?>" data-error=".errorTxt3">
                                                            <label for="brgy_province" >Barangay Province</label>
                                                            <small class="errorTxt3"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" name="submit" id="editSystemSetupButton" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan">
<i class="material-icons right">edit</i>
Update</button>
<button type="submit" name="submit" id="updateBarangayInformationButton" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan">
<i class="material-icons right">save</i>
Save Changes</button>
</form>
<button type="submit" id="cancelSystemSetup" class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink">
<i class="material-icons right">cancel</i>
Cancel</button>

                                                </div>
                                            </div>

                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="col s12" id="barangayLogo">
                                        <form id="infotabForm">
                                            <div class="row">
                                            <div id="file-upload" class="section">
                            <!--use events-->
                            <div class="divider mb-1 mt-1"></div>
                            <div class="row section">
                                <div class="col s12 m4 l3">
                                    <p>Barangay Logo</p>
                                </div>
                                <div class="col s12 m8 l9">
                                <input type="file" name="test" id="barangayLogoDropify" class="dropify" data-max-file-size="50M" data-show-remove="false" data-default-file="" onchange="barangayLogoChange(this)" />

                                <br>

                                <button type="submit" name="submit" id="updateBarangayLogo" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan">
<i class="material-icons right">save</i>
Save Changes</button>

                                </div>
                            </div>

                            <div class="divider mb-1 mt-1"></div>
                            <div class="row section">
                                <div class="col s12 m4 l3">
                                    <p>Municipal Logo</p>
                                </div>
                                <div class="col s12 m8 l9">
                                <input type="file" name="test1" id="municipalLogo" class="dropify" data-max-file-size="50M" data-show-remove="false" data-default-file="" onchange="municipalityLogoChange(this)" />

                                <br>

<button type="submit" name="submit" id="updateMunicipalityLogo" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan">
<i class="material-icons right">save</i>
Save Changes</button>

                                </div>
                            </div>
                        </div>
                                            </div>
                                        </form>
                                        <!-- users edit Info form ends -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                      
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>


    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->


    <!-- BEGIN VENDOR HTML-->
    <?php include ('./page-layout/html-vendors.php'); ?>
    <!-- END: VENDOR HTML-->
    <script src="./app-assets/js/custom/swalToast.js"></script>


</body>

</html>
<script>

var newBarangayLogo = "";
var newMunicpalityLogo = "";
    

function barangayLogoChange(element) {
 
 var img = element.files[0];

 var reader = new FileReader();

 reader.onloadend = function() {

    newBarangayLogo = reader.result;
 }
 reader.readAsDataURL(img);

 $("#updateBarangayLogo").css({"display": "block"});

 console.log(newBarangayLogo);
}


function municipalityLogoChange(element) {
 
 var img = element.files[0];

 var reader = new FileReader();

 reader.onloadend = function() {
    newMunicpalityLogo = reader.result;
 }
 reader.readAsDataURL(img);

 $("#updateMunicipalityLogo").css({"display": "block"});



}

   
   
    $(document).ready(function () {

        $('#barangayLogoDropify').dropify();
        $('#municipalLogoDropify').dropify();


        


        //Get System Setup Images
        var url = "/bmis_v1/php-action-scripts/update.php";
        $.ajax({
                    type: 'POST',
                    url: url,
                    data: { getSystemSetupImages: JSON.stringify({})},
                    dataType: 'json',
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr);
                    },
                    success: function(response) {

  

resetPreview('test' , response.barangay_logo ,
    'Image.jpg');

    resetPreview('test1' , response.municipal_logo ,
    'Image.jpg');

    

                    }
                    
                });


        //Disable Inputs
        $(".systemSetupInput").attr({"disabled": "disabled"});

        //Hide Save Button
        $("#updateBarangayInformationButton").css({"display": "none"});
        $("#cancelSystemSetup").css({"display": "none"});

        //Hide Update Barangay and Municipal Logo
        $("#updateBarangayLogo").css({"display": "none"});
        $("#updateMunicipalityLogo").css({"display": "none"});


        //Edit Button Click
        $( "#editSystemSetupButton" ).click(function(event) {

            event.preventDefault();

            $(".systemSetupInput").removeAttr("disabled");
            $("#updateBarangayInformationButton").css({"display": "block"});
            $("#cancelSystemSetup").css({"display": "block"});
            $("#editSystemSetupButton").css({"display": "none"});  
        
        });



        //Click Barangay Update Button
        $( "#updateBarangayLogo" ).click(function(event) {

        event.preventDefault();

        //Disable Submit Button
        $("#updateBarangayLogo").attr("disabled", "true");


        $.ajax({
                    type: 'POST',
                    url: url,
                    data: { updateBarangayLogo: JSON.stringify({"logo_img": newBarangayLogo }) },
                    dataType: 'json', 
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr);
                    },
                    success: function(response) {
                        console.log(response);


            Toast.fire({
                icon: 'info',
                title: 'Updating Record... Please wait!',
            })
            

            setTimeout(() => {

                if (response.actionType === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: response.msg,
                            })
                            setTimeout(() => {
                                location.reload();

                            }, 4000);
                        } else if (response.actionType === 'error') {
                            setTimeout(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.msg
                                })
                                $("#updateBarangayLogo").removeAttr("disabled");

                            }, 2000);


                        }
                
            }, 3000);

           

                    }
                    
                });


        });



        //Click Municipality Update Button
        $( "#updateMunicipalityLogo" ).click(function(event) {

event.preventDefault();

//Disable Submit Button
$("#updateMunicipalityLogo").attr("disabled", "true");


$.ajax({
            type: 'POST',
            url: url,
            data: { updateMunicipalityLogo: JSON.stringify({"logo_img": newMunicpalityLogo }) },
            dataType: 'json', 
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr);
            },
            success: function(response) {
                console.log(response);


    Toast.fire({
        icon: 'info',
        title: 'Updating Logo... Please wait!',
    })

    setTimeout(() => {

if (response.actionType === 'success') {
            Toast.fire({
                icon: 'success',
                title: response.msg,
            })
            setTimeout(() => {
                location.reload();

            }, 4000);
        } else if (response.actionType === 'error') {
            setTimeout(() => {
                Toast.fire({
                    icon: 'error',
                    title: response.msg
                })
                $("#updateMunicipalityLogo").removeAttr("disabled");

            }, 2000);


        }

}, 3000);



    }

            
            
        });


});



         //Cancel Button Click
         $( "#cancelSystemSetup" ).click(function(event) {

        event.preventDefault();

        var confirmation = confirm("Are you sure you want to cancel this?");

        if (confirmation) {
            setTimeout(() => {
                location.reload();

            }, 2000);
        }

        });





    //Validate Form
    $("#barangaySetupForm").validate({
        onfocusout: false,
        ignore: "",
        rules: {
            brgy_name: {
                required: true
            },
            brgy_city: {
                required: true
            },
            brgy_province: {
                required: true
            }
        },
        //For custom messages
        messages: {
            brgy_name: {
                required: "Enter Barangay Name"
            },
            brgy_city: {
                required: "Enter Barangay City"
            },
            brgy_province: {
                required: "Enter Barangay Province"
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

        submitHandler: function() {

            var formData = {

                brgy_name: $("#brgy_name").val(),
                brgy_city : $("#brgy_city").val(),
                brgy_province : $("#brgy_province").val()

            };
            console.log(formData);

            


            //Disable Submit Button
            $("#updateBarangayInformationButton").attr("disabled", "true");
            Toast.fire({
                icon: 'info',
                title: 'Updating Record... Please wait!',
            })


            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { updateSystemSetupDetails: JSON.stringify(formData) },
                    dataType: 'json',
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    },
                    success: function(response) {
                        if (response.actionType === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: response.msg,
                            })
                            setTimeout(() => {
                                location.reload();

                            }, 4000);
                        } else if (response.actionType === 'error') {
                            setTimeout(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.msg
                                })
                                $("#updateBarangayInformationButton").removeAttr("disabled");

                            }, 2000);


                        }
                    }
                });
            }, 3000);
        }
    });

    });




    function resetPreview(name, src, fname = '') {
    let input = $('input[name="' + name + '"]');
    let wrapper = input.closest('.dropify-wrapper');
    let preview = wrapper.find('.dropify-preview');
    let filename = wrapper.find('.dropify-filename-inner');
    let render = wrapper.find('.dropify-render').html('');

    input.val('').attr('title', fname);
    wrapper.removeClass('has-error').addClass('has-preview');
    filename.html(fname);

    render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
    preview.fadeIn();

}
</script>