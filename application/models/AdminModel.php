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

    public function getsymptomsList()
    {
        $list = "SELECT * FROM `symptoms_list` WHERE activeStatus = '0' ORDER BY `symptomsName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getFindingsList()
    {
        $list = "SELECT * FROM `findings_list` WHERE activeStatus = '0' ORDER BY `findingsName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getDiagnosisList()
    {
        $list = "SELECT * FROM `diagnosis_list` WHERE activeStatus = '0' ORDER BY `diagnosisName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getInvestigationsList()
    {
        $list = "SELECT * FROM `investigations_list` WHERE activeStatus = '0' ORDER BY `investigationsName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getInstructionsList()
    {
        $list = "SELECT * FROM `instructions_list` WHERE activeStatus = '0' ORDER BY `instructionsName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getProceduresList()
    {
        $list = "SELECT * FROM `procedures_list` WHERE activeStatus = '0' ORDER BY `proceduresName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function getAdvicesList()
    {
        $list = "SELECT * FROM `advices_list` WHERE activeStatus = '0' ORDER BY `adviceName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    public function saveMedicine()
    {
        $post = $this->input->post(null, true);

        $data = [
            'medicineName' => $post['medicineName'],
            'compositionName' => $post['medicineComposition'],
            'category' => $post['medicineCategory']
        ];

        if (!empty($post['medicineId'])) {
            $this->db->where('id', $post['medicineId']);
            return $this->db->update('medicines_list', $data);
        } else {
            return $this->db->insert('medicines_list', $data);
        }
    }

    public function medicineDelete($id)
    {
        $medicineId = $id;
        $this->db->where('id', $medicineId);
        $this->db->delete('medicines_list');
        return true;
    }

    public function getMedicinesList()
    {
        $list = "SELECT * FROM `medicines_list` WHERE activeStatus = '0' ORDER BY `medicineName`";
        $select = $this->db->query($list);
        return $select->result_array();
    }

    //Universal Add
    public function addListData($type, $name)
    {
        $config = [
            'specialization' => ['table' => 'specialization_list', 'field' => 'specializationName'],
            'symptoms' => ['table' => 'symptoms_list', 'field' => 'symptomsName'],
            'findings' => ['table' => 'findings_list', 'field' => 'findingsName'],
            'diagnosis' => ['table' => 'diagnosis_list', 'field' => 'diagnosisName'],
            'investigations' => ['table' => 'investigations_list', 'field' => 'investigationsName'],
            'instructions' => ['table' => 'instructions_list', 'field' => 'instructionsName'],
            'procedures' => ['table' => 'procedures_list', 'field' => 'proceduresName'],
            'advices' => ['table' => 'advices_list', 'field' => 'adviceName']
        ];

        if (!isset($config[$type])) {
            return false;
        }

        $insert = [$config[$type]['field'] => $name];

        return $this->db->insert($config[$type]['table'], $insert);
    }

    //Universal Edit
    public function updateListData($table, $id, $field, $name)
    {
        $this->db->where('id', $id);
        return $this->db->update($table, [$field => $name]);
    }


    // -------------------------------------------------------------------------------------------------------
    public function specilizationDelete($id)
    {
        $specilizationId = $id;
        $this->db->where('id', $specilizationId);
        $this->db->delete('specialization_list');
        return true;
    }

    public function symptomsDelete($id)
    {
        $symptomsId = $id;
        $this->db->where('id', $symptomsId);
        $this->db->delete('symptoms_list');
        return true;
    }

    public function findingsDelete($id)
    {
        $findingId = $id;
        $this->db->where('id', $findingId);
        $this->db->delete('findings_list');
        return true;
    }

    public function diagnosisDelete($id)
    {
        $findingId = $id;
        $this->db->where('id', $findingId);
        $this->db->delete('diagnosis_list');
        return true;
    }

    public function investigationDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('investigations_list');
        return true;
    }

    public function instructionDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('instructions_list');
        return true;
    }

    public function procedureDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('procedures_list');
        return true;
    }

    public function adviceDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('advices_list');
        return true;
    }
    // -------------------------------------------------------------------------------------------------------




}
?>