import fr_lang from "./language_fr.json" assert { type: "json" };
const datatable_lang_fr = fr_lang;
// Default parametres of datatables
$(function() {
    let copyButtonTrans = 'Copier'
    let csvButtonTrans = 'CSV'
    let excelButtonTrans = 'Excel'
    let pdfButtonTrans = 'PDF'
    let printButtonTrans = 'Print'

    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
    $.extend(true, $.fn.dataTable.defaults, {
    language: datatable_lang_fr,
    columnDefs: [ {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    // select: {
    //     style:    'multi+shift',
    //     selector: 'td:first-child'
    // },
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
let roles_datatable = $('.datatable-Role');
let users_datatable = $('.datatable-User');
let booking_datatable = $('.datatable-booking');
let clients_datatable = $('.datatable-clients');


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
    });
}
if(roles_datatable.length>0) {
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        permissions_datatable.DataTable({ buttons: dtButtons})
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
if(users_datatable.length>0) {
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        users_datatable.DataTable({ buttons: dtButtons})
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}
if(booking_datatable.length>0) {
    $(function () {
        let datatableConfig = {
            buttons: $.extend(true, [], $.fn.dataTable.defaults.buttons),
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "/admin/bookings",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'client_name', name: 'client.name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'comment', name: 'comment' },
                { data: 'actions', name: 'actions' }
            ],
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        };

        booking_datatable.DataTable(datatableConfig);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}
if(clients_datatable.length>0) {
    $(function () {
        let datatableConfig = {
            buttons: $.extend(true, [], $.fn.dataTable.defaults.buttons),
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "/admin/clients",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions' }
            ],
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        };
        clients_datatable.DataTable(datatableConfig);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
}

