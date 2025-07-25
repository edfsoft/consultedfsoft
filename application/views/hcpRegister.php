<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCP Signup Page - EDF</title>
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

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }

        #hcpMobile::-webkit-outer-spin-button,
        #hcpMobile::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #edfLogo {
            display: none;
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

        #login {
            text-decoration: none;
        }

        #login:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .fixed-image {
                width: 100%;
                display: none;
            }

            #bgcolor {
                background-color: rgba(0, 173, 142, 0.6);
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
            <div class="col-md-6">
                <img src="<?php echo base_url(); ?>assets/hcpbglogin.png" alt="Fixed Image"
                    class="fixed-image img-fluid">
                <div class="fixed-image-container text-center d-none d-md-block"
                    style="position: fixed; top: 50%; left: 25%; transform: translate(-50%, -50%);">
                    <p style="font-size:40px;font-weight:500;">Welcome to</p>
                    <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="Overlay" class="img-fluid" width="226"
                        height="106">
                    <p class="pt-3" style="font-size:18px;">Sign up to continue as <b>Health Care Provider</b>.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-form mx-lg-2 mx-xxl-5 p-3 p-sm-4 p-xxl-5">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/edf_logo.png"
                            id="edfLogo" alt="logo" class="img-fluid"></a>
                    <p class="fs-1 fs-sm-2 pt-2" style="font-weight:500;color:#E01A2B;">Create an Account</p>
                    <p class="" style="font-size:24px;font-weight:600;">HEALTH CARE PROVIDER</p>
                    <p class="" style="font-size:18px;font-weight:400;">We're thrilled to have you join us on your
                        journey towards better health. </p>
                    <form action="<?php echo base_url() . "Healthcareprovider/hcpSignup" ?>" method="post"
                        name="hcpsignupform" onsubmit="return validateSignup()" oninput="return removeError()">
                        <div class="mb-3">
                            <label for="hcpName" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="hcpName" id="hcpName" placeholder="Suresh Kumar"
                                class="form-control rounded-pill p-3">
                            <div id="name_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="hcpMobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="number" name="hcpMobile" id="hcpMobile" placeholder="9876543210"
                                class="form-control rounded-pill p-3">
                            <div id="mobile_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="hcpEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="hcpEmail" id="hcpEmail" placeholder="example@gmail.com"
                                class="form-control rounded-pill p-3">
                            <div id="mail_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="hcpSpec" class="form-label">Specialization <span
                                    class="text-danger">*</span></label>
                            <select class="form-select rounded-pill p-3" id="hcpSpec" name="hcpSpec">
                                <option value="">Select Specialization</option>
                                <?php
                                foreach ($specializationList as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['specializationName'] ?>">
                                        <?php echo $value['specializationName'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div id="spec_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="position-relative">
                            <label for="hcpPassword" class="form-label">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="hcpPassword" id="hcpPassword" placeholder="password"
                                class="form-control rounded-pill p-3">
                            <i id="togglePassword"
                                class="bi bi-eye position-absolute end-0 top-50 translate-middle-y mt-3 me-4"
                                style="cursor: pointer;"></i>
                        </div>
                        <div id="password_err" class="text-danger pt-1"></div>

                        <div class="text-secondary mt-2" style="font-size:12px;display:none;" id="passwordmessage">
                            Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                            and a minimum of 8 characters.</div>
                        <div class="my-3">
                            <label for="hcpCnfmPassword" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="hcpCnfmPassword" id="hcpCnfmPassword"
                                placeholder="re-type password" class="form-control rounded-pill p-3">
                            <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <input type="checkbox" id="check" name="check" value="1">
                            <label for="check">I agree the Terms of Use and Privacy Policy.</label>
                        </div> -->
                        <input type="hidden" name="firstLoginPswdChange" id="firstLoginPswdChange" value="1">

                        <button type="submit" class="border-0 rounded-pill text-light mt-4 px-4 px-sm-5 py-1 py-sm-3"
                            style="background-color:#00AD8E;font-size:16px;font-weight:600;">Sign Up</button>
                    </form>
                    <p class="mt-4" style="font-size:18px;font-weight:400;">Already have an account ? <a
                            href="<?php echo base_url() . "Healthcareprovider/" ?>" id="login" class="text-dark"
                            style="font-weight:600;"> Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <!--Display Message Popup Screen -->
    <div class="modal fade" id="display_message" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php if ($this->session->flashdata('successMessage')) { ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Success</h5> <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->session->flashdata('successMessage'); ?></p>
                    </div>
                <?php }
                if ($this->session->flashdata('errorMessage')) { ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error!</h5> <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->session->flashdata('errorMessage'); ?></p>
                    </div>
                <?php } ?>
                <div class="modal-footer"> <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button> </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.1.3 JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Display popup success error message -->
    <script>
        <?php if ($this->session->flashdata('successMessage') || $this->session->flashdata('errorMessage')) { ?>
            var displayMessage = new bootstrap.Modal(document.getElementById('display_message'));
            displayMessage.show();
        <?php } ?>
    </script>

    <!-- Validation -->
    <script>
        function validateSignup() {
            var name = document.getElementById("hcpName").value;
            var mobile = document.getElementById("hcpMobile").value;
            var email = document.getElementById("hcpEmail").value;
            var spec = document.getElementById("hcpSpec").value;
            var password = document.getElementById("hcpPassword").value;
            var confirmpassword = document.getElementById("hcpCnfmPassword").value;

            if (name == "") {
                document.getElementById("name_err").innerHTML = "Name must be filled out.";
                return false;
            } else {
                document.getElementById("name_err").innerHTML = "";
            }

            if (mobile == "") {
                document.getElementById("mobile_err").innerHTML = "Mobile number must be filled out.";
                return false;
            } else if (!/^\d{10}$/.test(mobile)) {
                document.getElementById("mobile_err").innerHTML = "Invalid mobile number. Please enter valid number.";
                return false;
            } else {
                document.getElementById("mobile_err").innerHTML = "";
            }

            if (email == "") {
                document.getElementById("mail_err").innerHTML = "Mail address must be filled out.";
                return false;
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                document.getElementById("mail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                return false;
            } else {
                document.getElementById("mail_err").innerHTML = "";
            }

            if (spec == "") {
                document.getElementById("spec_err").innerHTML = "Specialization must be filled out.";
                return false;
            } else {
                document.getElementById("spec_err").innerHTML = "";
            }

            if (password == "") {
                document.getElementById("password_err").innerHTML = "Password must be filled out.";
                return false;
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password."
                return false;
            } else {
                document.getElementById("password_err").innerHTML = "";
            }

            if (confirmpassword == "") {
                document.getElementById("cnfmpassword_err").innerHTML = "Re-enter the password.";
                return false;
            } else if (confirmpassword != password) {
                document.getElementById("cnfmpassword_err").innerHTML = "Enter same as password."
                return false;
            } else {
                document.getElementById("cnfmpassword_err").innerHTML = "";
            }
        }

        document.getElementById("hcpPassword").onfocus = function () {
            document.getElementById("passwordmessage").style.display = "block";
        }

        document.getElementById("hcpPassword").onblur = function () {
            document.getElementById("passwordmessage").style.display = "none";
        }

        function removeError() {
            var name = document.getElementById("hcpName").value;
            var mobile = document.getElementById("hcpMobile").value;
            var email = document.getElementById("hcpEmail").value;
            var spec = document.getElementById("hcpSpec").value;
            var password = document.getElementById("hcpPassword").value;
            var confirmpassword = document.getElementById("hcpCnfmPassword").value;

            if (name != "") {
                document.getElementById("name_err").innerHTML = "";
            }

            if (mobile != "") {
                document.getElementById("mobile_err").innerHTML = "";
            }

            if (email != "") {
                document.getElementById("mail_err").innerHTML = "";
            }

            if (spec != "") {
                document.getElementById("spec_err").innerHTML = "";
            }

            if (password != "") {
                document.getElementById("password_err").innerHTML = "";
            }

            if (confirmpassword != "") {
                document.getElementById("cnfmpassword_err").innerHTML = "";
            }
        }
    </script>

    <!-- Password visiblity -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('hcpPassword');
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

    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>

    <!-- To hide page source Ctrl + U -->
    <script>
        document.onkeydown = function (e) {
            if (e.ctrlKey && e.keyCode === 85) {
                return false;
            }
        };
    </script>

</body>

</html>