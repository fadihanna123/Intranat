// @ts-check
// Implementerar Bootstrapvalidering i formulär.
(() => {
  window.addEventListener(
    'load',
    () => {
      const forms = document.getElementsByClassName('needs-validation');
      Array.prototype.filter.call(
        forms,
        (
          /** @type {{ addEventListener: (arg0: string, arg1: (event: any) => void, arg2: boolean) => void; checkValidity: () => boolean; classList: { add: (arg0: string) => void; }; }} */ form
        ) => {
          form.addEventListener(
            'submit',
            (event) => {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            },
            false
          );
        }
      );
    },
    false
  );
})();
