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

    public function dashboard()
    {
        $this->data['method'] = "dashboard";
        $this->load->view('ccDashboard.php', $this->data);
    }

    public function patients()
    {
        $this->data['method'] = "patients";
        $this->load->view('ccDashboard.php', $this->data);
    }
}