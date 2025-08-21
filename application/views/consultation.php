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
        if ($method == "newConsultation") { ?>
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
                        <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
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
                                    <?php foreach ($consultations as $consultation): ?>
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title">Consultation on
                                                    <?= date('d-m-Y h:i A', strtotime($consultation['created_at'])) ?>
                                                </h5>

                                                <!-- Vitals -->
                                                <?php if (!empty($consultation['vitals'])): ?>
                                                    <p><strong>Vitals:</strong></p>
                                                    <ul>
                                                        <li>Pulse: <?= $consultation['vitals']['pulse'] ?? 'N/A' ?></li>
                                                        <li>BP: <?= $consultation['vitals']['bp'] ?? 'N/A' ?></li>
                                                        <li>Temperature: <?= $consultation['vitals']['temperature'] ?? 'N/A' ?></li>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Symptoms -->
                                                <?php if (!empty($consultation['symptoms'])): ?>
                                                    <p><strong>Symptoms:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['symptoms'] as $symptom): ?>
                                                            <li><?= $symptom['symptom_name'] ?>
                                                                (<?= $symptom['severity'] ?>, <?= $symptom['since'] ?>)
                                                                - <?= $symptom['note'] ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Findings -->
                                                <?php if (!empty($consultation['findings'])): ?>
                                                    <p><strong>Findings:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['findings'] as $finding): ?>
                                                            <li><?= $finding['finding_name'] ?>
                                                                (<?= $finding['severity'] ?>, <?= $finding['since'] ?>)
                                                                - <?= $finding['note'] ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Diagnosis -->
                                                <?php if (!empty($consultation['diagnosis'])): ?>
                                                    <p><strong>Diagnosis:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['diagnosis'] as $diagnosis): ?>
                                                            <li><?= $diagnosis['diagnosis_name'] ?>
                                                                (<?= $diagnosis['severity'] ?>, <?= $diagnosis['since'] ?>)
                                                                - <?= $diagnosis['note'] ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <!-- Investigations -->
                                                <?php if (!empty($consultation['investigations'])): ?>
                                                    <p><strong>Investigations:</strong></p>
                                                    <ul>
                                                        <?php foreach ($consultation['investigations'] as $inv): ?>
                                                            <li><?= $inv['investigation_name'] ?> </li>
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
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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
                                    <!-- <input type="hidden" id="patientIdDb" name="patientIdDb" value="84">
                                    <input type="hidden" id="patientId" name="patientId" value="EDF000031"> -->

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
                                                        placeholder="E.g. 98.6">
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
                                                <span><strong>Symptoms</strong></span>
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
                                                    <!-- Display added symptoms -->
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="symptomsJson" id="symptomsJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#findingsCollapse">
                                                <span><strong>Findings</strong></span>
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
                                                    <!-- Display added findings -->
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="findingsJson" id="findingsJson">

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-toggle="collapse" data-target="#diagnosisCollapse">
                                                <span><strong>Diagnosis</strong></span>
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
                                                <span><strong>Investigations</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <!-- <textarea class="form-control mb-2" name="investigations" rows="3"
                                                    placeholder="Enter investigations..."></textarea> -->
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]"
                                                            value="PPBS-Postprandial Blood Sugar Test" id="inv1">
                                                        <label class="form-check-label" for="inv1">PPBS - Postprandial Blood
                                                            Sugar Test</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="Serum Creatinine" id="inv2">
                                                        <label class="form-check-label" for="inv2">Serum Creatinine</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]"
                                                            value="CBC - Complete Blood Count Haemogram" id="inv3">
                                                        <label class="form-check-label" for="inv3">CBC - Complete Blood
                                                            Count Haemogram</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="FBS- Fasting Blood Sugar"
                                                            id="inv4">
                                                        <label class="form-check-label" for="inv4">FBS - Fasting Blood
                                                            Sugar</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="SGOT/SGPT" id="inv5">
                                                        <label class="form-check-label" for="inv5">SGOT / SGPT</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="HbA1c Test" id="inv6">
                                                        <label class="form-check-label" for="inv6">HbA1c Test</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="Lipid Profile Test" id="inv7">
                                                        <label class="form-check-label" for="inv7">Lipid Profile
                                                            Test</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="D Dimer" id="inv8">
                                                        <label class="form-check-label" for="inv8">D Dimer</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="CRP" id="inv9">
                                                        <label class="form-check-label" for="inv9">CRP</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="investigations[]" value="ECG" id="inv10">
                                                        <label class="form-check-label" for="inv10">ECG</label>
                                                    </div>
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
                                                <button type="button"
                                                    class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Low fat in diet" id="inst1">
                                                        <label class="form-check-label" for="inst1">Low fat in diet</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Plenty of fluids" id="inst2">
                                                        <label class="form-check-label" for="inst2">Plenty of fluids</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Diet & exercise as advised"
                                                            id="inst3">
                                                        <label class="form-check-label" for="inst3">Diet & exercise as
                                                            advised</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]"
                                                            value="Plenty of green vegetables & fruits" id="inst4">
                                                        <label class="form-check-label" for="inst4">Plenty of green
                                                            vegetables &
                                                            fruits</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Diet 1500 Kcal for Diabetes"
                                                            id="inst5">
                                                        <label class="form-check-label" for="inst5">Diet 1500 Kcal for
                                                            Diabetes</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]"
                                                            value="Self monitoring of blood glucose (SMBG) as advised"
                                                            id="inst6">
                                                        <label class="form-check-label" for="inst6">Self monitoring of blood
                                                            glucose (SMBG) as advised</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Luke warm water to drink"
                                                            id="inst7">
                                                        <label class="form-check-label" for="inst7">Luke warm water to
                                                            drink</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]"
                                                            value="High protein diet suggested - soya bean, sprouts of moong, moth, black grams, egg"
                                                            id="inst8">
                                                        <label class="form-check-label" for="inst8">High protein diet
                                                            suggested
                                                            - soya bean, sprouts of moong, moth, black grams, egg</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]"
                                                            value="Add healthy foods to your diet like green leafy vegetables, fruits, whole grains, lean protein, beans, nuts, dairy"
                                                            id="inst9">
                                                        <label class="form-check-label" for="inst9">Add healthy foods to
                                                            your
                                                            diet like green leafy vegetables, fruits, whole grains, lean
                                                            protein, beans, nuts, dairy</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="instructions[]" value="Low Salt in diet" id="inst10">
                                                        <label class="form-check-label" for="inst10">Low Salt in
                                                            diet</label>
                                                    </div>
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
                                                <button type="button"
                                                    class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                                <div class="mb-3">
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="Coronary angiogram">
                                                        Coronary angiogram
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="HD - Hemodialysis">
                                                        HD - Hemodialysis
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]" value="Colonoscopy">
                                                        Colonoscopy
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]" value="Injection">
                                                        Injection
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]" value="Catheterization">
                                                        Catheterization
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="Debridement of infected wound/fistula/sinus">
                                                        Debridement of infected wound/fistula/sinus
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]" value="Circumcision">
                                                        Circumcision
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="Abscess - small, or cellulitis requiring incision and drainage with local anaesthetic">
                                                        Abscess - small, or cellulitis requiring incision and drainage with
                                                        local anaesthetic
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="Debridement of infected wound area & closure">
                                                        Debridement of infected wound area & closure
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="procedures[]"
                                                            value="Pleural Aspiration">
                                                        Pleural Aspiration
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Medicine section -->
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                                style="background-color: rgb(206, 206, 206);" role="button"
                                                data-bs-toggle="collapse" data-bs-target="#medicineField">
                                                <span><strong>Medicines</strong></span>
                                                <span class="toggle-icon">+</span>
                                            </div>
                                            <div class="collapse field-container mt-2" id="medicineField">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger clear-btn float-end">x</button>
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

                                    <!-- <div class="form-group pb-3">
                                        <label class="form-label" for="advices">Advice <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="advices" id="advices"
                                            placeholder="Enter the advice to patient"></textarea>
                                        <div id="advices_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label class="form-label" for="nextFollowUpDate">Next follow up <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="nextFollowUpDate"
                                            name="nextFollowUpDate">
                                        <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                                    </div> -->

                                    <button type="submit" id="submitForm" class="mt-2 float-end btn text-light"
                                        style="background-color: #00ad8e;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ******************************************************************************************************************************************** -->
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
                                    <input type="text" class="form-control" id="diagnosisSince"
                                        placeholder="Enter location">
                                </div>
                                <div class="mb-3">
                                    <label for="diagnosisSeverity" class="form-label">Description</label>
                                    <select class="form-select" id="diagnosisSeverity">
                                        <option value="">Select description</option>
                                        <option>To rule out</option>
                                        <option>Suspect</option>
                                        <option>Follow up</option>
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
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ******************************************************************************************************************************************** -->

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Symptoms Modal Script -->
                <script>
                    const symptomsList = [
                        "bodyache", "fever", "headache", "followup cough", "cold"
                    ];

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
                    }

                    function addSymptomTag(data) {
                        const tag = document.createElement("span");
                        tag.className = "bg-success rounded-2 text-light p-2";
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
                </script>

                <!-- Finding Modal Script -->
                <script>
                    const findingsList = [
                        "Blood Sugar High",
                        "DYSLIPIDEMIA",
                        "Foot swelling",
                        "Burning sensation in urine",
                        "HIGH BP",
                        "Asymptomatic",
                        "Heart Sounds",
                        "Post Covid 19",
                        "Dysuria",
                        "Post Covid 19 weakness",
                        "GIDDINESS"
                    ];

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
                    }

                    function addTag(data) {
                        const tag = document.createElement("span");
                        tag.className = "bg-success rounded-2 text-light p-2";
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
                </script>

                <!-- Diagonsis Modal Script -->
                <script>
                    const diagnosisList = [
                        "Diabetes", "Hypertension", "Asthma", "Tuberculosis", "Anemia", "Arthritis"
                    ];

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

                        // ✅ Set the title like this:
                        document.querySelector('#diagnosisModal .modal-title').textContent =
                            `Diagnosis Details for: ${name}`;

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
                    }

                    function addDiagnosisTag(data) {
                        const tag = document.createElement("span");
                        tag.className = "bg-success rounded-2 text-light p-2";
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

                <!-- ******************************************************************************************************************************************** -->


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

                    document.querySelectorAll('.clear-btn').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const textarea = button.parentElement.querySelector('textarea');
                            textarea.value = '';
                            e.stopPropagation();
                        });
                    });
                </script>

            </section>
        <?php } ?>

        <!-- All modal files -->
        <?php include 'hcpModals.php'; ?>
    </main>

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