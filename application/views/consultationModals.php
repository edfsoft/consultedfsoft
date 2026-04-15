<!-- Delete consultation and sugar chart Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-3 shadow">
            <div class="modal-header text-dark rounded-top-3">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                    id="deleteConfirmModalLabel">Delete Consultation</h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deleteModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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

<!-- Post Discharge Follow-up Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">Delete Discharge Follow-up
                    Plan</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this follow-up?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>

        </div>
    </div>
</div>

<!-- Script for discharge follow-up delete confirmation -->
<script>
    let deleteId = 0;

    function openDeleteModal(id) {
        deleteId = id;
        let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function confirmDelete() {

        fetch("<?= base_url('Consultation/deleteDischargeFollowup') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + deleteId
        })
            .then(res => res.json())
            .then(data => {
                location.reload();
            });
    }
</script>