<?php
class Upload extends Application
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{	if(!logged_in()) { $this->login();}
		//$this->load->view('upload_form', array('error' => ' ' ));
		$this->ag_auth->view('images/upload_image',array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './assets/img';
		$config['file_name'] = $this->input->post('filename');
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{	// kalau gagal upluad 
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
			$this->ag_auth->view('images/upload_image',$error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			
			//Image Resizing
		$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 160;
		$config['height'] = 90;

		$this->load->library('image_lib', $config);

		if ( ! $this->image_lib->resize()){
			$this->session->set_flashdata('message', $this->image_lib->display_errors('<p class="error">', '</p>'));				
		}

			//$this->load->view('upload_success', $data);
			$this->ag_auth->view('images/upload_success',$data);
		}
	}
}
?>