let modals = document.getElementsByClassName("modal");
let btns = document.getElementsByClassName("modify");

window.onclick = function(event) {
    let modalsArray = Array.from(modals);
    modalsArray.forEach(modal => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        let span = modal.getElementsByClassName("modal-close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    });
}

function updateNbSpot(id){
    let input = modals[id].getElementsByClassName("nbMessagesAdvancement")[0].value;
    let spotDiv = modals[id].getElementsByClassName("messagesAdvancement")[0];
    //console.log(input);
    inner='';
    for (i=0;i<input; i++){
        inner += "<input class='msg-adv' type='text' name="+i+">"
    }
    spotDiv.innerHTML = inner;
}