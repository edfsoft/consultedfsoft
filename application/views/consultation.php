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
                                                    <div class="card-body">
                                                        <div class="d-md-flex justify-content-between">
                                                            <h5 class="card-title mb-0">
                                                                <?= date('d M Y h:i A', strtotime($consultation['created_at'])) ?>
                                                            </h5>
                                                            <div class="mt-md-3 mb-4 mb-md-0">
                                                                <button class="btn btn-secondary" disabled><i
                                                                        class="bi bi-download"></i></button>
                                                                <button class="btn btn-secondary"
                                                                    onclick="window.location.href='<?php echo site_url('Healthcareprovider/editConsultation/' . $consultation['id']); ?>'"><i
                                                                        class="bi bi-pen"></i></button>
                                                                <button class="btn text-light" style="background-color: #00ad8e;"
                                                                    onclick="window.location.href='<?php echo site_url('Healthcareprovider/followupConsultation/' . $consultation['id']); ?>'">Follow-up
                                                                    / Repeat</button>
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
                                                                    'Cholesterol' => !empty($consultation['vitals']['cholesterol_mg_dl']) ? $consultation['vitals']['cholesterol_mg_dl'] . ' mg/dL' : null,
                                                                    'Fasting Blood Sugar' => !empty($consultation['vitals']['blood_sugar_fasting']) ? $consultation['vitals']['blood_sugar_fasting'] . ' mg/dL' : null,
                                                                    'PP Blood Sugar' => !empty($consultation['vitals']['blood_sugar_pp']) ? $consultation['vitals']['blood_sugar_pp'] . ' mg/dL' : null,
                                                                    'Random Blood Sugar' => !empty($consultation['vitals']['blood_sugar_random']) ? $consultation['vitals']['blood_sugar_random'] . ' mg/dL' : null,
                                                                    'SPO2' => !empty($consultation['vitals']['spo2_percent']) ? $consultation['vitals']['spo2_percent'] . ' %' : null,
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

                                                        <!-- Procedures -->
                                                        <?php if (!empty($consultation['procedures'])): ?>
                                                            <p><strong>Procedures:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['procedures'] as $proc): ?>
                                                                    <li><?= $proc['procedure_name'] ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>

                                                        <!-- Advices -->
                                                        <?php if (!empty($consultation['advices'])): ?>
                                                            <p><strong>Advices:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['advices'] as $adv): ?>
                                                                    <li><?= $adv['advice_name'] ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
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
                                                                            data-file="<?= $filePath ?>" data-ext="<?= $ext ?>">
                                                                            <?= $attach['file_name'] ?>
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
                                <?php else: ?>
                                    <p>No Previous Consultation.</p>
                                <?php endif; ?>
                            </div>

                            <!-- New Consultation -->
                            <div class="tab-pane fade" id="new-consultation" role="tabpanel">
                                <form action="<?php echo base_url() . 'Healthcareprovider/saveConsultation' ?>"
                                    method="post" id="consultationForm" class="mb-5" enctype="multipart/form-data">
                                    <input type="hidden" id="patientIdDb" name="patientIdDb"
                                        value="<?php echo $patientDetails[0]['id'] ?>">
                                    <input type="hidden" id="patientId" name="patientId"
                                        value="<?php echo $patientDetails[0]['patientId'] ?>">

                                    <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>
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
                                                <label class="form-label fieldLabel" for="patientsCholestrol">Blood Sugar
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
                                                <label class="form-label fieldLabel" for="patientTemperature">Blood Sugar
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
                                            <div class="col-md-4">
                                                <label class="form-label fieldLabel"
                                                    for="patientsCholestrol">Cholestrol</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientsCholestrol" name="patientsCholestrol" step="0.1" min="0"
                                                        placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">mg/dL</p>
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
                                            <div class="col-md-4 mt-3 mt-md-0">
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
                                                <span><strong><i class="bi bi-clipboard-data me-2"></i>
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

                                        <!-- Medicine section -->
                                        <!-- <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#medicinesCollapse">
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
                                        <input type="hidden" name="medicinesJson" id="medicinesJson"> -->

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

                                    </div>

                                    <div class="form-group pb-3">
                                        <label class="form-label fieldLabel">Attachments</label>
                                        <input type="file" id="fileInput" name="consultationFiles[]" class="d-none"
                                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
                                        <button type="button" id="addFileBtn" class="btn text-light float-end mb-2"
                                            style="background-color: #00ad8e;">
                                            + Add File
                                        </button>
                                        <div id="fileList" style="margin-top: 0.5rem;"></div>
                                        <div id="fileError" class="text-danger pt-1"></div>
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
                        <a href="<?php echo base_url() . "Healthcareprovider/consultation/" . $value['id']; ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body mx-3 px-md-4">
                        <form action="<?php echo base_url() . 'Healthcareprovider/saveConsultation' ?>" method="post"
                            enctype="multipart/form-data" id="consultationForm" class="mb-5">
                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                value="<?php echo $patientDetails[0]['id'] ?>">
                            <input type="hidden" id="patientId" name="patientId"
                                value="<?php echo $patientDetails[0]['patientId'] ?>">
                            <p class="fs-4 fw-semibold mb-3">Follow-up Consultation:</p>
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
                                        <label class="form-label fieldLabel" for="patientsCholestrol">Blood Sugar
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
                                        <label class="form-label fieldLabel" for="patientTemperature">Blood Sugar (Random)
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientsCholestrol">Cholestrol</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientsCholestrol"
                                                name="patientsCholestrol" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['cholesterol_mg_dl']) ? $vitals['cholesterol_mg_dl'] : '' ?>">
                                            <p class="mx-2 my-2">mg/dL</p>
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
                                    <div class="col-md-4 mt-3 mt-md-0">
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
                                        <span><strong><i class="bi bi-clipboard-data me-2"></i>
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

                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel">Attachments</label>
                                <input type="file" id="fileInput" name="consultationFiles[]" class="d-none"
                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
                                <button type="button" id="addFileBtn" class="btn text-light float-end mb-2"
                                    style="background-color: #00ad8e;">
                                    + Add File
                                </button>
                                <div id="fileList" style="margin-top: 0.5rem;"></div>
                                <div id="fileError" class="text-danger pt-1"></div>
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

                    </div>
            </section>

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
                        <a href="<?php echo base_url() . "Healthcareprovider/consultation/" . $value['id']; ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body mx-3 px-md-4">
                        <form action="<?php echo base_url() . 'Healthcareprovider/saveEditConsult' ?>" method="post"
                            enctype="multipart/form-data" id="consultationForm" class="mb-5">
                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                value="<?php echo $patientDetails[0]['id'] ?>">
                            <input type="hidden" id="patientId" name="patientId"
                                value="<?php echo $patientDetails[0]['patientId'] ?>">
                            <input type="hidden" id="consultationDbId" name="consultationDbId"
                                value="<?php echo $consultation['id'] ?>">
                            <input type="hidden" id="vitalsDbId" name="vitalsDbId" value="<?php echo $vitals['id'] ?>">
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
                                        <label class="form-label fieldLabel" for="patientsCholestrol">Blood Sugar
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
                                        <label class="form-label fieldLabel" for="patientTemperature">Blood Sugar (Random)
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
                                    <div class="col-md-4">
                                        <label class="form-label fieldLabel" for="patientsCholestrol">Cholestrol</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientsCholestrol"
                                                name="patientsCholestrol" step="0.1" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['cholesterol_mg_dl']) ? $vitals['cholesterol_mg_dl'] : '' ?>">
                                            <p class="mx-2 my-2">mg/dL</p>
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
                                    <div class="col-md-4 mt-3 mt-md-0">
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
                                        <span><strong><i class="bi bi-clipboard-data me-2"></i>
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
                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel">Attachments</label>
                                <input type="file" id="fileInput" name="consultationFiles[]" class="d-none"
                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
                                <button type="button" id="addFileBtn" class="btn text-light float-end mb-2"
                                    style="background-color: #00ad8e;"> + Add File </button>
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
        <div class="modal fade" id="medicinesModal" tabindex="-1" aria-labelledby="medicinesModalTitle"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="medicinesModalTitle"
                            style="font-family: Poppins, sans-serif;">
                            Enter Medicine Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="medicineNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="medicineNote" placeholder="Enter note" />
                        </div>
                        <div class="mb-3">
                            <label for="medicineSince" class="form-label">Since</label>
                            <input type="text" class="form-control" id="medicineSince" placeholder="Enter since" />
                        </div>
                        <div class="mb-3">
                            <label for="medicineSeverity" class="form-label">Severity</label>
                            <select id="medicineSeverity" class="form-select">
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
                            onclick="saveMedicineModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attachment Display Modal -->
        <div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header with dynamic file name -->
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                            id="attachmentModalLabel">
                            Attachment Preview
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body to show image or PDF -->
                    <div class="modal-body text-center">
                        <img id="attachmentImage" src="" alt="Attachment" class="img-fluid d-none">
                        <iframe id="attachmentPDF" src="" class="w-100" style="height:500px;" frameborder="0"></iframe>
                    </div>

                    <!-- Footer with close button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ******************************************************************************************************************************************** -->

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>

    </main>

    <!-- ******************************************************************************************************************************************** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Next follow update date field disable -->
    <script>
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("nextFollowUpDate").setAttribute("min", today);
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
            const query = symptomsInput.value.toLowerCase().trim();
            symptomsSuggestionsBox.innerHTML = "";

            const filtered = symptomsList.filter(s =>
                s.toLowerCase().includes(query) &&
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
                fetch("<?= site_url('Healthcareprovider/addSymptom') ?>", {
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
            const query = findingsInput.value.toLowerCase().trim();
            suggestionsBox.innerHTML = "";

            const filtered = findingsList.filter(f =>
                f.toLowerCase().includes(query) &&
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
                fetch("<?= site_url('Healthcareprovider/addFinding') ?>", {
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
            const query = diagnosisInput.value.toLowerCase().trim();
            diagnosisSuggestionsBox.innerHTML = "";

            const filtered = diagnosisList.filter(d =>
                d.toLowerCase().includes(query) &&
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
                fetch("<?= site_url('Healthcareprovider/addDiagnosis') ?>", {
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
            const query = investigationsInput.value.toLowerCase().trim();
            investigationsSuggestionsBox.innerHTML = "";

            const filtered = investigationsList.filter(s =>
                s.toLowerCase().includes(query) &&
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
                fetch("<?= site_url('Healthcareprovider/addInvestigation') ?>", {
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

                fetch("<?= site_url('Healthcareprovider/addInstruction') ?>", {
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

                fetch("<?= site_url('Healthcareprovider/addProcedure') ?>", {
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
    <script>
        const medicinesList = <?php echo json_encode(array_column($symptomsList, 'symptomsName')); ?>;

        const medicinesInput = document.getElementById("medicinesSearchInput");
        const medicinesSuggestionsBox = document.getElementById("medicinesSuggestionsBox");
        const medicinesTagContainer = document.getElementById("medicinesInput");

        const medicinesModal = new bootstrap.Modal(document.getElementById("medicinesModal"));
        const medicineNote = document.getElementById("medicineNote");
        const medicineSince = document.getElementById("medicineSince");
        const medicineSeverity = document.getElementById("medicineSeverity");
        const medicinesModalTitle = document.getElementById("medicinesModalTitle");

        let selectedMedicines = [];
        let pendingMedicine = "";
        let editingMedicineTag = null;

        function renderMedicinesSuggestions() {
            const query = medicinesInput.value.toLowerCase().trim();
            medicinesSuggestionsBox.innerHTML = "";

            const filtered = medicinesList.filter(m =>
                m.toLowerCase().includes(query) &&
                !selectedMedicines.some(obj => obj.medicine === m)
            );

            if (filtered.length === 0 && query !== "") {
                const customOption = document.createElement("div");
                customOption.innerHTML = `Add "<strong>${query}</strong>"`;
                customOption.onclick = () => {
                    openMedicineModal(query);
                    medicinesInput.value = "";
                };
                medicinesSuggestionsBox.appendChild(customOption);
            } else {
                filtered.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.onclick = () => {
                        openMedicineModal(item);
                        medicinesInput.value = "";
                    };
                    medicinesSuggestionsBox.appendChild(div);
                });
            }

            medicinesSuggestionsBox.style.display = "block";
        }

        function openMedicineModal(tagName, existing = null, tagEl = null) {
            pendingMedicine = tagName;
            editingMedicineTag = tagEl;

            medicinesModalTitle.textContent = existing ? `Edit: ${tagName}` : `Details for: ${tagName}`;
            medicineNote.value = existing?.note || "";
            medicineSince.value = existing?.since || "";
            medicineSeverity.value = existing?.severity || "";

            medicinesModal.show();
        }

        function saveMedicineModal() {
            const note = medicineNote.value.trim();
            const since = medicineSince.value.trim();
            const severity = medicineSeverity.value;

            if (!pendingMedicine) return;

            const existingIndex = selectedMedicines.findIndex(m => m.medicine === pendingMedicine);

            if (!medicinesList.includes(pendingMedicine)) {
                fetch("<?= site_url('Healthcareprovider/addMedicine') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(pendingMedicine)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            medicinesList.push(pendingMedicine);
                        } else {
                            console.error("Error saving new medicine", data);
                        }
                    })
                    .catch(err => console.error(err));
            }

            if (editingMedicineTag && existingIndex !== -1) {
                let existingId = selectedMedicines[existingIndex].id || "new";
                selectedMedicines[existingIndex] = { id: existingId, medicine: pendingMedicine, note, since, severity };
                updateMedicineTagDisplay(editingMedicineTag, selectedMedicines[existingIndex]);
                editingMedicineTag.setAttribute("data-id", existingId);
            } else {
                const data = { id: "new", medicine: pendingMedicine, note, since, severity };
                selectedMedicines.push(data);
                addMedicineTag(data);
            }

            medicinesModal.hide();
            pendingMedicine = "";
            editingMedicineTag = null;
            updateMedicinesHiddenInput();
        }

        function addMedicineTag(data) {
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
                selectedMedicines = selectedMedicines.filter(s => s.medicine !== data.medicine);
                updateMedicinesHiddenInput();
            };

            tag.appendChild(removeBtn);

            updateMedicineTagDisplay(tag, data);

            tag.onclick = () => {
                openMedicineModal(data.medicine, data, tag);
            };

            medicinesTagContainer.insertBefore(tag, medicinesInput);
        }

        function updateMedicineTagDisplay(tagEl, data) {
            const textParts = [data.medicine];
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
                selectedMedicines = selectedMedicines.filter(s => s.medicine !== data.medicine);
                updateMedicinesHiddenInput();
            };
            tagEl.appendChild(removeBtn);
            tagEl.setAttribute("data-id", data.id || "new");
        }

        function updateMedicinesHiddenInput() {
            document.getElementById("medicinesJson").value = JSON.stringify(selectedMedicines);
        }

        medicinesInput.addEventListener("input", renderMedicinesSuggestions);
        medicinesInput.addEventListener("focus", renderMedicinesSuggestions);
        medicinesInput.addEventListener("keydown", e => {
            if (e.key === "Enter" && medicinesInput.value.trim() !== "") {
                e.preventDefault();
                openMedicineModal(medicinesInput.value.trim());
                medicinesInput.value = "";
            }
        });

        document.addEventListener("click", (e) => {
            if (!medicinesTagContainer.contains(e.target)) {
                medicinesSuggestionsBox.style.display = "none";
            }
        });

        renderMedicinesSuggestions();

        document.addEventListener("DOMContentLoaded", () => {
            const preloadMedicines = <?php echo isset($medicines) ? json_encode($medicines) : '[]'; ?>;

            if (preloadMedicines.length > 0) {
                preloadMedicines.forEach(item => {
                    const data = {
                        id: item.id || "",
                        medicine: item.medicine_name,
                        note: item.note || "",
                        since: item.since || "",
                        severity: item.severity || ""
                    };
                    selectedMedicines.push(data);
                    addMedicineTag(data);
                });
                updateMedicinesHiddenInput();
            }
        });
    </script>

    <!-- ----------------------------------------------------------- -->
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

    <!-- Medication save script -->
    <script>
        $(document).ready(function () {
            function parseMedicineTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim();

                let match = text.match(/^(.+?)\s*\((.+)\)$/);
                if (match) {
                    let medicine = match[1].trim();
                    let detailsStr = match[2].trim();
                    let details = detailsStr.split(',').map(d => d.trim());

                    let parsed = { medicine: medicine, note: '', since: '', severity: '' };

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
                    return { medicine: text, note: '', since: '', severity: '' };
                }
            }

            function updateMedicinesJson() {
                let medicines = [];
                $('#medicinesInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim();
                    let medicine = parseMedicineTagText(tagText);

                    if (medicine) {
                        let medicineId = $(this).attr('data-id') || "new";
                        medicine.id = medicineId;
                        medicines.push(medicine);
                    }
                });
                $('#medicinesJson').val(JSON.stringify(medicines));
            }

            const observer = new MutationObserver(updateMedicinesJson);
            observer.observe(document.getElementById('medicinesInput'), { childList: true, subtree: true });

            $('#consultationForm').on('submit', function (e) {
                updateMedicinesJson();
            });
        });
    </script>

    <!-- Toggle visibility and icon for all fields -->
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

    <!-- Upload attachments script -->
    <script>
        (function () {
            const MAX_FILES = 10;
            const fileInput = document.getElementById("fileInput");
            const addBtn = document.getElementById("addFileBtn");
            const fileList = document.getElementById("fileList");
            const fileError = document.getElementById("fileError");
            const removedFilesInput = document.getElementById("removedFiles");

            let newFiles = [];
            let existingFiles = [];
            let removedFiles = [];

            existingFiles = <?php echo json_encode($attachments ?? []); ?>;

            renderFileList();

            addBtn.addEventListener("click", () => {
                if (newFiles.length + existingFiles.length >= MAX_FILES) {
                    fileError.textContent = `You can upload up to ${MAX_FILES} files only.`;
                    return;
                }
                fileInput.click();
            });

            fileInput.addEventListener("change", (e) => {
                fileError.textContent = "";
                if (!fileInput.files.length) return;

                for (let i = 0; i < fileInput.files.length; i++) {
                    if (newFiles.length + existingFiles.length >= MAX_FILES) {
                        fileError.textContent = `You can upload up to ${MAX_FILES} files only.`;
                        break;
                    }
                    newFiles.push(fileInput.files[i]);
                }

                renderFileList();
            });

            function renderFileList() {
                fileList.innerHTML = "";

                if (existingFiles.length + newFiles.length === 0) {
                    fileList.innerHTML = '<small class="text-muted">No files selected.</small>';
                    return;
                }

                const ul = document.createElement("ul");
                ul.style.paddingLeft = "1.2rem";

                existingFiles.forEach((file, index) => {
                    const li = document.createElement("li");
                    li.style.marginBottom = "6px";

                    const name = document.createTextNode(file.file_name + " ");
                    const removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.textContent = "✕";
                    removeBtn.className = "btn btn-sm btn-danger";
                    removeBtn.style.marginLeft = "8px";

                    removeBtn.addEventListener("click", () => {
                        removedFiles.push(file.file_name);
                        existingFiles.splice(index, 1);
                        removedFilesInput.value = JSON.stringify(removedFiles);
                        renderFileList();
                    });

                    li.appendChild(name);
                    li.appendChild(removeBtn);
                    ul.appendChild(li);
                });

                newFiles.forEach((file, index) => {
                    const li = document.createElement("li");
                    li.style.marginBottom = "6px";

                    const name = document.createTextNode(file.name + " ");
                    const removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.textContent = "✕";
                    removeBtn.className = "btn btn-sm btn-danger";
                    removeBtn.style.marginLeft = "8px";

                    removeBtn.addEventListener("click", () => {
                        newFiles.splice(index, 1);
                        renderFileList();
                    });

                    li.appendChild(name);
                    li.appendChild(removeBtn);
                    ul.appendChild(li);
                });

                fileList.appendChild(ul);
            }

            document.getElementById("consultationForm").addEventListener("submit", (e) => {
                const formData = new FormData(e.target);

                newFiles.forEach(file => {
                    formData.append("consultationFiles[]", file);
                });

            });
        })();
    </script>

    <!-- Attachment display modal script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const attachmentLinks = document.querySelectorAll(".openAttachment");
            const modal = new bootstrap.Modal(document.getElementById('attachmentModal'));
            const attachmentImage = document.getElementById('attachmentImage');
            const attachmentPDF = document.getElementById('attachmentPDF');
            const modalTitle = document.getElementById('attachmentModalLabel');

            attachmentLinks.forEach(link => {
                link.addEventListener("click", function () {
                    const file = this.getAttribute("data-file");
                    const ext = this.getAttribute("data-ext").toLowerCase();
                    const fileName = this.textContent;

                    // Set modal title with file name
                    modalTitle.textContent = `Attachment Preview - ${fileName}`;

                    // Hide both initially
                    attachmentImage.classList.add("d-none");
                    attachmentPDF.classList.add("d-none");

                    if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                        attachmentImage.src = file;
                        attachmentImage.classList.remove("d-none");
                    } else if (['pdf'].includes(ext)) {
                        attachmentPDF.src = file;
                        attachmentPDF.classList.remove("d-none");
                    } else {
                        alert("Preview not available for this file type.");
                        return;
                    }

                    modal.show();
                });
            });
        });
    </script>


    <!-- ******************************************************************************************************************************************** -->
    <!-- Sidebar active color change code -->
    <script>
        <?php if ($method == "consultDashboard" || $method == "followupConsult" || $method == "editConsult") { ?>
            document.getElementById('patients').style.color = "#87F7E3";
        <?php } ?>
    </script>

    <!-- Common Script -->
    <script src="<?php echo base_url(); ?>application/views/js/script.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- PDF Download link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


</body>

</html>