document.getElementById("sendChange").addEventListener("submit", (e) => {
    e.preventDefault();
    // Create a new XMLHttpRequest instance
    const request = new XMLHttpRequest();

    const data = {
    street: document.getElementById("street").value,
    number: document.getElementById("number").value,
    plz: document.getElementById("plz").value,
    town: document.getElementById("town").value,
    };
    // Configure the request: Method and URL
    request.open("GET", "/Backend/saveInDatabase.php", true);

    // Set up a callback function to handle the response
    request.onload = function() {
        if (request.status === 200) {
            console.log("Data changed");
            window.location.replace("/userData/");
        } else {
            document.getElementById('errorMessage').classList.remove("hidden");
        }
    };

    // Send the request
    request.send(JSON.stringify(data));    
});

function exitEdit(){

window.location.replace("/changeData/");

}