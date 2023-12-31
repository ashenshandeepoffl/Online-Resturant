window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};

function liveSearch() {
    var searchInput = document.getElementById("searchInput").value;
    var priceFilter = document.getElementById("priceFilter").value;
    var categoryFilter = document.getElementById("categoryFilter").value;

    // Send AJAX request to server for live search
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("filteredMenuContainer").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "liveSearch.php?searchInput=" + searchInput + "&priceFilter=" + priceFilter + "&categoryFilter=" + categoryFilter, true);
    xmlhttp.send();
}

