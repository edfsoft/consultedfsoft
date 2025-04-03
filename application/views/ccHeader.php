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

    <nav class="header-nav ms-auto me-2 me-md-4">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown d-flex justify-content-evenly">
                <!-- <a href="#" class="m-2 me-4">
                    <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a> -->
                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" width="40" height="40" alt="Profile"
                    class="d-none d-md-block rounded-circle" />
                <div class="ps-3">
                    <a class="d-flex align-items-center text-dark fw-medium" href="#" data-bs-toggle="dropdown"
                        onmouseover="this.style.textDecoration='underline';"
                        onmouseout="this.style.textDecoration='none';">
                        <?php echo $_SESSION['ccName']; ?> <span class="dropdown-toggle mx-2 mx-sm-3"></span>
                    </a>
                    <span class="fw-medium" style="font-size:16px;color: #0079AD;">CC</span>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        style="box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2);">
                        <li class="dropdown-header">
                            <p class="fs-6 fw-medium text-dark"> <?php echo $_SESSION['ccName']; ?> / </p>
                            <p> <?php echo $_SESSION['ccId']; ?> </p>
                            <span>Health Care Provider</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li> <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url() . "Chiefconsultant/myProfile" ?>"
                                onmouseover="this.style.textDecoration='underline';"
                                onmouseout="this.style.textDecoration='none';"> <i class="bi bi-person"></i>
                                <span>My Profile</span> </a> </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                                class="dropdown-item d-flex align-items-center text-danger">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
            <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                style="font-size: 18px; font-weight: 400;color:white;" id="logout">
                <div><i class="bi bi-box-arrow-in-right pe-3"></i>
                    <span>Log Out</span>
                </div>
            </a>
        </li>
    </ul>
</aside>