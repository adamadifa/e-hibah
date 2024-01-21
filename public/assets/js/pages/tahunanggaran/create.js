(function () {
    const formcreateAnggaran = document.querySelector('#formcreateAnggaran');
    // Form validation for Add new record
    if (formcreateAnggaran) {
        const fv = FormValidation.formValidation(formcreateAnggaran, {
            fields: {
                tahun: {
                    validators: {
                        notEmpty: {
                            message: 'Tahun Harus Diisi'
                        }
                    }
                },

                jumlah_anggaran: {
                    validators: {
                        notEmpty: {
                            message: 'Jumlah Anggaran Harus Diisi'
                        },
                        integer: {
                            message: 'Jumlah Anggaran Harus Berupa Angka'
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
