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

    // public function generatehcpid()
    // {
    //     $latest_customer_id = $this->getlasthcpid();
    //     $last_six_digits = substr($latest_customer_id, -6);
    //     $incremented_id = str_pad((int) $last_six_digits + 1, 6, '0', STR_PAD_LEFT);
    //     $generate_id = "ABC{$incremented_id}";
    //     $insert = array(
    //         'hcpid' => $generate_id
    //     );

    //     $MobileNumber = $this->input->post('phonenumber');
    //     $this->db->where('hcpMobile', $MobileNumber);
    //     $this->db->update('hcp_details', $insert);
    //     return $generate_id;
    // }

    // public function getlasthcpid()
    // {
    //     $this->db->select('idididid');
    //     $this->db->from('hcp_details');
    //     $this->db->order_by('idididid', 'DESC');
    //     $this->db->limit(1);

    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();
    //         return $row->eeid;
    //     } else {
    //         return 'ABC000000';
    //     }
    // }

    public function hcpLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['hcpEmail'];
        $password = $postData['hcpPassword'];
        $query = "SELECT * FROM hcp_details WHERE hcpMail = '$emailid' AND hcpPassword = '$password'";
        $count = $this->db->query($query);
        return $count->result_array();
    }

}
?>