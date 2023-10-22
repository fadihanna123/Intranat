// @ts-check
'use strict';
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var jquery_1 = __importDefault(require("jquery"));
// Implementerar kontroll om lösenordet är mindre än 6 tecken.
(0, jquery_1.default)(document).on('ready', function () {
    (0, jquery_1.default)('#registerpsw').on('click', function () {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        if ((0, jquery_1.default)('#registerpsw').val()[0].length >= 6) {
            // Om lösenordets längd var längre än 6 tecken.
            (0, jquery_1.default)('#registerpsw').css('border-color', '#008000');
        }
        else {
            // Slut om lösenordets längd var längre än 6 tecken.
            // Om lösenordets längd var mindre än 6 tecken.
            (0, jquery_1.default)('#registerpsw').css('border-color', 'red');
        } // Slut om lösenordets längd var mindre än 6 tecken.
    });
});
// Implementerar Bootstrapvalidering i formulären.
(function () {
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
