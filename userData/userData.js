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
});
// Funktion zum Abrufen und Anzeigen der Nutzerdaten
window.onload = function (){
  const request = new XMLHttpRequest();
  request.open("GET", "/Backend/getUserData.php", true);
  request.onload = function () {
    if (request.status === 200) {
      const responseData = JSON.parse(request.responseText);
      document.getElementById("profileImage").src = responseData.profilePictureUrl;
      document.getElementById("name").innerHTML = responseData.username;
      document.getElementById("email").innerHTML = responseData.email;
      document.getElementById("street").innerHTML = responseData.streetname;
      document.getElementById("number").innerHTML = responseData.streetnumber;
      document.getElementById("plz").innerHTML = responseData.plz;
      document.getElementById("town").innerHTML = responseData.town;
    } else {
      alert("An error occurred while fetching user data.");
      window.location.replace("/login/");
    }
  };
  request.send();
}

function changeData() {
  window.location.replace("/changeData/");
}
