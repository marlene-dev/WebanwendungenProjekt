document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("changeData").addEventListener("submit", (e) => {
    e.preventDefault();
    const regexPattern = /^[0-9]{5}/;
    //funktion verlassen wenn keine gültige Postleitzahl
    if (!regexPattern.test(document.getElementById("plz").value)) {
      document.getElementById("badPlz").classList.remove("hidden");
      return;
    } else {
      // Create a new XMLHttpRequest instance
      const request = new XMLHttpRequest();

    const data = {
      profilepicture: document.getElementById("profilepic").value,
      username: document.getElementById("name").value,
      email: document.getElementById("email").value,
      streetname: document.getElementById("street").value,
      streetnumber: document.getElementById("number").value,
      plz: document.getElementById("plz").value,
      cityname: document.getElementById("town").value,
    };
    // Configure the request: Method and URL
    request.open("POST", "/Backend/saveInDatabase.php", true);

      // Set up a callback function to handle the response
      request.onload = function () {
        if (request.status === 200) {
          console.log("Daten wurden geändert");
          alert("geänderte Daten wurden gespeichert.")
          window.location.replace("/userData/");
        } else {
          document.getElementById("badPlz").classList.add("hidden");
          document.getElementById("errorMessage").classList.remove("hidden");
        }
      };
      // Send the request
      request.send(JSON.stringify(data));
    }
  });
});

// Funktion zum Abrufen und Anzeigen der Nutzerdaten
window.onload = function (){
  const request = new XMLHttpRequest();
  request.open("GET", "/Backend/getUserData.php", true);
  request.onload = function () {
    if (request.status === 200) {
      const responseData = JSON.parse(request.responseText);
      document.getElementById("profilepic").value = responseData.profilepic;
      document.getElementById("name").value = responseData.username;
      document.getElementById("email").value = responseData.email;
      document.getElementById("street").value = responseData.streetname;
      document.getElementById("number").value = responseData.streetnumber;
      document.getElementById("plz").value = responseData.plz;
      document.getElementById("town").value = responseData.town;
    } else {
      alert("An error occurred while fetching user data.");
      window.location.replace("/login/");
    }
  };
  request.send();
}

function exitEdit() {
  window.location.replace("/userData/");
}
