

<?php
class VideoCategory extends CI_Controller {
//function list

//5. show category
//6. add category
//7. edit category
//8. delete category 


	function index()
	{	
		echo 'Hello World!';
	}
	
	
	function show_category_list($var1, $var2)
	{ // baca database, tampilkan list category
		echo $var1;
		echo $var2;
	}    
	
	function create_category($var1, $var2)
	{ 	// tampilkan form data category, 
		// ambil datanya
		// insert ke database
		// panggil show_category_list
		
		echo $var1;
		echo $var2;
	}    
	
	function update_category($var1, $var2)
	{ 	// dipanggil dari show_category_list, ketika satu category di klik
		// baca database berdasar no_category
		// tampilkan form data category beserta hasil pembacaan database nya
		// ambil datanya hasil editan
		// insert ke database
		// panggil show_category_list
		
		echo $var1;
		echo $var2;
	}        
	
	function delete_category($var1, $var2)
	{ 	// dipanggil dari show_category_list, ketika satu category di klik
		// tampilkan "are you sure you want to delete this category ? 
		// kalau ok, delete category dari database
		// panggil show_category_list
		
		echo $var1;
		echo $var2;
	}    
	
	function _my_private_function()
	{
	// some code
	}
}
?>        