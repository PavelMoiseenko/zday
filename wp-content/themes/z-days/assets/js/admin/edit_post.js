document.addEventListener("DOMContentLoaded", ready);
function ready() {
    var save = document.getElementById("publish");
    save.addEventListener("click", postUpdateConfirmMessage);
}

// Confirm event update
function postUpdateConfirmMessage(e) {
    var y;
    y = confirm('Если количество зарегестрированных пользователей больше 200, пожалуйста нажмите "Cancel" и обратитесь к администратору.');
    if( !y ){
        e.preventDefault();
        return false;
    }
    var save = document.getElementById("publish");
    save.addEventListener("click", postUpdateConfirmMessage);
    save.removeEventListener("click", postUpdateConfirmMessage);
    return true;
}