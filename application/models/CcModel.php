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
        $insert = array(
            'doctorName' => $post['ccName'],
            'doctorMobile' => $post['ccMobile'],
            'doctorMail' => $post['ccEmail'],
            'doctorPassword' => $post['ccCnfmPassword']
        );
        $this->db->insert('cc_details', $insert);
    }

    public function checkUserExistence($ccMobileNum)
    {
        $this->db->where('doctorMobile', $ccMobileNum);
        $query = $this->db->get('cc_details');
        return $query->num_rows() > 0;
    }


    public function ccLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['ccEmail'];
        $password = $postData['ccPassword'];
        $query = "SELECT * FROM cc_details WHERE doctorMail = '$emailid' AND doctorPassword = '$password'";
        $count = $this->db->query($query);
        return $count->result_array();
    }

}
?>