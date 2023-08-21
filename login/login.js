document.getElementById("loginForm").addEventListener("submit", (e) => {
  e.preventDefault();

  const request = new XMLHttpRequest();
  const data = {
    email: document.getElementById("email").value,
    password: document.getElementById("password").value,
  };
  request.open("POST", "/Backend/login.php");
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
});
