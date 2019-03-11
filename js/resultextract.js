$(document).ready(function () {


    $("#datepickerFirst").attr("autocomplete", "off");
    $("#datepickerSecond").attr("autocomplete", "off");
    $("#datepickerThird").attr("autocomplete", "off");

    $('#datepickerFirst').datepicker({dateFormat: 'dd.mm.yy'}).val();

    $('#datepickerFirst').focus(function () {
        $('#status').empty();
        $("#datepickerFirst").removeClass('error');
    });

    $('#datepickerSecond').focus(function () {
        $('#status-second').empty();
        $("#datepickerSecond").removeClass('error');
    });

    $('#datepickerThird').focus(function () {
        $('#status-third').empty();
        $("#datepickerThird").removeClass('error');
    });

    $('#datepickerSecond').datepicker({dateFormat: 'dd.mm.yy'}).val();
    $('#datepickerThird').datepicker({dateFormat: 'dd.mm.yy'}).val();

    $('#submit').click(function () {

        var resultValidation = checkInitialField();

        if (resultValidation == false) {
            return;
        } else {
            calculateData();
            $('#modal').modal('toggle')
        }
    });

    $('#close').click(function () {
        $('#resultTable').empty();
        $('#tableResult').css("display", "none");
    });
});

function drawResultTable(jsonData) {
    var json = jsonData;
    obj = JSON.parse(json);

    var table = "<td>" + obj.initialCharging + "</td>";
    table += "<td>" + obj.secondCharging + "</td>";
    table += "<td>" + obj.thirdCharging + "</td>";
    table += "<td>" + obj.bestBefore + "</td>";
    table += "<td>" + obj.upTo + "</td>";

    document.getElementById('resultTable').innerHTML = table;
}


function calculateData() {
    $.ajax({
        url: "app.php",
        type: "post",
        data: {
            datepickerFirst: $('#datepickerFirst').val(),
            datepickerSecond: $('#datepickerSecond').val(),
            datepickerThird: $('#datepickerThird').val(),
        },
        success: function (response) {
            drawResultTable(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}