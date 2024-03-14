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
            /* scroll-padding-top: 290px; */
        }

        #patientMobile::-webkit-outer-spin-button,
        #patientMobile::-webkit-inner-spin-button,
        #additionalContact::-webkit-outer-spin-button,
        #additionalContact::-webkit-inner-spin-button,
        #partnerMobile::-webkit-outer-spin-button,
        #partnerMobile::-webkit-inner-spin-button,
        #patientPincode::-webkit-outer-spin-button,
        #patientPincode::-webkit-inner-spin-button
         {
            -webkit-appearance: none;
            margin: 0;
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
                <a class="" href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                    style="font-size: 18px; font-weight: 400;color:white;" id="appointments">
                    <div>
                        <i class="bi bi-calendar4 pe-3"></i><span>Appointments</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Healthcareprovider/chiefDoctors" ?>"
                    style="font-size: 18px; font-weight: 400;color:white;" id="chiefDoctor">
                    <div>
                        <i class="bi bi-person-hearts pe-3"></i>
                        <span>Chief Doctors</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="#" style="font-size: 18px; font-weight: 400;color:white;" id="logout"
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
                <div class="d-md-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
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
                    <div class="card rounded-5 mx-2">
                        <div class="card-body text-center d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon2.svg" alt="icon2" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Today Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    25
                                </p>
                                <p style="font-size: 16px">29 December 2024</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon3.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    19
                                </p>
                                <p style="font-size: 16px">29 December 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-lg-flex justify-content-evenly">
                    <div class="card shadow-none rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                <i class="bi bi-calendar4 pe-3"></i> Today Appointments
                            </p>
                            <div class="table-responsive">
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
                            </div>
                            <a href="#" class="text-decoration-underline">see all</a>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-5 mx-1">
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
                            " class="border border-1 rounded p-2 p-md-3">
                                        <i class="bi bi-telephone"></i> +91 99445 56622
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #00ad8e; background-color: white"
                                        class="rounded p-2 p-md-3 mt-2 mt-sm-0 mx-sm-2">
                                        <i class="bi bi-folder2"></i> Document
                                    </button></a>
                                <a href="#"><button style="border: 2px solid #00ad8e; background-color: white"
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
                    document.getElementById('patients').style.color = "#87F7E3";
                </script>

                <section>
                    <div class="card shadow-none rounded">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mt-2 mb-5">
                                <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                    Patients
                                </p>
                                <a href="<?php echo base_url() . "Healthcareprovider/patientform" ?>"> <button
                                        style="background-color: #00ad8e;" class="text-light border-0 rounded p-2">
                                        <i class="bi bi-plus-square-fill"></i> Patient
                                    </button></a>
                            </div>
                            <div class="table-responsive">
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
                                                <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="img"
                                                    width="40" height="40" />
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
        } else if ($method == "patientDetailsForm") {
            ?>

                    <script>
                        document.getElementById('patients').style.color = "#87F7E3";
                    </script>

                    <section>
                        <div class="card shadow-none rounded">
                            <div class="card-body p-4">
                                <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>" class="float-end text-dark"><i
                                        class="bi bi-arrow-left"></i> Back</a>
                                <!-- Form  -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <form action="xd" name="patientDetails" id="multi-step-form"
                                                oninput="clearErrorPatientDetails()">
                                                <div id="step-1">
                                                    <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                        <button
                                                            style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                            class="text-light rounded-circle border-0">1</button> Basic Details
                                                    </p>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientName">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="patientName" name="patientName"
                                                            placeholder="Gopal">
                                                        <div id="patientName_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientLastName">Last Name</label>
                                                        <input type="text" class="form-control" id="patientLastName"
                                                            name="patientLastName" placeholder="Krishna">
                                                        <div id="patientLastName_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientMobile">Moblie Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="patientMobile"
                                                            name="patientMobile" placeholder="9638527410">
                                                        <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientEmail">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input type="mail" class="form-control" id="patientEmail"
                                                            name="patientEmail" placeholder="example@gmail.com">
                                                        <div id="patientEmail_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientGender">Gender <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" id="patientGender" name="patientGender">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <div id="patientGender_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientDob">DOB <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="patientDob"
                                                            onchange="calculateAge()" name="patientDob">
                                                        <div id="patientDob_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-2">
                                                        <label class="form-label">Age</label>
                                                        <div class="d-flex ">
                                                            <p class="pt-1 pe-2">Years: </p>
                                                            <p class="form-control" name="ageYearsOutput" id="ageYearsOutput"
                                                                value="">0</p>
                                                            <p class="pt-1 ps-2 ps-md-5 pe-2">Months: </p>
                                                            <p class="form-control" name="ageMonthsOutput" id="ageMonthsOutput"
                                                                value="">0</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientMatrital">Marital Status</label>
                                                        <select class="form-control" id="patientMatrital" name="patientMatrital">
                                                            <option value="">Select Marital Status</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                        </select>
                                                        <div id="patientMarital_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientBlood">Blood Group <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" id="patientBlood" name="patientBlood">
                                                            <option value="">Select Blood Group</option>
                                                            <option value="A +ve">A +ve</option>
                                                            <option value="A -ve">A -ve</option>
                                                            <option value="B +ve">B +ve</option>
                                                            <option value="B -ve">B -ve</option>
                                                            <option value="O +ve">O +ve</option>
                                                            <option value="O -ve">O -ve</option>
                                                            <option value="AB +ve">AB +ve</option>
                                                            <option value="AB -ve">AB -ve</option>
                                                        </select>
                                                        <div id="patientBlood_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <button class="btn text-light next float-end mt-2"
                                                        style="background-color: #00ad8e;"
                                                        onclick="if (validatePatientDetails()) { nextStep(1); }">Next</button>
                                                </div>

                                                <div id="step-2" style="display:none;">
                                                    <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                        <button
                                                            style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                            class="text-light rounded-circle border-0">2</button> Additional
                                                        Information  </p>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="additionalContact">Additional Contact
                                                            Number</label>
                                                        <input type="number" class="form-control" id="additionalContact"
                                                            name="additionalContact" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientProfessions">Patient's
                                                            Profession</label>
                                                        <input type="text" class="form-control" id="patientProfessions"
                                                            name="patientProfessions" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="partnersName">Partner's Name</label>
                                                        <input type="text" class="form-control" id="partnersName"
                                                            name="partnersName" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="partnerMobile">Partner's Mobile
                                                            Number</label>
                                                        <input type="number" class="form-control" id="partnerMobile"
                                                            name="partnerMobile" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="partnerBlood">Partner's Blood Group</label>
                                                        <select class="form-control" id="partnerBlood" name="partnerBlood">
                                                            <option value="">Select Blood Group</option>
                                                            <option value="A +ve">A +ve</option>
                                                            <option value="A -ve">A -ve</option>
                                                            <option value="B +ve">B +ve</option>
                                                            <option value="B -ve">B -ve</option>
                                                            <option value="O +ve">O +ve</option>
                                                            <option value="O -ve">O -ve</option>
                                                            <option value="AB +ve">AB +ve</option>
                                                            <option value="AB -ve">AB -ve</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientDoorNo">Door Number</label>
                                                        <input type="text" class="form-control" id="patientDoorNo"
                                                            name="patientDoorNo" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientStreet">Street Address</label>
                                                        <input type="text" class="form-control" id="patientStreet"
                                                            name="patientStreet" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientDistrict">District</label>
                                                        <input type="text" class="form-control" id="patientDistrict"
                                                            name="patientDistrict" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientPincode">Pincode</label>
                                                        <input type="number" class="form-control" id="patientPincode"
                                                            name="patientPincode" required>
                                                    </div>


                                                    <div class="d-flex justify-content-between mt-3">
                                                        <button class="btn btn-secondary text-light prev"
                                                            onclick="prevStep(2)">Previous</button>
                                                        <button class="btn text-light next" style="background-color: #00ad8e;"
                                                            onclick="nextStep(2)">Next</button>
                                                    </div>
                                                </div>

                                                <div id="step-3" style="display:none;">
                                                    <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                        <button
                                                            style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                            class="text-light rounded-circle border-0">3</button> Medical Records
                                                    </p>

                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientWeight">Weight</label>
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control" id="patientWeight"
                                                                name="patientWeight" min="0" required>
                                                            <p class="mx-2 my-2">Kg</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientHeight">Height</label>
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control" id="patientHeight"
                                                                name="patientHeight" min="0" required>
                                                            <p class="mx-2 my-2">Cm</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientBp">Blood Pressure</label>
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control" id="patientBp"
                                                                name="patientBp" required>
                                                            <p class="mx-2 my-2">mmHg</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientsCholestrol">Cholestrol</label>
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control" id="patientsCholestrol"
                                                                name="patientsCholestrol" min="0" required>
                                                            <p class="mx-2 my-2">mg/dl</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientBsugar">Blood Sugar</label>
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control" id="patientBsugar"
                                                                name="patientBsugar" min="0" required>
                                                            <p class="mx-2 my-2">mmol/L</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="medicalReceipts">Medical Receipts</label>
                                                        <input type="text" class="form-control" id="medicalReceipts"
                                                            name="medicalReceipts">
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="medicalReports">Attach Medical
                                                            Reports</label>
                                                        <input type="text" class="form-control" id="medicalReports"
                                                            name="medicalReports">
                                                    </div>
                                                    <!-- <div class="form-group pb-3">
                                                        <button class="btn text-light" style="background-color: #00ad8e;">
                                                            Add</button>
                                                    </div> -->
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <button class="btn btn-secondary text-light prev"
                                                            onclick="prevStep(3)">Previous</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <script>
                        function calculateAge() {
                            var dobInput = document.getElementById('patientDob').value;
                            if (dobInput) {
                                var dob = new Date(dobInput);
                                var today = new Date();
                                var ageYears = today.getFullYear() - dob.getFullYear();
                                var ageMonths = today.getMonth() - dob.getMonth();

                                if (ageMonths < 0 || (ageMonths === 0 && today.getDate() < dob.getDate())) {
                                    ageYears--;
                                    ageMonths = 12 - Math.abs(ageMonths);
                                } else {
                                    ageMonths++;
                                }

                                document.getElementById('ageYearsOutput').innerText = ageYears;
                                document.getElementById('ageMonthsOutput').innerText = ageMonths;
                            } else {
                                document.getElementById('ageYearsOutput').innerText = "";
                                document.getElementById('ageMonthsOutput').innerText = "";
                            }
                        }

                    </script>
                    <script>
                        function nextStep(step) {
                            document.getElementById('step-' + step).style.display = 'none';
                            document.getElementById('step-' + (step + 1)).style.display = 'block';
                        }

                        function prevStep(step) {
                            document.getElementById('step-' + step).style.display = 'none';
                            document.getElementById('step-' + (step - 1)).style.display = 'block';
                        }

                        function clearErrorPatientDetails() {
                            var name = document.getElementById("patientName").value;
                            var mobile = document.getElementById("patientMobile").value;
                            var email = document.getElementById("patientEmail").value;
                            var gender = document.getElementById("patientGender").value;
                            var dob = document.getElementById("patientDob").value;
                            var blood = document.getElementById("patientBlood").value;

                            if (name != "") {
                                document.getElementById("patientName_err").innerHTML = "";
                            }

                            if (mobile != "") {
                                document.getElementById("patientMobile_err").innerHTML = "";
                            }

                            if (email != "") {
                                document.getElementById("patientEmail_err").innerHTML = "";
                            }

                            if (gender != "") {
                                document.getElementById("patientGender_err").innerHTML = "";
                            }

                            if (dob != "") {
                                document.getElementById("patientDob_err").innerHTML = "";
                            }

                            if (blood != "") {
                                document.getElementById("patientBlood_err").innerHTML = "";
                            }
                        }


                        function validatePatientDetails() {
                            var name = document.getElementById("patientName").value;
                            var mobile = document.getElementById("patientMobile").value;
                            var email = document.getElementById("patientEmail").value;
                            var dob = document.getElementById("patientDob").value;
                            var gender = document.getElementById("patientGender").value;
                            var blood = document.getElementById("patientBlood").value;


                            if (name == "") {
                                document.getElementById("patientName_err").innerHTML = "Name must be filled out.";
                                document.getElementById("patientName").focus();
                                return false;
                            } else {
                                document.getElementById("patientName_err").innerHTML = "";
                            }

                            if (mobile == "") {
                                document.getElementById("patientMobile_err").innerHTML = "Mobile must be filled out.";
                                document.getElementById("patientMobile").focus();
                                return false;
                            } else if (!/^(\+\d{1, 3}[- ]?)?\d{10}$/.test(mobile)) {
                                document.getElementById("patientMobile_err").innerHTML = "Enter valid mobile number.";
                                document.getElementById("patientMobile").focus();
                                return false;
                            } else {
                                document.getElementById("patientMobile_err").innerHTML = "";
                            }

                            if (email == "") {
                                document.getElementById("patientEmail_err").innerHTML = "Mail address must be filled out.";
                                document.getElementById("patientEmail").focus();
                                return false;
                            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                                document.getElementById("patientEmail_err").innerHTML = "Enter valid mail address.";
                                document.getElementById("patientEmail").focus();
                                return false;
                            } else {
                                document.getElementById("patientEmail_err").innerHTML = "";
                            }

                            if (gender == "") {
                                document.getElementById("patientGender_err").innerHTML = "Gender must be filled out.";
                                document.getElementById("patientDob").focus();
                                return false;
                            } else {
                                document.getElementById("patientGender_err").innerHTML = "";
                            }

                            if (dob == "") {
                                document.getElementById("patientDob_err").innerHTML = "Dob must be filled out.";
                                document.getElementById("patientGender").focus();
                                return false;
                            } else {
                                document.getElementById("patientDob_err").innerHTML = "";
                            }

                            if (blood == "") {
                                document.getElementById("patientBlood_err").innerHTML = "Blood group must be filled out.";
                                document.getElementById("patientBlood").focus();
                                return false;
                            } else {
                                document.getElementById("patientBlood_err").innerHTML = "";
                            }

                            return true;
                        }
                    </script>
            <?php
        } else if ($method == "appointments") {
            ?>
                        <script>
                            document.getElementById('appointments').style.color = "#87F7E3";
                        </script>

                        <section>
                            <div class="card shadow-none rounded">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mt-2 mb-5">
                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                            Appointments
                                        </p>
                                        <a href="<?php echo base_url() . "Healthcareprovider/appointmentsForm" ?>"> <button
                                                style="background-color: #00ad8e;" class="text-light border-0 rounded p-2">
                                                <i class="bi bi-plus-square-fill"></i> Appointment
                                            </button></a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                        PATIENT ID
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                        PATIENT
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e" class="">
                                                        AGE
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                        GENDER
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                        DATE
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                        TIME
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
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
        } else if ($method == "appointmentsForm") {
            ?>

                            <script>
                                document.getElementById('appointments').style.color = "#87F7E3";
                            </script>

                            <section>
                                <div class="card shadow-none rounded">
                                    <div class="card-body p-4">
                                        <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                            class="float-end text-dark"><i class="bi bi-arrow-left"></i> Back</a>
                                        <!-- Form  -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <form action="xd" name="patientDetails" id="multi-step-form">
                                                        <div id="step-1">
                                                            <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;">
                                                                Appointments</p>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientName">Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="patientName" name="patientName">
                                                                <div id="patientName_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-2">
                                                                <label class="form-label" for="patientId">Patient Id <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" class="form-control" id="patientId" name="patientId"
                                                                    min="0">
                                                                <div id="patientId_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientGender">Gender <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" id="patientGender" name="patientGender">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                                <div id="patientGender_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientDob">DOB <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" id="patientDob" name="patientDob">
                                                                <div id="patientDob_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientMobile">Moblie Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="patientMobile"
                                                                    name="patientMobile">
                                                                <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientEmail">Email <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="mail" class="form-control" id="patientEmail"
                                                                    name="patientEmail">
                                                                <div id="patientEmail_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label class="form-label" for="patientAddress">Address <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="patientAddress"
                                                                    name="patientAddress">
                                                                <div id="patientAddress_err" class="text-danger pt-1"></div>
                                                            </div>
                                                            <button class="btn text-light next float-end mt-2"
                                                                style="background-color: #00ad8e;">
                                                                Submit </button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
            <?php
        } else if ($method == "chiefDoctors") {
            ?>
                                <script>
                                    document.getElementById('chiefDoctor').style.color = "#87F7E3";
                                </script>

                                <section>
                                    <div class="card rounded">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between mt-3 mb-3">
                                                <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                                    Chief Doctors
                                                </p>
                                                <a href="#"> <button style="background-color: #00ad8e;" class="text-light border-0 rounded p-2">
                                                        <i class="bi bi-plus-square-fill"></i> Add
                                                    </button></a>
                                            </div>
                                            <div class="d-md-flex">
                                                <div class="card rounded-2 mx-3">
                                                    <div class="card-body text-center p-4">
                                                        <img src="<?php echo base_url(); ?>assets/Dr1Senthilvelu.png" alt="dr1" width="122"
                                                            height="122" />
                                                        <p class="pt-4" style="font-size: 18px;">
                                                            Dr.A.S.Senthilvelu <br>
                                                            <span style="font-size:16px; color: #00ad8e;">
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
                                                            <span style="font-size:16px; color: #00ad8e;">
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
                                                            <span style="font-size:16px; color: #00ad8e;">
                                                                Diabetes Consultant
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </section>
        <?php } ?>
    </main>
</body>

<!-- Event listener to block right-click -->
<!-- <script>
    function blockRightClick(event) {
        event.preventDefault(); 
    }

    document.addEventListener('contextmenu', blockRightClick);
</script> -->

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