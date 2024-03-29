const newsletterForm = document.getElementById('newsletter-form');
const newsEmailEl = newsletterForm.querySelector('[name = email]');

newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();

    if(validateEmail(newsEmailEl)) {
        fetch('/' + baseUrl + '/newsletter/add', {
            method: 'POST',
            body: new FormData(newsletterForm),
        })
        .then(res => res.json())
        .then(data => {
            if(data['success']) {
                const errorText = document.getElementById('success-newsletter');
                errorText.textContent = data['text'];
            }
            else {
                const errorText = document.getElementById('error-newsletter');
                errorText.textContent = data['text'];
            }
        })
    }
});

newsletterForm.addEventListener("blur", () => {
    validateEmail(newsEmailEl);
}, true);