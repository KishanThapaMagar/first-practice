document.getElementById("search-icon").addEventListener("click", function(event) {
    event.preventDefault();
    let searchBox = document.getElementById("search-box");

    if (searchBox.style.display === "block") {
        searchBox.style.display = "none";
    } else {
        searchBox.style.display = "block";
    }
});