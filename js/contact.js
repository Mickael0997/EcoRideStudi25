document.getElementById('contact-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('contact-form-container').classList.remove('hidden');
});

document.getElementById('close-contact-form').addEventListener('click', function() {
    document.getElementById('contact-form-container').classList.add('hidden');
});