<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC Login Page</title>

    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

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

        .fixed-image {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            width: 50%;
            z-index: -1;
        }

        #forgotPassword, #newAccount {
            text-decoration: none;
        }

        #forgotPassword:hover, #newAccount:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .fixed-image {
                width: 100%;
                display: none;
            }

            #bgcolor {
                background-color: rgba(0, 121, 173, 0.4);
                min-height: 100vh;   
            }

            #edfLogo {
                display: block;
                margin: 0 auto;
            }
            
            #ccHeading{
                text-align: center;
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
                <div class="login-form  mx-lg-2 mx-xxl-5 p-3 p-sm-4 p-xxl-5">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/edf_logo.png"
                    id="edfLogo" alt="logo" class="img-fluid"></a>
                    <p class="fs-1 fs-sm-2 pt-2" style="font-weight:500;color:#0079AD;" id="ccHeading" >Chief Consultant Login</p>
                    <p class="" style="font-size:24px;font-weight:600;">Welcome back 👋</p>
                    <p class="" style="font-size:18px;font-weight:400;">Empowering chief practitioners to provide personalized online diabetes consultations for comprehensive patient care.
                    </p>
                    <form action="<?php echo base_url() . "Chiefconsultant/ccLogin" ?>" method="post" name="ccloginform"
                        onsubmit="return validateLogin()">
                        <div class="mb-3">
                            <label for="ccEmail" class="form-label">Email address <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="ccEmail" id="ccEmail" placeholder="example@gmail.com"
                                oninput="validEmail(this)" class="form-control rounded-pill p-3">
                            <div id="mail_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="position-relative">
                            <label for="ccPassword" class="form-label">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="ccPassword" id="ccPassword" placeholder="password"
                                oninput="validePassword(this)" class="form-control rounded-pill p-3">
                            <i id="togglePassword"
                                class="bi bi-eye position-absolute end-0 top-50 translate-middle-y mt-3 me-4"
                                style="cursor: pointer;"></i> 
                            </div>
                            <div id="password_err" class="text-danger pt-1"></div>                      
                        <div class="text-secondary my-3" style="font-size:12px;display:none;" id="passwordmessage">
                            Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                            and a minimum of 8 characters.</div>
                        <!-- <div class="mb-3">
                            <input type="checkbox" id="check" name="check" value="1">
                            <label for="check"> Remember me</label>
                        </div> -->
                        <div class="d-flex justify-content-between">
                            <button type="submit"
                                class="border-0 rounded-pill text-light mt-4 px-4 px-sm-5 py-1 py-sm-3"
                                style="background-color:#0079AD;font-size:16px;font-weight:600;">Login</button>
                            <!-- <a href="<?php echo base_url() . "Chiefconsultant/resetPassword" ?>" id="forgotPassword" class="text-danger mt-5">Forgot password?</a> -->
                        </div>
                    </form>

                    <p class="mt-4" style="font-size:18px;font-weight:400;">Don't have an account? <a
                            href="<?php echo base_url() . "Chiefconsultant/register" ?>" id="newAccount"
                            class="text-dark" style="font-weight:600;">Create free account</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.getElementById("ccPassword").onfocus = function () {
        //     document.getElementById("passwordmessage").style.display = "block";
        // }

        // document.getElementById("ccPassword").onblur = function () {
        //     document.getElementById("passwordmessage").style.display = "none";
        // }

        function validEmail(input) {
            const emailError = document.getElementById("mail_err");
            if (input.value != "") {
                emailError.textContent = "";
            }
        }

        function validePassword(input) {
            const passwordError = document.getElementById("password_err");
            if (input.value != "") {
                passwordError.textContent = "";
            }

            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(input.value)) {
                document.getElementById("passwordmessage").style.display = "block";
            } else {
                document.getElementById("passwordmessage").style.display = "none";
            }
        }

        function validateLogin() {
            var email = document.getElementById("ccEmail").value;
            var password = document.getElementById("ccPassword").value;

            if (email == "") {
                document.getElementById("mail_err").innerHTML = "Mail address must be filled out.";
                return false;
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                document.getElementById("mail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                return false;
            } else {
                document.getElementById("mail_err").innerHTML = "";
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

</body>

</html>