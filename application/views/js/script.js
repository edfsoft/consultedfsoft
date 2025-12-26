//  Display message for 3 seconds
setTimeout(() => {
	const displayMessage = document.getElementById("display_message");
	if (displayMessage) {
		displayMessage.style.display = "none";
	}
}, 8000);

// Password visiblity add CC and HCP in admin
function togglePasswordVisibility(id, icon) {
	const passwordField = document.getElementById(id);

	if (passwordField.type === "password") {
		passwordField.type = "text";
		icon.classList.remove("bi-eye-slash");
		icon.classList.add("bi-eye");
	} else {
		passwordField.type = "password";
		icon.classList.remove("bi-eye");
		icon.classList.add("bi-eye-slash");
	}
}

//  Go back
function goBack() {
	window.history.back();
}

//  Event listener to block right-click
function blockRightClick(event) {
	event.preventDefault();
}

document.addEventListener("contextmenu", blockRightClick);

//  Hide page source Ctrl + U
document.onkeydown = function (e) {
	if (e.ctrlKey && e.keyCode === 85) {
		return false;
	}
};

// HCP profile photo
let cropper;
let activeInput = null;

document.querySelectorAll(".image-input").forEach((input) => {
	input.addEventListener("change", function (e) {
		const file = e.target.files[0];
		if (!file) return;

		const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
		if (!allowedTypes.includes(file.type)) {
			alert("Only JPG, JPEG, PNG allowed.");
			input.value = "";
			return;
		}

		if (file.size > 1 * 1024 * 1024) {
			alert("Max file size is 1MB.");
			input.value = "";
			return;
		}

		const reader = new FileReader();
		reader.onload = function (event) {
			const image = document.getElementById("cropperImage");
			image.src = event.target.result;

			const modal = new bootstrap.Modal(document.getElementById("cropModal"));
			modal.show();

			activeInput = input;

			if (cropper) cropper.destroy();

			cropper = new Cropper(image, {
				aspectRatio: 1,
				viewMode: 1,
				autoCropArea: 1,
				responsive: true,
				scalable: true,
				zoomable: true,
				minContainerWidth: 600,
				minContainerHeight: 600,
				ready() {
					cropper.setCropBoxData({
						width: 200,
						height: 200,
					});
				},
			});
		};
		reader.readAsDataURL(file);
	});
});

document.getElementById("cropImageBtn").addEventListener("click", function () {
	if (!cropper) return;

	const canvas = cropper.getCroppedCanvas({
		width: 200,
		height: 200,
	});

	canvas.toBlob((blob) => {
		const file = new File([blob], "cropped.jpg", { type: "image/jpeg" });

		const dataTransfer = new DataTransfer();
		dataTransfer.items.add(file);
		activeInput.files = dataTransfer.files;

		// Show preview
		const preview = document.getElementById("previewImage");
		const reader = new FileReader();
		reader.onload = function (e) {
			preview.src = e.target.result;
		};
		reader.readAsDataURL(file);

		bootstrap.Modal.getInstance(document.getElementById("cropModal")).hide();
		cropper.destroy();
		cropper = null;
	}, "image/jpeg");
});
