$(document).ready(function() {
    if (localStorage.getItem("cart")) {
        cart = JSON.parse(localStorage.getItem("cart"));
        try {
            if (cart[0].foodId) {
                $(".cart-count").css("background", "red");
            }
        } catch {
            $(".cart-count").css("background", "transparent");
        }
    }
});
let cart = [];

$("#add-to-cart").click(function() {

    var des = $("#details").val();
    if (!des) {
        des = "N/A";
    }

    if (cart.length != 0) {
        var trid = vendorid;
        if (trid != cart[0].restaurentId) {
            $("#m2message").html("Error: You have another restaurent's foods in cart. To add this food you have to clear the previous cart.");
            $("#modalnotifi").css("display", "block");
            return;
        }
    }
    var product = {
        foodId: localStorage.getItem("food_id"),
        restaurentId: vendorid,
        foodImage: $("#modal-content-img").attr("src"),
        foodName: $("#food-name").html(),
        foodPrice: $("#price").html().slice(10),
        foodQuantity: $("#quantity").val(),
        orderDes: des,
        subtotal: parseInt($("#price").html().slice(10)) * parseInt($("#quantity").val())
    };
    var notFound = true;
    if (cart.length > 0) {
        for (let i in cart) {
            if (product.foodId == cart[i].foodId) {
                cart[i].foodQuantity = parseInt(product.foodQuantity) + parseInt(cart[i].foodQuantity);
                notFound = false;
                break;
            }
        }
    }
    if (notFound) {
        cart.push(product);
        try {
            if (cart[0].foodId) {
                $(".cart-count").css("background", "red");
            }
        } catch {
            $(".cart-count").css("background", "transparent");
        }
    }
    $("#error-message").css("display", "none");
    let tcart = JSON.stringify(cart);
    localStorage.setItem("cart", tcart);
    $("#modal").css("display", "none");
    $("#modalnotifi").css("display", "block");
    $("#m2message").text("Item added to your cart.");
});
$("#m2close").click(function() {
    $("#modalnotifi").css("display", "none");
});