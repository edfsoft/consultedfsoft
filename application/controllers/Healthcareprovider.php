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

    public function sendFPOtp()
    {
        $to = $this->input->post('hcpPassMail');
        $mobile = $this->input->post('hcpMobileNum');
        $otp = rand(1000, 9999);
        $this->session->set_userdata('generated_otp', $otp);

        // $message = "Your OTP is $otp to change the new password for your Health Care Provider[HCP] account.";
        $message = " Dear User, <br> <br>
        Your One-Time Password (OTP) to reset your Health Care Provider (HCP) account password is:
       <b> $otp </b> <br>
        Please use this OTP to proceed with updating your password. For security reasons, this OTP is valid for 10 minutes and should not be shared with anyone.
       <br> Best regards,<br>  
        Health Care Provider Support Team ";

        $this->email->set_newline("\r\n");
        $this->email->from('erodediabetesfoundation@gmail.com', 'Consult EDF');
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
            $this->HcpModel->generatePatientId($register);
            if ($register) {
                $this->session->set_flashdata('showSuccessMessage', 'Patient added successfully');
            } else {
                $this->session->set_flashdata('showErrorMessage', 'Error in adding patient');
            }
            redirect('Healthcareprovider/consultation/' . $register);
        }
    }

    public function patientdetails()
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "patientDetails";
            $patientIdDb = $this->uri->segment(3);
            $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['patientDetails'] = $patientDetails;
            $consultHistory = $this->HcpModel->getConsultationDetails($patientIdDb);
            $this->data['consultDetails'] = $consultHistory;
            $Medicinesconsult = $this->HcpModel->getConsultMedicinesDetails($patientIdDb);
            $this->data['consultMedicines'] = $Medicinesconsult;
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
        redirect('Healthcareprovider/consultation/' . $updatePatient);
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

    // public function prescriptionView()
    // {
    //     if (isset($_SESSION['hcpsName'])) {
    //         $this->data['method'] = "prescription";
    //         $patientIdDb = $this->uri->segment(3);
    //         $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
    //         $this->data['patientDetails'] = $patientDetails;
    //         $appMedicines = $this->HcpModel->getConsultMedicinesDetails($patientIdDb);
    //         $this->data['appMedicines'] = $appMedicines;
    //         $this->load->view('hcpDashboardPatients.php', $this->data);
    //     } else {
    //         redirect('Healthcareprovider/');
    //     }
    // }


    // This is in bottom of the file
    // public function consultation($patientIdDb)
    // {
    //     if (isset($_SESSION['hcpsName'])) {
    //         $this->data['method'] = "newConsultation";
    //         $patientDetails = $this->HcpModel->getPatientDetails($patientIdDb);
    //         $this->data['patientDetails'] = $patientDetails;
    //         $symptoms = $this->HcpModel->getSymptoms();
    //         $this->data['symptomsList'] = $symptoms;
    //         $medicines = $this->HcpModel->getMedicines();
    //         $this->data['medicinesList'] = $medicines;
    //         // $this->load->view('hcpDashboardPatients.php', $this->data);
    //         $this->load->view('consultation.php', $this->data);
    //     } else {
    //         redirect('Healthcareprovider/');
    //     }
    // }

    public function saveDirectConsultation()
    {
        $consultIdDb = $this->HcpModel->directConsultationSave();
        $this->HcpModel->consultMedicineSave($consultIdDb);
        if ($consultIdDb) {
            $this->session->set_flashdata('showSuccessMessage', 'Direct consultation saved successfully');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Error in submitting details');
        }
        redirect('Healthcareprovider/patients/');
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

    // Add new patient in the appointment form
    public function ajaxSavePatient()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);
        $data = [
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'mobileNumber' => $input['mobile'],
            'mailId' => $input['email'],
            'gender' => $input['gender'],
            'age' => $input['age'],
            'patientHcp' => $_SESSION['hcpId'],
            'patientHcpDbId' => $_SESSION['hcpIdDb'],
        ];

        if ($this->HcpModel->checkPatientExistence($data['mobileNumber'])) {
            echo json_encode(['success' => false, 'message' => 'Patient mobile number already exists']);
            return;
        }

        $insertId = $this->HcpModel->insertPartialPatient($data);
        $patientId = $this->HcpModel->generatePatientId($insertId);

        if ($insertId && $patientId) {
            $this->HcpModel->update($insertId, ['patientId' => $patientId]);
            echo json_encode([
                'success' => true,
                'id' => $insertId,
                'patientId' => $patientId,
                'firstName' => $data['firstName']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Insert failed']);
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
            $symptoms = $this->HcpModel->getSymptoms();
            $this->data['symptomsList'] = $symptoms;
            $medicines = $this->HcpModel->getMedicines();
            $this->data['medicinesList'] = $medicines;
            $this->load->view('hcpDashboard.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    // public function saveOnlineConsutation()
    // {
    //     $consultIdDb = $this->HcpModel->onlineConsultationSave();
    //     $this->HcpModel->consultMedicineSave($consultIdDb);
    //     if (consultIdDb) {
    //         $this->session->set_flashdata('showSuccessMessage', 'Online consultation saved successfully');
    //     } else {
    //         $this->session->set_flashdata('showErrorMessage', 'Error in submitting details');
    //     }
    //     redirect('Healthcareprovider/appointments');
    // }

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


    // ***************************************************************************
    // New 

    public function consultation($patientIdDb)
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "newConsultation";
            $this->data['patientId'] = $patientIdDb;
            $this->data['patientDetails'] = $this->HcpModel->getPatientDetails($patientIdDb);
            $this->data['symptomsList'] = $this->HcpModel->getSymptoms();
            // $this->data['medicinesList'] = $this->HcpModel->getMedicines();

            $this->data['consultations'] = $this->HcpModel->get_consultations_by_patient($patientIdDb);
            $this->data['patient_id'] = $patientIdDb;

            $this->load->view('consultation.php', $this->data);
        } else {
            redirect('Healthcareprovider/');
        }
    }

    public function saveConsultation()
    {
        $post = $this->input->post(null, true);
        $consultationId = $this->HcpModel->save_consultation();
        $post['consultationId'] = $consultationId;
        // Vitals
        $vitalsSaved = $this->HcpModel->save_vitals($post);

        // Symptoms
        $symptoms_json = $this->input->post('symptomsJson');
        $symptoms = json_decode($symptoms_json, true);
        if ($symptoms && is_array($symptoms)) {
            foreach ($symptoms as $symptom) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'symptom_name' => $symptom['symptom'],
                    'note' => $symptom['note'],
                    'since' => $symptom['since'],
                    'severity' => $symptom['severity'],
                );
                $symptomSaved = $this->HcpModel->save_symptom($data);
            }
        }

        // Findings
        $findings_json = $this->input->post('findingsJson');
        $findings = json_decode($findings_json, true);

        if ($findings && is_array($findings)) {
            foreach ($findings as $finding) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'finding_name' => $finding['name'],
                    'note' => $finding['note'],
                    'since' => $finding['since'],
                    'severity' => $finding['severity']
                );
                $findingSaved = $this->HcpModel->save_finding($data);
            }
        }

        // Diagnosis
        $diagnosis_json = $this->input->post('diagnosisJson');
        $diagnoses = json_decode($diagnosis_json, true);
        if ($diagnoses && is_array($diagnoses) && !empty($diagnoses)) {
            foreach ($diagnoses as $diagnosis) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'diagnosis_name' => $diagnosis['name'],
                    'note' => $diagnosis['note'],
                    'since' => $diagnosis['since'],
                    'severity' => $diagnosis['severity']
                );

                $diagnosisSaved = $this->HcpModel->save_diagnosis($data);
            }
        }

        $investigationSaved = $this->HcpModel->save_investigation($post);
        $instructionSaved = $this->HcpModel->save_instruction($post);
        $procedureSaved = $this->HcpModel->save_procedure($post);


        if ($vitalsSaved && $findingSaved && $diagnosisSaved && $symptomSaved && $investigationSaved && $instructionSaved && $procedureSaved) {
            $this->session->set_flashdata('showSuccessMessage', 'Consultation details saved successfully.');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to save consultation details.');
        }

        redirect('Healthcareprovider/consultation/' . $post['patientIdDb']);
    }

    public function followupConsultation($consultation_id)
    {
        if (isset($_SESSION['hcpsName'])) {
            $data['method'] = "followupConsult";
            $data['symptomsList'] = $this->HcpModel->getSymptoms();
            $data['consultation'] = $this->HcpModel->get_consultation_by_id($consultation_id);
            $data['vitals'] = $this->HcpModel->get_vitals_by_consultation_id($consultation_id);
            $data['symptoms'] = $this->HcpModel->get_symptoms_by_consultation_id($consultation_id);
            $data['findings'] = $this->HcpModel->get_findings_by_consultation_id($consultation_id);
            $data['diagnosis'] = $this->HcpModel->get_diagnosis_by_consultation_id($consultation_id);

            $data['patient_id'] = $data['consultation']['patient_id'];
            $data['previous_consultation_id'] = $consultation_id;
            $data['patientDetails'] = $this->HcpModel->getPatientDetails($data['patient_id']);

            $this->load->view('consultation.php', $data);
        } else {
            redirect('Healthcareprovider/');
        }

    }


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