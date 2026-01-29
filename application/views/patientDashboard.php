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

        /* Consultation arrows container style */
        .consultation-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .consultation-item {
            display: none;
            width: 100%;
        }

        .consultation-item.active {
            display: block;
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
                <div class="card rounded">
                    <div class="mt-2 p-3 pt-sm-4 px-sm-4">
                        <p style="font-size: 24px; font-weight: 500">Dashboard</p>
                    </div>
                    <div class="card-body p-3 px-sm-5">
                        <p class="fs-5 fw-semibold mb-3">All Consultations:</p>
                        <?php if (!empty($consultations)): ?>
                            <div class="consultation-container">
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="consultation-nav">
                                        <button id="nav-left" class="btn btn-outline-secondary me-2"
                                            onclick="navigateConsultations(-1)">&#9664;</button>
                                        <span id="consultation-counter">
                                            < 1 of <?= count($consultations) ?>>
                                        </span>
                                        <button id="nav-right" class="btn btn-outline-secondary ms-2"
                                            onclick="navigateConsultations(1)">&#9654;</button>
                                    </div>
                                </div>
                                <?php
                                usort($consultations, function ($a, $b) {
                                    $dateTimeA = strtotime($a['consult_date'] . ' ' . $a['consult_time']);
                                    $dateTimeB = strtotime($b['consult_date'] . ' ' . $b['consult_time']);
                                    return $dateTimeB <=> $dateTimeA; // latest first
                                });
                                ?>
                                <?php foreach ($consultations as $index => $consultation): ?>
                                    <div class="consultation-item <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                                        <div class="border border-5 mb-3 shadow-sm">
                                            <div class="card-body" id="consultation-content-<?= $consultation['id'] ?>">
                                                <div class="d-md-flex justify-content-between">
                                                    <h5 class="card-title mb-0">
                                                        <?= date('d M Y', strtotime($consultation['consult_date'])) . " - " . date('h:i A', strtotime($consultation['consult_time'])) ?>
                                                    </h5>
                                                    <div class="mt-md-3 mb-4 mb-md-0">
                                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                            data-bs-target="#consultationModal<?= $consultation['id'] ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Vitals -->
                                                <?php if (!empty($consultation['vitals'])): ?>
                                                    <p><strong>Vitals:</strong></p>
                                                    <div class="row g-2 mb-4">
                                                        <?php
                                                        $vitals = [
                                                            'Height' => !empty($consultation['vitals']['height_cm']) ? $consultation['vitals']['height_cm'] . ' cm' : null,
                                                            'Weight' => !empty($consultation['vitals']['weight_kg']) ? $consultation['vitals']['weight_kg'] . ' kg' : null,
                                                            'BMI' => !empty($consultation['vitals']['body_mass_index']) ? $consultation['vitals']['body_mass_index'] . ' kg/m²' : null,
                                                            'BP' => (!empty($consultation['vitals']['systolic_bp']) && !empty($consultation['vitals']['diastolic_bp'])) ? $consultation['vitals']['systolic_bp'] . '/' . $consultation['vitals']['diastolic_bp'] . ' mmHg' : null,
                                                            'HbA1c' => !empty($consultation['vitals']['HbA1c_percent']) ? $consultation['vitals']['HbA1c_percent'] . ' %' : null,
                                                            'Fasting Blood Sugar' => !empty($consultation['vitals']['blood_sugar_fasting']) ? $consultation['vitals']['blood_sugar_fasting'] . ' mg/dL' : null,
                                                            'PP Blood Sugar' => !empty($consultation['vitals']['blood_sugar_pp']) ? $consultation['vitals']['blood_sugar_pp'] . ' mg/dL' : null,
                                                            'Random Blood Sugar' => !empty($consultation['vitals']['blood_sugar_random']) ? $consultation['vitals']['blood_sugar_random'] . ' mg/dL' : null,
                                                            'SPO2' => !empty($consultation['vitals']['spo2_percent']) ? $consultation['vitals']['spo2_percent'] . ' %' : null,
                                                            'Pulse Rate' => !empty($consultation['vitals']['pulse_rate']) ? $consultation['vitals']['pulse_rate'] . ' /min' : null,
                                                            'Temperature' => !empty($consultation['vitals']['temperature_f']) ? $consultation['vitals']['temperature_f'] . ' °F' : null,
                                                        ];

                                                        foreach ($vitals as $label => $value):
                                                            if ($value):
                                                                ?>
                                                                <div class="col-12 col-md-6">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center border p-2 rounded">
                                                                        <span class="fw-medium"><?= $label ?>:</span>
                                                                        <span class="text-primary"><?= $value ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Symptoms -->
                                                <?php if (!empty($consultation['symptoms'])): ?>
                                                    <p><strong>Symptoms:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['symptoms'] as $symptom): ?>
                                                            <li>
                                                                <?= $symptom['symptom_name'] ?>
                                                                <?php
                                                                $details = [];
                                                                if (!empty($symptom['since']))
                                                                    $details[] = $symptom['since'];
                                                                if (!empty($symptom['severity']))
                                                                    $details[] = $symptom['severity'];
                                                                if (!empty($symptom['note']))
                                                                    $details[] = $symptom['note'];
                                                                if (!empty($details)) {
                                                                    echo ' (' . implode(', ', $details) . ')';
                                                                }
                                                                ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Findings -->
                                                <?php if (!empty($consultation['findings'])): ?>
                                                    <p><strong>Findings:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['findings'] as $finding): ?>
                                                            <li>
                                                                <?= $finding['finding_name'] ?>
                                                                <?php
                                                                $details = [];
                                                                if (!empty($finding['since']))
                                                                    $details[] = $finding['since'];
                                                                if (!empty($finding['severity']))
                                                                    $details[] = $finding['severity'];
                                                                if (!empty($finding['note']))
                                                                    $details[] = $finding['note'];
                                                                if (!empty($details)) {
                                                                    echo ' (' . implode(', ', $details) . ')';
                                                                }
                                                                ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Diagnosis -->
                                                <?php if (!empty($consultation['diagnosis'])): ?>
                                                    <p><strong>Diagnosis:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['diagnosis'] as $diagnosis): ?>
                                                            <li>
                                                                <?= $diagnosis['diagnosis_name'] ?>
                                                                <?php
                                                                $details = [];
                                                                if (!empty($diagnosis['since']))
                                                                    $details[] = $diagnosis['since'];
                                                                if (!empty($diagnosis['severity']))
                                                                    $details[] = $diagnosis['severity'];
                                                                if (!empty($diagnosis['note']))
                                                                    $details[] = $diagnosis['note'];
                                                                if (!empty($details)) {
                                                                    echo ' (' . implode(', ', $details) . ')';
                                                                }
                                                                ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Investigations -->
                                                <?php if (!empty($consultation['investigations'])): ?>
                                                    <p><strong>Investigations:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['investigations'] as $inv): ?>
                                                            <li>
                                                                <?= htmlspecialchars($inv['investigation_name']) ?>
                                                                <?php if (!empty($inv['note'])): ?>
                                                                    - <?= htmlspecialchars($inv['note']) ?>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Instructions -->
                                                <?php if (!empty($consultation['instructions'])): ?>
                                                    <p><strong>Instructions:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['instructions'] as $ins): ?>
                                                            <li><?= $ins['instruction_name'] ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Advices -->
                                                <?php if (!empty($consultation['advices'])): ?>
                                                    <p><strong>Advices:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['advices'] as $adv): ?>
                                                            <li><?= $adv['advice_name'] ?>
                                                                <?php if (!empty($adv['note'])): ?>
                                                                    - <?= htmlspecialchars($adv['note']) ?>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- ====== Medicines ====== -->
                                                <?php if (!empty($consultation['medicines'])): ?>
                                                    <p><strong>Medicines:</strong></p>
                                                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;"
                                                        class="mb-3">
                                                        <thead>
                                                            <!-- First header row -->
                                                            <tr>
                                                                <th rowspan="2"
                                                                    style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                    S.No</th>
                                                                <th rowspan="2"
                                                                    style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                    Name</th>
                                                                <th rowspan="2"
                                                                    style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                    Quantity</th>
                                                                <th rowspan="2"
                                                                    style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                    Food <br> Timing</th>

                                                                <!-- Frequency spanning four columns -->
                                                                <th colspan="4"
                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                    Frequency</th>

                                                                <th rowspan="2"
                                                                    style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                    Notes</th>
                                                            </tr>

                                                            <!-- Second header row for sub-columns -->
                                                            <tr>
                                                                <th style="border: 1px solid #000; padding: 10px; text-align: center;">
                                                                    Morning</th>
                                                                <th style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                    Afternoon</th>
                                                                <th style="border: 1px solid #000; padding: 10px; text-align: center;">
                                                                    Evening</th>
                                                                <th
                                                                    style="border: 1px solid #000; padding: 0 16px 0 16px; text-align: center;">
                                                                    Night</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php if (!empty($consultation['medicines'])): ?>
                                                                <?php foreach ($consultation['medicines'] as $index => $medicine): ?>
                                                                    <?php
                                                                    // Safely split timing into 4 parts
                                                                    $timingString = isset($medicine['timing']) ? trim($medicine['timing']) : '0-0-0-0';
                                                                    $timingParts = preg_split('/\s*-\s*/', $timingString);
                                                                    $timingParts = array_pad($timingParts, 4, '0'); // ensure 4 values
                                                                    list($morning, $afternoon, $evening, $night) = $timingParts;
                                                                    ?>
                                                                    <tr>
                                                                        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= $index + 1 . '.' ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; padding: 6px;">
                                                                            <?php if (!empty($medicine['medicine_name'])): ?>
                                                                                <?php
                                                                                $category = trim($medicine['category'] ?? '');
                                                                                if ($category !== '' && strtolower($category) !== 'nil'):
                                                                                    ?>
                                                                                    <small style="font-size:12px;"
                                                                                        class="text-muted"><?= htmlspecialchars($medicine['category']) ?></small>
                                                                                <?php endif; ?>
                                                                                <strong>
                                                                                    <?= htmlspecialchars($medicine['medicine_name']) ?></strong>
                                                                            <?php else: ?>
                                                                                -
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars(trim($medicine['quantity'] ?? '') ?: '-') ?>

                                                                        </td>
                                                                        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            <?= htmlspecialchars(trim($medicine['food_timing'] ?? '') ?: '-') ?>

                                                                        </td>

                                                                        <!-- Frequency split -->
                                                                        <td
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center; font-family: Arial, sans-serif;">
                                                                            <?php
                                                                            if ($morning !== '0' && $morning !== '' && $morning !== '-') {
                                                                                // Split number and unit (e.g., "1 ml" → number = 1, unit = ml)
                                                                                $parts = preg_split('/(\d+)/', $morning, -1, PREG_SPLIT_DELIM_CAPTURE);
                                                                                $number = $parts[1] ?? $morning;  // the digits
                                                                                $unit = trim(str_replace($number, '', $morning)); // everything else (ml, tab, etc.)
                                                    
                                                                                echo '<span style="font-size: 15px;">' . htmlspecialchars($number) . '</span>';
                                                                                if ($unit) {
                                                                                    echo ' <span style="font-size: 13px; color: #555;">' . htmlspecialchars($unit) . '</span>';
                                                                                }
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center; font-family: Arial, sans-serif;">
                                                                            <?php
                                                                            if ($afternoon !== '0' && $afternoon !== '' && $afternoon !== '-') {
                                                                                // Split number and unit (e.g., "1 ml" → number = 1, unit = ml)
                                                                                $parts = preg_split('/(\d+)/', $afternoon, -1, PREG_SPLIT_DELIM_CAPTURE);
                                                                                $number = $parts[1] ?? $afternoon;  // the digits
                                                                                $unit = trim(str_replace($number, '', $afternoon)); // everything else (ml, tab, etc.)
                                                    
                                                                                echo '<span style="font-size: 15px;">' . htmlspecialchars($number) . '</span>';
                                                                                if ($unit) {
                                                                                    echo ' <span style="font-size: 13px; color: #555;">' . htmlspecialchars($unit) . '</span>';
                                                                                }
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center; font-family: Arial, sans-serif;">
                                                                            <?php
                                                                            if ($evening !== '0' && $evening !== '' && $evening !== '-') {
                                                                                // Split number and unit (e.g., "1 ml" → number = 1, unit = ml)
                                                                                $parts = preg_split('/(\d+)/', $evening, -1, PREG_SPLIT_DELIM_CAPTURE);
                                                                                $number = $parts[1] ?? $evening;  // the digits
                                                                                $unit = trim(str_replace($number, '', $evening)); // everything else (ml, tab, etc.)
                                                    
                                                                                echo '<span style="font-size: 15px;">' . htmlspecialchars($number) . '</span>';
                                                                                if ($unit) {
                                                                                    echo ' <span style="font-size: 13px; color: #555;">' . htmlspecialchars($unit) . '</span>';
                                                                                }
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center; font-family: Arial, sans-serif;">
                                                                            <?php
                                                                            if ($night !== '0' && $night !== '' && $night !== '-') {
                                                                                // Split number and unit (e.g., "1 ml" → number = 1, unit = ml)
                                                                                $parts = preg_split('/(\d+)/', $night, -1, PREG_SPLIT_DELIM_CAPTURE);
                                                                                $number = $parts[1] ?? $night;  // the digits
                                                                                $unit = trim(str_replace($number, '', $night)); // everything else (ml, tab, etc.)
                                                    
                                                                                echo '<span style="font-size: 15px;">' . htmlspecialchars($number) . '</span>';
                                                                                if ($unit) {
                                                                                    echo ' <span style="font-size: 13px; color: #555;">' . htmlspecialchars($unit) . '</span>';
                                                                                }
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td style="border: 1px solid #000; padding: 6px;">
                                                                            <?= !empty($medicine['notes']) ? htmlspecialchars($medicine['notes']) : '-' ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td colspan="9"
                                                                        style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                        No medicines found.
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>


                                                <?php endif; ?>

                                                <!-- Attachments
                                                        <?php if (!empty($consultation['attachments'])): ?>
                                                            <p><strong>Attachments:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['attachments'] as $attach): ?>
                                                                    <li><?= $attach['file_name'] ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?> -->
                                                <!-- Attachments -->
                                                <?php if (!empty($consultation['attachments'])): ?>
                                                    <p><strong>Attachments:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['attachments'] as $attach): ?>
                                                            <?php
                                                            $filePath = base_url('uploads/consultations/' . $attach['file_name']);
                                                            $ext = pathinfo($attach['file_name'], PATHINFO_EXTENSION);
                                                            ?>
                                                            <li>
                                                                <a href="javascript:void(0);" class="openAttachment"
                                                                    data-file="<?= $filePath ?>" data-ext="<?= $ext ?>"
                                                                    data-context="dashboard">
                                                                    <?= htmlspecialchars($attach['file_name']) ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>


                                                <!-- Notes -->
                                                <?php if (!empty($consultation['notes'])): ?>
                                                    <p><strong>Notes:</strong></p>
                                                    <ul>
                                                        <li><?= $consultation['notes'] ?></li>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Next Follow-Up -->
                                                <?php if (!empty($consultation['next_follow_up'])): ?>
                                                    <p><strong>Next Follow-Up Date:</strong></p>
                                                    <ul>
                                                        <li><?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
                                                        </li>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- preview for consultaion model  -->
                                        <div class="modal fade" id="consultationModal<?= $consultation['id'] ?>" tabindex="-1"
                                            aria-labelledby="consultationModalLabel<?= $consultation['id'] ?>" aria-hidden="true"
                                            data-bs-backdrop="static" data-bs-keyboard="false">

                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">

                                                    <div class="modal-header"
                                                        style="border-bottom: none;display: flex;justify-content: flex-end;">
                                                        <div class="mb-2 px-2" style="text-align: right; font-size: 13px;"
                                                            data-consultation-id="<?= $consultation['id'] ?>">
                                                            <label style="margin-right: 15px;">
                                                                <input type="radio"
                                                                    name="language_select_<?= $consultation['id'] ?>"
                                                                    value="english" id="lang-en-<?= $consultation['id'] ?>" checked>
                                                                English
                                                            </label>
                                                            <label>
                                                                <input type="radio"
                                                                    name="language_select_<?= $consultation['id'] ?>" value="tamil"
                                                                    id="lang-ta-<?= $consultation['id'] ?>">
                                                                தமிழ் (Tamil)
                                                            </label>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body" style="background-color: #ffffffff;">
                                                        <div id="consultationDetails<?= $consultation['id'] ?>"
                                                            style="background: #fff; padding: 1px; width: 100%; margin: 0 auto; min-height: 500px; font-family: 'Noto Sans', sans-serif; font-size: 13px; color: #000; line-height: 1.4; box-sizing: border-box;">

                                                            <div class="mb-2"
                                                                style="border: 1px solid #cec8c8ff; border-radius: 5px; padding: 5px; width: 100%; box-sizing: border-box; display: flex; justify-content: space-between; align-items: flex-start;">

                                                                <div style="width: 65%;">
                                                                    <p class="mb-0"><strong>Name<span
                                                                                style="margin-right: 28px;"></span>:</strong>
                                                                        <?php echo $patientDetails[0]['firstName'] ?>
                                                                        <?php echo $patientDetails[0]['lastName'] ?>
                                                                    </p>
                                                                    <p class="mb-0"><strong>Age & Sex:</strong>
                                                                        <?php echo $patientDetails[0]['age'] ?> Year(s) /
                                                                        <?php echo $patientDetails[0]['gender'] ?>
                                                                    </p>
                                                                    <p class="mb-0"><strong>Patient ID<span
                                                                                style="margin-right: 3px;"></span>:</strong>
                                                                        <?php echo $patientDetails[0]['patientId'] ?>
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div style="display: flex; justify-content: flex-end;">
                                                                        <div style="text-align: left;">
                                                                            <div class="mb-0" style="white-space: nowrap;">
                                                                                <strong>Date:</strong>
                                                                                <span><?= date('d M Y', strtotime($consultation['consult_date'])) ?></span>
                                                                                <span style="margin: 0 5px;">|</span>
                                                                                <span><?= date('h:i A', strtotime($consultation['consult_time'])) ?></span>
                                                                            </div>
                                                                            <div class="mb-0">
                                                                                <strong>Mobile:</strong>
                                                                                <span><?= htmlspecialchars($patientDetails[0]['mobileNumber'] ?? '-') ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <?php if (!empty($consultation['symptoms'])): ?>
                                                                <div class="mb-0 px-2">
                                                                    <p class="mb-0">
                                                                        <strong>Symptoms:</strong>
                                                                        <span>
                                                                            <?php
                                                                            $items = [];
                                                                            foreach ($consultation['symptoms'] as $symptom) {
                                                                                $name = trim($symptom['symptom_name']);
                                                                                $details = [];
                                                                                if (!empty($symptom['since']))
                                                                                    $details[] = "since " . trim($symptom['since']);
                                                                                if (!empty($symptom['severity']))
                                                                                    $details[] = trim($symptom['severity']);
                                                                                if (!empty($details)) {
                                                                                    $items[] = $name . " (" . implode(', ', $details) . ")";
                                                                                } else {
                                                                                    $items[] = $name;
                                                                                }
                                                                            }
                                                                            echo implode(', ', $items) . '.';
                                                                            ?>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($consultation['diagnosis'])): ?>
                                                                <div class="mb-1 px-2">
                                                                    <p class="mb-0">
                                                                        <strong>Diagnosis:</strong>
                                                                        <span>
                                                                            <?php
                                                                            $items = [];
                                                                            foreach ($consultation['diagnosis'] as $diagnosis) {
                                                                                $name = trim($diagnosis['diagnosis_name']);
                                                                                $details = [];
                                                                                if (!empty($diagnosis['since']))
                                                                                    $details[] = "since " . trim($diagnosis['since']);
                                                                                if (!empty($diagnosis['severity']))
                                                                                    $details[] = trim($diagnosis['severity']);
                                                                                if (!empty($details)) {
                                                                                    $items[] = $name . " (" . implode(', ', $details) . ")";
                                                                                } else {
                                                                                    $items[] = $name;
                                                                                }
                                                                            }
                                                                            echo implode(', ', $items) . '.';
                                                                            ?>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($consultation['medicines'])): ?>
                                                                <table
                                                                    style="width: 100%; border-collapse: collapse; border: 1px solid #000; margin-top: 15px;"
                                                                    class="mb-3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th rowspan="2"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; width: 25px;">
                                                                                Rx</th>
                                                                            <th rowspan="2"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; width: 200px; font-size:14px; font-weight: bold;">
                                                                                Name</th>
                                                                            <th rowspan="2"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; width: 35px; font-size:14px; font-weight: bold;">
                                                                                Qty</th>
                                                                            <th rowspan="2"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:14px; font-weight: bold;">
                                                                                Food <br> Timing</th>
                                                                            <th colspan="4"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:14px; font-weight: bold;">
                                                                                Frequency</th>
                                                                            <th rowspan="2"
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; width: 200px; font-size:14px; font-weight: bold;">
                                                                                Notes</th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:13px; font-weight: bold;">
                                                                                Mrn</th>
                                                                            <th
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:13px; font-weight: bold;">
                                                                                Aft</th>
                                                                            <th
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:13px; font-weight: bold;">
                                                                                Eve</th>
                                                                            <th
                                                                                style="border: 1px solid #000; padding: 6px; text-align: center; font-size:13px; font-weight: bold;">
                                                                                Ngt</th>
                                                                        </tr>
                                                                    </thead>


                                                                    <tbody>
                                                                        <?php foreach ($consultation['medicines'] as $index => $medicine): ?>
                                                                            <?php
                                                                            $timingString = isset($medicine['timing']) ? trim($medicine['timing']) : '0-0-0-0';
                                                                            $timingParts = preg_split('/\s*-\s*/', $timingString);
                                                                            $timingParts = array_pad($timingParts, 4, '0');
                                                                            list($morning, $afternoon, $evening, $night) = $timingParts;
                                                                            ?>
                                                                            <tr>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?= $index + 1 ?>
                                                                                </td>

                                                                                <td style="border: 1px solid #000; padding: 6px;">
                                                                                    <div
                                                                                        style="display: flex; flex-direction: column; justify-content: center;">
                                                                                        <div
                                                                                            style="display: flex; flex-direction: row; align-items: baseline;">
                                                                                            <?php
                                                                                            $category = trim($medicine['category'] ?? '');
                                                                                            if ($category !== '' && strtolower($category) !== 'nil'):
                                                                                                ?>
                                                                                                <span
                                                                                                    style="font-size: 10px; color: #555; margin-right: 6px;">
                                                                                                    <?= htmlspecialchars($medicine['category']) ?>
                                                                                                </span>
                                                                                            <?php endif; ?>

                                                                                            <strong
                                                                                                style="font-size: 13px; line-height: 1.1;">
                                                                                                <?= htmlspecialchars($medicine['medicine_name']) ?>
                                                                                            </strong>
                                                                                        </div>
                                                                                        <?php
                                                                                        $composition = trim($medicine['composition_name'] ?? '');
                                                                                        if ($composition !== '' && strtolower($composition) !== 'nil'):
                                                                                            ?>
                                                                                            <span
                                                                                                style="font-size: 11px; font-style: italic; color: #444; line-height: 1; margin-top: 2px;">
                                                                                                <?= htmlspecialchars($medicine['composition_name']) ?>
                                                                                            </span>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </td>

                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?= htmlspecialchars($medicine['quantity'] ?? '-') ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?= htmlspecialchars($medicine['food_timing'] ?? '-') ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?php if ($morning !== '0' && $morning !== '-'):
                                                                                        echo $morning;
                                                                                    else:
                                                                                        echo '-';
                                                                                    endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?php if ($afternoon !== '0' && $afternoon !== '-'):
                                                                                        echo $afternoon;
                                                                                    else:
                                                                                        echo '-';
                                                                                    endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?php if ($evening !== '0' && $evening !== '-'):
                                                                                        echo $evening;
                                                                                    else:
                                                                                        echo '-';
                                                                                    endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?php if ($night !== '0' && $night !== '-'):
                                                                                        echo $night;
                                                                                    else:
                                                                                        echo '-';
                                                                                    endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; line-height: 1.2; font-size: 14px; text-align: <?= !empty($medicine['notes']) ? 'left' : 'center' ?>;">
                                                                                    <?= !empty($medicine['notes']) ? htmlspecialchars($medicine['notes']) : '-' ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            <?php endif; ?>
                                                            <?php if (!empty($consultation['instructions'])): ?>
                                                                <div class="mb-3 px-2">
                                                                    <p class="mb-1"><strong>Instructions:</strong></p>
                                                                    <ul style="margin-top: 0; padding-left: 20px; margin-bottom: 5px;">
                                                                        <?php foreach ($consultation['instructions'] as $ins): ?>
                                                                            <li><?= $ins['instruction_name'] ?></li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($consultation['next_follow_up'])): ?>
                                                                <div class="mt-3 px-2">
                                                                    <p style="margin: 0;">
                                                                        <strong>Next Follow-Up Date:</strong>
                                                                        <span
                                                                            style="margin-left: 5px;"><?= date("d M Y", strtotime($consultation['next_follow_up'])) ?></span>
                                                                    </p>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div class="mt-4 px-2"
                                                                style="display: flex; justify-content: flex-end; margin-top: 40px; margin-bottom: 20px;">
                                                                <div style="text-align: center; width: auto;">

                                                                    <img src="<?= base_url('assets/Signature.jpeg') ?>"
                                                                        alt="Doctor's Signature"
                                                                        style="height: 60px; width: auto; display: block; margin-right: 30px;">

                                                                    <div style="text-align: left; margin-top: 5px;">
                                                                        <p style="margin: 0; font-weight: bold; font-size: 14px;">
                                                                            Dr. A. S. Senthilvelu</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary download-pdf-btn"
                                                            style="padding: 2px 4px; width:45px; height:45px;"
                                                            data-content-id="consultationDetails<?= $consultation['id'] ?>"
                                                            data-filename="Consultation_<?= $patientDetails[0]['patientId'] ?>_<?= $consultation['id'] ?>.pdf">
                                                            <i class="bi bi-download"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            style="padding: 2px 4px; width:45px; height:45px;"
                                                            onclick="printDiv('consultationDetails<?= $consultation['id'] ?>', 'Consultation_<?= $patientDetails[0]['patientId'] ?>_<?= $consultation['id'] ?>')">
                                                            <i class="bi bi-printer"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>No Previous Consultation.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <?php
        } else if ($method == "appointments") {
            ?>
                <section>
                    <div class="card rounded">
                        <div class="mt-2 p-3 pt-sm-4 px-sm-4">
                            <p style="font-size: 24px; font-weight: 500"> Appointments</p>
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
                                                <span class="input-group-text" id="searchIconHcp">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" id="searchInputHcp" class="form-control" placeholder="Search by name"
                                                    aria-describedby="searchIconHcp">
                                                <button class="btn btn-outline-secondary" type="button" id="clearSearchHcp">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                <?php if (isset($hcpDetails[0]['id'])) {
                    ?>

                                        <div class="container">
                                            <div class="row justify-content-center" id="hcpContainer"></div>
                                            <div class="pagination justify-content-center mt-3" id="paginationContainerHcp"></div>
                                        </div>

                <?php } else { ?>
                                        <h5 class="card text-center p-3"><b>No Records Found.</b> </h5>
                <?php } ?>

                                </section>

                                <script>
                                    const itemsPerPageHcp = 6;
                                    const hcpDetails = <?php echo json_encode($hcpDetails); ?>;
                                    let filteredHcpDetails = hcpDetails;
                                    const initialPageHcp = parseInt(localStorage.getItem('currentPageHcp')) || 1;

                                    function displayHcpPage(page) {
                                        localStorage.setItem('currentPageHcp', page);
                                        const start = (page - 1) * itemsPerPageHcp;
                                        const end = start + itemsPerPageHcp;
                                        const itemsToShow = filteredHcpDetails.slice(start, end);

                                        const hcpContainer = document.getElementById('hcpContainer');
                                        hcpContainer.innerHTML = '';

                                        if (itemsToShow.length === 0) {
                                            const noMatchesDiv = document.createElement('div');
                                            noMatchesDiv.className = 'col-12 text-center';
                                            noMatchesDiv.innerHTML = '<p>No matches found.</p>';
                                            hcpContainer.appendChild(noMatchesDiv);
                                        } else {
                                            itemsToShow.forEach(value => {
                                                const hcpItem = document.createElement('div');
                                                hcpItem.className = 'card col-lg-4 m-3 hcp-item';
                                                hcpItem.innerHTML =
                                                    '<div class=\'d-sm-flex justify-content-evenly text-center p-4\'>' +
                                                    '<img src="' + (value.hcpPhoto ? '<?php echo base_url(); ?>uploads/' + value.hcpPhoto : '<?php echo base_url(); ?>assets/BlankProfile.jpg') + 'alt="Profile Photo" width="122" height="122" class="rounded-circle my-auto" ' +
                                                    'onerror="this.onerror=null;this.src=\'<?php echo base_url(); ?>assets/BlankProfile.jpg\';">' +
                                                    '<div>' +
                                                    '<p class=\'card-title\'><b>' + value.hcpName + '</b> /<br>' + value.hcpId + '</p>' +
                                                    '<p style=\'color: #2F80ED;\'><b>' + value.hcpSpecialization + '</b></p>' +
                                                    '<a href=\'<?php echo base_url(); ?>Patient/healthCareProvidersProfile/' + value.id + '\' ' +
                                                    'class=\'btn btn-secondary\'>Full Details</a>' +
                                                    '</div>' +
                                                    '</div>';
                                                hcpContainer.appendChild(hcpItem);
                                            });
                                        }

                                        generateHcpPagination(filteredHcpDetails.length, page);
                                    }

                                    function generateHcpPagination(totalItems, currentPage) {
                                        const totalPages = Math.ceil(totalItems / itemsPerPageHcp);
                                        const paginationContainer = document.getElementById('paginationContainerHcp');
                                        paginationContainer.innerHTML = '';

                                        const ul = document.createElement('ul');
                                        ul.className = 'pagination';

                                        const prevLi = document.createElement('li');
                                        prevLi.innerHTML =
                                            '<a href=\'#\'>' +
                                            '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === 1 ? 'disabled' : '') + '>&lt;</button>' +
                                            '</a>';
                                        prevLi.onclick = () => {
                                            if (currentPage > 1) displayHcpPage(currentPage - 1);
                                        };
                                        ul.appendChild(prevLi);

                                        for (let i = 1; i <= totalPages; i++) {
                                            const li = document.createElement('li');
                                            li.innerHTML =
                                                '<a href=\'#\'>' +
                                                '<button type=\'button\' class=\'btn border px-3 py-2 ' + (i === currentPage ? 'btn-secondary text-light' : '') + '\'>' + i + '</button>' +
                                                '</a>';
                                            li.onclick = () => displayHcpPage(i);
                                            ul.appendChild(li);
                                        }

                                        const nextLi = document.createElement('li');
                                        nextLi.innerHTML =
                                            '<a href=\'#\'>' +
                                            '<button type=\'button\' class=\'bg-light border px-3 py-2\' ' + (currentPage === totalPages ? 'disabled' : '') + '>&gt;</button>' +
                                            '</a>';
                                        nextLi.onclick = () => {
                                            if (currentPage < totalPages) displayHcpPage(currentPage + 1);
                                        };
                                        ul.appendChild(nextLi);

                                        paginationContainer.appendChild(ul);
                                    }

                                    document.getElementById('searchInputHcp').addEventListener('keyup', function () {
                                        const searchQuery = this.value.toLowerCase();
                                        filteredHcpDetails = hcpDetails.filter(item => item.hcpName.toLowerCase().includes(searchQuery));
                                        displayHcpPage(1);
                                    });

                                    document.getElementById('clearSearchHcp').addEventListener('click', function () {
                                        document.getElementById('searchInputHcp').value = '';
                                        filteredHcpDetails = hcpDetails;
                                        displayHcpPage(1);
                                    });

                                    displayHcpPage(initialPageHcp);
                                </script>

            <?php
        } else if ($method == "hcpsProfile") {
            ?>
                                    <section>
                                        <div class="card rounded">
                                            <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                                                <p style="font-size: 24px; font-weight: 500"> Health Care Provider Profile</p>
                                                <button onclick="goBack()" class="border-0 bg-light float-end text-dark pb-3"><i
                                                        class="bi bi-arrow-left"></i> Back</button>
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
                                                            <img src="<?php echo base_url(); ?>assets/BlankProfile.jpg" alt="Profile Photo" width="140"
                                                                height="140" class="rounded-circle">
                                <?php } ?>
                                                        <div class="ps-sm-5">
                                                            <p style="font-size:20px;font-weight:500;">Dr.
                                        <?php echo $value['hcpName']; ?>
                                                            </p>
                                                            <p style="font-size:16px;font-weight:400;color: #2F80ED;">
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

                                                    <p class="my-3 fs-5 fw-semibold">Profile Details</p>

                                                    <div class="d-md-flex pb-1">
                                                        <p class="text-secondary col-md-3 mb-1">Years of Experience : </p>
                                                        <p class="col-md-9 ps-2">
                                    <?php echo $value['hcpExperience'] ? $value['hcpExperience'] : "-"; ?>
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
        } else if ($method == "chiefDoctors") {
            ?>
                                        <section>
                                            <div class="card rounded">
                                                <div class="d-sm-flex justify-content-between p-3">
                                                    <p class="ps-2 m-0" style="font-size: 24px; font-weight: 500">
                                                        Chief Consultants
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
                                                            '<p style=\'color: #2F80ED;\'><b>' + value.specialization + '</b></p>' +
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
                                                            Chief Consultant Profile </p>
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
                                                                    <p style="font-size:16px;font-weight:400;color:#2F80ED;">
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Previous and Next arrows script in consulation dashboard page -->
    <script>
        let currentIndex = 0;
        const consultationItems = document.querySelectorAll('.consultation-item');
        const totalItems = consultationItems.length;
        const counterDisplay = document.getElementById('consultation-counter');
        const navLeft = document.getElementById('nav-left');
        const navRight = document.getElementById('nav-right');

        function updateCounterAndButtons() {
            counterDisplay.textContent = ` ${currentIndex + 1} of ${totalItems} `;
            navLeft.disabled = currentIndex === 0;
            navRight.disabled = currentIndex === totalItems - 1;
        }

        function navigateConsultations(direction) {
            if ((direction === -1 && currentIndex === 0) || (direction === 1 && currentIndex === totalItems - 1)) {
                return;
            }
            consultationItems[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            consultationItems[currentIndex].classList.add('active');
            updateCounterAndButtons();
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft' && currentIndex > 0) {
                navigateConsultations(-1);
            } else if (event.key === 'ArrowRight' && currentIndex < totalItems - 1) {
                navigateConsultations(1);
            }
        });

        updateCounterAndButtons();
    </script>

    <!-- Consultation - PDF Download Script -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const downloadButtons = document.querySelectorAll('.download-pdf-btn');

            downloadButtons.forEach(button => {
                const originalButtonHtml = button.innerHTML;

                button.addEventListener('click', async function (event) {
                    button.disabled = true;
                    button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

                    const contentId = event.currentTarget.getAttribute('data-content-id');
                    const fileName = event.currentTarget.getAttribute('data-filename');
                    const sourceElement = document.getElementById(contentId);

                    if (!sourceElement) {
                        resetButton(button, originalButtonHtml);
                        return;
                    }

                    try {
                        const pages = await generateVirtualPages(sourceElement);

                        const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                        const pdfWidth = pdf.internal.pageSize.getWidth();

                        for (let i = 0; i < pages.length; i++) {
                            const page = pages[i];

                            document.body.appendChild(page);

                            const canvas = await html2canvas(page, {
                                scale: 1,
                                backgroundColor: '#ffffff',
                                logging: false,
                                useCORS: true
                            });

                            document.body.removeChild(page);

                            const imgData = canvas.toDataURL('image/png');

                            if (i > 0) pdf.addPage();

                            const imgProps = pdf.getImageProperties(imgData);
                            const imgHeight = (imgProps.height * pdfWidth) / imgProps.width;

                            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, imgHeight);
                        }

                        pdf.save(fileName);
                        resetButton(button, originalButtonHtml);

                    } catch (err) {
                        console.error('PDF Error:', err);
                        resetButton(button, originalButtonHtml);
                    }
                });
            });

            function resetButton(btn, originalHtml) {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                const modalElement = btn.closest('.modal');
                if (modalElement) {
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) modalInstance.hide();
                    // Ensure backdrop is removed
                    document.querySelector('.modal-backdrop')?.remove();
                }
            }

            async function generateVirtualPages(source) {
                const pages = [];

                const PAGE_WIDTH = 794;  // Standard A4 Web Width (px)
                const PAGE_HEIGHT = 1122; // Standard A4 Web Height (px)
                const MARGIN = 30;

                const CONTENT_LIMIT = 1010;

                function createNewPage() {
                    const div = document.createElement('div');
                    div.style.width = `${PAGE_WIDTH}px`;
                    div.style.height = `${PAGE_HEIGHT}px`;
                    div.style.position = 'fixed';
                    div.style.left = '-10000px';
                    div.style.top = '0';
                    div.style.backgroundColor = '#fff';
                    div.style.padding = `${MARGIN}px`;
                    div.style.boxSizing = 'border-box';
                    div.style.fontFamily = "'Noto Sans', sans-serif";
                    div.style.color = '#000';
                    return div;
                }

                const tempContainer = document.createElement('div');
                tempContainer.style.width = `${PAGE_WIDTH}px`;
                tempContainer.innerHTML = source.innerHTML;

                const children = Array.from(tempContainer.children);

                let currentPage = createNewPage();
                document.body.appendChild(currentPage);

                let currentHeight = 0;

                function addNewPage() {
                    document.body.removeChild(currentPage);
                    pages.push(currentPage);

                    currentPage = createNewPage();
                    document.body.appendChild(currentPage);
                    currentHeight = 0;
                }

                for (let child of children) {
                    const isTable = child.tagName === 'TABLE';

                    if (isTable) {
                        const thead = child.querySelector('thead');
                        const tbody = child.querySelector('tbody');
                        const rows = Array.from(tbody.querySelectorAll('tr'));

                        let currentTable = child.cloneNode(false);
                        currentTable.style.marginTop = '0';
                        currentTable.style.marginBottom = '0';
                        currentTable.appendChild(thead.cloneNode(true));
                        let currentTbody = document.createElement('tbody');
                        currentTable.appendChild(currentTbody);

                        currentPage.appendChild(currentTable);

                        const headerHeight = thead.offsetHeight || 50;
                        currentHeight += headerHeight;

                        for (let row of rows) {
                            currentTbody.appendChild(row);
                            const rowHeight = row.offsetHeight || 30;

                            if (currentHeight + rowHeight > CONTENT_LIMIT) {
                                currentTbody.removeChild(row); // Remove from here

                                addNewPage();

                                currentTable = child.cloneNode(false);
                                currentTable.style.marginTop = '0';
                                currentTable.style.marginBottom = '0';
                                currentTable.appendChild(thead.cloneNode(true)); // Header Again
                                currentTbody = document.createElement('tbody');
                                currentTable.appendChild(currentTbody);

                                currentPage.appendChild(currentTable);
                                currentHeight += headerHeight; // Header uses space

                                // Add Row to New Page
                                currentTbody.appendChild(row);
                                currentHeight += rowHeight;
                            } else {
                                // Fits fine
                                currentHeight += rowHeight;
                            }
                        }
                    } else {
                        currentPage.appendChild(child);
                        const blockHeight = child.offsetHeight;

                        if (currentHeight + blockHeight > CONTENT_LIMIT) {
                            currentPage.removeChild(child);
                            addNewPage();
                            currentPage.appendChild(child);
                            currentHeight = blockHeight;
                        } else {
                            currentHeight += blockHeight;
                        }
                    }
                }

                if (document.body.contains(currentPage)) {
                    document.body.removeChild(currentPage);
                }
                pages.push(currentPage);

                return pages;
            }
        });
    </script>

    <!-- To print consultation -->
    <script>
        function printDiv(divId, title) {
            var printContents = document.getElementById(divId).outerHTML;
            var originalContents = document.body.innerHTML;
            var originalTitle = document.title;

            document.body.innerHTML = printContents;

            if (title) {
                document.title = title;
            }

            window.print();

            document.body.innerHTML = originalContents;
            document.title = originalTitle;

            window.location.reload();
        }
    </script>

    <!-- script to Translate table in preview -->
    <script>
        const translationMap = {
            'Name': 'மருந்து',
            'Qty': 'அளவு',
            'Food <br> Timing': 'உணவுக்கு',
            'Frequency': 'வேளை',
            'Notes': 'குறிப்புகள்',
            'Mrn': 'காலை',
            'Aft': 'மதியம்',
            'Eve': 'மாலை',
            'Ngt': 'இரவு',

            'Before': 'முன்',
            'After': 'பின்',
            'before': 'முன்',
            'after': 'பின்'
        };

        const reverseTranslationMap = {
            'மருந்து': 'Name',
            'அளவு': 'Qty',
            'உணவுக்கு': 'Food <br> Timing',
            'வேளை': 'Frequency',
            'குறிப்புகள்': 'Notes',
            'காலை': 'Mrn',
            'மதியம்': 'Aft',
            'மாலை': 'Eve',
            'இரவு': 'Ngt',

            'முன்': 'Before',
            'பின்': 'After'
        };

        function updateTableHeadings(consultationId, language) {
            const tableContainer = document.getElementById('consultationDetails' + consultationId);
            if (!tableContainer) return;

            const tableElement = tableContainer.querySelector('table');
            if (!tableElement) return;

            const map = (language === 'tamil') ? translationMap : reverseTranslationMap;

            const theads = tableElement.querySelectorAll('thead th');
            theads.forEach(th => {
                let originalText = th.innerHTML;
                let cleanText = originalText.replace(/<br\s*\/?>/gi, ' <br> ').replace(/\s+/g, ' ').trim();

                if (map[cleanText]) {
                    th.innerHTML = map[cleanText];
                }
            });

            const rows = tableElement.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                if (cells.length > 3) {
                    const timingCell = cells[3];
                    const currentText = timingCell.textContent.trim();

                    if (map[currentText]) {
                        timingCell.textContent = map[currentText];
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('input[name^="language_select_"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    if (e.target.checked) {
                        const language = e.target.value;
                        const parentDiv = e.target.closest('div[data-consultation-id]');
                        if (parentDiv) {
                            const consultationId = parentDiv.getAttribute('data-consultation-id');
                            updateTableHeadings(consultationId, language);
                        }
                    }
                });
            });

            const consultationModals = document.querySelectorAll('[id^="consultationModal"]');

            consultationModals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function () {
                    const consultationId = this.id.replace('consultationModal', '');

                    const englishRadio = document.getElementById('lang-en-' + consultationId);
                    if (englishRadio) {
                        englishRadio.checked = true;
                    }

                    updateTableHeadings(consultationId, 'english');
                });
            });
        });
    </script>


    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- PDF Download link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <!-- Consultation Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</body>

</html>