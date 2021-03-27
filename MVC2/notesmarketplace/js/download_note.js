$(document).ready(function () {

    /*inserting data into downloads table using ajax and jquery for free download*/ 
    $("#download-btn-1").click(function () {

        $.ajax({
            type: "POST",
            url: "includes/download_note.php",
            data: {
                download_type: "free"
            },
            beforeSend: function () {
                $(".temp").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".temp").html(data);
            }


        })

    });
    
    /*inserting data into downloads table using ajax and jquery for paid download*/ 
    $("#download-btn-paid").click(function () {

        $.ajax({
            type: "POST",
            url: "includes/download_note.php",
            data: {
                download_type: "paid"
            },
            beforeSend: function () {
                $(".temp").html("<span>Working on it......</span>");
            },
            success: function (data) {
                $(".temp").html(data);
            }


        })

    });
    

});
