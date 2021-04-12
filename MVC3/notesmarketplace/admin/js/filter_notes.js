

/*code to filter notes according to various properties*/






/*filter function for note types*/

$(document).ready(function () {

    $("#note").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes.php",
            type: "POST",
            data: 'note=' + value,
            beforeSend: function () {
                $(".d_notes").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".d_notes").html(data);
            }
        });
    });

});


$(document).ready(function () {

    $("#seller").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes.php",
            type: "POST",
            data: 'seller=' + value,
            beforeSend: function () {
                $(".d_notes").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".d_notes").html(data);
            }
        });
    });

});
