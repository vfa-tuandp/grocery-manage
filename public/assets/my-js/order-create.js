var CreateOrder = function () {

    var handleDatetimePicker = function () {

        if (!jQuery().datetimepicker) {
            return;
        }



        $(".form_datetime").datetimepicker({
            autoclose: true,
            format: "dd/mm/yyyy - hh:ii",
            pickerPosition: "bottom-left",
            todayBtn: true,
            useCurrent: false
        });
        var now = new Date();
        $(".form_datetime input[type=text]").val(
            now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear() + ' - ' + now.getHours() + ':' + now.getMinutes()
        );
    }


    return {
        //main function to initiate the module
        init: function () {
            handleDatetimePicker();
        }
    };

}();