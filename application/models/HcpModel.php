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

    public function insertPatients()
    {
        $post = $this->input->post(null, true);

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
            'patientHcp	' => $_SESSION['hcpId'],
            'patientHcpDbId	' => $_SESSION['hcpIdDb'],
        );
        $this->db->insert('patient_details', $insertdata);
        $registeredId = $this->db->insert_id();

        $uploadPath = './uploads/';
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        $maxSize = 1 * 1024 * 1024;

        if (!empty($_FILES['profilePhoto']['name'])) {
            $ext = pathinfo($_FILES['profilePhoto']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            if (!in_array($ext, $allowedTypes)) {
                return ['status' => false, 'message' => 'Invalid file type'];
            }

            if ($_FILES['profilePhoto']['size'] > $maxSize) {
                return ['status' => false, 'message' => 'File size exceeds 1MB'];
            }

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $formattedId = str_pad($registeredId, 2, '0', STR_PAD_LEFT);
            $fileName = 'patient_profile_' . $formattedId . '.' . $ext;
            $targetPath = $uploadPath . $fileName;

            if (!move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $targetPath)) {
                return false;
            }

            $this->db->where('id', $registeredId);
            $this->db->update('patient_details', ['profilePhoto' => $fileName]);
        }

        return $registeredId;
    }

    public function updatePatientsDetails()
    {
        $post = $this->input->post(null, true);
        $updateData = array(
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
            'partnerBlood' => $post['partnerBlood']
        );
        $this->db->where('id', $post['patientIdDb']);
        $this->db->update('patient_details', $updateData);

        $uploadPath = './uploads/';
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        $maxSize = 1 * 1024 * 1024;

        if (!empty($_FILES['profilePhoto']['name'])) {
            $ext = pathinfo($_FILES['profilePhoto']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            if (!in_array($ext, $allowedTypes)) {
                return ['status' => false, 'message' => 'Invalid file type'];
            }

            if ($_FILES['profilePhoto']['size'] > $maxSize) {
                return ['status' => false, 'message' => 'File size exceeds 1MB'];
            }

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $formattedId = str_pad($post['patientIdDb'], 2, '0', STR_PAD_LEFT);
            $fileName = 'patient_profile_' . $formattedId . '.' . $ext;
            $targetPath = $uploadPath . $fileName;

            if (!move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $targetPath)) {
                return false;
            }

            $this->db->where('id', $post['patientIdDb']);
            $this->db->update('patient_details', ['profilePhoto' => $fileName]);
        }

        return $post['patientIdDb'];
    }

    public function generatePatientId($dbid)
    {
        $latest_customer_id = $this->getlastPatientId();
        $last_four_digits = substr($latest_customer_id, -6);
        $incremented_id = str_pad((int) $last_four_digits + 1, 6, '0', STR_PAD_LEFT);
        $generate_id = "EDF{$incremented_id}";
        $insert = array(
            'patientId' => $generate_id
        );
        $this->db->where('id', $dbid);
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

    public function getAppointmentListDash()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT pd.id, pd.patientId, pd.firstName, pd.lastName , pd.mobileNumber , pd.gender , pd.age , pd.bloodGroup, pd.profilePhoto,
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

    public function insertPartialPatient($data)
    {
        $this->db->insert('patient_details', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update('patient_details', $data);
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

    // For Reference to save medicine
    // public function consultMedicineSave($consultIdDb)
    // {
    //     $medNames = $this->input->post('preMedName');
    //     $frequencies = $this->input->post('preMedFrequency');
    //     $durations = $this->input->post('preMedDuration');
    //     $durationUnits = $this->input->post('preMedDurationUnit');
    //     $notes = $this->input->post('preMedNotes');
    //     $patientDbId = $this->input->post('patientIdDb');

    //     // for ($i = 0; $i < count($medNames); $i++) {
    //     //     $data = [
    //     //         'patientDbId' => $patientDbId,
    //     //         'consultationDbId' => $consultIdDb,
    //     //         'medicineName' => $medNames[$i],
    //     //         'frequency' => $frequencies[$i],
    //     //         'duration' => $durations[$i],
    //     //         'duration_unit' => $durationUnits[$i],
    //     //         'notes' => $notes[$i],
    //     //         'dateOfAppoint' => date('Y-m-d')
    //     //     ];
    //     // $this->db->insert('consultation_medicines', $data);
    //     for ($i = 0; $i < count($medNames); $i++) {
    //         $frequency = isset($frequencies[$i]) ? $frequencies[$i] : '';
    //         $duration = isset($durations[$i]) ? $durations[$i] : '';
    //         $durationUnit = isset($durationUnits[$i]) ? $durationUnits[$i] : '';
    //         $note = isset($notes[$i]) ? $notes[$i] : '';

    //         $data = [
    //             'patientDbId' => $patientDbId,
    //             'consultationDbId' => $consultIdDb,
    //             'medicineName' => $medNames[$i],
    //             'frequency' => $frequency,
    //             'duration' => $duration,
    //             'duration_unit' => $durationUnit,
    //             'notes' => $note,
    //             'dateOfAppoint' => date('Y-m-d')
    //         ];
    //         $this->db->insert('consultation_medicines', $data);
    //     }
    // }

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
            'hcpExperience' => $post['yearOfExp'],
            'hcpQualification' => $post['qualification'],
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
        $details = "SELECT * FROM `symptoms_list` WHERE `activeStatus` = '0' ORDER BY `symptomsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getFindings()
    {
        $details = "SELECT * FROM `findings_list` WHERE `activeStatus` = '0' ORDER BY `findingsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getDiagnosis()
    {
        $details = "SELECT * FROM `diagnosis_list` WHERE `activeStatus` = '0' ORDER BY `diagnosisName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getInvestigations()
    {
        $details = "SELECT * FROM `investigations_list` WHERE `activeStatus` = '0' ORDER BY `investigationsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getInstructions()
    {
        $details = "SELECT * FROM `instructions_list` WHERE `activeStatus` = '0' ORDER BY `instructionsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getProcedures()
    {
        $details = "SELECT * FROM `procedures_list` WHERE `activeStatus` = '0' ORDER BY `proceduresName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    // public function getMedicines()
    // {
    //     $details = "SELECT * FROM `medicines_list` ORDER BY `medicineName` ";
    //     $select = $this->db->query($details);
    //     return $select->result_array();
    // }

    public function getAdvices()
    {
        $details = "SELECT * FROM `advices_list` WHERE `activeStatus` = '0' ORDER BY `adviceName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function insertNewSymptoms($name)
    {
        $this->db->insert('symptoms_list', ['symptomsName' => $name]);
        return $this->db->insert_id();
    }

    public function insertNewFindings($name)
    {
        $this->db->insert('findings_list', ['findingsName' => $name]);
        return $this->db->insert_id();
    }

    public function insertNewDiagnosis($name)
    {
        $this->db->insert('diagnosis_list', ['diagnosisName' => $name]);
        return $this->db->insert_id();
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

    // *************************************************************************
    // Consultation Section

    public function save_consultation()
    {
        $post = $this->input->post(null, true);
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $consultData = array(
            'patient_id' => $post['patientIdDb'],
            'doctor_id' => $hcpIdDb,
            'notes' => trim($post['notes']),
            'next_follow_up' => $post['nextFollowUpDate'],
        );

        $this->db->insert('consultations', $consultData);
        return $this->db->insert_id();
    }

    public function save_vitals($post)
    {
        $vitalData = array(
            'patient_id' => $post['patientIdDb'],
            'consultation_id' => $post['consultationId'],
            'weight_kg' => $post['patientWeight'],
            'height_cm' => $post['patientHeight'],
            'systolic_bp' => $post['patientSystolicBp'],
            'diastolic_bp' => $post['patientDiastolicBp'],
            'cholesterol_mg_dl' => $post['patientsCholestrol'],
            'blood_sugar_fasting' => $post['fastingBsugar'],
            'blood_sugar_pp' => $post['ppBsugar'],
            'blood_sugar_random' => $post['randomBsugar'],
            'spo2_percent' => $post['patientSpo2'],
            'temperature_f' => $post['patientTemperature'],
        );
        return $this->db->insert('patient_vitals', $vitalData);
    }

    public function save_symptom($data)
    {
        $this->db->insert('patient_symptoms', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_symptom($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('patient_symptoms', $data);
    }

    public function delete_removed_symptoms($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('patient_symptoms');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('patient_symptoms');
        }
    }

    public function save_finding($data)
    {
        $this->db->insert('patient_findings', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_finding($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('patient_findings', $data);
    }

    public function delete_removed_findings($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('patient_findings');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('patient_findings');
        }
    }

    public function save_diagnosis($data)
    {
        $this->db->insert('patient_diagnosis', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_diagnosis($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('patient_diagnosis', $data);
    }

    public function delete_removed_diagnosis($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('patient_diagnosis');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('patient_diagnosis');
        }
    }

    public function delete_investigations($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('patient_investigations');
    }

    public function save_investigation($post)
    {
        $investigations = $this->input->post('investigations');
        $rowsInserted = 0;
        if (!empty($investigations) && is_array($investigations)) {
            foreach ($investigations as $investigation) {
                $this->db->insert('patient_investigations', [
                    'consultation_id' => $post['consultationId'],
                    'investigation_name' => $investigation
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function delete_instructions($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('patient_instructions');
    }

    public function save_instruction($post)
    {
        $instructions = $this->input->post('instructions');
        $rowsInserted = 0;
        if (!empty($instructions) && is_array($instructions)) {
            foreach ($instructions as $instruction) {
                $this->db->insert('patient_instructions', [
                    'consultation_id' => $post['consultationId'],
                    'instruction_name' => $instruction
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function delete_procedures($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('patient_procedures');
    }

    public function save_procedure($post)
    {
        $procedures = $this->input->post('procedures');
        $rowsInserted = 0;
        if (!empty($procedures) && is_array($procedures)) {
            foreach ($procedures as $procedure) {
                $this->db->insert('patient_procedures', [
                    'consultation_id' => $post['consultationId'],
                    'procedure_name' => $procedure
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function delete_advices($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('patient_advices');
    }

    public function save_advice($post)
    {
        $advices = $this->input->post('advices');
        $rowsInserted = 0;
        if (!empty($advices) && is_array($advices)) {
            foreach ($advices as $advice) {
                $this->db->insert('patient_advices', [
                    'consultation_id' => $post['consultationId'],
                    'advice_name' => $advice
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function save_attachment($consultationId, $fileName)
    {
        $data = [
            'consultation_id' => $consultationId,
            'file_name' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('patient_attachments', $data);
    }

    public function getLastFileCounter($consultationId)
    {
        $this->db->select('file_name');
        $this->db->from('patient_attachments');
        $this->db->where('consultation_id', $consultationId);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $lastFile = $query->row()->file_name;
            preg_match('/_(\d+)\./', $lastFile, $matches);
            return isset($matches[1]) ? (int) $matches[1] : 0;
        }
        return 0;
    }

    public function get_consultations_by_patient($patient_id)
    {
        $this->db->select('*');
        $this->db->from('consultations');
        $this->db->where('patient_id', $patient_id);
        $this->db->order_by('created_at', 'DESC');
        $consultations = $this->db->get()->result_array();

        foreach ($consultations as &$consultation) {
            $consultation_id = $consultation['id'];

            // Vitals
            $consultation['vitals'] = $this->db
                ->get_where('patient_vitals', ['consultation_id' => $consultation_id])
                ->row_array();

            // Symptoms
            $consultation['symptoms'] = $this->db
                ->get_where('patient_symptoms', ['consultation_id' => $consultation_id])
                ->result_array();

            // Findings
            $consultation['findings'] = $this->db
                ->get_where('patient_findings', ['consultation_id' => $consultation_id])
                ->result_array();

            // Diagnosis
            $consultation['diagnosis'] = $this->db
                ->get_where('patient_diagnosis', ['consultation_id' => $consultation_id])
                ->result_array();

            // Investigations
            $consultation['investigations'] = $this->db
                ->get_where('patient_investigations', ['consultation_id' => $consultation_id])
                ->result_array();

            // Instructions
            $consultation['instructions'] = $this->db
                ->get_where('patient_instructions', ['consultation_id' => $consultation_id])
                ->result_array();

            // Procedures
            $consultation['procedures'] = $this->db
                ->get_where('patient_procedures', ['consultation_id' => $consultation_id])
                ->result_array();

            // Advices
            $consultation['advices'] = $this->db
                ->get_where('patient_advices', ['consultation_id' => $consultation_id])
                ->result_array();
        }

        return $consultations;
    }

    public function get_consultation_by_id($id)
    {
        $query = $this->db->get_where('consultations', array('id' => $id));
        return $query->row_array();
    }

    public function get_vitals_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_vitals', array('consultation_id' => $consultation_id));
        return $query->row_array();
    }

    public function get_symptoms_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_symptoms', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_findings_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_findings', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_diagnosis_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_diagnosis', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_investigations_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_investigations', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_instructions_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_instructions', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_procedures_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('patient_procedures', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_advices_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where(' patient_advices', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function update_consultation()
    {
        $post = $this->input->post(null, true);
        $consultData = array(
            'notes' => trim($post['notes']),
            'next_follow_up' => $post['nextFollowUpDate'],
        );
        $this->db->where('id', $post['consultationDbId']);
        $this->db->update('consultations', $consultData);
        return $post['consultationDbId'];
    }

    public function update_vitals($post)
    {
        $vitalData = array(
            'weight_kg' => $post['patientWeight'],
            'height_cm' => $post['patientHeight'],
            'systolic_bp' => $post['patientSystolicBp'],
            'diastolic_bp' => $post['patientDiastolicBp'],
            'cholesterol_mg_dl' => $post['patientsCholestrol'],
            'blood_sugar_fasting' => $post['fastingBsugar'],
            'blood_sugar_pp' => $post['ppBsugar'],
            'blood_sugar_random' => $post['randomBsugar'],
            'spo2_percent' => $post['patientSpo2'],
            'temperature_f' => $post['patientTemperature'],
        );
        $this->db->where('id', $post['vitalsDbId']);
        $this->db->update('patient_vitals', $vitalData);
        return true;
    }



}
