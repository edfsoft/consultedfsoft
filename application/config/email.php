<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587; //  465
// $config['smtp_user'] = 'erodediabetesfoundation@gmail.com';
// $config['smtp_pass'] = 'aicbbfdzxzccqpfc';
$config['smtp_user'] = 'santhoshamparentalcare@gmail.com';
$config['smtp_pass'] = 'ruzn hytj fncv jkcn';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['smtp_timeout'] = 30;
$config['smtp_crypto'] = 'tls'; // ssl
$config['validate'] = TRUE;
$config['priority'] = 3;
