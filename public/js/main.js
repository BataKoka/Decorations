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

    // nacin koji sam upotrebio dole je bolji i brzi od ajax poziva, provereno
    /*$('#celebration_location').change(function () {
        var locationId = $(this).val();

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
    });*/

    // bolji i brzi nacin od ajax poziva
    $('#celebration_location').change(function () {
        var locationPercentageNum = $(this).find(':selected').attr('data-percentage');
        $('#celebration_locationPercentage').val(locationPercentageNum);
    });
});