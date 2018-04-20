/**
 * Created by Marko R on 03/04/2018.
 */

$(document).ready(function () {
    // polje za izbor datuma u Form/CelebrationType.php
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

    // Location percentage polje u Form/CelebrationType.php
    // bolji i brzi nacin od ajax poziva
    $('#celebration_location').change(function () {
        var locationPercentageNum = $(this).find(':selected').attr('data-percentage');
        $('#celebration_locationPercentage').val(locationPercentageNum);
    });

    // Price i Total polja u Form/DecorationItemType.php
    $('#decoration_item_balloon, #decoration_item_quantity').change(function () {
        var balloonPrice = $('#decoration_item_balloon').find(':selected').attr('data-price');
        $('#decoration_item_price').val(balloonPrice);

        var quantity = $('#decoration_item_quantity').val();
        var total = Number(balloonPrice * quantity).toFixed(2);
        $('#decoration_item_total').val(total);
    });

    // Price i Total polja u Form/DecorationItemType.php, dodatak za EDIT page
    var balloonPrice = $('#decoration_item_price').val()
    var quantity = $('#decoration_item_quantity').val()
    var total = Number(balloonPrice * quantity).toFixed(2);
    $('#decoration_item_total').val(total);
});