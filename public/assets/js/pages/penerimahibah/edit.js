(function () {
    const formeditPenerimahibah = document.querySelector('#formeditPenerimahibah');
    // Form validation for Add new record
    if (formeditPenerimahibah) {
        const fv = FormValidation.formValidation(formeditPenerimahibah, {
            fields: {
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Penerima Hibah Harus Diisi'
                        }
                    }
                },
                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat Penerima Hibah Harus Diisi'
                        }
                    }
                },

                no_telepon: {
                    validators: {
                        notEmpty: {
                            message: 'No. Telpon Harus Diisi'
                        },
                        integer: {
                            message: 'No. Telepon Harus Berupa Number'
                        }
                    }
                },

                email: {
                    validators: {

                        emailAddress: {
                            message: 'Email Tidak Valid'
                        }
                    }
                },

                penanggung_jawab: {
                    validators: {
                        notEmpty: {
                            message: 'Penanggung Jawab Harus Diisi'
                        }
                    }
                },

                no_telepon_penanggung_jawab: {
                    validators: {
                        notEmpty: {
                            message: 'No. Telpon Penanggung Jawab Harus Diisi'
                        },
                        integer: {
                            message: 'No. Telepon Penanggung Jawab Harus Berupa Number'
                        }
                    }
                },
                email_penanggung_jawab: {
                    validators: {

                        emailAddress: {
                            message: 'Email Penanggung Jawab Tidak Valid'
                        }
                    }
                },

                file_ktp: {
                    validators: {


                        file: {
                            extension: 'jpg,png,jpeg',
                            type: 'image/png,image/jpeg',
                            message: 'File KTP Harus JPG, JPEG,atau PNG',
                        },
                    }
                },
                nama_bank: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Bank Harus Diisi'
                        }
                    }
                },
                no_rekening: {
                    validators: {
                        notEmpty: {
                            message: 'No. Rekenign Harus Diisi'
                        }
                    }
                },
                nama_pemilik_rekening: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Pemilik Rekening Harus Diisi'
                        }
                    }
                },
                file_rekening: {
                    validators: {


                        file: {
                            extension: 'jpg,png,jpeg',
                            type: 'image/png,image/jpeg',
                            message: 'File Buku Renening Harus JPG, JPEG,atau PNG',
                        },
                    }
                },

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
