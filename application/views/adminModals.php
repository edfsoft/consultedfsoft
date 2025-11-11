<!-- Universal Delete confirmation Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="confirmLogoutLabel" style="font-family: Poppins, sans-serif;">
                    Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="deleteItemMessage">Are you sure you want to delete <strong id="deleteItemName"></strong>?</p>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <a id="deleteConfirmButton" href="#" style="background-color: #2b353bf5;"
                    class="btn text-light">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Universal Delete confirmation Script  -->
<script>
    document.addEventListener("click", (event) => {
        const deleteButton = event.target.closest(".delete-btn");
        if (!deleteButton) return;

        const id = deleteButton.dataset.id;
        const type = deleteButton.dataset.type;
        const name = deleteButton.dataset.name;

        const baseUrl = "<?= base_url(); ?>";
        const deleteUrl = `${baseUrl}Edfadmin/deleteItem/${type}/${id}`;

        document.getElementById("deleteItemName").textContent = name;
        document.getElementById("deleteConfirmButton").href = deleteUrl;
    });
</script>

<!-- Add and Edit medicine modal -->
<div class="modal fade" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="medicineModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="medicineModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Medicine</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="medicineForm" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="medicineId" id="medicineId" value="">

                    <label for="medicineName" class="form-label pb-2">Medicine Name <span
                            class="text-danger">*</span></label>
                    <input type="text" name="medicineName" id="medicineName" class="form-control"
                        placeholder="E.g. Dolo 650" required>

                    <label for="medicineComposition" class="form-label pb-2 mt-2">Composition <span
                            class="text-danger">*</span></label>
                    <input type="text" name="medicineComposition" id="medicineComposition" class="form-control"
                        placeholder="E.g. Paracetamol" required>

                    <label for="medicineCategory" class="form-label pb-2 mt-2">Category <span
                            class="text-danger">*</span></label>
                    <select name="medicineCategory" id="medicineCategory" class="form-select" required>
                        <option value="">Select Category</option>
                        <option value="TAB">Tablet</option>
                        <option value="CAP">Capsule</option>
                        <option value="SYR">Syrup</option>
                        <option value="INJ">Injection</option>
                        <option value="DROPS">Drops</option>
                        <option value="OINT">Ointment</option>
                        <option value="CREAM">Cream</option>
                        <option value="GEL">Gel</option>
                        <option value="SPRAY">Spray</option>
                        <option value="POW">Powder</option>
                        <option value="SUSP">Suppository</option>
                        <option value="INSULIN">Insulin</option>
                    </select>

                    <button type="submit" id="medicineSubmit" class="btn text-light float-end mt-3"
                        style="background-color: #2b353bf5;">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UNIVERSAL ADD MODAL -->
<div class="modal fade" id="universalAddModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="universalModalTitle" style="font-family: Poppins, sans-serif;">Add
                    New</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="universalAddForm" method="POST" enctype="multipart/form-data">
                    <label id="universalLabel" class="form-label pb-2"></label><span class="text-danger"> *</span><br>
                    <input type="text" name="" id="universalInput" class="form-control" placeholder="" required>
                    <br><br>
                    <button type="submit" style="background-color: #2b353bf5;"
                        class="btn text-light float-end">Add</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- UNIVERSAL ADD SCRIPT -->
<script>
    function openAddModal(type) {
        const modalTitle = document.getElementById("universalModalTitle");
        const label = document.getElementById("universalLabel");
        const input = document.getElementById("universalInput");
        const form = document.getElementById("universalAddForm");

        const config = {
            specialization: {
                title: "Add New Specialization", label: "Specialization Name",
                placeholder: "E.g. Diabetologist", name: "specializationName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/specialization'; ?>"
            },
            symptoms: {
                title: "Add New Symptom", label: "Symptom / Complaint Name",
                placeholder: "E.g. Head ache", name: "symptomName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/symptoms'; ?>"
            },
            findings: {
                title: "Add New Finding", label: "Finding Name",
                placeholder: "E.g. Blood Sugar High", name: "findingName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/findings'; ?>"
            },
            diagnosis: {
                title: "Add New Diagnosis", label: "Diagnosis Name",
                placeholder: "E.g. Diabetes", name: "diagnosisName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/diagnosis'; ?>"
            },
            investigation: {
                title: "Add New Investigation", label: "Investigation Name",
                placeholder: "E.g. ECG", name: "investigationsName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/investigations'; ?>"
            },
            instruction: {
                title: "Add New Instruction", label: "Instruction Name",
                placeholder: "E.g. Low fat in diet", name: "instructionsName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/instructions'; ?>"
            },
            procedure: {
                title: "Add New Procedure", label: "Procedure Name",
                placeholder: "E.g. Coronary angiogram", name: "proceduresName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/procedures'; ?>"
            },
            advice: {
                title: "Add New Advice", label: "Advice Name",
                placeholder: "E.g. Take rest", name: "advicesName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/advices'; ?>"
            }
        };

        const selected = config[type];
        if (!selected) return;

        modalTitle.textContent = selected.title;
        label.textContent = selected.label;
        input.placeholder = selected.placeholder;
        input.name = selected.name;
        form.action = selected.action;

        form.reset();

        const modal = new bootstrap.Modal(document.getElementById("universalAddModal"));
        modal.show();
    }
</script>

<!-- UNIVERSAL EDIT MODAL -->
<div class="modal fade" id="editCommonModal" tabindex="-1" aria-labelledby="editCommonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommonModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCommonForm" method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCommonId">

                    <div class="mb-3">
                        <label id="editCommonLabel" class="form-label"></label><span class="text-danger"> *</span>
                        <input type="text" class="form-control" id="editCommonName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-light" style="background-color: #2b353bf5;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- UNIVERSAL EDIT SCRIPT -->
<script>
    const waitForModal = setInterval(() => {
        const modal = document.getElementById('editCommonModal');
        if (modal) {
            clearInterval(waitForModal);

            const typeToController = {
                specialization: 'specialization',
                symptoms: 'symptoms',
                findings: 'findings',
                diagnosis: 'diagnosis',
                investigation: 'investigations',
                instruction: 'instructions',
                procedure: 'procedures',
                advice: 'advices'
            };

            const fieldLabels = {
                specialization: 'Specialization Name',
                symptoms: 'Symptom / Complaint Name',
                findings: 'Finding Name',
                diagnosis: 'Diagnosis Name',
                investigation: 'Investigation Name',
                instruction: 'Instruction Name',
                procedure: 'Procedure Name',
                advice: 'Advice Name'
            };

            document.body.addEventListener('click', function (e) {
                const btn = e.target.closest('.edit-btn');
                if (!btn) return;

                const type = btn.dataset.type;
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const cap = type.charAt(0).toUpperCase() + type.slice(1);

                document.getElementById('editCommonModalLabel')
                    .textContent = `Edit ${cap}`;

                document.getElementById('editCommonLabel')
                    .textContent = `${fieldLabels[type] || cap + ' Name'} `;

                document.getElementById('editCommonId').value = id;

                document.getElementById('editCommonName').value = name;

                const baseUrl = '<?php echo base_url(); ?>';
                const ctrl = typeToController[type] || type;
                document.getElementById('editCommonForm')
                    .action = `${baseUrl}Edfadmin/updateListItem/${ctrl}/${id}`;
            });

            console.log('Universal Edit Modal: Ready');
        }
    }, 50);
</script>

<!-- Patient Attachment Display Modal -->
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
                    style="height:43px;width:100%;background:#cccecfff;border-radius:5px;display:none;">
                    <button id="zoomOutBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom Out" disabled><b
                            style="font-size:1.2rem;">-</b></button>
                    <button id="zoomInBtn" class="btn btn-dark btn-sm mx-1 text-light" title="Zoom In" disabled><b
                            style="font-size:1.2rem;">+</b></button>
                    <button id="downloadAttachmentBtn" class="btn btn-secondary ms-3"><i
                            class="bi bi-download"></i></button>
                </div>

                <button id="prevAttachment"
                    class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y"
                    style="font-size:1.5rem;" disabled><b>&lt;</b></button>
                <button id="nextAttachment"
                    class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y"
                    style="font-size:1.5rem;" disabled><b>&gt;</b></button>

                <div class="preview-area">
                    <img id="attachmentImage" src="" alt="Attachment" class="img-fluid d-none"
                        style="transform-origin:top left;transition:transform .2s ease-out;">
                    <iframe id="attachmentPDF" src="" class="w-100" style="height:100%;border:none;"
                        frameborder="0"></iframe>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Log out confirmation -->
<div class="modal fade" id="confirmLogout" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="confirmLogoutLabel" style="font-family: Poppins, sans-serif;">
                    Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url() . "Edfadmin/logout" ?>">
                    <button class="btn text-light" style="background-color: #2b353bf5;">Logout</button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Not in use currently -->
<!--Display Message Popup Screen -->
<!-- <div class="modal fade" id="display_message_popup" tabindex="-1" aria-labelledby="errorModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php if ($this->session->flashdata('successMessage')) { ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Success</h5> <button type="button"
                                class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $this->session->flashdata('successMessage'); ?></p>
                        </div>
                    <?php }
                    if ($this->session->flashdata('errorMessage')) { ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error!</h5> <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $this->session->flashdata('errorMessage'); ?></p>
                        </div>
                    <?php } ?>
                    <div class="modal-footer"> <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Close</button> </div>
                </div>
            </div>
        </div> -->

<!-- Display Message Popup Screen Script -->
<!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            var messagePopup = document.getElementById('display_message_popup');

            if (messagePopup) {
                <?php if ($this->session->flashdata('successMessage') || $this->session->flashdata('errorMessage')) { ?>
                    var displayMessage = new bootstrap.Modal(messagePopup);
                    displayMessage.show();
                <?php } ?>
            }
        });
    </script> -->