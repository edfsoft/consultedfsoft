<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edfadmin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->model('HcpModel');
        $this->load->model('AdminModel');
        $this->load->model('ConsultModel');
        $this->load->library('session');
        $this->load->library('email');
        $this->check_session_timeout();
    }

    private function check_session_timeout()
    {
        $session_lifetime = 1800; // 30 minutes
        $alert_time = 1200; // 10 minutes (for alert)
        $last_activity = $this->session->userdata('last_activity_time');

        if ($this->session->userdata('adminIdDb')) {
            if ($last_activity) {
                $inactive_time = time() - $last_activity;
                if ($inactive_time >= $alert_time && $inactive_time < $session_lifetime) {
                    $this->session->set_flashdata('showErrorMessage', 'You have been inactive for 10 minutes. You will be logged out soon due to inactivity.');
                }
                if ($inactive_time >= $session_lifetime) {
                    $this->session->set_flashdata('errorMessage', 'Session expired due to inactivity for last 30 minutes.');
                    $this->session->unset_userdata('adminIdDb');
                    $this->session->unset_userdata('adminName');
                    $this->session->unset_userdata('adminMailId');
                    $this->session->unset_userdata('adminMobileNum');
                    $this->session->unset_userdata('last_activity_time');
                    $this->session->sess_regenerate(TRUE);
                    redirect('Edfadmin/');
                }
            }
            $this->session->set_userdata('last_activity_time', time());
        }
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
            $this->session->set_flashdata('errorMessage', 'Please valid details.');
            redirect('Edfadmin/');
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
        $mobileNumber = $this->input->post('ccMobile');
        $mailId = $this->input->post('ccEmail');
        $pswd = $this->input->post('ccCnfmPassword');

        $existingFields = $this->CcModel->check_existing_user($mobileNumber, $mailId);

        if (!empty($existingFields)) {
            $errorMessage = implode(', ', $existingFields) . ' already exist. Please use different credential.';
            $this->session->set_flashdata('showErrorMessage', $errorMessage);
            redirect('Edfadmin/ccList');
            exit();
        } else {
            $register = $this->CcModel->register();
            $id = $this->CcModel->generateCcId();

            $message = "Hi there, <br><br>
            Your account has been created as Chief Consultant [CC].<br>
            Login URL: <b>https://consult.edftech.in/</b><br>
            Mail Id: <b>" . $mailId . " </b><br>
            Password: <b>" . $pswd . " </b><br>
            You will be required to change your password upon first login.
            <br><br> Warm regards, <br>
            Team EDF";
            $this->email->from('noreply@consult.edftech.in', 'EDF Tech Account Creation');
            $this->email->to($mailId);
            $this->email->subject('Your Account Login Credentials');
            $this->email->message($message);
            $this->email->send();
            // if ($this->email->send()) {
            //     echo 'status success';
            // }

            if ($register && $id) {
                $this->session->set_flashdata('showSuccessMessage', 'CC added successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in adding CC');
            }
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
            if ($this->AdminModel->approveCcDb($ccIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'CC status updated successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in approving CC');
            }
            redirect('Edfadmin/ccList');
        } else {
            redirect('Edfadmin/');
        }
    }

    public function addAppLink()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            if ($this->CcModel->addAppLinkCc($ccIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'Appointment link added successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in adding appointment link');
            }
            redirect('Edfadmin/ccDetails/' . $ccIdDb);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function deleteCc()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            if ($this->AdminModel->deleteCcDb($ccIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'CC deleted successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in deleting CC');
            }
            redirect('Edfadmin/ccList');
        } else {
            redirect('Edfadmin/');
        }
    }

    //Check duplicate number and for new HCP or CC Signup
    public function check_duplicate_user()
    {
        $type = $this->input->post('type'); // 'Cc' or 'Hcp'
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');

        $existing_errors = [];

        if ($type == 'Cc') {
            $existing_errors = $this->CcModel->check_existing_user($mobile, $email);
        } else if ($type == 'Hcp') {
            $existing_errors = $this->HcpModel->check_existing_user($mobile, $email);
        }

        $response = [
            'mobile_exists' => in_array('Mobile Number', $existing_errors),
            'email_exists' => in_array('Mail Id', $existing_errors)
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
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
        $hcpMailId = $this->input->post('hcpEmail');
        $pswd = $this->input->post('hcpCnfmPassword');

        $existingFields = $this->HcpModel->check_existing_user($hcpMobileNum, $hcpMailId);

        if (!empty($existingFields)) {
            $errorMessage = implode(', ', $existingFields) . ' already exist. Please use different credential.';
            $this->session->set_flashdata('showErrorMessage', $errorMessage);
            redirect('Edfadmin/hcpList');
            exit();
        } else {
            $register = $this->HcpModel->register();
            $id = $this->HcpModel->generatehcpid();

            $message = "Hi there, <br><br>
            Your account has been created as Health Care Provider [HCP].<br>
            Login URL: <b>https://consult.edftech.in/</b><br>
            Mail Id: <b>" . $hcpMailId . " </b><br>
            Password: <b>" . $pswd . " </b><br>
            You will be required to change your password upon first login.
            <br><br> Warm regards, <br>
            Team EDF";
            $this->email->from('noreply@consult.edftech.in', 'EDF Tech Account Creation');
            $this->email->to($hcpMailId);
            $this->email->subject('Your Account Login Credentials');
            $this->email->message($message);
            $this->email->send();
            // if ($this->email->send()) {
            //     echo 'status success';
            // }

            if ($register && $id) {
                $this->session->set_flashdata('showSuccessMessage', 'HCP added successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in adding HCP');
            }
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
            if ($this->AdminModel->approveHcpDb($hcpIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'HCP status updated successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in approving HCP');
            }
            redirect('Edfadmin/hcpList');
        } else {
            redirect('Edfadmin/');
        }
    }

    public function deleteHcp()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            if ($this->AdminModel->deleteHcpDb($hcpIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'HCP deleted successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in deleting HCP');
            }
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
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->data['consultations'] = $this->ConsultModel->get_consultations_by_patient($patientIdDb);
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function deletePatient()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $patientIdDb = $this->uri->segment(3);
            if ($this->AdminModel->deletePatientDb($patientIdDb)) {
                $this->session->set_flashdata('showSuccessMessage', 'Patient deleting successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in deleting patient');
            }
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

    public function findingsList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "findings";
            $list = $this->AdminModel->getFindingsList();
            $this->data['findingsList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function diagnosisList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "diagnosis";
            $list = $this->AdminModel->getDiagnosisList();
            $this->data['diagnosisList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function investigationsList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "investigations";
            $list = $this->AdminModel->getInvestigationsList();
            $this->data['investigationsList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function advicesList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "advices";
            $list = $this->AdminModel->getAdvicesList();
            $this->data['advicesList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function instructionsList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "instructions";
            $list = $this->AdminModel->getInstructionsList();
            $this->data['instructionsList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function proceduresList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "procedures";
            $list = $this->AdminModel->getProceduresList();
            $this->data['proceduresList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function medicinesList()
    {
        if (isset($_SESSION['adminIdDb'])) {
            $this->data['method'] = "medicines";
            $list = $this->AdminModel->getMedicinesList();
            $this->data['medicineCategories'] = $this->AdminModel->getMedicineCategories();
            $this->data['medicinesList'] = $list;
            $this->load->view('adminDashboard.php', $this->data);
        } else {
            redirect('Edfadmin/');
        }
    }

    public function saveMedicine()
    {
        if ($this->AdminModel->saveMedicine()) {
            $this->session->set_flashdata('showSuccessMessage', 'Medicine saved successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in saving medicine');
        }

        redirect('Edfadmin/medicinesList');
    }

    public function deleteMedicine()
    {
        $medicineId = $this->uri->segment(3);
        if ($this->AdminModel->medicineDelete($medicineId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Medicine deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting edicine');
        }
        redirect('Edfadmin/medicinesList');
    }

    public function getCategories()
    {
        $result = $this->AdminModel->getMedicineCategories();
        echo json_encode($result);
    }

    public function addCategory()
    {
        $name = trim($this->input->post('name'));

        if ($name == "") {
            echo json_encode(["status" => false, "msg" => "Category cannot be empty"]);
            return;
        }

        $insert = $this->AdminModel->insertCategory($name);

        echo json_encode(["status" => $insert]);
    }

    public function deleteCategory()
    {
        $id = $this->input->post('id');
        $deleted = $this->AdminModel->deleteCategory($id);

        echo json_encode(["status" => $deleted]);
    }

    public function getDosageUnits()
    {
        $result = $this->AdminModel->getDosageUnits();
        echo json_encode($result);
    }

    public function addDosageUnit()
    {
        $name = trim($this->input->post('name'));

        if ($name == "") {
            echo json_encode(["status" => false, "msg" => "Unit cannot be empty"]);
            return;
        }

        $insert = $this->AdminModel->insertDosageUnit($name);
        echo json_encode(["status" => $insert]);
    }

    public function deleteDosageUnit()
    {
        $id = $this->input->post('id');
        $deleted = $this->AdminModel->deleteDosageUnit($id);
        echo json_encode(["status" => $deleted]);
    }

    //Universal Add
    public function addListItem($type)
    {
        if (!$this->session->userdata('adminIdDb')) {
            redirect('Edfadmin/');
        }

        $fieldMap = [
            'specialization' => 'specializationName',
            'symptoms' => 'symptomName',
            'findings' => 'findingName',
            'diagnosis' => 'diagnosisName',
            'investigations' => 'investigationsName',
            'instructions' => 'instructionsName',
            'procedures' => 'proceduresName',
            'advices' => 'advicesName',
        ];

        $fieldName = $fieldMap[$type] ?? 'name';
        $name = trim($this->input->post($fieldName));

        if (empty($name)) {
            $this->session->set_flashdata('showErrorMessage', 'Name cannot be empty');
            redirect("Edfadmin/{$type}List");
        }

        if ($this->AdminModel->addListData($type, $name)) {
            $this->session->set_flashdata('showSuccessMessage', ucfirst($type) . ' added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error adding ' . ucfirst($type));
        }

        redirect("Edfadmin/{$type}List");
    }

    //Universal Edit
    public function updateListItem($type)
    {
        if (!$this->session->userdata('adminIdDb')) {
            redirect('Edfadmin/');
        }

        $id = $this->uri->segment(4);
        $name = trim($this->input->post('name'));

        $map = [
            'specialization' => ['table' => 'specialization_list', 'field' => 'specializationName'],
            'symptoms' => ['table' => 'symptoms_list', 'field' => 'symptomsName'],
            'findings' => ['table' => 'findings_list', 'field' => 'findingsName'],
            'diagnosis' => ['table' => 'diagnosis_list', 'field' => 'diagnosisName'],
            'investigations' => ['table' => 'investigations_list', 'field' => 'investigationsName'],
            'instructions' => ['table' => 'instructions_list', 'field' => 'instructionsName'],
            'procedures' => ['table' => 'procedures_list', 'field' => 'proceduresName'],
            'advices' => ['table' => 'advices_list', 'field' => 'adviceName']
        ];

        if (!isset($map[$type])) {
            $this->session->set_flashdata('showErrorMessage', 'Invalid type');
            redirect('Edfadmin/');
        }

        $tbl = $map[$type]['table'];
        $field = $map[$type]['field'];

        if ($this->AdminModel->updateListData($tbl, $id, $field, $name)) {
            $this->session->set_flashdata(
                'showSuccessMessage',
                ucfirst(rtrim($type, 's')) . ' updated successfully'
            );
        } else {
            $this->session->set_flashdata(
                'showErrorMessage',
                'Failed to update ' . rtrim($type, 's')
            );
        }

        redirect("Edfadmin/{$type}List");
    }


    // Universal Model Delete
    public function deleteItem()
    {
        $type = $this->uri->segment(3);
        $id = $this->uri->segment(4);

        $typeMap = [
            'specialization' => 'specialization_list',
            'symptoms' => 'symptoms_list',
            'findings' => 'findings_list',
            'diagnosis' => 'diagnosis_list',
            'investigation' => 'investigations_list',
            'instruction' => 'instructions_list',
            'procedure' => 'procedures_list',
            'advice' => 'advices_list',
            'medicine' => 'medicines_list'
        ];

        $pluralMap = [
            'specialization' => 'specialization',
            'symptoms' => 'symptoms',
            'findings' => 'findings',
            'diagnosis' => 'diagnosis',
            'investigation' => 'investigations',
            'instruction' => 'instructions',
            'procedure' => 'procedures',
            'advice' => 'advices',
            'medicine' => 'medicines'
        ];

        if (!isset($typeMap[$type]) || !$id) {
            $this->session->set_flashdata('showErrorMessage', 'Invalid request.');
            redirect('Edfadmin/dashboard');
        }

        $table = $typeMap[$type];
        $listUrl = $pluralMap[$type] . 'List';

        if ($this->AdminModel->deleteItem($table, $id)) {
            $this->session->set_flashdata('showSuccessMessage', ucfirst($type) . ' deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error deleting ' . $type);
        }

        redirect('Edfadmin/' . $listUrl);
    }

    public function logout()
    {
        $this->session->unset_userdata('adminIdDb');
        $this->session->unset_userdata('adminName');
        $this->session->unset_userdata('adminMailId');
        $this->session->unset_userdata('adminMobileNum');
        $this->session->unset_userdata('last_activity_time');

        $this->session->sess_regenerate(TRUE);

        redirect('Edfadmin/');
    }


}
