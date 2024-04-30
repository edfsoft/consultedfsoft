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
        $list = "SELECT * FROM `cc_details` WHERE deleteStatus = '0'";
        $select = $this->db->query($list);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function  ccAllDetails($ccId)
    {
        $details = "SELECT * FROM `cc_details` WHERE `id`= '$ccId' AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function approveCcDb($ccIdDb)
    {
        $updateStatus = array(
            'approvalStatus' => '1',
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updateStatus);
    }

    public function deleteCcDb($ccIdDb)
    {
        $updateStatus = array(
            'deleteStatus' => '1',
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updateStatus);
    }

    public function hcpList()
    {
        $list = "SELECT * FROM `hcp_details` WHERE deleteStatus = '0'";
        $select = $this->db->query($list);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function hcpAllDetails($hcpId)
    {
        $details = "SELECT * FROM `hcp_details` WHERE `id`= '$hcpId' AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function approveHcpDb($hcpIdDb)
    {
        $updateStatus = array(
            'approvalStatus' => '1',
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updateStatus);
    }

    public function deleteHcpDb($hcpIdDb)
    {
        $updateStatus = array(
            'deleteStatus' => '1',
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updateStatus);
    }

    public function patientList()
    {
        $list = "SELECT * FROM `patient_details` WHERE deleteStatus = '0'";
        $select = $this->db->query($list);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function  patientAllDetails($patientId)
    {
        $details = "SELECT * FROM `patient_details` WHERE `id`= '$patientId' AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }
   
    public function deletePatientDb($patientIdDb)
    {
        $updateStatus = array(
            'deleteStatus' => '1',
        );
        $this->db->where('id', $patientIdDb);
        $this->db->update('patient_details', $updateStatus);
    }

}
?>