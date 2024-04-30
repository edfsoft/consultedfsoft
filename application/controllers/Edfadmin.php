<?php
defined('BASEPATH') or exit('No direct script access allowed');

class edfadmin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->model('HcpModel');
        $this->load->model('AdminModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('adminLogin.php');
    }

    public function adminLogin()
    {
        $login = $this->AdminModel->adminLoginDetails();
        if (isset($login[0]['id'])) {
            $LoggedInDetails = array( 
                'adminIdDb' => $login[0]['id'],
                'adminName' => $login[0]['adminName'],
                'adminMailId' => $login[0]['adminMailId'],
                'adminMobileNum' => $login[0]['adminMobile'],
               
            );
            $this->session->set_userdata($LoggedInDetails);
            $this->dashboard();
        } else {
            $this->index();
            echo '<script>alert("Please valid details.");</script>';
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "dashboard";
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function ccList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "chiefConsultant";
            $overallcc = $this->AdminModel->ccList();
            $this->data['ccList'] = $overallcc['response'];
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function ccDetails()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->data['method'] = "ccDetails";
            $ccDetails = $this->AdminModel->ccAllDetails($ccIdDb);
            $this->data['ccDetails'] = $ccDetails;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function approveCc()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->AdminModel->approveCcDb($ccIdDb);
            $this->ccList();
        } else {
            $this->index();
        }
    }

    public function deleteCc()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->AdminModel->deleteCcDb($ccIdDb);
            $this->ccList();
        } else {
            $this->index();
        }
    }

    public function hcpList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "healthCareProvider";
            $overallhcp = $this->AdminModel->hcpList();
            $this->data['hcpList'] = $overallhcp['response'];
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function hcpDetails()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->data['method'] = "hcpDetails";
            $hcpDetails = $this->AdminModel->hcpAllDetails($hcpIdDb);
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function approveHcp()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->AdminModel->approveHcpDb($hcpIdDb);
            $this->hcpList();
        } else {
            $this->index();
        }
    }

    public function deleteHcp()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->AdminModel->deleteHcpDb($hcpIdDb);
            $this->hcpList();
        } else {
            $this->index();
        }
    }

    public function patientList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "patient";
            $overallpatient = $this->AdminModel->patientList();
            $this->data['patientList'] = $overallpatient['response'];
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function patientDetails()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $patientIdDb = $this->uri->segment(3);
            $this->data['method'] = "patientDetails";
            $patientDetails = $this->AdminModel->patientAllDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function deletePatient()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $patientIdDb = $this->uri->segment(3);
            $this->AdminModel->deletePatientDb($patientIdDb);
            $this->patientList();
        } else {
            $this->index();
        }
    }

   public function logout()
    {
        $this->session->unset_userdata('adminIdDb');
        $this->session->unset_userdata('adminName');
        $this->session->unset_userdata('adminMailId');
        $this->session->unset_userdata('adminMobileNum');
        $this->index();
    }
}