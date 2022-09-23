$(document).ready(function() {
    orderProceessdata();
    setInterval(orderProceessdata, 3000);
    deleveredItem();
    setInterval(deleveredItem, 3000);
});

function orderProceessdata() {
    $.ajax({
        url: "phptools/ordermanage.php",
        type: "POST",
        data: { pending: true },
        success: function(data) {
            var obj = JSON.parse(data);
            let text = "";
            var sum = 0;
            if (!obj) {
                $("#appendItems").html("No orders proccessing");
            } else {
                for (let i = 0; i < obj.length; i++) {

                    if (orderid != obj[i][0] || orderid == null) {
                        text += "<div class='order-container'><p class='orderId'>Order id: " + obj[i][0] + "</p><aside class='right'><p>Date: " + obj[i][3] + "</p><p>Time: " + obj[i][2] + "</p></aside><br><br> <img src='" + obj[i][10] + "' alt='img' class='rimg'><h2 class='resname'>" + obj[i][9] + "</h2><br><table><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";
                    }
                    sum += parseInt(obj[i][6]);
                    text += "<tr><td>" + obj[i][7] + "</td> <td>" + obj[i][8] + "</td><td>" + obj[i][4] + "</td><td>" + obj[i][6] + "</td></tr>";
                    var orderid = obj[i][0];
                    if (obj[i + 1]) {
                        if (orderid != obj[i + 1][0]) {
                            text += " </table><div class='tright'><table><tr><td>Total</td><td>" + sum + "</td></tr><tr><td>Vat(10%)</td><td>" + Math.round(0.1 * sum) + "</td></tr><tr><td>Grand total</td><td>" + (sum + Math.round(0.1 * sum)) + "</td></tr></table></div><br><div class='innerFlex'><div class='pending'><p>" + obj[i][5] + "</p><div class='loader'>      <div class='loader__element'></div></div></div></div></div>";
                            sum = 0;
                        }

                    } else {
                        text += " </table><div class='tright'><table><tr><td>Total</td><td>" + sum + "</td></tr><tr><td>Vat(10%)</td><td>" + Math.round(0.1 * sum) + "</td></tr><tr><td>Grand total</td><td>" + (sum + Math.round(0.1 * sum)) + "</td></tr></table></div><br><div class='innerFlex'><div class='pending'><p>" + obj[i][5] + "</p><div class='loader'>      <div class='loader__element'></div></div></div></div></div>";

                        sum = 0;
                    }

                }
                $("#appendItems").html(text);
            }
        }
    });
}

function deleveredItem() {
    $.ajax({
        url: "phptools/ordermanage.php",
        type: "POST",
        data: { delivered: true },
        success: function(data) {
            var obj = JSON.parse(data);
            let text = "";
            var sum = 0;
            if (!obj) {
                $("#delivered").html("No items");
            } else {
                for (i = 0; i < obj.length; i++) {

                    if (orderid != obj[i][0] || orderid == null) {
                        text += "<div class='order-container'><p class='orderId'>Order id: " + obj[i][0] + "</p><aside class='right'><p>Date: " + obj[i][3] + "</p><p>Time: " + obj[i][2] + "</p></aside><br><br> <img src='" + obj[i][10] + "' alt='img' class='rimg'><h2 class='resname'>" + obj[i][9] + "</h2><br><table><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Subtotal</th> </tr>";
                    }
                    sum += parseInt(obj[i][6]);
                    text += "<tr><td>" + obj[i][7] + "</td> <td>" + obj[i][8] + "</td><td>" + obj[i][4] + "</td><td>" + obj[i][6] + "</td></tr>";
                    var orderid = obj[i][0];
                    if (obj[i + 1]) {
                        if (orderid != obj[i + 1][0]) {
                            text += " </table><div class='tright'><table><tr><td>Total</td><td>" + sum + "</td></tr><tr><td>Vat(10%)</td><td>" + Math.round(0.1 * sum) + "</td></tr><tr><td>Grand total</td><td>" + (sum + Math.round(0.1 * sum)) + "</td></tr></table></div><br><div class='delivered'><p>Delivered</p><i class='fas fa-check'></i></div></div>";
                            sum = 0;
                        }
                    } else {
                        text += " </table><div class='tright'><table><tr><td>Total</td><td>" + sum + "</td></tr><tr><td>Vat(10%)</td><td>" + Math.round(0.1 * sum) + "</td></tr><tr><td>Grand total</td><td>" + (sum + Math.round(0.1 * sum)) + "</td></tr></table></div><br><div class='delivered'><p>Delivered</p><i class='fas fa-check'></i></div></div>";
                        sum = 0;
                    }
                }
            }
            $("#delivered").html(text);
        }
    });
}