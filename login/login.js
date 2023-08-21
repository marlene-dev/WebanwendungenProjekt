function hide(hide) {
  const hideElement = document.getElementById(hide);
  // Change the HTML file displayed
  hideElement.classList.add("hidden");
}
//zwingt Elemente auf Website die vorher verborgen waren

function show(show) {
  const showElement = document.getElementById(show);
  showElement.classList.remove("hidden");
}

function sendLogin() {
  // Erstelle eine XMLHttpRequest-Instanz
  const request = new XMLHttpRequest();
  const data = {
    email: document.getElementById("email").value,
    password: document.getElementById("password").value,
  };
  request.open("POST", "Backend/login.php");
  //maybe change to line 34 ? 
  request.send(JSON.stringify(data));

  // Setze eine Callback-Funktion für die Antwort
  request.onload = function () {
    if (request.status === 200) {
      console.log("Erfolgreich eingeloggt:", request.responseText);
      window.location.replace("/userData/");
    } else {
      document.getElementById('errorLogin').classList.remove("hidden");
    }
  };
  request.send(JSON.stringify(data));
}
