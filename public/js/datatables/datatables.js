import fr_lang from "./language_fr.json" assert { type: "json" };
const datatable_lang_fr = fr_lang;
$(function() {
    let copyButtonTrans = 'Copier'
    let csvButtonTrans = 'CSV'
    let excelButtonTrans = 'Excel'
    let pdfButtonTrans = 'PDF'
    let printButtonTrans = 'Print'

    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
    $.extend(true, $.fn.dataTable.defaults, {
    language: datatable_lang_fr,
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
        style:    'multi+shift',
        selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
        {
            extend: 'copy',
            className: 'btn-default',
            text: copyButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'csv',
            className: 'btn-default',
            text: csvButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'excel',
            className: 'btn-default',
            text: excelButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdf',
            className: 'btn-default',
            text: pdfButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'print',
            className: 'btn-default',
            text: printButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        }
    ]
    });

    $.fn.dataTable.ext.classes.sPageButton = '';
});



// Datatables
let permissions_datatable = $('.datatable-Permission');
let cities_datatable = $('.cities-Permission');
let  datatable_services = $('.datatable-services');

if(permissions_datatable.length>0) {
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        permissions_datatable.DataTable({ buttons: dtButtons})
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}
if(cities_datatable.length>0) {
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        cities_datatable.DataTable({ buttons: dtButtons})
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}
if(datatable_services.length>0) {
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        datatable_services.DataTable({ buttons: dtButtons})
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}