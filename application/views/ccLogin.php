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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="d-flex ">
        <div class="card d-none d-md-block">
            <img src="<?php echo base_url(); ?>assets/ccbglogin.png" alt="Background"
                class="h-100 w-md-50 w-lg-75 w-100">
            <div class="card-img-overlay d-flex align-items-center justify-content-center mt-0 pt-0">
                <img src="<?php echo base_url(); ?>assets/cclogin.png" alt="Overlay" class="img-fluid">
            </div>
        </div>

        <div class="mx-sm-5 p-5">
            <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="logo" class="img-fluid">
            <p class="pt-2" style="font-size:40px;font-weight:500;color:#0079AD;">Chief Consultant Login</p>
            <p class="" style="font-size:24px;font-weight:600;">Welcome back 👋</p>
            <p class="" style="font-size:18px;font-weight:400;">Empowering chief practitioners to provide <br>
                personalized online diabetes consultations <br> for comprehensive patient care.
            </p>
            <form action="#" method="post" name="ccloginform">
                <div class="mb-3">
                    <label for="ccemail" class="form-label">Email address</label>
                    <input type="text" name="ccemail" id="ccemail" placeholder="example@gmail.com"
                        class="form-control rounded-pill p-3">
                </div>
                <div class="mb-3">
                    <label for="ccpassword" class="form-label">Password</label>
                    <input type="password" name="ccpassword" id="ccpassword" placeholder="password"
                        class="form-control rounded-pill p-3">
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="check" name="check" value="1">
                    <label for="check"> Remember me</label>
                </div>

                <button class="border-0 rounded-pill text-light mt-4 px-5 py-3"
                    style="background-color:#0079AD;font-size:16px;font-weight:600;">Login</button>
            </form>

            <p class="mt-3" style="font-size:18px;font-weight:400;">Don't have an account? <a href="#"
                    class="text-decoration-none text-dark" style="font-weight:600;">Create free account</a></p>
        </div>
    </div>
</body>

</html>