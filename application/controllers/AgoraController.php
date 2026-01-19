<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgoraController extends CI_Controller {

    public function join() {
        
    $data['method']='videoCall';
    $data['app_id'] = 'f891d97665524065b626ea324f06942f';
    // Paste the temporary token you just copied here
    $data['temp_token'] = '007eJxTYPB+ITlNMN/W0z3t37UEhm9pYnPSZPZU+aWntUza/C4oTEOBIc3C0jDF0tzMzNTUyMTAzDTJzMgsNdHYyCTNwMzSxCjNbGduZkMgI8NEn63MjAwQCOJzMpSkFpfoFuXn5zIwAAA9rR8K'; 
    // The channel name must MATCH what you typed in the console
    $data['channel_name'] = 'test-room'; 

    $this->load->view('agoraTestView', $data);
}
}