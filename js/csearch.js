function resultDisplay() {
    const itemText = document.getElementById("search-input");
    document.getElementById("result").innerHTML = "";
    if (itemText.value != "") {
        document.getElementById("restaurent-search").style.display = "block";
        const xmlhttp = new XMLHttpRequest();
        const toPass = JSON.stringify({ text: itemText.value });
        let text = "";
        xmlhttp.onload = function() {
            myobj = JSON.parse(this.responseText);
            if (myobj.length == 0) {
                document.getElementById("nodata").style.display = "block";
            } else {
                document.getElementById("nodata").style.display = "none";
                for (let i in myobj) {
                    text += "<div><a href='foods.php?data=" + myobj[i][0] + "' class='card'style='background-image: url(" + myobj[i][6] + ");'><div class='border'> <h2 class='border-text'>" + myobj[i][1] + "</h2></div></a></div>";
                }
                document.getElementById("result").innerHTML = text;
            }
        }
        xmlhttp.open("POST", "phptools/csearch.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + toPass);
    }
}
var input = document.getElementById("search-input");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("search-btn").click();
    }
});
$("#closesb").click(function() {
    $("#restaurent-search").css("display", "none");
});