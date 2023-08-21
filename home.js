//Verhindert u.a. die Nutzung nicht deklarierter Variablen
"use strict";
//leave
window.location.replace("/login/");

//delete
const name = "Angela Ziegler";
const email = "angela.ziegler@mail.com";
const address = ["Bahnhofstrasse ", "23", "8001", "Zürich", "Switzerland"];
const object = "help";

// wird genutzt damit elemente auf website nicht angezeigt werden
//BSP.: wenn die "Seite" gewechselt wird
function hide(hide) {
  const hideElement = document.getElementById(hide);
  // Change the HTML file displayed
  hideElement.classList.add("hidden");
}
//zwigt Elemente auf Website die vorher verborgen waren

function show(show) {
  const showElement = document.getElementById(show);
  showElement.classList.remove("hidden");
}

//window.open(link)

//überprüft ob alle Felder von einer Form auf ihre Ausgefülltheit
// Feld leer dann error
function submit() {
  const form = document.getElementById('loginForm');
  // Wenn alle Felder leer sind, wechselt die Seite
}

window.onload = function () {
  document.getElementById("name").innerHTML = name;
  document.getElementById("email").innerHTML = email;
  document.getElementById("street").innerHTML = address[0];
  document.getElementById("number").innerHTML = address[1];
  document.getElementById("town").innerHTML = address[2];
};

function checkForm() {
  document.submit;
}
