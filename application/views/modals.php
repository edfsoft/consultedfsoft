<!-- Popup Add new specilization -->
<div class="modal fade" id="newSpecilization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Specilization</h5>
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
                    <button type="submit" class="btn btn-secondary float-end"> Add </button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Symptom</h5>
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
                    <button type="submit" class="btn btn-secondary float-end"> Add </button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Medicine</h5>
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
                    <button type="submit" class="btn btn-secondary float-end"> Add </button>
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
                <h5 class="modal-title fw-medium" id="confirmLogoutLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url() . "Edfadmin/logout" ?>">
                    <button class="btn btn-danger">Logout</button>
                </a>
            </div>
        </div>
    </div>
</div>