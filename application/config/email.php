<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['protocol'] = 'smtp';
/* $config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = '465';
$config['smtp_user'] = 'adnan.basalamah@gmail.com';
$config['smtp_pass'] = 'saratoga'; */

$config['smtp_host'] = 'smtp.gmx.net';
$config['smtp_port'] = '25';
$config['smtp_user'] = 'yourexpert@gmx.com';
$config['smtp_pass'] = 'stalag13';

$config['mailtype']  = 'text';
$config['charset']   = 'iso-8859-1';
$config['smtp_timeout'] =	'30';


/* End of file email.php */
/* Location: ./application/config/email.php */