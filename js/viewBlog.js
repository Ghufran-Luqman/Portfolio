const button = document.getElementById('add-post');
const deleteBtns = document.querySelectorAll('.delete-btn');

button.addEventListener('click', function() {
    const loggedInStatus = this.dataset.loggedIn === 'true';
    if (loggedInStatus) {
        window.location.href = 'addEntry.php';
    }
    else {
        window.location.href = 'login.php';
    }
});

deleteBtns.forEach(function(btn) {
    btn.addEventListener('click', function(e){
        userConfirmation = confirm("Are you sure you want to delete this blog post?");
        if (!userConfirmation) { // clicked cancel
            e.preventDefault();
        }
    })
})