(function () {
    const formcreateDisposisi = document.querySelector('#formcreateDisposisi');
    // Form validation for Add new record
    if (formcreateDisposisi) {
        const fv = FormValidation.formValidation(formcreateDisposisi, {
            fields: {
                id_penerima: {
                    validators: {
                        notEmpty: {
                            message: 'Penerima Harus Dipilih'
                        }
                    }
                },

                id_jenis_penanganan: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis Penanganan Harus Dipilih'
                        }
                    }
                }

            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.mb-3'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),

                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
    }
})();
