<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consult@EDF - Page Not Found</title>
	<link href="https://consult.edftech.in/assets/edfTitleLogo.png" rel="icon">
	<!-- Font -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

	<style>
		body {
			/* background: linear-gradient(135deg, #004369 0%, #002b4a 100%); */
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Poppins', sans-serif;
			color: #fff;
		}

		.error-container {
			background: rgba(255, 255, 255, 0.98);
			border-radius: 24px;
			box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
			padding: 50px 40px;
			text-align: center;
			max-width: 650px;
			width: 92%;
			position: relative;
			overflow: hidden;
		}

		.error-container::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 8px;
			background: linear-gradient(90deg, #BF1B2C, #004369);
		}

		.logo {
			max-height: 90px;
			margin-bottom: 20px;
			transition: transform 0.3s ease;
		}

		.logo:hover {
			transform: scale(1.05);
		}

		.display-1 {
			font-weight: 900;
			font-size: 8rem;
			color: #004369;
			text-shadow: 4px 4px 15px rgba(0, 0, 0, 0.2);
			margin-bottom: 10px;
		}

		.lead {
			font-size: 1.5rem;
			color: #BF1B2C;
			font-weight: 600;
			margin-bottom: 15px;
		}

		.text-muted-custom {
			color: #444 !important;
			font-size: 1.1rem;
			margin-bottom: 40px;
		}

		.btn-home {
			background-color: #BF1B2C;
			border: none;
			padding: 14px 36px;
			font-size: 1.2rem;
			font-weight: 600;
			border-radius: 50px;
			box-shadow: 0 6px 15px rgba(191, 27, 44, 0.3);
			transition: all 0.3s ease;
		}

		.btn-home:hover {
			background-color: #a01625;
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(191, 27, 44, 0.4);
		}

		.btn-back {
			background-color: transparent;
			color: #004369;
			border: 2px solid #004369;
			padding: 14px 36px;
			font-size: 1.2rem;
			font-weight: 600;
			border-radius: 50px;
			transition: all 0.3s ease;
		}

		.btn-back:hover {
			background-color: #004369;
			color: white;
			transform: translateY(-3px);
		}

		.btn i {
			margin-right: 8px;
		}

		@media (max-width: 576px) {
			.display-1 {
				font-size: 5.5rem;
			}

			.lead {
				font-size: 1.3rem;
			}

			.error-container {
				padding: 40px 20px;
			}
		}
	</style>
</head>

<body>
	<div class="error-container">
		<!-- Clickable Logo to Home -->
		<a href="https://consult.edftech.in/">
			<img src="https://consult.edftech.in/assets/edf_logo.png" alt="Your Logo" class="logo img-fluid">
		</a>

		<h1 class="display-1">404</h1>
		<p class="lead">Oops! Page Not Found</p>
		<p class="text-muted-custom">
			The page you are looking for might have been removed, had its name changed or is temporarily unavailable.
		</p>

		<div>
			<!-- Home Button -->
			<a href="https://consult.edftech.in/" class="btn btn-home text-white me-3">
				<i class="bi bi-house-door-fill"></i> Back to Home
			</a>
			<!-- Back Button -->
			<a href="javascript:history.back()" class="btn btn-back mt-3 mt-sm-0">
				<i class="bi bi-arrow-left-circle"></i> Go Back
			</a>
		</div>
	</div>

	<!-- Bootstrap JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>