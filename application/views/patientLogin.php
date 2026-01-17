<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #00AD8E;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .left-panel {
            background-color: #00AD8E;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .left-panel img {
            max-width: 100%;
            border-radius: 20px;
        }

        .right-panel {
            background-color: #ffffff;
            padding: 40px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-control {
            border-radius: 30px;
            padding: 14px 20px;
        }

        .login-btn {
            background-color: #00AD8E;
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            border: none;
        }

        .login-btn:hover {
            background-color: #009b80;
        }

        .eye-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        @media (max-width: 991px) {
            .left-panel {
                display: none;
            }
            .right-panel {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid login-wrapper">
    <div class="row h-100">

        <!-- LEFT IMAGE SECTION -->
        <div class="col-lg-6 left-panel">
            <img src="<?php echo base_url(); ?>assets/patientLoginImg.png" alt="Patient Login">
        </div>

        <!-- RIGHT LOGIN FORM -->
        <div class="col-lg-6 right-panel">

            <!-- Logo -->
            <div class="mb-4 pb-0">
                <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="EDF Logo" style="max-width:200px;"><br><br>
            </div>

            <h2 class="fs-1 fs-sm-2 pt-2" style="font-weight:500;color:#00AD8E;">Patient Login</h2>
            <p class="" style="font-size:24px;font-weight:600;">
                Welcome back 👋 </p>
                <p style="font-size:18px;font-weight:400;">Log in to view your medical history and upcoming appointments, 
                    Manage your health information safely in one place.
                </p>

            <form action="<?php echo base_url('Patient/login'); ?>" method="post" onsubmit="return validateLogin();">

                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                    <input type="text" name="patientEmail" id="patientEmail"
                           class="form-control"
                           placeholder="example@gmail.com"
                           oninput="clearEmailError()">
                    <small id="emailError" class="text-danger"></small>
                </div>

                <div class="mb-4 position-relative">
                    <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                    <input type="password" name="patientPassword" id="patientPassword"
                           class="form-control"
                           placeholder="Password"
                           oninput="clearPasswordError()">
                    <i class="bi bi-eye eye-icon" id="togglePassword"></i>
                    <small id="passwordError" class="text-danger"></small>
                </div>

                <button type="submit" class="btn login-btn text-white w-100">
                    Login
                </button>

            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function validateLogin() {
        let email = document.getElementById("patientEmail").value.trim();
        let password = document.getElementById("patientPassword").value.trim();
        let valid = true;

        if (email === "") {
            document.getElementById("emailError").innerText = "Please enter email address.";
            valid = false;
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            document.getElementById("emailError").innerText = "Invalid email address.";
            valid = false;
        }

        if (password === "") {
            document.getElementById("passwordError").innerText = "Please enter password.";
            valid = false;
        }

        return valid;
    }

    function clearEmailError() {
        document.getElementById("emailError").innerText = "";
    }

    function clearPasswordError() {
        document.getElementById("passwordError").innerText = "";
    }

    document.getElementById("togglePassword").addEventListener("click", function () {
        let pwd = document.getElementById("patientPassword");
        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
        pwd.type = pwd.type === "password" ? "text" : "password";
    });
</script>

</body>
</html>
