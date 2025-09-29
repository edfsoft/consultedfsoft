<!-- Delete confirmation -->
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

<script>
    document.addEventListener("click", (event) => {
        let deleteButton = event.target.closest(".delete-btn");
        if (deleteButton) {
            let id = deleteButton.getAttribute("data-id");
            let type = deleteButton.getAttribute("data-type");
            let name = deleteButton.getAttribute("data-name");

            let baseUrl = "<?php echo base_url(); ?>";
            let deleteUrl = "";

            switch (type) {
                case "cc":
                    deleteUrl = baseUrl + "Edfadmin/deleteCc/" + id;
                    break;
                case "hcp":
                    deleteUrl = baseUrl + "Edfadmin/deleteHcp/" + id;
                    break;
                case "patient":
                    deleteUrl = baseUrl + "Edfadmin/deletePatient/" + id;
                    break;
                case "specialization":
                    deleteUrl = baseUrl + "Edfadmin/deleteSpecilization/" + id;
                    break;
                case "symptom":
                    deleteUrl = baseUrl + "Edfadmin/deleteSymptoms/" + id;
                    break;
                case "finding":
                    deleteUrl = baseUrl + "Edfadmin/deleteFindings/" + id;
                    break;
                case "diagnosis":
                    deleteUrl = baseUrl + "Edfadmin/deleteDiagnosis/" + id;
                    break;
                case "investigation":
                    deleteUrl = baseUrl + "Edfadmin/deleteInvestigation/" + id;
                    break;
                case "instruction":
                    deleteUrl = baseUrl + "Edfadmin/deleteInstruction/" + id;
                    break;
                case "procedure":
                    deleteUrl = baseUrl + "Edfadmin/deleteProcedure/" + id;
                    break;
                case "advice":
                    deleteUrl = baseUrl + "Edfadmin/deleteAdvice/" + id;
                    break;
                case "medicine":
                    deleteUrl = baseUrl + "Edfadmin/deleteMedicine/" + id;
                    break;
            }

            document.getElementById("deleteConfirmButton").setAttribute("href", deleteUrl);
            document.getElementById("deleteItemName").textContent = name || '';
        }
    });
</script>

<!-- Popup Add new specilization -->
<div class="modal fade" id="newSpecilization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Specilization</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewSpecilization" ?>" name="addSpecilization"
                    name="addSpecilization" enctype="multipart/form-data" method="POST">
                    <label for="specializationName" class="form-label pb-2">Specilization Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="specializationName" id="specializationName" class="form-control"
                        placeholder="E.g. Diabetologist" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new symptom -->
<div class="modal fade" id="newSymptoms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Symptom
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewSymptoms" ?>" name="addSymptoms"
                    enctype="multipart/form-data" method="POST">

                    <label for="symptomsName" class="form-label pb-2">Symptom / Complaint Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="symptomsName" id="symptomsName" class="form-control"
                        placeholder="E.g. Head ache" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new findings  -->
<div class="modal fade" id="newFindings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Findings
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewFindings" ?>" name="addFindings"
                    enctype="multipart/form-data" method="POST">
                    <label for="findingsName" class="form-label pb-2">Finding Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="findingsName" id="findingsName" class="form-control"
                        placeholder="E.g. Blood Sugar High" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new diagnosis  -->
<div class="modal fade" id="newDiagnosis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Diagnosis
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewDiagnosis" ?>" name="addFindings"
                    enctype="multipart/form-data" method="POST">
                    <label for="diagnosisName" class="form-label pb-2">Diagnosis Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="diagnosisName" id="diagnosisName" class="form-control"
                        placeholder="E.g. Diabetes" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new investigation  -->
<div class="modal fade" id="newInvestigation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Investigation
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewInvestigation" ?>" name="addInvestigation"
                    enctype="multipart/form-data" method="POST">
                    <label for="investigationName" class="form-label pb-2">Investigation Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="investigationName" id="investigationName" class="form-control"
                        placeholder="E.g. ECG" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new instruction  -->
<div class="modal fade" id="newInstruction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Instruction
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewInstruction" ?>" name="addInstruction"
                    enctype="multipart/form-data" method="POST">
                    <label for="instructionName" class="form-label pb-2">Instruction Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="instructionName" id="instructionName" class="form-control"
                        placeholder="E.g. Low fat in diet" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new procedure  -->
<div class="modal fade" id="newProcedure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Procedure
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewProcedure" ?>" name="addProcedure"
                    enctype="multipart/form-data" method="POST">
                    <label for="procedureName" class="form-label pb-2">Procedure Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="procedureName" id="procedureName" class="form-control"
                        placeholder="E.g. Coronary angiogram" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new advice  -->
<div class="modal fade" id="newAdvice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Advice
                </h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewAdvice" ?>" name="addFindings"
                    enctype="multipart/form-data" method="POST">
                    <label for="adviceName" class="form-label pb-2">Advice Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="adviceName" id="adviceName" class="form-control"
                        placeholder="E.g. Take rest" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn text-light float-end"> Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Add new medicine -->
<div class="modal fade" id="newMedicine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add
                    New Medicine</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Edfadmin/addNewMedicine" ?>" name="addMedicine"
                    enctype="multipart/form-data" method="POST">
                    <label for="medicineNameBrand" class="form-label pb-2">Medicine Brand Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="medicineNameBrand" id="medicineNameBrand" class="form-control"
                        placeholder="E.g. Dolo 650" required><br>
                    <label for="medicineName" class="form-label pb-2">Medicine Name <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="medicineName" id="medicineName" class="form-control"
                        placeholder="E.g.  Paracetamol" required><br>
                    <label for="maedicineStrength" class="form-label pb-2">Medicine Strength <span
                            class="text-danger">*</span></label><br>
                    <input type="text" name="maedicineStrength" id="maedicineStrength" class="form-control"
                        placeholder="E.g.  100 mg" required><br><br>
                    <button type="submit" style="background-color: #2b353bf5;" class="btn float-end"> Add </button>
                </form>
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