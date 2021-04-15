/*rejected notes filter*/

$(document).ready(function () {

    $("#month").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_rejected_notes.php",
            type: "POST",
            data: 'user=' + value,
            beforeSend: function () {
                $(".table-responsive").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".table-responsive").html(data);
            }
        });
    });

});



