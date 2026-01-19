<?php
class PatientModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    // public function changeNewPassword()
    // {
    //     $post = $this->input->post(null, true);
    //     $updatedata = array(
    //         'hcpPassword' => password_hash($post['hcpCnfmPassword'], PASSWORD_BCRYPT),
    //     );
    //     $this->db->where('hcpMobile', $post['hcpMobileNum']);
    //     $this->db->update('hcp_details', $updatedata);
    //     return ($this->db->affected_rows() > 0);
    // }

    public function patientLoginDetails()
    {
        $postData = $this->input->post(null, true);
        $emailid = $postData['patientEmail'];
        $password = $postData['patientPassword'];
        $query = "SELECT * FROM patient_details WHERE mailId = ? AND deleteStatus = '0'";
        $result = $this->db->query($query, array($emailid));
        $user = $result->row_array();

        // $hashedPassword = $user['password'];
        // if (password_verify($password, $hashedPassword)) {
        //     return $user;
        // }
        if ($password == $user['password']) { /* Need to hash the password */
            return $user;
        }
    }










}
