<?php
class PatientModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_otp($email)
    {
        $otp = rand(1000, 9999);
        $hashed_otp = password_hash($otp, PASSWORD_BCRYPT);
        date_default_timezone_set('Asia/Kolkata');
        $expiry_time = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        $this->db->where('email', $email)->delete('password_resets');

        $data = [
            'email' => $email,
            'otp' => $hashed_otp,
            'expires_at' => $expiry_time,
            'is_used' => 0
        ];
        $this->db->insert('password_resets', $data);

        return $otp;
    }

    public function validate_otp($email, $otp)
    {
        date_default_timezone_set('Asia/Kolkata');

        $this->db->where('email', $email);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('password_resets');
        $record = $query->row();
        $expires_at_timestamp = strtotime($record->expires_at);
        $current_timestamp = time();

        if ($expires_at_timestamp < $current_timestamp) {
            return ['status' => false, 'reason' => 'OTP expired'];
        }
        if (password_verify($otp, $record->otp)) {
            return ['status' => true];
        } else {
            return ['status' => false, 'reason' => 'Invalid OTP'];
        }
    }

    public function changeNewPassword()
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'password' => password_hash($post['patientCnfmPassword'], PASSWORD_BCRYPT),
            'firstLoginPswd' => '1'
        );
        $this->db->where('mailId', $post['mailId']);
        $this->db->where('patientId', $post['patientId']);
        $this->db->update('patient_details', $updatedata);
        return ($this->db->affected_rows() > 0);
    }

    public function patientLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['patientEmail'];
        $id = $postData['patientId'];
        $password = $postData['patientPassword'];
        $user = $this->db
            ->where('mailId', $emailid)
            ->where('patientId', $id)
            ->where('deleteStatus', '0')
            ->get('patient_details')
            ->row_array();

        $hashedPassword = $user['password'];
        if (password_verify($password, $hashedPassword)) {
            return $user;
        }
    }

    public function get_consultations_by_patient($patient_id)
    {
        $this->db->select('*');
        $this->db->from('consultations');
        $this->db->where('patient_id', $patient_id);
        // $this->db->order_by('created_at', 'DESC');
        $this->db->order_by('consult_date', 'DESC');
        $this->db->order_by('consult_time', 'DESC');
        $consultations = $this->db->get()->result_array();

        if (empty($consultations)) {
            return [];
        }

        $consultation_ids = array_column($consultations, 'id');

        // Batch query sub-tables
        $vitals = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_vitals')->result_array();
        $symptoms = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_symptoms')->result_array();
        $findings = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_findings')->result_array();
        $diagnosis = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_diagnosis')->result_array();
        $investigations = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_investigations')->result_array();
        $instructions = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_instructions')->result_array();
        $procedures = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_procedures')->result_array();
        $advices = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_advices')->result_array();
        
        $this->db->order_by('order_position', 'ASC');
        $medicines = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_medicines')->result_array();
        
        $attachments = $this->db->where_in('consultation_id', $consultation_ids)->get('consult_attachments')->result_array();

        // Index the results in PHP memory
        $vitals_by_c = [];
        foreach ($vitals as $v) {
            $vitals_by_c[$v['consultation_id']] = $v;
        }

        $symptoms_by_c = [];
        foreach ($symptoms as $s) {
            $symptoms_by_c[$s['consultation_id']][] = $s;
        }

        $findings_by_c = [];
        foreach ($findings as $f) {
            $findings_by_c[$f['consultation_id']][] = $f;
        }

        $diagnosis_by_c = [];
        foreach ($diagnosis as $d) {
            $diagnosis_by_c[$d['consultation_id']][] = $d;
        }

        $investigations_by_c = [];
        foreach ($investigations as $i) {
            $investigations_by_c[$i['consultation_id']][] = $i;
        }

        $instructions_by_c = [];
        foreach ($instructions as $in) {
            $instructions_by_c[$in['consultation_id']][] = $in;
        }

        $procedures_by_c = [];
        foreach ($procedures as $pr) {
            $procedures_by_c[$pr['consultation_id']][] = $pr;
        }

        $advices_by_c = [];
        foreach ($advices as $ad) {
            $advices_by_c[$ad['consultation_id']][] = $ad;
        }

        $medicines_by_c = [];
        foreach ($medicines as $m) {
            $medicines_by_c[$m['consultation_id']][] = $m;
        }

        $attachments_by_c = [];
        foreach ($attachments as $at) {
            $attachments_by_c[$at['consultation_id']][] = $at;
        }

        // Map grouped entries back into the consultations array structure
        foreach ($consultations as &$consultation) {
            $consultation_id = $consultation['id'];

            $consultation['vitals'] = isset($vitals_by_c[$consultation_id]) ? $vitals_by_c[$consultation_id] : null;
            $consultation['symptoms'] = isset($symptoms_by_c[$consultation_id]) ? $symptoms_by_c[$consultation_id] : [];
            $consultation['findings'] = isset($findings_by_c[$consultation_id]) ? $findings_by_c[$consultation_id] : [];
            $consultation['diagnosis'] = isset($diagnosis_by_c[$consultation_id]) ? $diagnosis_by_c[$consultation_id] : [];
            $consultation['investigations'] = isset($investigations_by_c[$consultation_id]) ? $investigations_by_c[$consultation_id] : [];
            $consultation['instructions'] = isset($instructions_by_c[$consultation_id]) ? $instructions_by_c[$consultation_id] : [];
            $consultation['procedures'] = isset($procedures_by_c[$consultation_id]) ? $procedures_by_c[$consultation_id] : [];
            $consultation['advices'] = isset($advices_by_c[$consultation_id]) ? $advices_by_c[$consultation_id] : [];
            $consultation['medicines'] = isset($medicines_by_c[$consultation_id]) ? $medicines_by_c[$consultation_id] : [];
            $consultation['attachments'] = isset($attachments_by_c[$consultation_id]) ? $attachments_by_c[$consultation_id] : [];
        }

        return $consultations;
    }

    public function getPatientDetails()
    {
        $patientIdDb = $_SESSION['patientIdDb'];
        $details = "SELECT * FROM `patient_details` WHERE `id` = $patientIdDb";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getTodayPendingCount()
    {
        date_default_timezone_set('Asia/Kolkata');
        $patientIdDb = $_SESSION['patientIdDb'];
        $today = date('Y-m-d');
        $currentTime = date('H:i');
        $this->db->where('patientDbId', $patientIdDb);
        $this->db->where('appointmentType', 'PATIENT');
        $this->db->where('dateOfAppoint', $today);
        $this->db->where('appStatus', '0');
        $this->db->where("ADDTIME(timeOfAppoint, '00:20:00') >=", $currentTime);
        return $this->db->count_all_results('appointment_details');
    }

    public function getAppointmentList()
    {
        $patientIdDb = $_SESSION['patientIdDb'];
        $details = "SELECT * FROM `appointment_details` WHERE `patientDbId` = '$patientIdDb' AND `appointmentType` = 'PATIENT' AND `appStatus` = '0' AND ( `dateOfAppoint` > CURDATE() OR 
        ( `dateOfAppoint` = CURDATE() AND ADDTIME(`timeOfAppoint`, '00:20:00') >= CURTIME() ) ) ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function updateProfileDetails()
    {
        $post = $this->input->post(null, true);
        $updateData = array(
            // 'firstName' => $post['patientName'],
            // 'lastName' => $post['patientLastName'],
            // 'mobileNumber' => $post['patientMobile'],
            // 'alternateMobile' => $post['patientAltMobile'],
            // 'mailId' => $post['patientEmail'],
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

    public function updateNewPassword()/* Password change after login */
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'password' => password_hash($post['patientCnfmPassword'], PASSWORD_BCRYPT),
            'firstLoginPswd' => '1'
        );
        $this->db->where('id', $post['patientDbId']);
        $this->db->update('patient_details', $updatedata);
        return ($this->db->affected_rows() > 0);
    }

    public function getHcpProfile()
    {
        $details = "SELECT * FROM `hcp_details` WHERE deleteStatus = '0' AND approvalStatus = '1'";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getHcpDetails($hcpIdDb)
    {
        $details = "SELECT * FROM `hcp_details` WHERE `id`=$hcpIdDb  AND deleteStatus = '0' AND approvalStatus = '1'";
        $select = $this->db->query($details);
        return $select->result_array();
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





}
