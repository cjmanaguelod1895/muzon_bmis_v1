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

$(function() {

    var usersTable;
    if ($("#users-list-datatable").length > 0) {
        usersTable = $("#users-list-datatable").DataTable({
            responsive: true,
            'columnDefs': [{
                "targets": [1],
                "visible": false
            }],
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




    };



    // if ($(".invoice-data-table").length) {
    //     var usersTable = $(".invoice-data-table").DataTable({
    //         columnDefs: [{
    //                 targets: 0,
    //                 className: "control"
    //             },
    //             {
    //                 orderable: true,
    //                 targets: 1,
    //                 checkboxes: { selectRow: true }
    //             },
    //             {
    //                 targets: [0, 1],
    //                 orderable: false
    //             },
    //             { "orderable": false, "targets": 8 },
    //         ],
    //         order: [2, 'asc'],
    //         dom: '<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',
    //         language: {
    //             search: "",
    //             searchPlaceholder: "Search Barangay Official"
    //         },
    //         responsive: {
    //             details: {
    //                 type: "column",
    //                 target: 0
    //             }
    //         },
    //     });
    //     // To append actions dropdown inside action-btn div
    //     var invoiceFilterAction = $(".invoice-filter-action");
    //     var invoiceCreateBtn = $(".invoice-create-btn");
    //     $(".action-btns").append(invoiceFilterAction, invoiceCreateBtn);


    //     var columnsToBeExport = [0, 1, 2, 3, 4, 5, 6, 7];
    //     var copyButton = new $.fn.dataTable.Buttons(usersTable, {
    //         buttons: [{
    //                 //COPY
    //                 extend: 'copyHtml5',
    //                 titleAttr: 'Copy',
    //                 text: '<i class="material-icons">content_copy</i>',
    //                 className: 'btn waves-effect waves-light invoice-export border-round z-depth-4',
    //                 exportOptions: {
    //                     columns: columnsToBeExport


    //                 }

    //             }

    //         ]
    //     }).container().appendTo($('#buttonCopy'));


    $('.dt-button').find('span').addClass('hide-on-small-only');



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
            pcontact: {
                required: true,
                minlength: 10,
                maxlength: 20
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
            sposition: {
                required: "Please select position"
            },
            pcontact: {
                required: "Enter your Contact Number"
            },
            paddress: {
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

            console.log(formData);

            setTimeout(() => {
                var url = "/bmis_v1/php-action-scripts/create.php";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { createBarangayOfficial: JSON.stringify(formData) },
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

    $("create").click(function() {});

});