<?php
class CcModel extends CI_Model
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
            'doctorName' => $post['ccName'],
            'doctorMobile' => $post['ccMobile'],
            'doctorMail' => $post['ccEmail'],
            'specialization' => $post['ccSpec'],
            'doctorPassword' => $post['ccCnfmPassword'],
            'approvalStatus' => $approval
        );
        $this->db->insert('cc_details', $insert);
    }

    public function generateCcId()
    {
        $latest_customer_id = $this->getlastCcId();
        $last_four_digits = substr($latest_customer_id, -3);
        $incremented_id = str_pad((int) $last_four_digits + 1, 3, '0', STR_PAD_LEFT);
        $generate_id = "EDFCC{$incremented_id}";
        $insert = array(
            'ccId' => $generate_id
        );
        $MobileNumber = $this->input->post('ccMobile');
        $this->db->where('doctorMobile', $MobileNumber);
        $this->db->update('cc_details', $insert);
        return $generate_id;
    }

    public function getlastCcId()
    {
        $this->db->select('ccId');
        $this->db->from('cc_details');
        $this->db->order_by('ccId', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->ccId;
        } else {
            return 'EDFCC000';
        }
    }

    public function checkUserExistence($ccMobileNum)
    {
        $this->db->where('doctorMobile', $ccMobileNum);
        $query = $this->db->get('cc_details');
        return $query->num_rows() > 0;
    }

    public function changeNewPassword()
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'doctorPassword' => $post['ccCnfmPassword']
        );
        $this->db->where('doctorMobile', $post['ccMobileNum']);
        $this->db->update('cc_details', $updatedata);
    }

    public function ccLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['ccEmail'];
        $password = $postData['ccPassword'];
        $query = "SELECT * FROM cc_details WHERE doctorMail = '$emailid' AND doctorPassword = '$password'  AND deleteStatus = '0'";
        $count = $this->db->query($query);
        return $count->result_array();
    }

    public function addAppLinkCc($ccIdDb)
    {
        $post = $this->input->post(null, true);
        $updatedata = array(
            'gMeetLink' => $post['appLink']
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updatedata);
    }

    public function allPatientList()
    {
        $details = "SELECT * FROM `patient_details` ORDER BY `id` DESC";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentList()
    {
        $ccId = $_SESSION['ccId'];
        $details = "SELECT * FROM `appointment_details` WHERE `referalDoctor` = '$ccId' AND `appStatus` = '0' AND ( `dateOfAppoint` > CURDATE() OR ( `dateOfAppoint` = CURDATE() AND ADDTIME(`timeOfAppoint`, '00:10:00') >= CURTIME() ) ) ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function getAppointmentListDash()
    {
        $ccId = $_SESSION['ccIdDb'];
        $todayDate = date('Y-m-d');
        $details = "SELECT pd.id, pd.patientId, pd.firstName, pd.lastName , pd.mobileNumber , pd.gender , pd.age , pd.bloodGroup, pd.profilePhoto , pd.documentOne , pd.documentTwo, pd.lastAppDate,
        ad.referalDoctor, ad.referalDoctorDbId , ad.dateOfAppoint , ad.timeOfAppoint , ad.patientComplaint , ad.patientHcp
        FROM patient_details AS pd
        LEFT JOIN appointment_details AS ad ON pd.id = ad.patientDbId
        WHERE referalDoctorDbId = $ccId AND  `dateOfAppoint` = CURDATE()   AND `timeOfAppoint` >= CURTIME() ORDER BY `dateOfAppoint`, `timeOfAppoint`;";
        $select = $this->db->query($details);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
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

    public function getCcDetails()
    {
        $ccIdDb = $_SESSION['ccIdDb'];
        $details = "SELECT * FROM `cc_details` WHERE `id`=$ccIdDb";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function updateProfilePhoto()
    {
        $post = $this->input->post(null, true);
        $ccIdDb = $_SESSION['ccIdDb'];

        $config['upload_path'] = "./uploads/";
        $basepath = base_url() . 'uploads/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);


        if ($this->upload->do_upload('ccProfile')) {
            $data = $this->upload->data();
            $photo = $data['file_name'];
        } else {
            $error = $this->upload->display_errors();
        }

        $photoFileName = $basepath . $photo;

        $updatedata = array(
            'ccPhoto' => $photoFileName
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updatedata);
    }

    public function updateProfileDetails()
    {
        $post = $this->input->post(null, true);
        $ccIdDb = $_SESSION['ccIdDb'];
        $updatedata = array(
            'doctorName' => $post['drName'],
            'doctorMobile' => $post['drMobile'],
            'doctorMail' => $post['drEmail'],
            'doctorPassword' => $post['drPassword'],
            'yearOfExperience' => $post['yearOfExp'],
            'qualification' => $post['qualification'],
            'regDetails' => $post['regDetails'],
            'membership' => $post['membership'],
            'specialization' => $post['specialization'],
            'dateOfBirth' => $post['dob'],
            'services' => $post['services'],
            'hospitalName' => $post['hospitalName'],
            'location' => $post['location'],
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updatedata);
    }

}
?>