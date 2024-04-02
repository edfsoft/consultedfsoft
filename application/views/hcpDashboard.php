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
        #patientPincode::-webkit-inner-spin-button,
        #patientAltMobile::-webkit-outer-spin-button,
        #patientAltMobile::-webkit-inner-spin-button,
        #patientId::-webkit-outer-spin-button,
        #patientId::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .timeButton.highlighted {
            background-color: blue;
            color: white;
        }

        .highlight {
            background-color: black;
            color: white;
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

                    <img src="<?php echo base_url(); ?>assets/happyPatients1.png" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />

                    <div class="text-dark w-25 d-none d-md-block me-2 my-auto">
                    Dr.<?php echo $_SESSION['hcpsName']; ?>
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
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url() . "Healthcareprovider/myProfile" ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a href="<?php echo base_url() . "Healthcareprovider/logout" ?>"
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
                <a class="" href="<?php echo base_url() . "Healthcareprovider/logout" ?>"
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
                                    320
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon2.svg" alt="icon2" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Today Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    25
                                </p>
                                <p style="font-size: 16px"><?php echo date("d - m - Y") ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon3.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Today Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    19
                                </p>
                                <p style="font-size: 16px"><?php echo date("d - m - Y") ?></p>
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
                                        <i class="bi bi-plus-square-fill"></i> Add Patient
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
                                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                                    <p class="" onclick="highlightRow(this)"><i
                                                            class="bi bi-three-dots-vertical"></i></p>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li><a class="px-1 "
                                                            href="<?php echo base_url() . "Healthcareprovider/patientdetails" ?>"><button
                                                                type="button" class="btn btn-success"><i class="bi bi-eye"></i>
                                                                View</button></a>
                                                        <a class="px-1 " href="#"><button type="button"
                                                                class="btn btn-secondary"><i class="bi bi-pencil"></i>
                                                                Edit</button></a>
                                                        <a onclick="return confirm('Are you sure you want to delete?')"
                                                            href="#"><button type="button" class="btn btn-danger"><i
                                                                    class="bi bi-trash"></i> Delete</button></a>
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
                <script>
                    function highlightRow(element) {
                        // Remove highlight class from all rows
                        var rows = document.querySelectorAll('tr.highlight');
                        rows.forEach(function (row) {
                            row.classList.remove('highlight');
                        });
                        // Add highlight class to current row
                        element.closest('tr').classList.add('highlight');
                    }

                    function removeHighlight(element) {
                        // Remove highlight class when dropdown menu is clicked
                        var row = element.closest('tr');
                        row.classList.remove('highlight');
                    }</script>
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
                                                enctype="multipart/form-data" method="POST" oninput="clearErrorPatientDetails()">
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
                                                            placeholder="Siva">
                                                        <div id="patientName_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientLastName">Last Name</label>
                                                        <input type="text" class="form-control" id="patientLastName"
                                                            name="patientLastName" placeholder="Kumar">
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
                                                        <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                            Number</label>
                                                        <input type="number" class="form-control" id="patientAltMobile"
                                                            name="patientAltMobile" placeholder="9876543210">
                                                        <!-- <div id="patientMobile_err" class="text-danger pt-1"></div> -->
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
                                                        <label class="form-label" for="marriedSince">Married Since</label>
                                                        <input type="date" class="form-control" id="marriedSince"
                                                            name="marriedSince">
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
                                                        Information
                                                    </p>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="additionalContact">Emergency Contact
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
                                                        <label class="form-label" for="patientDiagonsis">Diagonsis</label>
                                                        <input type="text" class="form-control" id="patientDiagonsis"
                                                            name="patientDiagonsis" required>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="medicalReceipts">Medical Receipts</label>
                                                        <input type="file" class="form-control" id="medicalReceipts"
                                                            name="medicalReceipts">
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="medicalReports">Attach Medical
                                                            Reports</label>
                                                        <input type="file" class="form-control" id="medicalReports"
                                                            name="medicalReports">
                                                    </div>
                                                    <!-- <div class="form-group pb-3">
                                                        <button class="btn text-light" style="background-color: #00ad8e;">
                                                            Add</button>
                                                    </div> -->

                                                    <input type="hidden" name="referedDoctor" id="referedDoctor"
                                                        value="Seesion doctor name">

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
        } else if ($method == "patientDetails") {
            ?>

                        <script>
                            document.getElementById('patients').style.color = "#87F7E3";
                        </script>

                        <section>
                            <div class="card shadow-none rounded">
                                <div class="card-body p-5">
                                    <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>" class="float-end text-dark"><i
                                            class="bi bi-arrow-left"></i> Back</a>
                                    <div class="d-sm-flex justify-content-evenly mt-2 mb-5">
                                        <div class="ps-sm-5">
                                            <p style="font-size:24px;font-weight:500;">Anand Kumar | EDF000001</p>

                                            <p><a href="tel:+9894604299" class="text-decoration-none text-dark fs-6">+91
                                                    9894604299</a> | <a href="mailto:example@gmail.com"
                                                    class="text-decoration-none text-dark fs-6">
                                                    example@gmail.com</a></p>
                                            <p>Male | 67 years</p>
                                            <p style="font-weight:500;"> Diabetes </p>
                                        </div>
                                        <img src="<?php echo base_url(); ?>assets/Dr1Senthilvelu.png" alt="Doctor" width="143"
                                            height="143">
                                    </div>


                                </div>
                            </div>
                            </div>
                        </section>

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
                                                    <i class="bi bi-plus-square-fill"></i> Book Appointment
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
                                                        <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                            ACTION
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
                                                        <td style="font-size: 16px">
                                                            <a href="#"><i class="bi bi-three-dots-vertical"></i></a>
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
                                                        <td style="font-size: 16px">
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

                                                        <form action="xd" name="patientDetails" onsubmit="return validateAppointment()"
                                                            oninput="clearErrorAppointment()">
                                                            <div>
                                                                <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;">
                                                                    Appointments</p>
                                                                <div class="form-group pb-2">
                                                                    <label class="form-label" for="patientId">Patient Id <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="patientId" name="patientId"
                                                                        placeholder="EDF000001">
                                                                    <div id="patientId_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="patientName">Name <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="patientName" name="patientName"
                                                                        placeholder="Gopal">
                                                                    <div id="patientName_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="referalDoctor">Referal Doctor <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="referalDoctor"
                                                                        name="referalDoctor" placeholder="A S Senthilvelu">
                                                                    <div id="referalDoctor_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label pb-2" for="appConsult">Mode of consult <span
                                                                            class="text-danger">*</span></label><br>
                                                                    <input type="radio" id="audio" name="appConsult" value="audio" checked>
                                                                    <label for="audio">Audio</label>
                                                                    <input type="radio" class="ms-5 ps-5" id="video" name="appConsult"
                                                                        value="video">
                                                                    <label for="video">Video</label><br>
                                                                    <div id="appConsult_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="appDate">Date <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control" id="appDate" name="appDate">
                                                                    <div id="appDate_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="dayTime">Part of a day <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" id="dayTime" name="dayTime"
                                                                        onchange="displayTime()">
                                                                        <option value="">Select time</option>
                                                                        <option value="Morning">Morning</option>
                                                                        <option value="Afternoon">Afternoon</option>
                                                                        <option value="Evening">Evening</option>
                                                                        <option value="Night">Night</option>
                                                                    </select>
                                                                    <div id="dayTime_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="py-2" id="morningTime" style="display:none"><i
                                                                        class="bi bi-brightness-alt-high"></i>, Morning Consult time,<br>
                                                                    <button type="button"
                                                                        class="timeButton btn btn-outline-primary my-1 btn btn-outline-primary py-1"
                                                                        value="08:30 AM">08:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:40 AM">08:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:50 AM">08:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:00 AM">09:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:10 AM">09:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:20 AM">09:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:30 AM">09:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:40 AM">09:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:50 AM">09:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:00 AM">10:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:10 AM">10:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:20 AM">10:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:30 AM">10:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:40 AM">10:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:50 AM">10:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:00 AM">11:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:10 AM">11:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:20 AM">11:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:30 AM">11:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:40 AM">11:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="11:50 AM">11:50 AM</button>
                                                                </div>
                                                                <div class="py-2" id="afternoonTime" style="display:none"><i
                                                                        class="bi bi-sun"></i>,
                                                                    Afternoon Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:00 PM">12:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:10 PM">12:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:20 PM">12:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:30 PM">12:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:40 PM">12:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="12:50 PM">12:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:00 PM">01:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:10 PM">01:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:20 PM">01:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:30 PM">01:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:40 PM">01:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="01:50 PM">01:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:00 PM">02:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:10 PM">02:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:20 PM">02:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:30 PM">02:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:40 PM">02:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="02:50 PM">02:50 PM</button>
                                                                </div>
                                                                <div class="py-2" id="eveningTime" style="display:none"><i
                                                                        class="bi bi-brightness-alt-high"></i>, Evening Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="05:30 PM">05:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="05:40 PM">05:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="05:50 PM">05:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:00 PM">06:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:10 PM">06:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:20 PM">06:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:30 PM">06:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:40 PM">06:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="06:50 PM">06:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:00 PM">07:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:10 PM">07:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:20 PM">07:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:30 PM">07:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:40 PM">07:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="07:50 PM">07:50 PM</button>
                                                                </div>
                                                                <div class="py-2" id="nightTime" style="display:none"><i
                                                                        class="bi bi-moon-stars"></i>, Night Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:00 PM">08:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:10 PM">08:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:20 PM">08:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:30 PM">08:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:40 PM">08:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="08:50 PM">08:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:00 PM">09:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:10 PM">09:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:20 PM">09:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:30 PM">09:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:40 PM">09:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="09:50 PM">09:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:00 PM">10:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-primary my-1"
                                                                        value="10:10 PM">10:10 PM</button>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="appTime">Time <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="appTime" name="appTime"
                                                                        placeholder="Select time" readonly>
                                                                    <div id="appTime_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="appReason">Patient's Complaint <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="appReason" name="appReason"
                                                                        placeholder="Regular followups">
                                                                    <div id="appReason_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <!-- Payment -->
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="pay">Payment <span
                                                                            class="text-danger">******</span></label>
                                                                    <input type="text" class="form-control" id="pay" name="pay"
                                                                        placeholder="Add payment details">
                                                                </div>

                                                                <button type="submit" class="btn text-light next float-end mt-2"
                                                                    style="background-color: #00ad8e;">Confirm </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <script>
                                    var dateInput = document.getElementById('appDate');
                                    var today = new Date();
                                    var dd = String(today.getDate()).padStart(2, '0');
                                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                                    var yyyy = today.getFullYear();
                                    var minDate = yyyy + '-' + mm + '-' + dd;
                                    dateInput.setAttribute('min', minDate);


                                    // var timeButton = document.querySelectorAll('.timeButton');
                                    // timeButton.forEach(function (button) {
                                    //     button.addEventListener('click', function () {
                                    //         document.getElementById('appTime').value = button.value;
                                    //     });
                                    // });
                                    var buttons = document.querySelectorAll('.timeButton');

                                    buttons.forEach(function (button) {
                                        button.addEventListener('click', function () {
                                            buttons.forEach(function (btn) {
                                                btn.classList.remove('highlighted');
                                            });
                                            button.classList.add('highlighted');
                                            document.getElementById('appTime').value = button.value;
                                        });
                                    });


                                    function displayTime() {
                                        dayTime = document.getElementById("dayTime").value;
                                        if (dayTime == 'Morning') {
                                            document.getElementById("morningTime").style.display = "block";
                                        } else {
                                            document.getElementById("morningTime").style.display = "none";
                                        }
                                        if (dayTime == 'Afternoon') {
                                            document.getElementById("afternoonTime").style.display = "block";
                                        } else {
                                            document.getElementById("afternoonTime").style.display = "none";
                                        }
                                        if (dayTime == 'Evening') {
                                            document.getElementById("eveningTime").style.display = "block";
                                        } else {
                                            document.getElementById("eveningTime").style.display = "none";
                                        }
                                        if (dayTime == 'Night') {
                                            document.getElementById("nightTime").style.display = "block";
                                        } else {
                                            document.getElementById("nightTime").style.display = "none";
                                        }
                                    }

                                    function clearErrorAppointment() {
                                        var patientId = document.getElementById("patientId").value;
                                        var name = document.getElementById("patientName").value;
                                        var referalDr = document.getElementById("referalDoctor").value;
                                        // var consultMode = document.getElementById("appConsult").value;
                                        var date = document.getElementById("appDate").value;
                                        var dayTime = document.getElementById("dayTime").value;
                                        var time = document.getElementById("appTime").value;
                                        var reason = document.getElementById("appReason").value;

                                        if (patientId != "") {
                                            document.getElementById("patientId_err").innerHTML = "";
                                        }

                                        if (name != "") {
                                            document.getElementById("patientName_err").innerHTML = "";
                                        }

                                        if (referalDr != "") {
                                            document.getElementById("referalDoctor_err").innerHTML = "";
                                        }

                                        // if (consultMode != "") {
                                        //     document.getElementById("appConsult_err").innerHTML = "";
                                        // }

                                        if (date != "") {
                                            document.getElementById("appDate_err").innerHTML = "";
                                        }

                                        if (dayTime != "") {
                                            document.getElementById("dayTime_err").innerHTML = "";
                                        }

                                        if (time != "") {
                                            document.getElementById("appTime_err").innerHTML = "";
                                        }

                                        if (appReason != "") {
                                            document.getElementById("appReason_err").innerHTML = "";
                                        }
                                    }

                                    function validateAppointment() {
                                        var patientId = document.getElementById("patientId").value;
                                        var name = document.getElementById("patientName").value;
                                        var referalDr = document.getElementById("referalDoctor").value;
                                        // var consultMode = document.getElementById("appConsult").value;
                                        var date = document.getElementById("appDate").value;
                                        var dayTime = document.getElementById("dayTime").value;
                                        var time = document.getElementById("appTime").value;
                                        var reason = document.getElementById("appReason").value;

                                        if (patientId == "") {
                                            document.getElementById("patientId_err").innerHTML = "Id must be filled out.";
                                            document.getElementById("patientId").focus();
                                            return false;
                                        } else {
                                            document.getElementById("patientId_err").innerHTML = "";
                                        }

                                        if (name == "") {
                                            document.getElementById("patientName_err").innerHTML = "Name must be filled out.";
                                            document.getElementById("patientName").focus();
                                            return false;
                                        } else {
                                            document.getElementById("patientName_err").innerHTML = "";
                                        }

                                        if (referalDr == "") {
                                            document.getElementById("referalDoctor_err").innerHTML = "Referal doctor name must be filled out.";
                                            document.getElementById("referalDoctor").focus();
                                            return false;
                                        } else {
                                            document.getElementById("referalDoctor_err").innerHTML = "";
                                        }

                                        // if (consultMode == "") {
                                        //     document.getElementById("appConsult_err").innerHTML = "Select the mode of consultation.";
                                        //     document.getElementById("appConsult").focus();
                                        //     return false;
                                        // } else {
                                        //     document.getElementById("appConsult_err").innerHTML = "";
                                        // }

                                        if (date == "") {
                                            document.getElementById("appDate_err").innerHTML = "Date must be filled out.";
                                            document.getElementById("appDate").focus();
                                            return false;
                                        } else {
                                            document.getElementById("appDate_err").innerHTML = "";
                                        }

                                        if (dayTime == "") {
                                            document.getElementById("dayTime_err").innerHTML = "Time must be filled out.";
                                            document.getElementById("dayTime").focus();
                                            return false;
                                        } else {
                                            document.getElementById("dayTime_err").innerHTML = "";
                                        }

                                        if (time == "") {
                                            document.getElementById("appTime_err").innerHTML = "Time must be filled out.";
                                            document.getElementById("appTime").focus();
                                            return false;
                                        } else {
                                            document.getElementById("appTime_err").innerHTML = "";
                                        }

                                        if (reason == "") {
                                            document.getElementById("appReason_err").innerHTML = "Complaints must be filled out.";
                                            document.getElementById("appReason").focus();
                                            return false;
                                        } else {
                                            document.getElementById("appReason_err").innerHTML = "";
                                        }
                                        return true;
                                    }
                                </script>
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
                                                    <!-- <a href="#"> <button style="background-color: #00ad8e;" class="text-light border-0 rounded p-2">
                                                        <i class="bi bi-plus-square-fill"></i> Add
                                                    </button></a> -->
                                                </div>
                                                <div class="d-md-flex">
                                                    <div class="card rounded-2 mx-3">
                                                        <div class=" card-body text-center p-4">
                                                            <img src="<?php echo base_url(); ?>assets/Dr1Senthilvelu.png" alt="dr1" width="122"
                                                                height="122" class="mb-4" /> <br>
                                                            <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctorsProfile" ?>"
                                                                onMouseOver="this.style.textDecoration='underline'"
                                                                onMouseOut="this.style.textDecoration='none'" class="text-dark"
                                                                style="font-size: 18px;">
                                                                Dr.A.S.Senthilvelu </a>
                                                            <p style="font-size:16px; color: #00ad8e;">
                                                                Diabetes Consultant
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
            <?php
        } else if ($method == "chiefDoctorProfile") {
            ?>
                                        <script>
                                            document.getElementById('chiefDoctor').style.color = "#87F7E3";
                                        </script>

                                        <section>
                                            <div class="card shadow-none rounded">
                                                <div class="card-body p-4">
                                                    <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctors" ?>"
                                                        class="float-end text-dark"><i class="bi bi-arrow-left"></i> Back</a>
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
                                                    </div>

                                                    <table>
                                                        <tr>
                                                            <td class="col-3 py-2" style="color:#999292">Years of Experience</td>
                                                            <td>30</td>
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
        } else if ($method == "myProfile") {
            ?>
                                            <section>
                                                <div class="card shadow-none rounded">
                                                    <div class="card-body p-4">
                                                        <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="Doctor" width="143"
                                                                height="143">
                                                            <div class="ps-sm-5">
                                                                <p style="font-size:24px;font-weight:500;">Dr.Subash Karan</p>
                                                                <p style="font-size:16px;font-weight:400;color:#00ad8e;">Diabetologist</p>
                                                                <p><a href="tel:+9894604299" style="font-size:16px;font-weight:400;"
                                                                        class="text-decoration-none text-dark fs-6">+91
                                                                        9876543210</a> | <a href="mailto:contact@erodediabetesfoundation.org"
                                                                        style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                                                        drsubashkaran@gmail.com</a></p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-between mt-2 ">
                                                            <p style="font-size:24px;font-weight:400;">Profile Details</p>
                                                            <a href="<?php echo base_url() . "Healthcareprovider/editMyProfile" ?>"><i
                                                                    class="bi bi-pencil-square"></i> Edit</a>
                                                        </div>
                                                        <table>
                                                            <tr>
                                                                <td class="col-5 py-2" style="color:#999292">Years of Experience</td>
                                                                <td>7</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-2" style="color:#999292">Qualification</td>
                                                                <td>MBBS</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-2" style="color:#999292">Specialization</td>
                                                                <td>Diabetologist, Internal Medician Physician</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-2" style="color:#999292">Date of Birth</td>
                                                                <td>20/05/1967</td>
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
                                                                        <label class="form-label" for="dob">Date of Birth</label>
                                                                        <input type="date" class="form-control" id="dob" name="dob">
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
    <!-- <script>
    function blockRightClick(event) {
        event.preventDefault(); 
    }

    document.addEventListener('contextmenu', blockRightClick);
</script> -->

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