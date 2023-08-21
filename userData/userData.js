document.getElementById("logout").addEventListener("submit", (e) => {
    e.preventDefault();
        // Create a new XMLHttpRequest instance
        const request = new XMLHttpRequest();

        // Configure the request: Method and URL
        request.open("GET", "/Backend/logout.php", true);
    
        // Set up a callback function to handle the response
        request.onload = function() {
            if (request.status === 200) {
                console.log("Logged out successfully");
                // Redirect to a login page or another appropriate location
                window.location.replace("/login/");
            } else {
                document.getElementById('errorMessage').classList.remove("hidden");
            }
        };
    
        // Send the request
        request.send();    
});
function changeData(){
    window.location.replace("/changeData/");
}