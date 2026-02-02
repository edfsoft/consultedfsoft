<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Manually include the files in this order
require_once APPPATH . 'libraries/Agora/Util.php';
require_once APPPATH . 'libraries/Agora/AccessToken.php';
require_once APPPATH . 'libraries/Agora/RtcTokenBuilder.php';

class Healthcareprovider extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->model('HcpModel');
        $this->load->library('session');
        $this->load->library('email');
        $this->check_session_timeout();
        //Notify Pending Appointments
        if ($this->session->has_userdata('hcpIdDb')) {
            $this->data['todayCount'] = $this->HcpModel->getTodayPendingCount();
        } else {
            $this->data['todayCount'] = 0;
        }
    }

    private function check_session_timeout()
    {
        $session_lifetime = 1800; // 30 minutes
        $alert_time = 1200; // 10 minutes (for alert)
        $last_activity = $this->session->userdata('last_activity_time');

        if ($this->session->userdata('hcpIdDb')) {
            if ($last_activity) {
                $inactive_time = time() - $last_activity;
                if ($inactive_time >= $alert_time && $inactive_time < $session_lifetime) {
                    $this->session->set_flashdata('showErrorMessage', 'You have been inactive for 10 minutes. You will be logged out soon due to inactivity.');
                }
                if ($inactive_time >= $session_lifetime) {
                    $this->session->set_flashdata('errorMessage', 'Session expired due to inactivity for last 30 minutes.');
                    $this->session->unset_userdata('hcpIdDb');
                    $this->session->unset_userdata('hcpId');
                    $this->session->unset_userdata('hcpsName');
                    $this->session->unset_userdata('hcpsMailId');
                    $this->session->unset_userdata('hcpsMobileNum');
                    $this->session->unset_userdata('last_activity_time');
                    $this->session->sess_regenerate(TRUE);
                    redirect('Healthcareprovider/');
                }
            }
            $this->session->set_userdata('last_activity_time', time());
        }
    }

    public function index()
    {
        $this->load->view('hcpLogin.php');
    }

    public function register()
    {
        $specList = $this->HcpModel->getSpecialization();
        $this->data['specializationList'] = $specList;
        $this->load->view('hcpRegister.php', $this->data);
    }

    public function resetPassword()
    {
        $this->data['method'] = "getMailId";
        $this->load->view('hcpForgetPassword.php', $this->data);
    }

    public function sendFPOtp()
    {
        $to = $this->input->post('hcpPassMail');
        $mobile = $this->input->post('hcpMobileNum');
        $otp = rand(1000, 9999);
        $this->session->set_userdata('generated_otp', $otp);

        // $message = "Your OTP is $otp to change the new password for your Health Care Provider[HCP] account.";
        $message = "Hi there, <br> <br>
        Your One-Time Password (OTP) to reset your Health Care Provider (HCP) account password is:
        <b> $otp </b> <br>
        Please use this OTP to proceed with updating your password. For security reasons, this OTP is valid for 10 minutes and should not be shared with anyone.
        <br><br>
        Regards,
        <br><b>EDF Healthcare Team</b>";

        $this->email->set_newline("\r\n");
        $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
        $this->email->to($to);
        $this->email->subject('OTP to Reset Your HCP Account Password');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->data['method'] = "verifyOtp";
            $this->data['message'] = "Enter the OTP that has been sent to this mail address: ";
            $this->data['toMail'] = $to;
            $this->data['hcpMobileNumber'] = $mobile;
        } else {
            $this->data['method'] = "getMailId";
        }
        $this->load->view('hcpForgetPassword.php', $this->data);
    }

    public function verifyOtp()
    {
        $enteredOtp = isset($_POST['hcpPwdOtp']) ? $this->input->post('hcpPwdOtp') : '0';
        $mobile = $this->input->post('hcpMobileNum');
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
        $this->load->view('hcpForgetPassword.php', $this->data);
    }

    public function updateNewPassword()
    {
        $result = $this->HcpModel->changeNewPassword();
        if ($result) {
            $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Password update failed or no changes made');
        }
        redirect('Healthcareprovider/');
    }

    public function hcpSignup()
    {
        $hcpMobileNum = $this->input->post('hcpMobile');
        $hcpMailId = $this->input->post('hcpEmail');

        $existingFields = $this->HcpModel->check_existing_user($hcpMobileNum, $hcpMailId);

        if (!empty($existingFields)) {
            $errorMessage = implode(', ', $existingFields) . ' already exist. Please use different credential.';
            $this->session->set_flashdata('errorMessage', $errorMessage);
            redirect('Healthcareprovider/register');
            exit();
        } else {
            $this->HcpModel->register();
            $this->HcpModel->generatehcpid();
            redirect('Healthcareprovider/');
        }
    }

    public function hcpLogin()
    {
        $login = $this->HcpModel->hcpLoginDetails();
        if (isset($login['id']) && ($login['approvalStatus'] == "1")) {
            $LoggedInDetails = array(
                'hcpIdDb' => $login['id'],
                'hcpId' => $login['hcpId'],
                'hcpsName' => $login['hcpName'],
                'hcpsMailId' => $login['hcpMail'],
                'hcpsMobileNum' => $login['hcpMobile'],
            );
            $this->session->set_userdata($LoggedInDetails);
            if ($login['firstLoginPswd'] == '0') {
                $this->session->set_userdata('firstLogin', '0');
            }
            redirect('Healthcareprovider/dashboard');
        } else if (isset($login['approvalStatus']) && $login['approvalStatus'] == 0) {
            $this->session->set_flashdata('errorMessage', 'You can log in once the verification process is done.');
            redirect('Healthcareprovider/');
            exit();
        } else {
            $this->session->set_flashdata('errorMessage', 'Please enter registered details.');
            redirect('Healthcareprovider/');
            exit();
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "dashboard";
            $patientTotal = $this->HcpModel->getPatientList();
            $this->data['patientTotal'] = $patientTotal['totalRows'];
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['totalCcs'] = $ccDetails['totalRows'];
            $appointmentList = $this->HcpModel->getAppointmentListDash();
            // $this->data['appointmentList'] = $appointmentList['response']; /* Currently commented */
            $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function getCompletedConsultByDate()
    {
        $hcpIdDb = $this->session->userdata('hcpIdDb');
        if (!$hcpIdDb) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $date = $this->input->get('date');
        $consultDate = $date ? date('Y-m-d', strtotime($date)) : date('Y-m-d');

        $data = $this->HcpModel->getCompletedConsultByDate($hcpIdDb, $consultDate);

        foreach ($data as &$row) {
            $row['time_12hr'] = date('h:i A', strtotime($row['consult_time']));
        }

        echo json_encode([
            'success' => true,
            'date' => $consultDate,
            'data' => $data
        ]);
    }

    public function getFollowUpConsultations()
    {
        $hcpIdDb = $this->session->userdata('hcpIdDb');
        if (!$hcpIdDb) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $date = $this->input->get('date');

        $data = $this->HcpModel->getFollowUpConsult($hcpIdDb, $date);

        foreach ($data as &$row) {
            $row['time_12hr'] = date('h:i A', strtotime($row['consult_time']));
        }

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    }

    public function patients()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patients";
            $patientList = $this->HcpModel->getPatientList();
            $this->data['patientList'] = $patientList['response'];
            $this->load->view('hcpDashboardPatients.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function patientform()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetailsForm";
            $this->load->view('hcpDashboardPatients.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function check_duplicate()
    {
        $value = $this->input->post('value');
        $field = $this->input->post('field'); // 'mobile', 'alt_mobile', 'email'
        $patientId = $this->input->post('patientId');

        if (!$value || !$field) {
            echo json_encode(['exists' => false]);
            return;
        }

        $table = 'patient_details';

        $this->db->select('patientId, firstName, lastName, mobileNumber, alternateMobile, mailId');
        $this->db->from($table);

        switch ($field) {
            case 'mobile':
                $this->db->where('mobileNumber', $value);
                break;
            case 'alt_mobile':
                $this->db->where('alternateMobile', $value);
                break;
            case 'email':
                $this->db->where('mailId', $value);
                break;
            default:
                echo json_encode(['exists' => false]);
                return;
        }

        // Exclude current patient in edit mode
        if ($patientId) {
            $this->db->where('patientId !=', $patientId);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            echo json_encode([
                'exists' => true,
                'data' => $query->result_array()
            ]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }

    private function generateTempPassword($length = 8)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $special = '@#$%&*!';
        $numbers = '0123456789';

        $password = $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $special[random_int(0, strlen($special) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];

        $allChars = $uppercase . $lowercase . $special . $numbers;
        while (strlen($password) < $length) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        return str_shuffle($password);
    }

    public function addPatientsForm()
    {
        $post = $this->input->post(null, true);
        $patientMail = $post['patientEmail'] ?? '';

        $tempPassword = null;
        $hashedPassword = null;

        if (!empty($patientMail)) {
            $tempPassword = $this->generateTempPassword(8);
            $hashedPassword = password_hash($tempPassword, PASSWORD_BCRYPT);
        }

        $register = $this->HcpModel->insertPatients($hashedPassword);
        if (!$register) {
            $this->session->set_flashdata('showErrorMessage', 'Error in adding patient');
            redirect('Consultation/consultation');
            return;
        }
        $this->HcpModel->generatePatientId($register);

        if (!empty($patientMail)) {
            $message = "
                    Hi there,<br><br>
                    Your account has been created as <b>Patient</b>.<br><br>
                    Login URL: <b>https://consult.edftech.in/</b><br>
                    Email Address: <b>{$patientMail}</b><br>
                    Temporary Password: <b>{$tempPassword}</b><br><br>
                    You will be required to change your password upon first login.
                    <br><br>
                    Regards,<br>
                    <b>EDF Healthcare Team</b>
                ";

            $this->email->set_newline("\r\n");
            $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
            $this->email->to($patientMail);
            $this->email->subject('Your Account Login Credentials');
            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Patient email failed: ' . $this->email->print_debugger());
            }
        }
        $this->session->set_flashdata('showSuccessMessage', 'Patient added successfully');
        redirect('Consultation/consultation/' . $register);
    }

    public function patientdetails()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->load->view('hcpDashboardPatients.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function patientformUpdate()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetailsFormUpdate";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $this->load->view('hcpDashboardPatients.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function updatePatientsForm()
    {
        $updatePatient = $this->HcpModel->updatePatientsDetails();
        if ($updatePatient) {
            $this->session->set_flashdata('showSuccessMessage', 'Patient details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating patient details');
        }
        redirect('Consultation/consultation/' . $updatePatient);
    }

    public function appointments()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointments";
            $appointmentList = $this->HcpModel->getAppointmentList();
            $this->data['appointmentList'] = $appointmentList['response'];
            $appointmentReschedule = $this->HcpModel->getAppointmentReschedule();
            $this->data['appointmentReschedule'] = $appointmentReschedule['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function appointmentsForm()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointmentsForm";
            $patientList = $this->HcpModel->getPatientForAppointment();
            $this->data['patientsId'] = $patientList['response'];
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['ccsId'] = $ccDetails['response'];
            $symptoms = $this->HcpModel->getSymptoms();
            $this->data['symptomsList'] = $symptoms;
            $appTime = $this->HcpModel->getAppointmentTime();
            $this->data['appBookedDetails'] = $appTime;

            $mtime = $this->HcpModel->getAppMorTime();
            $this->data['morning'] = $mtime;
            $atime = $this->HcpModel->getAppAfterTime();
            $this->data['afternoon'] = $atime;
            $etime = $this->HcpModel->getAppEveTime();
            $this->data['evening'] = $etime;
            $ntime = $this->HcpModel->getAppNightTime();
            $this->data['night'] = $ntime;

            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    // Add new patient in the appointment form
    public function ajaxSavePatient()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || empty($input['firstName']) || empty($input['mobile'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid input data'
            ]);
            return;
        }

        $tempPassword = $this->generateTempPassword(8);
        $hashedPassword = password_hash($tempPassword, PASSWORD_BCRYPT);

        $data = [
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'mobileNumber' => $input['mobile'],
            'mailId' => $input['email'],
            'gender' => $input['gender'],
            'age' => $input['age'],
            'patientHcp' => $_SESSION['hcpId'],
            'patientHcpDbId' => $_SESSION['hcpIdDb'],
            'password' => $hashedPassword,
            'firstLoginPswd' => '0'
        ];

        $insertId = $this->HcpModel->insertPartialPatient($data);

        if (!$insertId) {
            echo json_encode([
                'success' => false,
                'message' => 'Patient insert failed'
            ]);
            return;
        }

        $patientId = $this->HcpModel->generatePatientId($insertId);

        if (!$patientId) {
            echo json_encode([
                'success' => false,
                'message' => 'Patient ID generation failed'
            ]);
            return;
        }
        $this->HcpModel->updatePatientId($insertId, ['patientId' => $patientId]);

        if (!empty($data['mailId'])) {
            $message = "
            Hi there,<br><br>
            Your account has been created as <b>Patient</b>.<br><br>
            Login URL: <b>https://consult.edftech.in/</b><br>
            Email Address: <b>{$data['mailId']}</b><br>
            Temporary Password: <b>{$tempPassword}</b><br><br>
            You will be required to change your password upon first login.
            <br><br>
            Regards,<br>
            <b>EDF Healthcare Team</b>
        ";

            $this->email->set_newline("\r\n");
            $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
            $this->email->to($data['mailId']);
            $this->email->subject('Your Account Login Credentials');
            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Patient email failed: ' . $this->email->print_debugger());
            }
        }

        echo json_encode([
            'success' => true,
            'id' => $insertId,
            'patientId' => $patientId,
            'firstName' => $data['firstName']
        ]);
    }

    /*  public function newAppointment()
     {
         if ($this->HcpModel->insertAppointment()) {

             $this->session->set_flashdata('showSuccessMessage', 'Appointment booked successfully');
         } else {
             $this->session->set_flashdata('showErrorMessage', 'Error in booking appointment');
         }
         redirect('Healthcareprovider/appointments');
     } */

    public function newAppointment()
    {
        $appointmentId = $this->HcpModel->insertAppointment();

        if (!$appointmentId) {
            $this->session->set_flashdata('showErrorMessage', 'Error in booking appointment');
            redirect('Healthcareprovider/appointments');
            return;
        }

        $details = $this->HcpModel->getAppointmentAndPatientDetails($appointmentId);

        if ($details && $details['appointmentType'] === 'PATIENT' && !empty($details['mailId'])) {

            $formattedDate = date('d M Y', strtotime($details['dateOfAppoint']));
            $formattedTime = date('h:i A', strtotime($details['timeOfAppoint']));
            $meetingBaseUrl = 'https://consult.edftech.in/patient/join/';
            $joinUrl = $meetingBaseUrl . ltrim($details['appointmentLink'], '/');
            $message = "
                Dear {$details['firstName']} {$details['lastName']},<br><br>
                Your appointment has been successfully booked.<br><br>
                <b>📅 Date:</b> {$formattedDate}<br>
                <b>⏰ Time:</b> {$formattedTime}<br><br>
                <b>🔗 Join Meeting:</b><br>
                <a href='{$joinUrl}' target='_blank'>{$joinUrl}</a><br><br>
                Please join the meeting at the scheduled time.
                <br><br>
                Regards,
                <br><b>EDF Healthcare Team</b>
            ";

            $this->email->set_newline("\r\n");
            $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
            $this->email->to($details['mailId']);
            $this->email->subject('Appointment Confirmation & Meeting Link');
            $this->email->message($message);
            $this->email->send();

            $this->session->set_flashdata('showSuccessMessage', 'Appointment booked successfully and Mail has been sent');
        } else {
            $this->session->set_flashdata('showSuccessMessage', 'Appointment booked successfully');
        }
        redirect('Healthcareprovider/appointments');
    }

    //Delete Appointments
    public function deleteAppointment($id)
    {
        $details = $this->HcpModel->getAppointmentAndPatientDetails($id);

        if ($this->HcpModel->delete_appointment($id)) {

            if ($details && $details['appointmentType'] === 'PATIENT' && !empty($details['mailId'])) {

                $formattedDate = date('d M Y', strtotime($details['dateOfAppoint']));
                $formattedTime = date('h:i A', strtotime($details['timeOfAppoint']));

                $message = "
                Dear {$details['firstName']} {$details['lastName']},<br><br>

                Your appointment on <b>{$formattedDate}</b> at <b>{$formattedTime}</b> 
                has been <b>CANCELED</b>.<br><br>

                You may reschedule anytime through our platform.<br><br>

                <br><br>
                Regards,
                <br><b>EDF Healthcare Team</b>
                ";

                $this->email->set_newline("\r\n");
                $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
                $this->email->to($details['mailId']);
                $this->email->subject('Appointment Cancellation Notice');
                $this->email->message($message);
                $this->email->send();

                $this->session->set_flashdata('showSuccessMessage', 'Appointment Canceled and cancellation email sent.');
            } else {
                $this->session->set_flashdata('showSuccessMessage', 'Appointment Canceled Successfully.');
            }

        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to cancel appointment.');
        }

        redirect('Healthcareprovider/appointments');
    }

    //Update Appointments
    // public function appointmentUpdate()
    // {
    //     if (isset($_SESSION['hcpsName'])) {
    //         $this->data['method'] = "appointmentUpdate";
    //         $appId = $this->uri->segment(3);
    //         $editAppDetails = $this->HcpModel->editAppDetails($appId);
    //         $this->data['updateAppDetails'] = $editAppDetails;
    //         $appTime = $this->HcpModel->getAppointmentTime();
    //         $this->data['appBookedDetails'] = $appTime;

    //         $mtime = $this->HcpModel->getAppMorTime();
    //         $this->data['morning'] = $mtime;
    //         $atime = $this->HcpModel->getAppAfterTime();
    //         $this->data['afternoon'] = $atime;
    //         $etime = $this->HcpModel->getAppEveTime();
    //         $this->data['evening'] = $etime;
    //         $ntime = $this->HcpModel->getAppNightTime();
    //         $this->data['night'] = $ntime;

    //         $this->load->view('hcpDashboard.php', $this->data);
    //     } else {
    //         redirect('Healthcareprovider/');
    //     }
    // }

    // public function updateAppointmentForm()
    // {
    //     if ($this->HcpModel->updateAppointment()) {
    //         $this->session->set_flashdata('showSuccessMessage', 'Appointment details updated successfully');
    //     } else {
    //         $this->session->set_flashdata('showErrorMessage', 'Error in updating appointment details');
    //     }
    //     redirect('Healthcareprovider/appointments');
    // }

    public function updateAppointmentForm()
    {
        if ($this->HcpModel->updateAppointment()) {

            $appointmentId = $this->input->post('appTableId');

            $details = $this->HcpModel->getAppointmentAndPatientDetails($appointmentId);

            if ($details && $details['appointmentType'] === 'PATIENT' && !empty($details['mailId'])) {

                $formattedDate = date('d M Y', strtotime($details['dateOfAppoint']));
                $formattedTime = date('h:i A', strtotime($details['timeOfAppoint']));
                $meetingBaseUrl = 'https://consult.edftech.in/patient/join/';
                $joinUrl = $meetingBaseUrl . ltrim($details['appointmentLink'], '/');

                $message = "
                    Dear {$details['firstName']} {$details['lastName']},<br><br>
                    Your Reschedule appointment has been successfully <b>updated</b>.<br><br>
                    <b>📅 Date:</b> {$formattedDate}<br>
                    <b>⏰ Time:</b> {$formattedTime}<br><br>
                    <b>🔗 Join Meeting:</b><br>
                    <a href='{$joinUrl}' target='_blank'>{$joinUrl}</a><br><br>
                    Please join the meeting at the scheduled time. <br><br>
                    Regards,
                    <br><b>EDF Healthcare Team</b>
                ";

                $this->email->set_newline("\r\n");
                $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
                $this->email->to($details['mailId']);
                $this->email->subject('Appointment Rescheduled & Meeting Link');
                $this->email->message($message);
                $this->email->send();

                $this->session->set_flashdata('showSuccessMessage', 'Appointment details updated successfully and Mail has been sent');

            } else {
                $this->session->set_flashdata('showSuccessMessage', 'Appointment details updated successfully');
            }

        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating appointment details');
        }

        redirect('Healthcareprovider/appointments');
    }

    public function appointmentReschedule()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointmentReschedule";
            $appId = $this->uri->segment(3);
            $editAppDetails = $this->HcpModel->editAppDetails($appId);
            $this->data['updateAppDetails'] = $editAppDetails;
            $appTime = $this->HcpModel->getAppointmentTime();
            $this->data['appBookedDetails'] = $appTime;

            $mtime = $this->HcpModel->getAppMorTime();
            $this->data['morning'] = $mtime;
            $atime = $this->HcpModel->getAppAfterTime();
            $this->data['afternoon'] = $atime;
            $etime = $this->HcpModel->getAppEveTime();
            $this->data['evening'] = $etime;
            $ntime = $this->HcpModel->getAppNightTime();
            $this->data['night'] = $ntime;

            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function chiefDoctors()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "chiefDoctors";
            $ccDetails = $this->HcpModel->getCcProfile();
            $this->data['ccDetails'] = $ccDetails['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function chiefDoctorsProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $ccIdDb = $this->uri->segment(3);
            $this->data['method'] = "chiefDoctorProfile";
            $ccDetails = $this->HcpModel->getCcDetails($ccIdDb);
            $this->data['ccDetails'] = $ccDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function myProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "myProfile";
            $hcpDetails = $this->HcpModel->getHcpDetails();
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function editMyProfile()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "editMyProfile";
            $hcpDetails = $this->HcpModel->getHcpDetails();
            $this->data['hcpDetails'] = $hcpDetails;
            $specList = $this->HcpModel->getSpecialization();
            $this->data['specializationList'] = $specList;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function updateMyProfile()
    {
        if ($this->HcpModel->updateProfileDetails()) {
            $this->session->set_flashdata('showSuccessMessage', 'Profile details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating profile details');
        }
        redirect('Healthcareprovider/myProfile');
    }

    public function changePassword()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "passwordChange";
            $hcpDetails = $this->HcpModel->getHcpDetails();
            $this->data['hcpDetails'] = $hcpDetails;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
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

        if ($this->HcpModel->updateNewPassword()) {
            $this->session->unset_userdata('firstLogin');
            $this->session->set_flashdata('showSuccessMessage', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating password');
        }
        redirect('Healthcareprovider/myProfile');
    }

    public function logout()
    {
        $this->session->unset_userdata('hcpIdDb');
        $this->session->unset_userdata('hcpId');
        $this->session->unset_userdata('hcpsName');
        $this->session->unset_userdata('hcpsMailId');
        $this->session->unset_userdata('hcpsMobileNum');
        $this->session->unset_userdata('firstLogin');
        $this->session->unset_userdata('last_activity_time');

        $this->session->sess_regenerate(TRUE);

        redirect('Healthcareprovider/');
    }


    public function join($unique_meeting_id = null)
    {
        if (!$this->session->userdata('hcpsName')) {
            show_error('Unauthorized Access', 403);
            return;
        }
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

        $logged_hcp_id = $this->session->userdata('hcpIdDb');
        if (!$appointment || $logged_hcp_id != $appointment->hcpDbId) {
            show_error('Unauthorized access', 403);
            return;
        }

        $appID = 'f891d97665524065b626ea324f06942f';
        $appCertificate = '3b5229b39c254ce9b03f5a64966fa5c9';
        $uid = rand(200000, 299999); // HCP UID Range [cite: 17]
        $privilegeExpiredTs = time() + 3600;

        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $unique_meeting_id, $uid, RtcTokenBuilder::RolePublisher, $privilegeExpiredTs);

        $data = [
            'app_id' => $appID,
            'temp_token' => $token,
            'channel_name' => $unique_meeting_id,
            'uid' => $uid,
            'local_name' => $appointment->hcpName ?? 'Healthcare Provider',
            'patient_name' => ($appointment->firstName ?? 'Patient') . ' ' . ($appointment->lastName ?? ''),
            'hcp_name' => $appointment->hcpName ?? 'Healthcare Provider',
            // UPDATED: Now passing the dynamic doctor name from the database 
            'chief_name' => $appointment->chiefName ?? 'N/A',
            'consult_mode' => $appointment->modeOfConsultant ?? 'video',
            'role' => 'hcp',
            'is_doctor' => true
        ];

        $this->load->view('customMeeting', $data);
    }

    public function updateStatus() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if (is_numeric($id) && $status === '1') {
            $this->load->model('HcpModel');
            $success = $this->HcpModel->update_appointment_status($id, $status);
            
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid Request']);
        }
    }

    
}