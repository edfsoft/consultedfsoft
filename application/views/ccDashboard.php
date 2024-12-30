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

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }

        /* Prescription Print */
        @page {
            size: A4;
            margin: 20mm;
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

        <!-- <div class="input-group form-control rounded-pill d-none d-md-flex w-25 ms-3">
            <span class="px-2 my-auto"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-0" placeholder="Search here" />
        </div> -->
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center ms-5">
                <li class="nav-item dropdown d-flex justify-content-evenly">
                    <a href="#" class="m-2 me-4">
                        <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a>

                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />

                    <p class="text-dark w-50 d-none d-md-block me-2 my-auto" style="margin:15px;width:auto;">
                        Dr.
                        <?php echo $_SESSION['ccName']; ?>
                    </p>

                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="dropdown-toggle mx-4"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        style="box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2);">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $_SESSION['ccName']; ?> /
                            </h6>
                            <p>
                                <?php echo $_SESSION['ccId']; ?>
                            </p>
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
                        <i class="bi bi-calendar4 pe-3"></i> <span>Appointments</span>
                        <?php if ($appointmentListCount > 0) { ?>
                            <p class="text-dark float-end">
                                <i class="fas fa-envelope fa-2x"></i>
                                <span
                                    class="badge rounded-pill badge-notification bg-danger"><?php echo $appointmentListCount ?></span>
                            </p>
                        <?php } ?>
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
                <p class="card ps-3 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-lg-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc1.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon1" />
                            <div class="text-center px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    <?php echo $patientTotal; ?>
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc2.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon2" />
                            <div class="text-center px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Total Verified HCPs
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    <?php echo $totalHcps; ?>
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconcc3.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon3" />
                            <div class="text-center px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                    Today Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #0079AD">
                                    <?php echo $appointmentsTotal; ?>
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d-m-Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-lg-flex justify-content-evenly">
                    <div class="card rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-calendar4 pe-3"></i> Today Appointments
                            </p>
                            <div class="table-responsive">
                                <?php if (isset($appointmentList[0]['id'])) { ?>
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
                                            <?php if (isset($appointmentList[0]['id'])) { ?>
                                                <tr>
                                                    <td class="px-4">
                                                        <?php if (isset($appointmentList[0]['profilePhoto']) && $appointmentList[0]['profilePhoto'] != "No data") { ?>
                                                            <img src="<?php echo base_url() . 'uploads/' . $appointmentList[0]['profilePhoto'] ?>"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[0]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[0]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px">
                                                        <?php echo date('h:i a', strtotime($appointmentList[0]['timeOfAppoint'])); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if (isset($appointmentList[1]['id'])) { ?>
                                                <tr>
                                                    <td class="px-4">
                                                        <?php if (isset($appointmentList[1]['profilePhoto']) && $appointmentList[1]['profilePhoto'] != "No data") { ?>
                                                            <img src="<?php echo base_url() . 'uploads/' . $appointmentList[1]['profilePhoto'] ?>"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[1]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[1]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px">
                                                        <?php echo date('h:i a', strtotime($appointmentList[1]['timeOfAppoint'])); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if (isset($appointmentList[2]['id'])) { ?>
                                                <tr>
                                                    <td class="px-4">
                                                        <?php if (isset($appointmentList[2]['profilePhoto']) && $appointmentList[2]['profilePhoto'] != "No data") { ?>
                                                            <img src="<?php echo base_url() . 'uploads/' . $appointmentList[2]['profilePhoto'] ?>"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[2]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[2]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px">
                                                        <?php echo date('h:i a', strtotime($appointmentList[2]['timeOfAppoint'])); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <p class="m-md-5 px-md-5"><b> No appointments today.</b></p>
                                <?php } ?>
                            </div>
                            <?php if (isset($appointmentList[3]['id'])) { ?>
                                <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                    class="text-decoration-underline">see all</a>
                            <?php } ?>
                        </div>
                    </div>


                    <div class="card rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-person pe-3"></i> Patient Appointment Details
                            </p>
                            <?php if (isset($appointmentList[0]['id'])) { ?>
                                <div class="d-flex justify-content-evenly">
                                    <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                        <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>"
                                            alt="Profile Photo" width="50" height="50" class="rounded-circle">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="50"
                                            height="50" class="rounded-circle">
                                    <?php } ?>
                                    <p class="px-5">
                                        <span style="font-size: 16px; font-weight: 500; color: #0079AD">Name</span><br /><span
                                            style="font-size: 16px">
                                            <?php echo $appointmentList[0]['firstName'], " ", $appointmentList[0]['lastName']; ?></span>
                                    </p>
                                    <p>
                                        <span style="font-size: 16px; font-weight: 500; color: #0079AD">Patient
                                            ID</span><br /><span
                                            style="font-size: 16px"><?php echo $appointmentList[0]['patientId']; ?></span>
                                    </p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                                    Age
                                                </th>
                                                <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                                    Gender
                                                </th>
                                                <th scope="col-4" style="font-size: 16px; font-weight: 600">
                                                    Blood Group
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['age']; ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['gender']; ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo isset($appointmentList[0]['bloodGroup']) ? $appointmentList[0]['bloodGroup'] : '-' ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col-6" style="font-size: 16px; font-weight: 600">
                                                    Diagonsis
                                                </th>
                                                <th scope="col-6" style="font-size: 16px; font-weight: 600">
                                                    Patient HCP ID
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientComplaint']; ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientHcp']; ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <p style="font-size: 16px; font-weight: 500; color: #0079AD">
                                    Patient History
                                </p>
                                <p style="font-size: 16px;font-weight: 400;background-color: #e9eeed;padding: 10px;">
                                    Diabetes - Health care
                                </p> -->
                                <div>
                                    <a href="tel:<?php echo $appointmentList[0]['mobileNumber']; ?>"><button
                                            style=" background-color: #0079AD; color: white; font-size: 16px;"
                                            class="border border-1 rounded p-2 p-md-3">
                                            <i class="bi bi-telephone"></i> +91
                                            <?php echo $appointmentList[0]['mobileNumber']; ?>
                                        </button></a>
                                    <?php if ($appointmentList[0]['documentOne'] != "No data") { ?>
                                        <a href="<?php echo base_url() . 'uploads/' . $appointmentList[0]['documentOne'] ?>"
                                            target="blank"><button style="border: 2px solid #0079AD; background-color: white"
                                                class="rounded p-2 p-md-3 mt-2 mt-sm-0 mx-sm-2">
                                                <i class="bi bi-folder2"></i> Reports
                                            </button></a>
                                    <?php }
                                    if ($appointmentList[0]['documentTwo'] != "No data") { ?>
                                        <a href="<?php echo base_url() . 'uploads/' . $appointmentList[0]['documentTwo'] ?>"
                                            target="blank"><button style="border: 2px solid #0079AD; background-color: white"
                                                class="rounded p-2 p-md-3 mt-2 mt-sm-0">
                                                <i class="bi bi-folder2"></i> Medicines
                                            </button></a>
                                    <?php } ?>
                                </div>
                                <br>
                                <!-- <a href="#" class="text-decoration-underline">Last Appointment</a> -->
                                <?php if ($appointmentList[0]['lastAppDate'] != "") { ?>
                                    <p>Last Appointment Date - <?php echo $appointmentList[0]['lastAppDate']; ?></p>
                                <?php }
                            } else { ?>
                                <p class="m-md-5 px-md-5"><b> No appointments today.</b></p>
                            <?php } ?>
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
                    <div class="card rounded">
                        <div class="card-body p-3 p-sm-4">
                            <div class="d-sm-flex justify-content-between mt-2 mb-3">
                                <p style="font-size: 24px; font-weight: 500">
                                    Patients
                                </p>
                                <div class="input-group" style="width:250px;">
                                    <span class="input-group-text" id="searchIcon">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="searchInputPatients" class="form-control"
                                        placeholder="Search by name" aria-describedby="searchIcon">
                                    <button class="btn btn-outline-secondary" type="button" id="clearSearchPatients">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover text-center" id="PatientList">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">S.NO</th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">ID</th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">NAME</th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">MOBILE
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">GENDER
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">AGE</th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">HCP ID
                                            </th>
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="patientContainer"></tbody>
                                </table>
                            </div>

                            <div class="pagination justify-content-center mt-3" id="paginationContainerPatients"></div>
                        </div>
                    </div>
                </section>

                <script>
                    const itemsPerPagePatients = 10;
                    const patientDetails = <?php echo json_encode($patientDetails); ?>;
                    let filteredPatientDetails = patientDetails;
                    const initialPagePatients = parseInt(localStorage.getItem('currentPagePatients')) || 1;

                    function displayPatientPage(page) {
                        localStorage.setItem('currentPagePatients', page);
                        const start = (page - 1) * itemsPerPagePatients;
                        const end = start + itemsPerPagePatients;
                        const itemsToShow = filteredPatientDetails.slice(start, end);

                        const patientContainer = document.getElementById('patientContainer');
                        patientContainer.innerHTML = '';

                        if (itemsToShow.length === 0) {
                            const noMatchesRow = document.createElement('tr');
                            noMatchesRow.innerHTML = '<td colspan="9" class="text-center">No matches found.</td>';
                            patientContainer.appendChild(noMatchesRow);
                        } else {
                            itemsToShow.forEach((value, index) => {
                                const patientRow = document.createElement('tr');

                                const prescriptionButton = value.consultedOnce === '1' ?
                                    '<a href="<?php echo base_url(); ?>Chiefconsultant/prescriptionView/' + value.id + '">' +
                                    '<button class="btn btn-secondary">' +
                                    '<i class="bi bi-prescription"></i>' +
                                    '</button>' +
                                    '</a>' :
                                    '<button class="btn btn-secondary" disabled>' +
                                    '<i class="bi bi-prescription"></i>' +
                                    '</button>';

                                patientRow.innerHTML =
                                    '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.patientId + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.firstName + ' ' + value.lastName + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.mobileNumber + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.gender + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.age + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' +
                                    '<a href="<?php echo base_url(); ?>Chiefconsultant/healthCareProvidersProfile/' + value.patientHcpDbId + '"' +
                                    ' class="text-dark" onmouseover="style=\'text-decoration:underline\'" onmouseout="style=\'text-decoration:none\'">' +
                                    value.patientHcp +
                                    '</a>' +
                                    '</td>' +
                                    '<td style="font-size: 16px">' +
                                    '<a href="<?php echo base_url(); ?>Chiefconsultant/patientdetails/' + value.id + '" class="px-1">' +
                                    '<button class="btn btn-success"><i class="bi bi-eye"></i></button>' +
                                    '</a>' +
                                    prescriptionButton +
                                    '</td>';
                                patientContainer.appendChild(patientRow);
                            });
                        }

                        generatePatientPagination(filteredPatientDetails.length, page);
                    }

                    function generatePatientPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPagePatients);
                        const paginationContainer = document.getElementById('paginationContainerPatients');
                        paginationContainer.innerHTML = '';

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        const prevLi = document.createElement('li');
                        prevLi.innerHTML =
                            '<a href="#">' +
                            '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === 1 ? ' disabled' : '') + '>&lt;</button>' +
                            '</a>';
                        prevLi.onclick = () => {
                            if (currentPage > 1) displayPatientPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, currentPage + 2);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML =
                                '<a href="#">' +
                                '<button type="button" class="btn border px-3 py-2' + (i === currentPage ? ' btn-secondary text-light' : '') + '">' + i + '</button>' +
                                '</a>';
                            li.onclick = () => displayPatientPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML =
                            '<a href="#">' +
                            '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === totalPages ? ' disabled' : '') + '>&gt;</button>' +
                            '</a>';
                        nextLi.onclick = () => {
                            if (currentPage < totalPages) displayPatientPage(currentPage + 1);
                        };
                        ul.appendChild(nextLi);

                        paginationContainer.appendChild(ul);
                    }

                    document.getElementById('searchInputPatients').addEventListener('keyup', function () {
                        const searchQuery = this.value.toLowerCase();
                        filteredPatientDetails = patientDetails.filter(item => (item.firstName + ' ' + item.lastName).toLowerCase().includes(searchQuery));
                        displayPatientPage(1);
                    });

                    document.getElementById('clearSearchPatients').addEventListener('click', function () {
                        document.getElementById('searchInputPatients').value = '';
                        filteredPatientDetails = patientDetails;
                        displayPatientPage(1);
                    });

                    displayPatientPage(initialPagePatients);
                </script>

            <?php
        } else if ($method == "patientDetails") {
            ?>

                    <script>
                        document.getElementById('patients').style.color = "#66D1FF";
                    </script>

                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500"> Patient Details</p>
                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                        class="bi bi-arrow-left"></i> Back</button>
                            </div>
                            <div class="card-body p-3 p-sm-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                            <div class="d-sm-flex text-center mb-4">
                                <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                                    <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>" alt="Profile Photo"
                                                        width="140" height="140" class="rounded-circle">
                                <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                        height="140" class="rounded-circle">
                                <?php } ?>
                                                <div class="mt-3 ps-sm-5">
                                                    <p class="text-dark" style="font-weight:600;font-size:20px;">
                                        <?php echo $value['patientId'] ?>
                                                    </p>
                                                    <p class="fs-4 fw-bolder"> <?php echo $value['firstName'] ?>
                                        <?php echo $value['lastName'] ?>
                                                    </p>
                                                    <p> <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> Year(s)</p>
                                                    <!-- <p class="text-dark" style="font-weight:500;font-size:20px;">
                                        <?php echo $value['diagonsis'] ?>
                                                    </p> -->
                                                </div>

                                            </div>

                                            <h5 class="my-3 mt-3 fw-bolder">Personal Details</h5>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Mobile number</span> : <a
                                                        href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?></a></p>
                                                <p><span class="text-secondary ">Alternate mobile</span> :
                                    <?php echo $value['alternateMobile'] ? $value['alternateMobile'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Mail</span> :
                                        <?php
                                        $mailId = isset($value['mailId']) ? $value['mailId'] : null;
                                        ?>
                                                    <a href="mailto:<?php echo $mailId ? $mailId : '#'; ?>"
                                                        class="text-decoration-none text-dark">
                                        <?php echo $mailId ? $mailId : 'Not provided'; ?>
                                                    </a>
                                                </p>
                                                <p><span class="text-secondary ">Blood group</span> :
                                    <?php echo $value['bloodGroup'] ? $value['bloodGroup'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Age </span> :
                                    <?php echo $value['age']; ?>
                                                </p>
                                                <p><span class="text-secondary ">Married status</span> :
                                    <?php echo $value['maritalStatus'] ? $value['maritalStatus'] . " " . $value['marriedSince'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Street address</span> :
                                    <?php echo $value['doorNumber'] ? $value['doorNumber'] . ", " . $value['address'] : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">District</span> :
                                    <?php echo $value['district'] ? $value['district'] . " - " . $value['pincode'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Profession</span> :
                                    <?php echo $value['profession'] ? $value['profession'] : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">Guardian name</span> :
                                    <?php echo $value['partnerName'] ? $value['partnerName'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Guardian mobile</span> :
                                    <?php echo $value['partnerMobile'] ? $value['partnerMobile'] : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">Guardian blood group</span> :
                                    <?php echo $value['partnerBlood'] ? $value['partnerBlood'] : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <h5 class="my-3 mt-4 fw-bolder">Medical Records</h5>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Weight</span> :
                                    <?php echo $value['weight'] ? $value['weight'] . " Kg" : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">Height</span> :
                                    <?php echo $value['height'] ? $value['height'] . " Cm" : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Blood Pressure</span> :
                                    <?php echo $value['bloodPressure'] ? $value['bloodPressure'] . " mmHg" : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">Cholestrol </span> :
                                    <?php echo $value['cholestrol'] ? $value['cholestrol'] . " mg/dl" : "Not provided"; ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Blood Sugar</span> :
                                    <?php echo $value['bloodSugar'] ? $value['bloodSugar'] . " mmol/L" : "Not provided"; ?>
                                                </p>
                                                <p><span class="text-secondary ">Diagonsis / Complaints</span> :
                                    <?php echo $value['diagonsis'] ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Symptoms / Findings</span> :
                                    <?php echo $value['symptoms'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Medicines</span> :
                                    <?php echo $value['medicines'] ? $value['medicines'] : "Not provided"; ?>
                                                </p>
                                            </div>

                            <?php if ($value['documentOne'] != "No data" || $value['documentTwo'] != "No data") { ?>

                                                <h5 class="my-3 mt-4 fw-bolder">Documents / Reports</h5>

                                                <div class="d-md-flex">
                                    <?php if ($value['documentOne'] != "No data") { ?>
                                                        <p class="col-sm-6"><span class="text-secondary ">Medical Receipts</span> : <a
                                                                href="<?php echo base_url() . 'uploads/' . $value['documentOne'] ?>" target="blank"
                                                                rel="Document 1"> <i class="bi bi-box-arrow-up-right"></i> Open</a> </p>
                                    <?php } ?>
                                    <?php if ($value['documentTwo'] != "No data") { ?>
                                                        <p><span class="text-secondary ">Test uploads</span> : <a
                                                                href="<?php echo base_url() . 'uploads/' . $value['documentTwo'] ?>" target="blank"
                                                                rel="Document 2"> <i class="bi bi-box-arrow-up-right"></i> Open</a> </p>
                                    <?php } ?>
                                                </div>
                            <?php }
                            if ($value['consultedOnce'] === "1") {
                                ?>
                                                <h5 class="my-3 mt-4 fw-bolder">Appointments History</h5>
                                                <div class="d-md-flex">
                                                    <p class="col-sm-6"><span class="text-secondary ">Last Appointment Date</span> :
                                        <?php echo date('d-m-Y', strtotime($value['lastAppDate'])); ?>
                                                    </p>
                                                    <p><span class="text-secondary ">Next Followup </span> :
                                        <?php echo date('d-m-Y', strtotime($value['nextAppDate'])); ?>
                                                    </p>
                                                </div>
                                                <?php
                                    $appCount = 0;
                                    foreach ($patientAppHistory as $key => $svalue) {
                                        $appCount++;
                                        ?>
                                                    <div class="card rounded shadow mt-3 p-4">
                                                        <div class="d-sm-flex my-auto " style="font-weight:600;">
                                                            <button style=" width:30px;height:30px;font-weight:500"
                                                                class="text-light bg-secondary rounded-circle border-0 me-3"><?php echo $appCount; ?></button>
                                                            <p class="pe-4 pt-1"><?php echo date('d F Y', strtotime($svalue['dateOfAppoint'])); ?> -
                                                <?php echo date('h:i A', strtotime($svalue['timeOfAppoint'])); ?>
                                                            </p>
                                                            <p class="pe-4 pt-1"><?php echo $svalue['patientComplaint'] ?> </p>
                                                        </div>
                                                        <div class="d-sm-flex pb-1">
                                                            <p class="text-secondary col-md-2 mb-1">CC Id : </p>
                                                            <p class="col-md-9 ps-2"><?php echo $svalue['referalDoctor'] ?></p>
                                                        </div>
                                                        <div class="d-sm-flex pb-1">
                                                            <p class="text-secondary col-md-2 mb-1">HCP Id : </p>
                                                            <p class="col-md-9 ps-2"><?php echo $svalue['patientHcp'] ?></p>
                                                        </div>
                                                        <div class="d-sm-flex pb-1">
                                                            <p class="text-secondary col-md-2 mb-1">Advice Given : </p>
                                                            <p class="col-md-9 ps-2"> <?php echo $svalue['appointmentAdvice'] ?></p>
                                                        </div>
                                                        <p class="text-secondary">Medicines table : </p>

                                                        <table class="table table-bordered table-hover border border-dark text-center">
                                                            <thead class="table-light border border-dark">
                                                                <tr>
                                                                    <th scope="col">Rx</th>
                                                                    <th scope="col">Medicine</th>
                                                                    <th scope="col">Frequency</th>
                                                                    <th scope="col">Duration</th>
                                                                    <th scope="col">Notes</th>
                                                                </tr>
                                                            </thead>
                                            <?php $count = 0;
                                            foreach ($appMedicines as $key => $mvalue) {
                                                if ($mvalue['dateOfAppoint'] == $svalue['dateOfAppoint']) {
                                                    $count++; ?>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><?php echo $count ?> .</td>
                                                                            <td><?php echo $mvalue['medicineName'] ?></td>
                                                                            <td><?php echo $mvalue['frequency'] ?></td>
                                                                            <td><?php echo $mvalue['duration'] . ' ' . $mvalue['duration_unit']; ?></td>
                                                                            <td><?php echo $mvalue['notes'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                <?php }
                                            } ?>
                                                        </table>
                                                    </div>

                                <?php } ?>

                            <?php }
                            } ?>



                                    </div>
                        </div>

                    </section>

                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>

            <?php
        } else if ($method == "prescription") {
            ?>

                        <script>
                            document.getElementById('patients').style.color = "#66D1FF";
                        </script>

                        <section>
                            <div class="card rounded">
                                <div class="d-flex justify-content-between mt-2 p-1 px-3">
                                    <p style="font-size: 24px; font-weight: 500"> Patient Prescription Details</p>
                                    <button onclick="goBack()" class="border-0 bg-light float-end text-dark mb-3"><i
                                            class="bi bi-arrow-left"></i> Back</button>
                                </div>
                            </div>

                            <div class="card rounded p-3 p-lg-5">
                                <div id="pdf-wrapper" class="pdf-wrapper">
                                    <div class="containerheader">
                                        <div class="row mb-3 border-bottom border-dark pb-3">
                                            <div class="col-3 text-center">
                                                <img src="<?php echo base_url(); ?>assets/edf_logo.png" class="img-fluid hospital-logo"
                                                    alt="Hospital Logo" />
                                            </div>
                                            <div class="col-9 ps-3">
                                                <h1 class="fs-2 fw-bold text-success">
                                                    MAARUTHI MEDICAL CENTER AND HOSPITALS
                                                </h1>
                                                <p class="mb-0" style="font-weight:500">Perundurai Road, Erode - 11.</p>
                                                <p class="mb-0" style="font-weight:500">Erode Diabetes Foundation, Erode.</p>
                                            </div>
                                        </div>
                                        <div class="mt- mb-4">
                                            <p style="font-weight:500" class="mb-0"> Dr.<span class="text-uppercase fs-5"
                                                    style="font-weight:600">
                                                    A. S. Senthilvelu</span>, MD.,</p>
                                            <p class="mb-0 mt-1">
                                                Consultant Physician, Diabetologist, Ultrasound, Whole Body Color Doppler
                                                Applications, Echocardiography, Critical Care Physician REGIONAL FACULTY FOR
                                                CERTIFICATE COURSE IN EVIDENCE BASED DIABETES MANAGEMENT (PHFI)
                                            </p>
                                        </div>
                                    </div>

                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>

                                        <div class="container prescriptioncontent" id="prescription">
                                            <div class="row mb-2">
                                                <p class="col-6 mb-1">
                                                    <span class="fw-bold">Patient Name : </span><?php echo $value['firstName'] ?>
                                        <?php echo $value['lastName'] ?>
                                                </p>
                                                <p class="col-sm-6 mb-1">
                                                    <span class="fw-bold">Mobile : </span><?php echo $value['mobileNumber'] ?>
                                                </p>
                                            </div>
                                            <div class="row mb-4">
                                                <p class="col-6 mb-1">
                                                    <span class="fw-bold">Age / Gender : </span><?php echo $value['age'] ?> /
                                        <?php echo $value['gender'] == "Male" ? "M" : "F"; ?>
                                                </p>
                                                <p class="col-sm-6 mb-1">
                                                    <span class="fw-bold">ID : </span><?php echo $value['patientId'] ?>
                                                </p>
                                            </div>
                                            <p>
                                                <span class="fw-bold">Symptoms :
                                                </span><?php echo $value['symptoms'] ? $value['symptoms'] : "Not provided"; ?>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Diagnosis :
                                                </span><?php echo $value['diagonsis'] ? $value['diagonsis'] : "Not provided"; ?>
                                            </p>

                                            <div class="table-responsive row my-4">
                                                <div class="col-12">
                                                    <h5 class="fw-bold">Prescription:</h5>
                                                    <table class="table table-bordered table-hover border border-dark">
                                                        <thead class="table-light border border-dark">
                                                            <tr>
                                                                <th scope="col">Rx</th>
                                                                <th scope="col">Medicine</th>
                                                                <th scope="col">Frequency</th>
                                                                <th scope="col">Duration</th>
                                                                <th scope="col">Notes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td><?php echo $value['medicines'] ?></td>
                                                                <td>1 - 0 - 1</td>
                                                                <td>10 days</td>
                                                                <td>After Food</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <p class="mt-2">
                                                <span class="fw-bold">Advice given :
                                                </span><?php echo $value['adviceGiven'] ? $value['adviceGiven'] : "Not provided"; ?>
                                            </p>
                                            <p>
                                                <span class="fw-bold">Next follow-up date :
                                                </span><?php echo date('d-m-Y', strtotime($value['nextAppDate'])); ?>
                                            </p>
                                        </div>

                        <?php } ?>

                                    <p class="text-end fw-bold mt-5 pt-5">Dr. A. S. Senthil Velu</p>

                                    <div class="footerView text-center mt-4">
                                        <p class="border-top border-dark mb-0 py-2">
                                            <strong>Hospital Timings:</strong> Morning : 8 AM - 2 PM, Evening :
                                            6 PM - 9 PM.
                                        </p>
                                        <p class="border-top border-dark pt-2">
                                            <strong>Phone:</strong> 2250517, 2264949 |
                                            <strong>Mobile:</strong> 97894 94299 |
                                            <strong>E-mail:</strong> a.s.senthilvelu@gmail.com |
                                            <strong>Website:</strong> www.erodediabetesfoundation.org
                                        </p>
                                    </div>
                                </div>

                                <div class="row mt-5 action-buttons">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary d-none d-lg-inline me-3" onclick="printPrescription()">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-secondary" onclick="downloadPDF()">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </section>

                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                        <script>
                            function printPrescription() {
                                const printContents = document.getElementById("pdf-wrapper").innerHTML;
                                const originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                                window.location.reload();
                            }
                        </script>

                        <script>
                            function downloadPDF() {
                                var element = document.getElementById("pdf-wrapper");
                                html2pdf()
                                    .from(element)
                                    .set({
                                        margin: [15, 15, 15, 15],
                                        filename: "prescription.pdf",
                                        html2canvas: { scale: 2 },
                                        jsPDF: { orientation: "portrait", unit: "mm", format: "a4" },
                                    })
                                    .save();
                            }
                        </script>

            <?php
        } else if ($method == "appointments") {
            ?>
                            <script>
                                document.getElementById('appointments').style.color = "#66D1FF";
                            </script>

                            <section>
                                <div class="card rounded">
                                    <div class="card-body p-3 p-sm-4">
                                        <div class="d-flex justify-content-between mt-2 mb-3">
                                            <p style="font-size: 24px; font-weight: 500">
                                                Appointments
                                            </p>
                                        </div>

                            <?php
                            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $items_per_page = 10;

                            $total_items = count($appointmentList);
                            $total_pages = ceil($total_items / $items_per_page);

                            $offset = ($current_page - 1) * $items_per_page;

                            $current_page_items = array_slice($appointmentList, $offset, $items_per_page);

                            if (isset($appointmentList[0]['id'])) {
                                ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover class=" pt-3" text-center" id="appointmentTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                S.NO
                                                            </th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                PATIENT ID
                                                            </th>
                                                            <!-- <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                        PATIENT
                                                    </th> -->
                                                            <!-- <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD" class="">
                                                        AGE
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                        GENDER
                                                    </th> -->
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                DATE
                                                            </th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                TIME
                                                            </th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                HCP ID
                                                            </th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                PURPOSE
                                                            </th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">
                                                                ACTION
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                            <?php
                                            $count = $offset;
                                            foreach ($current_page_items as $key => $value) {
                                                $count++;
                                                ?>
                                                            <tr>
                                                                <td class="pt-3"><?php echo $count; ?>. </td>
                                                                <td style="font-size: 16px" class="pt-3"><a
                                                                        href="<?php echo base_url() . "Chiefconsultant/patientDetails/" . $value['patientDbId']; ?>"
                                                                        class="text-dark" onmouseover="style='text-decoration:underline'"
                                                                        onmouseout="style='text-decoration:none'"><?php echo $value['patientId'] ?></a>
                                                                </td>
                                                                <!-- <td class="px-4"><?php echo $value['patientName'] ?></td> -->
                                                                <td style="font-size: 16px" class="pt-3">
                                                    <?php if (date('Y-m-d', strtotime($value['dateOfAppoint'])) == date('Y-m-d')) {
                                                        echo "<b>Today</b>";
                                                    } else {
                                                        echo date("d-m-Y", strtotime($value['dateOfAppoint']));
                                                    } ?>
                                                                </td>
                                                                <td class="" style="font-size: 16px" class="pt-3">
                                                    <?php echo date('h:i a', strtotime($value['timeOfAppoint'])); ?>
                                                                </td>
                                                                <td style="font-size: 16px" class="pt-3"><a
                                                                        href="<?php echo base_url() . "Chiefconsultant/healthCareProvidersProfile/" . $value['hcpDbId']; ?>"
                                                                        class="text-dark" onmouseover="style='text-decoration:underline'"
                                                                        onmouseout="style='text-decoration:none'"><?php echo $value['patientHcp'] ?></a>
                                                                </td>
                                                                <td style="font-size: 16px" class="pt-3"><?php echo $value['patientComplaint'] ?>
                                                                </td>
                                                                <td style="font-size: 16px" class="d-flex d-lg-block">
                                                        <?php
                                                        date_default_timezone_set('Asia/Kolkata');

                                                        $dateOfAppoint = $value['dateOfAppoint'];
                                                        $timeOfAppoint = $value['timeOfAppoint'];

                                                        $today = date('Y-m-d');
                                                        $currentTime = date('H:i:s');

                                                        $appointmentDateTime = strtotime("$dateOfAppoint $timeOfAppoint");
                                                        $currentDateTime = strtotime("$today $currentTime");

                                                        $isToday = ($dateOfAppoint == $today);

                                                        $isWithin10Minutes = ($currentDateTime <= strtotime('+10 minutes', $appointmentDateTime)) &&
                                                            ($currentDateTime >= $appointmentDateTime);
                                                        $shouldEnableButton = $isToday && $isWithin10Minutes;

                                                        if ($shouldEnableButton) { ?>
                                                                        <a href="<?php echo $value['appointmentLink']; ?>" target="_blank">
                                                                            <button class="btn btn-success">Join</button>
                                                                        </a>
                                                    <?php } else { ?>
                                                                        <button class="btn btn-success" disabled>Join</button>
                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                    <?php if ($current_page > 1): ?>
                                                        <li>
                                                            <a href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                                                <button type="button" class="bg-light border px-3 py-2">
                                                                    < </button>
                                                            </a>
                                                        </li>
                                    <?php endif; ?>

                                        <?php
                                        $start_page = max(1, $current_page - 2);
                                        $end_page = min($total_pages, $current_page + 2);

                                        if ($start_page == 1) {
                                            $end_page = min($total_pages, 5);
                                        }
                                        if ($end_page == $total_pages) {
                                            $start_page = max(1, $total_pages - 4);
                                        }

                                        for ($i = $start_page; $i <= $end_page; $i++): ?>
                                                        <li>
                                                            <a href="?page=<?php echo $i; ?>">
                                                                <button type="button"
                                                                    class="btn border px-3 py-2 <?php echo ($i == $current_page) ? 'btn-secondary text-light' : " "; ?>">
                                                    <?php echo $i; ?></button>
                                                            </a>
                                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($current_page < $total_pages): ?>
                                                        <li>
                                                            <a href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                                                <button type="button" class="bg-light border px-3 py-2">
                                                                    ></button>
                                                            </a>
                                                        </li>
                                    <?php endif; ?>
                                                </ul>
                                            </nav>

                        <?php } else { ?>
                                            <h5 class="text-center my-5"><b> No Appointments Found.</b> </h5>
                        <?php } ?>
                                    </div>
                                </div>
                            </section>

            <?php
        } else if ($method == "hcps") {
            ?>
                                <script>
                                    document.getElementById('healthCareProviders').style.color = "#66D1FF";
                                </script>

                                <!-- Old code as per in design -->
                                <!-- <div class="card rounded">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">
                                            Health Care Providers
                                        </p>
                                    </div>
                                    <div class="d-md-flex">
                                <?php
                                foreach ($hcpDetails as $key => $value) {
                                    ?>
                                            <div class="card rounded-2 mx-3">
                                                <div class=" card-body text-center p-4">
                                                    <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="dr1" width="122"
                                                        height="122" class="mb-4" /> <br>
                                                    <a href="<?php echo base_url() . "Chiefconsultant/healthCareProvidersProfile/" . $value['id']; ?>"
                                                        onMouseOver="this.style.textDecoration='underline'" style="font-size: 18px;"
                                                        onMouseOut="this.style.textDecoration='none'" class="text-dark">
                                                        Dr.
                                            <?php echo $value['hcpName']; ?>
                                                    </a>
                                                    <p style="font-size:16px; color: #0079AD;">
                                            <?php echo $value['hcpSpecialization']; ?>
                                                    </p>
                                                </div>
                                            </div>
                            <?php } ?>
                                    </div>

                                </div>
                            </div> -->

                                <!-- Code to display all cards in single page -->
                                <!-- <div class="container">
                                    <div class="row justify-content-center">
                        <?php foreach ($hcpDetails as $key => $value) { ?>
                                            <div class="card col-lg-4 m-3">
                                                <div class="d-sm-flex justify-content-evenly text-center p-4">
                                    <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                        <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="122" height="122"
                                                            class="rounded-circle my-auto">
                                    <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="122"
                                                            height="122" class="rounded-circle my-auto">
                                    <?php } ?>
                                                    <div>
                                                        <p class="card-title"><b>
                                                <?php echo $value['hcpName']; ?>
                                                            </b> / <br>
                                            <?php echo $value['hcpId']; ?>
                                                        </p>
                                                        <p style="color: #0079AD;"><b>
                                                <?php echo $value['hcpSpecialization']; ?>
                                                            </b></p>
                                                        <a href="<?php echo base_url() . "Chiefconsultant/healthCareProvidersProfile/" . $value['id']; ?>"
                                                            class="btn btn-secondary">Full Details</a>
                                                    </div>
                                                </div>
                                            </div>
                        <?php } ?>
                                    </div>
                                </div> -->

                                <section>
                                    <div class="card rounded">
                                        <div class="d-sm-flex justify-content-between p-3">
                                            <p class="ps-2 m-0" style="font-size: 24px; font-weight: 500">
                                                Health Care Providers
                                            </p>
                                            <div class="input-group pt-2 pt-sm-0" style="width:250px;">
                                                <span class="input-group-text" id="searchIconHcp">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" id="searchInputHcp" class="form-control" placeholder="Search by name"
                                                    aria-describedby="searchIconHcp">
                                                <button class="btn btn-outline-secondary" type="button" id="clearSearchHcp">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row justify-content-center" id="hcpContainer"></div>
                                        <div class="pagination justify-content-center mt-3" id="paginationContainerHcp"></div>
                                    </div>
                                </section>

                                <script>
                                    const itemsPerPageHcp = 6;
                                    const hcpDetails = <?php echo json_encode($hcpDetails); ?>;
                                    let filteredHcpDetails = hcpDetails;
                                    const initialPageHcp = parseInt(localStorage.getItem('currentPageHcp')) || 1;

                                    function displayHcpPage(page) {
                                        localStorage.setItem('currentPageHcp', page);
                                        const start = (page - 1) * itemsPerPageHcp;
                                        const end = start + itemsPerPageHcp;
                                        const itemsToShow = filteredHcpDetails.slice(start, end);

                                        const hcpContainer = document.getElementById('hcpContainer');
                                        hcpContainer.innerHTML = '';

                                        if (itemsToShow.length === 0) {
                                            const noMatchesDiv = document.createElement('div');
                                            noMatchesDiv.className = 'col-12 text-center';
                                            noMatchesDiv.innerHTML = `
                                                                                                                                                                                                                <p>No matches found.</p>
                                                                                                                                                                                                            `;
                                            hcpContainer.appendChild(noMatchesDiv);
                                        } else {
                                            itemsToShow.forEach(value => {
                                                const hcpItem = document.createElement('div');
                                                hcpItem.className = 'card col-lg-4 m-3 hcp-item';
                                                hcpItem.innerHTML = `
                                                                                                                                                                                                                    <div class="d-sm-flex justify-content-evenly text-center p-4">
                                                                                                                                                                                                                        <img src="${value.hcpPhoto ? value.hcpPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg'}" 
                                                                                                                                                                                                                             alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto">
                                                                                                                                                                                                                        <div>
                                                                                                                                                                                                                            <p class="card-title"><b>${value.hcpName}</b> /<br>${value.hcpId}</p>
                                                                                                                                                                                                                            <p style="color: #0079AD;"><b>${value.hcpSpecialization}</b></p>
                                                                                                                                                                                                                            <a href="<?php echo base_url(); ?>Chiefconsultant/healthCareProvidersProfile/${value.id}" 
                                                                                                                                                                                                                               class="btn btn-secondary">Full Details</a>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                `;
                                                hcpContainer.appendChild(hcpItem);
                                            });
                                        }

                                        generateHcpPagination(filteredHcpDetails.length, page);
                                    }

                                    function generateHcpPagination(totalItems, currentPage) {
                                        const totalPages = Math.ceil(totalItems / itemsPerPageHcp);
                                        const paginationContainer = document.getElementById('paginationContainerHcp');
                                        paginationContainer.innerHTML = '';

                                        const ul = document.createElement('ul');
                                        ul.className = 'pagination';

                                        const prevLi = document.createElement('li');
                                        prevLi.innerHTML = `
                                                                                                                                                                                                            <a href="#">
                                                                                                                                                                                                                <button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>&lt;</button>
                                                                                                                                                                                                            </a>
                                                                                                                                                                                                        `;
                                        prevLi.onclick = () => {
                                            if (currentPage > 1) displayHcpPage(currentPage - 1);
                                        };
                                        ul.appendChild(prevLi);

                                        for (let i = 1; i <= totalPages; i++) {
                                            const li = document.createElement('li');
                                            li.innerHTML = `
                                                                                                                                                                                                                <a href="#">
                                                                                                                                                                                                                    <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}">${i}</button>
                                                                                                                                                                                                                </a>
                                                                                                                                                                                                            `;
                                            li.onclick = () => displayHcpPage(i);
                                            ul.appendChild(li);
                                        }

                                        const nextLi = document.createElement('li');
                                        nextLi.innerHTML = `
                                                                                                                                                                                                            <a href="#">
                                                                                                                                                                                                                <button type="button" class="bg-light border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>&gt;</button>
                                                                                                                                                                                                            </a>
                                                                                                                                                                                                        `;
                                        nextLi.onclick = () => {
                                            if (currentPage < totalPages) displayHcpPage(currentPage + 1);
                                        };
                                        ul.appendChild(nextLi);

                                        paginationContainer.appendChild(ul);
                                    }

                                    document.getElementById('searchInputHcp').addEventListener('keyup', function () {
                                        const searchQuery = this.value.toLowerCase();
                                        filteredHcpDetails = hcpDetails.filter(item => item.hcpName.toLowerCase().includes(searchQuery));
                                        displayHcpPage(1);
                                    });

                                    document.getElementById('clearSearchHcp').addEventListener('click', function () {
                                        document.getElementById('searchInputHcp').value = '';
                                        filteredHcpDetails = hcpDetails;
                                        displayHcpPage(1);
                                    });

                                    displayHcpPage(initialPageHcp);
                                </script>

            <?php
        } else if ($method == "hcpsProfile") {
            ?>
                                    <script>
                                        document.getElementById('healthCareProviders').style.color = "#66D1FF";
                                    </script>

                                    <section>
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500"> Health Care Provider's Profile</p>
                                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                                        class="bi bi-arrow-left"></i> Back</button>
                                            </div>
                                            <div class="card-body p-3 p-sm-4">
                            <?php
                            foreach ($hcpDetails as $key => $value) {
                                ?>
                                                    <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                            <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                class="rounded-circle">
                                <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                height="140" class="rounded-circle">
                                <?php } ?>
                                                        <div class="ps-sm-5">
                                                            <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['hcpName']; ?>
                                                            </p>
                                                            <p style="font-size:16px;font-weight:400;color:#0079AD;">
                                        <?php echo $value['hcpSpecialization']; ?>
                                                            </p>
                                                            <p><a href="tel:<?php echo $value['hcpMobile']; ?>" style="font-size:16px;font-weight:400;"
                                                                    class="text-decoration-none text-dark fs-6">+91
                                            <?php echo $value['hcpMobile']; ?>
                                                                </a> | <a href="mailto:<?php echo $value['hcpMail']; ?>"
                                                                    style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                            <?php echo $value['hcpMail']; ?>
                                                                </a></p>
                                                        </div>
                                                    </div>

                                                    <h5 class="fw-bolder pb-3">Profile Details:</h5>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Years of Experience : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpExperience'] ? $value['hcpExperience'] : "-"; ?>
                                                        </p>
                                                    </div>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Qualification : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpQualification'] ? $value['hcpQualification'] : "Not provided"; ?>
                                                        </p>
                                                    </div>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Date of Birth : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpDob'] ? $value['hcpDob'] : "Not provided"; ?>
                                                        </p>
                                                    </div>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Hospital / Clinic Name : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpHospitalName'] ? $value['hcpHospitalName'] : "Not provided"; ?>
                                                        </p>
                                                    </div>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Location : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpLocation'] ? $value['hcpLocation'] : "Not provided"; ?>
                                                        </p>
                                                    </div>
                        <?php } ?>
                                            </div>
                                        </div>
                                    </section>
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>

            <?php
        } else if ($method == "myProfile") {
            ?>

                                        <section>
                                            <div class="card rounded">
                                                <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                    <p style="font-size: 24px; font-weight: 500">
                                                        My Profile </p>
                                                    <a href="<?php echo base_url() . "Chiefconsultant/dashboard" ?>" class="text-dark mt-1"><i
                                                            class="bi bi-arrow-left"></i> Back</a>
                                                </div>
                                                <div class="card-body ps-3 p-sm-4">
                            <?php
                            foreach ($ccDetails as $key => $value) {
                                ?>
                                                        <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php if (isset($value['ccPhoto']) && $value['ccPhoto'] != "") { ?>
                                                                <img src="<?php echo $value['ccPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                    class="rounded-circle">
                                <?php } else { ?>
                                                                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                    height="140" class="rounded-circle">
                                <?php } ?>
                                                            <div class="ps-sm-5">
                                                                <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['doctorName']; ?>
                                                                </p>
                                                                <p style="font-size:16px;font-weight:400;color:#0079AD;">
                                        <?php echo $value['specialization']; ?>
                                                                </p>
                                                                <p><a href="tel:<?php echo $value['doctorMobile']; ?>"
                                                                        style="font-size:16px;font-weight:400;"
                                                                        class="text-decoration-none text-dark fs-6">+91
                                            <?php echo $value['doctorMobile']; ?>
                                                                    </a> | <a href="mailto:<?php echo $value['doctorMail']; ?>"
                                                                        style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                            <?php echo $value['doctorMail']; ?>
                                                                    </a></p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-between mt-2 ">
                                                            <h5 class="fw-bolder pb-3">Profile Details:</h5>
                                                            <a href="<?php echo base_url() . "Chiefconsultant/editMyProfile" ?>"><i
                                                                    class="bi bi-pencil-square"></i> Edit</a>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Years of Experience : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['yearOfExperience'] ? $value['yearOfExperience'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Qualification : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['qualification'] ? $value['qualification'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Registration detail : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['regDetails'] ? $value['regDetails'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Membership : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['membership'] ? $value['membership'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Services : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['services'] ? $value['services'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Date of Birth : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['dateOfBirth'] ? $value['dateOfBirth'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Hospital / Clinic Name : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['hospitalName'] ? $value['hospitalName'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-md-flex pb-1">
                                                            <p class="text-secondary col-md-3 mb-1">Location : </p>
                                                            <p class="col-md-9 ps-2">
                                    <?php echo $value['location'] ? $value['location'] : "Not provided"; ?>
                                                            </p>
                                                        </div>

                        <?php } ?>
                                                </div>
                                            </div>
                                        </section>

            <?php
        } else if ($method == "editMyProfile") {
            ?>

                                            <section>
                                                <div class="card rounded">
                                                    <div class="d-flex justify-content-between mx-2 p-3 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500">
                                                            Edit Profile Details</p>
                                                        <a href="<?php echo base_url() . "Chiefconsultant/myProfile" ?>" class="float-end text-dark mt-2"><i
                                                                class="bi bi-arrow-left"></i> Back</a>
                                                    </div>
                                                    <div class="card-body ps-3 p-sm-4">

                            <?php
                            foreach ($ccDetails as $key => $value) {
                                ?>
                                                            <div class="">
                                                                <div class="position-relative mb-5">

                                    <?php if (isset($value['ccPhoto']) && $value['ccPhoto'] != "") { ?>
                                                                        <img src="<?php echo $value['ccPhoto'] ?>" alt="Profile Photo" width="180" height="180"
                                                                            class="rounded-circle">
                                    <?php } else { ?>
                                                                        <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="180"
                                                                            height="180" class="rounded-circle">
                                    <?php } ?>
                                                                    <button class="position-absolute bottom-0 " type="button" data-toggle="modal"
                                                                        data-target="#updatePhoto"><i class="bi bi-pencil-square"></i></button>
                                                                </div>

                                                                <form action="<?php echo base_url() . "Chiefconsultant/updateMyProfile" ?>"
                                                                    name="profileEditForm" enctype="multipart/form-data" method="POST"
                                                                    onsubmit="return validateDetails()" oninput="clearErrorDetails()" class="col-md-6">
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="drName">Name <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="drName" name="drName"
                                                                            value="<?php echo $value['doctorName']; ?>" placeholder="Suresh Kumar">
                                                                        <div id="drName_err" class="text-danger pt-1"></div>
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="drMobile">Mobile <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                                            value="<?php echo $value['doctorMobile']; ?>" placeholder="9632587410">
                                                                        <div id="drMobile_err" class="text-danger pt-1"></div>
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="drEmail">Email <span class="text-danger">*</span></label>
                                                                        <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                            value="<?php echo $value['doctorMail']; ?>" placeholder="example@gmail.com">
                                                                        <div id="drEmail_err" class="text-danger pt-1"></div>
                                                                    </div>
                                                                    <!-- <div class="form-group pb-3 ">
                                                                        <label class="form-label" for="drPassword">Password <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="d-flex">
                                                                            <input type="password" class="form-control" id="drPassword" name="drPassword"
                                                                                value='<?php echo $value['doctorPassword']; ?>'>
                                                                            <button type="button" class="btn btn-outline-secondary"
                                                                                onclick="togglePasswordVisibility('drPassword', 'visibilityIcon')">
                                                                                <i id="visibilityIcon" class="bi bi-eye-slash"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div id="drPassword_err" class="text-danger pt-1"></div>
                                                                    </div> -->

                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="specialization">Specialization</label>
                                                                        <select class="form-control" id="specialization" name="specialization">
                                                <?php
                                                $defaultSelectedValue = $value['specialization'];
                                                foreach ($specializationList as $key => $cvalue) {
                                                    $selected = ($cvalue['specializationName'] == $defaultSelectedValue) ? 'selected' : ''; ?>
                                                                                <option value="<?php echo $cvalue['specializationName'] ?>" <?php echo $selected ?>>
                                                    <?php echo $cvalue['specializationName'] ?>
                                                                                </option>
                                            <?php } ?>
                                                                        </select>
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="yearOfExp">Years of Experience</label>
                                                                        <input type="text" class="form-control" id="yearOfExp" name="yearOfExp"
                                                                            value="<?php echo $value['yearOfExperience']; ?>" placeholder="25">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="qualification">Qualification</label>
                                                                        <input type="text" class="form-control" id="qualification" name="qualification"
                                                                            value="<?php echo $value['qualification']; ?>" placeholder="MBBS">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="regDetails">Registration detail</label>
                                                                        <input type="text" class="form-control" id="regDetails" name="regDetails"
                                                                            value="<?php echo $value['regDetails']; ?>"
                                                                            placeholder="Tamil Nadu Medical Council">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="membership">Membership</label>
                                                                        <input type="text" class="form-control" id="membership" name="membership"
                                                                            value="<?php echo $value['membership']; ?>" placeholder="Life member IMA">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="dob">Date of Birth</label>
                                                                        <input type="date" class="form-control" id="dob" name="dob"
                                                                            value="<?php echo $value['dateOfBirth']; ?>">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="services">Services</label><br>
                                                                        <textarea class="form-control" id="services" name="services" rows="" cols=""
                                                                            placeholder="Completed diabetes care under one roof"><?php echo $value['services']; ?></textarea>
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="hospitalName">Hospital / Clinic Name</label><br>
                                                                        <input type="text" class="form-control" id="hospitalName" name="hospitalName"
                                                                            value="<?php echo $value['hospitalName']; ?>" placeholder="MMCH">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="form-group pb-3">
                                                                        <label class="form-label" for="location">Location</label><br>
                                                                        <input type="text" class="form-control" id="location" name="location"
                                                                            value="<?php echo $value['location']; ?>" placeholder="Erode">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <button type="reset" class="btn btn-secondary float-start mt-3">Reset</button>
                                                                    <button type="submit" class="btn float-end mt-3 "
                                                                        style="color: white;background-color: #0079AD;">Save</button>
                                                                </form>
                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <script>
                                                function clearErrorDetails() {
                                                    var doctorName = document.getElementById("drName").value;
                                                    var doctorMobile = document.getElementById("drMobile").value;
                                                    var doctorEmail = document.getElementById("drEmail").value;
                                                    // var doctorpassword = document.getElementById("drPassword").value;
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
                                                    if (doctorpassword != "") {
                                                        document.getElementById("drPassword_err").innerHTML = "";
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
                                                    // var doctorPassword = document.getElementById("drPassword").value;
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

                                                    // if (doctorPassword == "") {
                                                    //     document.getElementById("drPassword_err").innerHTML = "A password can't be blank.";
                                                    //     document.getElementById("drPassword").focus();
                                                    //     return false;
                                                    // } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(doctorPassword)) {
                                                    //     document.getElementById("drPassword_err").innerHTML = "Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, 1 number and a minimum of 8 characters.";
                                                    //     document.getElementById("drPassword").focus();
                                                    //     return false;
                                                    // } else {
                                                    //     document.getElementById("drPassword_err").innerHTML = "";
                                                    // }

                                                    // if (photo == "") {
                                                    //     document.getElementById("profilePhoto_err").innerHTML = "Photo must be uploaded.";
                                                    //     document.getElementById("profilePhoto").focus();
                                                    //     return false;
                                                    // } else {
                                                    //     document.getElementById("profilePhoto_err").innerHTML = "";
                                                    // }


                                                }
                                            </script>
                                            <script>
                                                function togglePasswordVisibility(inputId, iconId) {
                                                    var passwordInput = document.getElementById(inputId);
                                                    var visibilityIcon = document.getElementById(iconId);

                                                    if (passwordInput.type === "password") {
                                                        passwordInput.type = "text";
                                                        visibilityIcon.classList.remove("bi-eye-slash");
                                                        visibilityIcon.classList.add("bi-eye");
                                                    } else {
                                                        passwordInput.type = "password";
                                                        visibilityIcon.classList.remove("bi-eye");
                                                        visibilityIcon.classList.add("bi-eye-slash");
                                                    }
                                                }
                                            </script>

        <?php } ?>

        <!-- Popup Update Profile Photo -->
        <div class="modal fade" id="updatePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url() . "Chiefconsultant/updatePhoto" ?>" name="profilePhotoForm"
                            name="profilePhotoForm" enctype="multipart/form-data" method="POST">
                            <label for="ccProfile" class="pb-2">Upload file: </label><br>
                            <input type="file" name="ccProfile" id="ccProfile" accept="image/png ,image/jpg, image/jpeg"
                                required><br><br>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

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

<!-- bootstrap popup link -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- PDF Download link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>



</html>