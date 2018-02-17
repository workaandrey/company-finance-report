$(document).ready(function() {
    console.log(123);
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
});
