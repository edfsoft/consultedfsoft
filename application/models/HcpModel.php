<?php
class HcpModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function register()
    {
        $post = $this->input->post(null, true);
        $approval = isset($post['approvalApproved']) ? $post['approvalApproved'] : '0';
        $insert = array(
            'hcpName' => $post['hcpName'],
            'hcpMobile' => $post['hcpMobile'],
            'hcpMail' => $post['hcpEmail'],
            'hcpSpecialization' => $post['hcpSpec'],
            // 'hcpPassword' => $post['hcpCnfmPassword'],
            'hcpPassword' => password_hash($post['hcpCnfmPassword'], PASSWORD_BCRYPT),
            'approvalStatus' => $approval,
            'firstLoginPswd' => $post['firstLoginPswdChange']
        );
        $this->db->insert('hcp_details', $insert);
        return true;
    }

    public function check_existing_user($mobileNumber, $mailId)
    {
        $existingFields = [];

        if ($this->db->where('hcpMobile', $mobileNumber)->get('hcp_details')->num_rows() > 0) {
            $existingFields[] = 'Mobile Number';
        }
        if ($this->db->where('hcpMail', $mailId)->get('hcp_details')->num_rows() > 0) {
            $existingFields[] = 'Mail Id';
        }

        return $existingFields;
    }

    public function generatehcpid()
    {
        $latest_customer_id = $this->getlasthcpid();
        $last_four_digits = substr($latest_customer_id, -4);
        $incremented_id = str_pad((int) $last_four_digits + 1, 4, '0', STR_PAD_LEFT);
        $generate_id = "EDFHCP{$incremented_id}";
        $insert = array(
            'hcpId' => $generate_id
        );
        $MobileNumber = $this->input->post('hcpMobile');
        $this->db->where('hcpMobile', $MobileNumber);
        $this->db->update('hcp_details', $insert);
        return $generate_id;
    }

    public function getlasthcpid()
    {
        $this->db->select('hcpId');
        $this->db->from('hcp_details');
        $this->db->order_by('hcpId', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->hcpId;
        } else {
            return 'EDFHCP0000';
        }
    }

    public function changeNewPassword()
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'hcpPassword' => password_hash($post['hcpCnfmPassword'], PASSWORD_BCRYPT),
        );
        $this->db->where('hcpMobile', $post['hcpMobileNum']);
        $this->db->update('hcp_details', $updatedata);
    }

    public function hcpLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['hcpEmail'];
        $password = $postData['hcpPassword'];
        // $query = "SELECT * FROM hcp_details WHERE hcpMail = '$emailid' AND hcpPassword = '$password' AND deleteStatus = '0'";
        // $count = $this->db->query($query);
        // return $count->result_array();
        $query = "SELECT * FROM hcp_details WHERE hcpMail = ? AND deleteStatus = '0'";
        $result = $this->db->query($query, array($emailid));
        $user = $result->row_array();

        $hashedPassword = $user['hcpPassword'];
        if (password_verify($password, $hashedPassword)) {
            return $user;
        }
    }

    public function getPatientList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `patient_details` WHERE `patientHcpDbId`=  $hcpIdDb AND deleteStatus = '0' ORDER BY `id` DESC";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function checkPatientExistence($patientMobileNum)
    {
        $this->db->where('mobileNumber', $patientMobileNum);
        $query = $this->db->get('patient_details');
        return $query->num_rows() > 0;
    }

    public function insertPatients()
    {
        $post = $this->input->post(null, true);

        $config['upload_path'] = "./uploads/";
        // $basepath = base_url() . 'uploads/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        $firstDocument = "No data";
        $secondDocument = "No data";
        $photo = "No data";

        if ($this->upload->do_upload('medicalReceipts')) {
            $data = $this->upload->data();
            $firstDocument = $data['file_name'];
        }
        if ($this->upload->do_upload('medicalReports')) {
            $data = $this->upload->data();
            $secondDocument = $data['file_name'];
        }
        if ($this->upload->do_upload('profilePhoto')) {
            $data = $this->upload->data();
            $photo = $data['file_name'];
        } else {
            $error = $this->upload->display_errors();
        }

        $medicine = $post['patientMedicines'] != "addNew" ? $post['patientMedicines'] : $post['newMedicineBrand'] . " / " . $post['newMedicineName'] . " / " . $post['newMedicineSrength'];

        $insertdata = array(
            'firstName' => $post['patientName'],
            'lastName' => $post['patientLastName'],
            'mobileNumber' => $post['patientMobile'],
            'alternateMobile' => $post['patientAltMobile'],
            'mailId' => $post['patientEmail'],
            'gender' => $post['patientGender'],
            'age' => $post['patientAge'],
            'bloodGroup' => $post['patientBlood'],
            'maritalStatus' => $post['patientMarital'],
            'marriedSince' => $post['marriedSince'],
            'profilePhoto' => $photo,
            'profession' => $post['patientProfessions'],
            'doorNumber' => $post['patientDoorNo'],
            'address' => $post['patientStreet'],
            'district' => $post['patientDistrict'],
            'pincode' => $post['patientPincode'],
            'partnerName' => $post['partnersName'],
            'partnerMobile' => $post['partnerMobile'],
            'partnerBlood' => $post['partnerBlood'],
            'weight	' => $post['patientWeight'],
            'height	' => $post['patientHeight'],
            'systolicBp' => $post['patientSystolicBp'],
            'diastolicBp' => $post['patientDiastolicBp'],
            'cholestrol' => $post['patientsCholestrol'],
            'bloodSugar' => $post['patientBsugar'],
            'diagonsis	' => $post['patientDiagonsis'],
            'symptoms' => $post['patientSymptoms'],
            'medicines' => $medicine,
            'documentOne' => $firstDocument,
            'documentTwo' => $secondDocument,
            'patientHcp	' => $_SESSION['hcpId'],
            'patientHcpDbId	' => $_SESSION['hcpIdDb'],
        );
        $this->db->insert('patient_details', $insertdata);

        if ($post['patientMedicines'] == "addNew") {
            $post = $this->input->post(null, true);
            $insert = array(
                'medicineBrand' => $post['newMedicineBrand'],
                'medicineName' => $post['newMedicineName'],
                'strength' => $post['newMedicineSrength']
            );
            $this->db->insert('medicines_list', $insert);
        }
        return true;
    }

    public function updatePatientsDetails()
    {
        $post = $this->input->post(null, true);

        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        $firstDocument = $post['oldmedicalReceipts'];
        $secondDocument = $post['oldmedicalReports'];

        if ($this->upload->do_upload('medicalReceipts')) {
            $data = $this->upload->data();
            $firstDocument = $data['file_name'];
        }
        if ($this->upload->do_upload('medicalReports')) {
            $data = $this->upload->data();
            $secondDocument = $data['file_name'];
        } else {
            $error = $this->upload->display_errors();
        }

        $insertdata = array(
            'firstName' => $post['patientName'],
            'lastName' => $post['patientLastName'],
            'mobileNumber' => $post['patientMobile'],
            'alternateMobile' => $post['patientAltMobile'],
            'mailId' => $post['patientEmail'],
            'gender' => $post['patientGender'],
            'age' => $post['patientAge'],
            'bloodGroup' => $post['patientBlood'],
            'maritalStatus' => $post['patientMarital'],
            'marriedSince' => $post['marriedSince'],
            'profession' => $post['patientProfessions'],
            'doorNumber' => $post['patientDoorNo'],
            'address' => $post['patientStreet'],
            'district' => $post['patientDistrict'],
            'pincode' => $post['patientPincode'],
            'partnerName' => $post['partnersName'],
            'partnerMobile' => $post['partnerMobile'],
            'partnerBlood' => $post['partnerBlood'],
            'weight	' => $post['patientWeight'],
            'height	' => $post['patientHeight'],
            'systolicBp' => $post['patientSystolicBp'],
            'diastolicBp' => $post['patientDiastolicBp'],
            'cholestrol' => $post['patientsCholestrol'],
            'bloodSugar' => $post['patientBsugar'],
            'diagonsis	' => $post['patientDiagonsis'],
            'symptoms' => $post['patientSymptoms'],
            'medicines	' => $post['patientMedicines'],
            'documentOne' => $firstDocument,
            'documentTwo' => $secondDocument,
        );
        $this->db->where('id', $post['patientIdDb']);
        $this->db->update('patient_details', $insertdata);
        return true;
    }

    public function updatePatientProfilePhoto()
    {
        $post = $this->input->post(null, true);

        $config['upload_path'] = "./uploads/";
        // $basepath = base_url() . 'uploads/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('patientProfile')) {
            $data = $this->upload->data();
            $photo = $data['file_name'];
        } else {
            $error = $this->upload->display_errors();
        }

        $updatedata = array(
            'profilePhoto' => $photo
        );
        $this->db->where('id', $post['photoPatientIdDb']);
        $this->db->update('patient_details', $updatedata);
        return true;
    }

    public function generatePatientId()
    {
        $latest_customer_id = $this->getlastPatientId();
        $last_four_digits = substr($latest_customer_id, -6);
        $incremented_id = str_pad((int) $last_four_digits + 1, 6, '0', STR_PAD_LEFT);
        $generate_id = "EDF{$incremented_id}";
        $insert = array(
            'patientId' => $generate_id
        );
        $MobileNumber = $this->input->post('patientMobile');
        $this->db->where('mobileNumber', $MobileNumber);
        $this->db->update('patient_details', $insert);
        return $generate_id;
    }

    public function getlastPatientId()
    {
        $this->db->select('patientId');
        $this->db->from('patient_details');
        $this->db->order_by('patientId', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->patientId;
        } else {
            return 'EDF000000';
        }
    }

    public function getPatientDetails($id)
    {
        $details = "SELECT * FROM `patient_details` WHERE `id`= $id  AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getConsultationDetails($id)
    {
        $details = "SELECT * FROM `consultation_details` WHERE `patientDbId` = $id  ORDER BY `createdDateTime` DESC ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getConsultMedicinesDetails($id)
    {
        $details = "SELECT * FROM `consultation_medicines` WHERE `patientDbId`= $id ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAppointmentListDash()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT pd.id, pd.patientId, pd.firstName, pd.lastName , pd.mobileNumber , pd.gender , pd.age , pd.bloodGroup, pd.profilePhoto , pd.documentOne , pd.documentTwo, pd.lastAppDate,
        ad.referalDoctor, ad.referalDoctorDbId , ad.dateOfAppoint , ad.timeOfAppoint , ad.patientComplaint , ad.patientHcp
        FROM patient_details AS pd
        LEFT JOIN appointment_details AS ad ON pd.id = ad.patientDbId
        WHERE hcpDbId = $hcpIdDb AND  `dateOfAppoint` = CURDATE()   AND `timeOfAppoint` >= CURTIME() ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `appointment_details` WHERE `hcpDbId` = $hcpIdDb AND `appStatus` = '0' AND ( `dateOfAppoint` > CURDATE() OR ( `dateOfAppoint` = CURDATE() AND ADDTIME(`timeOfAppoint`, '00:10:00') >= CURTIME() ) ) ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentTime()
    {
        $details = "SELECT * FROM `appointment_details` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function insertAppointment()
    {
        $post = $this->input->post(null, true);
        list($patientId, $dbId) = explode('|', $post['patientId']);
        list($ccId, $ccDbId, $appLink) = explode('|', $post['referalDoctor']);
        $insert = array(
            'patientId' => $patientId,
            'patientDbId' => $dbId,
            'referalDoctor' => $ccId,
            'appointmentLink' => $appLink,
            'referalDoctorDbId' => $ccDbId,
            'modeOfConsultant' => $post['appConsult'],
            'dateOfAppoint' => $post['appDate'],
            'partOfDay' => $post['dayTime'],
            'timeOfAppoint' => $post['appTime'],
            'patientComplaint' => $post['appReason'],
            'patientHcp' => $_SESSION['hcpId'],
            'hcpDbId' => $_SESSION['hcpIdDb']
        );
        $this->db->insert('appointment_details', $insert);
        return true;
    }

    public function getAppointmentReschedule()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `appointment_details` WHERE `hcpDbId` = $hcpIdDb AND ( `dateOfAppoint` < CURDATE() OR ( `dateOfAppoint` = CURDATE() AND `timeOfAppoint` <= SUBTIME(CURTIME(), '00:10:00') ) ) AND `appStatus`= '0' ORDER BY `dateOfAppoint`, `timeOfAppoint`; ";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function editAppDetails($id)
    {
        $details = "SELECT * FROM `appointment_details` WHERE `id` = $id";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function updateAppointment()
    {
        $post = $this->input->post(null, true);

        $updatedata = array(
            'modeOfConsultant' => $post['appConsult'],
            'dateOfAppoint' => $post['appDate'],
            'partOfDay' => $post['dayTime'],
            'timeOfAppoint' => $post['appTime'],
            'appStatus' => "0"
        );
        $this->db->where('id', $post['appTableId']);
        $this->db->update('appointment_details', $updatedata);
        return true;
    }

    public function directConsultationSave()
    {
        $post = $this->input->post(null, true);
        $updatePatient = array(
            'lastAppDate' => date('Y-m-d'),
            'nextAppDate' => $post['nextFollowUpDate'],
        );
        $this->db->where('id', $post['patientIdDb']);
        $this->db->update('patient_details', $updatePatient);

        $post = $this->input->post(null, true);
        $hcpId = $_SESSION['hcpId'];
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $symptom_string = implode(',', $post['symptoms']);
        $saveDirectConsult = array(
            'patientId' => $post['patientId'],
            'patientDbId' => $post['patientIdDb'],
            'consultDoctorId' => $hcpId,
            'consultDoctorDbId' => $hcpIdDb,
            'date' => date('d-m-Y'),
            'symptoms' => $symptom_string,
            'findings' => $post['findings'],
            'diagnosis' => $post['diagnosis'],
            'investigations' => $post['investigations'],
            'adviceGiven' => $post['advices'],
            'nextFollowup' => $post['nextFollowUpDate'],
            'consultMode' => '0',
        );
        $this->db->insert('consultation_details', $saveDirectConsult);
        return $this->db->insert_id();
    }

    public function onlineConsultationSave()
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'lastAppDate' => date('Y-m-d'),
            'nextAppDate' => $post['nextFollowUp'],
        );
        $this->db->where('id', $post['patientIdDb']);
        $this->db->update('patient_details', $updatedata);

        $updateAppStatus = array(
            'appStatus' => "1",
        );
        $this->db->where('patientDbId', $post['patientIdDb']);
        $this->db->where('dateOfAppoint', date('Y-m-d'));
        $this->db->update('appointment_details', $updateAppStatus);

        $hcpId = $_SESSION['hcpId'];
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $symptom_string = implode(', ', $post['symptoms']);
        $saveOnlineConsult = array(
            'patientId' => $post['patientId'],
            'patientDbId' => $post['patientIdDb'],
            'consultDoctorId' => $hcpId,
            'consultDoctorDbId' => $hcpIdDb,
            'date' => date('d-m-Y'),
            'symptoms' => $symptom_string,
            'findings' => $post['findings'],
            'diagnosis' => $post['diagnosis'],
            'investigations' => $post['investigations'],
            'adviceGiven' => $post['adviceGiven'],
            'nextFollowup' => $post['nextFollowUp'],
            'consultMode' => '1',
        );
        $this->db->insert('consultation_details', $saveOnlineConsult);
        return $this->db->insert_id();

    }

    public function consultMedicineSave($consultIdDb)
    {
        $medNames = $this->input->post('preMedName');
        $frequencies = $this->input->post('preMedFrequency');
        $durations = $this->input->post('preMedDuration');
        $durationUnits = $this->input->post('preMedDurationUnit');
        $notes = $this->input->post('preMedNotes');
        $patientDbId = $this->input->post('patientIdDb');

        for ($i = 0; $i < count($medNames); $i++) {
            $data = [
                'patientDbId' => $patientDbId,
                'consultationDbId' => $consultIdDb,
                'medicineName' => $medNames[$i],
                'frequency' => $frequencies[$i],
                'duration' => $durations[$i],
                'duration_unit' => $durationUnits[$i],
                'notes' => $notes[$i],
                'dateOfAppoint' => date('Y-m-d')
            ];
            $this->db->insert('consultation_medicines', $data);
        }
    }

    public function getHcpDetails()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `hcp_details` WHERE `id` = $hcpIdDb";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function updateProfilePhoto()
    {
        $post = $this->input->post(null, true);
        $hcpIdDb = $_SESSION['hcpIdDb'];

        $config['upload_path'] = "./uploads/";
        $basepath = base_url() . 'uploads/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);


        if ($this->upload->do_upload('hcpProfile')) {
            $data = $this->upload->data();
            $photo = $data['file_name'];
        } else {
            $error = $this->upload->display_errors();
        }

        $photoFileName = $basepath . $photo;

        $updatedata = array(
            'hcpPhoto' => $photoFileName
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updatedata);
        return true;
    }

    public function updateProfileDetails()
    {
        $post = $this->input->post(null, true);
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $updatedata = array(
            // 'hcpName' => $post['drName'],
            // 'hcpMobile' => $post['drMobile'],
            // 'hcpMail' => $post['drEmail'],
            // 'hcpPassword' => $post['drPassword'],
            'hcpExperience' => $post['yearOfExp'],
            'hcpQualification' => $post['qualification'],
            'hcpSpecialization' => $post['specialization'],
            'hcpDob' => $post['dob'],
            'hcpHospitalName' => $post['hospitalName'],
            'hcpLocation' => $post['location'],
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updatedata);
        return true;
    }

    public function getCcProfile()
    {
        $details = "SELECT * FROM `cc_details` WHERE deleteStatus = '0' AND approvalStatus = '1'";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getCcDetails($ccIdDb)
    {
        $details = "SELECT * FROM `cc_details` WHERE `id`=$ccIdDb AND deleteStatus = '0' AND approvalStatus = '1'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getSpecialization()
    {
        $details = "SELECT * FROM `specialization_list` ORDER BY `specializationName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getSymptoms()
    {
        $details = "SELECT * FROM `symptoms_list` ORDER BY `symptomsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getMedicines()
    {
        $details = "SELECT * FROM `medicines_list` ORDER BY `medicineName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAppMorTime()
    {
        $details = "SELECT * FROM `morning_time` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAppAfterTime()
    {
        $details = "SELECT * FROM `afternoon_time` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAppEveTime()
    {
        $details = "SELECT * FROM `evening_time` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAppNightTime()
    {
        $details = "SELECT * FROM `night_time` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }






}
