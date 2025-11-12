<!-- Popup Update Profile Photo -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: Poppins, sans-serif;">Upload CC Profile Photo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="cropperImage" style="max-width: 100%;" />
            </div>
            <div class="modal-footer">
                <button type="button" id="cropImageBtn" class="btn text-light my-3 py-auto px-4"
                    style="background-color: #0079AD;">Crop</button>
            </div>
        </div>
    </div>
</div>

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
                <a href="<?php echo base_url() . "Chiefconsultant/logout" ?>">
                    <button class="btn text-light" style="background-color: #0079AD;">Logout</button>
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