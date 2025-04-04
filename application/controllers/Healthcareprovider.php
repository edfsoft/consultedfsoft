<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Healthcareprovider extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('HcpModel');
        $this->load->library('session');
        $this->load->library('email');
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

    public function send()
    {
        $to = $this->input->post('hcpPassMail');
        $mobile = $this->input->post('hcpMobileNum');
        $otp = rand(1000, 9999);
        $this->session->set_userdata('generated_otp', $otp);

        $message = "Your OTP is $otp to change the new password for your Health Care Provider[HCP] account.";

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
        $profileDetails = $this->HcpModel->changeNewPassword();
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
            $this->data['appointmentList'] = $appointmentList['response'];
            $this->data['appointmentsTotal'] = $appointmentList['totalRows'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function patients()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patients";
            $patientList = $this->HcpModel->getPatientList();
            $this->data['patientList'] = $patientList['response'];
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function patientform()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetailsForm";
            $symptoms = $this->HcpModel->getSymptoms();
            $this->data['symptomsList'] = $symptoms;
            $medicines = $this->HcpModel->getMedicines();
            $this->data['medicinesList'] = $medicines;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function addPatientsForm()
    {
        $post = $this->input->post(null, true);
        $patientMobileNum = $post['patientMobile'];

        if ($this->HcpModel->checkPatientExistence($patientMobileNum)) {
            $this->session->set_flashdata('errorMessage', 'Mobile number already exists. Please use a new number.');
            redirect('Healthcareprovider/patientform');
            exit();
        } else {
            $register = $this->HcpModel->insertPatients();
            $this->HcpModel->generatePatientId();
            if ($register) {
                $this->session->set_flashdata('showSuccessMessage', 'Patient added successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in adding patient');
            }
            redirect('Healthcareprovider/patients');
        }
    }

    public function patientdetails()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $appHistory = $this->HcpModel->getAppointmentHistory($patientIdDb);
            $this->data['patientAppHistory'] = $appHistory;
            $appMedicines = $this->HcpModel->getAppMedicinesDetails($patientIdDb);
            $this->data['appMedicines'] = $appMedicines;
            $this->load->view('hcpDashboard.php', $this->data);
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
            $symptoms = $this->HcpModel->getSymptoms();
            $this->data['symptomsList'] = $symptoms;
            $medicines = $this->HcpModel->getMedicines();
            $this->data['medicinesList'] = $medicines;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function updatePatientsForm()
    {
        if ($this->HcpModel->updatePatientsDetails()) {
            $this->session->set_flashdata('showSuccessMessage', 'Patient details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating patient details');
        }
        redirect('Healthcareprovider/patients');
    }

    public function updatePatientPhoto()
    {
        if ($this->HcpModel->updatePatientProfilePhoto()) {
            $this->session->set_flashdata('showSuccessMessage', 'Patient photo updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating patient photo');
        }
        redirect('Healthcareprovider/updatePatientsForm');
    }

    public function prescriptionView()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "prescription";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $appMedicines = $this->HcpModel->getAppMedicinesDetails($patientIdDb);
            $this->data['appMedicines'] = $appMedicines;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
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
            $patientList = $this->HcpModel->getPatientList();
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

    public function newAppointment()
    {
        if ($this->HcpModel->insertAppointment()) {
            $this->session->set_flashdata('showSuccessMessage', 'Appointment booked successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in booking appointment');
        }
        redirect('Healthcareprovider/appointments');
    }

    public function appointmentUpdate()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointmentUpdate";
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

    public function updateAppointmentForm()
    {
        if ($this->HcpModel->updateAppointment()) {
            $this->session->set_flashdata('showSuccessMessage', 'Appointment details updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating appointment details');
        }
        redirect('Healthcareprovider/appointments');
    }

    public function appointmentSummary()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "appointmentSummary";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $medicines = $this->HcpModel->getMedicines();
            $this->data['medicinesList'] = $medicines;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function prescriptionForm()
    {
        $this->HcpModel->addPrescription();

        $medNames = $this->input->post('preMedName');
        $frequencies = $this->input->post('preMedFrequency');
        $durations = $this->input->post('preMedDuration');
        $durationUnits = $this->input->post('preMedDurationUnit');
        $notes = $this->input->post('preMedNotes');
        $patientDbId = $this->input->post('patientDbId');

        $medicinesData = [];
        for ($i = 0; $i < count($medNames); $i++) {
            $medicinesData[] = [
                'patientDbId' => $patientDbId,
                'medicineName' => $medNames[$i],
                'frequency' => $frequencies[$i],
                'duration' => $durations[$i],
                'duration_unit' => $durationUnits[$i],
                'notes' => $notes[$i],
                'dateOfAppoint' => date('Y-m-d')
            ];
        }
        $this->HcpModel->prescriptionMedicines($medicinesData);
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

    public function updatePhoto()
    {
        if ($this->HcpModel->updateProfilePhoto()) {
            $this->session->set_flashdata('showSuccessMessage', 'Profile photo updated successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in updating profile photo');
        }
        redirect('Healthcareprovider/editMyProfile');
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

    // public function getDetails()
    // {
    //     $patientList = $this->HcpModel->getPatientList();
    //     $this->data['patientList'] = $patientList['response'];
    //     $this->load->view('hcpDashboard.php',  $this->data);
    // }



    
    public function logout()
    {
        // $this->session->unset_userdata('LoggedInDetails');
        $this->session->unset_userdata('hcpIdDb');
        $this->session->unset_userdata('hcpId');
        $this->session->unset_userdata('hcpsName');
        $this->session->unset_userdata('hcpsMailId');
        $this->session->unset_userdata('hcpsMobileNum');
        redirect('Healthcareprovider/');
    }
}