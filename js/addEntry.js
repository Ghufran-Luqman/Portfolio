const clear = document.getElementById('clear');

clear.addEventListener('click', function(e) {
    const userConfirmation = confirm("Are you sure you want to clear?");
    if (!userConfirmation) { // if they clicked cancel
        e.preventDefault();
    }
});