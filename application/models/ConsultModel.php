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

    public function getSymptoms()
    {
        $details = "SELECT * FROM `symptoms_list` WHERE `activeStatus` = '0' ORDER BY `symptomsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getFindings()
    {
        $details = "SELECT * FROM `findings_list` WHERE `activeStatus` = '0' ORDER BY `findingsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getDiagnosis()
    {
        $details = "SELECT * FROM `diagnosis_list` WHERE `activeStatus` = '0' ORDER BY `diagnosisName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getInvestigations()
    {
        $details = "SELECT * FROM `investigations_list` WHERE `activeStatus` = '0' ORDER BY `investigationsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getInstructions()
    {
        $details = "SELECT * FROM `instructions_list` WHERE `activeStatus` = '0' ORDER BY `instructionsName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getProcedures()
    {
        $details = "SELECT * FROM `procedures_list` WHERE `activeStatus` = '0' ORDER BY `proceduresName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getMedicines()
    {
        $details = "SELECT * FROM `medicines_list` ORDER BY `medicineName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function getAdvices()
    {
        $details = "SELECT * FROM `advices_list` WHERE `activeStatus` = '0' ORDER BY `adviceName` ";
        $select = $this->db->query($details);
        return $select->result_array();
    }

    public function insertNewSymptoms($name)
    {
        $this->db->insert('symptoms_list', ['symptomsName' => $name]);
        return $this->db->insert_id();
    }

    public function insertNewFindings($name)
    {
        $this->db->insert('findings_list', ['findingsName' => $name]);
        return $this->db->insert_id();
    }

    public function insertNewDiagnosis($name)
    {
        $this->db->insert('diagnosis_list', ['diagnosisName' => $name]);
        return $this->db->insert_id();
    }

    public function insertNewInvestigations($name)
    {
        $this->db->insert('investigations_list', ['investigationsName' => $name]);
        return $this->db->insert_id();
    }

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




}
