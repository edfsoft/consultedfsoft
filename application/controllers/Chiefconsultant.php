<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chiefconsultant extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->model('HcpModel');
        $this->load->library('session');
        $this->load->library('email');
    }

    public function index()
    {
        $this->load->view('ccLogin.php');
    }

    public function register()
    {
        $specList = $this->HcpModel->getSpecialization();
        $this->data['specializationList'] = $specList;
        $this->load->view('ccRegister.php', $this->data);
    }

    public function resetPassword()
    {
        $this->data['method'] = "getMailId";
        $this->load->view('ccForgetPassword.php', $this->data);
    }

    public function sendFPOtp()
    {
        $to = $this->input->post('ccPassMail');
        $mobile = $this->input->post('ccMobileNum');
        $otp = rand(1000, 9999);
        $this->session->set_userdata('generated_otp', $otp);

        $message = "Your OTP is $otp to change the new password for your Chief Consultant [CC] account.";

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.arramjobs.in',
            'smtp_port' => 465,
            'smtp_user' => 'arramjobs@arramjobs.in',
            'smtp_pass' => '',  // Mail Password
            'mailtype' => 'text',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('arramjobs@arramjobs.in', 'Consult EDF');
        $this->email->to($to);
        $this->email->subject('Consultation at Erode Diabetes Foundation');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->data['method'] = "verifyOtp";
            $this->data['message'] = "Enter the OTP that has been sent to this mail address: ";
            $this->data['toMail'] = $to;
            $this->data['ccMobileNumber'] = $mobile;
        } else {
            $this->data['method'] = "getMailId";
        }
        $this->load->view('ccForgetPassword.php', $this->data);
    }

    public function verifyOtp()
    {
        $enteredOtp = isset($_POST['ccPwdOtp']) ? $this->input->post('ccPwdOtp') : '0';
        $mobile = $this->input->post('ccMobileNum');
        $generatedOtp = $this->session->userdata('generated_otp');

        if ($enteredOtp == $generatedOtp) {
            $this->session->unset_userdata('generated_otp');
            $this->data['method'] = "newPassword";
            $this->data['message'] = "Your OTP has been verified successfully.";
            $this->data['hcpMobileNumber'] = $mobile;
        } else {
            $this->data['method'] = "verifyOtp";
            $this->data['message'] = "Invalid OTP. Please try again.";
            $this->data['toMail'] = NULL;
            $this->data['hcpMobileNumber'] = NULL;

        }
        $this->load->view('ccForgetPassword.php', $this->data);
    }

    public function updateNewPassword()
    {
        $profileDetails = $this->CcModel->changeNewPassword();
        redirect('Chiefconsultant/');
    }

    public function ccSignup()
    {
        $ccMobileNum = $this->input->post('ccMobile');
        $ccMailId = $this->input->post('ccEmail');

        $existingFields = $this->CcModel->check_existing_user($ccMobileNum, $ccMailId);

        if (!empty($existingFields)) {
            $errorMessage = implode(', ', $existingFields) . ' already exist. Please use different credential.';
            $this->session->set_flashdata('errorMessage', $errorMessage);
            redirect('Chiefconsultant/register');
            exit();
        } else {
            $register = $this->CcModel->register();
            $generateid = $this->CcModel->generateCcId();
            redirect('Chiefconsultant/');
        }
    }

    public function ccLogin()
    {
        $login = $this->CcModel->ccLoginDetails();
        if (isset($login['id']) && ($login['approvalStatus'] == "1")) {
            $LoggedInDetails = array(
                'ccIdDb' => $login['id'],
                'ccId' => $login['ccId'],
                'ccName' => $login['doctorName'],
                'ccMailId' => $login['doctorMail'],
                'ccMobileNum' => $login['doctorMobile'],
            );
            $this->session->set_userdata($LoggedInDetails);
            if ($login['firstLoginPswd'] == '0') {
                $this->session->set_userdata('firstLogin', '0');
            }
            redirect('Chiefconsultant/dashboard');
        } else if (isset($login['approvalStatus']) && $login['approvalStatus'] == 0) {
            $this->session->set_flashdata('errorMessage', 'You can log in once the verification process is done.');
            redirect('Chiefconsultant/');
            exit();
        } else {
            $this->session->set_flashdata('errorMessage', 'Please enter registered details.');
            redirect('Chiefconsultant/');
            exit();
        }
    }

    public function setVariable()
    {
        $appointmentList = $this->CcModel->getAppointmentList();
        $this->data['appointmentListCount'] = $appointmentList['totalRows'];
    }

    public function dashboard()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "dashboard";
            $patientTotal = $this->CcModel->allPatientList();
            $this->data['patientTotal'] = $patientTotal['totalRows'];
            $hcpDetails = $this->CcModel->getHcpProfile();
            $this->data['totalHcps'] = $hcpDetails['totalRows'];
            $appointmentList = $this->CcModel->getAppointmentListDash();
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function patients()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "patients";
            $patientDetails = $this->CcModel->allPatientList();
            $this->data['patientDetails'] = $patientDetails['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function patientdetails()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $consultHistory = $this->HcpModel->getConsultationDetails($patientIdDb);
            $this->data['consultDetails'] = $consultHistory;
            $Medicinesconsult = $this->HcpModel->getConsultMedicinesDetails($patientIdDb);
            $this->data['consultMedicines'] = $Medicinesconsult;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function prescriptionView()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "prescription";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function appointments()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "appointments";
            $appointmentList = $this->CcModel->getAppointmentList();
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function healthCareProviders()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "hcps";
            $hcpDetails = $this->CcModel->getHcpProfile();
            $this->data['hcpDetails'] = $hcpDetails['response'];
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function healthCareProvidersProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->data['method'] = "hcpsProfile";
            $hcpDetails = $this->CcModel->getHcpDetails($hcpIdDb);
            $this->data['hcpDetails'] = $hcpDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function myProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "myProfile";
            $ccDetails = $this->CcModel->getCcDetails();
            $this->data['ccDetails'] = $ccDetails;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function editMyProfile()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "editMyProfile";
            $ccDetails = $this->CcModel->getCcDetails();
            $this->data['ccDetails'] = $ccDetails;
            $specList = $this->HcpModel->getSpecialization();
            $this->data['specializationList'] = $specList;
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function updatePhoto()
    {
        if ($this->CcModel->updateProfilePhoto()) {
            $this->session->set_flashdata('showSuccessMessage', 'Profile photo updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating profile photo');
        }
        redirect('Chiefconsultant/editMyProfile');
    }

    public function updateMyProfile()
    {
        if ($this->CcModel->updateProfileDetails()) {
            $this->session->set_flashdata('showSuccessMessage', 'Profile details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating profile details');
        }
        redirect('Chiefconsultant/myProfile');
    }

    public function changePassword()
    {
        if (isset($_SESSION['ccName'])) {
            $this->data['method'] = "passwordChange";
            $this->data['ccDetails'] = $this->CcModel->getCcDetails();
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    public function sendEmailOtp()// For CC change password
    {
        $email = $this->input->post('email');

        if (!$email) {
            echo json_encode(['status' => 'fail', 'message' => 'Email required']);
            return;
        }

        $otp = rand(100000, 999999);
        $this->session->set_userdata('email_otp', $otp);
        $this->session->set_userdata('email_otp_address', $email);

        $message = "Hi there, <br><br>
        Your OTP to change your CC account password is: <strong>$otp</strong><br>
        This OTP is valid for 10 minutes.<br><br>
        Warm regards,<br>
        Team EDF";
        $this->load->library('email');
        $this->email->from('erodediabetesfoundation@gmail.com', 'EDF OTP Verification');
        $this->email->to($email);
        $this->email->subject('Change Password OTP');
        $this->email->message($message);
        $this->email->set_mailtype("html");

        if ($this->email->send()) {
            echo json_encode(['status' => 'success']);
        } else {
            log_message('error', $this->email->print_debugger());
            echo json_encode(['status' => 'fail']);
        }
    }

    public function verifyEmailOtp()
    {
        $enteredOtp = $this->input->post('otp');
        $sessionOtp = $this->session->userdata('email_otp');

        if ($enteredOtp == $sessionOtp) {
            echo json_encode(['status' => 'success']);
            $this->session->unset_userdata(['email_otp', 'email_otp_address']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }

    public function saveNewPassword()
    {
        $this->session->unset_userdata('firstLogin');
        if ($this->CcModel->updateNewPassword()) {
            $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating password');
        }
        redirect('Chiefconsultant/myProfile');
    }

    public function logout()
    {
        // $this->session->unset_userdata('LoggedInDetails');
        $this->session->unset_userdata('ccIdDb');
        $this->session->unset_userdata('ccId');
        $this->session->unset_userdata('ccName');
        $this->session->unset_userdata('ccMailId');
        $this->session->unset_userdata('ccMobileNum');
        redirect('Chiefconsultant/');
    }


}