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


    //Load Datatable
    var residentTable;
    if ($("#resident-list-datatable").length > 0) {
        residentTable = $("#resident-list-datatable").DataTable({
            responsive: true,
            // 'columnDefs': [{
            //     "targets": [1],
            //     "visible": true
            // }],
        });

        var columnsToBeExport = [0, 1, 2, 3, 4, 5, 6, 7];
        var copyButton = new $.fn.dataTable.Buttons(residentTable, {
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


        var exportAsCSV = new $.fn.dataTable.Buttons(residentTable, {
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

        var exportAsPDF = new $.fn.dataTable.Buttons(residentTable, {
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

        var print = new $.fn.dataTable.Buttons(residentTable, {
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

    }



});

//Close Modal
function closeModal() {
    var confirmation = confirm("Are you sure you want to cancel this?");

    if (confirmation) {
        setTimeout(() => {
            location.reload();

        }, 2000);
    }
}