<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chiefconsultant extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CcModel');
        $this->load->model('HcpModel');
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

        if ($this->session->userdata('ccIdDb')) {
            if ($last_activity) {
                $inactive_time = time() - $last_activity;
                if ($inactive_time >= $alert_time && $inactive_time < $session_lifetime) {
                    $this->session->set_flashdata('showErrorMessage', 'You have been inactive for 10 minutes. You will be logged out soon due to inactivity.');
                }
                if ($inactive_time >= $session_lifetime) {
                    $this->session->set_flashdata('errorMessage', 'Session expired due to inactivity for last 30 minutes.');
                    $this->session->unset_userdata('ccIdDb');
                    $this->session->unset_userdata('ccId');
                    $this->session->unset_userdata('ccName');
                    $this->session->unset_userdata('ccMailId');
                    $this->session->unset_userdata('ccMobileNum');
                    $this->session->unset_userdata('last_activity_time');
                    $this->session->sess_regenerate(TRUE);
                    redirect('Chiefconsultant/');
                }
            }
            $this->session->set_userdata('last_activity_time', time());
        }
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

        $message = " Dear User, <br> <br>
        Your One-Time Password (OTP) to reset your Chief Consultant (CC) account password is:
       <b> $otp </b> <br>
        Please use this OTP to proceed with updating your password. For security reasons, this OTP is valid for 10 minutes and should not be shared with anyone.
       <br> Best regards,<br>  
        EDF Support Team ";

        $this->email->set_newline("\r\n");
        $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
        $this->email->to($to);
        $this->email->subject('OTP to Reset Your CC Account Password');
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
        $result = $this->CcModel->changeNewPassword();

        if ($result) {
            $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Password update failed or no changes made');
        }
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
            $this->data['consultations'] = $this->ConsultModel->get_consultations_by_patient($patientIdDb);
            $this->setVariable();
            $this->load->view('ccDashboard.php', $this->data);
        } else {
            redirect('Chiefconsultant/');
        }
    }

    // This is old code, need to update or remove this
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

    public function sendEmailOtp()// For CC change password after login
    {
        $email = $this->input->post('email');

        if (!$email) {
            echo json_encode(['status' => 'fail', 'message' => 'Email required']);
            return;
        }

        $otp = rand(1000, 9999);
        $this->session->set_userdata('email_otp', $otp);
        $this->session->set_userdata('email_otp_address', $email);

        $message = "Hi there, <br><br>
        Your OTP to change your CC account password is: <strong>$otp</strong><br>
        This OTP is valid for 10 minutes.<br><br>
        Warm regards,<br>
        Team EDF";
        $this->load->library('email');
        $this->email->from('noreply@consult.edftech.in', 'EDF OTP Verification');
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
        $this->session->unset_userdata('firstLogin');
        $this->session->unset_userdata('last_activity_time');

        $this->session->sess_regenerate(TRUE);

        redirect('Chiefconsultant/');
    }


}