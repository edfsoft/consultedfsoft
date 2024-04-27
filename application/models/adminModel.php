<?php
class AdminModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function adminLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['adminEmail'];
        $password = $postData['adminPassword'];
        $query = "SELECT * FROM edf_admin_details WHERE adminMailId = '$emailid' AND adminPassword = '$password'";
        $count = $this->db->query($query);
        return $count->result_array();
    }

    public function ccList()
    {
        $list = "SELECT * FROM `cc_details`";
        $select = $this->db->query($list);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

}
?>