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

    public function dashboard()
    {
        $this->data['method'] = "dashboard";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function patients()
    {
        $this->data['method'] = "patients";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function patientform()
    {
        $this->data['method'] = "patientDetailsForm";
        $this->load->view('hcpDashboard.php', $this->data);
    }
    public function appointments()
    {
        $this->data['method'] = "appointments";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function appointmentsForm()
    {
        $this->data['method'] = "appointmentsForm";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function chiefDoctors()
    {
        $this->data['method'] = "chiefDoctors";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function myProfile()
    {
        $this->data['method'] = "myProfile";
        $this->load->view('hcpDashboard.php', $this->data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }
}