function checkInitialField() {

    var firstInput = $('#datepickerFirst').val();
    var secondInput = $('#datepickerSecond').val();
    var thirdInput = $('#datepickerThird').val();

    var date = new RegExp('^([0-2][0-9]|(3)[0-1])[.](((0)[0-9])|((1)[0-2]))[.]\\d{4}$');

    if ($('#datepickerFirst').val() == "") {
        $("#datepickerFirst").addClass('error');
        $('#status').html("This field is required.");
        return false;
    }

    if (!date.test(firstInput)) {
        $("#datepickerFirst").addClass("error");
        $('#status').html("Incorrect date format");
        return false;
    }

    if (!date.test(secondInput) && secondInput.length != 0){
        $("#datepickerSecond").addClass('error');
        $('#status-second').html("Incorrect date format");
        return false;
    }

    if (!date.test(thirdInput) && thirdInput.length != 0){
        $("#datepickerThird").addClass('error');
        $('#status-third').html("Incorrect date format");
        return false;
    }

        return true;
}
