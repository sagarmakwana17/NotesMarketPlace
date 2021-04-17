

/*code to filter notes according to various properties*/






/*filter function for note types*/

$(document).ready(function () {

    $("#month").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes",
            type: "POST",
            data: 'note=' + value,
            beforeSend: function () {
                $(".table-responsive").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".table-responsive").html(data);
            }
        });
    });

});








