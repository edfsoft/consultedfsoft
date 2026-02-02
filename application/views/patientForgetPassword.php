<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Reset Password - EDF</title>
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon">
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #patientPwdOtp::-webkit-outer-spin-button,
        #patientPwdOtp::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }

        .fixed-image {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            width: 50%;
            z-index: -1;
        }

        #resend,
        #login {
            text-decoration: none;
        }

        #resend:hover,
        #login:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .fixed-image {
                width: 100%;
                display: none;
            }

            #bgcolor {
                background-color: rgba(0, 173, 142, 0.4);
                min-height: 100vh;
            }

            #edfLogo {
                display: block;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row" id="bgcolor">
            <div class="col-md-6 text-center">
                <img src="<?php echo base_url(); ?>assets/patientbglogin.png" alt="Fixed Image"
                    class="fixed-image img-fluid">
                <div class="fixed-image-container text-center d-none d-md-block"
                    style="position: fixed; top: 50%; left: 25%; transform: translate(-50%, -50%);">
                    <img src="<?php echo base_url(); ?>assets/patientlogin.png" alt="image" class="img-fluid" width=""
                        height="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="forgetPassword mx-lg-5 p-3 p-sm-5">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/edf_logo.png"
                            alt="logo" class="img-fluid" id="edfLogo"></a>

                    <?php
                    if ($method == "getMailId") {
                        ?>
                        <p class="py-2" style="font-size:24px;font-weight:600;">Forgot your password ?</p>
                        <p class="text-justify" style="font-size:18px;font-weight:400;">Enter your registered email address
                            below to receive an OTP at the entered email address to change your password.
                        </p>
                        <form action="<?php echo base_url('Patient/sendFPOtp'); ?>" method="post"
                            name="patientPasswordResetFormMail" onsubmit="return validateForm()"
                            oninput="return removeError()">
                            <div class="mb-3">
                                <label for="patientPassId" class="form-label">EDF Id <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="patientPassId" id="patientPassId"
                                    class="form-control rounded-pill p-3" oninput="validPatientId(this)"
                                    placeholder="EDF000001">
                                <small id="patientId_err" class="text-danger pt-1"></small>
                            </div>
                            <div class="my-3">
                                <label for="patientPassMail" class="form-label">Mail Id <span
                                        class="text-danger">*</span></label>
                                <input type="mail" name="patientPassMail" id="patientPassMail"
                                    placeholder="example@gmail.com" class="form-control rounded-pill p-3">
                                <small id="patientPassMail_err" class="text-danger pt-1"></small>
                            </div>
                            <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                style="background-color: #2F80ED;font-size:16px;font-weight:600;">Send OTP</button>
                        </form>

                        <script>
                            function validateForm() {
                                var patientId = document.getElementById("patientPassId").value;
                                var email = document.getElementById("patientPassMail").value;

                                if (patientId == "") {
                                    document.getElementById("patientId_err").innerHTML = "Please enter a patient ID.";
                                    return false;
                                } else if (!/^EDF\d{6}$/.test(patientId)) {
                                    document.getElementById("patientId_err").innerHTML = "Invalid patient ID. Please enter valid patient ID.";
                                    return false;
                                } else {
                                    document.getElementById("patientId_err").innerHTML = "";
                                }

                                if (email == "") {
                                    document.getElementById("patientPassMail_err").innerHTML = "Please enter an email address.";
                                    return false;
                                } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                                    document.getElementById("patientPassMail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                                    return false;
                                } else {
                                    document.getElementById("patientPassMail_err").innerHTML = "";
                                }
                            }

                            function removeError() {
                                var patientId = document.getElementById("patientPassId").value;
                                var email = document.getElementById("patientPassMail").value;

                                if (patientId != "") {
                                    document.getElementById("patientId_err").innerHTML = "";
                                }

                                if (email != "") {
                                    document.getElementById("patientPassMail_err").innerHTML = "";
                                }
                            }
                        </script>

                        <?php
                    } else if ($method == "verifyOtp") { ?>

                            <p class="py-2" style="font-size:24px;font-weight:600;">OTP verification</p>
                            <p class="text-justify" style="font-size:18px;font-weight:400;">
                            </p>
                            <form action="<?php echo base_url() . "Patient/verifyOtp" ?>" method="post"
                                name="patientOtpVerifyForm" onsubmit="return validOtp()">
                                <div class="">
                                    <label for="patientPwdOtp" class="form-label">OTP <span class="text-danger">*</span></label>
                                    <input type="number" name="patientPwdOtp" id="patientPwdOtp" placeholder="1234"
                                        class="form-control rounded-pill p-3" min="0">
                                    <small id="otp_err" class="text-danger pt-1"></small>
                                </div>
                                <input type="hidden" id="patientMail" name="patientMail" value="<?php echo $patientMail; ?>">
                                <input type="hidden" id="patientId" name="patientId" value="<?php echo $patientId; ?>">
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                        style="background-color:#2F80ED;font-size:16px;font-weight:600;">Verify</button>
                                    <p class="text-justify mt-3" style="font-size:18px;font-weight:400;">Didn't receive the
                                        OTP? <a href="<?php echo base_url() . "Patient/resetPassword" ?>" id="resend"
                                            class="text-dark mt-5" style="font-weight:600;"> Resend</a></p>
                                </div>
                            </form>

                            <script>
                                function validOtp() {
                                    var otp = document.getElementById("patientPwdOtp").value;

                                    if (otp === "") {
                                        document.getElementById("otp_err").innerHTML = "Please enter the OTP.";
                                        return false;
                                    } else if (!/^\d{4}$/.test(otp)) {
                                        document.getElementById("otp_err").innerHTML = "Invalid OTP. Please enter a valid 4-digit OTP.";
                                        return false;
                                    } else {
                                        document.getElementById("otp_err").innerHTML = "";
                                        return true;
                                    }
                                }
                            </script>

                        <?php
                    } else if ($method == "newPassword") { ?>

                                <p class="py-2" style="font-size:24px;font-weight:600;">Change password</p>
                                <p class="text-justify" style="font-size:18px;font-weight:400;"></p>
                                <form action="<?php echo base_url() . "Patient/updateNewPassword" ?>" method="post"
                                    name="patientPasswordResetForm" onsubmit="return validateFields()">
                                    <input type="hidden" id="mailId" name="mailId" value="<?php echo $patientMail; ?>">
                                    <input type="hidden" id="patientId" name="patientId" value="<?php echo $patientId; ?>">
                                    <div class="position-relative">
                                        <label for="patientPassword" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="patientPassword" id="patientPassword"
                                            placeholder="New password" oninput="validePassword(this)"
                                            class="form-control rounded-pill p-3">
                                        <i id="togglePassword"
                                            class="bi bi-eye position-absolute end-0 top-50 translate-middle-y mt-3 me-4"
                                            style="cursor: pointer;"></i>
                                    </div>
                                    <small id="password_err" class="text-danger pt-1"></small>
                                    <div class="text-secondary my-3" style="font-size:12px;display:none;" id="passwordmessage">
                                        Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                                        and a minimum of 8 characters.</div>
                                    <div class="my-3">
                                        <label for="patientCnfmPassword" class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="patientCnfmPassword" id="patientCnfmPassword"
                                            placeholder="re-type password" class="form-control rounded-pill p-3">
                                        <small id="cnfmpassword_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="d-flex justify-content-between mt-5">
                                        <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                            style="background-color:#2F80ED;font-size:16px;font-weight:600;">Change</button>
                                    </div>
                                </form>

                                <script>
                                    document.getElementById("patientPassword").onfocus = function () {
                                        document.getElementById("passwordmessage").style.display = "block";
                                    }

                                    document.getElementById("patientPassword").onblur = function () {
                                        document.getElementById("passwordmessage").style.display = "none";
                                    }
                                </script>

                                <script>
                                    function validateFields() {
                                        var password = document.getElementById("patientPassword").value;
                                        var cnfmPassword = document.getElementById("patientCnfmPassword").value;

                                        if (password == "") {
                                            document.getElementById("password_err").innerHTML = "Please enter a password.";
                                            return false;
                                        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                                            document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password.";
                                            return false;
                                        } else {
                                            document.getElementById("password_err").innerHTML = "";
                                        }

                                        if (cnfmPassword == "") {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Please re-enter the password.";
                                            return false;
                                        } else if (cnfmPassword != password) {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Please enter the same password again."
                                            return false;
                                        } else {
                                            document.getElementById("cnfmpassword_err").innerHTML = "";
                                        }
                                    }
                                </script>

                                <script>
                                    document.getElementById('togglePassword').addEventListener('click', function () {
                                        const passwordField = document.getElementById('patientPassword');
                                        const icon = document.getElementById('togglePassword');
                                        if (passwordField.type === 'password') {
                                            passwordField.type = 'text';
                                            icon.classList.remove('bi-eye');
                                            icon.classList.add('bi-eye-slash');
                                        } else {
                                            passwordField.type = 'password';
                                            icon.classList.remove('bi-eye-slash');
                                            icon.classList.add('bi-eye');
                                        }
                                    });
                                </script>
                    <?php } ?>

                    <p class="float-end mt-3" style="font-size:18px;font-weight:400;">Back to <a
                            href="<?php echo base_url() . "Patient/" ?>" class="text-dark" id="login"
                            style="font-weight:600;">Login</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <!--Display Success and Error Message Popup Scrren -->
    <div class="modal fade" id="display_message" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php if ($this->session->flashdata('successMessage')) { ?>
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: Poppins, sans-serif;" id="errorModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->session->flashdata('successMessage'); ?></p>
                    </div>
                <?php }
                if ($this->session->flashdata('errorMessage')) { ?>
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: Poppins, sans-serif;" id="errorModalLabel">Error!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->session->flashdata('errorMessage'); ?></p>
                    </div>
                <?php } ?>
                <div class="modal-footer"> <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Ok</button> </div>
            </div>
        </div>
    </div>


    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>

    <!-- Hide page source Ctrl + U -->
    <script>
        document.onkeydown = function (e) {
            if (e.ctrlKey && e.keyCode === 85) {
                return false;
            }
        };
    </script>

    <!-- Bootstrap 5.1.3 JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--Display Success and Error Message Popup Scrren -->
    <script>
        <?php if ($this->session->flashdata('successMessage') || $this->session->flashdata('errorMessage')) { ?>
            var displayMessage = new bootstrap.Modal(document.getElementById('display_message'));
            displayMessage.show();
        <?php } ?>
    </script>

</body>

</html>