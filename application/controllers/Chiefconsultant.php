<?php
defined('BASEPATH') or exit('No direct script access allowed');

class chiefconsultant extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->model('HcpModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('ccLogin.php');
    }

    public function register()
    {
        $specList = $this->HcpModel->getSpecialization();
        $this->data['specializationList'] = $specList;
        $this->load->view('ccRegister.php', $this->data);
    }

    public function resetPassword()
    {
        $this->load->view('ccForgetPassword.php');
    }

    public function ccSignup()
    {
        $ccMobileNum = $this->input->post('ccMobile');

        if ($this->CcModel->checkUserExistence($ccMobileNum)) {
            echo '<script type="text/javascript">
            alert("Mobile number already exists. Please use a new number.");
            window.location.href = "' . site_url('Chiefconsultant/register') . '";
          </script>';
            exit();
        } else {
            $postData = $this->input->post(null, true);
            $register = $this->CcModel->register();
            $generateid = $this->CcModel->generateCcId();
            redirect('Chiefconsultant/');
        }
    }

    public function ccLogin()
    {
        $postData = $this->input->post(null, true);
        $login = $this->CcModel->ccLoginDetails();
        if (isset($login[0]['id']) && ($login[0]['approvalStatus'] == "1")) {
            $LoggedInDetails = array(
                'ccIdDb' => $login[0]['id'],
                'ccId' => $login[0]['ccId'],
                'ccName' => $login[0]['doctorName'],
                'ccMailId' => $login[0]['doctorMail'],
                'ccMobileNum' => $login[0]['doctorMobile'],
            );
            $this->session->set_userdata($LoggedInDetails);
            redirect('Chiefconsultant/dashboard');
        } else if (isset($login[0]['approvalStatus']) && $login[0]['approvalStatus'] == 0) {
             echo '<script type="text/javascript">
            alert("You can log in once the verification process is done.");
            window.location.href = "' . site_url('Chiefconsultant/') . '";
          </script>';
            exit();
        } else {
            echo '<script type="text/javascript">
            alert("Please enter registered details.");
            window.location.href = "' . site_url('Chiefconsultant/') . '";
          </script>';
            exit();
        }
    }

    public function setVariable()
    {
        $appointmentList = $this->CcModel->getAppointmentList();
        $this->data['appointmentListCount'] = $appointmentList['totalRows'];
    }

    public function dashboard()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "dashboard";
            $patientTotal = $this->CcModel->allPatientList();
            $this->data['patientTotal'] = $patientTotal['totalRows'];
            $hcpDetails = $this->CcModel->getHcpProfile();
            $this->data['totalHcps'] = $hcpDetails['totalRows'];
            $appointmentList = $this->CcModel->getAppointmentListDash();
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function patients()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "patients";
            $patientDetails = $this->CcModel->allPatientList();
            $this->data['patientDetails'] = $patientDetails['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function patientdetails()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function prescriptionView()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "prescription";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function appointments()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "appointments";
            $appointmentList = $this->CcModel->getAppointmentList();
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function healthCareProviders()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "hcps";
            $hcpDetails = $this->CcModel->getHcpProfile();
            $this->data['hcpDetails'] = $hcpDetails['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function healthCareProvidersProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->data['method'] = "hcpsProfile";
            $hcpDetails = $this->CcModel->getHcpDetails($hcpIdDb);
            $this->data['hcpDetails'] = $hcpDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function myProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "myProfile";
            $ccDetails = $this->CcModel->getCcDetails();
            $this->data['ccDetails'] = $ccDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function editMyProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "editMyProfile";
            $ccDetails = $this->CcModel->getCcDetails();
            $specList = $this->HcpModel->getSpecialization();
            $this->data['specializationList'] = $specList;
            $this->data['ccDetails'] = $ccDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function updatePhoto()
    {
        $profileDetails = $this->CcModel->updateProfilePhoto();
        redirect('Chiefconsultant/editMyProfile');
    }

    public function updateMyProfile()
    {
        $profileDetails = $this->CcModel->updateProfileDetails();
        redirect('Chiefconsultant/myProfile');
    }

    public function logout()
    {
        // $this->session->unset_userdata('LoggedInDetails');
        // unset($this->session->LoggedInDetails('ccId'));
        // unset($this->session->userdata('ccId'));
        // $this->session->mark_as_flash('LoggedInDetails');
        $this->session->unset_userdata('ccIdDb');
        $this->session->unset_userdata('ccId');
        $this->session->unset_userdata('ccName');
        $this->session->unset_userdata('ccMailId');
        $this->session->unset_userdata('ccMobileNum');
        redirect('Chiefconsultant/');
    }


}