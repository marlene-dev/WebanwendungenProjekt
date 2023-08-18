//Verhindert u.a. die Nutzung nicht deklarierter Variablen
"use strict";

//successful login --delete later
// Add a click event listener to the button
const loginButton = document.getElementById('loginButton');


// Add a click event listener to the button
function hide(hide) {
  const hideElement = document.getElementById(hide);
  // Change the HTML file displayed
  hideElement.classList.add('hidden');
}

function show(show){
  const showElement = document.getElementById(show);
  showElement.classList.remove('hidden'); 
}

// document.addEventListener("DOMContentLoaded", function () {
//   const loginForm = document.getElementById("login-form");
//   loginForm.addEventListener("submit", function (event) {
//     event.preventDefault();

//     const email = document.getElementById("email").value;
//     const password = document.getElementById("password").value;

//     const daten = `${email}:${password}`;
//     const encryted = btoa(daten);
//     // Erstelle eine XMLHttpRequest-Instanz
//     const request = new XMLHttpRequest();

//     // URL für die Überprüfung
//     const url = "https://example.com/api/login";

//     // Öffne eine GET-Anfrage mit den codierten Anmeldeinformationen im Authorization-Header
//     request.open("POST", url);
//     request.setRequestHeader("Authorization", `Basic ${encryted}`);

//     request.send();

//     // Setze eine Callback-Funktion für die Antwort
//     request.onload = function () {
//       if (request.status === 200) {
//         console.log("Erfolgreich eingeloggt:", request.responseText);
//       } else {
//         console.error("Fehler beim Einloggen:", request.statusText);
//       }
//     };
//   });
// });

window.onload = function(){
    const name = "Angela Ziegler";
    const email = "angela.ziegler@mail.com";
    const address = ["Bahnhofstrasse 23", "8001", "Zürich", "Switzerland"];
    const object = "help";
    
    document.getElementById('name').innerHTML = name;
    document.getElementById('email').innerHTML = email;
    document.getElementById('street').innerHTML = address[0];
    document.getElementById('town').innerHTML = address[2];
  }
