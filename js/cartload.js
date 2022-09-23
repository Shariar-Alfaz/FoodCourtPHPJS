let cart = [];
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
        append();
    }
})


function append() {
    $("#add").empty();
    cart = JSON.parse(localStorage.getItem("cart"));
    var Text = "<table id='cart-table'><tr><th>Item</th><th>Description</th> <th>Quantity</th><th>Subtotal (Tk)</th></tr>";
    var subtotal = 0;
    for (let i in cart) {
        Text += "<tr><td><div class='tableFlex'><div><img src='" + cart[i].foodImage + "' class='cart-food-image'></div><div><p class='c-food-name'>" + cart[i].foodName + "</p><small>Price: " + cart[i].foodPrice + " Tk</small><br><a class='c-remove' onclick='itemRemove(" + cart[i].foodId + ");'>Remove</a></div></div></td><td><small>" + cart[i].orderDes + "</small></td><td><input type='number' min='1' step='1' value='" + cart[i].foodQuantity + "' class='quantity-cart' oninput='fixOnInput(" + cart[i].foodId + ",this);' onfocusout='fixZerro(" + cart[i].foodId + ", this);'></td><td id='total'>" + parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice) + "</td></tr>";
        subtotal += parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice);
    }
    Text += "</table>";
    var vat = (10 / 100) * subtotal;
    $("#add").append(Text);
    $("#subtotal").html(subtotal);
    $("#vat").html(Math.round(vat));
    $("#grand-total").html(subtotal + Math.round(vat));
}

function fixOnInput(id, e) {
    const lastchild = e.parentNode.parentNode.lastChild;
    for (let i in cart) {
        if (cart[i].foodId == id) {
            cart[i].foodQuantity = $(e).val();
            cart[i].subtotal = parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice);
            lastchild.textContent = parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice);
            break;
        }
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    populateCal();

}

function fixZerro(id, e) {
    const lastChild = e.parentNode.parentNode.lastChild;


    for (let i in cart) {
        if (cart[i].foodId == id && e.value == 0) {
            cart[i].foodQuantity = 1;
            e.value = 1;
            cart[i].subtotal = parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice);
            lastChild.textContent = cart[i].foodPrice;
            break;
        }
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    populateCal();
}

function populateCal() {
    var sum = 0;
    for (let i in cart) {
        sum += parseInt(cart[i].foodQuantity) * parseInt(cart[i].foodPrice);
    }
    var vat = Math.round((10 / 100) * sum);
    var grand = sum + vat;
    $("#subtotal").html(sum);
    $("#vat").html(vat);
    $("#grand-total").html(grand);
}

function itemRemove(id) {
    for (let i in cart) {
        if (cart[i].foodId == id) {
            cart.splice(i, 1);
        }
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    append();
}
$("#Clear").click(function() {
    cart = [];
    localStorage.removeItem("cart");
    append();
    $(".cart-count").css("background", "transparent");
});
$("#confirm").click(function() {
    const number = $("#contuct-number");
    const Address = $("#address");
    const er = $("#m2message");
    if (!number.val().match(/^\d{11}$/) || number.val().substring(0, 2) != "01") {
        number.css("border-color", "red");
        $("#modalnotifi").css("display", "block");
        er.text("Error: Number is not valid");
        return;
    } else {
        number.css("border-color", "#eee");
    }
    if (!Address.val()) {
        Address.css("border-color", "red");
        $("#modalnotifi").css("display", "block");
        er.text("Error: Address can not be empty");
        return;
    } else {
        Address.css("border-color", "#eee");
    }
    $.ajax({
        url: "phptools/ordermanage.php",
        type: "POST",
        data: {
            vendorid: localStorage.getItem("vendorid"),
            phone: number.val(),
            address: Address.val(),
            items: localStorage.getItem("cart")
        },
        success: function(data) {
            var message = JSON.parse(data);
            $("#modalnotifi").css("display", "block");
            $("#m2message").text(message);
            if (message == "Order placed.") {
                cart = [];
                localStorage.removeItem("cart");
                append();
            }
        }
    });
});
$("#m2close").click(function() {
    $("#modalnotifi").css("display", "none");
});
$(document).ready(function() {
    $.ajax({
        url: "phptools/foodspopulate.php",
        type: "POST",
        data: { owninfo: "true" },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#contuct-number").val(obj[0][0]);
            $("#address").val(obj[0][1]);
        }
    });
});