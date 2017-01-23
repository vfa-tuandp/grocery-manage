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


    var handleTemplate = function () {
        //define template
        var template = $('#create-order-form .row.section:first').clone();

        //define counter
        var sectionsCount = 0;

        $('#addsection').on('click', '.addsection', function () {

            //increment
            sectionsCount++;

            //loop through each input
            var section = template.clone().find(':input').each(function () {

                //set id to store the updated section number
                var newId = this.id + sectionsCount;

                //update for label
                $(this).prev().attr('for', newId);

                //update id
                this.id = newId;

            }).end().appendTo('#create-order-form');

            section.find('.my-currency').each(function () {
                $(this).priceFormat({
                    prefix: '',
                    thousandsSeparator: '.',
                    suffix: '',
                    centsLimit: 0
                });
            });
            $(this).addClass("disabled");
            return false;
        });

    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatetimePicker();
            handleTemplate();
        }
    };

}();