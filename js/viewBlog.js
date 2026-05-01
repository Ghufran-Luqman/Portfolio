const button = document.getElementById('add-post');

button.addEventListener('click', function() {
    const loggedInStatus = this.dataset.loggedIn === 'true';
    if (loggedInStatus) {
        window.location.href = 'addEntry.php';
    }
    else {
        window.location.href = 'login.php';
    }
});