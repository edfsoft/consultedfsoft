<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Manually include the files in this order
require_once APPPATH . 'libraries/Agora/Util.php';
require_once APPPATH . 'libraries/Agora/AccessToken.php';
require_once APPPATH . 'libraries/Agora/RtcTokenBuilder.php';
class Patient extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('PatientModel');
        $this->load->library('session');
        $this->load->library('email');
        $this->check_session_timeout();
    }

    private function check_session_timeout()
    {
        $session_lifetime = 1800; // 30 minutes
        $alert_time = 1200; // 10 minutes (for alert)
        $last_activity = $this->session->userdata('last_activity_time');

        if ($this->session->userdata('patientIdDb')) {
            if ($last_activity) {
                $inactive_time = time() - $last_activity;
                if ($inactive_time >= $alert_time && $inactive_time < $session_lifetime) {
                    $this->session->set_flashdata('showErrorMessage', 'You have been inactive for 10 minutes. You will be logged out soon due to inactivity.');
                }
                if ($inactive_time >= $session_lifetime) {
                    $this->session->set_flashdata('errorMessage', 'Session expired due to inactivity for last 30 minutes.');
                    $this->session->unset_userdata('patientIdDb');
                    $this->session->unset_userdata('patientId');
                    $this->session->unset_userdata('patientName');
                    $this->session->unset_userdata('patientMailId');
                    $this->session->unset_userdata('patientMobileNum');
                    $this->session->unset_userdata('last_activity_time');
                    $this->session->sess_regenerate(TRUE);
                    redirect('Patient/');
                }
            }
            $this->session->set_userdata('last_activity_time', time());
        }
    }

    public function index()
    {
        $this->load->view('patientLogin.php');
    }


    public function resetPassword()
    {
        $this->data['method'] = "getMailId";
        $this->session->unset_userdata('successMessage');
        $this->load->view('patientForgetPassword.php', $this->data);
    }

    public function sendFPOtp()
    {
        $patientMail = $this->input->post('patientPassMail');
        $patientId = $this->input->post('patientPassId');
        $user_exists = $this->db->where([
            'mailId' => $patientMail,
            'patientId' => $patientId
        ])->count_all_results('patient_details') > 0;
        if (!$user_exists) {
            $this->session->set_flashdata('errorMessage', 'Invalid Email or Patient ID.');
            redirect('Patient/resetPassword');
        }

        $otp = $this->PatientModel->generate_otp($patientMail);

        $message = "Hi there, <br> <br>
        Your One-Time Password (OTP) to reset your Patient account password is:
        <b> $otp </b> <br>
        Please use this OTP to proceed with updating your password. For security reasons, this OTP is valid for 10 minutes and should not be shared with anyone.
        <br><br>
        Regards,
        <br><b>EDF Healthcare Team</b>";

        $this->email->set_newline("\r\n");
        $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
        $this->email->to($patientMail);
        $this->email->subject('OTP to Reset Your Patient Account Password');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->data['method'] = "verifyOtp";
            $this->data['patientMail'] = $patientMail;
            $this->data['patientId'] = $patientId;
            $this->session->set_flashdata('successMessage', 'OTP sent to your email and is valid for the next 10 minutes.');
        } else {
            $this->data['method'] = "getMailId";
            $this->session->set_flashdata('errorMessage', 'Error in sending OTP. Please try again.');
        }
        $this->load->view('patientForgetPassword.php', $this->data);
    }

    public function verifyOtp()
    {
        $enteredOtp = isset($_POST['patientPwdOtp']) ? $this->input->post('patientPwdOtp') : '0';
        $mail = $this->input->post('patientMail');
        $patientId = $this->input->post('patientId');
        $result = $this->PatientModel->validate_otp($mail, $enteredOtp);
        if ($result['status'] == true) {
            $this->data['method'] = "newPassword";
            $this->data['patientMail'] = $mail;
            $this->data['patientId'] = $patientId;
            $this->session->unset_userdata('successMessage');
            $this->session->unset_userdata('errorMessage');
            $this->session->set_flashdata('successMessage', 'OTP verified successfully.');
            $this->load->view('patientForgetPassword.php', $this->data);
        } elseif ($result['status'] == false && $result['reason'] == 'Invalid OTP') {
            $this->data['method'] = "verifyOtp";
            $this->data['patientMail'] = $mail;
            $this->data['patientId'] = $patientId;
            $this->session->unset_userdata('successMessage');
            $this->session->unset_userdata('errorMessage');
            $this->session->set_flashdata('errorMessage', $result['reason']);
            $this->load->view('patientForgetPassword.php', $this->data);
        } elseif ($result['status'] == false && $result['reason'] == 'OTP expired') {
            $this->data['method'] = "getMailId";
            $this->session->set_flashdata('errorMessage', $result['reason']);
            $this->load->view('patientForgetPassword.php', $this->data);
        }
    }

    public function updateNewPassword()
    {
        $result = $this->PatientModel->changeNewPassword();
        if ($result) {
            $this->session->set_flashdata('successMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('errorMessage', 'Password update failed or no changes made');
        }
        redirect('Patient/');
    }

    public function patientLogin()
    {
        $login = $this->PatientModel->patientLoginDetails();
        if (isset($login['id']) && $login['id'] !== null) {
            $LoggedInDetails = array(
                'patientIdDb' => $login['id'],
                'patientId' => $login['patientId'],
                'patientName' => $login['firstName'] . ' ' . $login['lastName'],
                'patientMailId' => $login['mailId'],
                'patientMobileNum' => $login['mobileNumber'],
            );
            $this->session->set_userdata($LoggedInDetails);
            if ($login['firstLoginPswd'] == '0') {
                $this->session->set_userdata('firstLogin', '0');
            }
            redirect('Patient/dashboard');
        } else {
            $this->session->set_flashdata('errorMessage', 'Please enter registered details.');
            redirect('Patient/');
            exit();
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "dashboard";
            $patientIdDb = $_SESSION['patientIdDb'];
            $this->data['patientDetails'] = $this->PatientModel->getPatientDetails();
            $this->data['consultations'] = $this->PatientModel->get_consultations_by_patient($patientIdDb);
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function appointments()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "appointments";

            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function myProfile()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "myProfile";
            $patientDetail = $this->PatientModel->getPatientDetails();
            $this->data['patientDetails'] = $patientDetail;
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function editMyProfile()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "editMyProfile";
            $patientDetail = $this->PatientModel->getPatientDetails();
            $this->data['patientDetails'] = $patientDetail;
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function updateMyProfile()
    {
        if ($this->PatientModel->updateProfileDetails()) {
            $this->session->set_flashdata('showSuccessMessage', 'Profile details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating profile details');
        }
        redirect('Patient/myProfile');
    }

    public function changePassword()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "passwordChange";
            $patientDetail = $this->PatientModel->getPatientDetails();
            $this->data['patientDetails'] = $patientDetail;
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function sendEmailOtp()/* OTP for change password in the patient after login*/
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
        Your OTP is <b> $otp </b> to change the new password for your account. 
        <br>This OTP is valid for 10 minutes.
        <br><br>
        Regards,
        <br><b>EDF Healthcare Team</b>";
        $this->load->library('email');
        $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
        $this->email->to($email);
        $this->email->subject('Your OTP for Password Change');
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $mailSent = $this->email->send();
        if ($mailSent) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }

    public function verifyEmailOtp()
    {
        $enteredOtp = $this->input->post('otp');
        $sessionOtp = $this->session->userdata('email_otp');

        if ($enteredOtp == $sessionOtp) {
            echo json_encode(['status' => 'success']);
            $this->session->unset_userdata(['email_otp', 'email_otp_address']); // after otp verification is done.
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }

    public function saveNewPassword()
    {
        if ($this->PatientModel->updateNewPassword()) {
            $this->session->unset_userdata('firstLogin');
            $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating password');
        }
        redirect('Patient/myProfile');
    }

    public function healthCareProviders()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "hcps";
            $hcpDetails = $this->PatientModel->getHcpProfile();
            $this->data['hcpDetails'] = $hcpDetails['response'];
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function healthCareProvidersProfile()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $hcpIdDb = $this->uri->segment(3);
            $this->data['method'] = "hcpsProfile";
            $hcpDetails = $this->PatientModel->getHcpDetails($hcpIdDb);
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function chiefDoctors()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "chiefDoctors";
            $ccDetails = $this->PatientModel->getCcProfile();
            $this->data['ccDetails'] = $ccDetails['response'];
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function chiefDoctorsProfile()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->data['method'] = "chiefDoctorProfile";
            $ccDetails = $this->PatientModel->getCcDetails($ccIdDb);
            $this->data['ccDetails'] = $ccDetails;
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('patientIdDb');
        $this->session->unset_userdata('patientId');
        $this->session->unset_userdata('patientName');
        $this->session->unset_userdata('patientMailId');
        $this->session->unset_userdata('patientMobileNum');
        $this->session->unset_userdata('firstLogin');
        $this->session->unset_userdata('last_activity_time');

        $this->session->sess_regenerate(TRUE);

        redirect('Patient/');
    }



    public function join($unique_meeting_id = null)
    {
        if (!$unique_meeting_id) {
            show_error('Invalid Meeting Link', 404);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');

        $appointment = $this->db->select('
                appointment_details.*, 
                patient_details.firstName, 
                patient_details.lastName, 
                hcp_details.hcpName,
                cc_details.doctorName as chiefName
            ')
            ->from('appointment_details')
            ->join('patient_details', 'patient_details.id = appointment_details.patientDbId', 'inner')
            ->join('hcp_details', 'hcp_details.id = appointment_details.hcpDbId', 'inner')
            ->join('cc_details', 'cc_details.id = appointment_details.referalDoctorDbId', 'left')
            ->where('appointment_details.appointmentlink', $unique_meeting_id)
            ->get()->row();

        if (!$appointment) {
            show_error('This meeting link is invalid.', 403);
            return;
        }

        $appID = 'f891d97665524065b626ea324f06942f';
        $appCertificate = '3b5229b39c254ce9b03f5a64966fa5c9';
        $uid = rand(100000, 199999);
        $privilegeExpiredTs = time() + 3600;

        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $unique_meeting_id, $uid, RtcTokenBuilder::RolePublisher, $privilegeExpiredTs);

        $data = [
            'app_id' => $appID,
            'temp_token' => $token,
            'channel_name' => $unique_meeting_id,
            'uid' => $uid,
            'local_name' => ($appointment->firstName ?? 'Patient') . ' ' . ($appointment->lastName ?? ''),
            'patient_name' => ($appointment->firstName ?? 'Patient') . ' ' . ($appointment->lastName ?? ''),
            'hcp_name' => $appointment->hcpName ?? 'Doctor',
            'chief_name' => $appointment->chiefName ?? 'Chief doctor',
            'role' => 'patient',
            'is_doctor' => false
        ];

        $this->load->view('customMeeting', $data);
    }

}