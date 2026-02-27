<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon" />
    <title>HCP Patients - EDF</title>
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Drad and drop -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <!-- cropper CND -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .fieldLabel {
            font-weight: 500;
        }

        .fieldStyle {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px;
        }

        /* ********************************************************** */
        .tags-input {
            display: flex;
            flex-wrap: wrap;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            min-height: 46px;
            cursor: text;
        }

        .tags-input .tag {
            margin: 2px;
        }

        .suggestions-box {
            border: 1px solid #b6e1fdff;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            position: relative;
            background: #f3f5f8ff;
            width: 100%;
            z-index: 900;
        }

        .suggestions-box div {
            padding: 8px;
            cursor: pointer;
        }

        .suggestions-box div:hover {
            background-color: #dae9f8ff;
        }

        #consultationTabs {
            border-bottom: 2px solid #cccdcdff;
            gap: 6px;
        }

        #consultationTabs .nav-link {
            border: none;
            border-radius: 4px 4px 0 0;
            background: #d5d5d5ff;
            color: #495057;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.
        }

        #consultationTabs .nav-link.active {
            background: #bababaff;
            color: #000;
            font-weight: 600;
            border: 2px solid #9b9d9cff;
            border-bottom: none;
            border-radius: 4px 4px 0 0;
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

        /* Attachment display */
        #attachmentImage {
            width: 600px;
            height: 500px;
            object-fit: contain;
        }

        #prevAttachment,
        #nextAttachment {
            padding: 10px 15px;
            border-radius: 5;
            margin: 10px;
        }

        #prevAttachment {
            left: 10px;
            z-index: 1055;
        }

        #nextAttachment {
            right: 10px;
        }

        /*-----------------------Edit-Page------------------*/
        #imageEditModal .modal-xl {
            max-width: 1200px;
        }

        #imageEditModal .modal-content {
            overflow: hidden;
        }

        #imageEditModal .modal-body {
            padding: 20px;
            max-height: 80vh;
            overflow: auto;
        }

        #imageEditModal .editor-container {
            width: 100%;
            min-width: 600px;
            min-height: 600px;
            max-width: 90vw;
            max-height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            /* Light background for better visibility */
            border: 1px solid #dee2e6;
            /* Subtle border */
            border-radius: 4px;
        }

        #imageEditModal #editor-image,
        #imageEditModal #editor-canvas {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .modal-footer {
            position: relative;
            z-index: 1000;
            padding: 15px;
        }

        .modal-footer .btn {
            position: relative;
            z-index: 1001;
            width: 100px;
            text-align: center;
        }

        /* Make Models draggable for all specified modals */
        #symptomsModal .modal-header,
        #inputModal .modal-header,
        #diagnosisModal .modal-header,
        #investigationsModal .modal-header,
        #medicinesModal .modal-header {
            cursor: move;
            user-select: none;
        }

        /* Dashboard Attachment Preview */
        #dashboardPreviewModal .modal-body::before,
        #dashboardPreviewModal .modal-body::after {
            content: '';
            position: absolute;
            top: 0;
            width: 60px;
            height: 100%;
            background: #fff;
            z-index: 1;
            pointer-events: none;
        }

        #dashboardPreviewModal .modal-body::before {
            left: 0;
        }

        #dashboardPreviewModal .modal-body::after {
            right: 0;
        }

        #dashboardPreviewModal #prevAttachment,
        #dashboardPreviewModal #nextAttachment {
            z-index: 10;
        }

        /*Attachment Preview for Edit, followUp and New Consultant Page */
        #editPreviewModal #filePreviewContent,
        #followupPreviewModal #followup-content-wrapper,
        #newConsultationPreviewModal #newconsultation-content-wrapper {
            max-height: calc(75vh - 120px);
            min-height: 400px;
            overflow: auto;
            padding-left: 50px;
            padding-right: 50px;
        }

        #editPreviewModal #filePreviewContent img,
        #followupPreviewModal #followup-content-wrapper img,
        #newConsultationPreviewModal #newconsultation-content-wrapper img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        #editPreviewModal #filePreviewContent iframe {
            width: 100%;
            height: 70vh;
            border: none;
        }

        /* Limit height of dropdown and make it scrollable */
        #procedureList,
        #adviceList,
        #instructionList {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            border: 1px solid #ccc;
            padding: 5px;
            background-color: #00ad8d12;
            border-radius: 4px;
        }

        /* Medicines timing option in 2 lines */
        #timingOptions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        #timingOptions .form-check {
            width: 48%;
        }

        /* --- For Action icons in suggestion Box --- */
        /* --- Action icons in suggestion box (Icon only) --- */
        .action-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 0.8rem;
            padding: 3px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .action-icon.delete {
            color: #d63e4eff;
        }

        .action-icon.edit {
            margin-right: 10px;
        }

        .action-icon:hover {
            border: 1px solid #000;
            border-radius: 20%;
        }

        /*  Print consultaion page format*/
        @media print {
            @page {
                margin: 40px 15px 40px 15px;
                size: auto;
            }

            body {
                margin: 0px !important;
                padding: 0px !important;
                -webkit-print-color-adjust: exact;
            }

            tr {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            #consultationDetails<?= $consultation['id'] ?> {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        }

        #medicinesList span {
            cursor: grab;
        }

        #medicinesList span:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: 0.4;
        }

        /* Send mail from consultation to patient checkbox styles */
        .form-check-input:checked {
            border-color: #2b353b;
        }

        .form-check-input:disabled {
            opacity: 1;
            background-color: #dee2e6;
            border-color: #2b353b;
        }

        .form-check-input:disabled+.form-check-label {
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <?php $this->load->view('hcpHeader'); ?>

    <main id="main" class="main">
        <?php
        // 1. Get the message from either Flashdata OR Tempdata
        $successMsg = $this->session->flashdata('showSuccessMessage') ?: $this->session->tempdata('showSuccessMessage');
        $errorMsg = $this->session->flashdata('showErrorMessage') ?: $this->session->tempdata('showErrorMessage');
        ?>

        <?php if ($successMsg) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color: #d4edda;color: #155724;padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $successMsg; ?>
            </div>
        <?php } elseif ($errorMsg) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color:rgb(237, 212, 212);color:rgb(87, 21, 21);padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $errorMsg; ?>
            </div>
        <?php }
        if ($method == "consultDashboard") { ?>
            <section>
                <div class="card rounded pb-3">
                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                        <div class="border border-2 rounded text-center py-2 position-relative px-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                <a href="<?php echo base_url() . "Healthcareprovider/patientformUpdate/" . $value['id']; ?>"
                                    class="position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-secondary btn-sm"><i class="bi bi-pen"></i></button>
                                </a>
                                <p style="font-size: 16px; font-weight: 700">
                                    <?php echo $value['firstName'] ?>         <?php echo $value['lastName'] ?> |
                                    <?php echo $value['patientId'] ?>
                                </p>
                                <p>
                                    <a href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?>
                                        <?php
                                        if (!empty($value['derived_dob'])) {
                                            $dob = new DateTime($value['derived_dob']);
                                            $today = new DateTime();
                                            $currentAge = $today->diff($dob)->y;
                                        } else {
                                            $currentAge = $value['age'];
                                        } ?>
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $currentAge ?> Year(s)
                                </p>
                            <?php } ?>
                        </div>
                        <button onclick="goBack()" class="border-0 bg-light float-end text-dark mb-5"><i
                                class="bi bi-arrow-left"></i> Back</button>
                    </div>

                    <div class="card-body mx-3 px-md-4">
                        <ul class="nav nav-tabs mb-3" id="consultationTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn" id="new-tab" data-bs-toggle="tab"
                                    data-bs-target="#consultation-dashboard" type="button" role="tab">
                                    Consultation Dashboard
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn" id="new-tab" data-bs-toggle="tab"
                                    data-bs-target="#new-consultation" type="button" role="tab">
                                    New Consultation
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content border p-4 rounded shadow-sm" id="consultationTabsContent">
                            <!-- Consultation Dashboard -->
                            <div class="tab-pane fade active show" id="consultation-dashboard" role="tabpanel">
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
                                            <div class="consultation-item <?= $index === 0 ? 'active' : '' ?>"
                                                data-index="<?= $index ?>">
                                                <div class="border border-5 mb-3 shadow-sm">
                                                    <div class="card-body" id="consultation-content-<?= $consultation['id'] ?>">
                                                        <div class="d-md-flex justify-content-between">
                                                            <h5 class="card-title mb-0">
                                                                <?= date('d M Y', strtotime($consultation['consult_date'])) . " - " . date('h:i A', strtotime($consultation['consult_time'])) ?>
                                                            </h5>
                                                            <div class="mt-md-3 mb-4 mb-md-0">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-toggle="modal" title="Preview Consultation"
                                                                    data-bs-target="#consultationModal<?= $consultation['id'] ?>">
                                                                    <i class="bi bi-eye"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger"
                                                                    title="Delete Consultation"
                                                                    onclick="confirmDeleteConsult('<?php echo $patientDetails[0]['id']; ?>','<?php echo $consultation['id']; ?>', '<?php echo date('d M Y', strtotime($consultation['consult_date'])); ?>', '<?php echo date('h:i A', strtotime($consultation['consult_time'])); ?>')">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>

                                                                <button class="btn btn-secondary" title="Edit Consultation"
                                                                    onclick="window.location.href='<?php echo site_url('Consultation/editConsultation/' . $consultation['id']); ?>'">
                                                                    <i class="bi bi-pen"></i>
                                                                </button>

                                                                <button class="btn text-light" style="background-color: #00ad8e;"
                                                                    title="Follow-up Consultation"
                                                                    onclick="window.location.href='<?php echo site_url('Consultation/followupConsultation/' . $consultation['id']); ?>'">
                                                                    Follow-up / Repeat
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
                                                            <table
                                                                style="width: 100%; border-collapse: collapse; border: 1px solid #000;"
                                                                class="mb-3">
                                                                <thead>
                                                                    <!-- First header row -->
                                                                    <tr>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            S.No</th>
                                                                        <th rowspan="2"
                                                                            style="border: 1px solid #000; padding: 6px;  text-align: center;">
                                                                            Medicine</th>
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
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 10px; text-align: center;">
                                                                            Morning</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                            Afternoon</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 10px; text-align: center;">
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
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
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
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
                                                                                    <?= htmlspecialchars(trim($medicine['quantity'] ?? '') ?: '-') ?>

                                                                                </td>
                                                                                <td
                                                                                    style="border: 1px solid #000; padding: 6px; text-align: center;">
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

                                                        <!-- Diet Plan -->
                                                        <?php if (!empty($consultation['dietPlan'])): ?>
                                                            <div style="margin-bottom: 15px;"><strong>Diet Plan:</strong>
                                                                <p class="m-0 ps-3 pt-1">
                                                                    <?= nl2br(htmlspecialchars($consultation['dietPlan'])) ?>
                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- Notes -->
                                                        <?php if (!empty($consultation['notes'])): ?>
                                                            <div style="margin-bottom: 15px;"><strong>Notes:</strong>
                                                                <p class="m-0 ps-3 pt-1">
                                                                    <?= nl2br(htmlspecialchars($consultation['notes'])) ?>
                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- Next Follow-Up -->
                                                        <?php if (!empty($consultation['next_follow_up'])): ?>
                                                            <div style="margin-bottom: 15px;"><strong>Next Follow-Up Date:</strong>
                                                                <p class="m-0 ps-3 pt-1">
                                                                    <?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
                                                                </p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <!-- Preview for consultaion model  -->
                                                <div class="modal fade" id="consultationModal<?= $consultation['id'] ?>"
                                                    tabindex="-1" aria-labelledby="consultationModalLabel<?= $consultation['id'] ?>"
                                                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">

                                                            <div class="modal-header"
                                                                style="border-bottom: none;display: flex;justify-content: flex-end;">
                                                                <div class="mb-2 px-2" style="text-align: right; font-size: 13px;"
                                                                    data-consultation-id="<?= $consultation['id'] ?>">
                                                                    <label style="margin-right: 15px;">
                                                                        <input type="radio"
                                                                            name="language_select_<?= $consultation['id'] ?>"
                                                                            value="english" id="lang-en-<?= $consultation['id'] ?>"
                                                                            checked>
                                                                        English
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio"
                                                                            name="language_select_<?= $consultation['id'] ?>"
                                                                            value="tamil" id="lang-ta-<?= $consultation['id'] ?>">
                                                                        தமிழ் (Tamil)
                                                                    </label>
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body" style="background-color: #ffffffff;">
                                                                <div id="consultationDetails<?= $consultation['id'] ?>"
                                                                    style="background: #fff; padding: 1px; width: 100%; margin: 0 auto; min-height: 500px; font-family: 'Noto Sans', sans-serif; font-size: 12px; color: #000; line-height: 1.4; box-sizing: border-box;">

                                                                    <div class="mb-2"
                                                                        style="border: 1px solid #cec8c8ff; border-radius: 5px; padding: 5px; width: 100%; box-sizing: border-box; display: flex; justify-content: space-between; align-items: flex-start;">

                                                                        <div style="width: 65%;">
                                                                            <p class="mb-0"><strong>Name<span
                                                                                        style="margin-right: 28px;"></span>:</strong>
                                                                                <?php echo $patientDetails[0]['firstName'] ?>
                                                                                <?php echo $patientDetails[0]['lastName'] ?>
                                                                            </p>
                                                                            <p class="mb-0"><strong>Age & Sex:</strong>
                                                                                <?php
                                                                                if (!empty($patientDetails[0]['derived_dob'])) {
                                                                                    $dob = new DateTime($patientDetails[0]['derived_dob']);
                                                                                    $today = new DateTime();
                                                                                    $currentAge = $today->diff($dob)->y;
                                                                                } else {
                                                                                    $currentAge = $patientDetails[0]['age'];
                                                                                } ?>
                                                                                <?php echo $currentAge ?> Year(s) /
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
                                                                                        <strong>Consult Date:</strong>
                                                                                        <span><?= date('d M Y', strtotime($consultation['consult_date'])) ?></span>
                                                                                        <!-- <span style="margin: 0 5px;">|</span>
                                                                                        <span><?= date('h:i A', strtotime($consultation['consult_time'])) ?></span> -->
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
                                                                                            $details[] = "Since: " . trim($symptom['since']);
                                                                                        if (!empty($symptom['severity']))
                                                                                            $details[] = trim($symptom['severity']);
                                                                                        if (!empty($symptom['note']))
                                                                                            $details[] = "Note: " . trim($symptom['note']);
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
                                                                                            $details[] = "Location: " . trim($diagnosis['since']);
                                                                                        if (!empty($diagnosis['severity']))
                                                                                            $details[] = trim($diagnosis['severity']);
                                                                                        if (!empty($diagnosis['note']))
                                                                                            $details[] = "Note: " . trim($diagnosis['note']);
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
                                                                            style="width: 100%; border-collapse: collapse; border: 0.5px solid #A9A9A9; margin-top: 15px;font-size: 12px"
                                                                            class="mb-2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th rowspan="2"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; width: 25px;">
                                                                                        Rx</th>
                                                                                    <th rowspan="2"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; width: 200px; font-size:12px; font-weight: bold;">
                                                                                        Medicine</th>
                                                                                    <th rowspan="2"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; width: 35px; font-size:12px; font-weight: bold;">
                                                                                        Qty</th>
                                                                                    <th rowspan="2"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
                                                                                        Food <br> Timing</th>
                                                                                    <th colspan="4"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
                                                                                        Frequency</th>
                                                                                    <th rowspan="2"
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; width: 200px; font-size:12px; font-weight: bold;">
                                                                                        Notes</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
                                                                                        Mrn</th>
                                                                                    <th
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
                                                                                        Aft</th>
                                                                                    <th
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
                                                                                        Eve</th>
                                                                                    <th
                                                                                        style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center; font-size:12px; font-weight: bold;">
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
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?= $index + 1 ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px;">
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
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?= htmlspecialchars($medicine['quantity'] ?? '-') ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?= htmlspecialchars($medicine['food_timing'] ?? '-') ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?php if ($morning !== '0' && $morning !== '-'):
                                                                                                echo $morning;
                                                                                            else:
                                                                                                echo '-';
                                                                                            endif; ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?php if ($afternoon !== '0' && $afternoon !== '-'):
                                                                                                echo $afternoon;
                                                                                            else:
                                                                                                echo '-';
                                                                                            endif; ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?php if ($evening !== '0' && $evening !== '-'):
                                                                                                echo $evening;
                                                                                            else:
                                                                                                echo '-';
                                                                                            endif; ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; text-align: center;">
                                                                                            <?php if ($night !== '0' && $night !== '-'):
                                                                                                echo $night;
                                                                                            else:
                                                                                                echo '-';
                                                                                            endif; ?>
                                                                                        </td>
                                                                                        <td
                                                                                            style="border: 0.5px solid #A9A9A9; padding: 4px; line-height: 1.2; font-size: 12px; text-align: <?= !empty($medicine['notes']) ? 'left' : 'center' ?>;">
                                                                                            <?= !empty($medicine['notes']) ? htmlspecialchars($medicine['notes']) : '-' ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    <?php endif; ?>
                                                                    <?php if (!empty($consultation['advices'])): ?>
                                                                        <div style="margin-bottom: 8px;">
                                                                            <p style="margin: 0px; padding: 0;"><strong>
                                                                                Advices:</p></strong>
                                                                            <ul style="padding-left: 20px; margin: 0;">
                                                                                <?php foreach ($consultation['advices'] as $adv): ?>
                                                                                    <li><?= $adv['advice_name'] ?>
                                                                                        <?php if (!empty($adv['note'])): ?>
                                                                                            - <?= htmlspecialchars($adv['note']) ?>
                                                                                        <?php endif; ?>
                                                                                    </li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if (!empty($consultation['instructions'])): ?>
                                                                        <div style="margin-bottom: 8px;">
                                                                            <p style="margin:0;"><strong>Instructions:</strong></p>
                                                                            <ul style="padding-left: 20px; margin: 0;">
                                                                                <?php foreach ($consultation['instructions'] as $ins): ?>
                                                                                    <li><?= $ins['instruction_name'] ?></li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if (!empty($consultation['dietPlan'])): ?>
                                                                        <div style="margin-bottom: 8px;">
                                                                            <p style="margin:0;"><strong>Diet Plan:</strong></p>
                                                                            <p style="padding-left: 20px; margin: 0;">
                                                                                <?= nl2br(htmlspecialchars($consultation['dietPlan'])) ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if (!empty($consultation['notes'])): ?>
                                                                        <div style="margin-bottom: 8px;">
                                                                            <p style="margin:0;"><strong>Notes:</strong></p>
                                                                            <p style="padding-left: 20px; margin: 0;">
                                                                                <?= nl2br(htmlspecialchars($consultation['notes'])) ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if (!empty($consultation['next_follow_up'])): ?>
                                                                        <div style="margin-bottom: 8px;">
                                                                            <span><strong>Next Follow-Up Date:</strong></span>
                                                                            <?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <div class="mt-4 px-2"
                                                                        style="display: flex; justify-content: flex-end; margin-top: 40px; margin-bottom: 20px;">
                                                                        <div style="text-align: center; width: auto;">
                                                                            <!-- <img src="<?= base_url('assets/Signature.jpeg') ?>"
                                                                                alt="Doctor's Signature"
                                                                                style="height: 60px; width: auto; display: block; margin: 0 auto;"> -->
                                                                            <div style="text-align: left; margin-top: 50px;">
                                                                                <p
                                                                                    style="margin: 0; font-weight: bold; font-size: 14px;">
                                                                                    Dr. A. S. Senthilvelu</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-between">
                                                                <?php $patientEmail = isset($patientDetails[0]['mailId']) ? $patientDetails[0]['mailId'] : ''; ?>

                                                                <?php if (!empty($patientEmail)): ?>
                                                                    <a href="<?= base_url('consultation/resendEmail/' . $consultation['id']) ?>"
                                                                        class="btn btn-warning btn-sm pt-2"
                                                                        style="padding: 2px 4px; width:45px; height:45px;"
                                                                        onclick="return confirm('Are you sure you want to send the consultation email to the patient?');"
                                                                        title="Send Email to Patient">
                                                                        <i class="bi bi-envelope" style="font-size: 20px;"></i>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <span style="cursor: not-allowed;"
                                                                        title="Email address not available for this patient">
                                                                        <button type="button" class="btn btn-warning btn-sm"
                                                                            style="padding: 2px 4px; width:45px; height:45px; opacity: 0.6; pointer-events: none;"
                                                                            disabled>
                                                                            <i class="bi bi-envelope" style="font-size: 20px;"></i>
                                                                        </button>
                                                                    </span>
                                                                <?php endif; ?>

                                                                <div class="d-flex gap-2">
                                                                    <button type="button" class="btn btn-secondary download-pdf-btn"
                                                                        style="padding: 2px 4px; width:45px; height:45px;"
                                                                        data-content-id="consultationDetails<?= $consultation['id'] ?>"
                                                                        data-filename="Consultation_<?= $patientDetails[0]['patientId'] ?>_<?= $consultation['id'] ?>.pdf"
                                                                        title="Download Consultation PDF">
                                                                        <i class="bi bi-download" style="font-size: 20px;"></i>
                                                                    </button>

                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                        style="padding: 2px 4px; width:45px; height:45px;"
                                                                        onclick="printDiv('consultationDetails<?= $consultation['id'] ?>', 'Consultation_<?= $patientDetails[0]['patientId'] ?>_<?= $consultation['id'] ?>')"
                                                                        title="Print Consultation">
                                                                        <i class="bi bi-printer" style="font-size: 20px;"></i>
                                                                    </button>
                                                                </div>
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

                            <!-- New Consultation -->
                            <div class="tab-pane fade" id="new-consultation" role="tabpanel">
                                <form action="<?php echo base_url() . 'Consultation/saveConsultation' ?>" method="post"
                                    id="consultationForm" class="mb-3" enctype="multipart/form-data">
                                    <input type="hidden" id="patientIdDb" name="patientIdDb"
                                        value="<?php echo $patientDetails[0]['id'] ?>">
                                    <input type="hidden" id="patientId" name="patientId"
                                        value="<?php echo $patientDetails[0]['patientId'] ?>">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>

                                        <div>
                                            <label for="consultDate" class="form-label fieldLabel">Consultation Date &
                                                Time:</label>
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="date" id="consultDate" name="consultDate" class="form-control"
                                                    style="width: 180px;">
                                                <select id="consultTime" name="consultTime" class="form-select"
                                                    style="width: 150px;">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-3">
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                        name="patientHeight" step="0.1" min="0" placeholder="E.g. 135">
                                                    <p class="mx-2 my-2">Cm</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                        name="patientWeight" step="0.1" min="0" placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">Kg</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientSystolicBp">Systolic BP
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientSystolicBp" name="patientSystolicBp"
                                                        placeholder="E.g. 120" step="0.1" min="0">
                                                    <p class="mx-2 my-2">mmHg</p>
                                                </div>
                                                <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientDiastolicBp">Diastolic
                                                    BP</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientDiastolicBp" name="patientDiastolicBp"
                                                        placeholder="E.g. 80" step="0.1" min="0">
                                                    <p class="mx-2 my-2">mmHg</p>
                                                </div>
                                                <!-- <div id="patientBp_err" class="text-danger pt-1"></div> -->
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label fieldLabel" for="bodyMassIndex">BMI
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="bodyMassIndex"
                                                        name="bodyMassIndex" step="0.1" min="0" placeholder="E.g. 27.4">
                                                    <p class="mx-2 my-2">kg/m<sup>2</sup></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label fieldLabel" for="fastingBsugar">Blood Sugar
                                                    (Fasting)</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="fastingBsugar"
                                                        name="fastingBsugar" step="0.1" min="0" placeholder="E.g. 75">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP)
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                        name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="randomBsugar">Blood Sugar
                                                    (Random)
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle" id="randomBsugar"
                                                        name="randomBsugar" step="0.1" min="0" placeholder="E.g. 125">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                        name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98">
                                                    <p class="mx-2 my-2">%</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientPulseRate">Pulse Rate
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientPulseRate" name="patientPulseRate" placeholder="E.g. 75"
                                                        step="1" min="0">
                                                    <p class="mx-2 my-2">/min</p>
                                                </div>
                                                <div id="patientPulseRate_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientTemperature" name="patientTemperature" step="0.1" min="0"
                                                        step="0.01" placeholder="E.g. 98.6">
                                                    <p class="mx-2 my-2">°F</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                        name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5">
                                                    <p class="mx-2 my-2">%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="my-3 fs-5 fw-semibold">Consultation Details:</p>
                                    <div class="p-3">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#symptomsCollapse">
                                                <span><strong><i class="bi bi-virus me-2"></i> Symptoms</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="symptomsCollapse">
                                                <div id="symptomsWrapper">
                                                    <div id="symptomsList" class="mt-2"></div>
                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="symptomsInput">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="symptomsSearchInput"
                                                                    placeholder="Search or type to add..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearSymptomSearch" style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addSymptomBtn" style="display: none;">+ Add</button>
                                                        </div>
                                                        <div class="suggestions-box" id="symptomsSuggestionsBox"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="symptomsJson" id="symptomsJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#findingsCollapse">
                                                <span><strong><i class="bi bi-search me-2"></i> Findings</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="findingsCollapse">
                                                <div id="findingsWrapper">
                                                    <div id="findingsList" class="mt-2"></div>
                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="findingsInput">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="searchInput"
                                                                    placeholder="Search or type to add..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearFindingSearch" style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addFindingBtn" style="display: none;">+ Add</button>
                                                        </div>

                                                        <div class="suggestions-box" id="suggestionsBox"
                                                            style="position: relative; margin-bottom: 15px;"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="findingsJson" id="findingsJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#diagnosisCollapse">
                                                <span><strong><i class="bi bi-clipboard2-heart me-2"></i>
                                                        Diagnosis</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="diagnosisCollapse">
                                                <div id="diagnosisWrapper">
                                                    <div id="diagnosisList" class="mt-2"></div>
                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="diagnosisInputBox">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="diagnosisInput"
                                                                    placeholder="Search or type to add diagnosis..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearDiagnosisSearch" style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addDiagnosisBtn" style="display: none;">+ Add</button>
                                                        </div>

                                                        <div class="suggestions-box" id="diagnosisSuggestionsBox"
                                                            style="position: relative; margin-bottom: 15px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="diagnosisJson" id="diagnosisJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#investigationsCollapse">
                                                <span><strong><i class="bi bi-patch-question me-2"></i>
                                                        Investigations</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="investigationsCollapse">
                                                <div id="investigationsWrapper">
                                                    <div id="investigationsList" class="mb-2"></div>
                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="investigationsInput">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="investigationsSearchInput"
                                                                    placeholder="Search or type to add..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearInvestigationSearch"
                                                                style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addInvestigationBtn" style="display: none;">+
                                                                Add</button>
                                                        </div>

                                                        <div class="suggestions-box" id="investigationsSuggestionsBox"
                                                            style="position: relative; margin-bottom: 15px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="investigationsJson" id="investigationsJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong><i class="bi bi-prescription2 me-2"></i>
                                                        Procedures</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <div id="proceduresWrapper">
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" id="procedureSearch"
                                                            placeholder="Search Procedures">

                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="clearProcedureSearch" style="display: none;">✖</button>

                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="addProcedureBtn" style="display: none;">+ Add</button>
                                                    </div>

                                                    <div id="procedureList" class="mt-2"
                                                        style="max-height: 200px; overflow-y: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-bs-toggle="collapse" data-bs-target="#medicinesCol">
                                                <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="medicinesCollapse">
                                                <div id="medicinesWrapper">
                                                    <div id="medicinesList" class="mb-2"></div>

                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="medicinesInput">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="medicinesSearchInput"
                                                                    placeholder="Search or type to add..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearMedicineSearch" style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="medicinesAddBtn" style="display: none;">+ Add</button>
                                                        </div>
                                                        <div class="suggestions-box" id="medicinesSuggestionsBox"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="medicinesJson" id="medicinesJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                        Advices</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>

                                            <div class="collapse field-container mt-2">
                                                <div id="adviceWrapper">
                                                    <div id="adviceList" class="mb-2"
                                                        style="background-color: white; border: none"></div>
                                                    <div class="mb-3 position-relative">
                                                        <div class="input-group mb-2">
                                                            <div class="tags-input flex-grow-1" id="adviceInputContainer">
                                                                <input type="text" class="form-control border-0 shadow-none"
                                                                    id="adviceSearchInput"
                                                                    placeholder="Search Advice or type to add..." />
                                                            </div>

                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="clearAdviceSearch" style="display: none;">✖</button>

                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addAdviceBtn" style="display: none;">+ Add</button>
                                                        </div>

                                                        <div class="suggestions-box" id="adviceSuggestionsBox"
                                                            style="position: relative; margin-bottom: 15px; display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="advicesJson" id="advicesJson">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong><i class="bi bi-clipboard2-pulse me-2"></i>
                                                        Instructions</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <div id="instructionWrapper">
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" id="instructionSearch"
                                                            placeholder="Search Instructions">

                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="clearInstructionSearch" style="display: none;">✖</button>

                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="addInstructionBtn" style="display: none;">+ Add</button>
                                                    </div>

                                                    <div id="instructionList" class="mt-2"
                                                        style="max-height: 200px; overflow-y: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- This code is common for all 3 new, edit and followup -->
                                    <div class="form-group pb-3" data-page="new">
                                        <label class="form-label fieldLabel">Attachments</label>
                                        <button type="button" class="addFileBtn btn text-light float-end mb-2"
                                            style="background-color: #00ad8e;"> + Add File </button>
                                        <div class="mb-3"></div>
                                        <div class="dropZone"
                                            style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; margin-bottom: 15px;">
                                            <p class="text-muted mb-0">Drag and drop your files here or click the button
                                                above to upload. Supported formats: .pdf, .png, .jpg, .jpeg.
                                            </p>
                                        </div>
                                        <input type="file" class="fileInput d-none" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                            multiple>
                                        <input type="file" class="submitFileInput d-none" name="consultationFiles[]"
                                            multiple>
                                        <div class="fileList" style="margin-top: 0.5rem;"></div>
                                        <div class="fileError text-danger pt-1"></div>
                                        <input type="hidden" class="removedFiles" name="removedFiles" value="">
                                    </div>

                                    <div class="form-group pb-3">
                                        <label class="form-label fieldLabel" for="dietPlan">Diet Plan <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="dietPlan" id="dietPlan"
                                            placeholder="Enter the diet plan"></textarea>
                                        <div id="dietPlan_err" class="text-danger pt-1"></div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label class="form-label fieldLabel" for="notes">Notes <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="notes" id="notes"
                                            placeholder="Enter the notes"></textarea>
                                        <div id="advices_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label class="form-label fieldLabel" for="nextFollowUpDate">Next Follow-up Date
                                            <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="nextFollowUpDate"
                                            name="nextFollowUpDate">
                                        <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-5">
                                        <!-- Send mail in form is not in use and function removed in controller -->
                                        <?php $emailAvailable = !empty($patientDetails[0]['mailId']); ?>
                                        <div class="form-check">
                                            <input type="hidden" id="consultationSendEmail" name="consultationSendEmail"
                                                value="0">
                                            <!-- <input class="form-check-input border-dark" type="checkbox"
                                                id="consultationSendEmail" name="consultationSendEmail" value="1"
                                                <?= $emailAvailable ? '' : 'disabled'; ?>>
                                            <label class="form-check-label fw-medium text-dark" for="consultationSendEmail">
                                                Send consultation details to patient's email
                                            </label> -->
                                        </div>
                                        <button type="submit" class="float-end btn text-light"
                                            style="background-color: #00ad8e;">Save</button>
                                    </div>
                                </form>
                                <!---------------------------------------------------- Image Edit Modal -------------------------->
                                <div class="modal fade" id="imageEditModal" tabindex="-1"
                                    aria-labelledby="imageEditModalLabel" aria-hidden="true" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!-- Custom Toolbar -->
                                                <div id="editor-toolbar" style="margin-bottom: 10px; text-align: left;">
                                                    <button type="button" id="crop-btn" class="btn btn-sm btn-outline-dark"
                                                        title="Crop">✂️ Crop</button>
                                                    <button type="button" id="rotate-btn"
                                                        class="btn btn-sm btn-outline-dark" title="Rotate">⟳ Rotate</button>
                                                </div>
                                                <h5 class=" fw-medium" id="imageEditModalLabel"
                                                    style="font-family: Poppins, sans-serif; margin-left:25%">Edit Image
                                                </h5>
                                                <button type="button" class="btn-close btn btn-danger"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">

                                                <!-- Bootstrap container for image -->
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12"
                                                            style="position: relative; width: 600px; height: 600px;">
                                                            <img id="editor-image" class="img-fluid"
                                                                style=" object-fit: contain; display: none; ">
                                                            <canvas id="editor-canvas" class="img-fluid" style=""></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: white;">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn text-light"
                                                    style="background-color: #00ad8e;" id="saveEditedImage">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-----------------------------end edit image------------------>

                                <div class="modal fade" id="newConsultationPreviewModal" tabindex="-1"
                                    aria-labelledby="newConsultationPreviewModalLabel" aria-hidden="true"
                                    data-bs-backdrop="static" data-bs-keyboard="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                                                    id="newConsultationPreviewModalLabel">
                                                    New Consultation Attachment Preview
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center position-relative">
                                                <button id="prevNewConsultation"
                                                    class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                                                    style="font-size: 1.5rem; z-index: 10;" disabled>
                                                    <b>&lt;</b>
                                                </button>
                                                <div id="newconsultation-content-wrapper">
                                                    <img id="newConsultationImage" src="" alt="Attachment"
                                                        class="img-fluid d-none">
                                                    <iframe id="newConsultationPDF" src="" class="w-100"
                                                        style="height:500px;" frameborder="0"></iframe>
                                                </div>
                                                <button id="nextNewConsultation"
                                                    class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                                                    style="font-size: 1.5rem; z-index: 10;" disabled>
                                                    <b>&gt;</b>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-light"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!------- end attachment display -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } elseif ($method == "followupConsult") { ?>
            <section>
                <div class="card rounded pb-3">
                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                        <div class="border border-2 rounded text-center py-2 position-relative px-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                <a href="<?php echo base_url() . "Healthcareprovider/patientformUpdate/" . $value['id']; ?>"
                                    class="position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-secondary btn-sm"><i class="bi bi-pen"></i></button>
                                </a>
                                <p style="font-size: 16px; font-weight: 700">
                                    <?php echo $value['firstName'] ?>         <?php echo $value['lastName'] ?> |
                                    <?php echo $value['patientId'] ?>
                                </p>
                                <p>
                                    <a href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?>
                                        <?php
                                        if (!empty($value['derived_dob'])) {
                                            $dob = new DateTime($value['derived_dob']);
                                            $today = new DateTime();
                                            $currentAge = $today->diff($dob)->y;
                                        } else {
                                            $currentAge = $value['age'];
                                        } ?>
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $currentAge ?> Year(s)
                                </p>
                            <?php } ?>
                        </div>
                        <a href="<?php echo base_url() . "Consultation/consultation/" . $value['id']; ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body mx-3 px-md-4">
                        <form action="<?php echo base_url() . 'Consultation/saveConsultation' ?>" method="post"
                            enctype="multipart/form-data" id="consultationForm" class="mb-5">
                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                value="<?php echo $patientDetails[0]['id'] ?>">
                            <input type="hidden" id="patientId" name="patientId"
                                value="<?php echo $patientDetails[0]['patientId'] ?>">
                            <p class="fs-4 fw-semibold mb-3">Follow-up Consultation:</p>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>
                                <div>
                                    <label for="consultDate" class="form-label fieldLabel">Consultation Date & Time:</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="date" id="consultDate" name="consultDate" class="form-control"
                                            style="width: 180px;">
                                        <select id="consultTime" name="consultTime" class="form-select"
                                            style="width: 150px;">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                name="patientHeight" step="0.1" min="0" placeholder="E.g. 135"
                                                value="<?= isset($vitals['height_cm']) ? $vitals['height_cm'] : '' ?>">
                                            <p class="mx-2 my-2">Cm</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                name="patientWeight" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['weight_kg']) ? $vitals['weight_kg'] : '' ?>">
                                            <p class="mx-2 my-2">Kg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSystolicBp">Systolic BP
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120" step="0.1" min="0"
                                                value="<?= isset($vitals['systolic_bp']) ? $vitals['systolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientDiastolicBp">Diastolic BP</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientDiastolicBp"
                                                name="patientDiastolicBp" placeholder="E.g. 80" step="0.1" min="0"
                                                value="<?= isset($vitals['diastolic_bp']) ? $vitals['diastolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <!-- <div id="patientBp_err" class="text-danger pt-1"></div> -->
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="bodyMassIndex">BMI
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="bodyMassIndex"
                                                name="bodyMassIndex" step="0.1" min="0"
                                                value="<?= isset($vitals['body_mass_index']) ? $vitals['body_mass_index'] : '' ?>"
                                                placeholder="E.g. 27.4">
                                            <p class="mx-2 my-2">kg/m<sup>2</sup></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="fastingBsugar">Blood Sugar
                                            (Fasting)</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="fastingBsugar"
                                                name="fastingBsugar" step="0.1" min="0"
                                                value="<?= isset($vitals['blood_sugar_fasting']) ? $vitals['blood_sugar_fasting'] : '' ?>"
                                                placeholder="E.g. 75">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP) </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                value="<?= isset($vitals['blood_sugar_pp']) ? $vitals['blood_sugar_pp'] : '' ?>"
                                                name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="randomBsugar">Blood Sugar (Random)
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="randomBsugar"
                                                name="randomBsugar" step="0.1" min="0"
                                                value="<?= isset($vitals['blood_sugar_random']) ? $vitals['blood_sugar_random'] : '' ?>"
                                                placeholder="E.g. 125">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98"
                                                value="<?= isset($vitals['spo2_percent']) ? $vitals['spo2_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientPulseRate">Pulse Rate
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientPulseRate"
                                                name="patientPulseRate" placeholder="E.g. 75" step="1" min="0"
                                                value="<?= isset($vitals['pulse_rate']) ? $vitals['pulse_rate'] : '' ?>">
                                            <p class="mx-2 my-2">/min</p>
                                        </div>
                                        <div id="patientPulseRate_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" step="0.1" min="0" step="0.01"
                                                placeholder="E.g. 98.6"
                                                value="<?= isset($vitals['temperature_f']) ? $vitals['temperature_f'] : '' ?>">
                                            <p class="mx-2 my-2">°F</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5"
                                                value="<?= isset($vitals['HbA1c_percent']) ? $vitals['HbA1c_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#symptomsCollapse">
                                        <span><strong><i class="bi bi-virus me-2"></i> Symptoms</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="symptomsCollapse">
                                        <div id="symptomsWrapper">
                                            <div id="symptomsList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="symptomsInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="symptomsSearchInput"
                                                            placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearSymptomSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary" id="addSymptomBtn"
                                                        style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="symptomsSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="symptomsJson" id="symptomsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#findingsCollapse">
                                        <span><strong><i class="bi bi-search me-2"></i> Findings</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="findingsCollapse">
                                        <div id="findingsWrapper">
                                            <div id="findingsWrapper">
                                                <div id="findingsList" class="mb-2"></div>
                                                <div class="mb-3 position-relative">
                                                    <div class="input-group mb-2">
                                                        <div class="tags-input flex-grow-1" id="findingsInput">
                                                            <input type="text" class="form-control border-0 shadow-none"
                                                                id="searchInput" placeholder="Search or type to add..." />
                                                        </div>

                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="clearFindingSearch" style="display: none;">✖</button>

                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="addFindingBtn" style="display: none;">+ Add</button>
                                                    </div>
                                                    <div class="suggestions-box" id="suggestionsBox"
                                                        style="position: relative; margin-bottom: 15px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="findingsJson" id="findingsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#diagnosisCollapse">
                                        <span><strong><i class="bi bi-clipboard2-heart me-2"></i>
                                                Diagnosis</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="diagnosisCollapse">
                                        <div id="diagnosisWrapper">
                                            <div id="diagnosisList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="diagnosisInputBox">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="diagnosisInput"
                                                            placeholder="Search or type to add diagnosis..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearDiagnosisSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary"
                                                        id="addDiagnosisBtn" style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="diagnosisSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="diagnosisJson" id="diagnosisJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#investigationsCollapse">
                                        <span><strong><i class="bi bi-patch-question me-2"></i>
                                                Investigations</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="investigationsCollapse">
                                        <div id="investigationsWrapper">
                                            <div id="investigationsWrapper">
                                                <div id="investigationsList" class="mb-2"></div>
                                                <div class="mb-3 position-relative">
                                                    <div class="input-group mb-2">
                                                        <div class="tags-input flex-grow-1" id="investigationsInput">
                                                            <input type="text" class="form-control border-0 shadow-none"
                                                                id="investigationsSearchInput"
                                                                placeholder="Search or type to add..." />
                                                        </div>

                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="clearInvestigationSearch" style="display: none;">✖</button>

                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="addInvestigationBtn" style="display: none;">+ Add</button>
                                                    </div>
                                                    <div class="suggestions-box" id="investigationsSuggestionsBox"
                                                        style="position: relative; margin-bottom: 15px;"></div>
                                                </div>
                                            </div>
                                            <div id="investigationsList" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="investigationsJson" id="investigationsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-prescription2 me-2"></i>
                                                Procedures</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div id="proceduresWrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="procedureSearch"
                                                    placeholder="Search Procedures">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearProcedureSearch" style="display: none;">✖</button>

                                                <button type="button" class="btn btn-outline-primary" id="addProcedureBtn"
                                                    style="display: none;">+ Add</button>
                                            </div>

                                            <div id="procedureList" class="mt-2"
                                                style="max-height: 200px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button"
                                        data-bs-toggle="collapse" data-bs-target="#medicinesCol">
                                        <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="medicinesCollapse">
                                        <div id="medicinesWrapper">
                                            <div id="medicinesList" class="mb-2"></div>

                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="medicinesInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="medicinesSearchInput"
                                                            placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearMedicineSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary"
                                                        id="medicinesAddBtn" style="display: none;">+ Add</button>
                                                </div>

                                                <div class="suggestions-box" id="medicinesSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="medicinesJson" id="medicinesJson">
                                <!-- 
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                Advice</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>

                                    <div class="collapse field-container mt-2">
                                        <div id="adviceWrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="adviceSearch"
                                                    placeholder="Search Advice">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearAdviceSearch" style="display: none;">✖</button>

                                                <button type="button" class="btn btn-outline-primary" id="addAdviceBtn"
                                                    style="display: none;">+ Add</button>
                                            </div>

                                            <div id="adviceList" class="mt-2" style="max-height: 200px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>

                                </div> -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                Advices</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>

                                    <div class="collapse field-container mt-2">
                                        <div id="adviceWrapper">
                                            <div id="adviceList" class="mb-2"
                                                style="background-color: white; border: none;"></div>

                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="adviceInputContainer">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="adviceSearchInput"
                                                            placeholder="Search Advice or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearAdviceSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary" id="addAdviceBtn"
                                                        style="display: none;">+ Add</button>
                                                </div>

                                                <div class="suggestions-box" id="adviceSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px; display: none;"></div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="advicesJson" id="advicesJson">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-clipboard2-pulse me-2"></i>
                                                Instructions</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div id="instructionWrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="instructionSearch"
                                                    placeholder="Search Instructions">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearInstructionSearch" style="display: none;">✖</button>

                                                <button type="button" class="btn btn-outline-primary" id="addInstructionBtn"
                                                    style="display: none;">+ Add</button>
                                            </div>

                                            <div id="instructionList" class="mt-2"
                                                style="max-height: 200px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group pb-3" data-page="followup">
                                <label class="form-label fieldLabel">Attachments</label>
                                <button type="button" class="addFileBtn btn text-light float-end mb-2"
                                    style="background-color: #00ad8e;"> + Add File </button>
                                <div class="mb-3"></div>
                                <div class="dropZone"
                                    style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; margin-bottom: 15px;">
                                    <p class="text-muted mb-0">Drag and drop your files here or click the button above to
                                        upload. Supported formats: .pdf, .png, .jpg, .jpeg.</p>
                                </div>
                                <input type="file" class="fileInput d-none" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    multiple>
                                <input type="file" class="submitFileInput d-none" name="consultationFiles[]" multiple>
                                <div class="fileList" style="margin-top: 0.5rem;"></div>
                                <div class="fileError text-danger pt-1"></div>
                                <input type="hidden" class="removedFiles" name="removedFiles" value="">
                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="dietPlan">Diet Plan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="dietPlan" id="dietPlan"
                                    placeholder="Enter the diet plan"><?= isset($consultation['dietPlan']) ? $consultation['dietPlan'] : '' ?></textarea>
                                <div id="dietPlan_err" class="text-danger pt-1"></div>
                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="notes">Notes <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="notes" id="notes"
                                    placeholder="Enter the notes"><?= isset($consultation['notes']) ? $consultation['notes'] : '' ?></textarea>
                                <div id="advices_err" class="text-danger pt-1"></div>
                            </div>
                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="nextFollowUpDate">Next Follow-up Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="nextFollowUpDate" name="nextFollowUpDate"
                                    value="<?= isset($consultation['next_follow_up']) ? $consultation['next_follow_up'] : '' ?>">
                                <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                            </div>
                            <input type="hidden" id="consultationSendEmail" name="consultationSendEmail" value="0">
                            <button type="submit" class="float-end btn text-light" style="background-color: #00ad8e;">Save
                                as new</button>
                        </form>
                        <!---------------------------------------------------- Image Edit Modal -------------------------->
                        <div class="modal fade" id="imageEditModal" tabindex="-1" aria-labelledby="imageEditModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!-- Custom Toolbar -->
                                        <div id="editor-toolbar" style="margin-bottom: 10px; text-align: left;">
                                            <button type="button" id="crop-btn" class="btn btn-sm btn-outline-dark"
                                                title="Crop">✂️ Crop</button>
                                            <button type="button" id="rotate-btn" class="btn btn-sm btn-outline-dark"
                                                title="Rotate">⟳ Rotate</button>
                                        </div>
                                        <h5 class=" fw-medium" id="imageEditModalLabel"
                                            style="font-family: Poppins, sans-serif; margin-left:25%">Edit Image</h5>
                                        <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">

                                        <!-- Bootstrap container for image -->
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-12"
                                                    style="position: relative; width: 600px; height: 600px;">
                                                    <img id="editor-image" class="img-fluid"
                                                        style=" object-fit: contain; display: none; ">
                                                    <canvas id="editor-canvas" class="img-fluid" style=""></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="background-color: white;">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                                            id="saveEditedImage">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-----------------------------end ------------------>

                        <!-- Preview display Followup Model -->
                        <div class="modal fade" id="followupPreviewModal" tabindex="-1"
                            aria-labelledby="followupPreviewModalLabel" aria-hidden="true" data-bs-backdrop="static"
                            data-bs-keyboard="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                                            id="followupPreviewModalLabel">
                                            Follow-up Attachment Preview
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center position-relative">

                                        <button id="prevFollowup"
                                            class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                                            style="font-size: 1.5rem; z-index: 10;" disabled>
                                            <b>&lt;</b>
                                        </button>
                                        <div id="followup-content-wrapper">
                                            <img id="followupImage" src="" alt="Attachment" class="img-fluid d-none">
                                            <iframe id="followupPDF" src="" class="w-100" style="height:500px;"
                                                frameborder="0"></iframe>
                                        </div>
                                        <button id="nextFollowup"
                                            class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                                            style="font-size: 1.5rem; z-index: 10;" disabled>
                                            <b>&gt;</b>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary text-light"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>


            <!-------------------------- Edit Consultant -->
        <?php } elseif ($method == "editConsult") { ?>
            <section>
                <div class="card rounded pb-3">
                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                        <div class="border border-2 rounded text-center py-2 position-relative px-5">
                            <?php
                            foreach ($patientDetails as $key => $value) {
                                ?>
                                <a href="<?php echo base_url() . "Healthcareprovider/patientformUpdate/" . $value['id']; ?>"
                                    class="position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-secondary btn-sm"><i class="bi bi-pen"></i></button>
                                </a>
                                <p style="font-size: 16px; font-weight: 700">
                                    <?php echo $value['firstName'] ?>         <?php echo $value['lastName'] ?> |
                                    <?php echo $value['patientId'] ?>
                                </p>
                                <p>
                                    <a href="tel:<?php echo $value['mobileNumber'] ?>" class="text-decoration-none text-dark">
                                        <?php echo $value['mobileNumber'] ?>
                                        <?php
                                        if (!empty($value['derived_dob'])) {
                                            $dob = new DateTime($value['derived_dob']);
                                            $today = new DateTime();
                                            $currentAge = $today->diff($dob)->y;
                                        } else {
                                            $currentAge = $value['age'];
                                        } ?>
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $currentAge ?> Year(s)
                                </p>
                            <?php } ?>
                        </div>
                        <a href="<?php echo base_url() . "Consultation/consultation/" . $value['id']; ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body mx-3 px-md-4">
                        <form action="<?php echo base_url() . 'Consultation/saveEditConsult' ?>" method="post"
                            enctype="multipart/form-data" id="consultationForm" class="mb-5">
                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                value="<?php echo $patientDetails[0]['id'] ?>">
                            <input type="hidden" id="patientId" name="patientId"
                                value="<?php echo $patientDetails[0]['patientId'] ?>">
                            <input type="hidden" id="consultationDbId" name="consultationDbId"
                                value="<?php echo $consultation['id'] ?>">
                            <input type="hidden" id="vitalsDbId" name="vitalsDbId" value="<?php echo $vitals['id'] ?>">
                            <div class="float-end">
                                <label for="consultDate" class="form-label fieldLabel">Consultation Date & Time:</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="date" id="consultDate" name="consultDate" class="form-control"
                                        value="<?= isset($consultation['consult_date']) ? $consultation['consult_date'] : '' ?>">
                                    <select id="consultTime" name="consultTime" class="form-select" style="width:150px;">
                                    </select>
                                </div>
                            </div>
                            <p class="fs-4 fw-semibold mb-3">Edit Consultation:</p>
                            <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>
                            <div class="p-3">
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                name="patientHeight" step="0.1" min="0" placeholder="E.g. 135"
                                                value="<?= isset($vitals['height_cm']) ? $vitals['height_cm'] : '' ?>">
                                            <p class="mx-2 my-2">Cm</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                name="patientWeight" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['weight_kg']) ? $vitals['weight_kg'] : '' ?>">
                                            <p class="mx-2 my-2">Kg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSystolicBp">Systolic BP
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120" step="0.1" min="0"
                                                value="<?= isset($vitals['systolic_bp']) ? $vitals['systolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientDiastolicBp">Diastolic BP</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientDiastolicBp"
                                                name="patientDiastolicBp" placeholder="E.g. 80" step="0.1" min="0"
                                                value="<?= isset($vitals['diastolic_bp']) ? $vitals['diastolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <!-- <div id="patientBp_err" class="text-danger pt-1"></div> -->
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="bodyMassIndex">BMI
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="bodyMassIndex"
                                                name="bodyMassIndex" step="0.1" min="0"
                                                value="<?= isset($vitals['body_mass_index']) ? $vitals['body_mass_index'] : '' ?>"
                                                placeholder="E.g. 27.4">
                                            <p class="mx-2 my-2">kg/m<sup>2</sup></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="fastingBsugar">Blood Sugar
                                            (Fasting)</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="fastingBsugar"
                                                name="fastingBsugar" step="0.1" min="0"
                                                value="<?= isset($vitals['blood_sugar_fasting']) ? $vitals['blood_sugar_fasting'] : '' ?>"
                                                placeholder="E.g. 75">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP) </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                value="<?= isset($vitals['blood_sugar_pp']) ? $vitals['blood_sugar_pp'] : '' ?>"
                                                name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="randomBsugar">Blood Sugar (Random)
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="randomBsugar"
                                                name="randomBsugar" step="0.1" min="0"
                                                value="<?= isset($vitals['blood_sugar_random']) ? $vitals['blood_sugar_random'] : '' ?>"
                                                placeholder="E.g. 125">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98"
                                                value="<?= isset($vitals['spo2_percent']) ? $vitals['spo2_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientPulseRate">Pulse Rate
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientPulseRate"
                                                name="patientPulseRate" placeholder="E.g. 75" step="1" min="0"
                                                value="<?= isset($vitals['pulse_rate']) ? $vitals['pulse_rate'] : '' ?>">
                                            <p class="mx-2 my-2">/min</p>
                                        </div>
                                        <div id="patientPulseRate_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" step="0.1" min="0" step="0.01"
                                                placeholder="E.g. 98.6"
                                                value="<?= isset($vitals['temperature_f']) ? $vitals['temperature_f'] : '' ?>">
                                            <p class="mx-2 my-2">°F</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5"
                                                value="<?= isset($vitals['HbA1c_percent']) ? $vitals['HbA1c_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#symptomsCollapse">
                                        <span><strong><i class="bi bi-virus me-2"></i> Symptoms</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="symptomsCollapse">
                                        <div id="symptomsWrapper">
                                            <div id="symptomsList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="symptomsInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="symptomsSearchInput"
                                                            placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearSymptomSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary" id="addSymptomBtn"
                                                        style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="symptomsSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="symptomsJson" id="symptomsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#findingsCollapse">
                                        <span><strong><i class="bi bi-search me-2"></i> Findings</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="findingsCollapse">
                                        <div id="findingsWrapper">
                                            <div id="findingsList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="findingsInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="searchInput" placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearFindingSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary" id="addFindingBtn"
                                                        style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="suggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" name="findingsJson" id="findingsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#diagnosisCollapse">
                                        <span><strong><i class="bi bi-clipboard2-heart me-2"></i> Diagnosis</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="diagnosisCollapse">
                                        <div id="diagnosisWrapper">
                                            <div id="diagnosisList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="diagnosisInputBox">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="diagnosisInput"
                                                            placeholder="Search or type to add diagnosis..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearDiagnosisSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary"
                                                        id="addDiagnosisBtn" style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="diagnosisSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="diagnosisJson" id="diagnosisJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button" data-toggle="collapse"
                                        data-target="#investigationsCollapse">
                                        <span><strong><i class="bi bi-patch-question me-2"></i>
                                                Investigations</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="investigationsCollapse">
                                        <div id="investigationsWrapper">
                                            <div id="investigationsList" class="mb-2"></div>
                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="investigationsInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="investigationsSearchInput"
                                                            placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearInvestigationSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary"
                                                        id="addInvestigationBtn" style="display: none;">+ Add</button>
                                                </div>
                                                <div class="suggestions-box" id="investigationsSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="investigationsJson" id="investigationsJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-prescription2 me-2"></i>
                                                Procedures</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div id="proceduresWrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="procedureSearch"
                                                    placeholder="Search Procedures">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearProcedureSearch" style="display: none;">✖</button>

                                                <button type="button" class="btn btn-outline-primary" id="addProcedureBtn"
                                                    style="display: none;">+ Add</button>
                                            </div>

                                            <div id="procedureList" class="mt-2"
                                                style="max-height: 200px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button"
                                        data-bs-toggle="collapse" data-bs-target="#medicinesCol">
                                        <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="medicinesCollapse">
                                        <div id="medicinesWrapper">
                                            <div id="medicinesList" class="mb-2"></div>

                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="medicinesInput">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="medicinesSearchInput"
                                                            placeholder="Search or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearMedicineSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary"
                                                        id="medicinesAddBtn" style="display: none;">+ Add</button>
                                                </div>

                                                <div class="suggestions-box" id="medicinesSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="medicinesJson" id="medicinesJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                Advices</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>

                                    <div class="collapse field-container mt-2">
                                        <div id="adviceWrapper">
                                            <div id="adviceList" class="mb-2" style="background-color: white; border: none">
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <div class="input-group mb-2">
                                                    <div class="tags-input flex-grow-1" id="adviceInputContainer">
                                                        <input type="text" class="form-control border-0 shadow-none"
                                                            id="adviceSearchInput"
                                                            placeholder="Search Advice or type to add..." />
                                                    </div>

                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearAdviceSearch" style="display: none;">✖</button>

                                                    <button type="button" class="btn btn-outline-primary" id="addAdviceBtn"
                                                        style="display: none;">+ Add</button>
                                                </div>

                                                <div class="suggestions-box" id="adviceSuggestionsBox"
                                                    style="position: relative; margin-bottom: 15px; display: none;"></div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="advicesJson" id="advicesJson">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-clipboard2-pulse me-2"></i>
                                                Instructions</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div id="instructionWrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="instructionSearch"
                                                    placeholder="Search Instructions">

                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearInstructionSearch" style="display: none;">✖</button>

                                                <button type="button" class="btn btn-outline-primary" id="addInstructionBtn"
                                                    style="display: none;">+ Add</button>
                                            </div>

                                            <div id="instructionList" class="mt-2"
                                                style="max-height: 200px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group pb-3 " data-page="edit" id="editFileSection">
                                <label class="form-label fieldLabel">Attachments</label>
                                <button type="button" id="addFileBtn" class="btn text-light float-end mb-2"
                                    style="background-color: #00ad8e;"> + Add File </button>
                                <div class="mb-3"></div>
                                <div id="dropZone"
                                    style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; margin-bottom: 15px;">
                                    <p class="text-muted mb-0">Drag and drop your files here or click the button above to
                                        upload. Supported formats: .pdf, .png, .jpg, .jpeg.
                                    </p>
                                </div>
                                <input type="file" id="fileInput" class="d-none" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    multiple>
                                <input type="file" id="submitFileInput" name="consultationFiles[]" class="d-none" multiple>
                                <div id="fileList" style="margin-top: 0.5rem;"></div>
                                <div id="fileError" class="text-danger pt-1"></div>
                                <input type="hidden" id="removedFiles" name="removedFiles" value="">
                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="dietPlan">Diet Plan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="dietPlan" id="dietPlan"
                                    placeholder="Enter the diet plan"><?= isset($consultation['dietPlan']) ? $consultation['dietPlan'] : '' ?></textarea>
                                <div id="dietPlan_err" class="text-danger pt-1"></div>
                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="notes">Notes <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="notes" id="notes"
                                    placeholder="Enter the notes"><?= isset($consultation['notes']) ? $consultation['notes'] : '' ?></textarea>
                                <div id="advices_err" class="text-danger pt-1"></div>
                            </div>
                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="nextFollowUpDate">Next Follow-up Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="nextFollowUpDate" name="nextFollowUpDate"
                                    value="<?= isset($consultation['next_follow_up']) ? $consultation['next_follow_up'] : '' ?>">
                                <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                            </div>
                            <input type="hidden" id="consultationSendEmail" name="consultationSendEmail" value="0">
                            <button type="submit" class="float-end btn text-light"
                                style="background-color: #00ad8e;">Update</button>
                        </form>
                        <!---------------------------------------------------- Image Edit Modal -------------------------->
                        <div class="modal fade" id="imageEditModal" tabindex="-1" aria-labelledby="imageEditModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!-- Custom Toolbar -->
                                        <div id="editor-toolbar" style="margin-bottom: 10px; text-align: left;">
                                            <button type="button" id="crop-btn" class="btn btn-sm btn-outline-dark"
                                                title="Crop">✂️ Crop</button>
                                            <button type="button" id="rotate-btn" class="btn btn-sm btn-outline-dark"
                                                title="Rotate">⟳ Rotate</button>
                                        </div>
                                        <h5 class=" fw-medium" id="imageEditModalLabel"
                                            style="font-family: Poppins, sans-serif; margin-left:25%">Edit Image</h5>
                                        <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-12"
                                                    style="position: relative; width: 600px; height: 600px;">
                                                    <img id="editor-image" class="img-fluid"
                                                        style=" object-fit: contain; display: none; ">
                                                    <canvas id="editor-canvas" class="img-fluid" style=""></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="background-color: white;">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                                            id="saveEditedImage">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Preview  in Edit Modal -->
                        <div class="modal fade" id="editPreviewModal" tabindex="-1" aria-labelledby="editPreviewModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                                            id="editPreviewModalLabel">Attachment Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center position-relative">
                                        <button id="prevFile"
                                            class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                                            style="font-size: 1.5rem;" disabled>
                                            <b>&lt;</b>
                                        </button>
                                        <div id="filePreviewContent"></div>
                                        <button id="nextFile"
                                            class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                                            style="font-size: 1.5rem;" disabled>
                                            <b>&gt;</b>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary text-light"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </section>
        <?php } ?>

        <!-- ******************************************************************************************************************************************** -->

        <!-- Symptoms Modal -->
        <div class="modal fade" id="symptomsModal" tabindex="-1" aria-labelledby="symptomsModalTitle" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="symptomsModalTitle"
                            style="font-family: Poppins, sans-serif;">
                            Enter Symptom Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="symptomNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="symptomNote" placeholder="Enter note" />
                        </div>
                        <div class="mb-3">
                            <label for="symptomSince" class="form-label">Since</label>
                            <input type="text" class="form-control" id="symptomSince" placeholder="Enter since" />
                        </div>
                        <div class="mb-3">
                            <label for="symptomSeverity" class="form-label">Severity</label>
                            <select id="symptomSeverity" class="form-select">
                                <option value="">Select severity</option>
                                <option value="Mild">Mild</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Severe">Severe</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn text-light" style="background-color: #00ad8e;"
                            onclick="saveSymptomModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Findings Modal -->
        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="modalTitle" style="font-family: Poppins, sans-serif;">
                            Enter Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="modalNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="modalNote" placeholder="Enter note" />
                        </div>
                        <div class="mb-3">
                            <label for="modalSince" class="form-label">Since</label>
                            <input type="text" class="form-control" id="modalSince" placeholder="Enter since" />
                        </div>
                        <div class="mb-3">
                            <label for="modalSeverity" class="form-label">Severity</label>
                            <select id="modalSeverity" class="form-select">
                                <option value="">Select severity</option>
                                <option value="Mild">Mild</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Severe">Severe</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn text-light" style="background-color: #00ad8e;"
                            onclick="saveModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diagnosis Modal -->
        <div class="modal fade" id="diagnosisModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">
                            Diagnosis
                            Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="diagnosisNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="diagnosisNote" placeholder="Enter note">
                        </div>
                        <div class="mb-3">
                            <label for="diagnosisSince" class="form-label">Location</label>
                            <input type="text" class="form-control" id="diagnosisSince" placeholder="Enter location">
                        </div>
                        <div class="mb-3">
                            <label for="diagnosisSeverity" class="form-label">Description</label>
                            <select class="form-select" id="diagnosisSeverity">
                                <option value="">Select description</option>
                                <option>To rule out</option>
                                <option>Suspect</option>
                                <option>Follow-up</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn text-light" style="background-color: #00ad8e;"
                            onclick="saveDiagnosisModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Investigation Modal -->
        <div class="modal fade" id="investigationsModal" tabindex="-1" aria-labelledby="investigationsModalTitle"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="investigationsModalTitle"
                            style="font-family: Poppins, sans-serif;">
                            Enter Investigation Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="investigationNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="investigationNote" placeholder="Enter note" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                            onclick="saveInvestigationModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instruction Add New Modal -->
        <div class="modal fade" id="addInstructionModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <form id="addInstructionForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Add New Instruction
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newInstructionName" class="form-label fieldLabel">Instruction Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="newInstructionName" class="form-control" name="name"
                            placeholder="Enter new instruction" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-light" style="background-color: #00ad8e;">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Procedure Modal -->
        <div class="modal fade" id="addProcedureModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <form id="addProcedureForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Add New Procedure
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newProcedureName" class="form-label fieldLabel">Procedure Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="newProcedureName" class="form-control" name="name"
                            placeholder="Procedure name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-light" style="background-color: #00ad8e;">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- New Add-new-medicine modal  -->
        <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-md">
                <form id="addMedicineMasterForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="addMedicineModalTitle"
                            style="font-family: Poppins, sans-serif;">Add New Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newMedicineName" class="form-label fieldLabel pb-2">Medicine Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="newMedicineName" class="form-control" placeholder="E.g. Dolo 650"
                            required>

                        <label for="newMedicineComposition" class="form-label fieldLabel pb-2 mt-2">Composition
                            Name</label>
                        <input type="text" id="newMedicineComposition" class="form-control"
                            placeholder="E.g. Paracetamol">

                        <label for="newMedicineCategory" class="form-label fieldLabel pb-2 mt-2">Category</label>
                        <select id="newMedicineCategory" class="form-select">
                            <option value="">Select Category</option>
                            <?php if (!empty($medicineCategories)): ?>
                                <?php foreach ($medicineCategories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat['category']) ?>">
                                        <?= htmlspecialchars($cat['category']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <input type="hidden" id="editMedicineMasterId" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="addMedicineConfirmBtn" class="btn text-light"
                            style="background-color: #00ad8e;">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Medicine -->
        <div class="modal fade" id="deleteMedicineMasterModal" tabindex="-1" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="delMedNameDisplay"></strong>?</p>
                        <input type="hidden" id="delMedId" value="">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="finalDeleteMedBtn" class="btn text-light"
                            style="background-color: #2b353bf5;">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Medicine Modal -->
        <div class="modal fade" id="medicinesModal" tabindex="-1" aria-labelledby="medicinesModalTitle"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="modal-title fw-medium" id="medicinesModalTitle"
                                style="font-family: Poppins, sans-serif;">Enter Medicine Details</h5>
                            <small id="medicineCompositionText" class="text-muted d-block"></small>
                        </div>
                        <span id="medicineCategoryText" class="text-dark"></span>
                        <div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    </div>

                    <div class="modal-body" style="font-family: Poppins, sans-serif;">
                        <div class="mb-4">

                            <div class="d-flex align-items-start gap-4">

                                <div>
                                    <label class="form-label fw-semibold">Quantity</label>
                                    <input type="number" id="medicineQuantity" min="0" class="form-control w-100"
                                        placeholder="Enter quantity">
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Food Timing</label>

                                    <div class="d-flex flex-column flex-lg-row gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="foodTiming"
                                                value="Before" id="beforeFood">
                                            <label class="form-check-label" for="beforeFood">
                                                Before Food
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="foodTiming" value="After"
                                                id="afterFood">
                                            <label class="form-check-label" for="afterFood">
                                                After Food
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Timing</label>
                            <div id="timingOptions" class="d-flex flex-wrap gap-4">

                                <!-- Morning -->
                                <div class="form-check d-flex align-items-center gap-2 flex-column flex-sm-row">
                                    <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                                        <input type="checkbox" id="morningCheck" class="me-1">
                                        <label for="morningCheck" class="mb-0">Morning</label>
                                    </div>
                                    <div class="d-flex gap-3 w-100 w-sm-auto">
                                        <input type="number" id="morningQty" class="form-control"
                                            style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5"
                                            disabled placeholder="Qty">
                                        <select id="morningUnit" class="form-select"
                                            style="min-width: 130px; width: 100%; max-width: 220px;" disabled>
                                            <option value=""></option>
                                            <?php if (!empty($dosageUnits)): ?>
                                                <?php foreach ($dosageUnits as $unit): ?>
                                                    <option value="<?= htmlspecialchars($unit['units_name']) ?>">
                                                        <?= htmlspecialchars($unit['units_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Afternoon -->
                                <div class="form-check d-flex align-items-center gap-2 flex-column flex-sm-row">
                                    <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                                        <input type="checkbox" id="afternoonCheck" class="me-1">
                                        <label for="afternoonCheck" class="mb-0">Afternoon</label>
                                    </div>
                                    <div class="d-flex gap-3 w-100 w-sm-auto">
                                        <input type="number" id="afternoonQty" class="form-control"
                                            style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5"
                                            disabled placeholder="Qty">
                                        <select id="afternoonUnit" class="form-select"
                                            style="min-width: 110px; width: 100%; max-width: 210px;" disabled>
                                            <option value=""></option>
                                            <?php if (!empty($dosageUnits)): ?>
                                                <?php foreach ($dosageUnits as $unit): ?>
                                                    <option value="<?= htmlspecialchars($unit['units_name']) ?>">
                                                        <?= htmlspecialchars($unit['units_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Evening -->
                                <div class="form-check d-flex align-items-center gap-2 flex-column flex-sm-row">
                                    <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                                        <input type="checkbox" id="eveningCheck" class="me-1">
                                        <label for="eveningCheck" class="mb-0">Evening</label>
                                    </div>
                                    <div class="d-flex gap-3 w-100 w-sm-auto">
                                        <input type="number" id="eveningQty" class="form-control"
                                            style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5"
                                            disabled placeholder="Qty">
                                        <select id="eveningUnit" class="form-select"
                                            style="min-width: 130px; width: 100%; max-width: 220px;" disabled>
                                            <option value=""></option>
                                            <?php if (!empty($dosageUnits)): ?>
                                                <?php foreach ($dosageUnits as $unit): ?>
                                                    <option value="<?= htmlspecialchars($unit['units_name']) ?>">
                                                        <?= htmlspecialchars($unit['units_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Night -->
                                <div class="form-check d-flex align-items-center gap-2 flex-column flex-sm-row">
                                    <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                                        <input type="checkbox" id="nightCheck" class="me-1">
                                        <label for="nightCheck" class="mb-0">Night</label>
                                    </div>
                                    <div class="d-flex gap-2 w-100 w-sm-auto">
                                        <input type="number" id="nightQty" class="form-control flex-fill flex-sm-none"
                                            style="min-width: 100px;" min="0" step="0.5" disabled placeholder="Qty">
                                        <select id="nightUnit" class="form-select flex-fill flex-sm-none"
                                            style="min-width: 120px;" disabled>
                                            <option value=""></option>
                                            <?php if (!empty($dosageUnits)): ?>
                                                <?php foreach ($dosageUnits as $unit): ?>
                                                    <option value="<?= htmlspecialchars($unit['units_name']) ?>">
                                                        <?= htmlspecialchars($unit['units_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 pt-3">
                                <label class="form-label fw-semibold">Notes</label>
                                <textarea id="medicineNotes" class="form-control" rows="3"
                                    placeholder="Enter any additional notes..."></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn text-light" style="background-color: #00ad8e;"
                                onclick="saveMedicineModal()">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advice Note Modal -->
        <div class="modal fade" id="adviceModal" tabindex="-1" aria-labelledby="adviceModalTitle" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="adviceModalTitle"
                            style="font-family: Poppins, sans-serif;">
                            Enter Advice Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="adviceNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="adviceNote" placeholder="Enter note" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                            onclick="saveAdviceModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attachment Display Dashboard Modal -->
        <div class="modal fade" id="dashboardPreviewModal" tabindex="-1" aria-labelledby="dashboardPreviewModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                            id="dashboardPreviewModalLabel">
                            Attachment Preview
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center position-relative p-0">

                        <div id="attachment-toolbar" class="d-flex justify-content-center align-items-center mb-1 mt-0"
                            style="height: 43px; width: 100%; background-color: #cccecfff; border-radius: 5px; display: none;">
                            <button id="zoomOutBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom Out"
                                disabled>
                                <b style="font-size: 1.2rem;">-</b>
                            </button>
                            <button id="zoomInBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom In" disabled>
                                <b style="font-size: 1.2rem;">+</b>
                            </button>
                            <button id="downloadAttachmentBtn" class="btn btn-secondary ms-3"><i
                                    class="bi bi-download"></i></button>
                        </div>

                        <button id="prevAttachment"
                            class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                            style="font-size: 1.5rem;" disabled><b>&lt;</b></button>

                        <div id="attachment-content-wrapper" class="w-100"
                            style="max-height: calc(70vh - 100px); overflow: auto; min-height: 400px;">
                            <img id="attachmentImage" src="" alt="Attachment" class="img-fluid d-none"
                                style="transform-origin: top left; transition: transform 0.2s ease-out;">
                            <iframe id="attachmentPDF" src="" class="w-100" style="height:500px;"
                                frameborder="0"></iframe>
                        </div>

                        <button id="nextAttachment"
                            class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                            style="font-size: 1.5rem;" disabled><b>&gt;</b></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--  Add/Edit Modal for all -->
        <div class="modal fade" id="universalAddMasterModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <form id="universalAddMasterForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="universalMasterTitle"
                            style="font-family: Poppins, sans-serif;">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="universalMasterInput" id="universalMasterLabel" class="form-label fieldLabel">Name
                            <span class="text-danger">*</span></label>
                        <input type="text" id="universalMasterInput" class="form-control" name="name"
                            placeholder="Enter name" required>

                        <input type="hidden" id="universalMasterId" value=""> <input type="hidden"
                            id="universalMasterType" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-light" style="background-color: #00ad8e;">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!--  Delete Modal for all -->
        <div class="modal fade" id="universalDeleteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="universalDeleteNameDisplay"></strong>?</p>
                        <input type="hidden" id="universalDeleteId" value="">
                        <input type="hidden" id="universalDeleteType" value="">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="universalDeleteBtn" class="btn text-light"
                            style="background-color: #2b353bf5;">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

    </main>

    <!-- ******************************************************************************************************************************************** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

    <!-- Consultation date and time default -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const timeSelect = document.getElementById("consultTime");
            const dateInput = document.getElementById("consultDate");
            const method = "<?= isset($method) ? $method : '' ?>";
            const phpDate = method !== "consultDashboard" ?
                "<?= isset($consultation['consult_date']) ? $consultation['consult_date'] : '' ?>" : "";
            const phpTime = method !== "consultDashboard" ?
                "<?= isset($consultation['consult_time']) ? $consultation['consult_time'] : '' ?>" : "";
            console.log("PHP Date:", phpDate);
            console.log("PHP Time:", phpTime);
            for (let h = 0; h < 24; h++) {
                for (let m = 0; m < 60; m += 10) {
                    const hours12 = h % 12 === 0 ? 12 : h % 12;
                    const ampm = h < 12 ? "AM" : "PM";
                    const minutes = String(m).padStart(2, "0");
                    const value24 = `${String(h).padStart(2, "0")}:${minutes}`;
                    const label12 = `${hours12}:${minutes} ${ampm}`;

                    const option = document.createElement("option");
                    option.value = value24;
                    option.textContent = label12;
                    timeSelect.appendChild(option);
                }
            }

            const now = new Date();
            const today = now.toISOString().split("T")[0];
            dateInput.value = phpDate || today;

            if (phpTime) {
                const normalizedTime = phpTime.substring(0, 5);
                timeSelect.value = normalizedTime;
            } else {
                const currentMinutes = now.getMinutes();
                const roundedMinutes = Math.round(currentMinutes / 10) * 10;
                const adjustedMinutes = roundedMinutes === 60 ? 0 : roundedMinutes;
                const adjustedHours = roundedMinutes === 60 ? now.getHours() + 1 : now.getHours();

                const hours = String(adjustedHours % 24).padStart(2, "0");
                const minutes = String(adjustedMinutes).padStart(2, "0");
                const currentValue = `${hours}:${minutes}`;

                if (Array.from(timeSelect.options).some(opt => opt.value === currentValue)) {
                    timeSelect.value = currentValue;
                }
            }
        });
    </script>

    <!-- BMI calculate script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const heightInput = document.getElementById("patientHeight");
            const weightInput = document.getElementById("patientWeight");
            const bmiInput = document.getElementById("bodyMassIndex");

            function calculateBMI() {
                const heightCm = parseFloat(heightInput.value);
                const weightKg = parseFloat(weightInput.value);

                if (heightCm > 0 && weightKg > 0) {
                    const heightMeters = heightCm / 100;
                    const bmi = weightKg / (heightMeters * heightMeters);
                    bmiInput.value = bmi.toFixed(1); // 1 decimal place
                } else {
                    bmiInput.value = "";
                }
            }

            heightInput.addEventListener("input", calculateBMI);
            weightInput.addEventListener("input", calculateBMI);
        });
    </script>

    <!-- Next follow up update date field disable -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const followUpDate = document.getElementById("nextFollowUpDate");
            const consultDate = document.getElementById("consultDate");

            function updateFollowUpMinDate() {
                const selectedDate = consultDate.value;
                if (selectedDate) {
                    followUpDate.setAttribute("min", selectedDate);
                }
            }

            updateFollowUpMinDate();

            consultDate.addEventListener("change", updateFollowUpMinDate);
        });
    </script>

    <!-- New Symptoms model save script -->
    <script>
        let symptomsList = <?php echo (isset($symptomsList) && !empty($symptomsList)) ? json_encode($symptomsList) : '[]'; ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const symptomsInput = document.getElementById("symptomsSearchInput");
            const symptomsSuggestionsBox = document.getElementById("symptomsSuggestionsBox");
            const addSymptomBtn = document.getElementById("addSymptomBtn");
            const clearSymptomSearch = document.getElementById("clearSymptomSearch");
            const symptomsTagContainer = document.getElementById("symptomsInput");

            const symptomsListContainer = document.getElementById("symptomsList");

            const universalAddModalEl = document.getElementById("universalAddMasterModal");
            const universalAddModal = new bootstrap.Modal(universalAddModalEl);
            const universalForm = document.getElementById("universalAddMasterForm");
            const universalTitle = document.getElementById("universalMasterTitle");
            const universalLabel = document.getElementById("universalMasterLabel");
            const universalInput = document.getElementById("universalMasterInput");
            const universalId = document.getElementById("universalMasterId");
            const universalType = document.getElementById("universalMasterType");

            const universalDeleteModalEl = document.getElementById("universalDeleteModal");
            const universalDeleteModal = new bootstrap.Modal(universalDeleteModalEl);
            const universalDeleteName = document.getElementById("universalDeleteNameDisplay");
            const universalDeleteId = document.getElementById("universalDeleteId");
            const universalDeleteType = document.getElementById("universalDeleteType");
            const universalDeleteBtn = document.getElementById("universalDeleteBtn");

            const symptomsModalEl = document.getElementById("symptomsModal");
            const symptomsModal = new bootstrap.Modal(symptomsModalEl);
            const symptomNote = document.getElementById("symptomNote");
            const symptomSince = document.getElementById("symptomSince");
            const symptomSeverity = document.getElementById("symptomSeverity");
            const symptomsModalTitle = document.getElementById("symptomsModalTitle");

            let selectedSymptoms = [];
            let pendingSymptom = "";
            let editingSymptomTag = null;
            let pendingMedicineMasterId = null;

            const addModalCloseBtns = universalAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            addModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalAddModal.hide();

                    if (universalForm) universalForm.reset();
                });
            });

            const deleteModalCloseBtns = universalDeleteModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            deleteModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalDeleteModal.hide();
                });
            });

            function renderSymptomsSuggestions() {
                if (!symptomsInput) return;
                const query = symptomsInput.value.trim().toLowerCase();
                symptomsSuggestionsBox.innerHTML = "";

                if (query.length > 0) {
                    if (clearSymptomSearch) clearSymptomSearch.style.display = 'block';
                } else {
                    if (clearSymptomSearch) clearSymptomSearch.style.display = 'none';
                    if (addSymptomBtn) addSymptomBtn.style.display = 'none';
                }

                const filtered = symptomsList.filter(s => s.symptomsName.toLowerCase().includes(query));

                if (filtered.length === 0 && query !== "") {
                    if (addSymptomBtn) addSymptomBtn.style.display = 'block';

                    if (symptomsSuggestionsBox) {
                        symptomsSuggestionsBox.style.display = 'block';
                        const noResultDiv = document.createElement("div");
                        noResultDiv.className = "p-2 text-muted";
                        noResultDiv.style.fontSize = "0.9rem";
                        noResultDiv.textContent = "No result found on search – Add new";
                        symptomsSuggestionsBox.appendChild(noResultDiv);
                    }
                } else {
                    if (addSymptomBtn) addSymptomBtn.style.display = 'none';

                    if (symptomsSuggestionsBox && query !== "") {
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom";
                            div.style.cursor = "pointer";
                            div.style.padding = "1px 6px";

                            div.addEventListener("mouseenter", () => {
                                div.style.backgroundColor = "#8db8afff";
                            });

                            div.addEventListener("mouseleave", () => {
                                div.style.backgroundColor = "transparent";
                            });

                            const spanName = document.createElement("span");
                            spanName.textContent = item.symptomsName;
                            spanName.className = "flex-grow-1";
                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                openSymptomModal(item.symptomsName);
                                clearSearch();
                            };
                            div.appendChild(spanName);

                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.title = "Edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openEditModal(item.id, item.symptomsName);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.title = "Delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openDeleteModal(item.id, item.symptomsName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }

                            div.onclick = () => {
                                openSymptomModal(item.symptomsName);
                                clearSearch();
                            };

                            symptomsSuggestionsBox.appendChild(div);
                        });
                        symptomsSuggestionsBox.style.display = "block";
                    } else {
                        symptomsSuggestionsBox.style.display = "none";
                    }
                }
            }

            function clearSearch() {
                if (symptomsInput) {
                    symptomsInput.value = "";
                    symptomsInput.focus();
                }
                if (symptomsSuggestionsBox) symptomsSuggestionsBox.style.display = "none";
                if (clearSymptomSearch) clearSymptomSearch.style.display = "none";
                if (addSymptomBtn) addSymptomBtn.style.display = "none";
            }

            window.openSymptomModal = function (tagName, existing = null, tagEl = null) {
                pendingSymptom = tagName;
                editingSymptomTag = tagEl;

                if (symptomsModalTitle) symptomsModalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
                if (symptomNote) symptomNote.value = existing?.note || "";
                if (symptomSince) symptomSince.value = existing?.since || "";
                if (symptomSeverity) symptomSeverity.value = existing?.severity || "";

                symptomsModal.show();
                setTimeout(() => { if (symptomNote) symptomNote.focus(); }, 500);
            }

            window.saveSymptomModal = function () {
                const note = symptomNote ? symptomNote.value.trim() : "";
                const since = symptomSince ? symptomSince.value.trim() : "";
                const severity = symptomSeverity ? symptomSeverity.value : "";

                if (!pendingSymptom) return;

                const existingIndex = selectedSymptoms.findIndex(s => s.symptom === pendingSymptom);

                if (editingSymptomTag && existingIndex !== -1) {
                    let existingId = selectedSymptoms[existingIndex].id || "new";
                    selectedSymptoms[existingIndex] = { id: existingId, symptom: pendingSymptom, note, since, severity };
                    updateSymptomTagDisplay(editingSymptomTag, selectedSymptoms[existingIndex]);
                    editingSymptomTag.setAttribute("data-id", existingId);
                } else {
                    const data = { id: "new", symptom: pendingSymptom, note, since, severity };
                    selectedSymptoms.push(data);
                    addSymptomTag(data);
                }

                symptomsModal.hide();
                pendingSymptom = "";
                editingSymptomTag = null;
                updateHiddenInput();
            }

            if (addSymptomBtn) {
                addSymptomBtn.addEventListener('click', () => {
                    universalTitle.textContent = "Add New Symptom";
                    universalLabel.innerHTML = 'Symptom Name <span class="text-danger">*</span>';
                    universalInput.value = symptomsInput.value.trim();
                    universalId.value = "";
                    universalType.value = "symptom";

                    universalAddModal.show();
                    setTimeout(() => universalInput.focus(), 500);
                });
            }

            function openEditModal(id, name) {
                universalTitle.textContent = "Edit Symptom";
                universalLabel.innerHTML = 'Symptom Name <span class="text-danger">*</span>';
                universalInput.value = name;
                universalId.value = id;
                universalType.value = "symptom";

                universalAddModal.show();
                setTimeout(() => universalInput.focus(), 500);
            }

            if (universalForm) {
                universalForm.addEventListener('submit', (e) => {
                    if (universalType.value !== 'symptom') return;

                    e.preventDefault();
                    const name = universalInput.value.trim();
                    const id = universalId.value;

                    if (!name) return;

                    const submitBtn = universalForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'saving...';

                    const url = id ? "<?= site_url('Consultation/editSymptomItem') ?>" : "<?= site_url('Consultation/addSymptom') ?>";
                    const body = id ?
                        `id=${id}&name=${encodeURIComponent(name)}` :
                        `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = symptomsList.findIndex(s => s.id == id);
                                    if (index !== -1) symptomsList[index].symptomsName = name;
                                    universalAddModal.hide();
                                    clearSearch();
                                } else {
                                    symptomsList.push({
                                        id: data.id,
                                        symptomsName: name,
                                        is_mine: true
                                    });
                                    universalAddModal.hide();
                                    clearSearch();
                                    setTimeout(() => openSymptomModal(name), 300);
                                }
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            function openDeleteModal(id, name) {
                universalDeleteName.textContent = name;
                universalDeleteId.value = id;
                universalDeleteType.value = "symptom";
                universalDeleteModal.show();
            }

            if (universalDeleteBtn) {
                universalDeleteBtn.addEventListener('click', () => {
                    if (universalDeleteType.value !== 'symptom') return;

                    const id = universalDeleteId.value;
                    fetch("<?= site_url('Consultation/deleteSymptomItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                symptomsList = symptomsList.filter(s => s.id != id);
                                universalDeleteModal.hide();
                                renderSymptomsSuggestions();
                            }
                        });
                });
            }

            if (symptomsInput) {
                symptomsInput.addEventListener("input", renderSymptomsSuggestions);
                symptomsInput.addEventListener("focus", renderSymptomsSuggestions);

                symptomsInput.addEventListener("keydown", e => {
                    if (e.key === "Enter" && symptomsInput.value.trim() !== "") {
                        e.preventDefault();
                        const val = symptomsInput.value.trim();
                        const exists = symptomsList.some(s => s.symptomsName.toLowerCase() === val.toLowerCase());

                        if (exists) {
                            openSymptomModal(val);
                            clearSearch();
                        } else {
                            if (addSymptomBtn) addSymptomBtn.click();
                        }
                    }
                });
            }

            if (symptomsModalEl) {
                symptomsModalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveSymptomModal();
                    }
                });
            }

            if (clearSymptomSearch) {
                clearSymptomSearch.addEventListener("click", clearSearch);
            }

            document.addEventListener("click", (e) => {
                if (symptomsTagContainer && !symptomsTagContainer.contains(e.target) &&
                    addSymptomBtn && !addSymptomBtn.contains(e.target)) {
                    if (symptomsSuggestionsBox) symptomsSuggestionsBox.style.display = "none";
                }
            });

            function addSymptomTag(data) {
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", data.id || "new");

                const textSpan = document.createElement("span");
                tag.appendChild(textSpan);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "text-light ms-2";
                removeBtn.innerHTML = "&times;";
                removeBtn.style.fontSize = "1rem";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";

                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tag.remove();
                    selectedSymptoms = selectedSymptoms.filter(s => s.symptom !== data.symptom);
                    updateHiddenInput();
                };

                tag.appendChild(removeBtn);
                updateSymptomTagDisplay(tag, data);
                tag.onclick = () => openSymptomModal(data.symptom, data, tag);

                const listContainer = document.getElementById('symptomsList');

                if (listContainer) {
                    listContainer.appendChild(tag);
                } else {
                    const wrapper = document.querySelector('#symptomsWrapper .mb-3');
                    if (wrapper) {
                        wrapper.insertAdjacentElement('beforebegin', tag);
                    } else if (symptomsTagContainer) {
                        symptomsTagContainer.parentElement.insertBefore(tag, symptomsTagContainer.parentElement.firstChild);
                    }
                }
            }

            function updateSymptomTagDisplay(tagEl, data) {
                const textParts = [data.symptom];
                const details = [];
                if (data.note) details.push(`Note: ${data.note}`);
                if (data.since) details.push(`Since: ${data.since}`);
                if (data.severity) details.push(`Severity: ${data.severity}`);
                if (details.length > 0) textParts.push(`(${details.join(", ")})`);
                tagEl.firstChild.textContent = textParts.join(" ");
            }

            function updateHiddenInput() {
                const hiddenInput = document.getElementById("symptomsJson");
                if (hiddenInput) hiddenInput.value = JSON.stringify(selectedSymptoms);
            }

            const preloadSymptoms = <?php echo (isset($symptoms) && !empty($symptoms)) ? json_encode($symptoms) : '[]'; ?>;
            if (preloadSymptoms.length > 0) {
                preloadSymptoms.forEach(item => {
                    const data = {
                        id: item.id || "",
                        symptom: item.symptom_name,
                        note: item.note || "",
                        since: item.since || "",
                        severity: item.severity || ""
                    };
                    selectedSymptoms.push(data);
                    addSymptomTag(data);
                });
                updateHiddenInput();
            }
        });
    </script>

    <!-- New Findings save script -->
    <script>
        let findingsList = <?php echo (isset($findingsList) && !empty($findingsList)) ? json_encode($findingsList) : '[]'; ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const findingsInput = document.getElementById("searchInput");
            const suggestionsBox = document.getElementById("suggestionsBox");
            const tagContainer = document.getElementById("findingsInput");
            const addFindingBtn = document.getElementById("addFindingBtn");
            const clearFindingSearch = document.getElementById("clearFindingSearch");
            const findingsListContainer = document.getElementById("findingsList");

            const universalAddModalEl = document.getElementById("universalAddMasterModal");
            const universalAddModal = new bootstrap.Modal(universalAddModalEl);
            const universalForm = document.getElementById("universalAddMasterForm");
            const universalTitle = document.getElementById("universalMasterTitle");
            const universalLabel = document.getElementById("universalMasterLabel");
            const universalInput = document.getElementById("universalMasterInput");
            const universalId = document.getElementById("universalMasterId");
            const universalType = document.getElementById("universalMasterType");

            const universalDeleteModalEl = document.getElementById("universalDeleteModal");
            const universalDeleteModal = new bootstrap.Modal(universalDeleteModalEl);
            const universalDeleteName = document.getElementById("universalDeleteNameDisplay");
            const universalDeleteId = document.getElementById("universalDeleteId");
            const universalDeleteType = document.getElementById("universalDeleteType");
            const universalDeleteBtn = document.getElementById("universalDeleteBtn");

            const modalEl = document.getElementById("inputModal");
            const modal = new bootstrap.Modal(modalEl);
            const modalNote = document.getElementById("modalNote");
            const modalSince = document.getElementById("modalSince");
            const modalSeverity = document.getElementById("modalSeverity");
            const modalTitle = document.getElementById("modalTitle");

            let selectedFindings = [];
            let pendingTag = "";
            let editingTagEl = null;

            const addModalCloseBtns = universalAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            addModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalAddModal.hide();

                    if (universalForm) universalForm.reset();
                });
            });

            const deleteModalCloseBtns = universalDeleteModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            deleteModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalDeleteModal.hide();
                });
            });
            function renderSuggestions() {
                if (!findingsInput) return;
                const query = findingsInput.value.trim().toLowerCase();
                suggestionsBox.innerHTML = "";

                if (query.length > 0) {
                    if (clearFindingSearch) clearFindingSearch.style.display = 'block';
                } else {
                    if (clearFindingSearch) clearFindingSearch.style.display = 'none';
                    if (addFindingBtn) addFindingBtn.style.display = 'none';
                }

                const filtered = findingsList.filter(f => f.findingsName.toLowerCase().includes(query));

                if (filtered.length === 0 && query !== "") {
                    if (addFindingBtn) addFindingBtn.style.display = 'block';

                    if (suggestionsBox) {
                        suggestionsBox.style.display = 'block';
                        const noResultDiv = document.createElement("div");
                        noResultDiv.className = "p-2 text-muted";
                        noResultDiv.style.fontSize = "0.9rem";
                        noResultDiv.textContent = "No result found on search – Add new";
                        suggestionsBox.appendChild(noResultDiv);
                    }
                } else {
                    if (addFindingBtn) addFindingBtn.style.display = 'none';

                    if (suggestionsBox && query !== "") {
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom";
                            div.style.cursor = "pointer";
                            div.style.padding = "1px 6px";

                            div.addEventListener("mouseenter", () => {
                                div.style.backgroundColor = "#8db8afff";
                            });

                            div.addEventListener("mouseleave", () => {
                                div.style.backgroundColor = "transparent";
                            });

                            const spanName = document.createElement("span");
                            spanName.textContent = item.findingsName;
                            spanName.className = "flex-grow-1";
                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                openModal(item.findingsName);
                                clearSearch();
                            };
                            div.appendChild(spanName);

                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.title = "Edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openEditModal(item.id, item.findingsName);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.title = "Delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openDeleteModal(item.id, item.findingsName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }

                            div.onclick = () => {
                                openModal(item.findingsName);
                                clearSearch();
                            };
                            suggestionsBox.appendChild(div);
                        });
                        suggestionsBox.style.display = "block";
                    } else {
                        if (suggestionsBox) suggestionsBox.style.display = "none";
                    }
                }
            }

            function clearSearch() {
                if (findingsInput) {
                    findingsInput.value = "";
                    findingsInput.focus();
                }
                if (suggestionsBox) suggestionsBox.style.display = "none";
                if (clearFindingSearch) clearFindingSearch.style.display = "none";
                if (addFindingBtn) addFindingBtn.style.display = "none";
            }

            window.openModal = function (tagName, existing = null, tagEl = null) {
                pendingTag = tagName;
                editingTagEl = tagEl;

                if (modalTitle) modalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
                if (modalNote) modalNote.value = existing?.note || "";
                if (modalSince) modalSince.value = existing?.since || "";
                if (modalSeverity) modalSeverity.value = existing?.severity || "";

                modal.show();
                setTimeout(() => { if (modalNote) modalNote.focus(); }, 500);
            }

            window.saveModal = function () {
                const note = modalNote ? modalNote.value.trim() : "";
                const since = modalSince ? modalSince.value.trim() : "";
                const severity = modalSeverity ? modalSeverity.value : "";

                if (!pendingTag) return;

                const existingIndex = selectedFindings.findIndex(f => f.finding === pendingTag);

                if (editingTagEl && existingIndex !== -1) {
                    let existingId = selectedFindings[existingIndex].id || "new";
                    selectedFindings[existingIndex] = { id: existingId, finding: pendingTag, note, since, severity };
                    updateTagDisplay(editingTagEl, selectedFindings[existingIndex]);
                    editingTagEl.setAttribute("data-id", existingId);
                } else {
                    const data = { id: "new", finding: pendingTag, note, since, severity };
                    selectedFindings.push(data);
                    addTag(data);
                }

                modal.hide();
                pendingTag = "";
                editingTagEl = null;
                updateHiddenInput();
            }

            if (addFindingBtn) {
                addFindingBtn.addEventListener('click', () => {
                    universalTitle.textContent = "Add New Finding";
                    universalLabel.innerHTML = 'Finding Name <span class="text-danger">*</span>';
                    universalInput.value = findingsInput.value.trim();
                    universalId.value = "";
                    universalType.value = "finding";

                    universalAddModal.show();
                    setTimeout(() => universalInput.focus(), 500);
                });
            }

            function openEditModal(id, name) {
                universalTitle.textContent = "Edit Finding";
                universalLabel.innerHTML = 'Finding Name <span class="text-danger">*</span>';
                universalInput.value = name;
                universalId.value = id;
                universalType.value = "finding";

                universalAddModal.show();
                setTimeout(() => universalInput.focus(), 500);
            }

            if (universalForm) {
                universalForm.addEventListener('submit', (e) => {
                    if (universalType.value !== 'finding') return;

                    e.preventDefault();

                    const name = universalInput.value.trim();
                    const id = universalId.value;
                    if (!name) return;

                    const submitBtn = universalForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id ? "<?= site_url('Consultation/editFindingItem') ?>" : "<?= site_url('Consultation/addFinding') ?>";
                    const body = id ? `id=${id}&name=${encodeURIComponent(name)}` : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = findingsList.findIndex(f => f.id == id);
                                    if (index !== -1) findingsList[index].findingsName = name;
                                    universalAddModal.hide();
                                    clearSearch();
                                } else {
                                    findingsList.push({
                                        id: data.id,
                                        findingsName: name,
                                        is_mine: true
                                    });
                                    universalAddModal.hide();
                                    clearSearch();
                                    setTimeout(() => openModal(name), 300);
                                }
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error("Fetch error:", err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            function openDeleteModal(id, name) {
                universalDeleteName.textContent = name;
                universalDeleteId.value = id;
                universalDeleteType.value = "finding";
                universalDeleteModal.show();
            }

            if (universalDeleteBtn) {
                universalDeleteBtn.addEventListener('click', () => {
                    if (universalDeleteType.value !== 'finding') return;

                    const id = universalDeleteId.value;
                    fetch("<?= site_url('Consultation/deleteFindingItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                findingsList = findingsList.filter(f => f.id != id);
                                universalDeleteModal.hide();
                                renderSuggestions();
                            }
                        });
                });
            }

            if (findingsInput) {
                findingsInput.addEventListener("input", renderSuggestions);
                findingsInput.addEventListener("focus", renderSuggestions);

                findingsInput.addEventListener("keydown", e => {
                    if (e.key === "Enter" && findingsInput.value.trim() !== "") {
                        e.preventDefault();
                        const val = findingsInput.value.trim();
                        const exists = findingsList.some(f => f.findingsName.toLowerCase() === val.toLowerCase());

                        if (exists) {
                            openModal(val);
                            clearSearch();
                        } else {
                            if (addFindingBtn) addFindingBtn.click();
                        }
                    }
                });
            }

            if (modalEl) {
                modalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveModal();
                    }
                });
            }

            if (clearFindingSearch) {
                clearFindingSearch.addEventListener("click", clearSearch);
            }

            document.addEventListener("click", (e) => {
                if (tagContainer && !tagContainer.contains(e.target) &&
                    addFindingBtn && !addFindingBtn.contains(e.target)) {
                    if (suggestionsBox) suggestionsBox.style.display = "none";
                }
            });

            function addTag(data) {
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", data.id || "new");

                const textSpan = document.createElement("span");
                tag.appendChild(textSpan);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "text-light ms-2";
                removeBtn.innerHTML = "&times;";
                removeBtn.style.fontSize = "1rem";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tag.remove();
                    selectedFindings = selectedFindings.filter(f => f.finding !== data.finding);
                    updateHiddenInput();
                };

                tag.appendChild(removeBtn);
                updateTagDisplay(tag, data);
                tag.onclick = () => openModal(data.finding, data, tag);

                if (findingsListContainer) {
                    findingsListContainer.appendChild(tag);
                } else if (tagContainer) {
                    tagContainer.parentElement.insertBefore(tag, tagContainer.parentElement.firstChild);
                }
            }

            function updateTagDisplay(tagEl, data) {
                const textParts = [data.finding];
                const details = [];
                if (data.note) details.push(`Note: ${data.note}`);
                if (data.since) details.push(`Since: ${data.since}`);
                if (data.severity) details.push(`Severity: ${data.severity}`);
                if (details.length > 0) textParts.push(`(${details.join(", ")})`);
                tagEl.firstChild.textContent = textParts.join(" ");
            }

            function updateHiddenInput() {
                const hiddenInput = document.getElementById("findingsJson");
                if (hiddenInput) hiddenInput.value = JSON.stringify(selectedFindings);
            }

            const preloadFindings = <?php echo (isset($findings) && !empty($findings)) ? json_encode($findings) : '[]'; ?>;
            if (preloadFindings.length > 0) {
                preloadFindings.forEach(item => {
                    const data = {
                        id: item.id || "",
                        finding: item.finding_name,
                        note: item.note || "",
                        since: item.since || "",
                        severity: item.severity || ""
                    };
                    selectedFindings.push(data);
                    addTag(data);
                });
                updateHiddenInput();
            }
        });
    </script>

    <!--new Diagnosis Model and save script -->
    <script>
        let diagnosisList = <?php echo (isset($diagnosisList) && !empty($diagnosisList)) ? json_encode($diagnosisList) : '[]'; ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const diagnosisInput = document.getElementById("diagnosisInput");
            const suggestionsBox = document.getElementById("diagnosisSuggestionsBox");
            const tagContainer = document.getElementById("diagnosisInputBox");
            const addDiagnosisBtn = document.getElementById("addDiagnosisBtn");
            const clearDiagnosisSearch = document.getElementById("clearDiagnosisSearch");
            const diagnosisListContainer = document.getElementById("diagnosisList");

            const diagnosisModalEl = document.getElementById("diagnosisModal");
            const diagnosisModal = new bootstrap.Modal(diagnosisModalEl);
            const diagnosisNote = document.getElementById("diagnosisNote");
            const diagnosisSince = document.getElementById("diagnosisSince");
            const diagnosisSeverity = document.getElementById("diagnosisSeverity");
            const diagnosisModalTitle = document.querySelector('#diagnosisModal .modal-title');

            const universalAddModalEl = document.getElementById("universalAddMasterModal");
            const universalAddModal = new bootstrap.Modal(universalAddModalEl);
            const universalForm = document.getElementById("universalAddMasterForm");
            const universalTitle = document.getElementById("universalMasterTitle");
            const universalLabel = document.getElementById("universalMasterLabel");
            const universalInput = document.getElementById("universalMasterInput");
            const universalId = document.getElementById("universalMasterId");
            const universalType = document.getElementById("universalMasterType");

            const universalDeleteModalEl = document.getElementById("universalDeleteModal");
            const universalDeleteModal = new bootstrap.Modal(universalDeleteModalEl);
            const universalDeleteName = document.getElementById("universalDeleteNameDisplay");
            const universalDeleteId = document.getElementById("universalDeleteId");
            const universalDeleteType = document.getElementById("universalDeleteType");
            const universalDeleteBtn = document.getElementById("universalDeleteBtn");

            let selectedDiagnosis = [];
            let pendingDiagnosis = "";
            let editingDiagnosisTag = null;

            const addModalCloseBtns = universalAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            addModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalAddModal.hide();

                    if (universalForm) universalForm.reset();
                });
            });

            const deleteModalCloseBtns = universalDeleteModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            deleteModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalDeleteModal.hide();
                });
            });

            function renderDiagnosisSuggestions() {
                if (!diagnosisInput) return;
                const query = diagnosisInput.value.trim().toLowerCase();
                suggestionsBox.innerHTML = "";

                if (query.length > 0) {
                    if (clearDiagnosisSearch) clearDiagnosisSearch.style.display = 'block';
                } else {
                    if (clearDiagnosisSearch) clearDiagnosisSearch.style.display = 'none';
                    if (addDiagnosisBtn) addDiagnosisBtn.style.display = 'none';
                }

                const filtered = diagnosisList.filter(d => d.diagnosisName.toLowerCase().includes(query));

                if (filtered.length === 0 && query !== "") {
                    if (addDiagnosisBtn) addDiagnosisBtn.style.display = 'block';

                    if (suggestionsBox) {
                        suggestionsBox.style.display = 'block';
                        const noResultDiv = document.createElement("div");
                        noResultDiv.className = "p-2 text-muted";
                        noResultDiv.style.fontSize = "0.9rem";
                        noResultDiv.textContent = "No result found on search – Add new";
                        suggestionsBox.appendChild(noResultDiv);
                    }
                } else {
                    if (addDiagnosisBtn) addDiagnosisBtn.style.display = 'none';

                    if (suggestionsBox && query !== "") {
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom";
                            div.style.cursor = "pointer";
                            div.style.padding = "1px 6px";

                            div.addEventListener("mouseenter", () => {
                                div.style.backgroundColor = "#8db8afff";
                            });

                            div.addEventListener("mouseleave", () => {
                                div.style.backgroundColor = "transparent";
                            });

                            const spanName = document.createElement("span");
                            spanName.textContent = item.diagnosisName;
                            spanName.className = "flex-grow-1";
                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                openDiagnosisModal(item.diagnosisName);
                                clearSearch();
                            };
                            div.appendChild(spanName);

                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.title = "Edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openUniversalEdit('diagnosis', item.id, item.diagnosisName);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.title = "Delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openUniversalDelete('diagnosis', item.id, item.diagnosisName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }

                            div.onclick = () => {
                                openDiagnosisModal(item.diagnosisName);
                                clearSearch();
                            };
                            suggestionsBox.appendChild(div);
                        });
                        suggestionsBox.style.display = "block";
                    } else {
                        if (suggestionsBox) suggestionsBox.style.display = "none";
                    }
                }
            }

            function clearSearch() {
                if (diagnosisInput) {
                    diagnosisInput.value = "";
                    diagnosisInput.focus();
                }
                if (suggestionsBox) suggestionsBox.style.display = "none";
                if (clearDiagnosisSearch) clearDiagnosisSearch.style.display = "none";
                if (addDiagnosisBtn) addDiagnosisBtn.style.display = "none";
            }

            window.openDiagnosisModal = function (name, existing = null, tagEl = null) {
                pendingDiagnosis = name;
                editingDiagnosisTag = tagEl;

                if (diagnosisModalTitle) diagnosisModalTitle.textContent = existing ? `Edit Diagnosis: ${name}` : `Diagnosis Details for: ${name}`;
                if (diagnosisNote) diagnosisNote.value = existing?.note || "";
                if (diagnosisSince) diagnosisSince.value = existing?.since || "";
                if (diagnosisSeverity) diagnosisSeverity.value = existing?.severity || "";

                diagnosisModal.show();
                setTimeout(() => { if (diagnosisNote) diagnosisNote.focus(); }, 500);
            }

            window.saveDiagnosisModal = function () {
                const note = diagnosisNote ? diagnosisNote.value.trim() : "";
                const since = diagnosisSince ? diagnosisSince.value.trim() : "";
                const severity = diagnosisSeverity ? diagnosisSeverity.value : "";

                if (!pendingDiagnosis) return;

                const existingIndex = selectedDiagnosis.findIndex(d => d.name === pendingDiagnosis);

                if (editingDiagnosisTag && existingIndex !== -1) {
                    let existingId = selectedDiagnosis[existingIndex].id || "new";
                    selectedDiagnosis[existingIndex] = { id: existingId, name: pendingDiagnosis, note, since, severity };
                    updateDiagnosisTag(editingDiagnosisTag, selectedDiagnosis[existingIndex]);
                    editingDiagnosisTag.setAttribute("data-id", existingId);
                } else {
                    const data = { id: "new", name: pendingDiagnosis, note, since, severity };
                    selectedDiagnosis.push(data);
                    addDiagnosisTag(data);
                }

                diagnosisModal.hide();
                pendingDiagnosis = "";
                editingDiagnosisTag = null;
                updateDiagnosisHidden();
            }

            if (addDiagnosisBtn) {
                addDiagnosisBtn.addEventListener('click', () => {
                    universalTitle.textContent = "Add New Diagnosis";
                    universalLabel.innerHTML = 'Diagnosis Name <span class="text-danger">*</span>';
                    universalInput.value = diagnosisInput.value.trim();
                    universalId.value = "";
                    universalType.value = "diagnosis";

                    universalAddModal.show();
                    setTimeout(() => universalInput.focus(), 500);
                });
            }

            function openUniversalEdit(type, id, name) {
                universalTitle.textContent = "Edit Diagnosis";
                universalLabel.innerHTML = 'Diagnosis Name <span class="text-danger">*</span>';
                universalInput.value = name;
                universalId.value = id;
                universalType.value = "diagnosis";

                universalAddModal.show();
                setTimeout(() => universalInput.focus(), 500);
            }

            if (universalForm) {
                universalForm.addEventListener('submit', (e) => {
                    if (universalType.value !== 'diagnosis') return;

                    e.preventDefault();
                    const name = universalInput.value.trim();
                    const id = universalId.value;

                    if (!name) return;

                    const submitBtn = universalForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id ? "<?= site_url('Consultation/editDiagnosisItem') ?>" : "<?= site_url('Consultation/addDiagnosis') ?>";
                    const body = id ? `id=${id}&name=${encodeURIComponent(name)}` : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = diagnosisList.findIndex(d => d.id == id);
                                    if (index !== -1) diagnosisList[index].diagnosisName = name;
                                    clearSearch();
                                    universalAddModal.hide();
                                } else {
                                    diagnosisList.push({
                                        id: data.id,
                                        diagnosisName: name,
                                        is_mine: true
                                    });
                                    universalAddModal.hide();
                                    clearSearch();
                                    setTimeout(() => openDiagnosisModal(name), 300);
                                }
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            function openUniversalDelete(type, id, name) {
                universalDeleteName.textContent = name;
                universalDeleteId.value = id;
                universalDeleteType.value = "diagnosis";
                universalDeleteModal.show();
            }

            if (universalDeleteBtn) {
                universalDeleteBtn.addEventListener('click', () => {
                    if (universalDeleteType.value !== 'diagnosis') return;

                    const id = universalDeleteId.value;
                    fetch("<?= site_url('Consultation/deleteDiagnosisItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                diagnosisList = diagnosisList.filter(d => d.id != id);
                                universalDeleteModal.hide();
                                renderDiagnosisSuggestions();
                            }
                        });
                });
            }

            if (diagnosisInput) {
                diagnosisInput.addEventListener("input", renderDiagnosisSuggestions);
                diagnosisInput.addEventListener("focus", renderDiagnosisSuggestions);

                diagnosisInput.addEventListener("keydown", e => {
                    if (e.key === "Enter" && diagnosisInput.value.trim() !== "") {
                        e.preventDefault();
                        const val = diagnosisInput.value.trim();
                        const exists = diagnosisList.some(d => d.diagnosisName.toLowerCase() === val.toLowerCase());

                        if (exists) {
                            openDiagnosisModal(val);
                            clearSearch();
                        } else {
                            if (addDiagnosisBtn) addDiagnosisBtn.click();
                        }
                    }
                });
            }

            if (diagnosisModalEl) {
                diagnosisModalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveDiagnosisModal();
                    }
                });
            }

            if (clearDiagnosisSearch) {
                clearDiagnosisSearch.addEventListener("click", clearSearch);
            }

            document.addEventListener("click", (e) => {
                if (tagContainer && !tagContainer.contains(e.target) &&
                    addDiagnosisBtn && !addDiagnosisBtn.contains(e.target)) {
                    if (suggestionsBox) suggestionsBox.style.display = "none";
                }
            });

            function addDiagnosisTag(data) {
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", data.id || "new");

                const textSpan = document.createElement("span");
                tag.appendChild(textSpan);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "text-light ms-2";
                removeBtn.innerHTML = "&times;";
                removeBtn.style.fontSize = "1rem";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tag.remove();
                    selectedDiagnosis = selectedDiagnosis.filter(d => d.name !== data.name);
                    updateDiagnosisHidden();
                };

                tag.appendChild(removeBtn);
                updateDiagnosisTag(tag, data);
                tag.onclick = () => openDiagnosisModal(data.name, data, tag);

                if (diagnosisListContainer) {
                    diagnosisListContainer.appendChild(tag);
                } else if (tagContainer) {
                    tagContainer.parentElement.insertBefore(tag, tagContainer.parentElement.firstChild);
                }
            }

            function updateDiagnosisTag(tagEl, data) {
                const textParts = [data.name];
                const details = [];
                if (data.note) details.push(`Note: ${data.note}`);
                if (data.since) details.push(`Since: ${data.since}`);
                if (data.severity) details.push(`Severity: ${data.severity}`);
                if (details.length > 0) textParts.push(`(${details.join(", ")})`);
                tagEl.firstChild.textContent = textParts.join(" ");
            }

            function updateDiagnosisHidden() {
                const hiddenInput = document.getElementById("diagnosisJson");
                if (hiddenInput) hiddenInput.value = JSON.stringify(selectedDiagnosis);
            }

            const preloadDiagnosis = <?php echo (isset($diagnosis) && !empty($diagnosis)) ? json_encode($diagnosis) : '[]'; ?>;
            if (preloadDiagnosis.length > 0) {
                preloadDiagnosis.forEach(item => {
                    const data = {
                        id: item.id || "",
                        name: item.diagnosis_name,
                        note: item.note || "",
                        since: item.since || "",
                        severity: item.severity || ""
                    };
                    selectedDiagnosis.push(data);
                    addDiagnosisTag(data);
                });
                updateDiagnosisHidden();
            }
        });
    </script>

    <!-- new Investigation save script -->
    <script>
        let investigationsList = <?php echo (isset($investigationsList) && !empty($investigationsList)) ? json_encode($investigationsList) : '[]'; ?>;

        document.addEventListener("DOMContentLoaded", function () {
            const investigationsInput = document.getElementById("investigationsSearchInput");
            const suggestionsBox = document.getElementById("investigationsSuggestionsBox");
            const tagContainer = document.getElementById("investigationsInput");
            const addInvestigationBtn = document.getElementById("addInvestigationBtn");
            const clearInvestigationSearch = document.getElementById("clearInvestigationSearch");
            const investigationsListContainer = document.getElementById("investigationsList");

            const investigationsModalEl = document.getElementById("investigationsModal");
            const investigationsModal = new bootstrap.Modal(investigationsModalEl);
            const investigationNote = document.getElementById("investigationNote");
            const investigationsModalTitle = document.getElementById("investigationsModalTitle");

            const universalAddModalEl = document.getElementById("universalAddMasterModal");
            const universalAddModal = new bootstrap.Modal(universalAddModalEl);
            const universalForm = document.getElementById("universalAddMasterForm");
            const universalTitle = document.getElementById("universalMasterTitle");
            const universalLabel = document.getElementById("universalMasterLabel");
            const universalInput = document.getElementById("universalMasterInput");
            const universalId = document.getElementById("universalMasterId");
            const universalType = document.getElementById("universalMasterType");

            const universalDeleteModalEl = document.getElementById("universalDeleteModal");
            const universalDeleteModal = new bootstrap.Modal(universalDeleteModalEl);
            const universalDeleteName = document.getElementById("universalDeleteNameDisplay");
            const universalDeleteId = document.getElementById("universalDeleteId");
            const universalDeleteType = document.getElementById("universalDeleteType");
            const universalDeleteBtn = document.getElementById("universalDeleteBtn");

            let selectedInvestigations = [];
            let pendingInvestigation = "";
            let editingInvestigationTag = null;

            const addModalCloseBtns = universalAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            addModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalAddModal.hide();

                    if (universalForm) universalForm.reset();
                });
            });

            const deleteModalCloseBtns = universalDeleteModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
            deleteModalCloseBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    universalDeleteModal.hide();
                });
            });
            function renderInvestigationsSuggestions() {
                if (!investigationsInput) return;
                const query = investigationsInput.value.trim().toLowerCase();
                suggestionsBox.innerHTML = "";

                if (query.length > 0) {
                    if (clearInvestigationSearch) clearInvestigationSearch.style.display = 'block';
                } else {
                    if (clearInvestigationSearch) clearInvestigationSearch.style.display = 'none';
                    if (addInvestigationBtn) addInvestigationBtn.style.display = 'none';
                }

                const filtered = investigationsList.filter(i => i.investigationsName.toLowerCase().includes(query));

                if (filtered.length === 0 && query !== "") {
                    if (addInvestigationBtn) addInvestigationBtn.style.display = 'block';
                    if (suggestionsBox) {
                        suggestionsBox.style.display = 'block';
                        const noResultDiv = document.createElement("div");
                        noResultDiv.className = "p-2 text-muted";
                        noResultDiv.style.fontSize = "0.9rem";
                        noResultDiv.textContent = "No result found on search – Add new";
                        suggestionsBox.appendChild(noResultDiv);
                    }
                } else {
                    if (addInvestigationBtn) addInvestigationBtn.style.display = 'none';

                    if (suggestionsBox && query !== "") {
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom";
                            div.style.cursor = "pointer";
                            div.style.padding = "1px 6px";

                            div.addEventListener("mouseenter", () => {
                                div.style.backgroundColor = "#8db8afff";
                            });

                            div.addEventListener("mouseleave", () => {
                                div.style.backgroundColor = "transparent";
                            });

                            const spanName = document.createElement("span");
                            spanName.textContent = item.investigationsName;
                            spanName.className = "flex-grow-1";
                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                openInvestigationModal(item.investigationsName);
                                clearSearch();
                            };
                            div.appendChild(spanName);

                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.title = "Edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openUniversalEdit('investigation', item.id, item.investigationsName);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.title = "Delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openUniversalDelete('investigation', item.id, item.investigationsName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }

                            div.onclick = () => {
                                openInvestigationModal(item.investigationsName);
                                clearSearch();
                            };
                            suggestionsBox.appendChild(div);
                        });
                        suggestionsBox.style.display = "block";
                    } else {
                        if (suggestionsBox) suggestionsBox.style.display = "none";
                    }
                }
            }

            function clearSearch() {
                if (investigationsInput) {
                    investigationsInput.value = "";
                    investigationsInput.focus();
                }
                if (suggestionsBox) suggestionsBox.style.display = "none";
                if (clearInvestigationSearch) clearInvestigationSearch.style.display = "none";
                if (addInvestigationBtn) addInvestigationBtn.style.display = "none";
            }

            window.openInvestigationModal = function (tagName, existing = null, tagEl = null) {
                pendingInvestigation = tagName;
                editingInvestigationTag = tagEl;

                if (investigationsModalTitle) investigationsModalTitle.textContent = existing ? `Edit: ${tagName}` : `Detail for: ${tagName}`;
                if (investigationNote) investigationNote.value = existing?.note || "";

                investigationsModal.show();
                setTimeout(() => { if (investigationNote) investigationNote.focus(); }, 500);
            }

            window.saveInvestigationModal = function () {
                const note = investigationNote ? investigationNote.value.trim() : "";

                if (!pendingInvestigation) return;

                const existingIndex = selectedInvestigations.findIndex(s => s.investigation === pendingInvestigation);

                if (editingInvestigationTag && existingIndex !== -1) {
                    let existingId = selectedInvestigations[existingIndex].id || "new";
                    selectedInvestigations[existingIndex] = { id: existingId, investigation: pendingInvestigation, note };
                    updateInvestigationTagDisplay(editingInvestigationTag, selectedInvestigations[existingIndex]);
                    editingInvestigationTag.setAttribute("data-id", existingId);
                } else {
                    const data = { id: "new", investigation: pendingInvestigation, note };
                    selectedInvestigations.push(data);
                    addInvestigationTag(data);
                }

                investigationsModal.hide();
                pendingInvestigation = "";
                editingInvestigationTag = null;
                updateInvestigationHiddenInput();
            }

            if (addInvestigationBtn) {
                addInvestigationBtn.addEventListener('click', () => {
                    universalTitle.textContent = "Add New Investigation";
                    universalLabel.innerHTML = 'Investigation Name <span class="text-danger">*</span>';
                    universalInput.value = investigationsInput.value.trim();
                    universalId.value = "";
                    universalType.value = "investigation"; // <--- FLAG

                    universalAddModal.show();
                    setTimeout(() => universalInput.focus(), 500);
                });
            }

            function openUniversalEdit(type, id, name) {
                universalTitle.textContent = "Edit Investigation";
                universalLabel.innerHTML = 'Investigation Name <span class="text-danger">*</span>';
                universalInput.value = name;
                universalId.value = id;
                universalType.value = "investigation";

                universalAddModal.show();
                setTimeout(() => universalInput.focus(), 500);
            }

            if (universalForm) {
                universalForm.addEventListener('submit', (e) => {
                    if (universalType.value !== 'investigation') return;

                    e.preventDefault();
                    const name = universalInput.value.trim();
                    const id = universalId.value;

                    if (!name) return;

                    const submitBtn = universalForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id ? "<?= site_url('Consultation/editInvestigationItem') ?>" : "<?= site_url('Consultation/addInvestigation') ?>";
                    const body = id ? `id=${id}&name=${encodeURIComponent(name)}` : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = investigationsList.findIndex(i => i.id == id);
                                    if (index !== -1) investigationsList[index].investigationsName = name;
                                    universalAddModal.hide();
                                    clearSearch();
                                } else {
                                    investigationsList.push({
                                        id: data.id,
                                        investigationsName: name,
                                        is_mine: true
                                    });
                                    universalAddModal.hide();
                                    clearSearch();
                                    setTimeout(() => openInvestigationModal(name), 300);
                                }
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            function openUniversalDelete(type, id, name) {
                universalDeleteName.textContent = name;
                universalDeleteId.value = id;
                universalDeleteType.value = "investigation"; // <--- FLAG
                universalDeleteModal.show();
            }

            if (universalDeleteBtn) {
                universalDeleteBtn.addEventListener('click', () => {
                    if (universalDeleteType.value !== 'investigation') return;

                    const id = universalDeleteId.value;
                    fetch("<?= site_url('Consultation/deleteInvestigationItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                investigationsList = investigationsList.filter(i => i.id != id);
                                universalDeleteModal.hide();
                                renderInvestigationsSuggestions();
                            }
                        });
                });
            }

            if (investigationsInput) {
                investigationsInput.addEventListener("input", renderInvestigationsSuggestions);
                investigationsInput.addEventListener("focus", renderInvestigationsSuggestions);

                investigationsInput.addEventListener("keydown", e => {
                    if (e.key === "Enter" && investigationsInput.value.trim() !== "") {
                        e.preventDefault();
                        const val = investigationsInput.value.trim();
                        const exists = investigationsList.some(i => i.investigationsName.toLowerCase() === val.toLowerCase());

                        if (exists) {
                            openInvestigationModal(val);
                            clearSearch();
                        } else {
                            if (addInvestigationBtn) addInvestigationBtn.click();
                        }
                    }
                });
            }

            if (investigationsModalEl) {
                investigationsModalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveInvestigationModal();
                    }
                });
            }

            if (clearInvestigationSearch) {
                clearInvestigationSearch.addEventListener("click", clearSearch);
            }

            document.addEventListener("click", (e) => {
                if (tagContainer && !tagContainer.contains(e.target) &&
                    addInvestigationBtn && !addInvestigationBtn.contains(e.target)) {
                    if (suggestionsBox) suggestionsBox.style.display = "none";
                }
            });

            function addInvestigationTag(data) {
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", data.id || "new");

                const textSpan = document.createElement("span");
                tag.appendChild(textSpan);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "text-light ms-2";
                removeBtn.innerHTML = "&times;";
                removeBtn.style.fontSize = "1rem";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tag.remove();
                    selectedInvestigations = selectedInvestigations.filter(s => s.investigation !== data.investigation);
                    updateInvestigationHiddenInput();
                };

                tag.appendChild(removeBtn);
                updateInvestigationTagDisplay(tag, data);
                tag.onclick = () => openInvestigationModal(data.investigation, data, tag);

                if (investigationsListContainer) {
                    investigationsListContainer.appendChild(tag);
                } else if (tagContainer) {
                    tagContainer.parentElement.insertBefore(tag, tagContainer.parentElement.firstChild);
                }
            }

            function updateInvestigationTagDisplay(tagEl, data) {
                const textParts = [data.investigation];
                const details = [];
                if (data.note) details.push(`Note: ${data.note}`);
                if (details.length > 0) textParts.push(`(${details.join(", ")})`);
                tagEl.firstChild.textContent = textParts.join(" ");
            }

            function updateInvestigationHiddenInput() {
                const hiddenInput = document.getElementById("investigationsJson");
                if (hiddenInput) hiddenInput.value = JSON.stringify(selectedInvestigations);
            }

            const preloadInvestigations = <?php echo (isset($investigations) && !empty($investigations)) ? json_encode($investigations) : '[]'; ?>;
            if (preloadInvestigations.length > 0) {
                preloadInvestigations.forEach(item => {
                    const data = {
                        id: item.id || "",
                        investigation: item.investigation_name,
                        note: item.note || ""
                    };
                    selectedInvestigations.push(data);
                    addInvestigationTag(data);
                });
                updateInvestigationHiddenInput();
            }
        });
    </script>

    <!-- New Instruction Search Button -->
    <script>
        let instructionsList = <?php echo (isset($instructionsList) && !empty($instructionsList)) ? json_encode($instructionsList) : '[]'; ?>;
        let savedInstructions = <?php echo (isset($instructions) && !empty($instructions)) ? json_encode($instructions) : '[]'; ?>;

        let selectedInstructionSet = new Set();
        const normIns = s => (s || '').toLowerCase().trim();

        if (Array.isArray(savedInstructions)) {
            savedInstructions.forEach(i => {
                let name = i.instruction_name || i;
                selectedInstructionSet.add(normIns(name));
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('instructionSearch');
            const clearBtn = document.getElementById('clearInstructionSearch');
            const addBtn = document.getElementById('addInstruction') || document.getElementById('addInstructionBtn');
            const list = document.getElementById('instructionList');

            const uAddModalEl = document.getElementById("universalAddMasterModal");
            const uAddModal = new bootstrap.Modal(uAddModalEl);
            const uAddForm = document.getElementById("universalAddMasterForm");
            const uTitle = document.getElementById("universalMasterTitle");
            const uLabel = document.getElementById("universalMasterLabel");
            const uInput = document.getElementById("universalMasterInput");
            const uId = document.getElementById("universalMasterId");
            const uType = document.getElementById("universalMasterType");

            const uDelModalEl = document.getElementById("universalDeleteModal");
            const uDelModal = new bootstrap.Modal(uDelModalEl);
            const uDelName = document.getElementById("universalDeleteNameDisplay");
            const uDelId = document.getElementById("universalDeleteId");
            const uDelType = document.getElementById("universalDeleteType");
            const uDelBtn = document.getElementById("universalDeleteBtn");

            uAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    uAddModal.hide();
                    if (uAddForm) uAddForm.reset();
                });
            });

            uDelModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    uDelModal.hide();
                });
            });

            function sortList() {
                const items = Array.from(list.querySelectorAll('.instruction-item'));
                const selected = items.filter(i => i.querySelector('input').checked);
                const unselected = items.filter(i => !i.querySelector('input').checked);

                items.forEach(i => i.remove());
                selected.forEach(i => list.appendChild(i));
                unselected.forEach(i => list.appendChild(i));
            }

            function renderList() {
                const q = normIns(searchInput.value);
                list.innerHTML = '';

                if (q.length > 0) {
                    clearBtn.style.display = 'block';
                } else {
                    clearBtn.style.display = 'none';
                    if (addBtn) addBtn.style.display = 'none';
                }

                let filtered = instructionsList.filter(i => normIns(i.instructionsName).includes(q));

                filtered.sort((a, b) => {
                    const aSelected = selectedInstructionSet.has(normIns(a.instructionsName));
                    const bSelected = selectedInstructionSet.has(normIns(b.instructionsName));

                    if (aSelected && !bSelected) return -1;
                    if (!aSelected && bSelected) return 1;
                    return 0;
                });

                if (filtered.length === 0 && q !== "") {
                    if (addBtn) addBtn.style.display = 'block';

                    const noResultDiv = document.createElement("div");
                    noResultDiv.className = "text-muted p-2";
                    noResultDiv.textContent = "No result found – Add new";
                    list.appendChild(noResultDiv);
                } else {
                    if (addBtn) addBtn.style.display = 'none';

                    filtered.forEach(ins => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'form-check instruction-item d-flex justify-content-between align-items-center mb-2 border-bottom pb-1';

                        wrapper.addEventListener("mouseenter", () => {
                            wrapper.style.backgroundColor = "#8db8afff";
                        });
                        wrapper.addEventListener("mouseleave", () => {
                            wrapper.style.backgroundColor = "transparent";
                        });
                        // Left Side
                        const leftDiv = document.createElement('div');
                        leftDiv.className = 'd-flex align-items-center flex-grow-1';

                        const checkbox = document.createElement('input');
                        checkbox.className = 'form-check-input mt-0';
                        checkbox.type = 'checkbox';
                        checkbox.name = 'instructions[]';
                        checkbox.value = ins.instructionsName;
                        checkbox.id = `ins${ins.id}`;

                        if (selectedInstructionSet.has(normIns(ins.instructionsName))) {
                            checkbox.checked = true;
                        }

                        checkbox.addEventListener('change', (e) => {
                            if (e.target.checked) {
                                selectedInstructionSet.add(normIns(ins.instructionsName));
                            } else {
                                selectedInstructionSet.delete(normIns(ins.instructionsName));
                            }
                        });

                        const label = document.createElement('label');
                        label.className = 'form-check-label ms-2';
                        label.htmlFor = `ins${ins.id}`;
                        label.textContent = ins.instructionsName;
                        label.style.cursor = 'pointer';
                        label.style.width = '100%';

                        leftDiv.appendChild(checkbox);
                        leftDiv.appendChild(label);
                        wrapper.appendChild(leftDiv);

                        if (ins.is_mine == true || ins.is_mine == "true") {
                            const actionDiv = document.createElement("div");
                            actionDiv.className = "d-flex align-items-center gap-2";

                            const editIcon = document.createElement("i");
                            editIcon.className = "bi bi-pen action-icon edit";
                            editIcon.title = "Edit";
                            editIcon.onclick = (e) => {
                                e.preventDefault();
                                openUniversalEdit('instruction', ins.id, ins.instructionsName);
                            };

                            const deleteIcon = document.createElement("i");
                            deleteIcon.className = "bi bi-trash action-icon delete";
                            deleteIcon.title = "Delete";
                            deleteIcon.onclick = (e) => {
                                e.preventDefault();
                                openUniversalDelete('instruction', ins.id, ins.instructionsName);
                            };

                            actionDiv.appendChild(editIcon);
                            actionDiv.appendChild(deleteIcon);
                            wrapper.appendChild(actionDiv);
                        }

                        list.appendChild(wrapper);
                    });
                }
            }

            list.addEventListener('change', (e) => {
                if (e.target.matches('input[type="checkbox"]')) {
                    sortList();
                }
            });


            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    uTitle.textContent = "Add New Instruction";
                    uLabel.innerHTML = 'Instruction Name <span class="text-danger">*</span>';
                    uInput.value = searchInput.value.trim();
                    uId.value = "";
                    uType.value = "instruction";
                    uAddModal.show();
                    setTimeout(() => uInput.focus(), 500);
                });
            }

            function openUniversalEdit(type, id, name) {
                uTitle.textContent = "Edit Instruction";
                uLabel.innerHTML = 'Instruction Name <span class="text-danger">*</span>';
                uInput.value = name;
                uId.value = id;
                uType.value = "instruction";
                uAddModal.show();
                setTimeout(() => uInput.focus(), 500);
            }

            function openUniversalDelete(type, id, name) {
                uDelName.textContent = name;
                uDelId.value = id;
                uDelType.value = "instruction";
                uDelModal.show();
            }

            if (uAddForm) {
                uAddForm.addEventListener('submit', (e) => {
                    if (uType.value !== 'instruction') return;
                    e.preventDefault();

                    const name = uInput.value.trim();
                    const id = uId.value;
                    if (!name) return;

                    const submitBtn = uAddForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id ? "<?= site_url('Consultation/editInstructionItem') ?>" : "<?= site_url('Consultation/addInstruction') ?>";
                    const body = id ? `id=${id}&name=${encodeURIComponent(name)}` : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = instructionsList.findIndex(i => i.id == id);
                                    if (index !== -1) {
                                        const oldName = instructionsList[index].instructionsName;
                                        instructionsList[index].instructionsName = name;

                                        if (selectedInstructionSet.has(normIns(oldName))) {
                                            selectedInstructionSet.delete(normIns(oldName));
                                            selectedInstructionSet.add(normIns(name));
                                        }
                                    }
                                } else {
                                    instructionsList.push({
                                        id: data.id,
                                        instructionsName: name,
                                        is_mine: true
                                    });
                                    selectedInstructionSet.add(normIns(name));
                                }
                                uAddModal.hide();
                                searchInput.value = "";
                                renderList();
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            if (uDelBtn) {
                uDelBtn.addEventListener('click', () => {
                    if (uDelType.value !== 'instruction') return;

                    const id = uDelId.value;
                    fetch("<?= site_url('Consultation/deleteInstructionItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const item = instructionsList.find(i => i.id == id);
                                if (item) selectedInstructionSet.delete(normIns(item.instructionsName));

                                instructionsList = instructionsList.filter(i => i.id != id);
                                uDelModal.hide();
                                renderList();
                            }
                        });
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', renderList);

                searchInput.addEventListener('keydown', (e) => {
                    if (e.key === "Enter" && searchInput.value.trim() !== "") {
                        e.preventDefault();
                        const q = normIns(searchInput.value);
                        const exists = instructionsList.some(i => normIns(i.instructionsName) === q);

                        if (!exists) {
                            if (addBtn) addBtn.click();
                        }
                    }
                });
            }

            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    renderList();
                    searchInput.focus();
                });
            }

            renderList();
        });
    </script>

    <!-- New Procedure Search Button -->
    <script>
        let proceduresList = <?php echo (isset($proceduresList) && !empty($proceduresList)) ? json_encode($proceduresList) : '[]'; ?>;

        let savedProcedures = <?php echo (isset($procedures) && !empty($procedures)) ? json_encode($procedures) : '[]'; ?>;

        let selectedSet = new Set();
        const norm = s => (s || '').toLowerCase().trim();

        if (Array.isArray(savedProcedures)) {
            savedProcedures.forEach(p => {
                let name = p.procedure_name || p;
                selectedSet.add(norm(name));
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('procedureSearch');
            const clearBtn = document.getElementById('clearProcedureSearch');
            const addBtn = document.getElementById('addProcedure') || document.getElementById('addProcedureBtn');
            const list = document.getElementById('procedureList');

            const uAddModalEl = document.getElementById("universalAddMasterModal");
            const uAddModal = new bootstrap.Modal(uAddModalEl);
            const uAddForm = document.getElementById("universalAddMasterForm");
            const uTitle = document.getElementById("universalMasterTitle");
            const uLabel = document.getElementById("universalMasterLabel");
            const uInput = document.getElementById("universalMasterInput");
            const uId = document.getElementById("universalMasterId");
            const uType = document.getElementById("universalMasterType");

            const uDelModalEl = document.getElementById("universalDeleteModal");
            const uDelModal = new bootstrap.Modal(uDelModalEl);
            const uDelName = document.getElementById("universalDeleteNameDisplay");
            const uDelId = document.getElementById("universalDeleteId");
            const uDelType = document.getElementById("universalDeleteType");
            const uDelBtn = document.getElementById("universalDeleteBtn");

            uAddModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    uAddModal.hide();
                    if (uAddForm) uAddForm.reset();
                });
            });

            uDelModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    uDelModal.hide();
                });
            });

            function sortList() {
                const items = Array.from(list.querySelectorAll('.procedure-item'));
                const selected = items.filter(i => i.querySelector('input').checked);
                const unselected = items.filter(i => !i.querySelector('input').checked);

                items.forEach(i => i.remove());
                selected.forEach(i => list.appendChild(i));
                unselected.forEach(i => list.appendChild(i));
            }

            function renderList() {
                const q = norm(searchInput.value);
                list.innerHTML = '';

                if (q.length > 0) {
                    clearBtn.style.display = 'block';
                } else {
                    clearBtn.style.display = 'none';
                    if (addBtn) addBtn.style.display = 'none';
                }

                let filtered = proceduresList.filter(p => norm(p.proceduresName).includes(q));

                filtered.sort((a, b) => {
                    const aSelected = selectedSet.has(norm(a.proceduresName));
                    const bSelected = selectedSet.has(norm(b.proceduresName));

                    if (aSelected && !bSelected) return -1;
                    if (!aSelected && bSelected) return 1;
                    return 0;
                });

                if (filtered.length === 0 && q !== "") {
                    if (addBtn) addBtn.style.display = 'block';

                    const noResultDiv = document.createElement("div");
                    noResultDiv.className = "text-muted p-2";
                    noResultDiv.textContent = "No result found – Add new";
                    list.appendChild(noResultDiv);
                } else {
                    if (addBtn) addBtn.style.display = 'none';

                    filtered.forEach(pro => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'form-check procedure-item d-flex justify-content-between align-items-center mb-2 border-bottom pb-1';

                        wrapper.addEventListener("mouseenter", () => {
                            wrapper.style.backgroundColor = "#8db8afff";
                        });
                        wrapper.addEventListener("mouseleave", () => {
                            wrapper.style.backgroundColor = "transparent";
                        });

                        const leftDiv = document.createElement('div');
                        leftDiv.className = 'd-flex align-items-center flex-grow-1';

                        const checkbox = document.createElement('input');
                        checkbox.className = 'form-check-input mt-0';
                        checkbox.type = 'checkbox';
                        checkbox.name = 'procedures[]';
                        checkbox.value = pro.proceduresName;
                        checkbox.id = `pro${pro.id}`;

                        if (selectedSet.has(norm(pro.proceduresName))) {
                            checkbox.checked = true;
                        }

                        checkbox.addEventListener('change', (e) => {
                            if (e.target.checked) {
                                selectedSet.add(norm(pro.proceduresName));
                            } else {
                                selectedSet.delete(norm(pro.proceduresName));
                            }
                        });

                        const label = document.createElement('label');
                        label.className = 'form-check-label ms-2';
                        label.htmlFor = `pro${pro.id}`;
                        label.textContent = pro.proceduresName;
                        label.style.cursor = 'pointer';
                        label.style.width = '100%';

                        leftDiv.appendChild(checkbox);
                        leftDiv.appendChild(label);
                        wrapper.appendChild(leftDiv);

                        if (pro.is_mine == true || pro.is_mine == "true") {
                            const actionDiv = document.createElement("div");
                            actionDiv.className = "d-flex align-items-center gap-2";

                            const editIcon = document.createElement("i");
                            editIcon.className = "bi bi-pen action-icon edit";
                            editIcon.title = "Edit";
                            editIcon.onclick = (e) => {
                                e.preventDefault();
                                openUniversalEdit('procedure', pro.id, pro.proceduresName);
                            };

                            const deleteIcon = document.createElement("i");
                            deleteIcon.className = "bi bi-trash action-icon delete";
                            deleteIcon.title = "Delete";
                            deleteIcon.onclick = (e) => {
                                e.preventDefault();
                                openUniversalDelete('procedure', pro.id, pro.proceduresName);
                            };

                            actionDiv.appendChild(editIcon);
                            actionDiv.appendChild(deleteIcon);
                            wrapper.appendChild(actionDiv);
                        }

                        list.appendChild(wrapper);
                    });
                }
            }

            list.addEventListener('change', (e) => {
                if (e.target.matches('input[type="checkbox"]')) {
                    sortList();
                }
            });


            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    uTitle.textContent = "Add New Procedure";
                    uLabel.innerHTML = 'Procedure Name <span class="text-danger">*</span>';
                    uInput.value = searchInput.value.trim();
                    uId.value = "";
                    uType.value = "procedure"; // FLAG
                    uAddModal.show();
                    setTimeout(() => uInput.focus(), 500);
                });
            }

            function openUniversalEdit(type, id, name) {
                uTitle.textContent = "Edit Procedure";
                uLabel.innerHTML = 'Procedure Name <span class="text-danger">*</span>';
                uInput.value = name;
                uId.value = id;
                uType.value = "procedure";
                uAddModal.show();
                setTimeout(() => uInput.focus(), 500);
            }

            function openUniversalDelete(type, id, name) {
                uDelName.textContent = name;
                uDelId.value = id;
                uDelType.value = "procedure";
                uDelModal.show();
            }

            if (uAddForm) {
                uAddForm.addEventListener('submit', (e) => {
                    if (uType.value !== 'procedure') return;
                    e.preventDefault();

                    const name = uInput.value.trim();
                    const id = uId.value;
                    if (!name) return;

                    const submitBtn = uAddForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id ? "<?= site_url('Consultation/editProcedureItem') ?>" : "<?= site_url('Consultation/addProcedure') ?>";
                    const body = id ? `id=${id}&name=${encodeURIComponent(name)}` : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = proceduresList.findIndex(p => p.id == id);
                                    if (index !== -1) {
                                        const oldName = proceduresList[index].proceduresName;
                                        proceduresList[index].proceduresName = name;

                                        if (selectedSet.has(norm(oldName))) {
                                            selectedSet.delete(norm(oldName));
                                            selectedSet.add(norm(name));
                                        }
                                    }
                                } else {
                                    proceduresList.push({
                                        id: data.id,
                                        proceduresName: name,
                                        is_mine: true
                                    });
                                    selectedSet.add(norm(name));
                                }
                                uAddModal.hide();
                                searchInput.value = "";
                                renderList();
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            if (uDelBtn) {
                uDelBtn.addEventListener('click', () => {
                    if (uDelType.value !== 'procedure') return;

                    const id = uDelId.value;
                    fetch("<?= site_url('Consultation/deleteProcedureItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const item = proceduresList.find(p => p.id == id);
                                if (item) selectedSet.delete(norm(item.proceduresName));

                                proceduresList = proceduresList.filter(p => p.id != id);
                                uDelModal.hide();
                                renderList();
                            }
                        });
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', renderList);

                searchInput.addEventListener('keydown', (e) => {
                    if (e.key === "Enter" && searchInput.value.trim() !== "") {
                        e.preventDefault();
                        const q = norm(searchInput.value);
                        const exists = proceduresList.some(p => norm(p.proceduresName) === q);

                        if (!exists) {
                            if (addBtn) addBtn.click();
                        }
                    }
                });
            }

            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    renderList();
                    searchInput.focus();
                });
            }

            renderList();
        });
    </script>

    <!-- New Advice search and add script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let adviceDataList = <?php echo (isset($advicesList) && !empty($advicesList)) ? json_encode($advicesList) : '[]'; ?>;
            const adviceInput = document.getElementById('adviceSearchInput');
            const adviceSuggestionsBox = document.getElementById('adviceSuggestionsBox');
            const adviceListContainer = document.getElementById('adviceList');
            const addAdviceBtn = document.getElementById('addAdviceBtn');
            const clearAdviceBtn = document.getElementById('clearAdviceSearch');
            const adviceHiddenInput = document.getElementById('advicesJson');

            const adviceModalEl = document.getElementById("adviceModal");
            if (!adviceInput || !adviceModalEl) return;

            const adviceModal = new bootstrap.Modal(adviceModalEl);
            const adviceNote = document.getElementById("adviceNote");
            const adviceModalTitle = document.getElementById("adviceModalTitle");

            // Universal Modal Elements
            const uAddModalEl = document.getElementById("universalAddMasterModal");
            const uAddModal = new bootstrap.Modal(uAddModalEl);
            const uAddForm = document.getElementById("universalAddMasterForm");
            const uTitle = document.getElementById("universalMasterTitle");
            const uLabel = document.getElementById("universalMasterLabel");
            const uInput = document.getElementById("universalMasterInput");
            const uId = document.getElementById("universalMasterId");
            const uType = document.getElementById("universalMasterType");

            const uDelModalEl = document.getElementById("universalDeleteModal");
            const uDelModal = new bootstrap.Modal(uDelModalEl);
            const uDelName = document.getElementById("universalDeleteNameDisplay");
            const uDelId = document.getElementById("universalDeleteId");
            const uDelType = document.getElementById("universalDeleteType");
            const uDelBtn = document.getElementById("universalDeleteBtn");

            // State Variables
            let selectedAdvices = [];
            let pendingAdvice = "";
            let editingAdviceTag = null;

            function renderAdviceSuggestions() {
                const q = adviceInput.value.trim().toLowerCase();
                adviceSuggestionsBox.innerHTML = "";

                if (q.length > 0) {
                    if (clearAdviceBtn) clearAdviceBtn.style.display = 'block';
                } else {
                    if (clearAdviceBtn) clearAdviceBtn.style.display = 'none';
                    if (addAdviceBtn) addAdviceBtn.style.display = 'none';
                }

                const filtered = adviceDataList.filter(a => a.adviceName.toLowerCase().includes(q));

                // No Result Found
                if (filtered.length === 0 && q !== "") {
                    if (addAdviceBtn) addAdviceBtn.style.display = 'block';
                    adviceSuggestionsBox.style.display = 'block';
                    const noResultDiv = document.createElement("div");
                    noResultDiv.className = "text-muted p-2";
                    noResultDiv.textContent = "No result found – Add new";
                    adviceSuggestionsBox.appendChild(noResultDiv);
                } else {
                    if (addAdviceBtn) addAdviceBtn.style.display = 'none';

                    if (q !== "") {
                        adviceSuggestionsBox.style.display = "block";
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom p-1 pointer-hover";
                            div.style.cursor = "pointer";

                            div.addEventListener("mouseenter", () => div.style.backgroundColor = "#8db8afff");
                            div.addEventListener("mouseleave", () => div.style.backgroundColor = "transparent");

                            const spanName = document.createElement("span");
                            spanName.textContent = item.adviceName;
                            spanName.className = "flex-grow-1";
                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                openAdviceModal(item.adviceName);
                                clearAdviceSearchFunc();
                            };
                            div.appendChild(spanName);

                            // Edit/Delete Icons (Owned Items Only)
                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center gap-2";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.title = "Edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openAdviceEdit(item.id, item.adviceName);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.title = "Delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openAdviceDelete(item.id, item.adviceName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }
                            adviceSuggestionsBox.appendChild(div);
                        });
                    } else {
                        adviceSuggestionsBox.style.display = "none";
                    }
                }
            }

            function clearAdviceSearchFunc() {
                adviceInput.value = "";
                adviceInput.focus();
                adviceSuggestionsBox.style.display = "none";
                if (clearAdviceBtn) clearAdviceBtn.style.display = "none";
                if (addAdviceBtn) addAdviceBtn.style.display = "none";
            }

            // 4. NOTE MODAL LOGIC
            window.openAdviceModal = function (tagName, existing = null, tagEl = null) {
                pendingAdvice = tagName;
                editingAdviceTag = tagEl;
                if (adviceModalTitle) adviceModalTitle.textContent = existing ? `Edit: ${tagName}` : `Detail for: ${tagName}`;
                if (adviceNote) adviceNote.value = existing?.note || "";
                adviceModal.show();
                setTimeout(() => { if (adviceNote) adviceNote.focus(); }, 500);
            }

            window.saveAdviceModal = function () {
                const note = adviceNote ? adviceNote.value.trim() : "";
                if (!pendingAdvice) return;

                const existingIndex = selectedAdvices.findIndex(s => s.advice === pendingAdvice);
                if (editingAdviceTag && existingIndex !== -1) {
                    // Update
                    let existingId = selectedAdvices[existingIndex].id || "new";
                    selectedAdvices[existingIndex] = { id: existingId, advice: pendingAdvice, note };
                    updateAdviceTagDisplay(editingAdviceTag, selectedAdvices[existingIndex]);
                    editingAdviceTag.setAttribute("data-id", existingId);
                } else {
                    // Add
                    const data = { id: "new", advice: pendingAdvice, note };
                    selectedAdvices.push(data);
                    addAdviceTag(data);
                }
                adviceModal.hide();
                pendingAdvice = "";
                editingAdviceTag = null;
                updateAdviceHiddenInput();
            }

            function addAdviceTag(data) {
                const tag = document.createElement("span");

                tag.className = "bg-success text-light rounded-2 p-2 me-2 mb-2 d-inline-block";

                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", data.id || "new");

                const textSpan = document.createElement("span");
                tag.appendChild(textSpan);

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";

                removeBtn.className = "text-light ms-2";

                removeBtn.innerHTML = "&times;";
                removeBtn.style.fontSize = "1rem";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tag.remove();
                    selectedAdvices = selectedAdvices.filter(s => s.advice !== data.advice);
                    updateAdviceHiddenInput();
                };

                tag.appendChild(removeBtn);
                updateAdviceTagDisplay(tag, data);
                tag.onclick = () => openAdviceModal(data.advice, data, tag);

                if (adviceListContainer) adviceListContainer.appendChild(tag);
            }

            function updateAdviceTagDisplay(tagEl, data) {
                const textParts = [data.advice];
                const details = [];
                if (data.note) details.push(`Note: ${data.note}`);
                if (details.length > 0) textParts.push(`(${details.join(", ")})`);
                tagEl.firstChild.textContent = textParts.join(" ");
            }

            function updateAdviceHiddenInput() {
                if (adviceHiddenInput) adviceHiddenInput.value = JSON.stringify(selectedAdvices);
            }

            // Open Add Modal
            if (addAdviceBtn) {
                addAdviceBtn.addEventListener('click', () => {
                    uTitle.textContent = "Add New Advice";
                    uLabel.innerHTML = 'Advice Name <span class="text-danger">*</span>';
                    uInput.value = adviceInput.value.trim();
                    uId.value = "";
                    uType.value = "advice";
                    uAddModal.show();
                    setTimeout(() => uInput.focus(), 500);
                });
            }

            // Open Edit Modal
            function openAdviceEdit(id, name) {
                uTitle.textContent = "Edit Advice";
                uLabel.innerHTML = 'Advice Name <span class="text-danger">*</span>';
                uInput.value = name;
                uId.value = id;
                uType.value = "advice";
                uAddModal.show();
                setTimeout(() => uInput.focus(), 500);
            }

            // Open Delete Modal
            function openAdviceDelete(id, name) {
                uDelName.textContent = name;
                uDelId.value = id;
                uDelType.value = "advice";
                uDelModal.show();
            }

            // Handle Form Submit (Add/Edit)
            if (uAddForm) {
                uAddForm.addEventListener('submit', (e) => {
                    if (document.getElementById("universalMasterType").value !== 'advice') return;

                    e.preventDefault();

                    const name = uInput.value.trim();
                    const id = uId.value;

                    if (!name) return;

                    const submitBtn = uAddForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.textContent;
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Saving...';

                    const url = id
                        ? "<?= site_url('Consultation/editAdviceItem') ?>"
                        : "<?= site_url('Consultation/addAdviceMaster') ?>";

                    const body = id
                        ? `id=${id}&name=${encodeURIComponent(name)}`
                        : `name=${encodeURIComponent(name)}`;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: body
                    })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;

                            if (data.status === 'success') {
                                if (id) {
                                    const index = adviceDataList.findIndex(a => a.id == id);
                                    if (index !== -1) adviceDataList[index].adviceName = name;
                                    uAddModal.hide();
                                    clearAdviceSearchFunc();
                                    renderAdviceSuggestions();
                                } else {
                                    adviceDataList.push({
                                        id: data.id,
                                        adviceName: name,
                                        is_mine: true
                                    });
                                    uAddModal.hide();
                                    clearAdviceSearchFunc();
                                    setTimeout(() => openAdviceModal(name), 300);
                                }
                            } else {
                                alert("Operation failed");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalBtnText;
                            alert("An error occurred. Please try again.");
                        });
                });
            }

            // Handle Delete Confirm
            if (uDelBtn) {
                uDelBtn.addEventListener('click', () => {
                    if (document.getElementById("universalDeleteType").value !== 'advice') return;

                    const id = uDelId.value;

                    fetch("<?= site_url('Consultation/deleteAdviceItem') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${id}`
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                adviceDataList = adviceDataList.filter(a => a.id != id);
                                uDelModal.hide();
                                renderAdviceSuggestions();
                            } else {
                                alert("Delete failed.");
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert("An error occurred.");
                        });
                });
            }

            // 7. EVENT LISTENERS
            adviceInput.addEventListener('input', renderAdviceSuggestions);
            adviceInput.addEventListener('focus', renderAdviceSuggestions);
            adviceInput.addEventListener('keydown', (e) => {
                if (e.key === "Enter" && adviceInput.value.trim() !== "") {
                    e.preventDefault();
                    const val = adviceInput.value.trim();
                    const exists = adviceDataList.some(a => a.adviceName.toLowerCase() === val.toLowerCase());

                    if (exists) {
                        openAdviceModal(val);
                        clearAdviceSearchFunc();
                    } else {
                        if (addAdviceBtn) addAdviceBtn.click();
                    }
                }
            });

            if (clearAdviceBtn) {
                clearAdviceBtn.addEventListener('click', clearAdviceSearchFunc);
            }

            if (adviceModalEl) {
                adviceModalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveAdviceModal();
                    }
                });
            }
            document.addEventListener("click", (e) => {
                const adviceContainer = document.getElementById("adviceInputContainer");
                if (adviceContainer && !adviceContainer.contains(e.target) &&
                    addAdviceBtn && !addAdviceBtn.contains(e.target)) {
                    if (adviceSuggestionsBox) adviceSuggestionsBox.style.display = "none";
                }
            });

            // 8. PRELOAD DATA (For Edit/Follow-up)
            const preloadAdvices = <?php echo (isset($advices) && !empty($advices)) ? json_encode($advices) : '[]'; ?>;
            if (preloadAdvices.length > 0) {
                preloadAdvices.forEach(item => {
                    const name = item.advice_name || item.advice || "";
                    if (name) {
                        const data = {
                            id: item.id || "",
                            advice: name,
                            note: item.note || ""
                        };
                        selectedAdvices.push(data);
                        addAdviceTag(data);
                    }
                });
                updateAdviceHiddenInput();
            }
        });
    </script>

    <!-- New Medicine Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let medicinesData = <?php echo json_encode($medicinesList); ?> || [];
            const savedMedicines = <?php echo isset($medicines) ? json_encode($medicines) : '[]'; ?> || [];

            const medicinesInput = document.getElementById("medicinesSearchInput");
            const medicinesSuggestionsBox = document.getElementById("medicinesSuggestionsBox");
            const medicinesTagContainer = document.getElementById("medicinesInput");
            const medicinesListContainer = document.getElementById("medicinesList");

            const addBtn = document.getElementById("medicinesAddBtn");
            const clearBtn = document.getElementById("clearMedicineSearch");

            const medicinesModalEl = document.getElementById("medicinesModal");
            const medicinesModal = new bootstrap.Modal(medicinesModalEl);
            const medicinesModalTitle = document.getElementById("medicinesModalTitle");
            const medicineCompositionText = document.getElementById("medicineCompositionText");
            const medicineCategoryText = document.getElementById("medicineCategoryText");
            const medicineQuantity = document.getElementById("medicineQuantity");
            const medicineNotes = document.getElementById("medicineNotes");

            const addMedMasterModalEl = document.getElementById("addMedicineModal");
            const addMedMasterModal = new bootstrap.Modal(addMedMasterModalEl);
            const addMedMasterForm = document.getElementById("addMedicineMasterForm");
            const medMasterTitle = document.getElementById("addMedicineModalTitle");
            const newMedName = document.getElementById("newMedicineName");
            const newMedComp = document.getElementById("newMedicineComposition");
            const newMedCat = document.getElementById("newMedicineCategory");
            const editMedId = document.getElementById("editMedicineMasterId");
            const addMedicineConfirmBtn = document.getElementById("addMedicineConfirmBtn");

            const delMedModalEl = document.getElementById("deleteMedicineMasterModal");
            const delMedModal = new bootstrap.Modal(delMedModalEl);
            const delMedName = document.getElementById("delMedNameDisplay");
            const delMedId = document.getElementById("delMedId");
            const finalDeleteMedBtn = document.getElementById("finalDeleteMedBtn");

            const slots = ["morning", "afternoon", "evening", "night"];
            let selectedMedicines = [];
            let pendingMedicineName = "";
            let editingMedicineTag = null;
            let pendingMedicineId = null;
            let pendingMedicineMasterId = null;


            addMedMasterModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => { e.preventDefault(); addMedMasterModal.hide(); });
            });
            delMedModalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', (e) => { e.preventDefault(); delMedModal.hide(); });
            });

            function renderMedicinesSuggestions() {
                if (!medicinesInput) return;
                const query = medicinesInput.value.trim().toLowerCase();
                medicinesSuggestionsBox.innerHTML = "";
                if (addBtn) addBtn.style.display = 'block';

                if (query.length > 0) {
                    if (clearBtn) clearBtn.style.display = 'block';
                } else {
                    if (clearBtn) clearBtn.style.display = 'none';
                    //if (addBtn) addBtn.style.display = 'none';
                }

                const filtered = medicinesData.filter(m => m.medicineName.toLowerCase().includes(query));

                if (filtered.length === 0 && query !== "") {
                    //if (addBtn) addBtn.style.display = 'block';
                    if (medicinesSuggestionsBox) {
                        medicinesSuggestionsBox.style.display = 'block';
                        const div = document.createElement("div");
                        div.className = "p-2 text-muted";
                        div.style.cursor = "pointer";
                        div.innerHTML = `No match found - <span class="text-primary">Add new</span>`;
                        div.onclick = () => {
                            openAddMedicineMaster(medicinesInput.value);
                            clearSearch();
                        };
                        medicinesSuggestionsBox.appendChild(div);
                    }
                } else {
                    //if (addBtn) addBtn.style.display = 'none';

                    if (medicinesSuggestionsBox && query !== "") {
                        filtered.forEach(item => {
                            const div = document.createElement("div");
                            div.className = "d-flex justify-content-between align-items-center border-bottom";
                            div.style.cursor = "pointer";
                            div.style.padding = "1px 6px";

                            div.addEventListener("mouseenter", () => { div.style.backgroundColor = "#8db8afff"; });
                            div.addEventListener("mouseleave", () => { div.style.backgroundColor = "transparent"; });

                            const spanName = document.createElement("span");
                            spanName.className = "flex-grow-1";

                            const categoryHtml = item.category ? `<small class="text-muted me-2" style="font-size:0.75em;">${item.category}</small>` : '';
                            spanName.innerHTML = `${categoryHtml}<strong>${item.medicineName}</strong>`;

                            spanName.onclick = (e) => {
                                e.stopPropagation();
                                pendingMedicineMasterId = item.id;
                                openMedicineModal(item.medicineName);
                                clearSearch();
                            };
                            div.appendChild(spanName);

                            if (item.is_mine == true || item.is_mine == "true") {
                                const actionDiv = document.createElement("div");
                                actionDiv.className = "d-flex align-items-center gap-2";

                                const editIcon = document.createElement("i");
                                editIcon.className = "bi bi-pen action-icon edit";
                                editIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openEditMedicineMaster(item);
                                };

                                const deleteIcon = document.createElement("i");
                                deleteIcon.className = "bi bi-trash action-icon delete";
                                deleteIcon.onclick = (e) => {
                                    e.stopPropagation();
                                    openDeleteMedicine(item.id, item.medicineName);
                                };

                                actionDiv.appendChild(editIcon);
                                actionDiv.appendChild(deleteIcon);
                                div.appendChild(actionDiv);
                            }

                            div.onclick = () => {
                                pendingMedicineMasterId = item.id; //  master id
                                pendingMedicineId = null;
                                openMedicineModal(item.medicineName);
                                clearSearch();
                            };
                            medicinesSuggestionsBox.appendChild(div);
                        });
                        medicinesSuggestionsBox.style.display = "block";
                    } else {
                        medicinesSuggestionsBox.style.display = "none";
                    }
                }
            }

            function clearSearch() {
                medicinesInput.value = "";
                medicinesSuggestionsBox.style.display = "none";
                if (clearBtn) clearBtn.style.display = "none";
                if (addBtn) addBtn.style.display = "none";
                medicinesInput.focus();
            }

            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    openAddMedicineMaster(medicinesInput.value);
                });
            }

            function openAddMedicineMaster(prefillName) {
                medMasterTitle.textContent = "Add New Medicine";
                newMedName.value = prefillName || "";
                newMedComp.value = "";
                newMedCat.value = "";
                editMedId.value = "";
                addMedMasterModal.show();
                setTimeout(() => newMedName.focus(), 200);
            }

            function openEditMedicineMaster(item) {
                if (!addMedMasterModal) return;

                medMasterTitle.textContent = "Edit Medicine";
                newMedName.value = item.medicineName;

                newMedComp.value = (item.compositionName === "Nil" || !item.compositionName) ? "" : item.compositionName;

                if (item.category === "Nil" || !item.category) {
                    newMedCat.value = "";
                } else {
                    newMedCat.value = item.category;
                }

                editMedId.value = item.id;
                addMedMasterModal.show();
                setTimeout(() => newMedName.focus(), 200);
            }

            addMedicineConfirmBtn.addEventListener('click', async (e) => {
                e.preventDefault();

                const name = newMedName.value.trim();
                const comp = newMedComp.value.trim();
                const cat = newMedCat.value;
                const id = editMedId.value;

                if (!name) {
                    alert('Please enter Medicine Name.');
                    return;
                }

                const url = id ? "<?= site_url('Consultation/editMedicineItem') ?>" : "<?= site_url('Consultation/addNewMedicines') ?>";

                const payload = {
                    medicineName: name,
                    compositionName: comp,
                    category: cat
                };
                if (id) payload.id = id;

                try {
                    addMedicineConfirmBtn.disabled = true;
                    addMedicineConfirmBtn.textContent = 'Saving...';

                    const res = await fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json();

                    if (data.status === 'success' || data.status === true) {
                        const finalComp = comp || "Nil";
                        const finalCat = cat || "Nil";

                        if (id) {
                            const index = medicinesData.findIndex(m => m.id == id);
                            if (index !== -1) {
                                medicinesData[index].medicineName = name;
                                medicinesData[index].compositionName = finalComp;
                                medicinesData[index].category = finalCat;
                            }
                            addMedMasterModal.hide();
                            clearSearch();
                        } else {
                            const newObj = {
                                id: data.id || data.data.id,
                                medicineName: name,
                                compositionName: finalComp,
                                category: finalCat,
                                is_mine: true
                            };
                            medicinesData.push(newObj);
                            addMedMasterModal.hide();
                            clearSearch();
                            pendingMedicineMasterId = newObj.id;
                            setTimeout(() => openMedicineModal(newObj), 300);  // Pass object instead of name
                        }
                    } else {
                        alert(data.message || "Failed to save.");
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    addMedicineConfirmBtn.disabled = false;
                    addMedicineConfirmBtn.textContent = 'Save';
                }
            });

            function openDeleteMedicine(id, name) {
                delMedName.textContent = name;
                delMedId.value = id;
                delMedModal.show();
            }

            finalDeleteMedBtn.addEventListener('click', () => {
                const id = delMedId.value;
                fetch("<?= site_url('Consultation/deleteMedicineItem') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}`
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const idx = medicinesData.findIndex(m => m.id == id);
                            if (idx !== -1) medicinesData.splice(idx, 1);
                            delMedModal.hide();
                            renderMedicinesSuggestions();
                        } else {
                            alert("Failed to delete.");
                        }
                    });
            });

            if (medicinesInput) {
                medicinesInput.addEventListener("input", renderMedicinesSuggestions);
                medicinesInput.addEventListener("focus", renderMedicinesSuggestions);
                medicinesInput.addEventListener("keydown", (e) => {
                    if (e.key === "Enter" && medicinesInput.value.trim() !== "") {
                        e.preventDefault();
                        const q = medicinesInput.value.trim().toLowerCase();
                        const founds = medicinesData.filter(m => m.medicineName.toLowerCase() === q);
                        if (founds.length === 1) {
                            const found = founds[0];
                            pendingMedicineMasterId = found.id;
                            openMedicineModal(found.medicineName);
                            clearSearch();
                        } else if (founds.length > 1) {
                            // Do nothing: Multiple matches,
                        } else {
                            openAddMedicineMaster(medicinesInput.value);
                        }
                    }
                });
            }

            if (medicinesModalEl) {
                medicinesModalEl.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') { e.preventDefault(); saveMedicineModal(); }
                });
            }
            if (clearBtn) clearBtn.addEventListener("click", clearSearch);

            document.addEventListener("click", (e) => {
                if (medicinesTagContainer && !medicinesTagContainer.contains(e.target) &&
                    addBtn && !addBtn.contains(e.target)) {
                    if (medicinesSuggestionsBox) medicinesSuggestionsBox.style.display = "none";
                }
            });

            function forEachSlot(cb) {
                slots.forEach(slot => {
                    const check = document.getElementById(`${slot}Check`);
                    const qty = document.getElementById(`${slot}Qty`);
                    const unit = document.getElementById(`${slot}Unit`);
                    if (check && qty && unit) cb(check, qty, unit);
                });
            }

            forEachSlot((check, qty, unit) => {
                check.addEventListener("change", () => {
                    if (check.checked) {
                        qty.disabled = false;
                        unit.disabled = false;
                        if (!qty.value) qty.value = 1;
                    } else {
                        qty.disabled = true;
                        unit.disabled = true;
                        qty.value = "";
                        unit.value = "";
                    }
                });
                qty.addEventListener("focus", () => {
                    if (!check.checked) qty.blur();
                });
            });

            function buildTimingString() {
                const parts = [];
                forEachSlot((check, qty, unit) => {
                    if (check && check.checked && qty && qty.value) {
                        const u = unit && unit.value ? unit.value : "";
                        const qtyVal = String(qty.value);
                        parts.push(u ? `${qtyVal} ${u}` : `${qtyVal}`);
                    } else {
                        parts.push("0");
                    }
                });
                return parts.join("-");
            }

            function applyTimingString(timingStr) {
                const parts = String(timingStr || "0-0-0-0").split("-");
                slots.forEach((slot, i) => {
                    const check = document.getElementById(`${slot}Check`);
                    const qty = document.getElementById(`${slot}Qty`);
                    const unit = document.getElementById(`${slot}Unit`);
                    if (!check) return;

                    const v = parts[i] ?? "0";
                    if (v !== "0") {
                        check.checked = true;
                        qty.disabled = false;
                        unit.disabled = false;
                        const matches = String(v).match(/^([\d.]+)\s*(.*)$/);
                        if (matches) {
                            qty.value = matches[1];
                            if (matches[2]) unit.value = matches[2];
                        } else {
                            qty.value = v;
                        }
                    } else {
                        check.checked = false;
                        qty.value = "";
                        unit.value = "";
                        qty.disabled = true;
                        unit.disabled = true;
                    }
                });
            }

            function toDbShape(row) {
                if (!row) return null;
                return {
                    id: row.id ?? row.medicine_id ?? "",
                    medicine_id: row.medicine_id ?? row.id ?? "",
                    consultation_id: row.consultation_id ?? "",
                    medicine_name: row.medicine_name ?? row.medicine ?? row.medicineBrand ?? "",
                    quantity: row.quantity ?? "",
                    unit: row.unit ?? "",
                    timing: row.timing ?? "0-0-0-0",
                    food_timing: row.food_timing ?? "",
                    notes: row.notes ?? "",
                    composition: row.compositionName ?? row.composition ?? "",
                    category: row.category ?? row.medicineCategory ?? ""
                };
            }

            function getCleanDisplay(value, field = 'category') {
                if (!value || value === 'Nil' || value === 'nil') return '';
                return value;
            }

            window.openMedicineModal = function (nameOrItem, existing = null, tagEl = null) {
                editingMedicineTag = tagEl;

                let item = null;
                if (typeof nameOrItem === 'object' && nameOrItem && nameOrItem.medicineName) {
                    item = nameOrItem;
                    pendingMedicineName = item.medicineName;
                    pendingMedicineMasterId = item.id;
                } else {
                    pendingMedicineName = nameOrItem;
                }

                if (existing && existing.id) {
                    pendingMedicineId = existing.id; // consultation row id
                    pendingMedicineMasterId = existing.medicine_id || pendingMedicineMasterId;
                } else {
                    pendingMedicineId = null;
                }

                let medData = null;
                if (existing) {
                    medData = existing;
                } else {
                    medData = item || medicinesData.find(m => m.id === pendingMedicineMasterId) || null;
                }

                medicinesModalTitle.textContent = existing ? `Edit: ${pendingMedicineName}` : `Details for: ${pendingMedicineName}`;

                medicineCompositionText.textContent = getCleanDisplay(medData?.compositionName || medData?.composition || '', 'composition');
                medicineCategoryText.textContent = getCleanDisplay(medData?.category || medData?.medicineCategory || '', 'category');

                medicineQuantity.value = "";
                medicineNotes.value = "";
                slots.forEach(slot => {
                    const check = document.getElementById(`${slot}Check`);
                    if (check) { check.checked = false; }
                });
                document.querySelectorAll('input[name="foodTiming"]').forEach(r => r.checked = false);

                const row = toDbShape(existing);
                if (row) {
                    medicineQuantity.value = row.quantity || "";
                    medicineNotes.value = row.notes || "";
                    applyTimingString(row.timing);
                    document.querySelectorAll('input[name="foodTiming"]').forEach(r => {
                        r.checked = (r.value === (row.food_timing || ""));
                    });
                } else {
                    applyTimingString("0-0-0-0");
                }

                medicinesModal.show();
                setTimeout(() => medicineQuantity.focus(), 500);
            };
            window.saveMedicineModal = function () {
                const quantity = (medicineQuantity.value || "").trim();
                const notes = (medicineNotes.value || "").trim();
                const timing = buildTimingString();
                const food_timing = document.querySelector('input[name="foodTiming"]:checked')?.value || "";

                if (!pendingMedicineName) return;
                let medData;
                if (pendingMedicineId) {
                    const existingMed = selectedMedicines.find(m => String(m.id) === String(pendingMedicineId));
                    if (existingMed) {
                        medData = {
                            compositionName: existingMed.composition || '',
                            category: existingMed.category || ''
                        };
                    } else {
                        medData = { compositionName: '', category: '' };
                    }
                } else {
                    medData = medicinesData.find(m => m.id === pendingMedicineMasterId) || { compositionName: '', category: '' };
                }
                const existingIndex = selectedMedicines.findIndex(
                    m => String(m.id) === String(pendingMedicineId)
                );

                //const medData = medicinesData.find(m => m.id === pendingMedicineMasterId) || { compositionName: '', category: '' };
                const composition = medData.compositionName || "";
                const category = medData.category || "";

                const data = {
                    id: pendingMedicineId || `temp_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`,
                    medicine_id: pendingMedicineMasterId,
                    medicine_name: pendingMedicineName,
                    quantity,
                    timing,
                    food_timing,
                    notes,
                    composition,
                    category
                };

                if (editingMedicineTag) {
                    if (existingIndex !== -1) {
                        if (selectedMedicines[existingIndex].consultation_id)
                            data.consultation_id = selectedMedicines[existingIndex].consultation_id;
                        selectedMedicines[existingIndex] = {
                            ...selectedMedicines[existingIndex],
                            ...data
                        };
                    }
                    updateMedicineTagDisplay(editingMedicineTag, data);
                    editingMedicineTag.setAttribute("data-id", data.id);
                } else {
                    selectedMedicines.push(data);
                    addMedicineTag(data);
                }
                updateMedicinesHiddenInput();
                medicinesModal.hide();
                pendingMedicineId = null;
                pendingMedicineMasterId = null;
                editingMedicineTag = null;
            };
            function addMedicineTag(row) {
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "move";
                tag.setAttribute("data-id", row.id);

                updateMedicineTagDisplay(tag, row);

                tag.onclick = () => {
                    const currentId = tag.getAttribute("data-id");
                    const currentMed = selectedMedicines.find(m => String(m.id) === String(currentId));
                    if (currentMed) {
                        openMedicineModal(currentMed.medicine_name, currentMed, tag);
                    } else {
                        console.warn("Medicine not found in selectedMedicines:", currentId);
                    }
                };

                if (medicinesListContainer) {
                    medicinesListContainer.appendChild(tag);
                } else {
                    medicinesTagContainer.appendChild(tag);
                }
            }

            function updateMedicineTagDisplay(tagEl, row) {
                const categoryDisplay = (row.category && row.category !== 'Nil')
                    ? `<span style="font-size: 0.85em; opacity: 0.9; margin-right: 5px;">${row.category}</span>`
                    : '';

                tagEl.innerHTML = `${categoryDisplay}<b>${row.medicine_name}</b> 
                        <button class="text-light ms-2" style="border:none;background:transparent;font-size:1rem;">&times;</button>`;

                tagEl.querySelector('button').onclick = (e) => {
                    e.stopPropagation();
                    tagEl.remove();
                    selectedMedicines = selectedMedicines.filter(
                        s => String(s.id) !== String(row.id)  // Uses ID, safe
                    );
                    updateMedicinesHiddenInput();
                };

                tagEl.onclick = (e) => {
                    if (e.target.tagName === 'BUTTON') return; // Avoid on close button
                    const currentId = tagEl.getAttribute("data-id");
                    const currentMed = selectedMedicines.find(m => String(m.id) === String(currentId));
                    if (currentMed) {
                        openMedicineModal(currentMed.medicine_name, currentMed, tagEl);
                    }
                };
            }

            function updateMedicinesHiddenInput() {
                let hidden = document.getElementById("medicinesJson");
                if (!hidden) {
                    hidden = document.createElement("input");
                    hidden.type = "hidden";
                    hidden.id = "medicinesJson";
                    hidden.name = "medicinesJson";
                    const form = medicinesModalEl.closest("form") || document.querySelector("form");
                    (form || document.body).appendChild(hidden);
                }

                const forBackend = selectedMedicines.map(m => {
                    const copy = { ...m };
                    if (String(copy.id).startsWith('temp_') || copy.id === 'new' || !copy.id) {
                        copy.id = 'new';
                    }
                    return copy;
                });

                hidden.value = JSON.stringify(forBackend);
            }

            if (Array.isArray(savedMedicines) && savedMedicines.length) {
                savedMedicines.forEach(m => {
                    const row = toDbShape(m);
                    selectedMedicines.push(row);
                    addMedicineTag(row);
                });
                updateMedicinesHiddenInput();
            }
            //for dragable
            if (medicinesListContainer) {
                Sortable.create(medicinesListContainer, {
                    animation: 150,
                    ghostClass: "sortable-ghost",
                    onEnd: function () {
                        syncSelectedMedicinesOrder();
                    }
                });
            }

            function syncSelectedMedicinesOrder() {
                const newOrder = [];

                document.querySelectorAll("#medicinesList [data-id]").forEach(tag => {
                    const id = tag.getAttribute("data-id");
                    const found = selectedMedicines.find(m => String(m.id) === String(id));
                    if (found) newOrder.push(found);
                });

                selectedMedicines = newOrder;
                updateMedicinesHiddenInput();
            }
        });
    </script>

    <!-- Upload attachments script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isEditPage = !!document.getElementById('fileList');
            const isDashboardPage = !isEditPage && !!document.querySelector('.openAttachment[data-context="dashboard"]');
            const isNewConsultation = !!document.getElementById('newConsultationPreviewModal');
            const isFollowup = !!document.getElementById('followupPreviewModal');

            console.log('Page context:', {
                isEditPage,
                isDashboardPage,
                isNewConsultation,
                isFollowup
            });

            // === Find Containers for Class-based Elements ===
            const newConsultationContainer = isNewConsultation ? document.querySelector('[data-page="new"]') : null;
            const followupContainer = isFollowup ? document.querySelector('[data-page="followup"]') : null;

            // === Remove conflicting modals (Unchanged Logic) ===
            if (isEditPage) {
                ['attachmentModal', 'newConsultationPreviewModal', 'followupPreviewModal', 'dashboardPreviewModal'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.remove();
                });
            }

            // === DOM Elements Initialization ===
            const editElements = {
                fileInput: document.getElementById("fileInput"),
                submitFileInput: document.getElementById("submitFileInput"),
                addBtn: document.getElementById("addFileBtn"),
                fileList: document.getElementById("fileList"),
                fileError: document.getElementById("fileError"),
                removedFilesInput: document.getElementById("removedFiles"),
                dropZone: document.getElementById("dropZone"),
                imageEditModal: document.getElementById('imageEditModal') ? new bootstrap.Modal(document.getElementById('imageEditModal'), {
                    backdrop: 'static',
                    keyboard: false
                }) : null,
                editPreviewModal: document.getElementById('editPreviewModal') ? new bootstrap.Modal(document.getElementById('editPreviewModal'), {
                    backdrop: 'static',
                    keyboard: true
                }) : null,
                previewContent: document.getElementById('filePreviewContent'),
                modalTitle: document.getElementById('editPreviewModalLabel'),
                prevBtn: document.getElementById('prevFile'),
                nextBtn: document.getElementById('nextFile')
            };

            const newConsultationElements = isNewConsultation && newConsultationContainer ? {
                previewModal: new bootstrap.Modal(document.getElementById('newConsultationPreviewModal'), {
                    backdrop: 'static',
                    keyboard: true
                }),
                image: document.getElementById('newConsultationImage'),
                pdf: document.getElementById('newConsultationPDF'),
                modalTitle: document.getElementById('newConsultationPreviewModalLabel'),
                prevBtn: document.getElementById('prevNewConsultation'),
                nextBtn: document.getElementById('nextNewConsultation'),
                fileInput: newConsultationContainer.querySelector(".fileInput"),
                submitFileInput: newConsultationContainer.querySelector(".submitFileInput"),
                addBtn: newConsultationContainer.querySelector(".addFileBtn"),
                fileList: newConsultationContainer.querySelector(".fileList"),
                fileError: newConsultationContainer.querySelector(".fileError"),
                dropZone: newConsultationContainer.querySelector(".dropZone"),
            } : {};

            const followupElements = isFollowup && followupContainer ? {
                previewModal: new bootstrap.Modal(document.getElementById('followupPreviewModal'), {
                    backdrop: 'static',
                    keyboard: true
                }),
                image: document.getElementById('followupImage'),
                pdf: document.getElementById('followupPDF'),
                modalTitle: document.getElementById('followupPreviewModalLabel'),
                prevBtn: document.getElementById('prevFollowup'),
                nextBtn: document.getElementById('nextFollowup'),
                fileInput: followupContainer.querySelector(".fileInput"),
                submitFileInput: followupContainer.querySelector(".submitFileInput"),
                addBtn: followupContainer.querySelector(".addFileBtn"),
                fileList: followupContainer.querySelector(".fileList"),
                fileError: followupContainer.querySelector(".fileError"),
                dropZone: followupContainer.querySelector(".dropZone"),
            } : {};

            const dashboardElements = isDashboardPage ? {
                previewModal: new bootstrap.Modal(document.getElementById('dashboardPreviewModal'), {
                    backdrop: 'static',
                    keyboard: true
                }),
                image: document.getElementById('attachmentImage'),
                pdf: document.getElementById('attachmentPDF'),
                modalTitle: document.getElementById('dashboardPreviewModalLabel'),
                prevBtn: document.getElementById('prevAttachment'),
                nextBtn: document.getElementById('nextAttachment')
            } : {};

            const MAX_FILES = 20;
            let cropper;
            let newFiles = [];
            let existingFiles = [];
            let removedFiles = [];
            let currentRotationAngle = 0;
            let originalDataURL = null;
            let currentImageBlob = null;
            let currentIndex = -1;
            let currentFiles = [];
            let currentZoom = 1.0;
            const ZOOM_STEP = 0.2;
            let isDragging = false;
            let startX, startY, scrollLeft, scrollTop;

            const BASE_FILE_URL = '<?php echo base_url('uploads/consultations/'); ?>';

            function getCurrentElements() {
                if (isNewConsultation) return newConsultationElements;
                if (isFollowup) return followupElements;
                return editElements;
            }

            if (isEditPage && editElements.fileList) {
                try {
                    existingFiles = <?php echo json_encode($attachments ?? []); ?>;
                } catch (e) {
                    console.error('Error parsing existingFiles:', e);
                    existingFiles = [];
                }

                existingFiles = existingFiles.map(file => {
                    const fileName = file.file_name || file.name || 'Unknown';
                    const extension = fileName.split('.').pop().toLowerCase();
                    const mimeType = file.mime_type || getMimeType(extension);
                    const url = file.url || (file.file_path ? BASE_FILE_URL +
                        encodeURIComponent(file.file_path) : BASE_FILE_URL + encodeURIComponent(fileName));
                    return {
                        file_name: fileName,
                        ext: extension,
                        mime_type: mimeType,
                        url,
                        size: file.size || 0
                    };
                });

                renderFileList();
            }
            if (isNewConsultation || isFollowup) {
                renderFileList();
            }


            function getMimeType(ext) {
                const map = {
                    'jpg': 'image/jpeg',
                    'jpeg': 'image/jpeg',
                    'png': 'image/png',
                    'pdf': 'application/pdf',
                    'doc': 'application/msword',
                    'docx': 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                };
                return map[ext] || 'application/octet-stream';
            }


            const currentElements = getCurrentElements();
            const dropZone = currentElements.dropZone;

            if (dropZone) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev => {
                    dropZone.addEventListener(ev, preventDefaults, false);
                    document.body.addEventListener(ev, preventDefaults, false);
                });
                ['dragenter', 'dragover'].forEach(ev => dropZone.addEventListener(ev, () => highlight(dropZone), false));
                ['dragleave', 'drop'].forEach(ev => dropZone.addEventListener(ev, () => unhighlight(dropZone), false));
                dropZone.addEventListener('drop', async e => {
                    unhighlight(dropZone);
                    await processNewFiles(Array.from(e.dataTransfer.files));
                });
            }

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(el) {
                el.style.borderColor = '#00ad8e';
                el.style.backgroundColor = '#f2ebebff';
            }

            function unhighlight(el) {
                el.style.borderColor = '#ccc';
                el.style.backgroundColor = 'transparent';
            }

            async function processNewFiles(files) {
                const currentElements = getCurrentElements();
                if (!currentElements.fileError) currentElements.fileError = document.getElementById('fileError');
                currentElements.fileError.textContent = "";
                if (!files.length) return;

                const allowedTypes = (currentElements.fileInput?.getAttribute('accept') || '').split(',').map(t => t.trim()).filter(t => t);
                for (let file of files) {
                    const ext = file.name.split('.').pop().toLowerCase();
                    const type = file.type || getMimeType(ext);

                    if (allowedTypes.length && !allowedTypes.includes(type) && !allowedTypes.some(t => file.name.endsWith(t.replace('.', '')))) {
                        currentElements.fileError.textContent = `File type not allowed: ${file.name}`;
                        continue;
                    }
                    if (newFiles.length + existingFiles.length >= MAX_FILES) {
                        currentElements.fileError.textContent = `Max ${MAX_FILES} files allowed.`;
                        break;
                    }
                    if ([...newFiles, ...existingFiles].some(f => (f.name || f.file_name) === file.name && f.size === file.size)) {
                        currentElements.fileError.textContent = `File "${file.name}" already uploaded.`;
                        continue;
                    }

                    if (['image/jpeg', 'image/jpg', 'image/png'].includes(type) && editElements.imageEditModal) {
                        const edited = await editImage(file);
                        if (edited) newFiles.push({
                            name: edited.name,
                            file: edited,
                            type: edited.type,
                            ext,
                            url: null,
                            size: edited.size
                        });
                    } else {
                        newFiles.push({
                            name: file.name,
                            file,
                            type,
                            ext,
                            url: null,
                            size: file.size
                        });
                    }
                }
                renderFileList();
                updateSubmitFileInput();
            }

            function editImage(file) {
                return new Promise(resolve => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const dataURL = e.target.result;
                        const img = document.getElementById('editor-image');
                        const canvas = document.getElementById('editor-canvas');
                        if (cropper) cropper.destroy();
                        currentRotationAngle = 0;
                        originalDataURL = dataURL;
                        currentImageBlob = file;
                        img.src = dataURL;
                        img.style.display = 'block';
                        canvas.style.display = 'none';
                        editElements.imageEditModal.show();
                        cropper = new Cropper(img, {
                            aspectRatio: NaN,
                            viewMode: 1,
                            autoCropArea: 1,
                            responsive: true,
                            scalable: true,
                            zoomable: true,
                            minContainerWidth: 600,
                            minContainerHeight: 600
                        });

                        const escapeHandler = ev => ev.key === 'Escape' && editElements.imageEditModal.hide();
                        document.addEventListener('keydown', escapeHandler);
                        editElements.imageEditModal._element.addEventListener('hidden.bs.modal', () => {
                            document.removeEventListener('keydown', escapeHandler);
                            resolve(null);
                            cleanup();
                        }, {
                            once: true
                        });

                        document.getElementById('crop-btn').onclick = () => {
                            img.style.display = 'block';
                            canvas.style.display = 'none';
                            if (!cropper) cropper = new Cropper(img, {
                                viewMode: 1,
                                dragMode: 'crop',
                                autoCrop: false,
                                movable: false,
                                zoomable: false,
                                scalable: false
                            });
                            cropper.setDragMode('crop');
                        };

                        document.getElementById('rotate-btn').onclick = () => {
                            if (!originalDataURL) return;
                            currentRotationAngle = (currentRotationAngle + 90) % 360;
                            const imgObj = new Image();
                            imgObj.src = originalDataURL;
                            imgObj.onload = () => {
                                const tempCanvas = document.createElement('canvas'),
                                    ctx = tempCanvas.getContext('2d');
                                const angleRad = currentRotationAngle * Math.PI / 180;
                                const isSwapped = currentRotationAngle === 90 || currentRotationAngle === 270;
                                const [w, h] = isSwapped ? [imgObj.naturalHeight * 0.5, imgObj.naturalWidth * 0.5] : [imgObj.naturalWidth * 0.5, imgObj.naturalHeight * 0.5];
                                tempCanvas.width = w;
                                tempCanvas.height = h;
                                ctx.translate(w / 2, h / 2);
                                ctx.rotate(angleRad);
                                ctx.drawImage(imgObj, -imgObj.naturalWidth * 0.25, -imgObj.naturalHeight * 0.25, imgObj.naturalWidth * 0.5, imgObj.naturalHeight * 0.5);
                                tempCanvas.toBlob(blob => {
                                    currentImageBlob = new File([blob], file.name, {
                                        type: file.type
                                    });
                                    const url = URL.createObjectURL(currentImageBlob);
                                    img.src = url;
                                    if (cropper) cropper.destroy();
                                    cropper = new Cropper(img, {
                                        aspectRatio: NaN,
                                        viewMode: 1,
                                        autoCropArea: 1,
                                        responsive: true,
                                        scalable: true,
                                        zoomable: true,
                                        minContainerWidth: 600,
                                        minContainerHeight: 600
                                    });
                                }, file.type, 1);
                            };
                        };

                        const saveBtn = document.getElementById('saveEditedImage');
                        const saveHandler = () => {
                            if (cropper) {
                                cropper.getCroppedCanvas({
                                    fillColor: file.type.includes('png') ? 'transparent' : '#ffffff'
                                }).toBlob(blob => {
                                    const edited = new File([blob], file.name, {
                                        type: file.type
                                    });
                                    const errorElement = getCurrentElements().fileError; // Use context-aware error element
                                    if ([...newFiles, ...existingFiles].some(f => (f.name || f.file_name) === edited.name && f.size === edited.size)) {
                                        errorElement.textContent = `File "${edited.name}" already uploaded.`;
                                        resolve(null);
                                        cleanup();
                                    } else {
                                        resolve(edited);
                                        cleanup();
                                    }
                                }, file.type, 1);
                            } else {
                                const edited = currentImageBlob ? new File([currentImageBlob], file.name, {
                                    type: file.type
                                }) : file;
                                const errorElement = getCurrentElements().fileError; // Use context-aware error element
                                if ([...newFiles, ...existingFiles].some(f => (f.name || f.file_name) === edited.name && f.size === edited.size)) {
                                    errorElement.textContent = `File "${edited.name}" already uploaded.`;
                                    resolve(null);
                                    cleanup();
                                } else {
                                    resolve(edited);
                                    cleanup();
                                }
                            }
                        };
                        saveBtn.addEventListener('click', saveHandler, {
                            once: true
                        });

                        function cleanup() {
                            editElements.imageEditModal.hide();
                            if (cropper) {
                                cropper.destroy();
                                cropper = null;
                            }
                            img.src = '';
                            img.style.display = 'none';
                            canvas.style.display = 'none';
                            currentRotationAngle = 0;
                            originalDataURL = null;
                            currentImageBlob = null;
                            const newBtn = saveBtn.cloneNode(true);
                            saveBtn.parentNode.replaceChild(newBtn, saveBtn);
                        }
                    };
                    reader.readAsDataURL(file);
                });
            }

            if (isEditPage || isNewConsultation || isFollowup) {
                const elements = getCurrentElements();

                if (elements.addBtn) {
                    elements.addBtn.addEventListener("click", () => {
                        if (newFiles.length + existingFiles.length >= MAX_FILES) {
                            elements.fileError.textContent = `Maximum ${MAX_FILES} files allowed.`;
                            return;
                        }
                        elements.fileInput.click();
                    });
                }
                if (elements.fileInput) {
                    elements.fileInput.addEventListener("change", async () => {
                        if (elements.fileInput.files.length) {
                            await processNewFiles(Array.from(elements.fileInput.files));
                            elements.fileInput.value = "";
                        }
                    });
                }
            }


            function renderFileList() {
                const currentElements = getCurrentElements();
                if (!currentElements.fileList) return;
                currentElements.fileList.innerHTML = "";
                const context = isEditPage ? "edit" : isNewConsultation ? "new" : "followup";

                if (!existingFiles.length && !newFiles.length) {
                    currentElements.fileList.innerHTML = '<small class="text-muted">No files selected.</small>';
                    return;
                }

                const ul = document.createElement("ul");
                ul.style.paddingLeft = "1.2rem";
                [...existingFiles, ...newFiles].forEach((file, i) => {
                    const isExisting = isEditPage && i < existingFiles.length;
                    const fileIndexInArray = isExisting ? i : i - existingFiles.length;

                    const li = document.createElement("li");
                    li.style.marginBottom = "6px";
                    const link = document.createElement("a");
                    link.href = "javascript:void(0);";
                    link.textContent = isExisting ? file.file_name : file.name;
                    link.className = "openAttachment";
                    link.style.color = "#007bff";
                    link.style.textDecoration = "underline";
                    link.style.cursor = "pointer";
                    link.setAttribute("data-file", isExisting ? file.url : (file.file ? file.name : ''));
                    link.setAttribute("data-ext", isExisting ? file.ext : file.ext);
                    link.setAttribute("data-context", context);
                    link.setAttribute("data-is-existing", isExisting.toString());
                    link.setAttribute("data-file-index", fileIndexInArray.toString());

                    const removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.textContent = "✕";
                    removeBtn.className = "btn btn-sm btn-danger";
                    removeBtn.style.marginLeft = "8px";
                    removeBtn.onclick = () => {
                        if (isExisting) {
                            removedFiles.push(file.file_name);
                            existingFiles.splice(fileIndexInArray, 1);
                            if (currentElements.removedFilesInput) currentElements.removedFilesInput.value = JSON.stringify(removedFiles);
                        } else newFiles.splice(fileIndexInArray, 1);
                        renderFileList();
                        updateSubmitFileInput();
                    };
                    li.appendChild(link);
                    li.appendChild(removeBtn);
                    ul.appendChild(li);
                });
                currentElements.fileList.appendChild(ul);
            }

            function updateSubmitFileInput() {
                const currentElements = getCurrentElements();
                if (!currentElements.submitFileInput) return;
                const dt = new DataTransfer();
                newFiles.forEach(f => dt.items.add(f.file));
                currentElements.submitFileInput.files = dt.files;
            }

            function showPreview(file, isExisting, index, context) {
                const fileName = isExisting ? file.file_name : file.name;
                const fileType = isExisting ? (file.mime_type || getMimeType(file.ext)) : file.type;
                const url = isExisting ? file.url : URL.createObjectURL(file.file);

                let elements, showModal, updateNav;
                if (context === 'edit' && editElements.editPreviewModal) {
                    elements = editElements;
                    showModal = () => editElements.editPreviewModal.show();
                    updateNav = updateEditNavigation;
                    elements.modalTitle.textContent = `Attachment Preview - ${fileName}`;
                    elements.previewContent.innerHTML = '';
                } else if (context === 'new' && newConsultationElements.previewModal) {
                    elements = newConsultationElements;
                    showModal = () => elements.previewModal.show();
                    updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `New Consultation Attachment Preview - ${fileName}`;
                    elements.image.classList.add('d-none');
                    elements.pdf.classList.add('d-none');
                } else if (context === 'followup' && followupElements.previewModal) {
                    elements = followupElements;
                    showModal = () => elements.previewModal.show();
                    updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `Follow-up Attachment Preview - ${fileName}`;
                    elements.image.classList.add('d-none');
                    elements.pdf.classList.add('d-none');
                } else if (context === 'dashboard' && dashboardElements.previewModal) {
                    elements = dashboardElements;
                    showModal = () => elements.previewModal.show();
                    updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `Attachment Preview in Dashboard - ${fileName}`;
                    elements.image.classList.add('d-none');
                    elements.pdf.classList.add('d-none');

                    document.getElementById('attachment-content-wrapper')?.querySelector('#no-preview-message')?.remove();

                    const toolbar = document.getElementById('attachment-toolbar');
                    const downloadBtn = document.getElementById('downloadAttachmentBtn');
                    const attachmentImage = document.getElementById('attachmentImage');

                    toolbar.style.display = 'none';

                    currentZoom = 1.0;
                    attachmentImage.style.transform = `scale(${currentZoom})`;

                    let hasDownloaded = false; // Restrict multi download
                    const patientId = document.getElementById('patientId').value;
                    const newFileName = fileName.replace(/^[^_]+/, `attachment_${patientId}`);
                    downloadBtn.onclick = () => {
                        if (hasDownloaded) return;  // Stop further clicks
                        hasDownloaded = true;

                        const tempLink = document.createElement('a');
                        tempLink.href = url;
                        tempLink.download = newFileName;
                        document.body.appendChild(tempLink);
                        tempLink.click();
                        document.body.removeChild(tempLink);
                    };

                    if (fileType.includes('image')) {
                        toolbar.style.display = 'flex';
                        document.getElementById('zoomOutBtn').disabled = true;
                        document.getElementById('zoomInBtn').disabled = false;
                        attachmentImage.style.cursor = 'grab';
                    } else {
                        attachmentImage.style.cursor = 'default';
                    }
                } else return;

                currentIndex = index;

                const display = () => {
                    if (fileType.includes('image')) {
                        if (context === 'edit') {
                            const img = document.createElement('img');
                            img.src = url;
                            img.style.maxWidth = '100%';
                            img.maxHeight = '70vh';
                            elements.previewContent.appendChild(img);
                        } else {
                            elements.image.src = url;
                            elements.image.classList.remove('d-none');
                        }
                    } else if (fileType === 'application/pdf') {
                        if (context === 'edit') {
                            const embed = document.createElement('embed');
                            embed.src = url;
                            embed.style.width = '100%';
                            embed.style.height = '70vh';
                            elements.previewContent.appendChild(embed);
                        } else {
                            elements.pdf.src = url;
                            elements.pdf.classList.remove('d-none');
                        }
                    } else {
                        const p = document.createElement('p');
                        p.textContent = `Preview not available for ${fileName}.`;
                        p.style.textAlign = 'center';

                        if (context === 'dashboard') {
                            elements.image.classList.add('d-none');
                            elements.pdf.classList.add('d-none');
                            p.id = 'no-preview-message';
                            document.getElementById('attachment-content-wrapper').appendChild(p);
                        } else if (context === 'edit') {
                            elements.previewContent.appendChild(p);
                        } else {
                            elements.image.classList.remove('d-none');
                            elements.image.alt = p.textContent;
                        }
                    }
                    updateNav(index);
                    showModal();
                };

                if (isExisting && context !== 'edit') {
                    fetch(url, {
                        method: 'HEAD'
                    }).then(r => r.ok ? display() : fail()).catch(fail);
                } else display();

                function fail() {
                    const p = document.createElement('p');
                    p.textContent = `Cannot access ${fileName}.`;
                    p.style.textAlign = 'center';
                    context === 'edit' ? elements.previewContent.appendChild(p) : elements.image.classList.remove('d-none'), elements.image.alt = p.textContent;
                    updateNav(index);
                    showModal();
                }

                elements.previewModal._element.addEventListener('hidden.bs.modal', () => {
                    if (!isExisting && url.startsWith('blob:')) URL.revokeObjectURL(url);
                    if (context === 'edit') elements.previewContent.innerHTML = '';
                    else {
                        elements.image.src = '';
                        elements.pdf.src = '';
                        elements.image.classList.add('d-none');
                        elements.pdf.classList.add('d-none');
                    }
                    currentIndex = -1;
                    currentFiles = [];

                    if (context === 'dashboard') {
                        document.getElementById('attachmentImage').style.cursor = 'default';
                        document.getElementById('attachment-content-wrapper').scrollTo(0, 0); // Reset scroll position
                        document.getElementById('attachment-content-wrapper')?.querySelector('#no-preview-message')?.remove();
                    }
                }, {
                    once: true
                });
            }

            function updateEditNavigation(index) {
                editElements.prevBtn.disabled = index === 0;
                editElements.nextBtn.disabled = index === currentFiles.length - 1;
                editElements.prevBtn.classList.toggle('disabled', index === 0);
                editElements.nextBtn.classList.toggle('disabled', index === currentFiles.length - 1);
            }

            function updateNavButtons(el, index) {
                el.prevBtn.disabled = index === 0;
                el.nextBtn.disabled = index === currentFiles.length - 1;
                el.prevBtn.classList.toggle('disabled', index === 0);
                el.nextBtn.classList.toggle('disabled', index === currentFiles.length - 1);
            }

            document.removeEventListener('click', handleAttachmentClick);

            function handleAttachmentClick(e) {
                const link = e.target.closest('.openAttachment');
                if (!link) return;
                e.preventDefault();
                e.stopPropagation();

                const context = link.getAttribute('data-context');
                const fileName = link.textContent.trim();

                let allRelevantLinks = Array.from(document.querySelectorAll(`.openAttachment[data-context="${context}"]`));
                currentFiles = allRelevantLinks;

                if (context === 'dashboard') {
                    const match = fileName.match(/_(\d+)_/);
                    const consultationId = match ? match[1] : null;

                    if (consultationId) {
                        const filterPattern = new RegExp(`_${consultationId}_`);
                        currentFiles = allRelevantLinks.filter(fileLink =>
                            filterPattern.test(fileLink.textContent.trim())
                        );
                    } else {
                        currentFiles = [link];
                    }
                }

                const index = currentFiles.indexOf(link);
                if (index === -1) return;

                if (['new', 'edit', 'followup'].includes(context)) {
                    const isExisting = link.getAttribute('data-is-existing') === "true";
                    const fileIndexInArray = parseInt(link.getAttribute('data-file-index'), 10);

                    let file = null;
                    if (isExisting) {
                        file = existingFiles[fileIndexInArray];
                    } else {
                        file = newFiles[fileIndexInArray];
                    }

                    if (file) showPreview(file, isExisting, index, context);
                    else console.error(`File not found for context ${context} at index ${fileIndexInArray}`);

                } else if (context === 'dashboard') {
                    showPreview({
                        url: link.getAttribute('data-file'),
                        ext: link.getAttribute('data-ext'),
                        file_name: fileName
                    }, true, index, 'dashboard');
                }
            }
            document.addEventListener('click', handleAttachmentClick);

            function setupNav(prevBtn, nextBtn, context) {
                if (!prevBtn || !nextBtn) return;
                prevBtn.onclick = () => {
                    if (!prevBtn.disabled && currentIndex > 0) navigate(currentIndex - 1, context);
                };
                nextBtn.onclick = () => {
                    if (!nextBtn.disabled && currentIndex < currentFiles.length - 1) navigate(currentIndex + 1, context);
                };
                [prevBtn, nextBtn].forEach(btn => {
                    btn.addEventListener("mouseenter", () => btn.style.cursor = btn.disabled ? 'not-allowed' : 'pointer');
                    btn.addEventListener("mouseleave", () => btn.style.cursor = '');
                });
            }

            function navigate(index, context) {
                const link = currentFiles[index];
                link.click();
            }

            setupNav(editElements.prevBtn, editElements.nextBtn, 'edit');
            if (newConsultationElements.prevBtn) setupNav(newConsultationElements.prevBtn, newConsultationElements.nextBtn, 'new');
            if (followupElements.prevBtn) setupNav(followupElements.prevBtn, followupElements.nextBtn, 'followup');
            if (dashboardElements.prevBtn) setupNav(dashboardElements.prevBtn, dashboardElements.nextBtn, 'dashboard');

            // === Dashboard Zoom & Pan (double-tap + hold ONLY) ===
            const zoomInBtn = document.getElementById('zoomInBtn');
            const zoomOutBtn = document.getElementById('zoomOutBtn');
            const attachmentImage = document.getElementById('attachmentImage');
            const contentWrapper = document.getElementById('attachment-content-wrapper');

            if (zoomInBtn && zoomOutBtn && attachmentImage && contentWrapper) {

                zoomInBtn.addEventListener('click', () => {
                    if (attachmentImage.classList.contains('d-none')) return;
                    currentZoom = Math.min(currentZoom + ZOOM_STEP, 3.0);
                    attachmentImage.style.transform = `scale(${currentZoom})`;
                    zoomOutBtn.disabled = false;
                    if (currentZoom >= 3.0) zoomInBtn.disabled = true;
                    if (currentZoom > 1.0) attachmentImage.style.cursor = 'grab';
                });

                zoomOutBtn.addEventListener('click', () => {
                    if (attachmentImage.classList.contains('d-none')) return;
                    currentZoom = Math.max(currentZoom - ZOOM_STEP, 1.0);
                    attachmentImage.style.transform = `scale(${currentZoom})`;
                    zoomInBtn.disabled = false;
                    if (currentZoom <= 1.0) {
                        zoomOutBtn.disabled = true;
                        contentWrapper.scrollTo(0, 0);
                        attachmentImage.style.cursor = 'default';
                    } else {
                        attachmentImage.style.cursor = 'grab';
                    }
                });

                attachmentImage.setAttribute('draggable', 'false');
                attachmentImage.addEventListener('dragstart', e => e.preventDefault());

                // CSS – allow only panning, block everything else
                attachmentImage.style.touchAction = 'pan-x pan-y';
                attachmentImage.style.userSelect = 'none';

                let isDragging = false;
                let startX, startY, scrollLeft, scrollTop;

                const startDrag = (clientX, clientY) => {
                    if (attachmentImage.classList.contains('d-none') || currentZoom <= 1.0) return;

                    isDragging = true;
                    attachmentImage.style.cursor = 'grabbing';

                    startX = clientX - contentWrapper.offsetLeft;
                    startY = clientY - contentWrapper.offsetTop;
                    scrollLeft = contentWrapper.scrollLeft;
                    scrollTop = contentWrapper.scrollTop;

                    contentWrapper.style.userSelect = 'none';
                };

                const moveDrag = (clientX, clientY) => {
                    if (!isDragging) return;
                    const x = clientX - contentWrapper.offsetLeft;
                    const y = clientY - contentWrapper.offsetTop;
                    const walkX = x - startX;
                    const walkY = y - startY;

                    contentWrapper.scrollLeft = scrollLeft - walkX;
                    contentWrapper.scrollTop = scrollTop - walkY;
                };

                const stopDrag = () => {
                    if (!isDragging) return;
                    isDragging = false;
                    if (currentZoom > 1.0) attachmentImage.style.cursor = 'grab';
                    contentWrapper.style.userSelect = '';
                };

                contentWrapper.addEventListener('mousedown', e => startDrag(e.pageX, e.pageY));
                contentWrapper.addEventListener('mousemove', e => moveDrag(e.pageX, e.pageY));
                document.addEventListener('mouseup', stopDrag);
                contentWrapper.addEventListener('mouseleave', stopDrag);


                let lastTap = 0;
                let tapTimeout = null;

                contentWrapper.addEventListener('touchstart', e => {
                    const now = Date.now();
                    const TAP_DELAY = 300;
                    const DOUBLE_TAP_THRESHOLD = 500;

                    if (now - lastTap < TAP_DELAY) {
                        // ---- DOUBLE TAP DETECTED ----
                        clearTimeout(tapTimeout);
                        e.preventDefault();

                        tapTimeout = setTimeout(() => {
                            if (e.touches.length === 1) {
                                const touch = e.touches[0];
                                startDrag(touch.pageX, touch.pageY);
                            }
                        }, 150);
                    } else {
                        lastTap = now;
                        tapTimeout = setTimeout(() => { }, DOUBLE_TAP_THRESHOLD);
                    }
                });

                contentWrapper.addEventListener('touchmove', e => {
                    if (!isDragging) return;
                    e.preventDefault();
                    const touch = e.touches[0];
                    moveDrag(touch.pageX, touch.pageY);
                });

                contentWrapper.addEventListener('touchend', stopDrag);
                contentWrapper.addEventListener('touchcancel', stopDrag);
            }
        });
    </script>

    <!-- Delete Consultation Script -->
    <script>
        let deleteConsultationId = null;
        let deletePatientId = null;

        function confirmDeleteConsult(patientId, consultationId, consultationDate, consultationTime) {
            deleteConsultationId = consultationId;
            deletePatientId = patientId;

            document.getElementById('deleteModalBody').innerHTML =
                `Are you sure you want to delete this consultation done on <strong>${consultationDate} - ${consultationTime}</strong>?`;

            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            modal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteConsultationId && deletePatientId) {
                window.location.href = "<?php echo site_url('Consultation/deleteConsultation/'); ?>" +
                    deletePatientId + "/" + deleteConsultationId;
            }
        });
    </script>

    <!-- Sidebar active color change code -->
    <script>
        <?php if ($method == "consultDashboard" || $method == "followupConsult" || $method == "editConsult") { ?>
            document.getElementById('patients').style.color = "#87F7E3";
        <?php } ?>
    </script>

    <!-- Toggle visibility and icon for all fields in consultation page -->
    <script>
        document.querySelectorAll('.toggle-label').forEach(label => {
            label.addEventListener('click', function (e) {
                const container = label.nextElementSibling;
                const icon = label.querySelector('.toggle-icon');
                const isOpening = !container.classList.contains('show');

                if (isOpening) {
                    document.querySelectorAll('.field-container.collapse').forEach(otherContainer => {
                        if (otherContainer !== container && otherContainer.classList.contains('show')) {
                            otherContainer.classList.remove('show');
                            const otherLabel = otherContainer.previousElementSibling;
                            if (otherLabel) {
                                const otherIcon = otherLabel.querySelector('.toggle-icon');
                                if (otherIcon) otherIcon.textContent = '+';
                            }
                        }
                    });
                }
                if (isOpening) {
                    container.classList.add('show');
                    icon.textContent = '-';
                } else {
                    container.classList.remove('show');
                    icon.textContent = '+';
                }
            });
        });
    </script>

    <!-- Modal move on screen -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const draggableModalIds = [
                '#symptomsModal',
                '#inputModal',
                '#diagnosisModal',
                '#investigationsModal',
                '#medicinesModal'
            ];
            draggableModalIds.forEach(id => {
                const modalElement = document.querySelector(id);
                if (modalElement) {
                    makeModalDraggable(modalElement);
                    modalElement.addEventListener('hidden.bs.modal', function () {
                        const modalDialog = modalElement.querySelector('.modal-dialog');
                        modalDialog.style.left = '';
                        modalDialog.style.top = '';
                        modalDialog.style.margin = '';
                        modalDialog.style.transform = '';
                    });
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    const openModal = document.querySelector('.modal.show');
                    if (openModal) {
                        const modalInstance = bootstrap.Modal.getInstance(openModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                }
            });
        });

        function makeModalDraggable(modal) {
            const modalDialog = modal.querySelector('.modal-dialog');
            const modalHeader = modal.querySelector('.modal-header');

            if (!modalHeader) return; // Safety check if a modal has no header

            let isDragging = false;
            let hasDragged = false;
            let initialPosX = 0;
            let initialPosY = 0;
            let offsetX = 0;
            let offsetY = 0;

            modalHeader.addEventListener('mousedown', function (e) {
                e.preventDefault();
                isDragging = true;
                hasDragged = false;

                const rect = modalDialog.getBoundingClientRect();
                initialPosX = rect.left;
                initialPosY = rect.top;

                offsetX = e.clientX - initialPosX;
                offsetY = e.clientY - initialPosY;

                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });

            function onMouseMove(e) {
                if (!isDragging) return;

                if (!hasDragged) {
                    modalDialog.style.margin = '0';
                    modalDialog.style.transform = 'none';
                    modalDialog.style.left = initialPosX + 'px';
                    modalDialog.style.top = initialPosY + 'px';
                    hasDragged = true;
                }

                let newPosX = e.clientX - offsetX;
                let newPosY = e.clientY - offsetY;

                modalDialog.style.left = newPosX + 'px';
                modalDialog.style.top = newPosY + 'px';
            }

            function onMouseUp() {
                isDragging = false;
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
            }
        }
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

                            // const canvas = await html2canvas(page, {
                            //     scale: 1,
                            //     backgroundColor: '#ffffff',
                            //     logging: false,
                            //     useCORS: true
                            // });
                            await document.fonts.ready;

                            const canvas = await html2canvas(page, {
                                scale: 2,
                                backgroundColor: '#ffffff',
                                useCORS: true,
                                logging: false
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
                }
            }

            async function generateVirtualPages(source) {
                const pages = [];
                const PAGE_WIDTH = 794;  // Standard A4 Web Width (px)
                const PAGE_HEIGHT = 1122; // Standard A4 Web Height (px)

                // 1. SET YOUR CUSTOM MARGINS HERE
                const MARGIN_TOP = 200;     // Top Space
                const MARGIN_BOTTOM = 150;   // Bottom Space
                const MARGIN_SIDES = 30;    // Keep 30px for Left/Right

                // 2. CALCULATE SAFE CONTENT HEIGHT
                // Total Height - (Top Space + Bottom Space) = Usable Area
                const CONTENT_LIMIT = PAGE_HEIGHT - MARGIN_TOP - MARGIN_BOTTOM;

                function createNewPage() {
                    const div = document.createElement('div');
                    div.style.width = `${PAGE_WIDTH}px`;
                    div.style.height = `${PAGE_HEIGHT}px`;
                    div.style.position = 'fixed';
                    div.style.left = '-10000px';
                    div.style.top = '0';
                    div.style.backgroundColor = '#fff';

                    // 3. APPLY SPECIFIC PADDING
                    div.style.paddingTop = `${MARGIN_TOP}px`;
                    div.style.paddingBottom = `${MARGIN_BOTTOM}px`;
                    div.style.paddingLeft = `${MARGIN_SIDES}px`;
                    div.style.paddingRight = `${MARGIN_SIDES}px`;

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

            document.body.innerHTML = `
                <div id="print-wrapper">
                    ${printContents}
                </div>
            `;

            if (title) {
                document.title = title;
            }

            var style = document.createElement('style');
            // Adjust style based on requirement to print on Letterpad with header and footer space
            style.innerHTML = `
                @media print {
                    @page {
                        margin-top: 150px;    /* Header space on EVERY page */
                        margin-bottom: 150px;  /* Footer space on EVERY page */
                        margin-left: 10mm;
                        margin-right: 10mm;
                    }

                    body {
                        margin: 0;
                    }
                }
            `;
            document.head.appendChild(style);

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

    <!-- Submit control -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function setupProcessingAnimation(form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        return;
                    }

                    const btn = form.querySelector('button[type="submit"]');

                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Save';
                    }
                });
            }

            const consultForms = document.querySelectorAll('[id="consultationForm"]');
            consultForms.forEach(function (form) {
                setupProcessingAnimation(form);
            });

            const editForm = document.getElementById('editConsultationForm');
            if (editForm) {
                setupProcessingAnimation(editForm);
            }
        });
    </script>

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Vendor JS Files --> <!-- Latest version on middle of page -->
    <!-- <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- PDF Download link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Drag And Drop -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <!-- Consultation Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Fabric.js and Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>


</body>

</html>