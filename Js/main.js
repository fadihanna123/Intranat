$(document).on('ready', () => {
    $('#registerpsw').on('click', () => {
        if ($('#registerpsw').val()[0].length >= 6) {
            $('#registerpsw').css('border-color', '#008000');
        }
        else {
            $('#registerpsw').css('border-color', 'red');
        }
    });
});
(() => {
    window.addEventListener('load', () => {
        const forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, (form) => {
            form.addEventListener('submit', (event) => {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
export {};
