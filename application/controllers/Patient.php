<?php
defined('BASEPATH') or exit('No direct script access allowed');

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


    // public function resetPassword()
    // {
    //     $this->data['method'] = "getMailId";
    //     $this->load->view('hcpForgetPassword.php', $this->data);
    // }

    // public function sendFPOtp()
    // {
    //     $to = $this->input->post('hcpPassMail');
    //     $mobile = $this->input->post('hcpMobileNum');
    //     $otp = rand(1000, 9999);
    //     $this->session->set_userdata('generated_otp', $otp);

    //     // $message = "Your OTP is $otp to change the new password for your Health Care Provider[HCP] account.";
    //     $message = "Hi there, <br> <br>
    //     Your One-Time Password (OTP) to reset your Health Care Provider (HCP) account password is:
    //     <b> $otp </b> <br>
    //     Please use this OTP to proceed with updating your password. For security reasons, this OTP is valid for 10 minutes and should not be shared with anyone.
    //     <br><br>
    //     Regards,
    //     <br><b>EDF Healthcare Team</b>";

    //     $this->email->set_newline("\r\n");
    //     $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
    //     $this->email->to($to);
    //     $this->email->subject('OTP to Reset Your HCP Account Password');
    //     $this->email->message($message);

    //     if ($this->email->send()) {
    //         $this->data['method'] = "verifyOtp";
    //         $this->data['message'] = "Enter the OTP that has been sent to this mail address: ";
    //         $this->data['toMail'] = $to;
    //         $this->data['hcpMobileNumber'] = $mobile;
    //     } else {
    //         $this->data['method'] = "getMailId";
    //     }
    //     $this->load->view('hcpForgetPassword.php', $this->data);
    // }

    // public function verifyOtp()
    // {
    //     $enteredOtp = isset($_POST['hcpPwdOtp']) ? $this->input->post('hcpPwdOtp') : '0';
    //     $mobile = $this->input->post('hcpMobileNum');
    //     $generatedOtp = $this->session->userdata('generated_otp');

    //     if ($enteredOtp == $generatedOtp) {
    //         $this->session->unset_userdata('generated_otp');
    //         $this->data['method'] = "newPassword";
    //         $this->data['message'] = "Your OTP has been verified successfully.";
    //         $this->data['hcpMobileNumber'] = $mobile;
    //     } else {
    //         $this->data['method'] = "verifyOtp";
    //         $this->data['message'] = "Invalid OTP. Please try again.";
    //         $this->data['toMail'] = NULL;
    //         $this->data['hcpMobileNumber'] = NULL;

    //     }
    //     $this->load->view('hcpForgetPassword.php', $this->data);
    // }

    // public function updateNewPassword()
    // {
    //     $result = $this->PatientModel->changeNewPassword();
    //     if ($result) {
    //         $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
    //     } else {
    //         $this->session->set_flashdata('showErrorMessage', 'Password update failed or no changes made');
    //     }
    //     redirect('Patient/');
    // }

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

    public function sendEmailOtp()/* OTP for change password in the HCP after login*/
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
            // $patientTotal = $this->PatientModel->getPatientList();
            // $this->data['patientTotal'] = $patientTotal['totalRows'];
            // $ccDetails = $this->PatientModel->getCcProfile();
            // $this->data['totalCcs'] = $ccDetails['totalRows'];
            // $appointmentList = $this->PatientModel->getAppointmentListDash();
            // // $this->data['appointmentList'] = $appointmentList['response']; /* Currently commented */
            // $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
            $this->load->view('patientDashboard.php', $this->data);
        } else {
            redirect('Patient/');
        }
    }

    public function chiefDoctors()
    {
        if (isset($_SESSION['patientIdDb'])) {
            $this->data['method'] = "chiefDoctors";
            // $patientTotal = $this->PatientModel->getPatientList();
            // $this->data['patientTotal'] = $patientTotal['totalRows'];
            // $ccDetails = $this->PatientModel->getCcProfile();
            // $this->data['totalCcs'] = $ccDetails['totalRows'];
            // $appointmentList = $this->PatientModel->getAppointmentListDash();
            // // $this->data['appointmentList'] = $appointmentList['response']; /* Currently commented */
            // $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
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






}