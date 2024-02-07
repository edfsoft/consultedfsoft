<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCP Login Page</title>

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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex ">
        <div class="card d-none d-md-block">
            <img src="<?php echo base_url(); ?>assets/hcpbglogin.png" alt="Background"
                class="h-100 w-md-50 w-lg-75 w-100">
            <div class="card-img-overlay d-flex align-items-center justify-content-center mt-0 pt-0">
                <img src="<?php echo base_url(); ?>assets/hcplogin.png" alt="Overlay" class="img-fluid">
            </div>
        </div>

        <div class="mx-sm-5 p-5">
            <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="logo" class="img-fluid">
            <p class="pt-2" style="font-size:40px;font-weight:500;color:#00AD8E;">Healthcare Provider Login</p>
            <p class="" style="font-size:24px;font-weight:600;">Welcome back 👋</p>
            <p class="" style="font-size:18px;font-weight:400;">Empowering general practitioners to provide <br>
                personalized online diabetes consultations <br> for comprehensive patient care.
            </p>
            <form action="forms" method="post" name="hcploginform" onsubmit="return validateLogin()">
                <div class="mb-3">
                    <label for="hcpemail" class="form-label">Email address</label>
                    <input type="text" name="hcpemail" id="hcpemail" placeholder="example@gmail.com"
                        oninput="validEmail(this)" class="form-control rounded-pill p-3">
                    <div id="mail_err" class="text-danger pt-1"></div>
                </div>
                <div class="mb-3">
                    <label for="hcppassword" class="form-label">Password</label>
                    <input type="password" name="hcppassword" id="hcppassword" placeholder="password"
                        oninput="validePassword(this)" class="form-control rounded-pill p-3">
                    <div id="password_err" class="text-danger pt-1"></div>
                </div>
                <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                    Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number and a minimum
                    of 8 characters.</div>
                <div class="mb-3">
                    <input type="checkbox" id="check" name="check" value="1">
                    <label for="check"> Remember me</label>
                </div>

                <button type="submit" class="border-0 rounded-pill text-light mt-4 px-5 py-3"
                    style="background-color:#00AD8E;font-size:16px;font-weight:600;">Login</button>
            </form>

            <p class="mt-3" style="font-size:18px;font-weight:400;">Don't have an account? <a href="#"
                    class="text-decoration-none text-dark" style="font-weight:600;">Create free account</a></p>
        </div>
    </div>

    <script>
        document.getElementById("hcppassword").onfocus = function () {
            document.getElementById("passwordmessage").style.display = "block";
        }

        document.getElementById("hcppassword").onblur = function () {
            document.getElementById("passwordmessage").style.display = "none";
        }

        function validEmail(input) {
            const emailError = document.getElementById("mail_err");
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(input.value)) {
                emailError.textContent = "Invalid email address. Please enter valid mail address.";
            } else {
                emailError.textContent = "";
            }
        }

        function validePassword(input) {
            const passwordError = document.getElementById("password_err");
            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(input.value)) {
                passwordError.textContent = "Invalid password. Please enter valid password.";
            } else {
                passwordError.textContent = "";
            }
        }

        function validateLogin() {
            var email = document.getElementById("hcpemail").value;
            var password = document.getElementById("hcppassword").value;

            if (email == "") {
                document.getElementById("mail_err").innerHTML = "Mail address must be filled out.";
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
</body>

</html>