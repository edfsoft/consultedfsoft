<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>HCP Patients - EDF</title>
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

        #patientId: :-webkit-outer-spin-button,
        #patientId::-webkit-inner-spin-button,
        {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }

        .table-hoverr tbody tr:hover td,
        .table-hoverr tbody tr:hover th {
            background-color: rgba(0, 173, 142, 0.1) !important;
        }

        .fieldLink:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php $this->load->view('hcpHeader'); ?>

    <main id="main" class="main">
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
        if ($method == "patients") {
            ?>
            <section>
                <div class="card rounded">
                    <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                        <p style="font-size: 24px; font-weight: 500">
                            Patients
                        </p>
                        <a href="<?php echo base_url() . 'Healthcareprovider/patientform'; ?>">
                            <button style="background-color: #00ad8e;" class="text-light border-0 rounded float-end p-2">
                                <i class="bi bi-plus-square-fill"></i> Add Patient
                            </button>
                        </a>
                    </div>
                    <?php if (isset($patientList[0]['id'])) {
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
                                <table class="table text-center table-hoverr text-nowrap" id="patientTable">
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
                                            <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTIONS
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
            </section>

            <script>
                let itemsPerPagePatients = 10;
                const patientDetails = <?php echo json_encode($patientList); ?>;
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
                        const alternateMobileNumber = patient.alternateMobile || '';

                        const matchesSearch =
                            fullName.toLowerCase().includes(searchTerm) ||
                            patientId.toLowerCase().includes(searchTerm) ||
                            mobileNumber.includes(searchTerm) ||
                            alternateMobileNumber.includes(searchTerm);

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
                            let currentAge = value.age;

                            if (value.created_at) {
                                const createdDate = new Date(value.created_at);
                                const today = new Date();
                                let yearsDiff = today.getFullYear() - createdDate.getFullYear();

                                const hasBirthdayPassed =
                                    today.getMonth() > createdDate.getMonth() ||
                                    (today.getMonth() === createdDate.getMonth() && today.getDate() >= createdDate.getDate());
                                if (!hasBirthdayPassed) yearsDiff -= 1;

                                currentAge = parseInt(value.age) + yearsDiff;
                            }

                            const patientRow = document.createElement('tr');
                            patientRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td class="px-2">
                    <img src="${value.profilePhoto && value.profilePhoto !== 'No data' ? '<?php echo base_url(); ?>uploads/' + value.profilePhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg'}" alt="Profile" width="40" height="40" class="rounded-circle"  onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg') ?>';">
                </td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Consultation/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.patientId}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Consultation/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.firstName} ${value.lastName}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Consultation/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.mobileNumber}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Consultation/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.gender}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Consultation/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${currentAge}</a></td>
                <td class="pt-2" style="font-size: 16px;">
                    <a href="<?php echo base_url(); ?>Healthcareprovider/patientdetails/${value.id}" class="px-1"><button class="btn btn-success mb-1"><i class="bi bi-eye"></i></button></a>
                    <a href="<?php echo base_url(); ?>Consultation/consultation/${value.id}" class=""><button class="btn btn-secondary text-light mb-1"><i class="bi bi-calendar-check"></i></button></a>
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
                        li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#00ad8e' : 'transparent'};">${i}</button></a>`;
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

                // On load: Show all data, then render
                toggleClearIcons();
                filteredPatientDetails = [...patientDetails];
                displayPatientPage(initialPagePatients);
            </script>

            <?php
        } else if ($method == "patientDetailsForm") {
            ?>
                <section>
                    <div class="card rounded">
                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500"> New Patient </p>
                            <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>"
                                class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                        </div>

                        <div class="card-body px-md-4 pb-4">
                            <form action="<?php echo base_url() . "Healthcareprovider/addPatientsForm" ?>"
                                name="addPatientDetails" id="addPatientDetails" enctype="multipart/form-data" method="POST"
                                oninput="validatePatientDetails()" onsubmit="return submitPatientDetails(event)">
                                <div class="position-relative">
                                    <img id="previewImage" src="<?= base_url('assets/BlankProfileCircle.png') ?>"
                                        alt="Profile Photo" width="150" height="150" class="rounded-circle d-block mx-auto mb-4"
                                        style="box-shadow: 0px 4px 4px rgba(5, 149, 123, 0.7); outline: 1px solid white;"
                                        onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                    <input type="file" id="profilePhoto" name="profilePhoto"
                                        class="fieldStyle form-control p-3 image-input d-none" accept=".png, .jpg, .jpeg">
                                    <img src="<?= base_url('assets/nurseCameraIcon.svg') ?>" alt="Edit Image" height="40"
                                        width="40" class="position-absolute"
                                        style="cursor: pointer; top: 75%; left: 50%; transform: translateX(44%);"
                                        onclick="document.getElementById('profilePhoto').click();">
                                </div>
                                <p class="pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                    <button
                                        style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                        class="text-light rounded-circle border-0">1</button> Basic Details
                                </p>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientName">First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="patientName" name="patientName"
                                            maxlength="30" placeholder="E.g. Siva">
                                        <small id="patientName_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientLastName">Last Name</label>
                                        <input type="text" class="form-control" id="" name="patientLastName" maxlength="30"
                                            placeholder="E.g. Kumar">
                                        <small id="patientLastName_err" class="text-danger pt-1"></small>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientMobile">Mobile Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                            maxlength="10" placeholder="E.g. 9638527410">
                                        <small id="patientMobile_err" class="text-danger pt-1"></small>
                                        <small id="duplicateMobile_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientAltMobile">Alternate Moblie
                                            Number</label>
                                        <input type="text" class="form-control" id="patientAltMobile" name="patientAltMobile"
                                            maxlength="10" placeholder="E.g. 9876543210">
                                        <small id="patientAltMobile_err" class="text-danger pt-1"></small>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientEmail">Email Id</label>
                                        <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                            placeholder="E.g. example@gmail.com" maxlength="50">
                                        <small id="patientEmail_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientGender">Gender <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="patientGender" name="patientGender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <small id="patientGender_err" class="text-danger pt-1"></small>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientAge">Age <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="patientAge" name="patientAge" min="0"
                                            max="121" maxlength="3" placeholder="E.g. 96">
                                        <small id="patientAge_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
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
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientMarital">Marital Status</label>
                                        <select class="form-select" id="patientMarital" name="patientMarital">
                                            <option value="">Select Marital Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                        <small id="patientMarital_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="marriedSince">Married Since</label>
                                        <input type="text" class="form-control" id="marriedSince" name="marriedSince"
                                            maxlength="20" placeholder="E.g. 2012">
                                    </div>
                                </div>
                                <p class="pt-4 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                    <button
                                        style="width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                        class="text-light rounded-circle border-0">2</button> Additional
                                    Information
                                </p>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientProfessions">Patient's
                                            Profession</label>
                                        <input type="text" class="form-control" id="patientProfessions"
                                            name="patientProfessions" maxlength="30" placeholder="E.g. IT employee">
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientDoorNo">Door Number</label>
                                        <input type="text" class="form-control" id="patientDoorNo" name="patientDoorNo"
                                            maxlength="30" placeholder="E.g. 96">
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientStreet">Street Address</label>
                                        <input type="text" class="form-control" id="patientStreet" name="patientStreet"
                                            maxlength="50" placeholder="E.g. Abc street">
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientDistrict">District</label>
                                        <input type="text" class="form-control" id="patientDistrict" name="patientDistrict"
                                            maxlength="30" placeholder="E.g. Erode">
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientPincode">Pincode</label>
                                        <input type="text" class="form-control" id="patientPincode" name="patientPincode"
                                            maxlength="6" placeholder="E.g. 638001">
                                    </div>

                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="partnersName">Guardian's Name </label>
                                        <input type="text" class="form-control" id="partnersName" name="partnersName"
                                            maxlength="30" placeholder="E.g. Rohith">
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="partnerMobile">Guardian's Mobile</label>
                                        <input type="text" class="form-control" id="partnerMobile" name="partnerMobile"
                                            minlength="10" maxlength="10" placeholder="E.g. 9874563210">
                                        <small id="partnerMobile_err" class="text-danger pt-1"></small>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
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
                                </div>
                                <button type="submit" class="btn float-end text-light mt-2"
                                    style="background-color: #00ad8e;">Add</button>
                            </form>
                        </div>
                    </div>
                </section>


            <?php
        } else if ($method == "patientDetailsFormUpdate") {
            ?>
                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500">Edit Patient Details</p>
                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                        class="bi bi-arrow-left"></i> Back</button>
                            </div>
                            <div class="card-body p-3 p-sm-4">
                                <div class="container">
                                <?php
                                foreach ($patientDetails as $key => $value) {
                                    ?>
                                        <form action="<?php echo base_url() . "Healthcareprovider/updatePatientsForm" ?>"
                                            name="editPatientDetails" id="editPatientDetails" enctype="multipart/form-data"
                                            method="POST" oninput="validatePatientDetails()"
                                            onsubmit="return submitPatientDetails(event)">
                                            <div class="position-relative">
                                                <img id="previewImage" src="<?= isset($value['profilePhoto']) && $value['profilePhoto'] !== "No data"
                                                    ? base_url('uploads/' . $value['profilePhoto'])
                                                    : base_url('assets/img/BlankProfileCircle.png') ?>"
                                                    alt="Profile Photo" width="150" height="150"
                                                    class="rounded-circle d-block mx-auto mb-4"
                                                    style="box-shadow: 0px 4px 4px rgba(5, 149, 123, 0.7); outline: 1px solid white;"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                                <input type="file" id="profilePhoto" name="profilePhoto"
                                                    class="fieldStyle form-control p-3 image-input d-none" accept=".png, .jpg, .jpeg">
                                                <img src="<?= base_url('assets/nurseCameraIcon.svg') ?>" alt="Edit Image" height="40"
                                                    width="40" class="position-absolute"
                                                    style="cursor: pointer; top: 75%; left: 50%; transform: translateX(44%);"
                                                    onclick="document.getElementById('profilePhoto').click();">
                                            </div>
                                            <button type="submit" class="btn text-light float-end"
                                                style="background-color: #00ad8e;">Update</button>
                                            <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">1</button> Basic Details
                                            </p>
                                            <div class="d-md-flex justify-content-between py-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientName">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="patientName" name="patientName"
                                                        value="<?php echo $value['firstName'] ?>" maxlength="30"
                                                        placeholder="E.g. Siva">
                                                    <small id="patientName_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="" name="patientLastName"
                                                        value="<?php echo $value['lastName'] ?>" maxlength="30"
                                                        placeholder="E.g. Kumar">
                                                    <small id="patientLastName_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientMobile">Moblie Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                                        value="<?php echo $value['mobileNumber'] ?>" maxlength="10"
                                                        placeholder="E.g. 9638527410">
                                                    <small id="patientMobile_err" class="text-danger pt-1"></small>
                                                    <small id="duplicateMobile_err" class="text-danger pt-1"></small>
                                                    <input type="hidden" id="oldMobile" value="<?php echo $value['mobileNumber']; ?>">
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                        Number</label>
                                                    <input type="text" class="form-control" id="patientAltMobile"
                                                        name="patientAltMobile" value="<?php echo $value['alternateMobile'] ?>"
                                                        maxlength="10" placeholder="E.g. 9876543210">
                                                    <small id="patientAltMobile_err" class="text-danger pt-1"></small>
                                                    <input type="hidden" id="oldAltMobile"
                                                        value="<?php echo $value['alternateMobile']; ?>">
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientEmail">Email</label>
                                                    <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                                        value="<?php echo $value['mailId'] ?>" placeholder="E.g. example@gmail.com"
                                                        maxlength="50">
                                                    <small id="patientEmail_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientGender">Gender <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="patientGender" name="patientGender">
                                                        <option value="">Select Gender</option>
                                                        <option value="Male" <?php if (isset($value['gender']) && $value['gender'] === 'Male')
                                                            echo 'selected'; ?>>Male</option>
                                                        <option value="Female" <?php if (isset($value['gender']) && $value['gender'] === 'Female')
                                                            echo 'selected'; ?>>Female</option>
                                                    </select>
                                                    <small id="patientGender_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                            <?php
                                            $createdDate = new DateTime($value['created_at']);
                                            $today = new DateTime();
                                            $diff = $today->diff($createdDate);
                                            $currentAge = $value['age'] + $diff->y;
                                            ?>
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientAge">Age
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" class="form-control" id="patientAge" name="patientAge" min="0"
                                                        max="121" maxlength="3" value="<?php echo $currentAge; ?>"
                                                        placeholder="E.g. 41">
                                                    <small id="patientAge_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
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
                                                    <small id="patientBlood_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientMarital">Marital Status</label>
                                                    <select class="form-select" id="patientMarital" name="patientMarital">
                                                        <option value="">Select Marital Status</option>
                                                        <option value="Single" <?php if (isset($value['maritalStatus']) && $value['maritalStatus'] === 'Single')
                                                            echo 'selected'; ?>>Single</option>
                                                        <option value="Married" <?php if (isset($value['maritalStatus']) && $value['maritalStatus'] === 'Married')
                                                            echo 'selected'; ?>>Married
                                                        </option>
                                                    </select>
                                                    <small id="patientMarital_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="marriedSince">Married Since</label>
                                                    <input type="text" class="form-control" id="marriedSince"
                                                        value="<?php echo $value['marriedSince'] ?>" name="marriedSince" maxlength="20"
                                                        placeholder="E.g. 2012">
                                                </div>
                                            </div>

                                            <p class="py-3" style="font-size: 20px; font-weight: 500;color:#00ad8e"> <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">2</button> Additional Information
                                            </p>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientProfessions">Patient's
                                                        Profession</label>
                                                    <input type="text" class="form-control" id="patientProfessions"
                                                        name="patientProfessions" value="<?php echo $value['profession'] ?>"
                                                        maxlength="30" placeholder="E.g. IT employee">
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientDoorNo">Door Number</label>
                                                    <input type="text" class="form-control" id="patientDoorNo" name="patientDoorNo"
                                                        value="<?php echo $value['doorNumber'] ?>" maxlength="30" placeholder="E.g. 96">
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientStreet">Street Address</label>
                                                    <input type="text" class="form-control" id="patientStreet" name="patientStreet"
                                                        value="<?php echo $value['address'] ?>" maxlength="30"
                                                        placeholder="E.g. Abc street">
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientDistrict">District</label>
                                                    <input type="text" class="form-control" id="patientDistrict" name="patientDistrict"
                                                        value="<?php echo $value['district'] ?>" maxlength="30"
                                                        placeholder="E.g. Erode">
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientPincode">Pincode</label>
                                                    <input type="text" class="form-control" id="patientPincode" name="patientPincode"
                                                        value="<?php echo $value['pincode'] ?>" maxlength="6" placeholder="E.g. 638001">
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="partnersName">Guardian's Name </label>
                                                    <input type="text" class="form-control" id="partnersName" name="partnersName"
                                                        value="<?php echo $value['partnerName'] ?>" maxlength="30"
                                                        placeholder="E.g. Rohith">
                                                    <small id="partnersName_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="partnerMobile">Guardian's Mobile </label>
                                                    <input type="text" class="form-control" id="partnerMobile" name="partnerMobile"
                                                        value="<?php echo $value['partnerMobile'] ?>" maxlength="10"
                                                        placeholder="E.g. 9874563210">
                                                    <small id="partnerMobile_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
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
                                            </div>
                                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                                value="<?php echo $value['id']; ?>">
                                            <div class="d-flex justify-content-between mt-3">
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                <button type="submit" class="btn text-light"
                                                    style="background-color: #00ad8e;">Update</button>
                                            </div>
                                        </form>
                            <?php } ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </section>

            <?php
        } elseif ($method == "patientDetails") {
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
                                    <div class="d-sm-flex text-center mb-4 position-relative">
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
                                        <?php
                                        $createdDate = new DateTime($value['created_at']);
                                        $today = new DateTime();
                                        $diff = $today->diff($createdDate);
                                        $currentAge = $value['age'] + $diff->y;
                                        ?>
                                            <p> <?php echo $value['gender'] ?> | <?php echo $currentAge; ?> Year(s)</p>
                                        </div>
                                        <div class="position-absolute top-0 end-0 m-2 d-flex flex-column gap-2 align-items-end">
                                            <a
                                                href="<?php echo base_url() . "Healthcareprovider/patientformUpdate/" . $value['id']; ?>">
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-pen"></i> Edit
                                                </button>
                                            </a>
                                            <a href="<?php echo base_url() . "Consultation/consultation/" . $value['id']; ?>">
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-calendar-check"></i> Consult
                                                </button>
                                            </a>
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
                                            <!-- <?php echo $value['age']; ?> -->
                                    <?php echo $currentAge; ?>
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
                        <?php } ?>
                            </div>
                        </div>
                    </section>

        <?php } ?>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

        <!-- Mobile number already exist message display modal - 2 palces [Add, Edit patient details] -->
        <div class="modal fade" id="duplicateMobileModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Mobile Number Exists
                        </h5>
                    </div>
                    <div class="modal-body" id="duplicateDetails"></div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button class="btn btn-secondary" id="dupCloseBtn">Cancel</button>
                        <button class="btn btn-success" id="dupAddAnywayBtn">Add Anyway</button>
                        <button class="btn btn-warning" id="dupEditBtn">Edit Number</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient Profile Photo -->
        <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Upload Profile Photo
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="cropperImage" style="max-width: 100%;" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cropImageBtn" class="btn text-light my-3 py-auto px-4"
                            style="background-color: #00ad8e;">Crop</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        <?php if ($method == "patients" || $method == "patientDetailsForm" || $method == "patientDetailsFormUpdate" || $method == "patientDetails" || $method == "prescription") { ?>
            document.getElementById('patients').style.color = "#87F7E3";
        <?php } ?>
    </script>

    <!-- Patient add and edit validation script -->
    <script>
        function validatePatientDetails() {
            let isValid = true;

            var name = document.getElementById("patientName").value.trim();
            var mobile = document.getElementById("patientMobile").value;
            var gender = document.getElementById("patientGender").value;
            var age = document.getElementById("patientAge").value;
            var gdMob = document.getElementById("partnerMobile").value;
            var AltMob = document.getElementById("patientAltMobile").value;

            // === NAME ===
            if (name === "") {
                document.getElementById("patientName_err").innerHTML = "Please enter a first name";
                isValid = false;
            } else {
                document.getElementById("patientName_err").innerHTML = "";
            }

            // === MOBILE NUMBER (Patient) - MUST BE EXACTLY 10 DIGITS ===
            if (mobile === "") {
                document.getElementById("patientMobile_err").innerHTML = "Please enter a mobile number";
                isValid = false;
            } else if (mobile.length !== 10 || !/^\d{10}$/.test(mobile)) {
                document.getElementById("patientMobile_err").innerHTML = "Please enter a valid 10-digit mobile number";
                isValid = false;
            } else {
                document.getElementById("patientMobile_err").innerHTML = "";
            }

            // === GENDER ===
            if (gender === "") {
                document.getElementById("patientGender_err").innerHTML = "Please select a gender";
                isValid = false;
            } else {
                document.getElementById("patientGender_err").innerHTML = "";
            }

            // === AGE ===
            if (age === "") {
                document.getElementById("patientAge_err").innerHTML = "Please enter an age";
                isValid = false;
            } else if (parseInt(age) > 120 || parseInt(age) < 1) {
                document.getElementById("patientAge_err").innerHTML = "Please enter a valid age (1-120)";
                isValid = false;
            } else {
                document.getElementById("patientAge_err").innerHTML = "";
            }

            // === PARTNER MOBILE (Optional but must be 10 digits if provided) ===
            if (gdMob !== "" && !/^\d{10}$/.test(gdMob)) {
                document.getElementById("partnerMobile_err").innerHTML = "Please enter a valid 10-digit mobile number";
                isValid = false;
            } else {
                document.getElementById("partnerMobile_err").innerHTML = "";
            }

            // === ALTERNATE MOBILE (Optional but must be 10 digits if provided) ===
            if (AltMob !== "" && !/^\d{10}$/.test(AltMob)) {
                document.getElementById("patientAltMobile_err").innerHTML = "Please enter a valid 10-digit mobile number";
                isValid = false;
            } else {
                document.getElementById("patientAltMobile_err").innerHTML = "";
            }

            return isValid;
        }
    </script>

    <!-- Patient profile photo add and edit page -->
    <script>
        let cropper;
        let activeInput = null;

        document.querySelectorAll(".image-input").forEach((input) => {
            input.addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (!file) return;

                const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
                if (!allowedTypes.includes(file.type)) {
                    alert("Only JPG, JPEG, PNG allowed.");
                    input.value = "";
                    return;
                }

                if (file.size > 1 * 1024 * 1024) {
                    alert("Max file size is 1MB.");
                    input.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    const image = document.getElementById("cropperImage");
                    image.src = event.target.result;

                    const modal = new bootstrap.Modal(document.getElementById("cropModal"));
                    modal.show();

                    activeInput = input;

                    if (cropper) cropper.destroy();

                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                        responsive: true,
                        scalable: true,
                        zoomable: true,
                        minContainerWidth: 600,
                        minContainerHeight: 600,
                        ready() {
                            cropper.setCropBoxData({
                                width: 200,
                                height: 200,
                            });
                        },
                    });
                };
                reader.readAsDataURL(file);
            });
        });

        document.getElementById("cropImageBtn").addEventListener("click", function () {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });

            canvas.toBlob((blob) => {
                const file = new File([blob], "cropped.jpg", { type: "image/jpeg" });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                activeInput.files = dataTransfer.files;

                // Show preview
                const preview = document.getElementById("previewImage");
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);

                bootstrap.Modal.getInstance(document.getElementById("cropModal")).hide();
                cropper.destroy();
                cropper = null;
            }, "image/jpeg");
        });

    </script>

    <!-- Check Mobile Number, Alternate mobile number already exist or not -->
    <!-- Need to update for Mail id check, currently only one mobile check at a time so change method to check all 3 at a time in future -->
    <script>
        function checkDuplicateNumber(number, patientId, callback) {

            const formData = new URLSearchParams();
            formData.append('value', number);
            if (patientId) {
                formData.append('patientId', patientId);
            }

            fetch("<?= base_url('Healthcareprovider/check_duplicate_mobile') ?>", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData
            })
                .then(res => res.json())
                .then(data => callback(data))
                .catch(() => callback({ exists: false }));
        }

        function submitPatientDetails(event) {
            event.preventDefault();

            if (!validatePatientDetails()) return false;

            const mobile = document.getElementById("patientMobile").value.trim();
            const alt = document.getElementById("patientAltMobile").value.trim();

            const oldMobile = document.getElementById("oldMobile")?.value || "";
            const oldAlt = document.getElementById("oldAltMobile")?.value || "";

            const patientId = document.getElementById("patientIdDb")?.value || "";

            const form = document.getElementById("addPatientDetails") ||
                document.getElementById("editPatientDetails");

            if (mobile !== oldMobile) {
                checkDuplicateNumber(mobile, patientId, function (res) {
                    if (res.exists) {
                        showDuplicateModal(res.data, mobile, 'Mobile Number');
                        return;
                    }
                    checkAlternate();
                });
            } else {
                checkAlternate();
            }

            function checkAlternate() {

                if (alt === "" || alt === oldAlt) {
                    form.submit();
                    return;
                }

                checkDuplicateNumber(alt, patientId, function (resAlt) {
                    if (resAlt.exists) {
                        showDuplicateModal(resAlt.data, alt, 'Alternate Mobile');
                    } else {
                        form.submit();
                    }
                });
            }
        }

        function showDuplicateModal(patients, number, type) {

            let html = `<p class="fw-semibold mb-2">${type} <b>${number}</b> already exists</p><ul>`;

            patients.forEach(p => {
                html += `<li>
        <b>${p.firstName} ${p.lastName}</b> (Patient ID: ${p.patientId})
    </li>`;
            });

            html += '</ul>';

            document.getElementById("duplicateDetails").innerHTML = html;

            const modal = new bootstrap.Modal(document.getElementById('duplicateMobileModal'));
            modal.show();
        }

        document.addEventListener("DOMContentLoaded", function () {

            const modalEl = document.getElementById("duplicateMobileModal");

            document.getElementById("dupEditBtn").onclick = () => {
                bootstrap.Modal.getInstance(modalEl).hide();
            };

            document.getElementById("dupAddAnywayBtn").onclick = () => {
                bootstrap.Modal.getInstance(modalEl).hide();
                const form = document.getElementById("addPatientDetails") || document.getElementById("editPatientDetails");
                form.submit();
            };

            document.getElementById("dupCloseBtn").onclick = () => {
                bootstrap.Modal.getInstance(modalEl).hide();
                window.history.back();
            };
        });
    </script>

    <!-- Consultation card show more and less -->
    <script>
        function toggleCard(btn) {
            const cardContent = btn.closest('.card').querySelector('.card-content');
            cardContent.classList.toggle('d-none');

            if (cardContent.classList.contains('d-none')) {
                btn.innerHTML = 'Show More <i class="bi bi-chevron-down"></i>';
            } else {
                btn.innerHTML = 'Show Less <i class="bi bi-chevron-up"></i>';
            }
        }
    </script>

    <!-- Go back function for patient edit details page -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- PDF Download link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

</body>

</html>