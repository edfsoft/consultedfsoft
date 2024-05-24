<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>EDF Admin</title>

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
    <header id="header" class="header fixed-top d-flex align-items-center" style="background-color:#0081ff;">
        <div class="d-flex align-items-center justify-content-between">
            <a href="https://erodediabetesfoundation.org/" target="blank" class="logo d-flex align-items-center">
                <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="edf" />
            </a>
            <i class="bi bi-list toggle-sidebar-btn text-light"></i>
        </div>

        <!-- <div class="input-group form-control rounded-pill d-none d-md-flex w-25 ms-3">
            <span class="px-2 my-auto"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-0" placeholder="Search here" />
        </div> -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center ms-5">
                <li class="nav-item dropdown d-flex justify-content-evenly">
                    <!-- <a href="" class="m-2 me-4">
                         <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a> -->
                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />
                    <p class="text-light w-50 d-none d-md-block me-2 my-auto" style="margin:15px;width:auto;">
                        <?php echo $_SESSION['adminName']; ?>
                    </p>
                    <a class="nav-link nav-profile d-flex align-items-center text-light" href="#"
                        data-bs-toggle="dropdown">
                        <span class="dropdown-toggle mx-4"></span> </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        style="box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2);">
                        <li class="dropdown-header">
                            <h6> <?php echo $_SESSION['adminName']; ?></h6>
                            <span>EDF Consult Adminstrator</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a href="<?php echo base_url() . "Edfadmin/logout" ?>"
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

    <aside id="sidebar" class="sidebar" style="background-color: #222d32">
        <ul class="sidebar-nav pt-5 ps-4" id="sidebar-nav">
            <li class="">
                <a class="" href="<?php echo base_url() . "Edfadmin/dashboard" ?>" id="dashboard"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;">
                    <i class="bi bi-grid pe-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="pt-4">
                <a class="" style="font-size: 18px; font-weight: 400;color:#8cafba;" id="ccs"
                    href="<?php echo base_url() . "Edfadmin/ccList" ?>">
                    <div><i class="bi bi-person-check pe-3"></i></i> <span>CC</span></div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/hcpList" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="hcps">
                    <div>
                        <i class="bi bi-person-hearts pe-3"></i><span>HCP</span>
                    </div>
                </a>
            </li>

            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/patientList" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="patients">
                    <div>
                        <i class="bi bi-people pe-3"></i>
                        <span>Patients</span>
                    </div>
                </a>
            </li>

            <!-- <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/logout" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="logout"
                    onclick="return confirm('Are you sure to logout?')">
                    <div>
                        <i class="bi bi-box-arrow-in-right pe-3"></i>
                        <span>Log Out</span>
                    </div>
                </a>
            </li> -->
        </ul>
    </aside>

    <main id="main" class="main">

        <?php
        if ($method == "dashboard") {
            ?>

            <script>
                document.getElementById('dashboard').style.color = "white";
            </script>

            <section>
                <p class="card ps-3 py-3" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-md-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-3 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin2.svg" alt="icon1" />
                            <div class="ps-3 pe-3">
                                <p style="font-size: 20px; font-weight: 500;">
                                    Total Chief Consultants
                                </p>
                                <p style="font-size: 30px; font-weight: 400;">
                                    <?php echo $totalCcList; ?>
                                </p>
                                <p style="font-size: 16px"> <?php echo date("d - m - Y") ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-3 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin2.svg" alt="icon2" />
                            <div class="ps-3 pe-3">
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
                        </div>
                    </div>
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_iconadmin1.svg" alt="icon3" />
                            <div class="ps-3 pe-5">
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
                        </div>
                    </div>
                </div>
            </section>

            <?php
        } else if ($method == "chiefConsultant") {
            ?>

                <script>
                    document.getElementById('ccs').style.color = "white";
                </script>

                <section>
                    <div class="card rounded">
                        <div class="d-sm-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                            <p class="ps-2" style="font-size: 24px; font-weight: 500">Chief Consultant List</p>
                            <a href="<?php echo base_url() . "Edfadmin/ccSignupForm" ?>">
                                <button style="background-color: #0081ff;" class="text-light border-0 rounded float-end p-2">
                                    <i class="bi bi-plus-square-fill"></i> Add CC
                                </button>
                            </a>
                        </div>
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
                                <table class="table text-center" id="ccTable">
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

                        itemsToShow.forEach((value, index) => {
                            const ccRow = document.createElement('tr');
                            ccRow.innerHTML = `
                                                                        <td>${start + index + 1}.</td>
                                                                        <td style="font-size: 16px">${value.ccId}</td>
                                                                        <td style="font-size: 16px">${value.doctorName}</td>
                                                                        <td style="font-size: 16px">${value.doctorMobile}</td>
                                                                        <td style="font-size: 16px">${value.specialization}</td>
                                                                        <td style="font-size: 16px">${value.approvalStatus == 1 ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-check-fill text-danger"></i>'}</td>
                                                                        <td class="d-flex d-md-block" style="font-size: 16px">
                                                                            <a href="${baseUrl}Edfadmin/ccDetails/${value.id}">
                                                                                <button class="btn btn-secondary me-1"><i class="bi bi-eye"></i></button>
                                                                            </a>
                                                                            <a href="${baseUrl}Edfadmin/deleteCc/${value.id}" onclick="return confirm('Are you sure you want to delete?')">
                                                                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                                            </a>
                                                                        </td>
                                                                    `;
                            ccTableBody.appendChild(ccRow);
                        });

                        generateCcPagination(filteredCcDetails.length, page);
                    }

                    function generateCcPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPageCc);
                        const paginationContainer = document.getElementById('paginationContainerCc');
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
                            if (currentPage > 1) displayCcPage(currentPage - 1);
                        };
                        ul.appendChild(prevLi);

                        for (let i = 1; i <= totalPages; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `
                                                                        <a href="#">
                                                                            <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}">${i}</button>
                                                                        </a>
                                                                    `;
                            li.onclick = () => displayCcPage(i);
                            ul.appendChild(li);
                        }

                        const nextLi = document.createElement('li');
                        nextLi.innerHTML = `
                                                                    <a href="#">
                                                                        <button type="button" class="bg-light border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>&gt;</button>
                                                                    </a>
                                                                `;
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
                    <script>
                        document.getElementById('ccs').style.color = "white";
                    </script>

                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500">
                                    New Chief Consultant</p>
                                <a href="<?php echo base_url() . "Edfadmin/ccList" ?>" class="text-dark"><i
                                        class="bi bi-arrow-left"></i> Back</a>
                            </div>

                            <div class="card-body col-md-8 p-2 px-sm-4">
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
                                        <select class="form-control rounded-pill p-3" id="ccSpec" name="ccSpec">
                                            <option value="">Select Specialization</option>
                                            <option value="Diabetologist">Diabetologist</option>
                                            <option value="General Practitioners">General Practitioners</option>
                                        </select>
                                        <div id="spec_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ccPassword" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="ccPassword" id="ccPassword" placeholder="password"
                                            class="form-control">
                                        <div id="password_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                                        Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1
                                        number and a minimum of 8 characters.</div>
                                    <div class="mb-3">
                                        <label for="ccCnfmPassword" class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="ccCnfmPassword" id="ccCnfmPassword"
                                            placeholder="confirm password" class="form-control">
                                        <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                                    </div>
                                    <input type="hidden" name="approvalApproved" id="approvalApproved" value="1">
                                    <button type="submit" class="btn btn-secondary text-light float-end">Sign
                                        Up</button>
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
                        <script>
                            document.getElementById('ccs').style.color = "white";
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
                                                <p style="font-size:16px;font-weight:400;">Diabetologist</p>
                                                <p><a href="tel:<?php echo $value['doctorMobile']; ?>"
                                                        style="font-size:16px;font-weight:400;"
                                                        class="text-decoration-none text-dark fs-6">+91
                                            <?php echo $value['doctorMobile']; ?>
                                                    </a> | <a href="mailto:<?php echo $value['doctorMail']; ?>"
                                                        style="font-size:16px;font-weight:400;" class="text-decoration-none text-dark fs-6">
                                            <?php echo $value['doctorMail']; ?>
                                                    </a></p>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        value='<?php echo $value['doctorPassword']; ?>' readonly>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="togglePasswordVisibility('password', 'visibilityIcon')">
                                                        <i id="visibilityIcon" class="bi bi-eye-slash"></i>
                                                    </button>
                                                </div>
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
                                        }
                                        ?>
                                                </td>
                                            </tr>
                                        </table>
                            <?php if ($value['approvalStatus'] == "0") { ?>
                                            <h5 class="my-3 fw-bolder">Profile Approval Process:</h5>
                                            <p>Please review the details and approve the Chief Consultant for login : <a
                                                    href="<?php echo base_url() . "Edfadmin/approveCc/" . $value['id'] ?>"
                                                    onclick="return confirm('The details have been verified and approved for login.')"><button
                                                        class="btn btn-success px-2 py-1">Approve</button></a> </p>
                            <?php }
                                } ?>
                                </div>
                            </div>
                        </section>

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
                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>

            <?php
        } else if ($method == "healthCareProvider") {
            ?>

                            <script>
                                document.getElementById('hcps').style.color = "white";
                            </script>

                            <section>
                                <div class="card rounded">
                                    <div class="d-sm-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">Health Care Provider List</p>
                                        <a href="<?php echo base_url() . 'Edfadmin/hcpSignupForm'; ?>">
                                            <button style="background-color: #0081ff;" class="text-light border-0 rounded float-end p-2">
                                                <i class="bi bi-plus-square-fill"></i> Add HCP
                                            </button>
                                        </a>
                                    </div>
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
                                            <table class="table text-center" id="hcpTable">
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
                                </div>
                            </section>

                            <script>
                                const baseUrl = '<?php echo base_url(); ?>';
                                const itemsPerPageHcp = 10;
                                const hcpList = <?php echo json_encode($hcpList); ?>;
                                let filteredHcpList = hcpList;
                                let currentPageHcp = 1;

                                function displayHcpPage(page) {
                                    currentPageHcp = page;
                                    const start = (page - 1) * itemsPerPageHcp;
                                    const end = start + itemsPerPageHcp;
                                    const paginatedData = filteredHcpList.slice(start, end);
                                    const hcpTableBody = document.getElementById('hcpTableBody');
                                    hcpTableBody.innerHTML = '';
                                    paginatedData.forEach((hcp, index) => {
                                        const row = `
                                                                            <tr>
                                                                                <td>${start + index + 1}.</td>
                                                                                <td>${hcp.hcpId}</td>
                                                                                <td>${hcp.hcpName}</td>
                                                                                <td>${hcp.hcpMobile}</td>
                                                                                <td>${hcp.hcpSpecialization}</td>
                                                                                <td>${hcp.approvalStatus == 1 ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-check-fill text-danger"></i>'}</td>
                                                                                <td class="d-flex d-md-block">
                                                                                    <a href="${baseUrl}Edfadmin/hcpDetails/${hcp.id}"><button class="btn btn-secondary me-1"><i class="bi bi-eye"></i></button></a>
                                                                                    <a href="${baseUrl}Edfadmin/deleteHcp/${hcp.id}" onclick="return confirm('Are you sure you want to delete?')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                                                                </td>
                                                                            </tr>
                                                                        `;
                                        hcpTableBody.innerHTML += row;
                                    });
                                    generatePagination(filteredHcpList.length, page);
                                }

                                function generatePagination(totalItems, currentPage) {
                                    const totalPages = Math.ceil(totalItems / itemsPerPageHcp);
                                    const paginationContainer = document.getElementById('paginationContainerHcp');
                                    paginationContainer.innerHTML = '';
                                    const prevButton = document.createElement('button');
                                    prevButton.innerHTML = '&lt;';
                                    prevButton.type = 'button';
                                    prevButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                    prevButton.disabled = currentPage === 1;
                                    prevButton.addEventListener('click', () => {
                                        if (currentPage > 1) {
                                            displayHcpPage(currentPage - 1);
                                        }
                                    });
                                    paginationContainer.appendChild(prevButton);

                                    for (let i = 1; i <= totalPages; i++) {
                                        const li = document.createElement('li');
                                        li.innerHTML = `
                                                                            <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}" onclick="displayHcpPage(${i})">${i}</button>
                                                                        `;
                                        paginationContainer.appendChild(li);
                                    }

                                    const nextButton = document.createElement('button');
                                    nextButton.innerHTML = '&gt;';
                                    nextButton.type = 'button';
                                    nextButton.classList.add('btn', 'border', 'px-3', 'py-2');
                                    nextButton.disabled = currentPage === totalPages;
                                    nextButton.addEventListener('click', () => {
                                        if (currentPage < totalPages) {
                                            displayHcpPage(currentPage + 1);
                                        }
                                    });
                                    paginationContainer.appendChild(nextButton);
                                }

                                function filterHcpList(searchQuery) {
                                    const lowerCaseQuery = searchQuery.toLowerCase();
                                    filteredHcpList = hcpList.filter(hcp => {
                                        return hcp.hcpName.toLowerCase().includes(lowerCaseQuery) || hcp.hcpId.toLowerCase().includes(lowerCaseQuery);
                                    });
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

                                displayHcpPage(1);
                            </script>


            <?php
        } else if ($method == "hcpRegisterForm") {
            ?>
                                <script>
                                    document.getElementById('hcps').style.color = "white";
                                </script>

                                <section>
                                    <div class="card rounded">
                                        <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                            <p style="font-size: 24px; font-weight: 500">
                                                New Health Care Provider</p>
                                            <a href="<?php echo base_url() . "Edfadmin/hcpList" ?>" class="text-dark"><i
                                                    class="bi bi-arrow-left"></i> Back</a>
                                        </div>

                                        <div class="card-body col-md-8 p-2 px-sm-4">
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
                                                    <select class="form-control" id="hcpSpec" name="hcpSpec">
                                                        <option value="">Select Specialization</option>
                                                        <option value="Diabetologist">Diabetologist</option>
                                                        <option value="General Practitioners">General Practitioners</option>
                                                    </select>
                                                    <div id="spec_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hcpPassword" class="form-label">Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="hcpPassword" id="hcpPassword" placeholder="password"
                                                        class="form-control">
                                                    <div id="password_err" class="text-danger pt-1"></div>
                                                </div>
                                                <div class="text-secondary mb-3" style="font-size:12px;display:none;" id="passwordmessage">
                                                    Passwords must contain atleast 1 uppercase, 1 lowercase, 1 special character, <br> 1 number
                                                    and a minimum of 8 characters.</div>
                                                <div class="mb-3">
                                                    <label for="hcpCnfmPassword" class="form-label">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="hcpCnfmPassword" id="hcpCnfmPassword"
                                                        placeholder="confirm password" class="form-control">
                                                    <div id="cnfmpassword_err" class="text-danger pt-1"></div>
                                                </div>
                                                <input type="hidden" name="approvalApproved" id="approvalApproved" value="1">
                                                <button type="submit" class="btn btn-secondary text-light float-end">Sign
                                                    Up</button>
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

                                    <script>
                                        document.getElementById('hcps').style.color = "white";
                                    </script>

                                    <section>
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500"> Health Care Provider's Profile</p>
                                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark"><i
                                                        class="bi bi-arrow-left"></i> Back</button>
                                            </div>

                                            <div class="card-body p-2 p-sm-4">
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
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="password" name="password"
                                                                    value='<?php echo $value['hcpPassword']; ?>' readonly>
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    onclick="togglePasswordVisibility('password', 'visibilityIcon')">
                                                                    <i id="visibilityIcon" class="bi bi-eye-slash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="my-3 fw-bolder">Profile Details:</h5>
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
                            <?php if ($value['approvalStatus'] == "0") { ?>
                                                        <h5 class="my-3 fw-bolder">Profile Approval Process:</h5>
                                                        <p>Please review the details and approve the Health Care Provider for login : <a
                                                                href="<?php echo base_url() . "Edfadmin/approveHcp/" . $value['id'] ?>"
                                                                onclick="return confirm('The details have been verified and approved for login.')"><button
                                                                    class="btn btn-success px-2 py-1">Approve</button></a> </p>
                            <?php }
                                } ?>
                                            </div>

                                    </section>

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
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>

            <?php
        } else if ($method == "patient") {
            ?>

                                        <script>
                                            document.getElementById('patients').style.color = "white";
                                        </script>

                                        <section>
                                            <div class="card rounded">
                                                <div class="card-body p-2 p-sm-4">
                                                    <div class="d-sm-flex justify-content-between mt-2 mb-3">
                                                        <p class="ps-2" style="font-size: 24px; font-weight: 500">Patients List</p>
                                                        <div class="input-group" style="width:250px;">
                                                            <span class="input-group-text" id="searchIconPatient">
                                                                <i class="bi bi-search"></i>
                                                            </span>
                                                            <input type="text" id="searchInputPatient" class="form-control"
                                                                placeholder="Search by name" aria-describedby="searchIconPatient">
                                                            <button class="btn btn-outline-secondary" type="button" id="clearSearchPatient">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table text-center" id="patientTable">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">S.NO</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">PATIENT ID</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">PATIENT NAME</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">MOBILE NUMBER</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">GENDER</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">AGE</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">DIAGNOSIS</th>
                                                                    <th scope="col" style="font-size: 16px; font-weight: 500;">ACTION</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="patientTableBody"></tbody>
                                                        </table>
                                                    </div>

                                                    <div class="pagination justify-content-center mt-3" id="paginationContainerPatient"></div>
                                                </div>
                                            </div>
                                        </section>

                                        <script>
                                            const baseUrl = '<?php echo base_url(); ?>';
                                            const patientList = <?php echo json_encode($patientList); ?>;
                                            const itemsPerPagePatient = 10;
                                            let filteredPatientList = patientList;
                                            let currentPagePatient = 1;

                                            function displayPatientPage(page) {
                                                currentPagePatient = page;
                                                const start = (page - 1) * itemsPerPagePatient;
                                                const end = start + itemsPerPagePatient;
                                                const paginatedData = filteredPatientList.slice(start, end);
                                                const patientTableBody = document.getElementById('patientTableBody');
                                                patientTableBody.innerHTML = '';
                                                paginatedData.forEach((patient, index) => {
                                                    const row = `
                                                                                <tr>
                                                                                    <td>${start + index + 1}.</td>
                                                                                    <td>${patient.patientId}</td>
                                                                                    <td>${patient.firstName} ${patient.lastName}</td>
                                                                                    <td>${patient.mobileNumber}</td>
                                                                                    <td>${patient.gender}</td>
                                                                                    <td>${patient.age}</td>
                                                                                    <td>${patient.diagonsis}</td>
                                                                                    <td class="d-flex d-md-block">
                                                                                        <a href="${baseUrl}Edfadmin/patientdetails/${patient.id}"><button class="btn btn-secondary me-1"><i class="bi bi-eye"></i></button></a>
                                                                                        <a href="${baseUrl}Edfadmin/deletePatient/${patient.id}" onclick="return confirm('Are you sure you want to delete?')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                                                                    </td>
                                                                                </tr>
                                                                            `;
                                                    patientTableBody.innerHTML += row;
                                                });
                                                generatePagination(filteredPatientList.length, page);
                                            }

                                            function generatePagination(totalItems, currentPage) {
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

                                                for (let i = 1; i <= totalPages; i++) {
                                                    const li = document.createElement('li');
                                                    li.innerHTML = `
                                                                                <button type="button" class="btn border px-3 py-2 ${i === currentPage ? 'btn-secondary text-light' : ''}" onclick="displayPatientPage(${i})">${i}</button>
                                                                            `;
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

                                            displayPatientPage(1);
                                        </script>

            <?php
        } else if ($method == "patientDetails") {
            ?>

                                            <script>
                                                document.getElementById('patients').style.color = "white";
                                            </script>

                                            <section>
                                                <div class="card rounded">
                                                    <div class="d-flex justify-content-between mt-2 p-2 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500"> Patient Details</p>
                                                        <button onclick="goBack()" class="border-0 bg-light float-end text-dark"><i
                                                                class="bi bi-arrow-left"></i> Back</button>
                                                    </div>
                                                    <div class="card-body p-2 p-sm-4">

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
                                                                <p class="col-sm-6"><span class="text-secondary ">Date of Birth </span> -
                                    <?php echo $value['dob'] ?>
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
        }
        ?>
    </main>

    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>
    <!-- Hide page source -->
    <script>
        document.onkeydown = function (e) {
            if (e.ctrlKey && e.keyCode === 85) { // Check if Ctrl + U is pressed
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
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->


</html>