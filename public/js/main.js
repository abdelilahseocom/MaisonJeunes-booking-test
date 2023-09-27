$(document).ready(function () {
window._token = $('meta[name="csrf-token"]').attr('content')

var allEditors = document.querySelectorAll('.ckeditor');
for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
        allEditors[i],
        {
            removePlugins: ['ImageUpload']
        }
    );
}

moment.updateLocale('en', {
    week: {dow: 1} // Monday is the first day of the week
})

$('.date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'en'
})

$('.datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
    locale: 'en',
    sideBySide: true,
    stepping: 15
})

$('.timepicker').datetimepicker({
    format: 'HH:mm:ss'
})

$('.select-all').click(function () {
    $('.form-check-input').each(function(){
        $(this).prop('checked', true);
    })
})
$('.deselect-all').click(function () {
    $('.form-check-input').each(function(){
        $(this).prop('checked', false);
    })
})

$('.select2').select2()

$('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
    if ($(this).hasClass('active')) {
        shouldExpand = true
    }
    })
    if (shouldExpand) {
    $(this).addClass('active')
    }
})
})
