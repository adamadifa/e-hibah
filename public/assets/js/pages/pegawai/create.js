(function () {
    const formcreatePegawai = document.querySelector('#formcreatePegawai');
    // Form validation for Add new record
    if (formcreatePegawai) {
        const fv = FormValidation.formValidation(formcreatePegawai, {
            fields: {
                nip: {
                    validators: {
                        notEmpty: {
                            message: 'Nomor Induk Pegawai Harus Diisi'
                        }
                    }
                },
                nama_pegawai: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Pegawai Harus Diisi'
                        }
                    }
                },
                kode_jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Jabatan Harus Diisi'
                        }
                    }
                },
                kode_unit: {
                    validators: {
                        notEmpty: {
                            message: 'Unit Organisasi Harus Diisi'
                        }
                    }
                },
                kode_status_pns: {
                    validators: {
                        notEmpty: {
                            message: 'Status Harus Diisi'
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
