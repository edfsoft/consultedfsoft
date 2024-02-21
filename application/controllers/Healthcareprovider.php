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

public function dashboard()
{
    $this->data['method'] = "dashboard";
    $this->load->view('hcpDashboard.php',  $this->data);
}
    
public function patients()
{
    $this->data['method'] = "patients";
    $this->load->view('hcpDashboard.php',  $this->data);
}

public function patientform()
{
    $this->data['method'] = "patientDetailsform";
    $this->load->view('hcpDashboard.php',  $this->data);
}

}