"use strict";

// Implementerar kontroll om lösenordet är mindre än 6 tecken.
$(document).ready(function () {
  $("#registerpsw").keyup(function () {
    if ($("#registerpsw").val().length >= 6) {
      // Om lösenordets längd var längre än 6 tecken.
      $("#registerpsw").css("border-color", "#008000");
    } else {
      // Slut om lösenordets längd var längre än 6 tecken.
      // Om lösenordets längd var mindre än 6 tecken.
      $("#registerpsw").css("border-color", "red");
    } // Slut om lösenordets längd var mindre än 6 tecken.
  });
});

// Implementerar Bootstrapvalidering i formulären.
(function () {
  window.addEventListener(
    "load",
    function () {
      var forms = document.getElementsByClassName("needs-validation");
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();
