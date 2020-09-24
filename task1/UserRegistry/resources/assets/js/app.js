const showModal = function(modalid) {
    let modal = document.getElementById(modalid)
    modal.style.zIndex = 999;
    modal.style.opacity = 1;
    return null;
}

const hideModal = function(modalid) {
    let modal = document.getElementById(modalid)
    modal.style.zIndex = -1;
    modal.style.opacity = 0;
    return null;
}

window.addEventListener('load', function () {
    document.getElementById('adduser').addEventListener('click', () => {
        showModal('newusermodal');
    }, false);

    document.getElementById('closeuser').addEventListener('click', (e) => {
        e.preventDefault();
        hideModal('newusermodal');
    }, false);


    document.getElementById('canceldelete').addEventListener('click', (e) => {
        e.preventDefault();
        hideModal('deletemodal');
    }, false);

    document.getElementById('confirmdelete').addEventListener('click', (e) => {
        e.preventDefault();
        hideModal('deletemodal');
        let id = e.target.getAttribute('data-id');
        e.target.setAttribute('data-id', '');
        if(id) window.location.href = "delete/" + id;
    }, false);



    [...document.getElementsByClassName("deletebutton")].forEach(function(element) {
        element.addEventListener('click', (e) => {
            e.preventDefault();

            document.getElementById('confirmdelete').setAttribute('data-id', e.target.getAttribute('data-id'));
            showModal('deletemodal');

        }, false);
    });

});
