var currentUrl = window.location.href;
let params = (new URL(currentUrl)).searchParams;
const vendorid = params.get('data');
$(document).ready(function() {
    $.ajax({
        url: 'phptools/foodspopulate.php',
        type: 'POST',
        data: {
            vendorid: vendorid,
            info: 'findinfo'
        },
        success: function(data) {
            var obj = JSON.parse(data);
            if (obj.length != 0) {
                document.getElementById("image").style.display = "block";
                document.getElementById("image").src = obj[0][5];
                $("#name").text(obj[0][1]);
                $("#info").append("<p><strong>Email:</strong> " + obj[0][4] + "</p><p><strong>Contuct number:</strong> " + obj[0][3] + "</p><p><strong>Address:</strong> " + obj[0][2] + "</p>");
            } else {
                document.getElementById("image").style.display = "none";
                $("#name").text("*This restaurent has not added any food yet*");
            }
        }
    });
    var text = "<div class='flex-category'>";
    $.ajax({
        url: 'phptools/foodspopulate.php',
        type: 'POST',
        data: {
            find: 'category',
            vendorid: vendorid
        },
        success: function(data) {
            var obj = JSON.parse(data);
            for (let i in obj) {
                text += "<a href='#" + obj[i] + "'>" + obj[i] + "</a>";
            }
            text += "</div>"
            $("#category-list").append(text);
        }
    });
    $.ajax({
        url: 'phptools/foodspopulate.php',
        type: "POST",
        data: {
            vendorid: vendorid,
            show: 'foods'
        },
        success: function(data) {
            var obj = JSON.parse(data);
            if (obj == null) {
                $(".flex").append("no foods added");
            } else {
                var text = "";
                for (let i in obj) {
                    if (category != obj[i][11] || category == null) {
                        text += "<div class='hole' id='" + obj[i][11] + "'><h3 >" + obj[i][11] + "</h3><hr></div>";
                    }
                    text += " <div class='foodcard' onclick='foodCardClick(" + obj[i][6] + ")'><div><h4 class='item-name'>" + obj[i][7] + "</h4><p class='item-description'>" + obj[i][9] + "</p><p class='item-price'>Tk " + obj[i][8] + "</p></div><div> <img src='" + obj[i][10] + "' class='foodcard-img'></div></div>";
                    var category = obj[i][11];
                }
                $(".flex").append(text);
            }
        }
    });
});

$("#category-btn").click(function() {
    $("#category-list").slideToggle("slow");
})

function foodCardClick(id) {
    localStorage.setItem("food_id", id);
    getFoodItemsAndRestaurent();
    $("#modal").fadeIn("slow", function() {
        $("#modal").css("display", "block");
    });
}
$("#modal-close-btn").click(function() {
    $("#modal").fadeOut("slow", function() {
        $("#modal").css("display", "none");
    });
});
$("#modal-close-btn-2").click(function() {
    $("#modal").fadeOut("slow", function() {
        $("#modal").css("display", "none");
    });
});

function getFoodItemsAndRestaurent() {
    $.ajax({
        url: "phptools/foodspopulate.php",
        type: "POST",
        data: { foodid: localStorage.getItem("food_id"), vendorid: vendorid },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#modal-content-img").attr("src", obj[0][10]);
            $("#food-name").text(obj[0][7]);
            $("#restaurentname").text(obj[0][1]);
            $("#description").text(obj[0][9]);
            $("#price").text("Price: Tk " + obj[0][8]);
        }
    });
}

function findfood() {
    $("#restaurent-search").css("display", "block");
    var text = "";
    if ($("#search-input").val() == 0)
        $("#restaurent-search").css("display", "none");
    $("#result").empty();
    if ($("#search-input").val().length > 0) {
        $.ajax({
            url: "phptools/foodspopulate.php",
            type: "POST",
            data: { foodsearch: "true", vendorid: vendorid, text: $("#search-input").val() },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.length == 0) {
                    $("#nodata").css("display", "block");
                } else {
                    $("#nodata").css("display", "none");
                    for (let i in obj) {
                        text += " <div class='foodcard' onclick='foodCardClick(" + obj[i][6] + ")'><div><h4 class='item-name'>" + obj[i][7] + "</h4><p class='item-description'>" + obj[i][9] + "</p><p class='item-price'>Tk " + obj[i][8] + "</p></div><div> <img src='" + obj[i][10] + "' class='foodcard-img'></div></div>";
                    }
                    $("#result").append(text);
                }
            }
        });
    }
}
$("#quantity").on("focusout", function() {
    if ($("#quantity").val() == 0) {
        $("#quantity").val(1);
    }
});