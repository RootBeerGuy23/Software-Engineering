// Generate a random CAPTCHA
function generateCaptcha() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var captchaText = '';
    for (var i = 0; i < 6; i++) {
        captchaText += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('captchaText').innerText = captchaText;
    document.getElementById('hiddenCaptcha').value = captchaText;
}

// Verify the CAPTCHA
function validateCaptcha() {
    var enteredCaptcha = document.getElementById('captcha').value;
    var generatedCaptcha = document.getElementById('hiddenCaptcha').value;

    if (enteredCaptcha !== generatedCaptcha) {
        alert("Captcha verification failed. Please try again.");
        generateCaptcha(); // Refresh CAPTCHA
        return false;
    }
    return true;
}

window.onload = function() {
    generateCaptcha();
}
