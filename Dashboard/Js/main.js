// @ts-check
// Implementerar Bootstrapvalidering i formulär.
(function () {
  window.addEventListener(
    'load',
    function () {
      var forms = document.getElementsByClassName('needs-validation');
      Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          'submit',
          function (
            /** @type {{ preventDefault: () => void; stopPropagation: () => void; }} */ event
          ) {
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
