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
        if ($method == "newConsultation") {
            ?>
            <section>
                <div class="card rounded">
                    <div class="d-flex justify-content-between mt-2 p-3 pt-sm-4 px-sm-4">
                        <p style="font-size: 24px; font-weight: 500">New Consultation </p>
                        <a href="<?php echo base_url() . "Healthcareprovider/patients" ?>"
                            class="float-end text-dark mt-2"><i class="bi bi-arrow-left"></i> Back</a>
                    </div>

                    <div class="card-body px-md-4 pb-2">
                        <!-- <p class="my-3 fs-5 fw-semibold">Patient's Info:</p> -->
                        <?php
                        foreach ($patientDetails as $key => $value) {
                            ?>
                            <div class="border border-2 rounded text-center py-2 position-relative">
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
                            </div>
                        <?php } ?>

                        <p class="mb-2 mt-4 fs-5 fw-semibold">Vitals:</p>
                        <div class="p-3">
                            <form action="<?php echo base_url() . 'Healthcareprovider/saveVitals' ?>" method="post"
                                id="vitalsForm" class="">
                                <input type="hidden" id="patientIdDb" name="patientIdDb" value="<?php echo $value['id'] ?>">
                                <input type="hidden" id="patientId" name="patientId"
                                    value="<?php echo $value['patientId'] ?>">
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
                                        <label class="form-label fieldLabel" for="patientWeight">Blood Pressure (Systolic)
                                        </label>
                                        <div class="d-flex me-4">
                                            <input type="text" class="form-control fieldStyle" id="patientSystolicBp"
                                                name="patientSystolicBp" placeholder="E.g. 120 (Systolic)">
                                            <p class="mx-2 my-2">mmHg</p>
                                        </div>
                                        <div id="patientSystolicBp_err" class="text-danger pt-1"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientHeight">Blood Pressure
                                            (Diastolic)</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control fieldStyle" id="patientDiastolicBp"
                                                name="patientDiastolicBp" placeholder="E.g. 80 (Diastolic)">
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
                                                name="patientsCholestrol" min="0" placeholder="E.g. 50">
                                            <p class="mx-2 my-2">mg/dL</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fieldLabel" for="patientBsugar">Blood Sugar </label>
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
                                        <label class="form-label fieldLabel" for="patientTemperature">Temperature </label>
                                        <div class="d-flex">
                                            <input type="number" class="form-control fieldStyle" id="patientTemperature"
                                                name="patientTemperature" min="0" placeholder="E.g. 98.6">
                                            <p class="mx-2 my-2">°F</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-flex justify-content-between mt-2">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" id="submitForm" class="btn text-light"
                                        style="background-color: #00ad8e;">Submit</button>
                                </div> -->
                            </form>
                        </div>
                        <p class="mb-2 mt-4 fs-5 fw-semibold">Consultation Details:</p>
                        <div class="p-3">
                            <form action="<?php echo base_url() . 'Healthcareprovider/saveDirectConsultation' ?>"
                                method="post" id="consultForm" class="containe col-md-9">
                                <input type="hidden" id="patientIdDb" name="patientIdDb" value="<?php echo $value['id'] ?>">
                                <input type="hidden" id="patientId" name="patientId"
                                    value="<?php echo $value['patientId'] ?>">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color:rgb(206, 206, 206);" role="button">
                                        <span><strong>Symptoms</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-containe mt-2">
                                        <select id="symptoms" name="symptoms[]" multiple="multiple" style="width:100%;">
                                            <?php foreach ($symptomsList as $key => $value) { ?>
                                                <option value="<?php echo $value['symptomsName'] ?>">
                                                    <?php echo $value['symptomsName'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong>Findings</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div id="findingsWrapper">
                                            <div class="mb-3 position-relative">
                                                <div class="tags-input" id="findingsInput">
                                                    <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                        id="searchInput" placeholder="Search or type to add..." />
                                                </div>
                                                <div class="suggestions-box" id="suggestionsBox"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong>Diagnosis</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <div class="mb-3 position-relative">
                                            <div class="tags-input" id="diagnosisInputBox">
                                                <input type="text" class="form-control border-0 p-0 m-0 shadow-none"
                                                    id="diagnosisInput" placeholder="Search or type to add diagnosis..." />
                                            </div>
                                            <div class="suggestions-box" id="diagnosisSuggestionsBox"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);" role="button">
                                        <span><strong>Investigations</strong></span>
                                        <span class="toggle-icon">+</span>
                                    </div>
                                    <div class="collapse field-container mt-2">
                                        <button type="button" class="btn btn-sm btn-danger clear-btn float-end">x</button>
                                        <textarea class="form-control mb-2" name="investigations" rows="3"
                                            placeholder="Enter investigations..."></textarea>
                                    </div>
                                </div>

                                <div id="medicine-template" class="card medicine-entry">
                                    <div class="card-header d-flex justify-content-between align-items-center p-2 rounded toggle-label"
                                        style="background-color: rgb(206, 206, 206);">
                                        <span class="text-dark"><strong>Medicines</strong></span>
                                        <button type="button" class="btn-close btn-remove d-none"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group py-3">
                                            <label class="form-label" for="preMedName">Medicine Name <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select preMedName" id="preMedName[]" name="preMedName[]">
                                                <option value="">Select Medicine</option>
                                                <?php
                                                foreach ($medicinesList as $key => $value) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>">
                                                        <?php echo $value['medicineBrand'] . " / " . $value['medicineName'] . " / " . $value['strength'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <div id="preMedName_err" class="text-danger pt-1"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label class="form-label" for="preMedFrequency">Frequency <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control preMedFrequency" name="preMedFrequency[]"
                                                placeholder="1 - 0 - 1" maxlength="9">
                                            <div id="preMedFrequency_err" class="text-danger pt-1"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label class="form-label" for="preMedDuration">Duration <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control preMedDuration"
                                                    name="preMedDuration[]" placeholder="Enter duration" min="1" max="31">
                                                <select class="form-select preMedDurationUnit" name="preMedDurationUnit[]">
                                                    <option value="days">Days</option>
                                                    <option value="weeks">Weeks</option>
                                                    <option value="months">Month</option>
                                                </select>
                                            </div>
                                            <div id="preMedDuration_err" class="text-danger pt-1 pe-2"></div>
                                            <!-- <div id="preMedDurationUnit_err" class="text-danger pt-1"></div> -->
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="preMedNotes">Notes <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select preMedNotes" name="preMedNotes[]">
                                                <option value=" ">Select Notes</option>
                                                <option value="Before food">Before Food</option>
                                                <option value="After food">After Food</option>
                                            </select>
                                            <div id="preMedNotes_err" class="text-danger pt-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="medicines-list"></div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="addMoreBtn" class="btn btn-secondary mt-0 mb-4"><i
                                            class="bi bi-plus-lg"></i> Medicine</button>
                                </div>
                                <div class="form-group pb-3">
                                    <label class="form-label" for="advices">Advice <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="advices" id="advices"
                                        placeholder="Enter the advice to patient"></textarea>
                                    <div id="advices_err" class="text-danger pt-1"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <label class="form-label" for="nextFollowUpDate">Next follow up <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="nextFollowUpDate" name="nextFollowUpDate">
                                    <div id="nextFollowUpDate_err" class="text-danger pt-1"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" id="submitForm" class="btn text-light"
                                        style="background-color: #00ad8e;">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>

            <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Enter Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="modalNote" class="form-label">Note</label>
                                <input type="text" class="form-control" id="modalNote" />
                            </div>
                            <div class="mb-3">
                                <label for="modalSince" class="form-label">Since</label>
                                <input type="text" class="form-control" id="modalSince" />
                            </div>
                            <div class="mb-3">
                                <label for="modalSeverity" class="form-label">Severity</label>
                                <select id="modalSeverity" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Mild">Mild</option>
                                    <option value="Moderate">Moderate</option>
                                    <option value="Severe">Severe</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" onclick="saveModal()">OK</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagnosis Modal -->
            <div class="modal fade" id="diagnosisModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Diagnosis Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="diagnosisNote" class="form-label">Note</label>
                                <input type="text" class="form-control" id="diagnosisNote">
                            </div>
                            <div class="mb-3">
                                <label for="diagnosisSince" class="form-label">Location</label>
                                <input type="text" class="form-control" id="diagnosisSince">
                            </div>
                            <div class="mb-3">
                                <label for="diagnosisSeverity" class="form-label">Description</label>
                                <select class="form-select" id="diagnosisSeverity">
                                    <option value="">Select</option>
                                    <option>To rule out</option>
                                    <option>Suspect</option>
                                    <option>Follow up</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" onclick="saveDiagnosisModal()">OK</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finding Script -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                    tag.className = "badge bg-primary tag";
                    tag.style.cursor = "pointer";
                    updateTagDisplay(tag, data);

                    tag.onclick = () => {
                        openModal(data.finding, data, tag);
                    };

                    const removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.className = "btn-close btn-close-white ms-2";
                    removeBtn.style.fontSize = "0.6rem";
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
            <!-- Diagonsis script -->
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
                    tag.className = "badge bg-success me-1 mb-1";
                    tag.style.cursor = "pointer";
                    updateDiagnosisTag(tag, data);

                    tag.onclick = () => {
                        openDiagnosisModal(data.name, data, tag);
                    };

                    const removeBtn = document.createElement("button");
                    removeBtn.type = "button";
                    removeBtn.className = "btn-close btn-close-white ms-2";
                    removeBtn.style.fontSize = "0.6rem";
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


            <!-- Medicine Add More Script -->
            <!-- <script>
                document.getElementById("addMoreBtn").addEventListener("click", function () {
                    const medicineContainer = document.getElementById("medicine-template");
                    const newMedicine = medicineContainer.cloneNode(true);

                    newMedicine.querySelectorAll("input, select").forEach(function (input) {
                        input.value = "";
                        const errorDiv = input.parentNode.querySelector('.text-danger');
                        if (errorDiv) {
                            errorDiv.textContent = '';
                        }
                    });

                    newMedicine.querySelector(".btn-remove").classList.remove("d-none");
                    newMedicine.querySelector(".btn-remove").addEventListener("click", function () {
                        newMedicine.remove();
                    });

                    document.getElementById("medicines-list").appendChild(newMedicine);
                });
            </script> -->
            <!-- Medicines Field Validation Script -->
            <!-- <script>
                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelectorAll(".preMedFrequency").forEach(function (frequencyInput) {
                        validateFrequencyPattern(frequencyInput);

                        frequencyInput.addEventListener("input", function (event) {
                            validateFrequencyPattern(event.target);
                        });
                    });
                });

                // document.getElementById("submitForm").addEventListener("click", function (event) {
                //     event.preventDefault();

                //     if (validateMedicines()) {
                //         document.getElementById("prescriptionForm").submit();
                //     }
                // });

                function validateFrequencyPattern(input) {
                    const frequencyPattern = /^[0-1]\s-\s[0-1]\s-\s[0-1]$/;
                    const errorDiv = input.closest(".medicine-entry").querySelector("#preMedFrequency_err");

                    let value = input.value.replace(/[^01]/g, '').substring(0, 3);
                    let formattedValue = '';
                    if (value.length > 0) formattedValue += value[0];
                    if (value.length > 1) formattedValue += ' - ' + value[1];
                    if (value.length > 2) formattedValue += ' - ' + value[2];
                    input.value = formattedValue;
                }

                function validateMedicines() {
                    let allFilled = true;

                    const adviceGiven = document.getElementById("adviceGiven");
                    const adviceGivenErr = document.getElementById("adviceGiven_err");
                    if (adviceGiven.value.trim() === "") {
                        adviceGivenErr.innerHTML = "Advice to patient must be filled out.";
                        allFilled = false;
                    } else {
                        adviceGivenErr.innerHTML = "";
                    }

                    const nextFollowUp = document.getElementById("nextFollowUp");
                    const nextFollowUpErr = document.getElementById("nextFollowUp_err");
                    if (nextFollowUp.value === "") {
                        nextFollowUpErr.innerHTML = "Next follow-up date must be filled out.";
                        allFilled = false;
                    } else {
                        nextFollowUpErr.innerHTML = "";
                    }

                    const medicineEntries = document.querySelectorAll(".medicine-entry:not(.d-none)");

                    medicineEntries.forEach(function (entry) {
                        const nameInput = entry.querySelector(".preMedName");
                        const frequencyInput = entry.querySelector(".preMedFrequency");
                        const durationInput = entry.querySelector(".preMedDuration");
                        // const durationUnitSelect = entry.querySelector(".preMedDurationUnit");
                        const notesSelect = entry.querySelector(".preMedNotes");

                        if (nameInput.value.trim() === "") {
                            entry.querySelector("#preMedName_err").innerHTML = "Medicine name must be filled out.";
                            allFilled = false;
                        } else {
                            entry.querySelector("#preMedName_err").innerHTML = "";
                        }

                        if (frequencyInput.value.trim() === "") {
                            entry.querySelector("#preMedFrequency_err").innerHTML = "Frequency must be filled out.";
                            allFilled = false;
                        } else {
                            entry.querySelector("#preMedFrequency_err").innerHTML = "";
                        }

                        if (durationInput.value.trim() === "") {
                            entry.querySelector("#preMedDuration_err").innerHTML = "Duration must be filled out.";
                            allFilled = false;
                        } else {
                            entry.querySelector("#preMedDuration_err").innerHTML = "";
                        }

                        // if (durationUnitSelect.value.trim() === "") {
                        //     entry.querySelector("#preMedDurationUnit_err").innerHTML = "Please select a duration unit.";
                        //     allFilled = false;
                        // } else {
                        //     entry.querySelector("#preMedDurationUnit_err").innerHTML = "";
                        // }

                        if (notesSelect.value.trim() === "") {
                            entry.querySelector("#preMedNotes_err").innerHTML = "Notes selection is required.";
                            allFilled = false;
                        } else {
                            entry.querySelector("#preMedNotes_err").innerHTML = "";
                        }
                    });

                    return allFilled;
                }
            </script> -->
            <!--  Multiple Select 2 Old Symptoms -->
            <!-- <script>
                $(document).ready(function () {
                    $('#symptoms').select2({
                        placeholder: 'Type to search and select symptoms',
                        allowClear: true
                    });
                });
            </script> -->
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
                        e.stopPropagation(); // Prevent toggling when clicking clear
                    });
                });
            </script>
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