// @ts-check
// Implementerar kontroll om lösenordet är mindre än 6 tecken.
$(document).on('ready', () => {
  $('#registerpsw').on('click', () => {
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    if ($('#registerpsw').val()[0].length >= 6) {
      // Om lösenordets längd var längre än 6 tecken.
      $('#registerpsw').css('border-color', '#008000');
    } else {
      // Slut om lösenordets längd var längre än 6 tecken.
      // Om lösenordets längd var mindre än 6 tecken.
      $('#registerpsw').css('border-color', 'red');
    } // Slut om lösenordets längd var mindre än 6 tecken.
  });
});

// Implementerar Bootstrapvalidering i formulären.
(() => {
  window.addEventListener(
    'load',
    () => {
      const forms = document.getElementsByClassName('needs-validation');
      Array.prototype.filter.call(forms, (form: HTMLFormElement) => {
        form.addEventListener(
          'submit',
          (event: Event) => {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          },
          false
        );
      });
    },
    false
  );
})();
