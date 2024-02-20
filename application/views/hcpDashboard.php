<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Health Care Provider</title>

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
    <!-- <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet"> -->
    <!-- <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
    <!-- <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet"> -->
    <!-- <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="edf" />
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="input-group form-control rounded-pill d-none d-md-flex w-25 ms-3">
            <span class="px-2 my-auto"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-0" placeholder="Search here" />
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center ms-5">
                <li class="nav-item dropdown d-flex justify-content-evenly">
                    <a href="" class="m-2 me-4">
                        <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a>

                    <img src="<?php echo base_url(); ?>assets/happyPatients1.png" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />

                    <div class="text-dark w-25 d-none d-md-block me-2">
                        Dr.Subash Karan
                    </div>

                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="dropdown-toggle mx-4"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6></h6>
                            <p class="pt-1"></p>
                            <span>Health Care Provider</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center text-danger"
                                onclick="return confirm('Are you sure to logout?')" href="">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <aside id="sidebar" class="sidebar" style="background-color: #00ad8e">
        <ul class="sidebar-nav pt-5 ps-4" id="sidebar-nav">
            <li class="">
                <a class="" href="<?php echo base_url() . "Healthcareprovider/dashboard" ?>" id="dashboard"
                    style="font-size: 18px; font-weight: 400;color:white;">
                    <i class="bi bi-grid pe-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="pt-4">
                <a class="" style="font-size: 18px; font-weight: 400;color:white;" id="patients"
                    href="<?php echo base_url() . "Healthcareprovider/patients" ?>">
                    <div><i class="bi bi-person pe-3"></i> <span>Patients</span></div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="" style="font-size: 18px; font-weight: 400;color:white;" id="appointments">
                    <div>
                        <i class="bi bi-calendar4 pe-3"></i><span>Appointments</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="" style="font-size: 18px; font-weight: 400;color:white;" id="chiefdoctor">
                    <div>
                        <i class="bi bi-person-hearts pe-3"></i>
                        <span>Chief Doctors</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="" style="font-size: 18px; font-weight: 400;color:white;" id="logout"
                    onclick="return confirm('Are you sure to logout?')">
                    <div>
                        <i class="bi bi-box-arrow-in-right pe-3"></i>
                        <span>Log Out</span>
                    </div>
                </a>
            </li>
        </ul>
    </aside>

    <main id="main" class="main">

        <?php
        if ($method == "dashboard") {
            ?>

            <script>
                document.getElementById('dashboard').style.color = "#87F7E3";
            </script>

            <section>
                <p class="ps-2 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-flex justify-content-evenly">
                    <div class="card rounded-5">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon1.svg" alt="icon1" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    2500
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon2.svg" alt="icon2" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    25
                                </p>
                                <p style="font-size: 16px">29 December 2024</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon3.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    19
                                </p>
                                <p style="font-size: 16px">29 December 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-evenly">
                    <div class="card shadow-none rounded-5">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                <i class="bi bi-calendar4 pe-3"></i> Today Appointments
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-4" style="font-size: 18px; font-weight: 500; color: #00ad8e">
                                            Patients
                                        </th>
                                        <th scope="col" style="font-size: 18px; font-weight: 500; color: #00ad8e"
                                            class="px-5">
                                            Name / Diagonsis
                                        </th>
                                        <th scope="col" style="font-size: 18px; font-weight: 500; color: #00ad8e">
                                            Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4">
                                            <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="img"
                                                width="40" height="40" />
                                        </td>
                                        <td class="px-5">
                                            <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Michael
                                                George</span><br /><span style="font-size: 16px">
                                                Diabetes Consultation</span>
                                        </td>
                                        <td style="font-size: 16px">Ongoing</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3">
                                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img"
                                                width="40" height="40" />
                                        </td>
                                        <td class="px-5">
                                            <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Michael
                                                George</span><br /><span style="font-size: 16px">
                                                Diabetes Consultation</span>
                                        </td>
                                        <td style="font-size: 16px">7.15 p.m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="text-decoration-underline">see all</a>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-5">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                <i class="bi bi-person pe-3"></i> Next Patient Details
                            </p>
                            <div class="d-flex justify-content-evenly">
                                <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img" width="40"
                                    height="40" />
                                <p class="px-5">
                                    <span
                                        style="font-size: 16px; font-weight: 500; color: #00ad8e">Lithorish</span><br /><span
                                        style="font-size: 16px">
                                        Diabetes Consultation</span>
                                </p>
                                <p>
                                    <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Patient
                                        ID</span><br /><span style="font-size: 16px"> 10127896</span>
                                </p>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                            D.O.B
                                        </th>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600" class="px-5">
                                            Gender
                                        </th>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                            Weight
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4">
                                            <span style="font-size: 16px; font-weight: 400">29 January 2024</span>
                                        </td>
                                        <td class="px-5">
                                            <span style="font-size: 16px; font-weight: 400">Male</span>
                                        </td>
                                        <td>
                                            <span style="font-size: 16px; font-weight: 400">65Kg</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                            Last Appointment
                                        </th>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600" class="px-5">
                                            Height
                                        </th>
                                        <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                            Reg.Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4">
                                            <span style="font-size: 16px; font-weight: 400">29 January 2024</span>
                                        </td>
                                        <td class="px-5">
                                            <span style="font-size: 16px; font-weight: 400">172cm</span>
                                        </td>
                                        <td>
                                            <span style="font-size: 16px; font-weight: 400">29 January 2024</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                Patient History
                            </p>
                            <p style="
                                font-size: 16px;
                                font-weight: 400;
                                background-color: #e9eeed;
                                padding: 10px;
                            ">
                                Diabetes - Health care
                            </p>
                            <div>
                                <a href="tel:+9944556622"><button style="
                                background-color: #00ad8e;
                                color: white;
                                font-size: 16px;
                            " class="border border-1 rounded p-3">
                                        <i class="bi bi-telephone"></i> +91 99445 56622
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #00ad8e; background-color: white"
                                        class="rounded p-3 ms-2">
                                        <i class="bi bi-folder2"></i> Document
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #00ad8e; background-color: white"
                                        class="rounded p-3 ms-2">
                                        <i class="bi bi-chat-left"></i> Chat
                                    </button></a>
                            </div>
                            <br>
                            <a href="#" class="text-decoration-underline">Last participants</a>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        } else if ($method == "patients") {
            ?>

                <script>
                    document.getElementById('patients').style.color = "#87F7E3";
                </script>

                <section>
                    <div class="card shadow-none rounded">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mt-2 mb-5">
                                <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                    Patients
                                </p>
                                <button style="background-color: #00ad8e; color: white; border: none" class="rounded">
                                    <i class="bi bi-plus-square-fill"></i> Patient
                                </button>
                            </div>

                            <!-- Section-1 -->
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                            PATIENT
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e" class="">
                                            NAME
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                            PATIENT ID
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                            GENDER
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e" class="">
                                            AGE
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                            DIAGNOSIS
                                        </th>
                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                            ACTION
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4">
                                            <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="img" width="40"
                                                height="40" />
                                        </td>
                                        <td class="" style="font-size: 16px">Lithorish</td>
                                        <td style="font-size: 16px">0220946660</td>
                                        <td style="font-size: 16px">Male</td>
                                        <td style="font-size: 16px">62</td>
                                        <td style="font-size: 16px">Diabetes</td>
                                        <td style="font-size: 16px">
                                            <a href="#"><i class="bi bi-three-dots-vertical"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4">
                                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img" width="40"
                                                height="40" />
                                        </td>
                                        <td class="" style="font-size: 16px">Santhosh Kumar</td>
                                        <td style="font-size: 16px">0220946661</td>
                                        <td style="font-size: 16px">Male</td>
                                        <td style="font-size: 16px">65</td>
                                        <td style="font-size: 16px">Diabetes</td>
                                        <td style="font-size: 16px" class="text-center">
                                            <a href="#"><i class="bi bi-three-dots-vertical"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
        <?php } ?>
    </main>
</body>

<!-- Vendor JS Files -->
<script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="assets/vendor/chart.js/chart.umd.js"></script> -->
<!-- <script src="assets/vendor/echarts/echarts.min.js"></script> -->
<!-- <script src="assets/vendor/quill/quill.min.js"></script> -->
<!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->
<!-- <script src="assets/vendor/tinymce/tinymce.min.js"></script> -->
<!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</html>