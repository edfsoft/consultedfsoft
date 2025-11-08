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
            border: 1px solid #ced4da;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            position: absolute;
            background: white;
            width: 100%;
            z-index: 1050;
        }

        .suggestions-box div {
            padding: 8px;
            cursor: pointer;
        }

        .suggestions-box div:hover {
            background-color: #f8f9fa;
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
        #investigationsModal .modal-header {
            cursor: move;
            user-select: none; /* Prevents text selection on double-click */
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
        #dashboardPreviewModal .modal-body::before { left: 0; }
        #dashboardPreviewModal .modal-body::after  { right: 0; }
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
            <?php
        }
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
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> Year(s)
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
                                                    < 1 of <?= count($consultations) ?> >
                                                </span>
                                                <button id="nav-right" class="btn btn-outline-secondary ms-2"
                                                    onclick="navigateConsultations(1)">&#9654;</button>
                                            </div>
                                        </div>
                                        <?php
                                        usort($consultations, function ($a, $b) {
                                            return strtotime($b['created_at']) - strtotime($a['created_at']);
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
                                                                <button class="btn btn-secondary"
                                                                    onclick="downloadConsultationPDF(<?= $consultation['id'] ?>)">
                                                                    <i class="bi bi-download"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="confirmDeleteConsult('<?php echo $patientDetails[0]['id']; ?>','<?php echo $consultation['id']; ?>', '<?php echo date('d M Y', strtotime($consultation['consult_date'])); ?>', '<?php echo date('h:i A', strtotime($consultation['consult_time'])); ?>')">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>

                                                                <button class="btn btn-secondary"
                                                                    onclick="window.location.href='<?php echo site_url('Consultation/editConsultation/' . $consultation['id']); ?>'">
                                                                    <i class="bi bi-pen"></i>
                                                                </button>

                                                                <button class="btn text-light" style="background-color: #00ad8e;"
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

                                                        <!-- ====== Medicines ====== -->
                                                        <?php if (!empty($consultation['medicines'])): ?>
                                                            <p><strong>Medicines:</strong></p>
                                                            <table
                                                                style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                                                                <thead>
                                                                    <tr>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: left;">
                                                                            S.No</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: left;">
                                                                            Name</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: left;">
                                                                            Frequency</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: left;">
                                                                            Duration</th>
                                                                        <th
                                                                            style="border: 1px solid #000; padding: 6px; text-align: left;">
                                                                            Notes</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($consultation['medicines'] as $index => $medicine): ?>
                                                                        <tr>
                                                                            <td style="border: 1px solid #000; padding: 6px;">
                                                                                <?= $index + 1 . ' .' ?></td>
                                                                            <td style="border: 1px solid #000; padding: 6px;">
                                                                                <?= htmlspecialchars($medicine['medicine_name']) ?>
                                                                                <?php if (!empty($medicine['quantity']) || !empty($medicine['unit'])): ?>
                                                                                    <small>
                                                                                        (<?= htmlspecialchars($medicine['quantity'] ?? '') . ' ' . htmlspecialchars($medicine['unit'] ?? '') ?>)
                                                                                    </small>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                            <td style="border: 1px solid #000; padding: 6px;">
                                                                                <?= htmlspecialchars($medicine['timing'] ?? '-') ?></td>
                                                                            <td style="border: 1px solid #000; padding: 6px;">
                                                                                <?= htmlspecialchars($medicine['duration'] ?? '-') ?></td>
                                                                            <td style="border: 1px solid #000; padding: 6px;">
                                                                                <?php
                                                                                $notes = [];
                                                                                if (!empty($medicine['food_timing']))
                                                                                    $notes[] = $medicine['food_timing'];
                                                                                if (!empty($medicine['notes']))
                                                                                    $notes[] = $medicine['notes'];
                                                                                echo !empty($notes) ? htmlspecialchars(implode(' - ', $notes)) : '-';
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
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
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Previous and Next arrows script -->
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
                                    <!-- ✅ Add jsPDF and html2canvas -->
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

                                    <script>
                                        async function downloadConsultationPDF(consultationId) {
                                            const element = document.getElementById('consultation-content-' + consultationId);
                                            if (!element) {
                                                alert("Consultation content not found!");
                                                return;
                                            }

                                            const { jsPDF } = window.jspdf;
                                            const pdf = new jsPDF('p', 'mm', 'a4');

                                            // Capture element as canvas
                                            await html2canvas(element, {
                                                scale: 2,
                                                useCORS: true,
                                            }).then(canvas => {
                                                const imgData = canvas.toDataURL('image/png');
                                                const imgWidth = 190; // width of A4 minus margins
                                                const pageHeight = 295; // height of A4
                                                const imgHeight = canvas.height * imgWidth / canvas.width;
                                                let heightLeft = imgHeight;
                                                let position = 10;

                                                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                                                heightLeft -= pageHeight;

                                                while (heightLeft > 0) {
                                                    position = heightLeft - imgHeight;
                                                    pdf.addPage();
                                                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                                                    heightLeft -= pageHeight;
                                                }

                                                pdf.save('consultation_' + consultationId + '.pdf');
                                            });
                                        }
                                    </script>
                                <?php else: ?>
                                    <p>No Previous Consultation.</p>
                                <?php endif; ?>
                            </div>

                            <!-- New Consultation -->
                            <div class="tab-pane fade" id="new-consultation" role="tabpanel">
                                <form action="<?php echo base_url() . 'Consultation/saveConsultation' ?>" method="post"
                                    id="consultationForm" class="mb-5" enctype="multipart/form-data">
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
                                            <div class="col-md-4">
                                                <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                        name="patientHeight" step="0.1" min="0" placeholder="E.g. 135">
                                                    <p class="mx-2 my-2">Cm</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                        name="patientWeight" step="0.1" min="0" placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">Kg</p>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientWeight">Systolic BP
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientSystolicBp" name="patientSystolicBp"
                                                        placeholder="E.g. 120" step="0.1" min="0">
                                                </div>
                                                <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="col-md-2 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientHeight">Diastolic
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
                                            <div class="col-md-4">
                                                <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                        name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5">
                                                    <p class="mx-2 my-2">%</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                        name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98">
                                                    <p class="mx-2 my-2">%</p>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-3 mt-md-0">
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
                                            <div class="col-md-2 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientTemperature" name="patientTemperature" step="0.1" min="0"
                                                        step="0.01" placeholder="E.g. 98.6">
                                                    <p class="mx-2 my-2">°F</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label fieldLabel" for="fastingBsugar">Blood Sugar
                                                    (Fasting)</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="fastingBsugar"
                                                        name="fastingBsugar" step="0.1" min="0" placeholder="E.g. 75">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3 mt-md-0">
                                                <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP)
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                        name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3 mt-md-0">
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
                                                    <div class="mb-3 position-relative">
                                                        <div class="tags-input" id="symptomsInput">
                                                            <input type="text"
                                                                class="form-control border-0 p-0 m-0 shadow-none"
                                                                id="symptomsSearchInput"
                                                                placeholder="Search or type to add..." />
                                                        </div>
                                                        <div class="suggestions-box" id="symptomsSuggestionsBox"></div>
                                                    </div>
                                                    <div id="symptomsList" class="mt-2"></div>
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
                                                    <div class="mb-3 position-relative">
                                                        <div class="tags-input" id="findingsInput">
                                                            <input type="text"
                                                                class="form-control border-0 p-0 m-0 shadow-none"
                                                                id="searchInput" placeholder="Search or type to add..." />
                                                        </div>
                                                        <div class="suggestions-box" id="suggestionsBox"></div>
                                                    </div>
                                                    <div id="findingsList" class="mt-2"></div>
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
                                                <div class="mb-3 position-relative">
                                                    <div class="tags-input" id="diagnosisInputBox">
                                                        <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                            id="diagnosisInput"
                                                            placeholder="Search or type to add diagnosis..." />
                                                    </div>
                                                    <div class="suggestions-box" id="diagnosisSuggestionsBox"></div>
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
                                                    <div class="mb-3 position-relative">
                                                        <div class="tags-input" id="investigationsInput">
                                                            <input type="text"
                                                                class="form-control border-0 p-0 m-0 shadow-none"
                                                                id="investigationsSearchInput"
                                                                placeholder="Search or type to add..." />
                                                        </div>
                                                        <div class="suggestions-box" id="investigationsSuggestionsBox">
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
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" id="procedureSearch"
                                                        placeholder="Search Instructions">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearProcedureSearch">✖</button>
                                                    <button type="button" class="btn btn-outline-primary d-none"
                                                        id="addProcedure">+ Add</button>
                                                </div>
                                                <div id="procedureList">
                                                    <?php if (!empty($proceduresList)): ?>
                                                        <?php foreach ($proceduresList as $pro): ?>
                                                            <div class="form-check procedure-item">
                                                                <input class="form-check-input" type="checkbox" name="procedures[]"
                                                                    value="<?php echo htmlspecialchars($pro['proceduresName']); ?>"
                                                                    id="pro<?php echo $pro['id']; ?>">
                                                                <label class="form-check-label" for="pro<?php echo $pro['id']; ?>">
                                                                    <?php echo htmlspecialchars($pro['proceduresName']); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-bs-toggle="collapse" data-bs-target="#medicinesCollapse">
                                                <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="medicinesCollapse">
                                                <div id="medicinesWrapper">
                                                    <div class="mb-3 position-relative">
                                                        <div class="tags-input" id="medicinesInput">
                                                            <input type="text"
                                                                class="form-control border-0 p-0 m-0 shadow-none"
                                                                id="medicinesSearchInput"
                                                                placeholder="Search or type to add..." />
                                                        </div>
                                                        <div class="suggestions-box" id="medicinesSuggestionsBox"></div>
                                                    </div>
                                                    <div id="medicinesList" class="mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="medicinesJson" id="medicinesJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                        Advice</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>

                                            <div class="collapse field-container mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" id="adviceSearch"
                                                        placeholder="Search Advice">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="clearAdviceSearch">✖</button>
                                                    <button type="button" class="btn btn-outline-primary d-none"
                                                        id="addAdvice">+ Add</button>
                                                </div>
                                                <div id="adviceList">
                                                    <?php if (!empty($advicesList)): ?>
                                                        <?php foreach ($advicesList as $adv): ?>
                                                            <div class="form-check advice-item">
                                                                <input class="form-check-input" type="checkbox" name="advices[]"
                                                                    value="<?php echo htmlspecialchars($adv['adviceName']); ?>"
                                                                    id="adv<?php echo $adv['id']; ?>">
                                                                <label class="form-check-label" for="adv<?php echo $adv['id']; ?>">
                                                                    <?php echo htmlspecialchars($adv['adviceName']); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
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
                                                <div class="mb-3">
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" id="instructionSearch"
                                                            placeholder="Search Instructions">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="clearInstructionSearch">✖</button>
                                                        <button type="button" class="btn btn-outline-primary d-none"
                                                            id="addInstruction">+ Add</button>
                                                    </div>
                                                </div>
                                                <div id="instructionList">
                                                    <?php if (!empty($instructionsList)): ?>
                                                        <?php foreach ($instructionsList as $ins): ?>
                                                            <div class="form-check instruction-item">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="instructions[]"
                                                                    value="<?php echo htmlspecialchars($ins['instructionsName']); ?>"
                                                                    id="ins<?php echo $ins['id']; ?>">
                                                                <label class="form-check-label" for="ins<?php echo $ins['id']; ?>">
                                                                    <?php echo htmlspecialchars($ins['instructionsName']); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group pb-3">
                                        <label class="form-label fieldLabel">Attachments</label>
                                        <input type="file" id="fileInput" name="consultationFiles[]" class="d-none"
                                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
                                        <button type="button" id="addFileBtn" class="btn text-light float-end mb-2"
                                            style="background-color: #00ad8e;">
                                            + Add File
                                        </button>
                                        <div id="fileList" style="margin-top: 0.5rem;"></div>
                                        <div id="fileError" class="text-danger pt-1"></div> 
                                    </div> --><!-- This code is common for all 3 new, edi and followup -->

                                    <div class="form-group pb-3" data-page="new">
                                        <label class="form-label fieldLabel">Attachments</label>
                                        <button type="button" class="addFileBtn btn text-light float-end mb-2"
                                            style="background-color: #00ad8e;"> + Add File </button>
                                        <div class="mb-3"></div>
                                        <div class="dropZone"
                                            style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; margin-bottom: 15px;">
                                            <p class="text-muted mb-0">Drag and drop files here, or click the button below.
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

                                    <button type="submit" id="submitForm" class="mt-2 float-end btn text-light"
                                        style="background-color: #00ad8e;">Save</button>
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
                                                <iframe id="newConsultationPDF" src="" class="w-100" style="height:500px;"
                                                    frameborder="0"></iframe>
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
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> Year(s)
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                name="patientHeight" step="0.1" min="0" placeholder="E.g. 135"
                                                value="<?= isset($vitals['height_cm']) ? $vitals['height_cm'] : '' ?>">
                                            <p class="mx-2 my-2">Cm</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                name="patientWeight" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['weight_kg']) ? $vitals['weight_kg'] : '' ?>">
                                            <p class="mx-2 my-2">Kg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Systolic BP
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120" step="0.1" min="0"
                                                value="<?= isset($vitals['systolic_bp']) ? $vitals['systolic_bp'] : '' ?>">
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientHeight">Diastolic BP</label>
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5"
                                                value="<?= isset($vitals['HbA1c_percent']) ? $vitals['HbA1c_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98"
                                                value="<?= isset($vitals['spo2_percent']) ? $vitals['spo2_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
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
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" step="0.1" min="0" step="0.01"
                                                placeholder="E.g. 98.6"
                                                value="<?= isset($vitals['temperature_f']) ? $vitals['temperature_f'] : '' ?>">
                                            <p class="mx-2 my-2">°F</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP) </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                value="<?= isset($vitals['blood_sugar_pp']) ? $vitals['blood_sugar_pp'] : '' ?>"
                                                name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="symptomsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="symptomsSearchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="symptomsSuggestionsBox"></div>
                                            </div>
                                            <div id="symptomsList" class="mt-2"></div>
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="findingsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="searchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="suggestionsBox"></div>
                                            </div>
                                            <div id="findingsList" class="mt-2"></div>
                                            <!-- Display added findings -->
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
                                        <div class="mb-3 position-relative">
                                            <div class="tags-input" id="diagnosisInputBox">
                                                <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                    id="diagnosisInput" placeholder="Search or type to add diagnosis..." />
                                            </div>
                                            <div class="suggestions-box" id="diagnosisSuggestionsBox"></div>
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="investigationsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="investigationsSearchInput"
                                                        placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="investigationsSuggestionsBox"></div>
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
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="procedureSearch"
                                                placeholder="Search Instructions">
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="clearProcedureSearch">✖</button>
                                            <button type="button" class="btn btn-outline-primary d-none" id="addProcedure">+
                                                Add</button>
                                        </div>
                                        <div id="procedureList">
                                            <?php if (!empty($proceduresList)): ?>
                                                <?php foreach ($proceduresList as $pro): ?>
                                                    <div class="form-check procedure-item">
                                                        <input class="form-check-input" type="checkbox" name="procedures[]"
                                                            value="<?php echo htmlspecialchars($pro['proceduresName']); ?>"
                                                            id="pro<?php echo $pro['id']; ?>">
                                                        <label class="form-check-label" for="pro<?php echo $pro['id']; ?>">
                                                            <?php echo htmlspecialchars($pro['proceduresName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button"
                                        data-bs-toggle="collapse" data-bs-target="#medicinesCollapse">
                                        <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="medicinesCollapse">
                                        <div id="medicinesWrapper">
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="medicinesInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="medicinesSearchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="medicinesSuggestionsBox"></div>
                                            </div>
                                            <div id="medicinesList" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="medicinesJson" id="medicinesJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                Advice</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>

                                    <div class="collapse field-container mt-2">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="adviceSearch"
                                                placeholder="Search Advice">
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="clearAdviceSearch">✖</button>
                                            <button type="button" class="btn btn-outline-primary d-none" id="addAdvice">+
                                                Add</button>
                                        </div>
                                        <div id="adviceList">
                                            <?php if (!empty($advicesList)): ?>
                                                <?php foreach ($advicesList as $adv): ?>
                                                    <div class="form-check advice-item">
                                                        <input class="form-check-input" type="checkbox" name="advices[]"
                                                            value="<?php echo htmlspecialchars($adv['adviceName']); ?>"
                                                            id="adv<?php echo $adv['id']; ?>">
                                                        <label class="form-check-label" for="adv<?php echo $adv['id']; ?>">
                                                            <?php echo htmlspecialchars($adv['adviceName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
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
                                        <div class="mb-3">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="instructionSearch"
                                                    placeholder="Search Instructions">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearInstructionSearch">✖</button>
                                                <button type="button" class="btn btn-outline-primary d-none"
                                                    id="addInstruction">+ Add</button>
                                            </div>
                                        </div>
                                        <div id="instructionList">
                                            <?php if (!empty($instructionsList)): ?>
                                                <?php foreach ($instructionsList as $ins): ?>
                                                    <div class="form-check instruction-item">
                                                        <input class="form-check-input" type="checkbox" name="instructions[]"
                                                            value="<?php echo htmlspecialchars($ins['instructionsName']); ?>"
                                                            id="ins<?php echo $ins['id']; ?>">
                                                        <label class="form-check-label" for="ins<?php echo $ins['id']; ?>">
                                                            <?php echo htmlspecialchars($ins['instructionsName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
                                    <p class="text-muted mb-0">Drag and drop files here, or click the button below.</p>
                                </div>
                                <input type="file" class="fileInput d-none" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    multiple>
                                <input type="file" class="submitFileInput d-none" name="consultationFiles[]" multiple>
                                <div class="fileList" style="margin-top: 0.5rem;"></div>
                                <div class="fileError text-danger pt-1"></div>
                                <input type="hidden" class="removedFiles" name="removedFiles" value="">
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

                            <button type="submit" id="submitForm" class="mt-2 float-end btn text-light"
                                style="background-color: #00ad8e;">Save as new</button>
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
                                    </a> | <?php echo $value['gender'] ?> | <?php echo $value['age'] ?> Year(s)
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                name="patientHeight" step="0.1" min="0" placeholder="E.g. 135"
                                                value="<?= isset($vitals['height_cm']) ? $vitals['height_cm'] : '' ?>">
                                            <p class="mx-2 my-2">Cm</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                name="patientWeight" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['weight_kg']) ? $vitals['weight_kg'] : '' ?>">
                                            <p class="mx-2 my-2">Kg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientWeight">Systolic BP
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120" step="0.1" min="0"
                                                value="<?= isset($vitals['systolic_bp']) ? $vitals['systolic_bp'] : '' ?>">
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientHeight">Diastolic BP</label>
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientsHbA1c">HbA1c</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientsHbA1c"
                                                name="patientsHbA1c" step="0.1" min="0" placeholder="E.g. 5.5"
                                                value="<?= isset($vitals['HbA1c_percent']) ? $vitals['HbA1c_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                name="patientSpo2" step="0.1" min="0" placeholder="E.g. 98"
                                                value="<?= isset($vitals['spo2_percent']) ? $vitals['spo2_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
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
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" step="0.1" min="0" step="0.01"
                                                placeholder="E.g. 98.6"
                                                value="<?= isset($vitals['temperature_f']) ? $vitals['temperature_f'] : '' ?>">
                                            <p class="mx-2 my-2">°F</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <label class="form-label fieldLabel" for="patientSpo2">Blood Sugar (PP) </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="ppBsugar"
                                                value="<?= isset($vitals['blood_sugar_pp']) ? $vitals['blood_sugar_pp'] : '' ?>"
                                                name="ppBsugar" step="0.1" min="0" placeholder="E.g. 100">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="symptomsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="symptomsSearchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="symptomsSuggestionsBox"></div>
                                            </div>
                                            <div id="symptomsList" class="mt-2"></div>
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="findingsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="searchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="suggestionsBox"></div>
                                            </div>
                                            <div id="findingsList" class="mt-2"></div>
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
                                        <div class="mb-3 position-relative">
                                            <div class="tags-input" id="diagnosisInputBox">
                                                <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                    id="diagnosisInput" placeholder="Search or type to add diagnosis..." />
                                            </div>
                                            <div class="suggestions-box" id="diagnosisSuggestionsBox"></div>
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
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="investigationsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="investigationsSearchInput"
                                                        placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="investigationsSuggestionsBox"></div>
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
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="procedureSearch"
                                                placeholder="Search Instructions">
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="clearProcedureSearch">✖</button>
                                            <button type="button" class="btn btn-outline-primary d-none" id="addProcedure">+
                                                Add</button>
                                        </div>
                                        <div id="procedureList">
                                            <?php if (!empty($proceduresList)): ?>
                                                <?php foreach ($proceduresList as $pro): ?>
                                                    <div class="form-check procedure-item">
                                                        <input class="form-check-input" type="checkbox" name="procedures[]"
                                                            value="<?php echo htmlspecialchars($pro['proceduresName']); ?>"
                                                            id="pro<?php echo $pro['id']; ?>">
                                                        <label class="form-check-label" for="pro<?php echo $pro['id']; ?>">
                                                            <?php echo htmlspecialchars($pro['proceduresName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Medicine section -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button"
                                        data-bs-toggle="collapse" data-bs-target="#medicinesCollapse">
                                        <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2" id="medicinesCollapse">
                                        <div id="medicinesWrapper">
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="medicinesInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="medicinesSearchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="medicinesSuggestionsBox"></div>
                                            </div>
                                            <div id="medicinesList" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="medicinesJson" id="medicinesJson">

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong><i class="bi bi-chat-square-text me-2"></i>
                                                Advice</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>

                                    <div class="collapse field-container mt-2">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="adviceSearch"
                                                placeholder="Search Advice">
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="clearAdviceSearch">✖</button>
                                            <button type="button" class="btn btn-outline-primary d-none" id="addAdvice">+
                                                Add</button>
                                        </div>
                                        <div id="adviceList">
                                            <?php if (!empty($advicesList)): ?>
                                                <?php foreach ($advicesList as $adv): ?>
                                                    <div class="form-check advice-item">
                                                        <input class="form-check-input" type="checkbox" name="advices[]"
                                                            value="<?php echo htmlspecialchars($adv['adviceName']); ?>"
                                                            id="adv<?php echo $adv['id']; ?>">
                                                        <label class="form-check-label" for="adv<?php echo $adv['id']; ?>">
                                                            <?php echo htmlspecialchars($adv['adviceName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
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
                                        <div class="mb-3">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" id="instructionSearch"
                                                    placeholder="Search Instructions">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="clearInstructionSearch">✖</button>
                                                <button type="button" class="btn btn-outline-primary d-none"
                                                    id="addInstruction">+ Add</button>
                                            </div>
                                        </div>
                                        <div id="instructionList">
                                            <?php if (!empty($instructionsList)): ?>
                                                <?php foreach ($instructionsList as $ins): ?>
                                                    <div class="form-check instruction-item">
                                                        <input class="form-check-input" type="checkbox" name="instructions[]"
                                                            value="<?php echo htmlspecialchars($ins['instructionsName']); ?>"
                                                            id="ins<?php echo $ins['id']; ?>">
                                                        <label class="form-check-label" for="ins<?php echo $ins['id']; ?>">
                                                            <?php echo htmlspecialchars($ins['instructionsName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
                                    <p class="text-muted mb-0">Drag and drop files here, or click the button below.
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

                            <button type="submit" id="submitForm" class="mt-2 float-end btn text-light"
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

        <!-- Medicine Modal -->

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
    </div>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

    </main>

    <!-- ******************************************************************************************************************************************** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Consultation date and time default -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const timeSelect = document.getElementById("consultTime");
            const dateInput = document.getElementById("consultDate");
            const method = "<?= isset($method) ? $method : '' ?>";
            const phpDate = method !== "consultDashboard"
                ? "<?= isset($consultation['consult_date']) ? $consultation['consult_date'] : '' ?>" : "";
            const phpTime = method !== "consultDashboard"
                ? "<?= isset($consultation['consult_time']) ? $consultation['consult_time'] : '' ?>" : "";

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
                timeSelect.value = phpTime;
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

    <!-- Symptoms Modal Script -->
    <script>
        const symptomsList = <?php echo json_encode(array_column($symptomsList, 'symptomsName')); ?>;

        const symptomsInput = document.getElementById("symptomsSearchInput");
        const symptomsSuggestionsBox = document.getElementById("symptomsSuggestionsBox");
        const symptomsTagContainer = document.getElementById("symptomsInput");

        const symptomsModal = new bootstrap.Modal(document.getElementById("symptomsModal"));
        const symptomNote = document.getElementById("symptomNote");
        const symptomSince = document.getElementById("symptomSince");
        const symptomSeverity = document.getElementById("symptomSeverity");
        const symptomsModalTitle = document.getElementById("symptomsModalTitle");

        let selectedSymptoms = [];
        let pendingSymptom = "";
        let editingSymptomTag = null;

        function renderSymptomsSuggestions() {
            const query = symptomsInput.value.trim();
            const queryLower = query.toLowerCase();
            symptomsSuggestionsBox.innerHTML = "";

            const filtered = symptomsList.filter(s =>
                s.toLowerCase().includes(queryLower) &&
                !selectedSymptoms.some(obj => obj.symptom === s)
            );

            if (filtered.length === 0 && query !== "") {
                const customOption = document.createElement("div");
                customOption.innerHTML = `Add "<strong>${query}</strong>"`;
                customOption.onclick = () => {
                    openSymptomModal(query);
                    symptomsInput.value = "";
                };
                symptomsSuggestionsBox.appendChild(customOption);
            } else {
                filtered.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.onclick = () => {
                        openSymptomModal(item);
                        symptomsInput.value = "";
                    };
                    symptomsSuggestionsBox.appendChild(div);
                });
            }

            symptomsSuggestionsBox.style.display = "block";
        }

        function openSymptomModal(tagName, existing = null, tagEl = null) {
            pendingSymptom = tagName;
            editingSymptomTag = tagEl;

            symptomsModalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
            symptomNote.value = existing?.note || "";
            symptomSince.value = existing?.since || "";
            symptomSeverity.value = existing?.severity || "";

            symptomsModal.show();
        }

        function saveSymptomModal() {
            const note = symptomNote.value.trim();
            const since = symptomSince.value.trim();
            const severity = symptomSeverity.value;

            if (!pendingSymptom) return;

            const existingIndex = selectedSymptoms.findIndex(s => s.symptom === pendingSymptom);

            if (!symptomsList.includes(pendingSymptom)) {
                fetch("<?= site_url('Consultation/addSymptom') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(pendingSymptom)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            symptomsList.push(pendingSymptom);
                        } else {
                            console.error("Error saving new symptom", data);
                        }
                    })
                    .catch(err => console.error(err));
            }

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

            tag.onclick = () => {
                openSymptomModal(data.symptom, data, tag);
            };

            symptomsTagContainer.insertBefore(tag, symptomsInput);
        }

        function updateSymptomTagDisplay(tagEl, data) {
            const textParts = [data.symptom];
            const details = [];

            if (data.note) details.push(`Note: ${data.note}`);
            if (data.since) details.push(`Since: ${data.since}`);
            if (data.severity) details.push(`Severity: ${data.severity}`);

            if (details.length > 0) {
                textParts.push(`(${details.join(", ")})`);
            }

            tagEl.innerHTML = textParts.join(" ");
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "text-light ms-2";
            removeBtn.innerHTML = "&times;";
            removeBtn.style.fontSize = "1rem";
            removeBtn.style.border = "none";
            removeBtn.style.background = "transparent";
            removeBtn.onclick = (e) => {
                e.stopPropagation();
                tagEl.remove();
                selectedSymptoms = selectedSymptoms.filter(s => s.symptom !== data.symptom);
                updateHiddenInput();
            };
            tagEl.appendChild(removeBtn);
            tagEl.setAttribute("data-id", data.id || "new");
        }

        function updateHiddenInput() {
            document.getElementById("symptomsJson").value = JSON.stringify(selectedSymptoms);
        }

        symptomsInput.addEventListener("input", renderSymptomsSuggestions);
        symptomsInput.addEventListener("focus", renderSymptomsSuggestions);
        symptomsInput.addEventListener("keydown", e => {
            if (e.key === "Enter" && symptomsInput.value.trim() !== "") {
                e.preventDefault();
                openSymptomModal(symptomsInput.value.trim());
                symptomsInput.value = "";
            }
        });

        document.addEventListener("click", (e) => {
            if (!symptomsTagContainer.contains(e.target)) {
                symptomsSuggestionsBox.style.display = "none";
            }
        });

        renderSymptomsSuggestions();

        document.addEventListener("DOMContentLoaded", () => {
            const preloadSymptoms = <?php echo isset($symptoms) ? json_encode($symptoms) : '[]'; ?>;

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

    <!-- Symptoms save script -->
    <script>
        $(document).ready(function () {
            function parseSymptomTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim();

                // Extract symptom and optional details
                let match = text.match(/^(.+?)\s*\((.+)\)$/);
                if (match) {
                    let symptom = match[1].trim();
                    let detailsStr = match[2].trim();
                    let details = detailsStr.split(',').map(d => d.trim());

                    let parsed = {
                        symptom: symptom,
                        note: '',
                        since: '',
                        severity: ''
                    };

                    details.forEach(detail => {
                        let kv = detail.split(':').map(s => s.trim());
                        if (kv.length === 2) {
                            let key = kv[0].toLowerCase();
                            let value = kv[1];
                            if (key === 'note') parsed.note = value;
                            else if (key === 'since') parsed.since = value;
                            else if (key === 'severity') parsed.severity = value;
                        }
                    });

                    return parsed;
                } else {
                    return {
                        symptom: text,
                        note: '',
                        since: '',
                        severity: ''
                    };
                }

                return null;
            }

            function updateSymptomsJson() {
                let symptoms = [];
                $('#symptomsInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim();
                    let symptom = parseSymptomTagText(tagText);

                    if (symptom) {
                        let symptomId = $(this).attr('data-id') || "new";
                        symptom.id = symptomId;
                        symptoms.push(symptom);
                    }
                });
                $('#symptomsJson').val(JSON.stringify(symptoms));
            }

            const observer = new MutationObserver(updateSymptomsJson);
            observer.observe(document.getElementById('symptomsInput'), { childList: true, subtree: true });

            $('#consultationForm').on('submit', function (e) {
                updateSymptomsJson();
            });
        });
    </script>

    <!-- Finding Modal Script -->
    <script>
        const findingsList = <?php echo json_encode(array_column($findingsList, 'findingsName')); ?>;

        const findingsInput = document.getElementById("searchInput");
        const suggestionsBox = document.getElementById("suggestionsBox");
        const tagContainer = document.getElementById("findingsInput");

        const modal = new bootstrap.Modal(document.getElementById("inputModal"));
        const modalNote = document.getElementById("modalNote");
        const modalSince = document.getElementById("modalSince");
        const modalSeverity = document.getElementById("modalSeverity");
        const modalTitle = document.getElementById("modalTitle");

        let selectedFindings = [];
        let pendingTag = "";
        let editingTagEl = null;

        function renderSuggestions() {
            const query = findingsInput.value.trim();
            const queryLower = query.toLowerCase();
            suggestionsBox.innerHTML = "";

            const filtered = findingsList.filter(f =>
                f.toLowerCase().includes(queryLower) &&
                !selectedFindings.some(obj => obj.finding === f)
            );

            if (filtered.length === 0 && query !== "") {
                const customOption = document.createElement("div");
                customOption.innerHTML = `Add "<strong>${query}</strong>"`;
                customOption.onclick = () => {
                    openModal(query);
                    findingsInput.value = "";
                };
                suggestionsBox.appendChild(customOption);
            } else {
                filtered.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.onclick = () => {
                        openModal(item);
                        findingsInput.value = "";
                    };
                    suggestionsBox.appendChild(div);
                });
            }

            suggestionsBox.style.display = "block";
        }

        function openModal(tagName, existing = null, tagEl = null) {
            pendingTag = tagName;
            editingTagEl = tagEl;

            modalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
            modalNote.value = existing?.note || "";
            modalSince.value = existing?.since || "";
            modalSeverity.value = existing?.severity || "";

            modal.show();
        }

        function saveModal() {
            const note = modalNote.value.trim();
            const since = modalSince.value.trim();
            const severity = modalSeverity.value;

            if (!pendingTag) return;

            const existingIndex = selectedFindings.findIndex(f => f.finding === pendingTag);

            if (!findingsList.includes(pendingTag)) {
                fetch("<?= site_url('Consultation/addFinding') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(pendingTag)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            findingsList.push(pendingTag); // add to available list
                        } else {
                            console.error("Error saving new finding", data);
                        }
                    })
                    .catch(err => console.error(err));
            }

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

            tag.onclick = () => {
                openModal(data.finding, data, tag);
            };

            tagContainer.insertBefore(tag, findingsInput);
        }

        function updateTagDisplay(tagEl, data) {
            const textParts = [data.finding];
            const details = [];

            if (data.note) details.push(`Note: ${data.note}`);
            if (data.since) details.push(`Since: ${data.since}`);
            if (data.severity) details.push(`Severity: ${data.severity}`);

            if (details.length > 0) {
                textParts.push(`(${details.join(", ")})`);
            }

            tagEl.innerHTML = textParts.join(" ");
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "text-light ms-2";
            removeBtn.innerHTML = "&times;";
            removeBtn.style.fontSize = "1rem";
            removeBtn.style.border = "none";
            removeBtn.style.background = "transparent";
            removeBtn.onclick = (e) => {
                e.stopPropagation();
                tagEl.remove();
                selectedFindings = selectedFindings.filter(f => f.finding !== data.finding);
                updateHiddenInput();
            };
            tagEl.appendChild(removeBtn);
            tagEl.setAttribute("data-id", data.id || "new");
        }

        function updateHiddenInput() {
            document.getElementById("findingsJson").value = JSON.stringify(selectedFindings);
        }

        findingsInput.addEventListener("input", renderSuggestions);
        findingsInput.addEventListener("focus", renderSuggestions);
        findingsInput.addEventListener("keydown", e => {
            if (e.key === "Enter" && findingsInput.value.trim() !== "") {
                e.preventDefault();
                openModal(findingsInput.value.trim());
                findingsInput.value = "";
            }
        });

        document.addEventListener("click", (e) => {
            if (!tagContainer.contains(e.target)) {
                suggestionsBox.style.display = "none";
            }
        });

        renderSuggestions();

        document.addEventListener("DOMContentLoaded", () => {
            const preloadFindings = <?php echo isset($findings) ? json_encode($findings) : '[]'; ?>;

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

    <!-- Findings save script -->
    <script>
        $(document).ready(function () {
            function parseTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim(); // Remove remove button if any

                let finding, note = '', since = '', severity = '';

                const match = text.match(/^(.+?)(?:\s*\((.*)\))?$/);

                if (match) {
                    finding = match[1].trim();

                    if (match[2]) {
                        const details = match[2].split(', ').map(d => d.trim());

                        details.forEach(detail => {
                            const [key, value] = detail.split(': ', 2);
                            if (key === 'Note') note = value || '';
                            else if (key === 'Since') since = value || '';
                            else if (key === 'Severity') severity = value || '';
                        });
                    }
                } else {
                    finding = text;
                }

                return { finding, note, since, severity };
            }

            function updateFindingsJson() {
                let findings = [];
                $('#findingsInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim();
                    let finding = parseTagText(tagText);
                    if (finding) {
                        let findingId = $(this).attr('data-id') || "new";
                        finding.id = findingId;
                        findings.push(finding);
                    }
                });
                $('#findingsJson').val(JSON.stringify(findings));
                console.log('Findings JSON updated:', $('#findingsJson').val()); // Debug
            }

            const observer = new MutationObserver(updateFindingsJson);
            observer.observe(document.getElementById('findingsInput'), { childList: true, subtree: true });

            $('#consultationForm').on('submit', function (e) {
                updateFindingsJson(); // Ensure latest data
                console.log('Form submitting with findingsJson:', $('#findingsJson').val()); // Debug
            });
        });
    </script>

    <!-- Diagonsis Modal Script -->
    <script>
        const diagnosisList = <?php echo json_encode(array_column($diagnosisList, 'diagnosisName')); ?>;

        const diagnosisInput = document.getElementById("diagnosisInput");
        const diagnosisSuggestionsBox = document.getElementById("diagnosisSuggestionsBox");
        const diagnosisTagContainer = document.getElementById("diagnosisInputBox");

        const diagnosisModal = new bootstrap.Modal(document.getElementById("diagnosisModal"));
        const diagnosisNote = document.getElementById("diagnosisNote");
        const diagnosisSince = document.getElementById("diagnosisSince");
        const diagnosisSeverity = document.getElementById("diagnosisSeverity");
        const diagnosisModalTitle = document.querySelector('#diagnosisModal .modal-title');

        let selectedDiagnosis = [];
        let pendingDiagnosis = "";
        let editingDiagnosisTag = null;

        function renderDiagnosisSuggestions() {
            const query = diagnosisInput.value.trim();
            const queryLower = query.toLowerCase();

            diagnosisSuggestionsBox.innerHTML = "";

            const filtered = diagnosisList.filter(d =>
                d.toLowerCase().includes(queryLower) &&
                !selectedDiagnosis.some(obj => obj.name === d)
            );

            if (filtered.length === 0 && query !== "") {
                const customOption = document.createElement("div");
                customOption.innerHTML = `Add "<strong>${query}</strong>"`;
                customOption.onclick = () => {
                    openDiagnosisModal(query);
                    diagnosisInput.value = "";
                };
                diagnosisSuggestionsBox.appendChild(customOption);
            } else {
                filtered.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.onclick = () => {
                        openDiagnosisModal(item);
                        diagnosisInput.value = "";
                    };
                    diagnosisSuggestionsBox.appendChild(div);
                });
            }

            diagnosisSuggestionsBox.style.display = "block";
        }

        function openDiagnosisModal(name, existing = null, tagEl = null) {
            pendingDiagnosis = name;
            editingDiagnosisTag = tagEl;

            diagnosisModalTitle.textContent = existing
                ? `Edit Diagnosis: ${name}`
                : `Diagnosis Details for: ${name}`;

            diagnosisNote.value = existing?.note || "";
            diagnosisSince.value = existing?.since || "";
            diagnosisSeverity.value = existing?.severity || "";

            diagnosisModal.show();
        }

        function saveDiagnosisModal() {
            const note = diagnosisNote.value.trim();
            const since = diagnosisSince.value.trim();
            const severity = diagnosisSeverity.value;

            if (!pendingDiagnosis) return;

            if (!diagnosisList.includes(pendingDiagnosis)) {
                fetch("<?= site_url('Consultation/addDiagnosis') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(pendingDiagnosis)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            diagnosisList.push(pendingDiagnosis);
                        } else {
                            console.error("Error saving new diagnosis", data);
                        }
                    })
                    .catch(err => console.error(err));
            }

            const existingIndex = selectedDiagnosis.findIndex(d => d.name === pendingDiagnosis);

            if (editingDiagnosisTag && existingIndex !== -1) {
                // Update existing diagnosis
                let existingId = selectedDiagnosis[existingIndex].id || "new";
                selectedDiagnosis[existingIndex] = { id: existingId, name: pendingDiagnosis, note, since, severity };
                updateDiagnosisTag(editingDiagnosisTag, selectedDiagnosis[existingIndex]);
                editingDiagnosisTag.setAttribute("data-id", existingId);
            } else {
                // New diagnosis → id="new"
                const data = { id: "new", name: pendingDiagnosis, note, since, severity };
                selectedDiagnosis.push(data);
                addDiagnosisTag(data);
            }

            diagnosisModal.hide();
            pendingDiagnosis = "";
            editingDiagnosisTag = null;
            updateDiagnosisHidden();
        }

        function addDiagnosisTag(data) {
            const tag = document.createElement("span");
            tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
            tag.style.cursor = "pointer";

            // Attach id to tag
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

            // click = edit
            tag.onclick = () => {
                openDiagnosisModal(data.name, data, tag);
            };

            diagnosisTagContainer.insertBefore(tag, diagnosisInput);
        }

        function updateDiagnosisTag(tagEl, data) {
            const textParts = [data.name];
            const details = [];

            if (data.note) details.push(`Note: ${data.note}`);
            if (data.since) details.push(`Since: ${data.since}`);
            if (data.severity) details.push(`Severity: ${data.severity}`);

            if (details.length > 0) {
                textParts.push(`(${details.join(", ")})`);
            }

            tagEl.innerHTML = textParts.join(" ");
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "text-light ms-2";
            removeBtn.innerHTML = "&times;";
            removeBtn.style.fontSize = "1rem";
            removeBtn.style.border = "none";
            removeBtn.style.background = "transparent";
            removeBtn.onclick = (e) => {
                e.stopPropagation();
                tagEl.remove();
                selectedDiagnosis = selectedDiagnosis.filter(d => d.name !== data.name);
                updateDiagnosisHidden();
            };
            tagEl.appendChild(removeBtn);
            tagEl.setAttribute("data-id", data.id || "new");
        }

        function updateDiagnosisHidden() {
            document.getElementById("diagnosisJson").value = JSON.stringify(selectedDiagnosis);
        }

        // Input events
        diagnosisInput.addEventListener("input", renderDiagnosisSuggestions);
        diagnosisInput.addEventListener("focus", renderDiagnosisSuggestions);
        diagnosisInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter" && diagnosisInput.value.trim()) {
                e.preventDefault();
                openDiagnosisModal(diagnosisInput.value.trim());
                diagnosisInput.value = "";
            }
        });

        document.addEventListener("click", (e) => {
            if (!diagnosisTagContainer.contains(e.target)) {
                diagnosisSuggestionsBox.style.display = "none";
            }
        });

        renderDiagnosisSuggestions();

        // Preload existing diagnoses in edit mode
        document.addEventListener("DOMContentLoaded", () => {
            const preloadDiagnosis = <?php echo isset($diagnosis) ? json_encode($diagnosis) : '[]'; ?>;

            if (preloadDiagnosis.length > 0) {
                preloadDiagnosis.forEach(item => {
                    const data = {
                        id: item.id || "", // Preserve diagnosis ID for edit mode
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

    <!-- Diagnosis save script -->
    <script>
        $(document).ready(function () {
            function parseDiagnosisTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim();

                let name, note = '', since = '', severity = '';

                const match = text.match(/^(.+?)(?:\s*\((.*)\))?$/);

                if (match) {
                    name = match[1].trim();

                    if (match[2]) {
                        const details = match[2].split(', ').map(d => d.trim());

                        details.forEach(detail => {
                            const [key, value] = detail.split(': ', 2);
                            if (key === 'Note') note = value || '';
                            else if (key === 'Since') since = value || '';
                            else if (key === 'Severity') severity = value || '';
                        });
                    }
                } else {
                    name = text;
                }

                return { name, note, since, severity };
            }

            function updateDiagnosisJson() {
                let diagnoses = [];
                $('#diagnosisInputBox > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim(); // Get text without child elements (e.g., remove button)
                    let diagnosis = parseDiagnosisTagText(tagText);
                    if (diagnosis) {
                        let diagnosisId = $(this).attr('data-id') || "new"; // Read ID or mark as new
                        diagnosis.id = diagnosisId;
                        diagnoses.push(diagnosis);
                    }
                });
                $('#diagnosisJson').val(JSON.stringify(diagnoses));
                console.log('Diagnosis JSON updated:', $('#diagnosisJson').val()); // Debug
            }

            const diagnosisObserver = new MutationObserver(updateDiagnosisJson);
            diagnosisObserver.observe(document.getElementById('diagnosisInputBox'), { childList: true, subtree: true });

            $('#consultationForm').on('submit', function (e) {
                updateDiagnosisJson(); // Ensure latest data
                console.log('Form submitting with diagnosisJson:', $('#diagnosisJson').val()); // Debug
            });
        });
    </script>

    <!-- Investigation Search Button -->
    <script>
        const investigationsList = <?php echo json_encode(array_column($investigationsList, 'investigationsName')); ?>;

        const investigationsInput = document.getElementById("investigationsSearchInput");
        const investigationsSuggestionsBox = document.getElementById("investigationsSuggestionsBox");
        const investigationsTagContainer = document.getElementById("investigationsInput");

        const investigationsModal = new bootstrap.Modal(document.getElementById("investigationsModal"));
        const investigationNote = document.getElementById("investigationNote");
        const investigationsModalTitle = document.getElementById("investigationsModalTitle");

        let selectedInvestigations = [];
        let pendingInvestigation = "";
        let editingInvestigationTag = null;

        function renderInvestigationsSuggestions() {
            const query = investigationsInput.value.trim();
            const queryLower = query.toLowerCase();
            investigationsSuggestionsBox.innerHTML = "";

            const filtered = investigationsList.filter(s =>
                s.toLowerCase().includes(queryLower) &&
                !selectedInvestigations.some(obj => obj.investigation === s)
            );

            if (filtered.length === 0 && query !== "") {
                const customOption = document.createElement("div");
                customOption.innerHTML = `Add "<strong>${query}</strong>"`;
                customOption.onclick = () => {
                    openInvestigationModal(query);
                    investigationsInput.value = "";
                };
                investigationsSuggestionsBox.appendChild(customOption);
            } else {
                filtered.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.onclick = () => {
                        openInvestigationModal(item);
                        investigationsInput.value = "";
                    };
                    investigationsSuggestionsBox.appendChild(div);
                });
            }

            investigationsSuggestionsBox.style.display = "block";
        }

        function openInvestigationModal(tagName, existing = null, tagEl = null) {
            pendingInvestigation = tagName;
            editingInvestigationTag = tagEl;

            investigationsModalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
            investigationNote.value = existing?.note || "";

            investigationsModal.show();
        }

        function saveInvestigationModal() {
            const note = investigationNote.value.trim();

            if (!pendingInvestigation) return;

            const existingIndex = selectedInvestigations.findIndex(s => s.investigation === pendingInvestigation);

            if (!investigationsList.includes(pendingInvestigation)) {
                fetch("<?= site_url('Consultation/addInvestigation') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(pendingInvestigation)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            investigationsList.push(pendingInvestigation);
                        } else {
                            console.error("Error saving new investigation", data);
                        }
                    })
                    .catch(err => console.error(err));
            }

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

            tag.onclick = () => {
                openInvestigationModal(data.investigation, data, tag);
            };

            investigationsTagContainer.insertBefore(tag, investigationsInput);
        }

        function updateInvestigationTagDisplay(tagEl, data) {
            const textParts = [data.investigation];
            const details = [];

            if (data.note) details.push(`Note: ${data.note}`);

            if (details.length > 0) {
                textParts.push(`(${details.join(", ")})`);
            }

            tagEl.innerHTML = textParts.join(" ");
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "text-light ms-2";
            removeBtn.innerHTML = "&times;";
            removeBtn.style.fontSize = "1rem";
            removeBtn.style.border = "none";
            removeBtn.style.background = "transparent";
            removeBtn.onclick = (e) => {
                e.stopPropagation();
                tagEl.remove();
                selectedInvestigations = selectedInvestigations.filter(s => s.investigation !== data.investigation);
                updateInvestigationHiddenInput();
            };
            tagEl.appendChild(removeBtn);
            tagEl.setAttribute("data-id", data.id || "new");
        }

        function updateInvestigationHiddenInput() {
            document.getElementById("investigationsJson").value = JSON.stringify(selectedInvestigations);
        }

        investigationsInput.addEventListener("input", renderInvestigationsSuggestions);
        investigationsInput.addEventListener("focus", renderInvestigationsSuggestions);
        investigationsInput.addEventListener("keydown", e => {
            if (e.key === "Enter" && investigationsInput.value.trim() !== "") {
                e.preventDefault();
                openInvestigationModal(investigationsInput.value.trim());
                investigationsInput.value = "";
            }
        });

        document.addEventListener("click", (e) => {
            if (!investigationsTagContainer.contains(e.target)) {
                investigationsSuggestionsBox.style.display = "none";
            }
        });

        renderInvestigationsSuggestions();

        document.addEventListener("DOMContentLoaded", () => {
            const preloadInvestigations = <?php echo isset($investigations) ? json_encode($investigations) : '[]'; ?>;

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

    <!-- Investigation save script -->
    <script>
        $(document).ready(function () {
            function parseInvestigationTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim();

                let match = text.match(/^(.+?)\s*\((.+)\)$/);
                if (match) {
                    let investigation = match[1].trim();
                    let detailsStr = match[2].trim();

                    let parsed = {
                        investigation: investigation,
                        note: ''
                    };

                    if (detailsStr.toLowerCase().startsWith("note:")) {
                        parsed.note = detailsStr.split(":")[1].trim();
                    }

                    return parsed;
                } else {
                    return { investigation: text, note: '' };
                }
            }

            function updateInvestigationsJson() {
                let investigations = [];
                $('#investigationsInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim();
                    let investigation = parseInvestigationTagText(tagText);

                    if (investigation) {
                        let investigationId = $(this).attr('data-id') || "new";
                        investigation.id = investigationId;
                        investigations.push(investigation);
                    }
                });
                $('#investigationsJson').val(JSON.stringify(investigations));
            }

            const observer = new MutationObserver(updateInvestigationsJson);
            observer.observe(document.getElementById('investigationsInput'), { childList: true, subtree: true });

            $('#consultationForm').on('submit', function () {
                updateInvestigationsJson();
            });
        });
    </script>

    <!-- Instruction Search Button -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('instructionSearch');
            const clearBtn = document.getElementById('clearInstructionSearch');
            const addBtn = document.getElementById('addInstruction');
            const list = document.getElementById('instructionList');
            const modalEl = document.getElementById('addInstructionModal');
            const modal = (window.bootstrap && bootstrap.Modal) ? new bootstrap.Modal(modalEl) : null;
            const newInstructionInput = document.getElementById('newInstructionName');
            const addForm = document.getElementById('addInstructionForm');

            const preloadInstructions = <?php echo isset($instructions) ? json_encode($instructions) : '[]'; ?>;

            function norm(s) { return s.toLowerCase().trim(); }

            function filter() {
                const q = norm(searchInput.value);
                let matches = 0;
                list.querySelectorAll('.instruction-item').forEach(item => {
                    const labelText = item.querySelector('label').textContent;
                    const show = norm(labelText).includes(q) || q === '';
                    item.classList.toggle('d-none', !show);
                    if (show) matches++;
                });
                addBtn.classList.toggle('d-none', !(q && matches === 0));
            }

            searchInput.addEventListener('input', filter);

            clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                filter();
                searchInput.focus();
            });

            addBtn.addEventListener('click', () => {
                newInstructionInput.value = searchInput.value.trim();
                if (modal) { modal.show(); }
                else { modalEl.classList.add('show'); modalEl.style.display = 'block'; }
            });

            addForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = newInstructionInput.value.trim();
                if (!name) return;

                fetch("<?= site_url('Consultation/addInstruction') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(name)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'form-check instruction-item';
                            wrapper.innerHTML = `
                    <input class="form-check-input" type="checkbox" 
                           name="instructions[]" 
                           value="${data.name}" 
                           id="ins${data.id}" checked>
                    <label class="form-check-label" for="ins${data.id}">${data.name}</label>
                `;
                            list.prepend(wrapper);

                            if (modal) { modal.hide(); }
                            searchInput.value = '';
                            filter();
                        } else {
                            alert(data.message || "Error saving instruction");
                        }
                    })
                    .catch(err => console.error(err));
            });

            if (Array.isArray(preloadInstructions)) {
                preloadInstructions.forEach(ins => {
                    const checkbox = list.querySelector(
                        `input[type="checkbox"][value="${ins.instruction_name}"]`
                    );
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }

            filter();
        });
    </script>

    <!-- Procedure Search Button -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('procedureSearch');
            const clearBtn = document.getElementById('clearProcedureSearch');
            const addBtn = document.getElementById('addProcedure');
            const list = document.getElementById('procedureList');
            const modalEl = document.getElementById('addProcedureModal');
            const modal = (window.bootstrap && bootstrap.Modal) ? new bootstrap.Modal(modalEl) : null;
            const newProcedureInput = document.getElementById('newProcedureName');
            const addForm = document.getElementById('addProcedureForm');

            const preloadProcedures = <?php echo isset($procedures) ? json_encode($procedures) : '[]'; ?>;

            function norm(s) { return s.toLowerCase().trim(); }

            function filter() {
                const q = norm(searchInput.value);
                let matches = 0;
                list.querySelectorAll('.procedure-item').forEach(item => {
                    const labelText = item.querySelector('label').textContent;
                    const show = norm(labelText).includes(q) || q === '';
                    item.classList.toggle('d-none', !show);
                    if (show) matches++;
                });
                addBtn.classList.toggle('d-none', !(q && matches === 0));
            }

            searchInput.addEventListener('input', filter);

            clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                filter();
                searchInput.focus();
            });

            addBtn.addEventListener('click', () => {
                newProcedureInput.value = searchInput.value.trim();
                if (modal) { modal.show(); }
                else { modalEl.classList.add('show'); modalEl.style.display = 'block'; }
            });

            addForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = newProcedureInput.value.trim();
                if (!name) return;

                fetch("<?= site_url('Consultation/addProcedure') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(name)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'form-check procedure-item';
                            wrapper.innerHTML = `
                    <input class="form-check-input" type="checkbox" 
                           name="procedures[]" 
                           value="${data.name}" 
                           id="pro${data.id}" checked>
                    <label class="form-check-label" for="pro${data.id}">${data.name}</label>
                `;
                            list.prepend(wrapper);

                            if (modal) { modal.hide(); }
                            searchInput.value = '';
                            filter();
                        } else {
                            alert(data.message || "Error saving procedure");
                        }
                    })
                    .catch(err => console.error(err));
            });

            if (Array.isArray(preloadProcedures)) {
                preloadProcedures.forEach(pro => {
                    const checkbox = list.querySelector(
                        `input[type="checkbox"][value="${pro.procedure_name}"]`
                    );
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }

            filter();
        });
    </script>

    <!-- Advice search and add script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const adviceSearch = document.getElementById('adviceSearch');
            const clearAdviceSearch = document.getElementById('clearAdviceSearch');
            const addAdvice = document.getElementById('addAdvice');
            const adviceList = document.getElementById('adviceList');

            const preloadAdvices = <?php echo isset($advices) ? json_encode($advices) : '[]'; ?>;

            function norm(s) { return (s || '').toLowerCase().trim(); }

            function filter() {
                const q = norm(adviceSearch.value);
                let matches = 0;
                adviceList.querySelectorAll('.advice-item').forEach(item => {
                    const labelText = item.querySelector('label').textContent;
                    const show = norm(labelText).includes(q) || q === '';
                    item.classList.toggle('d-none', !show);
                    if (show) matches++;
                });
                addAdvice.classList.toggle('d-none', !(q && matches === 0));
            }

            adviceSearch.addEventListener('input', filter);

            clearAdviceSearch.addEventListener('click', () => {
                adviceSearch.value = '';
                filter();
                adviceSearch.focus();
            });

            addAdvice.addEventListener('click', () => {
                const newAdvice = adviceSearch.value.trim();
                if (!newAdvice) return;

                const id = 'adv-' + Date.now();
                const div = document.createElement('div');
                div.className = 'form-check advice-item';
                div.innerHTML = `
            <input class="form-check-input" type="checkbox" 
                   name="advices[]" 
                   value="${newAdvice}" 
                   id="${id}" checked>
            <label class="form-check-label" for="${id}">${newAdvice}</label>
        `;
                adviceList.prepend(div);

                const checkbox = div.querySelector('input');
                checkbox.addEventListener('change', () => {
                    if (!checkbox.checked) {
                        div.remove();
                    }
                });

                adviceSearch.value = '';
                filter();
            });

            if (Array.isArray(preloadAdvices)) {
                preloadAdvices.forEach(adv => {
                    const dbName = norm(adv.advice_name || adv);
                    let matched = false;

                    adviceList.querySelectorAll('.advice-item input[type="checkbox"]').forEach(cb => {
                        if (norm(cb.value) === dbName) {
                            cb.checked = true;
                            matched = true;
                        }
                    });

                    if (!matched && dbName) {
                        const id = 'adv-pre-' + Date.now();
                        const div = document.createElement('div');
                        div.className = 'form-check advice-item';
                        div.innerHTML = `
                    <input class="form-check-input" type="checkbox" 
                           name="advices[]" 
                           value="${adv.advice_name || adv}" 
                           id="${id}" checked>
                    <label class="form-check-label" for="${id}">${adv.advice_name || adv}</label>
                `;
                        adviceList.prepend(div);
                    }
                });
            }

            filter();
        });
    </script>

    <!-- Medicine Modal Script -->
    <div class="modal fade" id="medicinesModal" tabindex="-1" aria-labelledby="medicinesModalTitle" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="modal-title fw-medium" id="medicinesModalTitle"
                            style="font-family: Poppins, sans-serif;">Enter Medicine Details</h5>
                        <small id="medicineCompositionText" class="text-muted d-block"></small>
                    </div>
                    <div>
                        <span id="medicineCategoryText" class="text-dark me-3"></span>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>

                <div class="modal-body" style="font-family: Poppins, sans-serif;">

                    <!-- Quantity + Units -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Quantity</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" id="medicineQuantity" min="0" class="form-control w-25"
                                placeholder="Enter qty">

                            <select id="medicineUnit" class="form-select w-25">
                                <option value="mg">mg</option>
                                <option value="ml">ml</option>
                                <option value="units">units</option>
                                <option value="drops">drops</option>
                                <option value="tab">tab</option>
                                <option value="cap">cap</option>
                            </select>
                        </div>
                    </div>

                    <!-- Timing -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Timing</label>

                        <div id="timingOptions" class="d-flex flex-wrap gap-4">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input type="checkbox" id="morningCheck">
                                <label for="morningCheck" class="mb-0">Morning</label>
                                <input type="number" id="morningQty" class="form-control w-25" min="0" step="0.5"
                                    disabled placeholder="Qty">
                            </div>

                            <div class="form-check d-flex align-items-center gap-2">
                                <input type="checkbox" id="afternoonCheck">
                                <label for="afternoonCheck" class="mb-0">Afternoon</label>
                                <input type="number" id="afternoonQty" class="form-control w-25" min="0" step="0.5"
                                    disabled placeholder="Qty">
                            </div>

                            <div class="form-check d-flex align-items-center gap-2">
                                <input type="checkbox" id="eveningCheck">
                                <label for="eveningCheck" class="mb-0">Evening</label>
                                <input type="number" id="eveningQty" class="form-control w-25" min="0" step="0.5"
                                    disabled placeholder="Qty">
                            </div>

                            <div class="form-check d-flex align-items-center gap-2">
                                <input type="checkbox" id="nightCheck">
                                <label for="nightCheck" class="mb-0">Night</label>
                                <input type="number" id="nightQty" class="form-control w-25" min="0" step="0.5" disabled
                                    placeholder="Qty">
                            </div>
                        </div>
                    </div>

                    <!-- Food Timing -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Food Timing</label>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="foodTiming" value="Before Food"
                                    id="beforeFood">
                                <label class="form-check-label" for="beforeFood">Before Food</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="foodTiming" value="After Food"
                                    id="afterFood">
                                <label class="form-check-label" for="afterFood">After Food</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="foodTiming" value="Empty Stomach"
                                    id="emptyStomach">
                                <label class="form-check-label" for="emptyStomach">Empty Stomach</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="foodTiming" value="Bedtime"
                                    id="bedtime">
                                <label class="form-check-label" for="bedtime">Bedtime</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Duration</label>
                        <input type="number" id="medicineDuration" min="0" class="form-control w-50"
                            placeholder="Enter duration (days)">
                    </div>

                    <div class="mb-3">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const medicinesData = <?php echo json_encode($medicinesList); ?>;
            const medicinesList = medicinesData.map(m => m.medicineName);

            const medicines = <?php echo isset($medicines) ? json_encode($medicines) : '[]'; ?>;

            const medicinesInput = document.getElementById("medicinesSearchInput");
            const medicinesSuggestionsBox = document.getElementById("medicinesSuggestionsBox");
            const medicinesTagContainer = document.getElementById("medicinesInput");

            const medicinesModalEl = document.getElementById("medicinesModal");
            const medicinesModal = new bootstrap.Modal(medicinesModalEl);

            const medicinesModalTitle = document.getElementById("medicinesModalTitle");
            const medicineCompositionText = document.getElementById("medicineCompositionText");
            const medicineCategoryText = document.getElementById("medicineCategoryText");
            const medicineQuantity = document.getElementById("medicineQuantity");
            const medicineUnit = document.getElementById("medicineUnit");
            const medicineDuration = document.getElementById("medicineDuration");
            const medicineNotes = document.getElementById("medicineNotes");

            const slots = ["morning", "afternoon", "evening", "night"];

            let selectedMedicines = [];
            let pendingMedicineName = "";
            let editingMedicineTag = null;

            function forEachSlot(cb) {
                slots.forEach(slot => cb(
                    slot,
                    document.getElementById(`${slot}Check`),
                    document.getElementById(`${slot}Qty`)
                ));
            }

            function toDbShape(row) {
                if (!row) return null;
                return {
                    id: row.id ?? row.medicine_id ?? row.MedicineID ?? "",
                    consultation_id: row.consultation_id ?? row.consultationId ?? undefined,
                    medicine_name: row.medicine_name ?? row.medicine ?? row.medicineBrand ?? "",
                    quantity: row.quantity ?? "",
                    unit: row.unit ?? "",
                    timing: row.timing ?? row.timingString ?? "0-0-0-0",
                    food_timing: row.food_timing ?? row.foodTiming ?? "",
                    duration: row.duration ?? "",
                    notes: row.notes ?? ""
                };
            }

            function buildTimingString() {
                const parts = [];
                forEachSlot((slot, check, qty) => {
                    parts.push(check && check.checked && qty && qty.value ? String(qty.value) : "0");
                });
                return parts.join("-");
            }

            function applyTimingString(timingStr) {
                const parts = String(timingStr || "0-0-0-0").split("-");
                slots.forEach((slot, i) => {
                    const check = document.getElementById(`${slot}Check`);
                    const qty = document.getElementById(`${slot}Qty`);
                    if (!check || !qty) return;
                    const v = parts[i] ?? "0";
                    if (v !== "0") {
                        check.checked = true;
                        qty.disabled = false;
                        qty.value = v;
                    } else {
                        check.checked = false;
                        qty.value = "";
                        qty.disabled = true;
                    }
                });
            }

            forEachSlot((slot, check, qty) => {
                if (!check || !qty) return;
                qty.disabled = true;
                check.addEventListener("change", () => {
                    if (check.checked) {
                        qty.disabled = false;
                        if (!qty.value) qty.value = 1;
                    } else {
                        qty.value = "";
                        qty.disabled = true;
                    }
                });
                qty.addEventListener("focus", () => {
                    if (!check.checked) qty.blur();
                });
            });

            function renderMedicinesSuggestions() {
                if (!medicinesInput || !medicinesSuggestionsBox) return;

                const query = medicinesInput.value.trim().toLowerCase();
                medicinesSuggestionsBox.innerHTML = "";

                const filtered = medicinesList.filter(m =>
                    m.toLowerCase().includes(query) &&
                    !selectedMedicines.some(obj => obj.medicine_name === m)
                );

                if (filtered.length === 0 && query !== "") {
                    const div = document.createElement("div");
                    div.innerHTML = `Add "<strong>${medicinesInput.value}</strong>"`;
                    div.onclick = () => { openMedicineModal(medicinesInput.value); medicinesInput.value = ""; };
                    medicinesSuggestionsBox.appendChild(div);
                } else {
                    filtered.forEach(item => {
                        const div = document.createElement("div");
                        div.textContent = item;
                        div.onclick = () => { openMedicineModal(item); medicinesInput.value = ""; };
                        medicinesSuggestionsBox.appendChild(div);
                    });
                }
                medicinesSuggestionsBox.style.display = "block";
            }

            if (medicinesInput) {
                medicinesInput.addEventListener("input", renderMedicinesSuggestions);
                medicinesInput.addEventListener("focus", renderMedicinesSuggestions);
                medicinesInput.addEventListener("keydown", (e) => {
                    if (e.key === "Enter" && medicinesInput.value.trim() !== "") {
                        e.preventDefault();
                        openMedicineModal(medicinesInput.value.trim());
                        medicinesInput.value = "";
                    }
                });
                document.addEventListener("click", (e) => {
                    if (!medicinesTagContainer?.contains(e.target)) {
                        if (medicinesSuggestionsBox) medicinesSuggestionsBox.style.display = "none";
                    }
                });
            }

            window.openMedicineModal = function (name, existing = null, tagEl = null) {
                pendingMedicineName = name;
                editingMedicineTag = tagEl;

                const medData = medicinesData.find(m => m.medicineName === name);
                medicinesModalTitle.textContent = existing ? `Edit: ${name}` : `Details for: ${name}`;
                medicineCompositionText.textContent = medData ? medData.compositionName : "(No composition available)";
                medicineCategoryText.textContent = medData ? `Category: ${medData.category}` : "(No category)";

                medicineQuantity.value = "";
                medicineUnit.value = "mg";
                medicineDuration.value = "";
                medicineNotes.value = "";
                forEachSlot((slot, check, qty) => {
                    if (!check || !qty) return;
                    check.checked = false; qty.value = ""; qty.disabled = true;
                });
                document.querySelectorAll('input[name="foodTiming"]').forEach(r => r.checked = false);

                const row = toDbShape(existing);
                if (row) {
                    medicineQuantity.value = row.quantity || "";
                    medicineUnit.value = row.unit || "mg";
                    medicineDuration.value = row.duration || "";
                    medicineNotes.value = row.notes || "";
                    applyTimingString(row.timing);
                    document.querySelectorAll('input[name="foodTiming"]').forEach(r => {
                        r.checked = (r.value === (row.food_timing || ""));
                    });
                }

                medicinesModal.show();
            };

            window.saveMedicineModal = function () {
                const quantity = (medicineQuantity.value || "").trim();
                const unit = (medicineUnit.value || "").trim();
                const duration = (medicineDuration.value || "").trim();
                const notes = (medicineNotes.value || "").trim();
                const timing = buildTimingString();
                const food_timing = document.querySelector('input[name="foodTiming"]:checked')?.value || "";

                if (!pendingMedicineName) return;

                const existingIndex = selectedMedicines.findIndex(m => m.medicine_name === pendingMedicineName);

                const resolvedId = (existingIndex !== -1 && selectedMedicines[existingIndex]?.id)
                    ? selectedMedicines[existingIndex].id
                    : "new";

                const data = {
                    id: resolvedId,
                    medicine_name: pendingMedicineName,
                    quantity,
                    unit,
                    timing,
                    food_timing,
                    duration,
                    notes
                };

                if (editingMedicineTag && existingIndex !== -1) {
                    if (selectedMedicines[existingIndex].consultation_id) {
                        data.consultation_id = selectedMedicines[existingIndex].consultation_id;
                    }
                    selectedMedicines[existingIndex] = data;
                    updateMedicineTagDisplay(editingMedicineTag, data);
                    editingMedicineTag.setAttribute("data-id", data.id || "new");
                } else {
                    selectedMedicines.push(data);
                    addMedicineTag(data);
                }

                updateMedicinesHiddenInput();
                medicinesModal.hide();
                pendingMedicineName = "";
                editingMedicineTag = null;
            };

            function addMedicineTag(row) {
                if (!medicinesTagContainer) return;
                const tag = document.createElement("span");
                tag.className = "bg-success rounded-2 text-light p-2 me-2 mb-2 d-inline-block";
                tag.style.cursor = "pointer";
                tag.setAttribute("data-id", row.id || "new");

                updateMedicineTagDisplay(tag, row);

                tag.onclick = () => openMedicineModal(row.medicine_name, row, tag);

                if (medicinesInput && medicinesInput.parentElement === medicinesTagContainer) {
                    medicinesTagContainer.insertBefore(tag, medicinesInput);
                } else {
                    medicinesTagContainer.appendChild(tag);
                }
            }

            function updateMedicineTagDisplay(tagEl, row) {
                const qtyText = row.quantity ? `${row.quantity} ${row.unit || ""}`.trim() : "0";
                tagEl.innerHTML = `${row.medicine_name} (Qty: ${qtyText}, Timing: ${row.timing || "0-0-0-0"}, Duration: ${row.duration || 0})`;

                tagEl.setAttribute("data-id", row.id || "new");

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.className = "text-light ms-2";
                removeBtn.style.border = "none";
                removeBtn.style.background = "transparent";
                removeBtn.style.fontSize = "1rem";
                removeBtn.innerHTML = "&times;";
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    tagEl.remove();
                    selectedMedicines = selectedMedicines.filter(s => s.medicine_name !== row.medicine_name);
                    updateMedicinesHiddenInput();
                };
                tagEl.appendChild(removeBtn);
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
                hidden.value = JSON.stringify(selectedMedicines);
            }

            if (Array.isArray(medicines) && medicines.length) {
                medicines.forEach(m => {
                    const row = toDbShape(m);
                    selectedMedicines.push(row);
                    addMedicineTag(row);
                });
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

            console.log('Page context:', { isEditPage, isDashboardPage, isNewConsultation, isFollowup });

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
                imageEditModal: document.getElementById('imageEditModal') ? new bootstrap.Modal(document.getElementById('imageEditModal'), { backdrop: 'static', keyboard: false }) : null,
                editPreviewModal: document.getElementById('editPreviewModal') ? new bootstrap.Modal(document.getElementById('editPreviewModal'), { backdrop: 'static', keyboard: true }) : null,
                previewContent: document.getElementById('filePreviewContent'),
                modalTitle: document.getElementById('editPreviewModalLabel'),
                prevBtn: document.getElementById('prevFile'),
                nextBtn: document.getElementById('nextFile')
            };

            const newConsultationElements = isNewConsultation && newConsultationContainer ? {
                previewModal: new bootstrap.Modal(document.getElementById('newConsultationPreviewModal'), { backdrop: 'static', keyboard: true }),
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
                previewModal: new bootstrap.Modal(document.getElementById('followupPreviewModal'), { backdrop: 'static', keyboard: true }),
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
                previewModal: new bootstrap.Modal(document.getElementById('dashboardPreviewModal'), { backdrop: 'static', keyboard: true }),
                image: document.getElementById('attachmentImage'),
                pdf: document.getElementById('attachmentPDF'),
                modalTitle: document.getElementById('dashboardPreviewModalLabel'),
                prevBtn: document.getElementById('prevAttachment'),
                nextBtn: document.getElementById('nextAttachment')
            } : {};

            const MAX_FILES = 10;
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

            const BASE_FILE_URL = '<?php echo base_url('Uploads/consultations/'); ?>';

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
                    const url = file.url || (file.file_path ? BASE_FILE_URL + encodeURIComponent(file.file_path) : BASE_FILE_URL + encodeURIComponent(fileName));
                    return { file_name: fileName, ext: extension, mime_type: mimeType, url, size: file.size || 0 };
                });

                renderFileList();
            }
            if (isNewConsultation || isFollowup) {
                renderFileList();
            }


            function getMimeType(ext) {
                const map = { 'jpg': 'image/jpeg', 'jpeg': 'image/jpeg', 'png': 'image/png', 'pdf': 'application/pdf', 'doc': 'application/msword', 'docx': 'application/vnd.openxmlformats-officedocument.wordprocessingprocessingml.document' };
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

            function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }
            function highlight(el) { el.style.borderColor = '#00ad8e'; el.style.backgroundColor = '#f2ebebff'; }
            function unhighlight(el) { el.style.borderColor = '#ccc'; el.style.backgroundColor = 'transparent'; }

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
                        if (edited) newFiles.push({ name: edited.name, file: edited, type: edited.type, ext, url: null, size: edited.size });
                    } else {
                        newFiles.push({ name: file.name, file, type, ext, url: null, size: file.size });
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
                        currentRotationAngle = 0; originalDataURL = dataURL; currentImageBlob = file;
                        img.src = dataURL; img.style.display = 'block'; canvas.style.display = 'none';
                        editElements.imageEditModal.show();
                        cropper = new Cropper(img, { aspectRatio: NaN, viewMode: 1, autoCropArea: 1, responsive: true, scalable: true, zoomable: true, minContainerWidth: 600, minContainerHeight: 600 });

                        const escapeHandler = ev => ev.key === 'Escape' && editElements.imageEditModal.hide();
                        document.addEventListener('keydown', escapeHandler);
                        editElements.imageEditModal._element.addEventListener('hidden.bs.modal', () => {
                            document.removeEventListener('keydown', escapeHandler);
                            resolve(null); cleanup();
                        }, { once: true });

                        document.getElementById('crop-btn').onclick = () => {
                            img.style.display = 'block'; canvas.style.display = 'none';
                            if (!cropper) cropper = new Cropper(img, { viewMode: 1, dragMode: 'crop', autoCrop: false, movable: false, zoomable: false, scalable: false });
                            cropper.setDragMode('crop');
                        };

                        document.getElementById('rotate-btn').onclick = () => {
                            if (!originalDataURL) return;
                            currentRotationAngle = (currentRotationAngle + 90) % 360;
                            const imgObj = new Image(); imgObj.src = originalDataURL;
                            imgObj.onload = () => {
                                const tempCanvas = document.createElement('canvas'), ctx = tempCanvas.getContext('2d');
                                const angleRad = currentRotationAngle * Math.PI / 180;
                                const isSwapped = currentRotationAngle === 90 || currentRotationAngle === 270;
                                const [w, h] = isSwapped ? [imgObj.naturalHeight * 0.5, imgObj.naturalWidth * 0.5] : [imgObj.naturalWidth * 0.5, imgObj.naturalHeight * 0.5];
                                tempCanvas.width = w; tempCanvas.height = h;
                                ctx.translate(w / 2, h / 2); ctx.rotate(angleRad);
                                ctx.drawImage(imgObj, -imgObj.naturalWidth * 0.25, -imgObj.naturalHeight * 0.25, imgObj.naturalWidth * 0.5, imgObj.naturalHeight * 0.5);
                                tempCanvas.toBlob(blob => {
                                    currentImageBlob = new File([blob], file.name, { type: file.type });
                                    const url = URL.createObjectURL(currentImageBlob);
                                    img.src = url; if (cropper) cropper.destroy();
                                    cropper = new Cropper(img, { aspectRatio: NaN, viewMode: 1, autoCropArea: 1, responsive: true, scalable: true, zoomable: true, minContainerWidth: 600, minContainerHeight: 600 });
                                }, file.type, 1);
                            };
                        };

                        const saveBtn = document.getElementById('saveEditedImage');
                        const saveHandler = () => {
                            if (cropper) {
                                cropper.getCroppedCanvas({ fillColor: file.type.includes('png') ? 'transparent' : '#ffffff' }).toBlob(blob => {
                                    const edited = new File([blob], file.name, { type: file.type });
                                    const errorElement = getCurrentElements().fileError; // Use context-aware error element
                                    if ([...newFiles, ...existingFiles].some(f => (f.name || f.file_name) === edited.name && f.size === edited.size)) {
                                        errorElement.textContent = `File "${edited.name}" already uploaded.`; resolve(null); cleanup();
                                    } else { resolve(edited); cleanup(); }
                                }, file.type, 1);
                            } else {
                                const edited = currentImageBlob ? new File([currentImageBlob], file.name, { type: file.type }) : file;
                                const errorElement = getCurrentElements().fileError; // Use context-aware error element
                                if ([...newFiles, ...existingFiles].some(f => (f.name || f.file_name) === edited.name && f.size === edited.size)) {
                                    errorElement.textContent = `File "${edited.name}" already uploaded.`; resolve(null); cleanup();
                                } else { resolve(edited); cleanup(); }
                            }
                        };
                        saveBtn.addEventListener('click', saveHandler, { once: true });

                        function cleanup() {
                            editElements.imageEditModal.hide();
                            if (cropper) { cropper.destroy(); cropper = null; }
                            img.src = ''; img.style.display = 'none'; canvas.style.display = 'none';
                            currentRotationAngle = 0; originalDataURL = null; currentImageBlob = null;
                            const newBtn = saveBtn.cloneNode(true); saveBtn.parentNode.replaceChild(newBtn, saveBtn);
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

                const ul = document.createElement("ul"); ul.style.paddingLeft = "1.2rem";
                [...existingFiles, ...newFiles].forEach((file, i) => {
                    const isExisting = isEditPage && i < existingFiles.length;
                    const fileIndexInArray = isExisting ? i : i - existingFiles.length;

                    const li = document.createElement("li"); li.style.marginBottom = "6px";
                    const link = document.createElement("a"); link.href = "javascript:void(0);"; link.textContent = isExisting ? file.file_name : file.name;
                    link.className = "openAttachment"; link.style.color = "#007bff"; link.style.textDecoration = "underline"; link.style.cursor = "pointer";
                    link.setAttribute("data-file", isExisting ? file.url : (file.file ? file.name : ''));
                    link.setAttribute("data-ext", isExisting ? file.ext : file.ext);
                    link.setAttribute("data-context", context);
                    link.setAttribute("data-is-existing", isExisting.toString());
                    link.setAttribute("data-file-index", fileIndexInArray.toString());

                    const removeBtn = document.createElement("button"); removeBtn.type = "button"; removeBtn.textContent = "✕";
                    removeBtn.className = "btn btn-sm btn-danger"; removeBtn.style.marginLeft = "8px";
                    removeBtn.onclick = () => {
                        if (isExisting) { removedFiles.push(file.file_name); existingFiles.splice(fileIndexInArray, 1); if (currentElements.removedFilesInput) currentElements.removedFilesInput.value = JSON.stringify(removedFiles); }
                        else newFiles.splice(fileIndexInArray, 1);
                        renderFileList(); updateSubmitFileInput();
                    };
                    li.appendChild(link); li.appendChild(removeBtn); ul.appendChild(li);
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
                    elements = editElements; showModal = () => editElements.editPreviewModal.show(); updateNav = updateEditNavigation;
                    elements.modalTitle.textContent = `Attachment Preview - ${fileName}`;
                    elements.previewContent.innerHTML = '';
                } else if (context === 'new' && newConsultationElements.previewModal) {
                    elements = newConsultationElements; showModal = () => elements.previewModal.show(); updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `New Consultation Attachment Preview - ${fileName}`;
                    elements.image.classList.add('d-none'); elements.pdf.classList.add('d-none');
                } else if (context === 'followup' && followupElements.previewModal) {
                    elements = followupElements; showModal = () => elements.previewModal.show(); updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `Follow-up Attachment Preview - ${fileName}`;
                    elements.image.classList.add('d-none'); elements.pdf.classList.add('d-none');
                } else if (context === 'dashboard' && dashboardElements.previewModal) {
                    elements = dashboardElements; showModal = () => elements.previewModal.show(); updateNav = () => updateNavButtons(elements, index);
                    elements.modalTitle.textContent = `Attachment Preview in Dashboard - ${fileName}`;
                    elements.image.classList.add('d-none'); elements.pdf.classList.add('d-none');

                    document.getElementById('attachment-content-wrapper')?.querySelector('#no-preview-message')?.remove();

                    const toolbar = document.getElementById('attachment-toolbar');
                    const downloadBtn = document.getElementById('downloadAttachmentBtn');
                    const attachmentImage = document.getElementById('attachmentImage');

                    toolbar.style.display = 'none';

                    currentZoom = 1.0;
                    attachmentImage.style.transform = `scale(${currentZoom})`;

                    downloadBtn.onclick = () => {
                        const tempLink = document.createElement('a');
                        tempLink.href = url;
                        tempLink.download = fileName;
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
                        if (context === 'edit') { const img = document.createElement('img'); img.src = url; img.style.maxWidth = '100%'; img.maxHeight = '70vh'; elements.previewContent.appendChild(img); }
                        else { elements.image.src = url; elements.image.classList.remove('d-none'); }
                    } else if (fileType === 'application/pdf') {
                        if (context === 'edit') { const embed = document.createElement('embed'); embed.src = url; embed.style.width = '100%'; embed.style.height = '70vh'; elements.previewContent.appendChild(embed); }
                        else { elements.pdf.src = url; elements.pdf.classList.remove('d-none'); }
                    } else {
                        const p = document.createElement('p'); p.textContent = `Preview not available for ${fileName}.`; p.style.textAlign = 'center';

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
                    updateNav(index); showModal();
                };

                if (isExisting && context !== 'edit') {
                    fetch(url, { method: 'HEAD' }).then(r => r.ok ? display() : fail()).catch(fail);
                } else display();

                function fail() {
                    const p = document.createElement('p'); p.textContent = `Cannot access ${fileName}.`; p.style.textAlign = 'center';
                    context === 'edit' ? elements.previewContent.appendChild(p) : elements.image.classList.remove('d-none'), elements.image.alt = p.textContent;
                    updateNav(index); showModal();
                }

                elements.previewModal._element.addEventListener('hidden.bs.modal', () => {
                    if (!isExisting && url.startsWith('blob:')) URL.revokeObjectURL(url);
                    if (context === 'edit') elements.previewContent.innerHTML = '';
                    else { elements.image.src = ''; elements.pdf.src = ''; elements.image.classList.add('d-none'); elements.pdf.classList.add('d-none'); }
                    currentIndex = -1; currentFiles = [];

                    if (context === 'dashboard') {
                        document.getElementById('attachmentImage').style.cursor = 'default';
                        document.getElementById('attachment-content-wrapper').scrollTo(0, 0); // Reset scroll position
                        document.getElementById('attachment-content-wrapper')?.querySelector('#no-preview-message')?.remove();
                    }
                }, { once: true });
            }

            function updateEditNavigation(index) {
                editElements.prevBtn.disabled = index === 0; editElements.nextBtn.disabled = index === currentFiles.length - 1;
                editElements.prevBtn.classList.toggle('disabled', index === 0); editElements.nextBtn.classList.toggle('disabled', index === currentFiles.length - 1);
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
                e.preventDefault(); e.stopPropagation();

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
                    showPreview({ url: link.getAttribute('data-file'), ext: link.getAttribute('data-ext'), file_name: fileName }, true, index, 'dashboard');
                }
            }
            document.addEventListener('click', handleAttachmentClick);

            function setupNav(prevBtn, nextBtn, context) {
                if (!prevBtn || !nextBtn) return;
                prevBtn.onclick = () => { if (!prevBtn.disabled && currentIndex > 0) navigate(currentIndex - 1, context); };
                nextBtn.onclick = () => { if (!nextBtn.disabled && currentIndex < currentFiles.length - 1) navigate(currentIndex + 1, context); };
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
                window.location.href = "<?php echo site_url('Consultation/deleteConsultation/'); ?>"
                    + deletePatientId + "/" + deleteConsultationId;
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
            label.addEventListener('click', () => {
                const container = label.nextElementSibling;
                const icon = label.querySelector('.toggle-icon');

                container.classList.toggle('show');
                icon.textContent = container.classList.contains('show') ? '-' : '+';
            });
        });
    </script>

   /*  Model Model on screen */
<script>
 document.addEventListener("DOMContentLoaded", function() {

    // --- 1. MAKE MODALS DRAGGABLE ---
    // List all modal IDs you want to be draggable
    const draggableModalIds = [
        '#symptomsModal', 
        '#inputModal', 
        '#diagnosisModal', 
        '#investigationsModal'
    ];
    // Loop through each ID and apply the draggable logic
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

    // --- 2. ADD 'ESC' KEY TO CLOSE ALL MODALS ---
    document.addEventListener('keydown', function(e) {
        // Check if the pressed key is 'Escape'
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
/* Reusable function to make a Bootstrap modal draggable. */
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

    modalHeader.addEventListener('mousedown', function(e) {
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

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <!-- Fabric.js and Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
</body>

</html>