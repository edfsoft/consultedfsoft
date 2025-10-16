<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Consultation extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ConsultModel');
        $this->load->library('session');
        $this->load->library('email');
    }

    public function consultation($patientIdDb)
    {
        if (isset($_SESSION['hcpsName'])) {
            $this->data['method'] = "consultDashboard";
            $this->data['patientId'] = $patientIdDb;
            $this->data['patientDetails'] = $this->ConsultModel->getPatientDetails($patientIdDb);
            $this->data['symptomsList'] = $this->ConsultModel->getSymptoms();
            $this->data['findingsList'] = $this->ConsultModel->getFindings();
            $this->data['diagnosisList'] = $this->ConsultModel->getDiagnosis();
            $this->data['investigationsList'] = $this->ConsultModel->getInvestigations();
            $this->data['instructionsList'] = $this->ConsultModel->getInstructions();
            $this->data['proceduresList'] = $this->ConsultModel->getProcedures();
            $this->data['medicinesList'] = $this->ConsultModel->getMedicines();
            $this->data['advicesList'] = $this->ConsultModel->getAdvices();

            $this->data['consultations'] = $this->ConsultModel->get_consultations_by_patient($patientIdDb);
            $this->data['patient_id'] = $patientIdDb;

            $this->load->view('consultationView.php', $this->data);
        } else {
            redirect('Consultation/');
        }
    }

    public function addSymptom()
    {
        $name = $this->input->post('name', true);
        $id = $this->ConsultModel->insertNewSymptoms($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save symptom']);
        }
    }

    public function addFinding()
    {
        $name = $this->input->post('name', true);
        $id = $this->ConsultModel->insertNewFindings($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save symptom']);
        }
    }

    public function addDiagnosis()
    {
        $name = $this->input->post('name', true);
        $id = $this->ConsultModel->insertNewDiagnosis($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save symptom']);
        }
    }

    public function addInvestigation()
    {
        $name = $this->input->post('name', true);
        $id = $this->ConsultModel->insertNewInvestigations($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save symptom']);
        }
    }

    public function addInstruction()
    {
        $name = $this->input->post('name', true);
        if (!$name) {
            echo json_encode(["status" => "error", "message" => "Instruction name required"]);
            return;
        }
        $data = ["instructionsName" => $name];
        $this->db->insert("instructions_list", $data);
        $id = $this->db->insert_id();

        echo json_encode([
            "status" => "success",
            "id" => $id,
            "name" => $name
        ]);
    }

    public function addProcedure()
    {
        $name = $this->input->post('name', true);

        if (!$name) {
            echo json_encode(["status" => "error", "message" => "Procedure name required"]);
            return;
        }

        $data = ["proceduresName" => $name];
        $this->db->insert("procedures_list", $data);
        $id = $this->db->insert_id();

        echo json_encode([
            "status" => "success",
            "id" => $id,
            "name" => $name
        ]);
    }

    // Follow up Consultation view page
    public function followupConsultation($consultation_id)
    {
        if (isset($_SESSION['hcpsName'])) {
            $data['method'] = "followupConsult";
            $data['symptomsList'] = $this->ConsultModel->getSymptoms();
            $data['findingsList'] = $this->ConsultModel->getFindings();
            $data['diagnosisList'] = $this->ConsultModel->getDiagnosis();
            $data['investigationsList'] = $this->ConsultModel->getInvestigations();
            $data['instructionsList'] = $this->ConsultModel->getInstructions();
            $data['proceduresList'] = $this->ConsultModel->getProcedures();
            $data['medicinesList'] = $this->ConsultModel->getMedicines();
            $data['advicesList'] = $this->ConsultModel->getAdvices();

            $data['consultation'] = $this->ConsultModel->get_consultation_by_id($consultation_id);
            $data['vitals'] = $this->ConsultModel->get_vitals_by_consultation_id($consultation_id);
            $data['symptoms'] = $this->ConsultModel->get_symptoms_by_consultation_id($consultation_id);
            $data['findings'] = $this->ConsultModel->get_findings_by_consultation_id($consultation_id);
            $data['diagnosis'] = $this->ConsultModel->get_diagnosis_by_consultation_id($consultation_id);
            $data['investigations'] = $this->ConsultModel->get_investigations_by_consultation_id($consultation_id);
            $data['instructions'] = $this->ConsultModel->get_instructions_by_consultation_id($consultation_id);
            $data['procedures'] = $this->ConsultModel->get_procedures_by_consultation_id($consultation_id);
            $data['advices'] = $this->ConsultModel->get_advices_by_consultation_id($consultation_id);
            $data['medicines'] = $this->ConsultModel->get_medicines_by_consultation_id($consultation_id);
            // $data['attachments'] = $this->ConsultModel->get_attachments_by_consultation_id($consultation_id);

            $data['patient_id'] = $data['consultation']['patient_id'];
            $data['previous_consultation_id'] = $consultation_id;
            $data['patientDetails'] = $this->ConsultModel->getPatientDetails($data['patient_id']);

            $this->load->view('consultationView.php', $data);
        } else {
            redirect('Consultation/');
        }
    }

    // Common save consultation for new and follow-up
    public function saveConsultation()
    {
        $post = $this->input->post(null, true);
        $consultationId = $this->ConsultModel->save_consultation();
        $post['consultationId'] = $consultationId;
        // Vitals
        $vitalsSaved = $this->ConsultModel->save_vitals($post);
        // Symptoms
        $symptoms_json = $this->input->post('symptomsJson');
        $symptoms = json_decode($symptoms_json, true);
        if ($symptoms && is_array($symptoms)) {
            foreach ($symptoms as $symptom) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'symptom_name' => $symptom['symptom'],
                    'note' => $symptom['note'],
                    'since' => $symptom['since'],
                    'severity' => $symptom['severity'],
                );
                $symptomSaved = $this->ConsultModel->save_symptom($data);
            }
        }
        // Findings
        $findings_json = $this->input->post('findingsJson');
        $findings = json_decode($findings_json, true);

        if ($findings && is_array($findings)) {
            foreach ($findings as $finding) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'finding_name' => $finding['finding'],
                    'note' => $finding['note'],
                    'since' => $finding['since'],
                    'severity' => $finding['severity']
                );
                $findingSaved = $this->ConsultModel->save_finding($data);
            }
        }
        // Diagnosis
        $diagnosis_json = $this->input->post('diagnosisJson');
        $diagnoses = json_decode($diagnosis_json, true);
        if ($diagnoses && is_array($diagnoses) && !empty($diagnoses)) {
            foreach ($diagnoses as $diagnosis) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'diagnosis_name' => $diagnosis['name'],
                    'note' => $diagnosis['note'],
                    'since' => $diagnosis['since'],
                    'severity' => $diagnosis['severity']
                );

                $diagnosisSaved = $this->ConsultModel->save_diagnosis($data);
            }
        }
        // Investigations
        $investigations_json = $this->input->post('investigationsJson');
        $investigations = json_decode($investigations_json, true);
        if ($investigations && is_array($investigations)) {
            foreach ($investigations as $investigation) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'investigation_name' => $investigation['investigation'],
                    'note' => $investigation['note'],
                );
                $investigationSaved = $this->ConsultModel->save_investigation($data);
            }
        }

        $instructionSaved = $this->ConsultModel->save_instruction($post);
        $procedureSaved = $this->ConsultModel->save_procedure($post);
        $adviceSaved = $this->ConsultModel->save_advice($post);

        $medicines_json = $this->input->post('medicinesJson');
        $medicines = json_decode($medicines_json, true);

        if ($medicines && is_array($medicines)) {
            foreach ($medicines as $medicine) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'medicine_name' => $medicine['medicine'],
                    'quantity' => $medicine['quantity'],
                    'unit' => $medicine['unit'],
                    'timing' => $medicine['timing'],
                    'frequency' => $medicine['frequency'],
                    'food_timing' => $medicine['foodTiming'],
                    'duration' => $medicine['duration']
                );

                $medicineSaved = $this->ConsultModel->save_medicine($data);
            }
        }

        // Attachments
        if (!empty($_FILES['consultationFiles']['name'][0])) {
            $uploadPath = './uploads/consultations/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $filesCount = count($_FILES['consultationFiles']['name']);
            $uploadedFiles = [];
            $lastCounter = $this->ConsultModel->getLastAttachmentCounter($consultationId);

            $this->load->library('upload');

            for ($i = 0; $i < $filesCount; $i++) {
                if (!empty($_FILES['consultationFiles']['name'][$i])) {
                    $ext = pathinfo($_FILES['consultationFiles']['name'][$i], PATHINFO_EXTENSION);
                    $counter = str_pad($lastCounter + $i + 1, 2, '0', STR_PAD_LEFT);
                    $newFileName = "Attachment_" . str_pad($consultationId, 2, '0', STR_PAD_LEFT) . "_" . $counter . "." . $ext;

                    $_FILES['file']['name'] = $newFileName;
                    $_FILES['file']['type'] = $_FILES['consultationFiles']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['consultationFiles']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['consultationFiles']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['consultationFiles']['size'][$i];

                    $config = [
                        'upload_path' => $uploadPath,
                        'allowed_types' => 'jpg|jpeg|png|pdf|doc|docx',
                        'file_name' => $newFileName,
                        'overwrite' => false
                    ];

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadedFiles[] = $newFileName;
                        $this->ConsultModel->save_attachment($consultationId, $newFileName);
                        $attachmentsSaved = true;
                    } else {
                        error_log("Upload error for file {$newFileName}: " . $this->upload->display_errors());
                    }
                }
            }
        }

        $messages = [];

        if ($vitalsSaved)
            $messages[] = "Vitals";
        if ($findingSaved)
            $messages[] = "Findings";
        if ($diagnosisSaved)
            $messages[] = "Diagnosis";
        if ($symptomSaved)
            $messages[] = "Symptoms";
        if ($investigationSaved)
            $messages[] = "Investigations";
        if ($instructionSaved)
            $messages[] = "Instructions";
        if ($procedureSaved)
            $messages[] = "Procedures";
        if ($adviceSaved)
            $messages[] = "Advice";
        if ($medicineSaved)
            $messages[] = "Medicines";
        if ($attachmentsSaved)
            $messages[] = "Attachments";

        if (!empty($messages)) {
            $this->session->set_flashdata('showSuccessMessage', implode(", ", $messages) . " saved successfully.");
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to save consultation details.');
        }

        redirect('Consultation/consultation/' . $post['patientIdDb']);
    }

    // Edit Consultation view page
    public function editConsultation($consultation_id)
    {
        if (isset($_SESSION['hcpsName'])) {
            $data['method'] = "editConsult";
            $data['symptomsList'] = $this->ConsultModel->getSymptoms();
            $data['findingsList'] = $this->ConsultModel->getFindings();
            $data['diagnosisList'] = $this->ConsultModel->getDiagnosis();
            $data['investigationsList'] = $this->ConsultModel->getInvestigations();
            $data['instructionsList'] = $this->ConsultModel->getInstructions();
            $data['proceduresList'] = $this->ConsultModel->getProcedures();
            $data['medicinesList'] = $this->ConsultModel->getMedicines();
            $data['advicesList'] = $this->ConsultModel->getAdvices();

            $data['consultation'] = $this->ConsultModel->get_consultation_by_id($consultation_id);
            $data['vitals'] = $this->ConsultModel->get_vitals_by_consultation_id($consultation_id);
            $data['symptoms'] = $this->ConsultModel->get_symptoms_by_consultation_id($consultation_id);
            $data['findings'] = $this->ConsultModel->get_findings_by_consultation_id($consultation_id);
            $data['diagnosis'] = $this->ConsultModel->get_diagnosis_by_consultation_id($consultation_id);
            $data['investigations'] = $this->ConsultModel->get_investigations_by_consultation_id($consultation_id);
            $data['instructions'] = $this->ConsultModel->get_instructions_by_consultation_id($consultation_id);
            $data['procedures'] = $this->ConsultModel->get_procedures_by_consultation_id($consultation_id);
            $data['advices'] = $this->ConsultModel->get_advices_by_consultation_id($consultation_id);
            $data['medicines'] = $this->ConsultModel->get_medicines_by_consultation_id($consultation_id);
            $data['attachments'] = $this->ConsultModel->get_attachments_by_consultation_id($consultation_id);

            $data['patient_id'] = $data['consultation']['patient_id'];
            $data['previous_consultation_id'] = $consultation_id;
            $data['patientDetails'] = $this->ConsultModel->getPatientDetails($data['patient_id']);

            $this->load->view('consultationView.php', $data);
        } else {
            redirect('Consultation/');
        }
    }

    public function saveEditConsult()
    {
        $post = $this->input->post(null, true);
        $consultationId = $this->ConsultModel->update_consultation();
        $post['consultationId'] = $consultationId;
        // Vitals
        $vitalsSaved = $this->ConsultModel->update_vitals($post);
        // Symptoms
        $symptoms_json = $this->input->post('symptomsJson');
        $symptoms = json_decode($symptoms_json, true);

        if ($symptoms && is_array($symptoms)) {
            $existingIds = [];

            foreach ($symptoms as $symptom) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'symptom_name' => $symptom['symptom'],
                    'note' => $symptom['note'],
                    'since' => $symptom['since'],
                    'severity' => $symptom['severity'],
                );

                if (!empty($symptom['id'] !== 'new')) {
                    $this->ConsultModel->update_symptom($symptom['id'], $data);
                    $existingIds[] = $symptom['id'];
                } elseif ($symptom['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_symptom($data);
                    $existingIds[] = $insertId;
                }
            }

            $this->ConsultModel->delete_removed_symptoms($consultationId, $existingIds);
            $symptomSaved = true;
        }

        // Findings
        $findings_json = $this->input->post('findingsJson');
        $findings = json_decode($findings_json, true);
        if ($findings && is_array($findings)) {
            $existingIds = [];

            foreach ($findings as $finding) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'finding_name' => $finding['finding'],
                    'note' => $finding['note'],
                    'since' => $finding['since'],
                    'severity' => $finding['severity'],
                );

                if (!empty($finding['id'] !== 'new')) {
                    $this->ConsultModel->update_finding($finding['id'], $data);
                    $existingIds[] = $finding['id'];
                } elseif ($finding['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_finding($data);
                    $existingIds[] = $insertId;
                }
            }

            $this->ConsultModel->delete_removed_findings($consultationId, $existingIds);
            $findingSaved = true;
        }
        // Diagnosis
        $diagnosis_json = $this->input->post('diagnosisJson');
        $diagnoses = json_decode($diagnosis_json, true);
        if ($diagnoses && is_array($diagnoses)) {
            $existingIds = [];

            foreach ($diagnoses as $diagnosis) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'diagnosis_name' => $diagnosis['name'],
                    'note' => $diagnosis['note'],
                    'since' => $diagnosis['since'],
                    'severity' => $diagnosis['severity'],
                );

                if (!empty($diagnosis['id'] !== 'new')) {
                    $this->ConsultModel->update_diagnosis($diagnosis['id'], $data);
                    $existingIds[] = $diagnosis['id'];
                } elseif ($diagnosis['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_diagnosis($data);
                    $existingIds[] = $insertId;
                }
            }

            $this->ConsultModel->delete_removed_diagnosis($consultationId, $existingIds);
            $diagnosisSaved = true;
        }

        // Investigations
        $investigations_json = $this->input->post('investigationsJson');
        $investigations = json_decode($investigations_json, true);
        if ($investigations && is_array($investigations)) {
            $existingIds = [];

            foreach ($investigations as $investigation) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'investigation_name' => $investigation['investigation'],
                    'note' => $investigation['note'],
                );

                if (!empty($investigation['id'] !== 'new')) {
                    $this->ConsultModel->update_investigation($investigation['id'], $data);
                    $existingIds[] = $investigation['id'];
                } elseif ($investigation['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_investigation($data);
                    $existingIds[] = $insertId;
                }
            }

            $this->ConsultModel->delete_removed_investigations($consultationId, $existingIds);
            $investigationSaved = true;
        }
        // $this->ConsultModel->delete_investigations($consultationId);
        // $investigationSaved = $this->ConsultModel->save_investigation($post);
        // Instructions
        $this->ConsultModel->delete_instructions($consultationId);
        $instructionSaved = $this->ConsultModel->save_instruction($post);
        // Procedures
        $this->ConsultModel->delete_procedures($consultationId);
        $procedureSaved = $this->ConsultModel->save_procedure($post);
        // Advices
        $this->ConsultModel->delete_advices($consultationId);
        $adviceSaved = $this->ConsultModel->save_advice($post);

        $medicines_json = $this->input->post('medicinesJson');
        $medicines = json_decode($medicines_json, true);

        if ($medicines && is_array($medicines)) {
            $existingIds = [];

            foreach ($medicines as $medicine) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'medicine_name' => $medicine['medicine'],
                    'quantity' => $medicine['quantity'],
                    'unit' => $medicine['unit'],
                    'timing' => $medicine['timing'],
                    'frequency' => $medicine['frequency'],
                    'food_timing' => $medicine['foodTiming'],
                    'duration' => $medicine['duration']
                );

                if (!empty($medicine['id']) && $medicine['id'] !== 'new') {
                    $this->ConsultModel->update_medicine($medicine['id'], $data);
                    $existingIds[] = $medicine['id'];
                } elseif ($medicine['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_medicine($data);
                    $existingIds[] = $insertId;
                }
            }

            $this->ConsultModel->delete_removed_medicines($consultationId, $existingIds);
            $medicineSaved = true;
        }

        // Attachments
        // if (!empty($_FILES['consultationFiles']['name'][0])) {
        //     $uploadPath = './uploads/consultations/';
        //     if (!is_dir($uploadPath)) {
        //         mkdir($uploadPath, 0777, true);
        //     }

        //     $filesCount = count($_FILES['consultationFiles']['name']);
        //     $uploadedFiles = [];
        //     $lastCounter = $this->ConsultModel->getLastAttachmentCounter($consultationId);

        //     for ($i = 0; $i < $filesCount; $i++) {
        //         if (!empty($_FILES['consultationFiles']['name'][$i])) {
        //             $ext = pathinfo($_FILES['consultationFiles']['name'][$i], PATHINFO_EXTENSION);
        //             $counter = str_pad($lastCounter + $i + 1, 2, '0', STR_PAD_LEFT);
        //             $newFileName = "Attachment_" . str_pad($consultationId, 2, '0', STR_PAD_LEFT) . "_" . $counter . "." . $ext;

        //             $_FILES['file']['name'] = $newFileName;
        //             $_FILES['file']['type'] = $_FILES['consultationFiles']['type'][$i];
        //             $_FILES['file']['tmp_name'] = $_FILES['consultationFiles']['tmp_name'][$i];
        //             $_FILES['file']['error'] = $_FILES['consultationFiles']['error'][$i];
        //             $_FILES['file']['size'] = $_FILES['consultationFiles']['size'][$i];

        //             $config['upload_path'] = $uploadPath;
        //             $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        //             $config['file_name'] = $newFileName;

        //             $this->load->library('upload', $config);

        //             if ($this->upload->do_upload('file')) {
        //                 $uploadedFiles[] = $newFileName;
        //                 $this->ConsultModel->save_attachment($consultationId, $newFileName);
        //                 $attachmentsSaved = true;
        //             } else {
        //                 error_log("Upload error: " . $this->upload->display_errors()); // Log errors
        //             }
        //         }
        //     }
        // }
        if (!empty($_FILES['consultationFiles']['name'][0])) {
            $uploadPath = './uploads/consultations/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $filesCount = count($_FILES['consultationFiles']['name']);
            $uploadedFiles = [];
            $lastCounter = $this->ConsultModel->getLastAttachmentCounter($consultationId);

            $this->load->library('upload');

            for ($i = 0; $i < $filesCount; $i++) {
                if (!empty($_FILES['consultationFiles']['name'][$i])) {
                    $ext = pathinfo($_FILES['consultationFiles']['name'][$i], PATHINFO_EXTENSION);
                    $counter = str_pad($lastCounter + $i + 1, 2, '0', STR_PAD_LEFT);
                    $newFileName = "Attachment_" . str_pad($consultationId, 2, '0', STR_PAD_LEFT) . "_" . $counter . "." . $ext;

                    $_FILES['file']['name'] = $newFileName;
                    $_FILES['file']['type'] = $_FILES['consultationFiles']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['consultationFiles']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['consultationFiles']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['consultationFiles']['size'][$i];

                    $config = [
                        'upload_path' => $uploadPath,
                        'allowed_types' => 'jpg|jpeg|png|pdf|doc|docx',
                        'file_name' => $newFileName,
                        'overwrite' => false 
                    ];

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadedFiles[] = $newFileName;
                        $this->ConsultModel->save_attachment($consultationId, $newFileName);
                        $attachmentsSaved = true;
                    } else {
                        error_log("Upload error for file {$newFileName}: " . $this->upload->display_errors());
                    }
                }
            }
        }

        // Attachment edit consultation to remove in db and folder
        $removedFiles = json_decode($this->input->post('removedFiles'), true);
        if (!empty($removedFiles)) {
            foreach ($removedFiles as $fileName) {
                $filePath = FCPATH . 'uploads/consultations/' . $fileName;
                if (file_exists($filePath))
                    unlink($filePath);
                $this->ConsultModel->deleteAttachment($consultationId, $fileName);
            }
        }

        $messages = [];
        if ($vitalsSaved)
            $messages[] = "Vitals";
        if ($symptomSaved)
            $messages[] = "Symptoms";
        if ($findingSaved)
            $messages[] = "Findings";
        if ($diagnosisSaved)
            $messages[] = "Diagnosis";
        if ($investigationSaved)
            $messages[] = "Investigations";
        if ($instructionSaved)
            $messages[] = "Instructions";
        if ($procedureSaved)
            $messages[] = "Procedures";
        if ($adviceSaved)
            $messages[] = "Advice";
        if ($medicineSaved)
            $messages[] = "Medicines";
        if ($attachmentsSaved)
            $messages[] = "Attachments";

        if (!empty($messages)) {
            $this->session->set_flashdata('showSuccessMessage', implode(", ", $messages) . " updated successfully.");
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to update consultation details.');
        }

        redirect('Consultation/consultation/' . $post['patientIdDb']);
    }

    // Delete Consultation
    public function deleteConsultation($patientId, $consultationId)
    {
        $deleted = $this->ConsultModel->delete_consultation($consultationId);

        if ($deleted) {
            $this->session->set_flashdata('showSuccessMessage', 'Consultation deleted successfully.');
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to delete consultation.');
        }

        redirect('Consultation/consultation/' . $patientId);
    }




}