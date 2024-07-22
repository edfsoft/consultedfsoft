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
           redirect('Edfadmin/');
            echo '<script>alert("Please valid details.");</script>';
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "dashboard";
            $overallcc = $this->AdminModel->ccList();
            $this->data['totalCcList'] = $overallcc['totalRows'];
            $overallhcp = $this->AdminModel->hcpList();
            $this->data['totalHcpList'] = $overallhcp['totalRows'];
            $overallpatient = $this->AdminModel->patientList();
            $this->data['totalPatientList'] = $overallpatient['totalRows'];
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
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
           redirect('Edfadmin/');
        }
    }

    public function ccSignupForm()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "ccRegisterForm";
            $specList = $this->HcpModel->getSpecialization();
            $this->data['specializationList'] = $specList;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
        }
    }

    public function ccSignup()
    {
        $ccMobileNum = $this->input->post('ccMobile');

        if ($this->CcModel->checkUserExistence($ccMobileNum)) {
            echo '<script type="text/javascript">
                    alert("Mobile number already exists. Please use a new number.");
                    window.location.href = "' . site_url('Edfadmin/ccList') . '";
                  </script>';
            exit();
             } else {
            $postData = $this->input->post(null, true);
            $register = $this->CcModel->register();
            $generateid = $this->CcModel->generateCcId();
            redirect('Edfadmin/ccList');
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
           redirect('Edfadmin/');
        }
    }

    public function approveCc()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->AdminModel->approveCcDb($ccIdDb);
            redirect('Edfadmin/ccList');
        } else {
           redirect('Edfadmin/');
        }
    }

    public function deleteCc()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->AdminModel->deleteCcDb($ccIdDb);
            redirect('Edfadmin/ccList');
        } else {
           redirect('Edfadmin/');
        }
    }

    public function addAppLink()
    {
        if (isset($_SESSION['adminIdDb'])) {
           $this->CcModel->addAppLinkCc();
            redirect('Edfadmin/ccList');
        } else {
           redirect('Edfadmin/');
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
           redirect('Edfadmin/');
        }
    }

    public function hcpSignupForm()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "hcpRegisterForm";
            $specList = $this->HcpModel->getSpecialization();
            $this->data['specializationList'] = $specList;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
        }
    }

    public function hcpSignup()
    {
        $hcpMobileNum = $this->input->post('hcpMobile');

        if ($this->HcpModel->checkUserExistence($hcpMobileNum)) {
             echo '<script type="text/javascript">
            alert("Mobile number already exists. Please use a new number.");
            window.location.href = "' . site_url('Edfadmin/hcpList') . '";
          </script>';
    exit();
        } else {
            $postData = $this->input->post(null, true);
            $register = $this->HcpModel->register();
            $generateid = $this->HcpModel->generatehcpid();
            redirect('Edfadmin/hcpList');
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
           redirect('Edfadmin/');
        }
    }

    public function approveHcp()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->AdminModel->approveHcpDb($hcpIdDb);
            redirect('Edfadmin/hcpList');
        } else {
           redirect('Edfadmin/');
        }
    }

    public function deleteHcp()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->AdminModel->deleteHcpDb($hcpIdDb);
            redirect('Edfadmin/hcpList');
        } else {
           redirect('Edfadmin/');
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
           redirect('Edfadmin/');
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
           redirect('Edfadmin/');
        }
    }

    public function deletePatient()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $patientIdDb = $this->uri->segment(3);
            $this->AdminModel->deletePatientDb($patientIdDb);
            redirect('Edfadmin/patientList');
        } else {
           redirect('Edfadmin/');
        }
    }

    public function specializationList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "specialization";
            $list = $this->AdminModel->getSpecializationList();
            $this->data['specilalizationList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
        }
    }

    public function addNewSpecilization()
    {
        $postData = $this->input->post(null, true);
        $register = $this->AdminModel->newSpecilization();
        redirect('Edfadmin/specializationList');
    }

    public function deleteSpecilization()
    {
        $specilizationId = $this->uri->segment(3);
        $register = $this->AdminModel->specilizationDelete($specilizationId);
        redirect('Edfadmin/specializationList');
    }

    public function symptomsList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "symptoms";
            $list = $this->AdminModel->getSymptomsList();
            $this->data['symptomsList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
        }
    }

    public function addNewSymptoms()
    {
        $postData = $this->input->post(null, true);
        $register = $this->AdminModel->newSymptoms();
        redirect('Edfadmin/symptomsList');
    }

    public function deleteSymptoms()
    {
        $symptomsId = $this->uri->segment(3);
        $register = $this->AdminModel->symptomsDelete($symptomsId);
        redirect('Edfadmin/symptomsList');
    }

    public function medicinesList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "medicines";
            $list = $this->AdminModel->getMedicinesList();
            $this->data['medicinesList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
           redirect('Edfadmin/');
        }
    }

    public function addNewMedicine()
    {
        $postData = $this->input->post(null, true);
        $register = $this->AdminModel->newMedicine();
        redirect('Edfadmin/medicinesList');
    }

    public function deleteMedicine()
    {
        $medicineId = $this->uri->segment(3);
        $register = $this->AdminModel->medicineDelete($medicineId);
        redirect('Edfadmin/medicinesList');
    }

    public function logout()
    {
        $this->session->unset_userdata('adminIdDb');
        $this->session->unset_userdata('adminName');
        $this->session->unset_userdata('adminMailId');
        $this->session->unset_userdata('adminMobileNum');
       redirect('Edfadmin/');
    }
}