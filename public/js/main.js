/**
 * Created by Marko R on 03/04/2018.
 */

$(document).ready(function () {
    // you may need to change this code if you are not using Bootstrap Datepicker
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        todayBtn: "linked",
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        todayHighlight: true
    });

    $('#celebration_location').change(function () {
        var locationId = $(this).val();
        console.log(locationId);
        $.ajax({
            url: '/celebration/get-location-percentage',
            method: 'GET',
            dataType: 'JSON',
            data: {
                locationId: locationId
            },
            success: function (percentageNum) {
                $('#celebration_locationPercentage').val(percentageNum);
            },
            error: function (error) {
                alert('An error occurred while loading data.');
            }
        });
    });
});