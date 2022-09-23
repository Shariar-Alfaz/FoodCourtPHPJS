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
document.getElementById("def").click();
$(document).ready(function() {
    loadPending();
    loadCooking();
    loadOntheWay();
    loadDelivered();
});

function loadPending() {
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: { pending: true },
        success: function(data) {
            var obj = JSON.parse(data);
            var sum = 0;
            var text = "<div class='flex-order'>";
            for (let i = 0; i < obj.length; i++) {
                if (order_id != obj[i][0] || order_id == null) {
                    text += "<div class='order-card'><small>Order id: " + obj[i][0] + "</small><br><small>Status: Pending</small><aside class='right'><small class='time'>Time: " + obj[i][2] + "</small><br><small class='date'>Date: " + obj[i][3] + "</small></aside><p>Items:</p><hr><table>";
                }
                sum += parseInt(obj[i][4]);
                text += "<tr><td class='inner'><img src='" + obj[i][10] + "' alt='img' class='flex-img'><div><p>" + obj[i][9] + "</p><small>Instruction: " + obj[i][14] + "</small><br><p>Category: " + obj[i][11] + "</p><p>Quantity: " + obj[i][5] + "</p></div></td><td><p>Subtotal: Tk " + obj[i][4] + "</p></td></tr>";
                var order_id = obj[i][0];
                if (obj[i + 1]) {
                    if (order_id != obj[i + 1][0]) {

                        text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changePending(this);'>Receive</button></div></div>";
                        sum = 0;
                    }
                } else {
                    text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changePending(this);'>Receive</button></div></div>";
                    sum = 0;
                }
            }
            text += "</div>";
            $("#Pending").html(text);
        }
    });
}

function loadCooking() {
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: { cookinglist: true },
        success: function(data) {
            var obj = JSON.parse(data);
            var sum = 0;
            var text = "<div class='flex-order'>";
            for (let i = 0; i < obj.length; i++) {
                if (order_id != obj[i][0] || order_id == null) {
                    text += "<div class='order-card'><small>Order id: " + obj[i][0] + "</small><br><small>Status: Cooking</small><aside class='right'><small class='time'>Time: " + obj[i][2] + "</small><br><small class='date'>Date: " + obj[i][3] + "</small></aside><p>Items:</p><hr><table>";
                }
                sum += parseInt(obj[i][4]);
                text += "<tr><td class='inner'><img src='" + obj[i][10] + "' alt='img' class='flex-img'><div><p>" + obj[i][9] + "</p><small>Instruction: " + obj[i][14] + "</small><br><p>Category: " + obj[i][11] + "</p><p>Quantity: " + obj[i][5] + "</p></div></td><td><p>Subtotal: Tk " + obj[i][4] + "</p></td></tr>";
                var order_id = obj[i][0];
                if (obj[i + 1]) {
                    if (order_id != obj[i + 1][0]) {

                        text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changeCooking(this);'>Process for delivery</button></div></div>";
                        sum = 0;
                    }
                } else {
                    text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changeCooking(this);'>Process for delivery</button></div></div>";
                    sum = 0;
                }
            }
            text += "</div>";
            $("#Cooking").html(text);
        }
    });
}

function loadOntheWay() {
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: { ontheway: true },
        success: function(data) {
            var obj = JSON.parse(data);
            var sum = 0;
            var text = "<div class='flex-order'>";
            for (let i = 0; i < obj.length; i++) {
                if (order_id != obj[i][0] || order_id == null) {
                    text += "<div class='order-card'><small>Order id: " + obj[i][0] + "</small><br><small>Status: On the way</small><aside class='right'><small class='time'>Time: " + obj[i][2] + "</small><br><small class='date'>Date: " + obj[i][3] + "</small></aside><p>Items:</p><hr><table>";
                }
                sum += parseInt(obj[i][4]);
                text += "<tr><td class='inner'><img src='" + obj[i][10] + "' alt='img' class='flex-img'><div><p>" + obj[i][9] + "</p><small>Instruction: " + obj[i][14] + "</small><br><p>Category: " + obj[i][11] + "</p><p>Quantity: " + obj[i][5] + "</p></div></td><td><p>Subtotal: Tk " + obj[i][4] + "</p></td></tr>";
                var order_id = obj[i][0];
                if (obj[i + 1]) {
                    if (order_id != obj[i + 1][0]) {

                        text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changeOnTheWay(this);'>Hand over</button></div></div>";
                        sum = 0;
                    }
                } else {
                    text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><button data-id='" + obj[i][0] + "' onclick='changeOnTheWay(this);'>Hand over</button></div></div>";
                    sum = 0;
                }
            }
            text += "</div>";
            $("#On-the-way").html(text);
        }
    });
}


function changePending(btn) {
    var id = btn.getAttribute('data-id');
    console.log(id);
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: {
            cooking: true,
            order_id: id
        },
        success: function(data) {
            var m = JSON.parse(data);
            $("#m2message").text(m);
            $("#modalnotifi").css("display", "block");
            loadPending();
            loadCooking();
        }
    });
}


function changeCooking(btn) {
    var id = btn.getAttribute('data-id');
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: {
            way: true,
            order_id1: id
        },
        success: function(data) {
            var m = JSON.parse(data);
            $("#m2message").text(m);
            $("#modalnotifi").css("display", "block");
            loadPending();
            loadCooking();
            loadOntheWay();
        }
    });
}

function changeOnTheWay(btn) {
    var id = btn.getAttribute('data-id');
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: {
            delivered: true,
            order_id2: id
        },
        success: function(data) {
            var m = JSON.parse(data);
            $("#m2message").text(m);
            $("#modalnotifi").css("display", "block");
            loadPending();
            loadCooking();
            loadOntheWay();
            loadDelivered();
        }
    });
}

function loadDelivered() {
    $.ajax({
        url: "phptools/processOrder.php",
        type: "POST",
        data: { done: true },
        success: function(data) {
            var obj = JSON.parse(data);
            var sum = 0;
            var text = "<div class='flex-order'>";
            for (let i = 0; i < obj.length; i++) {
                if (order_id != obj[i][0] || order_id == null) {
                    text += "<div class='order-card'><small>Order id: " + obj[i][0] + "</small><br><small>Status: Delivered</small><aside class='right'><small class='time'>Time: " + obj[i][2] + "</small><br><small class='date'>Date: " + obj[i][3] + "</small></aside><p>Items:</p><hr><table>";
                }
                sum += parseInt(obj[i][4]);
                text += "<tr><td class='inner'><img src='" + obj[i][10] + "' alt='img' class='flex-img'><div><p>" + obj[i][9] + "</p><small>Instruction: " + obj[i][14] + "</small><br><p>Category: " + obj[i][11] + "</p><p>Quantity: " + obj[i][5] + "</p></div></td><td><p>Subtotal: Tk " + obj[i][4] + "</p></td></tr>";
                var order_id = obj[i][0];
                if (obj[i + 1]) {
                    if (order_id != obj[i + 1][0]) {

                        text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><p>Delivered</p></div></div>";
                        sum = 0;
                    }
                } else {
                    text += " </table><hr><table class='grandt'><tr><td><p>Total</p></td><td><p>" + sum + "</p></td></tr><tr><td><p>Vat(10%)</p></td><td><p>" + Math.round(0.1 * sum) + "</p></td></tr><tr><td><p>Grand total</p></td><td><p>" + Math.round(sum + sum * 0.1) + "</p></td></tr><aside class='leftab'><p>Customer info</p><small>Name: " + obj[i][12] + " " + obj[i][13] + "</small><br><small>Mobile: " + obj[i][7] + "</small><br><small><i class='fas fa-map-marked-alt'></i> " + obj[i][8] + "</small></aside></table><div class='center'><p>Delivered</p></div></div>";
                    sum = 0;
                }
            }
            text += "</div>";
            $("#Delivered").html(text);
        }
    });
}