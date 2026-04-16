//  Toggle month content visibility and icon - Sugar Chart
document.querySelectorAll(".toggle-btn").forEach((button) => {
	button.addEventListener("click", function () {
		let content = this.closest(".card").querySelector(".month-content");

		const isVisible = content.style.display === "block";

		content.style.display = isVisible ? "none" : "block";
		this.textContent = isVisible ? "+" : "-";
	});
});

//  Delete Sugar Records by Month
function deleteMonthRecords(month, patientId) {
	if (confirm("Delete all sugar records for " + month + " ?")) {
		window.location.href =
			"<?= base_url('Consultation/deleteMonthRecords/') ?>" +
			patientId +
			"/" +
			encodeURIComponent(month);
	}
}

//    Print - sugar chart
function printMonthTable(month, button) {
	var card = button.closest(".card");
	var content = card.querySelector(".month-content").innerHTML;

	var patientId = button.getAttribute("data-patient-id");
	var patientName = button.getAttribute("data-patient-name");
	var patientAge = button.getAttribute("data-patient-age");
	var patientGender = button.getAttribute("data-patient-gender");
	var patientMobile = button.getAttribute("data-patient-mobile");
	var printDate = new Date().toLocaleDateString("en-GB", {
		day: "2-digit",
		month: "short",
		year: "numeric",
	});

	var printWindow = window.open("", "", "width=900,height=700");

	printWindow.document.write(`
        <html>
        <head>
            <title>Sugar Report - ${month}</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                @page {
                    size: A4;
                    margin: 0.5cm 0.5cm 0.5cm 0.5cm;
                }
                * {
                    box-sizing: border-box;
                }
                .action-column { display: none; }
                html, body {
                    margin: 0;
                    padding: 0;
                    width: 100%;
                    height: 100%;
                }
                body {
                    font-family: Arial, sans-serif;
                    padding: 8px;
                    margin: 0;
                }
                .header { border-bottom: 1px solid #00ad8e; padding-bottom: 8px; margin-bottom: 10px; }
                .patient-info { display: grid; grid-template-columns: repeat(2, 1fr); gap: 5px; font-size: 11px; margin: 0; padding: 0; }
                .info-item { display: flex; flex-direction: column; margin: 0; padding: 0; }
                .info-label { font-weight: bold; color: #00ad8e; font-size: 10px; margin: 0; padding: 0; }
                .info-value { font-weight: normal;font-size: 10px; color: #333; margin: 0; padding: 0; }
                .print-title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 3px; }
                .print-month { text-align: center; font-size: 13px; color: #666; margin-bottom: 8px; }
                .print-date { text-align: right; margin-bottom: 8px; font-size: 10px; color: #666; }
                table {
                    border-collapse: collapse !important;
                    width: 100%;
                    table-layout: auto;
                }
                table, th, td {
                    border: 1px solid #000 !important;
                    padding: 6px !important;
                    font-size: 11px;
                }
                thead {
                    background-color: #f0f0f0 !important;
                    font-weight: bold;
                }
                tbody tr:nth-child(even) { background-color: #fafafa !important; }
                .table-responsive {
                    overflow: visible !important;
                }
                @media print {
                    @page {
                        size: A4;
                        margin: 0.5cm 0.5cm 0.5cm 0.5cm;
                    }
                    html, body {
                        margin: 0;
                        padding: 0;
                        width: 100%;
                    }
                    body {
                        padding: 5px;
                        margin: 0;
                    }
                    table {
                        border-collapse: collapse !important;
                        width: 100%;
                    }
                    table, th, td {
                        border: 1px solid #000 !important;
                        padding: 6px !important;
                        page-break-inside: avoid;
                    }
                    thead { background-color: #f0f0f0 !important; font-weight: bold; font-size: 8px; color: #0066cc; }
                    .header { padding-bottom: 6px; margin-bottom: 6px; }
                    .patient-info { margin-bottom: 4px; font-size: 11px; margin: 0; padding: 0; gap: 5px; margin-top: 10px; }
                    .info-item { margin: 0; padding: 0; }
                    .info-label { margin: 0; padding: 0; font-size: 9px; }
                    .info-value { margin: 0; padding: 0; font-size: 9px; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="print-title">Sugar Chart Record</div>
                <div class="patient-info">
                    <div class="info-item">
                        <p class="info-label">Patient Name:
                        <span class="info-value">${patientName}</span></p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Patient ID:
                        <span class="info-value">${patientId}</span></p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Mobile Number:
                        <span class="info-value">${patientMobile}</span></p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Age & Gender:
                        <span class="info-value">${patientAge} years & ${patientGender}</span></p>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
            <div class="print-month">Period: <strong>${month}</strong></div>
            <div class="print-date" style="text-align: right; margin-bottom: 10px; font-size: 12px; color: #666;">Printed on: ${printDate}</div>
            </div>
            ${content}
        </body>
        </html>
    `);

	printWindow.document.close();
	printWindow.print();
}

// Discharge follow-up plan modal trigger script
document
	.getElementById("openFollowupModal")
	.addEventListener("click", function () {
		var patientId = this.getAttribute("data-patient-id");

		document.getElementById("modal_patient_id").value = patientId;

		var modal = new bootstrap.Modal(document.getElementById("followupModal"));
		modal.show();
	});

function validateFollowupForm() {
	let isValid = true;

	let appointment = document.getElementById("appointment_date").value;
	let discharge = document.getElementById("discharge_date").value;
	let review = document.getElementById("next_review_date").value;
	let interval = document.getElementById("interval_days").value;

	document.getElementById("appointment_date_err").innerText = "";
	document.getElementById("discharge_date_err").innerText = "";
	document.getElementById("review_date_err").innerText = "";
	document.getElementById("interval_err").innerText = "";

	if (!appointment) {
		document.getElementById("appointment_date_err").innerText =
			"Appointment date is required";
		isValid = false;
	}

	if (!discharge) {
		document.getElementById("discharge_date_err").innerText =
			"Discharge date is required";
		isValid = false;
	}

	if (!review) {
		document.getElementById("review_date_err").innerText =
			"Review date is required";
		isValid = false;
	}

	if (!interval) {
		document.getElementById("interval_err").innerText = "Interval is required";
		isValid = false;
	}

	if (!isValid) return false;

	let appDate = new Date(appointment);
	let disDate = new Date(discharge);
	let revDate = new Date(review);

	if (appDate > disDate) {
		document.getElementById("appointment_date_err").innerText =
			"Appointment date must be before or same as discharge date";
		isValid = false;
	}

	if (revDate <= disDate) {
		document.getElementById("review_date_err").innerText =
			"Review date must be after discharge date";
		isValid = false;
	}

	if (interval < 1) {
		document.getElementById("interval_err").innerText =
			"Interval must be at least 1 day";
		isValid = false;
	}

	let diffDays = Math.floor((revDate - disDate) / (1000 * 60 * 60 * 24));

	if (interval > diffDays) {
		document.getElementById("interval_err").innerText =
			"Interval must not exceed the days between discharge and review date";
		isValid = false;
	}
	return isValid;
}
