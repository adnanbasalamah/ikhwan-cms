<?php
class Video extends Application
{
	// max record per page
	private $limit = 7;
	
	public function __construct()
	{
		parent::__construct();
		//$this->ag_auth->restrict('admin'); // restrict this controller to admins only
	
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Video_model','',TRUE);
	
	}

	function index()
	{	
		if(!logged_in()) { $this->login();}
	
		// offset
		$uri_segment = 4;   // di segmen ke berapa si no halaman mau diletakkan (utk pagination)
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$videos = $this->Video_model->get_paged_list($this->limit, $offset)->result();
		
		// configure & generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('/admin/video/index/');
 		$config['total_rows'] 	= $this->Video_model->count_all();
 		$config['per_page'] 	= $this->limit;
		$config['uri_segment'] 	= $uri_segment;
		$config['full_tag_open'] = '<ul>';		//The opening tag placed on the left side of the entire result.
		$config['full_tag_close'] = '</ul>';	//The closing tag placed on the right side of the entire result.

		//Customizing the First Link
		$config['first_link'] = 'First';		//The text you would like shown in the "first" link on the left. If you do not want this link rendered, you can set its value to FALSE.
		$config['last_link'] = 'Last';			//The text you would like shown in the "last" link on the right. If you do not want this link rendered, you can set its value to FALSE.
		$config['last_tag_open'] = '<li>';		//The opening tag for the "last" link.
		$config['last_tag_close'] = '</li>';	//The closing tag for the "last" link.

		//Customizing the "Next" Link
		$config['next_link'] = '&gt;';			//The text you would like shown in the "next" page link. If you do not want this link rendered, you can set its value to FALSE.
		$config['next_tag_open'] = '<li>';		//The opening tag for the "next" link.
		$config['next_tag_close'] = '</li>';	//The closing tag for the "next" link.

		//Customizing the "Previous" Link
		$config['prev_link'] = '&lt;';			//The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
		$config['prev_tag_open'] = '<li>';		//The opening tag for the "previous" link.
		$config['prev_tag_close'] = '</li>';	//The closing tag for the "previous" link.

		//Customizing the "Current Page" Link
		$config['cur_tag_open'] = '<li><a href="#">';	//The opening tag for the "current" link.
		$config['cur_tag_close'] = '</a></li>';			//The closing tag for the "current" link.

		//Customizing the "Digit" Link
		$config['num_tag_open'] = '<li>';		//The opening tag for the "digit" link.
		$config['num_tag_close'] = '</li>';		//The closing tag for the "digit" link. */
		
		
		$this->pagination->initialize($config);
		$data['pagination'] 	= $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		// setting table header
		$tmpl = array ('table_open'          => '<table class="table table-condensed">');
		$this->table->set_template($tmpl);

		//ID	Thumb	Title	Category	Date	Producer	Action
		$this->table->set_heading('No', 'Thumb','Title', 'Teaser','Category', 'Date', 'Producer', 'Actions');
		$i = 0 + $offset;
		
		foreach ($videos as $video)
		{
			$this->table->add_row(
				++$i, 
				'<img src="'.urldecode($video->screenshoot_url).'" "width="160" height="90" alt="">', 
				$video->video_title, 
				$video->video_teaser,
				$video->video_category,
				date('d-m-Y',strtotime($video->video_date)),
				$video->video_producer,
				
				anchor('/admin/video/update/'.$video->id,'<button class="btn btn-primary" type="submit">Edit</button>',array('class'=>'update')).' '.
				anchor('/admin/video/delete/'.$video->id,'<button class="btn btn-danger" type="submit">Delete</button></td>',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this video?')"))
			);
		}
		$data['table'] = $this->table->generate();
		$data1['title'] = "TVRSA";
		// load view
		
		$this->ag_auth->view('video/video_view',$data);
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new video';
		$data['message'] = '';
		$data['action'] = site_url('/admin/video/add_video/');
		$data['link_back'] = anchor('/admin/video/index/','Back to list of videos',array('class'=>'back'));
	
		// load view
		
		$this->ag_auth->view('video/video_add',$data);
	}
	  
	
	function add_video()
	{   // form handler utk add video
		// set common properties
		$data['title'] = 'Add new video';
		$data['action'] = site_url('/admin/video/add_video/');
		$data['link_back'] = anchor('/admin/video/index/','Back to list of videos',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{	
			// save data dari POST nya
			//	title, 			teaser,	videourl,		thumburl,	producer,
			// array berisi nama record di DB + isinya	
			$video = array(	'video_title' 		=> $this->input->post('title'),
							'video_teaser' 		=> $this->input->post('teaser'),
							'video_url' 		=> urlencode(prep_url($this->input->post('videourl'))),
							'screenshoot_url' 	=> urlencode(prep_url($this->input->post('thumburl'))),
							'video_producer' 	=> $this->input->post('producer'),
							'video_category' 	=> $this->input->post('category'),
							//,'video_tag' 		=> $this->input->post('gender'),
							'video_date' 		=> date('Y-m-d', time())
							);
			$id = $this->Video_model->save($video);
			
			// set user message
			$data['message'] = '<div class="success">add new video success</div>';
		}
		
		// load view

		$this->ag_auth->view('video/video_add',$data);
	}
	
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		//ambil data di database nya
		$video = $this->Video_model->get_by_id($id)->row();
		// prefill form values
		
		// set common properties
		$data['title'] = 'Update video';
		$data['message'] = '';
		$data['action'] = site_url('/admin/video/update_video');
		$data['link_back'] = anchor('/admin/video/index/','Back to list of videos',array('class'=>'back'));
		
		//current video status sent to form
		$data['video_id'] 			= $video->id;
		$data['video_title'] 		= $video->video_title;
		$data['video_teaser'] 		= $video->video_teaser;
		$data['video_url'] 			= urldecode($video->video_url);
		$data['screenshoot_url'] 	= urldecode($video->screenshoot_url);
		$data['video_category'] 	= $video->video_category;
		$data['video_producer'] 	= $video->video_producer;
		$data['video_date'] 		= $video->video_date;
		
		
		// load view
		
		$this->ag_auth->view('video/video_edit',$data);
	}
	
	function update_video()
	{
		// set common properties
		$data['title'] = 'Update video';
		$data['action'] = site_url('video/update_video');
		$data['link_back'] = anchor('video/index/','Back to list of videos',array('class'=>'back'));
		
		
			// save data
			$id = $this->input->post('id');
			
			
			$video = array(	'video_title' 		=> $this->input->post('title'),
							'video_teaser' 		=> $this->input->post('teaser'),
							'video_url' 		=> urlencode(prep_url($this->input->post('videourl'))),
							'screenshoot_url' 	=> urlencode(prep_url($this->input->post('thumburl'))),
							'video_category' 	=> $this->input->post('category'),
							'video_producer' 	=> $this->input->post('producer'),
							//,'video_tag' 		=> $this->input->post('gender'),
							'video_date' 		=> date('Y-m-d', time())
							);
							
			$this->Video_model->update($id,$video);
			
			//video test
			$data['video_id'] 			= $this->input->post('id');
			$data['video_title'] 		= $this->input->post('title');
			$data['video_teaser'] 		= $this->input->post('teaser');
			$data['video_url'] 			= $this->input->post('videourl');
			$data['screenshoot_url'] 	= $this->input->post('thumburl');
			$data['video_category'] 	= $this->input->post('category');
			$data['video_producer'] 	= $this->input->post('producer');
			
			// set user message
			$data['message'] = '<div class="success">update person success</div>';
		
		
		
		// load view
		$this->ag_auth->view('video/video_edit',$data);
	}
	
	function delete($id)
	{
		// delete person
		$this->Video_model->delete($id);
		
		// redirect to person list page
		redirect('/admin/video/index/','refresh');
	}       
	
	// set empty default form field values
	function _set_fields()
	{	//	title,	teaser,	videourl,	thumburl,	producer
		$this->form_data->title = '';
		$this->form_data->teaser = '';
		$this->form_data->videourl = '';
		$this->form_data->thumburl = '';
		$this->form_data->producer = '';
	}
	
	// validation rules
	function _set_rules()
	{
		//	id bigint auto_increment PRIMARY KEY,
			//	video_title varchar(50),			//	video_teaser tinytext,		 	 	 	 	 	 	 
			//	video_url tinytext,	 	 			//	screenshoot_url tinytext, 	 	 	 	 	 
			//	video_category varchar(50),	 	 	//	video_producer varchar(50),		 	 	 	 	 	 	 
			//	video_tag tinytext,	 	 	 	 	//	video_date date
			
			// save data
			// dari POST nya
			//	title,	teaser,	videourl,	thumburl,	producer
			
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('teaser', 'Teaser', 'required');
		$this->form_validation->set_rules('videourl', 'Videourl', 'required');
		$this->form_validation->set_rules('thumburl', 'Thumburl', 'required');
		$this->form_validation->set_rules('producer', 'Producer', 'required');
		//$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	
}
?>