document.addEventListener('DOMContentLoaded', function () {
    addEventListener('ajax:invalid-field', function(event) {
        const { element, fieldName, errorMsg, isFirst } = event.detail;
        element.classList.add('-has-error');
    });

    addEventListener('ajax:promise', function(event) {
        event.target.closest('form').querySelectorAll('.-has-error').forEach(function(el) {
            el.classList.remove('-has-error');
        });
    });
})
