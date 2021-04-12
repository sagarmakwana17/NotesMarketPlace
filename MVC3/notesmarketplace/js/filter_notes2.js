/*hide the search icon*/
$("#search").click(function () {
    $(".fa-search").hide();
});

/*filter notes with search bar*/






/*code to filter notes according to various properties*/


$(document).ready(function () {

    $("#search").keyup(function () {

            var inpval = $('#search').val();

            $.ajax({
                    type: 'POST',
                    data: 'input=' + inpval,
                    url: "filter_notes.php",
                    beforeSend: function () {
                        $(".note_container").html("<span>Working on it......</span>");
                    },
                    success: function (data) {
                        $(".note_container").html(data);
                    }

                
            });


    });


});






/*filter function for note types*/

$(document).ready(function () {

    $("#type").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'type=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});


/*filter function for note categories*/
$(document).ready(function () {

    $("#category").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'category=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});



$(document).ready(function () {

    $("#university").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'university=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});



$(document).ready(function () {

    $("#course").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'course=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});




$(document).ready(function () {

    $("#country").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'country=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});


$(document).ready(function () {

    $("#rating").on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "filter_notes.php",
            type: "POST",
            data: 'rating=' + value,
            beforeSend: function () {
                $(".note_container").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".note_container").html(data);
            }
        });
    });

});
