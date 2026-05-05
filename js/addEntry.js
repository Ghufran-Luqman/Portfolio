const title = document.getElementById('title');
const blog_text = document.getElementById('blog-text');
const post = document.getElementById('post');
const clear = document.getElementById('clear');
const errorMsg = document.getElementById('errorMsg');
const preview = document.getElementById('preview');
let valid = true;
let titleValid = true;
let bodyValid = true;

function notFilledOut(e) {
    let valid = true;
    if (title.value.length==0) {
        title.classList.add('notFilledOut');
        valid = false;
        titleValid = false;
    }
    if (blog_text.value.length==0) {
        blog_text.classList.add('notFilledOut');
        valid = false;
        bodyValid = false;
    }
    if (valid==false) {
        e.preventDefault();
        errorMsg.textContent = "Please fill in all fields before posting."
    }
}

post.addEventListener('click', notFilledOut);

preview.addEventListener('click', notFilledOut);

title.addEventListener('input', function() {
    if (!(titleValid)) {
        title.classList.remove('notFilledOut');
        errorMsg.textContent="";
    }
})

blog_text.addEventListener('input', function() {
    if (!(bodyValid)) {
        blog_text.classList.remove('notFilledOut');
        errorMsg.textContent="";
    }
})


clear.addEventListener('click', function(e) {
    const userConfirmation = confirm("Are you sure you want to clear?");
    if (!userConfirmation) { // if they clicked cancel
        e.preventDefault();
    }
    else { // reset
        title.classList.remove('notFilledOut');
        blog_text.classList.remove('notFilledOut');
        errorMsg.textContent="";
        title.value="";
        blog_text.value="";
    }
});