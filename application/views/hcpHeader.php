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
                <a href="#" class="m-2 me-4">
                    <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a>
                <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" width="40" height="40" alt="Profile"
                    class="rounded-circle" />
                <p class="text-dark w-100 d-none d-md-block me-2 my-auto ps-2">
                    Dr. <?php echo $_SESSION['hcpsName']; ?>
                </p>
                <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <span class="dropdown-toggle mx-4"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                    style="box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2);">
                    <li class="dropdown-header">
                        <h6> <?php echo $_SESSION['hcpsName']; ?> / </h6>
                        <p> <?php echo $_SESSION['hcpId']; ?> </p>
                        <span>Health Care Provider</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li> <a class="dropdown-item d-flex align-items-center"
                            href="<?php echo base_url() . "Healthcareprovider/myProfile" ?>"> <i
                                class="bi bi-person"></i> <span>My Profile</span> </a> </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <!-- <a href="<?php echo base_url() . "" ?>"
                            class="dropdown-item d-flex align-items-center text-danger"
                            onclick="return confirm('Are you sure to logout?')">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a> -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                            class="dropdown-item d-flex align-items-center text-danger">
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
            <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                style="font-size: 18px; font-weight: 400;color:white;" id="logout">
                <div><i class="bi bi-box-arrow-in-right pe-3"></i>
                    <span>Log Out</span>
                </div>
            </a>
        </li>
    </ul>
</aside>