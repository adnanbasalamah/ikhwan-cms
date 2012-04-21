<?php
class MyController extends CI_Controller {

	function index()
	{
		echo 'Hello World!';
	}
	function myfunction1($var1, $var2)
	{
		echo $var1;
		echo $var2;
	}
}
?>