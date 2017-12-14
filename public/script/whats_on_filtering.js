/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkSearch(form) {
    var Search = form.Search.value;
    var NumCount = 0;
    var Checks = document.getElementsByClassName('Checks');
    var date1 = new Date(document.getElementById("dateinput1").value).setHours(0, 0, 0, 0);
    var date2 = new Date(document.getElementById("dateinput2").value);
    var sort = form.selections.value;
    var str = '';
    for (i = 0; i < 8; i++) {
        if (Checks[i].checked === true) {
            NumCount = NumCount + 1;
            str += Checks[i].name + "  ";
        }
    }

    if (date1 > date2) {
        alert("Invaid date range");
        return false;
    }
    if (date1 <= date2) {
        var d = "right";
    }

    if (NumCount === 0 && Search === "" && d !== "right" && sort === "no") {
        alert("Please enter a search criteria");
        return false;
    } else if (NumCount > 0 && Search === "") {
        alert("You have refined your search to events in \n" + str);
        return true;
    } else if (NumCount === 0 && Search != "") {
        alert("You have searched for " + Search);
        return true;
    } else if (NumCount > 0 && Search != "") {
        alert("You have searched for " + Search + "\n" + " under these categories " + "\n" + str);
        return true;
    }

}

