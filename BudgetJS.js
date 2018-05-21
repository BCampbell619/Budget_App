var focusFields = {
fieldFocus: function (id) {
        "use strict";
        var myField = document.getElementById(id);
        myField.style.backgroundColor = "#7276BC";
        myField.style.color = "#FFF";
    },
fieldBlind: function (id) {
    
        "use strict";
        var myField = document.getElementById(id);
        myField.style.backgroundColor = "#FFF";
        myField.style.color = "#333";
    
    }
};

function dropdown() {
    "use strict";

    document.getElementById('frmDropdown').classList.toggle("show");

}

window.onclick = function(event) {
    "use strict";
    
    if (!event.target.matches('.drop-btn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};