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
        $insert = array(
            'hcpName' => $post['hcpName'],
            'hcpMobile' => $post['hcpMobile'],
            'hcpMail' => $post['hcpEmail'],
            'hcpPassword' => $post['hcpCnfmPassword']
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
        $query = "SELECT * FROM hcp_details WHERE hcpMail = '$emailid' AND hcpPassword = '$password'";
        $count = $this->db->query($query);
        return $count->result_array();
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
        $details = "SELECT * FROM `cc_details`";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getCcDetails($ccIdDb)
    {
        $details = "SELECT * FROM `cc_details` WHERE `id`=$ccIdDb ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

}
?>