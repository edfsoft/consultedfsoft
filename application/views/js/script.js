//  Display message for 3 seconds
setTimeout(() => {
	const displayMessage = document.getElementById("display_message");
	if (displayMessage) {
		displayMessage.style.display = "none";
	}
}, 3000);

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

// View password CC, HCP and admin password
function togglePasswordVisibility(inputId, iconId) {
	var passwordInput = document.getElementById(inputId);
	var visibilityIcon = document.getElementById(iconId);

	if (passwordInput.type === "password") {
		passwordInput.type = "text";
		visibilityIcon.classList.remove("bi-eye-slash");
		visibilityIcon.classList.add("bi-eye");
	} else {
		passwordInput.type = "password";
		visibilityIcon.classList.remove("bi-eye");
		visibilityIcon.classList.add("bi-eye-slash");
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
