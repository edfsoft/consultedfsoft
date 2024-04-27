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
        // $this->load->view('adminDashboard.php');
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

    public function hcpList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "healthCareProvider";
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            $this->index();
        }
    }

    public function patientList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "patient";
            $this->load->view('adminDashboard.php', $this->data);
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