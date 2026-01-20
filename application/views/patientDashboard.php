<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>Patient - EDF</title>
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
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php $this->load->view('patientHeader'); ?>

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
            </section>

            <?php
        } else if ($method == "appointments") {
            ?>
                <section>
                    <div class="card rounded">
                        <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500"> Appointments</p>
                            <a href="<?php echo base_url() . "Patient/dashboard" ?>" class="float-end text-dark mt-2"><i
                                    class="bi bi-arrow-left"></i> Back</a>
                        </div>
                        <div class="card-body p-3 p-sm-4">

                        </div>
                    </div>
                </section>

            <?php
        } else if ($method == "myProfile") {
            ?>
                    <section>
                        <div class="card rounded">
                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                <p style="font-size: 24px; font-weight: 500"> My Profile</p>
                                <a href="<?php echo base_url() . "Patient/dashboard" ?>" class="float-end text-dark mt-2"><i
                                        class="bi bi-arrow-left"></i> Back</a>
                            </div>
                            <div class="card-body p-3 p-sm-4">
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
                                            <a href="<?php echo base_url() . "Patient/editMyProfile/" . $value['id']; ?>">
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-pen pe-1"></i> Profile
                                                </button>
                                            </a>
                                            <a href="<?php echo base_url() . "Patient/changePassword/" . $value['id']; ?>">
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-pen pe-1"></i> Password
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
                                        <p class="col-sm-6"><span class="text-secondary ">Email address</span> :
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
                                    <p class="mb-2"><span class="text-secondary ">Registration Date </span> :
                                <?php echo date('d-M-Y', strtotime($value['created_at'])); ?>
                                    </p>
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
                                    <a href="<?php echo base_url() . "Patient/myProfile" ?>" class="float-end text-dark mt-2"><i
                                            class="bi bi-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body ps-3 p-sm-4">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                        <form action="<?php echo base_url() . "Patient/updateMyProfile" ?>" name="editPatientDetails"
                                            id="editPatientDetails" enctype="multipart/form-data" method="POST"
                                            oninput="validatePatientDetails()" onsubmit="return submitPatientDetails(event)">
                                            <div class="position-relative">
                                                <img id="previewImage" src="<?= isset($value['profilePhoto']) && $value['profilePhoto'] !== "No data"
                                                    ? base_url('uploads/' . $value['profilePhoto'])
                                                    : base_url('assets/img/BlankProfileCircle.png') ?>"
                                                    alt="Profile Photo" width="150" height="150" class="rounded-circle d-block mx-auto mb-4"
                                                    style="box-shadow: 0px 4px 4px rgba(47, 129, 237, 0.7); outline: 1px solid white;"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/BlankProfileCircle.png') ?>';">
                                                <input type="file" id="profilePhoto" name="profilePhoto"
                                                    class="form-control p-3 image-input d-none" accept=".png, .jpg, .jpeg">
                                                <a href="#" class="position-absolute rounded-circle px-2 py-1"
                                                    style="color: #2F80ED;border: 2px solid #2F80ED;border-radius: 50%;top: 77%; left: 52%; transform: translateX(44%); "
                                                    onclick="document.getElementById('profilePhoto').click();"><i
                                                        class="bi bi-camera"></i></a>
                                            </div>
                                            <p class="ps-2 pb-2" style="font-size: 20px; font-weight: 500;color:#2F80ED">
                                                <button
                                                    style=" width:30px;height:30px;background-color: #2F80ED;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">1</button> Basic Details
                                            </p>
                                            <div class="d-md-flex justify-content-between py-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientName">First Name</label>
                                                    <input type="text" class="form-control" id="patientName" name="patientName"
                                                        value="<?php echo $value['firstName'] ?>" maxlength="30" placeholder="E.g. Siva"
                                                        style="cursor: no-drop;" disabled readonly>
                                                    <small id="patientName_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="" name="patientLastName"
                                                        value="<?php echo $value['lastName'] ?>" maxlength="30" placeholder="E.g. Kumar"
                                                        style="cursor: no-drop;" disabled readonly>
                                                    <small id="patientLastName_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientMobile">Moblie Number</label>
                                                    <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                                        value="<?php echo $value['mobileNumber'] ?>" maxlength="10"
                                                        placeholder="E.g. 9638527410" style="cursor: no-drop;" disabled readonly>
                                                    <small id="patientMobile_err" class="text-danger pt-1"></small>
                                                    <small id="duplicateMobile_err" class="text-danger pt-1"></small>
                                                </div>
                                                <div class="col-md-6 pe-md-4 pt-2 pt-md-0">
                                                    <label class="form-label" for="patientAltMobile">Alternate Moblie
                                                        Number</label>
                                                    <input type="text" class="form-control" id="patientAltMobile" name="patientAltMobile"
                                                        value="<?php echo $value['alternateMobile'] ?>" maxlength="10"
                                                        placeholder="E.g. 9876543210" style="cursor: no-drop;" disabled readonly>
                                                    <small id="patientAltMobile_err" class="text-danger pt-1"></small>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientEmail">Email
                                                    </label>
                                                    <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                                        value="<?php echo $value['mailId'] ?>" placeholder="E.g. example@gmail.com"
                                                        maxlength="50" style="cursor: no-drop;" disabled readonly>
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
                                                        max="121" maxlength="3" value="<?php echo $currentAge; ?>" placeholder="E.g. 41">
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

                                            <p class="py-3" style="font-size: 20px; font-weight: 500;color: #2F80ED"> <button
                                                    style=" width:30px;height:30px;background-color: #2F80ED;font-size:20px; font-weight: 500"
                                                    class="text-light rounded-circle border-0">2</button> Additional Information
                                            </p>
                                            <div class="d-md-flex justify-content-between pb-3">
                                                <div class="col-md-6 pe-md-4 pb-2 pb-md-0">
                                                    <label class="form-label" for="patientProfessions">Patient's
                                                        Profession</label>
                                                    <input type="text" class="form-control" id="patientProfessions"
                                                        name="patientProfessions" value="<?php echo $value['profession'] ?>" maxlength="30"
                                                        placeholder="E.g. IT employee">
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
                                                        value="<?php echo $value['district'] ?>" maxlength="30" placeholder="E.g. Erode">
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
                                            <input type="hidden" id="patientIdDb" name="patientIdDb" value="<?php echo $value['id']; ?>">
                                            <div class="d-flex justify-content-between mt-3">
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                <button type="submit" class="btn text-light"
                                                    style="background-color: #2F80ED;">Update</button>
                                            </div>
                                        </form>
                        <?php } ?>
                                </div>
                            </div>
                        </section>

            <?php
        } else if ($method == "passwordChange") {
            ?>
                            <section>
                                <div class="card rounded m-md-2">
                                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                        <p style="font-size: 24px; font-weight: 500"> Change Password</p>
                                        <a href="<?php echo base_url() . "Patient/myProfile" ?>" class="float-end text-dark mt-2"><i
                                                class="bi bi-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="card-body">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                            <form action="<?php echo base_url() . "Patient/saveNewPassword" ?>" name="PasswordForm"
                                                method="POST" class="px-md-3" onsubmit="return validateNewPassword()"
                                                oninput="validateNewPassword()">
                                                <input type="hidden" name="patientDbId" id="patientDbId" value="<?php echo $value['id']; ?>">
                                                <div class="d-md-flex justify-content-between pb-3">
                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                        <label class="form-label pb-2" for="patientName">Full Name</label>
                                                        <input type="text" class="form-control" id="patientName" name="patientName"
                                                            style="cursor: no-drop;"
                                                            value="<?php echo $value['firstName'] . ' ' . $value['lastName']; ?>"
                                                            placeholder="Suresh Kumar" disabled readonly>
                                                    </div>
                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                        <label class="form-label pb-2" for="patientMobile">Mobile Number </label>
                                                        <input type="text" class="form-control" id="patientMobile" name="patientMobile"
                                                            style="cursor: no-drop;" value="<?php echo $value['mobileNumber']; ?>"
                                                            placeholder="9632587410" disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="d-md-flex justify-content-between pt-3">
                                                    <div class="col-md-6 pe-md-4 pb-3 pb-md-0">
                                                        <label class="form-label pb-2" for="patientEmail">Email Id</label>
                                                        <div class="">
                                                            <input type="email" class="form-control" id="patientEmail" name="patientEmail"
                                                                style="cursor: no-drop;" value="<?php echo $value['mailId']; ?>"
                                                                placeholder="example@gmail.com" disabled readonly>
                                                        </div>
                                                        <p type="button" class="float-end mt-2 m-0 p-0" style="color: #2F80ED;"
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
                                                        <label class="form-label pb-2" for="patientNewPassword">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <div style="position: relative;">
                                                            <input type="password" class="form-control" id="patientNewPassword" maxlength="20"
                                                                name="patientNewPassword" placeholder="Enter New Password">
                                                            <i class="bi bi-eye-fill"
                                                                onclick="togglePasswordVisibility('patientNewPassword', this)"
                                                                style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                        </div>
                                                        <small id="passwordError" class="text-danger"></small>
                                                    </div>
                                                    <div class="col-md-6 pe-md-4 pt-3 pt-md-0">
                                                        <label class="form-label pb-2" for="patientCnfmPassword">Confirm Password <span
                                                                class="text-danger">*</span></label>
                                                        <div style="position: relative;">
                                                            <input type="password" class="form-control" id="patientCnfmPassword" maxlength="20"
                                                                name="patientCnfmPassword" placeholder="Re-Enter New Password">
                                                            <i class="bi bi-eye-fill"
                                                                onclick="togglePasswordVisibility('patientCnfmPassword', this)"
                                                                style="position: absolute; right: 20px;top: 50%;transform: translateY(-50%);cursor: pointer;"></i>
                                                        </div>
                                                        <small id="confirmPasswordError" class="text-danger"></small>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn float-end mt-3"
                                                    style="color: white;background-color: #2F80ED;">Save</button>
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
                                    const email = document.getElementById('patientEmail').value.trim();

                                    fetch("<?= base_url('Patient/sendEmailOtp') ?>", {
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
                                        fetch("<?= base_url('Patient/verifyEmailOtp') ?>", {
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
                                    let password = document.getElementById("patientNewPassword").value.trim();
                                    let confirmPassword = document.getElementById("patientCnfmPassword").value.trim();
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
        } else if ($method == "hcps") {
            ?>
                                <section>
                                    <div class="card rounded">
                                        <div class="d-sm-flex justify-content-between p-3">
                                            <p class="ps-2 m-0" style="font-size: 24px; font-weight: 500">
                                                Health Care Providers
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
                                                    '<p class=\'card-title\'><b>' + value.doctorName + '</b><br>' + value.ccId + '</p>' +
                                                    '<p style=\'color: #00ad8e;\'><b>' + value.specialization + '</b></p>' +
                                                    '<a href=\'<?php echo base_url(); ?>Patient/chiefDoctorsProfile/' + value.id + '\' ' +
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
        } else if ($method == "hcpsProfile") {
            ?>
                                    <section>
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500">
                                                    Health Care Provider Profile </p>
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
                                                            '<p class=\'card-title\'><b>' + value.doctorName + '</b><br>' + value.ccId + '</p>' +
                                                            '<p style=\'color: #00ad8e;\'><b>' + value.specialization + '</b></p>' +
                                                            '<a href=\'<?php echo base_url(); ?>Patient/chiefDoctorsProfile/' + value.id + '\' ' +
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
        } ?>

        <!-- All modal files -->
        <?php include 'patientModals.php'; ?>

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
                            <a href="<?php echo base_url('Patient/changePassword'); ?>" class="btn text-light"
                                style="background-color: #2F80ED;">Update
                                Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        <?php if ($method == "dashboard") { ?>
            document.getElementById('dashboard').style.color = "#bbd3f2";
        <?php } elseif ($method == "appointments") { ?>
            document.getElementById('appointments').style.color = "#bbd3f2";
        <?php } elseif ($method == "myProfile" || $method == "editMyProfile" || $method == "passwordChange") { ?>
            document.getElementById('myProfile').style.color = "#bbd3f2";
        <?php } elseif ($method == "hcps" || $method == "hcpsProfile") { ?>
            document.getElementById('healthCareProvider').style.color = "#bbd3f2";
        <?php } elseif ($method == "chiefDoctors" || $method == "chiefDoctorProfile") { ?>
            document.getElementById('chiefDoctor').style.color = "#bbd3f2";
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