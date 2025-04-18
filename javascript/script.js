
    // toggle password
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        if (togglePassword && passwordField) {
            togglePassword.addEventListener("click", function () {
                console.log('je suis cliauer')
                console.log(togglePassword, passwordField)
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                
            });
        }
    });
