$(document).ready(function() {
    $('.input-daterange').datepicker({
        format: 'yyyy-mm-dd',
        inputs: $('.input-daterange input')
    });
});