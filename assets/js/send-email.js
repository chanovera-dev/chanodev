const form = document.querySelector('.wpcf7-form');
function checkClassAndChangeStyles() {
    const titleElement = document.getElementById('title--get-in-touch')
      , showFormElement = document.getElementById('show-form');
    form.classList.contains('submitting') | form.classList.contains('resetting') ? titleElement.classList.remove('hide') : form.classList.contains('sent') && (titleElement.classList.add('hide'),
    showFormElement.classList.add('show'))
}
const observerContact = new MutationObserver(mutations => {
    mutations.forEach(mutation => {
        mutation.type === 'attributes' && mutation.attributeName === 'class' && checkClassAndChangeStyles()
    }
    )
}
);
form && observerContact.observe(form, {
    attributes: true
});
checkClassAndChangeStyles();
function showForm() {
    const titleElement = document.getElementById('title--get-in-touch')
      , showFormElement = document.getElementById('show-form');
    titleElement.classList.remove('hide'),
    showFormElement.classList.remove('show'),
    form.classList.remove('sent'),
    form.setAttribute('data-status', 'init')
}

if (showFormElement) {
    showFormElement.addEventListener('click', function () {
    if (showFormElement.classList.contains('show')) {
        showForm();
    }
    });
}
