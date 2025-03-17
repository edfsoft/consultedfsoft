<!-- Popup Update Profile Photo -->
<div class="modal fade" id="updatePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update photo</h5>
                <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "Chiefconsultant/updatePhoto" ?>" name="profilePhotoForm"
                    name="profilePhotoForm" enctype="multipart/form-data" method="POST">
                    <label for="ccProfile" class="pb-2">Upload file: </label><br>
                    <input type="file" name="ccProfile" id="ccProfile" accept="image/png ,image/jpg, image/jpeg"
                        required><br><br>
                    <button type="submit" class="btn text-light" style="background-color: #0079AD;">Save</button>
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
                <a href="<?php echo base_url() . "Chiefconsultant/logout" ?>">
                    <button class="btn text-light" style="background-color: #0079AD;">Logout</button>
                </a>
            </div>
        </div>
    </div>
</div>