<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consult@EDF</title>
    <link href="<?php echo base_url(); ?>assets/edfTitleLogo.png" rel="icon">
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        html {
            scroll-behavior: auto !important;
            scroll-padding-top: 90px !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow px-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://www.erodediabetesfoundation.org/" target="blank"><img
                    src="<?php echo base_url(); ?>assets/edf_logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ps-5" id="navbarNavDropdown">
                <ul class="navbar-nav ps-5">
                    <li class="nav-item">
                        <a class="nav-link text-dark me-4" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-4" aria-current="page" href="#whychooseus">About us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark me-4" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu border-0 rounded-3 shadow mt-2 p-2"
                            aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#services">Online Consultation</a></li>
                            <li><a class="dropdown-item"
                                    href="https://erodediabetesfoundation.org/service/diabetes-consult/"
                                    target="blank">Diabetes Consult</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-4" href="https://www.erodediabetesfoundation.org/blog/"
                            target="blank">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-4" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#contactus">Contact us</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex text-center">
                <div class="dropdown me-4 me-sm-0">
                    <button class="btn rounded-pill text-light me-sm-4 px-4" style="background-color:#00AD8E;"
                        type="button" id="dropDownLogin" data-bs-toggle="dropdown" aria-expanded="false">
                        Login
                    </button>
                    <ul class="dropdown-menu border-0 rounded-3 shadow mt-3 p-2" style="transform: translateX(-50px);"
                        aria-labelledby="dropDownLogin">
                        <li><a href="<?php echo base_url() . "Healthcareprovider/" ?>" class="dropdown-item py-2">Health
                                Care Provider</a></li>
                        <li><a href="<?php echo base_url() . "Chiefconsultant/" ?>" class="dropdown-item py-2">
                                Chief Consultant</a></li>
                        <li><a href="<?php echo base_url() . "Patient/" ?>" class="dropdown-item py-2">
                                Patient</a></li>
                    </ul>
                </div>

                <!-- <div class="dropdown ms-4 ms-sm-0">
                    <a href="<?php echo base_url() . "Healthcareprovider/register" ?>">
                        <button class="btn btn-danger rounded-pill text-light px-4" type="button">Signup</button></a>
                </div> -->
                <div class="dropdown ms-4 ms-sm-0">
                    <button class="btn btn-danger rounded-pill text-light px-4" type="button" id="dropDownSignup"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Signup
                    </button>
                    <ul class="dropdown-menu border-0 rounded-3 shadow mt-3 p-2" style="transform: translateX(-70px);"
                        aria-labelledby="dropDownSignup">
                        <li><a href="<?php echo base_url() . "Healthcareprovider/register" ?>"
                                class="dropdown-item py-2">Health Care Provider</a></li>
                        <li><a href="<?php echo base_url() . "Chiefconsultant/register" ?>"
                                class="dropdown-item py-2">Chief Consultant</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div id="home" class="d-lg-flex justify-content-between pt-sm-5 ps-sm-5" style="background-color:#EEF6F5;">
        <div class="m-4 ms-sm-5 mt-3 mt-sm-5 pt-4 pt-sm-0 fs-1" style="font-weight:500;">
            Specialized <span class="text-danger">Diabetes Support</span> from the convenience of your
            own home
            <p class="pt-3" style="font-size:18px;font-weight:400;"> Online Video Consultations With <br> Expert
                Diabetologists.</p>
            <a href="<?php echo base_url() . "Healthcareprovider/appointmentsForm" ?>"><img
                    src="<?php echo base_url(); ?>assets/bookAppointBtn.png" alt="book"></a>
        </div>
        <img class="d-none d-lg-block img-fluid ms-2" src="<?php echo base_url(); ?>assets/banner.png" alt="banner">
    </div>

    <!-- Special -->
    <div id="services" class="container">
        <div class=" justify-content-md-center">
            <div class="col-lg-auto">
                <div class="d-lg-flex text-center align-items-center m-lg-5">
                    <img class="text-center img-fluid" src="<?php echo base_url(); ?>assets/special.svg" alt="special">
                    <div class="text-lg-start ps-md-5 p-2" style="font-size:36px;font-weight:500;">
                        We Provide Best <span style="color:#00AD8E;">Online Doctor Consultation</span> for you
                        <p class="pt-4" style="font-size:18px;font-weight:400;">Feel free to secure diabetes
                            consultations online at your convenience, connecting with reliable and experienced medical
                            professionals. You can arrange your appointment by giving us a call and the rest is in our
                            capable hands. <br><br> While video consultations offer the benefit of the comfort of your
                            home, they do not compromise the treatment protocol. <br>
                            <button class="btn text-light rounded-pill mt-3 px-3" style="background-color:#00AD8E;">Read
                                More</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why choose -->
    <div id="whychooseus" class="py-5 position-relative"
        style="background-color:#FFF4F4;background-image: url('<?php echo base_url(); ?>assets/whysvg2.svg');background-repeat: no-repeat;background-position: right top;z-index:-2;">
        <div class="position-relative">
            <img class="position-absolute top-0 start-0" src="assets/whysvg1.svg" alt="1" style="z-index: -1;">
        </div>

        <h3 class="pt-lg-5 text-center" style="font-size:36px;font-weight:500;">
            Why choose us? </h3>
        <p class="pt-4 text-center" style="font-size:18px;font-weight:400;">Choose us for expert online diabetic
            consultations, providing <br> personalized care from certified professionals. </p>

        <div class="d-lg-flex justify-content-evenly pt-lg-4">
            <div class="col-lg-2 text-center"> <img class="mt-lg-5 pt-3"
                    src="<?php echo base_url(); ?>assets/choose1.png" alt="1">
                <p class="text-danger pt-2 pt-lg-5 " style="font-size:20px;font-weight:500;">Video Consultations</p>
                <p class="px-2" style="font-size:18px;font-weight:400;">Experience the convenience of video
                    consultations for diabetic care from the comfort of your home.
                </p>
            </div>
            <div class="col-lg-2 text-center"> <img class="pt-3 pb-lg-2 "
                    src="<?php echo base_url(); ?>assets/choose2.png" alt="2">
                <p class="text-danger pt-2 pt-lg-5" style="font-size:20px;font-weight:500;"> Best Online Doctors</p>
                <p class="px-2" style="font-size:18px;font-weight:400;">Experience top-notch online diabetic care with
                    our expert doctors, providing personalized consultations.
                </p>
            </div>
            <div class="col-lg-2 text-center"> <img class="pt-3 mt-lg-5"
                    src="<?php echo base_url(); ?>assets/choose3.png" alt="3">
                <p class="text-danger pt-2 pt-lg-4" style="font-size:20px;font-weight:500;">Digital Medical Records</p>
                <p class="px-2" style="font-size:18px;font-weight:400;">Effortlessly manage your diabetic health with
                    our online consultation platform, featuring secure.
                </p>
            </div>
            <div class="col-lg-2 text-center"> <img class="pt-3 pt-lg-4 pb-lg-3"
                    src="<?php echo base_url(); ?>assets/choose4.png" alt="4">
                <p class="text-danger pt-2 pt-lg-5 mt-lg-3" style="font-size:20px;font-weight:500;">Secure Patient
                    Records</p>
                <p class="px-2" style="font-size:18px;font-weight:400;">Trust us for a confidential and secure platform
                    dedicated to your well-being.
                </p>
            </div>
        </div>
    </div>

    <!-- Happy Patients -->
    <div id="testimonials" class="my-5 pt-5">
        <div class="text-center">
            <img src="<?php echo base_url(); ?>assets/happysmile.svg" alt="happy">
            <p style="font-size:36px;font-weight:500;">Happy Patients</p>
            <p class="px-2" style="font-size:18px;font-weight:400;">What Our Patients Say About Our Medical Treatments
            </p>
        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" style="padding-top:100px;">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1" style="text-indent:0;"><span class="badge bg-success">
                    </span></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2" style="text-indent:0;"><span class="badge bg-success"> </button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3" style="text-indent:0;"><span class="badge bg-success"> </button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item ">
                    <div class="d-md-flex justify-content-center p-3 pb-5">
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="1">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Suesh Krishanan</p>
                        </div>
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="2">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Govinda jushani</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="d-md-flex justify-content-center  p-3 pb-5">
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="1">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Suesh Krishanan</p>
                        </div>
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="2">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Govinda jushani</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-md-flex justify-content-center  p-3 pb-5">
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients1.png" alt="1">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Suesh Krishanan</p>
                        </div>
                        <div class=" col-md-5 text-center border border-2 rounded-3 m-3 p-5">
                            <img src="<?php echo base_url(); ?>assets/happyPatients2.png" alt="2">
                            <p class="text-secondary pt-2" style="font-size:18px;font-weight:400;"> “Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
                            <p style="font-size:18px;font-weight:400;">Govinda jushani</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div id="contactus" class="container-fluid pt-5"
        style="background-image: url('<?php echo base_url(); ?>assets/footer.png');background-size: cover;background-position: center center;background-repeat: no-repeat;">
        <div class="row">
            <div class="col-12 text-center ">
                <img src="<?php echo base_url(); ?>assets/edf_logo.png" alt="logo">
                <p class="text-light pt-2" style="font-size:18px;font-weight:400;"> “Empowering lives through expert
                    diabetes consultations online, <br> Your journey to a healthier, happier life starts here.”</p>
                <hr class="my-4 text-light mx-auto" style="width:50%;height: 2px;">
                <div class="d-lg-flex justify-content-evenly ">
                    <p style="font-size:18px;font-weight:400;" class="text-light"><img
                            src="<?php echo base_url(); ?>assets/phone-call.svg" alt="1"> <a href="tel:9789494299"
                            style="font-size:18px;font-weight:400;" class="text-decoration-none text-light fs-6">+91
                            9789494299</a> , <a href="tel:04242264949" style="font-size:18px;font-weight:400;"
                            class="text-decoration-none text-light fs-6">04242264949</a></p>
                    <p><a href="mailto:contact@erodediabetesfoundation.org" style="font-size:18px;font-weight:400;"
                            class="text-decoration-none text-light fs-6"><img
                                src="<?php echo base_url(); ?>assets/mail.svg" alt="1">
                            contact@erodediabetesfoundation.org</a></p>
                    <p><a href="https://www.google.com/maps/place/Maruthi+Medical+Center+Erode+-+Multispeciality+Hospitals%2FInfertility+Clinic%2FIVF+Treatment+Center%2FTest+Tube+Baby+Center%2FIUI+Center/@11.3383515,77.7104976,17z/data=!4m10!1m2!2m1!1s564,Perundurai+road,+Erode-11!3m6!1s0x3ba96f34f915e187:0xb1e50821faa81313!8m2!3d11.3381551!4d77.7130846!15sCh01NjQsUGVydW5kdXJhaSByb2FkLCBFcm9kZS0xMZIBEGZlcnRpbGl0eV9jbGluaWPgAQA!16s%2Fg%2F1ptvtx91z?entry=ttu"
                            style="font-size:18px;font-weight:400;" target="blank"
                            class="text-decoration-none text-light fs-6"><img
                                src="<?php echo base_url(); ?>assets/location.svg" alt="1"> 564, Perundurai road,
                            Erode-11</a></p>
                </div>
                <p style="font-size:13px;font-weight:400;" class="text-light pt-2">Copyright © 2024 <a
                        href="https://www.erodediabetesfoundation.org/" target="blank"
                        style="font-size:13px;font-weight:400;" class="text-light">Erodediabetesfoundation</a> All
                    rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- <p>Welcome to Online Consultation</p> -->

    <!-- Bootstrap 5.1.3 JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Event listener to block right-click -->
    <script>
        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);
    </script>

    <!-- Hide page source Ctrl + U -->
    <script>
        document.onkeydown = function (e) {
            if (e.ctrlKey && e.keyCode === 85) {
                return false;
            }
        };
    </script>

</body>

</html>