// @ts-check
// Implementerar Bootstrapvalidering i formulär.
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
