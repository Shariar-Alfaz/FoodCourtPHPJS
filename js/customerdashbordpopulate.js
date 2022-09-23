const xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    myobj = JSON.parse(this.responseText);
    let text = "";
    for (let i in myobj) {
        text += "<div><a href='foods.php?data=" + myobj[i][0] + "' class='card'style='background-image: url(" + myobj[i][6] + ");'><div class='border'> <h2 class='border-text'>" + myobj[i][1] + "</h2></div></a></div>";
    }
    document.getElementById("restaurant-container").innerHTML = text;
}
xmlhttp.open("GET", "phptools/cdashbordpopulate.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send();