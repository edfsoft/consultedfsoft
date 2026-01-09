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

        if (!$this->session->userdata('hcpsName') || !$this->session->userdata('hcpIdDb')) {
            redirect('Healthcareprovider/');
        }

    }

    public function consultation($patientIdDb)
    {
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
        $this->data['medicineCategories'] = $this->ConsultModel->getMedicineCategories();//pass category
        $this->data['dosageUnits'] = $this->ConsultModel->getDosageUnits();
        $this->data['advicesList'] = $this->ConsultModel->getAdvices();

        $this->data['consultations'] = $this->ConsultModel->get_consultations_by_patient($patientIdDb);
        $this->data['patient_id'] = $patientIdDb;

        $this->load->view('consultationView.php', $this->data);
    }

    // Follow up Consultation view page
    public function followupConsultation($consultation_id)
    {
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
        $data['medicineCategories'] = $this->ConsultModel->getMedicineCategories();
        $data['dosageUnits'] = $this->ConsultModel->getDosageUnits();

        // $data['attachments'] = $this->ConsultModel->get_attachments_by_consultation_id($consultation_id);

        $data['patient_id'] = $data['consultation']['patient_id'];
        $data['previous_consultation_id'] = $consultation_id;
        $data['patientDetails'] = $this->ConsultModel->getPatientDetails($data['patient_id']);

        $this->load->view('consultationView.php', $data);
    }

    // Common save consultation for new and follow-up
    public function saveConsultation()
    {
        $post = $this->input->post(null, true);
        $consultationId = $this->ConsultModel->save_consultation();
        $post['consultationId'] = $consultationId;

        $vitalsSaved = false;
        $symptomSaved = false;
        $findingSaved = false;
        $diagnosisSaved = false;
        $investigationSaved = false;
        $instructionSaved = false;
        $procedureSaved = false;
        $adviceSaved = false;
        $medicineSaved = false;
        $attachmentsSaved = false;
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

        $advices_json = $this->input->post('advicesJson');
        $advices = json_decode($advices_json, true);
        $adviceSaved = false;

        if ($advices && is_array($advices)) {
            foreach ($advices as $advice) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'advice_name' => $advice['advice'], // Matching JS key
                    'note' => $advice['note'],
                );
                $adviceSaved = $this->ConsultModel->save_advice($data);
            }
        }

        $instructionSaved = $this->ConsultModel->save_instruction($post);
        $procedureSaved = $this->ConsultModel->save_procedure($post);
        //$adviceSaved = $this->ConsultModel->save_advice($post);

        $medicines_json = $this->input->post('medicinesJson');
        $medicines = json_decode($medicines_json, true);

        if ($medicines && is_array($medicines)) {
            foreach ($medicines as $index => $medicine) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'medicine_name' => $medicine['medicine_name'],
                    'composition_name' => $medicine['composition'],
                    'category' => $medicine['category'],
                    'quantity' => $medicine['quantity'],
                    'timing' => $medicine['timing'],
                    'food_timing' => $medicine['food_timing'],
                    'notes' => $medicine['notes'],
                    'order_position' => $index + 1
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
            $this->session->set_flashdata('showSuccessMessage', implode(", ", $messages) . " saved successfully. Mail is being sent in the background.");
        } else {
            $this->session->set_flashdata('showErrorMessage', 'Failed to save consultation details.');
        }

        session_write_close();

        $redirectUrl = base_url('Consultation/consultation/' . $post['patientIdDb']);
        header("Location: " . $redirectUrl);
        header("Content-Encoding: none");
        header("Content-Length: 0");
        header("Connection: close");

        if (ob_get_level())
            ob_end_clean();
        flush();
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        if ($post['consultationSendEmail'] == '1') {

            $patient = $this->ConsultModel->getPatientDetails($post['patientIdDb']);
            $email = $patient[0]['mailId'];

            $rawInstructions = $this->input->post('instructions');
            $pdfInstructions = [];
            if (!empty($rawInstructions) && is_array($rawInstructions)) {
                foreach ($rawInstructions as $ins) {
                    $pdfInstructions[] = ['instruction_name' => $ins];
                }
            }
            date_default_timezone_set('Asia/Kolkata');
            $consultationData = [
                'patientDetails' => $patient,
                'consultation' => [
                    'consult_date' => date('Y-m-d'),
                    'consult_time' => date('H:i:s'),
                    'symptoms' => $symptoms,
                    'diagnosis' => $diagnoses,
                    'medicines' => $medicines,
                    'instructions' => $pdfInstructions,
                    'next_follow_up' => $this->input->post('nextFollowUpDate')
                ]
            ];

            require_once FCPATH . 'vendor/autoload.php';
            $dompdf = new \Dompdf\Dompdf();

            $html = $this->load->view('prescription_pdf_template', $consultationData, true);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $output = $dompdf->output();
            $tempFileName = 'Consultation_' . date('d-m-Y_h-i_A') . '_' . $consultationId . '.pdf';
            $tempFilePath = FCPATH . 'uploads/temp/' . $tempFileName;

            if (!is_dir(FCPATH . 'uploads/temp/')) {
                mkdir(FCPATH . 'uploads/temp/', 0777, true);
            }
            file_put_contents($tempFilePath, $output);

            $message = "
                Dear {$patient[0]['firstName']},<br><br>
                Your consultation has been successfully completed.<br>
                Please find your consultation attached.
                <br><br>
                Regards,
                <br><b>EDF Healthcare Team</b>
            ";

            $this->email->set_newline("\r\n");
            $this->email->from('noreply@consult.edftech.in', 'Consult EDF');
            $this->email->to($email);
            $this->email->subject('Consultation Details');
            $this->email->message($message);
            $this->email->attach($tempFilePath);

            $this->email->send();

            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }

    }

    // Edit Consultation view page
    public function editConsultation($consultation_id)
    {
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
        $data['medicineCategories'] = $this->ConsultModel->getMedicineCategories();//pass category
        $data['dosageUnits'] = $this->ConsultModel->getDosageUnits();
        $data['attachments'] = $this->ConsultModel->get_attachments_by_consultation_id($consultation_id);

        $data['patient_id'] = $data['consultation']['patient_id'];
        $data['previous_consultation_id'] = $consultation_id;
        $data['patientDetails'] = $this->ConsultModel->getPatientDetails($data['patient_id']);

        $this->load->view('consultationView.php', $data);
    }

    public function saveEditConsult()
    {
        $post = $this->input->post(null, true);
        $vitalsSaved = false;
        $symptomSaved = false;
        $findingSaved = false;
        $diagnosisSaved = false;
        $investigationSaved = false;
        $instructionSaved = false;
        $procedureSaved = false;
        $adviceSaved = false;
        $medicineSaved = false;
        $attachmentsSaved = false;
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

        // Advices
        $advices_json = $this->input->post('advicesJson');
        $advices = json_decode($advices_json, true);
        $adviceSaved = false;

        if ($advices && is_array($advices)) {
            $existingIds = [];
            foreach ($advices as $advice) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'advice_name' => $advice['advice'],
                    'note' => $advice['note'],
                );

                if (!empty($advice['id']) && $advice['id'] !== 'new') {
                    $this->ConsultModel->update_advice($advice['id'], $data);
                    $existingIds[] = $advice['id'];
                } elseif ($advice['id'] == 'new') {
                    $insertId = $this->ConsultModel->save_advice($data);
                    $existingIds[] = $insertId;
                }
            }
            $this->ConsultModel->delete_removed_advices($consultationId, $existingIds);
            $adviceSaved = true;
        } else {
            // If array is empty, clear all for this consultation
            $this->ConsultModel->delete_advices($consultationId);
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
        /* $this->ConsultModel->delete_advices($consultationId);
        $adviceSaved = $this->ConsultModel->save_advice($post); */

        $medicines_json = $this->input->post('medicinesJson');
        $medicines = json_decode($medicines_json, true);

        if ($medicines && is_array($medicines)) {
            $existingIds = [];

            foreach ($medicines as $index => $medicine) {
                $data = array(
                    'consultation_id' => $consultationId,
                    'medicine_name' => $medicine['medicine_name'],
                    'composition_name' => $medicine['composition'],
                    'category' => $medicine['category'],
                    'quantity' => $medicine['quantity'],
                    'timing' => $medicine['timing'],
                    'food_timing' => $medicine['food_timing'],
                    'notes' => $medicine['notes'],
                    'order_position' => $index + 1
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

    /* symptoms for consultaion form */
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

    public function editSymptomItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $hcpId = $_SESSION['hcpIdDb'];

        if ($this->ConsultModel->updateSymptomName($id, $name, $hcpId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Permission denied']);
        }
    }

    public function deleteSymptomItem()
    {
        $id = $this->input->post('id');
        $hcpId = $_SESSION['hcpIdDb']; // Get from session

        if ($this->ConsultModel->deleteSymptom($id, $hcpId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Permission denied']);
        }
    }

    /* Finding in consultation form */
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

    public function editFindingItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateFindingName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteFindingItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteFinding($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    /* Diagnosis in consultation form */
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

    public function editDiagnosisItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateDiagnosisName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteDiagnosisItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteDiagnosis($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    /* Investigation in consultation form */
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

    public function editInvestigationItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateInvestigationName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteInvestigationItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteInvestigation($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    // Procedures in consultation form
    public function addProcedure()
    {
        $name = $this->input->post('name', true);
        if (!$name) {
            echo json_encode(["status" => "error", "message" => "Name required"]);
            return;
        }

        $id = $this->ConsultModel->insertNewProcedures($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save']);
        }
    }

    public function editProcedureItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateProcedureName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteProcedureItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteProcedure($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    // Advice  in consultion form
    public function addAdviceMaster()
    {
        $name = $this->input->post('name', true);
        if (!$name) {
            echo json_encode(["status" => "error", "message" => "Name required"]);
            return;
        }

        $id = $this->ConsultModel->insertNewAdvice($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save']);
        }
    }

    public function editAdviceItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateAdviceName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteAdviceItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteAdvice($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // Instructions in Consultation form
    public function addInstruction()
    {
        $name = $this->input->post('name', true);
        if (!$name) {
            echo json_encode(["status" => "error", "message" => "Name required"]);
            return;
        }

        $id = $this->ConsultModel->insertNewInstruction($name);

        if ($id) {
            echo json_encode(['status' => 'success', 'id' => $id, 'name' => $name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save']);
        }
    }

    public function editInstructionItem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if ($this->ConsultModel->updateInstructionName($id, $name)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteInstructionItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteInstruction($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    //Medicine for consultation form
    public function addNewMedicines()
    {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $data = json_decode($stream_clean, true);

        if (!$data) {
            $name = $this->input->post('name');
            $composition = $this->input->post('composition');
            $category = $this->input->post('category');
        } else {
            $name = $data['medicineName'] ??
                '';
            $composition = $data['compositionName'] ?? '';
            $category = $data['category'] ?? '';
        }

        if (!$name) {
            echo json_encode(['status' => 'error', 'message' => 'Name required']);
            return;
        }

        $id = $this->ConsultModel->insertNewMedicineMaster($name, $composition, $category);
        if ($id) {
            echo json_encode([
                'status' => 'success',
                'id' => $id,
                'medicineName' => $name,
                'compositionName' => $composition,
                'category' => $category
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save']);
        }
    }

    public function editMedicineItem()
    {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $data = json_decode($stream_clean, true);

        if ($data) {
            $id = $data['id'] ?? null;
            $name = $data['medicineName'] ?? null;
            $composition = $data['compositionName'] ?? null;
            $category = $data['category'] ?? null;
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $composition = $this->input->post('composition');
            $category = $this->input->post('category');
        }

        if ($this->ConsultModel->updateMedicineMaster($id, $name, $composition, $category)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function deleteMedicineItem()
    {
        $id = $this->input->post('id');

        if ($this->ConsultModel->deleteMedicineMaster($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

}