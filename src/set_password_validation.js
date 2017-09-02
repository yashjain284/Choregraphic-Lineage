
function loadH() {
    // console.log("HTML is loaded");
}

function validateSetForm() {
	// console.log("Validate");
    var pass1 = document.getElementById("user_new_password").value;
    var pass2 = document.getElementById("user_rnew_password").value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Passwords Do not match");
        document.getElementById("user_new_password").style.borderColor = "#E34234";
        document.getElementById("user_rnew_password").style.borderColor = "#E34234";
        ok = false;
    }
    return ok;
}