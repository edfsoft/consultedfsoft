<?php
class patientModel extends CI_Model
{
    public function patientLoginDetails()
    {
        $postData = $this->input->post(null, true);

        $email    = $postData['patientEmail'] ?? '';
        $password = $postData['patientPassword'] ?? '';

        if ($email === '' || $password === '') {
            return false;
        }

        $sql = "SELECT * FROM patient_details 
                WHERE mailId = ? AND deleteStatus = '0' LIMIT 1";
        $query = $this->db->query($sql, [$email]);
        if ($query->num_rows() !== 1) {
            return false;
        }
        $user = $query->row_array();

        if ($password === $user['patientPassword']) {
        return $user; // SUCCESS
        }

        return false;
    }

}

?>
