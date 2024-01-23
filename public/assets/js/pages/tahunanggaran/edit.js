(function () {
    const formeditAnggaran = document.querySelector('#formeditAnggaran');
    // Form validation for Add new record
    if (formeditAnggaran) {
        const fv = FormValidation.formValidation(formeditAnggaran, {
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
                        numeric: {
                            decimalSeparator: ',',
                            thousandsSeparator: '.',
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
