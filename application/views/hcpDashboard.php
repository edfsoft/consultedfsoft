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

        /* To remove the arrows in the  input type number*/
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
        #patientId::-webkit-inner-spin-button,
        #drMobile::-webkit-outer-spin-button,
        #drMobile::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Appointment time buttons */
        .timeButton.highlighted {
            background-color: #383d3d;
            color: white;
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
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
                        <?php echo $_SESSION['hcpsName']; ?>
                    </p>

                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span class="dropdown-toggle mx-4"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        style="box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2);">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $_SESSION['hcpsName']; ?> /
                            </h6>
                            <p>
                                <?php echo $_SESSION['hcpId']; ?>
                            </p>
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
                        <i class="bi bi-calendar4 pe-3"></i> <span>Appointments</span>
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
                <p class=" card ps-3 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-lg-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon1.svg" alt="icon1" />
                            <div class="px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    <?php echo $patientTotal; ?>
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon2.svg" alt="icon2" />
                            <div class="px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Total Verified CCs
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    <?php echo $totalCcs; ?>
                                </p>
                                <p style="font-size: 16px">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex -4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon3.svg" alt="icon3" />
                            <div class="px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    Today Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
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
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e" class="pb-2">
                                <i class="bi bi-calendar4 pe-3"></i> Today Appointments
                            </p>
                            <div class="table-responsive">
                                <?php if (isset($appointmentList[0]['id'])) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 18px; font-weight: 500; color: #00ad8e">
                                                    Patients
                                                </th>
                                                <th style="font-size: 18px; font-weight: 500; color: #00ad8e" class="px-5">
                                                    Patient ID / Diagonsis
                                                </th>
                                                <th style="font-size: 18px; font-weight: 500; color: #00ad8e">
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
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[0]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[0]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px"><?php echo $appointmentList[0]['timeOfAppoint']; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if (isset($appointmentList[1]['id'])) { ?>
                                                <tr>
                                                    <td class="px-3">
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
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[1]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[1]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px"><?php echo $appointmentList[1]['timeOfAppoint']; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if (isset($appointmentList[2]['id'])) { ?>
                                                <tr>
                                                    <td>
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
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[2]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[2]['patientComplaint']; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px"><?php echo $appointmentList[2]['timeOfAppoint']; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
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
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e" class="pb-2">
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
                                        <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Name</span><br /><span
                                            style="font-size: 16px">
                                            <?php echo $appointmentList[0]['firstName'], $appointmentList[0]['lastName']; ?></span>
                                    </p>
                                    <p>
                                        <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Patient
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
                                                <!-- <th scope="col-4" style="font-size: 16px; font-weight: 600" class="px-5">
                                                    Height
                                                </th> -->
                                                <th scope="col-6" style="font-size: 16px; font-weight: 600">
                                                    Referal Doctor
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientComplaint']; ?></span>
                                                </td>
                                                <!-- <td class="px-5">
                                                    <span style="font-size: 16px; font-weight: 400">172cm</span>
                                                </td> -->
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['referalDoctor']; ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                    Patient History
                                </p>
                                <p style="font-size: 16px;font-weight: 400;background-color: #e9eeed;padding: 10px;">
                                    Diabetes - Health care
                                </p>
                                <div>
                                    <a href="tel:<?php echo $appointmentList[0]['mobileNumber']; ?>"><button
                                            style=" background-color: #00ad8e; color: white; font-size: 16px;"
                                            class="border border-1 rounded p-2 p-md-3">
                                            <i class="bi bi-telephone"></i> +91
                                            <?php echo $appointmentList[0]['mobileNumber']; ?>
                                        </button></a>
                                    <?php if ($appointmentList[0]['documentOne'] != "No data") { ?>
                                        <a href="<?php echo base_url() . 'uploads/' . $appointmentList[0]['documentOne'] ?>"
                                            target="blank"><button style="border: 2px solid #00ad8e; background-color: white"
                                                class="rounded p-2 p-md-3 mt-2 mt-sm-0 mx-sm-2">
                                                <i class="bi bi-folder2"></i> Reports
                                            </button></a>
                                    <?php }
                                    if ($appointmentList[0]['documentTwo'] != "No data") { ?>
                                        <a href="<?php echo base_url() . 'uploads/' . $appointmentList[0]['documentTwo'] ?>"
                                            target="blank"><button style="border: 2px solid #00ad8e; background-color: white"
                                                class="rounded p-2 p-md-3 mt-2 mt-sm-0">
                                                <i class="bi bi-folder2"></i> Medicines
                                            </button></a>
                                    <?php } ?>
                                </div>
                                <br>
                                <a href="#" class="text-decoration-underline">Last Appointment</a>
                            <?php } else { ?>
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
                    document.getElementById('patients').style.color = "#87F7E3";
                </script>

                <section>
                    <div class="card rounded">
                        <div class="d-sm-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500">
                                Patients
                            </p>
                            <div class="input-group my-2 my-sm-0" style="width:250px;">
                                <span class="input-group-text" id="searchIcon">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="searchInputPatients" class="form-control" placeholder="Search by name"
                                    aria-describedby="searchIcon">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchPatients">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <a href="<?php echo base_url() . 'Healthcareprovider/patientform'; ?>">
                                <button style="background-color: #00ad8e;" class="text-light border-0 rounded float-end p-2">
                                    <i class="bi bi-plus-square-fill"></i> Add Patient
                                </button>
                            </a>
                        </div>
                    <?php if (isset($patientList[0]['id'])) {
                        ?>
                            <div class="card-body ps-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table text-center" id="patientTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PHOTO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ID</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">NAME</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">MOBILE
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">GENDER
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">AGE</th>
                                                <!-- <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">DIAGNOSIS</th> -->
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="patientContainer"></tbody>
                                    </table>
                                </div>
                                <div class="pagination justify-content-center mt-3" id="paginationContainerPatients"></div>
                            </div>
                    <?php } else { ?>
                            <h5 class="text-center my-5"><b>No Records Found.</b> </h5>
                    <?php } ?>
                    </div>
                </section>

                <script>
                    const itemsPerPagePatients = 10;
                    const patientDetails = <?php echo json_encode($patientList); ?>;
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
                            noMatchesRow.innerHTML = `
                                                                                                                                                                                                                                                            <td colspan="8" class="text-center">No matches found.</td>
                                                                                                                                                                                                                                                            `;
                            patientContainer.appendChild(noMatchesRow);
                        } else {
                            itemsToShow.forEach((value, index) => {
                                const patientRow = document.createElement('tr');
                                patientRow.innerHTML = `
                                                                                                                                                                                                                                                                <td>${start + index + 1}.</td>
                                                                                                                                                                                                                                                                <td class="px-2">
                                                                                                                                                                                                                                                                    <img src="${value.profilePhoto && value.profilePhoto !== 'No data' ? '<?php echo base_url(); ?>uploads/' + value.profilePhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg'}"
                                                                                                                                                                                                                                                                        alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                <td style="font-size: 16px">${value.patientId}</td>
                                                                                                                                                                                                                                                                <td style="font-size: 16px">${value.firstName} ${value.lastName}</td>
                                                                                                                                                                                                                                                                <td style="font-size: 16px">${value.mobileNumber}</td>
                                                                                                                                                                                                                                                                <td style="font-size: 16px">${value.gender}</td>
                                                                                                                                                                                                                                                                <td style="font-size: 16px">${value.age}</td>
                                                                                                                                                                                                                                                                <td class="d-flex d-lg-block" style="font-size: 16px">
                                                                                                                                                                                                                                                                    <a href="<?php echo base_url(); ?>Healthcareprovider/patientdetails/${value.id}" class="px-1">
                                                                                                                                                                                                                                                                        <button class="btn btn-success"><i class="bi bi-eye"></i></button>
                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                    <a href="<?php echo base_url(); ?>Healthcareprovider/patientformUpdate/${value.id}" class="px-1">
                                                                                                                                                                                                                                                                        <button class="btn btn-secondary"><i class="bi bi-pencil"></i></button>
                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                            `;
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
                        prevLi.innerHTML = `
                                                                                                                                                                                                                                                        <a href="#">
                                                                                                                                                                                                                                                            <button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>&lt;</button>
                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                    `;
                        prevLi.onclick = () => {
                            if (currentPage > 1) displayPatientPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, currentPage + 2);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `
                                                                                                                                                                                                                                                            <a href="#">
                                                                                                                                                                                                                                                                <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}">${i}</button>
                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                        `;
                            li.onclick = () => displayPatientPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML = `
                                                                                                                                                                                                                                                        <a href="#">
                                                                                                                                                                                                                                                            <button type="button" class="bg-light border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>&gt;</button>
                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                    `;
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
        } else if ($method == "patientDetailsForm") {
            ?>
                    <script>
                        document.getElementById('patients').style.color = "#87F7E3";
                    </script>

                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500"> New Patient </p>
                                <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>" class="float-end text-dark"><i
                                        class="bi bi-arrow-left"></i> Back</a>
                            </div>

                            <div class="card-body px-md-4 pb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="<?php echo base_url() . "Healthcareprovider/addPatientsForm" ?>"
                                            name="patientDetails" id="patientDetails" enctype="multipart/form-data" method="POST"
                                            oninput="clearErrorPatientDetails()" onsubmit="return validatePatientDetails()">
                                            <p class="pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">1</button> Basic Details
                                            </p>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientName">First Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="patientName" name="patientName"
                                                    placeholder="E.g. Siva">
                                                <div id="patientName_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientLastName">Last Name</label>
                                                <input type="text" class="form-control" id="" name="patientLastName"
                                                    placeholder="E.g. Kumar">
                                                <div id="patientLastName_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientMobile">Moblie Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="patientMobile" name="patientMobile"
                                                    placeholder="E.g. 9638527410">
                                                <div id="patientMobile_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                    Number</label>
                                                <input type="number" class="form-control" id="patientAltMobile"
                                                    name="patientAltMobile" placeholder="E.g. 9876543210">
                                                <div id="patientMobile_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientEmail">Email</label>
                                                <input type="mail" class="form-control" id="patientEmail" name="patientEmail"
                                                    placeholder="E.g. example@gmail.com">
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
                                            <div class="form-group pb-2">
                                                <label class="form-label" for="patientAge">Age <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="patientAge" name="patientAge" min="0"
                                                    placeholder="E.g. 41">
                                                <div id="patientAge_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientBlood">Blood Group</label>
                                                <select class="form-select" id="patientBlood" name="patientBlood">
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
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientMarital">Marital Status</label>
                                                <select class="form-select" id="patientMarital" name="patientMarital">
                                                    <option value="">Select Marital Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                                <div id="patientMarital_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="marriedSince">Married Since</label>
                                                <input type="text" class="form-control" id="marriedSince" name="marriedSince"
                                                    placeholder="E.g. 2012">
                                            </div>

                                            <p class="pt-4 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">2</button> Additional
                                                Information
                                            </p>

                                            <div class="form-group pb-3">
                                                <label class="form-label" for="profilePhoto">Profile Photo</label>
                                                <input type="file" class="form-control" id="profilePhoto" name="profilePhoto"
                                                    accept="image/png ,image/jpg, image/jpeg">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientProfessions">Patient's
                                                    Profession</label>
                                                <input type="text" class="form-control" id="patientProfessions"
                                                    name="patientProfessions" placeholder="E.g. IT employee">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientDoorNo">Door Number</label>
                                                <input type="text" class="form-control" id="patientDoorNo" name="patientDoorNo"
                                                    placeholder="E.g. 96">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientStreet">Street Address</label>
                                                <input type="text" class="form-control" id="patientStreet" name="patientStreet"
                                                    placeholder="E.g. Abc street">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientDistrict">District</label>
                                                <input type="text" class="form-control" id="patientDistrict" name="patientDistrict"
                                                    placeholder="E.g. Erode">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientPincode">Pincode</label>
                                                <input type="number" class="form-control" id="patientPincode" name="patientPincode"
                                                    placeholder="E.g. 638001">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="partnersName">Guardian's Name </label>
                                                <input type="text" class="form-control" id="partnersName" name="partnersName"
                                                    placeholder="E.g. Rohith">
                                                <div id="partnersName_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="partnerMobile">Guardian's Mobile </label>
                                                <input type="number" class="form-control" id="partnerMobile" name="partnerMobile"
                                                    placeholder="E.g. 9874563210">
                                                <div id="partnerMobile_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="partnerBlood">Guardian's Blood Group</label>
                                                <select class="form-select" id="partnerBlood" name="partnerBlood">
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
                                            <p class="pt-4 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">3</button> Medical Records
                                            </p>

                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientWeight">Weight </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" id="patientWeight"
                                                        name="patientWeight" min="0" placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">Kg</p>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientHeight">Height</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" id="patientHeight"
                                                        name="patientHeight" min="0" placeholder="E.g. 135">
                                                    <p class="mx-2 my-2">Cm</p>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientBp">Blood Pressure</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" id="patientBp" name="patientBp"
                                                        placeholder="E.g. 100">
                                                    <p class="mx-2 my-2">mmHg</p>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientsCholestrol">Cholestrol</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" id="patientsCholestrol"
                                                        name="patientsCholestrol" min="0" placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">mg/dl</p>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientBsugar">Blood Sugar </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control" id="patientBsugar"
                                                        name="patientBsugar" min="0" placeholder="E.g. 200">
                                                    <p class="mx-2 my-2">mmol/L</p>
                                                </div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientDiagonsis">Diagonsis <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" name="patientDiagonsis" id="patientDiagonsis" cols=""
                                                    rows="" placeholder="E.g. Diabetes checkup"></textarea>
                                                <div id="diagonsis_err" class="text-danger pt-1"></div>
                                            </div>

                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientSymptoms">Symptoms / Complaints <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="patientSymptoms" name="patientSymptoms" readonly
                                                    class="form-control" hidden>
                                                <div class="selected-values-container mb-2 p-2" id="selectedValuesContainer"> </div>
                                                <select class="form-select" id="multiSelectSymptoms">
                                                    <option value="" selected disabled>Select Symptoms</option>
                                                <?php
                                                $count = 0;
                                                foreach ($symptomsList as $key => $value) {
                                                    $count++;
                                                    ?>
                                                        <option value="<?php echo $value['symptomsName'] ?>">
                                                    <?php echo $count . '. ' . $value['symptomsName'] ?>
                                                        </option>

                                            <?php } ?>
                                                </select>
                                                <div id="symptoms_err" class="text-danger pt-1"></div>
                                            </div>
                                            <!-- <div class="form-group pb-3">
                                                <label class="form-label" for="patientMedicines">Medicines</label>
                                                <select class="form-select" id="patientMedicines" name="patientMedicines"
                                                    oninput="addNewMedicines()">
                                                    <option value="">Select Medicine</option>
                                                <?php
                                                foreach ($medicinesList as $key => $value) {
                                                    ?>
                                                        <option
                                                            value="<?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>">
                                                    <?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>
                                                        </option>
                                            <?php } ?>
                                                    <option value="addNew">Add New</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="patientMedicines">Medicines</label>
                                                <input list="medicinesList" id="patientMedicines" name="patientMedicines"
                                                    class="form-select" placeholder="Enter medicine name"
                                                    oninput="addNewMedicines(this)">
                                                <datalist id="medicinesList" class="custom-datalist">
                                                <?php
                                                foreach ($medicinesList as $key => $mlvalue) {
                                                    ?>
                                                        <option
                                                            mlvalue="<?php echo $mlvalue['medicineBrand'] . " / " . $mlvalue['medicineName'] . " / " . $mlvalue['strength'] ?>">
                                                    <?php echo $mlvalue['medicineBrand'] . " / " . $mlvalue['medicineName'] . " / " . $mlvalue['strength'] ?>
                                                        </option>
                                            <?php } ?>
                                                    <option value="Add New">Add New</option>
                                                </datalist>
                                            </div>
                                            <div id="addMedicine" class="ps-4" style="display: none;">
                                                <p class="fw-bolder">Enter New Medicine Details</p>
                                                <div class="form-group mt-1 pb-2 col-9">
                                                    <label class="form-lbel" for="newMedicineBrand">Medicine Brand Name</label>
                                                    <input type="text" class="form-control" id="newMedicineBrand"
                                                        name="newMedicineBrand" placeholder="E.g. Dolo 650">
                                                </div>
                                                <div class="form-group pb-2 col-9">
                                                    <label class="form-lael" for="newMedicineName">Medicine Name</label>
                                                    <input type="text" class="form-control" id="newMedicineName"
                                                        name="newMedicineName" placeholder="E.g. Paracetamol">
                                                </div>
                                                <div class="form-group pb-3 mb-2 col-9">
                                                    <label class="form-lbel" for="newMedicineSrength">Medicine Strength</label>
                                                    <input type="text" class="form-control" id="newMedicineSrength"
                                                        name="newMedicineSrength" placeholder="E.g. 100 mg">
                                                </div>
                                            </div>

                                            <div class="form-group pb-3">
                                                <label class="form-label" for="medicalReceipts">Medical Receipts</label>
                                                <input type="file" class="form-control" id="medicalReceipts" name="medicalReceipts"
                                                    accept="image/png ,image/jpg, image/jpeg,application/pdf">
                                            </div>
                                            <div class="form-group pb-3">
                                                <label class="form-label" for="medicalReports">Test Uploads</label>
                                                <input type="file" class="form-control" id="medicalReports" name="medicalReports">
                                            </div>
                                            <button type="submit" class="btn float-end text-light mt-2"
                                                style="background-color: #00ad8e;">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const multiSelect = document.getElementById("multiSelectSymptoms");
                            const selectedValuesInput = document.getElementById("patientSymptoms");
                            const selectedValuesContainer = document.getElementById("selectedValuesContainer");

                            let selectedValues = new Set();

                            const updateSelectedValues = () => {
                                selectedValuesContainer.innerHTML = '';
                                selectedValues.forEach(value => {
                                    const span = document.createElement('span');
                                    span.classList.add('badge', 'bg-secondary', 'me-2', 'd-inline-flex', 'align-items-center');
                                    span.textContent = value;
                                    const button = document.createElement('button');
                                    button.innerHTML = '&times;';
                                    button.classList.add('btn-close', 'btn-close-white', 'ms-2');
                                    button.addEventListener('click', () => {
                                        selectedValues.delete(value);
                                        updateSelectedValues();
                                        Array.from(multiSelect.options).forEach(option => {
                                            if (option.value === value) {
                                                option.classList.remove('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                                option.selected = false;
                                                option.textContent = option.textContent.replace(' ✓', '').trim();
                                            }
                                        });
                                    });
                                    span.appendChild(button);
                                    selectedValuesContainer.appendChild(span);
                                });

                                selectedValuesInput.value = Array.from(selectedValues).join(", ");
                            };

                            multiSelect.addEventListener("change", () => {
                                const selectedOptions = Array.from(multiSelect.selectedOptions);
                                selectedOptions.forEach(option => {
                                    selectedValues.add(option.value);
                                    option.classList.add('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                    if (!option.innerHTML.includes('✓')) {
                                        option.innerHTML = `<span>${option.textContent.trim()} <span class="ms-5">✓</span></span>`;

                                    }
                                });
                                updateSelectedValues();
                            });
                        });
                    </script>

                    <script>
                        function addNewMedicines() {
                            var medicines = document.getElementById("patientMedicines").value;

                            if (medicines == "Add New") {
                                document.getElementById("addMedicine").style.display = "block";
                            } else {
                                document.getElementById("addMedicine").style.display = "none";
                            }
                        }
                    </script>

                    <script>
                        function clearErrorPatientDetails() {
                            var name = document.getElementById("patientName").value;
                            var mobile = document.getElementById("patientMobile").value;
                            var gender = document.getElementById("patientGender").value;
                            var age = document.getElementById("patientAge").value;
                            var diagonsis = document.getElementById("patientDiagonsis").value;
                            var symptoms = document.getElementById("patientSymptoms").value;

                            if (name != "") {
                                document.getElementById("patientName_err").innerHTML = "";
                            }
                            if (mobile != "") {
                                document.getElementById("patientMobile_err").innerHTML = "";
                            }
                            if (gender != "") {
                                document.getElementById("patientGender_err").innerHTML = "";
                            }
                            if (age != "") {
                                document.getElementById("patientAge_err").innerHTML = "";
                            }
                            if (diagonsis != "") {
                                document.getElementById("diagonsis_err").innerHTML = "";
                            }
                            if (symptoms != "") {
                                document.getElementById("symptoms_err").innerHTML = "";
                            }
                        }

                        function validatePatientDetails() {
                            var name = document.getElementById("patientName").value;
                            var mobile = document.getElementById("patientMobile").value;
                            var gender = document.getElementById("patientGender").value;
                            var age = document.getElementById("patientAge").value;
                            var diagonsis = document.getElementById("patientDiagonsis").value;
                            var symptoms = document.getElementById("patientSymptoms").value;

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

                            if (gender == "") {
                                document.getElementById("patientGender_err").innerHTML = "Gender must be filled out.";
                                document.getElementById("patientGender").focus();
                                return false;
                            } else {
                                document.getElementById("patientGender_err").innerHTML = "";
                            }

                            if (age == "") {
                                document.getElementById("patientAge_err").innerHTML = "Age must be filled out.";
                                document.getElementById("patientAge").focus();
                                return false;
                            } else if (age >= 120) {
                                document.getElementById("patientAge_err").innerHTML = "Enter valid age.";
                                document.getElementById("patientAge").focus();
                                return false;
                            } else {
                                document.getElementById("patientAge_err").innerHTML = "";
                            }

                            if (diagonsis == "") {
                                document.getElementById("diagonsis_err").innerHTML = "Diagonsis / Complaints must be filled out.";
                                document.getElementById("patientDiagonsis").focus();
                                return false;
                            } else {
                                document.getElementById("diagonsis_err").innerHTML = "";
                            }

                            if (symptoms == "") {
                                document.getElementById("symptoms_err").innerHTML = "Symptoms / Findings must be filled out.";
                                document.getElementById("patientSymptoms").focus();
                                return false;
                            } else {
                                document.getElementById("symptoms_err").innerHTML = "";
                            }
                            // return true;
                        }
                    </script>

            <?php
        } else if ($method == "patientDetailsFormUpdate") {
            ?>
                        <script>
                            document.getElementById('patients').style.color = "#87F7E3";
                        </script>

                        <section>
                            <div class="card rounded">
                                <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                    <p style="font-size: 24px; font-weight: 500">Edit Patient Details</p>
                                    <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>" class="float-end text-dark"><i
                                            class="bi bi-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body p-2 p-sm-4">

                                    <div class="container">
                                <?php
                                foreach ($patientDetails as $key => $value) {
                                    ?>
                                            <div class="row">
                                                <div class="position-relative mb-5">

                                        <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                                        <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>"
                                                            alt="Profile Photo" width="180" height="180" class="rounded-circle">
                                        <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo"
                                                            width="180" height="180" class="rounded-circle">
                                        <?php } ?>
                                                    <button class="position-absolute bottom-0 " type="button" data-toggle="modal"
                                                        data-target="#updateProfile"
                                                        onclick="patientPhotoUpdate('<?php echo $value['id'] ?>')"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </div>
                                                <div class="col-md-8">

                                                    <form action="<?php echo base_url() . "Healthcareprovider/updatePatientsForm" ?>"
                                                        name="patientDetails" id="multi-step-form" enctype="multipart/form-data"
                                                        method="POST" oninput="clearErrorPatientDetails()">
                                                        <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                            <button
                                                                style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                                class="text-light rounded-circle border-0">1</button> Basic Details
                                                        </p>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientName">First Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="patientName" name="patientName"
                                                                value="<?php echo $value['firstName'] ?>" placeholder="E.g. Siva">
                                                            <div id="patientName_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientLastName">Last Name</label>
                                                            <input type="text" class="form-control" id="" name="patientLastName"
                                                                value="<?php echo $value['lastName'] ?>" placeholder="E.g. Kumar">
                                                            <div id="patientLastName_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientMobile">Moblie Number <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="patientMobile"
                                                                name="patientMobile" value="<?php echo $value['mobileNumber'] ?>"
                                                                placeholder="E.g. 9638527410">
                                                            <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                                Number</label>
                                                            <input type="number" class="form-control" id="patientAltMobile"
                                                                name="patientAltMobile" value="  <?php echo $value['alternateMobile'] ?>"
                                                                placeholder="E.g. 9876543210">
                                                            <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientEmail">Email</label>
                                                            <input type="mail" class="form-control" id="patientEmail" name="patientEmail"
                                                                value="<?php echo $value['mailId'] ?>" placeholder="E.g. example@gmail.com">
                                                            <div id="patientEmail_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientGender">Gender <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" id="patientGender" name="patientGender">
                                                                <option value="">Select Gender</option>
                                                                <option value="Male" <?php if (isset($value['gender']) && $value['gender'] === 'Male')
                                                                    echo 'selected'; ?>>Male</option>
                                                                <option value="Female" <?php if (isset($value['gender']) && $value['gender'] === 'Female')
                                                                    echo 'selected'; ?>>Female</option>
                                                            </select>
                                                            <div id="patientGender_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-2">
                                                            <label class="form-label" for="patientAge">Age <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="patientAge" name="patientAge"
                                                                min="0" value="<?php echo $value['age'] ?>" placeholder="E.g. 41">
                                                            <div id="patientAge_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientBlood">Blood Group</label>
                                                            <select class="form-select" id="patientBlood" name="patientBlood">
                                                                <option value="">Select Blood Group</option>
                                                                <option value="A +ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'A +ve')
                                                                    echo 'selected'; ?>>A +ve</option>
                                                                <option value="A -ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'A -ve')
                                                                    echo 'selected'; ?>>A -ve</option>
                                                                <option value="B +ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'B +ve')
                                                                    echo 'selected'; ?>>B +ve</option>
                                                                <option value="B -ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'B -ve')
                                                                    echo 'selected'; ?>>B -ve</option>
                                                                <option value="O +ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'O +ve')
                                                                    echo 'selected'; ?>>O +ve</option>
                                                                <option value="O -ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'O -ve')
                                                                    echo 'selected'; ?>>O -ve</option>
                                                                <option value="AB +ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'AB +ve')
                                                                    echo 'selected'; ?>>AB +ve</option>
                                                                <option value="AB -ve" <?php if (isset($value['bloodGroup']) && $value['bloodGroup'] === 'AB -ve')
                                                                    echo 'selected'; ?>>AB -ve</option>
                                                            </select>
                                                            <div id="patientBlood_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientMarital">Marital Status</label>
                                                            <select class="form-select" id="patientMarital" name="patientMarital">
                                                                <option value="">Select Marital Status</option>
                                                                <option value="Single" <?php if (isset($value['maritalStatus']) && $value['maritalStatus'] === 'Single')
                                                                    echo 'selected'; ?>>Single</option>
                                                                <option value="Married" <?php if (isset($value['maritalStatus']) && $value['maritalStatus'] === 'Married')
                                                                    echo 'selected'; ?>>Married
                                                                </option>
                                                            </select>
                                                            <div id="patientMarital_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="marriedSince">Married Since</label>
                                                            <input type="text" class="form-control" id="marriedSince"
                                                                value="<?php echo $value['marriedSince'] ?>" name="marriedSince"
                                                                placeholder="E.g. 2012">
                                                        </div>

                                                        <p class="py-3" style="font-size: 20px; font-weight: 500;color:#00ad8e"> <button
                                                                style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                                class="text-light rounded-circle border-0">2</button> Additional Information
                                                        </p>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientProfessions">Patient's
                                                                Profession</label>
                                                            <input type="text" class="form-control" id="patientProfessions"
                                                                name="patientProfessions" value="<?php echo $value['profession'] ?>"
                                                                placeholder="E.g. IT employee">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientDoorNo">Door Number</label>
                                                            <input type="text" class="form-control" id="patientDoorNo" name="patientDoorNo"
                                                                value="<?php echo $value['doorNumber'] ?>" placeholder="E.g. 96">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientStreet">Street Address</label>
                                                            <input type="text" class="form-control" id="patientStreet" name="patientStreet"
                                                                value="<?php echo $value['address'] ?>" placeholder="E.g. Abc street">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientDistrict">District</label>
                                                            <input type="text" class="form-control" id="patientDistrict"
                                                                name="patientDistrict" value="<?php echo $value['district'] ?>"
                                                                placeholder="E.g. Erode">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientPincode">Pincode</label>
                                                            <input type="number" class="form-control" id="patientPincode"
                                                                name="patientPincode" value="<?php echo $value['pincode'] ?>"
                                                                placeholder="E.g. 638001">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="partnersName">Guardian's Name </label>
                                                            <input type="text" class="form-control" id="partnersName" name="partnersName"
                                                                value="<?php echo $value['partnerName'] ?>" placeholder="E.g. Rohith">
                                                            <div id="partnersName_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="partnerMobile">Guardian's Mobile </label>
                                                            <input type="number" class="form-control" id="partnerMobile"
                                                                name="partnerMobile" value="<?php echo $value['partnerMobile'] ?>"
                                                                placeholder="E.g. 9874563210">
                                                            <div id="partnerMobile_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="partnerBlood">Guardian's Blood Group</label>
                                                            <select class="form-select" id="partnerBlood" name="partnerBlood">
                                                                <option value="">Select Blood Group</option>
                                                                <option value="A +ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'A +ve')
                                                                    echo 'selected'; ?>>A +ve</option>
                                                                <option value="A -ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'A -ve')
                                                                    echo 'selected'; ?>>A -ve</option>
                                                                <option value="B +ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'B +ve')
                                                                    echo 'selected'; ?>>B +ve</option>
                                                                <option value="B -ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'B -ve')
                                                                    echo 'selected'; ?>>B -ve</option>
                                                                <option value="O +ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'O +ve')
                                                                    echo 'selected'; ?>>O +ve</option>
                                                                <option value="O -ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'O -ve')
                                                                    echo 'selected'; ?>>O -ve</option>
                                                                <option value="AB +ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'AB +ve')
                                                                    echo 'selected'; ?>>AB +ve</option>
                                                                <option value="AB -ve" <?php if (isset($value['partnerBlood']) && $value['partnerBlood'] === 'AB -ve')
                                                                    echo 'selected'; ?>>AB -ve</option>
                                                            </select>
                                                        </div>

                                                        <p class="py-3" style="font-size: 20px; font-weight: 500;color:#00ad8e"> <button
                                                                style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                                class="text-light rounded-circle border-0">3</button> Medical Records
                                                        </p>

                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientWeight">Weight </label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control" id="patientWeight"
                                                                    name="patientWeight" min="0" value="<?php echo $value['weight'] ?>"
                                                                    placeholder="E.g. 50">
                                                                <p class="mx-2 my-2">Kg</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientHeight">Height </label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control" id="patientHeight"
                                                                    name="patientHeight" min="0" value="<?php echo $value['height'] ?>"
                                                                    placeholder="E.g. 140">
                                                                <p class="mx-2 my-2">Cm</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientBp">Blood Pressure </label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control" id="patientBp" name="patientBp"
                                                                    value="<?php echo $value['bloodPressure'] ?>" min="0"
                                                                    placeholder="E.g. 100">
                                                                <p class="mx-2 my-2">mmHg</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientsCholestrol">Cholestrol </label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control" id="patientsCholestrol"
                                                                    name="patientsCholestrol" min="0"
                                                                    value="<?php echo $value['cholestrol'] ?>" placeholder="E.g. 50">
                                                                <p class="mx-2 my-2">mg/dl</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientBsugar">Blood Sugar </label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control" id="patientBsugar"
                                                                    name="patientBsugar" min="0" value="<?php echo $value['bloodSugar'] ?>"
                                                                    placeholder="E.g. 200">
                                                                <p class="mx-2 my-2">mmol/L</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientDiagonsis">Diagonsis <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="patientDiagonsis" id="patientDiagonsis"
                                                                cols="" rows=""
                                                                placeholder="E.g. Diabetes checkup"><?php echo $value['diagonsis']; ?></textarea>
                                                            <div id="diagonsis_err" class="text-danger pt-1"></div>
                                                        </div>

                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientSymptoms">Symptoms / Complaints <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="patientSymptoms" name="patientSymptoms"
                                                                value="<?php echo $value['symptoms'] ?>" class="form-control"
                                                                placeholder="Select symptoms" readonly hidden>
                                                            <div class="selected-values-container my-2 p-2" id="selectedValuesContainer">
                                                            </div>
                                                            <select class="form-select" id="multiSelectSymptoms">
                                                                <option value="" selected disabled>Select Symptoms</option>
                                                        <?php
                                                        $count = 0;
                                                        foreach ($symptomsList as $key => $svalue) {
                                                            $count++;
                                                            ?>
                                                                    <option value="<?php echo $svalue['symptomsName'] ?>">
                                                            <?php echo $count . '. ' . $svalue['symptomsName'] ?>
                                                                    </option>
                                                    <?php } ?>
                                                            </select>
                                                            <div id="symptoms_err" class="text-danger pt-1"></div>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientMedicines">Medicines</label>
                                                            <select class="form-select" id="patientMedicines" name="patientMedicines">
                                                                <option value="">Select Medicine</option>
                                                        <?php
                                                        $defaultSelectedValue = $value['medicines'];
                                                        foreach ($medicinesList as $key => $mvalue) {
                                                            $selected = ($mvalue['medicineBrand'] . " / " . $mvalue['medicineName'] . " / " . $mvalue['strength'] == $defaultSelectedValue) ? 'selected' : ''; ?>
                                                                    <option
                                                                        value="<?php echo $mvalue['medicineBrand'] . " / " . $mvalue['medicineName'] . " / " . $mvalue['strength'] ?>"
                                                            <?php echo $selected ?>>
                                                            <?php echo $mvalue['medicineBrand'] . " / " . $mvalue['medicineName'] . " / " . $mvalue['strength'] ?>
                                                                    </option>
                                                    <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="medicalReceipts" class="form-label">Medical Receipts</label>
                                                            <input type="text" class="form-control" name="oldmedicalReceipts"
                                                                value="<?php echo $value['documentOne']; ?>" hidden>
                                                            <input type="file" class="form-control" id="medicalReceipts"
                                                                name="medicalReceipts"
                                                                accept="image/png ,image/jpg, image/jpeg, application/pdf" hidden>
                                                            <div style="display:flex;">
                                                                <label id="file_mr" for="medicalReceipts" class="form-control"
                                                                    style="cursor:pointer">Choose File</label>
                                                                <a href="<?php echo base_url() . 'uploads/' . $value['documentOne']; ?>"
                                                                    class="ps-2 pt-1" style="display:none" target="blank" id="existfileMR">
                                                                    <i class="bi bi-box-arrow-up-right me-2"></i> Open </a>
                                                            </div>
                                                        </div>

                                                        <div class="form-group pb-3">
                                                            <label for="medicalReports" class="form-label">Test Uploads</label>
                                                            <input type="text" class="form-control" name="oldmedicalReports"
                                                                value="<?php echo $value['documentTwo']; ?>" hidden>
                                                            <input type="file" class="form-control" id="medicalReports"
                                                                name="medicalReports"
                                                                accept="image/png ,image/jpg, image/jpeg, application/pdf" hidden>
                                                            <div style="display:flex;">
                                                                <label id="file_tu" for="medicalReports" class="form-control"
                                                                    style="cursor:pointer">Choose File</label>
                                                                <a href="<?php echo base_url() . 'uploads/' . $value['documentTwo']; ?>"
                                                                    class="ps-2 pt-1" style="display:none" target="blank" id="existfileTU">
                                                                    <i class="bi bi-box-arrow-up-right me-2"> </i> Open </a>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="patientIdDb" name="patientIdDb"
                                                            value="<?php echo $value['id']; ?>">

                                                        <div class="d-flex justify-content-between mt-3">
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                            <button type="submit" class="btn text-light" style="background-color: #00ad8e;"
                                                                onclick="return validatePatientDetails()">Submit</button>
                                                        </div>
                                                    </form>

                                            <?php
                                            if ($value['documentOne'] != 'No data') {
                                                ?>
                                                        <script>
                                                            document.getElementById("existfileMR").style.display = "flex";
                                                        </script>
                                            <?php
                                            }
                                            if ($value['documentTwo'] != 'No data') {
                                                ?>
                                                        <script>
                                                            document.getElementById("existfileTU").style.display = "flex";
                                                        </script>
                                            <?php
                                            }
                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const multiSelect = document.getElementById("multiSelectSymptoms");
                                const selectedValuesInput = document.getElementById("patientSymptoms");
                                const selectedValuesContainer = document.getElementById("selectedValuesContainer");

                                // Assuming the PHP value is outputted here
                                const symptomsFromDatabase = "<?php echo $value['symptoms'] ?>";
                                const initialSelectedValues = symptomsFromDatabase.split(', ').map(item => item.trim());

                                let selectedValues = new Set(initialSelectedValues);

                                const updateSelectedValues = () => {
                                    selectedValuesContainer.innerHTML = '';
                                    selectedValues.forEach(value => {
                                        const span = document.createElement('span');
                                        span.classList.add('badge', 'bg-secondary', 'me-2', 'd-inline-flex', 'align-items-center');
                                        span.textContent = value;
                                        const button = document.createElement('button');
                                        button.innerHTML = '&times;';
                                        button.classList.add('btn-close', 'btn-close-white', 'ms-2');
                                        button.addEventListener('click', () => {
                                            selectedValues.delete(value);
                                            updateSelectedValues();
                                            Array.from(multiSelect.options).forEach(option => {
                                                if (option.value === value) {
                                                    option.classList.remove('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                                    option.selected = false;
                                                    option.textContent = option.textContent.replace(' ✓', '').trim();
                                                }
                                            });
                                        });
                                        span.appendChild(button);
                                        selectedValuesContainer.appendChild(span);
                                    });

                                    selectedValuesInput.value = Array.from(selectedValues).join(", ");
                                };

                                const initializeSelection = () => {
                                    initialSelectedValues.forEach(value => {
                                        Array.from(multiSelect.options).forEach(option => {
                                            if (option.value === value) {
                                                option.selected = true;
                                                option.classList.add('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                                if (!option.innerHTML.includes('✓')) {
                                                    option.innerHTML = `<span>${option.textContent.trim()} <span class="ms-5">✓</span></span>`;
                                                }
                                            }
                                        });
                                    });
                                    updateSelectedValues();
                                };

                                multiSelect.addEventListener("change", () => {
                                    const selectedOptions = Array.from(multiSelect.selectedOptions);
                                    selectedOptions.forEach(option => {
                                        selectedValues.add(option.value);
                                        option.classList.add('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                        if (!option.innerHTML.includes('✓')) {
                                            option.innerHTML = `<span>${option.textContent.trim()} <span class="ms-5">✓</span></span>`;
                                        }
                                    });
                                    updateSelectedValues();
                                });

                                // Initialize the selection based on database values
                                initializeSelection();
                            });
                        </script>

                        <script>
                            document.getElementById("file_mr").addEventListener("click", function () {
                                document.getElementById("existfileMR").style.display = "none";
                            });

                            const fileInputab = document.getElementById("medicalReceipts");
                            const fileInputLabelab = document.getElementById("file_mr");

                            fileInputab.addEventListener("change", function () {
                                if (fileInputab.files.length > 0) {
                                    fileInputLabelab.textContent = fileInputab.files[0].name;
                                } else {
                                    fileInputLabelab.textContent = "Select a File";
                                }
                            });
                        </script>

                        <script>
                            document.getElementById("file_tu").addEventListener("click", function () {
                                document.getElementById("existfileTU").style.display = "none";
                            });

                            const fileInputtu = document.getElementById("medicalReports");
                            const fileInputLabeltu = document.getElementById("file_tu");

                            fileInputtu.addEventListener("change", function () {
                                if (fileInputtu.files.length > 0) {
                                    fileInputLabeltu.textContent = fileInputtufiles[0].name;
                                } else {
                                    fileInputLabeltu.textContent = "Select a File";
                                }
                            });
                        </script>

                        <script>
                            function patientPhotoUpdate(dbId) {
                                document.getElementById("photoPatientIdDb").value = dbId;
                            }
                        </script>

                        <script>
                            function clearErrorPatientDetails() {
                                var name = document.getElementById("patientName").value;
                                var mobile = document.getElementById("patientMobile").value;
                                var gender = document.getElementById("patientGender").value;
                                var age = document.getElementById("patientAge").value;
                                var diagonsis = document.getElementById("patientDiagonsis").value;
                                var symptoms = document.getElementById("patientSymptoms").value;

                                if (name != "") {
                                    document.getElementById("patientName_err").innerHTML = "";
                                }
                                if (mobile != "") {
                                    document.getElementById("patientMobile_err").innerHTML = "";
                                }
                                if (gender != "") {
                                    document.getElementById("patientGender_err").innerHTML = "";
                                }
                                if (age != "") {
                                    document.getElementById("patientAge_err").innerHTML = "";
                                }
                                if (diagonsis != "") {
                                    document.getElementById("diagonsis_err").innerHTML = "";
                                }
                                if (symptoms != "") {
                                    document.getElementById("symptoms_err").innerHTML = "";
                                }
                            }

                            function validatePatientDetails() {
                                var name = document.getElementById("patientName").value;
                                var mobile = document.getElementById("patientMobile").value;
                                var gender = document.getElementById("patientGender").value;
                                var age = document.getElementById("patientAge").value;
                                var diagonsis = document.getElementById("patientDiagonsis").value;
                                var symptoms = document.getElementById("patientSymptoms").value;

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

                                if (gender == "") {
                                    document.getElementById("patientGender_err").innerHTML = "Gender must be filled out.";
                                    document.getElementById("patientGender").focus();
                                    return false;
                                } else {
                                    document.getElementById("patientGender_err").innerHTML = "";
                                }

                                if (age == "") {
                                    document.getElementById("patientAge_err").innerHTML = "Age must be filled out.";
                                    document.getElementById("patientAge").focus();
                                    return false;
                                } else if (age >= 120) {
                                    document.getElementById("patientAge_err").innerHTML = "Enter valid age.";
                                    document.getElementById("patientAge").focus();
                                    return false;
                                } else {
                                    document.getElementById("patientAge_err").innerHTML = "";
                                }

                                if (diagonsis == "") {
                                    document.getElementById("diagonsis_err").innerHTML = "Diagonsis / Complaints must be filled out.";
                                    document.getElementById("patientDiagonsis").focus();
                                    return false;
                                } else {
                                    document.getElementById("diagonsis_err").innerHTML = "";
                                }

                                if (symptoms == "") {
                                    document.getElementById("symptoms_err").innerHTML = "Symptoms / Findings must be filled out.";
                                    document.getElementById("patientSymptoms").focus();
                                    return false;
                                } else {
                                    document.getElementById("symptoms_err").innerHTML = "";
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
                                <div class="card rounded">
                                    <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                        <p style="font-size: 24px; font-weight: 500"> Patient Details</p>
                                        <button onclick="goBack()" class="border-0 bg-light float-end text-dark"><i
                                                class="bi bi-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="card-body p-2 p-sm-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                            <div class="d-sm-flex justify-content-evenly mt-2 mb-5">
                                                <div class="ps-sm-5">
                                                    <p class="fs-4 fw-bolder"> <?php echo $value['firstName'] ?>
                                        <?php echo $value['lastName'] ?> | <?php echo $value['patientId'] ?>
                                                    </p>
                                                    <p> <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> year(s)</p>
                                                    <p class="text-dark" style="font-weight:500;font-size:20px;">
                                        <?php echo $value['diagonsis'] ?>
                                                    </p>
                                                </div>
                                <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                                    <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>" alt="Profile Photo"
                                                        width="140" height="140" class="rounded-circle">
                                <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                        height="140" class="rounded-circle">
                                <?php } ?>
                                            </div>

                                            <h5 class="my-3 fw-bolder">Personal Details:</h5>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Mobile number</span> - <a
                                                        href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?></a></p>
                                                <p><span class="text-secondary ">Mail</span> - <a href="mailto:<?php echo $value['mailId'] ?>"
                                                        class="text-decoration-none text-dark">
                                        <?php echo $value['mailId'] ?></a></p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Blood group</span> -
                                    <?php echo $value['bloodGroup'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Alternate mobile</span> -
                                    <?php echo $value['alternateMobile'] ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Age </span> -
                                    <?php echo $value['age'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Married status</span> - <?php echo $value['marriedSince'] ?>
                                    <?php echo $value['maritalStatus'] ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Profession</span> -
                                    <?php echo $value['profession'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Street address</span> - <?php echo $value['doorNumber'] ?>,
                                    <?php echo $value['address'] ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">District</span> -
                                    <?php echo $value['district'] ?>         <?php echo $value['pincode'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Guardian name</span> - <?php echo $value['partnerName'] ?></p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Guardian mobile</span> -
                                    <?php echo $value['partnerMobile'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Guardian blood group</span> -
                                    <?php echo $value['partnerBlood'] ?>
                                                </p>
                                            </div>
                                            <h5 class="my-3 fw-bolder">Medical Records:</h5>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Weight</span> - <?php echo $value['weight'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Height</span> - <?php echo $value['height'] ?></p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Blood Pressure</span> -
                                    <?php echo $value['bloodPressure'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Cholestrol </span> - <?php echo $value['cholestrol'] ?></p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Blood Sugar</span> -
                                    <?php echo $value['bloodSugar'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Diagonsis / Complaints</span> -
                                    <?php echo $value['diagonsis'] ?>
                                                </p>
                                            </div>
                                            <div class="d-md-flex">
                                                <p class="col-sm-6"><span class="text-secondary ">Symptoms / Findings</span> -
                                    <?php echo $value['symptoms'] ?>
                                                </p>
                                                <p><span class="text-secondary ">Medicines</span> - <?php echo $value['medicines'] ?></p>
                                            </div>
                            <?php if ($value['documentOne'] != "No data" || $value['documentTwo'] != "No data") { ?>

                                                <h5 class="my-3 mt-5 fw-bolder">Documents / Reports:</h5>

                                                <div class="d-md-flex">
                                    <?php if ($value['documentOne'] != "No data") { ?>
                                                        <p class="col-sm-6"><span class="text-secondary ">Medical Receipts</span> - <a
                                                                href="<?php echo base_url() . 'uploads/' . $value['documentOne'] ?>" target="blank"
                                                                rel="Document 1"> <i class="bi bi-box-arrow-up-right"></i> Open</a> </p>
                                    <?php } ?>
                                    <?php if ($value['documentTwo'] != "No data") { ?>
                                                        <p><span class="text-secondary ">Test uploads</span> - <a
                                                                href="<?php echo base_url() . 'uploads/' . $value['documentTwo'] ?>" target="blank"
                                                                rel="Document 2"> <i class="bi bi-box-arrow-up-right"></i> Open</a> </p>
                                    <?php } ?>
                                                </div>
                            <?php }
                            } ?>
                                    </div>
                                </div>
                                </div>
                            </section>

                            <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script>

            <?php
        } else if ($method == "appointments") {
            ?>

                                <script>
                                    document.getElementById('appointments').style.color = "#87F7E3";
                                </script>

                                <section>
                                    <div class="card rounded">
                                        <div class="d-sm-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                            <p style="font-size: 24px; font-weight: 500">
                                                Appointments
                                            </p>
                                            <a href="<?php echo base_url() . "Healthcareprovider/appointmentsForm" ?>"> <button
                                                    style="background-color: #00ad8e;" class="float-end text-light border-0 rounded p-2">
                                                    <i class="bi bi-plus-square-fill"></i> Book Appointment
                                                </button></a>
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

                                            <div class="card-body p-2 p-sm-4">
                                                <div class="table-responsive">
                                                    <table class="table text-center" id="appointmentTable">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO</th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PATIENT ID
                                                                </th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">DATE</th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">TIME</th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">CC ID</th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PURPOSE
                                                                </th>
                                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
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
                                                                    <td><?php echo $count; ?>. </td>
                                                                    <td style="font-size: 16px">
                                                                        <a href="<?php echo base_url() . "Healthcareprovider/patientdetails/" . $value['patientDbId']; ?>"
                                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['patientId'] ?>
                                                                        </a>
                                                                    </td>
                                                                    <td style="font-size: 16px">
                                                        <?php
                                                        if (date('Y-m-d', strtotime($value['dateOfAppoint'])) == date('Y-m-d')) {
                                                            echo "<b>Today</b>";
                                                        } else {
                                                            echo date("d-m-Y", strtotime($value['dateOfAppoint']));
                                                        } ?>
                                                                    </td>
                                                                    <td class="" style="font-size: 16px">
                                                    <?php echo date('h:i a', strtotime($value['timeOfAppoint'])); ?>
                                                                    </td>
                                                                    <td style="font-size: 16px">
                                                                        <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctorsProfile/" . $value['referalDoctorDbId']; ?>"
                                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['referalDoctor'] ?>
                                                                        </a>
                                                                    </td>
                                                                    <td style="font-size: 16px"><?php echo $value['patientComplaint'] ?></td>
                                                                    <td style="font-size: 16px">
                                                                        <a href="#"><i class="bi bi-three-dots-vertical"></i></a>
                                                                    </td>
                                                                </tr>
                                        <?php } ?>
                                                        </tbody>
                                                    </table>

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
                                                                <li class=" ">
                                                                    <a href="?page=<?php echo $i; ?>">
                                                                        <button type="button"
                                                                            class="btn border px-3 py-2 <?php echo ($i == $current_page) ? 'btn-secondary text-light' : " "; ?>">
                                                        <?php echo $i; ?></button>
                                                                    </a>
                                                                </li>
                                        <?php endfor; ?>

                                        <?php if ($current_page < $total_pages): ?>
                                                                <li class="page-item">
                                                                    <a href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                                                        <button type="button" class="bg-light border px-3 py-2">
                                                                            ></button>
                                                                    </a>
                                                                </li>
                                        <?php endif; ?>
                                                        </ul>
                                                    </nav>
                            <?php } else { ?>
                                                    <h5 class="text-center my-5"><b>No Records Found.</b> </h5>
                            <?php } ?>
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
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500"> New Appoitment</p>
                                                <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                                    class="float-end text-dark"><i class="bi bi-arrow-left"></i> Back</a>
                                            </div>
                                            <div class="card-body px-md-4 pb-4">

                                                <!-- Form  -->
                                                <div>
                                                    <div class="col-md-8">
                                                        <form action="<?php echo base_url() . "Healthcareprovider/newAppointment" ?>" method="POST"
                                                            name="patientDetails" onsubmit="return validateAppointment()"
                                                            oninput="clearErrorAppointment()">
                                                            <div>
                                                                <!-- <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;">
                                                                        Appointments Details</p> -->
                                                                <div class="form-group pb-2">
                                                                    <label class="form-label" for="patientId">Patient Id <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-select" name="patientId" id="patientId">
                                                                        <option value="">Select Patient Id</option>
                                                    <?php
                                                    foreach ($patientsId as $key => $value) {
                                                        ?>
                                                                            <option value="<?php echo $value['patientId'] . '|' . $value['id'] ?>">
                                                        <?php echo $value['patientId'] . " / " . $value['firstName'] . " " . $value['lastName'] ?>
                                                                            </option>
                                                <?php } ?>
                                                                    </select>
                                                                    <div id="patientId_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <!-- <div class="form-group pb-3">
                                                                        <label class="form-label" for="patientName">Name <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="patientName" name="patientName"
                                                                            placeholder="E.g. Gopal">
                                                                        <div id="patientName_err" class="text-danger pt-1"></div>
                                                                    </div> -->
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="referalDoctor">Referal Doctor ID <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-select" name="referalDoctor" id="referalDoctor">
                                                                        <option value="">Select Chief Consultant Id</option>
                                                    <?php
                                                    foreach ($ccsId as $key => $value) {
                                                        ?>
                                                                            <option value="<?php echo $value['ccId'] . '|' . $value['id'] ?>">
                                                        <?php echo $value['ccId'] ?> / <?php echo $value['doctorName'] ?>
                                                                            </option>
                                                <?php } ?>
                                                                    </select>
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
                                                                    <input type="date" class="form-control" id="appDate" name="appDate"
                                                                        oninput="adjustTimeOptions()">
                                                                    <div id="appDate_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="dayTime">Part of a day <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-select" id="dayTime" name="dayTime"
                                                                        onchange="displayTime()">
                                                                        <option id="placeholderOption" value="" style="display: none;">Select date
                                                                        </option>
                                                                        <option value="Morning">Morning</option>
                                                                        <option value="Afternoon">Afternoon</option>
                                                                        <option value="Evening">Evening</option>
                                                                        <option value="Night">Night</option>
                                                                    </select>
                                                                    <div id="dayTime_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="form-group pb-1">
                                                                    <label class="form-label" for="appTime">Time <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="appTime" name="appTime"
                                                                        placeholder="E.g. Select time" readonly>
                                                                    <div id="appTime_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <div class="py-2" id="morningTime" style="display:none"><i
                                                                        class="bi bi-brightness-alt-high"></i>, Morning Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="08:30">08:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="08:40">08:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="08:50">08:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:00">09:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:10">09:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:20">09:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:30">09:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:40">09:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="09:50">09:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:00">10:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:10">10:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:20">10:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:30">10:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:40">10:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="10:50">10:50 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:00">11:00 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:10">11:10 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:20">11:20 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:30">11:30 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:40">11:40 AM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="11:50">11:50 AM</button>
                                                                </div>
                                                                <div class="py-2" id="afternoonTime" style="display:none"><i class="bi bi-sun"></i>,
                                                                    Afternoon Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:00">12:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:10">12:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:20">12:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:30">12:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:40">12:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="12:50">12:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:00">01:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:10">01:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:20">01:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:30">01:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:40">01:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="13:50">01:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:00">02:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:10">02:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:20">02:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:30">02:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:40">02:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="14:50">02:50 PM</button>
                                                                </div>
                                                                <div class="py-2" id="eveningTime" style="display:none"><i
                                                                        class="bi bi-brightness-alt-high"></i>, Evening Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="17:30">05:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="17:40">05:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="17:50">05:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:00">06:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:10">06:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:20">06:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:30">06:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:40">06:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="18:50">06:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:00">07:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:10">07:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:20">07:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:30">07:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:40">07:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="19:50">07:50 PM</button>
                                                                </div>
                                                                <div class="py-2" id="nightTime" style="display:none"><i
                                                                        class="bi bi-moon-stars"></i>, Night Consult time,<br>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:00">08:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:10">08:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:20">08:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:30">08:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:40">08:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="20:50">08:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:00">09:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:10">09:10 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:20">09:20 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:30">09:30 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:40">09:40 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="21:50">09:50 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="22:00">10:00 PM</button>
                                                                    <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                        value="22:10">10:10 PM</button>
                                                                </div>
                                                                <div class="form-group py-3">
                                                                    <label class="form-label" for="appReason">Patient's Complaint / Symptoms<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" id="appReason" name="appReason" readonly class="form-control"
                                                                        hidden>
                                                                    <div class="selected-values-container mb-2 p-2" id="selectedValuesContainer">
                                                                    </div>
                                                                    <select class="form-select" id="multiSelectSymptoms">
                                                                        <option value="" selected disabled>Select Symptoms</option>
                                                    <?php
                                                    $count = 0;
                                                    foreach ($symptomsList as $key => $value) {
                                                        $count++;
                                                        ?>
                                                                            <option value="<?php echo $value['symptomsName'] ?>">
                                                        <?php echo $count . '. ' . $value['symptomsName'] ?>
                                                                            </option>

                                                <?php } ?>
                                                                    </select>
                                                                    <div id="appReason_err" class="text-danger pt-1"></div>
                                                                </div>
                                                                <!-- Payment -->
                                                                <div class="form-group pb-3">
                                                                    <label class="form-label" for="pay">Payment <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="pay" name="pay"
                                                                        placeholder="E.g. Add payment details">
                                                                </div>

                                                                <button type="submit" class="btn text-light float-end mt-2"
                                                                    style="background-color: #00ad8e;">Confirm </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    
                                    <script>
                                        function adjustTimeOptions() {
                                            const currentDate = new Date();
                                            const selectedDate = new Date(document.getElementById('appDate').value);
                                            const selectElement = document.getElementById('dayTime');

                                            hideAllOptions();

                                            let anyOptionVisible = false;

                                            if (currentDate.toDateString() === selectedDate.toDateString()) {
                                                const currentHour = currentDate.getHours();

                                                if (currentHour < 4) {
                                                    showOption('Morning');
                                                    anyOptionVisible = true;
                                                }
                                                if (currentHour < 9) {
                                                    showOption('Afternoon');
                                                    anyOptionVisible = true;
                                                }
                                                if (currentHour < 15) {
                                                    showOption('Evening');
                                                    anyOptionVisible = true;
                                                }
                                                if (currentHour < 18) {
                                                    showOption('Night');
                                                    anyOptionVisible = true;
                                                }
                                            } else {
                                                showAllOptions();
                                                anyOptionVisible = true;
                                            }

                                            if (!anyOptionVisible) {
                                                document.getElementById('placeholderOption').style.display = 'block';
                                            } else {
                                                document.getElementById('placeholderOption').style.display = 'none';
                                            }
                                        }

                                        function hideAllOptions() {
                                            const selectElement = document.getElementById('dayTime');
                                            for (let i = 0; i < selectElement.options.length; i++) {
                                                selectElement.options[i].style.display = 'none';
                                            }
                                        }

                                        function hideOption(timeOfDay) {
                                            const selectElement = document.getElementById('dayTime');
                                            for (let i = 0; i < selectElement.options.length; i++) {
                                                if (selectElement.options[i].value === timeOfDay) {
                                                    selectElement.options[i].style.display = 'none';
                                                }
                                            }
                                        }

                                        function showOption(timeOfDay) {
                                            const selectElement = document.getElementById('dayTime');
                                            for (let i = 0; i < selectElement.options.length; i++) {
                                                if (selectElement.options[i].value === timeOfDay) {
                                                    selectElement.options[i].style.display = 'block';
                                                }
                                            }
                                        }

                                        function showAllOptions() {
                                            const selectElement = document.getElementById('dayTime');
                                            for (let i = 0; i < selectElement.options.length; i++) {
                                                selectElement.options[i].style.display = 'block';
                                            }
                                        }

                                        window.onload = function () {
                                            hideAllOptions();
                                            document.getElementById('placeholderOption').style.display = 'block';
                                        };
                                    </script>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const multiSelect = document.getElementById("multiSelectSymptoms");
                                            const selectedValuesInput = document.getElementById("appReason");
                                            const selectedValuesContainer = document.getElementById("selectedValuesContainer");

                                            let selectedValues = new Set();

                                            const updateSelectedValues = () => {
                                                selectedValuesContainer.innerHTML = '';
                                                selectedValues.forEach(value => {
                                                    const span = document.createElement('span');
                                                    span.classList.add('badge', 'bg-secondary', 'me-2', 'd-inline-flex', 'align-items-center');
                                                    span.textContent = value;
                                                    const button = document.createElement('button');
                                                    button.innerHTML = '&times;';
                                                    button.classList.add('btn-close', 'btn-close-white', 'ms-2');
                                                    button.addEventListener('click', () => {
                                                        selectedValues.delete(value);
                                                        updateSelectedValues();
                                                        Array.from(multiSelect.options).forEach(option => {
                                                            if (option.value === value) {
                                                                option.classList.remove('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                                                option.selected = false;
                                                                option.textContent = option.textContent.replace(' ✓', '').trim();
                                                            }
                                                        });
                                                    });
                                                    span.appendChild(button);
                                                    selectedValuesContainer.appendChild(span);
                                                });

                                                selectedValuesInput.value = Array.from(selectedValues).join(", ");
                                            };

                                            multiSelect.addEventListener("change", () => {
                                                const selectedOptions = Array.from(multiSelect.selectedOptions);
                                                selectedOptions.forEach(option => {
                                                    selectedValues.add(option.value);
                                                    option.classList.add('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                                    if (!option.innerHTML.includes('✓')) {
                                                        option.innerHTML = `<span>${option.textContent.trim()} <span class="ms-5">✓</span></span>`;

                                                    }
                                                });
                                                updateSelectedValues();
                                            });
                                        });
                                    </script>

                                    <script>
                                        var dateInput = document.getElementById('appDate');
                                        var today = new Date();
                                        var dd = String(today.getDate()).padStart(2, '0');
                                        var mm = String(today.getMonth() + 1).padStart(2, '0');
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
                                            button.addEventListener('click',
                                                function () {
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
                                            // var name = document.getElementById("patientName").value;
                                            var referalDr = document.getElementById("referalDoctor").value;
                                            // var consultMode = document.getElementById("appConsult").value;      
                                            var date = document.getElementById("appDate").value;
                                            var dayTime = document.getElementById("dayTime").value;
                                            var time = document.getElementById("appTime").value;
                                            var reason = document.getElementById("appReason").value;

                                            if (patientId != "") {
                                                document.getElementById("patientId_err").innerHTML = "";
                                            }
                                            // if (name != "") {
                                            //     document.getElementById("patientName_err").innerHTML = "";
                                            // }
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
                                            // var name = document.getElementById("patientName").value;
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
                                            // if (name == "") {
                                            //     document.getElementById("patientName_err").innerHTML = "Name must be filled out.";
                                            //     document.getElementById("patientName").focus();
                                            //     return false;
                                            // } else {
                                            //     document.getElementById("patientName_err").innerHTML = "";
                                            // }
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
                                                <div class="d-sm-flex justify-content-between p-3">
                                                    <p class="ps-2 m-0" style="font-size: 24px; font-weight: 500">
                                                        Chief Doctors
                                                    </p>
                                                    <div class="input-group pt-2 pt-sm-0" style="width:250px;">
                                                        <span class="input-group-text" id="searchIcon">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input type="text" id="searchInputChiefDoctor" class="form-control" placeholder="Search by name"
                                                            aria-describedby="searchIcon">
                                                        <button class="btn btn-outline-secondary" type="button" id="clearSearchChiefDoctor">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="container">
                                                <div class="row justify-content-center" id="doctorContainer">
                                                </div>

                                                <div class="pagination justify-content-center mt-3" id="paginationContainer">
                                                </div>
                                            </div>
                                        </section>

                                        <script>
                                            const itemsPerPage = 6;
                                            const ccDetails = <?php echo json_encode($ccDetails); ?>;
                                            let filteredDetails = ccDetails;
                                            const initialPage = parseInt(localStorage.getItem('currentPage')) || 1;

                                            function displayPage(page) {
                                                localStorage.setItem('currentPage', page);
                                                const start = (page - 1) * itemsPerPage;
                                                const end = start + itemsPerPage;
                                                const itemsToShow = filteredDetails.slice(start, end);

                                                const doctorContainer = document.getElementById('doctorContainer');
                                                doctorContainer.innerHTML = '';

                                                if (itemsToShow.length === 0) {
                                                    const noMatchesDiv = document.createElement('div');
                                                    noMatchesDiv.className = 'col-12 text-center';
                                                    noMatchesDiv.innerHTML = `<p>No matches found.</p>`;
                                                    doctorContainer.appendChild(noMatchesDiv);
                                                } else {
                                                    itemsToShow.forEach(value => {
                                                        const doctorItem = document.createElement('div');
                                                        doctorItem.className = 'card col-lg-4 m-3 chief-doctor-item';
                                                        doctorItem.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="d-sm-flex justify-content-evenly text-center p-4">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <img src="${value.ccPhoto ? value.ccPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg'}" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p class="card-title"><b>${value.doctorName}</b>/<br>${value.ccId}</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p style="color: #00ad8e;"><b>${value.specialization}</b></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a href="<?php echo base_url(); ?>Healthcareprovider/chiefDoctorsProfile/${value.id}" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           class="btn btn-secondary">Full Details</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
                                                        doctorContainer.appendChild(doctorItem);
                                                    });
                                                }

                                                generatePagination(filteredDetails.length, page);
                                            }

                                            function generatePagination(totalItems, currentPage) {
                                                const totalPages = Math.ceil(totalItems / itemsPerPage);
                                                const paginationContainer = document.getElementById('paginationContainer');
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
                                                    if (currentPage > 1) displayPage(currentPage - 1);
                                                };
                                                ul.appendChild(prevLi);

                                                for (let i = 1; i <= totalPages; i++) {
                                                    const li = document.createElement('li');
                                                    li.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a href="#">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}">${i}</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `;
                                                    li.onclick = () => displayPage(i);
                                                    ul.appendChild(li);
                                                }

                                                const nextLi = document.createElement('li');
                                                nextLi.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a href="#">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="bg-light border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>&gt;</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `;
                                                nextLi.onclick = () => {
                                                    if (currentPage < totalPages) displayPage(currentPage + 1);
                                                };
                                                ul.appendChild(nextLi);

                                                paginationContainer.appendChild(ul);
                                            }

                                            document.getElementById('searchInputChiefDoctor').addEventListener('keyup', function () {
                                                const searchQuery = this.value.toLowerCase();
                                                filteredDetails = ccDetails.filter(item => item.doctorName.toLowerCase().includes(searchQuery));
                                                displayPage(1);
                                            });

                                            document.getElementById('clearSearchChiefDoctor').addEventListener('click', function () {
                                                document.getElementById('searchInputChiefDoctor').value = '';
                                                filteredDetails = ccDetails;
                                                displayPage(1);
                                            });

                                            displayPage(initialPage);
                                        </script>

            <?php
        } else if ($method == "chiefDoctorProfile") {
            ?>
                                            <script>
                                                document.getElementById('chiefDoctor').style.color = "#87F7E3";
                                            </script>

                                            <section>
                                                <div class="card rounded">
                                                    <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500">
                                                            Chief Doctor Profile </p>
                                                        <button onclick="goBack()" class="border-0 bg-light float-end text-dark"><i
                                                                class="bi bi-arrow-left"></i> Back</button>
                                                    </div>

                                                    <div class="card-body p-2 p-sm-4">

                                                        <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php
                                foreach ($ccDetails as $key => $value) {
                                    ?>
                                <?php if (isset($value['ccPhoto']) && $value['ccPhoto'] != "") { ?>
                                                                    <img src="<?php echo $value['ccPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                        class="rounded-circle">
                                <?php } else { ?>
                                                                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                        height="140" class="rounded-circle my-auto">
                                <?php } ?>
                                                                <div class="ps-sm-5">
                                                                    <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['doctorName']; ?>
                                                                    </p>
                                                                    <p style="font-size:16px;font-weight:400;color:#00ad8e;">Diabetologist</p>
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

                                                            <h5 class="my-3 fw-bolder">Profile Details:</h5>

                                                            <table>
                                                                <tr>
                                                                    <td class="col-2 py-2" style="color:#999292">Years of Experience</td>
                                                                    <td class="col-5">
                                        <?php if ($value['yearOfExperience'] != "") {
                                            echo $value['yearOfExperience'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Qualification</td>
                                                                    <td>
                                        <?php if ($value['qualification'] != "") {
                                            echo $value['qualification'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Registration detail</td>
                                                                    <td>
                                        <?php if ($value['regDetails'] != "") {
                                            echo $value['regDetails'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Membership</td>
                                                                    <td>
                                        <?php if ($value['membership'] != "") {
                                            echo $value['membership'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Services</td>
                                                                    <td>
                                        <?php if ($value['services'] != "") {
                                            echo $value['services'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Date of Birth</td>
                                                                    <td>
                                        <?php if ($value['dateOfBirth'] != "") {
                                            echo $value['dateOfBirth'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Hospital / Clinic Name</td>
                                                                    <td>
                                        <?php if ($value['hospitalName'] != "") {
                                            echo $value['hospitalName'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2" style="color:#999292">Location</td>
                                                                    <td>
                                        <?php if ($value['location'] != "") {
                                            echo $value['location'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                    <?php } ?>
                                                </div>
                                            </section>
                                            <script>
                                                function goBack() {
                                                    window.history.back(); yy
                                                }
                                            </script>


            <?php
        } else if ($method == "myProfile") {
            ?>

                                                <section>
                                                    <div class="card rounded">
                                                        <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                            <p style="font-size: 24px; font-weight: 500"> My Profile</p>
                                                            <a href="<?php echo base_url() . "Healthcareprovider/dashboard" ?>" class="float-end text-dark"><i
                                                                    class="bi bi-arrow-left"></i> Back</a>
                                                        </div>
                                                        <div class="card-body p-2 p-sm-4">
                            <?php
                            foreach ($hcpDetails as $key => $value) {
                                ?>
                                                                <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                                        <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                            class="rounded-circle">
                                <?php } else { ?>
                                                                        <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt=" Profile Photo" width="140"
                                                                            height="140" class="rounded-circle">
                                <?php } ?>
                                                                    <div class="ps-sm-5">
                                                                        <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['hcpName']; ?>
                                                                        </p>
                                                                        <p style="font-size:16px;font-weight:400;color:#00ad8e;">
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

                                                                <div class="d-flex justify-content-between mt-2 ">
                                                                    <p style="font-size:22px;font-weight:500;">Profile Details:</p>
                                                                    <a href="<?php echo base_url() . "Healthcareprovider/editMyProfile" ?>"><i
                                                                            class="bi bi-pencil-square"></i> Edit</a>
                                                                </div>
                                                                <table>
                                                                    <tr>
                                                                        <td class="col-5 py-2" style="color:#999292">Years of Experience</td>
                                                                        <td class="col-5">
                                        <?php if ($value['hcpExperience'] != "") {
                                            echo $value['hcpExperience'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-2" style="color:#999292">Qualification</td>
                                                                        <td>
                                        <?php if ($value['hcpQualification'] != "") {
                                            echo $value['hcpQualification'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- <tr>
                                                                <td class="py-2" style="color:#999292">Specialization</td>
                                                                <td>Diabetologist, Internal Medician Physician</td>
                                                            </tr> -->
                                                                    <tr>
                                                                        <td class="py-2" style="color:#999292">Date of Birth</td>
                                                                        <td>
                                        <?php if ($value['hcpDob'] != "") {
                                            echo $value['hcpDob'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-2" style="color:#999292">Hospital / Clinic Name</td>
                                                                        <td>
                                        <?php if ($value['hcpHospitalName'] != "") {
                                            echo $value['hcpHospitalName'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-2" style="color:#999292">Location</td>
                                                                        <td>
                                        <?php if ($value['hcpLocation'] != "") {
                                            echo $value['hcpLocation'];
                                        } else {
                                            echo "-";
                                        } ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                        <?php } ?>
                                                        </div>
                                                    </div>
                                                </section>

            <?php
        } else if ($method == "editMyProfile") {
            ?>

                                                    <section>
                                                        <div class="card rounded">
                                                            <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                                <p style="font-size: 24px; font-weight: 500"> Edit Profile Details</p>
                                                                <a href="<?php echo base_url() . "Healthcareprovider/myProfile" ?>" class="float-end text-dark"><i
                                                                        class="bi bi-arrow-left"></i> Back</a>
                                                            </div>
                                                            <div class="card-body ps-2 p-sm-4">
                                                                <div class="">
                                                                    <div class="position-relative mb-5">
                                    <?php
                                    foreach ($hcpDetails as $key => $value) {
                                        ?>
                                    <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                                                <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="180" height="180"
                                                                                    class="rounded-circle">
                                    <?php } else { ?>
                                                                                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="180"
                                                                                    height="180" class="rounded-circle">
                                    <?php } ?>
                                                                            <button class="position-absolute bottom-0 " type="button" data-toggle="modal"
                                                                                data-target="#updatePhoto"><i class="bi bi-pencil-square"></i></button>
                                                                        </div>


                                                                        <form action="<?php echo base_url() . "Healthcareprovider/updateMyProfile" ?>"
                                                                            name="profileEditForm" name="profileEditForm" enctype="multipart/form-data" method="POST"
                                                                            onsubmit="return validateDetails()" oninput="clearErrorDetails()" class="col-md-6">

                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="drName">Name <span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="drName" name="drName"
                                                                                    value="<?php echo $value['hcpName']; ?>" placeholder="E.g. Suresh Kumar">
                                                                                <div id="drName_err" class="text-danger pt-1"></div>
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="drMobile">Mobile <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                                                    value="<?php echo $value['hcpMobile']; ?>" placeholder="E.g. 9632587410">
                                                                                <div id="drMobile_err" class="text-danger pt-1"></div>
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="drEmail">Email <span class="text-danger">*</span></label>
                                                                                <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                                    value="<?php echo $value['hcpMail']; ?>" placeholder="E.g. example@gmail.com">
                                                                                <div id="drEmail_err" class="text-danger pt-1"></div>
                                                                            </div>
                                                                            <div class="form-group pb-3 ">
                                                                                <label class="form-label" for="drPassword">Password <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="d-flex">
                                                                                    <input type="password" class="form-control" id="drPassword" name="drPassword"
                                                                                        value='<?php echo $value['hcpPassword']; ?>'>
                                                                                    <button type="button" class="btn btn-outline-secondary"
                                                                                        onclick="togglePasswordVisibility('drPassword', 'visibilityIcon')">
                                                                                        <i id="visibilityIcon" class="bi bi-eye-slash"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div id="drPassword_err" class="text-danger pt-1"></div>
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="specialization">Specialization <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control" id="specialization" name="specialization">
                                                <?php
                                                $defaultSelectedValue = $value['hcpSpecialization'];
                                                foreach ($specializationList as $key => $cvalue) {
                                                    $selected = ($cvalue['specializationName'] == $defaultSelectedValue) ? 'selected' : ''; ?>
                                                                                        <option value="<?php echo $cvalue['specializationName'] ?>" <?php echo $selected ?>>
                                                    <?php echo $cvalue['specializationName'] ?>
                                                                                        </option>
                                            <?php } ?>
                                                                                </select>
                                                                                <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                            </div>

                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="yearOfExp">Years of Experience</label>
                                                                                <input type="text" class="form-control" id="yearOfExp" name="yearOfExp"
                                                                                    value="<?php echo $value['hcpExperience']; ?>" placeholder="E.g. 25">
                                                                                <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="qualification">Qualification</label>
                                                                                <input type="text" class="form-control" id="qualification" name="qualification"
                                                                                    value="<?php echo $value['hcpQualification']; ?>" placeholder="E.g. MBBS">
                                                                                <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="dob">Date of Birth</label>
                                                                                <input type="date" class="form-control" id="dob" name="dob"
                                                                                    value="<?php echo $value['hcpDob']; ?>">
                                                                                <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="hospitalName">Hospital / Clinic Name</label>
                                                                                <input type="text" class="form-control" id="hospitalName" name="hospitalName"
                                                                                    value="<?php echo $value['hcpHospitalName']; ?>" placeholder="E.g. MMCH">
                                                                                <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                            </div>
                                                                            <div class="form-group pb-3">
                                                                                <label class="form-label" for="location">Location</label>
                                                                                <input type="text" class="form-control" id="location" name="location"
                                                                                    value="<?php echo $value['hcpLocation']; ?>" placeholder="E.g. Erode">
                                                                                <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                            </div>

                                                                            <button type="reset" class="btn btn-secondary float-start mt-3">Reset</button>
                                                                            <button type="submit" class="btn float-end mt-3"
                                                                                style="color: white;background-color: #00ad8e;">Save</button>
                                                                        </form>
                                                                    </div><?php } ?>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <script>
                                                        function clearErrorDetails() {
                                                            var doctorName = document.getElementById("drName").value;
                                                            var doctorMobile = document.getElementById("drMobile").value;
                                                            var doctorEmail = document.getElementById("drEmail").value;
                                                            var doctorpassword = document.getElementById("drPassword").value;
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
                                                            //     document.getElementById("profilePhoto_err").innerHTML = "";   // }           
                                                        }
                                                    </script>

                                                    <script>
                                                        function validateDetails() {
                                                            var doctorNmae = document.getElementById("drName").value;
                                                            var doctorMobile = document.getElementById("drMobile").value;
                                                            var doctorEmail = document.getElementById("drEmail").value;
                                                            var doctorPassword = document.getElementById("drPassword").value;
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
                                                            if (doctorPassword == "") {
                                                                document.getElementById("drPassword_err").innerHTML = "A password can't be blank.";
                                                                document.getElementById("drPassword").focus();
                                                                return false;
                                                            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(doctorPassword)) {
                                                                document.getElementById("drPassword_err").innerHTML = "Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, 1 number and a minimum of 8 characters.";
                                                                document.getElementById("drPassword").focus();
                                                                return false;
                                                            } else {
                                                                document.getElementById("drPassword_err").innerHTML = "";
                                                            }
                                                            // // if (photo == "") {                
                                                            //     document.getElementById("profilePhoto_err").innerHTML = "Photo must be uploaded.";   
                                                            //     document.getElementById("profilePhoto").focus();                
                                                            //     return false;                 // } else {              
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
                        <form action="<?php echo base_url() . "Healthcareprovider/updatePhoto" ?>"
                            name="profilePhotoForm" name="profilePhotoForm" enctype="multipart/form-data" method="POST">
                            <label for="hcpProfile" class="pb-2">Upload file: </label><br>
                            <input type="file" name="hcpProfile" id="hcpProfile"
                                accept="image/png ,image/jpg, image/jpeg" required><br><br>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Update Patient Profile Photo -->
        <div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form action="<?php echo base_url() . "Healthcareprovider/updatePatientPhoto" ?>"
                            name="profilePhotoForm" name="profilePhotoForm" enctype="multipart/form-data" method="POST">
                            <label for="hcpProfile" class="pb-2">Upload file: </label><br>
                            <input type="file" name="patientProfile" id="patientProfile"
                                accept="image/png ,image/jpg, image/jpeg" required><br><br>
                            <input type="hidden" id="photoPatientIdDb" name="photoPatientIdDb" value="">
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

<!-- Bootstrap popup link -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</html>