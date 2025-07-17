<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC Reset Password - EDF</title>
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

        #ccPwdOtp::-webkit-outer-spin-button,
        #ccPwdOtp::-webkit-inner-spin-button,
        #ccMobileNum::-webkit-outer-spin-button,
        #ccMobileNum::-webkit-inner-spin-button {
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

        #forgotPassword {
            text-decoration: none;
        }

        #forgotPassword:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .fixed-image {
                width: 100%;
                display: none;
            }

            #bgcolor {
                background-color: rgba(0, 121, 173, 0.4);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row" id="bgcolor">
            <div class="col-md-6">
                <img src="<?php echo base_url(); ?>assets/ccbglogin.png" alt="Fixed Image"
                    class="fixed-image img-fluid">
                <div class="fixed-image-container text-center d-none d-md-block"
                    style="position: fixed; top: 50%; left: 25%; transform: translate(-50%, -50%);">
                    <img src="<?php echo base_url(); ?>assets/ccloginimg.png" alt="image" class="img-fluid" width=""
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
                        <p class="text-justify" style="font-size:18px;font-weight:400;">Enter your registered mobile number
                            and email address below to receive an OTP at the entered email address to change your password.
                        </p>
                        <form action="<?php echo base_url('Chiefconsultant/sendFPOtp'); ?>" method="post"
                            name="ccasswordResetFormMail" onsubmit="return validateForm()" oninput="return removeError()">
                            <div class="mb-3">
                                <label for="ccMobileNum" class="form-label">Mobile Number <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="ccMobileNum" id="ccMobileNum" placeholder="9876543210"
                                    class="form-control rounded-pill p-3">
                                <div id="ccMobileNum_err" class="text-danger pt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label for="ccPassMail" class="form-label">Mail Id <span
                                        class="text-danger">*</span></label>
                                <input type="mail" name="ccPassMail" id="ccPassMail" placeholder="example@gmail.com"
                                    class="form-control rounded-pill p-3">
                                <div id="ccPassMail_err" class="text-danger pt-1"></div>
                            </div>
                            <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                style="background-color:#0079AD;font-size:16px;font-weight:600;">Send OTP</button>
                        </form>

                        <script>
                            function validateForm() {
                                var mobile = document.getElementById("ccMobileNum").value;
                                var email = document.getElementById("ccPassMail").value;

                                if (mobile == "") {
                                    document.getElementById("ccMobileNum_err").innerHTML = "Registered mobile number must be filled out.";
                                    return false;
                                } else if (!/^\d{10}$/.test(mobile)) {
                                    document.getElementById("ccMobileNum_err").innerHTML = "Invalid mobile number. Please enter valid number.";
                                    return false;
                                } else {
                                    document.getElementById("ccMobileNum_err").innerHTML = "";
                                }

                                if (email == "") {
                                    document.getElementById("ccPassMail_err").innerHTML = "Mail address must be filled out.";
                                    return false;
                                } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                                    document.getElementById("ccPassMail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                                    return false;
                                } else {
                                    document.getElementById("ccPassMail_err").innerHTML = "";
                                }
                            }

                            function removeError() {
                                var mobile = document.getElementById("ccMobileNum").value;
                                var email = document.getElementById("ccPassMail").value;

                                if (mobile != "") {
                                    document.getElementById("ccMobileNum_err").innerHTML = "";
                                }

                                if (email != "") {
                                    document.getElementById("ccPassMail_err").innerHTML = "";
                                }
                            }
                        </script>

                        <?php
                    } else if ($method == "verifyOtp") { ?>

                            <p class="py-2" style="font-size:24px;font-weight:600;">OTP verification</p>
                            <p class="text-justify" style="font-size:18px;font-weight:400;"><?php echo $message; ?>
                                <b><?php echo $toMail; ?></b>
                            </p>
                            <form action="<?php echo base_url() . "Chiefconsultant/verifyOtp" ?>" method="post"
                                name="ccOtpVerifyForm" onsubmit="return validOtp()">
                                <div class="">
                                    <label for="ccPwdOtp" class="form-label">OTP <span class="text-danger">*</span></label>
                                    <input type="number" name="ccPwdOtp" id="ccPwdOtp" placeholder="1234"
                                        class="form-control rounded-pill p-3" min="0">
                                    <div id="otp_err" class="text-danger pt-1"></div>
                                </div>
                                <input type="hidden" id="ccMobileNum" name="ccMobileNum" value="<?php echo $ccMobileNumber; ?>">
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                        style="background-color:#0079AD;font-size:16px;font-weight:600;">Verify</button>
                                    <p class="text-justify mt-3" style="font-size:18px;font-weight:400;">Didn't receive the
                                        OTP? <a href="<?php echo base_url() . "Chiefconsultant/resetPassword" ?>" id="resend"
                                            class="text-dark mt-5" style="font-weight:600;"> Resend</a></p>
                                </div>
                            </form>

                            <script>
                                function validOtp() {
                                    var otp = document.getElementById("ccPwdOtp").value;

                                    if (otp === "") {
                                        document.getElementById("otp_err").innerHTML = "OTP must be filled out.";
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
                                <p class="text-justify" style="font-size:18px;font-weight:400;"><?php echo $message; ?></p>
                                <form action="<?php echo base_url() . "Chiefconsultant/updateNewPassword" ?>" method="post"
                                    name="ccPasswordResetForm" onsubmit="return validateFields()">
                                    <div class="position-relative">
                                        <label for="ccPassword" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="ccPassword" id="ccPassword" placeholder="New password"
                                            oninput="validePassword(this)" class="form-control rounded-pill p-3">
                                        <i id="togglePassword"
                                            class="bi bi-eye position-absolute end-0 top-50 translate-middle-y mt-3 me-4"
                                            style="cursor: pointer;"></i>
                                    </div>
                                    <div id="password_err" class="text-danger pt-1"></div>
                                    <div class="text-secondary my-3" style="font-size:12px;display:none;" id="passwordmessage">
                                        Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                                        and a minimum of 8 characters.</div>
                                    <div class="my-3">
                                        <label for="ccCnfmPassword" class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="ccCnfmPassword" id="ccCnfmPassword"
                                            placeholder="re-type password" class="form-control rounded-pill p-3">
                                        <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                                    </div>
                                    <input type="hidden" id="ccMobileNum" name="ccMobileNum" value="<?php echo $hcpMobileNumber ?>">
                                    <div class="d-flex justify-content-between mt-5">
                                        <button type="submit" class="border-0 rounded-pill text-light px-4 px-sm-5 py-1 py-sm-3"
                                            style="background-color:#0079AD;font-size:16px;font-weight:600;">Change</button>
                                    </div>
                                </form>

                                <script>
                                    document.getElementById("ccPassword").onfocus = function () {
                                        document.getElementById("passwordmessage").style.display = "block";
                                    }

                                    document.getElementById("ccPassword").onblur = function () {
                                        document.getElementById("passwordmessage").style.display = "none";
                                    }
                                </script>

                                <script>
                                    function validateFields() {
                                        var password = document.getElementById("ccPassword").value;
                                        var cnfmPassword = document.getElementById("ccCnfmPassword").value;

                                        if (password == "") {
                                            document.getElementById("password_err").innerHTML = "Password must be filled out.";
                                            return false;
                                        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                                            document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password.";
                                            return false;
                                        } else {
                                            document.getElementById("password_err").innerHTML = "";
                                        }

                                        if (cnfmPassword == "") {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Re-enter the password.";
                                            return false;
                                        } else if (cnfmPassword != password) {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Enter same as password."
                                            return false;
                                        } else {
                                            document.getElementById("cnfmpassword_err").innerHTML = "";
                                        }
                                    }
                                </script>

                                <script>
                                    document.getElementById('togglePassword').addEventListener('click', function () {
                                        const passwordField = document.getElementById('ccPassword');
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
                            href="<?php echo base_url() . "Chiefconsultant/" ?>" class="text-dark" id="login"
                            style="font-weight:600;">Login</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        document.getElementById("ccPassword").onfocus = function () {
            document.getElementById("passwordmessage").style.display = "block";
        }

        document.getElementById("ccPassword").onblur = function () {
            document.getElementById("passwordmessage").style.display = "none";
        }

        function validOtp(input) {
            const emailError = document.getElementById("otp_err");
            if (input.value != "") {
                emailError.textContent = "";
            }
        }

        function validePassword(input) {
            const passwordError = document.getElementById("password_err");
            if (input.value != "") {
                passwordError.textContent = "";
            }
        }

        function validateFields() {
            var otp = document.getElementById("ccPwdOtp").value;
            var password = document.getElementById("ccPassword").value;
            var cnfmPassword = document.getElementById("ccCnfmPassword").value;

            if (otp == "") {
                document.getElementById("otp_err").innerHTML = "OTP must be filled out.";
                return false;
            } else if (otp < 1000 || otp > 9999) {
                document.getElementById("otp_err").innerHTML = "Invalid OTP. Please 4-digits valid OTP.";
                return false;
            } else {
                document.getElementById("otp_err").innerHTML = "";
            }

            if (password == "") {
                document.getElementById("password_err").innerHTML = "Password must be filled out.";
                return false;
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password.";
                return false;
            } {
                document.getElementById("password_err").innerHTML = "";
            }

            if (cnfmPassword == "") {
                document.getElementById("cnfmpassword_err").innerHTML = "Re-enter the password.";
                return false;
            } else if (cnfmPassword != password) {
                document.getElementById("cnfmpassword_err").innerHTML = "Enter same as password."
                return false;
            } else {
                document.getElementById("cnfmpassword_err").innerHTML = "";
            }
        }
    </script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('ccPassword');
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
    </script> -->

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

</body>

</html>