document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("logout").addEventListener("click", (e) => {
        e.preventDefault();
        // Create a new XMLHttpRequest instance
        const request = new XMLHttpRequest();

        // Configure the request: Method and URL
        request.open("GET", "/Backend/logout.php", true);

        // Set up a callback function to handle the response
        request.onload = function () {
        if (request.status === 200) {
            console.log("Logged out successfully");
            // Redirect to a login page or another appropriate location
            window.location.replace("/login/");
        } else {
            document.getElementById("errorMessage").classList.remove("hidden");
        }
        };

        // Send the request
        request.send();
    });

    // Funktion zum Abrufen und Anzeigen der Nutzerdaten
    function fetchAndPopulateUserData() {
        const request = new XMLHttpRequest();
        request.open("GET", "/Backend/getUserData.php", true);
        request.onload = function () {
        if (request.status === 200) {
            const responseData = JSON.parse(request.responseText);
            document.getElementById("name").value = responseData.username;
            document.getElementById("email").value = responseData.email;
            document.getElementById("street").value = responseData.streetname;
            document.getElementById("number").value = responseData.streetnumber;
            document.getElementById("plz").value = responseData.plz;
            document.getElementById("town").value = responseData.town;        
        } else {
            console.error("An error occurred while fetching user data.");
            window.location.replace("/login/");
        }
        };
        request.send();
    }
    //aufrufen der Funktion um Userdata zu laden
    fetchAndPopulateUserData();
    
    function changeData() {
        window.location.replace("/changeData/");
    }
});
