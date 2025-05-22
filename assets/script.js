function validateRegisterForm() {
    const username = document.getElementById("reg_username").value.trim();
    const password = document.getElementById("reg_password").value;

    if (username.length < 4) {
        alert("Username must be at least 4 characters.");
        return false;
    }
    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }
    return true;
}

function validateLoginForm() {
    const username = document.getElementById("login_username").value.trim();
    const password = document.getElementById("login_password").value;

    if (!username || !password) {
        alert("Please fill in both fields.");
        return false;
    }
    return true;
}
