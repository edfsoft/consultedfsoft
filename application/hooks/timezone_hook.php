<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function set_db_timezone()
{
    $CI =& get_instance();
    $CI->load->database(); // IMPORTANT safety line
    $CI->db->query("SET time_zone = '+05:30'");
}