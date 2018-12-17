$(function () {
    $('input#ean').on('change', function () {
        $.ajax({
            type: 'GET',
            url: '/find.php',
            data: {ean: $(this).val()},
            dataType: 'json',
            success: function (data) {
                $('#firstName').val(data.firstName);
                $('#lastName').val(data.lastName);
                $('#email').val(data.email);
                $('#phoneNumber').val(data.phoneNumber);
            },
            error: function (result) {
                console.log("Error");
            }
        });
    });
});