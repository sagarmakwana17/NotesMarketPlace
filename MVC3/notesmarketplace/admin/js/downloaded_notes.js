/*downloaded notes filter*/

$(document).ready(function () {

    $(".note").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes.php",
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



$(document).ready(function () {

    $(".seller").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes.php",
            type: "POST",
            data: 'seller=' + value,
            beforeSend: function () {
                $(".table-responsive").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".table-responsive").html(data);
            }
        });
    });

});


$(document).ready(function () {

    $(".buyer").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_downloaded_notes.php",
            type: "POST",
            data: 'buyer=' + value,
            beforeSend: function () {
                $(".table-responsive").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".table-responsive").html(data);
            }
        });
    });

});



