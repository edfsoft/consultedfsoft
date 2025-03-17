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

    public function ccAllDetails($ccId)
    {
        $details = "SELECT * FROM `cc_details` WHERE `id`= '$ccId' AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function approveCcDb($ccIdDb)
    {
        $postData = $this->input->post(null, true);
        $updateStatus = array(
            'approvalStatus' => $postData['approveCc'],
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updateStatus);
        return true;
    }

    public function deleteCcDb($ccIdDb)
    {
        $updateStatus = array(
            'deleteStatus' => '1',
        );
        $this->db->where('id', $ccIdDb);
        $this->db->update('cc_details', $updateStatus);
        return true;
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
        $postData = $this->input->post(null, true);
        $updateStatus = array(
            'approvalStatus' => $postData['approveHcp'],
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updateStatus);
        return true;
    }

    public function deleteHcpDb($hcpIdDb)
    {
        $updateStatus = array(
            'deleteStatus' => '1',
        );
        $this->db->where('id', $hcpIdDb);
        $this->db->update('hcp_details', $updateStatus);
        return true;
    }

    public function patientList()
    {
        $list = "SELECT * FROM `patient_details` WHERE deleteStatus = '0'";
        $select = $this->db->query($list);
        return array("response" => $select->result_array(), "totalRows" => $select->num_rows());
    }

    public function patientAllDetails($patientId)
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
        return true;
    }

    public function getSpecializationList()
    {
        $list = "SELECT * FROM `specialization_list` WHERE activeStatus = '0' ORDER BY `specializationName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function newSpecilization()
    {
        $post = $this->input->post(null, true);
        $insert = array(
            'specializationName' => $post['specializationName'],
        );
        $this->db->insert('specialization_list', $insert);
        return true;
    }

    public function specilizationDelete($id)
    {
        $specilizationId = $id;
        // $update = array(
        //     'activeStatus' => '1',
        // );
        // $this->db->where('id', $specilizationId);
        // $this->db->update('specialization_list', $update);
        $this->db->where('id', $specilizationId);
        $this->db->delete('specialization_list');
        return true;
    }

    public function newSymptoms()
    {
        $post = $this->input->post(null, true);
        $insert = array(
            'symptomsName' => $post['symptomsName'],
        );
        $this->db->insert('symptoms_list', $insert);
        return true;
    }

    public function getsymptomsList()
    {
        $list = "SELECT * FROM `symptoms_list` WHERE activeStatus = '0' ORDER BY `symptomsName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function symptomsDelete($id)
    {
        $symptomsId = $id;
        $this->db->where('id', $symptomsId);
        $this->db->delete('symptoms_list');
        return true;
    }

    public function newMedicine()
    {
        $post = $this->input->post(null, true);
        $insert = array(
            'medicineBrand' => $post['medicineNameBrand'],
            'medicineName' => $post['medicineName'],
            'strength' => $post['maedicineStrength']
        );
        $this->db->insert('medicines_list', $insert);
        return true;
    }

    public function getMedicinesList()
    {
        $list = "SELECT * FROM `medicines_list` WHERE activeStatus = '0' ORDER BY `medicineName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function medicineDelete($id)
    {
        $medicineId = $id;
        $this->db->where('id', $medicineId);
        $this->db->delete('medicines_list');
        return true;
    }



}
?>