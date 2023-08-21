function sendChange (){
    // Create a new XMLHttpRequest instance
    const request = new XMLHttpRequest();
    const data = {
    //     document.getElementById("email").value;
    //   document.getElementById("password").value;
    //   // Similarly, update other input fields using their IDs and userData properties
    //   document.getElementById("street").value;
    //   document.getElementById("number").value;
    //   document.getElementById("plz").value;
    //   document.getElementById("town").value;
    //   document.getElementById("country");
      };
    // Configure the request: Method and URL
    request.open("GET", "Backend/getUserdata.php", true);

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
    request.send();    
}

function exitEdit(){

window.location.replace("/changeData/");

}