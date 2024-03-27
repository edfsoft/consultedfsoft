<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Chief Consultant</title>

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
            /* scroll-padding-top: 290px; */
        }

        #patientMobile::-webkit-outer-spin-button,
        #patientMobile::-webkit-inner-spin-button,
        #additionalContact::-webkit-outer-spin-button,
        #additionalContact::-webkit-inner-spin-button,
        #partnerMobile::-webkit-outer-spin-button,
        #partnerMobile::-webkit-inner-spin-button,
        #patientPincode::-webkit-outer-spin-button,
        #patientPincode::-webkit-inner-spin-button,
        #drMobile::-webkit-outer-spin-button,
        #drMobile::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="https://erodediabetesfoundation.org/" target="blank" class="logo d-flex align-items-center">
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

                    <img src="<?php echo base_url(); ?>assets/Dr1Senthilvelu.png" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />

                    <div class="text-dark w-25 d-none d-md-block me-2">
                        Dr.Senthil Velu
                    </div>

                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="dropdown-toggle mx-4"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <!-- <h6></h6> -->
                            <p class="pt-"></p>
                            <span>Chief Consultant</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url() . "Chiefconsultant/myProfile" ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a href="<?php echo base_url() . "Chiefconsultant/logout" ?>"
                                class="dropdown-item d-flex align-items-center text-danger"
                                onclick="return confirm('Are you sure to logout?')">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <aside id="sidebar" class="sidebar" style="background-color:#0079AD">
        <ul class="sidebar-nav pt-5 ps-4" id="sidebar-nav">
            <li class="">
                <a class="" href="<?php echo base_url() . "Chiefconsultant/dashboard" ?>" id="dashboard"
                    style="font-size: 18px; font-weight: 400;color:white;">
                    <i class="bi bi-grid pe-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="pt-4">
                <a class="" style="font-size: 18px; font-weight: 400;color:white;" id="patients"
                    href="<?php echo base_url() . "Chiefconsultant/patients" ?>">
                    <div><i class="bi bi-person pe-3"></i> <span>Patients</span></div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Chiefconsultant/appointments" ?>"
                    style="font-size: 18px; font-weight: 400;color:white;" id="appointments">
                    <div>
                        <i class="bi bi-calendar4 pe-3"></i><span>Appointments</span>
                        <p class="text-dark float-end">
                            <i class="fas fa-envelope fa-2x"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">15</span>
                        </p>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Chiefconsultant/healthCareProviders" ?>"
                    style="font-size: 18px; font-weight: 400;color:white;" id="healthCareProviders">
                    <div>
                        <i class="bi bi-person-hearts pe-3"></i>
                        <span>Health Care Providers</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Chiefconsultant/logout" ?>"
                    style="font-size: 18px; font-weight: 400;color:white;" id="logout"
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
                document.getElementById('dashboard').style.color = "#66D1FF";
            </script>

            <section>
                <p class="ps-2 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-md-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc1.svg" alt="icon1" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Total Doctors
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    25
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc2.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    500
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d - m - Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc3.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Total Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    19
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d - m - Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-lg-flex justify-content-evenly">
                    <div class="card shadow-none rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-calendar4 pe-3"></i> Today Appointments
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col-4" style="font-size: 18px; font-weight: 500; color: #0079AD">
                                                Patients
                                            </th>
                                            <th scope="col" style="font-size: 18px; font-weight: 500; color: #0079AD"
                                                class="px-5">
                                                Name / Diagonsis
                                            </th>
                                            <th scope="col" style="font-size: 18px; font-weight: 500; color: #0079AD">
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
                                                <span style="font-size: 16px; font-weight: 500; color: #0079AD">Michael
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
                                                <span style="font-size: 16px; font-weight: 500; color: #0079AD">Michael
                                                    George</span><br /><span style="font-size: 16px">
                                                    Diabetes Consultation</span>
                                            </td>
                                            <td style="font-size: 16px">7.15 p.m</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="text-decoration-underline">see all</a>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-person pe-3"></i> Next Patient Details
                            </p>
                            <div class="d-flex justify-content-evenly">
                                <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img" width="40"
                                    height="40" />
                                <p class="px-5">
                                    <span
                                        style="font-size: 16px; font-weight: 500; color: #0079AD">Lithorish</span><br /><span
                                        style="font-size: 16px">
                                        Diabetes Consultation</span>
                                </p>
                                <p>
                                    <span style="font-size: 16px; font-weight: 500; color: #0079AD">Patient
                                        ID</span><br /><span style="font-size: 16px"> 10127896</span>
                                </p>
                            </div>
                            <div class="table-responsive">
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
                            </div>
                            <p style="font-size: 16px; font-weight: 500; color: #0079AD">
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
                                background-color: #0079AD;
                                color: white;
                                font-size: 16px;
                            " class="border border-1 rounded p-2 p-md-3">
                                        <i class="bi bi-telephone"></i> +91 99445 56622
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #0079AD; background-color: white"
                                        class="rounded p-2 p-md-3 mt-2 mt-sm-0 mx-sm-2">
                                        <i class="bi bi-folder2"></i> Document
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #0079AD; background-color: white"
                                        class="rounded p-2 p-md-3 mt-2 mt-sm-0">
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
                    document.getElementById('patients').style.color = "#66D1FF";
                </script>

                <section>
                    <div class="card shadow-none rounded">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mt-2 mb-5">
                                <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                    Patients
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                PATIENT
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD" class="">
                                                NAME
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                PATIENT ID
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                GENDER
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD" class="">
                                                AGE
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                DIAGNOSIS
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4">
                                                <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="img"
                                                    width="40" height="40" />
                                            </td>
                                            <td class="" style="font-size: 16px">Lithorish</td>
                                            <td style="font-size: 16px">0220946660</td>
                                            <td style="font-size: 16px">Male</td>
                                            <td style="font-size: 16px">62</td>
                                            <td style="font-size: 16px">Diabetes</td>
                                            <td style="font-size: 16px">
                                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                                    <p class=""><i class="bi bi-three-dots-vertical"></i></p>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow text-center
                                                 ">
                                                    <li><a class="text-center"
                                                            href="<?php echo base_url() . "cc/patientdetails" ?>"><button
                                                                type="button" class="btn btn-success"><i class="bi bi-eye"></i>
                                                                View</button></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4">
                                                <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img"
                                                    width="40" height="40" />
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
                    </div>
                </section>
            <?php
        } else if ($method == "appointments") {
            ?>
                    <script>
                        document.getElementById('appointments').style.color = "#66D1FF";
                    </script>

                    <section>
                        <div class="card shadow-none rounded">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between mt-2 mb-5">
                                    <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                        Appointments
                                    </p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    PATIENT ID
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    PATIENT
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD" class="">
                                                    AGE
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    GENDER
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    DATE
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    TIME
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                    DOCTOR
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 16px">0220946660</td>
                                                <td class="px-4">
                                                    <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="img"
                                                        width="40" height="40" /> Lithorish
                                                </td>
                                                <td style="font-size: 16px">62</td>
                                                <td style="font-size: 16px">Male</td>
                                                <td style="font-size: 16px">29-01-2024</td>
                                                <td class="" style="font-size: 16px">11.00 A.M</td>
                                                <td style="font-size: 16px">Dr.A.S.Senthilvelu
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 16px">0220946661</td>
                                                <td class="px-4">
                                                    <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="img"
                                                        width="40" height="40" /> Santhosh Kumar
                                                </td>
                                                <td style="font-size: 16px">65</td>
                                                <td style="font-size: 16px">Male</td>
                                                <td style="font-size: 16px">30-01-2024</td>
                                                <td class="" style="font-size: 16px">11.30 A.M</td>
                                                <td style="font-size: 16px" class="text-center">
                                                    Dr.A.S.Senthilvelu
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php
        } else if ($method == "hcps") {
            ?>
                        <script>
                            document.getElementById('healthCareProviders').style.color = "#66D1FF";
                        </script>

                        <section>
                            <div class="card rounded">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                            Health Care Providers
                                        </p>
                                    </div>
                                    <div class="d-md-flex">
                                        <div class="card rounded-2 mx-3">
                                            <div class="card-body text-center p-4">
                                                <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="dr1" width="122"
                                                    height="122" />
                                                <p class="pt-4" style="font-size: 18px;">
                                                 Dr.Subash Karan <br>
                                                    <span style="font-size:16px; color: #0079AD;">
                                                        Diabetes Consultant
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card rounded-2 mx-3">
                                            <div class="card-body text-center p-4">
                                                <img src="<?php echo base_url(); ?>assets/Doctor2.png" alt="dr1" width="122"
                                                    height="122" />
                                                <p class="pt-4" style="font-size: 18px;">
                                                    Dr.Kumaresan <br>
                                                    <span style="font-size:16px; color: #0079AD;">
                                                        Diabetes Consultant
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card rounded-2 mx-3">
                                            <div class="card-body text-center p-4">
                                                <img src="<?php echo base_url(); ?>assets/Doctor3.png" alt="dr1" width="122"
                                                    height="122" />
                                                <p class="pt-4" style="font-size: 18px;">
                                                    Dr.Sweethasha <br>
                                                    <span style="font-size:16px; color: #0079AD;">
                                                        Diabetes Consultant
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
            <?php
        } else if ($method == "myProfile") {
            ?>
                            <section>
                                <div class="card shadow-none rounded">
                                    <div class="card-body p-4">
                                        <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                            <img src="<?php echo base_url(); ?>assets/Dr1Senthilvelu.png" alt="Doctor" width="143"
                                                height="143">
                                            <div class="ps-sm-5">
                                                <p style="font-size:24px;font-weight:500;">Dr.A.S.Senthilvelu</p>
                                                <p style="font-size:16px;font-weight:400;color:#0079AD;">Diabetologist</p>
                                                <p><a href="tel:+9894604299" style="font-size:16px;font-weight:400;"
                                                        class="text-decoration-none text-dark fs-6">+91
                                                        9894604299</a> | <a href="mailto:contact@erodediabetesfoundation.org"
                                                        style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                                        contact@erodediabetesfoundation.org</a></p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-2 ">
                                            <p style="font-size:24px;font-weight:400;">Profile Details</p>
                                            <a href="<?php echo base_url() . "Chiefconsultant/editMyProfile" ?>"><i
                                                    class="bi bi-pencil-square"></i> Edit</a>
                                        </div>

                                        <table>
                                            <tr>
                                                <td class="col-3 py-2" style="color:#999292">Years of Experience</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Qualification</td>
                                                <td>MBBS</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Registration detail</td>
                                                <td>Tamil Nadu Medical Council</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Specialization</td>
                                                <td>Diabetologist, Internal Medician Physician</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Membership</td>
                                                <td>Life Member IMA</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Date of Birth</td>
                                                <td>20/05/1967</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2" style="color:#999292">Services</td>
                                                <td>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantiu doloremque
                                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                                    architecto beatae vitae dicta sunt explicabo.</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </section>
            <?php
        } else if ($method == "editMyProfile") {
            ?>
                                <section>
                                    <div class="card shadow-none rounded">
                                        <div class="card-body p-4">
                                            <div class="">
                                                <p style="font-size:24px;font-weight:400;">Edit Profile Details</p>
                                                <form action="#" name="profileEditForm" name="profileEditForm" enctype="multipart/form-data"
                                                    method="POST" onsubmit="return validateDetails()" oninput="clearErrorDetails()">
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="drName">Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="drName" name="drName"
                                                            placeholder="Suresh Kumar">
                                                        <div id="drName_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="drMobile">Mobile <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                            placeholder="9632587410">
                                                        <div id="drMobile_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="drEmail">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                            placeholder="example@gmail.com">
                                                        <div id="drEmail_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="profilePhoto">Profile Photo <span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" id="profilePhoto" name="profilePhoto">
                                                        <div id="profilePhoto_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="yearOfExp">Years of Experience</label>
                                                        <input type="text" class="form-control" id="yearOfExp" name="yearOfExp"
                                                            placeholder="25">
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="qualification">Qualification</label>
                                                        <input type="text" class="form-control" id="qualification" name="qualification"
                                                            placeholder="MBBS">
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="regDetails">Registration detail</label>
                                                        <input type="text" class="form-control" id="regDetails" name="regDetails"
                                                            placeholder="Tamil Nadu Medical Council">
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="membership">Membership</label>
                                                        <input type="text" class="form-control" id="membership" name="membership"
                                                            placeholder="Life member IMA">
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="dob">Date of Birth</label>
                                                        <input type="date" class="form-control" id="dob" name="dob">
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="services">Services</label><br>
                                                        <textarea class="form-control" id="services" name="services" rows="" cols=""
                                                            placeholder="Completed diabetes care under one roof"></textarea>
                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                    </div>
                                                    <button type="submit" class="btn btn-success float-end mt-3 ">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <script>
                                    function clearErrorDetails() {
                                        var doctorName = document.getElementById("drName").value;
                                        var doctorMobile = document.getElementById("drMobile").value;
                                        var doctorEmail = document.getElementById("drEmail").value;
                                        // var photo = document.getElementById("profilePhoto").value;

                                        if (doctorName != "") {
                                            document.getElementById("drName_err").innerHTML = "";
                                        }

                                        if (doctorMobile != "") {
                                            document.getElementById("drMobile_err").innerHTML = "";
                                        }

                                        if (doctorEmail != "") {
                                            document.getElementById("drEmail_err").innerHTML = "";
                                        }

                                        // if (photo != "") {
                                        //     document.getElementById("profilePhoto_err").innerHTML = "";
                                        // }
                                    }
                                </script>
                                <script>
                                    function validateDetails() {
                                        var doctorNmae = document.getElementById("drName").value;
                                        var doctorMobile = document.getElementById("drMobile").value;
                                        var doctorEmail = document.getElementById("drEmail").value;
                                        // var photo = document.getElementById("profilePhoto").value;

                                        if (doctorNmae == "") {
                                            document.getElementById("drName_err").innerHTML = "A name can't be blank.";
                                            document.getElementById("drName").focus();
                                            return false;
                                        } else {
                                            document.getElementById("drName_err").innerHTML = "";
                                        }

                                        if (doctorMobile == "") {
                                            document.getElementById("drMobile_err").innerHTML = "A mobile number can't be blank.";
                                            document.getElementById("drMobile").focus();
                                            return false;
                                        } else {
                                            document.getElementById("drMobile_err").innerHTML = "";
                                        }

                                        if (doctorEmail == "") {
                                            document.getElementById("drEmail_err").innerHTML = "A email id can't be blank.";
                                            document.getElementById("drEmail").focus();
                                            return false;
                                        } else {
                                            document.getElementById("drEmail_err").innerHTML = "";
                                        }

                                        // if (photo == "") {
                                        //     document.getElementById("profilePhoto_err").innerHTML = "Photo must be uploaded.";
                                        //     document.getElementById("profilePhoto").focus();
                                        //     return false;
                                        // } else {
                                        //     document.getElementById("profilePhoto_err").innerHTML = "";
                                        // }

                                        return true;
                                    }
                                </script>

        <?php } ?>
    </main>

    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>

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
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</html>