document.getElementById("sendChange").addEventListener("submit", (e) => {
  e.preventDefault();
  const regexPattern = /^[a-zA-Z0-9\s-]+$/;
  //funktion verlassen wenn keine gültige Postleitzahl
  if (!regexPattern.test(document.getElementById("plz").value)) {
    document.getElementById("badPlz").classList.remove("hidden");
    return;
  } else {
    // Create a new XMLHttpRequest instance
    const request = new XMLHttpRequest();

    const data = {
      profilePicture: document.getElementById("profilePictureInput").files[0],
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      street: document.getElementById("street").value,
      number: document.getElementById("number").value,
      plz: document.getElementById("plz").value,
      town: document.getElementById("town").value,
    };
    // Configure the request: Method and URL
    request.open("GET", "/Backend/saveInDatabase.php", true);

    // Set up a callback function to handle the response
    request.onload = function () {
      if (request.status === 200) {
        console.log("Daten wurden geändert");
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

function exitEdit() {
  window.location.replace("/changeData/");
}
