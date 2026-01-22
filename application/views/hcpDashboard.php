<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Health Care Provider - EDF</title>
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

        .table-hoverr tbody tr:hover td,
        .table-hoverr tbody tr:hover th {
            background-color: rgba(0, 173, 142, 0.1) !important;
        }

        .fieldLink:hover {
            text-decoration: underline;
        }

        /* Prescription Print */
        @page {
            size: A4;
            margin: 20mm;
        }
    </style>
</head>

<body>
    <?php $this->load->view('hcpHeader'); ?>

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

        <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('todaysAppointmentsModal');
                if (modalEl) {
                    const myModal = new bootstrap.Modal(modalEl);
                    myModal.show();
                }
            });
        </script> -->
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
                <p class="card ps-3 py-3 mx-1" style="font-size: 24px; font-weight: 500">
                    Dashboard
                </p>

                <!-- Section-1 -->
                <div class="d-lg-flex justify-content-evenly">
                    <div class="card rounded-5 mx-2">
                        <div class="card-body d-flex px-4 pt-3">
                            <img src="<?php echo base_url(); ?>assets/dash_icon1.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon1" />
                            <div class="text-center px-4">
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
                            <img src="<?php echo base_url(); ?>assets/dash_icon2.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon2" />
                            <div class="text-center px-4">
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
                            <img src="<?php echo base_url(); ?>assets/dash_icon3.svg" class="my-auto"
                                style="width:80px;height:80px" alt="icon3" />
                            <div class="text-center px-4">
                                <p style="font-size: 20px; font-weight: 500; color: #00ad8e">
                                    CC Appointments
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    <?php echo $appointmentsTotal; ?>
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d-M-Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <!-- Hiding - there 2 appointment sections  -->
                <!-- <div class="d-lg-flex justify-content-evenly">
                    <div class="card rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e" class="pb-2">
                                <i class="bi bi-calendar4 pe-3"></i> Appointments List
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
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg"
                                                                alt="Profile Photo" width="40" height="40" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="px-5">
                                                        <span
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[0]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[0]['patientComplaint'] != '' ? $appointmentList[0]['patientComplaint'] : "-"; ?></span>
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
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[1]['patientId']; ?></span><br /><span
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
                                                            style="font-size: 16px; font-weight: 500; color: #00ad8e"><?php echo $appointmentList[2]['patientId']; ?></span><br /><span
                                                            style="font-size: 16px">
                                                            <?php echo $appointmentList[2]['patientComplaint'] != '' ? $appointmentList[2]['patientComplaint'] : "-"; ?></span>
                                                    </td>
                                                    <td style="font-size: 16px">
                                                        <?php echo date('h:i a', strtotime($appointmentList[2]['timeOfAppoint'])); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
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

                    <div class="card rounded-5 mx-1">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e" class="pb-2">
                                <i class="bi bi-person pe-3"></i> Patient Appointment Details
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
                                        <span style="font-size: 16px; font-weight: 500; color: #00ad8e">Name</span><br /><span
                                            style="font-size: 16px">
                                            <?php echo $appointmentList[0]['firstName'], " ", $appointmentList[0]['lastName']; ?></span>
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
                                                <th scope="col-4" style="font-size: 16px; font-weight: 600" class="px-5">
                                                    Height
                                                </th>
                                                <th scope="col-6" style="font-size: 16px; font-weight: 600">
                                                    Referal Doctor
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientComplaint'] != '' ? $appointmentList[0]['patientComplaint'] : "-"; ?></span>
                                                </td>
                                                <td class="px-5">
                                                    <span style="font-size: 16px; font-weight: 400">172cm</span>
                                                </td>
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
                                <?php if ($appointmentList[0]['lastAppDate'] != "") { ?>
                                    <p>Last Appointment Date - <?php echo $appointmentList[0]['lastAppDate']; ?></p>
                                <?php }
                            } else { ?>
                                <p class="m-md-5 px-md-5"><b> No Appointments Today.</b></p>
                            <?php } ?>

                        </div>
                    </div>
                </div> -->

                <!-- Section 3 -->
                <div class="d-lg-flex justify-content-between mx-2">
                    <!-- Completed Consult Section -->
                    <div class="card col-12 col-lg-6 rounded-5 mx-1 mt-3">
                        <div class="card-body p-4">
                            <p style="font-size:20px;font-weight:500;color:#00ad8e"
                                class="pb-3 d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-check2-circle pe-3"></i>Completed Consultations</span>
                                <span class="px-2" id="completedConsultCount"
                                    style="font-size:16px;color: #00ad8e;border : 2px solid #00ad8e; border-radius:50%;">0</span>
                            </p>

                            <div class="rounded-4 px-3">
                                <!-- Date Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3"
                                    style="background:#fff;color:#00ad8e;border-radius:12px;padding:10px 20px;border:2px solid #00ad8e">

                                    <button id="prevDayBtnCompletedConsult" class="btn btn-link p-0"
                                        style="font-size:1.5rem;color:#00ad8e">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>

                                    <div class="text-center">
                                        <h5 class="mb-0 fw-semibold d-flex align-items-center gap-2 justify-content-center">
                                            <span id="completedConsultDate"></span>

                                            <input type="date" id="completedConsultCalendar"
                                                style="opacity:0;position:absolute;pointer-events:none">

                                            <i class="bi bi-calendar-event ms-md-3 ms-1" id="completedConsultCalendarIcon"
                                                style="cursor:pointer;font-size:1.5rem"></i>
                                        </h5>
                                        <small id="completedConsultDay"></small>
                                    </div>

                                    <button id="nextDayBtnCompletedConsult" class="btn btn-link p-0"
                                        style="font-size:1.5rem;color:#00ad8e">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- Table -->
                                <div class="table-responsive" style="max-height:300px">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                            <tr style="font-weight:700">
                                                <th>S.No</th>
                                                <th>Patient ID</th>
                                                <th>Patient Name</th>
                                                <th>Mobile Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="completedConsultTableBody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Today's Follow up Section  -->
                    <div class="card col-12 col-lg-6 rounded-5 mx-1 mt-3">
                        <div class="card-body p-4">
                            <p style="font-size: 20px; font-weight: 500; color: #00ad8e"
                                class="pb-3 d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-clock-history pe-3"></i>
                                    Follow-ups (Next Follow-up)</span>
                                <span class="px-2" id="followUpCount"
                                    style="font-size:16px;color: #00ad8e;border : 2px solid #00ad8e; border-radius:50%;">0</span>
                            </p>

                            <div class="rounded-4 px-3">
                                <!-- Date Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3"
                                    style="background-color: #fff; color: #00ad8e; border-radius: 12px; padding: 10px 20px;border: 2px solid #00ad8e;">
                                    <button id="prevDayBtnFollowUp" class="btn btn-link fw-bold p-0"
                                        style="font-size: 1.5rem; color: #00ad8e;">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <div class="text-center">
                                        <h5 class="mb-0 fw-semibold d-flex align-items-center gap-2 justify-content-center">
                                            <span id="appointmentsDate"></span>
                                            <input type="date" id="followUpCalendar"
                                                style="opacity:0;position:absolute;pointer-events:none">
                                            <i class="bi bi-calendar-event ms-md-3 ms-1" id="followUpCalendarIcon"
                                                style="cursor:pointer;font-size:1.5rem"></i>
                                        </h5>
                                        <small id="appointmentsDay"></small>
                                    </div>
                                    <button id="nextDayBtnFollowUp" class="btn btn-link fw-bold p-0"
                                        style="font-size: 1.5rem; color: #00ad8e;">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- Table -->
                                <div class="table-responsive" style="max-height: 300px;">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                            <tr style="color: #000; font-weight: 700;">
                                                <th>S.No</th>
                                                <th style="text-align:top">Patient ID</th>
                                                <th>Patient Name</th>
                                                <th>Last Consult On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="followUpTableBody">
                                            <!-- Data loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- Completed Consultations script -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const dateEl = document.getElementById('completedConsultDate');
                    const dayEl = document.getElementById('completedConsultDay');
                    const tbody = document.getElementById('completedConsultTableBody');
                    const prevBtn = document.getElementById('prevDayBtnCompletedConsult');
                    const nextBtn = document.getElementById('nextDayBtnCompletedConsult');
                    const calIn = document.getElementById('completedConsultCalendar');
                    const calIcon = document.getElementById('completedConsultCalendarIcon');
                    const countEl = document.getElementById('completedConsultCount');

                    let currentDate = new Date();

                    const baseUrl = '<?= base_url("Healthcareprovider/getCompletedConsultByDate") ?>';

                    function formatDisplayDate(date) {
                        return date.toLocaleDateString('en-GB', {
                            day: '2-digit', month: 'short', year: 'numeric'
                        }).replace(/ /g, '-');
                    }

                    function formatApiDate(date) {
                        return date.toISOString().split('T')[0];
                    }

                    function updateHeader() {
                        dateEl.textContent = formatDisplayDate(currentDate);
                        dayEl.textContent = currentDate.toLocaleDateString('en-US', { weekday: 'long' });
                        calIn.value = formatApiDate(currentDate);
                    }

                    function loadCompletedConsult() {
                        updateHeader();
                        tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4">Loading...</td></tr>`;

                        fetch(`${baseUrl}?date=${formatApiDate(currentDate)}`)
                            .then(res => res.json())
                            .then(res => {
                                if (res.success && res.data.length) {
                                    renderCompletedConsult(res.data);
                                    countEl.textContent = res.data.length;
                                } else {
                                    tbody.innerHTML = `
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        No completed consultations
                                                    </td>
                                                </tr>`;
                                    countEl.textContent = 0;
                                }
                            })
                            .catch(() => {
                                tbody.innerHTML = `
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">
                                                    Error loading data
                                                </td>
                                            </tr>`;
                                countEl.textContent = 0;
                            });
                    }

                    function renderCompletedConsult(data) {
                        tbody.innerHTML = '';
                        data.forEach((row, i) => {
                            const consultDate = new Date(row.consult_date + 'T00:00:00');

                            tbody.innerHTML += `
                 <tr>
                    <td>${i + 1}.</td>
                     <td><a href="<?php echo base_url('Consultation/consultation/'); ?>${row.consultationPatientId}" class="fieldLink text-dark">${row.patientId}</a></td>
                    <td><a href="<?php echo base_url('Consultation/consultation/'); ?>${row.consultationPatientId}" class="fieldLink text-dark">${row.patientName}</a></td>                   
                    <td><a href="<?php echo base_url('Consultation/consultation/'); ?>${row.consultationPatientId}" class="fieldLink text-dark">${row.mobileNumber}</a></td>
                    <td>
                        <a href="<?= base_url('Consultation/consultation/') ?>${row.consultationPatientId}"
                           class="btn btn-sm btn-secondary">
                            <i class="bi bi-calendar-check"></i>
                        </a>
                    </td>
                </tr>`;
                        });
                    }

                    prevBtn.onclick = () => {
                        currentDate.setDate(currentDate.getDate() - 1);
                        loadCompletedConsult();
                    };

                    nextBtn.onclick = () => {
                        currentDate.setDate(currentDate.getDate() + 1);
                        loadCompletedConsult();
                    };

                    calIcon.onclick = () => calIn.showPicker();

                    calIn.onchange = () => {
                        currentDate = new Date(calIn.value);
                        loadCompletedConsult();
                    };

                    loadCompletedConsult(); // default = today
                });
            </script>

            <!-- Today Follow up Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const dateEl = document.getElementById('appointmentsDate');
                    const dayEl = document.getElementById('appointmentsDay');
                    const prevBtn = document.getElementById('prevDayBtnFollowUp');
                    const nextBtn = document.getElementById('nextDayBtnFollowUp');
                    const tbody = document.getElementById('followUpTableBody');
                    const countEl = document.getElementById('followUpCount');
                    const calIn = document.getElementById('followUpCalendar');
                    const calIcon = document.getElementById('followUpCalendarIcon');

                    let currentDate = new Date();

                    const baseUrl = '<?= base_url("Healthcareprovider/getFollowUpConsultations") ?>';

                    function formatDate(date) {
                        return date.toLocaleDateString('en-GB', {
                            day: '2-digit', month: 'short', year: 'numeric'
                        }).replace(/ /g, '-');
                    }

                    function formatApiDate(date) {
                        return date.toISOString().split('T')[0];
                    }

                    function formatConsultDate(dateStr) {
                        if (!dateStr) return '-';
                        const date = new Date(dateStr + 'T00:00:00');
                        return date.toLocaleDateString('en-GB', {
                            day: '2-digit', month: 'short', year: 'numeric'
                        }).replace(/ /g, '-');
                    }

                    function updateHeader() {
                        dateEl.textContent = formatDate(currentDate);
                        dayEl.textContent = currentDate.toLocaleDateString('en-US', { weekday: 'long' });
                        calIn.value = formatApiDate(currentDate);
                    }

                    function loadAppointments() {
                        updateHeader();
                        tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4">Loading...</td></tr>`;
                        countEl.textContent = 0;

                        fetch(`${baseUrl}?date=${formatApiDate(currentDate)}`)
                            .then(r => r.json())
                            .then(res => {
                                if (res.success && res.data.length > 0) {
                                    renderTable(res.data);
                                    countEl.textContent = res.data.length;
                                } else {
                                    tbody.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No follow-ups scheduled
                            </td>
                        </tr>`;
                                    countEl.textContent = 0;
                                }
                            })
                            .catch(() => {
                                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-danger">
                            Error loading data
                        </td>
                    </tr>`;
                                countEl.textContent = 0;
                            });
                    }

                    function renderTable(data) {
                        tbody.innerHTML = '';
                        data.forEach((row, i) => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                        <td>${i + 1}.</td>
                                        <td><a href="<?php echo base_url('Consultation/consultation/'); ?>${row.consultationPatientId}" class="fieldLink text-dark">${row.patientId}</a></td> 
                                        <td><a href="<?php echo base_url('Consultation/consultation/'); ?>${row.consultationPatientId}" class="fieldLink text-dark">${row.patientName}</a></td>
                                        <td>
                                            <span class="fw-medium">${formatConsultDate(row.consult_date)}</span>
                                            <br>${row.time_12hr}<br>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('Consultation/consultation/') ?>${row.consultationPatientId}" 
                                            class="btn btn-sm btn-secondary text-light"> <i class="bi bi-calendar-check"></i></a>
                                        </td>
                                           `;
                            tbody.appendChild(tr);
                        });
                    }

                    prevBtn.onclick = () => {
                        currentDate.setDate(currentDate.getDate() - 1);
                        loadAppointments();
                    };

                    nextBtn.onclick = () => {
                        currentDate.setDate(currentDate.getDate() + 1);
                        loadAppointments();
                    };

                    calIcon.onclick = () => calIn.showPicker();

                    calIn.onchange = () => {
                        currentDate = new Date(calIn.value);
                        loadAppointments();
                    };

                    loadAppointments();
                });
            </script>

            <?php
        } else if ($method == "appointments") {
            ?>
                <section>
                    <div class="card rounded">
                        <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500">
                                Appointments
                            </p>
                            <a href="<?php echo base_url() . "Healthcareprovider/appointmentsForm" ?>"> <button
                                    style="background-color: #00ad8e;" class="float-end text-light border-0 rounded p-2">
                                    <i class="bi bi-plus-square-fill"></i> Book Appointment
                                </button></a>
                        </div>


                    <?php if (isset($appointmentList[0]['id'])) {
                        ?>

                            <div id="entriesPerPage" class="d-md-flex align-items-center justify-content-between mx-4">

                                <!-- FILTER -->
                                <select id="filterDropdown" class="form-select border border-2 rounded-3 px-3 py-2"
                                    style="height: 50px; width: 280px;">
                                    <option value="All">Filter Appoinmtent with (All)</option>
                                    <option value="CC">CC & HCP</option>
                                    <option value="PATIENT">PATIENT & HCP</option>
                                </select>

                                <!-- SEARCH -->
                                <div class="d-flex align-items-center position-relative pt-2 pt-md-0">
                                    <input type="text" id="searchBar" class="border border-2 rounded-3 px-3 py-2"
                                        style="height: 50px; width: 260px" placeholder="Search (PATIENT ID / CC ID)">
                                    <span id="clearSearch" class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);
                                        cursor: pointer; display: none; font-size: 22px;">×</span>
                                </div>
                            </div>

                            <!-- ITEMS PER PAGE -->
                            <div class="mt-3 ms-4">
                                <label>Show</label>
                                <select id="itemsPerPageDropdown"
                                    class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <label>Entries</label>
                            </div>
                            <div class="card-body p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table text-center table-hoverr" id="appointmentTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                    APPOINTMENT WITH</th>
                                                <th scope="col"
                                                    style="font-size:16px; font-weight:500; color:#00ad8e; cursor:pointer;"
                                                    id="sortPatientId">
                                                    <span onmouseover="this.style.textDecoration='underline'"
                                                        onmouseout="this.style.textDecoration='none'">
                                                        PATIENT ID <span id="sortPatientIdIndicator"></span>
                                                    </span>
                                                </th>
                                                <th scope="col"
                                                    style="font-size:16px; font-weight:500; color:#00ad8e; cursor:pointer;"
                                                    id="sortDate">
                                                    <span onmouseover="this.style.textDecoration='underline'"
                                                        onmouseout="this.style.textDecoration='none'">
                                                        DATE <span id="sortDateIndicator">🡱</span>
                                                    </span>
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">TIME</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">CC ID</th>
                                                <!-- <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PURPOSE
                                                </th> -->
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="appointmentTableBody">
                                    </table>
                                    <div class="d-md-flex justify-content-between ms-2">
                                        <div id="entriesInfoAppointment" class="mt-4"></div>
                                        <div class="pagination justify-content-end mt-4" id="paginationContainerAppointment"></div>
                                    </div>
                                </div>
                            </div>
                    <?php } else { ?>
                            <h5 class="text-center my-5"><b> No Appointments Found.</b> </h5>
                    <?php } ?>
                    </div>
                </section>

                <!-- Display Appointments -->
                <script>
                    const appointmentList = <?php echo json_encode($appointmentList, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
                    const baseUrl = '<?php echo base_url(); ?>';

                    let filteredList = [...appointmentList];
                    let itemsPerPageAppointment = parseInt(localStorage.getItem('itemsPerPageAppointment')) || 10;
                    let currentPageAppointment = 1;

                    let sortBy = 'patientId';
                    let sortOrder = 'asc';

                    // Elements
                    const itemsDropdown = document.getElementById('itemsPerPageDropdown');
                    const searchBar = document.getElementById('searchBar');
                    const clearSearch = document.getElementById('clearSearch');
                    const filterDropdown = document.getElementById('filterDropdown');

                    const sortPatientId = document.getElementById('sortPatientId');
                    const sortDate = document.getElementById('sortDate');
                    const pidIndicator = document.getElementById('sortPatientIdIndicator');
                    const dateIndicator = document.getElementById('sortDateIndicator');

                    itemsDropdown.value = itemsPerPageAppointment;

                    //Delete Appointments
                    function confirmDeleteApp(id) {
                        const app = appointmentList.find(item => item.id == id);
                        let formattedTime = app.timeOfAppoint; // Default to original if something fails

                        if (app.timeOfAppoint) {
                            const timeParts = app.timeOfAppoint.split(':'); // Split "14:30:00"
                            let hours = parseInt(timeParts[0]);
                            let minutes = timeParts[1];

                            const ampm = hours >= 12 ? 'PM' : 'AM';

                            hours = hours % 12;
                            hours = hours ? hours : 12;

                            formattedTime = `${hours}:${minutes} ${ampm}`;
                        }
                        let formattedDate = app.dateOfAppoint;
                        if (app.dateOfAppoint) {
                            const dateParts = app.dateOfAppoint.split('-'); // Split 2026-01-30
                            // Reassemble as DD-MM-YYYY (30-01-2026)
                            if (dateParts.length === 3) {
                                formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
                            }
                        }
                        let emailNotice = '';
                        if (app.appointmentType === 'PATIENT') {
                            emailNotice = ' A cancellation email will be sent to the patient.';
                        }

                        if (app) {
                            var content = `
                                    <p>Are you sure you want to delete this Appointment?</p>
                                    <div class="alert alert-light border">
                                        <strong>Patient Name:</strong> ${app.firstName} ${app.lastName}<br>
                                        <strong>Patient ID:</strong> ${app.patientId}<br>
                                        <strong>Appointment With:</strong> ${app.appointmentType}<br>
                                        <strong>Date:</strong> ${formattedDate}<br>
                                        <strong>Time:</strong> ${formattedTime}
                                    </div>
                                    <p class="text-danger small mb-0"><i class="bi bi-exclamation-triangle"></i> This action cannot be undone.<br>
                                    ${emailNotice}</p>
                                `;

                            document.getElementById('deleteModalBody').innerHTML = content;

                            var deleteUrl = "<?php echo base_url(); ?>Healthcareprovider/deleteAppointment/" + id;
                            var deleteBtn = document.getElementById('confirmDeleteBtn');

                            deleteBtn.disabled = false;
                            deleteBtn.innerHTML = 'Cancel & Delete';

                            deleteBtn.onclick = function () {
                                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...';
                                this.disabled = true;

                                window.location.href = deleteUrl;
                            };

                            var myModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                            myModal.show();
                        } else {
                            console.error("Appointment not found in list");
                        }
                    }
                    //Block XSS Attacks
                    function escapeHTML(value) {
                        return String(value)
                            .replace(/&/g, '&amp;')
                            .replace(/</g, '&lt;')
                            .replace(/>/g, '&gt;')
                            .replace(/"/g, '&quot;')
                            .replace(/'/g, '&#039;');
                    }

                    // EVENTS
                    itemsDropdown.onchange = e => {
                        itemsPerPageAppointment = parseInt(e.target.value);
                        localStorage.setItem('itemsPerPageAppointment', itemsPerPageAppointment);
                        applyFilters();
                    };

                    searchBar.oninput = () => {
                        clearSearch.style.display = searchBar.value ? 'block' : 'none';
                        applyFilters();
                    };

                    clearSearch.onclick = () => {
                        searchBar.value = '';
                        clearSearch.style.display = 'none';
                        applyFilters();
                    };

                    filterDropdown.onchange = applyFilters;

                    // SORT EVENTS
                    sortPatientId.onclick = () => toggleSort('patientId');
                    sortDate.onclick = () => toggleSort('dateOfAppoint');

                    function toggleSort(field) {
                        if (sortBy === field) {
                            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                        } else {
                            sortBy = field;
                            sortOrder = 'asc';
                        }
                        updateSortIcons();
                        applyFilters();
                    }

                    function updateSortIcons() {
                        pidIndicator.textContent = sortBy === 'patientId' ? (sortOrder === 'asc' ? '🡱' : '🡳') : '';
                        dateIndicator.textContent = sortBy === 'dateOfAppoint' ? (sortOrder === 'asc' ? '🡱' : '🡳') : '';
                    }

                    // CORE FILTER
                    function applyFilters() {
                        const search = searchBar.value.toLowerCase();
                        const typeFilter = filterDropdown.value;

                        filteredList = appointmentList.filter(a => {
                            const patientId = a.patientId?.toLowerCase() || '';
                            const ccId = a.referalDoctor?.toLowerCase() || '';

                            const matchSearch = patientId.includes(search) || ccId.includes(search);
                            const matchType = typeFilter === 'All' || a.appointmentType === typeFilter;

                            return matchSearch && matchType;
                        });

                        if (sortBy) {
                            filteredList.sort((a, b) => {
                                let x = a[sortBy] || '';
                                let y = b[sortBy] || '';
                                return sortOrder === 'asc'
                                    ? x.localeCompare(y)
                                    : y.localeCompare(x);
                            });
                        }

                        displayAppointmentPage(1);
                    }

                    function renderActionButtons(row) {
                        const fullJoinUrl = `${baseUrl}healthcareprovider/join/${row.appointmentLink}`;
                        const consultBtn = `
                                <a href="${baseUrl}Consultation/consultation/${row.patientDbId}">
                                    <button class="btn btn-secondary mx-1"
                                        style="cursor:pointer;">
                                        <i class="bi bi-calendar-check"></i>
                                    </button>
                                </a>
                            `;
                        // Join logic stays SAME as before
                        const now = new Date();
                        const appointmentDateTime = new Date(
                            row.dateOfAppoint + ' ' + row.timeOfAppoint
                        );

                        const diffMinutes = (now - appointmentDateTime) / (1000 * 60);
                        const isToday = now.toISOString().slice(0, 10) === row.dateOfAppoint;
                        const isWithin10Minutes = diffMinutes >= -10000 && diffMinutes <= 10000;
                        const shouldEnableJoin = isToday && isWithin10Minutes;

                        const joinBtn = shouldEnableJoin
                            ? `
                                    <a href="${safeUrl(fullJoinUrl)}"
                                    target=_blank rel="noopener noreferrer">
                                        <button class="btn btn-success">Join</button>
                                    </a>
                                `
                            : `
                                    <button class="btn btn-success" style="opacity:0.6" disabled>
                                        Join
                                    </button>
                                `;

                        const isTooLateToDelete = diffMinutes > -10;
                        const deleteBtn = isTooLateToDelete
                            ? `
                                    <button class="btn btn-danger" 
                                        style="opacity: 0.5; cursor: not-allowed;" 
                                        title="Cannot delete 10 mins before appointment" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                `
                            : `
                                    <button class="btn btn-danger" 
                                        onclick="confirmDeleteApp(${row.id})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                `;

                        return `
                                ${deleteBtn}
                                ${consultBtn}
                                ${joinBtn}
                            `;
                    }
                    function formatTimeAMPM(timeStr) {
                        if (!timeStr) return '';

                        const date = new Date('1970-01-01 ' + timeStr);
                        return date.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        });
                    }

                    function formatDateOrToday(dateStr) {
                        const today = new Date().toISOString().slice(0, 10);

                        if (dateStr === today) {
                            return '<b>Today</b>';
                        }

                        const [year, month, day] = dateStr.split('-');
                        return `${day}-${month}-${year}`;
                    }

                    function safeUrl(url) {
                        return /^https?:\/\//i.test(url) ? url : '#';
                    }

                    // PAGINATION
                    function displayAppointmentPage(page) {
                        currentPageAppointment = page;

                        const start = (page - 1) * itemsPerPageAppointment;
                        const end = start + itemsPerPageAppointment;
                        const rows = filteredList.slice(start, end);

                        const tbody = document.getElementById('appointmentTableBody');
                        tbody.innerHTML = '';

                        updateAppointmentEntriesInfo(
                            start + 1,
                            Math.min(end, filteredList.length),
                            filteredList.length
                        );

                        rows.forEach((r, i) => {
                            const complaintText = r.patientComplaint
                                ? escapeHTML(r.patientComplaint)
                                : 'No complaint provided';

                            const patientLink = `<a href="${baseUrl}Healthcareprovider/patientdetails/${r.patientDbId}" 
                                    class="text-dark" onmouseover="this.style.textDecoration='underline'" 
                                    onmouseout="this.style.textDecoration='none'">${escapeHTML(r.patientId)}</a>`;

                            let ccLink = 'NA';
                            if (r.referalDoctor && r.referalDoctor !== 'Nil' && r.referalDoctorDbId) {
                                ccLink = `<a href="${baseUrl}Healthcareprovider/chiefDoctorsProfile/${r.referalDoctorDbId}" 
                            class="text-dark" onmouseover="this.style.textDecoration='underline'" 
                            onmouseout="this.style.textDecoration='none'">${escapeHTML(r.referalDoctor)}</a>`;
                            }

                            tbody.insertAdjacentHTML('beforeend', `
                                    <tr data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="${complaintText}">
                                        <td class="align-middle">${start + i + 1}.</td>
                                        <td class="align-middle">${escapeHTML(r.appointmentType)}</td>
                                        <td class="align-middle">${patientLink}</td>
                                        <td class="align-middle">${formatDateOrToday(r.dateOfAppoint)}</td>
                                        <td class="align-middle">${formatTimeAMPM(r.timeOfAppoint)}</td>
                                        <td class="align-middle">${ccLink}</td>
                                        <td class="d-flex d-lg-block">${renderActionButtons(r)}</td>
                                    </tr>
                                `);
                        });

                        generateAppointmentPagination(filteredList.length, page);
                        initBootstrapTooltips();
                    }

                    function updateAppointmentEntriesInfo(start, end, total) {
                        document.getElementById('entriesInfoAppointment')
                            .textContent = `Showing ${start} to ${end} of ${total} entries.`;
                    }

                    function generateAppointmentPagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPageAppointment);
                        const container = document.getElementById('paginationContainerAppointment');
                        container.innerHTML = '';

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        // Previous
                        const prev = document.createElement('li');
                        prev.innerHTML = `<button class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>`;
                        prev.onclick = () => currentPage > 1 && displayAppointmentPage(currentPage - 1);
                        ul.appendChild(prev);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, startPage + 4);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `<button class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}"
                                    style="background-color:${i === currentPage ? '#00ad8e' : 'transparent'}">${i}</button>`;
                            li.onclick = () => displayAppointmentPage(i);
                            ul.appendChild(li);
                        }

                        // Next
                        const next = document.createElement('li');
                        next.innerHTML = `<button class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>`;
                        next.onclick = () => currentPage < totalPages && displayAppointmentPage(currentPage + 1);
                        ul.appendChild(next);

                        container.appendChild(ul);
                    }

                    // INIT
                    displayAppointmentPage(1);

                    function initBootstrapTooltips() {
                        const tooltipTriggerList = [].slice.call(
                            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                        );

                        tooltipTriggerList.forEach(el => {
                            // Dispose old instance (important for pagination)
                            if (bootstrap.Tooltip.getInstance(el)) {
                                bootstrap.Tooltip.getInstance(el).dispose();
                            }

                            new bootstrap.Tooltip(el, {
                                placement: 'top',
                                html: false,
                                trigger: 'hover',
                                container: 'body'
                            });
                        });
                    }

                </script>

            <?php if (isset($appointmentReschedule[0]['id'])) { ?>
                    <section>
                        <div class="card rounded mt-4">
                            <div class="d-sm-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500">
                                    Reschedule Appointments
                                </p>
                            </div>

                            <div id="entriesPerPageReschedule" class="d-md-flex align-items-center justify-content-between mx-4">
                                <select id="filterDropdownReschedule" class="form-select border border-2 rounded-3 px-3 py-2"
                                    style="height: 50px; width: 280px;">
                                    <option value="All">Filter Appoinmtent with (All)</option>
                                    <option value="PATIENT">HCP</option>
                                    <option value="CC">CC</option>
                                </select>

                                <div class="d-flex align-items-center position-relative pt-2 pt-md-0">
                                    <input type="text" id="searchBarReschedule" class="border border-2 rounded-3 px-3 py-2"
                                        style="height: 50px; width: 260px" placeholder="Search (PATIENT ID / CC ID)">
                                    <span id="clearSearchReschedule" class="position-absolute"
                                        style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; font-size: 22px;">&times;</span>
                                </div>
                            </div>

                            <div class="mt-3 ms-4">
                                <label>Show</label>
                                <select id="itemsPerPageDropdownReschedule"
                                    class="form-select d-inline-block border border-2 rounded-2 w-auto mx-2">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <label>Entries</label>
                            </div>

                            <div class="card-body p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table text-center table-hoverr" id="appointmentRescheduleTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                                    APPOINTMENT WITH</th>

                                                <th scope="col"
                                                    style="font-size: 16px; font-weight: 500; color: #00ad8e; cursor:pointer;"
                                                    id="sortPatientIdReschedule">
                                                    <span onmouseover="this.style.textDecoration='underline'"
                                                        onmouseout="this.style.textDecoration='none'">
                                                        PATIENT ID <span id="sortPatientIdIndicatorReschedule"></span>
                                                    </span>
                                                </th>

                                                <th scope="col"
                                                    style="font-size: 16px; font-weight: 500; color: #00ad8e; cursor:pointer;"
                                                    id="sortDateReschedule">
                                                    <span onmouseover="this.style.textDecoration='underline'"
                                                        onmouseout="this.style.textDecoration='none'">
                                                        DATE <span id="sortDateIndicatorReschedule">🡱</span>
                                                    </span>
                                                </th>

                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">TIME
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">CC ID
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="rescheduleTableBody">
                                        </tbody>
                                    </table>

                                    <div class="d-md-flex justify-content-between ms-2">
                                        <div id="entriesInfoReschedule" class="mt-4"></div>
                                        <div class="pagination justify-content-end mt-4" id="paginationContainerReschedule">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php } ?>

                <script>
                    const rescheduleList = <?php echo json_encode($appointmentReschedule, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

                    let filteredRescheduleList = [...rescheduleList];
                    let itemsPerPageReschedule = 10;
                    let currentPageReschedule = 1;
                    let sortByReschedule = 'dateOfAppoint';
                    let sortOrderReschedule = 'asc';

                    const itemsDropdownRes = document.getElementById('itemsPerPageDropdownReschedule');
                    const searchBarRes = document.getElementById('searchBarReschedule');
                    const clearSearchRes = document.getElementById('clearSearchReschedule');
                    const filterDropdownRes = document.getElementById('filterDropdownReschedule');

                    const sortPidRes = document.getElementById('sortPatientIdReschedule');
                    const sortDateRes = document.getElementById('sortDateReschedule');
                    const pidIndRes = document.getElementById('sortPatientIdIndicatorReschedule');
                    const dateIndRes = document.getElementById('sortDateIndicatorReschedule');

                    function renderRescheduleActions(row) {
                        const rescheduleBtn = `
                        <a href="${baseUrl}Healthcareprovider/appointmentReschedule/${row.id}">
                            <button class="btn btn-secondary" title="Reschedule">
                                Reschedule
                            </button>
                        </a>
                        `;

                        // Delete Button (Triggers Modal via new function)
                        const deleteBtn = `
                            <button class="btn btn-danger" onclick="confirmDeleteReschedule(${row.id})" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        `;

                        return `
                            <div class="d-flex justify-content-center gap-2">
                                ${deleteBtn}
                                ${rescheduleBtn}
                            </div>
                        `;
                    }

                    function confirmDeleteReschedule(id) {
                        const app = rescheduleList.find(item => item.id == id);

                        if (app) {
                            let formattedTime = formatTimeAMPM(app.timeOfAppoint);
                            let formattedDate = formatDateOrToday(app.dateOfAppoint).replace('<b>Today</b>', app.dateOfAppoint); // Strip bold for modal

                            var content = `
                                <p>Are you sure you want to delete this Appointment?</p>
                                <div class="alert alert-light border">
                                    <strong>Patient Name:</strong> ${app.firstName || ''} ${app.lastName || ''}<br>
                                    <strong>Patient ID:</strong> ${app.patientId}<br>
                                    <strong>Appointment With:</strong> ${app.appointmentType}<br>
                                    <strong>Date:</strong> ${formattedDate}<br>
                                    <strong>Time:</strong> ${formattedTime}
                                </div>
                                <p class="text-danger small mb-0"><i class="bi bi-exclamation-triangle"></i> This action cannot be undone.</p>
                            `;

                            document.getElementById('deleteModalBody').innerHTML = content;

                            var deleteUrl = "<?php echo base_url(); ?>Healthcareprovider/deleteAppointment/" + id;
                            var deleteBtn = document.getElementById('confirmDeleteBtn');

                            deleteBtn.disabled = false;
                            deleteBtn.innerHTML = 'Delete';
                            deleteBtn.onclick = function () {
                                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...';
                                this.disabled = true;
                                window.location.href = deleteUrl;
                            };

                            var myModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                            myModal.show();
                        }
                    }

                    function displayReschedulePage(page) {

                        currentPageReschedule = page;
                        const start = (page - 1) * itemsPerPageReschedule;
                        const end = start + itemsPerPageReschedule;
                        const rows = filteredRescheduleList.slice(start, end);

                        const tbody = document.getElementById('rescheduleTableBody');
                        tbody.innerHTML = '';

                        if (rows.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="7" class="py-4">No appointments found</td></tr>';
                            document.getElementById('entriesInfoReschedule').textContent = '';
                            document.getElementById('paginationContainerReschedule').innerHTML = '';
                            return;
                        }

                        rows.forEach((r, i) => {
                            const complaintText = r.patientComplaint
                                ? escapeHTML(r.patientComplaint)
                                : 'No complaint provided';

                            const patientLink = `<a href="${baseUrl}Healthcareprovider/patientdetails/${r.patientDbId}" 
                                    class="text-dark" onmouseover="this.style.textDecoration='underline'" 
                                    onmouseout="this.style.textDecoration='none'">${escapeHTML(r.patientId)}</a>`;

                            let ccLink = 'NA';
                            if (r.referalDoctor && r.referalDoctor !== 'Nil' && r.referalDoctorDbId) {
                                ccLink = `<a href="${baseUrl}Healthcareprovider/chiefDoctorsProfile/${r.referalDoctorDbId}" 
                            class="text-dark" onmouseover="this.style.textDecoration='underline'" 
                            onmouseout="this.style.textDecoration='none'">${escapeHTML(r.referalDoctor)}</a>`;
                            }

                            tbody.insertAdjacentHTML('beforeend', `
                                <tr data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="${complaintText}">
                                    <td class="align-middle">${start + i + 1}.</td>
                                    <td class="align-middle">${r.appointmentType}</td>
                                    <td class="align-middle">${patientLink}</td>
                                    <td class="align-middle">${formatDateOrToday(r.dateOfAppoint)}</td>
                                    <td class="align-middle">${formatTimeAMPM(r.timeOfAppoint)}</td>
                                    <td class="align-middle">${ccLink}</td>
                                    <td class="align-middle">${renderRescheduleActions(r)}</td>
                                </tr>
                            `);
                        });

                        document.getElementById('entriesInfoReschedule').textContent =
                            `Showing ${start + 1} to ${Math.min(end, filteredRescheduleList.length)} of ${filteredRescheduleList.length} entries.`;

                        generateReschedulePagination(filteredRescheduleList.length, page);
                        initRescheduleTooltips();
                    }

                    function generateReschedulePagination(totalItems, currentPage) {
                        const totalPages = Math.ceil(totalItems / itemsPerPageReschedule);
                        const container = document.getElementById('paginationContainerReschedule');
                        container.innerHTML = '';

                        if (totalPages <= 0) return;

                        const ul = document.createElement('ul');
                        ul.className = 'pagination';

                        const prev = document.createElement('li');
                        prev.innerHTML = `<button class="bg-light border px-3 py-2" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>`;
                        prev.onclick = () => currentPage > 1 && displayReschedulePage(currentPage - 1);
                        ul.appendChild(prev);

                        const startPage = Math.max(1, currentPage - 2);
                        const endPage = Math.min(totalPages, startPage + 4);

                        for (let i = startPage; i <= endPage; i++) {
                            const li = document.createElement('li');
                            li.innerHTML = `<button class="btn border px-3 py-2 ${i === currentPage ? 'text-light' : ''}"
                        style="background-color:${i === currentPage ? '#00ad8e' : 'transparent'}">${i}</button>`;
                            li.onclick = () => displayReschedulePage(i);
                            ul.appendChild(li);
                        }

                        // Next
                        const next = document.createElement('li');
                        next.innerHTML = `<button class="border px-3 py-2" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>`;
                        next.onclick = () => currentPage < totalPages && displayReschedulePage(currentPage + 1);
                        ul.appendChild(next);

                        container.appendChild(ul);
                    }

                    // 7. FILTER & SORT LOGIC
                    function applyRescheduleFilters() {
                        const search = searchBarRes.value.toLowerCase();
                        const typeFilter = filterDropdownRes.value; // 'All', 'PATIENT', 'CC'

                        filteredRescheduleList = rescheduleList.filter(a => {
                            const patientId = a.patientId?.toLowerCase() || '';
                            const ccId = a.referalDoctor?.toLowerCase() || '';

                            const matchSearch = patientId.includes(search) || ccId.includes(search);
                            const matchType = typeFilter === 'All' || a.appointmentType === typeFilter;

                            return matchSearch && matchType;
                        });

                        // Sort
                        if (sortByReschedule) {
                            filteredRescheduleList.sort((a, b) => {
                                let x = a[sortByReschedule] || '';
                                let y = b[sortByReschedule] || '';
                                return sortOrderReschedule === 'asc' ? x.localeCompare(y) : y.localeCompare(x);
                            });
                        }

                        displayReschedulePage(1);
                    }

                    function toggleRescheduleSort(field) {
                        if (sortByReschedule === field) {
                            sortOrderReschedule = sortOrderReschedule === 'asc' ? 'desc' : 'asc';
                        } else {
                            sortByReschedule = field;
                            sortOrderReschedule = 'asc';
                        }

                        // Update Icons
                        pidIndRes.textContent = sortByReschedule === 'patientId' ? (sortOrderReschedule === 'asc' ? '🡱' : '🡳') : '';
                        dateIndRes.textContent = sortByReschedule === 'dateOfAppoint' ? (sortOrderReschedule === 'asc' ? '🡱' : '🡳') : '';

                        applyRescheduleFilters();
                    }

                    // 8. EVENT LISTENERS
                    itemsDropdownRes.onchange = e => {
                        itemsPerPageReschedule = parseInt(e.target.value);
                        displayReschedulePage(1);
                    };

                    searchBarRes.oninput = () => {
                        clearSearchRes.style.display = searchBarRes.value ? 'block' : 'none';
                        applyRescheduleFilters();
                    };

                    clearSearchRes.onclick = () => {
                        searchBarRes.value = '';
                        clearSearchRes.style.display = 'none';
                        applyRescheduleFilters();
                    };

                    filterDropdownRes.onchange = applyRescheduleFilters;

                    sortPidRes.onclick = () => toggleRescheduleSort('patientId');
                    sortDateRes.onclick = () => toggleRescheduleSort('dateOfAppoint');

                    // 9. INITIALIZE
                    displayReschedulePage(1);

                    function initRescheduleTooltips() {
                        const tooltipTriggerList = [].slice.call(
                            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                        );

                        tooltipTriggerList.forEach(el => {
                            // Dispose old instance (important for pagination)
                            if (bootstrap.Tooltip.getInstance(el)) {
                                bootstrap.Tooltip.getInstance(el).dispose();
                            }

                            new bootstrap.Tooltip(el, {
                                placement: 'top',
                                html: false,
                                trigger: 'hover',
                                container: 'body'
                            });
                        });
                    }
                </script>

            <?php
        } else if ($method == "appointmentsForm") {
            ?>
                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500"> New Appointment</p>
                                <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                    class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                            </div>
                            <div class="card-body px-md-4 pb-4">
                                <!-- Form  -->
                                <div>
                                    <div class="col-md-8">
                                        <form action="<?php echo base_url() . "Healthcareprovider/newAppointment" ?>" method="POST"
                                            name="patientDetails" onsubmit="return validateAppointment()"
                                            oninput="clearErrorAppointment()">

                                            <div class="form-group pb-3">
                                                <label class="form-label">Appointment With <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="appointmentType" name="appointmentType"
                                                    onchange="toggleAppointmentFields()">
                                                    <option value="">Select Appointment With</option>
                                                    <option value="CC">CC & HCP Appointment</option>
                                                    <option value="PATIENT">PATIENT & HCP Appointment</option>
                                                </select>
                                                <small id="appointmentType_err" class="text-danger pt-1"></small>
                                            </div>

                                            <fieldset id="appointmentFormFields" disabled>

                                                <div class="form-group pb-3" id="referalDoctorSection" style="display:none;">
                                                    <label class="form-label" for="referalDoctor">Referal Doctor ID <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control mb-1" id="referralDoctorSearch"
                                                        placeholder="Search Chief Consultant Id / Name" autocomplete="off">
                                                    <select class="form-select" name="referalDoctor" id="referalDoctor"
                                                        oninput="adjustTimeOptions()">
                                                        <option value="">Select Chief Consultant Id</option>
                                                <?php foreach ($ccsId as $key => $value) { ?>
                                                            <option
                                                                value="<?php echo $value['ccId'] . '|' . $value['id'] . '|' . $value['gMeetLink'] ?>">
                                                        <?php echo $value['ccId'] ?> / <?php echo $value['doctorName'] ?>
                                                            </option>
                                                <?php } ?>
                                                    </select>
                                                    <small id="referalDoctor_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="form-group pb-2">
                                                    <label class="form-label" for="patientId">Patient Id <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group mb-1">
                                                        <input type="text" class="form-control"
                                                            placeholder="Search patient Id / Name" id="patientSearch"
                                                            autocomplete="off">
                                                        <span class="input-group-text bg-white border-start-0"><i
                                                                class="bi bi-search"></i></span>
                                                        <button class="btn text-light d-flex align-items-center"
                                                            style="background-color: #00ad8e;" type="button" id="addPatientBtn"
                                                            title="Add New Patient">
                                                            <i class="bi bi-plus-lg me-1"></i> Add New Patient
                                                        </button>
                                                    </div>
                                                    <select class="form-select" name="patientId" id="patientId">
                                                <?php foreach ($patientsId as $value): ?>
                                                            <option
                                                                value="<?php echo htmlspecialchars($value['patientId'] . '|' . $value['id']); ?>">
                                                        <?php echo htmlspecialchars($value['patientId'] . " / " . $value['firstName'] . " " . $value['lastName']); ?>
                                                            </option>
                                                <?php endforeach; ?>
                                                    </select>
                                                    <small id="patientId_err" class="text-danger pt-1"></small>
                                                </div>



                                                <!-- <div class="form-group pb-3" id="modeSection">
                                                    <label class="form-label pb-2" for="appConsult">Mode of consult <span class="text-danger">*</span></label><br>
                                                    <input type="radio" id="audio" name="appConsult" value="audio" checked>
                                                    <label for="audio">Audio</label>
                                                    <input type="radio" class="ms-5 ps-5" id="video" name="appConsult" value="video">
                                                    <label for="video">Video</label><br>
                                                    <div id="appConsult_err" class="text-danger pt-1"></div>
                                                </div> -->

                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="appDate">Date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="appDate" name="appDate"
                                                        oninput="adjustTimeOptions()">
                                                    <small id="appDate_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="dayTime">Part of a day <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="dayTime" name="dayTime"
                                                        onchange="adjustTimeOptions()">
                                                        <option id="placeholderOption" value="" style="display: none;">Select
                                                            part
                                                            of the day</option>
                                                        <option value="Morning">Morning</option>
                                                        <option value="Afternoon">Afternoon</option>
                                                        <option value="Evening">Evening</option>
                                                        <option value="Night">Night</option>
                                                    </select>
                                                    <small id="dayTime_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="form-group pb-1">
                                                    <label class="form-label" for="appTime">Time <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="appTime" name="appTime"
                                                        placeholder="Select time" readonly>
                                                    <small id="appTime_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="py-2" id="morningTime" style="display:none">
                                                    <i class="bi bi-brightness-alt-high"></i>, Morning Consult time,<br>
                                            <?php foreach ($morning as $time): ?>
                                                        <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                            value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                        </button>
                                            <?php endforeach; ?>
                                                </div>

                                                <div class="py-2" id="afternoonTime" style="display:none">
                                                    <i class="bi bi-sun"></i>, Afternoon Consult time,<br>
                                            <?php foreach ($afternoon as $time): ?>
                                                        <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                            value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                        </button>
                                            <?php endforeach; ?>
                                                </div>

                                                <div class="py-2" id="eveningTime" style="display:none">
                                                    <i class="bi bi-brightness-alt-high"></i>, Evening Consult time,<br>
                                            <?php foreach ($evening as $time): ?>
                                                        <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                            value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                        </button>
                                            <?php endforeach; ?>
                                                </div>

                                                <div class="py-2" id="nightTime" style="display:none">
                                                    <i class="bi bi-moon-stars"></i>, Night Consult time,<br>
                                            <?php foreach ($night as $time): ?>
                                                        <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                            value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                        </button>
                                            <?php endforeach; ?>
                                                </div>

                                                <div class="form-group py-3">
                                                    <label class="form-label" for="appReason">Complaint <span
                                                            class="text-danger">*</span></label></label>
                                                    <textarea class="form-control" id="appReason" name="appReason" rows="3"
                                                        maxlength="250"
                                                        placeholder="Enter complaint to book appointment"></textarea>
                                                    <small id="appReason_err" class="text-danger pt-1"></small>
                                                </div>

                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="pay">Payment</label>
                                                    <input type="text" class="form-control" id="pay" name="pay"
                                                        placeholder="Add payment details">
                                                </div>

                                                <button type="submit" id="AppSubmit" class="btn text-light float-end mt-2"
                                                    style="background-color: #00ad8e;">Book Appointment</button>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Appointment booking -->
                    <script>
                        var appBookedDetails = <?php echo json_encode($appBookedDetails); ?>;

                        function adjustTimeOptions() {
                            const selectedDate = document.getElementById('appDate').value;
                            const referalCc = document.getElementById('referalDoctor').value;
                            const parts = referalCc.split('|');
                            const referalCcId = parts[0];
                            var currentHcpId = "<?php echo $_SESSION['hcpIdDb']; ?>";

                            const timeButtons = document.querySelectorAll('.timeButton');

                            timeButtons.forEach(button => {
                                button.disabled = false;
                                button.classList.add('btn-outline-secondary');
                                button.classList.remove('btn-secondary');
                                button.style.fontSize = '16px';
                                button.innerHTML = button.innerHTML.replace(' Booked', '');
                            });

                            appBookedDetails.forEach(appointment => {
                                const bookedDate = formatDate(appointment.dateOfAppoint);
                                const bookedTime = appointment.timeOfAppoint;
                                const bookedCcDoctor = appointment.referalDoctor;
                                const bookedHcpId = appointment.hcpDbId;

                                if ((bookedDate === selectedDate && referalCcId !== '' && bookedCcDoctor === referalCcId)) {
                                    timeButtons.forEach(button => {
                                        if (button.value === bookedTime) {
                                            button.disabled = true;
                                            button.classList.add('btn-secondary');
                                            button.classList.remove('btn-outline-secondary');
                                            button.style.fontSize = '12px';
                                            const time = button.textContent;
                                            const booked = ' Booked';
                                            if (!button.innerHTML.includes(booked)) {
                                                button.innerHTML = time + booked;
                                            }
                                        }
                                    });
                                }

                                if ((bookedDate === selectedDate && bookedHcpId === currentHcpId)) {
                                    timeButtons.forEach(button => {
                                        if (button.value === bookedTime) {
                                            button.disabled = true;
                                            button.classList.add('btn-secondary');
                                            button.classList.remove('btn-outline-secondary');
                                            button.style.fontSize = '12px';
                                            const time = button.textContent;
                                            const booked = ' Booked';
                                            if (!button.innerHTML.includes(booked)) {
                                                button.innerHTML = time + booked;
                                            }
                                        }
                                    });
                                }

                            });
                        }

                        function formatDate(dateString) {
                            const date = new Date(dateString);
                            const yyyy = date.getFullYear();
                            const mm = String(date.getMonth() + 1).padStart(2, '0');
                            const dd = String(date.getDate()).padStart(2, '0');
                            return `${yyyy}-${mm}-${dd}`; // Ensure consistent format
                        }

                        var dateInput = document.getElementById('appDate');
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                        var yyyy = today.getFullYear();
                        var minDate = `${yyyy}-${mm}-${dd}`;
                        dateInput.setAttribute('min', minDate);

                        var buttons = document.querySelectorAll('.timeButton');
                        buttons.forEach(function (button) {
                            button.addEventListener('click', function () {
                                buttons.forEach(function (btn) {
                                    btn.classList.remove('highlighted');
                                });
                                button.classList.add('highlighted');
                                document.getElementById('appTime').value = button.value;
                            });
                        });

                        function displayTime() {
                            var dayTime = document.getElementById("dayTime").value;
                            var morningTime = document.getElementById("morningTime");
                            var afternoonTime = document.getElementById("afternoonTime");
                            var eveningTime = document.getElementById("eveningTime");
                            var nightTime = document.getElementById("nightTime");

                            morningTime.style.display = "none";
                            afternoonTime.style.display = "none";
                            eveningTime.style.display = "none";
                            nightTime.style.display = "none";

                            if (dayTime === 'Morning') {
                                morningTime.style.display = "block";
                            } else if (dayTime === 'Afternoon') {
                                afternoonTime.style.display = "block";
                            } else if (dayTime === 'Evening') {
                                eveningTime.style.display = "block";
                            } else if (dayTime === 'Night') {
                                nightTime.style.display = "block";
                            }

                            adjustTimeOptions();
                        }

                        window.onload = function () {
                            var selectElement = document.getElementById('dayTime');
                            selectElement.addEventListener('change', function () {
                                displayTime();
                            });

                            var placeholderOption = document.getElementById('placeholderOption');
                            placeholderOption.style.display = 'block';

                            var timeButtons = document.querySelectorAll('.timeButton');
                            timeButtons.forEach(function (button) {
                                button.addEventListener('click', function () {
                                    timeButtons.forEach(function (btn) {
                                        btn.classList.remove('highlighted');
                                    });
                                    button.classList.add('highlighted');
                                    document.getElementById('appTime').value = button.value;
                                });
                            });

                            adjustTimeOptions();
                        };

                        function adjustTimeOptionsBasedOnCurrentTime() {
                            const currentDate = new Date();
                            const selectedDate = new Date(document.getElementById('appDate').value);
                            const selectElement = document.getElementById('dayTime');

                            selectElement.style.display = 'block';

                            if (currentDate.toDateString() === selectedDate.toDateString()) {
                                const currentHour = currentDate.getHours();

                                if (currentHour >= 4) {
                                    hideOption('Morning');
                                }
                                if (currentHour >= 9) {
                                    hideOption('Afternoon');
                                }
                                if (currentHour >= 15) {
                                    hideOption('Evening');
                                }
                                if (currentHour >= 18) {
                                    hideOption('Night');
                                }
                            } else {
                                showAllOptions();
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

                        function showAllOptions() {
                            const selectElement = document.getElementById('dayTime');
                            for (let i = 0; i < selectElement.options.length; i++) {
                                selectElement.options[i].style.display = 'block';
                            }
                        }

                        document.getElementById('appDate').addEventListener('change', function () {
                            adjustTimeOptionsBasedOnCurrentTime();
                            displayTime();
                        });
                    </script>

                    <!-- Symptoms search and select -->
                    <!-- <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const multiSelect = document.getElementById("multiSelectSymptoms");
                            const selectedValuesInput = document.getElementById("appReason");
                            const selectedValuesContainer = document.getElementById("selectedValuesContainer");
                            const symptomSearchInput = document.getElementById("symptomSearchInput");

                            let originalOptions = Array.from(multiSelect.options);
                            let selectedValues = new Set();

                            if (symptomSearchInput) {
                                symptomSearchInput.addEventListener("input", function () {
                                    const term = this.value.toLowerCase().trim();

                                    multiSelect.innerHTML = '';

                                    multiSelect.appendChild(originalOptions[0]);

                                    if (term.length > 0) {
                                        let matchCount = 0;
                                        const MAX_RESULTS = 5;

                                        for (let i = 1; i < originalOptions.length; i++) {
                                            if (matchCount >= MAX_RESULTS) break;

                                            const option = originalOptions[i];
                                            if (option.textContent.toLowerCase().includes(term)) {
                                                multiSelect.appendChild(option.cloneNode(true));
                                                matchCount++;
                                            }
                                        }

                                        if (matchCount > 0) {
                                            multiSelect.size = matchCount + 1;
                                        } else {
                                            const noRes = document.createElement('option');
                                            noRes.textContent = "— No symptoms found —";
                                            noRes.disabled = true;
                                            multiSelect.appendChild(noRes);
                                            multiSelect.size = 2;
                                        }
                                    } else {
                                        originalOptions.forEach(opt => multiSelect.appendChild(opt.cloneNode(true)));
                                        multiSelect.size = 1; // Close dropdown
                                    }
                                });

                                symptomSearchInput.addEventListener("blur", function () {
                                    setTimeout(() => {
                                        multiSelect.size = 1;
                                    }, 200);
                                });

                                symptomSearchInput.addEventListener("click", function () {
                                    if (this.value.length > 0) {
                                        this.dispatchEvent(new Event('input'));
                                    }
                                });
                            }

                            multiSelect.addEventListener("change", () => {
                                const selectedOptions = Array.from(multiSelect.selectedOptions);

                                selectedOptions.forEach(option => {
                                    if (option.value === "") return;

                                    selectedValues.add(option.value);

                                    originalOptions.forEach(origOpt => {
                                        if (origOpt.value === option.value) {
                                            if (!origOpt.textContent.includes('✓')) {
                                                origOpt.textContent = origOpt.textContent + ' ✓';
                                            }
                                        }
                                    });
                                });

                                updateSelectedValues();

                                symptomSearchInput.value = '';
                                multiSelect.innerHTML = '';
                                originalOptions.forEach(opt => multiSelect.appendChild(opt.cloneNode(true)));
                                multiSelect.value = "";
                                multiSelect.size = 1;
                            });

                            const updateSelectedValues = () => {
                                selectedValuesContainer.innerHTML = '';
                                selectedValues.forEach(value => {
                                    const span = document.createElement('span');
                                    span.classList.add('badge', 'bg-secondary', 'me-2', 'mb-1', 'd-inline-flex', 'align-items-center', 'p-2');
                                    span.textContent = value;

                                    const button = document.createElement('button');
                                    button.innerHTML = '&times;';
                                    button.classList.add('btn-close', 'btn-close-white', 'ms-2');

                                    button.addEventListener('click', () => {
                                        selectedValues.delete(value);
                                        updateSelectedValues();

                                        originalOptions.forEach(origOpt => {
                                            if (origOpt.value === value) {
                                                origOpt.textContent = origOpt.textContent.replace(' ✓', '').trim();
                                            }
                                        });

                                        multiSelect.innerHTML = '';
                                        originalOptions.forEach(opt => multiSelect.appendChild(opt.cloneNode(true)));
                                        multiSelect.value = "";
                                    });

                                    span.appendChild(button);
                                    selectedValuesContainer.appendChild(span);
                                });

                                selectedValuesInput.value = Array.from(selectedValues).join(", ");
                            };
                        });
                    </script> -->

                    <!-- Appoinmtent form validation -->
                    <!-- <script>
                        function clearErrorAppointment() {
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;
                            // var reason = document.getElementById("appReason").value;

                            if (patientId != "") {
                                document.getElementById("patientId_err").innerHTML = "";
                            }
                            if (referalDr != "") {
                                document.getElementById("referalDoctor_err").innerHTML = "";
                            }
                            if (date != "") {
                                document.getElementById("appDate_err").innerHTML = "";
                            }
                            if (dayTime != "") {
                                document.getElementById("dayTime_err").innerHTML = "";
                            }
                            if (time != "") {
                                document.getElementById("appTime_err").innerHTML = "";
                            }
                            // if (appReason != "") {
                            //     document.getElementById("appReason_err").innerHTML = "";
                            // }
                        }

                        function validateAppointment() {
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;
                            // var reason = document.getElementById("appReason").value;

                            if (patientId == "") {
                                document.getElementById("patientId_err").innerHTML = "Please select a patient.";
                                document.getElementById("patientId").focus();
                                return false;
                            } else {
                                document.getElementById("patientId_err").innerHTML = "";
                            }
                            if (referalDr == "") {
                                document.getElementById("referalDoctor_err").innerHTML = "Please Select the referral doctor’s name.";
                                document.getElementById("referalDoctor").focus();
                                return false;
                            } else {
                                document.getElementById("referalDoctor_err").innerHTML = "";
                            }
                            if (date == "") {
                                document.getElementById("appDate_err").innerHTML = "Please select a date.";
                                document.getElementById("appDate").focus();
                                return false;
                            } else {
                                document.getElementById("appDate_err").innerHTML = "";
                            }

                            if (dayTime == "") {
                                document.getElementById("dayTime_err").innerHTML = "Please select Part Of Day";
                                document.getElementById("dayTime").focus();
                                return false;
                            } else {
                                document.getElementById("dayTime_err").innerHTML = "";
                            }
                            if (time == "") {
                                document.getElementById("appTime_err").innerHTML = "Please select a time.";
                                document.getElementById("appTime").focus();
                                return false;
                            } else {
                                document.getElementById("appTime_err").innerHTML = "";
                            }
                            // if (reason == "") {
                            //     document.getElementById("appReason_err").innerHTML = "Complaints must be filled out.";
                            //     document.getElementById("appReason").focus();
                            //     return false;
                            // } else {
                            //     document.getElementById("appReason_err").innerHTML = "";
                            // }
                            return true;
                        }
                    </script> -->

                    <!--New Appoinmtent form validation -->
                    <script>
                        function toggleAppointmentFields() {
                            var type = document.getElementById("appointmentType").value;
                            var fieldset = document.getElementById("appointmentFormFields"); // This targets the <fieldset> wrapper
                            var referalSection = document.getElementById("referalDoctorSection");
                            //var modeSection = document.getElementById("modeSection");

                            if (type === "") {
                                // Disable everything if no type selected
                                if (fieldset) fieldset.disabled = true;
                            } else {
                                // Enable form
                                if (fieldset) fieldset.disabled = false;

                                if (type === "PATIENT") {
                                    // Hide Referral & Mode sections for Only HCP
                                    if (referalSection) referalSection.style.display = "none";
                                    //if(modeSection) modeSection.style.display = "none";
                                    // Clear values to avoid validation errors
                                    document.getElementById("referalDoctor").value = "";
                                } else {
                                    // Show them for CC & HCP
                                    if (referalSection) referalSection.style.display = "block";
                                    //if(modeSection) modeSection.style.display = "block";
                                }
                            }
                        }
                        function clearErrorAppointment() {
                            // 1. Get the new Appointment Type
                            var type = document.getElementById("appointmentType").value;
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;

                            // 2. Clear error for Appointment Type
                            if (type != "") {
                                document.getElementById("appointmentType_err").innerHTML = "";
                            }
                            if (patientId != "") {
                                document.getElementById("patientId_err").innerHTML = "";
                            }
                            if (referalDr != "") {
                                document.getElementById("referalDoctor_err").innerHTML = "";
                            }
                            if (date != "") {
                                document.getElementById("appDate_err").innerHTML = "";
                            }
                            if (dayTime != "") {
                                document.getElementById("dayTime_err").innerHTML = "";
                            }
                            if (time != "") {
                                document.getElementById("appTime_err").innerHTML = "";
                            }
                        }

                        function validateAppointment() {
                            var type = document.getElementById("appointmentType").value;
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;
                            var Reason = document.getElementById("appReason").value;

                            if (type == "") {
                                document.getElementById("appointmentType_err").innerHTML = "Please select an appointment type.";
                                document.getElementById("appointmentType").focus();
                                return false;
                            } else {
                                document.getElementById("appointmentType_err").innerHTML = "";
                            }

                            if (type !== "PATIENT") {
                                if (referalDr == "") {
                                    document.getElementById("referalDoctor_err").innerHTML = "Please Select the referral doctor’s name.";
                                    document.getElementById("referalDoctor").focus();
                                    return false;
                                } else {
                                    document.getElementById("referalDoctor_err").innerHTML = "";
                                }
                            }

                            if (patientId == "") {
                                document.getElementById("patientId_err").innerHTML = "Please select the patient";
                                document.getElementById("patientId").focus();
                                return false;
                            } else {
                                document.getElementById("patientId_err").innerHTML = "";
                            }

                            if (date == "") {
                                document.getElementById("appDate_err").innerHTML = "Please select a date.";
                                document.getElementById("appDate").focus();
                                return false;
                            } else {
                                document.getElementById("appDate_err").innerHTML = "";
                            }

                            if (dayTime == "") {
                                document.getElementById("dayTime_err").innerHTML = "Please select part of day";
                                document.getElementById("dayTime").focus();
                                return false;
                            } else {
                                document.getElementById("dayTime_err").innerHTML = "";
                            }

                            if (time == "") {
                                document.getElementById("appTime_err").innerHTML = "Please select a time.";
                                document.getElementById("appTime").focus();
                                return false;
                            } else {
                                document.getElementById("appTime_err").innerHTML = "";
                            }

                            if (Reason == "") {
                                document.getElementById("appReason_err").innerHTML = "Please fill the compliant section";
                                document.getElementById("appReason").focus();
                                return false;

                            } else {
                                document.getElementById("appReason_err").innerHTML = "";
                            }
                            var submitBtn = document.getElementById("AppSubmit");
                            if (submitBtn) {
                                submitBtn.disabled = true;
                                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
                            }

                            return true;
                        }
                    </script>

            <?php
        } else if ($method == "appointmentUpdate") {
            ?>
                        <!-- UpdateAppointment section -->
                        <!-- <section>
                            <div class="card rounded">
                                <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                    <p style="font-size: 24px; font-weight: 500">Update Appoitment</p>
                                    <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                        class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body px-md-4 pb-4">
                                    <div>
                                        <div class="col-md-8">
                                    <?php
                                    foreach ($updateAppDetails as $key => $value) {
                                        ?>
                                                <form action="<?php echo base_url() . "Healthcareprovider/updateAppointmentForm" ?>"
                                                    method="POST" name="patientDetails" onsubmit="return validateAppointment()"
                                                    oninput="clearErrorAppointment()">
                                                    <input type="hidden" id="appTableId" name="appTableId"
                                                        value="<?php echo $value['id'] ?>">
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="patientId">Patient Id</label>
                                                        <input type="text" class="form-control" name="patientId" id="patientId"
                                                            value="<?php echo $value['patientId'] ?>" disabled
                                                            onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="referalDoctor">Referal Doctor ID</label>
                                                        <input type="text" class="form-control" id="referalDoctor" name="referalDoctor"
                                                            value="<?php echo $value['referalDoctor'] ?>" disabled
                                                            onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label pb-2" for="appConsult">Mode of consult</label><br>
                                                        <input type="radio" id="audio" name="appConsult" value="audio" checked>
                                                        <label for="audio">Audio</label>
                                                        <input type="radio" class="ms-5 ps-5" id="video" name="appConsult" value="video">
                                                        <label for="video">Video</label><br>
                                                    </div>
                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="appDate">Date <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="appDate" name="appDate"
                                                            oninput="adjustTimeOptions()" onchange="dateError()">
                                                        <div id="appDate_err" class="text-danger pt-1"></div>
                                                    </div>
                                                    <div class="form-group pb-1" id="appTimeGroup">
                                                        <label class="form-label" for="appTime">Time <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="appTime" name="appTime"
                                                            placeholder="E.g. Select time" readonly>
                                                        <div id="appTime_err" class="text-danger pt-1"></div>
                                                    </div>

                                                    <div class="py-2" id="morningTime">
                                                        <i class="bi bi-brightness-alt-high"></i>, Morning Consult time,<br>
                                            <?php foreach ($morning as $time): ?>
                                                            <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                            </button>
                                            <?php endforeach; ?>
                                                    </div>

                                                    <div class="py-2" id="afternoonTime">
                                                        <i class="bi bi-sun"></i>, Afternoon Consult time,<br>
                                            <?php foreach ($afternoon as $time): ?>
                                                            <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                            </button>
                                            <?php endforeach; ?>
                                                    </div>

                                                    <div class="py-2" id="eveningTime">
                                                        <i class="bi bi-brightness-alt-high"></i>, Evening Consult time,<br>
                                            <?php foreach ($evening as $time): ?>
                                                            <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                            </button>
                                            <?php endforeach; ?>
                                                    </div>

                                                    <div class="py-2" id="nightTime">
                                                        <i class="bi bi-moon-stars"></i>, Night Consult time,<br>
                                            <?php foreach ($night as $time): ?>
                                                            <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                            </button>
                                            <?php endforeach; ?>
                                                    </div>
                                                    <div class="form-group py-3">
                                                        <label class="form-label" for="appReason">Complaint</label>
                                                        <input type="text" class="form-control" id="appReason" name="appReason"
                                                            value="<?php echo $value['patientComplaint'] != '' ? $value['patientComplaint'] : "-"; ?>"
                                                            disabled onmouseover="style='cursor: no-drop;'"
                                                            onmouseout="style='cursor: ns-resize;">
                                                    </div>

                                                    <div class="form-group pb-3">
                                                        <label class="form-label" for="pay">Payment Status</label>
                                                        <input type="text" class="form-control" id="pay" name="pay" value="Paid" disabled
                                                            onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2">
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
                        </section> -->

                        <!-- <script>
                            function formatDate(dateString) {
                                const date = new Date(dateString);
                                const year = date.getFullYear();
                                const month = ('0' + (date.getMonth() + 1)).slice(-2);
                                const day = ('0' + date.getDate()).slice(-2);
                                return `${year}-${month}-${day}`;
                            }

                            var appBookedDetails = <?php echo json_encode($appBookedDetails); ?>;

                            document.getElementById('appDate').setAttribute('min', new Date().toISOString().split('T')[0]);

                            document.getElementById('appTimeGroup').style.display = 'none';
                            document.getElementById('morningTime').style.display = 'none';
                            document.getElementById('afternoonTime').style.display = 'none';
                            document.getElementById('eveningTime').style.display = 'none';
                            document.getElementById('nightTime').style.display = 'none';

                            function adjustTimeOptions() {
                                const selectedDate = document.getElementById('appDate').value;
                                const referalCc = document.getElementById('referalDoctor').value;
                                const parts = referalCc.split('|');
                                const referalCcId = parts[0];
                                const today = new Date().toISOString().split('T')[0];
                                const currentTime = new Date().getHours() * 60 + new Date().getMinutes();

                                const timeButtons = document.querySelectorAll('.timeButton');
                                var currentHcpId = "<?php echo $_SESSION['hcpIdDb']; ?>";

                                if (!selectedDate) {
                                    document.getElementById('appTimeGroup').style.display = 'none';
                                    document.getElementById('morningTime').style.display = 'none';
                                    document.getElementById('afternoonTime').style.display = 'none';
                                    document.getElementById('eveningTime').style.display = 'none';
                                    document.getElementById('nightTime').style.display = 'none';
                                    return;
                                }

                                document.getElementById('appTimeGroup').style.display = 'block';
                                document.getElementById('morningTime').style.display = 'block';
                                document.getElementById('afternoonTime').style.display = 'block';
                                document.getElementById('eveningTime').style.display = 'block';
                                document.getElementById('nightTime').style.display = 'block';

                                timeButtons.forEach(button => {
                                    button.disabled = false;
                                    button.classList.add('btn-outline-secondary');
                                    button.classList.remove('btn-secondary');
                                    button.style.display = '';
                                    button.style.fontSize = '16px';
                                    button.innerHTML = button.innerHTML.replace('Booked', '').trim();
                                });

                                if (selectedDate === today) {
                                    timeButtons.forEach(button => {
                                        const [hours, minutes] = button.value.split(':').map(Number);
                                        const buttonTime = hours * 60 + minutes;

                                        if (buttonTime <= currentTime) {
                                            button.style.display = 'none';
                                        }
                                    });
                                }

                                appBookedDetails.forEach(appointment => {
                                    const bookedDate = formatDate(appointment.dateOfAppoint);
                                    const bookedTime = appointment.timeOfAppoint;
                                    const bookedCcDoctor = appointment.referalDoctor;
                                    const bookedHcpId = appointment.hcpDbId;

                                    if ((bookedDate === selectedDate && referalCcId !== '' && bookedCcDoctor === referalCcId)) {
                                        timeButtons.forEach(button => {
                                            if (button.value === bookedTime) {
                                                button.disabled = true;
                                                button.classList.add('btn-secondary');
                                                button.classList.remove('btn-outline-secondary');
                                                button.style.fontSize = '12px';
                                                const time = button.textContent;
                                                const booked = ' Booked';
                                                if (!button.innerHTML.includes(booked)) {
                                                    button.innerHTML = time + booked;
                                                }
                                            }
                                        });
                                    }

                                    if ((bookedDate === selectedDate && bookedHcpId === currentHcpId)) {
                                        timeButtons.forEach(button => {
                                            if (button.value === bookedTime) {
                                                button.disabled = true;
                                                button.classList.add('btn-secondary');
                                                button.classList.remove('btn-outline-secondary');
                                                button.style.fontSize = '12px';
                                                const time = button.textContent;
                                                const booked = ' Booked';
                                                if (!button.innerHTML.includes(booked)) {
                                                    button.innerHTML = time + booked;
                                                }
                                            }
                                        });
                                    }
                                });

                                ['morningTime', 'afternoonTime', 'eveningTime', 'nightTime'].forEach(sectionId => {
                                    const section = document.getElementById(sectionId);
                                    const visibleButtons = Array.from(section.querySelectorAll('.timeButton')).some(button => button.style.display !== 'none');
                                    section.style.display = visibleButtons ? 'block' : 'none';
                                });
                            }
                        </script> -->

                        <!-- <script>
                            function dateError() {
                                const selectedDate = document.getElementById('appDate').value;
                                const today = new Date().toISOString().split('T')[0];
                                if (selectedDate < today) {
                                    document.getElementById("appDate_err").innerHTML = "Date must be today or later.";
                                } else {
                                    document.getElementById("appDate_err").innerHTML = "";
                                }

                            }
                        </script> -->

                        <!-- <script>
                            var buttons = document.querySelectorAll('.timeButton');
                            buttons.forEach(function (button) {
                                button.addEventListener('click', function () {
                                    buttons.forEach(function (btn) {
                                        btn.classList.remove('highlighted');
                                    });
                                    button.classList.add('highlighted');
                                    document.getElementById('appTime').value = button.value;
                                });
                            });
                        </script> -->

                        <!-- <script>
                            function clearErrorAppointment() {
                                var date = document.getElementById("appDate").value;
                                var time = document.getElementById("appTime").value;

                                if (date != "") {
                                    document.getElementById("appDate_err").innerHTML = "";
                                }
                                if (time != "") {
                                    document.getElementById("appTime_err").innerHTML = "";
                                }
                            }

                            function validateAppointment() {

                                var date = document.getElementById("appDate").value;
                                var time = document.getElementById("appTime").value;

                                if (date == "") {
                                    document.getElementById("appDate_err").innerHTML = "Date must be filled out.";
                                    document.getElementById("appDate").focus();
                                    return false;
                                } else {
                                    var selectedDate = new Date(date);
                                    var today = new Date();

                                    today.setHours(0, 0, 0, 0);

                                    if (selectedDate < today) {
                                        document.getElementById("appDate_err").innerHTML = "Date must be today or later.";
                                        document.getElementById("appDate").focus();
                                        return false;
                                    } else {
                                        document.getElementById("appDate_err").innerHTML = "";
                                    }
                                }
                                if (time == "") {
                                    document.getElementById("appTime_err").innerHTML = "Time must be filled out.";
                                    document.getElementById("appTime").focus();
                                    return false;
                                } else {
                                    document.getElementById("appTime_err").innerHTML = "";
                                }
                                return true;
                            }
                        </script> -->
                        <!---End------------>

            <?php
        } else if ($method == "appointmentReschedule") {
            ?>
                            <section>
                                <div class="card rounded">
                                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                        <p style="font-size: 24px; font-weight: 500">Reschedule Appoitment</p>
                                        <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="card-body px-md-4 pb-4">
                                        <div>
                                            <div class="col-md-8">
                                    <?php
                                    foreach ($updateAppDetails as $key => $value) {
                                        ?>
                                                    <form action="<?php echo base_url() . "Healthcareprovider/updateAppointmentForm" ?>"
                                                        method="POST" name="patientDetails" onsubmit="return validateAppointment()"
                                                        oninput="clearErrorAppointment()">
                                                        <input type="hidden" id="appTableId" name="appTableId"
                                                            value="<?php echo $value['id'] ?>">
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="patientId">Patient Id</label>
                                                            <input type="text" class="form-control" name="patientId" id="patientId"
                                                                value="<?php echo $value['patientId'] ?>" disabled
                                                                onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;'">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="referalDoctor">Referal Doctor ID</label>
                                                            <input type="text" class="form-control" id="referalDoctor" name="referalDoctor"
                                                                value="<?php
                                                                echo (empty($value['referalDoctor']) || $value['referalDoctor'] === 'Nil')
                                                                    ? 'NA'
                                                                    : htmlspecialchars($value['referalDoctor'], ENT_QUOTES, 'UTF-8');
                                                                ?>" disabled onmouseover="style='cursor: no-drop;'"
                                                                onmouseout="style='cursor: ns-resize;">
                                                        </div>
                                                        <!-- <div class="form-group pb-3">
                                                            <label class="form-label pb-2" for="appConsult">Mode of consult</label><br>
                                                            <input type="radio" id="audio" name="appConsult" value="audio" checked>
                                                            <label for="audio">Audio</label>
                                                            <input type="radio" class="ms-5 ps-5" id="video" name="appConsult" value="video">
                                                            <label for="video">Video</label><br>
                                                        </div> -->

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
                                                                onchange="adjustTimeOptions()">
                                                                <option id="placeholderOption" value="" style="display: none;">Select part
                                                                    of the day</option>
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

                                                        <div class="py-2" id="morningTime" style="display:none">
                                                            <i class="bi bi-brightness-alt-high"></i>, Morning Consult time,<br>
                                            <?php foreach ($morning as $time): ?>
                                                                <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                    value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                                </button>
                                            <?php endforeach; ?>
                                                        </div>

                                                        <div class="py-2" id="afternoonTime" style="display:none">
                                                            <i class="bi bi-sun"></i>, Afternoon Consult time,<br>
                                            <?php foreach ($afternoon as $time): ?>
                                                                <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                    value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                                </button>
                                            <?php endforeach; ?>
                                                        </div>

                                                        <div class="py-2" id="eveningTime" style="display:none">
                                                            <i class="bi bi-brightness-alt-high"></i>, Evening Consult time,<br>
                                            <?php foreach ($evening as $time): ?>
                                                                <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                    value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                                </button>
                                            <?php endforeach; ?>
                                                        </div>

                                                        <div class="py-2" id="nightTime" style="display:none">
                                                            <i class="bi bi-moon-stars"></i>, Night Consult time,<br>
                                            <?php foreach ($night as $time): ?>
                                                                <button type="button" class="timeButton btn btn-outline-secondary my-1"
                                                                    value="<?php echo $time['time']; ?>">
                                                    <?php echo date('h:i A', strtotime($time['time'])); ?>
                                                                </button>
                                            <?php endforeach; ?>
                                                        </div>

                                                        <div class="form-group py-3">
                                                            <label class="form-label" for="appReason">Complaint</label>
                                                            <input type="text" class="form-control" id="appReason" name="appReason"
                                                                value="<?php echo $value['patientComplaint'] != '' ? $value['patientComplaint'] : "-"; ?>"
                                                                disabled onmouseover="style='cursor: no-drop;'"
                                                                onmouseout="style='cursor: ns-resize;">
                                                        </div>

                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="pay">Payment Status</label>
                                                            <input type="text" class="form-control" id="pay" name="pay" value="Paid" disabled
                                                                onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                            <button type="submit" id="ReSubmit" class="btn text-light"
                                                                style="background-color: #00ad8e;">Submit</button>
                                                        </div>
                                                    </form>
                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Book Reschedule appointment date handling, submition, ect.. -->
                            <script>
                                var appBookedDetails = <?php echo json_encode($appBookedDetails); ?>;
                                const referalCc = document.getElementById('referalDoctor').value;

                                function adjustTimeOptions() {
                                    const selectedDate = document.getElementById('appDate').value;
                                    const parts = referalCc ? referalCc.split('|') : [];
                                    const referalCcId = parts.length > 0 ? parts[0] : null;
                                    const timeButtons = document.querySelectorAll('.timeButton');
                                    var currentHcpId = "<?php echo $_SESSION['hcpIdDb']; ?>";
                                    timeButtons.forEach(button => {
                                        button.disabled = false;
                                        button.classList.add('btn-outline-secondary');
                                        button.classList.remove('btn-secondary');
                                        button.style.fontSize = '16px';
                                        button.innerHTML = button.textContent.replace(' Booked', '');
                                    });

                                    appBookedDetails.forEach(appointment => {
                                        const bookedDate = formatDate(appointment.dateOfAppoint);
                                        const bookedTime = appointment.timeOfAppoint;
                                        const bookedCcDoctor = appointment.referalDoctor;
                                        const bookedHcpId = appointment.hcpDbId;

                                        if ((bookedDate === selectedDate && referalCcId !== '' && bookedCcDoctor === referalCcId)) {

                                            timeButtons.forEach(button => {
                                                if (button.value === bookedTime) {
                                                    button.disabled = true;
                                                    button.classList.add('btn-secondary');
                                                    button.classList.remove('btn-outline-secondary');
                                                    button.style.fontSize = '12px';
                                                    const time = button.textContent;
                                                    const booked = ' Booked';
                                                    if (!button.innerHTML.includes(booked)) {
                                                        button.innerHTML = time + booked;
                                                    }
                                                }
                                            });
                                        }

                                        if ((bookedDate === selectedDate && bookedHcpId === currentHcpId)) {
                                            timeButtons.forEach(button => {
                                                if (button.value === bookedTime) {
                                                    button.disabled = true;
                                                    button.classList.add('btn-secondary');
                                                    button.classList.remove('btn-outline-secondary');
                                                    button.style.fontSize = '12px';
                                                    const time = button.textContent;
                                                    const booked = ' Booked';
                                                    if (!button.innerHTML.includes(booked)) {
                                                        button.innerHTML = time + booked;
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }

                                function formatDate(dateString) {
                                    const date = new Date(dateString);
                                    const yyyy = date.getFullYear();
                                    const mm = String(date.getMonth() + 1).padStart(2, '0');
                                    const dd = String(date.getDate()).padStart(2, '0');
                                    return `${yyyy}-${mm}-${dd}`;
                                }

                                var dateInput = document.getElementById('appDate');
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                var yyyy = today.getFullYear();
                                var minDate = yyyy + '-' + mm + '-' + dd;
                                dateInput.setAttribute('min', minDate);

                                function displayTime() {
                                    var dayTime = document.getElementById("dayTime").value;
                                    var morningTime = document.getElementById("morningTime");
                                    var afternoonTime = document.getElementById("afternoonTime");
                                    var eveningTime = document.getElementById("eveningTime");
                                    var nightTime = document.getElementById("nightTime");

                                    morningTime.style.display = "none";
                                    afternoonTime.style.display = "none";
                                    eveningTime.style.display = "none";
                                    nightTime.style.display = "none";

                                    if (dayTime === 'Morning') {
                                        morningTime.style.display = "block";
                                    } else if (dayTime === 'Afternoon') {
                                        afternoonTime.style.display = "block";
                                    } else if (dayTime === 'Evening') {
                                        eveningTime.style.display = "block";
                                    } else if (dayTime === 'Night') {
                                        nightTime.style.display = "block";
                                    }

                                    adjustTimeOptions();
                                }
                                function showAllOptions() {
                                    const select = document.getElementById('dayTime');
                                    if (!select) return;
                                    const options = select.options;
                                    for (let i = 0; i < options.length; i++) {
                                        options[i].style.display = 'block';
                                        options[i].disabled = false;
                                        options[i].hidden = false;
                                    }
                                }

                                function hideOption(value) {
                                    const select = document.getElementById('dayTime');
                                    if (!select) return;
                                    const options = select.options;
                                    for (let i = 0; i < options.length; i++) {
                                        if (options[i].value === value) {
                                            options[i].style.display = 'none';
                                            options[i].disabled = true;
                                            options[i].hidden = true;
                                            if (select.value === value) {
                                                select.value = "";
                                            }
                                        }
                                    }
                                }

                                function adjustTimeOptionsBasedOnCurrentTime() {
                                    const dateInput = document.getElementById('appDate').value;
                                    if (!dateInput) return;

                                    const now = new Date();
                                    const yyyy = now.getFullYear();
                                    const mm = String(now.getMonth() + 1).padStart(2, '0');
                                    const dd = String(now.getDate()).padStart(2, '0');
                                    const todayStr = `${yyyy}-${mm}-${dd}`;

                                    showAllOptions();

                                    if (dateInput === todayStr) {
                                        const currentHour = now.getHours();
                                        if (currentHour >= 4) {
                                            hideOption('Morning');
                                        }
                                        if (currentHour >= 9) {
                                            hideOption('Afternoon');
                                        }
                                        if (currentHour >= 15) {
                                            hideOption('Evening');
                                        }
                                        if (currentHour >= 18) {
                                            hideOption('Night');
                                        }
                                        displayTime();
                                    }
                                }
                                window.onload = function () {
                                    var selectElement = document.getElementById('dayTime');
                                    if (selectElement) {
                                        selectElement.addEventListener('change', function () {
                                            displayTime();
                                        });
                                    }

                                    var dateInputElement = document.getElementById('appDate');
                                    if (dateInputElement) {
                                        dateInputElement.addEventListener('change', function () {
                                            adjustTimeOptionsBasedOnCurrentTime();
                                            adjustTimeOptions();
                                        });
                                    }

                                    const submitBtn = document.getElementById('ReSubmit');
                                    if (submitBtn) {
                                        const form = submitBtn.closest('form');
                                        if (form) {
                                            form.addEventListener('submit', function (event) {
                                                if (!validateAppointment()) {
                                                    event.preventDefault();
                                                    return;
                                                }
                                                submitBtn.disabled = true;
                                                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
                                            });
                                        }
                                    }

                                    if (typeof adjustTimeOptionsBasedOnCurrentTime === "function") {
                                        adjustTimeOptionsBasedOnCurrentTime();
                                    }
                                    adjustTimeOptions();
                                };
                            </script>

                            <!-- highlight the time buttons -->
                            <script>
                                var buttons = document.querySelectorAll('.timeButton');
                                buttons.forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        buttons.forEach(function (btn) {
                                            btn.classList.remove('highlighted');
                                        });
                                        button.classList.add('highlighted');
                                        document.getElementById('appTime').value = button.value;
                                    });
                                });
                            </script>

                            <!-- validation Check  -->
                            <script>
                                function clearErrorAppointment() {
                                    var date = document.getElementById("appDate").value;
                                    var dayTime = document.getElementById("dayTime").value;
                                    var time = document.getElementById("appTime").value;

                                    if (date != "") {
                                        document.getElementById("appDate_err").innerHTML = "";
                                    }
                                    if (dayTime != "") {
                                        document.getElementById("dayTime_err").innerHTML = "";
                                    }
                                    if (time != "") {
                                        document.getElementById("appTime_err").innerHTML = "";
                                    }
                                }

                                function validateAppointment() {
                                    var date = document.getElementById("appDate").value;
                                    var dayTime = document.getElementById("dayTime").value;
                                    var time = document.getElementById("appTime").value;

                                    if (date == "") {
                                        document.getElementById("appDate_err").innerHTML = "Please fill the date.";
                                        document.getElementById("appDate").focus();
                                        return false;
                                    } else {
                                        document.getElementById("appDate_err").innerHTML = "";
                                    }

                                    if (dayTime == "") {
                                        document.getElementById("dayTime_err").innerHTML = "Please select part of day";
                                        document.getElementById("dayTime").focus();
                                        return false;
                                    } else {
                                        document.getElementById("dayTime_err").innerHTML = "";
                                    }

                                    if (time == "") {
                                        document.getElementById("appTime_err").innerHTML = "Please select the time.";
                                        document.getElementById("appTime").focus();
                                        return false;
                                    } else {
                                        document.getElementById("appTime_err").innerHTML = "";
                                    }

                                    return true;
                                }
                            </script>
            <?php


        } else if ($method == "chiefDoctors") {
            ?>
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

                <?php if (isset($ccDetails[0]['id'])) { ?>

                                        <div class="container">
                                            <div class="row justify-content-center" id="doctorContainer">
                                            </div>

                                            <div class="pagination justify-content-center mt-3" id="paginationContainer">
                                            </div>
                                        </div>
                <?php } else { ?>
                                        <h5 class="card text-center p-3"><b>No Records Found.</b> </h5>
                <?php } ?>
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
                                            noMatchesDiv.innerHTML = '<p>No matches found.</p>';
                                            doctorContainer.appendChild(noMatchesDiv);
                                        } else {
                                            itemsToShow.forEach(value => {
                                                const doctorItem = document.createElement('div');
                                                doctorItem.className = 'card col-lg-4 m-3 chief-doctor-item';
                                                doctorItem.innerHTML =
                                                    '<div class=\'d-sm-flex justify-content-evenly text-center p-4\'>' +
                                                    '<img src="' + (value.ccPhoto ? '<?php echo base_url(); ?>uploads/' + value.ccPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg') +
                                                    'alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto" ' +
                                                    'onerror="this.onerror=null;this.src=\'<?php echo base_url(); ?>assets/BlankProfile.jpg\';">' +
                                                    '<div>' +
                                                    '<p class=\'card-title\'><b>' + value.doctorName + '</b> /<br>' + value.ccId + '</p>' +
                                                    '<p style=\'color: #00ad8e;\'><b>' + value.specialization + '</b></p>' +
                                                    '<a href=\'<?php echo base_url(); ?>Healthcareprovider/chiefDoctorsProfile/' + value.id + '\' ' +
                                                    'class=\'btn btn-secondary\'>Full Details</a>' +
                                                    '</div>' +
                                                    '</div>';
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
                                        prevLi.innerHTML =
                                            '<a href=\'#\'>' +
                                            '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === 1 ? 'disabled' : '') + '>&lt;</button>' +
                                            '</a>';
                                        prevLi.onclick = () => {
                                            if (currentPage > 1) displayPage(currentPage - 1);
                                        };
                                        ul.appendChild(prevLi);

                                        for (let i = 1; i <= totalPages; i++) {
                                            const li = document.createElement('li');
                                            li.innerHTML =
                                                '<a href=\'#\'>' +
                                                '<button type=\'button\' class=\'btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '\'>' + i + '</button>' +
                                                '</a>';
                                            li.onclick = () => displayPage(i);
                                            ul.appendChild(li);
                                        }

                                        const nextLi = document.createElement('li');
                                        nextLi.innerHTML =
                                            '<a href=\'#\'>' +
                                            '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === totalPages ? 'disabled' : '') + '>&gt;</button>' +
                                            '</a>';
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
                                                            <img src="<?php echo base_url('uploads/' . $value['ccPhoto']); ?>" alt="Profile Photo"
                                                                width="140" height="140" class="rounded-circle"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfile.jpg'); ?>';">
                                <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                height="140" class="rounded-circle my-auto">
                                <?php } ?>
                                                        <div class="ps-sm-5">
                                                            <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['doctorName']; ?>
                                                            </p>
                                                            <p style="font-size:16px;font-weight:400;color:#00ad8e;">
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

                                                     <p class="my-3 fs-5 fw-semibold">Profile Details</p>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Years of Experience : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['yearOfExperience'] ? $value['yearOfExperience'] : "-"; ?>
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

                                                </div>
                    <?php } ?>
                                        </div>
                                    </section>

            <?php
        } else if ($method == "myProfile") {
            ?>
                                        <section>
                                            <div class="card rounded">
                                                <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                    <p style="font-size: 24px; font-weight: 500"> My Profile</p>
                                                    <a href="<?php echo base_url() . "Healthcareprovider/dashboard" ?>"
                                                        class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
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
                                                            <p class="my-3 fs-5 fw-semibold">Profile Details :</p>
                                                            <a href="<?php echo base_url() . "Healthcareprovider/editMyProfile" ?>"><i
                                                                    class="bi bi-pencil-square"></i> Edit</a>
                                                        </div>

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

                        <?php } ?>
                                                </div>
                                            </div>
                                        </section>

            <?php
        } else if ($method == "editMyProfile") {
            ?>
                                            <section>
                                                <div class="card rounded">
                                                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                        <p style="font-size: 24px; font-weight: 500"> Edit Profile Details</p>
                                                        <a href="<?php echo base_url() . "Healthcareprovider/myProfile" ?>"
                                                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                                                    </div>
                                                    <div class="card-body ps-3 p-sm-4">
                            <?php
                            foreach ($hcpDetails as $key => $value) {
                                ?>
                                                            <form action="<?php echo base_url() . "Healthcareprovider/updateMyProfile" ?>"
                                                                name="profileEditForm" name="profileEditForm" enctype="multipart/form-data" method="POST"
                                                                onsubmit="return validateDetails()" oninput="clearErrorDetails()" class="">
                                                                <div class="position-relative">
                                                                    <img id="previewImage"
                                                                        src="<?= isset($value['hcpPhoto']) && $value['hcpPhoto'] !== "No data"
                                                                            ? base_url('uploads/' . $value['hcpPhoto'])
                                                                            : base_url('assets/img/BlankProfileCircle.png') ?>"
                                                                        alt="Profile Photo" width="150" height="150" class="rounded-circle d-block mx-auto mb-4"
                                                                        style="box-shadow: 0px 4px 4px rgba(5, 149, 123, 0.7); outline: 1px solid white;"
                                                                        onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                                                    <input type="file" id="profilePhoto" name="profilePhoto"
                                                                        class="fieldStyle form-control p-3 image-input d-none" accept=".png, .jpg, .jpeg">
                                                                    <a href="#" class="position-absolute rounded-circle px-2 py-1"
                                                                        style="color: #00ad8e;border: 2px solid #00ad8e;border-radius: 50%;top: 77%; left: 52%; transform: translateX(44%); "
                                                                        onclick="document.getElementById('profilePhoto').click();"><i
                                                                            class="bi bi-camera"></i></a>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="drName">Full Name</label>
                                                                        <input type="text" class="form-control" id="drName" name="drName"
                                                                            value="<?php echo $value['hcpName']; ?>" placeholder="E.g. Suresh Kumar"
                                                                            style="cursor: no-drop;" disabled readonly>
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label" for="drMobile">Mobile Number</label>
                                                                        <input type="number" class="form-control" id="drMobile" name="drMobile"
                                                                            value="<?php echo $value['hcpMobile']; ?>" placeholder="E.g. 9632587410"
                                                                            style="cursor: no-drop;" disabled readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="drEmail">Email Id</label>
                                                                        <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                            value="<?php echo $value['hcpMail']; ?>" placeholder="E.g. example@gmail.com"
                                                                            style="cursor: no-drop;" disabled readonly>
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label" for="specialization">Specialization</label>
                                                                        <select class="form-control" id="specialization" name="specialization"
                                                                            style="cursor: no-drop;" disabled readonly>
                                                                            <option value="" selected><?php echo $value['hcpSpecialization'] ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="yearOfExp">Years of Experience</label>
                                                                        <input type="text" class="form-control" id="yearOfExp" name="yearOfExp" maxlength="25"
                                                                            value="<?php echo $value['hcpExperience']; ?>" placeholder="E.g. 25">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label" for="qualification">Qualification</label>
                                                                        <input type="text" class="form-control" id="qualification" name="qualification"
                                                                            value="<?php echo $value['hcpQualification']; ?>" maxlength="90"
                                                                            placeholder="E.g. MBBS">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="dob">Date of Birth</label>
                                                                        <input type="date" class="form-control" id="dob" name="dob"
                                                                            value="<?php echo $value['hcpDob']; ?>">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label" for="hospitalName">Hospital / Clinic Name</label>
                                                                        <input type="text" class="form-control" id="hospitalName" name="hospitalName"
                                                                            maxlength="90" value="<?php echo $value['hcpHospitalName']; ?>"
                                                                            placeholder="E.g. MMCH">
                                                                        <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="location">Location</label>
                                                                        <input type="text" class="form-control" id="location" name="location" maxlength="90"
                                                                            value="<?php echo $value['hcpLocation']; ?>" placeholder="E.g. Erode">
                                                                        <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label">Password</label><br>
                                                                        <a href="<?php echo base_url('Healthcareprovider/changePassword'); ?>"
                                                                            class="btn text-light" style="background-color: #00ad8e;">
                                                                            Change Password</a>
                                                                    </div>
                                                                </div>
                                                                <button type="reset" class="btn btn-secondary float-start mt-3">Reset</button>
                                                                <button type="submit" class="btn float-end mt-3"
                                                                    style="color: white;background-color: #00ad8e;">Update</button>
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
                                                    //     document.getElementById("profilePhoto_err").innerHTML = "";   // }
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
                                                    // // if (photo == "") {
                                                    //     document.getElementById("profilePhoto_err").innerHTML = "Photo must be uploaded.";
                                                    //     document.getElementById("profilePhoto").focus();
                                                    //     return false;                 // } else {
                                                    //     document.getElementById("profilePhoto_err").innerHTML = "";
                                                    // }
                                                }
                                            </script>

            <?php
        } else if ($method == "passwordChange") {
            ?>
                                                <section>
                                                    <div class="card rounded m-md-2">
                                                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                            <p style="font-size: 24px; font-weight: 500"> Change Password</p>
                                                            <a href="<?php echo base_url() . "Healthcareprovider/myProfile" ?>"
                                                                class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                                                        </div>
                                                        <div class="card-body">
                            <?php
                            foreach ($hcpDetails as $key => $value) {
                                ?>
                                                                <form action="<?php echo base_url() . "Healthcareprovider/saveNewPassword" ?>" name="PasswordForm"
                                                                    method="POST" class="px-md-3" onsubmit="return validateNewPassword()"
                                                                    oninput="validateNewPassword()">
                                                                    <input type="hidden" name="hcpDbId" id="hcpDbId" value="<?php echo $value['id']; ?>">
                                                                    <div class="d-md-flex justify-content-between pb-3">
                                                                        <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                            <label class="form-label pb-2" for="drName">Full Name</label>
                                                                            <input type="text" class="form-control" id="drName" name="drName"
                                                                                style="cursor: no-drop;" value="<?php echo $value['hcpName']; ?>"
                                                                                placeholder="Suresh Kumar" disabled readonly>
                                                                        </div>
                                                                        <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                            <label class="form-label pb-2" for="drMobile">Mobile Number </label>
                                                                            <input type="text" class="form-control" id="drMobile" name="drMobile"
                                                                                style="cursor: no-drop;" value="<?php echo $value['hcpMobile']; ?>"
                                                                                placeholder="9632587410" disabled readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-flex justify-content-between pt-3">
                                                                        <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                            <label class="form-label pb-2" for="drEmail">Email Id</label>
                                                                            <div class="">
                                                                                <input type="email" class="form-control" id="drEmail" name="drEmail"
                                                                                    style="cursor: no-drop;" value="<?php echo $value['hcpMail']; ?>"
                                                                                    placeholder="example@gmail.com" disabled readonly>
                                                                            </div>
                                                                            <p type="button" class="float-end mt-2 m-0 p-0" style="color: #00ad8e;"
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
                                                                                <input type="password" class="form-control" id="drNewPassword" maxlength="20"
                                                                                    name="drNewPassword" placeholder="Enter New Password">
                                                                                <i class="bi bi-eye-fill" onclick="togglePasswordVisibility('drNewPassword', this)"
                                                                                    style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                                            </div>
                                                                            <small id="passwordError" class="text-danger"></small>
                                                                        </div>
                                                                        <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                            <label class="form-label pb-2" for="drCnfmPassword">Confirm Password <span
                                                                                    class="text-danger">*</span></label>
                                                                            <div style="position: relative;">
                                                                                <input type="password" class="form-control" id="drCnfmPassword" maxlength="20"
                                                                                    name="drCnfmPassword" placeholder="Re-Enter New Password">
                                                                                <i class="bi bi-eye-fill" onclick="togglePasswordVisibility('drCnfmPassword', this)"
                                                                                    style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                                            </div>
                                                                            <small id="confirmPasswordError" class="text-danger"></small>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn float-end mt-3"
                                                                        style="color: white;background-color: #00ad8e;">Save</button>
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

                                                        fetch("<?= base_url('Healthcareprovider/sendEmailOtp') ?>", {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/x-www-form-urlencoded"
                                                            },
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
                                                            fetch("<?= base_url('Healthcareprovider/verifyEmailOtp') ?>", {
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
                                                            document.getElementById("passwordError").textContent = "Please enter a new password.";
                                                            isValid = false;
                                                        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(password)) {
                                                            document.getElementById("passwordError").textContent = "Please enter a valid password (8 to 20 characters with at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character).";
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
            <?php
        } ?>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

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
                            <a href="<?php echo base_url('Healthcareprovider/changePassword'); ?>"
                                class="btn text-light" style="background-color: #00ad8e;">Update
                                Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        <?php if ($method == "dashboard") { ?>
            document.getElementById('dashboard').style.color = "#87F7E3";
        <?php } elseif ($method == "appointments" || $method == "appointmentsForm" || $method == "appointmentUpdate" || $method == "appointmentReschedule") { ?>
            document.getElementById('appointments').style.color = "#87F7E3";
        <?php } elseif ($method == "chiefDoctors" || $method == "chiefDoctorProfile") { ?>
            document.getElementById('chiefDoctor').style.color = "#87F7E3";
        <?php } ?>
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