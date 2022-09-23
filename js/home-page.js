$(document).ready(function() {
    $("#read-more-btn").click(function() {

        $("#more").slideToggle("slow", function() {
            if ($("#read-more-btn").text() == "Click here to read more") {
                $("#read-more-btn").text("Click here to read less");
            } else {
                $("#read-more-btn").text("Click here to read more");
            }
        });
    });
});