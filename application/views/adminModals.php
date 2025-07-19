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
                <p>Are you sure you want to delete ?</p>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <a id="deleteConfirmButton" href="#" class="btn btn-danger">Delete</a>
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
                case "medicine":
                    deleteUrl = baseUrl + "Edfadmin/deleteMedicine/" + id;
                    break;
            }

            document.getElementById("deleteConfirmButton").setAttribute("href", deleteUrl);
        }
    });
</script>

<!-- Popup Add new specilization -->
<div class="modal fade" id="newSpecilization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add New
                    Specilization</h5>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add New Symptom
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

<!-- Popup Add new medicine -->
<div class="modal fade" id="newMedicine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-family: Poppins, sans-serif;">Add New
                    Medicine</h5>
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