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

    // New signup and admin add HCP
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
            'firstLoginPswd' => '1'
        );
        $this->db->where('hcpMobile', $post['hcpMobileNum']);
        $this->db->update('hcp_details', $updatedata);
        return ($this->db->affected_rows() > 0);
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

    public function getCompletedConsultByDate($hcpIdDb, $consultDate)
    {
        $this->db->select("
        MAX(c.id) AS consultationId,
        c.patient_id AS consultationPatientId,
        c.consult_date,
        c.consult_time,
        CONCAT(p.firstName, ' ', p.lastName) AS patientName,
        p.patientId,
        p.mobileNumber
    ");

        $this->db->from('consultations c');
        $this->db->join('patient_details p', 'p.id = c.patient_id', 'left');

        $this->db->where('c.doctor_id', $hcpIdDb);
        $this->db->where('DATE(c.consult_date)', $consultDate);

        $this->db->group_by('c.patient_id');

        $this->db->order_by('c.consult_time', 'ASC');

        return $this->db->get()->result_array();
    }

    public function getFollowUpConsult($hcpIdDb, $followUpDate = null)
    {
        $this->db->select("
        c.id AS consultationId, c.patient_id AS consultationPatientId,
        c.consult_date AS consult_date,
        c.consult_time AS consult_time,
        CONCAT(p.firstName, ' ', p.lastName) AS patientName,
        p.patientId,
        p.mobileNumber,
    ");
        $this->db->from('consultations c');
        $this->db->join('patient_details p', 'p.id = c.patient_id', 'left');
        $this->db->where('c.doctor_id', $hcpIdDb);

        if ($followUpDate) {
            $this->db->where('DATE(c.next_follow_up)', $followUpDate);
        }

        $this->db->group_by('c.id');
        $this->db->order_by('c.consult_time', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPatientList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `patient_details` WHERE `patientHcpDbId`=  $hcpIdDb AND `deleteStatus` = '0' ORDER BY `patientId` DESC";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function insertPatients($hashedPassword)
    {
        $post = $this->input->post(null, true);
        $enteredAge = (int) $post['patientAge'];
        $today = new DateTime();
        $derivedDob = $today->modify("-{$enteredAge} years")->format('Y-m-d');

        $insertdata = array(
            'firstName' => $post['patientName'],
            'lastName' => $post['patientLastName'],
            'mobileNumber' => $post['patientMobile'],
            'alternateMobile' => $post['patientAltMobile'],
            'mailId' => $post['patientEmail'],
            'gender' => $post['patientGender'],
            'age' => $post['patientAge'], /* Not in use - just save */
            'derived_dob' => $derivedDob,
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
            'patientHcp' => $_SESSION['hcpId'],
            'patientHcpDbId' => $_SESSION['hcpIdDb'],
            'password' => $hashedPassword,
            'firstLoginPswd' => '0',
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
        $correctedAge = (int) $post['patientAge'];
        $today = new DateTime();
        $newDerivedDob = $today->modify("-{$correctedAge} years")->format('Y-m-d');
        $updateData = array(
            'firstName' => $post['patientName'],
            'lastName' => $post['patientLastName'],
            'mobileNumber' => $post['patientMobile'],
            'alternateMobile' => $post['patientAltMobile'],
            'mailId' => $post['patientEmail'],
            'gender' => $post['patientGender'],
            // 'age' => $post['patientAge'],
            'derived_dob' => $newDerivedDob,
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

    /* public function generatePatientId($dbid)
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
    } */

    public function generatePatientId($dbid)
    {
        $next_number = $this->getFirstAvailableId();

        $incremented_id = str_pad($next_number, 6, '0', STR_PAD_LEFT);
        $generate_id = "EDF{$incremented_id}";

        $insert = array(
            'patientId' => $generate_id
        );

        $this->db->where('id', $dbid);
        $this->db->update('patient_details', $insert);

        return $generate_id;
    }

    public function getFirstAvailableId()
    {
        $this->db->select('patientId');
        $query = $this->db->get('patient_details');
        $existing_numbers = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $num = (int) substr($row->patientId, 3);
                $existing_numbers[] = $num;
            }

            sort($existing_numbers);
        }

        $expected = 1;
        foreach ($existing_numbers as $num) {
            if ($num == $expected) {
                $expected++;
            } else if ($num > $expected) {
                return $expected;
            }
        }

        return $expected;
    }

    public function getPatientDetails($id)
    {
        $details = "SELECT * FROM `patient_details` WHERE `id`= $id  AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    /* public function getAppointmentList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `appointment_details` WHERE `hcpDbId` = $hcpIdDb AND `appStatus` = '0' AND ( `dateOfAppoint` > CURDATE() OR ( `dateOfAppoint` = CURDATE() AND ADDTIME(`timeOfAppoint`, '00:10:00') >= CURTIME() ) ) ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    } */

    public function getAppointmentList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT a.*, p.firstName, p.lastName 
                    FROM `appointment_details` a
                    LEFT JOIN `patient_details` p ON a.patientDbId = p.id
                    WHERE a.hcpDbId = $hcpIdDb 
                    AND a.appStatus = '0' 
                    AND ( a.dateOfAppoint > CURDATE() 
                    OR ( a.dateOfAppoint = CURDATE() AND ADDTIME(a.timeOfAppoint, '00:20:00') >= CURTIME() ) ) 
                    ORDER BY a.dateOfAppoint, a.timeOfAppoint";

        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentTime()
    {
        $details = "SELECT * FROM `appointment_details` WHERE `appStatus` = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getPatientForAppointment()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `patient_details` WHERE `patientHcpDbId`=  $hcpIdDb AND deleteStatus = '0' 
        AND `mailId` != '' AND `mailId` != 'NULL' ORDER BY `patientId` DESC";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getTodayPendingCount()
    {
        date_default_timezone_set('Asia/Kolkata');
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $today = date('Y-m-d');
        $currentTime = date('H:i');
        $this->db->where('hcpDbId', $hcpIdDb);
        $this->db->where('dateOfAppoint', $today);
        $this->db->where('appStatus', '0');
        $this->db->where("ADDTIME(timeOfAppoint, '00:20:00') >=", $currentTime);
        return $this->db->count_all_results('appointment_details');
    }

    public function insertPartialPatient($data)
    {
        $this->db->insert('patient_details', $data);
        return $this->db->insert_id();
    }

    public function updatePatientId($id, $data)
    {
        $this->db->where('id', $id)->update('patient_details', $data);
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

    // Not in use
    // public function getAppMorTime()
    // {
    //     $details = "SELECT * FROM `morning_time` WHERE `status` = '0' ORDER BY `time` ASC";
    //     $select = $this->db->query($details);
    //     return $select->result_array();
    // }

    // public function getAppAfterTime()
    // {
    //     $details = "SELECT * FROM `afternoon_time` WHERE `status` = '0' ORDER BY `time` ASC ";
    //     $select = $this->db->query($details);
    //     return $select->result_array();
    // }

    // public function getAppEveTime()
    // {
    //     $details = "SELECT * FROM `evening_time` WHERE `status` = '0' ORDER BY `time` ASC ";
    //     $select = $this->db->query($details);
    //     return $select->result_array();
    // }

    // public function getAppNightTime()
    // {
    //     $details = "SELECT * FROM `night_time`WHERE `status` = '0' ORDER BY `time` ASC ";
    //     $select = $this->db->query($details);
    //     return $select->result_array();
    // }

    public function getAppointmentListDash()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT pd.id, pd.patientId, pd.firstName, pd.lastName , pd.mobileNumber , pd.gender , pd.age , pd.bloodGroup, pd.profilePhoto,
        ad.referalDoctor, ad.referalDoctorDbId , ad.dateOfAppoint , DATE_FORMAT(ad.timeOfAppoint, '%h:%i %p') AS timeOfAppoint12, ad.patientComplaint , ad.patientHcp, ad.appointmentType
        FROM patient_details AS pd
        LEFT JOIN appointment_details AS ad ON pd.id = ad.patientDbId
        WHERE hcpDbId = $hcpIdDb AND  `dateOfAppoint` = CURDATE()   AND `timeOfAppoint` >= CURTIME() ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    /* public function insertAppointment()
    {
        $post = $this->input->post(null, true);

        $ccId = 'Nil';
        $ccDbId = 'Nil';
        $appLink = 'https://meet.google.com/wzo-dprz-zqy';//link for only hcp
        $modeOfConsultant = 'Nil';
        if (!empty($post['patientId'])) {
            list($patientId, $dbId) = explode('|', $post['patientId']);
        } else {
            return false; // handle error
        }

        if (!empty($post['referalDoctor'])) {//If referal doctor has, insert cc & hcp meet link
            list($ccId, $ccDbId, $appLink) = explode('|', $post['referalDoctor']);
        }

        $insert = array(
            'patientId' => $patientId,
            'patientDbId' => $dbId,
            'referalDoctor' => $ccId,
            'appointmentLink' => $appLink,
            'referalDoctorDbId' => $ccDbId,
            'modeOfConsultant' => $modeOfConsultant,
            'dateOfAppoint' => $post['appDate'],
            'partOfDay' => $post['dayTime'],
            'timeOfAppoint' => $post['appTime'],
            'appointmentType' => $post['appointmentType'],
            'patientComplaint' => $post['appReason'],
            'patientHcp' => $_SESSION['hcpId'],
            'hcpDbId' => $_SESSION['hcpIdDb'],
        );

        // 5. Insert
        $this->db->insert('appointment_details', $insert);
        return $this->db->insert_id();
    } */

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

    public function delete_appointment($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('appointment_details');
    }

    //Get Appointment details 
    public function getAppointmentAndPatientDetails($appointmentId)
    {
        $this->db->select('
            a.id as appointmentId,
            a.dateOfAppoint, 
            a.timeOfAppoint, 
            a.appointmentLink, 
            a.appointmentType,
            p.firstName, 
            p.lastName, 
            p.mailId
        ');
        $this->db->from('appointment_details a');
        $this->db->join('patient_details p', 'p.id = a.patientDbId', 'left');
        $this->db->where('a.id', $appointmentId);

        return $this->db->get()->row_array();
    }

    //Update Appointments
    public function updateAppointment()
    {
        $post = $this->input->post(null, true);

        $updatedata = array(
            'modeOfConsultant' => $post['appConsult'],
            'dateOfAppoint' => $post['appDate'],
            //'partOfDay' => $post['dayTime'],
            'timeOfAppoint' => date('H:i', strtotime($post['appTime'])),
            'appStatus' => "0"
        );
        $this->db->where('id', $post['appTableId']);
        $this->db->update('appointment_details', $updatedata);
        return true;
    }


    public function getHcpDetails()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `hcp_details` WHERE `id` = $hcpIdDb";
        $select = $this->db->query($details);
        return $select->result_array();
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

            $formattedId = str_pad($hcpIdDb, 2, '0', STR_PAD_LEFT);
            $fileName = 'hcp_profile_' . $formattedId . '.' . $ext;
            $targetPath = $uploadPath . $fileName;

            if (!move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $targetPath)) {
                return false;
            }
            $this->db->where('id', $hcpIdDb);
            $this->db->update('hcp_details', ['hcpPhoto' => $fileName]);
        }

        return true;
    }

    public function updateNewPassword()/* Password chnage after login */
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'hcpPassword' => password_hash($post['drCnfmPassword'], PASSWORD_BCRYPT),
            'firstLoginPswd' => '1'
        );
        $this->db->where('id', $post['hcpDbId']);
        $this->db->update('hcp_details', $updatedata);
        return ($this->db->affected_rows() > 0);
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


    function generateMeetingID()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz'; // Google Meet uses lowercase letters

        // Generate 3 random letters for the first part
        $part1 = substr(str_shuffle($chars), 0, 3);
        // Generate 4 random letters for the middle part
        $part2 = substr(str_shuffle($chars), 0, 4);
        // Generate 3 random letters for the last part
        $part3 = substr(str_shuffle($chars), 0, 3);

        return $part1 . '-' . $part2 . '-' . $part3; // Result: wzo-dprz-zqy
    }

    public function insertAppointment()
    {
        $post = $this->input->post(null, true);

        $ccId = 'Nil';
        $ccDbId = 'Nil';
        $appLink = $this->generateMeetingID();//link for only hcp
        //$modeOfConsultant = 'Nil';
        if (!empty($post['patientId'])) {
            list($patientId, $dbId) = explode('|', $post['patientId']);
        } else {
            return false; // handle error
        }

        if (!empty($post['referalDoctor'])) {//If referal doctor has, insert cc & hcp meet link
            list($ccId, $ccDbId) = explode('|', $post['referalDoctor']);
        }

        $insert = array(
            'patientId' => $patientId,
            'patientDbId' => $dbId,
            'referalDoctor' => $ccId,
            'appointmentLink' => $appLink,
            'referalDoctorDbId' => $ccDbId,
            'modeOfConsultant' => $post['appConsult'],
            'dateOfAppoint' => $post['appDate'],
            /* 'partOfDay' => $post['dayTime'], */
            'timeOfAppoint' => date('H:i', strtotime($post['appTime'])),
            'appointmentType' => $post['appointmentType'],
            'patientComplaint' => $post['appReason'],
            'patientHcp' => $_SESSION['hcpId'],
            'hcpDbId' => $_SESSION['hcpIdDb'],
        );

        // 5. Insert
        $this->db->insert('appointment_details', $insert);
        return $this->db->insert_id();
    }

    public function update_appointment_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('appointment_details', ['appStatus' => $status]);
    }


}
