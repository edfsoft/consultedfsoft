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

                    <label for="medicineComposition" class="form-label pb-2 mt-2">Composition</label>
                    <input type="text" name="medicineComposition" id="medicineComposition" class="form-control"
                        placeholder="E.g. Paracetamol">

                    <label for="medicineCategory" class="form-label pb-2 mt-2">Category</label>
                    <select name="medicineCategory" id="medicineCategory" class="form-select">
                        <option value="">Select Category</option>
                        <?php if (!empty($medicineCategories)) { ?>
                            <?php foreach ($medicineCategories as $cat) { ?>
                                <option value="<?php echo htmlspecialchars($cat['category']); ?>">
                                    <?php echo htmlspecialchars($cat['category']); ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
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

        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Add';
        }

        const config = {
            specialization: {
                title: "Add New Specialization",
                label: "Specialization Name",
                placeholder: "E.g. Diabetologist",
                name: "specializationName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/specialization'; ?>"
            },
            symptoms: {
                title: "Add New Symptom",
                label: "Symptom / Complaint Name",
                placeholder: "E.g. Head ache",
                name: "symptomName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/symptoms'; ?>"
            },
            findings: {
                title: "Add New Finding",
                label: "Finding Name",
                placeholder: "E.g. Blood Sugar High",
                name: "findingName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/findings'; ?>"
            },
            diagnosis: {
                title: "Add New Diagnosis",
                label: "Diagnosis Name",
                placeholder: "E.g. Diabetes",
                name: "diagnosisName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/diagnosis'; ?>"
            },
            investigation: {
                title: "Add New Investigation",
                label: "Investigation Name",
                placeholder: "E.g. ECG",
                name: "investigationsName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/investigations'; ?>"
            },
            instruction: {
                title: "Add New Instruction",
                label: "Instruction Name",
                placeholder: "E.g. Low fat in diet",
                name: "instructionsName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/instructions'; ?>"
            },
            procedure: {
                title: "Add New Procedure",
                label: "Procedure Name",
                placeholder: "E.g. Coronary angiogram",
                name: "proceduresName",
                action: "<?php echo base_url() . 'Edfadmin/addListItem/procedures'; ?>"
            },
            advice: {
                title: "Add New Advice",
                label: "Advice Name",
                placeholder: "E.g. Take rest",
                name: "advicesName",
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

    document.addEventListener('DOMContentLoaded', (event) => {
        const universalForm = document.getElementById('universalAddForm');

        if (universalForm) {
            universalForm.addEventListener('submit', function (e) {
                const submitButton = universalForm.querySelector('button[type="submit"]');

                if (submitButton) {
                    if (submitButton.disabled) {
                        e.preventDefault();
                        return;
                    }
                    submitButton.disabled = true;
                    submitButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...`;
                }
            });
        }
    });
</script>

<!-- UNIVERSAL EDIT MODAL -->
<div class="modal fade" id="editCommonModal" tabindex="-1" aria-labelledby="editCommonModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;" id="editCommonModalLabel">
                    Edit Item</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
                const editForm = document.getElementById('editCommonForm');
                const submitButton = editForm.querySelector('button[type="submit"]');

                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Update'; // Reset to "Update" 
                }
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
            const editForm = document.getElementById('editCommonForm');
            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    const submitButton = editForm.querySelector('button[type="submit"]');
                    if (submitButton) {
                        if (submitButton.disabled) {
                            e.preventDefault();
                            return;
                        }
                        submitButton.disabled = true;
                        submitButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...`;
                    }
                });
            }
            console.log('Universal Edit Modal: Ready (with n-click fix)');
        }
    }, 50);
</script>

<!-- Universal Delete confirmation Modal and also for delete Medicine category-->
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

<!-- To delete HCP, CC, Patient -->
<div class="modal fade" id="SecondconfirmDelete" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true"
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

<!-- script to delete hcp, cc, patient -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmDeleteModal = document.getElementById('SecondconfirmDelete');

        if (confirmDeleteModal) {
            confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const type = button.getAttribute('data-type'); // 'hcp', 'cc', or 'patient'

                const modalTitleName = confirmDeleteModal.querySelector('#deleteItemName');
                if (modalTitleName) modalTitleName.textContent = name;

                const deleteBtn = confirmDeleteModal.querySelector('#deleteConfirmButton');
                let deleteUrl = '#';

                switch (type) {
                    case 'hcp':
                        deleteUrl = `${baseUrl}Edfadmin/deleteHcp/${id}`;
                        break;
                    case 'cc':
                        deleteUrl = `${baseUrl}Edfadmin/deleteCc/${id}`;
                        break;
                    case 'patient':
                        deleteUrl = `${baseUrl}Edfadmin/deletePatient/${id}`;
                        break;
                    default:
                        console.error('Unknown delete type: ' + type);
                }

                if (deleteBtn) deleteBtn.setAttribute('href', deleteUrl);
            });
        }
    });
</script>

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

<!-- Movable Add, Edit, Add medicines, Edit Medicines, Category Modals script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const draggableModalIds = ['#medicineModal', '#editCommonModal', '#universalAddModal', '#categoryModal'];

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

        if (!modalHeader) return;

        modalHeader.style.cursor = 'move';

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

<!-- Duplicate signup popup Model - CC and HCP -->
<div class="modal fade" id="duplicateCheckModal" tabindex="-1" aria-labelledby="duplicateCheckLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;" id="duplicateCheckLabel">
                    Duplicate Entry
                </h5>
            </div>

            <div class="modal-body" id="duplicateCheckBody">
            </div>

            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Medicine Category modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Manage Medicine Categories
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-3 gap-2">
                    <input type="text" id="newCategoryName" class="form-control" placeholder="Enter new category name">

                    <button class="btn text-light" style="background-color: #2b353bf5;" onclick="addCategory()">Add</button>
                </div>
                <span id="categoryError" class="text-danger mb-1 d-none"></span>

                <div style="max-height: 300px; overflow-y: auto;">
                    <ul id="categoryList" class="list-group"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Manage Dosage Unit Modal -->
<div class="modal fade" id="dosageUnitModal" tabindex="-1"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">
                    Manage Dosage Units
                </h5>
                <button type="button" class="close btn btn-outline-danger"
                    data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="d-flex mb-3 gap-2">
                    <input type="text" id="newUnitName" class="form-control"
                        placeholder="Enter dosage unit (mg, ml...)">

                    <button class="btn text-light"
                        style="background-color: #090a0af5;"
                        onclick="addDosageUnit()">Add</button>
                </div>

                <span id="dosageUnitError" class="text-danger mb-1 d-none"></span>

                <div style="max-height: 300px; overflow-y: auto;">
                    <ul id="dosageUnitList" class="list-group"></ul>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
