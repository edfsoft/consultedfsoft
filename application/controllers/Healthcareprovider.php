<?php
defined('BASEPATH') or exit('No direct script access allowed');

class healthcareprovider extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('HcpModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('hcpLogin.php');
    }

    public function register()
    {
        $this->load->view('hcpRegister.php');
    }

    public function hcpSignup()
    {
        $hcpMobileNum = $this->input->post('hcpMobile');

        if ($this->HcpModel->checkUserExistence($hcpMobileNum)) {
            echo '<script>alert("Mobile number already exists. Please use a new number.");</script>';
            $this->register();
        } else {
            $postData = $this->input->post(null, true);
            $register = $this->HcpModel->register();
            $generateid = $this->HcpModel->generatehcpid();
            $this->index();
        }
    }

    public function hcpLogin()
    {
        $login = $this->HcpModel->hcpLoginDetails();
        if (isset($login[0]['id']) && ($login[0]['approvalStatus']== "1")) {
            $LoggedInDetails = array(
                'hcpIdDb' => $login[0]['id'],
                'hcpId' => $login[0]['hcpId'],
                'hcpsName' => $login[0]['hcpName'],
                'hcpsMailId' => $login[0]['hcpMail'],
                'hcpsMobileNum' => $login[0]['hcpMobile'],
            );
            $this->session->set_userdata($LoggedInDetails);
            $this->dashboard();
        } else if (isset($login[0]['approvalStatus']) && $login[0]['approvalStatus']== 0) {
            $this->index();
            echo '<script>alert("You can log in once the verification process is done.");</script>';
        } else {
            $this->index();
            echo '<script>alert("Please enter registered details.");</script>';
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "dashboard";
            $patientTotal = $this->HcpModel->getPatientList();
            $this->data['patientTotal'] = $patientTotal['totalRows'];
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['totalCcs'] = $ccDetails['totalRows'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
            // echo '<script>alert("Please Login");</script>';
        }
    }

    public function patients()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patients";
            $patientList = $this->HcpModel->getPatientList();
            $this->data['patientList'] = $patientList['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function patientform()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetailsForm";
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function addPatientsForm()
    {
        $profileDetails = $this->HcpModel->insertPatients();
        $generateid = $this->HcpModel->generatePatientId();
        $this->patients();
    }

    public function patientdetails()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function patientformUpdate()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetailsFormUpdate";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function updatePatientsForm()
    {
        $profileDetails = $this->HcpModel->updatePatients();
        $this->patients();
    }

    public function updatePatientPhoto()
    {
        $profilePhoto = $this->HcpModel->updatePatientProfile();
        $this->patients();
    }

    public function appointments()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointments";
            $appointmentList = $this->HcpModel->getAppointmentList();
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function appointmentsForm()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointmentsForm";
            $patientList = $this->HcpModel->getPatientList();
            $this->data['patientsId'] = $patientList['response'];
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['ccsId'] = $ccDetails['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function newAppointment()
    {
        $appointmentDetails = $this->HcpModel->insertappointment();
        $this->appointments();
    }

    public function chiefDoctors()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "chiefDoctors";
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['ccDetails'] = $ccDetails['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function chiefDoctorsProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->data['method'] = "chiefDoctorProfile";
            $ccDetails = $this->HcpModel->getCcDetails($ccIdDb);
            $this->data['ccDetails'] = $ccDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function myProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "myProfile";
            $hcpDetails = $this->HcpModel->getHcpDetails();
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function editMyProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "editMyProfile";
            $hcpDetails = $this->HcpModel->getHcpDetails();
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function updatePhoto()
    {
        $profileDetails = $this->HcpModel->updateProfilePhoto();
        $this->editMyProfile();
    }

    public function updateMyProfile()
    {
        $profileDetails = $this->HcpModel->updateProfileDetails();
        $this->myProfile();
    }

    // public function getDetails()
    // {
    //     $patientList = $this->HcpModel->getPatientList();
    //     $this->data['patientList'] = $patientList['response'];
    //     $this->load->view('hcpDashboard.php',  $this->data);
    // }

    // public function logout()
    // {
    //     $this->session->sess_destroy();
    //     $this->index();
    // }

    public function logout()
    {
        // $this->session->unset_userdata('LoggedInDetails');
        $this->session->unset_userdata('hcpIdDb');
        $this->session->unset_userdata('hcpId');
        $this->session->unset_userdata('hcpsName');
        $this->session->unset_userdata('hcpsMailId');
        $this->session->unset_userdata('hcpsMobileNum');
        $this->index();
    }
}