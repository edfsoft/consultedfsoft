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
        $this->load->library('session');
        $this->load->library('email');
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
            $this->session->set_flashdata('errorMessage', $errorMessage);
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
            $this->email->from('erodediabetesfoundation@gmail.com', 'EDF Tech Account Creation');
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
            $this->session->set_flashdata('errorMessage', $errorMessage);
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
            $this->email->from('erodediabetesfoundation@gmail.com', 'EDF Tech Account Creation');
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

    public function addNewSpecilization()
    {
        if ($this->AdminModel->newSpecilization()) {
            $this->session->set_flashdata('showSuccessMessage', 'Specilization added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding specilization');
        }
        redirect('Edfadmin/specializationList');
    }

    public function deleteSpecilization()
    {
        $specilizationId = $this->uri->segment(3);
        if ($this->AdminModel->specilizationDelete($specilizationId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Specilization deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting specilization');
        }
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
        if ($this->AdminModel->newSymptoms()) {
            $this->session->set_flashdata('showSuccessMessage', 'Symptoms added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding symptoms');
        }
        redirect('Edfadmin/symptomsList');
    }

    public function deleteSymptoms()
    {
        $symptomsId = $this->uri->segment(3);
        if ($this->AdminModel->symptomsDelete($symptomsId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Symptoms deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting symptoms');
        }
        redirect('Edfadmin/symptomsList');
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

    public function addNewFindings()
    {
        if ($this->AdminModel->newFindings()) {
            $this->session->set_flashdata('showSuccessMessage', 'Findings added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding findings');
        }
        redirect('Edfadmin/findingsList');
    }

    public function deleteFindings()
    {
        $findingsId = $this->uri->segment(3);
        if ($this->AdminModel->findingsDelete($findingsId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Findings deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting findings');
        }
        redirect('Edfadmin/findingsList');
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

    public function addNewDiagnosis()
    {
        if ($this->AdminModel->newDiagnosis()) {
            $this->session->set_flashdata('showSuccessMessage', 'Diagnosis added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding diagnosis');
        }
        redirect('Edfadmin/diagnosisList');
    }

    public function deleteDiagnosis()
    {
        $diagnosisId = $this->uri->segment(3);
        if ($this->AdminModel->diagnosisDelete($diagnosisId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Diagnosis deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting diagnosis');
        }
        redirect('Edfadmin/diagnosisList');
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
        if ($this->AdminModel->newMedicine()) {
            $this->session->set_flashdata('showSuccessMessage', 'Medicine added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding medicine');
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

    public function addNewInvestigation()
    {
        if ($this->AdminModel->newInvestigation()) {
            $this->session->set_flashdata('showSuccessMessage', 'Investigation added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding investigation');
        }
        redirect('Edfadmin/investigationsList');
    }

    public function deleteInvestigation()
    {
        $investigationId = $this->uri->segment(3);
        if ($this->AdminModel->investigationDelete($investigationId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Investigation deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting edicine');
        }
        redirect('Edfadmin/investigationsList');
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

    public function addNewAdvice()
    {
        if ($this->AdminModel->newAdvice()) {
            $this->session->set_flashdata('showSuccessMessage', 'Advice added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding advice');
        }
        redirect('Edfadmin/advicesList');
    }

    public function deleteAdvice()
    {
        $adviceId = $this->uri->segment(3);
        if ($this->AdminModel->adviceDelete($adviceId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Advice deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting Advice');
        }
        redirect('Edfadmin/advicesList');
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

    public function addNewInstruction()
    {
        if ($this->AdminModel->newInstruction()) {
            $this->session->set_flashdata('showSuccessMessage', 'Instruction added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding instruction');
        }
        redirect('Edfadmin/instructionsList');
    }

    public function deleteInstruction()
    {
        $adviceId = $this->uri->segment(3);
        if ($this->AdminModel->instructionDelete($adviceId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Instruction deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting instruction');
        }
        redirect('Edfadmin/instructionsList');
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

    public function addNewProcedure()
    {
        if ($this->AdminModel->newProcedure()) {
            $this->session->set_flashdata('showSuccessMessage', 'Procedure added successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding procedure');
        }
        redirect('Edfadmin/proceduresList');
    }

    public function deleteProcedure()
    {
        $adviceId = $this->uri->segment(3);
        if ($this->AdminModel->procedureDelete($adviceId)) {
            $this->session->set_flashdata('showSuccessMessage', 'Procedure deleted successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in deleting procedure');
        }
        redirect('Edfadmin/proceduresList');
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