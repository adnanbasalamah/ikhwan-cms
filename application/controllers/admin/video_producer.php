<?php
class VideoProducer extends CI_Controller {

	function index()
	{
		echo 'Hello World!';
	}
	function show_producer_list($var1, $var2)
	{ // baca database, tampilkan list producer
		echo $var1;
		echo $var2;
	}    
	
	function create_producer($var1, $var2)
	{ 	// tampilkan form data producer, 
		// ambil datanya
		// insert ke database
		// panggil show_producer_list
		
		echo $var1;
		echo $var2;
	}    
	
	function update_producer($var1, $var2)
	{ 	// dipanggil dari show_producer_list, ketika satu producer di klik
		// baca database berdasar no_producer
		// tampilkan form data producer beserta hasil pembacaan database nya
		// ambil datanya hasil editan
		// insert ke database
		// panggil show_producer_list
		
		echo $var1;
		echo $var2;
	}        
	
	function delete_producer($var1, $var2)
	{ 	// dipanggil dari show_producer_list, ketika satu producer di klik
		// tampilkan "are you sure you want to delete this producer ? 
		// kalau ok, delete producer dari database
		// panggil show_producer_list
		
		echo $var1;
		echo $var2;
	}    
	
	
		
		
	
	function _my_private_function()
	{
	// some code
	}
}
?>        