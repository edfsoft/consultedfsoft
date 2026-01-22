<?php
class PatientModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    // public function changeNewPassword()
    // {
    //     $post = $this->input->post(null, true);
    //     $updatedata = array(
    //         'hcpPassword' => password_hash($post['hcpCnfmPassword'], PASSWORD_BCRYPT),
    //     );
    //     $this->db->where('hcpMobile', $post['hcpMobileNum']);
    //     $this->db->update('hcp_details', $updatedata);
    //     return ($this->db->affected_rows() > 0);
    // }

    public function patientLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['patientEmail'];
        $password = $postData['patientPassword'];
        $query = "SELECT * FROM patient_details WHERE mailId = ? AND deleteStatus = '0'";
        $result = $this->db->query($query, array($emailid));
        $user = $result->row_array();

        $hashedPassword = $user['password'];
        if (password_verify($password, $hashedPassword)) {
            return $user;
        }
    }

    public function getPatientDetails()
    {
        $patientIdDb = $_SESSION['patientIdDb'];
        $details = "SELECT * FROM `patient_details` WHERE `id` = $patientIdDb";
        $select = $this->db->query($details);
        return $select->result_array();
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
