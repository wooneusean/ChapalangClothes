function displayimage(event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
}

function validateEmail() {
    var x = document.register.email.value;
    var atposition = x.indexOf("@");
    var dotposition = x.lastIndexOf(".");
    var email = document.getElementById("emailerror");
    if (
        atposition < 1 ||
        dotposition < atposition + 2 ||
        dotposition + 2 >= x.length
    ) {
        email.classList.remove("hidden");
        email.innerHTML = "Email is not in a valid format";
        return false;
    } else {
        email.classList.add("hidden");
        return true;
    }
}

function valimage() {
    var img = document.getElementById("file");
    var modal = document.getElementById("modal");
    if (img.value.length === 0) {
        modal.classList.remove("hidden");
    } else {
        modal.classList.add("hidden");
    }
}

function valpassword() {
    var pass = document.getElementById("pass").value;
    var passcfm = document.getElementById("passcfm").value;
    var errormsg = document.getElementById("passerror");

    if (pass != passcfm) {
        errormsg.classList.remove("hidden");
        errormsg.innerHTML = "Passwords do not match";
        return false;
    } else {
        errormsg.classList.add("hidden");
        return true;
    }
}