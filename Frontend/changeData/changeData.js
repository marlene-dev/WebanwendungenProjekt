//Verhindert u.a. die Nutzung nicht deklarierter Variablen
"use strict";
window.onload = function(){
    const name = "Angela Ziegler";
    const email = "angela.ziegler@mail.com";
    const address = ["Bahnhofstrasse 23", "8001", "Zürich", "Switzerland"];
    const object = "help";
    
    document.getElementById('name').innerHTML = name;
    document.getElementById('email').innerHTML = email;
    document.getElementById('street').innerHTML = address[0];
    document.getElementById('town').innerHTML = adress[1];
    }
validate (){
    
}