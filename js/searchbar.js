function search() {
    // Declare variables
    let a, txtValue;
    let input = document.getElementById('searchBar');
    let filter = input.value.toUpperCase();

    let listObjects = document.getElementById("object");
    let objects = listObjects.getElementsByClassName('id');

    // Loop through all list items, and hide those who don't match the search query
    for (let i = 0; i < objects.length; i++) {
        
        a = objects[i].getElementsByTagName("p")[0];
        txtValue = a.textContent || a.innerText; //To get the complete title of the course

        if (txtValue.toUpperCase().indexOf(filter) <= -1) { //The test if the research and the title match
            objects[i].classList.add("hidden");
        } else {
            objects[i].classList.remove("hidden");
        }
    }
}