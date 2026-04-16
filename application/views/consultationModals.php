<!-- Symptoms Modal -->
<div class="modal fade" id="symptomsModal" tabindex="-1" aria-labelledby="symptomsModalTitle" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="symptomsModalTitle" style="font-family: Poppins, sans-serif;">
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
                <button class="btn text-light" style="background-color: #00ad8e;" onclick="saveModal()">OK</button>
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
                <input type="text" id="newProcedureName" class="form-control" name="name" placeholder="Procedure name"
                    required>
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
                <h5 class="modal-title fw-medium" id="addMedicineModalTitle" style="font-family: Poppins, sans-serif;">
                    Add New Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label for="newMedicineName" class="form-label fieldLabel pb-2">Medicine Name <span
                        class="text-danger">*</span></label>
                <input type="text" id="newMedicineName" class="form-control" placeholder="E.g. Dolo 650" required>

                <label for="newMedicineComposition" class="form-label fieldLabel pb-2 mt-2">Composition
                    Name</label>
                <input type="text" id="newMedicineComposition" class="form-control" placeholder="E.g. Paracetamol">

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
<div class="modal fade" id="deleteMedicineMasterModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
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
                                    <input class="form-check-input" type="radio" name="foodTiming" value="Before"
                                        id="beforeFood">
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
                                    style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5" disabled
                                    placeholder="Qty">
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
                                    style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5" disabled
                                    placeholder="Qty">
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
                                    style="min-width: 110px; width: 100%; max-width: 200px;" min="0" step="0.5" disabled
                                    placeholder="Qty">
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
                <h5 class="modal-title fw-medium" id="adviceModalTitle" style="font-family: Poppins, sans-serif;">
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
                    <button id="zoomOutBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom Out" disabled>
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
                    <iframe id="attachmentPDF" src="" class="w-100" style="height:500px;" frameborder="0"></iframe>
                </div>

                <button id="nextAttachment"
                    class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                    style="font-size: 1.5rem;" disabled><b>&gt;</b></button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
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
                <h5 class="modal-title fw-medium" id="universalMasterTitle" style="font-family: Poppins, sans-serif;">
                    Add New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label for="universalMasterInput" id="universalMasterLabel" class="form-label fieldLabel">Name
                    <span class="text-danger">*</span></label>
                <input type="text" id="universalMasterInput" class="form-control" name="name" placeholder="Enter name"
                    required>

                <input type="hidden" id="universalMasterId" value=""> <input type="hidden" id="universalMasterType"
                    value="">
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

<!-- Delete Confirmation Modal - consultation, sugar chart, discharge followup  -->
<div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-labelledby="globalDeleteModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-3 shadow">
            <div class="modal-header text-dark rounded-top-3">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;" id="globalDeleteModalLabel">
                    Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" id="globalDeleteModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmGlobalDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Discharge Follow-up Plan -->
<div class="modal fade" id="followupModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Add Post-Discharge
                    Follow-up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('Consultation/saveDischargeFollowUp'); ?>" method="post" id="followupForm"
                onsubmit="return validateFollowupForm();">

                <div class="modal-body">
                    <input type="hidden" name="patient_id" id="modal_patient_id">

                    <div class="row">

                        <!-- Appointment -->
                        <div class="col-md-6">
                            <label class="form-label fieldLabel">Appointment Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="appointment_date" id="appointment_date"
                                class="form-control fieldStyle">
                            <small id="appointment_date_err" class="text-danger"></small>
                        </div>

                        <!-- Discharge -->
                        <div class="col-md-6">
                            <label class="form-label fieldLabel">Discharge Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="discharge_date" id="discharge_date"
                                class="form-control fieldStyle">
                            <small id="discharge_date_err" class="text-danger"></small>
                        </div>

                        <!-- Review -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label fieldLabel">Next Review Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="next_review_date" id="next_review_date"
                                class="form-control fieldStyle">
                            <small id="review_date_err" class="text-danger"></small>
                        </div>

                        <!-- Interval -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label fieldLabel">Follow-up Interval (Days)</label>
                            <input type="number" name="followup_interval_days" id="interval_days"
                                class="form-control fieldStyle" value="7" min="1">
                            <small id="interval_err" class="text-danger"></small>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label fieldLabel">Notes</label>
                            <textarea name="notes" class="form-control" placeholder="Enter the notes"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-light" style="background-color:#00ad8e;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Discharge follow-up plan modal trigger script -->
<script>
    document.getElementById('openFollowupModal').addEventListener('click', function () {
        var patientId = this.getAttribute('data-patient-id');

        document.getElementById('modal_patient_id').value = patientId;

        var modal = new bootstrap.Modal(document.getElementById('followupModal'));
        modal.show();
    });

    function validateFollowupForm() {

        let isValid = true;

        let appointment = document.getElementById('appointment_date').value;
        let discharge = document.getElementById('discharge_date').value;
        let review = document.getElementById('next_review_date').value;
        let interval = document.getElementById('interval_days').value;

        document.getElementById('appointment_date_err').innerText = '';
        document.getElementById('discharge_date_err').innerText = '';
        document.getElementById('review_date_err').innerText = '';
        document.getElementById('interval_err').innerText = '';

        if (!appointment) {
            document.getElementById('appointment_date_err').innerText = 'Appointment date is required';
            isValid = false;
        }

        if (!discharge) {
            document.getElementById('discharge_date_err').innerText = 'Discharge date is required';
            isValid = false;
        }

        if (!review) {
            document.getElementById('review_date_err').innerText = 'Review date is required';
            isValid = false;
        }

        if (!interval) {
            document.getElementById('interval_err').innerText = 'Interval is required';
            isValid = false;
        }

        if (!isValid) return false;

        let appDate = new Date(appointment);
        let disDate = new Date(discharge);
        let revDate = new Date(review);

        if (appDate > disDate) {
            document.getElementById('appointment_date_err').innerText =
                'Appointment date must be before or same as discharge date';
            isValid = false;
        }

        if (revDate <= disDate) {
            document.getElementById('review_date_err').innerText =
                'Review date must be after discharge date';
            isValid = false;
        }

        if (interval < 1) {
            document.getElementById('interval_err').innerText =
                'Interval must be at least 1 day';
            isValid = false;
        }

        let diffDays = Math.floor((revDate - disDate) / (1000 * 60 * 60 * 24));

        if (interval > diffDays) {
            document.getElementById('interval_err').innerText =
                'Interval must not exceed the days between discharge and review date';
            isValid = false;
        }
        return isValid;
    }
</script>