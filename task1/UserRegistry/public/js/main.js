// Get the modal
var modal = document.getElementById("create_user");

// Get the button that opens the modal
var btn = document.getElementById("open_form");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

document.body.onclick = function (e) {
    e = window.event ? event.srcElement : e.target;
    if (e.className && e.className.indexOf('open_delete_form') != -1) {
        console.log(e.id);
        var deleteFormHiddenInput = document.getElementById('delete_form');
        console.log(deleteFormHiddenInput);
        deleteFormHiddenInput.value = e.id;
        modal2.style.display = "block";
    }
}
// Get the modal
var modal2 = document.getElementById("delete_user");

// Get the button that opens the modal
var btn2 = document.getElementsByClassName("open_delete_form");
// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[1];

// When the user clicks on the button, open the modal
btn2.onclick = function () {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function () {
    modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal2) {
//         modal2.style.display = "none";
//     }
// }