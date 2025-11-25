<?php
class ConsultModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPatientDetails($id)
    {
        $details = "SELECT * FROM `patient_details` WHERE `id`= $id  AND deleteStatus = '0'";
        $select = $this->db->query($details);
        return $select->result_array();
    }

/*     public function getSymptoms()
    {
        $details = "SELECT * FROM `symptoms_list` WHERE `activeStatus` = '0' ORDER BY `symptomsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */


/*     public function getFindings()
    {
        $details = "SELECT * FROM `findings_list` WHERE `activeStatus` = '0' ORDER BY `findingsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function getDiagnosis()
    {
        $details = "SELECT * FROM `diagnosis_list` WHERE `activeStatus` = '0' ORDER BY `diagnosisName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function getInvestigations()
    {
        $details = "SELECT * FROM `investigations_list` WHERE `activeStatus` = '0' ORDER BY `investigationsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

    /* public function getInstructions()
    {
        $details = "SELECT * FROM `instructions_list` WHERE `activeStatus` = '0' ORDER BY `instructionsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function getProcedures()
    {
        $details = "SELECT * FROM `procedures_list` WHERE `activeStatus` = '0' ORDER BY `proceduresName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function getMedicines()
    {
        $details = "SELECT * FROM `medicines_list` ORDER BY `medicineName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function getAdvices()
    {
        $details = "SELECT * FROM `advices_list` WHERE `activeStatus` = '0' ORDER BY `adviceName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    } */

/*     public function insertNewSymptoms($name)
    {
        $this->db->insert('symptoms_list', ['symptomsName' => $name]);
        return $this->db->insert_id();
    } */

/*     public function insertNewFindings($name)
    {
        $this->db->insert('findings_list', ['findingsName' => $name]);
        return $this->db->insert_id();
    } */

    
/*     public function insertNewDiagnosis($name)
    {
        $this->db->insert('diagnosis_list', ['diagnosisName' => $name]);
        return $this->db->insert_id();
    } */

/*     public function insertNewInvestigations($name)
    {
        $this->db->insert('investigations_list', ['investigationsName' => $name]);
        return $this->db->insert_id();
    } */

    // Save Consultation
    public function save_consultation()
    {
        $post = $this->input->post(null, true);
        $hcpIdDb = $_SESSION['hcpIdDb'];
        $consultData = array(
            'consult_date' => $post['consultDate'],
            'consult_time' => $post['consultTime'],
            'patient_id' => $post['patientIdDb'],
            'doctor_id' => $hcpIdDb,
            'notes' => trim($post['notes']),
            'next_follow_up' => $post['nextFollowUpDate'],
        );

        $this->db->insert('consultations', $consultData);
        return $this->db->insert_id();
    }

    public function update_consultation()
    {
        $post = $this->input->post(null, true);
        $consultData = array(
            'consult_date' => $post['consultDate'],
            'consult_time' => $post['consultTime'],
            'notes' => trim($post['notes']),
            'next_follow_up' => $post['nextFollowUpDate'],
        );
        $this->db->where('id', $post['consultationDbId']);
        $this->db->update('consultations', $consultData);
        return $post['consultationDbId'];
    }

    public function save_vitals($post)
    {
        $vitalData = array(
            'patient_id' => $post['patientIdDb'],
            'consultation_id' => $post['consultationId'],
            'weight_kg' => $post['patientWeight'],
            'height_cm' => $post['patientHeight'],
            'systolic_bp' => $post['patientSystolicBp'],
            'diastolic_bp' => $post['patientDiastolicBp'],
            'HbA1c_percent' => $post['patientsHbA1c'],
            'blood_sugar_fasting' => $post['fastingBsugar'],
            'blood_sugar_pp' => $post['ppBsugar'],
            'blood_sugar_random' => $post['randomBsugar'],
            'spo2_percent' => $post['patientSpo2'],
            'pulse_rate' => $post['patientPulseRate'],
            'temperature_f' => $post['patientTemperature'],
        );
        return $this->db->insert('consult_vitals', $vitalData);
    }

    public function update_vitals($post)
    {
        $vitalData = array(
            'weight_kg' => $post['patientWeight'],
            'height_cm' => $post['patientHeight'],
            'systolic_bp' => $post['patientSystolicBp'],
            'diastolic_bp' => $post['patientDiastolicBp'],
            'HbA1c_percent' => $post['patientsHbA1c'],
            'blood_sugar_fasting' => $post['fastingBsugar'],
            'blood_sugar_pp' => $post['ppBsugar'],
            'blood_sugar_random' => $post['randomBsugar'],
            'spo2_percent' => $post['patientSpo2'],
            'pulse_rate' => $post['patientPulseRate'],
            'temperature_f' => $post['patientTemperature'],
        );
        $this->db->where('id', $post['vitalsDbId']);
        $this->db->update('consult_vitals', $vitalData);
        return true;
    }

    public function save_symptom($data)
    {
        $this->db->insert('consult_symptoms', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_symptom($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consult_symptoms', $data);
    }

    public function delete_removed_symptoms($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('consult_symptoms');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('consult_symptoms');
        }
    }

    public function save_finding($data)
    {
        $this->db->insert('consult_findings', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_finding($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consult_findings', $data);
    }

    public function delete_removed_findings($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('consult_findings');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('consult_findings');
        }
    }

    public function save_diagnosis($data)
    {
        $this->db->insert('consult_diagnosis', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_diagnosis($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consult_diagnosis', $data);
    }

    public function delete_removed_diagnosis($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('consult_diagnosis');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('consult_diagnosis');
        }
    }

    public function delete_investigations($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('consult_investigations');
    }

    public function save_investigation($data)
    {
        $this->db->insert('consult_investigations', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_investigation($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consult_investigations', $data);
    }

    public function delete_removed_investigations($consultationId, $keepIds)
    {
        if (empty($keepIds)) {
            $this->db->where('consultation_id', $consultationId);
            $this->db->delete('consult_investigations');
        } else {
            $this->db->where('consultation_id', $consultationId);
            $this->db->where_not_in('id', $keepIds);
            $this->db->delete('consult_investigations');
        }
    }

    public function delete_instructions($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('consult_instructions');
    }

    public function save_instruction($post)
    {
        $instructions = $this->input->post('instructions');
        $rowsInserted = 0;
        if (!empty($instructions) && is_array($instructions)) {
            foreach ($instructions as $instruction) {
                $this->db->insert('consult_instructions', [
                    'consultation_id' => $post['consultationId'],
                    'instruction_name' => $instruction
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function delete_procedures($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('consult_procedures');
    }

    public function save_procedure($post)
    {
        $procedures = $this->input->post('procedures');
        $rowsInserted = 0;
        if (!empty($procedures) && is_array($procedures)) {
            foreach ($procedures as $procedure) {
                $this->db->insert('consult_procedures', [
                    'consultation_id' => $post['consultationId'],
                    'procedure_name' => $procedure
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function delete_advices($consultationId)
    {
        $this->db->where('consultation_id', $consultationId);
        return $this->db->delete('consult_advices');
    }

    public function save_advice($post)
    {
        $advices = $this->input->post('advices');
        $rowsInserted = 0;
        if (!empty($advices) && is_array($advices)) {
            foreach ($advices as $advice) {
                $this->db->insert('consult_advices', [
                    'consultation_id' => $post['consultationId'],
                    'advice_name' => $advice
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rowsInserted++;
                }
            }
        }
        return ($rowsInserted > 0);
    }

    public function save_medicine($data)
    {
        $this->db->insert('consult_medicines', $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function update_medicine($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consult_medicines', $data);
    }

    public function delete_removed_medicines($consultation_id, $existingIds)
    {
        if (!empty($existingIds)) {
            $this->db->where('consultation_id', $consultation_id);
            $this->db->where_not_in('id', $existingIds);
            $this->db->delete('consult_medicines');
        } else {
            $this->db->where('consultation_id', $consultation_id);
            $this->db->delete('consult_medicines');
        }
    }

    public function save_attachment($consultationId, $fileName)
    {
        $data = [
            'consultation_id' => $consultationId,
            'file_name' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('consult_attachments', $data);
    }

    public function getLastAttachmentCounter($consultationId)
    {
        $this->db->select('file_name');
        $this->db->from('consult_attachments');
        $this->db->where('consultation_id', $consultationId);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $lastFile = $query->row()->file_name;
            preg_match('/_(\d+)\./', $lastFile, $matches);
            return isset($matches[1]) ? (int) $matches[1] : 0;
        }
        return 0;
    }

    public function deleteAttachment($consultationId, $fileName)
    {
        $this->db->where('consultation_id', $consultationId);
        $this->db->where('file_name', $fileName);
        $this->db->delete('consult_attachments');
    }

    // All consultation details by patient id
    public function get_consultations_by_patient($patient_id)
    {
        $this->db->select('*');
        $this->db->from('consultations');
        $this->db->where('patient_id', $patient_id);
        $this->db->order_by('created_at', 'DESC');
        $consultations = $this->db->get()->result_array();

        foreach ($consultations as &$consultation) {
            $consultation_id = $consultation['id'];

            // Vitals
            $consultation['vitals'] = $this->db
                ->get_where('consult_vitals', ['consultation_id' => $consultation_id])
                ->row_array();

            // Symptoms
            $consultation['symptoms'] = $this->db
                ->get_where('consult_symptoms', ['consultation_id' => $consultation_id])
                ->result_array();

            // Findings
            $consultation['findings'] = $this->db
                ->get_where('consult_findings', ['consultation_id' => $consultation_id])
                ->result_array();

            // Diagnosis
            $consultation['diagnosis'] = $this->db
                ->get_where('consult_diagnosis', ['consultation_id' => $consultation_id])
                ->result_array();

            // Investigations
            $consultation['investigations'] = $this->db
                ->get_where('consult_investigations', ['consultation_id' => $consultation_id])
                ->result_array();

            // Instructions
            $consultation['instructions'] = $this->db
                ->get_where('consult_instructions', ['consultation_id' => $consultation_id])
                ->result_array();

            // Procedures
            $consultation['procedures'] = $this->db
                ->get_where('consult_procedures', ['consultation_id' => $consultation_id])
                ->result_array();

            // Advices
            $consultation['advices'] = $this->db
                ->get_where('consult_advices', ['consultation_id' => $consultation_id])
                ->result_array();

            // Medicines
            $consultation['medicines'] = $this->db
                ->get_where('consult_medicines', ['consultation_id' => $consultation_id])
                ->result_array();

            // Attachments
            $consultation['attachments'] = $this->db
                ->get_where('consult_attachments', ['consultation_id' => $consultation_id])
                ->result_array();
        }

        return $consultations;
    }

    public function get_consultation_by_id($id)
    {
        $query = $this->db->get_where('consultations', array('id' => $id));
        return $query->row_array();
    }

    public function get_vitals_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_vitals', array('consultation_id' => $consultation_id));
        return $query->row_array();
    }

    public function get_symptoms_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_symptoms', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_findings_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_findings', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_diagnosis_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_diagnosis', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_investigations_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_investigations', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_instructions_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_instructions', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_procedures_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where('consult_procedures', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_advices_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where(' consult_advices', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_medicines_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where(' consult_medicines', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    public function get_attachments_by_consultation_id($consultation_id)
    {
        $query = $this->db->get_where(' consult_attachments', array('consultation_id' => $consultation_id));
        return $query->result_array();
    }

    // Delete Consultation Permanently
    public function delete_consultation($consultation_id)
    {
        $this->db->trans_start();

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_vitals');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_symptoms');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_findings');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_diagnosis');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_investigations');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_instructions');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_procedures');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_advices');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_medicines');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_medicines');

        $this->db->where('consultation_id', $consultation_id);
        $this->db->delete('consult_attachments');

        $this->db->where('id', $consultation_id);
        $this->db->delete('consultations');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }


    
    /* Symptoms in consultaion form */
    public function getSymptoms()
{
    // 1. Get the Logged-in User's Alphanumeric ID (e.g., 'EDFHCP0001')
    $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
    $myHcpIdString = '';

    if ($hcpIdDb > 0) {
        $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
        if ($user) {
            $myHcpIdString = $user['hcpId'];
        }
    }

    // 2. Get ALL active symptoms (No filtering by user here, so everyone sees everything)
    $this->db->select('*');
    $this->db->from('symptoms_list');
    $this->db->where('activeStatus', '0');
    $this->db->order_by('symptomsName', 'ASC');
    $query = $this->db->get();
    $result = $query->result_array();

    // 3. Add 'is_mine' flag for the UI
    foreach ($result as &$row) {
        // If the creator matches the current logged-in ID, set is_mine = true
        if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
            $row['is_mine'] = true;
        } else {
            $row['is_mine'] = false;
        }
    }
    return $result;
}
    public function insertNewSymptoms($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        // Fetch the String ID to save as 'created_by'
        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'symptomsName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        
        $this->db->insert('symptoms_list', $data);
        return $this->db->insert_id();
    }

    public function updateSymptomName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('symptoms_list', ['symptomsName' => $name]);
    }

    // 6. Delete Symptom
    public function deleteSymptom($id) {
        $this->db->where('id', $id);
        return $this->db->delete('symptoms_list'); 
    }



    //findings in consultaion form
    public function getFindings()
    {
        // Get Logged-in HCP ID string
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        // Fetch Active Findings
        $this->db->select('*');
        $this->db->from('findings_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('findingsName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        // Mark 'is_mine' if created by this user
        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    // 2. Insert with Creator ID
    public function insertNewFindings($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'findingsName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('findings_list', $data);
        return $this->db->insert_id();
    }

    // 3. Update Name
    public function updateFindingName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('findings_list', ['findingsName' => $name]);
    }

    // 5. Delete Finding
    public function deleteFinding($id) {
        $this->db->where('id', $id);
        return $this->db->delete('findings_list'); 
    }

    public function getDiagnosis()
    {
        // 1. Get Logged-in HCP ID
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        // 2. Get Diagnosis
        $this->db->select('*');
        $this->db->from('diagnosis_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('diagnosisName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        // 3. Mark Ownership
        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }



    /* Diagnosis in consultation form */
    public function insertNewDiagnosis($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'diagnosisName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('diagnosis_list', $data);
        return $this->db->insert_id();
    }

    public function updateDiagnosisName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('diagnosis_list', ['diagnosisName' => $name]);
    }

    // 4. Delete Diagnosis
    public function deleteDiagnosis($id) {
        $this->db->where('id', $id);
        return $this->db->delete('diagnosis_list'); 
    }

    public function getInvestigations()
    {
        // 1. Get Logged-in HCP ID
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        // 2. Get Investigations
        $this->db->select('*');
        $this->db->from('investigations_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('investigationsName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        // 3. Mark Ownership
        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    public function insertNewInvestigations($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'investigationsName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('investigations_list', $data);
        return $this->db->insert_id();
    }

    public function updateInvestigationName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('investigations_list', ['investigationsName' => $name]);
    }

    // 3. Delete Investigation
    public function deleteInvestigation($id) {
        $this->db->where('id', $id);
        return $this->db->delete('investigations_list'); 
    }



    /* Procedures in consultation form */
    // 1. Get Procedures with Ownership Check
    public function getProcedures()
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        $this->db->select('*');
        $this->db->from('procedures_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('proceduresName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    // 2. Insert New Master Procedure
    public function insertNewProcedures($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'proceduresName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('procedures_list', $data);
        return $this->db->insert_id();
    }

    // 3. Update Master Procedure Name
    public function updateProcedureName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('procedures_list', ['proceduresName' => $name]);
    }

    // 2. Delete Procedure
    public function deleteProcedure($id) {
        $this->db->where('id', $id);
        return $this->db->delete('procedures_list'); 
    }



    // Advice in consultation form
    public function getAdvices()
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        $this->db->select('*');
        $this->db->from('advices_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('adviceName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    // 2. Insert New Master Advice
    public function insertNewAdvice($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'adviceName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('advices_list', $data);
        return $this->db->insert_id();
    }

    // 3. Update Master Advice Name
    public function updateAdviceName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('advices_list', ['adviceName' => $name]);
    }

    // 1. Delete Advice
    public function deleteAdvice($id) {
        $this->db->where('id', $id);
        return $this->db->delete('advices_list'); 
    }



  //Instruction in consultation page
    // 1. Get Instructions with Ownership Check
    public function getInstructions()
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        $this->db->select('*');
        $this->db->from('instructions_list');
        $this->db->where('activeStatus', '0');
        $this->db->order_by('instructionsName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    // 2. Insert New Master Instruction
    public function insertNewInstruction($name)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'instructionsName' => $name,
            'created_by' => $creator,
            'activeStatus' => '0'
        ];
        $this->db->insert('instructions_list', $data);
        return $this->db->insert_id();
    }

    // 3. Update Instruction Name
    public function updateInstructionName($id, $name) {
        $this->db->where('id', $id);
        return $this->db->update('instructions_list', ['instructionsName' => $name]);
    }

    // 4. Delete Master Instruction (Hard Delete)
    public function deleteInstruction($id) {
        $this->db->where('id', $id);
        return $this->db->delete('instructions_list'); 
    }



  //Medicine for consultaion form
    public function getMedicines()
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $myHcpIdString = '';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $myHcpIdString = $user['hcpId'];
            }
        }

        $this->db->select('*');
        $this->db->from('medicines_list');
        // Optional: Filter by activeStatus if you add that column, otherwise get all
        $this->db->order_by('medicineName', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as &$row) {
            if (!empty($myHcpIdString) && isset($row['created_by']) && $row['created_by'] === $myHcpIdString) {
                $row['is_mine'] = true;
            } else {
                $row['is_mine'] = false;
            }
        }
        return $result;
    }

    // 2. Insert New Master Medicine
    public function insertNewMedicineMaster($name, $composition, $category)
    {
        $hcpIdDb = isset($_SESSION['hcpIdDb']) ? $_SESSION['hcpIdDb'] : 0;
        $creator = 'admin';

        if ($hcpIdDb > 0) {
            $user = $this->db->get_where('hcp_details', ['id' => $hcpIdDb])->row_array();
            if ($user) {
                $creator = $user['hcpId'];
            }
        }

        $data = [
            'medicineName' => $name,
            'compositionName' => $composition,
            'category' => $category,
            'created_by' => $creator,
            'activeStatus' => '0' // Assuming you added activeStatus column, else remove this
        ];
        
        $this->db->insert('medicines_list', $data);
        return $this->db->insert_id();
    }

    // 3. Update Master Medicine
    public function updateMedicineMaster($id, $name, $composition, $category) {
        $this->db->where('id', $id);
        $data = [
            'medicineName' => $name,
            'compositionName' => $composition,
            'category' => $category
        ];
        return $this->db->update('medicines_list', $data);
    }

    // 4. Delete Master Medicine (Hard Delete or Soft Delete based on your preference)
    public function deleteMedicineMaster($id) {
        $this->db->where('id', $id);
        // Using delete to match your request for "Delete"
        return $this->db->delete('medicines_list'); 
    }
}
