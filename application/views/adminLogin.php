<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDF Admin Login Page</title>

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
            background-color: #ebebeb;
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="text-center mt-5">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="logo"
                width="200" height="90"></a>
    </div>
    <div class="d-flex align-middle justify-content-center">
        <div class="card mt-3 p-4 p-sm-5">
            <p class="fs-2 pb-3" style="font-weight:500;">Administrator Login</p>
            <form action="<?php echo base_url() . "Edfadmin/adminLogin" ?>" method="post" name="hcploginform"
                onsubmit="return validateLogin()">
                <div class="mb-3">
                    <label for="adminEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="text" name="adminEmail" id="adminEmail" placeholder="example@gmail.com"
                        oninput="validEmail(this)" class="form-control p-2">
                    <div id="mail_err" class="text-danger pt-1"></div>
                </div>
                <div class="position-relative">
                    <label for="adminPassword" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="adminPassword" id="adminPassword" placeholder="password" oninput="validePassword(this)"
                        class="form-control p-2">
                    <i id="togglePassword" class="bi bi-eye position-absolute end-0 top-50 translate-middle-y mt-3 me-4"
                        style="cursor: pointer;"></i>
                </div>
                <div id="password_err" class="text-danger pt-1"></div>

                <!-- <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                    Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                    and a minimum of 8 characters.</div> -->

                <!-- <div class="d-flex justify-content-between"> -->
                <!-- <a href="#" id="forgotPassword" class="text-danger mt-5">Forgot password?</a> -->
                <button type="submit"
                    class="bg-primary border-0 rounded-1 text-light float-end mt-2 px-4 py-2">Login</button>
                <!-- </div> -->
            </form>
        </div>
    </div>

    <script>
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
        }

        function validateLogin() {
            var email = document.getElementById("adminEmail").value;
            var password = document.getElementById("adminPassword").value;

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
            } else {
                document.getElementById("password_err").innerHTML = "";
            }
        }
    </script>

<script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('adminPassword');
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