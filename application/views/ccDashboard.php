<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Chief Consultant - EDF</title>
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
    <!-- Image Cropper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
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

        .table-hoverr tbody tr:hover td,
        .table-hoverr tbody tr:hover th {
            background-color: rgba(0, 121, 173, 0.1) !important;
        }

        /* Consultation previous and next arrows */
        .consultation-item {
            display: none;
        }

        .consultation-item.active {
            display: block;
        }

        /* Attachment Display Preview */
        #dashboardPreviewModal #prevAttachment,
        #dashboardPreviewModal #nextAttachment {
            z-index: 10;
        }

        #dashboardPreviewModal .modal-body::before,
        #dashboardPreviewModal .modal-body::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50px;
            background: #fff;
            z-index: 5;
            pointer-events: none;
        }

        #dashboardPreviewModal .modal-body::before {
            left: 0;
        }

        #dashboardPreviewModal .modal-body::after {
            right: 0;
        }

        #dashboardPreviewModal .preview-area {
            margin: 0 50px;
            height: calc(70vh - 100px);
            min-height: 400px;
            overflow: auto;
            background: #fff;
        }
    </style>
</head>

<body>
    <?php $this->load->view('ccHeader'); ?>

    <main id="main" class="main">
        <?php
        $firstLogin = $this->session->userdata('firstLogin');
        if ($firstLogin !== null && $firstLogin == '0' && $method !== "passwordChange") {
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var myModal = new bootstrap.Modal(document.getElementById('firstLoginAlert'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myModal.show();
                });
            </script>
        <?php } ?>
        <?php if ($this->session->flashdata('showSuccessMessage')) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color: #d4edda;color: #155724;padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $this->session->flashdata('showSuccessMessage'); ?>
            </div>
        <?php } elseif ($this->session->flashdata('showErrorMessage')) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color:rgb(237, 212, 212);color:rgb(87, 21, 21);padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $this->session->flashdata('showErrorMessage'); ?>
            </div>
        <?php }
        if ($method == "dashboard") {
            ?>

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
                                    <?php echo date("d-M-Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2  -->
                <div class="d-lg-flex justify-content-evenly">
                    <div class="card col-12 col-lg-5 rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-calendar2-check pe-3"></i> Today Appointments
                            </p>
                            <div class="table-responsive">
                                <?php if (isset($appointmentList[0]['id'])) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col-4" style="font-size: 18px; font-weight: 500; color: #0079AD">
                                                    Patient
                                                </th>
                                                <th scope="col" style="font-size: 18px; font-weight: 500; color: #0079AD"
                                                    class="px-5">
                                                    Patient Id / Name
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
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[0]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[0]['firstName'] != '' ? $appointmentList[0]['firstName'] . " " . $appointmentList[0]['lastName'] : "-"; ?></span>
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
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[1]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[1]['patientComplaint'] != '' ? $appointmentList[1]['patientComplaint'] : "-"; ?></span>
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
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #0079AD"><?php echo $appointmentList[2]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[2]['patientComplaint'] != '' ? $appointmentList[2]['patientComplaint'] : "-"; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px">
                                                        <?php echo date('h:i a', strtotime($appointmentList[2]['timeOfAppoint'])); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <p class="m-md-5 px-md-5"><b> No Appointments Today.</b></p>
                                <?php } ?>
                            </div>
                            <?php if (isset($appointmentList[3]['id'])) { ?>
                                <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                    class="text-decoration-underline">see all</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="card col-12 col-lg-5 rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #0079AD">
                                <i class="bi bi-person pe-3"></i> Patient Details
                            </p>
                            <?php if (isset($appointmentList[0]['id'])) { ?>
                                <div class="d-flex justify-content-evenly">
                                    <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                        <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>"
                                            alt="Profile Photo" width="50" height="50" class="rounded-circle"
                                            onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
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
                                                <th class="col-4" style="font-size: 16px; font-weight: 600">
                                                    Age
                                                </th>
                                                <th class="col-4" style="font-size: 16px; font-weight: 600">
                                                    Gender
                                                </th>
                                                <th class="col-4" style="font-size: 16px; font-weight: 600">
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
                                                <th class="col-8" style="font-size: 16px; font-weight: 600">
                                                    Complaint
                                                </th>
                                                <th class="col-4" style="font-size: 16px; font-weight: 600">
                                                    Patient HCP ID
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientComplaint'] != '' ? $appointmentList[0]['patientComplaint'] : "-"; ?></span>
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
                                <div class="d-flex justify-content-center">
                                    <a href="tel:<?php echo $appointmentList[0]['mobileNumber']; ?>"><button
                                            style=" background-color: #0079AD; color: white; font-size: 16px;"
                                            class="border border-1 rounded p-2 p-md-3">
                                            <i class="bi bi-telephone"></i> +91
                                            <?php echo $appointmentList[0]['mobileNumber']; ?>
                                        </button></a>
                                </div>
                            <?php } else { ?>
                                <p class="m-md-5 px-md-5"><b> No Appointments Today.</b></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php
        } else if ($method == "patients") {
            ?>

                <section>
                    <div class="card rounded">
                        <div class="p-3 p-sm-4">
                            <div class="d-sm-flex justify-content-between mt-2 mb-3">
                                <p style="font-size: 24px; font-weight: 500">
                                    Patients
                                </p>
                            </div>
                        <?php if (isset($patientDetails[0]['id'])) {
                            ?>
                                <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between m-3">
                                    <select id="filterDropdown" class="form-select border border-2 rounded-3 px-3 py-2"
                                        style="height: 50px; width: 250px;">
                                        <option value="All">Filter (All Genders)</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="d-flex align-items-center position-relative pt-2 pt-md-0">
                                        <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                            style="height: 50px; width: 260px" placeholder="Search (ID / NAME / MOBILE)">
                                        <span id="clearSearch" class="position-absolute"
                                            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                    </div>
                                </div>
                                <div class="ps-4">
                                    <label for="itemsPerPageDropdown">Show </label>
                                    <select id="itemsPerPageDropdown"
                                        class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    <label for="itemsPerPageDropdown">Entries </label>
                                </div>
                                <div class="card-body ps-2 p-sm-4">
                                    <div class="table-responsive">
                                        <table class="table table-hoverr text-center" id="PatientList">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">S.NO
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">ID
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">NAME
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">MOBILE
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">GENDER
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">AGE
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">HCP ID
                                                    </th>
                                                    <th scope="col" style="font-size: 16px; font-weight: 500; color: #0079AD">ACTION
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="patientContainer"></tbody>
                                        </table>
                                    </div>
                                    <div class="d-md-flex justify-content-between">
                                        <div id="entriesInfo" class="mt-4"></div>
                                        <div class="pagination justify-content-end mt-4" id="paginationContainerPatients"></div>
                                    </div>
                                </div>

                        <?php } else { ?>
                                <h5 class="text-center my-5"><b>No Patient Records Found.</b> </h5>
                        <?php } ?>
                        </div>
                    </div>
                </section>


                <script>
                    let itemsPerPagePatients = 10;
                    const patientDetails = <?php echo json_encode($patientDetails); ?>;
                    patientDetails.sort((a, b) => {
                        const dateA = new Date(a.createdAt || a.enrolledTime);
                        const dateB = new Date(b.createdAt || b.enrolledTime);
                        return dateB - dateA;
                    });
                    let filteredPatientDetails = [...patientDetails];
                    const initialPagePatients = parseInt(localStorage.getItem('currentPagePatients')) || 1;

                    const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                    const searchBar = document.getElementById('searchBar');
                    const clearSearch = document.getElementById('clearSearch');
                    const filterDropdown = document.getElementById('filterDropdown');

                    // Load saved itemsPerPage
                    const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPagePatients')) || itemsPerPagePatients;
                    itemsPerPageDropdown.value = savedItemsPerPage;
                    itemsPerPagePatients = savedItemsPerPage;

                    // Event Listeners
                    itemsPerPageDropdown.addEventListener('change', (event) => {
                        itemsPerPagePatients = parseInt(event.target.value);
                        localStorage.setItem('itemsPerPagePatients', itemsPerPagePatients);
                        applyFilters();
                    });

                    searchBar.addEventListener('input', () => {
                        toggleClearIcons();
                        applyFilters();
                    });

                    clearSearch.addEventListener('click', () => {
                        searchBar.value = '';
                        toggleClearIcons();
                        applyFilters();
                    });

                    filterDropdown.addEventListener('change', applyFilters);

                    function toggleClearIcons() {
                        clearSearch.style.display = searchBar.value ? 'block' : 'none';
                    }

                    function applyFilters() {
                        const searchTerm = searchBar.value.toLowerCase();
                        const genderFilter = filterDropdown.value;

                        filteredPatientDetails = patientDetails.filter((patient) => {
                            const fullName = `${patient.firstName || ''} ${patient.lastName || ''}`.trim();
                            const patientId = patient.patientId || '';
                            const mobileNumber = patient.mobileNumber || '';

                            const matchesSearch =
                                fullName.toLowerCase().includes(searchTerm) ||
                                patientId.toLowerCase().includes(searchTerm) ||
                                mobileNumber.includes(searchTerm);

                            let matchesGender = true;
                            if (genderFilter !== 'All') {
                                matchesGender = patient.gender === genderFilter;
                            }

                            return matchesSearch && matchesGender;
                        });

                        displayPatientPage(1);
                    }

                    function displayPatientPage(page) {
                        localStorage.setItem('currentPagePatients', page);
                        const start = (page - 1) * itemsPerPagePatients;
                        const end = start + itemsPerPagePatients;
                        const itemsToShow = filteredPatientDetails.slice(start, end);

                        const patientContainer = document.getElementById('patientContainer');
                        patientContainer.innerHTML = '';

                        updateEntriesInfo(start + 1, Math.min(end, filteredPatientDetails.length), filteredPatientDetails.length);

                        if (itemsToShow.length === 0) {
                            const noMatchesRow = document.createElement('tr');
                            noMatchesRow.innerHTML = '<td colspan="8" class="text-center">No matches found.</td>';
                            patientContainer.appendChild(noMatchesRow);
                        } else {
                            itemsToShow.forEach((value, index) => {
                                const patientRow = document.createElement('tr');

                                patientRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${value.patientId}</td>
                <td style="font-size: 16px" class="pt-3">${value.firstName} ${value.lastName}</td>
                <td style="font-size: 16px" class="pt-3">${value.mobileNumber}</td>
                <td style="font-size: 16px" class="pt-3">${value.gender}</td>
                <td style="font-size: 16px" class="pt-3">${value.age}</td>
                <td style="font-size: 16px" class="pt-3">
                    <a href="<?php echo base_url(); ?>Chiefconsultant/healthCareProvidersProfile/${value.patientHcpDbId}" class="text-dark" onmouseover="style='text-decoration:underline'" onmouseout="style='text-decoration:none'">${value.patientHcp}</a>
                </td>
                <td style="font-size: 16px">
                    <a href="<?php echo base_url(); ?>Chiefconsultant/patientdetails/${value.id}" class="px-1"><button class="btn btn-success"><i class="bi bi-eye"></i></button></a>
                </td>`;
                                patientContainer.appendChild(patientRow);
                            });
                        }
                        generatePatientPagination(filteredPatientDetails.length, page);
                    }

                    function updateEntriesInfo(start, end, totalEntries) {
                        const entriesInfo = document.getElementById('entriesInfo');
                        entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                    }

                    function generatePatientPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPagePatients);
                        const paginationContainer = document.getElementById('paginationContainerPatients');
                        paginationContainer.innerHTML = '';

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        const prevLi = document.createElement('li');
                        prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                        prevLi.onclick = () => {
                            if (currentPage > 1) displayPatientPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, currentPage + 2);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#0079AD' : 'transparent'};">${i}</button></a>`;
                            li.onclick = () => displayPatientPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                        nextLi.onclick = () => {
                            if (currentPage < totalPages) displayPatientPage(currentPage + 1);
                        };
                        ul.appendChild(nextLi);

                        paginationContainer.appendChild(ul);
                    }

                    toggleClearIcons();
                    filteredPatientDetails = [...patientDetails];
                    displayPatientPage(initialPagePatients);
                </script>

            <?php
        } else if ($method == "patientDetails") {
            ?>

                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500"> Patient Details</p>
                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                        class="bi bi-arrow-left"></i> Back</button>
                            </div>
                            <div class="card-body p-3 px-sm-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                    <div class="d-sm-flex text-center mb-4">
                                <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                            <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>" alt="Profile Photo"
                                                width="140" height="140" class="rounded-circle"
                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
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
                                    <p class="my-3 mt-3 fs-5 fw-semibold">Personal Details</p>
                                    <div class="d-md-flex">
                                        <p class="col-sm-6"><span class="text-secondary ">Mobile number</span> : <a
                                                href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?></a></p>
                                        <p><span class="text-secondary ">Alternate mobile</span> :
                                    <?php echo $value['alternateMobile'] ? $value['alternateMobile'] : "Not provided"; ?>
                                        </p>
                                    </div>
                                    <div class="d-md-flex">
                                        <p class="col-sm-6"><span class="text-secondary ">Email address</span> :
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
                                    <p class="mb-2"><span class="text-secondary ">Registration Date </span> :
                                <?php echo date('d-M-Y', strtotime($value['created_at'])); ?>
                                    </p>
                        <?php } ?>
                                <p class="fs-5 fw-semibold mt-3">All Consultations</p>
                        <?php if (!empty($consultations)): ?>
                                    <div class="consultation-container">
                                        <div class="d-flex justify-content-end mb-2">
                                            <div class="consultation-nav">
                                                <button id="nav-left" class="btn btn-outline-secondary me-2"
                                                    onclick="navigateConsultations(-1)">&#9664;</button>
                                                <span id="consultation-counter">
                                                    < 1 of <?= count($consultations) ?> >
                                                </span>
                                                <button id="nav-right" class="btn btn-outline-secondary ms-2"
                                                    onclick="navigateConsultations(1)">&#9654;</button>
                                            </div>
                                        </div>
                                    <?php
                                    usort($consultations, function ($a, $b) {
                                        return strtotime($b['created_at']) - strtotime($a['created_at']);
                                    });
                                    ?>
                                <?php foreach ($consultations as $index => $consultation): ?>
                                            <div class="consultation-item <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                                                <div class="border border-5 mb-3 shadow-sm">
                                                    <div class="card-body" id="consultation-content-<?= $consultation['id'] ?>">
                                                        <div class="d-md-flex justify-content-between">
                                                            <h5 class="card-title mb-0">
                                                        <?= date('d M Y', strtotime($consultation['consult_date'])) . " - " . date('h:i A', strtotime($consultation['consult_time'])) ?>
                                                            </h5>
                                                        </div>

                                                        <!-- Vitals -->
                                                <?php if (!empty($consultation['vitals'])): ?>
                                                            <p><strong>Vitals:</strong></p>
                                                            <div class="row g-2 mb-4">
                                                            <?php
                                                            $vitals = [
                                                                'Height' => !empty($consultation['vitals']['height_cm']) ? $consultation['vitals']['height_cm'] . ' cm' : null,
                                                                'Weight' => !empty($consultation['vitals']['weight_kg']) ? $consultation['vitals']['weight_kg'] . ' kg' : null,
                                                                'BMI' => !empty($consultation['vitals']['body_mass_index']) ? $consultation['vitals']['body_mass_index'] . ' kg/m²' : null,
                                                                'BP' => (!empty($consultation['vitals']['systolic_bp']) && !empty($consultation['vitals']['diastolic_bp'])) ? $consultation['vitals']['systolic_bp'] . '/' . $consultation['vitals']['diastolic_bp'] . ' mmHg' : null,
                                                                'Cholesterol' => !empty($consultation['vitals']['cholesterol_mg_dl']) ? $consultation['vitals']['cholesterol_mg_dl'] . ' mg/dL' : null,
                                                                'Fasting Blood Sugar' => !empty($consultation['vitals']['blood_sugar_fasting']) ? $consultation['vitals']['blood_sugar_fasting'] . ' mg/dL' : null,
                                                                'PP Blood Sugar' => !empty($consultation['vitals']['blood_sugar_pp']) ? $consultation['vitals']['blood_sugar_pp'] . ' mg/dL' : null,
                                                                'Random Blood Sugar' => !empty($consultation['vitals']['blood_sugar_random']) ? $consultation['vitals']['blood_sugar_random'] . ' mg/dL' : null,
                                                                'SPO2' => !empty($consultation['vitals']['spo2_percent']) ? $consultation['vitals']['spo2_percent'] . ' %' : null,
                                                                'Temperature' => !empty($consultation['vitals']['temperature_f']) ? $consultation['vitals']['temperature_f'] . ' °F' : null,
                                                            ];

                                                            foreach ($vitals as $label => $value):
                                                                if ($value):
                                                                    ?>
                                                                        <div class="col-12 col-md-6">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center border p-2 rounded">
                                                                                <span class="fw-medium"><?= $label ?>:</span>
                                                                                <span class="text-primary"><?= $value ?></span>
                                                                            </div>
                                                                        </div>
                                                                <?php
                                                                endif;
                                                            endforeach;
                                                            ?>
                                                            </div>
                                                <?php endif; ?>

                                                        <!-- Symptoms -->
                                                <?php if (!empty($consultation['symptoms'])): ?>
                                                            <p><strong>Symptoms:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['symptoms'] as $symptom): ?>
                                                                    <li>
                                                                <?= $symptom['symptom_name'] ?>
                                                                    <?php
                                                                    $details = [];
                                                                    if (!empty($symptom['since']))
                                                                        $details[] = $symptom['since'];
                                                                    if (!empty($symptom['severity']))
                                                                        $details[] = $symptom['severity'];
                                                                    if (!empty($symptom['note']))
                                                                        $details[] = $symptom['note'];
                                                                    if (!empty($details)) {
                                                                        echo ' (' . implode(', ', $details) . ')';
                                                                    }
                                                                    ?>
                                                                    </li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- Findings -->
                                                <?php if (!empty($consultation['findings'])): ?>
                                                            <p><strong>Findings:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['findings'] as $finding): ?>
                                                                    <li>
                                                                <?= $finding['finding_name'] ?>
                                                                    <?php
                                                                    $details = [];
                                                                    if (!empty($finding['since']))
                                                                        $details[] = $finding['since'];
                                                                    if (!empty($finding['severity']))
                                                                        $details[] = $finding['severity'];
                                                                    if (!empty($finding['note']))
                                                                        $details[] = $finding['note'];
                                                                    if (!empty($details)) {
                                                                        echo ' (' . implode(', ', $details) . ')';
                                                                    }
                                                                    ?>
                                                                    </li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- Diagnosis -->
                                                <?php if (!empty($consultation['diagnosis'])): ?>
                                                            <p><strong>Diagnosis:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['diagnosis'] as $diagnosis): ?>
                                                                    <li>
                                                                <?= $diagnosis['diagnosis_name'] ?>
                                                                    <?php
                                                                    $details = [];
                                                                    if (!empty($diagnosis['since']))
                                                                        $details[] = $diagnosis['since'];
                                                                    if (!empty($diagnosis['severity']))
                                                                        $details[] = $diagnosis['severity'];
                                                                    if (!empty($diagnosis['note']))
                                                                        $details[] = $diagnosis['note'];
                                                                    if (!empty($details)) {
                                                                        echo ' (' . implode(', ', $details) . ')';
                                                                    }
                                                                    ?>
                                                                    </li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- Investigations -->
                                                <?php if (!empty($consultation['investigations'])): ?>
                                                            <p><strong>Investigations:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['investigations'] as $inv): ?>
                                                                    <li>
                                                                <?= htmlspecialchars($inv['investigation_name']) ?>
                                                                <?php if (!empty($inv['note'])): ?>
                                                                            - <?= htmlspecialchars($inv['note']) ?>
                                                                <?php endif; ?>
                                                                    </li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- Instructions -->
                                                <?php if (!empty($consultation['instructions'])): ?>
                                                            <p><strong>Instructions:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['instructions'] as $ins): ?>
                                                                    <li><?= $ins['instruction_name'] ?></li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- ====== Medicines ====== -->
                                                        <!-- ====== Medicines ====== -->
                                                <?php if (!empty($consultation['medicines'])): ?>
                                                            <p><strong>Medicines:</strong></p>
                                                            <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;"
                                                                class="mb-3">
                                                                <thead>
                                                                    <!-- First header row -->
                                                                    <tr>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            S.No</th>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            Name</th>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            Quantity</th>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            Food Timing</th>

                                                                        <!-- Frequency spanning four columns -->
                                                                        <th colspan="4"
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Frequency</th>

                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            Notes</th>
                                                                    </tr>

                                                                    <!-- Second header row for sub-columns -->
                                                                    <tr>
                                                                        <th style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Morning</th>
                                                                        <th style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Afternoon</th>
                                                                        <th style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Evevning</th>
                                                                        <th style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Night</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                            <?php if (!empty($consultation['medicines'])): ?>
                                                                <?php foreach ($consultation['medicines'] as $index => $medicine): ?>
                                                                        <?php
                                                                        // Safely split timing into 4 parts
                                                                        $timingString = isset($medicine['timing']) ? trim($medicine['timing']) : '0-0-0-0';
                                                                        $timingParts = preg_split('/\s*-\s*/', $timingString);
                                                                        $timingParts = array_pad($timingParts, 4, '0'); // ensure 4 values
                                                                        list($morning, $afternoon, $evening, $night) = $timingParts;
                                                                        ?>
                                                                            <tr>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= $index + 1 . '.' ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px;">
                                                                            <?php if (!empty($medicine['medicine_name'])): ?>
                                                                                <?php if (!empty($medicine['category'])): ?>
                                                                                            <small
                                                                                                class="text-muted">(<?= htmlspecialchars($medicine['category']) ?>)</small>
                                                                                <?php endif; ?>
                                                                                <?= htmlspecialchars($medicine['medicine_name']) ?>
                                                                            <?php else: ?>
                                                                                        -
                                                                            <?php endif; ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($medicine['quantity'] ?? '-') ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($medicine['food_timing'] ?? '-') ?>
                                                                                </td>

                                                                                <!-- Frequency split -->
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($morning !== '0' ? $morning : '-') ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($afternoon !== '0' ? $afternoon : '-') ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($evening !== '0' ? $evening : '-') ?>
                                                                                </td>
                                                                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars($night !== '0' ? $night : '-') ?>
                                                                                </td>

                                                                                <td style="border: 1px solid #000; padding: 6px;">
                                                                            <?= !empty($medicine['notes']) ? htmlspecialchars($medicine['notes']) : '-' ?>
                                                                                </td>
                                                                            </tr>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                        <tr>
                                                                            <td colspan="9"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                No medicines found.
                                                                            </td>
                                                                        </tr>
                                                            <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                <?php endif; ?>

                                                <?php if (!empty($consultation['attachments'])): ?>
                                                            <p><strong>Attachments:</strong></p>
                                                            <ul>
                                                        <?php foreach ($consultation['attachments'] as $attach): ?>
                                                                <?php
                                                                $filePath = base_url('uploads/consultations/' . $attach['file_name']);
                                                                $ext = pathinfo($attach['file_name'], PATHINFO_EXTENSION);
                                                                ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="openAttachment"
                                                                            data-file="<?= $filePath ?>" data-ext="<?= $ext ?>">
                                                                    <?= $attach['file_name'] ?>
                                                                        </a>
                                                                    </li>
                                                        <?php endforeach; ?>
                                                            </ul>
                                                <?php endif; ?>


                                                        <!-- Notes -->
                                                <?php if (!empty($consultation['notes'])): ?>
                                                            <p><strong>Notes:</strong></p>
                                                            <ul>
                                                                <li><?= $consultation['notes'] ?></li>
                                                            </ul>
                                                <?php endif; ?>

                                                        <!-- Next Follow-Up -->
                                                <?php if (!empty($consultation['next_follow_up'])): ?>
                                                            <p><strong>Next Follow-Up Date:</strong></p>
                                                            <ul>
                                                                <li><?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
                                                                </li>
                                                            </ul>
                                                <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                <?php endforeach; ?>
                                    </div>
                        <?php else: ?>
                                    <p>No Previous Consultation.</p>
                        <?php endif; ?>
                            </div>
                        </div>
                    </section>

                    <!-- Previous and Next arrows script -->
                    <script>
                        let currentIndex = 0;
                        const consultationItems = document.querySelectorAll('.consultation-item');
                        const totalItems = consultationItems.length;
                        const counterDisplay = document.getElementById('consultation-counter');
                        const navLeft = document.getElementById('nav-left');
                        const navRight = document.getElementById('nav-right');

                        function updateCounterAndButtons() {
                            counterDisplay.textContent = ` ${currentIndex + 1} of ${totalItems} `;
                            navLeft.disabled = currentIndex === 0;
                            navRight.disabled = currentIndex === totalItems - 1;
                        }

                        function navigateConsultations(direction) {
                            if ((direction === -1 && currentIndex === 0) || (direction === 1 && currentIndex === totalItems - 1)) {
                                return;
                            }
                            consultationItems[currentIndex].classList.remove('active');
                            currentIndex = (currentIndex + direction + totalItems) % totalItems;
                            consultationItems[currentIndex].classList.add('active');
                            updateCounterAndButtons();
                        }

                        document.addEventListener('keydown', function (event) {
                            if (event.key === 'ArrowLeft' && currentIndex > 0) {
                                navigateConsultations(-1);
                            } else if (event.key === 'ArrowRight' && currentIndex < totalItems - 1) {
                                navigateConsultations(1);
                            }
                        });

                        updateCounterAndButtons();
                    </script>

            <?php
        } else if ($method == "appointments") {
            ?>
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
                                            <table class="table table-hoverr class=" pt-3" text-center" id="appointmentTable">
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
                                                            COMPLAINT
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
                                                        echo date("d-M-Y", strtotime($value['dateOfAppoint']));
                                                    } ?>
                                                            </td>
                                                            <td style="font-size: 16px" class="pt-3">
                                                    <?php echo date('h:i A', strtotime($value['timeOfAppoint'])); ?>
                                                            </td>
                                                            <td style="font-size: 16px" class="pt-3"><a
                                                                    href="<?php echo base_url() . "Chiefconsultant/healthCareProvidersProfile/" . $value['hcpDbId']; ?>"
                                                                    class="text-dark" onmouseover="style='text-decoration:underline'"
                                                                    onmouseout="style='text-decoration:none'"><?php echo $value['patientHcp'] ?></a>
                                                            </td>
                                                            <td style="font-size: 16px" class="pt-3">
                                                    <?php echo $value['patientComplaint'] != '' ? $value['patientComplaint'] : "-"; ?>
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

                                                        $isWithin20Minutes = ($currentDateTime <= strtotime('+20 minutes', $appointmentDateTime)) &&
                                                            ($currentDateTime >= $appointmentDateTime);
                                                        $shouldEnableButton = $isToday && $isWithin20Minutes;

                                                        if ($shouldEnableButton) { ?>
                                                                    <a href="<?php echo base_url() . 'chiefconsultant/join/' . ltrim($value['appointmentLink'], '/'); ?>"
                                                                        target="_self" rel="noopener">
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

                <?php if (isset($hcpDetails[0]['id'])) {
                    ?>

                                    <div class="container">
                                        <div class="row justify-content-center" id="hcpContainer"></div>
                                        <div class="pagination justify-content-center mt-3" id="paginationContainerHcp"></div>
                                    </div>

                <?php } else { ?>
                                    <h5 class="card text-center p-3"><b>No Records Found.</b> </h5>
                <?php } ?>

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
                                        noMatchesDiv.innerHTML = '<p>No matches found.</p>';
                                        hcpContainer.appendChild(noMatchesDiv);
                                    } else {
                                        itemsToShow.forEach(value => {
                                            const hcpItem = document.createElement('div');
                                            hcpItem.className = 'card col-lg-4 m-3 hcp-item';
                                            hcpItem.innerHTML =
                                                '<div class=\'d-sm-flex justify-content-evenly text-center p-4\'>' +
                                                '<img src="' + (value.hcpPhoto ? '<?php echo base_url(); ?>uploads/' + value.hcpPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg') + 'alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto" ' +
                                                'onerror="this.onerror=null;this.src=\'<?php echo base_url(); ?>assets/BlankProfile.jpg\';">' +
                                                '<div>' +
                                                '<p class=\'card-title\'><b>' + value.hcpName + '</b> /<br>' + value.hcpId + '</p>' +
                                                '<p style=\'color: #0079AD;\'><b>' + value.hcpSpecialization + '</b></p>' +
                                                '<a href=\'<?php echo base_url(); ?>Chiefconsultant/healthCareProvidersProfile/' + value.id + '\' ' +
                                                'class=\'btn btn-secondary\'>Full Details</a>' +
                                                '</div>' +
                                                '</div>';
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
                                    prevLi.innerHTML =
                                        '<a href=\'#\'>' +
                                        '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === 1 ? 'disabled' : '') + '>&lt;</button>' +
                                        '</a>';
                                    prevLi.onclick = () => {
                                        if (currentPage > 1) displayHcpPage(currentPage - 1);
                                    };
                                    ul.appendChild(prevLi);

                                    for (let i = 1; i <= totalPages; i++) {
                                        const li = document.createElement('li');
                                        li.innerHTML =
                                            '<a href=\'#\'>' +
                                            '<button type=\'button\' class=\'btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '\'>' + i + '</button>' +
                                            '</a>';
                                        li.onclick = () => displayHcpPage(i);
                                        ul.appendChild(li);
                                    }

                                    const nextLi = document.createElement('li');
                                    nextLi.innerHTML =
                                        '<a href=\'#\'>' +
                                        '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === totalPages ? 'disabled' : '') + '>&gt;</button>' +
                                        '</a>';
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
                                <section>
                                    <div class="card rounded">
                                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                            <p style="font-size: 24px; font-weight: 500"> Health Care Provider Profile</p>
                                            <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                                    class="bi bi-arrow-left"></i> Back</button>
                                        </div>
                                        <div class="card-body p-3 p-sm-4">
                            <?php
                            foreach ($hcpDetails as $key => $value) {
                                ?>
                                                <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                        <img src="<?php echo base_url('uploads/' . $value['hcpPhoto']); ?>" alt="Profile Photo"
                                                            width="140" height="140" class="rounded-circle"
                                                            onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
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

                                                <p class="my-3 fs-5 fw-semibold">Profile Details</p>

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
                                                            <img src="<?php echo base_url('uploads/' . $value['ccPhoto']); ?>" alt="Profile Photo"
                                                                width="140" height="140" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
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

                                                    <div class="d-flex justify-content-between mt-2">
                                                        <p class="my-3 fs-5 fw-semibold">Profile Details :</p>

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
                                                        <form action="<?php echo base_url() . "Chiefconsultant/updateMyProfile" ?>" name="profileEditForm"
                                                            enctype="multipart/form-data" method="POST" onsubmit="return validateDetails()"
                                                            oninput="clearErrorDetails()" class="">
                                                            <div class="position-relative">
                                                                <img id="previewImage"
                                                                    src="<?= isset($value['ccPhoto']) && $value['ccPhoto'] !== "No data"
                                                                        ? base_url('uploads/' . $value['ccPhoto'])
                                                                        : base_url('assets/img/BlankProfileCircle.png') ?>"
                                                                    alt="Profile Photo" width="150" height="150" class="rounded-circle d-block mx-auto mb-4"
                                                                    style="box-shadow: 0px 4px 4px #0079AD; outline: 1px solid white;"
                                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                                                <input type="file" id="profilePhoto" name="profilePhoto"
                                                                    class="fieldStyle form-control p-3 image-input d-none" accept=".png, .jpg, .jpeg">
                                                                <a href="#" class="position-absolute rounded-circle px-2 py-1"
                                                                    style="color: #0079AD;border: 2px solid #0079AD;border-radius: 50%;top: 77%; left: 52%; transform: translateX(44%); "
                                                                    onclick="document.getElementById('profilePhoto').click();"><i
                                                                        class="bi bi-camera"></i></a>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label" for="drName">Full Name</label>
                                                                    <input type="text" class="form-control" id="drName" name="drName"
                                                                        value="<?php echo $value['doctorName']; ?>" placeholder="E.g. Suresh Kumar"
                                                                        style="cursor: no-drop;" disabled readonly>
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="drMobile">Mobile Number</label>
                                                                    <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                                        value="<?php echo $value['doctorMobile']; ?>" placeholder="E.g. 9632587410"
                                                                        style="cursor: no-drop;" disabled readonly>
                                                                </div>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label" for="drEmail">Email Id</label>
                                                                    <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                        value="<?php echo $value['doctorMail']; ?>" placeholder="E.g. example@gmail.com"
                                                                        style="cursor: no-drop;" disabled readonly>
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="specialization">Specialization</label>
                                                                    <select class="form-control" id="specialization" name="specialization"
                                                                        style="cursor: no-drop;" disabled readonly>
                                                                        <option value="" selected><?php echo $value['specialization'] ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label">Password</label><br>
                                                                    <a href="<?php echo base_url('Chiefconsultant/changePassword'); ?>"
                                                                        class="btn text-light" style="background-color: #0079AD;">
                                                                        Change Password</a>
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="dob">Date of Birth</label>
                                                                    <input type="date" class="form-control" id="dob" name="dob"
                                                                        value="<?php echo $value['dateOfBirth']; ?>">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label" for="yearOfExp">Years of Experience</label>
                                                                    <input type="text" class="form-control" id="yearOfExp" name="yearOfExp" maxlength="25"
                                                                        value="<?php echo $value['yearOfExperience']; ?>" placeholder="25">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="qualification">Qualification</label>
                                                                    <input type="text" class="form-control" id="qualification" name="qualification"
                                                                        maxlength="90" value="<?php echo $value['qualification']; ?>" placeholder="MBBS">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label" for="regDetails">Registration detail</label>
                                                                    <input type="text" class="form-control" id="regDetails" name="regDetails" maxlength="90"
                                                                        value="<?php echo $value['regDetails']; ?>"
                                                                        placeholder="Tamil Nadu Medical Council">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="membership">Membership</label>
                                                                    <input type="text" class="form-control" id="membership" name="membership" maxlength="90"
                                                                        value="<?php echo $value['membership']; ?>" placeholder="Life member IMA">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between py-3">
                                                                <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                    <label class="form-label" for="hospitalName">Hospital / Clinic Name</label><br>
                                                                    <input type="text" class="form-control" id="hospitalName" name="hospitalName"
                                                                        maxlength="90" value="<?php echo $value['hospitalName']; ?>" placeholder="MMCH">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                                <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                    <label class="form-label" for="location">Location</label><br>
                                                                    <input type="text" class="form-control" id="location" name="location" maxlength="90"
                                                                        value="<?php echo $value['location']; ?>" placeholder="Erode">
                                                                    <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                </div>
                                                            </div>
                                                            <div class="py-3">
                                                                <label class="form-label" for="services">Services</label><br>
                                                                <textarea class="form-control" id="services" name="services" rows="" cols="" maxlength="490"
                                                                    placeholder="Completed diabetes care under one roof"><?php echo $value['services']; ?></textarea>
                                                                <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                            </div>
                                                            <button type="reset" class="btn btn-secondary float-start mt-3">Reset</button>
                                                            <button type="submit" class="btn float-end mt-3 "
                                                                style="color: white;background-color: #0079AD;">Update</button>
                                                        </form>
                        <?php } ?>

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


            <?php
        } else if ($method == "passwordChange") {
            ?>
                                            <section>
                                                <div class="card rounded m-2">
                                                    <div class="d-flex justify-content-between mx-2 p-3 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500">
                                                            Change Password</p>
                                                        <a href="<?php echo base_url() . "Chiefconsultant/myProfile" ?>" class="float-end text-dark mt-2"><i
                                                                class="bi bi-arrow-left"></i> Back</a>
                                                    </div>
                                                    <div class="card-body">
                            <?php
                            foreach ($ccDetails as $key => $value) {
                                ?>
                                                            <form action="<?php echo base_url() . "Chiefconsultant/saveNewPassword" ?>" name="PasswordForm"
                                                                method="POST" class="" onsubmit="return validateNewPassword()" oninput="validateNewPassword()">
                                                                <div class="d-md-flex justify-content-between pb-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label pb-2" for="drName">Name</label>
                                                                        <input type="text" class="form-control" id="drName" name="drName"
                                                                            style="cursor: no-drop;" value="<?php echo $value['doctorName']; ?>"
                                                                            placeholder="Suresh Kumar" disabled readonly>
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label pb-2" for="drMobile">Mobile </label>
                                                                        <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                                            style="cursor: no-drop;" value="<?php echo $value['doctorMobile']; ?>"
                                                                            placeholder="9632587410" disabled readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between pt-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label pb-2" for="drEmail">Email</label>
                                                                        <div class="">
                                                                            <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                                style="cursor: no-drop;" value="<?php echo $value['doctorMail']; ?>"
                                                                                placeholder="example@gmail.com" disabled readonly>
                                                                        </div>
                                                                        <p type="button" class="float-end mt-2 m-0 p-0" style="color: #0079AD;"
                                                                            id="sendEmailOtpBtn" onclick="sendEmailOtp()"
                                                                            onmouseover="this.style.textDecoration='underline'"
                                                                            onmouseout="this.style.textDecoration='none'">Send
                                                                            OTP</p>
                                                                        <small id="emailOtpStatus" class="text-success"></small>
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label for="emailOtp" class="form-label pb-2">Enter OTP <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" id="emailOtp" maxlength="6" class="form-control"
                                                                            placeholder="Enter OTP" disabled>
                                                                        <small id="emailOtpError" class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label pb-2" for="drNewPassword">New Password <span
                                                                                class="text-danger">*</span></label>
                                                                        <div style="position: relative;">
                                                                            <input type="password" class="form-control" id="drNewPassword" name="drNewPassword"
                                                                                placeholder="Enter New Password">
                                                                            <i class="bi bi-eye-fill" onclick="togglePasswordVisibility('drNewPassword', this)"
                                                                                style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                                        </div>
                                                                        <small id="passwordError" class="text-danger"></small>
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label pb-2" for="drCnfmPassword">Confirm Password <span
                                                                                class="text-danger">*</span></label>
                                                                        <div style="position: relative;">
                                                                            <input type="password" class="form-control" id="drCnfmPassword"
                                                                                name="drCnfmPassword" placeholder="Re-Enter New Password">
                                                                            <i class="bi bi-eye-fill" onclick="togglePasswordVisibility('drCnfmPassword', this)"
                                                                                style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                                        </div>
                                                                        <small id="confirmPasswordError" class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="buttonStyle btn float-end mt-3 "
                                                                    style="color: white;background-color: #0079AD;">Save</button>
                                                            </form>
                        <?php } ?>
                                                    </div>
                                                </div>
                                            </section>

                                            <script>
                                                function togglePasswordVisibility(id, icon) {
                                                    const passwordField = document.getElementById(id);

                                                    if (passwordField.type === "password") {
                                                        passwordField.type = "text";
                                                        icon.classList.remove('bi-eye-fill');
                                                        icon.classList.add('bi-eye-slash-fill');
                                                    } else {
                                                        passwordField.type = "password";
                                                        icon.classList.remove('bi-eye-slash-fill');
                                                        icon.classList.add('bi-eye-fill');
                                                    }
                                                }
                                            </script>

                                            <script>
                                                function sendEmailOtp() {
                                                    const email = document.getElementById('drEmail').value.trim();

                                                    fetch("<?= base_url('Chiefconsultant/sendEmailOtp') ?>", {
                                                        method: "POST",
                                                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                                        body: `email=${encodeURIComponent(email)}`
                                                    })
                                                        .then(res => res.json())
                                                        .then(data => {
                                                            if (data.status === "success") {
                                                                document.getElementById('emailOtp').disabled = false;
                                                                document.getElementById('emailOtp').focus();
                                                                document.getElementById('emailOtpStatus').textContent = "OTP sent to your email.";
                                                                alert("OTP sent to your email.");
                                                            } else {
                                                                document.getElementById('emailOtpStatus').textContent = "Failed to send OTP.";
                                                            }
                                                        });
                                                }

                                                document.getElementById('emailOtp').addEventListener('input', () => {
                                                    const otp = document.getElementById('emailOtp').value.trim();

                                                    if (otp.length === 4) {
                                                        fetch("<?= base_url('Chiefconsultant/verifyEmailOtp') ?>", {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/x-www-form-urlencoded"
                                                            },
                                                            body: `otp=${otp}`
                                                        })
                                                            .then(res => res.json())
                                                            .then(data => {
                                                                if (data.status === "success") {
                                                                    document.getElementById('emailOtpError').textContent = "";
                                                                    document.getElementById('emailOtpStatus').textContent = "OTP verified successfully!";
                                                                    document.getElementById('emailOtp').disabled = true;
                                                                    document.getElementById('emailOtp').dataset.verified = "true";
                                                                } else {
                                                                    document.getElementById('emailOtpError').textContent = "Invalid OTP.";
                                                                    document.getElementById('emailOtpStatus').textContent = "";
                                                                    document.getElementById('emailOtp').dataset.verified = "false";
                                                                }
                                                            })
                                                            .catch(err => {
                                                                console.error("OTP verification error:", err);
                                                                document.getElementById('emailOtpError').textContent = "Server error during OTP verification.";
                                                            });
                                                    }
                                                });

                                                function validateNewPassword() {
                                                    let password = document.getElementById("drNewPassword").value.trim();
                                                    let confirmPassword = document.getElementById("drCnfmPassword").value.trim();
                                                    let otpVerified = document.getElementById("emailOtp").dataset.verified === "true";

                                                    let isValid = true;

                                                    if (password === "") {
                                                        document.getElementById("passwordError").textContent = "Password must be filled out.";
                                                        isValid = false;
                                                    } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                                                        document.getElementById("passwordError").textContent = "Password must contain uppercase, lowercase, number, special char and min 8 chars.";
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById("passwordError").textContent = "";
                                                    }

                                                    if (confirmPassword === "") {
                                                        document.getElementById("confirmPasswordError").textContent = "Please re-enter the password.";
                                                        isValid = false;
                                                    } else if (confirmPassword !== password) {
                                                        document.getElementById("confirmPasswordError").textContent = "Passwords do not match.";
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById("confirmPasswordError").textContent = "";
                                                    }

                                                    if (!otpVerified) {
                                                        document.getElementById('emailOtpError').textContent = "Please enter a valid OTP and wait for verification.";
                                                        isValid = false;
                                                    }

                                                    return isValid;
                                                }
                                            </script>
        <?php } ?>

        <!-- All modal files -->
        <?php include 'ccModals.php'; ?>

        <!-- Change Password Alert  -->
        <div class="modal fade" id="firstLoginAlert" tabindex="-1" role="dialog" aria-labelledby="firstLoginLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="firstLoginLabel"
                            style="font-family: Poppins, sans-serif;">Update Password Alert</h5>
                    </div>
                    <div class="modal-body">
                        <p>⚠️ Please change your temporary password immediately before proceeding any further.</p>
                        <div class="text-end">
                            <a href="<?php echo base_url('Chiefconsultant/changePassword'); ?>" class="btn text-light"
                                style="background-color: #0079AD;">Update
                                Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient Attachment Display Modal -->
        <div class="modal fade" id="dashboardPreviewModal" tabindex="-1" aria-labelledby="dashboardPreviewModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                            id="dashboardPreviewModalLabel">
                            Attachment Preview
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center position-relative p-0">

                        <div id="attachment-toolbar" class="d-flex justify-content-center align-items-center mb-1 mt-0"
                            style="height:43px;width:100%;background:#cccecfff;border-radius:5px;display:none;">
                            <button id="zoomOutBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom Out"
                                disabled><b style="font-size:1.2rem;">-</b></button>
                            <button id="zoomInBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom In"
                                disabled><b style="font-size:1.2rem;">+</b></button>
                            <button id="downloadAttachmentBtn" class="btn btn-secondary ms-3"><i
                                    class="bi bi-download"></i></button>
                        </div>

                        <button id="prevAttachment"
                            class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                            style="font-size:1.5rem;" disabled><b>&lt;</b></button>
                        <button id="nextAttachment"
                            class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                            style="font-size:1.5rem;" disabled><b>&gt;</b></button>

                        <div class="preview-area">
                            <img id="attachmentImage" src="" alt="Attachment" class="img-fluid d-none"
                                style="transform-origin:top left;transition:transform .2s ease-out;">
                            <iframe id="attachmentPDF" src="" class="w-100" style="height:100%;border:none;"
                                frameborder="0"></iframe>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Sidebar script to highlight active menu item -->
    <script>
        <?php if ($method == "dashboard") { ?>
            document.getElementById('dashboard').style.color = "#66D1FF";
        <?php } elseif ($method == "patients" || $method == "patientDetails" || $method == "prescription") { ?>
            document.getElementById('patients').style.color = "#66D1FF";
        <?php } elseif ($method == "appointments") { ?>
            document.getElementById('appointments').style.color = "#66D1FF";
        <?php } elseif ($method == "hcps" || $method == "hcpsProfile") { ?>
            document.getElementById('healthCareProviders').style.color = "#66D1FF";
        <?php } ?>
    </script>

    <!-- Script to display patient attachments in modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalEl = document.getElementById('dashboardPreviewModal');
            const modal = new bootstrap.Modal(modalEl);
            const toolbarEl = document.getElementById('attachment-toolbar');
            const zoomInBtn = document.getElementById('zoomInBtn');
            const zoomOutBtn = document.getElementById('zoomOutBtn');
            const downloadBtn = document.getElementById('downloadAttachmentBtn');
            const prevBtn = document.getElementById('prevAttachment');
            const nextBtn = document.getElementById('nextAttachment');

            const imgEl = document.getElementById('attachmentImage');
            const pdfEl = document.getElementById('attachmentPDF');
            const previewArea = document.querySelector('.preview-area');

            let messageEl = null;
            let currentAttachments = [];
            let currentIdx = -1;
            const downloadedFiles = new Map(); // url → true

            // === OPEN ATTACHMENT ===
            document.querySelectorAll('.openAttachment').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const consultationContainer = this.closest('[data-consultation-id]') ||
                        this.closest('.consultation') ||
                        this.closest('div');
                    if (!consultationContainer) return;

                    const linksInGroup = consultationContainer.querySelectorAll('.openAttachment');
                    currentAttachments = [];
                    linksInGroup.forEach((l, idx) => {
                        const url = l.dataset.file;
                        const ext = l.dataset.ext.toLowerCase();
                        const fileName = l.textContent.trim() || url.split('/').pop().split('?')[0];
                        currentAttachments.push({ url, ext, fileName, link: l, index: idx });
                    });

                    const clickedUrl = this.dataset.file;
                    currentIdx = currentAttachments.findIndex(a => a.url === clickedUrl);
                    if (currentIdx === -1) return;

                    showFile(currentAttachments[currentIdx]);
                    modal.show();
                });
            });

            // === SHOW FILE ===
            function showFile(fileObj) {
                // Reset
                imgEl.classList.add('d-none');
                pdfEl.classList.add('d-none');
                if (messageEl) messageEl.remove();
                imgEl.src = '';
                pdfEl.src = '';
                toolbarEl.style.display = 'none';

                // ZOOM BUTTONS: FORCE ENABLED
                zoomInBtn.disabled = false;
                zoomOutBtn.disabled = false;
                zoomInBtn.removeAttribute('disabled');
                zoomOutBtn.removeAttribute('disabled');

                // Image
                if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'].includes(fileObj.ext)) {
                    imgEl.src = fileObj.url;
                    imgEl.classList.remove('d-none');
                    toolbarEl.style.display = 'flex';
                    enableImageZoom();

                    zoomInBtn.style.display = 'inline-block';
                    zoomOutBtn.style.display = 'inline-block';
                }
                // PDF
                else if (fileObj.ext === 'pdf') {
                    pdfEl.src = fileObj.url + '#toolbar=0';
                    pdfEl.classList.remove('d-none');
                    toolbarEl.style.display = 'flex';

                    zoomInBtn.style.display = 'none';
                    zoomOutBtn.style.display = 'none';
                }
                // Unsupported
                else {
                    messageEl = document.createElement('div');
                    messageEl.className = 'd-flex align-items-center justify-content-center h-100 text-muted position-absolute top-0 start-0 w-100 bg-white';
                    messageEl.style.zIndex = '5';
                    messageEl.innerHTML = `<p class="mb-0 fs-5">Preview not available for <strong>${fileObj.fileName}</strong></p>`;
                    previewArea.appendChild(messageEl);
                    toolbarEl.style.display = 'flex';

                    zoomInBtn.style.display = 'none';
                    zoomOutBtn.style.display = 'none';
                }

                // Navigation
                prevBtn.disabled = (currentIdx === 0);
                nextBtn.disabled = (currentIdx === currentAttachments.length - 1);
                prevBtn.onclick = () => { if (currentIdx > 0) showFile(currentAttachments[--currentIdx]); };
                nextBtn.onclick = () => { if (currentIdx < currentAttachments.length - 1) showFile(currentAttachments[++currentIdx]); };

                // Download: Once per file
                const already = downloadedFiles.has(fileObj.url);
                downloadBtn.disabled = already;
                downloadBtn.innerHTML = already ? '<i class="bi bi-check2"></i>' : '<i class="bi bi-download"></i>';
                downloadBtn.title = already ? 'Downloaded' : '';

                downloadBtn.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (already) return;

                    downloadedFiles.set(fileObj.url, true);
                    downloadBtn.disabled = true;
                    downloadBtn.innerHTML = '<i class="bi bi-check2"></i>';
                    downloadBtn.title = 'Downloaded';

                    const patientIdP = document.querySelector('p[style*="font-weight:600"]');
                    const patientId = patientIdP ? patientIdP.textContent.trim() : 'unknown';
                    const newFileName = fileObj.fileName.replace(/^[^_]+/, `attachment_${patientId}`);

                    const a = document.createElement('a');
                    a.href = fileObj.url;
                    a.download = newFileName;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };
            }

            // === IMAGE ZOOM ===
            let imgScale = 1;
            const SCALE_STEP = 0.2;
            const MIN_SCALE = 0.4;
            const MAX_SCALE = 3;

            function enableImageZoom() {
                zoomInBtn.onclick = () => {
                    imgScale = Math.min(imgScale + SCALE_STEP, MAX_SCALE);
                    imgEl.style.transform = `scale(${imgScale})`;
                };
                zoomOutBtn.onclick = () => {
                    imgScale = Math.max(imgScale - SCALE_STEP, MIN_SCALE);
                    imgEl.style.transform = `scale(${imgScale})`;
                };
            }

            // === MODAL CLOSE RESET ===
            modalEl.addEventListener('hidden.bs.modal', function () {
                imgEl.src = '';
                pdfEl.src = '';
                imgEl.classList.add('d-none');
                pdfEl.classList.add('d-none');
                if (messageEl) messageEl.remove();
                imgScale = 1;
                toolbarEl.style.display = 'none';
                currentAttachments = [];
                currentIdx = -1;

                downloadedFiles.clear();

                // Re-enable zoom buttons
                zoomInBtn.disabled = false;
                zoomOutBtn.disabled = false;
                zoomInBtn.removeAttribute('disabled');
                zoomOutBtn.removeAttribute('disabled');
                zoomInBtn.style.display = 'inline-block';
                zoomOutBtn.style.display = 'inline-block';
            });
        });
    </script>

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

</body>

</html>