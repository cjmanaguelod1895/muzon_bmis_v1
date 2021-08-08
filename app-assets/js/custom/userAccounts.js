(function($) {
    $.fn.serializeFormJSON = function() {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
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




$(document).ready(function() {

    $('#official').hide();
    $('#mySelect').on('change', function(e) {
        var optionSelected = $("option:selected", this);
        var selected = this.value;
        if (selected == 10) {
            $('#official').show();
        } else {

            $('#official').hide();
        }

    });


    $('.dt-button').find('span').addClass('hide-on-small-only');


    $("#phoneNumberLabel").addClass("active");

    $('#pcontact').formatter({
        'pattern': '{{9999}}{{999}}{{9999}}',
        'persistent': false
    });


    //Validate Form
    $("#addNewUserForm").validate({
        onfocusout: false,
        ignore: "",
        rules: {
            official_ID: {
                required: true
            },
            position: {
                required: true
            },
            commitee: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            conpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        //For custom messages
        messages: {
            official_ID: {
                required: "Please select Barangay Official"
            },
            position: {
                required: "Please select position"
            },
            commitee: {
                required: "Please select position"
            },
            username: {
                required: "Enter Username"
            },
            password: {
                required: "Enter Password"
            },
            conpassword: {
                required: "Confirm Password",
                equalTo: "Password did not match"

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

        submitHandler: function(form) {

            var formData = $(form).serializeFormJSON();

            //Disable Submit Button
            $("#addNewUserButton").attr("disabled", "true");
            Toast.fire({
                icon: 'info',
                title: 'Saving Record... Please wait!',
            })


            setTimeout(() => {
                var url = "/bmis_v1/php-action-scripts/create.php";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { createNewUser: JSON.stringify(formData) },
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
                        } else if (response.actionType === 'usernameIsTaken') {
                            setTimeout(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.msg
                                })
                                $("#addNewUserButton").removeAttr("disabled");

                            }, 2000);


                        } else if (response.actionType === 'passwordNotMatch') {

                            setTimeout(() => {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.msg
                                })

                                $("#addNewUserButton").removeAttr("disabled");

                            }, 2000);



                        }
                    }
                });
            }, 1000);
        }
    });


    //Add User Account Modal
    $('#addNewUser').modal({
        dismissible: false, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        // startingTop: '100%%', // Starting top style attribute
        // endingTop: '10%', // Ending top style attribute
        ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            alert("Ready");
            console.log(modal, trigger);
        },
        complete: function() { alert('Closed'); } // Callback for Modal close
    });


    $("#canelButton").click(function() {
        var confirmation = confirm("Are you sure you want to cancel this?");
        if (confirmation) {
            setTimeout(() => {
                location.reload();

            }, 2000);
        }
    });






    //Load Datatable
    var usersTable;
    if ($("#users-list-datatable").length > 0) {
        usersTable = $("#users-list-datatable").DataTable({
            responsive: false,
            // 'columnDefs': [{
            //     "targets": [1],
            //     "visible": true
            // }],
        });

        var columnsToBeExport = [0, 1, 2, 3, 4, 5, 6, 7];
        var copyButton = new $.fn.dataTable.Buttons(usersTable, {
            buttons: [{
                    //COPY
                    extend: 'copyHtml5',
                    titleAttr: 'Copy Data',
                    text: '<i class="material-icons">content_copy</i> Copy',
                    className: 'btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4',
                    exportOptions: {
                        columns: columnsToBeExport


                    }

                }

            ]
        }).container().appendTo($('#buttonCopy'));


        var exportAsCSV = new $.fn.dataTable.Buttons(usersTable, {
            buttons: [{
                    //CSV
                    extend: 'csvHtml5',
                    titleAttr: 'Export as CSV',
                    text: '<i class="material-icons">cloud_download</i> CSV',
                    className: 'btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4',
                    exportOptions: {
                        columns: columnsToBeExport
                    }
                }

            ]
        }).container().appendTo($('#buttonExportToCSV'));

        var exportAsPDF = new $.fn.dataTable.Buttons(usersTable, {
            buttons: [{
                    //PDF
                    extend: 'pdfHtml5',
                    titleAttr: 'Export as PDF',
                    text: '<i class="material-icons">picture_as_pdf</i> PDF',
                    className: 'btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4',
                    title: 'Export as PDF File',
                    exportOptions: {
                        columns: columnsToBeExport
                    }
                }

            ]
        }).container().appendTo($('#buttonExportToPDF'));

        var print = new $.fn.dataTable.Buttons(usersTable, {
            buttons: [

                {
                    //PRINT
                    extend: 'print',
                    titleAttr: 'Print',
                    text: '<i class="material-icons">print</i> Print',
                    className: 'btn-small btn-light-indigo btn waves-effect waves-light invoice-export border-round z-depth-4',
                    exportOptions: {
                        columns: [6]
                    }
                }

            ]
        }).container().appendTo($('#buttonPrint'));

        // var excelFileButton = new $.fn.dataTable.Buttons(usersTable, {
        //     buttons: [

        //         {
        //             //Excel
        //             extend: 'excelHtml5',
        //             titleAttr: 'Print',
        //             text: '<i class="material-icons">view_list</i>',
        //             className: 'btn waves-effect waves-light invoice-export border-round z-depth-4',
        //             exportOptions: {
        //                 columns: columnsToBeExport
        //             }
        //         }

        //     ]
        // }).container().appendTo($('#buttonExcel'));



    }



});