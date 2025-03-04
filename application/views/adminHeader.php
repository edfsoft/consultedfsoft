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
        <nav class="header-nav ms-auto me-2 me-md-4">
            <ul class="d-flex align-items-center ms-5">
                <li class="nav-item dropdown d-flex justify-content-evenly">
                    <!-- <a href="" class="m-2 me-4">
                         <img src="<?php echo base_url(); ?>assets/bell.svg" alt="Notification" /></a> -->
                    <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" width="40" height="40" alt="Profile"
                        class="rounded-circle me-1" />
                    <p class="text-light w-100 d-none d-md-block me-2 my-auto ps-2">
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
                            <a href="#" class="dropdown-item d-flex align-items-center">
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
                        <i class="bi bi-person-hearts pe-3"></i> <span>HCP</span>
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
            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/specializationList" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="specialization">
                    <div>
                        <span class="material-symbols-outlined pe-2">data_check</span>
                        <span>Specializations</span>
                    </div>
                </a>
            </li>
            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/symptomsList" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="symptoms">
                    <div>
                        <span class="material-symbols-outlined pe-2"> conditions </span>
                        <span>Symptoms</span>
                    </div>
                </a>
            </li>
            <li class="pt-4">
                <a class="" href="<?php echo base_url() . "Edfadmin/medicinesList" ?>"
                    style="font-size: 18px; font-weight: 400;color:#8cafba;" id="medicines">
                    <div>
                        <span class="material-symbols-outlined pe-2">vaccines</span>
                        <span>Medicines</span>
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