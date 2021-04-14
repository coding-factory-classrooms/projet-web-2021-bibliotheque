window.onload = function(){ 
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btn-modify");
    var span = document.getElementsByClassName("modal-close")[0];
    btn.onclick = function() {
    modal.style.display = "block";
    }
    console.log(span)
    span.onclick = function() {
    modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        }
    }
};
