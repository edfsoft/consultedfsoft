<!-- Popup Update Profile Photo -->
<div class="modal fade" id="updateHCPPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" id="exampleModalLabel">Update Profile Photo</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <label for="hcpProfile" class="pb-2">Upload file: <span class="text-danger">*</span></label><br>
                    <input type="file" name="hcpProfile" id="hcpProfile" accept="image/png ,image/jpg, image/jpeg"
                        required>
                    <br><br>
                    <div style="max-width: 300px; max-height:300px; overflow: hidden;">
                        <img id="previewImage" style="max-width: 100%;">
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="uploadButton" class="btn text-light"
                            style="background-color: #00ad8e;">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup Update Patient Profile Photo -->
<div class="modal fade" id="updatePatientProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Patient Photo</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action=" <?php echo base_url() . "Healthcareprovider/updatePatientPhoto" ?>"
                    name="profilePhotoForm" name="profilePhotoForm" enctype="multipart/form-data" method="POST">
                    <label for="hcpProfile" class="pb-2">Upload file: <span class="text-danger">*</span></label><br>
                    <input type="file" name="patientProfile" id="patientProfile"
                        accept="image/png ,image/jpg, image/jpeg" required><br><br>
                    <input type="hidden" id="photoPatientIdDb" name="photoPatientIdDb" value="">
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn text-light" style="background-color: #00ad8e;">Upload</button>
                    </div>
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
                <a href="<?php echo base_url() . "Healthcareprovider/logout" ?>">
                    <button class="btn text-light" style="background-color: #00ad8e;">Logout</button>
                </a>
            </div>
        </div>
    </div>
</div>