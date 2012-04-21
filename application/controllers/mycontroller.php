<?php
class MyController extends CI_Controller {

	function index()
	{
		echo 'Hello World!';
	}
	function my_public_function($var1, $var2)
	{
		echo $var1;
		echo $var2;
	}
	
	function my_load_view()
	{
		$data['title'] = "My Real Title";
		$data['heading'] = "My Real Heading";

		$this->load->view('my_view', $data);
	}
	
	function _my_private_function()
	{
	// some code
	}
}
?>        