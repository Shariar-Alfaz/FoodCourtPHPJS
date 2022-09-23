$(document).ready(function() {
    loadCategory();
    loadFood();
});

function loadCategory() {
    $.ajax({
        url: "phptools/businessDashBordData.php",
        type: "POST",
        data: { category: true },
        success: function(data) {
            var category = JSON.parse(data);
            var text = "";
            for (let i in category) {
                text += "<div><a href='#" + category[i][0] + "' class='c-i'>" + category[i][0] + "</a></div>";
            }
            $("#categorylist").html(text);
        }
    });
}

function loadFood() {
    $.ajax({
        url: "phptools/businessDashBordData.php",
        type: "POST",
        data: { food: true },
        success: function(data) {
            var obj = JSON.parse(data);
            var text = "";
            for (let i in obj) {
                if (obj[i][6] != category || category == null) {
                    text += "<div id='" + obj[i][6] + "' class='cat-c'><p class='show-c'>" + obj[i][6] + "</p><hr><br></div>"
                }
                text += "<div class='foodcard'><div><h4 class='item-name'>" + obj[i][2] + "</h4><p class='item-description'>" + obj[i][5] + "</p><p class='item-price'>Tk " + obj[i][3] + "</p><div class='btnPos'><button class='btnEdit' onclick='modalOpen(" + obj[i][0] + ")'>Edit</button><button class='btnDelete' onclick='deleteItem(" + obj[i][0] + ")'>Delete</button></div></div><div> <img src='" + obj[i][4] + "' class='foodcard-img'></div></div>";
                var category = obj[i][6];
            }
            $("#foodflex").html(text);
        }
    });
}
var foodId = "";

function modalOpen(obj) {
    foodId = obj;
    $.ajax({
        url: "phptools/businessDashBordData.php",
        type: "POST",
        data: { fid: obj },
        success: function(data) {
            var obj = JSON.parse(data);
            foodId = obj[0][0];
            $("#foodName").val(obj[0][2]);
            $("#details").html(obj[0][5]);
            $("#cat").val(obj[0][6]);
            $("#price").val(obj[0][3]);
            $("#modal-content-img").attr("src", obj[0][4]);
            $("#modal-edit").css("display", "block");
        }
    });
}
$("#modal-close-btn").click(function() {
    $("#modal-edit").css("display", "none");
});
$("#update-close").click(function() {
    $("#modal-edit").css("display", "none");
});
$("#update").click(function() {
    console.log(foodId);
    $.ajax({
        url: "phptools/businessDashBordData.php",
        type: "POST",
        data: {
            update: true,
            foodid: foodId,
            fname: $("#foodName").val(),
            detail: $("#details").html(),
            cat: $("#cat").val(),
            price: $("#price").val()
        },
        success: function(data) {
            var m = JSON.parse(data);
            if (m == "Success") {
                $("#m2message").text("Data updated");
                $("#modal-edit").css("display", "none");
                $("#modalnotifi").css("display", "block");
                loadCategory();
                loadFood();
            } else {
                $("#m2message").text("Could not update");
                $("#modal-edit").css("display", "none");
                $("#modalnotifi").css("display", "block");
            }
        }
    })
});
$("#m2close").click(function() {
    $("#modalnotifi").css("display", "none");
});

function deleteItem(id) {
    var fid = id;
    console.log(id);
    $.ajax({
        url: "phptools/businessDashBordData.php",
        type: "POST",
        data: {
            clear: true,
            fid: fid
        },
        success: function(data) {
            if (data) {
                $("#m2message").text("Data deleted");
                $("#modalnotifi").css("display", "block");
                loadFood();
                loadCategory();
            } else {
                $("#m2message").text("Something wrong!!");
                $("#modalnotifi").css("display", "block");
                loadFood();
            }
        }
    });
}
$("#addFood").click(function() {
    $("#addModal").show();
});
$("#addclose").click(function() {
    $("#addModal").hide();
});

function openTab(evt, tabname) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabname).style.display = "block";
    evt.currentTarget.className += " active";
}