<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Admin - EDF</title>
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
    <!-- Google fonts link -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            /* scroll-padding-top: 290px; */
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }

        #ccMobile::-webkit-outer-spin-button,
        #ccMobile::-webkit-inner-spin-button,
        #hcpMobile::-webkit-outer-spin-button,
        #hcpMobile::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php $this->load->view('adminHeader'); ?>

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
        if ($method == "dashboard") {
            ?>

            <section>
                <p class="card ps-3 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-lg-flex justify-content-evenly">
                    <div class="card position-relative rounded-5 mx-2">
                        <div class="card-body d-flex px-3 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin2.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon1" />
                            <div class="text-center px-3">
                                <p style="font-size: 20px; font-weight: 500;">
                                    Total Chief Consultants
                                </p>
                                <p style="font-size: 30px; font-weight: 400;">
                                    <?php echo $totalCcList; ?>
                                </p>
                                <p style="font-size: 16px"> <?php echo date("d - m - Y") ?></p>
                            </div>
                            <a href="<?php echo base_url() . "Edfadmin/ccList" ?>"
                                class="small position-absolute bottom-0 end-0 m-2 mt-3" style="color: #1f3861;"
                                onmouseover="this.style.textDecoration='underline'"
                                onmouseout="this.style.textDecoration='none'">
                                View All <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card position-relative rounded-5 mx-2">
                        <div class="card-body d-flex px-3 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin2.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon2" />
                            <div class="text-center px-3">
                                <p style="font-size: 20px; font-weight: 500;">
                                    Total Health Care Providers
                                </p>
                                <p style="font-size: 30px; font-weight: 400;">
                                    <?php echo $totalHcpList; ?>
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d - m - Y") ?>
                                </p>
                            </div>
                            <a href="<?php echo base_url() . "Edfadmin/hcpList" ?>"
                                class="small position-absolute bottom-0 end-0 m-2 mt-3" style="color: #1f3861;"
                                onmouseover="this.style.textDecoration='underline'"
                                onmouseout="this.style.textDecoration='none'">
                                View All <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card position-relative rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin1.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon3" />
                            <div class="text-center px-3">
                                <p style="font-size: 20px; font-weight: 500;">
                                    Total Patients
                                </p>
                                <p style="font-size: 30px; font-weight: 400;">
                                    <?php echo $totalPatientList; ?>
                                </p>
                                <p style="font-size: 16px">
                                    Till Today
                                </p>
                            </div>
                            <a href="<?php echo base_url() . "Edfadmin/patientList" ?>"
                                class="small position-absolute bottom-0 end-0 m-2 mt-3" style="color: #1f3861;"
                                onmouseover="this.style.textDecoration='underline'"
                                onmouseout="this.style.textDecoration='none'">
                                View All <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <?php
        } else if ($method == "chiefConsultant") {
            ?>

                <section>
                    <div class="card rounded">
                        <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500">Chief Consultant List</p>
                            <a href="<?php echo base_url() . "Edfadmin/ccSignupForm" ?>">
                                <button style="background-color: #2b353bf5;"
                                    class="text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                    <i class="bi bi-plus-square-fill"></i> Add CC
                                </button>
                            </a>
                        </div>
                    <?php if (isset($ccList[0]['id'])) { ?>
                            <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                <div class="ms-2 py-2 py-md-0">
                                    <label for="itemsPerPageDropdown">Show </label>
                                    <select id="itemsPerPageDropdown"
                                        class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    <label for="itemsPerPageDropdown">Entries </label>
                                </div>
                                <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                    <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                        style="height: 50px; width: 250px" placeholder="Search (ID / NAME)">
                                    <span id="clearSearch" class="position-absolute"
                                        style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                </div>
                            </div>
                            <div class="card-body p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table table-hover text-center" id="ccTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">S.NO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">ID</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">NAME</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">MOBILE
                                                    NUMBER</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">SPECIALIST
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">STATUS
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #1a1f24">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="ccTableBody"></tbody>
                                    </table>
                                </div>
                                <div class="d-md-flex justify-content-between ms-2">
                                    <div id="entriesInfo" class="mt-4"></div>
                                    <div class="pagination justify-content-end mt-4" id="paginationContainerCc"></div>
                                </div>
                            </div>
                    <?php } else { ?>
                            <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                    <?php } ?>

                    </div>
                </section>

                <script>
                    const baseUrl = '<?php echo base_url(); ?>';
                    let itemsPerPageCc = 10;
                    const ccDetails = <?php echo json_encode($ccList); ?>;
                    let filteredCcDetails = [...ccDetails];
                    const initialPageCc = parseInt(localStorage.getItem('currentPageCc')) || 1;

                    const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                    const searchBar = document.getElementById('searchBar');
                    const clearSearch = document.getElementById('clearSearch');

                    // Load saved itemsPerPage
                    const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageCc')) || itemsPerPageCc;
                    itemsPerPageDropdown.value = savedItemsPerPage;
                    itemsPerPageCc = savedItemsPerPage;

                    // Event Listeners
                    itemsPerPageDropdown.addEventListener('change', (event) => {
                        itemsPerPageCc = parseInt(event.target.value);
                        localStorage.setItem('itemsPerPageCc', itemsPerPageCc);
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

                    function toggleClearIcons() {
                        clearSearch.style.display = searchBar.value ? 'block' : 'none';
                    }

                    function applyFilters() {
                        const searchTerm = searchBar.value.toLowerCase();

                        filteredCcDetails = ccDetails.filter((item) => {
                            const fullName = item.doctorName || '';
                            const ccId = item.ccId || '';

                            return (
                                fullName.toLowerCase().includes(searchTerm) ||
                                ccId.toLowerCase().includes(searchTerm)
                            );
                        });

                        displayCcPage(1);
                    }

                    function displayCcPage(page) {
                        localStorage.setItem('currentPageCc', page);
                        const start = (page - 1) * itemsPerPageCc;
                        const end = start + itemsPerPageCc;
                        const itemsToShow = filteredCcDetails.slice(start, end);

                        const ccTableBody = document.getElementById('ccTableBody');
                        ccTableBody.innerHTML = '';

                        updateEntriesInfo(start + 1, Math.min(end, filteredCcDetails.length), filteredCcDetails.length);

                        if (itemsToShow.length === 0) {
                            const noMatchesRow = document.createElement('tr');
                            noMatchesRow.innerHTML = '<td colspan="7" class="text-center">No matches found.</td>';
                            ccTableBody.appendChild(noMatchesRow);
                        } else {
                            itemsToShow.forEach((value, index) => {
                                const ccRow = document.createElement('tr');
                                ccRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px;" class="pt-3">${value.ccId}</td>
                <td style="font-size: 16px" class="pt-3">${value.doctorName}</td>
                <td style="font-size: 16px" class="pt-3">${value.doctorMobile}</td>
                <td style="font-size: 16px" class="pt-3">${value.specialization}</td>
                <td style="font-size: 16px" class="pt-3">
                    ${value.approvalStatus == 1 ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-check-fill text-danger"></i>'}
                </td>
                <td class="d-flex d-md-block" style="font-size: 16px">
                    <a href="${baseUrl}Edfadmin/ccDetails/${value.id}"><button class="btn btn-success me-1"><i class="bi bi-eye"></i></button></a>
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${value.id}" data-name="${value.doctorName}" data-type="cc"><i class="bi bi-trash"></i></button>
                </td>`;
                                ccTableBody.appendChild(ccRow);
                            });
                        }

                        generateCcPagination(filteredCcDetails.length, page);
                    }

                    function updateEntriesInfo(start, end, totalEntries) {
                        const entriesInfo = document.getElementById('entriesInfo');
                        entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                    }

                    function generateCcPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPageCc);
                        const paginationContainer = document.getElementById('paginationContainerCc');
                        paginationContainer.innerHTML = '';

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        const prevLi = document.createElement('li');
                        prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                        prevLi.onclick = () => {
                            if (currentPage > 1) displayCcPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, startPage + 4);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                            li.onclick = () => displayCcPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                        nextLi.onclick = () => {
                            if (currentPage < totalPages) displayCcPage(currentPage + 1);
                        };
                        ul.appendChild(nextLi);

                        paginationContainer.appendChild(ul);
                    }

                    // On load: Show all data, then render
                    toggleClearIcons();
                    filteredCcDetails = [...ccDetails];
                    displayCcPage(initialPageCc);
                </script>

            <?php
        } else if ($method == "ccRegisterForm") {
            ?>
                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500">
                                    New Chief Consultant</p>
                                <a href="<?php echo base_url() . "Edfadmin/ccList" ?>" class="text-dark mt-2"><i
                                        class="bi bi-arrow-left"></i> Back</a>
                            </div>
                            <div class="card-body col-md-8 px-sm-4">
                                <p style="font-size: 20px; font-weight: 500">Create an Account for Chief Consultant</p>
                                <form action="<?php echo base_url() . "Edfadmin/ccSignup" ?>" method="post" name="signupform"
                                    onsubmit="return validateSignup()" oninput="return removeError()">
                                    <div class="mb-3">
                                        <label for="ccName" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="ccName" id="ccName" placeholder="Suresh Kumar"
                                            class="form-control">
                                        <div id="name_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccMobile" class="form-label">Mobile Number <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="ccMobile" id="ccMobile" placeholder="9876543210"
                                            class="form-control">
                                        <div id="mobile_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccEmail" class="form-label">Email Id <span class="text-danger">*</span></label>
                                        <input type="email" name="ccEmail" id="ccEmail" placeholder="example@gmail.com"
                                            class="form-control">
                                        <div id="mail_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccSpec" class="form-label">Specialization <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select " id="ccSpec" name="ccSpec">
                                            <option value="">Select Specialization</option>
                                        <?php
                                        foreach ($specializationList as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['specializationName'] ?>">
                                            <?php echo $value['specializationName'] ?>
                                                </option>
                                    <?php } ?>
                                        </select>
                                        <div id="spec_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccPassword" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <div style="position: relative;">
                                            <input type="password" name="ccPassword" id="ccPassword" placeholder="password"
                                                class="form-control">
                                            <i class="bi bi-eye-slash" onclick="togglePasswordVisibility('ccPassword', this)"
                                                style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                        <div id="password_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                                        Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1
                                        number and a minimum of 8 characters.</div>
                                    <div class="mb-3">
                                        <label for="ccCnfmPassword" class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <div style="position: relative;">
                                            <input type="password" name="ccCnfmPassword" id="ccCnfmPassword"
                                                placeholder="confirm password" class="form-control">
                                            <i class="bi bi-eye-slash" onclick="togglePasswordVisibility('ccCnfmPassword', this)"
                                                style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                        <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                                    </div>
                                    <input type="hidden" name="approvalApproved" id="approvalApproved" value="1">
                                    <input type="hidden" name="firstLoginPswdChange" id="firstLoginPswdChange" value="0">
                                    <div class="d-flex justify-content-between">
                                        <button type="reset" class="btn btn-secondary text-light mt-2">Reset</button>
                                        <button type="submit" style="background-color: #2b353bf5;"
                                            class="btn text-light float-end mt-2">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <script>
                        function validateSignup() {
                            var name = document.getElementById("ccName").value;
                            var mobile = document.getElementById("ccMobile").value;
                            var email = document.getElementById("ccEmail").value;
                            var spec = document.getElementById("ccSpec").value;
                            var password = document.getElementById("ccPassword").value;
                            var confirmpassword = document.getElementById("ccCnfmPassword").value;

                            if (name == "") {
                                document.getElementById("name_err").innerHTML = "Name must be filled out.";
                                return false;
                            } else {
                                document.getElementById("name_err").innerHTML = "";
                            }

                            if (mobile == "") {
                                document.getElementById("mobile_err").innerHTML = "Mobile number must be filled out.";
                                return false;
                            } else if (!/^\d{10}$/.test(mobile)) {
                                document.getElementById("mobile_err").innerHTML = "Invalid mobile number. Please enter valid number.";
                                return false;
                            } else {
                                document.getElementById("mobile_err").innerHTML = "";
                            }

                            if (email == "") {
                                document.getElementById("mail_err").innerHTML = "Mail address must be filled out.";
                                return false;
                            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                                document.getElementById("mail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                                return false;
                            } else {
                                document.getElementById("mail_err").innerHTML = "";
                            }

                            if (spec == "") {
                                document.getElementById("spec_err").innerHTML = "Specialization must be filled out.";
                                return false;
                            } else {
                                document.getElementById("spec_err").innerHTML = "";
                            }

                            if (password == "") {
                                document.getElementById("password_err").innerHTML = "Password must be filled out.";
                                return false;
                            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                                document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password."
                                return false;
                            } else {
                                document.getElementById("password_err").innerHTML = "";
                            }

                            if (confirmpassword == "") {
                                document.getElementById("cnfmpassword_err").innerHTML = "Re-enter the password.";
                                return false;
                            } else if (confirmpassword != password) {
                                document.getElementById("cnfmpassword_err").innerHTML = "Enter same as password."
                                return false;
                            } else {
                                document.getElementById("cnfmpassword_err").innerHTML = "";
                            }
                        }

                        document.getElementById("ccPassword").onfocus = function () {
                            document.getElementById("passwordmessage").style.display = "block";
                        }

                        document.getElementById("ccPassword").onblur = function () {
                            document.getElementById("passwordmessage").style.display = "none";
                        }


                        function removeError() {
                            var name = document.getElementById("ccName").value;
                            var mobile = document.getElementById("ccMobile").value;
                            var email = document.getElementById("ccEmail").value;
                            var spec = document.getElementById("ccSpec").value;
                            var password = document.getElementById("ccPassword").value;
                            var confirmpassword = document.getElementById("ccCnfmPassword").value;

                            if (name != "") {
                                document.getElementById("name_err").innerHTML = "";
                            }

                            if (mobile != "") {
                                document.getElementById("mobile_err").innerHTML = "";
                            }

                            if (email != "") {
                                document.getElementById("mail_err").innerHTML = "";
                            }

                            if (spec != "") {
                                document.getElementById("spec_err").innerHTML = "";
                            }

                            if (password != "") {
                                document.getElementById("password_err").innerHTML = "";
                            }

                            if (confirmpassword != "") {
                                document.getElementById("cnfmpassword_err").innerHTML = "";
                            }
                        }
                    </script>

            <?php
        } else if ($method == "ccDetails") {
            ?>
                        <section>
                            <div class="card rounded">
                                <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                    <p style="font-size: 24px; font-weight: 500">
                                        Chief Doctor Profile </p>
                                    <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                            class="bi bi-arrow-left"></i> Back</button>
                                </div>

                                <div class="card-body p-3 p-sm-4">

                                    <div class="d-sm-flex justify-content-start mt-2 mb-5">
                                <?php
                                foreach ($ccDetails as $key => $value) {
                                    ?>
                                <?php if (isset($value['ccPhoto']) && $value['ccPhoto'] != "") { ?>
                                                <img src="<?php echo $value['ccPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                    class="rounded-circle"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                    height="140" class="rounded-circle my-auto">
                                <?php } ?>
                                            <div class="ps-sm-5">
                                                <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['doctorName']; ?>
                                                </p>
                                                <p style="font-size:16px;font-weight:400;">Diabetologist</p>
                                                <p><a href="tel:<?php echo $value['doctorMobile']; ?>"
                                                        style="font-size:16px;font-weight:400;"
                                                        class="text-decoration-none text-dark fs-6">+91
                                            <?php echo $value['doctorMobile']; ?>
                                                    </a> | <a href="mailto:<?php echo $value['doctorMail']; ?>"
                                                        style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                            <?php echo $value['doctorMail']; ?>
                                                    </a></p>
                                                <p class="pt-3"><?php echo $value['gMeetLink']; ?></p>
                                            </div>
                                        </div>

                                        <h5 class="fw-bolder pb-3">Profile Details:</h5>

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

                                        <h5 class="my-3 fw-bolder">Appointment Link:</h5>
                                        <form action="<?php echo base_url() . "Edfadmin/addAppLink/" . $value['id'] ?>" method="POST"
                                            class="col-md-6 mb-5" name="appLinkForm" onsubmit="return validateLink()">
                                            <label for="appLink" class="pb-2">Add Link <span class="text-danger">*</span></label><br>
                                            <input type="text" class="form-control" name="appLink" id="appLink"
                                                placeholder="Enter Google Meet Link" value="<?php echo $value['gMeetLink']; ?>"
                                                oninput="validateLinkClearError(this)">
                                            <div id="link_err" class="text-danger pt-1"></div>
                                <?php if ($value['gMeetLink'] == '') { ?>
                                                <button type="submit" style="background-color: #2b353bf5;"
                                                    class="btn text-light my-2 float-end">Add</button>
                                <?php } else { ?>
                                                <button type="submit" style="background-color: #2b353bf5;"
                                                    class="btn text-light my-2 float-end">Update</button>
                                <?php } ?>
                                        </form>
                                        <h5 class="my-3 fw-bolder">Profile Approval Process:</h5>
                                        <!--<p>Please review the details and approve the Chief Consultant for login :
                                                  <a href="<?php echo base_url() . "Edfadmin/approveCc/" . $value['id'] ?>"
                                                    onclick="return confirm('The details have been verified and approved for login.')"><button
                                                        class="btn btn-success px-2 py-1">Approve</button></a> </p> -->
                                        <form action="<?php echo base_url() . "Edfadmin/approveCc/" . $value['id'] ?>" method="post"
                                            name="ccApproveForm" class="col-6 border border-2 rounded p-3">
                                            <p>Verify the details and approve to login: </p>
                                            <div class="mb-2 ps-2"><input type="radio" name="approveCc" value="0" id="notApproved" <?php if ($value['approvalStatus'] == '0')
                                                echo "checked"; ?> required>
                                                <label class="ps-2" for="notApproved">Not Approved</label>
                                            </div>
                                            <div class="mb-2 ps-2"><input type="radio" name="approveCc" value="1" id="approved" <?php if ($value['approvalStatus'] == '1')
                                                echo "checked"; ?> required>
                                                <label class="ps-2" for="approved">Approved</label>
                                            </div>
                                            <button type="submit" style="background-color: #2b353bf5;"
                                                class="btn text-light px-2 py-1 mt-2">Approve</button>
                                        </form>
                            <?php
                                } ?>
                                </div>
                            </div>
                        </section>


                        <script>
                            function validateLink() {
                                var appAddLink = document.getElementById("appLink").value;

                                if (appAddLink == "") {
                                    document.getElementById("link_err").innerHTML = "Link must be filled out.";
                                    return false;
                                } else {
                                    document.getElementById("link_err").innerHTML = "";
                                }
                            }

                            function validateLinkClearError(input) {
                                const linkError = document.getElementById("link_err");
                                if (input.value != "") {
                                    linkError.textContent = "";
                                }
                            }
                        </script>

            <?php
        } else if ($method == "healthCareProvider") {
            ?>

                            <section>
                                <div class="card rounded">
                                    <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                        <p style="font-size: 24px; font-weight: 500">Health Care Provider List</p>
                                        <a href="<?php echo base_url() . 'Edfadmin/hcpSignupForm'; ?>">
                                            <button style="background-color: #2b353bf5;"
                                                class="text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                                <i class="bi bi-plus-square-fill"></i> Add HCP
                                            </button>
                                        </a>
                                    </div>
                    <?php if (isset($hcpList[0]['id'])) { ?>
                                        <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                            <div class="ms-2 py-2 py-md-0">
                                                <label for="itemsPerPageDropdown">Show </label>
                                                <select id="itemsPerPageDropdown"
                                                    class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                    <option value="10" selected>10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                                <label for="itemsPerPageDropdown">Entries </label>
                                            </div>
                                            <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                    style="height: 50px; width: 250px" placeholder="Search (ID / NAME)">
                                                <span id="clearSearch" class="position-absolute"
                                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-2 p-sm-4">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-center" id="hcpTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">ID</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">NAME</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">MOBILE NUMBER</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">SPECIALIST</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">STATUS</th>
                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="hcpTableBody"></tbody>
                                                </table>
                                            </div>
                                            <div class="d-md-flex justify-content-between ms-2">
                                                <div id="entriesInfo" class="mt-4"></div>
                                                <div class="pagination justify-content-end mt-4" id="paginationContainerHcp"></div>
                                            </div>
                                        </div>
                    <?php } else { ?>
                                        <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                    <?php } ?>
                                </div>
                            </section>



                            <script>
                                const baseUrl = '<?php echo base_url(); ?>';
                                let itemsPerPageHcp = 10;
                                const hcpList = <?php echo json_encode($hcpList); ?>;
                                let filteredHcpList = [...hcpList];
                                const initialPageHcp = parseInt(localStorage.getItem('currentPageHcp')) || 1;

                                const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                const searchBar = document.getElementById('searchBar');
                                const clearSearch = document.getElementById('clearSearch');

                                // Load saved itemsPerPage
                                const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageHcp')) || itemsPerPageHcp;
                                itemsPerPageDropdown.value = savedItemsPerPage;
                                itemsPerPageHcp = savedItemsPerPage;

                                // Event Listeners
                                itemsPerPageDropdown.addEventListener('change', (event) => {
                                    itemsPerPageHcp = parseInt(event.target.value);
                                    localStorage.setItem('itemsPerPageHcp', itemsPerPageHcp);
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

                                function toggleClearIcons() {
                                    clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                }

                                function applyFilters() {
                                    const searchTerm = searchBar.value.toLowerCase();

                                    filteredHcpList = hcpList.filter((hcp) => {
                                        const fullName = hcp.hcpName || '';
                                        const hcpId = hcp.hcpId || '';

                                        return (
                                            fullName.toLowerCase().includes(searchTerm) ||
                                            hcpId.toLowerCase().includes(searchTerm)
                                        );
                                    });

                                    displayHcpPage(1);
                                }

                                function displayHcpPage(page) {
                                    localStorage.setItem('currentPageHcp', page);
                                    const start = (page - 1) * itemsPerPageHcp;
                                    const end = start + itemsPerPageHcp;
                                    const itemsToShow = filteredHcpList.slice(start, end);

                                    const hcpTableBody = document.getElementById('hcpTableBody');
                                    hcpTableBody.innerHTML = '';

                                    updateEntriesInfo(start + 1, Math.min(end, filteredHcpList.length), filteredHcpList.length);

                                    if (itemsToShow.length === 0) {
                                        const noMatchesRow = document.createElement('tr');
                                        noMatchesRow.innerHTML = '<td colspan="7" class="text-center">No matches found.</td>';
                                        hcpTableBody.appendChild(noMatchesRow);
                                    } else {
                                        itemsToShow.forEach((hcp, index) => {
                                            const hcpRow = document.createElement('tr');
                                            hcpRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${hcp.hcpId}</td>
                <td style="font-size: 16px" class="pt-3">${hcp.hcpName}</td>
                <td style="font-size: 16px" class="pt-3">${hcp.hcpMobile}</td>
                <td style="font-size: 16px" class="pt-3">${hcp.hcpSpecialization}</td>
                <td style="font-size: 16px" class="pt-3">
                    ${hcp.approvalStatus == 1 ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-check-fill text-danger"></i>'}
                </td>
                <td class="d-flex d-md-block" style="font-size: 16px">
                    <a href="${baseUrl}Edfadmin/hcpDetails/${hcp.id}"><button class="btn btn-success me-1"><i class="bi bi-eye"></i></button></a>
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${hcp.id}" data-name="${hcp.hcpName}" data-type="hcp"><i class="bi bi-trash"></i></button>
                </td>`;
                                            hcpTableBody.appendChild(hcpRow);
                                        });
                                    }

                                    generateHcpPagination(filteredHcpList.length, page);
                                }

                                function updateEntriesInfo(start, end, totalEntries) {
                                    const entriesInfo = document.getElementById('entriesInfo');
                                    entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                }

                                function generateHcpPagination(totalItems, currentPage) {
                                    const totalPages = Math.ceil(totalItems / itemsPerPageHcp);
                                    const paginationContainer = document.getElementById('paginationContainerHcp');
                                    paginationContainer.innerHTML = '';

                                    const ul = document.createElement('ul');
                                    ul.className = 'pagination';

                                    const prevLi = document.createElement('li');
                                    prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                    prevLi.onclick = () => {
                                        if (currentPage > 1) displayHcpPage(currentPage - 1);
                                    };
                                    ul.appendChild(prevLi);

                                    const startPage = Math.max(1, currentPage - 2);
                                    const endPage = Math.min(totalPages, startPage + 4);

                                    for (let i = startPage; i <= endPage; i++) {
                                        const li = document.createElement('li');
                                        li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                        li.onclick = () => displayHcpPage(i);
                                        ul.appendChild(li);
                                    }

                                    const nextLi = document.createElement('li');
                                    nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                    nextLi.onclick = () => {
                                        if (currentPage < totalPages) displayHcpPage(currentPage + 1);
                                    };
                                    ul.appendChild(nextLi);

                                    paginationContainer.appendChild(ul);
                                }

                                // On load: Show all data, then render
                                toggleClearIcons();
                                filteredHcpList = [...hcpList];
                                displayHcpPage(initialPageHcp);
                            </script>

            <?php
        } else if ($method == "hcpRegisterForm") {
            ?>
                                <section>
                                    <div class="card rounded">
                                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                            <p style="font-size: 24px; font-weight: 500">
                                                New Health Care Provider</p>
                                            <a href="<?php echo base_url() . "Edfadmin/hcpList" ?>" class="text-dark mt-2"><i
                                                    class="bi bi-arrow-left"></i> Back</a>
                                        </div>
                                        <div class="card-body col-md-8 px-sm-4">
                                            <p style="font-size: 20px; font-weight: 500">Create an Account for Health Care Provider</p>
                                            <form action="<?php echo base_url() . "Edfadmin/hcpSignup" ?>" method="post" name="hcpsignupform"
                                                onsubmit="return validateSignup()" oninput="return removeError()">
                                                <div class="mb-3">
                                                    <label for="hcpName" class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="hcpName" id="hcpName" placeholder="Suresh Kumar"
                                                        class="form-control">
                                                    <div id="name_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpMobile" class="form-label">Mobile Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="hcpMobile" id="hcpMobile" placeholder="9876543210"
                                                        class="form-control">
                                                    <div id="mobile_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpEmail" class="form-label">Email Id <span class="text-danger">*</span></label>
                                                    <input type="email" name="hcpEmail" id="hcpEmail" placeholder="example@gmail.com"
                                                        class="form-control">
                                                    <div id="mail_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpSpec" class="form-label">Specialization <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="hcpSpec" name="hcpSpec">
                                                        <option value="">Select Specialization</option>
                                        <?php
                                        foreach ($specializationList as $key => $value) {
                                            ?>
                                                            <option value="<?php echo $value['specializationName'] ?>">
                                            <?php echo $value['specializationName'] ?>
                                                            </option>
                                    <?php } ?>
                                                    </select>
                                                    <div id="spec_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpPassword" class="form-label">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div style="position: relative;">
                                                        <input type="password" name="hcpPassword" id="hcpPassword" placeholder="password"
                                                            class="form-control">
                                                        <i class="bi bi-eye-slash" onclick="togglePasswordVisibility('hcpPassword', this)"
                                                            style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                                    </div>
                                                    <div id="password_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                                                    Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                                                    and a minimum of 8 characters.</div>
                                                <div class="mb-3">
                                                    <label for="hcpCnfmPassword" class="form-label">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <div style="position: relative;">
                                                        <input type="password" name="hcpCnfmPassword" id="hcpCnfmPassword"
                                                            placeholder="confirm password" class="form-control">
                                                        <i class="bi bi-eye-slash" onclick="togglePasswordVisibility('hcpCnfmPassword', this)"
                                                            style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                                    </div>
                                                    <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                                                </div>
                                                <input type="hidden" name="approvalApproved" id="approvalApproved" value="1">
                                                <input type="hidden" name="firstLoginPswdChange" id="firstLoginPswdChange" value="0">

                                                <div class="d-flex justify-content-between">
                                                    <button type="reset" class="btn btn-secondary text-light mt-2">Reset</button>
                                                    <button type="submit" style="background-color: #2b353bf5;"
                                                        class="btn text-light float-end mt-2">Sign Up</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>

                                <script>
                                    function validateSignup() {
                                        var name = document.getElementById("hcpName").value;
                                        var mobile = document.getElementById("hcpMobile").value;
                                        var email = document.getElementById("hcpEmail").value;
                                        var spec = document.getElementById("hcpSpec").value;
                                        var password = document.getElementById("hcpPassword").value;
                                        var confirmpassword = document.getElementById("hcpCnfmPassword").value;

                                        if (name == "") {
                                            document.getElementById("name_err").innerHTML = "Name must be filled out.";
                                            return false;
                                        } else {
                                            document.getElementById("name_err").innerHTML = "";
                                        }

                                        if (mobile == "") {
                                            document.getElementById("mobile_err").innerHTML = "Mobile number must be filled out.";
                                            return false;
                                        } else if (!/^\d{10}$/.test(mobile)) {
                                            document.getElementById("mobile_err").innerHTML = "Invalid mobile number. Please enter valid number.";
                                            return false;
                                        } else {
                                            document.getElementById("mobile_err").innerHTML = "";
                                        }

                                        if (email == "") {
                                            document.getElementById("mail_err").innerHTML = "Mail address must be filled out.";
                                            return false;
                                        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                                            document.getElementById("mail_err").innerHTML = "Invalid email address. Please enter valid mail address.";
                                            return false;
                                        } else {
                                            document.getElementById("mail_err").innerHTML = "";
                                        }

                                        if (spec == "") {
                                            document.getElementById("spec_err").innerHTML = "Specialization must be filled out.";
                                            return false;
                                        } else {
                                            document.getElementById("spec_err").innerHTML = "";
                                        }

                                        if (password == "") {
                                            document.getElementById("password_err").innerHTML = "Password must be filled out.";
                                            return false;
                                        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
                                            document.getElementById("password_err").innerHTML = "Invalid password. Please enter valid password."
                                            return false;
                                        } else {
                                            document.getElementById("password_err").innerHTML = "";
                                        }

                                        if (confirmpassword == "") {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Re-enter the password.";
                                            return false;
                                        } else if (confirmpassword != password) {
                                            document.getElementById("cnfmpassword_err").innerHTML = "Enter same as password."
                                            return false;
                                        } else {
                                            document.getElementById("cnfmpassword_err").innerHTML = "";
                                        }
                                    }

                                    document.getElementById("hcpPassword").onfocus = function () {
                                        document.getElementById("passwordmessage").style.display = "block";
                                    }

                                    document.getElementById("hcpPassword").onblur = function () {
                                        document.getElementById("passwordmessage").style.display = "none";
                                    }


                                    function removeError() {
                                        var name = document.getElementById("hcpName").value;
                                        var mobile = document.getElementById("hcpMobile").value;
                                        var email = document.getElementById("hcpEmail").value;
                                        var spec = document.getElementById("hcpSpec").value;
                                        var password = document.getElementById("hcpPassword").value;
                                        var confirmpassword = document.getElementById("hcpCnfmPassword").value;

                                        if (name != "") {
                                            document.getElementById("name_err").innerHTML = "";
                                        }

                                        if (mobile != "") {
                                            document.getElementById("mobile_err").innerHTML = "";
                                        }

                                        if (email != "") {
                                            document.getElementById("mail_err").innerHTML = "";
                                        }

                                        if (spec != "") {
                                            document.getElementById("spec_err").innerHTML = "";
                                        }

                                        if (password != "") {
                                            document.getElementById("password_err").innerHTML = "";
                                        }

                                        if (confirmpassword != "") {
                                            document.getElementById("cnfmpassword_err").innerHTML = "";
                                        }
                                    }
                                </script>

            <?php
        } else if ($method == "hcpDetails") {
            ?>

                                    <section>
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500"> Health Care Provider's Profile</p>
                                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                                        class="bi bi-arrow-left"></i> Back</button>
                                            </div>

                                            <div class="card-body p-3 p-sm-4">
                                                <div class="d-flex justify-content-start mt-2 mb-5">
                                <?php
                                foreach ($hcpDetails as $key => $value) {
                                    ?>

                                <?php if (isset($value['hcpPhoto']) && $value['hcpPhoto'] != "") { ?>
                                                            <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                height="140" class="rounded-circle">
                                <?php } ?>
                                                        <div class="ps-sm-5">
                                                            <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['hcpName']; ?>
                                                            </p>
                                                            <p style="font-size:16px;font-weight:400;">
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
                                    <?php echo $value['hcpExperience'] ? $value['hcpExperience'] : "Not provided"; ?>
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

                                                    <h5 class="my-3 fw-bolder">Profile Approval Process:</h5>
                                                    <!-- <p>Please review the details and approve the Health Care Provider for login : <a
                                                                href="<?php echo base_url() . "Edfadmin/approveHcp/" . $value['id'] ?>"
                                                                onclick="return confirm('The details have been verified and approved for login.')"><button
                                                                    class="btn btn-success px-2 py-1">Approve</button></a> </p> -->
                                                    <form action="<?php echo base_url() . "Edfadmin/approveHcp/" . $value['id'] ?>" method="post"
                                                        name="hcpApproveForm" class="col-6 border border-2 rounded p-3">
                                                        <p>Verify the details and approve to login: </p>
                                                        <div class="mb-2 ps-2"><input type="radio" name="approveHcp" value="0" id="notApproved" <?php if ($value['approvalStatus'] == '0')
                                                            echo "checked"; ?> required>
                                                            <label class="ps-2" for="notApproved">Not Approved</label>
                                                        </div>
                                                        <div class="mb-2 ps-2"><input type="radio" name="approveHcp" value="1" id="approved" <?php if ($value['approvalStatus'] == '1')
                                                            echo "checked"; ?> required>
                                                            <label class="ps-2" for="approved">Approved</label>
                                                        </div>
                                                        <button type="submit" style="background-color: #2b353bf5;"
                                                            class="btn text-light px-2 py-1 mt-2">Approve</button>
                                                    </form>
                        <?php } ?>
                                            </div>

                                    </section>

            <?php
        } else if ($method == "patient") {
            ?>

                                        <section>
                                            <div class="card rounded">
                                                <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                    <p style="font-size: 24px; font-weight: 500">Patients List</p>
                                                </div>
                    <?php if (isset($patientList[0]['id'])) { ?>
                                                    <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-4">
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
                                                    <div class="mt-3 ms-4">
                                                        <label for="itemsPerPageDropdown">Show </label>
                                                        <select id="itemsPerPageDropdown"
                                                            class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                            <option value="10" selected>10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                        <label for="itemsPerPageDropdown">Entries </label>
                                                    </div>
                                                    <div class="card-body p-2 p-sm-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover text-center" id="patientTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">PATIENT ID</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">PATIENT NAME</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">MOBILE NUMBER</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">GENDER</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">AGE</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">PATIENT HCP</th>
                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="patientTableBody"></tbody>
                                                            </table>
                                                        </div>
                                                        <div class="d-md-flex justify-content-between ms-2">
                                                            <div id="entriesInfo" class="mt-4"></div>
                                                            <div class="pagination justify-content-end mt-4" id="paginationContainerPatient"></div>
                                                        </div>
                                                    </div>

                    <?php } else { ?>
                                                    <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                    <?php } ?>
                                            </div>
                                        </section>


                                        <script>
                                            const baseUrl = '<?php echo base_url(); ?>';
                                            let itemsPerPagePatient = 10;
                                            const patientList = <?php echo json_encode($patientList); ?>;
                                            let filteredPatientList = [...patientList];
                                            const initialPagePatient = parseInt(localStorage.getItem('currentPagePatient')) || 1;

                                            const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                            const searchBar = document.getElementById('searchBar');
                                            const clearSearch = document.getElementById('clearSearch');
                                            const filterDropdown = document.getElementById('filterDropdown');

                                            // Load saved itemsPerPage
                                            const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPagePatient')) || itemsPerPagePatient;
                                            itemsPerPageDropdown.value = savedItemsPerPage;
                                            itemsPerPagePatient = savedItemsPerPage;

                                            // Event Listeners
                                            itemsPerPageDropdown.addEventListener('change', (event) => {
                                                itemsPerPagePatient = parseInt(event.target.value);
                                                localStorage.setItem('itemsPerPagePatient', itemsPerPagePatient);
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

                                                filteredPatientList = patientList.filter((patient) => {
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
                                                localStorage.setItem('currentPagePatient', page);
                                                const start = (page - 1) * itemsPerPagePatient;
                                                const end = start + itemsPerPagePatient;
                                                const itemsToShow = filteredPatientList.slice(start, end);

                                                const patientTableBody = document.getElementById('patientTableBody');
                                                patientTableBody.innerHTML = '';

                                                updateEntriesInfo(start + 1, Math.min(end, filteredPatientList.length), filteredPatientList.length);

                                                if (itemsToShow.length === 0) {
                                                    const noMatchesRow = document.createElement('tr');
                                                    noMatchesRow.innerHTML = '<td colspan="8" class="text-center">No matches found.</td>';
                                                    patientTableBody.appendChild(noMatchesRow);
                                                } else {
                                                    itemsToShow.forEach((patient, index) => {
                                                        const patientRow = document.createElement('tr');
                                                        patientRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${patient.patientId}</td>
                <td style="font-size: 16px" class="pt-3">${patient.firstName} ${patient.lastName}</td>
                <td style="font-size: 16px" class="pt-3">${patient.mobileNumber}</td>
                <td style="font-size: 16px" class="pt-3">${patient.gender}</td>
                <td style="font-size: 16px" class="pt-3">${patient.age}</td>
                <td style="font-size: 16px" class="pt-3">
                    <a href="${baseUrl}Edfadmin/hcpDetails/${patient.patientHcpDbId}" class="text-dark" onmouseover="style='text-decoration:underline'" onmouseout="style='text-decoration:none'">${patient.patientHcp}</a>
                </td>
                <td class="d-flex d-md-block" style="font-size: 16px">
                    <a href="${baseUrl}Edfadmin/patientdetails/${patient.id}"><button class="btn btn-success me-1"><i class="bi bi-eye"></i></button></a>
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${patient.id}" data-name="${patient.firstName} ${patient.lastName}" data-type="patient"><i class="bi bi-trash"></i></button>
                </td>`;
                                                        patientTableBody.appendChild(patientRow);
                                                    });
                                                }

                                                generatePatientPagination(filteredPatientList.length, page);
                                            }

                                            function updateEntriesInfo(start, end, totalEntries) {
                                                const entriesInfo = document.getElementById('entriesInfo');
                                                entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                            }

                                            function generatePatientPagination(totalItems, currentPage) {
                                                const totalPages = Math.ceil(totalItems / itemsPerPagePatient);
                                                const paginationContainer = document.getElementById('paginationContainerPatient');
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
                                                const endPage = Math.min(totalPages, startPage + 4);

                                                for (let i = startPage; i <= endPage; i++) {
                                                    const li = document.createElement('li');
                                                    li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
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
                                            filteredPatientList = [...patientList];
                                            displayPatientPage(initialPagePatient);
                                        </script>

            <?php
        } else if ($method == "patientDetails") {
            ?>

                                            <section>
                                                <div class="card rounded">
                                                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500"> Patient Details</p>
                                                        <button onclick="goBack()" class="border-0 bg-light float-end text-dark"><i
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
                                                                <p class="col-sm-6"><span class="text-secondary ">Mobile Number</span> : <a
                                                                        href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?></a></p>
                                                                <p><span class="text-secondary ">Alternate mobile</span> :
                                    <?php echo $value['alternateMobile'] ? $value['alternateMobile'] : "Not provided"; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-md-flex">
                                                                <p class="col-sm-6"><span class="text-secondary ">Email Id</span> :
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
                        <?php } ?>
                                                    </div>
                                                </div>
                                            </section>

            <?php
        } else if ($method == "specialization") {
            ?>

                                                <section>
                                                    <div class="card rounded">
                                                        <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                            <p style="font-size: 24px; font-weight: 500">Specialization List</p>
                                                            <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newSpecilization"
                                                                style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                <i class="bi bi-plus-square-fill"></i> New
                                                            </a>
                                                        </div>
                                                        <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                            <div class="ms-2">
                                                                <label for="itemsPerPageDropdown">Show </label>
                                                                <select id="itemsPerPageDropdown"
                                                                    class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                    <option value="10" selected>10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                </select>
                                                                <label for="itemsPerPageDropdown">Entries </label>
                                                            </div>
                                                            <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                    style="height: 50px; width: 250px" placeholder="Search (SPECIALIZATION)">
                                                                <span id="clearSearch" class="position-absolute"
                                                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-2 p-sm-4">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover text-center" id="specializationTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                            </th>
                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                SPECIALIZATION NAME</th>
                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="specializationTableBody"></tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-md-flex justify-content-between ms-2">
                                                                <div id="entriesInfo" class="mt-4"></div>
                                                                <div class="pagination justify-content-end mt-4" id="paginationContainerSpecialization">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </section>

                                                <script>
                                                    const baseUrl = '<?php echo base_url(); ?>';
                                                    let itemsPerPageSpecialization = 10;
                                                    const specializationList = <?php echo json_encode($specilalizationList); ?>;
                                                    let filteredSpecializationList = [...specializationList];
                                                    const initialPageSpecialization = parseInt(localStorage.getItem('currentPageSpecialization')) || 1;

                                                    const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                    const searchBar = document.getElementById('searchBar');
                                                    const clearSearch = document.getElementById('clearSearch');

                                                    // Load saved itemsPerPage
                                                    const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageSpecialization')) || itemsPerPageSpecialization;
                                                    itemsPerPageDropdown.value = savedItemsPerPage;
                                                    itemsPerPageSpecialization = savedItemsPerPage;

                                                    // Event Listeners
                                                    itemsPerPageDropdown.addEventListener('change', (event) => {
                                                        itemsPerPageSpecialization = parseInt(event.target.value);
                                                        localStorage.setItem('itemsPerPageSpecialization', itemsPerPageSpecialization);
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

                                                    function toggleClearIcons() {
                                                        clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                    }

                                                    function applyFilters() {
                                                        const searchTerm = searchBar.value.toLowerCase();

                                                        filteredSpecializationList = specializationList.filter((specialization) => {
                                                            const specializationName = specialization.specializationName || '';
                                                            return specializationName.toLowerCase().includes(searchTerm);
                                                        });

                                                        displaySpecializationPage(1);
                                                    }

                                                    function displaySpecializationPage(page) {
                                                        localStorage.setItem('currentPageSpecialization', page);
                                                        const start = (page - 1) * itemsPerPageSpecialization;
                                                        const end = start + itemsPerPageSpecialization;
                                                        const itemsToShow = filteredSpecializationList.slice(start, end);

                                                        const specializationTableBody = document.getElementById('specializationTableBody');
                                                        specializationTableBody.innerHTML = '';

                                                        updateEntriesInfo(start + 1, Math.min(end, filteredSpecializationList.length), filteredSpecializationList.length);

                                                        if (itemsToShow.length === 0) {
                                                            const noMatchesRow = document.createElement('tr');
                                                            noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                            specializationTableBody.appendChild(noMatchesRow);
                                                        } else {
                                                            itemsToShow.forEach((specialization, index) => {
                                                                const specializationRow = document.createElement('tr');
                                                                specializationRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${specialization.specializationName}</td>
                <td class="d-flex d-md-block">
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${specialization.id}" data-name="${specialization.specializationName}" data-type="specialization"><i class="bi bi-trash"></i></button>
                </td>`;
                                                                specializationTableBody.appendChild(specializationRow);
                                                            });
                                                        }

                                                        generateSpecializationPagination(filteredSpecializationList.length, page);
                                                    }

                                                    function updateEntriesInfo(start, end, totalEntries) {
                                                        const entriesInfo = document.getElementById('entriesInfo');
                                                        entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                    }

                                                    function generateSpecializationPagination(totalItems, currentPage) {
                                                        const totalPages = Math.ceil(totalItems / itemsPerPageSpecialization);
                                                        const paginationContainer = document.getElementById('paginationContainerSpecialization');
                                                        paginationContainer.innerHTML = '';

                                                        const ul = document.createElement('ul');
                                                        ul.className = 'pagination';

                                                        const prevLi = document.createElement('li');
                                                        prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                        prevLi.onclick = () => {
                                                            if (currentPage > 1) displaySpecializationPage(currentPage - 1);
                                                        };
                                                        ul.appendChild(prevLi);

                                                        const startPage = Math.max(1, currentPage - 2);
                                                        const endPage = Math.min(totalPages, startPage + 4);

                                                        for (let i = startPage; i <= endPage; i++) {
                                                            const li = document.createElement('li');
                                                            li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                            li.onclick = () => displaySpecializationPage(i);
                                                            ul.appendChild(li);
                                                        }

                                                        const nextLi = document.createElement('li');
                                                        nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                        nextLi.onclick = () => {
                                                            if (currentPage < totalPages) displaySpecializationPage(currentPage + 1);
                                                        };
                                                        ul.appendChild(nextLi);

                                                        paginationContainer.appendChild(ul);
                                                    }

                                                    // On load: Show all data, then render
                                                    toggleClearIcons();
                                                    filteredSpecializationList = [...specializationList];
                                                    displaySpecializationPage(initialPageSpecialization);
                                                </script>
            <?php
        } else if ($method == "symptoms") {
            ?>

                                                    <section>
                                                        <div class="card rounded">
                                                            <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                <p style="font-size: 24px; font-weight: 500">Symptoms List</p>
                                                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newSymptoms"
                                                                    style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                    <i class="bi bi-plus-square-fill"></i> New
                                                                </a>
                                                            </div>
                                                            <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                <div class="ms-2">
                                                                    <label for="itemsPerPageDropdown">Show </label>
                                                                    <select id="itemsPerPageDropdown"
                                                                        class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                        <option value="10" selected>10</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                    </select>
                                                                    <label for="itemsPerPageDropdown">Entries </label>
                                                                </div>
                                                                <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                    <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                        style="height: 50px; width: 250px" placeholder="Search (SYMPTOMS NAME)">
                                                                    <span id="clearSearch" class="position-absolute"
                                                                        style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body p-2 p-sm-4">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover text-center" id="symptomsTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                </th>
                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                    SYMPTOMS NAME</th>
                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="symptomsTableBody"></tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between">
                                                                    <div id="entriesInfo" class="mt-4"></div>
                                                                    <div class="pagination justify-content-end mt-4" id="paginationContainerSymptoms"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <script>
                                                        const baseUrl = '<?php echo base_url(); ?>';
                                                        let itemsPerPageSymptoms = 10;
                                                        const symptomsList = <?php echo json_encode($symptomsList); ?>;
                                                        let filteredSymptomsList = [...symptomsList];
                                                        const initialPageSymptoms = parseInt(localStorage.getItem('currentPageSymptoms')) || 1;

                                                        const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                        const searchBar = document.getElementById('searchBar');
                                                        const clearSearch = document.getElementById('clearSearch');

                                                        const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageSymptoms')) || itemsPerPageSymptoms;
                                                        itemsPerPageDropdown.value = savedItemsPerPage;
                                                        itemsPerPageSymptoms = savedItemsPerPage;

                                                        itemsPerPageDropdown.addEventListener('change', (event) => {
                                                            itemsPerPageSymptoms = parseInt(event.target.value);
                                                            localStorage.setItem('itemsPerPageSymptoms', itemsPerPageSymptoms);
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

                                                        function toggleClearIcons() {
                                                            clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                        }

                                                        function applyFilters() {
                                                            const searchTerm = searchBar.value.toLowerCase();

                                                            filteredSymptomsList = symptomsList.filter((symptom) => {
                                                                const symptomName = symptom.symptomsName || '';
                                                                return symptomName.toLowerCase().includes(searchTerm);
                                                            });

                                                            displaySymptomsPage(1);
                                                        }

                                                        function displaySymptomsPage(page) {
                                                            localStorage.setItem('currentPageSymptoms', page);
                                                            const start = (page - 1) * itemsPerPageSymptoms;
                                                            const end = start + itemsPerPageSymptoms;
                                                            const itemsToShow = filteredSymptomsList.slice(start, end);

                                                            const symptomsTableBody = document.getElementById('symptomsTableBody');
                                                            symptomsTableBody.innerHTML = '';

                                                            updateEntriesInfo(start + 1, Math.min(end, filteredSymptomsList.length), filteredSymptomsList.length);

                                                            if (itemsToShow.length === 0) {
                                                                const noMatchesRow = document.createElement('tr');
                                                                noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                symptomsTableBody.appendChild(noMatchesRow);
                                                            } else {
                                                                itemsToShow.forEach((symptom, index) => {
                                                                    const symptomRow = document.createElement('tr');
                                                                    symptomRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${symptom.symptomsName}</td>
                <td class="d-flex d-md-block">
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${symptom.id}" data-name="${symptom.symptomsName}" data-type="symptom"><i class="bi bi-trash"></i></button>
                </td>`;
                                                                    symptomsTableBody.appendChild(symptomRow);
                                                                });
                                                            }

                                                            generateSymptomsPagination(filteredSymptomsList.length, page);
                                                        }

                                                        function updateEntriesInfo(start, end, totalEntries) {
                                                            const entriesInfo = document.getElementById('entriesInfo');
                                                            entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                        }

                                                        function generateSymptomsPagination(totalItems, currentPage) {
                                                            const totalPages = Math.ceil(totalItems / itemsPerPageSymptoms);
                                                            const paginationContainer = document.getElementById('paginationContainerSymptoms');
                                                            paginationContainer.innerHTML = '';

                                                            const ul = document.createElement('ul');
                                                            ul.className = 'pagination';

                                                            const prevLi = document.createElement('li');
                                                            prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                            prevLi.onclick = () => {
                                                                if (currentPage > 1) displaySymptomsPage(currentPage - 1);
                                                            };
                                                            ul.appendChild(prevLi);

                                                            const startPage = Math.max(1, currentPage - 2);
                                                            const endPage = Math.min(totalPages, startPage + 4);

                                                            for (let i = startPage; i <= endPage; i++) {
                                                                const li = document.createElement('li');
                                                                li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                li.onclick = () => displaySymptomsPage(i);
                                                                ul.appendChild(li);
                                                            }

                                                            const nextLi = document.createElement('li');
                                                            nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                            nextLi.onclick = () => {
                                                                if (currentPage < totalPages) displaySymptomsPage(currentPage + 1);
                                                            };
                                                            ul.appendChild(nextLi);

                                                            paginationContainer.appendChild(ul);
                                                        }

                                                        toggleClearIcons();
                                                        filteredSymptomsList = [...symptomsList];
                                                        displaySymptomsPage(initialPageSymptoms);
                                                    </script>

            <?php
        } else if ($method == "findings") {
            ?>

                                                        <section>
                                                            <div class="card rounded">
                                                                <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                    <p style="font-size: 24px; font-weight: 500">Findings List</p>
                                                                    <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newFindings"
                                                                        style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                        <i class="bi bi-plus-square-fill"></i> New
                                                                    </a>
                                                                </div>
                                                                <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                    <div class="ms-2">
                                                                        <label for="itemsPerPageDropdown">Show </label>
                                                                        <select id="itemsPerPageDropdown"
                                                                            class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                            <option value="10" selected>10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="50">50</option>
                                                                        </select>
                                                                        <label for="itemsPerPageDropdown">Entries </label>
                                                                    </div>
                                                                    <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                        <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                            style="height: 50px; width: 250px" placeholder="Search (FINDINGS NAME)">
                                                                        <span id="clearSearch" class="position-absolute"
                                                                            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body p-2 p-sm-4">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover text-center" id="findingssTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                    </th>
                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                        FINDINGS NAME</th>
                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="findingsTableBody"></tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="d-md-flex justify-content-between">
                                                                        <div id="entriesInfo" class="mt-4"></div>
                                                                        <div class="pagination justify-content-end mt-4" id="paginationContainerFindings"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <script>
                                                            const baseUrl = '<?php echo base_url(); ?>';
                                                            let itemsPerPageFindings = 10;
                                                            const findingsList = <?php echo json_encode($findingsList); ?>;
                                                            let filteredFindingsList = [...findingsList];
                                                            const initialPageFindings = parseInt(localStorage.getItem('currentPageFindings')) || 1;

                                                            const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                            const searchBar = document.getElementById('searchBar');
                                                            const clearSearch = document.getElementById('clearSearch');

                                                            const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageFindings')) || itemsPerPageFindings;
                                                            itemsPerPageDropdown.value = savedItemsPerPage;
                                                            itemsPerPageFindings = savedItemsPerPage;

                                                            itemsPerPageDropdown.addEventListener('change', (event) => {
                                                                itemsPerPageFindings = parseInt(event.target.value);
                                                                localStorage.setItem('itemsPerPageFindings', itemsPerPageFindings);
                                                                applyFiltersFindings();
                                                            });

                                                            searchBar.addEventListener('input', () => {
                                                                toggleClearIconsFindings();
                                                                applyFiltersFindings();
                                                            });

                                                            clearSearch.addEventListener('click', () => {
                                                                searchBar.value = '';
                                                                toggleClearIconsFindings();
                                                                applyFiltersFindings();
                                                            });

                                                            function toggleClearIconsFindings() {
                                                                clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                            }

                                                            function applyFiltersFindings() {
                                                                const searchTerm = searchBar.value.toLowerCase();

                                                                filteredFindingsList = findingsList.filter((finding) => {
                                                                    const findingName = finding.findingsName || '';
                                                                    return findingName.toLowerCase().includes(searchTerm);
                                                                });

                                                                displayFindingsPage(1);
                                                            }

                                                            function displayFindingsPage(page) {
                                                                localStorage.setItem('currentPageFindings', page);
                                                                const start = (page - 1) * itemsPerPageFindings;
                                                                const end = start + itemsPerPageFindings;
                                                                const itemsToShow = filteredFindingsList.slice(start, end);

                                                                const findingsTableBody = document.getElementById('findingsTableBody');
                                                                findingsTableBody.innerHTML = '';

                                                                updateEntriesInfoFindings(start + 1, Math.min(end, filteredFindingsList.length), filteredFindingsList.length);

                                                                if (itemsToShow.length === 0) {
                                                                    const noMatchesRow = document.createElement('tr');
                                                                    noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                    findingsTableBody.appendChild(noMatchesRow);
                                                                } else {
                                                                    itemsToShow.forEach((finding, index) => {
                                                                        const findingRow = document.createElement('tr');
                                                                        findingRow.innerHTML = `
                    <td class="pt-3">${start + index + 1}.</td>
                    <td style="font-size: 16px" class="pt-3">${finding.findingsName}</td>
                    <td class="d-flex d-md-block">
                        <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${finding.id}" data-name="${finding.findingsName}" data-type="finding"><i class="bi bi-trash"></i></button>
                    </td>`;
                                                                        findingsTableBody.appendChild(findingRow);
                                                                    });
                                                                }

                                                                generateFindingsPagination(filteredFindingsList.length, page);
                                                            }

                                                            function updateEntriesInfoFindings(start, end, totalEntries) {
                                                                const entriesInfo = document.getElementById('entriesInfo');
                                                                entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                            }

                                                            function generateFindingsPagination(totalItems, currentPage) {
                                                                const totalPages = Math.ceil(totalItems / itemsPerPageFindings);
                                                                const paginationContainer = document.getElementById('paginationContainerFindings');
                                                                paginationContainer.innerHTML = '';

                                                                const ul = document.createElement('ul');
                                                                ul.className = 'pagination';

                                                                const prevLi = document.createElement('li');
                                                                prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                                prevLi.onclick = () => {
                                                                    if (currentPage > 1) displayFindingsPage(currentPage - 1);
                                                                };
                                                                ul.appendChild(prevLi);

                                                                const startPage = Math.max(1, currentPage - 2);
                                                                const endPage = Math.min(totalPages, startPage + 4);

                                                                for (let i = startPage; i <= endPage; i++) {
                                                                    const li = document.createElement('li');
                                                                    li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                    li.onclick = () => displayFindingsPage(i);
                                                                    ul.appendChild(li);
                                                                }

                                                                const nextLi = document.createElement('li');
                                                                nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                                nextLi.onclick = () => {
                                                                    if (currentPage < totalPages) displayFindingsPage(currentPage + 1);
                                                                };
                                                                ul.appendChild(nextLi);

                                                                paginationContainer.appendChild(ul);
                                                            }

                                                            toggleClearIconsFindings();
                                                            filteredFindingsList = [...findingsList];
                                                            displayFindingsPage(initialPageFindings);
                                                        </script>


            <?php
        } else if ($method == "diagnosis") {
            ?>

                                                            <section>
                                                                <div class="card rounded">
                                                                    <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                        <p style="font-size: 24px; font-weight: 500">Diagnosis List</p>
                                                                        <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newDiagnosis"
                                                                            style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                            <i class="bi bi-plus-square-fill"></i> New
                                                                        </a>
                                                                    </div>
                                                                    <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                        <div class="ms-2">
                                                                            <label for="itemsPerPageDropdown">Show </label>
                                                                            <select id="itemsPerPageDropdown"
                                                                                class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                                <option value="10" selected>10</option>
                                                                                <option value="25">25</option>
                                                                                <option value="50">50</option>
                                                                            </select>
                                                                            <label for="itemsPerPageDropdown">Entries </label>
                                                                        </div>
                                                                        <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                            <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                                style="height: 50px; width: 250px" placeholder="Search (DIAGNOSIS NAME)">
                                                                            <span id="clearSearch" class="position-absolute"
                                                                                style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body p-2 p-sm-4">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover text-center" id="diagnosisTable">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                        </th>
                                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                            DIAGNOSIS NAME</th>
                                                                                        <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="diagnosisTableBody"></tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="d-md-flex justify-content-between">
                                                                            <div id="entriesInfo" class="mt-4"></div>
                                                                            <div class="pagination justify-content-end mt-4" id="paginationContainerDiagnosis"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>

                                                            <script>
                                                                const baseUrl = '<?php echo base_url(); ?>';
                                                                let itemsPerPageDiagnosis = 10;
                                                                const diagnosisList = <?php echo json_encode($diagnosisList); ?>;
                                                                let filteredDiagnosisList = [...diagnosisList];
                                                                const initialPageDiagnosis = parseInt(localStorage.getItem('currentPageDiagnosis')) || 1;

                                                                const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                                const searchBar = document.getElementById('searchBar');
                                                                const clearSearch = document.getElementById('clearSearch');

                                                                const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageDiagnosis')) || itemsPerPageDiagnosis;
                                                                itemsPerPageDropdown.value = savedItemsPerPage;
                                                                itemsPerPageDiagnosis = savedItemsPerPage;

                                                                itemsPerPageDropdown.addEventListener('change', (event) => {
                                                                    itemsPerPageDiagnosis = parseInt(event.target.value);
                                                                    localStorage.setItem('itemsPerPageDiagnosis', itemsPerPageDiagnosis);
                                                                    applyFiltersDiagnosis();
                                                                });

                                                                searchBar.addEventListener('input', () => {
                                                                    toggleClearIconsDiagnosis();
                                                                    applyFiltersDiagnosis();
                                                                });

                                                                clearSearch.addEventListener('click', () => {
                                                                    searchBar.value = '';
                                                                    toggleClearIconsDiagnosis();
                                                                    applyFiltersDiagnosis();
                                                                });

                                                                function toggleClearIconsDiagnosis() {
                                                                    clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                                }

                                                                function applyFiltersDiagnosis() {
                                                                    const searchTerm = searchBar.value.toLowerCase();

                                                                    filteredDiagnosisList = diagnosisList.filter((diagnosis) => {
                                                                        const diagnosisName = diagnosis.diagnosisName || '';
                                                                        return diagnosisName.toLowerCase().includes(searchTerm);
                                                                    });

                                                                    displayDiagnosisPage(1);
                                                                }

                                                                function displayDiagnosisPage(page) {
                                                                    localStorage.setItem('currentPageDiagnosis', page);
                                                                    const start = (page - 1) * itemsPerPageDiagnosis;
                                                                    const end = start + itemsPerPageDiagnosis;
                                                                    const itemsToShow = filteredDiagnosisList.slice(start, end);

                                                                    const diagnosisTableBody = document.getElementById('diagnosisTableBody');
                                                                    diagnosisTableBody.innerHTML = '';

                                                                    updateEntriesInfoDiagnosis(start + 1, Math.min(end, filteredDiagnosisList.length), filteredDiagnosisList.length);

                                                                    if (itemsToShow.length === 0) {
                                                                        const noMatchesRow = document.createElement('tr');
                                                                        noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                        diagnosisTableBody.appendChild(noMatchesRow);
                                                                    } else {
                                                                        itemsToShow.forEach((diagnosis, index) => {
                                                                            const diagnosisRow = document.createElement('tr');
                                                                            diagnosisRow.innerHTML = `
                    <td class="pt-3">${start + index + 1}.</td>
                    <td style="font-size: 16px" class="pt-3">${diagnosis.diagnosisName}</td>
                    <td class="d-flex d-md-block">
                        <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${diagnosis.id}" data-name="${diagnosis.diagnosisName}" data-type="diagnosis"><i class="bi bi-trash"></i></button>
                    </td>`;
                                                                            diagnosisTableBody.appendChild(diagnosisRow);
                                                                        });
                                                                    }

                                                                    generateDiagnosisPagination(filteredDiagnosisList.length, page);
                                                                }

                                                                function updateEntriesInfoDiagnosis(start, end, totalEntries) {
                                                                    const entriesInfo = document.getElementById('entriesInfo');
                                                                    entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                                }

                                                                function generateDiagnosisPagination(totalItems, currentPage) {
                                                                    const totalPages = Math.ceil(totalItems / itemsPerPageDiagnosis);
                                                                    const paginationContainer = document.getElementById('paginationContainerDiagnosis');
                                                                    paginationContainer.innerHTML = '';

                                                                    const ul = document.createElement('ul');
                                                                    ul.className = 'pagination';

                                                                    const prevLi = document.createElement('li');
                                                                    prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                                    prevLi.onclick = () => {
                                                                        if (currentPage > 1) displayDiagnosisPage(currentPage - 1);
                                                                    };
                                                                    ul.appendChild(prevLi);

                                                                    const startPage = Math.max(1, currentPage - 2);
                                                                    const endPage = Math.min(totalPages, startPage + 4);

                                                                    for (let i = startPage; i <= endPage; i++) {
                                                                        const li = document.createElement('li');
                                                                        li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                        li.onclick = () => displayDiagnosisPage(i);
                                                                        ul.appendChild(li);
                                                                    }

                                                                    const nextLi = document.createElement('li');
                                                                    nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                                    nextLi.onclick = () => {
                                                                        if (currentPage < totalPages) displayDiagnosisPage(currentPage + 1);
                                                                    };
                                                                    ul.appendChild(nextLi);

                                                                    paginationContainer.appendChild(ul);
                                                                }

                                                                toggleClearIconsDiagnosis();
                                                                filteredDiagnosisList = [...diagnosisList];
                                                                displayDiagnosisPage(initialPageDiagnosis);
                                                            </script>




            <?php
        } else if ($method == "medicines") {
            ?>

                                                                <section>
                                                                    <div class="card rounded">
                                                                        <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                                            <p style="font-size: 24px; font-weight: 500">Medicines List</p>
                                                                            <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newMedicine"
                                                                                style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                                <i class="bi bi-plus-square-fill"></i> New
                                                                            </a>
                                                                        </div>
                                                                        <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                            <div class="ms-2">
                                                                                <label for="itemsPerPageDropdown">Show </label>
                                                                                <select id="itemsPerPageDropdown"
                                                                                    class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                                    <option value="10" selected>10</option>
                                                                                    <option value="25">25</option>
                                                                                    <option value="50">50</option>
                                                                                </select>
                                                                                <label for="itemsPerPageDropdown">Entries </label>
                                                                            </div>
                                                                            <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                                <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                                    style="height: 50px; width: 250px" placeholder="Search (MEDICINE NAME)">
                                                                                <span id="clearSearch" class="position-absolute"
                                                                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card-body p-2 p-sm-4">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover text-center" id="medicinesTable">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                            </th>
                                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">BRAND
                                                                                                NAME</th>
                                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                                MEDICINE NAME</th>
                                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                                STRENGTH</th>
                                                                                            <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="medicinesTableBody"></tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="d-md-flex justify-content-between ms-2">
                                                                                <div id="entriesInfo" class="mt-4"></div>
                                                                                <div class="pagination justify-content-end mt-4" id="paginationContainerMedicines"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>

                                                                <script>
                                                                    const baseUrl = '<?php echo base_url(); ?>';
                                                                    let itemsPerPageMedicines = 10;
                                                                    const medicinesList = <?php echo json_encode($medicinesList); ?>;
                                                                    let filteredMedicinesList = [...medicinesList];
                                                                    const initialPageMedicines = parseInt(localStorage.getItem('currentPageMedicines')) || 1;

                                                                    const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                                    const searchBar = document.getElementById('searchBar');
                                                                    const clearSearch = document.getElementById('clearSearch');

                                                                    // Load saved itemsPerPage
                                                                    const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageMedicines')) || itemsPerPageMedicines;
                                                                    itemsPerPageDropdown.value = savedItemsPerPage;
                                                                    itemsPerPageMedicines = savedItemsPerPage;

                                                                    // Event Listeners
                                                                    itemsPerPageDropdown.addEventListener('change', (event) => {
                                                                        itemsPerPageMedicines = parseInt(event.target.value);
                                                                        localStorage.setItem('itemsPerPageMedicines', itemsPerPageMedicines);
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

                                                                    function toggleClearIcons() {
                                                                        clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                                    }

                                                                    function applyFilters() {
                                                                        const searchTerm = searchBar.value.toLowerCase();

                                                                        filteredMedicinesList = medicinesList.filter((medicine) => {
                                                                            const medicineName = medicine.medicineName || '';
                                                                            return medicineName.toLowerCase().includes(searchTerm);
                                                                        });

                                                                        displayMedicinesPage(1);
                                                                    }

                                                                    function displayMedicinesPage(page) {
                                                                        localStorage.setItem('currentPageMedicines', page);
                                                                        const start = (page - 1) * itemsPerPageMedicines;
                                                                        const end = start + itemsPerPageMedicines;
                                                                        const itemsToShow = filteredMedicinesList.slice(start, end);

                                                                        const medicinesTableBody = document.getElementById('medicinesTableBody');
                                                                        medicinesTableBody.innerHTML = '';

                                                                        updateEntriesInfo(start + 1, Math.min(end, filteredMedicinesList.length), filteredMedicinesList.length);

                                                                        if (itemsToShow.length === 0) {
                                                                            const noMatchesRow = document.createElement('tr');
                                                                            noMatchesRow.innerHTML = '<td colspan="5" class="text-center">No matches found.</td>';
                                                                            medicinesTableBody.appendChild(noMatchesRow);
                                                                        } else {
                                                                            itemsToShow.forEach((medicine, index) => {
                                                                                const medicineRow = document.createElement('tr');
                                                                                medicineRow.innerHTML = `
                <td class="pt-3">${start + index + 1}.</td>
                <td style="font-size: 16px" class="pt-3">${medicine.medicineBrand}</td>
                <td style="font-size: 16px" class="pt-3">${medicine.medicineName}</td>
                <td style="font-size: 16px" class="pt-3">${medicine.strength}</td>
                <td class="d-flex d-md-block">
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${medicine.id}" data-name="${medicine.medicineName}" data-type="medicine"><i class="bi bi-trash"></i></button>
                </td>`;
                                                                                medicinesTableBody.appendChild(medicineRow);
                                                                            });
                                                                        }

                                                                        generateMedicinesPagination(filteredMedicinesList.length, page);
                                                                    }

                                                                    function updateEntriesInfo(start, end, totalEntries) {
                                                                        const entriesInfo = document.getElementById('entriesInfo');
                                                                        entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                                    }

                                                                    function generateMedicinesPagination(totalItems, currentPage) {
                                                                        const totalPages = Math.ceil(totalItems / itemsPerPageMedicines);
                                                                        const paginationContainer = document.getElementById('paginationContainerMedicines');
                                                                        paginationContainer.innerHTML = '';

                                                                        const ul = document.createElement('ul');
                                                                        ul.className = 'pagination';

                                                                        const prevLi = document.createElement('li');
                                                                        prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                                        prevLi.onclick = () => {
                                                                            if (currentPage > 1) displayMedicinesPage(currentPage - 1);
                                                                        };
                                                                        ul.appendChild(prevLi);

                                                                        const startPage = Math.max(1, currentPage - 2);
                                                                        const endPage = Math.min(totalPages, startPage + 4);

                                                                        for (let i = startPage; i <= endPage; i++) {
                                                                            const li = document.createElement('li');
                                                                            li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                            li.onclick = () => displayMedicinesPage(i);
                                                                            ul.appendChild(li);
                                                                        }

                                                                        const nextLi = document.createElement('li');
                                                                        nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                                        nextLi.onclick = () => {
                                                                            if (currentPage < totalPages) displayMedicinesPage(currentPage + 1);
                                                                        };
                                                                        ul.appendChild(nextLi);

                                                                        paginationContainer.appendChild(ul);
                                                                    }

                                                                    // On load: Show all data, then render
                                                                    toggleClearIcons();
                                                                    filteredMedicinesList = [...medicinesList];
                                                                    displayMedicinesPage(initialPageMedicines);
                                                                </script>

            <?php
        } else if ($method == "investigations") {
            ?>

                                                                    <section>
                                                                        <div class="card rounded">
                                                                            <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                                <p style="font-size: 24px; font-weight: 500">Investigation List</p>
                                                                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newInvestigation"
                                                                                    style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                                    <i class="bi bi-plus-square-fill"></i> New
                                                                                </a>
                                                                            </div>
                                                                            <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                                <div class="ms-2">
                                                                                    <label for="itemsPerPageDropdown">Show </label>
                                                                                    <select id="itemsPerPageDropdown"
                                                                                        class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                                        <option value="10" selected>10</option>
                                                                                        <option value="25">25</option>
                                                                                        <option value="50">50</option>
                                                                                    </select>
                                                                                    <label for="itemsPerPageDropdown">Entries </label>
                                                                                </div>
                                                                                <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                                    <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                                        style="height: 50px; width: 280px" placeholder="Search (INVESTIGATION NAME)">
                                                                                    <span id="clearSearch" class="position-absolute"
                                                                                        style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body p-2 p-sm-4">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-hover text-center" id="investigationTable">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                                </th>
                                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                                    INVESTIGATION NAME</th>
                                                                                                <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                                </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody id="investigationsTableBody"></tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="d-md-flex justify-content-between">
                                                                                    <div id="entriesInfo" class="mt-4"></div>
                                                                                    <div class="pagination justify-content-end mt-4" id="paginationContainerInvestigation"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </section>

                                                                    <script>
                                                                        const baseUrl = '<?php echo base_url(); ?>';
                                                                        let itemsPerPageInvestigation = 10;
                                                                        const investigationList = <?php echo json_encode($investigationsList); ?>;
                                                                        let filteredInvestigationList = [...investigationList];
                                                                        const initialPageInvestigation = parseInt(localStorage.getItem('currentPageInvestigation')) || 1;

                                                                        const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                                        const searchBar = document.getElementById('searchBar');
                                                                        const clearSearch = document.getElementById('clearSearch');

                                                                        const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageInvestigation')) || itemsPerPageInvestigation;
                                                                        itemsPerPageDropdown.value = savedItemsPerPage;
                                                                        itemsPerPageInvestigation = savedItemsPerPage;

                                                                        itemsPerPageDropdown.addEventListener('change', (event) => {
                                                                            itemsPerPageInvestigation = parseInt(event.target.value);
                                                                            localStorage.setItem('itemsPerPageInvestigation', itemsPerPageInvestigation);
                                                                            applyFiltersInvestigation();
                                                                        });

                                                                        searchBar.addEventListener('input', () => {
                                                                            toggleClearIconsInvestigation();
                                                                            applyFiltersInvestigation();
                                                                        });

                                                                        clearSearch.addEventListener('click', () => {
                                                                            searchBar.value = '';
                                                                            toggleClearIconsInvestigation();
                                                                            applyFiltersInvestigation();
                                                                        });

                                                                        function toggleClearIconsInvestigation() {
                                                                            clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                                        }

                                                                        function applyFiltersInvestigation() {
                                                                            const searchTerm = searchBar.value.toLowerCase();

                                                                            filteredInvestigationList = investigationList.filter((investigation) => {
                                                                                const investigationName = investigation.investigationsName || '';
                                                                                return investigationName.toLowerCase().includes(searchTerm);
                                                                            });

                                                                            displayInvestigationPage(1);
                                                                        }

                                                                        function displayInvestigationPage(page) {
                                                                            localStorage.setItem('currentPageInvestigation', page);
                                                                            const start = (page - 1) * itemsPerPageInvestigation;
                                                                            const end = start + itemsPerPageInvestigation;
                                                                            const itemsToShow = filteredInvestigationList.slice(start, end);

                                                                            const investigationTableBody = document.getElementById('investigationsTableBody');
                                                                            investigationTableBody.innerHTML = '';

                                                                            updateEntriesInfoInvestigation(start + 1, Math.min(end, filteredInvestigationList.length), filteredInvestigationList.length);

                                                                            if (itemsToShow.length === 0) {
                                                                                const noMatchesRow = document.createElement('tr');
                                                                                noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                                investigationTableBody.appendChild(noMatchesRow);
                                                                            } else {
                                                                                itemsToShow.forEach((investigation, index) => {
                                                                                    const investigationRow = document.createElement('tr');
                                                                                    investigationRow.innerHTML = `
                      <td class="pt-3">${start + index + 1}.</td>
                    <td style="font-size: 16px" class="pt-3">${investigation.investigationsName}</td>
                    <td class="d-flex d-md-block">
                        <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${investigation.id}" data-name="${investigation.investigationsName}" data-type="investigation"><i class="bi bi-trash"></i></button>
                    </td>`;
                                                                                    investigationTableBody.appendChild(investigationRow);
                                                                                });
                                                                            }

                                                                            generateInvestigationPagination(filteredInvestigationList.length, page);
                                                                        }

                                                                        function updateEntriesInfoInvestigation(start, end, totalEntries) {
                                                                            const entriesInfo = document.getElementById('entriesInfo');
                                                                            entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                                        }

                                                                        function generateInvestigationPagination(totalItems, currentPage) {
                                                                            const totalPages = Math.ceil(totalItems / itemsPerPageInvestigation);
                                                                            const paginationContainer = document.getElementById('paginationContainerInvestigation');
                                                                            paginationContainer.innerHTML = '';

                                                                            const ul = document.createElement('ul');
                                                                            ul.className = 'pagination';

                                                                            const prevLi = document.createElement('li');
                                                                            prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                                            prevLi.onclick = () => {
                                                                                if (currentPage > 1) displayInvestigationPage(currentPage - 1);
                                                                            };
                                                                            ul.appendChild(prevLi);

                                                                            const startPage = Math.max(1, currentPage - 2);
                                                                            const endPage = Math.min(totalPages, startPage + 4);

                                                                            for (let i = startPage; i <= endPage; i++) {
                                                                                const li = document.createElement('li');
                                                                                li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                                li.onclick = () => displayInvestigationPage(i);
                                                                                ul.appendChild(li);
                                                                            }

                                                                            const nextLi = document.createElement('li');
                                                                            nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                                            nextLi.onclick = () => {
                                                                                if (currentPage < totalPages) displayInvestigationPage(currentPage + 1);
                                                                            };
                                                                            ul.appendChild(nextLi);

                                                                            paginationContainer.appendChild(ul);
                                                                        }

                                                                        toggleClearIconsInvestigation();
                                                                        filteredInvestigationList = [...investigationList];
                                                                        displayInvestigationPage(initialPageInvestigation);
                                                                    </script>


            <?php
        } else if ($method == "advices") {
            ?>

                                                                        <section>
                                                                            <div class="card rounded">
                                                                                <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                                    <p style="font-size: 24px; font-weight: 500">Advice List</p>
                                                                                    <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newAdvice"
                                                                                        style="background-color: #2b353bf5;" class="text-light border-0 rounded mx-sm-0 p-2 mb-3">
                                                                                        <i class="bi bi-plus-square-fill"></i> New
                                                                                    </a>
                                                                                </div>
                                                                                <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-3">
                                                                                    <div class="ms-2">
                                                                                        <label for="itemsPerPageDropdown">Show </label>
                                                                                        <select id="itemsPerPageDropdown"
                                                                                            class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                                                                            <option value="10" selected>10</option>
                                                                                            <option value="25">25</option>
                                                                                            <option value="50">50</option>
                                                                                        </select>
                                                                                        <label for="itemsPerPageDropdown">Entries </label>
                                                                                    </div>
                                                                                    <div class="d-flex align-items-center position-relative pt-2 pt-md-0 me-2">
                                                                                        <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                                                                            style="height: 50px; width: 250px" placeholder="Search (ADVICE NAME)">
                                                                                        <span id="clearSearch" class="position-absolute"
                                                                                            style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">×</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body p-2 p-sm-4">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-hover text-center" id="adviceTable">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO
                                                                                                    </th>
                                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">
                                                                                                        ADVICE NAME</th>
                                                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="adviceTableBody"></tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="d-md-flex justify-content-between">
                                                                                        <div id="entriesInfo" class="mt-4"></div>
                                                                                        <div class="pagination justify-content-end mt-4" id="paginationContainerAdvice"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>

                                                                        <script>
                                                                            const baseUrl = '<?php echo base_url(); ?>';
                                                                            let itemsPerPageAdvice = 10;
                                                                            const adviceList = <?php echo json_encode($advicesList); ?>;
                                                                            let filteredAdviceList = [...adviceList];
                                                                            const initialPageAdvice = parseInt(localStorage.getItem('currentPageAdvice')) || 1;

                                                                            const itemsPerPageDropdown = document.getElementById('itemsPerPageDropdown');
                                                                            const searchBar = document.getElementById('searchBar');
                                                                            const clearSearch = document.getElementById('clearSearch');

                                                                            const savedItemsPerPage = parseInt(localStorage.getItem('itemsPerPageAdvice')) || itemsPerPageAdvice;
                                                                            itemsPerPageDropdown.value = savedItemsPerPage;
                                                                            itemsPerPageAdvice = savedItemsPerPage;

                                                                            itemsPerPageDropdown.addEventListener('change', (event) => {
                                                                                itemsPerPageAdvice = parseInt(event.target.value);
                                                                                localStorage.setItem('itemsPerPageAdvice', itemsPerPageAdvice);
                                                                                applyFiltersAdvice();
                                                                            });

                                                                            searchBar.addEventListener('input', () => {
                                                                                toggleClearIconsAdvice();
                                                                                applyFiltersAdvice();
                                                                            });

                                                                            clearSearch.addEventListener('click', () => {
                                                                                searchBar.value = '';
                                                                                toggleClearIconsAdvice();
                                                                                applyFiltersAdvice();
                                                                            });

                                                                            function toggleClearIconsAdvice() {
                                                                                clearSearch.style.display = searchBar.value ? 'block' : 'none';
                                                                            }

                                                                            function applyFiltersAdvice() {
                                                                                const searchTerm = searchBar.value.toLowerCase();

                                                                                filteredAdviceList = adviceList.filter((advice) => {
                                                                                    const adviceName = advice.adviceName || '';
                                                                                    return adviceName.toLowerCase().includes(searchTerm);
                                                                                });

                                                                                displayAdvicePage(1);
                                                                            }

                                                                            function displayAdvicePage(page) {
                                                                                localStorage.setItem('currentPageAdvice', page);
                                                                                const start = (page - 1) * itemsPerPageAdvice;
                                                                                const end = start + itemsPerPageAdvice;
                                                                                const itemsToShow = filteredAdviceList.slice(start, end);

                                                                                const adviceTableBody = document.getElementById('adviceTableBody');
                                                                                adviceTableBody.innerHTML = '';

                                                                                updateEntriesInfoAdvice(start + 1, Math.min(end, filteredAdviceList.length), filteredAdviceList.length);

                                                                                if (itemsToShow.length === 0) {
                                                                                    const noMatchesRow = document.createElement('tr');
                                                                                    noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                                    adviceTableBody.appendChild(noMatchesRow);
                                                                                } else {
                                                                                    itemsToShow.forEach((advice, index) => {
                                                                                        const adviceRow = document.createElement('tr');
                                                                                        adviceRow.innerHTML = `
                     <td class="pt-3">${start + index + 1}.</td>
                    <td style="font-size: 16px" class="pt-3">${advice.adviceName}</td>
                    <td class="d-flex d-md-block">
                        <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="${advice.id}" data-name="${advice.adviceName}" data-type="advice"><i class="bi bi-trash"></i></button>
                    </td>`;
                                                                                        adviceTableBody.appendChild(adviceRow);
                                                                                    });
                                                                                }

                                                                                generateAdvicePagination(filteredAdviceList.length, page);
                                                                            }

                                                                            function updateEntriesInfoAdvice(start, end, totalEntries) {
                                                                                const entriesInfo = document.getElementById('entriesInfo');
                                                                                entriesInfo.textContent = `Showing ${start} to ${end} of ${totalEntries} entries.`;
                                                                            }

                                                                            function generateAdvicePagination(totalItems, currentPage) {
                                                                                const totalPages = Math.ceil(totalItems / itemsPerPageAdvice);
                                                                                const paginationContainer = document.getElementById('paginationContainerAdvice');
                                                                                paginationContainer.innerHTML = '';

                                                                                const ul = document.createElement('ul');
                                                                                ul.className = 'pagination';

                                                                                const prevLi = document.createElement('li');
                                                                                prevLi.innerHTML = `<a href="#"><button type="button" class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button></a>`;
                                                                                prevLi.onclick = () => {
                                                                                    if (currentPage > 1) displayAdvicePage(currentPage - 1);
                                                                                };
                                                                                ul.appendChild(prevLi);

                                                                                const startPage = Math.max(1, currentPage - 2);
                                                                                const endPage = Math.min(totalPages, startPage + 4);

                                                                                for (let i = startPage; i <= endPage; i++) {
                                                                                    const li = document.createElement('li');
                                                                                    li.innerHTML = `<a href="#"><button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}" style="background-color: ${i === currentPage ? '#2b353bf5' : 'transparent'};">${i}</button></a>`;
                                                                                    li.onclick = () => displayAdvicePage(i);
                                                                                    ul.appendChild(li);
                                                                                }

                                                                                const nextLi = document.createElement('li');
                                                                                nextLi.innerHTML = `<a href="#"><button type="button" class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button></a>`;
                                                                                nextLi.onclick = () => {
                                                                                    if (currentPage < totalPages) displayAdvicePage(currentPage + 1);
                                                                                };
                                                                                ul.appendChild(nextLi);

                                                                                paginationContainer.appendChild(ul);
                                                                            }

                                                                            toggleClearIconsAdvice();
                                                                            filteredAdviceList = [...adviceList];
                                                                            displayAdvicePage(initialPageAdvice);
                                                                        </script>

        <?php } ?>

        <!-- All modal files -->
        <?php include 'adminModals.php'; ?>

    </main>

    <script>
        <?php if ($method == "dashboard") { ?>
            document.getElementById('dashboard').style.color = "white";
        <?php } elseif ($method == "chiefConsultant" || $method == "ccRegisterForm" || $method == "ccDetails") { ?>
            document.getElementById('ccs').style.color = "white";
        <?php } elseif ($method == "healthCareProvider" || $method == "hcpRegisterForm" || $method == "hcpDetails") { ?>
            document.getElementById('hcps').style.color = "white";
        <?php } elseif ($method == "patient" || $method == "patientDetails") { ?>
            document.getElementById('patients').style.color = "white";
        <?php } elseif ($method == "specialization") { ?>
            document.getElementById('specialization').style.color = "white";
        <?php } elseif ($method == "symptoms") { ?>
            document.getElementById('symptoms').style.color = "white";
        <?php } elseif ($method == "findings") { ?>
            document.getElementById('findings').style.color = "white";
        <?php } elseif ($method == "diagnosis") { ?>
            document.getElementById('diagnosis').style.color = "white";
        <?php } elseif ($method == "medicines") { ?>
            document.getElementById('medicines').style.color = "white";
        <?php } elseif ($method == "investigations") { ?>
            document.getElementById('investigations').style.color = "white";
        <?php } elseif ($method == "advices") { ?>
            document.getElementById('advices').style.color = "white";
        <?php } ?>
    </script>

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

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
</body>

</html>