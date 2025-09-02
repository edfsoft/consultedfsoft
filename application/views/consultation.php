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
    </style>
    <style>
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

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .nav-arrow.left {
            left: 10px;
        }

        .nav-arrow.right {
            right: 10px;
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
                                                        <div class="d-flex justify-content-between">
                                                            <h5 class="card-title">
                                                                <?= date('d M Y h:i A', strtotime($consultation['created_at'])) ?>
                                                            </h5>
                                                            <div class="mt-3">
                                                                <button class="btn btn-secondary" disabled><i
                                                                        class="bi bi-download"></i></button>
                                                                <button class="btn btn-secondary" disabled><i
                                                                        class="bi bi-pen"></i></button>
                                                                <button class="btn text-light" style="background-color: #00ad8e;"
                                                                    onclick="window.location.href='<?php echo site_url('Healthcareprovider/followupConsultation/' . $consultation['id']); ?>'">Follow-up
                                                                    / Repeat</button>
                                                            </div>
                                                        </div>
                                                        <!-- Vitals -->
                                                        <?php if (!empty($consultation['vitals'])): ?>
                                                            <p><strong>Vitals:</strong></p>
                                                            <ul>
                                                                <li>Weight: <?= $consultation['vitals']['weight_kg'] ?? 'N/A' ?> kg</li>
                                                                <li>Height: <?= $consultation['vitals']['height_cm'] ?? 'N/A' ?> cm</li>
                                                                <li>BP:
                                                                    <?= $consultation['vitals']['systolic_bp'] ?? 'N/A' ?>/<?= $consultation['vitals']['diastolic_bp'] ?? 'N/A' ?>
                                                                    mmHg
                                                                </li>
                                                                <li>Cholesterol:
                                                                    <?= $consultation['vitals']['cholesterol_mg_dl'] ?? 'N/A' ?> mg/dL
                                                                </li>
                                                                <li>Blood Sugar:
                                                                    <?= $consultation['vitals']['blood_sugar_mg_dl'] ?? 'N/A' ?> mg/dL
                                                                </li>
                                                                <li>SPO2: <?= $consultation['vitals']['spo2_percent'] ?? 'N/A' ?> %</li>
                                                                <li>Temperature:
                                                                    <?= $consultation['vitals']['temperature_f'] ?? 'N/A' ?> °F
                                                                </li>
                                                            </ul>
                                                        <?php endif; ?>

                                                        <!-- Symptoms -->
                                                        <?php if (!empty($consultation['symptoms'])): ?>
                                                            <p><strong>Symptoms:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['symptoms'] as $symptom): ?>
                                                                    <li><?= $symptom['symptom_name'] ?> (<?= $symptom['severity'] ?>,
                                                                        <?= $symptom['since'] ?>) - <?= $symptom['note'] ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>

                                                        <!-- Findings -->
                                                        <?php if (!empty($consultation['findings'])): ?>
                                                            <p><strong>Findings:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['findings'] as $finding): ?>
                                                                    <li><?= $finding['finding_name'] ?> (<?= $finding['severity'] ?>,
                                                                        <?= $finding['since'] ?>) - <?= $finding['note'] ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>

                                                        <!-- Diagnosis -->
                                                        <?php if (!empty($consultation['diagnosis'])): ?>
                                                            <p><strong>Diagnosis:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['diagnosis'] as $diagnosis): ?>
                                                                    <li><?= $diagnosis['diagnosis_name'] ?> (<?= $diagnosis['severity'] ?>,
                                                                        <?= $diagnosis['since'] ?>) - <?= $diagnosis['note'] ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>

                                                        <!-- Investigations -->
                                                        <?php if (!empty($consultation['investigations'])): ?>
                                                            <p><strong>Investigations:</strong></p>
                                                            <ul>
                                                                <?php foreach ($consultation['investigations'] as $inv): ?>
                                                                    <li><?= $inv['investigation_name'] ?></li>
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

                                                        <!-- Advice Given -->
                                                        <?php if (!empty($consultation['advice_given'])): ?>
                                                            <p><strong>Advice Given:</strong></p>
                                                            <ul>
                                                                <li><?= $consultation['advice_given'] ?></li>
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
                                    method="post" id="consultationForm" class="mb-5">
                                    <input type="hidden" id="patientIdDb" name="patientIdDb"
                                        value="<?php echo $patientDetails[0]['id'] ?>">
                                    <input type="hidden" id="patientId" name="patientId"
                                        value="<?php echo $patientDetails[0]['patientId'] ?>">

                                    <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>
                                    <div class="p-3">
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                        name="patientWeight" min="0" placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">Kg</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                        name="patientHeight" min="0" placeholder="E.g. 135">
                                                    <p class="mx-2 my-2">Cm</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientWeight">Blood Pressure
                                                    (Systolic)
                                                </label>
                                                <div class="d-flex me-4">
                                                    <input type="text" class="form-control fieldStyle"
                                                        id="patientSystolicBp" name="patientSystolicBp"
                                                        placeholder="E.g. 120 (Systolic)">
                                                    <p class="mx-2 my-2">mmHg</p>
                                                </div>
                                                <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientHeight">Blood Pressure
                                                    (Diastolic)</label>
                                                <div class="d-flex">
                                                    <input type="text" class="form-control fieldStyle"
                                                        id="patientDiastolicBp" name="patientDiastolicBp"
                                                        placeholder="E.g. 80 (Diastolic)">
                                                    <p class="mx-2 my-2">mmHg</p>
                                                </div>
                                                <!-- <div id="patientBp_err" class="text-danger pt-1"></div> -->
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel"
                                                    for="patientsCholestrol">Cholestrol</label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientsCholestrol" name="patientsCholestrol" min="0"
                                                        placeholder="E.g. 50">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientBsugar">Blood Sugar
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle" id="patientBsugar"
                                                        name="patientBsugar" min="0" placeholder="E.g. 200">
                                                    <p class="mx-2 my-2">mg/dL</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                                <div class="d-flex me-4">
                                                    <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                        name="patientSpo2" min="0" placeholder="E.g. 98">
                                                    <p class="mx-2 my-2">%</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control fieldStyle"
                                                        id="patientTemperature" name="patientTemperature" min="0"
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
                                                style="background-color: rgb(206, 206, 206);" role="button">
                                                <span><strong><i class="bi bi-patch-question me-2"></i>
                                                        Investigations</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <div class="mb-3">
                                                    <div class="input-group mb-2">
                                                        <input type="text" id="investigationSearch" class="form-control"
                                                            placeholder="Search investigations...">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            id="clearSearch">✖</button>
                                                        <button class="btn btn-outline-primary d-none" type="button"
                                                            id="addNew">+ Add</button>
                                                    </div>

                                                    <div id="investigationList">
                                                        <?php if (!empty($investigationsList)): ?>
                                                            <?php foreach ($investigationsList as $inv): ?>
                                                                <div class="form-check investigation-item">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="investigations[]"
                                                                        value="<?php echo htmlspecialchars($inv['investigationsName']); ?>"
                                                                        id="inv<?php echo (int) $inv['id']; ?>">
                                                                    <label class="form-check-label"
                                                                        for="inv<?php echo (int) $inv['id']; ?>">
                                                                        <?php echo htmlspecialchars($inv['investigationsName']); ?>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
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
                                                    <?php if (!empty($instructionsList)): ?>
                                                        <?php foreach ($instructionsList as $ins): ?>
                                                            <div class="form-check">
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
                                                <div class="mb-3">
                                                    <?php if (!empty($proceduresList)): ?>
                                                        <?php foreach ($proceduresList as $pro): ?>
                                                            <div class="form-check">
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
                                                data-bs-toggle="collapse" data-bs-target="#medicineField">
                                                <span><strong><i class="bi bi-capsule me-2"></i> Medicines</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="medicineField">
                                                <div>
                                                    <select class="form-select" id="medicineSelect">
                                                        <option value="">-- Select Medicine --</option>
                                                        <option value="Paracetamol">Paracetamol</option>
                                                        <option value="Amoxicillin">Amoxicillin</option>
                                                        <option value="Cetirizine">Cetirizine</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group pb-3">
                                        <label class="form-label fieldLabel" for="advices">Advice <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="advices" id="advices"
                                            placeholder="Enter the advice to patient"></textarea>
                                        <div id="advices_err" class="text-danger pt-1"></div>
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
                            id="consultationForm" class="mb-5">
                            <input type="hidden" id="patientIdDb" name="patientIdDb"
                                value="<?php echo $patientDetails[0]['id'] ?>">
                            <input type="hidden" id="patientId" name="patientId"
                                value="<?php echo $patientDetails[0]['patientId'] ?>">
                            <p class="fs-4 fw-semibold mb-3">Follow-up Consultation:</p>
                            <p class="mb-2 mt-0 pt-0 fs-5 fw-semibold">Vitals:</p>
                            <div class="p-3">
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientWeight">Weight </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientWeight"
                                                name="patientWeight" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['weight_kg']) ? $vitals['weight_kg'] : '' ?>">
                                            <p class="mx-2 my-2">Kg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientHeight">Height</label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientHeight"
                                                name="patientHeight" min="0" placeholder="E.g. 135"
                                                value="<?= isset($vitals['height_cm']) ? $vitals['height_cm'] : '' ?>">
                                            <p class="mx-2 my-2">Cm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientWeight">Blood Pressure
                                            (Systolic)
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="text" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120 (Systolic)"
                                                value="<?= isset($vitals['systolic_bp']) ? $vitals['systolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientHeight">Blood Pressure
                                            (Diastolic)</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control fieldStyle" id="patientDiastolicBp"
                                                name="patientDiastolicBp" placeholder="E.g. 80 (Diastolic)"
                                                value="<?= isset($vitals['diastolic_bp']) ? $vitals['diastolic_bp'] : '' ?>">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <!-- <div id="patientBp_err" class="text-danger pt-1"></div> -->
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientsCholestrol">Cholestrol</label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientsCholestrol"
                                                name="patientsCholestrol" min="0" placeholder="E.g. 50"
                                                value="<?= isset($vitals['blood_sugar_mg_dl']) ? $vitals['blood_sugar_mg_dl'] : '' ?>">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientBsugar">Blood Sugar
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientBsugar"
                                                name="patientBsugar" min="0" placeholder="E.g. 200"
                                                value="<?= isset($vitals['blood_sugar_mg_dl']) ? $vitals['blood_sugar_mg_dl'] : '' ?>">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientSpo2">SPO2 </label>
                                        <div class="d-flex me-4">
                                            <input type="number" class="form-control fieldStyle" id="patientSpo2"
                                                name="patientSpo2" min="0" placeholder="E.g. 98"
                                                value="<?= isset($vitals['spo2_percent']) ? $vitals['spo2_percent'] : '' ?>">
                                            <p class="mx-2 my-2">%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature
                                        </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" min="0" step="0.01" placeholder="E.g. 98.6"
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
                                        <span><strong>Symptoms</strong></span>
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
                                        <span><strong>Findings</strong></span>
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
                                        <span><strong>Diagnosis</strong></span>
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
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong>Investigations</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div class="mb-3">
                                            <?php if (!empty($symptomsList)): ?>
                                                <?php foreach ($symptomsList as $inv): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="investigations[]"
                                                            value="<?php echo htmlspecialchars($inv['symptomsName']); ?>"
                                                            id="inv<?php echo $inv['id']; ?>">
                                                        <label class="form-check-label" for="inv<?php echo $inv['id']; ?>">
                                                            <?php echo htmlspecialchars($inv['symptomsName']); ?>
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
                                        <span><strong>Instructions</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div class="mb-3">
                                            <?php if (!empty($symptomsList)): ?>
                                                <?php foreach ($symptomsList as $inv): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="instructions[]"
                                                            value="<?php echo htmlspecialchars($inv['symptomsName']); ?>"
                                                            id="inv<?php echo $inv['id']; ?>">
                                                        <label class="form-check-label" for="inv<?php echo $inv['id']; ?>">
                                                            <?php echo htmlspecialchars($inv['symptomsName']); ?>
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
                                        <span><strong>Procedures</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div class="mb-3">
                                            <?php if (!empty($symptomsList)): ?>
                                                <?php foreach ($symptomsList as $inv): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="procedures[]"
                                                            value="<?php echo htmlspecialchars($inv['symptomsName']); ?>"
                                                            id="inv<?php echo $inv['id']; ?>">
                                                        <label class="form-check-label" for="inv<?php echo $inv['id']; ?>">
                                                            <?php echo htmlspecialchars($inv['symptomsName']); ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="advices">Advice <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="advices" id="advices"
                                    placeholder="Enter the advice to patient"> <?= isset($consultation['advice_given']) ? $consultation['advice_given'] : '' ?></textarea>
                                <div id="advices_err" class="text-danger pt-1"></div>
                            </div>
                            <div class="form-group pb-3">
                                <label class="form-label fieldLabel" for="notes">Notes <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="notes" id="notes"
                                    placeholder="Enter the notes"> <?= isset($consultation['notes']) ? $consultation['notes'] : '' ?></textarea>
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
        <?php } ?>

        <!-- ******************************************************************************************************************************************** -->
        <!-- Symptoms Modal -->
        <div class="modal fade" id="symptomsModal" tabindex="-1" aria-labelledby="symptomsModalTitle"
            aria-hidden="true">
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
        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
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
        <div class="modal fade" id="diagnosisModal" tabindex="-1">
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

        <!-- Investigation Add New Modal -->
        <div class="modal fade" id="addInvestigationModal" tabindex="-1" aria-labelledby="addInvestigationLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                            id="addInvestigationLabel">Add New
                            Investigation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addInvestigationForm">
                            <div class="mb-3">
                                <label for="newInvestigationName" class="form-label fieldLabel">Investigation Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control fieldStyle" id="newInvestigationName"
                                    name="newInvestigationName" placeholder="Enter new investigation" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="addInvestigationForm" class="btn text-light"
                            style="background-color: #00ad8e;">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medicine Modal -->
        <div class="modal fade" id="medicineModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Medicine Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="medicineForm">
                            <div class="mb-3">
                                <label class="form-label">Medicine Name</label>
                                <input type="text" id="selectedMedicine" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dosage</label>
                                <input type="text" class="form-control" placeholder="e.g. 500mg">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Duration</label>
                                <input type="text" class="form-control" placeholder="e.g. 5 days">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Frequency</label>
                                <select class="form-select">
                                    <option>Once a day</option>
                                    <option>Twice a day</option>
                                    <option>Thrice a day</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-light" style="background-color: #00ad8e;">Save</button>
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

            if (editingSymptomTag && existingIndex !== -1) {
                // Update existing tag
                selectedSymptoms[existingIndex] = { symptom: pendingSymptom, note, since, severity };
                updateSymptomTagDisplay(editingSymptomTag, selectedSymptoms[existingIndex]);
            } else {
                const data = { symptom: pendingSymptom, note, since, severity };
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
            updateSymptomTagDisplay(tag, data);

            tag.onclick = () => {
                openSymptomModal(data.symptom, data, tag);
            };

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
        }

        function updateHiddenInput() {
            document.getElementById("symptomsJson").value = JSON.stringify(selectedSymptoms);
        }

        // Input events
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

        // ✅ PRELOAD symptoms for followup
        document.addEventListener("DOMContentLoaded", () => {
            const preloadSymptoms = <?php echo isset($symptoms) ? json_encode($symptoms) : '[]'; ?>;

            if (preloadSymptoms.length > 0) {
                preloadSymptoms.forEach(item => {
                    const data = {
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

            if (editingTagEl && existingIndex !== -1) {
                // Update existing tag
                selectedFindings[existingIndex] = { finding: pendingTag, note, since, severity };
                updateTagDisplay(editingTagEl, selectedFindings[existingIndex]);
            } else {
                const data = { finding: pendingTag, note, since, severity };
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
            updateTagDisplay(tag, data);

            tag.onclick = () => {
                openModal(data.finding, data, tag);
            };

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
        }

        function updateHiddenInput() {
            document.getElementById("findingsJson").value = JSON.stringify(selectedFindings);
        }

        // Input events
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

        // ✅ PRELOAD findings for followup
        document.addEventListener("DOMContentLoaded", () => {
            const preloadFindings = <?php echo isset($findings) ? json_encode($findings) : '[]'; ?>;

            if (preloadFindings.length > 0) {
                preloadFindings.forEach(item => {
                    const data = {
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

            document.querySelector('#diagnosisModal .modal-title').textContent =
                existing ? `Edit Diagnosis: ${name}` : `Diagnosis Details for: ${name}`;

            diagnosisNote.value = existing?.note || "";
            diagnosisSince.value = existing?.since || "";
            diagnosisSeverity.value = existing?.severity || "";

            diagnosisModal.show();
        }

        function saveDiagnosisModal() {
            const note = diagnosisNote.value.trim();
            const since = diagnosisSince.value.trim();
            const severity = diagnosisSeverity.value;

            const data = { name: pendingDiagnosis, note, since, severity };

            const index = selectedDiagnosis.findIndex(d => d.name === pendingDiagnosis);

            if (editingDiagnosisTag && index !== -1) {
                selectedDiagnosis[index] = data;
                updateDiagnosisTag(editingDiagnosisTag, data);
            } else {
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
            updateDiagnosisTag(tag, data);

            tag.onclick = () => {
                openDiagnosisModal(data.name, data, tag);
            };

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
            diagnosisTagContainer.insertBefore(tag, diagnosisInput);
        }

        function updateDiagnosisTag(tagEl, data) {
            let text = data.name;
            const details = [];
            if (data.note) details.push(`Note: ${data.note}`);
            if (data.since) details.push(`Since: ${data.since}`);
            if (data.severity) details.push(`Severity: ${data.severity}`);
            if (details.length) text += ` (${details.join(", ")})`;
            tagEl.innerHTML = text;
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

        // ✅ PRELOAD diagnosis for followup
        document.addEventListener("DOMContentLoaded", () => {
            const preloadDiagnosis = <?php echo isset($diagnosis) ? json_encode($diagnosis) : '[]'; ?>;

            if (preloadDiagnosis.length > 0) {
                preloadDiagnosis.forEach(item => {
                    const data = {
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

    <!-- Investigation search button -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('investigationSearch');
            const clearBtn = document.getElementById('clearSearch');
            const addBtn = document.getElementById('addNew');
            const list = document.getElementById('investigationList');
            const modalEl = document.getElementById('addInvestigationModal');
            const modal = (window.bootstrap && bootstrap.Modal) ? new bootstrap.Modal(modalEl) : null;
            const newInvestigationInput = document.getElementById('newInvestigationName');
            const addForm = document.getElementById('addInvestigationForm');

            function norm(s) { return s.toLowerCase().trim(); }

            function filter() {
                const q = norm(searchInput.value);
                let matches = 0;
                list.querySelectorAll('.investigation-item').forEach(item => {
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
                newInvestigationInput.value = searchInput.value.trim();
                if (modal) {
                    modal.show();
                } else {
                    modalEl.classList.add('show');
                    modalEl.style.display = 'block';
                }
            });

            addForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = newInvestigationInput.value.trim();
                if (!name) return;

                fetch("<?= site_url('Healthcareprovider/addInvestigation') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "name=" + encodeURIComponent(name)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            // Add to list with new DB id
                            const wrapper = document.createElement('div');
                            wrapper.className = 'form-check investigation-item';
                            wrapper.innerHTML = `
                    <input class="form-check-input" type="checkbox" 
                           name="investigations[]" 
                           value="${data.name}" 
                           id="inv${data.id}" checked>
                    <label class="form-check-label" for="inv${data.id}">${data.name}</label>
                `;
                            list.prepend(wrapper);

                            if (modal) { modal.hide(); }
                            searchInput.value = '';
                            filter();
                        } else {
                            alert(data.message || "Error saving investigation");
                        }
                    })
                    .catch(err => console.error(err));
            });

            filter();
        });
    </script>

    <!-- Medicine Modal Script -->
    <script>
        document.getElementById("medicineSelect").addEventListener("change", function () {
            let selected = this.value;
            if (selected) {
                document.getElementById("selectedMedicine").value = selected;
                let modal = new bootstrap.Modal(document.getElementById("medicineModal"));
                modal.show();
            }
        });
    </script>

    <!-- ----------------------------------------------------------- -->
    <!-- Symptoms save script -->
    <script>
        $(document).ready(function () {
            // Function to parse a tag's text back into an object
            function parseSymptomTagText(text) {
                text = text.trim().replace(/&times;$/g, '').trim();

                let regex = /^(.+?)\s*\(Note:\s*(.+?),\s*Since:\s*(.+?),\s*Severity:\s*(.+?)\)$/;
                let match = text.match(regex);
                if (match) {
                    return {
                        symptom: match[1].trim(),
                        note: match[2].trim(),
                        since: match[3].trim(),
                        severity: match[4].trim()
                    };
                }

                regex = /^(.+?)$/;
                match = text.match(regex);
                if (match) {
                    return {
                        symptom: match[1].trim(),
                        note: '',
                        since: '',
                        severity: ''
                    };
                }

                return null;
            }

            // Update hidden input by parsing displayed tags
            function updateSymptomsJson() {
                let symptoms = [];
                $('#symptomsInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim();
                    let symptom = parseSymptomTagText(tagText);
                    if (symptom) {
                        symptoms.push(symptom);
                    }
                });
                $('#symptomsJson').val(JSON.stringify(symptoms));
                // console.log('Symptoms JSON updated:', $('#symptomsJson').val());
            }

            // Use MutationObserver to detect changes in the tag container
            const observer = new MutationObserver(updateSymptomsJson);
            observer.observe(document.getElementById('symptomsInput'), { childList: true, subtree: true });

            // Also update before form submission
            $('#consultationForm').on('submit', function (e) {
                updateSymptomsJson();
            });
        });
    </script>
    <!-- Findings save script -->
    <script>
        $(document).ready(function () {
            // Function to parse a tag's text back into an object
            function parseTagText(text) {
                // Clean up text: remove any extra spaces or button content
                text = text.trim().replace(/&times;$/g, '').trim(); // Remove remove button if any

                let regex = /^(.+?)\s*\(Note:\s*(.+?),\s*Since:\s*(.+?),\s*Severity:\s*(.+?)\)$/;
                let match = text.match(regex);
                if (match) {
                    return {
                        name: match[1].trim(),
                        note: match[2].trim(),
                        since: match[3].trim(),
                        severity: match[4].trim()
                    };
                }

                // If no details, just the finding name
                regex = /^(.+?)$/;
                match = text.match(regex);
                if (match) {
                    return {
                        name: match[1].trim(),
                        note: '',
                        since: '',
                        severity: ''
                    };
                }

                return null;
            }

            // Update hidden input by parsing displayed tags
            function updateFindingsJson() {
                let findings = [];
                $('#findingsInput > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim(); // Get text without child elements (e.g., remove button)
                    let finding = parseTagText(tagText);
                    if (finding) {
                        findings.push(finding);
                    }
                });
                $('#findingsJson').val(JSON.stringify(findings));
                console.log('Findings JSON updated:', $('#findingsJson').val()); // Debug
            }

            // Use MutationObserver to detect changes in the tag container
            const observer = new MutationObserver(updateFindingsJson);
            observer.observe(document.getElementById('findingsInput'), { childList: true, subtree: true });

            // Also update before form submission
            $('#consultationForm').on('submit', function (e) {
                updateFindingsJson(); // Ensure latest data
                console.log('Form submitting with findingsJson:', $('#findingsJson').val()); // Debug
                // Form will submit normally
            });
        });
    </script>
    <!-- Diagnosis save script -->
    <script>
        $(document).ready(function () {
            // Function to parse a tag's text back into an object
            function parseDiagnosisTagText(text) {
                // Clean up text: remove any extra spaces or button content
                text = text.trim().replace(/&times;$/g, '').trim(); // Remove remove button if any

                let regex = /^(.+?)\s*\(Note:\s*(.+?),\s*Since:\s*(.+?),\s*Severity:\s*(.+?)\)$/;
                let match = text.match(regex);
                if (match) {
                    return {
                        name: match[1].trim(),
                        note: match[2].trim(),
                        since: match[3].trim(),
                        severity: match[4].trim()
                    };
                }

                // If no details, just the diagnosis name
                regex = /^(.+?)$/;
                match = text.match(regex);
                if (match) {
                    return {
                        name: match[1].trim(),
                        note: '',
                        since: '',
                        severity: ''
                    };
                }

                return null;
            }

            // Update hidden input by parsing displayed tags
            function updateDiagnosisJson() {
                let diagnoses = [];
                $('#diagnosisInputBox > span.bg-success').each(function () {
                    let tagText = $(this).clone().children().remove().end().text().trim(); // Get text without child elements (e.g., remove button)
                    let diagnosis = parseDiagnosisTagText(tagText);
                    if (diagnosis) {
                        diagnoses.push(diagnosis);
                    }
                });
                $('#diagnosisJson').val(JSON.stringify(diagnoses));
                console.log('Diagnosis JSON updated:', $('#diagnosisJson').val()); // Debug
            }

            // Use MutationObserver to detect changes in the tag container
            const diagnosisObserver = new MutationObserver(updateDiagnosisJson);
            diagnosisObserver.observe(document.getElementById('diagnosisInputBox'), { childList: true, subtree: true });

            // Also update before form submission
            $('#consultationForm').on('submit', function (e) {
                updateDiagnosisJson(); // Ensure latest data
                console.log('Form submitting with diagnosisJson:', $('#diagnosisJson').val()); // Debug
                // Form will submit normally
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


    <!-- ******************************************************************************************************************************************** -->
    <!-- Sidebar active color change code -->
    <script>
        <?php if ($method == "consultDashboard" || $method == "followupConsult") { ?>
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