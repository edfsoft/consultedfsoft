<?php
defined('BASEPATH') or exit('No direct script access allowed');

class patient extends CI_Controller
{

        function __construct()
    {
        parent::__construct();

        $this->load->model('patientModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('patientLogin');
    }

    public function login()
    {
        $login = $this->patientModel->patientLoginDetails();

        if (isset($login['id'])) {

            $this->session->set_userdata([
                'patientIdDb' => $login['id'],
                'patientId'   => $login['patientId'],
                'patientName' => $login['firstName'],
                'patientMail' => $login['mailId']
            ]);

            redirect('Patient/dashboard');

        } else {
            $this->session->set_flashdata('errorMessage', 'Invalid email or password');
            redirect('Patient');
        }
    }

    public function dashboard()
    {
        $this->load->view('patientDashboard.php');
    }

}
