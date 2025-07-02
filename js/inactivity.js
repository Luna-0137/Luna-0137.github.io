let inactivityTime = function () 
{
    let time;
    let redirectUrl = 'index.php?page=logout&message=logout';

    // Reset timer
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer; // catches touchscreen presses as well
    window.ontouchstart = resetTimer;
    window.ontouchmove = resetTimer;
    window.onclick = resetTimer;     // catches touchpad clicks as well
    window.onkeypress = resetTimer;
    window.addEventListener('scroll', resetTimer, true); // improved; see comments

    function logout() {
        window.location.href = redirectUrl;
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 900000);
    }
};

// Initialize the inactivity timer
inactivityTime();
