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
            // $generateid = $this->HcpModel->generatehcpid();
            $this->index();
        }
    }

    public function hcpLogin()
    {
        $postData = $this->input->post(null, true);
        $login = $this->HcpModel->hcpLoginDetails();
        if (isset($login[0]['id'])) {
            $LoggedInDetails = array(
                'hcpsName' => $login[0]['hcpName'],
                'hcpsMailId' => $login[0]['hcpMail'],
                'hcpsMobileNum' => $login[0]['hcpMobile'],
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
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "dashboard";
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
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
            // echo '<script>alert("Please Login");</script>';
        }
    }

    public function patientform()
    {
        $this->data['method'] = "patientDetailsForm";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function patientdetails()
    {
        $this->data['method'] = "patientDetails";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function appointments()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointments";
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
            // echo '<script>alert("Please Login");</script>';
        }

    }

    public function appointmentsForm()
    {
        $this->data['method'] = "appointmentsForm";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function chiefDoctors()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "chiefDoctors";
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            $this->index();
            // echo '<script>alert("Please Login");</script>';
        }

    }

    public function chiefDoctorsProfile()
    {
        $this->data['method'] = "chiefDoctorProfile";
        $this->load->view('hcpDashboard.php', $this->data);
    }
    public function myProfile()
    {
        $this->data['method'] = "myProfile";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function editMyProfile()
    {
        $this->data['method'] = "editMyProfile";
        $this->load->view('hcpDashboard.php', $this->data);
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