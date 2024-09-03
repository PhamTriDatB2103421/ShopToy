function validatePassword() {
    var password = document.getElementById('password-edit');
    var confirmPassword = document.getElementById('test_password');

    if (password.value !== confirmPassword.value) {
        password.style.borderColor = "red";
        confirmPassword.style.borderColor = "red";
        alert("Mật khẩu không khớp!");
    } else {
        password.style.borderColor = "";
        confirmPassword.style.borderColor = "";
        document.getElementById('editUserForm').submit();
    }
}
document.getElementById('password-edit').addEventListener('input', validatePassword);
document.getElementById('test_password').addEventListener('input', validatePassword);

function validatePassword() {
    var password = document.getElementById('password-edit');
    var confirmPassword = document.getElementById('test_password');

    if (password.value !== confirmPassword.value) {
        password.style.borderColor = "red";
        confirmPassword.style.borderColor = "red";
    } else {
        password.style.borderColor = "";
        confirmPassword.style.borderColor = "";
    }
}

