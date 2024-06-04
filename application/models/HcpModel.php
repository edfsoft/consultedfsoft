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
            'hcpPassword' => $post['hcpCnfmPassword'],
            'approvalStatus' => $approval
        );
        $this->db->insert('hcp_details', $insert);
    }

    public function checkUserExistence($hcpMobileNum)
    {
        $this->db->where('hcpMobile', $hcpMobileNum);
        $query = $this->db->get('hcp_details');
        return $query->num_rows() > 0;
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

    public function hcpLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['hcpEmail'];
        $password = $postData['hcpPassword'];
        $query = "SELECT * FROM hcp_details WHERE hcpMail = '$emailid' AND hcpPassword = '$password' AND deleteStatus = '0'";
        $count = $this->db->query($query);
        return $count->result_array();
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
            'bloodPressure' => $post['patientBp'],
            'cholestrol' => $post['patientsCholestrol'],
            'bloodSugar' => $post['patientBsugar'],
            'diagonsis	' => $post['patientDiagonsis'],
            'symptoms' => $post['patientSymptoms'],
            'medicines	' => $post['patientMedicines'],
            'documentOne' => $firstDocument,
            'documentTwo' => $secondDocument,
            'patientHcp	' => $_SESSION['hcpId'],
            'patientHcpDbId	' => $_SESSION['hcpIdDb'],
        );
        $this->db->insert('patient_details', $insertdata);
    }

    public function updatePatients()
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
            'bloodPressure' => $post['patientBp'],
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
    }

    public function updatePatientProfile()
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

    public function insertappointment()
    {
        $post = $this->input->post(null, true);
        list($patientId, $dbId) = explode('|', $post['patientId']);
        list($ccId, $ccDbId) = explode('|', $post['referalDoctor']);
        $insert = array(
            'patientId' => $patientId,
            'patientDbId' => $dbId,
            'referalDoctor' => $ccId,
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
    }

    public function getAppointmentList()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $details = "SELECT * FROM `appointment_details` WHERE `hcpDbId`=  $hcpIdDb ORDER BY `dateOfAppoint`, `timeOfAppoint`";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentListDash()
    {
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $todayDate = date('Y-m-d');
        $details = "SELECT pd.id, pd.patientId, pd.firstName, pd.lastName , pd.mobileNumber , pd.gender , pd.age , pd.bloodGroup, pd.profilePhoto , pd.documentOne , pd.documentTwo,
        ad.referalDoctor, ad.referalDoctorDbId , ad.dateOfAppoint , ad.timeOfAppoint , ad.patientComplaint , ad.patientHcp
        FROM patient_details AS pd
        LEFT JOIN appointment_details AS ad ON pd.id = ad.patientDbId
        WHERE hcpDbId = $hcpIdDb  AND dateOfAppoint = '$todayDate';";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
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
    }

    public function updateProfileDetails()
    {
        $post = $this->input->post(null, true);
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $updatedata = array(
            'hcpName' => $post['drName'],
            'hcpMobile' => $post['drMobile'],
            'hcpMail' => $post['drEmail'],
            'hcpPassword' => $post['drPassword'],
            'hcpExperience' => $post['yearOfExp'],
            'hcpQualification' => $post['qualification'],
            'hcpSpecialization' => $post['specialization'],
            'hcpDob' => $post['dob'],
            'hcpHospitalName' => $post['hospitalName'],
            'hcpLocation' => $post['location'],
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updatedata);
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

    public function getSymptoms()
    {
        $details = "SELECT * FROM `symptoms_list` ORDER BY `id` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    // public function do_upload()
    // {
    //     $config['upload_path'] = "./uploads/";
    //     $config['allowed_types'] = "jpg|png|pdf";
    //     $config['max_size'] = 1024;

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('file')) {
    //         $data = $this->upload->data();
    //     } else {
    //         $error = $this->upload->display_errors();
    //     }
    // }

}
?>