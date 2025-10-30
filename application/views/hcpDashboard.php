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
                <p class=" card ps-3 py-3" style="font-size: 24px; font-weight: 500">
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
                                    Appointments Count
                                </p>
                                <p style="font-size: 30px; font-weight: 400; color: #00ad8e">
                                    <?php echo $appointmentsTotal; ?>
                                </p>
                                <p style="font-size: 16px">
                                    <?php echo date("d-m-Y") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-lg-flex justify-content-evenly">
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
                                                            <?php echo $appointmentList[0]['patientComplaint']; ?></span>
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
                                                            <?php echo $appointmentList[1]['patientComplaint']; ?></span>
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
                                                            <?php echo $appointmentList[2]['patientComplaint']; ?></span>
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
                                                <!-- <th scope="col-4" style="font-size: 16px; font-weight: 600" class="px-5">
                                                    Height
                                                </th> -->
                                                <th scope="col-6" style="font-size: 16px; font-weight: 600">
                                                    Referal Doctor
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['patientComplaint']; ?></span>
                                                </td>
                                                <!-- <td class="px-5">
                                                    <span style="font-size: 16px; font-weight: 400">172cm</span>
                                                </td> -->
                                                <td>
                                                    <span
                                                        style="font-size: 16px; font-weight: 400"><?php echo $appointmentList[0]['referalDoctor']; ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <p style="font-size: 16px; font-weight: 500; color: #00ad8e">
                                    Patient History
                                </p>
                                <p style="font-size: 16px;font-weight: 400;background-color: #e9eeed;padding: 10px;">
                                    Diabetes - Health care
                                </p> -->
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
                                <!-- <a href="#" class="text-decoration-underline">Last Appointment</a> -->
                                <?php if ($appointmentList[0]['lastAppDate'] != "") { ?>
                                    <p>Last Appointment Date - <?php echo $appointmentList[0]['lastAppDate']; ?></p>
                                <?php }
                            } else { ?>
                                <p class="m-md-5 px-md-5"><b> No Appointments Today.</b></p>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </section>

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

                        <?php
                        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                        $items_per_page = 10;

                        $total_items = count($appointmentList);
                        $total_pages = ceil($total_items / $items_per_page);

                        $offset = ($current_page - 1) * $items_per_page;

                        $current_page_items = array_slice($appointmentList, $offset, $items_per_page);

                        if (isset($appointmentList[0]['id'])) {
                            ?>

                            <div class="card-body p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table text-center table-hoverr" id="appointmentTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PATIENT ID
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">DATE</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">TIME</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">CC ID</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PURPOSE
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
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
                                                    <td style="font-size: 16px" class="pt-3">
                                                        <a href="<?php echo base_url() . "Healthcareprovider/patientdetails/" . $value['patientDbId']; ?>"
                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['patientId'] ?>
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                        <?php
                                                        if (date('Y-m-d', strtotime($value['dateOfAppoint'])) == date('Y-m-d')) {
                                                            echo "<b>Today</b>";
                                                        } else {
                                                            echo date("d-m-Y", strtotime($value['dateOfAppoint']));
                                                        } ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                    <?php echo date('h:i a', strtotime($value['timeOfAppoint'])); ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                        <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctorsProfile/" . $value['referalDoctorDbId']; ?>"
                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['referalDoctor'] ?>
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3"><?php echo $value['patientComplaint'] ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="d-flex d-lg-block">
                                                        <!-- <a href="#" class="ps-2"><i class="bi bi-three-dots-vertical"></i></a> -->
                                                        <?php
                                                        date_default_timezone_set('Asia/Kolkata');

                                                        $dateOfAppoint = $value['dateOfAppoint'];
                                                        $timeOfAppoint = $value['timeOfAppoint'];

                                                        $today = date('Y-m-d');
                                                        $currentTime = date('H:i:s');

                                                        $appointmentDateTime = strtotime("$dateOfAppoint $timeOfAppoint");
                                                        $currentDateTime = strtotime("$today $currentTime");

                                                        $isToday = ($dateOfAppoint == $today);

                                                        $isWithin10Minutes = ($currentDateTime <= strtotime('+10 minutes', $appointmentDateTime)) &&
                                                            ($currentDateTime >= $appointmentDateTime);
                                                        $shouldEnableButton = $isToday && $isWithin10Minutes;

                                                        if ($shouldEnableButton) { ?>
                                                            <a
                                                                href="<?php echo base_url() . "Healthcareprovider/consultation/" . $value['patientDbId'] ?>">
                                                                <button class="btn btn-secondary">Consult</button>
                                                            </a>
                                                            <a href="<?php echo $value['appointmentLink']; ?>" target="_blank">
                                                                <button class="btn btn-success">Join</button>
                                                            </a>
                                                    <?php } else { ?>
                                                            <a
                                                                href="<?php echo base_url() . "Healthcareprovider/appointmentUpdate/" . $value['id'] ?>">
                                                                <button class="btn btn-secondary">Edit</button> </a>
                                                            <button class="btn btn-secondary" disabled>Summary</button>
                                                            <button class="btn btn-success" disabled>Join</button>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>

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
                                                <li class=" ">
                                                    <a href="?page=<?php echo $i; ?>">
                                                        <button type="button"
                                                            class="btn border px-3 py-2 <?php echo ($i == $current_page) ? 'btn-secondary text-light' : " "; ?>">
                                                        <?php echo $i; ?></button>
                                                    </a>
                                                </li>
                                        <?php endfor; ?>

                                        <?php if ($current_page < $total_pages): ?>
                                                <li class="page-item">
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
                    </div>

                <?php if (isset($appointmentReschedule[0]['id'])) { ?>

                        <div class="card rounded">
                            <div class="mt-2 p-2 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500">
                                    Reschedule Appointments
                                </p>
                            </div>

                            <div class="card-body p-2 p-sm-4">
                                <div class="table-responsive">
                                    <table class="table table-hoverr text-center" id="appointmentReschedule">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">S.NO</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PATIENT ID
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">DATE</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">TIME</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">CC ID</th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">PURPOSE
                                                </th>
                                                <th scope="col" style="font-size: 16px; font-weight: 500; color: #00ad8e">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $serial = 0;
                                            foreach ($appointmentReschedule as $key => $value) {
                                                $serial++;
                                                ?>
                                                <tr>
                                                    <td class="pt-3"><?php echo $serial; ?>. </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                        <a href="<?php echo base_url() . "Healthcareprovider/patientdetails/" . $value['patientDbId']; ?>"
                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['patientId'] ?>
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                    <?php echo date("d-m-Y", strtotime($value['dateOfAppoint'])) ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                    <?php echo date('h:i a', strtotime($value['timeOfAppoint'])); ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3">
                                                        <a href="<?php echo base_url() . "Healthcareprovider/chiefDoctorsProfile/" . $value['referalDoctorDbId']; ?>"
                                                            class="text-dark" onmouseover="style='text-decoration:underline'"
                                                            onmouseout="style='text-decoration:none'">
                                                        <?php echo $value['referalDoctor'] ?>
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 16px" class="pt-3"><?php echo $value['patientComplaint'] ?>
                                                    </td>
                                                    <td style="font-size: 16px" class="">
                                                        <a href="<?php echo base_url() . "Healthcareprovider/appointmentReschedule/" . $value['id'] ?>"
                                                            class="btn btn-secondary mx-1">Reschedule</a>
                                                        <a href="#" class="btn btn-danger" disabled>Refund</a>
                                                    </td>

                                                </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                </section>

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
                                            <div>
                                                <!-- Old Id select -->
                                                <!-- <div class="form-group pb-2">
                                                    <label class="form-label" for="patientId">Patient Id <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="patientId" id="patientId">
                                                        <option value="">Select Patient Id</option>
                                                    <?php
                                                    foreach ($patientsId as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo $value['patientId'] . '|' . $value['id'] ?>">
                                                        <?php echo $value['patientId'] . " / " . $value['firstName'] . " " . $value['lastName'] ?>
                                                            </option>
                                                    <?php } ?>
                                                        <option value="new">+ Add New Patient</option>
                                                    </select>
                                                    <div id="patientId_err" class="text-danger pt-1"></div>
                                                </div> -->
                                                        <!-- Old Id select End -->
                                                <div class="form-group pb-2">
                                                    <label class="form-label" for="patientId">
                                                        Patient Id <span class="text-danger">*</span>
                                                    </label>

                                                    <!-- Search + Add button on the SAME line -->
                                                    <div class="input-group mb-1">
                                                        <input type="text" class="form-control" placeholder="Search patient Id / Name"
                                                            id="patientSearch" autocomplete="off">
                                                        <span class="input-group-text bg-white border-start-0">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <button class="btn btn-outline-primary d-flex align-items-center"
                                                                type="button" id="addPatientBtn" title="Add New Patient">
                                                            <i class="bi bi-plus-lg me-1"></i> Add Patient
                                                        </button>
                                                    </div>
                                                        <!-- SELECT – we give it a data-attribute so JS can find the original options -->
                                                        <select class="form-select" name="patientId" id="patientId">
                                                            <?php foreach ($patientsId as $value): ?>
                                                                <option value="<?php echo htmlspecialchars($value['patientId'] . '|' . $value['id']); ?>">
                                                                    <?php echo htmlspecialchars($value['patientId'] . " / " . $value['firstName'] . " " . $value['lastName']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <div id="patientId_err" class="text-danger pt-1"></div>
                                                 </div>                                                
                                                    
                                                    <!-- Add New patient -->
                                                <!-- <div id="newPatientFields" class="border p-3 mt-2 rounded d-none bg-light">
                                                    <h6>Add New Patient</h6>
                                                    <div class="form-group pb-2">
                                                        <label>First Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="newFirstName" id="newFirstName"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group pb-2">
                                                        <label>Mobile <span class="text-danger">*</span></label>
                                                        <input type="text" name="newMobile" id="newMobile" class="form-control">
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-success mt-2"
                                                        onclick="saveNewPatient()">Save Patient</button>
                                                    <div id="newPatientStatus" class="text-success mt-2"></div>
                                                </div> -->
                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="referalDoctor">Referal Doctor ID <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="referalDoctor" id="referalDoctor"
                                                        oninput="adjustTimeOptions()">
                                                        <option value="">Select Chief Consultant Id</option>
                                                    <?php
                                                    foreach ($ccsId as $key => $value) {
                                                        ?>
                                                            <option
                                                                value="<?php echo $value['ccId'] . '|' . $value['id'] . '|' . $value['gMeetLink'] ?>">
                                                        <?php echo $value['ccId'] ?> / <?php echo $value['doctorName'] ?>
                                                            </option>
                                                <?php } ?>
                                                    </select>
                                                    <div id="referalDoctor_err" class="text-danger pt-1"></div>
                                                </div>

                                                <div class="form-group pb-3">
                                                    <label class="form-label pb-2" for="appConsult">Mode of consult <span
                                                            class="text-danger">*</span></label><br>
                                                    <input type="radio" id="audio" name="appConsult" value="audio" checked>
                                                    <label for="audio">Audio</label>
                                                    <input type="radio" class="ms-5 ps-5" id="video" name="appConsult"
                                                        value="video">
                                                    <label for="video">Video</label><br>
                                                    <div id="appConsult_err" class="text-danger pt-1"></div>
                                                </div>

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
                                                    <label class="form-label" for="appReason">Patient's Complaint / Symptoms<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="appReason" name="appReason" readonly class="form-control"
                                                        hidden>
                                                    <div class="selected-values-container mb-2 p-2" id="selectedValuesContainer">
                                                    </div>
                                                    <select class="form-select" id="multiSelectSymptoms">
                                                        <option value="" selected disabled>Select Symptoms</option>
                                                    <?php
                                                    $count = 0;
                                                    foreach ($symptomsList as $key => $value) {
                                                        $count++;
                                                        ?>
                                                            <option value="<?php echo $value['symptomsName'] ?>">
                                                        <?php echo $count . '. ' . $value['symptomsName'] ?>
                                                            </option>

                                                <?php } ?>
                                                    </select>
                                                    <div id="appReason_err" class="text-danger pt-1"></div>
                                                </div>
                                                <!-- Payment -->
                                                <div class="form-group pb-3">
                                                    <label class="form-label" for="pay">Payment <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="pay" name="pay"
                                                        placeholder="E.g. Add payment details">
                                                </div>

                                                <button type="submit" class="btn text-light float-end mt-2"
                                                    style="background-color: #00ad8e;">Confirm </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Modal for add new patient -->
                    <div class="modal fade" id="newPatientModal" tabindex="-1" aria-labelledby="newPatientModalLabel"
                        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <input type="hidden" id="newPatientResult" value="">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newPatientModalLabel">Add New Patient</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group pb-2">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="newFirstName" id="newFirstName" class="form-control">
                                        <div id="newFirstName_err" class="text-danger"></div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label>Last Name</label>
                                        <input type="text" name="newLastName" id="newLastName" class="form-control">
                                        <div id="newLastName_err" class="text-danger"></div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label>Mobile <span class="text-danger">*</span></label>
                                        <input type="text" name="newMobile" id="newMobile" class="form-control">
                                        <div id="newMobile_err" class="text-danger"></div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label>Email</label>
                                        <input type="email" name="newEmail" id="newEmail" class="form-control">
                                        <div id="newEmail_err" class="text-danger"></div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="newGender" id="newGender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div id="newGender_err" class="text-danger"></div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label>Age <span class="text-danger">*</span></label>
                                        <input type="number" name="newAge" id="newAge" class="form-control">
                                        <div id="newAge_err" class="text-danger"></div>
                                    </div>
                                    <div id="newPatientStatus" class="text-success mt-2"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                                        onclick="saveNewPatient()">Add Patient</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Open Modal and Close Modal -->
                   <!--  <script>
                        let patientDropdown = document.getElementById('patientId');

                        patientDropdown.addEventListener('change', function () {
                            if (this.value === 'new') {
                                showNewPatientModal();
                            }
                        });

                        function showNewPatientModal() {
                            const modal = new bootstrap.Modal(document.getElementById('newPatientModal'));
                            modal.show();
                        }

                        document.getElementById('newPatientModal').addEventListener('hidden.bs.modal', function () {
                            document.getElementById('patientId').value = '';
                        });
                    </script> -->

                    <script>
                document.addEventListener('DOMContentLoaded', function () {
                        const select      = document.getElementById('patientId');
                        const searchInput = document.getElementById('patientSearch');
                        const addBtn      = document.getElementById('addPatientBtn');
                        let originalOptions = Array.from(select.options);

                    select.value = "";
                // 1. Live search filter
                    searchInput.addEventListener('input', function () {
                        const term = this.value.toLowerCase().trim();
                        
                        if (term.length > 0) {
                            select.size = 6; 
                        } else {
                            select.size = 1; 
                        }

                    select.innerHTML = '<option value="">Select Patient Id</option>';
                    let matches = 0;
                        originalOptions.forEach(opt => {
                        if (opt.value === '') return;
                        if (opt.textContent.toLowerCase().includes(term)) {
                                select.appendChild(opt.cloneNode(true));
                                matches++;
                            }
                        });
                        if (matches === 0 && term !== '') {
                            const no = document.createElement('option');
                            no.disabled = true;
                            no.textContent = '— No patient found —';
                            select.appendChild(no);
                        }
                        });

                // 4. When user picks a patient → clear search box
                     select.addEventListener('change', function () {
                        if (this.value) {
                        searchInput.value = ''; 
                        }
                        select.size = 1;
                     });

                        // 4. +Add button → open modal
                        addBtn.addEventListener('click', function () {
                            showNewPatientModal();
                            searchInput.value = '';
                            select.value = '';
                        });

                        // 5. FIXED: When modal closes → Add & Select new patient
                        document.getElementById('newPatientModal').addEventListener('hidden.bs.modal', function () {
                            const resultInput = document.getElementById('newPatientResult');
                            if (resultInput && resultInput.value) {
                                const patient = JSON.parse(resultInput.value);
                                addPatientToSelectAndSelect(patient);
                                resultInput.value = ''; // clear for next time
                            }
                            document.getElementById('patientSearch').value = '';
                        });
                    });

                    // Open modal
                    function showNewPatientModal() {
                        const modal = new bootstrap.Modal(document.getElementById('newPatientModal'));
                        modal.show();
                    }

                    // Add new patient to dropdown and SELECT it
                    function addPatientToSelectAndSelect(patient) {
                        const select = document.getElementById('patientId');
                        const value = patient.patientId + '|' + patient.id;
                        const text  = patient.patientId + " / " + patient.firstName + (patient.lastName ? " " + patient.lastName : "");

                        // Avoid duplicate
                        let exists = false;
                        for (let opt of select.options) {
                            if (opt.value === value) {
                                exists = true;
                                break;
                            }
                        }

                        if (!exists) {
                            const option = new Option(text, value, true, true); 
                            select.add(option);
                            originalOptions = Array.from(select.options);
                        } else {
                            select.value = value;
                        }

                        select.dispatchEvent(new Event('change'));
                    }

                </script>

                 <!-- Add to db and validation -->
                <script>
                    function saveNewPatient() {
                        // Clear all errors and status
                        document.getElementById("newFirstName_err").innerHTML = "";
                        document.getElementById("newLastName_err").innerHTML = "";
                        document.getElementById("newMobile_err").innerHTML = "";
                        document.getElementById("newEmail_err").innerHTML = "";
                        document.getElementById("newGender_err").innerHTML = "";
                        document.getElementById("newAge_err").innerHTML = "";
                        document.getElementById("newPatientStatus").innerHTML = "";

                        const firstName = document.getElementById("newFirstName").value.trim();
                        const lastName  = document.getElementById("newLastName").value.trim();
                        const mobile    = document.getElementById("newMobile").value.trim();
                        const email     = document.getElementById("newEmail").value.trim();
                        const gender    = document.getElementById("newGender").value;
                        const age       = document.getElementById("newAge").value.trim();

                        let isValid = true;

                        // Validation
                        if (firstName === "") {
                            document.getElementById("newFirstName_err").innerHTML = "First name must be filled out.";
                            isValid = false;
                        } else if (!/^[a-zA-Z\s]+$/.test(firstName)) {
                            document.getElementById("newFirstName_err").innerHTML = "First name must contain only letters and spaces.";
                            isValid = false;
                        }

                        if (lastName !== "" && !/^[a-zA-Z\s]+$/.test(lastName)) {
                            document.getElementById("newLastName_err").innerHTML = "Last name must contain only letters and spaces.";
                            isValid = false;
                        }

                        if (mobile === "") {
                            document.getElementById("newMobile_err").innerHTML = "Mobile number must be filled out.";
                            isValid = false;
                        } else if (!/^\d{10}$/.test(mobile)) {
                            document.getElementById("newMobile_err").innerHTML = "Mobile number must be exactly 10 digits.";
                            isValid = false;
                        }

                        if (email !== "" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                            document.getElementById("newEmail_err").innerHTML = "Please enter a valid email address.";
                            isValid = false;
                        }

                        if (gender === "") {
                            document.getElementById("newGender_err").innerHTML = "Gender must be selected.";
                            isValid = false;
                        }

                        if (age === "") {
                            document.getElementById("newAge_err").innerHTML = "Age must be filled out.";
                            isValid = false;
                        } else if (isNaN(age) || age < 2 || age > 120) {
                            document.getElementById("newAge_err").innerHTML = "Age must be a number between 2 and 120.";
                            isValid = false;
                        }

                        if (isValid) {
                            fetch('<?php echo base_url("Healthcareprovider/ajaxSavePatient"); ?>', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ firstName, lastName, mobile, email, gender, age })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Success message
                                    document.getElementById("newPatientStatus").innerHTML = "Patient saved successfully!";
                                    document.getElementById("newPatientStatus").className = "text-success mt-2";

                                    // Store patient data in hidden field for modal close handler
                                    const patientData = {
                                        patientId: data.patientId,
                                        id: data.id,
                                        firstName: data.firstName,
                                        lastName: data.lastName || ''
                                    };
                                    document.getElementById("newPatientResult").value = JSON.stringify(patientData);

                                    // Clear form
                                    document.getElementById("newFirstName").value = "";
                                    document.getElementById("newLastName").value = "";
                                    document.getElementById("newMobile").value = "";
                                    document.getElementById("newEmail").value = "";
                                    document.getElementById("newGender").value = "";
                                    document.getElementById("newAge").value = "";

                                    // Close modal
                                    const modal = bootstrap.Modal.getInstance(document.getElementById('newPatientModal'));
                                    modal.hide();
                                } else {
                                    document.getElementById("newPatientStatus").innerHTML = "Failed to save patient.";
                                    document.getElementById("newPatientStatus").className = "text-danger mt-2";
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                document.getElementById("newPatientStatus").innerHTML = "An error occurred while saving the patient.";
                                document.getElementById("newPatientStatus").className = "text-danger mt-2";
                            });
                        }
                    }
                    </script>

                    <!-- Appointment booking -->
                    <script>
                        var appBookedDetails = <?php echo json_encode($appBookedDetails); ?>;

                        function adjustTimeOptions() {
                            const selectedDate = document.getElementById('appDate').value;
                            const referalCc = document.getElementById('referalDoctor').value;
                            const parts = referalCc.split('|');
                            const referalCcId = parts[0];

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

                                if (bookedDate === selectedDate && bookedCcDoctor === referalCcId) {
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

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const multiSelect = document.getElementById("multiSelectSymptoms");
                            const selectedValuesInput = document.getElementById("appReason");
                            const selectedValuesContainer = document.getElementById("selectedValuesContainer");

                            let selectedValues = new Set();

                            const updateSelectedValues = () => {
                                selectedValuesContainer.innerHTML = '';
                                selectedValues.forEach(value => {
                                    const span = document.createElement('span');
                                    span.classList.add('badge', 'bg-secondary', 'me-2', 'd-inline-flex', 'align-items-center');
                                    span.textContent = value;
                                    const button = document.createElement('button');
                                    button.innerHTML = '&times;';
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

                            multiSelect.addEventListener("change", () => {
                                const selectedOptions = Array.from(multiSelect.selectedOptions);
                                selectedOptions.forEach(option => {
                                    selectedValues.add(option.value);
                                    option.classList.add('text-secondary', 'fw-bold', 'd-flex', 'justify-content-between', 'align-items-center');
                                    if (!option.innerHTML.includes('✓')) {
                                        option.innerHTML = `<span> ${option.textContent.trim()} <span class="ms-5">✓</span></span >`;

                                    }
                                });
                                updateSelectedValues();
                            });
                        });
                    </script>

                    <script>
                        function clearErrorAppointment() {
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;
                            var reason = document.getElementById("appReason").value;

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
                            if (appReason != "") {
                                document.getElementById("appReason_err").innerHTML = "";
                            }
                        }

                        function validateAppointment() {
                            var patientId = document.getElementById("patientId").value;
                            var referalDr = document.getElementById("referalDoctor").value;
                            var date = document.getElementById("appDate").value;
                            var dayTime = document.getElementById("dayTime").value;
                            var time = document.getElementById("appTime").value;
                            var reason = document.getElementById("appReason").value;

                            if (patientId == "") {
                                document.getElementById("patientId_err").innerHTML = "Id must be filled out.";
                                document.getElementById("patientId").focus();
                                return false;
                            } else {
                                document.getElementById("patientId_err").innerHTML = "";
                            }
                            if (referalDr == "") {
                                document.getElementById("referalDoctor_err").innerHTML = "Referal doctor name must be filled out.";
                                document.getElementById("referalDoctor").focus();
                                return false;
                            } else {
                                document.getElementById("referalDoctor_err").innerHTML = "";
                            }
                            if (date == "") {
                                document.getElementById("appDate_err").innerHTML = "Date must be filled out.";
                                document.getElementById("appDate").focus();
                                return false;
                            } else {
                                document.getElementById("appDate_err").innerHTML = "";
                            }

                            if (dayTime == "") {
                                document.getElementById("dayTime_err").innerHTML = "Time must be filled out.";
                                document.getElementById("dayTime").focus();
                                return false;
                            } else {
                                document.getElementById("dayTime_err").innerHTML = "";
                            }
                            if (time == "") {
                                document.getElementById("appTime_err").innerHTML = "Time must be filled out.";
                                document.getElementById("appTime").focus();
                                return false;
                            } else {
                                document.getElementById("appTime_err").innerHTML = "";
                            }
                            if (reason == "") {
                                document.getElementById("appReason_err").innerHTML = "Complaints must be filled out.";
                                document.getElementById("appReason").focus();
                                return false;
                            } else {
                                document.getElementById("appReason_err").innerHTML = "";
                            }
                            return true;
                        }
                    </script>

            <?php
        } else if ($method == "appointmentUpdate") {
            ?>
                        <section>
                            <div class="card rounded">
                                <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                    <p style="font-size: 24px; font-weight: 500">Update Appoitment</p>
                                    <a href="<?php echo base_url() . "Healthcareprovider/appointments" ?>"
                                        class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body px-md-4 pb-4">
                                    <!-- Form  -->
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
                                                        <label class="form-label" for="appReason">Patient's Complaint / Symptoms</label>
                                                        <input type="text" class="form-control" id="appReason" name="appReason"
                                                            value="<?php echo $value['patientComplaint'] ?>" disabled
                                                            onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
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
                        </section>

                        <script>
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

                                    if (bookedDate === selectedDate && bookedCcDoctor === referalCcId) {
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

                        </script>

                        <script>
                            function dateError() {
                                const selectedDate = document.getElementById('appDate').value;
                                const today = new Date().toISOString().split('T')[0];
                                if (selectedDate < today) {
                                    document.getElementById("appDate_err").innerHTML = "Date must be today or later.";
                                } else {
                                    document.getElementById("appDate_err").innerHTML = "";
                                }

                            }
                        </script>

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

                        <script>
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
                        </script>

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
                                                            <label class="form-label" for="appReason">Patient's Complaint / Symptoms</label>
                                                            <input type="text" class="form-control" id="appReason" name="appReason"
                                                                value="<?php echo $value['patientComplaint'] ?>" disabled
                                                                onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                        </div>

                                                        <div class="form-group pb-3">
                                                            <label class="form-label" for="pay">Payment Status</label>
                                                            <input type="text" class="form-control" id="pay" name="pay" value="Paid" disabled
                                                                onmouseover="style='cursor: no-drop;'" onmouseout="style='cursor: ns-resize;">
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                            <button type="submit" class="btn text-light"
                                                                style="background-color: #00ad8e;">Submit</button>
                                                        </div>
                                                    </form>
                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <script>
                                var appBookedDetails = <?php echo json_encode($appBookedDetails); ?>;
                                const referalCc = document.getElementById('referalDoctor').value;

                                function adjustTimeOptions() {
                                    const selectedDate = document.getElementById('appDate').value;
                                    const parts = referalCc ? referalCc.split('|') : [];
                                    const referalCcId = parts.length > 0 ? parts[0] : null;

                                    const timeButtons = document.querySelectorAll('.timeButton');

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
                                        if (bookedDate === selectedDate && bookedCcDoctor === referalCcId) {
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

                                window.onload = function () {
                                    var selectElement = document.getElementById('dayTime');
                                    selectElement.addEventListener('change', function () {
                                        displayTime();
                                    });

                                    adjustTimeOptions();
                                };

                                document.getElementById('appDate').addEventListener('change', function () {
                                    adjustTimeOptionsBasedOnCurrentTime();
                                    displayTime();
                                });

                            </script>

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
                                        document.getElementById("appDate_err").innerHTML = "Date must be filled out.";
                                        document.getElementById("appDate").focus();
                                        return false;
                                    } else {
                                        document.getElementById("appDate_err").innerHTML = "";
                                    }

                                    if (dayTime == "") {
                                        document.getElementById("dayTime_err").innerHTML = "Time must be filled out.";
                                        document.getElementById("dayTime").focus();
                                        return false;
                                    } else {
                                        document.getElementById("dayTime_err").innerHTML = "";
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
                                                    '<img src="' + (value.ccPhoto ? value.ccPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg') + '" ' +
                                                    'alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto" ' +
                                                    'onerror="this.onerror=null;this.src=\'<?php echo base_url(); ?>assets/BlankProfile.jpg\';">' +
                                                    '<div>' +
                                                    '<p class=\'card-title\'><b>' + value.doctorName + '</b><br>' + value.ccId + '</p>' +
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
                                                            <p style="font-size:16px;font-weight:400;color:#00ad8e;">Diabetologist</p>
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

                                                    <h5 class="fw-bolder pb-3">Profile Details:</h5>

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
                                                                <img src="<?php echo $value['hcpPhoto'] ?>" alt="Profile Photo" width="140" height="140"
                                                                    class="rounded-circle"
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
                                                            <p class="my-3 mt-3 fs-5 fw-semibold">Profile Details :</p>
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
                                                            <div class="position-relative">
                                                                <img id="previewImage" src="<?= isset($value['hcpPhoto']) && $value['hcpPhoto'] !== "No data"
                                                                    ? base_url('uploads/' . $value['hcpPhoto'])
                                                                    : base_url('assets/BlankProfileCircle.png') ?>"
                                                                    alt="Profile Photo" width="150" height="150" class="rounded-circle d-block mx-auto mb-4"
                                                                    style="box-shadow: 0px 4px 4px rgba(5, 149, 123, 0.7); outline: 1px solid white;"
                                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                                                <a href="#" class="position-absolute rounded-circle px-2 py-1"
                                                                    style="color: #00ad8e;border: 2px solid #00ad8e;border-radius: 50%;top: 77%; left: 52%; transform: translateX(44%); "
                                                                    role="button" data-bs-toggle="modal" data-bs-target="#updateHCPPhoto"><i
                                                                        class="bi bi-camera"></i></a>
                                                            </div>

                                                            <form action="<?php echo base_url() . "Healthcareprovider/updateMyProfile" ?>"
                                                                name="profileEditForm" name="profileEditForm" enctype="multipart/form-data" method="POST"
                                                                onsubmit="return validateDetails()" oninput="clearErrorDetails()" class="">

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
                                                                        <input type="text" class="form-control" id="yearOfExp" name="yearOfExp"
                                                                            value="<?php echo $value['hcpExperience']; ?>" placeholder="E.g. 25">
                                                                        <!-- <div id="drName_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                                        <label class="form-label" for="qualification">Qualification</label>
                                                                        <input type="text" class="form-control" id="qualification" name="qualification"
                                                                            value="<?php echo $value['hcpQualification']; ?>" placeholder="E.g. MBBS">
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
                                                                            value="<?php echo $value['hcpHospitalName']; ?>" placeholder="E.g. MMCH">
                                                                        <!-- <div id="specialization_err" class="text-danger pt-1"></div> -->
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-flex justify-content-between py-3">
                                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                                        <label class="form-label" for="location">Location</label>
                                                                        <input type="text" class="form-control" id="location" name="location"
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

        <?php } ?>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>
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

    <!-- Crop Image and Upload HCP profile -->
    <script>
        let cropper;

        document.getElementById('hcpProfile').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const image = document.getElementById('previewImage');
                    image.src = e.target.result;

                    if (cropper) cropper.destroy();

                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 2,
                        dragMode: 'move',
                        cropBoxResizable: false,
                        cropBoxMovable: true,
                        ready: function () {
                            cropper.setCropBoxData({
                                width: 200,
                                height: 200
                            });
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('uploadButton').addEventListener('click', function () {
            if (!cropper) {
                alert("Please select an image to upload.");
                return;
            }
            cropper.getCroppedCanvas({ width: 200, height: 200 }).toBlob(blob => {
                if (!blob) {
                    alert("Cropping failed. Please try again.");
                    return;
                }

                const now = new Date();
                const day = String(now.getDate()).padStart(2, '0');
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');

                const fileName = `doctorHCP_${day}_${month}_${year}_${hours}_${minutes}.jpg`;

                const formData = new FormData();
                formData.append('hcpProfile', blob, fileName);

                fetch("<?php echo base_url() . 'Healthcareprovider/updatePhoto' ?>", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        var myModal = new bootstrap.Modal(document.getElementById('updateHCPPhoto'));
                        myModal.hide();
                        location.reload();
                    })
                    .catch(error => console.error("Upload failed:", error));
            }, "image/jpeg");
        });
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