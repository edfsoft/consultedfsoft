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
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        body {
            font-family: "Poppins", sans-serif;
            /* scroll-padding-top: 290px; */
        }

        /* To remove the arrows in the  input type number*/
        /* #patientMobile::-webkit-outer-spin-button,
        #patientMobile::-webkit-inner-spin-button,
        #additionalContact::-webkit-outer-spin-button,
        #additionalContact::-webkit-inner-spin-button,
        #partnerMobile::-webkit-outer-spin-button,
        #partnerMobile::-webkit-inner-spin-button,
        #patientPincode::-webkit-outer-spin-button,
        #patientPincode::-webkit-inner-spin-button, 
        #patientAltMobile::-webkit-outer-spin-button,
        #patientAltMobile::-webkit-inner-spin-button, 
        #drMobile::-webkit-outer-spin-button,
        #drMobile::-webkit-inner-spin-button */

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

                        const matchesSearch =
                            fullName.toLowerCase().includes(searchTerm) ||
                            patientId.toLowerCase().includes(searchTerm) ||
                            mobileNumber.toLowerCase().includes(searchTerm);

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
                <td class="px-2">
                    <img src="${value.profilePhoto && value.profilePhoto !== 'No data' ? '<?php echo base_url(); ?>uploads/' + value.profilePhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg'}" alt="Profile" width="40" height="40" class="rounded-circle">
                </td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Healthcareprovider/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.patientId}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Healthcareprovider/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.firstName} ${value.lastName}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Healthcareprovider/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.mobileNumber}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Healthcareprovider/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.gender}</a></td>
                <td style="font-size: 16px" class="pt-3"><a href="<?php echo base_url('Healthcareprovider/consultation/'); ?>${value.id}"
                 class="fieldLink text-dark"> ${value.age}</a></td>
                <td class="pt-2" style="font-size: 16px;">
                    <a href="<?php echo base_url(); ?>Healthcareprovider/patientdetails/${value.id}" class="px-1"><button class="btn btn-success mb-1"><i class="bi bi-eye"></i></button></a>
                    <a href="<?php echo base_url(); ?>Healthcareprovider/consultation/${value.id}" class=""><button class="btn btn-secondary text-light mb-1"><i class="bi bi-calendar-check"></i></button></a>
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
                            <form action="<?php echo base_url() . "Healthcareprovider/addPatientsForm" ?>" name="patientDetails"
                                id="patientDetails" enctype="multipart/form-data" method="POST"
                                oninput="clearErrorPatientDetails()" onsubmit="return validatePatientDetails()">
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
                                        <div id="patientName_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientLastName">Last Name</label>
                                        <input type="text" class="form-control" id="" name="patientLastName" maxlength="30"
                                            placeholder="E.g. Kumar">
                                        <div id="patientLastName_err" class="text-danger pt-1"></div>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientMobile">Mobile Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                            maxlength="10" placeholder="E.g. 9638527410">
                                        <div id="patientMobile_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientAltMobile">Alternate Moblie
                                            Number</label>
                                        <input type="text" class="form-control" id="patientAltMobile" name="patientAltMobile"
                                            maxlength="10" placeholder="E.g. 9876543210">
                                        <div id="patientMobile_err" class="text-danger pt-1"></div>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientEmail">Email Id</label>
                                        <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                            placeholder="E.g. example@gmail.com">
                                        <div id="patientEmail_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                        <label class="form-label" for="patientGender">Gender <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="patientGender" name="patientGender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div id="patientGender_err" class="text-danger pt-1"></div>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between pb-3">
                                    <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                        <label class="form-label" for="patientAge">Age <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="patientAge" name="patientAge" max="120"
                                            min="2" maxlength="3" placeholder="E.g. 41">
                                        <div id="patientAge_err" class="text-danger pt-1"></div>
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
                                        <div id="patientMarital_err" class="text-danger pt-1"></div>
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
                                <!-- Need to add crop option and move to top of the form -->
                                <!-- <div class="form-group pb-3">
                                    <label class="form-label" for="profilePhoto">Profile Photo</label>
                                    <input type="file" class="form-control" id="profilePhoto" name="profilePhoto"
                                        accept="image/png ,image/jpg, image/jpeg">
                                </div> -->
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
                                        <label class="form-label" for="partnerMobile">Guardian's Mobile </label>
                                        <input type="number" class="form-control" id="partnerMobile" name="partnerMobile"
                                            maxlength="10" placeholder="E.g. 9874563210">
                                        <div id="partnerMobile_err" class="text-danger pt-1"></div>
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

                <!-- Validation script -->
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

                    }
                </script>

                <!-- Check Mobile Number already exist or not -->
                <script>
                    function checkDuplicateField(field, value, callback) {
                        $.post("<?= base_url('Healthcareprovider/check_duplicate_field') ?>", {
                            field: "mobileNumber",
                            value: value,
                            table: "patient_details"
                        }, function (response) {
                            let res = JSON.parse(response);
                            callback(res.exists);
                        }).fail(() => {
                            callback(false);
                        });
                    }

                    $(document).ready(function () {
                        $("#patientMobile").on("keyup", function () {
                            let mobile = $(this).val();

                            if (mobile.length === 10) {
                                $("#patientMobile_err").html("");

                                checkDuplicateField("mobile", mobile, function (exists) {
                                    if (exists) {
                                        $("#duplicateMobileModal").modal("show");
                                    }
                                });
                            }
                        });
                    });
                </script>

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
                                        <div class="position-relative mb-5">
                                    <?php if (isset($value['profilePhoto']) && $value['profilePhoto'] != "No data") { ?>
                                                <img src="<?php echo base_url() . 'uploads/' . $value['profilePhoto'] ?>"
                                                    alt="Profile Photo" width="180" height="180" class="rounded-circle"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                    <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="180"
                                                    height="180" class="rounded-circle">
                                    <?php } ?>
                                            <button class="position-absolute bottom-0 " role="button" data-bs-toggle="modal"
                                                data-bs-target="#updatePatientProfile"
                                                onclick="patientPhotoUpdate('<?php echo $value['id'] ?>')">
                                                <i class="bi bi-pencil-square"></i></button>
                                        </div>
                                        <form action="<?php echo base_url() . "Healthcareprovider/updatePatientsForm" ?>"
                                            name="patientDetails" id="multi-step-form" enctype="multipart/form-data" method="POST"
                                            oninput="clearErrorPatientDetails()">
                                            <button type="submit" class="btn text-light float-end" style="background-color: #00ad8e;"
                                                onclick="return validatePatientDetails()">Update</button>
                                            <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#00ad8e">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #00ad8e;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">1</button> Basic Details
                                            </p>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientName">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="patientName" name="patientName"
                                                        value="<?php echo $value['firstName'] ?>" maxlength="30"
                                                        placeholder="E.g. Siva">
                                                    <div id="patientName_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="" name="patientLastName"
                                                        value="<?php echo $value['lastName'] ?>" maxlength="30"
                                                        placeholder="E.g. Kumar">
                                                    <div id="patientLastName_err" class="text-danger pt-1"></div>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientMobile">Moblie Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                                        value="<?php echo $value['mobileNumber'] ?>" maxlength="10"
                                                        placeholder="E.g. 9638527410">
                                                    <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                        Number</label>
                                                    <input type="text" class="form-control" id="patientAltMobile"
                                                        name="patientAltMobile" value="<?php echo $value['alternateMobile'] ?>"
                                                        maxlength="10" placeholder="E.g. 9876543210">
                                                    <div id="patientMobile_err" class="text-danger pt-1"></div>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientEmail">Email</label>
                                                    <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                                        value="<?php echo $value['mailId'] ?>" placeholder="E.g. example@gmail.com">
                                                    <div id="patientEmail_err" class="text-danger pt-1"></div>
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
                                                    <div id="patientGender_err" class="text-danger pt-1"></div>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientAge">Age <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="patientAge" name="patientAge" min="0"
                                                        max="120" maxlength="3" value="<?php echo $value['age'] ?>"
                                                        placeholder="E.g. 41">
                                                    <div id="patientAge_err" class="text-danger pt-1"></div>
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
                                                    <div id="patientBlood_err" class="text-danger pt-1"></div>
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
                                                    <div id="patientMarital_err" class="text-danger pt-1"></div>
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
                                                    <div id="partnersName_err" class="text-danger pt-1"></div>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="partnerMobile">Guardian's Mobile </label>
                                                    <input type="text" class="form-control" id="partnerMobile" name="partnerMobile"
                                                        value="<?php echo $value['partnerMobile'] ?>" maxlength="30"
                                                        placeholder="E.g. 9874563210">
                                                    <div id="partnerMobile_err" class="text-danger pt-1"></div>
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
                                                <button type="submit" class="btn text-light" style="background-color: #00ad8e;"
                                                    onclick="return validatePatientDetails()">Update</button>
                                            </div>
                                        </form>
                            <?php } ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </section>

                    <!-- Symptoms / Complaints -->
                    <!-- <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const multiSelect = document.getElementById("multiSelectSymptoms");
                            const selectedValuesInput = document.getElementById("patientSymptoms");
                            const selectedValuesContainer = document.getElementById("selectedValuesContainer");
                            const customSymptomInput = document.getElementById("customSymptomInput");
                            const addCustomSymptomBtn = document.getElementById("addCustomSymptom");

                            const symptomsFromDatabase = "<?php echo $value['symptoms'] ?>";
                            const initialSelectedValues = symptomsFromDatabase ? symptomsFromDatabase.split(', ').map(item => item.trim()) : [];
                            let selectedValues = new Set(initialSelectedValues);

                            const updateSelectedValues = () => {
                                selectedValuesContainer.innerHTML = '';
                                selectedValues.forEach(value => {
                                    const span = document.createElement('span');
                                    span.classList.add('badge', 'bg-secondary', 'me-2', 'd-inline-flex', 'align-items-center');
                                    span.textContent = value;
                                    const button = document.createElement('button');
                                    button.innerHTML = '×';
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
                                                option.innerHTML = `<span> ${option.textContent.trim()} <span class="ms-5">✓</span></span>`;
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
                                        option.innerHTML = `<span> ${option.textContent.trim()} <span class="ms-5">✓</span></span>`;
                                    }
                                });
                                updateSelectedValues();
                            });

                            addCustomSymptomBtn.addEventListener("click", () => {
                                const customValue = customSymptomInput.value.trim();
                                if (customValue) {
                                    selectedValues.add(customValue);
                                    updateSelectedValues();
                                    customSymptomInput.value = '';
                                }
                            });

                            customSymptomInput.addEventListener("keypress", (e) => {
                                if (e.key === "Enter") {
                                    e.preventDefault();
                                    const customValue = customSymptomInput.value.trim();
                                    if (customValue) {
                                        selectedValues.add(customValue);
                                        updateSelectedValues();
                                        customSymptomInput.value = '';
                                    }
                                }
                            });

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
                    </script> -->

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
                                            <p> <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> Year(s)</p>
                                        </div>
                                        <div class="position-absolute top-0 end-0 m-2 d-flex flex-column gap-2 align-items-end">
                                            <a
                                                href="<?php echo base_url() . "Healthcareprovider/patientformUpdate/" . $value['id']; ?>">
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-pen"></i> Edit
                                                </button>
                                            </a>
                                            <a href="<?php echo base_url() . "Healthcareprovider/consultation/" . $value['id']; ?>">
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

                                    <!-- This is old code, but can be changed to display the new consultation details -->
                                    <!--      <p class="my-3 mt-3 fs-5 fw-semibold">Consultation Details</p>
                            <?php if (!empty($consultDetails)) { ?>
                                        <div class="d-md-flex">
                                            <p class="col-sm-6"><span class="text-secondary ">Last Appointment Date</span> :
                                        <?php echo date('d-m-Y', strtotime($value['lastAppDate'])); ?>
                                            </p>
                                            <p><span class="text-secondary ">Next Followup Date</span> :
                                        <?php echo date('d-m-Y', strtotime($value['nextAppDate'])); ?>
                                            </p>
                                        </div>

                                    <?php
                                    $consultCount = 0;
                                    foreach ($consultDetails as $key => $cvalue) {
                                        $consultCount++;
                                        ?>
                                            <div class="card rounded shadow border mt-3 p-4">
                                                <div class="d-sm-flex justify-content-between my-auto mb-2" style="font-weight:600;">
                                                    <div class="d-flex">
                                                        <button style="width:30px;height:30px;font-weight:500"
                                                            class="text-light bg-secondary rounded-circle border-0 me-3">
                                                    <?php echo $consultCount; ?>
                                                        </button>
                                                        <p class="pe-4 pt-1">
                                                    <?php echo date('d F Y', strtotime($cvalue['date'])); ?> -
                                                    <?php echo date('h:i A', strtotime($cvalue['time'])); ?>
                                                        </p>
                                                    </div>
                                            <?php if ($cvalue['consultMode'] == '0') { ?>
                                                        <p class="pe-4 pt-1"><span class="badge bg-primary">Direct Consult</span></p>
                                            <?php } else { ?>
                                                        <p class="pe-4 pt-1 float-end"><span class="badge bg-success me-2">Online Consult</span></p>
                                            <?php } ?>
                                                    <button class="btn btn-secondary"><i class="bi bi-download"></i> Prescription</button>
                                                </div>

                                                <div class="text-end">
                                                    <button class="btn btn-link text-decoration-none toggle-btn" onclick="toggleCard(this)">
                                                        Show More <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                </div>

                                                <div class="card-content d-none">
                                                    <div class="d-sm-flex pb-3">
                                                        <p class="text-secondary col-md-2 mb-1">CC Id : </p>
                                                        <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctorsProfile/" . $cvalue['consultDoctorDbId']; ?>"
                                                            class="col-md-9 text-dark ps-2" onmouseover="style='text-decoration:underline'"
                                                            onmouseout="style='text-decoration:none'">
                                                    <?php echo $cvalue['consultDoctorId'] ?>
                                                        </a>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Symptoms : </p>
                                                        <p class="col-md-9 ps-2"> <?php echo $cvalue['symptoms'] ?></p>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Findings : </p>
                                                        <p class="col-md-9 ps-2"> <?php echo $cvalue['findings'] ?></p>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Diagnosis : </p>
                                                        <p class="col-md-9 ps-2"> <?php echo $cvalue['diagnosis'] ?></p>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Investigations : </p>
                                                        <p class="col-md-9 ps-2"> <?php echo $cvalue['investigations'] ?></p>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Advice Given : </p>
                                                        <p class="col-md-9 ps-2"> <?php echo $cvalue['adviceGiven'] ?></p>
                                                    </div>
                                                    <div class="d-sm-flex pb-1">
                                                        <p class="text-secondary col-md-2 mb-1">Next Followup : </p>
                                                        <p class="col-md-9 ps-2">
                                                    <?php echo date('d F Y', strtotime($cvalue['nextFollowup'])); ?>
                                                        </p>
                                                    </div>

                                                    <p class="text-secondary">Medicines table :</p>
                                                    <table class="table table-bordered table-hoverr border border-dark text-center">
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
                                                foreach ($consultMedicines as $key => $mvalue) {
                                                    if ($mvalue['consultationDbId'] == $cvalue['id']) {
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
                                            </div>

                                <?php } ?>

                            <?php } else { ?>
                                        <p class="text-muted text-center pt-1 pb-2">No consultations have been conducted yet.</p>
                            <?php } ?> -->

                        <?php } ?>
                            </div>
                        </div>
                    </section>

        <?php } ?>

        <!-- This methods/sections currently not in use. -->
        <?php if ($method == "prescription") {
            ?>
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
                        foreach ($patientDetails as $key => $pvalue) {
                            ?>

                            <div class="container prescriptioncontent" id="prescription">
                                <div class="row mb-2">
                                    <p class="col-6 mb-1">
                                        <span class="fw-bold">Patient Name : </span><?php echo $pvalue['firstName'] ?>
                                        <?php echo $pvalue['lastName'] ?>
                                    </p>
                                    <p class="col-sm-6 mb-1">
                                        <span class="fw-bold">Mobile : </span><?php echo $pvalue['mobileNumber'] ?>
                                    </p>
                                </div>
                                <div class="row mb-4">
                                    <p class="col-6 mb-1">
                                        <span class="fw-bold">Age / Gender : </span><?php echo $pvalue['age'] ?> /
                                        <?php echo $pvalue['gender'] == "Male" ? "M" : "F"; ?>
                                    </p>
                                    <p class="col-sm-6 mb-1">
                                        <span class="fw-bold">ID : </span><?php echo $pvalue['patientId'] ?>
                                    </p>
                                </div>
                                <p>
                                    <span class="fw-bold">Symptoms :
                                    </span><?php echo $pvalue['symptoms'] ? $pvalue['symptoms'] : "Not provided"; ?>
                                </p>
                                <p>
                                    <span class="fw-bold">Diagnosis :
                                    </span><?php echo $pvalue['diagonsis'] ? $pvalue['diagonsis'] : "Not provided"; ?>
                                </p>


                                <div class="table-responsive row my-4">
                                    <div class="col-12">
                                        <h5 class="fw-bold">Prescription:</h5>
                                        <table class="table table-bordered table-hoverr border border-dark">
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
                                            foreach ($consultMedicines as $key => $mvalue) {
                                                if ($mvalue['dateOfAppoint'] == $pvalue['lastAppDate']) {
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
                                </div>
                                <!-- <p class="mt-2"><span class="fw-bold">Advice given :</span></p> -->
                                <p>
                                    <span class="fw-bold">Next follow-up date :
                                    </span><?php echo date('d-m-Y', strtotime($pvalue['nextAppDate'])); ?>
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
                function checkPrinterConnection() {
                    document.getElementById("printButton").disabled = false;
                }

                window.onload = checkPrinterConnection;

                function printPrescription() {
                    const printContents = document.getElementById("pdf-wrapper").innerHTML;
                    const originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    window.location.reload();
                }
            </script>

            <!-- <script>
                                    function printPrescription() {
                                        const printContents = document.getElementById("pdf-wrapper").innerHTML;
                                        const originalContents = document.body.innerHTML;

                                        document.body.innerHTML = printContents;
                                        window.print();
                                        document.body.innerHTML = originalContents;
                                        window.location.reload();
                                    }
                                </script> -->

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
        } else if ($method == "newConsultation") {
            ?>
                <section>
                    <div class="card rounded">
                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500">New Consultation </p>
                            <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>"
                                class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                        </div>

                        <div class="card-body px-md-4 pb-4">
                            <p class="my-3 fs-5 fw-semibold">Patient Details:</p>
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                <div class="text-center pt-2 pb-4">
                                    <p style="font-size: 16px; font-weight: 700"> <?php echo $value['firstName'] ?>
                                    <?php echo $value['lastName'] ?> | <?php echo $value['patientId'] ?>
                                    </p>
                                    <p><a href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?></a> | <?php echo $value['gender'] ?> |
                                    <?php echo $value['age'] ?> Year(s)
                                    </p>
                                </div>

                                <div class="d-md-flex">
                                    <p class="col-sm-6"><span class="text-secondary ">Weight</span> -
                                    <?php echo $value['weight'] ? $value['weight'] . " Kg" : "Not provided"; ?>
                                    </p>
                                    <p><span class="text-secondary ">Height</span> -
                                    <?php echo $value['height'] ? $value['height'] . " Cm" : "Not provided"; ?>
                                    </p>
                                </div>
                                <div class="d-md-flex">
                                    <p class="col-sm-6"><span class="text-secondary ">Blood Pressure</span> -
                                    <?php echo $value['systolicBp'] ? $value['systolicBp'] . " / " . $value['diastolicBp'] . " mmHg" : "Not provided"; ?>
                                    </p>
                                    <p><span class="text-secondary ">Cholestrol </span> -
                                    <?php echo $value['cholestrol'] ? $value['cholestrol'] . " mg/dL" : "Not provided"; ?>
                                    </p>
                                </div>
                                <div class="d-md-flex">
                                    <p class="col-sm-6"><span class="text-secondary ">Blood Sugar</span> -
                                    <?php echo $value['bloodSugar'] ? $value['bloodSugar'] . "mg/dL" : "Not provided"; ?>
                                    </p>
                                    <p><span class="text-secondary ">Diagonsis / Complaints</span> -
                                    <?php echo $value['diagonsis'] ? $value['diagonsis'] : "Not provided"; ?>
                                    </p>
                                </div>
                                <div class="d-md-flex">
                                    <p class="col-sm-6"><span class="text-secondary ">Symptoms / Findings</span> -
                                    <?php echo $value['symptoms'] ? $value['symptoms'] : "Not provided"; ?>
                                    </p>
                                    <!-- <p><span class="text-secondary ">Medicines</span> -
                                    <?php echo $value['medicines'] ? $value['medicines'] : "Not provided"; ?>
                                                    </p> -->
                                </div>
                                <p class="mb-2 mt-4 fs-5 fw-semibold">Consultation Details:</p>
                                <div class="p-3">
                                    <form action="<?php echo base_url() . 'Healthcareprovider/saveDirectConsultation' ?>"
                                        method="post" id="consultForm" class="containe col-md-9">
                                        <input type="hidden" id="patientIdDb" name="patientIdDb" value="<?php echo $value['id'] ?>">
                                        <input type="hidden" id="patientId" name="patientId"
                                            value="<?php echo $value['patientId'] ?>">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color:rgb(206, 206, 206);" role="button">
                                                <span><strong>Symptoms</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-containe mt-2">
                                                <select id="symptoms" name="symptoms[]" multiple="multiple" style="width:100%;">
                                                <?php foreach ($symptomsList as $key => $value) { ?>
                                                        <option value="<?php echo $value['symptomsName'] ?>">
                                                        <?php echo $value['symptomsName'] ?>
                                                        </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong>Findings</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <button type="button" class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <textarea class="form-control mb-2" name="findings" rows="3"
                                                    placeholder="Enter findings..."></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong>Diagnosis</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <button type="button" class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <textarea class="form-control mb-2" name="diagnosis" rows="3"
                                                    placeholder="Enter diagnosis..."></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong>Investigations</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <button type="button" class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <textarea class="form-control mb-2" name="investigations" rows="3"
                                                    placeholder="Enter investigations..."></textarea>
                                            </div>
                                        </div>

                                        <div id="medicine-template" class="card medicine-entry">
                                            <div class="card-header d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);">
                                                <span class="text-dark"><strong>Medicines</strong></span>
                                                <button type="button" class="btn-close btn-remove d-none"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group py-3">
                                                    <label class="form-label" for="preMedName">Medicine Name <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select preMedName" id="preMedName[]" name="preMedName[]">
                                                        <option value="">Select Medicine</option>
                                                        <?php
                                                        foreach ($medicinesList as $key => $value) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>">
                                                            <?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>
                                                            </option>
                                                    <?php } ?>
                                                    </select>
                                                    <div id="preMedName_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="preMedFrequency">Frequency <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control preMedFrequency" name="preMedFrequency[]"
                                                        placeholder="1 - 0 - 1" maxlength="9">
                                                    <div id="preMedFrequency_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="preMedDuration">Duration <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control preMedDuration"
                                                            name="preMedDuration[]" placeholder="Enter duration" min="1" max="31">
                                                        <select class="form-select preMedDurationUnit" name="preMedDurationUnit[]">
                                                            <option value="days">Days</option>
                                                            <option value="weeks">Weeks</option>
                                                            <option value="months">Month</option>
                                                        </select>
                                                    </div>
                                                    <div id="preMedDuration_err" class="text-danger pt-1 pe-2"></div>
                                                    <!-- <div id="preMedDurationUnit_err" class="text-danger pt-1"></div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="preMedNotes">Notes <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select preMedNotes" name="preMedNotes[]">
                                                        <option value=" ">Select Notes</option>
                                                        <option value="Before food">Before Food</option>
                                                        <option value="After food">After Food</option>
                                                    </select>
                                                    <div id="preMedNotes_err" class="text-danger pt-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="medicines-list"></div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="addMoreBtn" class="btn btn-secondary mt-0 mb-4"><i
                                                    class="bi bi-plus-lg"></i> Medicine</button>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label class="form-label" for="advices">Advice <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" name="advices" id="advices"
                                                placeholder="Enter the advice to patient"></textarea>
                                            <div id="advices_err" class="text-danger pt-1"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label class="form-label" for="nextFollowUpDate">Next follow up <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="nextFollowUpDate" name="nextFollowUpDate">
                                            <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" id="submitForm" class="btn text-light"
                                                style="background-color: #00ad8e;">Submit</button>
                                        </div>
                                    </form>
                                </div>
                        <?php } ?>
                        </div>
                    </div>
                </section>

                <script>
                    document.getElementById("addMoreBtn").addEventListener("click", function () {
                        const medicineContainer = document.getElementById("medicine-template");
                        const newMedicine = medicineContainer.cloneNode(true);

                        newMedicine.querySelectorAll("input, select").forEach(function (input) {
                            input.value = "";
                            const errorDiv = input.parentNode.querySelector('.text-danger');
                            if (errorDiv) {
                                errorDiv.textContent = '';
                            }
                        });

                        newMedicine.querySelector(".btn-remove").classList.remove("d-none");
                        newMedicine.querySelector(".btn-remove").addEventListener("click", function () {
                            newMedicine.remove();
                        });

                        document.getElementById("medicines-list").appendChild(newMedicine);
                    });
                </script>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.querySelectorAll(".preMedFrequency").forEach(function (frequencyInput) {
                            validateFrequencyPattern(frequencyInput);

                            frequencyInput.addEventListener("input", function (event) {
                                validateFrequencyPattern(event.target);
                            });
                        });
                    });

                    // document.getElementById("submitForm").addEventListener("click", function (event) {
                    //     event.preventDefault();

                    //     if (validateMedicines()) {
                    //         document.getElementById("prescriptionForm").submit();
                    //     }
                    // });

                    function validateFrequencyPattern(input) {
                        const frequencyPattern = /^[0-1]\s-\s[0-1]\s-\s[0-1]$/;
                        const errorDiv = input.closest(".medicine-entry").querySelector("#preMedFrequency_err");

                        let value = input.value.replace(/[^01]/g, '').substring(0, 3);
                        let formattedValue = '';
                        if (value.length > 0) formattedValue += value[0];
                        if (value.length > 1) formattedValue += ' - ' + value[1];
                        if (value.length > 2) formattedValue += ' - ' + value[2];
                        input.value = formattedValue;
                    }

                    function validateMedicines() {
                        let allFilled = true;

                        const adviceGiven = document.getElementById("adviceGiven");
                        const adviceGivenErr = document.getElementById("adviceGiven_err");
                        if (adviceGiven.value.trim() === "") {
                            adviceGivenErr.innerHTML = "Advice to patient must be filled out.";
                            allFilled = false;
                        } else {
                            adviceGivenErr.innerHTML = "";
                        }

                        const nextFollowUp = document.getElementById("nextFollowUp");
                        const nextFollowUpErr = document.getElementById("nextFollowUp_err");
                        if (nextFollowUp.value === "") {
                            nextFollowUpErr.innerHTML = "Next follow-up date must be filled out.";
                            allFilled = false;
                        } else {
                            nextFollowUpErr.innerHTML = "";
                        }

                        const medicineEntries = document.querySelectorAll(".medicine-entry:not(.d-none)");

                        medicineEntries.forEach(function (entry) {
                            const nameInput = entry.querySelector(".preMedName");
                            const frequencyInput = entry.querySelector(".preMedFrequency");
                            const durationInput = entry.querySelector(".preMedDuration");
                            // const durationUnitSelect = entry.querySelector(".preMedDurationUnit");
                            const notesSelect = entry.querySelector(".preMedNotes");

                            if (nameInput.value.trim() === "") {
                                entry.querySelector("#preMedName_err").innerHTML = "Medicine name must be filled out.";
                                allFilled = false;
                            } else {
                                entry.querySelector("#preMedName_err").innerHTML = "";
                            }

                            if (frequencyInput.value.trim() === "") {
                                entry.querySelector("#preMedFrequency_err").innerHTML = "Frequency must be filled out.";
                                allFilled = false;
                            } else {
                                entry.querySelector("#preMedFrequency_err").innerHTML = "";
                            }

                            if (durationInput.value.trim() === "") {
                                entry.querySelector("#preMedDuration_err").innerHTML = "Duration must be filled out.";
                                allFilled = false;
                            } else {
                                entry.querySelector("#preMedDuration_err").innerHTML = "";
                            }

                            // if (durationUnitSelect.value.trim() === "") {
                            //     entry.querySelector("#preMedDurationUnit_err").innerHTML = "Please select a duration unit.";
                            //     allFilled = false;
                            // } else {
                            //     entry.querySelector("#preMedDurationUnit_err").innerHTML = "";
                            // }

                            if (notesSelect.value.trim() === "") {
                                entry.querySelector("#preMedNotes_err").innerHTML = "Notes selection is required.";
                                allFilled = false;
                            } else {
                                entry.querySelector("#preMedNotes_err").innerHTML = "";
                            }
                        });

                        return allFilled;
                    }
                </script>

                <!-- Multiple Select 2  -->
                <script>
                    $(document).ready(function () {
                        $('#symptoms').select2({
                            placeholder: 'Type to search and select symptoms',
                            allowClear: true
                        });
                    });
                </script>

                <!-- Toggle visibility and icon -->
                <script>
                    document.querySelectorAll('.toggle-label').forEach(label => {
                        label.addEventListener('click', () => {
                            const container = label.nextElementSibling;
                            const icon = label.querySelector('.toggle-icon');

                            container.classList.toggle('show');
                            icon.textContent = container.classList.contains('show') ? '-' : '+';
                        });
                    });

                    document.querySelectorAll('.clear-btn').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const textarea = button.parentElement.querySelector('textarea');
                            textarea.value = '';
                            e.stopPropagation(); // Prevent toggling when clicking clear
                        });
                    });
                </script>

        <?php } ?>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

        <!-- Mobile number already exist message display modal -->
        <div class="modal fade" id="duplicateMobileModal" tabindex="-1" aria-labelledby="duplicateMobileLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal- fw-medium" style="font-family: Poppins, sans-serif;"
                            id="duplicateMobileLabel">Mobile Number Exist</h5>
                    </div>
                    <div class="modal-body">
                        This mobile number is already registered with another patient.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                            data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        <?php if ($method == "patients" || $method == "patientDetailsForm" || $method == "patientDetailsFormUpdate" || $method == "patientDetails" || $method == "prescription" || $method == "newConsultation") { ?>
            document.getElementById('patients').style.color = "#87F7E3";
        <?php } ?>
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

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- PDF Download link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

</body>

</html>