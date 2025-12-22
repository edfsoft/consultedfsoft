<!-- Popup Update Profile Photo -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: Poppins, sans-serif;">Upload HCP Profile Photo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="cropperImage" style="max-width: 100%;" />
            </div>
            <div class="modal-footer">
                <button type="button" id="cropImageBtn" class="btn text-light my-3 py-auto px-4"
                    style="background-color: #00ad8e;">Crop</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Consultation Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-3 shadow">
            <div class="modal-header text-dark rounded-top-3">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;"
                    id="deleteConfirmModalLabel">Confirm Consultation Deletion</h5>
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

<!-- Modal for add new patient -->
<div class="modal fade" id="newPatientModal" tabindex="-1" aria-labelledby="newPatientModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <input type="hidden" id="newPatientResult" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPatientModalLabel">Add New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group pb-2">
                    <label>First Name <span class="text-danger">*</span></label>
                    <input type="text" name="newFirstName" id="newFirstName" placeholder="E.g. Siva"
                        class="form-control">
                    <div id="newFirstName_err" class="text-danger"></div>
                </div>
                <div class="form-group pb-2">
                    <label>Last Name</label>
                    <input type="text" name="newLastName" id="newLastName" placeholder="E.g. kumar"
                        class="form-control">
                    <div id="newLastName_err" class="text-danger"></div>
                </div>
                <div class="form-group pb-2">
                    <label>Mobile <span class="text-danger">*</span></label>
                    <input type="text" name="newMobile" id="newMobile" placeholder="E.g. 5987654321"
                        class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <div id="newMobile_err" class="text-danger"></div>
                    <div id="newMobileDuplicate_err" class="text-danger"></div>
                </div>
                <div class="form-group pb-2">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="newEmail" id="newEmail" placeholder="E.g. siva@gmail.com"
                        class="form-control">
                    <div id="newEmail_err" class="text-danger"></div>
                </div>
                <div class="form-group pb-2">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select name="newGender" id="newGender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div id="newGender_err" class="text-danger"></div>
                </div>
                <div class="form-group pb-2">
                    <label>Age <span class="text-danger">*</span></label>
                    <input type="number" name="newAge" id="newAge" placeholder="E.g. 35" class="form-control">
                    <div id="newAge_err" class="text-danger"></div>
                </div>
                <div id="newPatientStatus" class="text-success mt-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                    onclick="saveNewPatient()">Add Patient</button>
            </div>
        </div>
    </div>
</div>

<!-- Add New patient -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('patientId');
        const searchInput = document.getElementById('patientSearch');
        const addBtn = document.getElementById('addPatientBtn');
        let originalOptions = Array.from(select.options);

        select.value = "";
        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();

            if (term.length > 0) {
                select.size = 6;
            } else {
                select.size = 1;
            }

            select.innerHTML = '<option value="">Select Patient Id</option>';
            let matches = 0;
            originalOptions.forEach(opt => {
                if (opt.value === '') return;
                if (opt.textContent.toLowerCase().includes(term)) {
                    select.appendChild(opt.cloneNode(true));
                    matches++;
                }
            });
            if (matches === 0 && term !== '') {
                const no = document.createElement('option');
                no.disabled = true;
                no.textContent = '— No patient found —';
                select.appendChild(no);
            }
        });

        select.addEventListener('change', function () {
            if (this.value) {
                searchInput.value = '';
            }
            select.size = 1;
        });

        addBtn.addEventListener('click', function () {
            showNewPatientModal();
            searchInput.value = '';
            select.value = '';
        });

        document.getElementById('newPatientModal').addEventListener('hidden.bs.modal', function () {
            const resultInput = document.getElementById('newPatientResult');
            if (resultInput && resultInput.value) {
                const patient = JSON.parse(resultInput.value);
                addPatientToSelectAndSelect(patient);
                resultInput.value = '';
            }
            document.getElementById('patientSearch').value = '';
        });
    });

    function showNewPatientModal() {
        const modal = new bootstrap.Modal(document.getElementById('newPatientModal'));
        modal.show();
    }

    function addPatientToSelectAndSelect(patient) {
        const select = document.getElementById('patientId');
        const value = patient.patientId + '|' + patient.id;
        const text = patient.patientId + " / " + patient.firstName + (patient.lastName ? " " + patient.lastName : "");

        let exists = false;
        for (let opt of select.options) {
            if (opt.value === value) {
                exists = true;
                break;
            }
        }

        if (!exists) {
            const option = new Option(text, value, true, true);
            select.add(option);
            originalOptions = Array.from(select.options);
        } else {
            select.value = value;
        }

        select.dispatchEvent(new Event('change'));
    }
</script>

<!-- Patient Id and Doctor Id Search Area -->
<script>
    let newPatientModalInstance;

    function setupSearchDropdown(selectElementId, searchInputId, placeholderText, noResultText) {
        const selectElement = document.getElementById(selectElementId);
        const searchInputElement = document.getElementById(searchInputId);

        if (!selectElement || !searchInputElement) {
            console.error(`Missing required elements for search: #${selectElementId} or #${searchInputId}`);
            return;
        }

        let originalOptions = Array.from(selectElement.options);
        const MAX_DISPLAY_COUNT = 5;

        selectElement.value = "";
        searchInputElement.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();

            if (term.length > 0) {
                selectElement.size = 6;
            } else {
                selectElement.size = 1;
            }

            selectElement.innerHTML = `<option value="">${placeholderText}</option>`;
            let matches = 0;
            let count = 0;

            originalOptions.forEach(opt => {
                if (opt.value === '') return;

                if (count >= MAX_DISPLAY_COUNT) return;

                if (opt.textContent.toLowerCase().includes(term)) {
                    selectElement.appendChild(opt.cloneNode(true));
                    matches++;
                    count++;
                }
            });

            if (term.length > 0) {
                selectElement.size = Math.min(matches + 1, MAX_DISPLAY_COUNT + 1);
            }

            if (matches === 0 && term !== '') {
                const no = document.createElement('option');
                no.disabled = true;
                no.textContent = noResultText;
                selectElement.appendChild(no);
                selectElement.size = 2;
            }
        });

        searchInputElement.addEventListener('click', function () {
            selectElement.size = 6;
            this.focus();
            this._ignoreBlur = true;
        });

        searchInputElement.addEventListener('blur', function () {
            if (this._ignoreBlur) {
                this._ignoreBlur = false;
                return;
            }
            setTimeout(() => selectElement.size = 1, 100);
        });

        selectElement.addEventListener('change', function () {
            if (this.value) {
                searchInputElement.value = '';
            }
            selectElement.size = 1;
        });

        return {
            originalOptions: originalOptions,
            selectElement: selectElement
        };
    }

    function showNewPatientModal() {
        if (newPatientModalInstance) {
            newPatientModalInstance.show();
        } else {
            console.error('New Patient Modal instance not initialized.');
        }
    }
    function addPatientToSelectAndSelect(patient, selectElement, originalOptionsRef) {
        const value = patient.patientId + '|' + patient.id;
        const text = patient.patientId + " / " + patient.firstName + (patient.lastName ? " " + patient.lastName : "");

        let exists = false;
        for (let opt of selectElement.options) {
            if (opt.value === value) {
                exists = true;
                break;
            }
        }

        if (!exists) {
            const option = new Option(text, value, true, true);
            selectElement.add(option);
            if (originalOptionsRef) {
                originalOptionsRef.splice(0, originalOptionsRef.length, ...Array.from(selectElement.options));
            }
        } else {
            selectElement.value = value;
        }

        selectElement.dispatchEvent(new Event('change'));
    }

    document.addEventListener('DOMContentLoaded', function () {
        const patientElements = setupSearchDropdown(
            'patientId',
            'patientSearch',
            'Select Patient Id',
            '— No patient found —'
        );
        let originalOptions = patientElements.originalOptions;
        const select = patientElements.selectElement;

        setupSearchDropdown(
            'referalDoctor',
            'referralDoctorSearch',
            'Select Chief Consultant Id',
            '— No doctor found —'
        );
        const newPatientModalElement = document.getElementById('newPatientModal');
        if (newPatientModalElement) {
            newPatientModalInstance = new bootstrap.Modal(newPatientModalElement);
        }

        const searchInput = document.getElementById('patientSearch');
        const addBtn = document.getElementById('addPatientBtn');

        if (addBtn) {
            addBtn.addEventListener('click', function () {
                showNewPatientModal();
                if (searchInput) searchInput.value = '';
                if (select) select.value = '';
            });
        }

        if (newPatientModalElement) {
            newPatientModalElement.addEventListener('hidden.bs.modal', function () {
                const resultInput = document.getElementById('newPatientResult');
                if (resultInput && resultInput.value) {
                    try {
                        const patient = JSON.parse(resultInput.value);
                        addPatientToSelectAndSelect(patient, select, originalOptions);
                        resultInput.value = '';
                    } catch (e) {
                        console.error("Error parsing new patient result:", e);
                    }
                }
                if (searchInput) document.getElementById('patientSearch').value = '';
            });
        }

    });
</script>

<!-- Add to db and validation -->
<script>
    window.forceAddAnyway = false;
    function resetNewPatientForm() {
        document.getElementById("newFirstName").value = "";
        document.getElementById("newLastName").value = "";
        document.getElementById("newMobile").value = "";
        document.getElementById("newEmail").value = "";
        document.getElementById("newGender").value = "";
        document.getElementById("newAge").value = "";

        document.getElementById("newFirstName_err").innerHTML = "";
        document.getElementById("newLastName_err").innerHTML = "";
        document.getElementById("newMobile_err").innerHTML = "";
        document.getElementById("newMobileDuplicate_err").innerHTML = "";
        document.getElementById("newEmail_err").innerHTML = "";
        document.getElementById("newGender_err").innerHTML = "";
        document.getElementById("newAge_err").innerHTML = "";

        document.getElementById("newPatientStatus").innerHTML = "";
    }

    document.addEventListener("DOMContentLoaded", function () {
        const newMobileInput = document.getElementById("newMobile");
        if (newMobileInput) {
            newMobileInput.addEventListener("input", function () {
                document.getElementById("newMobileDuplicate_err").innerHTML = "";
            });
        }
        const newPatientModalEl = document.getElementById("newPatientModal");

        if (newPatientModalEl) {
            newPatientModalEl.addEventListener("hidden.bs.modal", function () {
                resetNewPatientForm();
            });
        }
    });

    async function saveNewPatient() {
        document.getElementById("newFirstName_err").innerHTML = "";
        document.getElementById("newLastName_err").innerHTML = "";
        document.getElementById("newMobile_err").innerHTML = "";
        document.getElementById("newMobileDuplicate_err").innerHTML = "";
        document.getElementById("newEmail_err").innerHTML = "";
        document.getElementById("newGender_err").innerHTML = "";
        document.getElementById("newAge_err").innerHTML = "";
        document.getElementById("newPatientStatus").innerHTML = "";

        const firstName = document.getElementById("newFirstName").value.trim();
        const lastName = document.getElementById("newLastName").value.trim();
        const mobile = document.getElementById("newMobile").value.trim();
        const email = document.getElementById("newEmail").value.trim();
        const gender = document.getElementById("newGender").value;
        const age = document.getElementById("newAge").value.trim();

        let isValid = true;

        if (firstName === "") {
            document.getElementById("newFirstName_err").innerHTML = "First name must be filled out.";
            isValid = false;
        } else if (!/^[a-zA-Z\s]+$/.test(firstName)) {
            document.getElementById("newFirstName_err").innerHTML = "First name must contain only letters and spaces.";
            isValid = false;
        }

        if (lastName !== "" && !/^[a-zA-Z\s]+$/.test(lastName)) {
            document.getElementById("newLastName_err").innerHTML = "Last name must contain only letters and spaces.";
            isValid = false;
        }

        if (mobile === "") {
            document.getElementById("newMobile_err").innerHTML = "Mobile number must be filled out.";
            isValid = false;
        } else if (!/^\d{10}$/.test(mobile)) {
            document.getElementById("newMobile_err").innerHTML = "Mobile number must be exactly 10 digits.";
            isValid = false;
        }

        if (email === "") {
            document.getElementById("newEmail_err").innerHTML = "Email must be filled out.";
            isValid = false;
        } else if (email !== "" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById("newEmail_err").innerHTML = "Please enter a valid email address.";
            isValid = false;
        }

        if (gender === "") {
            document.getElementById("newGender_err").innerHTML = "Gender must be selected.";
            isValid = false;
        }

        if (age === "") {
            document.getElementById("newAge_err").innerHTML = "Age must be filled out.";
            isValid = false;
        } else if (isNaN(age) || age < 1 || age > 120) {
            document.getElementById("newAge_err").innerHTML = "Age must be a number between 1 and 120.";
            isValid = false;
        }

        if (isValid) {
            try {

                // Prepare duplicate container
                const duplicates = {};
                // CHECK MOBILE DUPLICATE
                const mobileFormData = new URLSearchParams();
                mobileFormData.append('field', 'mobile');
                mobileFormData.append('value', mobile);

                const mobileResponse = await fetch(
                    '<?= base_url("Healthcareprovider/check_duplicate") ?>',
                    {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: mobileFormData
                    }
                );

                const mobileData = await mobileResponse.json();

                if (mobileData.exists) {
                    duplicates['Mobile Number'] = {
                        value: mobile,
                        patients: mobileData.data
                    };
                }

                // CHECK EMAIL DUPLICATE
                const emailFormData = new URLSearchParams();
                emailFormData.append('field', 'email');
                emailFormData.append('value', email);

                const emailResponse = await fetch(
                    '<?= base_url("Healthcareprovider/check_duplicate") ?>',
                    {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: emailFormData
                    }
                );

                const emailData = await emailResponse.json();

                if (emailData.exists) {
                    duplicates['Email Address'] = {
                        value: email,
                        patients: emailData.data
                    };
                }

                // SHOW MODAL IF ANY DUPLICATE
                if (Object.keys(duplicates).length > 0 && !window.forceAddAnyway) {
                    showDuplicateModal(duplicates);
                    return;
                }

                // 2 CHECK EMAIL DUPLICATE
                if (email) {
                    const emailFormData = new URLSearchParams();
                    emailFormData.append('field', 'email');
                    emailFormData.append('value', email);

                    const emailResponse = await fetch(
                        '<?= base_url("Healthcareprovider/check_duplicate") ?>',
                        {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: emailFormData
                        }
                    );

                    const emailData = await emailResponse.json();

                    if (emailData.exists && !window.forceAddAnyway) {
                        showDuplicateModal(emailData.data);
                        return;
                    }
                }

                // 3 SAVE PATIENT (NO DUPLICATE)
                const saveResponse = await fetch(
                    '<?php echo base_url("Healthcareprovider/ajaxSavePatient"); ?>',
                    {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            firstName, lastName, mobile, email, gender, age
                        })
                    }
                );

                const data = await saveResponse.json();

                if (data.success) {
                    document.getElementById("newPatientStatus").innerHTML =
                        "Patient saved successfully!";
                    document.getElementById("newPatientStatus").className =
                        "text-success mt-2";

                    const patientData = {
                        patientId: data.patientId,
                        id: data.id,
                        firstName: data.firstName,
                        lastName: data.lastName || ''
                    };
                    document.getElementById("newPatientResult").value =
                        JSON.stringify(patientData);

                    // Clear fields
                    document.getElementById("newFirstName").value = "";
                    document.getElementById("newLastName").value = "";
                    document.getElementById("newMobile").value = "";
                    document.getElementById("newEmail").value = "";
                    document.getElementById("newGender").value = "";
                    document.getElementById("newAge").value = "";

                    bootstrap.Modal.getInstance(
                        document.getElementById('newPatientModal')
                    ).hide();
                } else {
                    document.getElementById("newPatientStatus").innerHTML =
                        "Failed to save patient.";
                    document.getElementById("newPatientStatus").className =
                        "text-danger mt-2";
                }

            } catch (error) {
                console.error('Error:', error);
                document.getElementById("newPatientStatus").innerHTML =
                    "An error occurred.";
                document.getElementById("newPatientStatus").className =
                    "text-danger mt-2";
            }
        }

    }


    function showDuplicateModal(duplicates) {
        let html = '<p class="fw-semibold mb-3">The following information already exists in the system:</p>';

        for (const [fieldName, info] of Object.entries(duplicates)) {
            html += `<div class="mb-3">
                    <p class="fw-semibold mb-1">${fieldName} <b>${info.value}</b> already exists in:</p>
                    <ul class="mb-0">`;

            info.patients.forEach(p => {
                html += `<li><b>${p.firstName} ${p.lastName || ''}</b> (Patient ID: ${p.patientId})</li>`;
            });

            html += `</ul></div>`;
        }

        document.getElementById("duplicateDetails").innerHTML = html;

        const modal = new bootstrap.Modal(
            document.getElementById('duplicateMobileModal')
        );
        modal.show();
    }


    document.addEventListener("DOMContentLoaded", function () {

        const dupModalEl = document.getElementById("duplicateMobileModal");
        if (!dupModalEl) return;

        document.getElementById("dupEditBtn")?.addEventListener("click", function () {
            const modal = bootstrap.Modal.getInstance(dupModalEl);
            if (modal) modal.hide();

            document.getElementById("newMobile")?.focus();
        });

        document.getElementById("dupAddAnywayBtn")?.addEventListener("click", function () {
            const modal = bootstrap.Modal.getInstance(dupModalEl);
            if (modal) modal.hide();

            window.forceAddAnyway = true;
            saveNewPatient();
            setTimeout(() => {
                window.forceAddAnyway = false;
            }, 500);
        });

        // CANCEL → close duplicate modal only
        document.getElementById("dupCloseBtn")?.addEventListener("click", function () {

            // 1 Close duplicate modal
            const dupModal = bootstrap.Modal.getInstance(
                document.getElementById("duplicateMobileModal")
            );
            if (dupModal) dupModal.hide();

            // 2 Close new patient modal
            const newPatientModalEl = document.getElementById("newPatientModal");
            if (newPatientModalEl) {
                const newPatientModal =
                    bootstrap.Modal.getInstance(newPatientModalEl) ||
                    new bootstrap.Modal(newPatientModalEl);

                newPatientModal.hide();
            }

        });
        ;

    });
</script>

<!-- Mobile number already exist message display modal - 2 palces [Add, Edit patient details] -->
<div class="modal fade" id="duplicateMobileModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;">
                    Duplicate Information Found
                </h5>
            </div>
            <div class="modal-body" id="duplicateDetails"></div>
            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-secondary" id="dupCloseBtn">Cancel</button>
                <button class="btn btn-success" id="dupAddAnywayBtn">Add Anyway</button>
                <button class="btn btn-warning" id="dupEditBtn">Edit Details</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Appointment Booked Modal -->
<div class="modal fade" id="appointmentSuccessModal" tabindex="-1" aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-success" id="successModalLabel">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <p class="mt-3">Appointment booked, link has been sent to the registered Email</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn text-light" style="background-color: #00ad8e;"
                    data-bs-dismiss="modal">OK</button>
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
                <h5 class="modal-title fw-medium" style="font-family: Poppins, sans-serif;" id="confirmLogoutLabel">
                    Confirm Logout</h5>
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