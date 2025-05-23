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
                            <p class="ps-2" style="font-size: 24px; font-weight: 500">Chief Consultant List</p>
                            <a href="<?php echo base_url() . "Edfadmin/ccSignupForm" ?>">
                                <button style="background-color: #0081ff;"
                                    class="text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                    <i class="bi bi-plus-square-fill"></i> Add CC
                                </button>
                            </a>
                        </div>
                    <?php if (isset($ccList[0]['id'])) { ?>
                            <div class="input-group mx-auto" style="width:250px;">
                                <span class="input-group-text" id="searchIconCc">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="searchInputCc" class="form-control" placeholder="Search by name"
                                    aria-describedby="searchIconCc">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchCc">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>

                            <div class="card-body p-2 p-sm-4">

                                <div class="table-responsive">
                                    <table class="table table-hover text-center" id="ccTable">
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
                                        <tbody id="ccTableBody"></tbody>
                                    </table>
                                </div>
                                <div class="pagination justify-content-center mt-3" id="paginationContainerCc"></div>
                            </div>
                    <?php } else { ?>
                            <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                    <?php } ?>

                    </div>
                </section>

                <script>
                    const baseUrl = '<?php echo base_url(); ?>';
                    const itemsPerPageCc = 10;
                    const ccDetails = <?php echo json_encode($ccList); ?>;
                    let filteredCcDetails = ccDetails;
                    const initialPageCc = parseInt(localStorage.getItem('currentPageCc')) || 1;

                    function displayCcPage(page) {
                        localStorage.setItem('currentPageCc', page);
                        const start = (page - 1) * itemsPerPageCc;
                        const end = start + itemsPerPageCc;
                        const itemsToShow = filteredCcDetails.slice(start, end);

                        const ccTableBody = document.getElementById('ccTableBody');
                        ccTableBody.innerHTML = '';

                        if (itemsToShow.length === 0) {
                            const noMatchesRow = document.createElement('tr');
                            noMatchesRow.innerHTML = '<td colspan="7" class="text-center">No matches found.</td>';
                            ccTableBody.appendChild(noMatchesRow);
                        } else {
                            itemsToShow.forEach((value, index) => {
                                const ccRow = document.createElement('tr');
                                ccRow.innerHTML =
                                    '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.ccId + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.doctorName + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.doctorMobile + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' + value.specialization + '</td>' +
                                    '<td style="font-size: 16px" class="pt-3">' +
                                    (value.approvalStatus == 1
                                        ? '<i class="bi bi-patch-check-fill text-success"></i>'
                                        : '<i class="bi bi-patch-check-fill text-danger"></i>') +
                                    '</td>' +
                                    '<td class="d-flex d-md-block" style="font-size: 16px">' +
                                    '<a href="' + baseUrl + 'Edfadmin/ccDetails/' + value.id + '">' +
                                    '<button class="btn btn-success me-1"><i class="bi bi-eye"></i></button>' +
                                    '</a>' +
                                    '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + value.id + '" data-type="cc">' +
                                    '<i class="bi bi-trash"></i>' +
                                    '</button>' +
                                    '</td>';
                                ccTableBody.appendChild(ccRow);
                            });

                        }

                        generateCcPagination(filteredCcDetails.length, page);
                    }

                    function generateCcPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPageCc);
                        const paginationContainer = document.getElementById('paginationContainerCc');
                        paginationContainer.innerHTML = '';

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        const prevLi = document.createElement('li');
                        prevLi.innerHTML =
                            '<a href="#">' +
                            '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === 1 ? ' disabled' : '') + '>&lt;</button>' +
                            '</a>';
                        prevLi.onclick = () => {
                            if (currentPage > 1) displayCcPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, startPage + 4);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML =
                                '<a href="#">' +
                                '<button type="button" class="btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '">' + i + '</button>' +
                                '</a>';
                            li.onclick = () => displayCcPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML =
                            '<a href="#">' +
                            '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === totalPages ? ' disabled' : '') + '>&gt;</button>' +
                            '</a>';
                        nextLi.onclick = () => {
                            if (currentPage < totalPages) displayCcPage(currentPage + 1);
                        };
                        ul.appendChild(nextLi);

                        paginationContainer.appendChild(ul);
                    }

                    document.getElementById('searchInputCc').addEventListener('keyup', function () {
                        const searchQuery = this.value.toLowerCase();
                        filteredCcDetails = ccDetails.filter(item => item.doctorName.toLowerCase().includes(searchQuery) || item.ccId.toLowerCase().includes(searchQuery));
                        displayCcPage(1);
                    });

                    document.getElementById('clearSearchCc').addEventListener('click', function () {
                        document.getElementById('searchInputCc').value = '';
                        filteredCcDetails = ccDetails;
                        displayCcPage(1);
                    });

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

                            <div class="card-body col-md-8 p-3 px-sm-4">
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
                                        <label for="ccMobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                        <input type="number" name="ccMobile" id="ccMobile" placeholder="9876543210"
                                            class="form-control">
                                        <div id="mobile_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccEmail" class="form-label">Email <span class="text-danger">*</span></label>
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
                                    <div class="d-flex justify-content-between">
                                        <button type="reset" class="btn btn-secondary text-light mt-2">Reset</button>
                                        <button type="submit" class="btn btn-primary text-light float-end mt-2">Sign Up</button>
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
                                                    class="rounded-circle">
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
                                                <button type="submit" class="btn btn-primary my-2 float-end">Add</button>
                                <?php } else { ?>
                                                <button type="submit" class="btn btn-primary my-2 float-end">Update</button>
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
                                            <button type="submit" class="btn btn-primary px-2 py-1 mt-2">Approve</button>
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
                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">Health Care Provider List</p>
                                        <a href="<?php echo base_url() . 'Edfadmin/hcpSignupForm'; ?>">
                                            <button style="background-color: #0081ff;"
                                                class="text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                                <i class="bi bi-plus-square-fill"></i> Add HCP
                                            </button>
                                        </a>
                                    </div>
                    <?php if (isset($hcpList[0]['id'])) { ?>

                                        <div class="input-group mx-auto" style="width:250px;">
                                            <span class="input-group-text" id="searchIconHcp">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" id="searchInputHcp" class="form-control" placeholder="Search by name"
                                                aria-describedby="searchIconHcp">
                                            <button class="btn btn-outline-secondary" type="button" id="clearSearchHcp">
                                                <i class="bi bi-x"></i>
                                            </button>
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
                                            <div class="pagination justify-content-center mt-3" id="paginationContainerHcp"></div>
                                        </div>
                    <?php } else { ?>
                                        <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                    <?php } ?>
                                </div>
                            </section>

                            <script>
                                const baseUrl = '<?php echo base_url(); ?>';
                                const itemsPerPageHcp = 10;
                                const hcpList = <?php echo json_encode($hcpList); ?>;
                                let filteredHcpList = hcpList;
                                let currentPageHcp = parseInt(localStorage.getItem('currentPageHcp')) || 1;

                                function displayHcpPage(page) {
                                    currentPageHcp = page;
                                    localStorage.setItem('currentPageHcp', page);
                                    const start = (page - 1) * itemsPerPageHcp;
                                    const end = start + itemsPerPageHcp;
                                    const paginatedData = filteredHcpList.slice(start, end);
                                    const hcpTableBody = document.getElementById('hcpTableBody');
                                    hcpTableBody.innerHTML = '';

                                    if (paginatedData.length === 0) {
                                        const noMatchesRow = document.createElement('tr');
                                        noMatchesRow.innerHTML = '<td colspan="7" class="text-center">No matches found.</td>';
                                        hcpTableBody.appendChild(noMatchesRow);
                                    } else {
                                        paginatedData.forEach((hcp, index) => {
                                            const row =
                                                '<tr>' +
                                                '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                                '<td class="pt-3">' + hcp.hcpId + '</td>' +
                                                '<td class="pt-3">' + hcp.hcpName + '</td>' +
                                                '<td class="pt-3">' + hcp.hcpMobile + '</td>' +
                                                '<td class="pt-3">' + hcp.hcpSpecialization + '</td>' +
                                                '<td class="pt-3">' + (hcp.approvalStatus == 1 ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-check-fill text-danger"></i>') + '</td>' +
                                                '<td class="d-flex d-md-block">' +
                                                '<a href="' + baseUrl + 'Edfadmin/hcpDetails/' + hcp.id + '">' +
                                                '<button class="btn btn-success me-1"><i class="bi bi-eye"></i></button>' +
                                                '</a>' + '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + hcp.id + '" data-type="hcp">' +
                                                '<i class="bi bi-trash"></i>' + '</button>' +
                                                '</td>' +
                                                '</tr>';
                                            hcpTableBody.innerHTML += row;
                                        });
                                    }

                                    generatePagination(filteredHcpList.length, page);
                                }

                                function generatePagination(totalItems, currentPage) {
                                    const totalPages = Math.ceil(totalItems / itemsPerPageHcp);
                                    const paginationContainer = document.getElementById('paginationContainerHcp');
                                    paginationContainer.innerHTML = '';

                                    const ul = document.createElement('ul');
                                    ul.className = 'pagination';

                                    const prevLi = document.createElement('li');
                                    prevLi.innerHTML =
                                        '<a href="#">' +
                                        '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === 1 ? ' disabled' : '') + '>&lt;</button>' +
                                        '</a>';
                                    prevLi.onclick = () => {
                                        if (currentPage > 1) displayHcpPage(currentPage - 1);
                                    };
                                    ul.appendChild(prevLi);

                                    const startPage = Math.max(1, currentPage - 2);
                                    const endPage = Math.min(totalPages, startPage + 4);

                                    for (let i = startPage; i <= endPage; i++) {
                                        const li = document.createElement('li');
                                        li.innerHTML =
                                            '<a href="#">' +
                                            '<button type="button" class="btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '">' + i + '</button>' +
                                            '</a>';
                                        li.onclick = () => displayHcpPage(i);
                                        ul.appendChild(li);
                                    }

                                    const nextLi = document.createElement('li');
                                    nextLi.innerHTML =
                                        '<a href="#">' +
                                        '<button type="button" class="bg-light border px-3 py-2"' + (currentPage === totalPages ? ' disabled' : '') + '>&gt;</button>' +
                                        '</a>';
                                    nextLi.onclick = () => {
                                        if (currentPage < totalPages) displayHcpPage(currentPage + 1);
                                    };
                                    ul.appendChild(nextLi);

                                    paginationContainer.appendChild(ul);
                                }

                                function filterHcpList(searchQuery) {
                                    const lowerCaseQuery = searchQuery.toLowerCase();
                                    filteredHcpList = hcpList.filter(hcp =>
                                        hcp.hcpName.toLowerCase().includes(lowerCaseQuery) ||
                                        hcp.hcpId.toLowerCase().includes(lowerCaseQuery)
                                    );
                                    displayHcpPage(1);
                                }

                                document.getElementById('searchInputHcp').addEventListener('input', function () {
                                    const searchQuery = this.value.trim();
                                    if (searchQuery === '') {
                                        filteredHcpList = hcpList;
                                        displayHcpPage(currentPageHcp);
                                    } else {
                                        filterHcpList(searchQuery);
                                    }
                                });

                                document.getElementById('clearSearchHcp').addEventListener('click', function () {
                                    document.getElementById('searchInputHcp').value = '';
                                    filteredHcpList = hcpList;
                                    displayHcpPage(currentPageHcp);
                                });

                                displayHcpPage(currentPageHcp);
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

                                        <div class="card-body col-md-8 p-3 px-sm-4">
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
                                                    <label for="hcpMobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                    <input type="number" name="hcpMobile" id="hcpMobile" placeholder="9876543210"
                                                        class="form-control">
                                                    <div id="mobile_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpEmail" class="form-label">Email <span class="text-danger">*</span></label>
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
                                                <div class="d-flex justify-content-between">
                                                    <button type="reset" class="btn btn-secondary text-light mt-2">Reset</button>
                                                    <button type="submit" class="btn btn-primary text-light float-end mt-2">Sign Up</button>
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
                                                                class="rounded-circle">
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
                                                        <button type="submit" class="btn btn-primary px-2 py-1 mt-2">Approve</button>
                                                    </form>
                        <?php } ?>
                                            </div>

                                    </section>

            <?php
        } else if ($method == "patient") {
            ?>

                                        <section>
                                            <div class="card rounded">
                                                <div class="card-body p-3 p-sm-4">
                                                    <div class="d-sm-flex justify-content-between mt-2 mb-3">
                                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">Patients List</p>
                                                        <div class="input-group" style="width:250px;">
                                                            <span class="input-group-text" id="searchIconPatient">
                                                                <i class="bi bi-search"></i>
                                                            </span>
                                                            <input type="text" id="searchInputPatient" class="form-control" placeholder="Search by name"
                                                                aria-describedby="searchIconPatient">
                                                            <button class="btn btn-outline-secondary" type="button" id="clearSearchPatient">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                        <?php if (isset($patientList[0]['id'])) { ?>

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
                                                        <div class="pagination justify-content-center mt-3" id="paginationContainerPatient"></div>
                        <?php } else { ?>
                                                        <h5 class="text-center py-3"><b>No Records Found.</b> </h5>
                        <?php } ?>
                                                </div>
                                            </div>
                                        </section>

                                        <script>
                                            const baseUrl = '<?php echo base_url(); ?>';
                                            const patientList = <?php echo json_encode($patientList); ?>;
                                            console.log('Patient List:', patientList);
                                            const itemsPerPagePatient = 10;
                                            let filteredPatientList = patientList;
                                            let currentPagePatient = parseInt(localStorage.getItem('currentPagePatient')) || 1;

                                            function displayPatientPage(page) {
                                                console.log('Display Page:', page);
                                                currentPagePatient = page;
                                                localStorage.setItem('currentPagePatient', page);
                                                const start = (page - 1) * itemsPerPagePatient;
                                                const end = start + itemsPerPagePatient;
                                                const paginatedData = filteredPatientList.slice(start, end);
                                                const patientTableBody = document.getElementById('patientTableBody');
                                                patientTableBody.innerHTML = '';

                                                if (paginatedData.length === 0) {
                                                    const noMatchesRow = document.createElement('tr');
                                                    noMatchesRow.innerHTML = '<td colspan="8" class="text-center">No matches found.</td>';
                                                    patientTableBody.appendChild(noMatchesRow);
                                                } else {
                                                    paginatedData.forEach((patient, index) => {
                                                        const row =
                                                            '<tr>' +
                                                            '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                                            '<td class="pt-3">' + patient.patientId + '</td>' +
                                                            '<td class="pt-3">' + patient.firstName + ' ' + patient.lastName + '</td>' +
                                                            '<td class="pt-3">' + patient.mobileNumber + '</td>' +
                                                            '<td class="pt-3">' + patient.gender + '</td>' +
                                                            '<td class="pt-3">' + patient.age + '</td>' +
                                                            '<td style="font-size: 16px" class="pt-3">' +
                                                            '<a href="' + baseUrl + 'Edfadmin/hcpDetails/' + patient.patientHcpDbId + '" ' +
                                                            'class="text-dark" onmouseover="style=\'text-decoration:underline\'" onmouseout="style=\'text-decoration:none\'">' +
                                                            patient.patientHcp +
                                                            '</a>' +
                                                            '</td>' +
                                                            '<td class="d-flex d-md-block">' +
                                                            '<a href="' + baseUrl + 'Edfadmin/patientdetails/' + patient.id + '"><button class="btn btn-success me-1"><i class="bi bi-eye"></i></button></a>' +
                                                            '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + patient.id + '" data-type="patient">' +
                                                            '<i class="bi bi-trash"></i>' + '</button>' +
                                                            '</td>' +
                                                            '</tr>';
                                                        patientTableBody.innerHTML += row;
                                                    });
                                                }

                                                generatePagination(filteredPatientList.length, page);
                                            }

                                            function generatePagination(totalItems, currentPage) {
                                                console.log('Generate Pagination:', totalItems, currentPage); // Debugging
                                                const totalPages = Math.ceil(totalItems / itemsPerPagePatient);
                                                const paginationContainer = document.getElementById('paginationContainerPatient');
                                                paginationContainer.innerHTML = '';

                                                const prevButton = document.createElement('button');
                                                prevButton.innerHTML = '&lt;';
                                                prevButton.type = 'button';
                                                prevButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                prevButton.disabled = currentPage === 1;
                                                prevButton.addEventListener('click', () => {
                                                    if (currentPage > 1) {
                                                        displayPatientPage(currentPage - 1);
                                                    }
                                                });
                                                paginationContainer.appendChild(prevButton);

                                                let startPage, endPage;
                                                if (totalPages <= 5) {
                                                    startPage = 1;
                                                    endPage = totalPages;
                                                } else {
                                                    if (currentPage <= 3) {
                                                        startPage = 1;
                                                        endPage = 5;
                                                    } else if (currentPage + 2 >= totalPages) {
                                                        startPage = totalPages - 4;
                                                        endPage = totalPages;
                                                    } else {
                                                        startPage = currentPage - 2;
                                                        endPage = currentPage + 2;
                                                    }
                                                }

                                                for (let i = startPage; i <= endPage; i++) {
                                                    const li = document.createElement('li');
                                                    li.innerHTML = '<button type="button" class="btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '" onclick="displayPatientPage(' + i + ')">' + i + '</button>';
                                                    paginationContainer.appendChild(li);
                                                }

                                                const nextButton = document.createElement('button');
                                                nextButton.innerHTML = '&gt;';
                                                nextButton.type = 'button';
                                                nextButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                nextButton.disabled = currentPage === totalPages;
                                                nextButton.addEventListener('click', () => {
                                                    if (currentPage < totalPages) {
                                                        displayPatientPage(currentPage + 1);
                                                    }
                                                });
                                                paginationContainer.appendChild(nextButton);
                                            }

                                            function filterPatientList(searchQuery) {
                                                const lowerCaseQuery = searchQuery.toLowerCase();
                                                filteredPatientList = patientList.filter(patient => {
                                                    return (
                                                        patient.firstName.toLowerCase().includes(lowerCaseQuery) ||
                                                        patient.lastName.toLowerCase().includes(lowerCaseQuery) ||
                                                        patient.patientId.toLowerCase().includes(lowerCaseQuery)
                                                    );
                                                });
                                                displayPatientPage(1);
                                            }

                                            document.getElementById('searchInputPatient').addEventListener('input', function () {
                                                const searchQuery = this.value.trim();
                                                if (searchQuery === '') {
                                                    filteredPatientList = patientList;
                                                    displayPatientPage(currentPagePatient);
                                                } else {
                                                    filterPatientList(searchQuery);
                                                }
                                            });

                                            document.getElementById('clearSearchPatient').addEventListener('click', function () {
                                                document.getElementById('searchInputPatient').value = '';
                                                filteredPatientList = patientList;
                                                displayPatientPage(currentPagePatient);
                                            });

                                            displayPatientPage(currentPagePatient);
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
                                    <?php echo $value['systolicBp'] ? $value['systolicBp'] . " / " . $value['diastolicBp'] . " mmHg" : "Not provided"; ?>
                                                                </p>
                                                                <p><span class="text-secondary ">Cholestrol </span> :
                                    <?php echo $value['cholestrol'] ? $value['cholestrol'] . " mg/dL" : "Not provided"; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-md-flex">
                                                                <p class="col-sm-6"><span class="text-secondary ">Blood Sugar</span> :
                                    <?php echo $value['bloodSugar'] ? $value['bloodSugar'] . " mg/dL" : "Not provided"; ?>
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

            <?php
        } else if ($method == "specialization") {
            ?>

                                                <section>
                                                    <div class="card rounded">
                                                        <div class="card-body">
                                                            <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                <p style="font-size: 24px; font-weight: 500">Specialization List</p>
                                                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newSpecilization"
                                                                    class="bg-primary text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                                                    <i class="bi bi-plus-square-fill"></i> New
                                                                </a>
                                                            </div>
                                                            <div class="input-group mx-auto pb-4" style="width:280px;">
                                                                <span class="input-group-text" id="searchIcon">
                                                                    <i class="bi bi-search"></i>
                                                                </span>
                                                                <input type="text" id="searchInputSpecialization" placeholder="Search Specialization"
                                                                    class="form-control">
                                                                <button class="btn btn-outline-secondary" id="clearSearchSpecialization"> <i
                                                                        class="bi bi-x"></i></button>
                                                            </div>


                                                            <div class="table-responsive">
                                                                <table class="table table-hover text-center" id="specializationTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col-3" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                                            <th scope="col-6" style="font-size: 16px; font-weight: 500;">SPECIALIZATION NAME
                                                                            </th>
                                                                            <th scope="col-3" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="specializationTableBody">
                                                                    </tbody>
                                                                </table>
                                                                <div id="paginationContainerSpecialization" class="d-flex justify-content-center"></div>
                                                            </div>
                                                        </div>
                                                </section>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        const baseUrl = '<?php echo base_url(); ?>';
                                                        const specializationList = <?php echo json_encode($specilalizationList); ?>;
                                                        const itemsPerPageSpecialization = 15;
                                                        let filteredSpecializationList = specializationList;
                                                        let currentPageSpecialization = 1;

                                                        function displaySpecializationPage(page) {
                                                            currentPageSpecialization = page;
                                                            const start = (page - 1) * itemsPerPageSpecialization;
                                                            const end = start + itemsPerPageSpecialization;
                                                            const paginatedData = filteredSpecializationList.slice(start, end);
                                                            const specializationTableBody = document.getElementById('specializationTableBody');
                                                            specializationTableBody.innerHTML = '';

                                                            if (paginatedData.length === 0) {
                                                                const noMatchesRow = document.createElement('tr');
                                                                noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                specializationTableBody.appendChild(noMatchesRow);
                                                            } else {
                                                                paginatedData.forEach(function (specialization, index) {
                                                                    const row =
                                                                        '<tr>' +
                                                                        '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                                                        '<td class="pt-3" style="font-size: 16px">' + specialization.specializationName + '</td>' +
                                                                        '<td>' + '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + specialization.id + '" data-type="specialization">' +
                                                                        '<i class="bi bi-trash"></i>' + '</button>' +
                                                                        '</td>' +
                                                                        '</tr>';
                                                                    specializationTableBody.innerHTML += row;
                                                                });
                                                            }

                                                            generatePaginationSpecialization(filteredSpecializationList.length, page);
                                                        }

                                                        function generatePaginationSpecialization(totalItems, currentPage) {
                                                            const totalPages = Math.ceil(totalItems / itemsPerPageSpecialization);
                                                            const paginationContainer = document.getElementById('paginationContainerSpecialization');
                                                            paginationContainer.innerHTML = '';

                                                            const prevButton = document.createElement('button');
                                                            prevButton.innerHTML = '&lt;';
                                                            prevButton.type = 'button';
                                                            prevButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                            prevButton.disabled = currentPage === 1;
                                                            prevButton.addEventListener('click', function () {
                                                                if (currentPage > 1) {
                                                                    displaySpecializationPage(currentPage - 1);
                                                                }
                                                            });
                                                            paginationContainer.appendChild(prevButton);

                                                            for (let i = 1; i <= totalPages; i++) {
                                                                const button = document.createElement('button');
                                                                button.type = 'button';
                                                                button.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                if (i === currentPage) {
                                                                    button.classList.add('btn-secondary', 'text-light');
                                                                }
                                                                button.textContent = i;
                                                                button.addEventListener('click', function () {
                                                                    displaySpecializationPage(i);
                                                                });
                                                                paginationContainer.appendChild(button);
                                                            }

                                                            const nextButton = document.createElement('button');
                                                            nextButton.innerHTML = '&gt;';
                                                            nextButton.type = 'button';
                                                            nextButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                            nextButton.disabled = currentPage === totalPages;
                                                            nextButton.addEventListener('click', function () {
                                                                if (currentPage < totalPages) {
                                                                    displaySpecializationPage(currentPage + 1);
                                                                }
                                                            });
                                                            paginationContainer.appendChild(nextButton);
                                                        }

                                                        function filterSpecializationList(searchQuery) {
                                                            const lowerCaseQuery = searchQuery.toLowerCase();
                                                            filteredSpecializationList = specializationList.filter(function (specialization) {
                                                                return specialization.specializationName.toLowerCase().includes(lowerCaseQuery);
                                                            });
                                                            displaySpecializationPage(1);
                                                        }

                                                        document.getElementById('searchInputSpecialization').addEventListener('input', function () {
                                                            const searchQuery = this.value.trim();
                                                            if (searchQuery === '') {
                                                                filteredSpecializationList = specializationList;
                                                                displaySpecializationPage(currentPageSpecialization);
                                                            } else {
                                                                filterSpecializationList(searchQuery);
                                                            }
                                                        });

                                                        document.getElementById('clearSearchSpecialization').addEventListener('click', function () {
                                                            document.getElementById('searchInputSpecialization').value = '';
                                                            filteredSpecializationList = specializationList;
                                                            displaySpecializationPage(currentPageSpecialization);
                                                        });

                                                        displaySpecializationPage(1);
                                                    });

                                                </script>

            <?php
        } else if ($method == "symptoms") {
            ?>

                                                    <section>
                                                        <div class="card rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between mt-2 mb-3 p-2 pt-sm-4 px-sm-4">
                                                                    <p style="font-size: 24px; font-weight: 500">Symptoms List</p>
                                                                    <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newSymptoms"
                                                                        class="bg-primary text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                                                        <i class="bi bi-plus-square-fill"></i> New
                                                                    </a>
                                                                </div>
                                                                <div class="input-group mx-auto pb-4" style="width:260px;">
                                                                    <span class="input-group-text" id="searchIcon">
                                                                        <i class="bi bi-search"></i>
                                                                    </span>
                                                                    <input type="text" id="searchInputSymptoms" placeholder="Search Symptom" class="form-control">
                                                                    <button class="btn btn-outline-secondary" id="clearSearchSymptoms"> <i
                                                                            class="bi bi-x"></i></button>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table class="table table-hover text-center" id="symptomsTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col-3" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                                                <th scope="col-6" style="font-size: 16px; font-weight: 500;">SYMPTOMS NAME</th>
                                                                                <th scope="col-3" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="symptomsTableBody">
                                                                        </tbody>
                                                                    </table>
                                                                    <div id="paginationContainerSymptoms" class="d-flex justify-content-center"></div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </section>

                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                            const baseUrl = '<?php echo base_url(); ?>';
                                                            const symptomsList = <?php echo json_encode($symptomsList); ?>;
                                                            const itemsPerPageSymptoms = 10;
                                                            let filteredSymptomsList = symptomsList;
                                                            let currentPageSymptoms = 1;

                                                            function displaySymptomsPage(page) {
                                                                currentPageSymptoms = page;
                                                                const start = (page - 1) * itemsPerPageSymptoms;
                                                                const end = start + itemsPerPageSymptoms;
                                                                const paginatedData = filteredSymptomsList.slice(start, end);
                                                                const symptomsTableBody = document.getElementById('symptomsTableBody');
                                                                symptomsTableBody.innerHTML = '';

                                                                if (paginatedData.length === 0) {
                                                                    const noMatchesRow = document.createElement('tr');
                                                                    noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                    symptomsTableBody.appendChild(noMatchesRow);
                                                                } else {
                                                                    paginatedData.forEach(function (symptom, index) {
                                                                        const row =
                                                                            '<tr>' +
                                                                            '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                                                            '<td class="pt-3" style="font-size: 16px">' + symptom.symptomsName + '</td>' +
                                                                            '<td>' + '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + symptom.id + '" data-type="symptom">' +
                                                                            '<i class="bi bi-trash"></i>' + '</button>' +
                                                                            '</td>' +
                                                                            '</tr>';
                                                                        symptomsTableBody.innerHTML += row;
                                                                    });
                                                                }

                                                                generatePaginationSymptoms(filteredSymptomsList.length, page);
                                                            }

                                                            function generatePaginationSymptoms(totalItems, currentPage) {
                                                                const totalPages = Math.ceil(totalItems / itemsPerPageSymptoms);
                                                                const paginationContainer = document.getElementById('paginationContainerSymptoms');
                                                                paginationContainer.innerHTML = '';

                                                                const prevButton = document.createElement('button');
                                                                prevButton.innerHTML = '&lt;';
                                                                prevButton.type = 'button';
                                                                prevButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                prevButton.disabled = currentPage === 1;
                                                                prevButton.addEventListener('click', function () {
                                                                    if (currentPage > 1) {
                                                                        displaySymptomsPage(currentPage - 1);
                                                                    }
                                                                });
                                                                paginationContainer.appendChild(prevButton);

                                                                for (let i = 1; i <= totalPages; i++) {
                                                                    const button = document.createElement('button');
                                                                    button.type = 'button';
                                                                    button.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                    if (i === currentPage) {
                                                                        button.classList.add('btn-secondary', 'text-light');
                                                                    }
                                                                    button.textContent = i;
                                                                    button.addEventListener('click', function () {
                                                                        displaySymptomsPage(i);
                                                                    });
                                                                    paginationContainer.appendChild(button);
                                                                }

                                                                const nextButton = document.createElement('button');
                                                                nextButton.innerHTML = '&gt;';
                                                                nextButton.type = 'button';
                                                                nextButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                nextButton.disabled = currentPage === totalPages;
                                                                nextButton.addEventListener('click', function () {
                                                                    if (currentPage < totalPages) {
                                                                        displaySymptomsPage(currentPage + 1);
                                                                    }
                                                                });
                                                                paginationContainer.appendChild(nextButton);
                                                            }

                                                            function filterSymptomsList(searchQuery) {
                                                                const lowerCaseQuery = searchQuery.toLowerCase();
                                                                filteredSymptomsList = symptomsList.filter(function (symptom) {
                                                                    return symptom.symptomsName.toLowerCase().includes(lowerCaseQuery);
                                                                });
                                                                displaySymptomsPage(1);
                                                            }

                                                            document.getElementById('searchInputSymptoms').addEventListener('input', function () {
                                                                const searchQuery = this.value.trim();
                                                                if (searchQuery === '') {
                                                                    filteredSymptomsList = symptomsList;
                                                                    displaySymptomsPage(currentPageSymptoms);
                                                                } else {
                                                                    filterSymptomsList(searchQuery);
                                                                }
                                                            });

                                                            document.getElementById('clearSearchSymptoms').addEventListener('click', function () {
                                                                document.getElementById('searchInputSymptoms').value = '';
                                                                filteredSymptomsList = symptomsList;
                                                                displaySymptomsPage(currentPageSymptoms);
                                                            });

                                                            displaySymptomsPage(1);
                                                        });

                                                    </script>

            <?php
        } else if ($method == "medicines") {
            ?>

                                                        <section>
                                                            <div class="card rounded">
                                                                <div class="card-body">
                                                                    <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                                        <p style="font-size: 24px; font-weight: 500">Medicines List</p>
                                                                        <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#newMedicine"
                                                                            class="bg-primary text-light border-0 rounded d-block d-sm-inline mx-auto mx-sm-0 p-2 mb-3">
                                                                            <i class="bi bi-plus-square-fill"></i> New
                                                                        </a>
                                                                    </div>

                                                                    <div class="input-group mx-auto pb-4" style="width:250px;">
                                                                        <span class="input-group-text" id="searchIcon">
                                                                            <i class="bi bi-search"></i>
                                                                        </span>
                                                                        <input type="text" id="searchInputMedicines" placeholder="Search Medicine" class="form-control">
                                                                        <button class="btn btn-outline-secondary" id="clearSearchMedicines"> <i
                                                                                class="bi bi-x"></i></button>
                                                                    </div>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover text-center" id="medicinesTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col-3" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                                                    <th scope="col-6" style="font-size: 16px; font-weight: 500;">BRAND NAME</th>
                                                                                    <th scope="col-6" style="font-size: 16px; font-weight: 500;">MEDICINE NAME</th>
                                                                                    <th scope="col-6" style="font-size: 16px; font-weight: 500;">STRENGTH</th>
                                                                                    <th scope="col-3" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="medicinesTableBody">
                                                                            </tbody>
                                                                        </table>
                                                                        <div id="paginationContainerMedicines" class="d-flex justify-content-center"></div>
                                                                    </div>

                                                                </div>
                                                        </section>

                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", function () {
                                                                const baseUrl = '<?php echo base_url(); ?>';
                                                                const medicinesList = <?php echo json_encode($medicinesList); ?>;
                                                                const itemsPerPageMedicines = 10;
                                                                let filteredMedicinesList = medicinesList;
                                                                let currentPageMedicines = 1;

                                                                function displayMedicinesPage(page) {
                                                                    currentPageMedicines = page;
                                                                    const start = (page - 1) * itemsPerPageMedicines;
                                                                    const end = start + itemsPerPageMedicines;
                                                                    const paginatedData = filteredMedicinesList.slice(start, end);
                                                                    const medicinesTableBody = document.getElementById('medicinesTableBody');
                                                                    medicinesTableBody.innerHTML = '';

                                                                    if (paginatedData.length === 0) {
                                                                        const noMatchesRow = document.createElement('tr');
                                                                        noMatchesRow.innerHTML = '<td colspan="3" class="text-center">No matches found.</td>';
                                                                        medicinesTableBody.appendChild(noMatchesRow);
                                                                    } else {
                                                                        paginatedData.forEach(function (medicine, index) {
                                                                            const row =
                                                                                '<tr>' +
                                                                                '<td class="pt-3">' + (start + index + 1) + '.</td>' +
                                                                                '<td class="pt-3" style="font-size: 16px">' + medicine.medicineBrand + '</td>' +
                                                                                '<td class="pt-3" style="font-size: 16px">' + medicine.medicineName + '</td>' +
                                                                                '<td class="pt-3" style="font-size: 16px">' + medicine.strength + '</td>' +
                                                                                '<td>' + '<button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="' + medicine.id + '" data-type="medicine">' +
                                                                                '<i class="bi bi-trash"></i>' + '</button>' +
                                                                                '</td>' +
                                                                                '</tr>';
                                                                            medicinesTableBody.innerHTML += row;
                                                                        });
                                                                    }

                                                                    generatePaginationMedicines(filteredMedicinesList.length, page);
                                                                }

                                                                function generatePaginationMedicines(totalItems, currentPage) {
                                                                    const totalPages = Math.ceil(totalItems / itemsPerPageMedicines);
                                                                    const paginationContainer = document.getElementById('paginationContainerMedicines');
                                                                    paginationContainer.innerHTML = '';

                                                                    const prevButton = document.createElement('button');
                                                                    prevButton.innerHTML = '&lt;';
                                                                    prevButton.type = 'button';
                                                                    prevButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                    prevButton.disabled = currentPage === 1;
                                                                    prevButton.addEventListener('click', function () {
                                                                        if (currentPage > 1) {
                                                                            displayMedicinesPage(currentPage - 1);
                                                                        }
                                                                    });
                                                                    paginationContainer.appendChild(prevButton);

                                                                    for (let i = 1; i <= totalPages; i++) {
                                                                        const button = document.createElement('button');
                                                                        button.type = 'button';
                                                                        button.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                        if (i === currentPage) {
                                                                            button.classList.add('btn-secondary', 'text-light');
                                                                        }
                                                                        button.textContent = i;
                                                                        button.addEventListener('click', function () {
                                                                            displayMedicinesPage(i);
                                                                        });
                                                                        paginationContainer.appendChild(button);
                                                                    }

                                                                    const nextButton = document.createElement('button');
                                                                    nextButton.innerHTML = '&gt;';
                                                                    nextButton.type = 'button';
                                                                    nextButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                                                    nextButton.disabled = currentPage === totalPages;
                                                                    nextButton.addEventListener('click', function () {
                                                                        if (currentPage < totalPages) {
                                                                            displayMedicinesPage(currentPage + 1);
                                                                        }
                                                                    });
                                                                    paginationContainer.appendChild(nextButton);
                                                                }

                                                                function filterMedicinesList(searchQuery) {
                                                                    const lowerCaseQuery = searchQuery.toLowerCase();
                                                                    filteredMedicinesList = medicinesList.filter(function (medicine) {
                                                                        return medicine.medicineName.toLowerCase().includes(lowerCaseQuery);
                                                                    });
                                                                    displayMedicinesPage(1);
                                                                }

                                                                document.getElementById('searchInputMedicines').addEventListener('input', function () {
                                                                    const searchQuery = this.value.trim();
                                                                    if (searchQuery === '') {
                                                                        filteredMedicinesList = medicinesList;
                                                                        displayMedicinesPage(currentPageMedicines);
                                                                    } else {
                                                                        filterMedicinesList(searchQuery);
                                                                    }
                                                                });

                                                                document.getElementById('clearSearchMedicines').addEventListener('click', function () {
                                                                    document.getElementById('searchInputMedicines').value = '';
                                                                    filteredMedicinesList = medicinesList;
                                                                    displayMedicinesPage(currentPageMedicines);
                                                                });

                                                                displayMedicinesPage(1);
                                                            });

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
        <?php } elseif ($method == "medicines") { ?>
            document.getElementById('medicines').style.color = "white";
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