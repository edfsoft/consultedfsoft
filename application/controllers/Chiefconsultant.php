<?php
defined('BASEPATH') or exit('No direct script access allowed');

class chiefconsultant extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('ccLogin.php');
    }

    public function register()
    {
        $this->load->view('ccRegister.php');
    }

    public function ccSignup()
    {
        $ccMobileNum = $this->input->post('ccMobile');

        if ($this->CcModel->checkUserExistence($ccMobileNum)) {
            echo '<script>alert("Mobile number already exists. Please use a new number.");</script>';
            $this->register();
        } else {
            $postData = $this->input->post(null, true);
            $register = $this->CcModel->register();
            $generateid = $this->CcModel->generateCcId();
            $this->index();
        }
    }

    public function ccLogin()
    {
        $postData = $this->input->post(null, true);
        $login = $this->CcModel->ccLoginDetails();
        if (isset($login[0]['id'])) {
            $LoggedInDetails = array(
                'ccIdDb' => $login[0]['id'],
                'ccId' => $login[0]['ccId'],
                'ccName' => $login[0]['doctorName'],
                'ccMailId' => $login[0]['doctorMail'],
                'ccMobileNum' => $login[0]['doctorMobile'],
            );
            $this->session->set_userdata($LoggedInDetails);
            $this->dashboard();
        } else {
            $this->index();
            echo '<script>alert("Please enter registered details.");</script>';
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "dashboard";
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function patients()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "patients";
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function appointments()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "appointments";
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function healthCareProviders()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "hcps";
            $hcpDetails = $this->CcModel->getHcpProfile();
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function healthCareProvidersProfile()
    {
        $hcpIdDb = $this->uri->segment(3);
        $this->data['method'] = "hcpsProfile";
        $hcpDetails = $this->CcModel->getHcpDetails($hcpIdDb);
        $this->data['hcpDetails'] = $hcpDetails;
        $this->load->view('ccDashboard.php', $this->data);
    }

    public function myProfile()
    {
        $this->data['method'] = "myProfile";
        $ccDetails = $this->CcModel->getCcDetails();
        $this->data['ccDetails'] = $ccDetails;
        $this->load->view('ccDashboard.php', $this->data);
    }

    public function editMyProfile()
    {
        $this->data['method'] = "editMyProfile";
        $ccDetails = $this->CcModel->getCcDetails();
        $this->data['ccDetails'] = $ccDetails;
        $this->load->view('ccDashboard.php', $this->data);
    } 
    
    public function updateMyProfile()
    {
        $profileDetails = $this->CcModel->updateProfileDetails();
        $this->myProfile();
    }

    // public function logout()
    // {
    //     $this->session->sess_destroy();
    //     $this->index();
    // }

    public function logout()
    {
        $this->session->unset_userdata('LoggedInDetails');
        $this->index();
    }


}