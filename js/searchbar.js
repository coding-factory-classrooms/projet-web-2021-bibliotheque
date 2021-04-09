function search() {
    let a, txtValue;
    let input = document.getElementById('searchBar');
    let filter = input.value.toUpperCase();

    let listObjects = document.getElementById("object");
    let objects = listObjects.getElementsByClassName('id');
    for (let i = 0; i < objects.length; i++) {
        
        switch (filter.substr(0,2)){
            case ".T":
                a = objects[i].getElementsByClassName("tagsObject")[0];
                txtValue = a.textContent || a.innerText; //To get the complete title of the object
    
                if (txtValue.substr(6).toUpperCase().indexOf(filter.substr(3)) <= -1) { //The test if the research and the title match
                    objects[i].classList.add("hidden");
                } else {
                    objects[i].classList.remove("hidden");
                }
                break;

            case ".":
                break;

            default:
                a = objects[i].getElementsByClassName("nameObject")[0];
                txtValue = a.textContent || a.innerText; //To get the complete title of the object
    
                if (txtValue.toUpperCase().indexOf(filter) <= -1) { //The test if the research and the title match
                    objects[i].classList.add("hidden");
                } else {
                    objects[i].classList.remove("hidden");
                }
        }
    }
    // Loop through all list items, and hide those who don't match the search query

        

}