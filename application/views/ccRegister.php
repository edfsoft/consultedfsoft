<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC Signup Page</title>

    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

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

        @media (max-width: 768px) {
            .fixed-image {
                width: 100%;
                display: none;
            }

            #bgcolor {
                background-color: rgba(0, 121, 173, 0.6);
            }
        }

        #ccMobile::-webkit-outer-spin-button,
        #ccMobile::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row" id="bgcolor">
            <div class="col-md-6">
                <img src="<?php echo base_url(); ?>assets/ccbglogin.png" alt="Fixed Image" class="fixed-image img-fluid">
                <div class="fixed-image-container text-center d-none d-md-block" style="position: fixed; top: 50%; left: 25%; transform: translate(-50%, -50%);">
                    <p style="font-size:40px;font-weight:500;">Welcome to</p>
                    <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="Overlay" class="img-fluid" width="226" height="106">
                    <p class="pt-3" style="font-size:18px;">Sign up to continue as <b>Chief Consultant</b>.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-form mx-lg-5 p-3 p-sm-5">
                    <p class="fs-1 fs-sm-2 pt-2" style="font-weight:500;color:#E01A2B;">Create an Account</p>
                    <p class="" style="font-size:24px;font-weight:600;">CHIEF CONSULTANT</p>
                    <p class="" style="font-size:18px;font-weight:400;">We're thrilled to have you join us on your
                        journey towards better health.</p>
                    <form action="<?php echo base_url() . "Chiefconsultant/ccSignup" ?>" method="post" name="signupform" onsubmit="return validateSignup()" oninput="return removeError()">
                        <div class="mb-3">
                            <label for="ccName" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="ccName" id="ccName" placeholder="Suresh Kumar" class="form-control rounded-pill p-3">
                            <div id="name_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ccMobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="number" name="ccMobile" id="ccMobile" placeholder="9876543210" class="form-control rounded-pill p-3">
                            <div id="mobile_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ccEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="ccEmail" id="ccEmail" placeholder="example@gmail.com" class="form-control rounded-pill p-3">
                            <div id="mail_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ccSpec" class="form-label">Specialization <span class="text-danger">*</span></label>
                            <select class="form-control rounded-pill p-3" id="ccSpec" name="ccSpec">
                                <option value="">Select Specialization</option>
                                <?php
                                foreach ($specializationList as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['specializationName'] ?>">
                                        <?php echo $value['specializationName'] ?> </option>
                                <?php } ?>
                            </select>
                            <div id="spec_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ccPassword" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="ccPassword" id="ccPassword" placeholder="password" class="form-control rounded-pill p-3">
                            <div id="password_err" class="text-danger pt-1"></div>
                        </div>
                        <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                            Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                            and a minimum of 8 characters.</div>
                        <div class="mb-3">
                            <label for="ccCnfmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="ccCnfmPassword" id="ccCnfmPassword" placeholder="confirm password" class="form-control rounded-pill p-3">
                            <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                        </div>

                        <!-- <div class="mb-3">
                            <input type="checkbox" id="check" name="check" value="1">
                            <label for="check">I agree the Terms of Use and Privacy Policy.</label>
                        </div> -->

                        <button type="submit" class="border-0 rounded-pill text-light mt-4 px-4 px-sm-5 py-1 py-sm-3" style="background-color:#0079AD;font-size:16px;font-weight:600;">Sign Up</button>
                    </form>
                    <p class="mt-4" style="font-size:18px;font-weight:400;">Already have an account ? <a href="<?php echo base_url() . "Chiefconsultant/" ?>" class="text-decoration-none text-dark" style="font-weight:600;"> Login</a></p>
                </div>
            </div>
        </div>
    </div>



    <script>
        function validateSignup() {
            var name = document.getElementById("ccName").value;
            var mobile = document.getElementById("ccMobile").value;
            var email = document.getElementById("ccEmail").value;
            var spec = document.getElementById("ccSpec").value;
            var password = document.getElementById("ccPassword").value;
            var confirmpassword = document.getElementById("ccCnfmPassword").value;

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

        document.getElementById("ccPassword").onfocus = function() {
            document.getElementById("passwordmessage").style.display = "block";
        }

        document.getElementById("ccPassword").onblur = function() {
            document.getElementById("passwordmessage").style.display = "none";
        }


        function removeError() {
            var name = document.getElementById("ccName").value;
            var mobile = document.getElementById("ccMobile").value;
            var email = document.getElementById("ccEmail").value;
            var spec = document.getElementById("ccSpec").value;
            var password = document.getElementById("ccPassword").value;
            var confirmpassword = document.getElementById("ccCnfmPassword").value;

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

    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>

    <!-- Hide page source Ctrl + U -->
    <script>
        document.onkeydown = function(e) {
            if (e.ctrlKey && e.keyCode === 85) {
                return false;
            }
        };
    </script>

</body>

</html>