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

    // Price i Total polja u Form/DecorationItemType.php, dodatak za EDIT page, da se prvi put vide
    var balloonPrice = $('#decoration_item_price').val();
    var quantity = $('#decoration_item_quantity').val();
    var total = Number(balloonPrice * quantity).toFixed(2);
    $('#decoration_item_total').val(total);

    // DataTables plug-in for the jQuery Javascript library
    $('#data_tables').DataTable({
        "order": [[ 1, 'asc' ]],
        "columnDefs": [
            { "orderable": false, "targets": -1 },
            { "searchable": false, "targets": -1 }
        ],
        "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "pagingType": "full_numbers"
    });

    // DataTables for Home page
    $('#dashboard').DataTable({
        "order": [[ 1, 'asc' ]]
    });

    // Decoration expense i Profit Polja u Form/CelebrationType.php, SAMO za EDIT
    $('#celebration_location, #celebration_revenue, #celebration_workerExpense, #celebration_transportExpense').change(function () {
        var locationPercentage = $('#celebration_locationPercentage').val();
        var revenue = $('#celebration_revenue').val();
        var workerExpense = $('#celebration_workerExpense').val();
        var transportExpense = $('#celebration_transportExpense').val();
        var decorationsExpense = $('#celebration_decorationsExpense').val();

        var moneyForLocation = (locationPercentage / 100) * revenue;
        var adjustedRevenue = revenue - moneyForLocation;
        var allExpenses = Number(workerExpense) + Number(transportExpense) + Number(decorationsExpense);
        var profit = Number(adjustedRevenue - allExpenses).toFixed(2);

        $('#celebration_profit').val(profit);
    });
});