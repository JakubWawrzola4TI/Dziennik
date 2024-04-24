function walidacjaDanych() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorElementUsername = document.getElementById("error-message-username");
    var errorElementPassword = document.getElementById("error-message-password");

    // Resetujemy poprzednie komunikaty
    errorElementUsername.style.display = "none";
    errorElementPassword.style.display = "none";

    if (username.trim() === "" && password.trim() === "") {
        errorElementUsername.innerHTML = "* Uzupełnij login.";
        errorElementUsername.style.display = "block"; // Pokaż komunikat o błędzie
        errorElementPassword.innerHTML = "* Uzupełnij hasło.";
        errorElementPassword.style.display = "block"; // Pokaż komunikat o błędzie
        return false;
    } else if (username.trim() === "") {
        errorElementUsername.innerHTML = "* Uzupełnij login.";
        errorElementUsername.style.display = "block"; // Pokaż komunikat o błędzie
        return false;
    } else if (password.trim() === "") {
        errorElementPassword.innerHTML = "* Uzupełnij hasło.";
        errorElementPassword.style.display = "block"; // Pokaż komunikat o błędzie
        return false;
    }
    errorElementUsername.innerHTML = "";
    errorElementPassword.innerHTML = "";
    return true;
}


